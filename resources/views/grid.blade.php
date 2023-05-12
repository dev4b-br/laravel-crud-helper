@extends($parentView)
@section('laravel-crud-helper')
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif


    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                @foreach($columns as $column)
                    <th>{{ $column->getHead() }}</th>
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
    </div>
@endsection
