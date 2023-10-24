<?php
require_once '../../config/conexion.php';
    class ModulosModel {
        
        public function __construct($db) {
            $conectar =  new Conectar();
            $this->db = $conectar->Conexion();
        }

        public function obtenerModulosDeUsuario($usuarioId, $rolId = 1) {

            $tabla = ($rolId === 1 OR $rolId === 2) ? "modulos_terciarios" : "relacion_tm_usuario_modulos";
            $query = "SELECT
                        mp.modulo_principal_id,
                        mp.letra AS letra_principal, 
                        mp.texto AS texto_principal,
                        ms.modulo_secundario_id,
                        ms.letra AS letra_secundario,
                        ms.texto AS texto_secundario,
                        mt.modulo_terciario_id,
                        mt.letra AS letra_terciario,
                        mt.texto AS texto_terciario
                        FROM
                        $tabla r
                        LEFT JOIN
                        modulos_terciarios mt ON r.modulo_terciario_id = mt.modulo_terciario_id
                        LEFT JOIN
                        modulos_secundarios ms ON mt.modulo_secundario_id = ms.modulo_secundario_id 
                        LEFT JOIN
                        modulos_principales mp ON ms.modulo_principal_id = mp.modulo_principal_id";
        
            
            if ($rolId === 3 OR $rolId === 4) {
                $query .= " WHERE r.usu_id = :usuario_id";
            }
        
            $stmt = $this->db->prepare($query);
            
            if ($rolId === 3 OR $rolId === 4) {
                $stmt->bindParam(":usuario_id", $usuarioId, PDO::PARAM_INT);
            }
        
            $stmt->execute();
        
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Inicializa un array para organizar los módulos jerárquicamente
            $modulosJerarquia = [];
        
            foreach ($result as $row) {
                $this->agregarModulo($modulosJerarquia, $row);
            }
        
            return $modulosJerarquia;
        }
        
        
        private function agregarModulo(&$modulosJerarquia, $row) {
            $modulo_principal_id = $row["modulo_principal_id"];
            $modulo_secundario_id = $row["modulo_secundario_id"];
            $modulo_terciario_id = $row["modulo_terciario_id"];
        
            if (!isset($modulosJerarquia[$modulo_principal_id])) {
                $modulosJerarquia[$modulo_principal_id] = [
                    "nombre" => $row["letra_principal"] . " " . $row["texto_principal"],
                    "submodulos" => []
                ];
            }
        
            if (!isset($modulosJerarquia[$modulo_principal_id]["submodulos"][$modulo_secundario_id])) {
                $modulosJerarquia[$modulo_principal_id]["submodulos"][$modulo_secundario_id] = [
                    "nombre" => $row["letra_secundario"] . " " . $row["texto_secundario"],
                    "submodulos" => []
                ];
            }
        
            if (!empty($modulo_terciario_id)) {
                $modulosJerarquia[$modulo_principal_id]["submodulos"][$modulo_secundario_id]["submodulos"][] = [
                    "nombre" => $row["letra_terciario"] . " " . $row["texto_terciario"]
                ];
            }
        }

        public function otorgarPermiso($usu_id, $modulo_terciario_id) {
            $stmt = $this->db->prepare("INSERT INTO relacion_tm_usuario_modulos (usu_id, modulo_terciario_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $usu_id, $modulo_terciario_id);
            return $stmt->execute();
        }

        public function revocarPermiso($usu_id, $modulo_terciario_id) {
            $stmt = $this->db->prepare("DELETE FROM relacion_tm_usuario_modulos WHERE usu_id = ? AND modulo_terciario_id = ?");
            $stmt->bind_param("ii", $usu_id, $modulo_terciario_id);
            return $stmt->execute();
        }


    }

?>
