<?php
require_once("../../config/conexion.php"); 
if(isset($_SESSION["usu_id"])){ 

    // require("..\..\controller\permisosRolesController\permisos_roles_controller.php"); 
    // $controller = new permisosRolesController();
    // $departamentos = $controller->mostrarDepartamentos();
    // $empleados = $controller->mostrarInformacionDeEmpleados();
    // $modulos = $controller->mostrarModulos();

?>
<!DOCTYPE html>
<html>
<?php require_once("../MainHead/head.php");?>
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> -->
</head>
<body class="with-side-menu">
    <?php require_once("../MainHeader/header.php");?>
    <div class="mobile-menu-left-overlay"></div>
    <?php require_once("../MainNav/nav.php");?>
    
    <!-- Contenido -->
    <div class="page-content">
        <div class="container-fluid">
            <div class="box-typical box-typical-padding">
				<p>Tabla/filtro de usuarios</p>
				<h5 class="m-t-lg">Ingresar Información</h5>
				<div class="row">
					<form method="POST" id="user_filter">
                        <p><?php var_dump($departamentos)?></p>
						<div class="col-lg-4">
                            <fieldset class="form-group">
                                <label class="form-label semibold" for="dep_id">Filtrar por departamento</label>
                                <select id="dep_id" name="dep_id" class="form-control">
                                    <?php foreach ($departamentos as $departamento): ?>
                                        <option value="<?php echo $departamento['id_departamento']; ?>"><?php echo $departamento['nombre_departamento']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>
                        </div>
						<div class="col-lg-12">
							<button type="submit" name="action" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
						</div>
						<div class="col-lg-12" style="overflow: scroll">
						<table id="user_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
							<thead>
								<tr>
									<th style="width: auto;">Id usuario</th>
									<th style="width: auto">Nombres</th>
									<th class="" style="width: auto;">Apellidos</th>
                                    <th class="" style="width: auto;">Id departamento</th>
								</tr>
							</thead>
							<tbody>
                                <?php 
                                    foreach($empleados as $empleado) {
                                        echo "<tr>";
                                        echo '<td style="color: #3498DB; cursor: pointer" class="selectable-id" data-id="' . $empleado['usu_id'] . '">' . $empleado['usu_id'] . '</td>';
                                        echo '<td data-id="' . $empleado['usu_nom'] . '">' . $empleado['usu_nom'] . '</td>';
                                        echo '<td data-id="' . $empleado['usu_ape'] . '">' . $empleado['usu_ape'] . '</td>';
                                        echo '<td data-id="' . $empleado['usu_dpto'] . '">' . $empleado['usu_dpto'] . '</td>';
                                        echo "</tr>";
                                    }
                                ?>
							</tbody>
						</table>
						</div>
					</form>
				</div>
			</div>
            <div class="box-typical box-typical-padding" id="user_info">
                <div class="media align-items-center py-3 mb-3">
                    <div class="media-body ml-4">
                        <h4 class="font-weight-bold mb-0" id="title-moduls"></h4><td><span class="badge badge-outline-success"></span></td>
                        <div class="text-muted mb-2"></div>
                    </div>
                </div>

                <!-- <div class="card mb-4">
                    <div class="card-body">
                        <table class="table user-view-table m-0">
                            <tbody>
                                <tr>
                                    <td>Fecha de registro:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Latest activity:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Verificado:</td>
                                    <td><span class="fa fa-check text-primary"></span>&nbsp; Yes</td>
                                </tr>
                                <tr>
                                    <td>Rol:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Estado:</td>
                                    <td><span class="badge badge-outline-success"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    <!-- <hr class="border-light m-0"> -->
                    <div class="table-responsive" style="overflow: scroll">
                        <table class="table card-table m-0" id="moduls-data">
                            <thead>
								<tr>
                                    <th style="width: 150px; text-align: center">Modulos Terciarios</th>
                                    <th style="width: 150px; text-align: center">Acciones</th>
								</tr>
							</thead>
                            <tbody>
                                <?php 
                                    foreach($modulos as $modulo) {
                                        echo "<tr>";
                                        echo '<td>' . $modulo['letra'] . " ". $modulo['texto'] . '</td>';
                                        echo '<td style="display: flex; justify-content:center; align-items: center"> <button class="btn btn-sm btn-outline-secondary badge" type="button">Activar</button </td>';
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <!-- <hr class="border-light m-0"> -->
                    <!-- <div class="card-body">
                        <table class="table user-view-table m-0">
                            <tbody>
                                <tr>
                                    <td># Documento</td>
                                    <td id="td-documento"></td>
                                </tr>
                                <tr>
                                    <td>Nombre completo:</td>
                                    <td id="td-complete-name"></td>
                                </tr>
                                <tr>
                                    <td>E-mail:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Compañia:</td>
                                    <td>SuperBrix S.A</td>
                                </tr>
                            </tbody>
                        </table>

                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contenido -->

    <?php require_once("../MainJs/js.php");?>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css"> -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" src="dist/permisosRoles.js"></script>
</body>
</html>
<?php

} else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>
