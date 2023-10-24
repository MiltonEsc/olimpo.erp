<?php
    require_once("../config/conexion.php");
    require_once("../models/Departamento.php");
    require_once("../models/Usuario.php");
    $departamento = new Departamento();
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
            $datos=$departamento->get_departamento();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["id_departamento"];
                $sub_array[] = $row["nom_departamento"];
                $sub_array[] = $row["cod_departamento"];
                $sub_array[] = $row["des_departamento"];

                if ($row["est_departamento"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">activo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-info">inactivo</span>';
                }

                $sub_array[] = '<a  type="button" onClick="editar('.$row["id_departamento"].');" class="btn btn-inline btn-warning btn-sm ladda-button text-center"><i class="fa fa-edit"></i></a>';
                $sub_array[] = '<a type="button" onClick="eliminar('.$row["id_departamento"].');"  id="'.$row["id_departamento"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></a>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "guardar_y_editar":
            if(empty($_POST["id_departamento"])){       
                $insert = $departamento->insert_departamento($_POST["nom_departamento"],$_POST["cod_departamento"],$_POST["des_departamento"]);     
                
                echo $insert?'ok':'err';     
            }
            else {
                $departamento->update_departamento($_POST["id_departamento"],$_POST["nom_departamento"],$_POST["cod_departamento"],$_POST["des_departamento"]);
            }
        break;
        case "mostrar";
            $datos=$departamento->get_departamento_x_id($_POST["id_departamento"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["id_departamento"] = $row["id_departamento"];
                    $output["nom_departamento"] = $row["nom_departamento"];
                    $output["cod_departamento"] = $row["cod_departamento"];
                    $output["des_departamento"] = $row["des_departamento"];
                }
                echo json_encode($output);
            }   
        break;
        case "eliminar":
            $departamento->delete_departamento($_POST["id_departamento"]);
        break;
        case "listar_departamento_inactivo":
            $datos=$departamento->get_departamento_inactivo();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["id_departamento"];
                $sub_array[] = $row["nom_departamento"];
                $sub_array[] = $row["cod_departamento"];
                $sub_array[] = $row["des_departamento"];

                if ($row["est_departamento"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">activo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-info">inactivo</span>';
                }

                $sub_array[] = '<button type="button" onClick="habilitar_usuario('.$row["id_departamento"].');"  id="'.$row["id_departamento"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-arrow-circle-left"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar_usuario_raiz('.$row["id_departamento"].');"  id="'.$row["id_departamento"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
        case "habilitar_departamento":
            $departamento->habilitar_departamento($_POST["id_departamento"]);
        break;
        case "eliminar_departamento_raiz":
            $departamento->eliminar_departamento_raiz($_POST["id_departamento"]);
        break;
    }
?>