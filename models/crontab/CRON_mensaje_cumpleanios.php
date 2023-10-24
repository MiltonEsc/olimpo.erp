<?php
  //include phpmailer class
  require('../class.phpmailer.php');
  include("../class.smtp.php");
  require_once("../../config/conexion.php");
  require_once("../Usuario.php");
  // creates object
  $mail = new PHPMailer(true); 
  $usuario = new Usuario();
   
    $datos = $usuario->usuario_cumple_hoy();
    foreach ($datos as $row){
        $id = $row["usu_id"];
        $nombre_completo[] = $row['usu_nom'].' '.$row['usu_ape'];
        
        $correo = "milton@superbrix.com";
        
        $email_subject = 'La familia SuperBrix felicita a ' . implode(", ", $nombre_completo). ' en su cumpleaños';
        
        $etiqueta[] = '<img src="[TEMPLATE]" alt="plantilla" height="100%" width="720" srcset="">';
        $etiqueta = str_replace('[TEMPLATE]' , "https://novedades.superbrix.com/public/cumpleanios/".$id.".png", $etiqueta);
        $cadena = implode('</br></br>', $etiqueta);
    }
    
  if(is_array($datos) == true and count($datos) > 0)
  {
   
   $email = "milton@superbrix.com";

   // HTML email starts here
   
   $cuerpo = '<img src="[TEMPLATE]" alt="plantilla" height="100%" width="720" srcset="">'; /* Ruta del template en formato HTML */
   
   // HTML email ends here

    $mail->IsSMTP(); 
    $mail->isHTML(true);
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = 'mail.superbrix.com';
    $mail->Port       = 465;             
    $mail->CharSet = 'UTF-8';
    $mail->AddAddress($email);
    $mail->Username = "novedades_superbrix@superbrix.com";  
    $mail->Password   ="j6Q9:3-4C7TRutA";            
    $mail->SetFrom('novedades_superbrix@superbrix.com','Comunicaciones Superbrix');
    $mail->Subject    = $email_subject;
    $mail->Body    = $cadena;
    $mail->AltBody    = "Comunicaciones Superbrix";
     
    if($mail->Send()){
        echo "Enviado";    
    } else
    {
        echo "No enviado";
    }
   
  } else
  {
      echo "No hay registros";
  }
  
?>