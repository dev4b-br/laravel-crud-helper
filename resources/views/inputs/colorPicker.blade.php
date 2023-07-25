<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{ $id }}-container">
    <input name="{{ $name }}" id="{{ $id }}" value="{{ $defaultColor }}" type="hidden"/>
    <label for="{{ $id }}-monolith-color-picker" class="form-label">{{ $label }}</label>
    <div id="{{ $id }}-monolith-color-picker"></div>
    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>

@section('laravel-crud-helper-scripts')
    <script>
        var monolithPicker = pickr.create({
            el: "#{{ $id }}-monolith-color-picker",
            theme: "monolith",
            default: "{{ $defaultColor }}",
            components: {
                // Main components
                preview: true,
                opacity: true,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    rgba: true,
                    hsla: true,
                    hsva: true,
                    cmyk: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        monolithPicker.on('save', (colorVar, instanceVar) => {
            {{$id}}.value = colorVar.toHEXA().toString();
        });
    </script>
@endsection
