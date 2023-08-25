
<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{$id}}-container">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <div id="files">
        @foreach($files as $file)
            <div class="file">
                <input type="hidden" name="{{ $name }}[]" value="{{ $file->id }}">
                <a href="{{ $file->url }}" target="_blank"><img src="{{ $file->url }}" width="10%"></a>
                <a href="{{ $deleteFileRoute }}/{{ $file->id }}" class="remove-file" data-id="{{ $file->id }}"><i
                        class="fas fa-trash"></i></a>
            </div><br>
        @endforeach
    </div>
    <br>
    <input type="file" @if($isMultiple) multiple
           @endif class="form-control @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
           name="{{ $name }}@if($isMultiple)[]@endif" id="{{ $id }}" placeholder="{{ $placeholder }}"/>
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
