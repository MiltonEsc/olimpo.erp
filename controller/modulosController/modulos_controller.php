<?php
   include '../../models/modulosModel/modulos_model.php';
   class ModulosController {
       public function mostrarModulos() {
            $usuarioId = intval($_SESSION['usu_id']); //Obtenemos el id del usuario
            $rolId = intval($_SESSION["rol_id"]); //Obtenemos el rol del usuario
            $modulosModel = new ModulosModel();
            try {
                    $modulosAsignados = $modulosModel->obtenerModulosDeUsuario($usuarioId, $rolId);
                    return $modulosAsignados; // Devuelve los datos para que se puedan usar en la vista
                } catch (PDOException $e) {
                    echo "Error en la consulta: " . $e->getMessage();
            }
        }
   }
   
?>