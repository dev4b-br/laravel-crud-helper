@extends('laravel-crud-helper::inputs.text')

@section('laravel-crud-helper-scripts')
    @parent
    <script>
        @if($autofill)
        const cep = document.querySelector("input[name={{ $name }}]");

        cep.addEventListener('blur', e => {
            const value = cep.value.replace(/[^0-9]+/, '');
            const url = `https://viacep.com.br/ws/${value}/json/`;

            fetch(url)
                .then(response => response.json())
                .then(json => {

                    if (json.logradouro) {
                        document.querySelector('input[name={{$addressInputName}}]').value = json.logradouro;
                        document.querySelector('input[name={{$neighborhoodInputName}}]').value = json.bairro;
                        document.querySelector('input[name={{$cityInputName}}]').value = json.localidade;
                        document.querySelector('input[name={{$stateInputName}}]').value = json.uf;
                    }


                });
        });
        @endif
    </script>
@endsection
