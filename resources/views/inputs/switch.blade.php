<div class="mb-3 {{ implode(' ', $containerClasses) }}">
    <label class="switch">
        <input type="checkbox"
               @if($value) checked @endif
               @if($toggleUrl) onchange="toggleStatus('{{ $toggleUrl }}')" @endif
               class="switch-input @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
               name="{{ $name }}" id="{{ $id }}" value="1"/>
        <span class="switch-toggle-slider"></span>
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

@section('laravel-crud-helper-scripts')
    @parent
    <script>
        function toggleStatus(url) {
            $.get(url);
        }
    </script>
@endsection
