<div class="btn-group me-3">
    <button class="btn btn-primary dropdown-toggle" type="button" id="link" data-bs-toggle="dropdown">
        @if($icon)
            <i class="mdi mdi-{{$icon}} me-1"></i>
        @endif
        {{$name}}
    </button>
    <ul class="dropdown-menu" aria-labelledby="link">
        @foreach($links as $link)
            <li>
                {!! $link->render() !!}
            </li>
        @endforeach
    </ul>
</div>
