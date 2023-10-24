<?php
mysqli_report(MYSQLI_REPORT_ERROR);
    class Usuario extends Conectar{

        public function login(){
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                if(empty($correo) and empty($pass)){
                    header("Location:".conectar::ruta()."index.php?m=2");
					exit();
                }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? and usu_pass=? and est=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    $stmt->bindValue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if (is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_cedula"]=$resultado["usu_cedula"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        $_SESSION["usu_foto"]=$resultado["usu_foto"];
                        header("Location:".Conectar::ruta()."view/Home/");
                        exit(); 
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }

        public function login_2(){
            $conectar=parent::conexion();
            parent::set_names();
            if(isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                if(empty($correo) and empty($pass)){
                    header("Location:".conectar::ruta()."index.php?m=2");
					exit();
                }else{
                    $link =  $_SERVER['HTTP_HOST'];
                    $url= $_SERVER["REQUEST_URI"];
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? and usu_pass=?  and est=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    $stmt->bindValue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if (is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        $_SESSION["rol_id"]=$resultado["rol_id"];
                        $_SESSION["usu_foto"]=$resultado["usu_foto"];
                        header("Location:".Conectar::ruta()."view/DetalleTicket/?id=".$_GET['id']);
                        exit(); 
                    }else{
                        header("Location:".Conectar::ruta()."view/DetalleTicket/?id=".$_GET['ID']."/index2.php?m=1");
                        exit();
                    }
                }
            }
        }

        public function insert_usuario($usu_nom,$usu_ape,$usu_correo,$usu_pass,$usu_cargo,$usu_ext,$usu_dpto,$fech_ingreso,$fech_nac,$rol_id, $usu_foto, $est){
            $conectar= parent::conexion();
            parent::set_names();
            try {
                $sql="INSERT INTO tm_usuario (usu_id, usu_nom, usu_ape, usu_correo, usu_pass, rol_id, fech_crea, fech_modi, fech_elim, fech_nac, usu_cargo, usu_ext, usu_foto,usu_dpto,fech_ingreso, est) VALUES (NULL, ?, ?, ?, ?, ?, now(), NULL, NULL, ?, ?,?, ?, ?, ?, ?);";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $usu_nom);
                $sql->bindValue(2, $usu_ape);
                $sql->bindValue(3, $usu_correo);
                $sql->bindValue(4, $usu_pass);
                $sql->bindValue(5, $rol_id);
                $sql->bindValue(6, $fech_nac);
                $sql->bindValue(7, $usu_cargo);
                $sql->bindValue(8, $usu_ext);
                $sql->bindValue(9, $usu_foto);
                $sql->bindValue(10, $usu_dpto);
                $sql->bindValue(11, $fech_ingreso);
                $sql->bindValue(12, $est);
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

        public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id,$fech_nac,$usu_cargo,$usu_ext,$usu_dpto,$fech_ingreso, $usu_foto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario set
                usu_nom = ?,
                usu_ape = ?,
                usu_correo = ?,
                usu_pass = ?,
                rol_id = ?,
                fech_nac = ?,
                usu_cargo = ?,
                usu_ext = ?,
                usu_dpto = ?,
                fech_ingreso = ?,
                usu_foto = ?,
                est = '1'
                WHERE
                usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $fech_nac);
            $sql->bindValue(7, $usu_cargo);
            $sql->bindValue(8, $usu_ext);
            $sql->bindValue(9, $usu_dpto);
            $sql->bindValue(10, $fech_ingreso);
            $sql->bindValue(11, $usu_foto);
            $sql->bindValue(12, $usu_id);
           
            $sql->execute();
            return $resultado=$sql;
        }

        public function update_usuario_sin_foto($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id,$fech_nac,$usu_cargo,$usu_ext,$usu_dpto,$fech_ingreso){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario set
                usu_nom = ?,
                usu_ape = ?,
                usu_correo = ?,
                usu_pass = ?,
                rol_id = ?,
                fech_nac = ?,
                usu_cargo = ?,
                usu_ext = ?,
                usu_dpto = ?,
                fech_ingreso = ?,
                est = '1'
                WHERE
                usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $fech_nac);
            $sql->bindValue(7, $usu_cargo);
            $sql->bindValue(8, $usu_ext);
            $sql->bindValue(9, $usu_dpto);
            $sql->bindValue(10, $fech_ingreso);
            $sql->bindValue(11, $usu_id);
           
            $sql->execute();
            return $resultado=$sql;
        }

        public function delete_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_d_usuario_01(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function eliminar_usuario_raiz($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_d_usuario_02(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function get_usuario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_01()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_x_rol(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario where est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sb_l_usuario_02(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_total_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalabierto_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ? and tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalcerrado_x_id($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where usu_id = ? and tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_grafico($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                and tm_ticket.usu_id = ?
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_inactivo(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario where est=0";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function habilitar_usuario($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call habilitar_usuario(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function current_rows($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT SUM(CASE WHEN usu_nom = '' OR usu_nom IS NULL THEN 0 ELSE 1 END
            + CASE WHEN usu_ape = '' OR usu_ape IS NULL THEN 0 ELSE 1 END
            + CASE WHEN usu_pass = '' OR usu_pass IS NULL THEN 0 ELSE 1 END
            + CASE WHEN usu_correo = '' OR usu_correo IS NULL THEN 0 ELSE 1 END
            + CASE WHEN fech_nac = '' OR fech_nac IS NULL THEN 0 ELSE 1 END
            + CASE WHEN usu_cargo = '' OR usu_cargo IS NULL THEN 0 ELSE 1 END
            + CASE WHEN usu_foto = '' OR usu_foto IS NULL THEN 0 ELSE 1 END
            + CASE WHEN usu_dpto = '' OR usu_dpto  IS NULL THEN 0 ELSE 1 END) currentn
            FROM tm_usuario WHERE usu_id = $usu_id;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            $arr=$sql->fetchAll(PDO::FETCH_COLUMN, 0);
            $resultado = implode(" ",$arr); 
            return $resultado;
        }
        
        public function usuario_cumple_hoy(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE DATE_FORMAT(fech_nac, '%m-%d') = DATE_FORMAT(now(),'%m-%d') AND est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>