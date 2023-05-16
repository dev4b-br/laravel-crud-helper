<div class="mb-3 {{ implode(' ', $containerClasses) }}">
    <div class="form-check mb-0">
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        <input type="{{ $type }}"
               class="form-check-input @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
               name="{{ $name }}" id="{{ $id }}" value="1"/>
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
</div>
