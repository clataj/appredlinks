<div class="modal fade" id="modalPublicity" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <form class="modal-content" id="form-save-publicity">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva Publicidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                @if (count($enterprises) == 1)
                    @if ($enterprise!=null)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sub_categoria">Nombre de la empresa</label>
                                <span class="form-control">{{ $enterprise->nombre_comercial }}</span>
                            </div>
                            <input type="hidden" name="_sub_categoria" id="sub_categoria" value="{{ $enterprise->id }}">
                        </div>
                    </div>
                    @endif
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="sub_categoria">Buscar empresa</label>
                            <select
                                id="sub_categoria"
                                name="sub_categoria"
                                class="form-control subCategoria"
                                >
                                <option selected disabled value="0">-- Seleccione --</option>
                                @foreach($enterprises as $enterprise)
                                    <option value="{{ $enterprise->id }}">{{$enterprise->nombre_comercial}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipo">Tipo de publicidad *</label>
                                <select name="tipo" id="tipo" class="custom-select">
                                    <option value="0" selected disabled>-- Seleccione --</option>
                                    <option value="P">Publicidad Destacada</option>
                                    <option value="C">Publicidad Secundaria</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="nombre">Nombre Publicitario*</label>
                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            name="nombre"
                            placeholder="Nombre de la publicidad">
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
                            placeholder="Descripción de la publicidad">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="img_publicity">Imagen *</label>

                            <div class="custom-file">
                                <input name="img_publicity" type="file" class="custom-file-input" id="imagen" aria-describedby="inputGroupFileAddon01">
                                <label id="img_publicity" class="custom-file-label" for="imagen">Escoger archivo</label>
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
