<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{$id}}-container">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <textarea class="form-control h-px-100 @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
              name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}">{{ old($oldKey) ?? $value }}</textarea>
    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
    @if($showInputErrorMessages)
        @if($errors->get($name))
            @foreach($errors->get($name) as $error)
                <div class="invalid-feedback">
                    {{$error}}
                </div>
            @endforeach
        @endif
    @endif
</div>

@section('laravel-crud-helper-scripts')
    @parent
    @if($isRichText)
        <script src="/assets/js/ckeditor.js"></script>
        <script src="/assets/js/ckeditor_pt-br.js"></script>
        <script>
            ClassicEditor
                .create(
                    document.querySelector('#{{$id}}'),
                    {
                        language: 'pt-br',
                        options: {}
                    }
                )
        </script>
        <style>
            .ck-editor__editable {
                min-height: 500px;
            }
        </style>
    @endif
@endsection
