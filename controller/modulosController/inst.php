<?php 

require('modulos_controller.php');
$controller = new MostrarModulos();
$modulosAsignados = $controller->mostrarEmpleadosPorDepartamento();


?>