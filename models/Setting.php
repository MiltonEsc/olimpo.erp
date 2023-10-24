<?php
    class Setting extends Conectar{

        public function update_setting($nom_app,$slogan_app,$mision_app,$vision_app, $city_app, $dpto_app, $direccion_app, $supersite_app, $web_app, $usu_new_title, $usu_new_des,$usu_edit_title, $dpto_name, $dpto_des,$correo_soli_abierta,$correo_soli_asignada,$correo_soli_cerrada){
            $conectar= parent::conexion();
            parent::set_names();
            try {
                $sql=" UPDATE sb_setting set
                nom_app = ?,
                slogan_app = ?,
                mision_app = ?,
                vision_app = ?,
                city_app = ?,
                dpto_app = ?,
                direccion_app = ?,
                supersite_app = ?,
                web_app = ?,
                usu_new_title = ?,
                usu_new_des = ?,
                usu_edit_title = ?,
                dpto_name = ?,
                dpto_des = ?,
                correo_soli_abierta = ?,
                correo_soli_asignada = ?,
                correo_soli_cerrada = ?
                where id = '1'";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $nom_app);
                $sql->bindValue(2, $slogan_app);
                $sql->bindValue(3, $mision_app);
                $sql->bindValue(4, $vision_app);
                $sql->bindValue(5, $city_app);
                $sql->bindValue(6, $dpto_app);
                $sql->bindValue(7, $direccion_app);
                $sql->bindValue(8, $supersite_app);
                $sql->bindValue(9, $web_app);
                $sql->bindValue(10, $usu_new_title);
                $sql->bindValue(11, $usu_new_des);
                $sql->bindValue(12, $usu_edit_title);
                $sql->bindValue(13, $dpto_name);
                $sql->bindValue(14, $dpto_des);
                $sql->bindValue(15, $correo_soli_abierta);
                $sql->bindValue(16, $correo_soli_asignada);
                $sql->bindValue(17, $correo_soli_cerrada);
                $res = $sql->execute();
                if ($res === false) {
                    echo "SQL Error: " . $sql->error;
                }else{
                    return true;
                }
                
            } catch (Exception $E) {
                echo "hubo un error en Nuevo Proyecto" . $E->getMessage();
            }
        }

        public function list_setting(){
            $conectar= parent::conexion();
            parent::set_names();
            try {
                $sql="SELECT * FROM sb_setting";
                $sql=$conectar->prepare($sql);
                $res = $sql->execute();
                if ($res === false) {
                    echo "SQL Error: " . $sql->error;
                }else{
                    return $res=$sql->fetchAll();;
                }
                
            } catch (Exception $E) {
                echo "hubo un error en Nuevo Proyecto" . $E->getMessage();
            }
            
        }
        
        public function list_correo_soli_abierta(){
            $conectar= parent::conexion();
            parent::set_names();
            try {
                $sql="SELECT correo_soli_abierta FROM sb_setting";
                $sql=$conectar->prepare($sql);
                $res = $sql->execute();
                if ($res === false) {
                    echo "SQL Error: " . $sql->error;
                }else{
                    return $res=$sql->fetchAll();
                }
                
            } catch (Exception $E) {
                echo "hubo un error en Nuevo Proyecto" . $E->getMessage();
            }
            
        }
    }
?>