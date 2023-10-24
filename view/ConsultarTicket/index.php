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
							<h3>Consultar Solicitudes</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Consultar Solicitudes</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">
				<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
					<thead>
						<tr>
							<th style="width: 5%;">Nro.Req</th>
							<th style="width: 15%;">Categoria</th>
							<th class="" style="width: 20%;">titular</th>
							<th class="" style="width: 30%;">Titulo</th>
							<th class="" style="width: 5%;">Estado</th>
							<th class="" style="width: 10%;">Fecha Creación</th>
							<th class="" style="width: 10%;">Fecha Asignación</th>
							<th class="" style="width: 10%;">Responsable</th>
							<th class="text-center" style="width: 5%;">Acciones</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- Contenido -->
	<?php require_once("modalasignar.php");?>

	<?php require_once("../MainJs/js.php");?>

	<script type="text/javascript" src="consultarticket.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."view/DetalleTicket/index2.php");
  }
?>