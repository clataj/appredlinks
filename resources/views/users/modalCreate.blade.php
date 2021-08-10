<div class="modal fade" id="modalUser" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form-user">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombres *</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Ingrese nombres"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo electrónico *</label>
                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder="Ingrese correo electrónico"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Contraseña *</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Ingrese contraseña"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm">Confirmar contraseña *</label>
                            <input
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                name="password_confirmation"
                                required
                                placeholder="Repita la contraseña"
                                autocomplete="new-password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="save-button" type="button" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>
