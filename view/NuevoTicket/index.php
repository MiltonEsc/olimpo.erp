<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">

			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Solicitudes</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Nueva solicitud</li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			<section class="card mb-3">
				<header class="card-header card-header-lg">
					Crear una Nueva Solicitud
					<p class="pull-right text-primary">
					<span class="label label-primary"><?php echo utf8_encode(strftime("%A %d de %B del %Y")); ?></span>
					</p>
				</header>
				<div class="row">
					<div class="col-md-4">
						<div class="card-block">
						<img class="img-fluid" style="width: 420px" src="/public/img/2480553.jpg" alt="" srcset="">	
						</div>
					</div>
					<div class="col-md-8">
						<div class="card-block">
						<h4 class="card-text">Bienvenido <?php echo $_SESSION['usu_nom']?>, aqui podra crear nuevas de ingreso, soporte, compras etc...</h4><br>
						<h1 class="card-text"><strong><?php echo CDA?></strong></h1>
					</div>
					</div>
				</div>
			</section>
			<div class="box-typical box-typical-padding">
				<p>
					Desde esta ventana podra generar nuevas Solicitudes.
				</p>

				<h5 class="m-t-lg">Ingresar Información</h5>

				<div class="row">
					<form method="POST" id="ticket_form">

						<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

						<div class="col-lg-12" id="titulo">
							<fieldset class="form-group">
								<label class="form-label semibold" for="tick_titulo">Titulo</label>
								<input type="text" class="form-control" id="tick_titulo" name="tick_titulo" placeholder="Ingrese Titulo">
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Categoria</label>
								<select id="cat_id" name="cat_id" class="form-control">
								</select>
							</fieldset>
						</div>
						<div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="fech_ingreso">Fecha ingreso del empleado</label>
                                <input type="date" class="form-control" id="fech_ingreso" name="fech_ingreso" >
                            </fieldset>
                        </div>
                        <div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold form-label" for="nom_emp">Nombre(s) del empleado</label>
                                <input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombres del empleado" style="text-transform: capitalize;">
                            </fieldset>
                        </div>
						<div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold form-label" for="ape_emp">Apellidos del empleado</label>
                                <input type="text" class="form-control" id="ape_emp" name="ape_emp" placeholder="Apellidos del empleado" style="text-transform: capitalize;">
                            </fieldset>
                        </div>
						<div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold form-label" for="usu_cedula">Documento de identificacion(*Solo numeros)</label>
                                <input type="text" class="form-control" id="usu_cedula" name="usu_cedula" placeholder="Ejem: 1002223455" maxlength="11" pattern="[0-9]+">
                            </fieldset>
                        </div>
						
						<div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold form-label" for="nom_jefe">Nombre del jefe inmediato</label>
                                <input type="text" class="form-control" id="nom_jefe" name="nom_jefe" placeholder="Nombre del Jefe inmediato">
                            </fieldset>
                        </div>
						<div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold form-label" for="correo">Correo corporativo del jefe inmediato</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo del Jefe inmediato">
                            </fieldset>
                        </div>
                        <div class="col-lg-6 fecha_ingreso" style="display: none;">
							<fieldset class="form-group">
								<label class="form-label semibold" for="nom_depa">Departamento</label>
								<select id="nom_depa" name="nom_depa" class="form-control">
								</select>
							</fieldset>
                        </div>
                        <div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="usu_cargo">Cargo del empleado</label>
                                <input type="text" class="form-control" id="usu_cargo" name="usu_cargo" placeholder="Ejem: Aux Archivo">
                            </fieldset>
                        </div>
						<div class="col-lg-6" id="fileElement">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Documentos Adicionales</label>
								<input type="file" name="fileElem" id="fileElem" class="form-control" multiple>
							</fieldset>
						</div>
						<div class="col-lg-6 fecha_ingreso" style="display: none;">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="fech_nac">Fecha nacimiento</label>
                                <input type="date" class="form-control" id="fech_nac" name="fech_nac" >
                            </fieldset>
                        </div>
						<div class="col-lg-12" id="descripcion">
							<fieldset class="form-group">
								<label class="form-label semibold" for="tick_descrip">Descripción</label>
								<div class="summernote-theme-1">
									<textarea id="tick_descrip" name="tick_descrip" class="summernote" name="name"></textarea>
								</div>
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="nuevoticket.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>