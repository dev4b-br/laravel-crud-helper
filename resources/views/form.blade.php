@extends($parentView)
@section('laravel-crud-helper')
    <div class="card-body">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif


        <form action="{{ $action }}" method="post">
            @csrf
            @if($resource->exists)
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $resource->getKey() }}">
            @endif
            <div class="row">
                @foreach($inputs as $input)
                    {!! $input->render() !!}
                @endforeach
            </div>

            <div class="mb-3">
                <button
                    class="btn btn-{{$color ?? 'primary'}} d-grid @if($half ?? false) mx-auto w-50 @else w-100 @endif"
                    type="submit">{{$submitText}}</button>
            </div>

        </form>
    </div>
@endsection
