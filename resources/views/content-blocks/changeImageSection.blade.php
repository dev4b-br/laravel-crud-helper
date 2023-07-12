<div class="mb-3 {{ implode(' ', $containerClasses) }}">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img src="{{ $placeholderPath }}" alt="user-image" class="d-block {{ $imageSize }} rounded">
        <div class="button-wrapper">
            <label class="btn btn-primary me-2 @if($hint) mb-3 @endif waves-effect waves-light gap-1" tabindex="0">
                <span class="d-none d-sm-block">Enviar nova Foto</span>
                <i class="mdi mdi-{{ $mdiIcon }} d-block"></i>
                <input type="file" id="{{ $id }}" name="{{ $name }}"
                       class="account-file-input @if($errors->get($name)) is-invalid @endif" hidden="">
            </label>
            @if($hint)
                <div class="text-muted small">{{ $hint }}</div>
            @endif
        </div>
    </div>
</div>
