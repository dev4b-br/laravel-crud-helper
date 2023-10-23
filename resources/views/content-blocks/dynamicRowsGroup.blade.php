<div class="row">
    <div class="dynamic-row row">
        <input type="hidden" class="row-index" value="0">
        @foreach($items as $item)
            {!! $item->render() !!}
        @endforeach
        <div class="col-1 d-flex align-items-center">
            <a class="btn btn-label-success p-1 add-input-row-btn" style="margin-top: 12px">
                <span class="mdi mdi-plus"></span>
            </a>
            <a class="btn btn-label-danger p-1 remove-input-row-btn d-none" style="margin-top: 12px">
                <span class="mdi mdi-minus"></span>
            </a>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        function addRow() {
            let lastRowEl = $(".dynamic-row").last();
            let inputRowClone = lastRowEl.clone();
            let rowIndexEl = inputRowClone.find('.row-index');
            let rowIndex = parseInt(rowIndexEl.val()) + 1;

            @foreach($items as $item)
            inputRowClone.find('input[id^="{{ $item->getIdClean() }}"], select[id^="{{ $item->getIdClean() }}"]').attr('name', '{{str_replace(['[', ']'], '', $item->getName())}}[' + rowIndex + ']');
            @endforeach
            inputRowClone.find('.add-input-row-btn').addClass('d-none');
            inputRowClone.find('.remove-input-row-btn').removeClass('d-none');
            lastRowEl.after(inputRowClone);

            inputRowClone.find('input').val('')
            rowIndexEl.val(rowIndex);

            @if($callbackFunction)
                {{$callbackFunction}}(inputRowClone)
            @endif
        }

        $('.add-input-row-btn').on('click', function () {
            addRow();
            setRemoveInputRowBtn();
        })

        function setRemoveInputRowBtn() {
            $(".remove-input-row-btn").on('click', function () {
                $(this).parents('.dynamic-row').remove();
            });
        }
    </script>
@endsection

