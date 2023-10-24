<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once(RUTA_APP."/view/MainHead/head.php");?>
</head>
<body class="with-side-menu">

    <?php require_once(RUTA_APP."/view/MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once(RUTA_APP."/view/MainNav/nav.php");?>

	<!-- Contenido -->
    
    <img src="https://loading.io/asset/579540" alt="" srcset="">
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-8 col-lg-push-3 col-md-12">
				<section class="tabs-section">
                <div class="tabs-section-nav">
                    <div class="tbl">
                        <ul class="nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
                                    <span class="nav-link-in">
                                        Datos Usuarios
                                        <span class="label label-pill label-danger">1</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
                                    <span class="nav-link-in">
                                        Plantilla de cumpleaños
                                        <span class="label label-pill label-success">2</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabs-2-tab-3" role="tab" data-toggle="tab">
                                    <span class="nav-link-in">
                                        Plantilla de bienvenida
                                        <span class="label label-pill label-info">3</span>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabs-2-tab-4" role="tab" data-toggle="tab">
                                    <span class="nav-link-in">
                                        Plantilla de salida
                                        <span class="label label-pill label-warning">4</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--.tabs-section-nav-->

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active show" id="tabs-2-tab-1">
                        <!-- INICIO DE FORMULARIO -->
                        <form method="post" id="usuario_form" enctype="multipart/form-data">
                            <h3 class="text-left"><?php echo USER_EDIT_TITLE ?></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_nom">Nombre</label>
                                        <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Ingrese Nombre">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_ape">Apellido</label>
                                        <input type="text" class="form-control" id="usu_ape" name="usu_ape" placeholder="Ingrese Apellido">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_correo">Correo Electronico</label>
                                        <input type="email" class="form-control" id="usu_correo" name="usu_correo" placeholder="test@test.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_pass">Contraseña</label>
                                        <input type="text" class="form-control" id="usu_pass" name="usu_pass" placeholder="**********">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_pass">Cargo en la Empresa</label>
                                        <input type="text" class="form-control" id="usu_cargo" name="usu_cargo" placeholder="Ingrese Cargo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_pass">Extencion</label>
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
                                        <label class="form-label semibold" for="usu_pass">Fecha Nacimiento</label>
                                        <input type="date" class="form-control" id="fech_nac" name="fech_nac">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="usu_pass">Fecha Ingreso</label>
                                        <input type="date" class="form-control" id="fech_ingreso" name="fech_ingreso" placeholder="Ingrese fecha ingreso">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label semibold" for="rol_id">Rol</label>
                                        <select class="select2" id="rol_id" name="rol_id">
                                            <option value="1">Usuario</option>
                                            <option value="2">Soporte</option>
                                            <option value="3">Thumano</option>
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
                            <input type="submit" name="submit" class="btn btn-success submitBtn" value="Actualizar" />
                            <input type="hidden" id="usu_id" name="usu_id">
                        </form>
                        <!-- FIN DEL FORMULARIO -->
                    </div>
                    <!--.tab-pane-->
                    <div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-2">
                       	 <!-- INICIO DE PLANTILLA -->
                        <div id="contenedor-cumpleanios" class="contenedor" style="width: 800px; height:600px; margin:0 auto;">
                            <img id="fondo" src="../../public/fondo-cumpleanios.png" style="width: 800px; height:600px;  position: absolute;" alt="" srcset="">
                            <div style="padding-top: 60px; margin-left: 60px; width: 340px; height: 474px; position: absolute; z-index: 1;">
                                <h4 style="text-align: center; margin-bottom: 2px;  font-size: 20px; color: #b45f06"></h4>
                                <h4 style="text-align: center; margin-top: 58px; font-size: 15px; font-family: 'Exo', sans-serif; color: black;">
                                    <strong class="fech_actual"></strong>
                                </h4>
                                <div class="foto">
                                    <center><img src="" class="usu_foto" width="140" height="140" style="text-align: center; margin:0 auto;" alt="" srcset=""></center>
                                </div>
                                <center>
                                    <h4 class="nombre" style="text-align: center; margin: 4px 0px 0px 0px;     font-family: 'Courgette', cursive; font-weight: bold; font-size: 19px; color: #b45f06">

                                    </h4>
                                </center>
                                <center>
                                    <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                        <strong class="cargo"></strong>
                                    </p>
                                </center>
                                <center>
                                    <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                        <strong class="departamento"></strong>
                                    </p>
                                </center>
                                <center>
                                    <p style="text-align: center; margin: 0; font-family: 'Exo', sans-serif; font-size: small; color:black; font-weight: 400;">
                                        <strong class="ext"></strong>
                                    </p>
                                </center>
                            </div>
                        </div>
                        <br>
						<input type="button" id="enviar_cumpleanios" class="btn btn-success submitBtn" value="Enviar"/>
                    <input type="hidden" id="usu_id" name="usu_id">
                        <!-- FIN DE PLANTILLA -->
                    </div>
                    <!--.tab-pane-->
                    <div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-3">
                        	<!-- INICIO DE PLANTILLA -->
                        <div id="contenedor-bienvenida" class="bienvenida" style="width: 800px; height:600px; margin:0 auto;">
                            <img id="fondo" src="../../public/fondo-bienvenida.png" style="width: 800px; height:600px;  position: absolute;">
                            <div style="padding-top: 60px; margin: auto; width: 800px; height: 474px;  position: absolute; z-index: 1;">
                                <h4 style="text-align: center; margin-bottom: 2px;  font-size: 20px; color: #b45f06"></h4>
                                <h4 style="text-align: center; margin-top: 58px; font-size: 15px; font-family: 'Exo', sans-serif; color: black;"></h4>
                                <div class="foto">
                                    <center>
                                        <img src="" class="usu_foto" width="140" height="140" style="text-align: center; margin:0 auto;" alt="" srcset="">
                                    </center>
                                </div>
                                <center>
                                    <h4 class="nombre" style="text-align: center; margin: 4px 0px 0px 0px; font-family: 'Courgette', cursive; font-weight: bold; font-size: 19px; color: #b45f06">

                                    </h4>
                                </center>
                                <center>
                                    <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                        <strong class="cargo"></strong>
                                    </p>
                                </center>
                                <center>
                                    <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                        <strong class="departamento"></strong>
                                    </p>
                                </center>
                                <center>
                                    <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                        <strong class="correo"></strong>
                                    </p>
                                </center>
                                <center>
                                    <p style="text-align: center; margin: 0; font-family: 'Exo', sans-serif; font-size: small; color:black; font-weight: 400;">
                                        <strong class="ext"></strong>
                                    </p>
                                </center>
                            </div>
                        </div>
                        <br>
                        <input type="button" id="enviar_bienvenida" class="btn btn-success submitBtn" value="Enviar"/>
                    <input type="hidden" id="usu_id" name="usu_id">
                        <!-- FIN DE PLANTILLA -->
                    </div>
                    <!--.tab-pane-->
                    <div role="tabpanel" class="tab-pane fade" id="tabs-2-tab-4">
                        <!-- INICIO DE PLANTILLA -->
                            <div id="contenedor-despedida" class="bienvenida" style="width: 800px; height:600px; margin:0 auto;">
                                <img id="fondo" src="../../public/fondo-despedida.png" style="width: 800px; height:600px; position: absolute;">
                                <div style="padding-top: 60px; margin: auto; width: 800px; height: 474px;  position: absolute; z-index: 1;">
                                    <h4 style="text-align: center; margin-bottom: 2px; font-size: 20px; color: #b45f06"></h4>
                                    <h4 style="text-align: center; margin-top: 58px; font-size: 15px; font-family: 'Exo', sans-serif; color: black;"></h4>
                                    <div class="foto">
                                        <center><img
                                                src=""  class="usu_foto" width="140" height="140" style="text-align: center; margin: 58px 0px 10px auto;" alt="" srcset="">
                                        </center>
                                    </div>
                                    <center>
                                        <h4 class="nombre"
                                            style="text-align: center; margin: 4px 0px 0px 0px; font-family: 'Courgette', cursive; font-weight: bold; font-size: 19px; color: #b45f06">
                                           
                                        </h4>
                                    </center>
                                    <center>
                                        <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                            <strong class="cargo"></strong>
                                        </p>
                                    </center>
                                    <center>
                                        <p style="text-align: center; font-family: 'Exo', sans-serif; margin: 0; font-size: 15px; color:black;">
                                            <strong class="departamento"></strong>
                                        </p>
                                    </center>
                                </div>
                            </div>
                            <br>
                            <input type="button" id="enviar_despedida" class="btn btn-success submitBtn" value="Enviar"/>
                    <input type="hidden" id="usu_id" name="usu_id">
                    </div>
                  
                    <!--.tab-pane-->
                </div>
                <!--.tab-content-->
            </section>


				</div><!--.col- -->
				<div class="col-lg-4 col-lg-pull-6 col-md-6 col-sm-6">
					<section class="box-typical">
						<div class="profile-card">
							<div class="profile-card-photo">
								<img class="usu_foto" src="" alt=""/>
							</div>
							<div class="nombre" class="profile-card-name">Sarah Sanchez</div>
							<div class="cargo" class="profile-card-status">Company Founder</div>
							<div class="profile-card-location departamento">Greater Seattle Area</div>
							<!-- <button type="button" id="follow" class="btn btn-rounded">Follow</button>
							<div class="btn-group">
								<button type="button"
                                        id="connect"
										class="btn btn-rounded btn-primary-outline dropdown-toggle"
										data-toggle="dropdown"
										aria-haspopup="true"
										aria-expanded="false">
									Connect
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
									<a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
									<a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
									<a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
									<a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
								</div>
							</div> -->
						</div><!--.profile-card-->

						<div class="profile-statistic tbl">
							<div class="tbl-row">
								<div class="tbl-cell">
									<b>200</b>
									Extencion
								</div>
								<div class="tbl-cell">
									<b>1.9M</b>
									Followers
								</div>
							</div>
						</div>

						<ul class="profile-links-list">
							<li class="nowrap">
								<i class="font-icon font-icon-earth-bordered"></i>
								<a href="https://superbrix.com/" target="_blank">superbrix.com</a>
							</li>
							<li class="nowrap">
								<i class="font-icon font-icon-fb-fill"></i>
								<a href="https://www.facebook.com/superbrixco" target="_blank">Facebook</a>
							</li>
							<li class="nowrap">
								<i class="font-icon font-icon-in-fill"></i>
								<a href="https://www.instagram.com/superbrixco/" target="_blank">Instagram</a>
							</li>
							<li class="nowrap">
								<i class="font-icon font-icon-in-fill"></i>
								<a href="https://www.linkedin.com/company/superbrix/" target="_blank">Linkedin</a>
							</li>
							<li class="nowrap">
								<i class="font-icon font-icon-tw-fill"></i>
								<a href="https://mobile.twitter.com/superbrixco" target="_blank">twitter</a>
							</li>
							<li class="divider"></li>
							
						</ul>
					</section><!--.box-typical-->

				</div><!--.col- -->

			</div><!--.row-->
		</div><!--.container-fluid-->
	</div><!--.page-content-->
	<!-- Contenido -->

    <?php require_once("modal_crear_usuario.php");?>
    <?php require_once("cumpleaniosModal.php");?>
	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="edituser.js"></script>
</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>