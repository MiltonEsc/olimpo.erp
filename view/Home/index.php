<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<div class="row">
	            <div class="col-xl-6">
					<section class="card">
						<header class="card-header">
							Grafico Estadístico
						</header>
						<div class="card-block">
							<div id="divgrafico" style="height: 250px;"></div>
						</div>
					</section>
	            </div><!--.col-->
	            <div class="col-xl-6">
	                <div class="row">
	                    <div class="col-sm-6">
							<article class="statistic-box green">
	                            <div>
	                                <div class="number" id="lbltotal"></div>
	                                <div class="caption"><div>Total de Solicitudes</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
							<article class="statistic-box yellow">
	                            <div>
	                                <div class="number" id="lbltotalabierto"></div>
	                                <div class="caption"><div>Total de Solicitudes Abiertas</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
							<article class="statistic-box red">
	                            <div>
	                                <div class="number" id="lbltotalcerrado"></div>
	                                <div class="caption"><div>Total de Solicitudes Cerradas</div></div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                   
	                </div><!--.row-->
	            </div><!--.col-->
	        </div><!--.row-->
			
			<div class="box-typical box-typical-padding">
				<p>
					Filtrar solicitudes.
				</p>

				<h5 class="m-t-lg">Ingresar Información</h5>

				<div class="row">
					<form method="post" id="ticket_form">

						<input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">

						<div class="col-lg-4">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Categoria</label>
								<select id="cat_id" name="cat_id" class="form-control">
								</select>
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Fecha Inicial</label>
								<input type="date" class="form-control" id="fech_inicial">
							</fieldset>
						</div>
						<div class="col-lg-2">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Fecha Final</label>
								<input type="date" class="form-control" id="fech_final">
								
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
						</div>
						<div class="col-lg-12">
						<table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
							<thead>
								<tr>
									<th style="width: 5%;">Nro.Ticket</th>
									<th style="width: 15%;">Categoria</th>
									<th class="" style="width: 40%;">Titulo</th>
									<th class="" style="width: 5%;">Estado</th>
									<th class="" style="width: 10%;">Fecha Creación</th>
									<th class="" style="width: 10%;">Fecha Asignación</th>
									<th class="" style="width: 10%;">Soporte</th>
									<th class="text-center" style="width: 5%;"></th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
						</div>

						
					</form>
				</div>

			</div>
			
		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>

	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script type="text/javascript" src="home.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>