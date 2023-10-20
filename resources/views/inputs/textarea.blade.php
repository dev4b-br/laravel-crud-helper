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
        <script src='/assets/js/tinymce.js'></script>
        <script src='/assets/js/tinymce-pt_BR.js'></script>
        @if($tinyMCEScripts)
            {!! $tinyMCEScripts !!}
        @else
            <script>
                let editor = tinymce.init({
                    selector: '#{{$id}}',
                    height: 500,
                    toolbar: 'undo redo | styleselect | bold italic | alignleft'
                        + ' aligncenter alignright alignjustify | '
                        + 'bullist numlist outdent indent | link hr code | codes',
                    menubar: false,
                    relative_urls: false,
                    convert_urls: false,
                });
            </script>
        @endif

        <style>
            .ck-editor__editable {
                min-height: 500px;
            }
        </style>
    @endif
@endsection
