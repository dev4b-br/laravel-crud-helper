<div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
        <i
            class="mdi mdi-dots-vertical"></i></button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ $updateUrl }}"><i
                class="mdi mdi-pencil-outline me-1"></i>Editar</a>
        <form action="{{ $deleteUrl }}" method="POST" id="form-delete-{{ md5($deleteUrl) }}">
            @csrf
            @method('DELETE')
        </form>
        <a class="dropdown-item" href="javascript:document.getElementById('{{'form-delete-' . md5($deleteUrl)}}').submit()"><i
                class="mdi mdi-trash-can-outline me-1"></i>Remover</a>
    </div>
</div>

