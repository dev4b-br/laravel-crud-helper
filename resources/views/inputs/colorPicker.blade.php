<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{ $id }}-container">
    <input name="{{ $name }}" id="{{ $id }}" value="{{ $value ?? $defaultValue }}" type="hidden"/>
    <label for="{{ $id }}-monolith-color-picker" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <div id="{{ $id }}-monolith-color-picker"></div>
    @if($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>

@section('laravel-crud-helper-scripts')
    @parent
    <script>
        var monolithPicker = pickr.create({
            el: "#{{ $id }}-monolith-color-picker",
            theme: "monolith",
            default: "{{ $value ?? $defaultValue }}",
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
            },
            // Translations
            i18n: {
                'ui:dialog': 'diálogo de seletor de cores',
                'btn:toggle': 'habilita diálogo de seletor de cores',
                'btn:swatch': 'amostra de cores',
                'btn:last-color': 'usar cor anterior',
                'btn:save': 'Salvar',
                'btn:cancel': 'Cancelar',
                'btn:clear': 'Limpar',
            }
        });

        monolithPicker.on('save', (colorVar, instanceVar) => {
            {{$id}}.value = colorVar.toHEXA().toString();
        });
    </script>
@endsection
