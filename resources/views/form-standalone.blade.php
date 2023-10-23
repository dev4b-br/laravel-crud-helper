<div class="card-body">
    <form action="{{ $action }}" method="post" id="{{$formId}}" enctype="{{$enctype}}">
        @isset($gridRoute)
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <a href="{{ $gridRoute }}">
                    <span><i class="mdi mdi-chevron-left mdi-24px"></i>Voltar</span>
                </a>
                @if($dropdown)
                    {!! $dropdown !!}
                @endif
            </div>
        @endisset
        <div id="errors-container">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>

        @csrf
        @if(($resource ?? false) && $resource->exists)
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $resource->getKey() }}">
        @endif
        <div class="row">
            @foreach($inputs as $input)
                {!! $input->render() !!}
            @endforeach
        </div>

        @if($renderSubmitButton)
            <div class="mb-3">
                <button
                    class="btn btn-{{$color ?? 'primary'}} d-grid @if($half ?? false) mx-auto w-50 @else w-100 @endif"
                    type="submit">{{$submitText}}</button>
            </div>
        @endif
    </form>
</div>


@section('laravel-crud-helper-scripts')
    @parent
    <script>
        @if($inputsWithRefreshList)
        @foreach($inputsWithRefreshList as $inputWithRefreshList)
        $('#{!! $inputWithRefreshList->getId() !!}').on('change', function () {
            handleChangeFieldCallback(['{!! implode("','", $inputWithRefreshList->getRefreshList()) !!}'])
        });
        @endforeach
        @endif

        function handleChangeFieldCallback(refreshList) {
            let data = {
                _token: '{{ @csrf_token() }}',
                formData: $('#{{$formId}}').serialize(),
                refreshList: refreshList,
            }
            $.ajax({
                type: 'POST',
                data: data,
                url: '{{ $changeFieldCallbackUrl }}',
                success: function (data) {
                    handleRefreshData(data);
                    @if($inputsWithRefreshList)
                    @foreach($inputsWithRefreshList as $inputWithRefreshList)
                    $('#{!! $inputWithRefreshList->getId() !!}').on('change', function () {
                        handleChangeFieldCallback(['{!! implode("','", $inputWithRefreshList->getRefreshList()) !!}'])
                    });
                    @endforeach
                    @endif
                },
            });
        }

        function handleRefreshData(data) {
            $(data).each(function (index, item) {
                let inputContainer = $('#' + item.id + '-container')
                inputContainer.replaceWith(item.html)
            })
        }

        @if($isAjax)
        $('#{{$formId}}').on('submit', function (event) {
            event.preventDefault();
            $('#{{$formId}}').find('#errors-container').html('')
            $('#{{$formId}}').find(':input').removeClass('is-invalid')
            $('#{{$formId}}').find(':input').parent().find('.invalid-feedback').remove()
            $.ajax({
                type: 'POST',
                data: $('#{{$formId}}').serialize(),
                url: $('#{{$formId}}').attr('action'),
                success: function (data) {
                    let message = data.message
                    if (!message) {
                        message = 'Registro salvo com sucesso'
                    }

                    if (data.redirect) {
                        window.location.href = data.redirect
                    }

                    toastr.success(message, toastMessageSettings)
                },
                error: function (data) {
                    if (data.status === 422) {
                        var jsonData = $.parseJSON(data.responseText);
                        var errors = jsonData.errors
                        $.each(errors, function (key, val) {
                            @if($showErrorsOnTop)
                            $('#{{$formId}}').find('#errors-container').append(`<div class="alert alert-danger" role="alert">${val}</div>`);
                            @endif
                            $('#{{$formId}}').find(`[id^=${key}][id $=-container]`).append(`<div class="invalid-feedback">${val}</div>`);
                            $('#{{$formId}}').find(`[id^=${key}][id $=-container]`).find(':input').addClass('is-invalid')
                        });
                    }
                }
            });
        })

        @endif
    </script>
@endsection
