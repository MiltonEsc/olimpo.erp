<?php
require('../../models/permisosRolesModel/permisos_roles_model.php');

class permisosRolesController {
    private $permisosModel;

    public function __construct() {
        $this->permisosModel = new permisosRolesModel();
    }

    public function mostrarDepartamentos() {
        // Simulemos que hemos obtenido departamentos de una base de datos o alguna otra fuente
        $departamentos = array(
            array(
                "id" => 1,
                "nombre" => "Departamento A"
            ),
            array(
                "id" => 2,
                "nombre" => "Departamento B"
            )
        );
    
        if ($departamentos) {
            $data = array(
                "nombre" => "Juan",
                "edad" => 30,
                "departamentos" => $departamentos
            );
            header('Content-Type: application/json');
            $jsonData = json_encode($data);  // Convierte el arreglo $data en una cadena JSON
            echo $jsonData;  // Imprime la cadena JSON
        } else {
            echo json_encode(['error' => 'No se encontraron departamentos']);
        }
    }
    

    public function mostrarInformacionDeEmpleados() {
        $empleados = $this->permisosModel->obtenerInformacionDeEmpleados();
        if ($empleados) {
            // header('Content-Type: application/json');
            echo json_encode($empleados);
        } else {
            echo json_encode(['error' => 'No se encontraron empleados']);
        }
    }

    public function mostrarModulos() {
        $modulos = $this->permisosModel->obtenerModulos();
        if ($modulos) {
            // header('Content-Type: application/json');
            echo json_encode($modulos);
        } else {
            echo json_encode(['error' => 'No se encontraron módulos disponibles']);
        }
    }
}
?>