<div
    class="modal fade"
    id="modalEditCoupon"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="form-coupon-edit">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Cupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $id }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="nombre">Nombre del Cupon*</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            placeholder="Nombre del cupon">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="num_cupon">Número de cupones *</label>
                        <span
                            type="text"
                            class="form-control"
                            id="num-cupon-edit"
                            name="num_cupon"
                            placeholder="Numero de cupones"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="cant_x_usua">Cantidad de cupones por usuario *</label>
                        <input
                            type="text"
                            class="form-control"
                            id="cant_x_usua"
                            name="cant_x_usua"
                            placeholder="Numero de cupones">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span
                                class="text-danger">
                                <em>Nota: </em>
                            </span>
                            <span>
                                La cantidad de cupones no debe ser superior al numero de cupones
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="fecha_inicio">Fecha de inicio *</label>
                        <input
                            type="date"
                            name="fecha_inicio"
                            id="fecha_inicio"
                            class="form-control"
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="hora_inicio">Hora de inicio *</label>
                        <input
                            type="time"
                            name="hora_inicio"
                            id="hora_inicio"
                            class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="fecha_fin">Fecha final *</label>
                        <input
                            type="date"
                            name="fecha_fin"
                            id="fecha_fin"
                            class="form-control"
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="hora_final">Hora Final *</label>
                        <input
                            type="time"
                            name="hora_final"
                            id="hora_final"
                            class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="descripcion">Descripción *</label>
                        <input
                            type="text"
                            class="form-control"
                            id="descripcion"
                            name="descripcion"
                            placeholder="Descripción del cupon">
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
