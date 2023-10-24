<div id="modal_crear_usuario" class="modal fade bd-example-modal-lg show" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="padding: 15px;">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title mdltitulo">Nuevo Registro</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="usuario_form_crear" enctype="multipart/form-data">
                    <h3 class="text-left">Informacion personal del empleado</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="usu_nom">Nombre</label>
                                <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Ingrese Nombre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="usu_ape">Apellido</label>
                                <input type="text" class="form-control" id="usu_ape" name="usu_ape" placeholder="Ingrese Apellido" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="usu_correo">Correo Electronico</label>
                                <input type="email" class="form-control" id="usu_correo" name="usu_correo"  placeholder="usuario@superbrix.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="usu_pass">Contraseña</label>
                                <input type="text" class="form-control" id="usu_pass" name="usu_pass" placeholder="**********" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="usu_cargo">Cargo en la Empresa</label>
                                <input type="text" class="form-control" id="usu_cargo" name="usu_cargo" placeholder="Ingrese Cargo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="usu_ext">Extencion</label>
                                <input type="text" class="form-control" id="usu_ext" name="usu_ext" placeholder="Ingrese Extencion">
                            </div>
                        </div>
                        <div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Departamento</label>
								<select id="usu_dpto" name="usu_dpto" class="form-control">
								</select>
							</fieldset>
						</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="fech_nac">Fecha Nacimiento</label>
                                <input type="date" class="form-control" id="fech_nac" name="fech_nac" placeholder="Ingrese fecha nacimiento" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="fech_ingreso">Fecha Ingreso</label>
                                <input type="date" class="form-control" id="fech_ingreso" name="fech_ingreso" placeholder="Ingrese fecha ingreso" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label semibold" for="rol_id">Rol</label>
                                <select class="select2" id="rol_id" name="rol_id">
                                    <option value="1">Usuario</option>
                                    <option value="2">Soporte</option>
                                    <option value="3">THumano</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <section class="card card-blue-fill">
                                <header class="card-header">
                                    Subir foto de perfil
                                </header>
                                <div class="card-block">
                                    <div class="form-group">
                                        <p class="statusMsg"></p>
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" id="file" name="file" />
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-success submitBtn" value="Registrar" />
                    <input type="hidden" id="est" name="est" value="1">
                    <input type="hidden" id="usu_id" name="usu_id">
                </form>
            </div>
        </div>
    </div>
</div>