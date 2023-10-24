<?php
    class Departamento extends Conectar{

        public function get_departamento(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_departamento WHERE est_departamento=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_departamento($nom_departamento,$cod_departamento,$des_departamento){
            $conectar= parent::conexion();
            parent::set_names();
            try {
                $sql="INSERT INTO tm_departamento (id_departamento, cod_departamento, nom_departamento,des_departamento, est_departamento) VALUES (NULL, ?, ?, ?,'1');";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $cod_departamento);
                $sql->bindValue(2, $nom_departamento);
                $sql->bindValue(3, $des_departamento);
    
                $res = $sql->execute();
                if ($res === false) {
                    echo 'Connection failed: ' . $e->getMessage();
                }else{
                    return true;
                }
                
            } catch (Exception $E) {
                echo "hubo un error en Nuevo Proyecto" . $E->getMessage();
            }
        }

        public function delete_departamento($id_departamento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sb_d_departamento(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_departamento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_departamento($id_departamento,$nom_departamento,$cod_departamento,$des_departamento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_departamento set
                nom_departamento = ?,
                cod_departamento = ?,
                des_departamento = ?,
                est_departamento = '1'
                WHERE
                id_departamento = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nom_departamento);
            $sql->bindValue(2, $cod_departamento);
            $sql->bindValue(3, $des_departamento);
            $sql->bindValue(4, $id_departamento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_departamento_x_id($id_departamento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sb_l_departamento_x_id(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_departamento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_departamento_inactivo(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_departamento where est_departamento=0";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function habilitar_departamento($id_departamento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call habilitar_departamento(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_departamento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function eliminar_departamento_raiz($id_departamento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sb_d_departamento_02(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_departamento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>