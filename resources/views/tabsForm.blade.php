@extends($parentView)
@section('laravel-crud-helper')
    <div class="nav-align-top">
        <ul class="nav nav-tabs" role="tablist">
            @foreach($forms as $key => $form)
                <li class="nav-item">
                    <button type="button" class="nav-link @if($key == 0) active @endif" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-{{ Str::slug($form->getTitle()) }}"
                            aria-controls="#tab-{{ Str::slug($form->getTitle()) }}"
                            @if($key == 0) aria-selected="true" @endif
                    >
                        {{ $form->getTitle() }}
                    </button>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($forms as $key => $form)
                <div class="tab-pane fade show @if($key == 0) active @endif" id="tab-{{ Str::slug($form->getTitle()) }}" role="tabpanel">
                    {!! $form->render() !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection


