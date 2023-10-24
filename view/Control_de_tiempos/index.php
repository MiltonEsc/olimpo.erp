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
            <div class="box-typical box-typical-padding">
                <form method="post" id="control_tiempo_form_crear">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center color-orange semibold">CONTROL DE TIEMPOS</h3>
                        </div>
                        <input type="hidden" id="coti_id" name="coti_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <!-- <h4 class="semibold text-center">CEDULA</h4> -->
                                <input type="hidden" class="form-control form-control-lg" id="cedula" name="cedula"  value="<?php echo $_SESSION["usu_cedula"]?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="semibold text-center">ORDEN DE PRODUCCION</h4>
                                <input type="number" class="form-control form-control-lg" pattern="[0123456789]{1,4}" id="num_op" name="num_op" onKeyPress="if(this.value.length==4) return false;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h4 class="semibold text-center">NUMERO DE HORAS</h4>
                                <input type="number" class="form-control form-control-lg" step="0.01" name="nhoras" id="nhoras" min="0" onKeyPress="if(this.value.length==4) return false;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <h4 class="semibold text-center">CT OPERACION</h4>
                            <select id="ct_op" name="ct_op" class="form-control form-control-lg" aria-label=".form-select-lg example">
                            <option value="CNC">CNC</option>
                            <option value="PNT">PNT</option>
                            <option value="ENS">ENS</option>
                            <option value="ENS2">ENS2</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6 est_maquina" style="display: none;">
                            <div class="form-group">
                                <h4 class="semibold text-center">MAQUINA DE CNC</h4>
                                <select id="maquina" name="maquina" class="form-control form-control-lg" aria-label=".form-select-lg example">
                                    <option value="D">D: DOBLADORA</option>
                                    <option value="B">B: PUNZONADORA BOSHERT</option>
                                    <option value="C">C: CORTADORA</option>
                                    <option value="P">P: PLASMA</option>
                                    <option value="0">WT: NINGUNA</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12 text-center">  
                            <button type="submit" name="action" id="#" value="add" class="btn btn-warning btn-lg center-block">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-typical box-typical-padding">
                <table id="tabla_tiempo_X_usuario" class="table table-bordered table-striped table-vcenter js-dataTable-full display nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Fecha Registro</th>
                            <th style="width: 10%;">No Conforme</th>
                            <th style="width: 10%;">OP#</th>
                            <th style="width: 100%;">Descripcion OP</th>
                            <th style="width: 10%;">No Horas</th>
                            <th style="width: 12%;">CT Operacion</th>
                            <th class="text-center" style="width: 5%;">editar</th>
                            <th class="text-center" style="width: 5%;">eliminar</th>
                        </tr>
                    </thead>
                        <tbody>

                        </tbody>
                </table>
            </div>   
		</div>
	</div>
	<!-- Contenido -->
	<?php require_once("../MainJs/js.php");?>
    <?php require_once("modal_crear_registro_op.php");?>
	<script type="text/javascript" src="control_de_tiempo.js"></script>
</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>