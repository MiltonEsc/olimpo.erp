<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$cat_id,$tick_titulo,$tick_descrip,$nom_emp,$ape_emp, $nom_jefe,$departamento,$cargo,$usu_cedula,$fech_nac,$fech_ingreso,$correo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (tick_id,usu_id,cat_id,tick_titulo,tick_descrip,tick_estado,fech_crea,usu_asig,fech_asig,nom_emp,ape_emp,nom_jef,departamento,cargo,usu_cedula,fech_nac,fech_ingreso,correo,est) VALUES (NULL,:usu_id,:cat_id,:tick_titulo,:tick_descrip,'Abierto',now(),NULL,NULL,:nom_emp,:ape_emp, :nom_jef,:departamento,:cargo,:usu_cedula,:fech_nac,:fech_ingreso,:correo,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindParam(':usu_id', $usu_id);
            $sql->bindValue(':cat_id', $cat_id);
            $sql->bindValue(':tick_titulo', $tick_titulo);
            $sql->bindValue(':tick_descrip', $tick_descrip);
            $sql->bindValue(':nom_emp', $nom_emp);
            $sql->bindValue(':ape_emp', $ape_emp);
            $sql->bindValue(':nom_jef', $nom_jefe);
            $sql->bindValue(':departamento', $departamento);
            $sql->bindValue(':cargo', $cargo);
            $sql->bindValue(':usu_cedula', $usu_cedula);
            $sql->bindValue(':fech_nac', $fech_nac);
            $sql->bindValue(':fech_ingreso', $fech_ingreso);
            $sql->bindValue(':correo', $correo);
            $sql->execute();

            $sql1 = $conectar->prepare("SELECT LAST_INSERT_ID() AS 'tick_id'");
            $sql1->execute();      
            return $resultado = $sql1->fetch(PDO::FETCH_ASSOC);
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                AND tm_usuario.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.nom_emp,
                tm_ticket.nom_jef,
                tm_ticket.departamento,
                tm_ticket.cargo,
                tm_ticket.fech_nac,
                tm_ticket.usu_cedula,
                tm_ticket.fech_ingreso,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.usu_correo,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.fech_entry,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1 ORDER BY fech_entry DESC
                ";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_cat($cat_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.cat_id = ? ";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            // $sql->bindValue(2, $fech_inicial);
            // $sql->bindValue(3, $fech_final);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_cat_y_fecha($cat_id, $fech_inicial, $fech_final){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            tm_ticket.tick_id,
            tm_ticket.usu_id,
            tm_ticket.cat_id,
            tm_ticket.tick_titulo,
            tm_ticket.tick_descrip,
            tm_ticket.tick_estado,
            tm_ticket.fech_crea,
            tm_ticket.usu_asig,
            tm_ticket.fech_asig,
            tm_usuario.usu_nom,
            tm_usuario.usu_ape,
            tm_categoria.cat_nom
            FROM 
            tm_ticket
            INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
            INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
            WHERE tm_ticket.cat_id = ? AND
            tm_ticket.fech_crea BETWEEN ? AND ?";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $fech_inicial);
            $sql->bindValue(3, $fech_final);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                td_ticketdetalle.tickd_id,
                td_ticketdetalle.tickd_descrip,
                td_ticketdetalle.fech_crea,

                 tm_usuario.usu_foto,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.rol_id
                FROM 
                td_ticketdetalle
                INNER join tm_usuario on td_ticketdetalle.usu_id = tm_usuario.usu_id
                WHERE 
                tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
 
        public function listar_ticketdetalle_x_ticket_ingreso($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                td_ticketdetalle_ingreso.tickd_id_ingreso,
                td_ticketdetalle_ingreso.tickd_descrip,
                td_ticketdetalle_ingreso.fech_crea_ingreso,

                td_ticketdetalle_ingreso.line_tef_ingreso,
                td_ticketdetalle_ingreso.tline_tef_ingreso,
                td_ticketdetalle_ingreso.tdivi_ingreso,
                td_ticketdetalle_ingreso.opt_ibes_ingreso,
                td_ticketdetalle_ingreso.cop_perfil_ibes_ingreso,
                td_ticketdetalle_ingreso.name_cop_perfil_ibes_ingreso,
                td_ticketdetalle_ingreso.adicional_ingreso,
                td_ticketdetalle_ingreso.exce_ingreso,
                td_ticketdetalle_ingreso.programas_ingreso,
                tm_usuario.usu_foto,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.rol_id
                FROM 
                td_ticketdetalle_ingreso
                INNER join tm_usuario on td_ticketdetalle_ingreso.usu_id_ingreso = tm_usuario.usu_id
                WHERE 
                tick_id_ingreso =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
 
        public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip) VALUES (NULL,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_ingreso($tick_id,$usu_id,$tickd_descrip,$linea_tele,$tipo_linea_tele,$divisiones,$opciones_ibes,$copia_ibes,$opcion_copia_usu_ibes,$adicional,$excepcion,$programas){
            $conectar= parent::conexion();
            date_default_timezone_set('America/Bogota');
            parent::set_names();
                $sql="INSERT INTO td_ticketdetalle_ingreso (tickd_id_ingreso,tick_id_ingreso,usu_id_ingreso,tickd_descrip, line_tef_ingreso, tline_tef_ingreso, tdivi_ingreso, opt_ibes_ingreso, cop_perfil_ibes_ingreso, name_cop_perfil_ibes_ingreso, adicional_ingreso, exce_ingreso, programas_ingreso,fech_crea_ingreso,est_ingreso) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->bindValue(4, $linea_tele);
            $sql->bindValue(5, $tipo_linea_tele);
            $sql->bindValue(6, $divisiones);
            $sql->bindValue(7, $opciones_ibes);
            $sql->bindValue(8, $copia_ibes);
            $sql->bindValue(9, $opcion_copia_usu_ibes);
            $sql->bindValue(10, $adicional);
            $sql->bindValue(11, $excepcion);
            $sql->bindValue(12, $programas);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="call sp_i_ticketdetalle_01(?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estado = 'Cerrado'
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    usu_asig = ?,
                    fech_asig = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_grafico_x_usu(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

         public function get_ingreso_usuario_grafico_x_cat(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
