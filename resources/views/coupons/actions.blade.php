<div class="d-flex justify-content-start">
    <div class="row">
        <button
            title="Editar información"
            id="{{$id}}"
            type="button"
            class="edit btn btn-info mr-1 mb-1">
            <i class="fas fa-edit"></i>
        </button>
        @if ($estado == 2)
            <button
                title="Desactivar"
                id="{{$id}}"
                class="desactivate btn btn-danger mr-1 mb-1">
                <i class="fas fa-sync-alt"></i>
            </button>
        @endif
        @if ($estado == 5)
        <button
            title="Activar"
            id="{{$id}}"
            class="activate btn btn-success mr-1 mb-1">
            <i class="fas fa-sync-alt"></i>
        </button>
        @endif
    </div>
</div>
