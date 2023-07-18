<div class="row">
    <h5 class="{{ implode(' ', $classes) }}" data-bs-toggle="collapse" href="#{{ $id }}" role="button"
        aria-expanded="true"
        aria-controls="{{ $id }}">{{ $title }}</h5>
    <div class="collapse show" id="{{ $id }}">
        <div class="p-3">
            {!! $content->render() !!}
        </div>
    </div>
</div>
