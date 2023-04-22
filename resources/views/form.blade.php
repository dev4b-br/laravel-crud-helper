<form action="{{ $action }}" method="post">
    @foreach($inputs as $input)
        {!! $input->render() !!}
    @endforeach
</form>
