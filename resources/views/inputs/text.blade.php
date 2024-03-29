<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{$id}}-container">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <input type="{{ $type }}"
           class="form-control @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
           name="{{ $name }}" @if($disabled) disabled @endif
           id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ old($oldKey) ?? $value }}"/>
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
    <script>
        @if($maskBlocks || $isNumericalOnly)
        $(document).ready(function () {
            new Cleave("#{{ $id }}", {
                @if($maskDelimiter) delimiters: ["{!! implode('","', $maskDelimiter) !!}"], @endif
                    @if($isNumericalOnly && !$maskBlocks)
                blocks: [100],
                @else
                blocks: [{{ implode(',',$maskBlocks) }}],
                @endif
                    @if($isFloat)
                numeral: true,
                delimiter: '.',
                numeralDecimalMark: ',',
                numeralDecimalScale: 2,
                @endif
                    @if($isNumericalOnly && !$isFloat)
                numericOnly: true,
                @endif
                    @if($isUpperCase) uppercase: true, @endif
            });
        })
        @endif
    </script>
@endsection
