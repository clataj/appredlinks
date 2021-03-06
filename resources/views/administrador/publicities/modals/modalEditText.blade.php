<div class="modal fade" id="modalEditPublicity" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="form-edit-publicity">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Publicidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sub_categoria">Buscar</label>
                            <select
                                id="sub_categoria"
                                class="searchEnterpriseEdit form-control col-md-12"
                                name="sub_categoria">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipo">Tipo de publicidad *</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="0" selected disabled>-- Seleccione --</option>
                                    <option value="P">Publicidad Destacada</option>
                                    <option value="C">Publicidad Secundaria</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">Nombre Publicitario*</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            placeholder="Nombre de la publicidad">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado *</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="0" selected disabled>-- Seleccione --</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                    <option value="P">En Revision</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="fecha_inicio">Fecha de inicio *</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_fin">Fecha final *</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descripcion">Descripci??n *</label>
                        <input
                            type="text"
                            class="form-control"
                            id="descripcion"
                            name="descripcion"
                            placeholder="Descripci??n de la publicidad">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="edit-button" type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
