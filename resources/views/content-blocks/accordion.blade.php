<div class="accordion" id="accordionWithIcon">
    @foreach($items as $item)
        <div class="accordion-item active">
            <h2 class="accordion-header d-flex align-items-center">
                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                        data-bs-target="#{{ $item->getId() }}" aria-expanded="true">
                    {!! $item->getTitle() !!}
                </button>
            </h2>

            <div id="{{ $item->getId() }}" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    {!! $item->render() !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
