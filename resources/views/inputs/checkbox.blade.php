<div class="mb-3 {{ implode(' ', $containerClasses) }} d-flex align-items-end" id="{{$id}}-container">
    <div class="form-check mb-0">
        <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
                <span class="text-danger">*</span>
            @endif</label>
        <input type="{{ $type }}"
               @if($checked) checked @endif
               @if($disabled) disabled @endif
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
