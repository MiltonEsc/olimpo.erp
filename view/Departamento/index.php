<?php
ini_set('display_errors', 1);
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
							<h3>Panel Administrativo de departamentos</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="<?php echo RUTA_URL ?>view/Home/">Home</a></li>
								<li class="active">Panel Administrativo</li>
							</ol>
						</div>
					</div>
				</div>
			</header>
			<section class="card mb-3 card-orange">
				<header class="card-header card-header-lg">
				<span class="label label-primary pull-right"><?php echo utf8_encode(strftime("%A %d de %B del %Y")); ?></span>
				</header>
				<div class="row">
					<div class="col-md-4">
						<div class="card-block">
						<img style="width: 100%" src="/public/img/18771.jpg" alt="" srcset="">	
						</div>
					</div>
					<div class="col-md-8">
						<div class="card-block">
						<h3 class="card-text"><?php echo DEPTO_DESCRIPTION ?></h3><br>
						<h1 class="card-text"><strong><?php echo NOM_APP ?></strong></h1>
					</div>
					
				</div>
				
			</section>
				<section class="tabs-section">
					<div class="tabs-section-nav tabs-section-nav-icons">
						<div class="tbl">
							<ul class="nav" role="tablist">
								<li class="nav-item">
									<a class="nav-link active show" href="#user-tabs-1-tab-1" role="tab" data-toggle="tab" aria-selected="true">
										<span class="nav-link-in">
											<i class="font-icon font-icon-home"></i>
											Listado de Departamentos
										</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#user-tabs-1-tab-2" role="tab" data-toggle="tab" aria-selected="false">
										<span class="nav-link-in">
											<span class="fa fa-product-hunt"></span>
											Departamentos desactivados
										</span>
									</a>
								</li>
							</ul>
						</div>
					</div><!--.tabs-section-nav-->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active show" id="user-tabs-1-tab-1">				
							<div class="box-typical box-typical-padding">
								<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Departamento</button>
								<table id="usuario_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
									<thead>
										<tr>
											<th style="width: 10%;">#</th>
											<th style="width: 40%;">Nombre</th>
											<th style="width: 10%;">codigo</th>
											<th style="width: 50%;">Descripcion</th>
											<th style="width: 50%;">Estado</th>
											<th class="text-center" style="width: 5%;">editar</th>
											<th class="text-center" style="width: 5%;">desactivar</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div><!--.tab-pane-->
						<div role="tabpanel" class="tab-pane fade" id="user-tabs-1-tab-2">
								<table id="usuario_inactivos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
									<thead>
										<tr>
											<th style="width: 10%;">#</th>
											<th style="width: 40%;">Nombre</th>
											<th style="width: 10%;">Codigo</th>
											<th style="width: 50%;">Descripcion</th>
											<th style="width: 50%;">Estado</th>
											<th class="text-center" style="width: 5%;">restaurar</th>
											<th class="text-center" style="width: 5%;">eliminar</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
						</div><!--.tab-pane-->
					</div><!--.tab-content-->
				</section>
			
		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("modal_crear_departamento.php");?>
	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="departamento.js"></script>
</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>