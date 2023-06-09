<div class="mb-3 {{ implode(' ', $containerClasses) }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control
           @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}" name="{{ $name }}"
           id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $value }}"/>
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
        @if($maskBlocks)
        $(document).ready(function () {
            new Cleave("#{{ $id }}", {
                @if($maskDelimiter) delimiters: ["{!! implode('","', $maskDelimiter) !!}"], @endif
                blocks: [{{ implode(',',$maskBlocks) }}],
                @if($isNumericalOnly) numericOnly: true, @endif
                @if($isUpperCase) uppercase: true, @endif
            });
        })
        @endif
    </script>
@endsection
