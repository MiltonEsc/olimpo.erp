<div id="modal_crear_departamento" class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px;">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="departamento_form_crear">
                    <h3 class="text-left">Informacion acerca del departamento</h3>
                    <div class="row">
                        <input type="hidden" id="id_departamento" name="id_departamento">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="nom_departamento">Nombre del departamento</label>
                                <input type="text" class="form-control" id="nom_departamento" name="nom_departamento" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="cod_departamento">Codigo</label>
                                <input type="text" class="form-control" id="cod_departamento" name="cod_departamento" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="des_departamento">Descripcion</label>
                                <input type="text" class="form-control" id="des_departamento" name="des_departamento" placeholder="">
                            </div>
                        </div>
                    </div>
                    <!-- <input type="submit" name="submit" class="btn btn-success submitBtn" value="Insertar" />
                    <input type="hidden" id="id_departamento" name="id_departamento"> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>