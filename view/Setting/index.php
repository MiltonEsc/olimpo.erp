<?php
require_once("../../config/conexion.php");
require_once '../../controller/MenuController.php';
if (isset($_SESSION["usu_id"])) {
?>
	<!DOCTYPE html>
	<html>
	<?php require_once("../MainHead/head.php"); ?>
	</head>

	<body class="with-side-menu">

		<?php require_once("../MainHeader/header.php"); ?>

		<div class="mobile-menu-left-overlay"></div>

		<?php require_once("../MainNav/nav.php"); ?>

		<!-- Contenido -->
		<div class="page-content">
			<div class="container-fluid">
				<div class="col-xl-9 col-lg-8">
					<form method="post" id="settings_form">
						<section class="tabs-section">
							<div class="tabs-section-nav tabs-section-nav-left">
								<ul class="nav" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#tabs-2-tab-1" role="tab" data-toggle="tab">
											<span class="nav-link-in">About me</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#tabs-2-tab-2" role="tab" data-toggle="tab">
											<span class="nav-link-in">Activity</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#tabs-2-tab-3" role="tab" data-toggle="tab">
											<span class="nav-link-in">Projects</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#tabs-2-tab-4" role="tab" data-toggle="tab">
											<span class="nav-link-in">Settings</span>
										</a>
									</li>
								</ul>
							</div>
							<!--.tabs-section-nav-->

							<div class="tab-content no-styled profile-tabs">
								<div role="tabpanel" class="tab-pane active" id="tabs-2-tab-1">
									<section class="box-typical box-typical-padding">
										Activity
									</section>
								</div>
								<!--.tab-pane-->
								<div role="tabpanel" class="tab-pane" id="tabs-2-tab-2">
									<section class="box-typical box-typical-padding">
									<form method="post" id="settings_form">
									<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">Slogan</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="slogan_app" type="text" name="slogan_app"/>
												</div>
											</div>

									</form>
									</section>
								</div>
								<!--.tab-pane-->
								<div role="tabpanel" class="tab-pane" id="tabs-2-tab-3">
									<section class="box-typical box-typical-padding">
										Projects
									</section>
								</div>
								<!--.tab-pane-->
								<div role="tabpanel" class="tab-pane" id="tabs-2-tab-4">
									<section class="box-typical profile-settings">
										<section class="box-typical-section">
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">Nombre de la aplicacion</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="nom_app" type="text" name="nom_app" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">Slogan</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="slogan_app" type="text" name="slogan_app"/>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">Mision</label>
												</div>
												<div class="col-xl-6">
												<div class="summernote-theme-1">
													<textarea id="mision_app" name="mision_app" class="summernote"></textarea>
												</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">Vision</label>
												</div>
												<div class="col-xl-6">
												
													<textarea id="vision_app" name="vision_app" class="summernote"></textarea>
											
												</div>
											</div>
										</section>
										<section class="box-typical-section">
											<header class="box-typical-header-sm">Info</header>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-pin-2"></i>
														City
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" type="text" id="city_app" name="city_app" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-users-two"></i>
														Departamento
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" name="dpto_app" id="dpto_app" type="text" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-case-3"></i>
														Direccion
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="direccion_app" name="direccion_app" type="text"/>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-github"></i>
														Supersite
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="supersite_app" name="supersite_app" type="text" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-earth"></i>
														Web
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="web_app" name="web_app" type="text"  />
												</div>
											</div>
										</section>

										<section class="box-typical-section">
											<header class="box-typical-header-sm">Pagina de usuarios nuevos</header>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-pin-2"></i>
														Titulo de cabezera
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="usu_new_title" name="usu_new_title" type="text"/>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-users-two"></i>
														Descripcion
													</label>
												</div>
												<div class="col-xl-6">
												<div class="summernote-theme-1">
													<textarea id="usu_new_des" name="usu_new_des" class="summernote"></textarea>
												</div>
												</div>
											</div>

										</section>

										<section class="box-typical-section">
											<header class="box-typical-header-sm">Pagina de edicion de usuarios</header>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-pin-2"></i>
														Titulo de formulario
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="usu_edit_title" name="usu_edit_title" type="text" />
												</div>
											</div>


										</section>

										<section class="box-typical-section">
											<header class="box-typical-header-sm">Pagina departamentos</header>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-pin-2"></i>
														Titulo de cabezera
													</label>
												</div>
												<div class="col-xl-6">
													<input class="form-control" id="dpto_name" name="dpto_name" type="text" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-xl-2">
													<label class="form-label">
														<i class="font-icon font-icon-users-two"></i>
														Descripcion de cabezera
													</label>
												</div>
												<div class="col-xl-6">
												<div class="summernote-theme-1">
													<textarea id="dpto_des" name="dpto_des" class="summernote"></textarea>
												</div>
												</div>
												
											</div>
										</section>

										<section class="box-typical-section">
											<header class="box-typical-header-sm">Correos</header>
											<div class="form-group row">
											</div>
											<div class="form-group purple-border mb-5">
												<label for="correo_soli_abierta" class="">Correos de solicitud abierta</label>
												<textarea class="form-control" id="correo_soli_abierta" name="correo_soli_abierta" rows="3"></textarea>
											</div>
											<div class="form-group purple-border mb-5">
												<label for="correo_soli_asignada" class="">Correo de solicitud asignada</label>
												<textarea class="form-control" id="correo_soli_asignada" name="correo_soli_asignada" rows="3"></textarea>
											</div>
											<div class="form-group purple-border mb-5">
												<label for="correo_soli_cerrada" class="">Correos de solicitud cerrada</label>
												<textarea class="form-control" id="correo_soli_cerrada" name="correo_soli_cerrada" rows="3"></textarea>
											</div>
											<p class="statusMsg"></p>
										</section>
										<section class="box-typical-section">
											<header class="box-typical-header-sm">MENU</header>
											<div class="form-group row">
											</div>

											<p class="statusMsg"></p>
										</section>
										<section class="box-typical-section profile-settings-btns">
											<button type="submit" class="btn btn-rounded">Guardar Cambios</button>
											<button type="button" class="btn btn-rounded btn-grey">Cancelar</button>
										</section>
										
									</section>
								</div>
								<!--.tab-pane-->
							</div>
							<!--.tab-content-->
						</section>
						<!--.tabs-section-->
					</form>
				</div>
			</div>
			<!-- Contenido -->

			<?php require_once("../MainJs/js.php"); ?>

			<script type="text/javascript" src="setting.js"></script>
	</body>

	</html>
<?php
} else {
	header("Location:" . Conectar::ruta() . "index.php");
}
?>