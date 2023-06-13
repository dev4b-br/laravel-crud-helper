@if($showLine)
    <hr />
@endif

@if($title)
    <h5 class="{{ implode(' ', $classes) }}">{{ $title }}</h5>
@endif
