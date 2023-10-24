<?php
    require_once("../config/conexion.php");
    require_once("../models/Setting.php");
    $setting = new Setting();

    switch($_GET["op"]){
       

        case "save_setting":
            $insert = $setting->update_setting($_POST["nom_app"],$_POST["slogan_app"],$_POST["mision_app"],$_POST["vision_app"],$_POST["city_app"],$_POST["dpto_app"],$_POST["direccion_app"],$_POST["supersite_app"],$_POST["web_app"],$_POST["usu_new_title"],$_POST["usu_new_des"],$_POST["usu_edit_title"],$_POST["dpto_name"],$_POST["dpto_des"],$_POST["correo_soli_abierta"],$_POST["correo_soli_asignada"],$_POST["correo_soli_cerrada"]);     
                
                echo $insert?'ok':'err';
        break;

        case "list_setting":
            $datos=$setting->list_setting();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["nom_app"] = $row["nom_app"];
                    $output["slogan_app"] = $row["slogan_app"];
                    $output["mision_app"] = $row["mision_app"];
                    $output["vision_app"] = $row["vision_app"];
                    $output["city_app"] = $row["city_app"];
                    $output["dpto_app"] = $row["dpto_app"];
                    $output["direccion_app"] = $row["direccion_app"];
                    $output["supersite_app"] = $row["supersite_app"];
                    $output["web_app"] = $row["web_app"];
                    $output["usu_new_des"] = $row["usu_new_des"];
                    $output["usu_edit_title"] = $row["usu_edit_title"];
                    $output["usu_new_title"] = $row["usu_new_title"];
                    $output["dpto_name"] = $row["dpto_name"];
                    $output["dpto_des"] = $row["dpto_des"];
                    $output["correo_soli_abierta"] = $row["correo_soli_abierta"];
                    $output["correo_soli_asignada"] = $row["correo_soli_asignada"];
                    $output["correo_soli_cerrada"] = $row["correo_soli_cerrada"];
                }
                echo json_encode($output);
            }   

        break;
    }
?>