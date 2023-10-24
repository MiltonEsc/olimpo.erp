<?php
    require_once("../config/conexion.php");
    require_once("../models/Control_tiempo.php");
    require_once("../models/Usuario.php");

    $control_tiempo = new Control_tiempo();
    $usuario = new Usuario();
    switch($_GET["op"]){
        case "combo":
            $datos = $departamento->get_departamento();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['nom_departamento']."'>".$row['nom_departamento']."</option>";
                }
                echo $html;
            }
        break;

        case "editar_combo":
            $datos = $departamento->get_departamento();
            $user_id=$usuario->get_usuario_x_id($_POST["usu_id"]);

            foreach ($user_id as $value) {             
                $id_depa=$value["usu_dpto"];      
            }
            echo($user_id['14']);  
            if(is_array($datos)==true and count($datos)>0){
                    foreach($datos as $row)
                    {     
                        $selected = ( $id_depa == $row['nom_departamento']? 'selected': '');
                        $html.= "<option ".$selected ." value='".$row['nom_departamento']."'>".$row['nom_departamento']."</option>";
                    }
                echo $html;
            }
        break;

        case "admin_user":
            $datos = $categoria->get_categoria();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['cat_id']."'>".$row['cat_nom']."</option>";
                }
                echo $html;
            }
        break;
        case "listar":
            $datos=$control_tiempo->get_control_tiempo();
            $data= Array();
            foreach($datos as $row){
                $datos_ibes=$control_tiempo->listar_x_ibes($row["coti_num_op"]);
                $sub_array = array();
                $sub_array[] = $row["coti_marca_temporal"];
                $sub_array[] = $row["coti_codigo_nc_ns"];
                if ($row["coti_num_op"]=="0"){
                    $sub_array[] = '<span class="label label-pill label-success">Sin OP</span>';
                }else{
                    $sub_array[] = $row["coti_num_op"];
                }
                $sub_array[] = $datos_ibes['pr_desc'];
                $sub_array[] = $row["coti_cantidad_tiempo"];
                $sub_array[] = $row["coti_ct_ejecuto"];
                

                $sub_array[] = '<a  type="button" onClick="editar('.$row["coti_id"].');" class="btn btn-inline btn-warning btn-sm ladda-button text-center"><i class="fa fa-edit"></i></a>';
                $sub_array[] = '<a type="button" onClick="eliminar('.$row["coti_id"].');"  id="'.$row["coti_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></a>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
        case "guardar_tiempo_op":
            if(empty($_POST["coti_id"])){       
                $insert = $control_tiempo->insert_control_tiempo($_POST["cedula"],$_POST["num_op"],$_POST["nhoras"],$_POST["maquina"],$_POST["ct_op"]);     
                
                echo $insert?'ok':'err';     
            }
        break;
        case "editar_tiempo_op":
            if(!empty($_POST["modal_coti_id"])){       
                $update = $control_tiempo->update_control_tiempo($_POST["modal_coti_id"],$_POST["modal_num_op"],$_POST["modal_nhoras"],$_POST["modal_ct_op"],$_POST["modal_maquina"],$_POST["modal_codigo_nc_ns"]);    
                
                echo $update?'ok':'errs';     
            }
        break;
        case "mostrar";
            $datos=$control_tiempo->get_control_tiempo_x_id($_POST["coti_id"]);
            if(is_array($datos)==true and count($datos)>0){
            $data= Array();
                foreach($datos as $row){
                    $datos_ibes=$control_tiempo->listar_x_ibes($row["coti_num_op"]);
                    $output["coti_num_op"] = $row["coti_num_op"];
                    $output["coti_maquina_cnc"] = $row["coti_maquina_cnc"];
                    $output["coti_cantidad_tiempo"] = $row["coti_cantidad_tiempo"];
                    $output["pmh_desc"] = $datos_ibes['pmh_desc'];
                    $output["coti_id"] = $row["coti_id"];
                    $output["coti_ct_ejecuto"] = $row["coti_ct_ejecuto"];
                }
                echo json_encode($output);
            }   
        break;
        case "eliminar":
            $control_tiempo->delete_control_tiempo($_POST["coti_id"]);
        break;
        case "validar":
            $datos = validar_op($_POST["num_op"]);

            $response = array();
                if ($datos['count'] > 0) {
                    $response['existe'] = true;
                } else {
                    $response['existe'] = false;
                }

                echo json_encode($response);
        break;
    }
?>