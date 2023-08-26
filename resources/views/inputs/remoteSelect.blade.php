<div class="mb-3 {{ implode(' ', $containerClasses) }}" id="{{$id}}-container">
    <label for="{{ $id }}" class="form-label">{{ $label }}@if($required)
            <span class="text-danger">*</span>
        @endif</label>
    <select @if($isMultiple) multiple
            @endif class="form-select select2 @if($errors->get($name)) is-invalid @endif {{ implode(' ', $inputClasses) }}"
            name="{{ $name }}@if($isMultiple)[]@endif" id="{{ $id }}">
        @if($defaultOption)
            <option value="">{{$defaultOption}}</option>
        @endif
        @if($value)
            @foreach($options as $key => $option)
                <option value="{{ $key }}" @if(in_array($key, $value)) selected @endif>{{ $option }}</option>
            @endforeach
        @endif
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
        $.fn.select2.amd.define('select2/i18n/pt-BR', [], function () {
            return {
                errorLoading: function () {
                    return 'Os resultados não puderam ser carregados.';
                },
                inputTooLong: function (args) {
                    var overChars = args.input.length - args.maximum;
                    var message = 'Por favor, remove ' + overChars + ' caracter';
                    if (overChars != 1) {
                        message += 'es';
                    }

                    return message;
                },
                inputTooShort: function (args) {
                    var remainingChars = args.minimum - args.input.length;

                    var message = 'Por favor, insira ' + remainingChars + ' caracteres';

                    return message;
                },
                loadingMore: function () {
                    return 'Carregando mais resultados…';
                },
                maximumSelected: function (args) {
                    var message = 'Você só pode selecionar ' + args.maximum + ' ite';

                    if (args.maximum == 1) {
                        message += 'm';
                    } else {
                        message += 'ns';
                    }

                    return message;
                },
                noResults: function () {
                    return 'Nenhum resultado encontrado';
                },
                searching: function () {
                    return 'Procurando…';
                }
            };
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {
            $("#{{ $id }}").select2({
                language: "pt-BR",
                minimumResultsForSearch: 0,
                @if($maximumSelectionLength) maximumSelectionLength: {{ $maximumSelectionLength }}, @endif
@if($minimumInputLength) minimumInputLength: {{ $minimumInputLength }}, @endif
                ajax: {
                    type: "POST",
                    url: "{{$route}}",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
                }
            });
        })
    </script>
@endsection
