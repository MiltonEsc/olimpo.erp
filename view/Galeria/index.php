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
		<section class="box-typical box-typical-full-height-with-header">
				<header class="box-typical-header box-typical-header-bordered">
					<div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
							<h3>Galeria</h3>
						</div>
						<div class="tbl-cell tbl-cell-actions">
							<button type="button" class="action-btn view active">
								<i class="font-icon font-icon-view-grid"></i>
							</button>
							<button type="button" class="action-btn view">
								<i class="font-icon font-icon-view-rows"></i>
							</button>
							<button type="button" class="action-btn view">
								<i class="font-icon font-icon-view-cascade"></i>
							</button>
						</div>
					</div>
				</header>
				<div class="box-typical-body">
					<div class="gallery-grid" id="gallery">
					</div><!--.gallery-grid-->
				</div><!--.box-typical-body-->
			</section><!--.box-typical-->
		</div>
	</div>
	<!-- Contenido -->

	<?php require_once("../MainJs/js.php");?>
	<?php require_once("uploadModal.php");?>
	<script type="text/javascript" src="galeria.js"></script>
</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>