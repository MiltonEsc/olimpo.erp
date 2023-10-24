<?php
/* librerias necesarias para que el proyecto pueda enviar emails */
require('class.phpmailer.php');
include("class.smtp.php");
/* llamada de las clases necesarias que se usaran en el envio del mail */
require_once("../config/conexion.php");
require_once("Ticket.php");
require_once("Usuario.php");
require_once("Setting.php");
class Email extends PHPMailer{

    //variable que contiene el correo del destinatario
    protected $gCorreo = "novedades_superbrix@superbrix.com";
    protected $gContrasena = "j6Q9:3-4C7TRutA";
    //variable que contiene la contraseña del destinatario

    public function ticket_abierto($tick_id, $usu_correo){
        $ticket = new Ticket();
        $settings = new Setting();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        // $corr = $settings->list_correo_soli_abierta();
        // foreach($corr as $rows)
        //     {
        //         $outputr["correo_soli_abierta"] = $rows["correo_soli_abierta"];
        //     }
        // $array = explode ( ',', $outputr["correo_soli_abierta"]);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];

            //datos detallados
            $fech_ingreso = $row["fech_ingreso"];
            $newDate = utf8_encode(strftime("%A %d de %B del %Y", strtotime($fech_ingreso)));
            $nom_emp = $row["nom_emp"];
            $ape_emp = $row["ape_emp"];
            $usu_cedula = $row["usu_cedula"];
            $departamento = $row["departamento"];
            $cargo = $row["cargo"];
            $fech_nac = $row["fech_nac"];
            $newDate2 = utf8_encode(strftime("%A %d de %B del %Y", strtotime($fech_nac)));
            $nom_jef = $row["nom_jef"];
        }


        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->SMTPDebug = 1;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "INGRESO NUEVO EMPLEADO #".$id;
        $this->CharSet = 'UTF-8';
        // for($i = 0; $i < count($array); $i++) {
        //     $til = "'";
        //     $this->AddAddress($array[$i]);
        //     echo $corr[$i];
        // }
        $this->AddAddress($usu_correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Por favor siga las instrucciones para completar el registro";
        //Igual//
        $cuerpo = file_get_contents('../public/email-template/NuevaSolicitud.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

        //data detallada
        $cuerpo = str_replace("FecIngrEmp", $newDate, $cuerpo);
        $cuerpo = str_replace("NomComEmp", $nom_emp.' '.$ape_emp, $cuerpo);
        $cuerpo = str_replace("xDocEmp", $usu_cedula, $cuerpo);
        $cuerpo = str_replace("xDeptox", $departamento, $cuerpo);
        $cuerpo = str_replace("CarGEmpl", $cargo, $cuerpo);
        $cuerpo = str_replace("FecNacx", $newDate2, $cuerpo);
        $cuerpo = str_replace("NomJefInm", $nom_jef, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Solicitud Abierta");
        return $this->Send();
    }

    public function ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        $datos2 = $ticket->listar_ticketdetalle_x_ticket_ingreso($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }
        
        if (is_array($datos2) == true and count($datos2) > 0) {
            foreach ($datos2 as $row){
            if ($row["line_tef_ingreso"] == '1') {
                $line_tef_ingreso = "Si";
            }else{
                $line_tef_ingreso = "No";
            }
            if ($row["tline_tef_ingreso"] == '') {
                $tline_tef_ingreso = "Ninguna";
            }else if($row["tline_tef_ingreso"] == '1'){
                $tline_tef_ingreso = "Linea Interna";
            }else if($row["tline_tef_ingreso"] == '2'){
                $tline_tef_ingreso = "Linea Externa";
            }else if($row["tline_tef_ingreso"] == '3'){
                $tline_tef_ingreso = "Linea Ambas";
            }
            if ($row["cop_perfil_ibes_ingreso"] == '1') {
                $cop_perfil_ibes_ingreso = "Si";
                    $name_cop_perfil_ibes_ingreso = $row["name_cop_perfil_ibes_ingreso"];
                    $adicional_ingreso = $row["adicional_ingreso"];
                    $exce_ingreso = $row["exce_ingreso"];
            }else{
                $cop_perfil_ibes_ingreso = "No";
                    $name_cop_perfil_ibes_ingreso = "Ninguna";
                    $adicional_ingreso = "Ninguna";
                    $exce_ingreso = "Ninguna";
            }

            if ($row["tdivi_ingreso"] == '') {
                $tdivi_ingreso = "Ninguna";
            }else{
                $tdivi_ingreso = $row["tdivi_ingreso"];
            }

            if ($row["opt_ibes_ingreso"] == '') {
                $opt_ibes_ingreso = "Ninguna";
            }else{
                $opt_ibes_ingreso = $row["opt_ibes_ingreso"];
            }

            $programas_ingreso = $row["programas_ingreso"];

            if ($row["tickd_descrip"] == '') {
                $tickd_descrip = "Ninguna";
            }else {
                $tickd_descrip = $row["tickd_descrip"];
            }
            

        }
            
            
            
        }else{
            echo "error";
        }
        
        
        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->SMTPDebug = 1;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Solicitud Cerrada ".$id;
        $this->CharSet = 'UTF-8';
        $this->addAddress('milton@superbrix.com',"milton escorcia");
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Solicitud Cerrada";
        //Igual//
        $cuerpo = file_get_contents('../public/email-template/SolicitudCerrada.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

        /* parametros del template a remplazar en iformacion adicional*/
        $cuerpo = str_replace("lineTel", $line_tef_ingreso, $cuerpo);
        $cuerpo = str_replace("TLineTele", $tline_tef_ingreso, $cuerpo);
        $cuerpo = str_replace("DiviAccess", $tdivi_ingreso, $cuerpo);
        $cuerpo = str_replace("OptionIbes", $opt_ibes_ingreso, $cuerpo);
        $cuerpo = str_replace("ReqCopy", $cop_perfil_ibes_ingreso, $cuerpo);
        $cuerpo = str_replace("NomxRexqCopy", $name_cop_perfil_ibes_ingreso, $cuerpo);
        $cuerpo = str_replace("xAdic", $adicional_ingreso, $cuerpo);
        $cuerpo = str_replace("xExep", $exce_ingreso, $cuerpo);
        $cuerpo = str_replace("ProgramsAccess", $programas_ingreso, $cuerpo);
        $cuerpo = str_replace("InfoAdiccional", $tickd_descrip, $cuerpo);
        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Solicitud Cerrada");
        return $this->Send();
    }

    public function ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $correo = $row["usu_correo"];
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->SMTPDebug = 1;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Ticket Asignado ".$id;
        $this->CharSet = 'UTF-8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Ticket Asignado";
        //Igual//
        $cuerpo = file_get_contents('../public/email-template/AsignarTicket.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
        $cuerpo = str_replace("lblCate", $categoria, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Asignado");
        return $this->Send();
    }

    public function mensaje_cumpleanios($tick_id){
        $usuario = new Usuario();
        $datos = $usuario->get_usuario_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["usu_id"];
            $usu_nom = $row["usu_nom"];
            $usu_ape = $row["usu_ape"];
            $usu_foto = $row["usu_foto"];
            $correo = "milton@superbrix.com";
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Comunicaciones Superbrix";
        $this->CharSet = 'UTF-8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = 'La familia SuperBrix felicita a ' .  $usu_nom .' '. $usu_ape. ' en su cumpleaños ';
        //Igual//
        $ruta = "https://novedades.superbrix.com/public/cumpleanios/".$id.".png";
        $cuerpo = '<img src="[TEMPLATE]" alt="plantilla" height="100%" width="720" srcset="">'; /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("[TEMPLATE]", $ruta, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Comunicaciones Superbrix");
        return $this->Send();
    }

    public function mensaje_bienvenida($tick_id){
        $usuario = new Usuario();
        $datos = $usuario->get_usuario_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["usu_id"];
            $usu_nom = $row["usu_nom"];
            $usu_ape = $row["usu_ape"];
            $usu_foto = $row["usu_foto"];
            $correo = "";
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $mail->SMTPDebug = 1;
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Comunicaciones Superbrix";
        $this->CharSet = 'UTF-8';
        $this->addAddress('milton@superbrix.com');
        $this->addAddress('juanc@superbrix.com');
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = 'La familia SuperBrix le da la bienvenida a ' .  $usu_nom .' '. $usu_ape;
        //Igual//
        $ruta = "https://novedades.superbrix.com/public/bienvenida/".$id.".png";
        $cuerpo = '<img src="[TEMPLATE]" alt="plantilla" height="100%" width="720" srcset="">'; /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("[TEMPLATE]", $ruta, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Comunicaciones Superbrix");
        return $this->Send();
    }

    public function form_ingreso($tick_id){
        $usuario = new Usuario();
        $datos = $usuario->get_usuario_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["usu_id"];
            $usu_nom = $row["usu_nom"];
            $usu_ape = $row["usu_ape"];
            $usu_foto = $row["usu_foto"];
            $correo = "milton@superbrix.com";
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Comunicaciones Superbrix";
        $this->CharSet = 'UTF-8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = 'Formulario de ingreso';
        //Igual//
       
        $cuerpo = ' <br></div><br><br><div dir="ltr"><div style="font-family:arial,helvetica,sans-serif"><div><span style="color:rgb(0,0,0)">Buenas tardes estimado colaborador,</span><br></div><div style="font-family:Arial,Helvetica,sans-serif"><div class="gmail_quote"><div dir="ltr"><div style="font-family:arial,helvetica,sans-serif"><font color="#000000"><br></font></div><div style="font-family:arial,helvetica,sans-serif"><font color="#000000">Con el objetivo de mantener la base de datos del personal de SuperBrix actualizada agradecemos diligenciar el siguiente formulario:</font></div><div style="font-family:arial,helvetica,sans-serif"><br></div><div style="color:rgb(80,0,80);font-family:arial,helvetica,sans-serif"><div><a href="https://forms.gle/YxMhn7e9Du5ZUKTWA" target="_blank"><b><font size="4">Formulario : Datos personales empleados SuperBrix</font></b></a><br></div></div><div style="color:rgb(80,0,80);font-family:arial,helvetica,sans-serif"><br></div><div style="color:rgb(80,0,80);font-family:arial,helvetica,sans-serif"><b><font color="#000000"><br></font></b></div></div></div></div><i>Si <span class="gmail_default">usted ya </span>diligenció el formulario omití<span class="gmail_default">a</span><span class="gmail_default"></span><span class="gmail_default"></span> este correo.</i><div style="font-family:Arial,Helvetica,sans-serif"><br></div><div style="font-family:Arial,Helvetica,sans-serif"><p style="margin-bottom:16pt"><span style="color:rgb(148,8,23)"><img src="https://docs.google.com/uc?export=download&amp;id=1pvQvbl0s3CD4flL0ENU12PPKlSEP5au0&amp;revid=0B6kg8Ed-ThXhL05TdlViTUZDZE91SkVlOUUveW51THBGd2prPQ" width="96" height="19"></span><b style="font-size:12.8px"> </b><span style="font-size:12.8px;color:rgb(255,153,0)">〉</span><b><span style="font-size:12.8px">Comunicaciones SuperBrix</span><span style="font-size:12.8px"><font color="#000000"> </font></span></b><span style="font-size:12.8px"> </span><font color="#ff9900" style="font-size:12.8px">〉</font><span style="font-size:12.8px"> </span><font color="#0000ff" style="font-size:12.8px"><a href="http://www.superbrix.com/" target="_blank">www.superbrix.com</a></font></p><p style="margin-bottom:16pt"><img src="https://docs.google.com/uc?export=download&amp;id=1bM9kL0cCtJJjribIk-m9pa28KkuTbOBP&amp;revid=0B6kg8Ed-ThXhRUtNcU9hSnNEenZDNzBycGJ0MWV5R0ZxV2VBPQ" width="200" height="93"><br></p><p><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif;color:rgb(106,168,79)">Comprométete con el medio ambiente, imprime solo lo necesario.</span></i><span lang="ES-CO" style="font-size:9.5pt"></span></p><p><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif">**Mensaje Confidencial**</span></i><span lang="ES-CO" style="font-size:9.5pt"></span></p><p><span lang="ES-CO" style="font-size:9.5pt"> </span></p><p><i><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif">Este mensaje es confidencial y está dirigido únicamente a su destinatario.  Por lo tanto, la información contenida en el mismo no podrá ser usada, copiada o difundida. Si Usted no es el destinatario de este mensaje por favor devuélvalo al remitente y borre el mensaje.</span></i><span lang="ES-CO" style="font-size:9.5pt"></span></p><p><span lang="ES-CO" style="font-size:9.5pt"> </span></p><p><i><span lang="EN-US" style="font-size:10pt;font-family:Arial,sans-serif">Gracias</span></i><span lang="EN-US" style="font-size:9.5pt"></span></p><p><span lang="EN-US" style="font-size:9.5pt"> </span></p><p><i><span lang="EN-US" style="font-size:10pt;font-family:Arial,sans-serif;color:rgb(106,168,79)">Please consider the environment before printing this e-mail</span></i><span lang="EN-US" style="font-size:9.5pt"></span></p><p><i><span lang="EN-US" style="font-size:10pt;font-family:Arial,sans-serif">**Confidential Notice**</span></i><span lang="EN-US" style="font-size:9.5pt"></span></p><p><span lang="EN-US" style="font-size:9.5pt"> </span></p><p><i><span lang="EN-US" style="font-size:10pt;font-family:Arial,sans-serif">This message (including any attachments) is intended only for the use of the individual or entity to which it is addressed and may contain information that is non-public, proprietary, privileged, confidential, and exempt from disclosure under applicable law or may constitute as attorney work product. If you are not the intended recipient, you are hereby notified that any use, dissemination, distribution, or copying of this communication is strictly prohibited. If you have received this communication in error, notify us immediately by telephone and (I) destroy this message if a facsimile or (II) delete this message immediately if this is an electronic communication&quot;</span></i><span lang="EN-US" style="font-size:9.5pt"></span></p><p><span lang="EN-US" style="font-size:9.5pt"> </span></p><div style="font-family:arial,helvetica,sans-serif"><i style="font-family:Arial,Helvetica,sans-serif"><span lang="EN-US" style="font-size:10pt;font-family:Arial,sans-serif"> </span></i><i style="font-family:Arial,Helvetica,sans-serif"><span lang="ES-CO" style="font-size:10pt;font-family:Arial,sans-serif">Thanks </span></i></div></div><br></div></div>
        </div></div>'; /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu_nom, $cuerpo);
        $cuerpo = str_replace("lblTitu", $correo, $cuerpo);
        $cuerpo = str_replace("lblCate", $usu_ape, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Comunicaciones Superbrix");
        return $this->Send();
    }

    public function mensaje_despedida($tick_id){
        $usuario = new Usuario();
        $datos = $usuario->get_usuario_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["usu_id"];
            $usu_nom = $row["usu_nom"];
            $usu_ape = $row["usu_ape"];
            $usu_foto = $row["usu_foto"];
            $correo = "milton@superbrix.com";
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Comunicaciones Superbrix";
        $this->CharSet = 'UTF-8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = utf8_decode('La familia SuperBrix se despide de ' .  $usu_nom .' '. $usu_ape. ' en su cumpleaños ' );
        //Igual//
        $ruta = "https://novedades.superbrix.com/public/despedida/".$id.".png";
        $cuerpo = '<img src="[TEMPLATE]" alt="plantilla" height="100%" width="720" srcset="">'; /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("[TEMPLATE]", $ruta, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Comunicaciones Superbrix");
        return $this->Send();
    }

    public function CRON_mensaje_cumpleanios(){
        $usuario = new Usuario();
        $datos = $usuario->usuario_cumple_hoy();
        foreach ($datos as $row){
            $id = $row["usu_id"];
            $usu_nom = $row["usu_nom"];
            $usu_ape = $row["usu_ape"];
            $usu_foto = $row["usu_foto"];
            $correo = "milton@superbrix.com";
        }

        //IGual//
        $this->IsSMTP();
        $this->Host = 'mail.superbrix.com';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->SMTPSecure = 'ssl';
        $this->FromName = $this->tu_nombre = "Comunicaciones Superbrix";
        $this->CharSet = 'UTF-8';
        $this->addAddress($correo);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = 'La familia SuperBrix felicita a ' .  $usu_nom .' '. $usu_ape. ' en su cumpleaños ';
        //Igual//
        $ruta = "https://novedades.superbrix.com/public/cumpleanios/".$id.".png";
        $cuerpo = '<img src="[TEMPLATE]" alt="plantilla" height="100%" width="720" srcset="">'; /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("[TEMPLATE]", $ruta, $cuerpo);

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Asignado");
        return $this->Send();
    }

}

?>