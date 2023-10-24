<?php
require_once '../../config/conexion.php';

class permisosRolesModel {
    private $db;

    public function __construct() {
        $conectar = new Conectar();
        $this->db = $conectar->Conexion();
    }

    public function obtenerDepartamentos() {
        try {
            $query = "SELECT id_departamento, nombre_departamento FROM departamentos";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            // Obtener los resultados como un array asociativo
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            // Manejo de errores en caso de que ocurra una excepción
            echo "Error al obtener departamentos: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerInformacionDeEmpleados() {
        try {
            $query = "SELECT usu_id, usu_nom, usu_ape, usu_cedula, usu_correo, rol_id, usu_dpto, est FROM tm_usuario WHERE est = 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            error_log("Error al obtener empleados por departamento: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerModulos() {
        try {
            $query = "SELECT modulo_terciario_id, letra, texto FROM modulos_terciarios";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;

        } catch (PDOException $e) {
            error_log("Error al obtener los móduolos: " . $e->getMessage());
            return false;
        }
    }
}
?>