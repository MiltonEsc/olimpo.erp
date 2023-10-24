<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Email.php");
    $email = new Email();

    /* opciones del controlador */
    switch ($_GET["op"]) {
        /*  enviar ticket abierto con el ID */
        case "ticket_abierto":
            $email->ticket_abierto($_POST["tick_id"], $_POST["usu_correo"]);
            break;

        case "ticket_cerrado":
            $email->ticket_cerrado($_POST["tick_id"]);
            break;

        case "ticket_asignado":
            $email->ticket_asignado($_POST["tick_id"]);
            break;

        case "mensaje_cumpleanios":
            $email->mensaje_cumpleanios($_POST["tick_id"],$_POST["correo"]);
            break;

        case "mensaje_bienvenida":
            $email->mensaje_bienvenida($_POST["tick_id"],$_POST["correo"]);
            break;

        case "form_ingreso":
            $email->form_ingreso($_POST["tick_id"],$_POST["correo"]);
            break;

        case "mensaje_despedida":
            $email->mensaje_despedida($_POST["tick_id"],$_POST["correo"]);
            break;
}

?>