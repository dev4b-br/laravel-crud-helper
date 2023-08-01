<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{$id}}-container">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <select @if($isMultiple) multiple
            @endif class="form-select select2 @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
            name="{{ $name }}@if($isMultiple)[]@endif" id="{{ $id }}">
        @foreach($options as $key => $option)
            <option value="{{ $key }}"
                    @if($isMultiple && in_array($key, old($oldKey))) selected
                    @elseif(!$isMultiple && old($oldKey) == $key) selected @endif
                    @if(!old($oldKey) && $value == $key) selected @endif
            >
                {{ $option }}
            </option>
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

@section('laravel-crud-helper-scripts')
    @parent
    <script>
        $(document).ready(function () {
            $("#{{ $id }}").select2({
                language: "pt-BR",
                @if(!$searchBar) minimumResultsForSearch: -1,@endif
            });
        })
    </script>
@endsection
