<div class="modal fade" id="modalCategoryEdit" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-category-edit">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name-edit">Nombre de categoria *</label>
                            <input
                                type="text"
                                id="name-edit"
                                name="name"
                                placeholder="Ingrese nombre de categoria"
                                value=""
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status-edit">Estado *</label>
                            <select name="status" id="status-edit" class="custom-select">
                                <option value="0" selected disabled>-- Seleccione --</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="edit-button" type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>
</div>
