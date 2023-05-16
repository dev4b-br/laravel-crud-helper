<div class="mb-3 {{ implode(' ', $containerClasses) }}">
    <label class="switch">
        <input type="checkbox"
               class="switch-input @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
               name="{{ $name }}" id="{{ $id }}" value="1"/>
        <span class="switch-toggle-slider"></span>
        <span class="switch-label">{{ $label }}</span>
    </label>
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
