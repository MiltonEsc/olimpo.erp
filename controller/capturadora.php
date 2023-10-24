<?php
    require_once("../config/conexion.php");
    require_once("../models/Capturadora.php");
    

    $capturar = new Capturadora();

    switch($_GET["captura"]){

        case "cumpleanios":
            $img = $_POST["img"];
            $nombre = $_POST["nombre"];
            echo $capturar->subir_imagen_cumpleanios($img, $nombre);
        break;

        case "bienvenida":
            $img = $_POST["img"];
            $nombre = $_POST["nombre"];
            echo $capturar->subir_imagen_bienvenida($img, $nombre);
        break;

        case "despedida":
            $img = $_POST["img"];
            $nombre = $_POST["nombre"];
            echo $capturar->subir_imagen_despedida($img, $nombre);
        break;
    }
?>

