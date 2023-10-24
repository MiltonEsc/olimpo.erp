<?php

    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    switch($_GET["op"]){

        case "editar":
            if(isset($_POST["usu_id"])){

                if($_FILES['file']['name'] != ''){
                    $filename = $_FILES['file']['name'];

                    $location = "../public/fotos-perfil/".$filename;
                    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                    $imageFileType = strtolower($imageFileType);

                    $valid_extensions = array("jpg","jpeg","png");

                    /* Check file extension */
                    if(in_array(strtolower($imageFileType), $valid_extensions)) {
                       /* Upload file */
                       if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                        
                          $response = $filename;
                       }
                    }

                    $insert = $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"],$_POST["fech_nac"],$_POST["usu_cargo"],$_POST["usu_ext"],$_POST["usu_dpto"],$_POST["fech_ingreso"],$filename);      
                    
                    echo $insert?'ok':'err';

                }else{
                    $insert = $usuario->update_usuario_sin_foto($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"],$_POST["fech_nac"],$_POST["usu_cargo"],$_POST["usu_ext"],$_POST["usu_dpto"],$_POST["fech_ingreso"]);      
                }               
            }
        break;

        case "editar_sin_foto":
            if(isset($_POST["usu_id"])){

                if(isset($_FILES['file']['name'])){
                    $filename = $_FILES['file']['name'];

                    $location = "../public/fotos-perfil/".$filename;
                    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                    $imageFileType = strtolower($imageFileType);

                    $valid_extensions = array("jpg","jpeg","png");

                    /* Check file extension */
                    if(in_array(strtolower($imageFileType), $valid_extensions)) {
                       /* Upload file */
                       if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                        
                          $response = $filename;
                       }
                    }

                    $insert = $usuario->update_usuario($_POST["usu_id"],$_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["rol_id"],$_POST["fech_nac"],$_POST["usu_cargo"],$_POST["usu_ext"],$_POST["usu_dpto"],$_POST["fech_ingreso"],$filename);      
                    
                    echo $insert?'ok':'err';

                }                       
            }
        break;
        
        case "guardar_usuario":

            if(isset($_FILES['file']['name'])){
                $filename = $_FILES['file']['name'];

                $location = "../public/fotos-perfil/".$filename;
                $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
                $imageFileType = strtolower($imageFileType);

                $valid_extensions = array("jpg","jpeg","png");

                /* Check file extension */
                if(in_array(strtolower($imageFileType), $valid_extensions)) {
                   /* Upload file */
                   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                    
                      $response = $filename;
                   }
                }

                $insert = $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_cargo"],$_POST["usu_ext"],$_POST["usu_dpto"],$_POST["fech_ingreso"],$_POST["fech_nac"], $_POST["rol_id"], $filename, $_POST["est"]);     
                
                echo $insert?'ok':'err';

            }else {
                $insert = $usuario->insert_usuario($_POST["usu_nom"],$_POST["usu_ape"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["usu_cargo"],$_POST["usu_ext"],$_POST["usu_dpto"],$_POST["fech_nac"], $_POST['fech_ingreso'], $_POST["rol_id"],NULL, $_POST["est"]);      
                
                echo $insert?'ok':'err2';
            }
            

        break; 

        case "listar":
            $datos=$usuario->get_usuario();
            $data= Array();
            foreach($datos as $row){
                $total = 8;
                $current = $usuario->current_rows($row["usu_id"]);
                $porcentaje = round(($current/$total) * 100);
                $sub_array = array();
                if ($row["est"]=="1"){
                    
                    $sub_array[] = '<progress value="'. $porcentaje .'" max="100"></progress> '. $porcentaje.'%';
                    $sub_array[] =$row["usu_nom"];
                }else if($row["est"]=="2"){
                    $sub_array[] = '<progress value="'. $porcentaje .'" max="100"></progress> '. $porcentaje.'%';
                    $sub_array[] = '<span style="width 100%; transform: rotate(-45deg);" class="label label-pill label-danger">new</span>'.$row["usu_nom"] .'';
                }
               
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_pass"];

                if ($row["rol_id"]=="1"){
                    $sub_array[] = '<span style="width 100%" class="label label-pill label-success">Usuario</span>';
                }else if($row["rol_id"]=="2"){
                    $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
                }elseif ($row["rol_id"]=="3") {
                    $sub_array[] = '<span class="label label-pill label-warning">Thumano</span>';
                }
                
                if ($row['usu_foto'] != '') {
                    $sub_array[] = '
                <img style="display: block; width: 32px; height:32px; border-radius:50%;" src="../../public/fotos-perfil/'.$row['usu_foto'].'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$row['usu_foto'].'"></>';
                } else {
                    $sub_array[] = '
                <img style="display: block; width: 32px; height:32px; border-radius:50%;" src="../../public/img/avatar-1-64.png" alt="" data-toggle="tooltip" data-placement="bottom" title="Nicholas<br/>Barrett"></>';
                }
                
                

                $sub_array[] = '<a  type="button" class="btn btn-inline btn-warning btn-sm ladda-button text-center" href="..\MntUsuario\editar_usuario.php?id='.$row["usu_id"].'"><i class="fa fa-edit"></i></a>';
                $sub_array[] = '<a type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></a>';
                $data[] = $sub_array;

                
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar_usuario_x_id":
            $datos=$usuario->get_usuario();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_pass"];

                if ($row["rol_id"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">Usuario</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
                }

                $sub_array[] = '<a  type="button" onClick="editar('.$row["usu_id"].');" class="btn btn-inline btn-warning btn-sm ladda-button text-center" href="..\MntUsuario\editar_usuario.php?id='.$row["usu_id"].'"><i class="fa fa-edit"></i></a>';
                $sub_array[] = '<a type="button" onClick="eliminar('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></a>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar_usuarios_inactivos":
            $datos=$usuario->get_usuario_inactivo();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["usu_nom"];
                $sub_array[] = $row["usu_ape"];
                $sub_array[] = $row["usu_correo"];
                $sub_array[] = $row["usu_pass"];

                if ($row["rol_id"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">Usuario</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
                }

                $sub_array[] = '<button type="button" onClick="habilitar_usuario('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-arrow-circle-left"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar_usuario_raiz('.$row["usu_id"].');"  id="'.$row["usu_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "eliminar":
            $usuario->delete_usuario($_GET["usu_id"]);
        break;

        case "mostrar";
            $datos=$usuario->get_usuario_x_id($_POST["usu_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $fecha = utf8_encode(strftime("Hoy %A %d de %B del %Y"));
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_cargo"] = $row["usu_cargo"];
                    $output["usu_ext"] = $row["usu_ext"];
                    $output["usu_dpto"] = $row["usu_dpto"];
                    $output["usu_foto"] = $row["usu_foto"];
                    $output["fech_nac"] =$row["fech_nac"];;
                    $output["fech_actual"] = $fecha;
                    $output["fech_ingreso"] = $row["fech_ingreso"];
                    $output["rol_id"] = $row["rol_id"];
                }
                echo json_encode($output);
            }   
        break;

        case "total";
            $datos=$usuario->get_usuario_total_x_id($_POST["usu_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalabierto";
            $datos=$usuario->get_usuario_totalabierto_x_id($_POST["usu_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalcerrado";
            $datos=$usuario->get_usuario_totalcerrado_x_id($_POST["usu_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "grafico";
            $datos=$usuario->get_usuario_grafico($_POST["usu_id"]);  
            echo json_encode($datos);
        break;

        case "combo";
            $datos = $usuario->get_usuario_x_rol();
            if(is_array($datos)==true and count($datos)>0){
                $html.= "<option label='Seleccionar'></option>";
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['usu_id']."'>".$row['usu_nom']."</option>";
                }
                echo $html;
            }
        break;

        case "eliminar_usuario_raiz":
            $usuario->eliminar_usuario_raiz($_POST["usu_id"]);
        break;

        case "habilitar_usuario":
            $usuario->habilitar_usuario($_POST["usu_id"]);
        break;
    }
?>