<div class="modal fade" id="modalImageEdit" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="form-enterprise-edit-image" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cambiar Imagen de Fondo de la Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Imagen *</b></p>
                        <img src="" id="img-enterprise" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            
                            <div class="custom-file">
                                <input name="img_enterprise_bg" type="file" class="custom-file-input" id="image_enterprise_edit" aria-describedby="inputGroupFileAddon01">
                                <label id="img_enterprise_edit" class="custom-file-label" for="image_enterprise_edit">Escoger archivo</label>
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

<div class="modal fade" id="modalImageEditContent" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cambiar Imagen de Contenido de la Empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-enterprise-edit-image-content" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Imagen *</b></p>
                            <img src="" id="img-enterprise" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                
                                <div class="custom-file">
                                    <input name="img_enterprise_cont" type="file" class="custom-file-input" id="image_enterprise_edit_content" aria-describedby="inputGroupFileAddon01">
                                    <label id="img_enterprise_edit_content" class="custom-file-label" for="image_enterprise_edit_content">Escoger archivo</label>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="change-image-content-button" type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
