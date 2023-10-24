<?php
    class Control_tiempo extends Conectar{

        public function get_control_tiempo(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM control_tiempo";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function listar_x_ibes($num_op){
            $conn=connect();
    
            $sql="SELECT pmh_cmpy, pmh_misc,pmh_part, pr_cmpy, pmh_id, pmh_part,pt_job,pt_oper,
            pt_code,pt_uamt,pr_desc,pt_divs,pt_dept,pt_fund,pt_ctyp,pt_wcen,pt_trcd,pt_chk,PT_JPst
            from ibes.timecard,ibes.jobhead,ibes.itemmain
             where pmh_id = pt_job
              AND  pr_id = pmh_part  and pt_cmpy='SI' and pr_cmpy = pt_cmpy
              and pmh_id ='$num_op' and pmh_stat = 'A' ORDER BY pt_chk,pt_seq LIMIT 1";
            $datos = exec_select($conn,$sql);

            while(odbc_fetch_array($datos)){
                $result['pr_desc']=odbc_result($datos,'pr_desc');
            }
            return $result;
        }
        public function insert_control_tiempo($cedula,$num_op,$nhoras,$maquina,$ct_op){
            $conectar= parent::conexion();
            parent::set_names();
            try {
                $sql="INSERT INTO control_tiempo (coti_id, coti_marca_temporal, coti_fecha_operacion, coti_no_cedula, coti_carcateristicas_proceso, coti_codigo_nc_ns, coti_num_op, coti_cantidad_tiempo, coti_maquina_cnc, coti_nombre, coti_ct_ejecuto, coti_cod_op, coti_tipo_trb, coti_tipo, coti_estado_op, coti_nombre_equipo) VALUES (NULL, now(), '2023-07-11', :cedula, 'normal', NULL, :num_op, :nhoras, :maquina, 'milton escorcia', :ct_op, '4 59-60', 'P', '0', 'A', 'aseo');";
                $sql=$conectar->prepare($sql);
                $sql->bindParam(':cedula', $cedula);
                $sql->bindParam(':num_op', $num_op);
                $sql->bindParam(':nhoras', $nhoras);
                $sql->bindParam(':maquina', $maquina);
                $sql->bindParam(':ct_op', $ct_op);
                $res = $sql->execute();

                if ($res === false) {
                    throw new Exception('Query execution failed: ');
                } else {
                    return true;
                }
                
            } catch (Exception $E) {
                echo false;
            }
        }
        public function delete_control_tiempo($coti_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM control_tiempo WHERE coti_id = '$coti_id'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $coti_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        public function update_control_tiempo($modal_coti_id, $modal_num_op, $modal_nhoras, $modal_ct_op, $modal_maquina, $codigo_nc_ns) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE control_tiempo SET
                    coti_num_op = ?,
                    coti_cantidad_tiempo = ?,
                    coti_ct_ejecuto = ?,
                    coti_maquina_cnc = ?,
                    coti_codigo_nc_ns = ?
                    WHERE
                    coti_id = ?";
            $stmt = $conectar->prepare($sql);
      
                $stmt->execute([$modal_num_op, $modal_nhoras, $modal_ct_op, $modal_maquina, $codigo_nc_ns, $modal_coti_id]);
                return $resultado=$stmt;
        }
        public function get_control_tiempo_x_id($coti_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM control_tiempo where coti_id = $coti_id";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $coti_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }

    //IBES
    function validar_op($num_op){
        $conn=connect();
        $sql = "SELECT pmh_id FROM jobhead WHERE pmh_id = '$num_op' and pmh_stat = 'A'";
        $datos = exec_select($conn,$sql);

        while(odbc_fetch_array($datos)){
            $result['count']=odbc_result($datos,'pmh_id');
        }
        return $result;   
    }
?>