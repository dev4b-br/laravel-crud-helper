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
                    <th>{{ $column }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($data as $line)
                <tr>
                    <td><i class="mdi mdi-wallet-travel mdi-20px text-danger me-3"></i> <strong>Tours Project</strong>
                    </td>
                    <td>Albert Cook</td>
                    <td>
                    </td>
                    <td><span class="badge bg-label-primary me-1">Active</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i
                                    class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"><i
                                        class="mdi mdi-pencil-outline me-1"></i>Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><i
                                        class="mdi mdi-trash-can-outline me-1"></i>Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
