<?php
require_once '../../models/perfilUsuarioModel/perfil_usuario_model.php';

class PerfilUsuarioController {
    private $perfilUsuarioModel;

    public function __construct() {
        $this->perfilUsuarioModel = new perfilUsuarioModel();
    }

    public function mostrarInformacionDeEmpleado() {
        session_start(); // Asegúrate de haber iniciado la sesión para acceder a $_SESSION
        if (isset($_SESSION['usu_id'])) {
            $usuarioId = intval($_SESSION['usu_id']); // Obtenemos el id del usuario desde la sesión

            try {
                $informacionEmpleado = $this->perfilUsuarioModel->obtenerInformacionDeEmpleado($usuarioId);

                $datosEmpleado = [];
                // Comprueba si se obtuvieron datos del empleado
                if ($informacionEmpleado) {
                    foreach($informacionEmpleado as $empleado){
                        $datosEmpleado['nombre'] = $empleado['usu_nom'] . " ". $empleado['usu_ape'];
                        $datosEmpleado['cedula'] = $empleado['usu_cedula'];
                        $datosEmpleado['cargo'] = $empleado['usu_cargo'];
                        $datosEmpleado['departamento'] = $empleado['usu_dpto'];
                        $datosEmpleado['correo'] = $empleado['usu_correo'];

                    }
                    // Devuelve los datos del empleado
                    return $datosEmpleado;
                } else {
                    return false; // No se pudo obtener la información del empleado
                }
            } catch (PDOException $e) {
                echo "Error en la consulta: " . $e->getMessage();
                return false; // Manejo de errores
            }
        } else {
            echo "El ID de usuario no está definido en la sesión."; // Manejo de errores
            return false;
        }
    }
}
