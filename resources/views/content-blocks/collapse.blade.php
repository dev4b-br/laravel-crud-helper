<div class="row">
    <h5 class="collapsible-header {{ implode(' ', $classes) }} d-flex align-items-center" data-bs-toggle="collapse" href="#{{ $id }}" role="button"
        aria-expanded="true"
        aria-controls="{{ $id }}">{{ $title }}
        <span class="mdi mdi-chevron-down" style="vertical-align: 2px; margin: 0 0.5rem"></span>
        <span class="flex-grow-1 bg-secondary" style="height: 1px"></span>
    </h5>
    <div class="collapse show" id="{{ $id }}">
        <div class="p-3">
            {!! $content->render() !!}
        </div>
    </div>
</div>

<style>
    .collapsible-header .mdi {
        transition: transform 0.2s ease-in-out;
    }
</style>
@section('laravel-crud-helper-scripts')
<script>
    $(document).ready(function () {
        $('.collapsible-header .mdi').css('transform', 'rotate(180deg');
    });

    $(".collapsible-header").on('click', function () {
        let mdiSpan = $(this).find('.mdi');
        if ($(this).hasClass('collapsed')) {
            mdiSpan.css('transform', '');
        } else {
            mdiSpan.css('transform', 'rotate(180deg)');
        }
    });
</script>
@endsection
