<?php
require_once '../../config/conexion.php';

class perfilUsuarioModel {
    private $db;

    public function __construct() {
        $conectar = new Conectar();
        $this->db = $conectar->Conexion();
    }

    public function obtenerInformacionDeEmpleado($idUsuario) {
        try {
            $query = "SELECT usu_nom, usu_ape, usu_cedula, usu_cargo, usu_dpto, usu_correo
            FROM tm_usuario
            WHERE usu_id = :idUsuario ";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
            $stmt->execute();
            // Obtener los resultados como un array asociativo
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            // Manejo de errores en caso de que ocurra una excepción
            echo "Error al obtener la información del empleado: " . $e->getMessage();
            return false;
        }
    }

}
?>