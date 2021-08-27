<div class="d-flex justify-content-start">
    <div class="row">
        <div class="col">

            <button
                title="Ver Imagen"
                id="{{$id}}"
                class="view btn btn-primary btn-circle mr-1 mb-1">
                <i class="far fa-image"></i>
            </button>
            <button
                title="Editar imagen de fondo"
                id="{{$id}}"
                class="change-image-background btn btn-success btn-circle mr-1 mb-1">
                <i class="fas fa-paperclip"></i>
            </button>
            <button
                title="Editar imagen de contenido"
                id="{{$id}}"
                class="change-image-content btn btn-warning btn-circle mr-1 mb-1">
                <i class="fas fa-file"></i>
            </button>
            <button
                title="Editar"
                id="{{$id}}"
                type="button"
                class="edit btn btn-info btn-circle mr-1 mb-1">
                <i class="fas fa-pen-square"></i>
            </button>
            <button
                title="Eliminar"
                id="{{$id}}"
                class="delete btn btn-danger btn-circle mr-1 mb-1">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
</div>

