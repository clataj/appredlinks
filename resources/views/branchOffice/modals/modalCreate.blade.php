<div class="modal fade" id="modalBranchOffice" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="form-save-branch-office">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva Sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="nombre">Nombre de la sucursal *</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            placeholder="Nombre de la sucursal">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ciudad_id">Ciudad *</label>
                        <select name="ciudad_id" id="ciudad_id" class="form-control">
                            <option value="0" selected disabled>-- Seleccione --</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->ciudDesc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado *</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="0" selected disabled>-- Seleccione --</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qr">Código QR *</label>
                            <input type="text" class="form-control" id="qr" name="qr" placeholder="Código QR">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Telefono *</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="direccion">Dirección *</label>
                            <input
                                type="text"
                                class="form-control"
                                id="direccion"
                                name="direccion"
                                placeholder="Dirección de la sucursal">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dias_laborales">Horario de Lunes a Viernes *</label>
                            <input
                                type="text"
                                class="form-control"
                                id="dias_laborales"
                                name="dias_laborales"
                                placeholder="Horario de Lunes a Viernes">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dia_no_laboral_1">Horario del Sábado</label>
                            <input
                                type="text"
                                class="form-control"
                                id="dia_no_laboral_1"
                                name="dia_no_laboral_1"
                                placeholder="Horario del Sábado">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dia_no_laboral_2">Horario del Domingo</label>
                            <input
                                type="text"
                                class="form-control"
                                id="dia_no_laboral_2"
                                name="dia_no_laboral_2"
                                placeholder="Horario del Domingo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="latitud_map">Latitud *</label>
                            <input
                                type="text"
                                class="form-control"
                                id="latitud_map"
                                name="latitud_map"
                                placeholder="Latitud del mapa">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="longitud_map">Longitud *</label>
                            <input
                                type="text"
                                class="form-control"
                                id="longitud_map"
                                name="longitud_map"
                                placeholder="Longitud del mapa">
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
