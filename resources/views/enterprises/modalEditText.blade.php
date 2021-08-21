<div class="modal fade" id="modalEnterpriseEditText" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="form-enterprise-edit" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <p class="text-purple text-bold">Información personal</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_comercial">Nombre Comercial *</label>
                            <input
                                type="text"
                                id="nombre_comercial"
                                name="nombre_comercial"
                                placeholder="Nombre comercial"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria_id">Categoria *</label>
                            <select name="categoria_id" id="categoria_id" class="custom-select">
                                <option value="0" selected disabled>-- Seleccione --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ruc">RUC *</label>
                            <input
                                type="text"
                                id="ruc"
                                name="ruc"
                                placeholder="Ingrese RUC de la empresa"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ruc">Razón social *</label>
                            <input
                                type="text"
                                id="razon_social"
                                name="razon_social"
                                placeholder="Razón social"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="beneficio">Beneficio *</label>
                            <input
                                type="text"
                                id="beneficio"
                                name="beneficio"
                                placeholder="Beneficio"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado *</label>
                            <select name="estado" id="estado" class="custom-select">
                                <option value="0" selected disabled>-- Seleccione --</option>
                                <option value="A">Activo</option>
                                <option value="I">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <p class="text-purple text-bold">Información de contacto</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección *</label>
                            <input
                                type="text"
                                id="direccion"
                                name="direccion"
                                placeholder="Dirección"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Telefono *</label>
                            <input
                                type="text"
                                id="telefono"
                                name="telefono"
                                placeholder="Telefono"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correo">Correo electrónico</label>
                            <input
                                type="text"
                                id="correo"
                                name="correo"
                                placeholder="Correo electrónico"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website">Sitio web</label>
                            <input
                                type="text"
                                id="website"
                                name="website"
                                placeholder="Sitio web"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <p class="text-purple text-bold">Redes sociales</p>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facebook"><i class="fab fa-facebook"></i> Facebook</label>
                            <input
                                type="text"
                                id="facebook"
                                name="facebook"
                                placeholder="Facebook"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="twitter"><i class="fab fa-twitter"></i> Twitter</label>
                            <input
                                type="text"
                                id="twitter"
                                name="twitter"
                                placeholder="Twitter"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instagram"><i class="fab fa-instagram"></i> Instagram</label>
                            <input
                                type="text"
                                id="instagram"
                                name="instagram"
                                placeholder="Instagram"
                                class="form-control">
                        </div>
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
