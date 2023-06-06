@extends($parentView)
@section('laravel-crud-helper')

    <div class="card-header">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {!! session()->get('message') !!}
            </div>
        @endif
        @if($filters)
            <form method="GET" id="filter-form">
                <h5 class="card-title">Filtros</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    @foreach($filters as $filter)
                        {!! $filter->render() !!}
                    @endforeach
                </div>
                <input type="submit" hidden/>

        @endif
    </div>
    <div class="card-datatable table-responsive">
        <div class="table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row mx-2">
                    <div class="col-md-2">
                        <div class="me-3">
                            <div class="dataTables_length">
                                <label>Mostrar
                                    <select name="limit" class="form-select form-select-sm"
                                            onchange="document.getElementById('filter-form').submit();">
                                        <option value="10" @if($limit == 10) selected @endif>10</option>
                                        <option value="25" @if($limit == 25) selected @endif>25</option>
                                        <option value="50" @if($limit == 50) selected @endif>50</option>
                                        <option value="100" @if($limit == 100) selected @endif>100</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="col-md-10">
                        <div
                            class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                            <div class="dt-buttons btn-group flex-wrap">
                                @if($filters)
                                    <button onclick="document.getElementById('filter-form').submit();"
                                            class="btn btn-secondary btn-primary">
                                                                <span>
                                                                    <i class="mdi mdi-search-web me-0 me-sm-1"></i>
                                                                    <span class="d-none d-sm-inline-block">Buscar</span>
                                                                </span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped dataTable">
                    <thead>
                    <tr>
                        @foreach($columns as $column)
                            <th @if($column->isSortable())
                                    class="{{ $column->getSorgingClasses() }}" onclick="window.location = '{{ $column->getSortUrl() }}'"
                                @endif
                            >{{ $column->getHead() }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            @foreach($columns as $column )
                                <td>{{ $column->getData($column->getName(), $row) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row mx-2">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            Mostrando de 1 até {{ $data->perPage() }} de {{ $data->total() }} registros
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                            {!! $data->appends(request()->input())->links() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--    todo: mover para alguma section --}}
    <style>
        .table-striped {
            margin-bottom: 1rem !important;
        }
    </style>
@endsection
