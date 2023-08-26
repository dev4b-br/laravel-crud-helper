<div class="card-body">
    <form action="{{ $action }}" method="post" id="{{$formId}}" enctype="{{$enctype}}">
        @isset($gridRoute)
            <a href="{{ $gridRoute }}" class="d-flex align-items-center">
                <span class="mdi mdi-chevron-left mdi-24px"></span>
                <span>Voltar</span>
            </a>
            <br>
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

        <div class="mb-3">
            <button
                class="btn btn-{{$color ?? 'primary'}} d-grid @if($half ?? false) mx-auto w-50 @else w-100 @endif"
                type="submit">{{$submitText}}</button>
        </div>

    </form>
</div>


@section('laravel-crud-helper-scripts')
    @parent
    <script>
        @if($inputsWithRefreshList)
        @foreach($inputsWithRefreshList as $inputWithRefreshList)
        $('#{!! $inputWithRefreshList->getId() !!}').on('change', function () {
            let data = {
                _token: '{{ @csrf_token() }}',
                formData: $('#{{$formId}}').serialize(),
                refreshList:   ['{!! implode("','", $inputWithRefreshList->getRefreshList()) !!}']
            }
            $.ajax({
                type: 'POST',
                data: data,
                url:  '{{ $changeFieldCallbackUrl }}',
                success: function (data) {
                    handleRefreshData(data)
                },
            });
        });
        @endforeach
            function handleRefreshData(data) {
                $(data).each(function (index, item) {
                    let inputContainer = $('#'+item.id +  '-container')
                    inputContainer.replaceWith(item.html)
                })
            }
        @endif
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
                            $('#{{$formId}}').find('#errors-container').append(`<div class="alert alert-danger" role="alert">${val}</div>`);
                            $('#{{$formId}}').find(`#${key}-container`).append(`<div class="invalid-feedback">${val}</div>`);
                            $('#{{$formId}}').find(`#${key}-container`).find(':input').addClass('is-invalid')
                        });
                    }
                }
            });
        })

        @endif
    </script>
@endsection
