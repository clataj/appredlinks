<div class="modal fade" id="modalCategory" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-category" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nombre de categoria *</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Ingrese nombre de categoria"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status">Estado *</label>
                            <select name="status" id="status" class="custom-select">
                                <option value="0" selected disabled>-- Seleccione --</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="img_category">Subir Imagen *</label>
                            <div class="custom-file">
                                <input name="image_category" type="file" class="custom-file-input" id="image_category" aria-describedby="inputGroupFileAddon01">
                                <label id="img_category" class="custom-file-label" for="image_category">Escoger archivo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="save-button" type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>