<div class="modal fade" id="modalImageEdit" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-publicity-edit-image" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cambiar Imagen de Publicidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Imagen *</b></p>
                        <img src="" id="img-publicity" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="custom-file">
                                <input name="img_publicity" type="file" class="custom-file-input" id="imageEdit" aria-describedby="inputGroupFileAddon01">
                                <label id="img_publicity_edit" class="custom-file-label" for="imageEdit">Escoger archivo</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button id="change-image-button" type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>
</div>
