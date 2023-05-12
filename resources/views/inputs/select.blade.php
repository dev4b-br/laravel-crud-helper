<div class="mb-3 {{ implode(' ', $containerClasses) }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select class="form-select @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}" name={{ $name }} id="{{ $id }}">
        @foreach($options as $key => $option)
            <option value="{{ $key }}">{{ $option }}</option>
        @endforeach
    </select>
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
