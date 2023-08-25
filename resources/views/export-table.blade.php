@extends($exportView)
@section('laravel-crud-helper')
    <table>
        <thead>
        <tr>
            @foreach($columns as $column)
                @if($column->getName() == 'actions')
                    @continue
                @endif
                <th>{{$column->getHead()}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                @foreach($columns as $column)
                    @if($column->getName() == 'actions')
                        @continue
                    @endif
                    <td>
                        <h6>{{$column->getData($column->getName(), $item)}}</h6>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
