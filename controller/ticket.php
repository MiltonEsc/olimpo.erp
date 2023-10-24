<?php
require_once("../config/conexion.php");
require_once("../models/Ticket.php");
$ticket = new Ticket();

require_once("../models/Usuario.php");
$usuario = new Usuario();

require_once("../models/Documento.php");
$documento = new Documento();

switch ($_GET["op"]) {

    case "insert":
        $datos = $ticket->insert_ticket($_POST["usu_id"], $_POST["cat_id"], $_POST["tick_titulo"], $_POST["tick_descrip"], $_POST["nom_emp"],  $_POST["ape_emp"],$_POST["nom_jefe"], $_POST["nom_depa"], $_POST["usu_cargo"], $_POST["usu_cedula"], $_POST["fech_nac"], $_POST["fech_ingreso"], $_POST["correo"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["tick_id"] = $row["tick_id"];
                $output["nom_emp"] = $row["nom_emp"];
                $output["departamento"] = $row["departamento"];
                $output["cargo"] = $row["cargo"];
                $output["fech_ingreso"] = $row["fech_ingreso"];
                $output["nom_jefe"] = $row["nom_jef"];
                if ($_FILES['files']['name'] > 0) {
                    $countfiles = count($_FILES['files']['name']);
                    $ruta = "../public/document/" . $output["tick_id"] . "/";
                    $files_arr = array();

                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }

                    for ($index = 0; $index < $countfiles; $index++) {
                        $doc1 = $_FILES['files']['tmp_name'][$index];
                        $destino = $ruta . $_FILES['files']['name'][$index];

                        $documento->insert_documento($output["tick_id"], $_FILES['files']['name'][$index]);

                        move_uploaded_file($doc1, $destino);
                    }
                } else {
                }
            }
        }
        echo json_encode($datos);
        break;

    case "update":
        $ticket->update_ticket($_POST["tick_id"]);
        $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"], $_POST["usu_id"]);
        break;

    case "asignar":
        $ticket->update_ticket_asignacion($_POST["tick_id"], $_POST["usu_asig"]);
        break;

    case "listar_x_usu":
        $datos = $ticket->listar_ticket_x_usu($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tick_id"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["usu_nom"].' '.$row["usu_ape"];
            $sub_array[] = $row["tick_titulo"];

            if ($row["tick_estado"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }

            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));

            if ($row["fech_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
            } else {
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
            }

            if ($row["usu_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-warning">Sin Asignar</span>';
            } else {
                $datos1 = $usuario->get_usuario_x_id($row["usu_asig"]);
                foreach ($datos1 as $row1) {
                    $sub_array[] = '<span class="label label-pill label-success">' . $row1["usu_nom"] . '</span>';
                }
            }

            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ',' . $row["cat_id"] .');"  id="' . $row["tick_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "listar":
        $datos = $ticket->listar_ticket();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tick_id"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["usu_nom"].' '.$row["usu_ape"];
            $sub_array[] = $row["tick_titulo"];

            if ($row["tick_estado"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }

            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_entry"]));

            if ($row["fech_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
            } else {
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
            }

            if ($row["usu_asig"] == null) {
                $sub_array[] = '<a onClick="asignar(' . $row["tick_id"] . ');"><span class="label label-pill label-warning">Sin Asignar</span></a>';
            } else {
                $datos1 = $usuario->get_usuario_x_id($row["usu_asig"]);
                foreach ($datos1 as $row1) {
                    $sub_array[] = '<span class="label label-pill label-success">' . $row1["usu_nom"] . '</span>';
                }
            }

            $sub_array[] = '<button type="button"  onClick="ver(' . $row["tick_id"] . ',' . $row["cat_id"] .');"  id="' . $row["tick_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "listar_ticket_x_cat":
        $datos = $ticket->listar_ticket_X_cat($_POST['cat_id']);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tick_id"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["tick_titulo"];

            if ($row["tick_estado"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }

            $sub_array[] = date("Y/m/d", strtotime($row["fech_crea"]));

            if ($row["fech_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
            } else {
                $sub_array[] = date("Y/m/d", strtotime($row["fech_asig"]));
            }

            if ($row["usu_asig"] == null) {
                $sub_array[] = '<a onClick="asignar(' . $row["tick_id"] . ');"><span class="label label-pill label-warning">Sin Asignar</span></a>';
            } else {
                $datos1 = $usuario->get_usuario_x_id($row["usu_asig"]);
                foreach ($datos1 as $row1) {
                    $sub_array[] = '<span class="label label-pill label-success">' . $row1["usu_nom"] . '</span>';
                }
            }

            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ');"  id="' . $row["tick_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "listar_ticket_x_cat_y_fecha":
        $datos = $ticket->listar_ticket_x_cat_y_fecha($_POST['cat_id'], $_POST['fech_inicial'], $_POST['fech_final']);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["tick_id"];
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = $row["tick_titulo"];

            if ($row["tick_estado"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }

            $sub_array[] = date("Y-m-d", strtotime($row["fech_crea"]));

            if ($row["fech_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
            } else {
                $sub_array[] = date("Y-m-d", strtotime($row["fech_asig"]));
            }

            if ($row["usu_asig"] == null) {
                $sub_array[] = '<a onClick="asignar(' . $row["tick_id"] . ');"><span class="label label-pill label-warning">Sin Asignar</span></a>';
            } else {
                $datos1 = $usuario->get_usuario_x_id($row["usu_asig"]);
                foreach ($datos1 as $row1) {
                    $sub_array[] = '<span class="label label-pill label-success">' . $row1["usu_nom"] . '</span>';
                }
            }

            $sub_array[] = '<button type="button" onClick="ver(' . $row["tick_id"] . ');"  id="' . $row["tick_id"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;

    case "listardetalle":
        $datos = $ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
        ?>
        <?php
        foreach ($datos as $row) {
            ?>
                <article class="activity-line-item box-typical">
                    <div class="activity-line-date">
                        <?php echo date("d/m/Y", strtotime($row["fech_crea"])); ?>
                    </div>
                    <header class="activity-line-item-header">
                        <div class="activity-line-item-user">
                            <div class="activity-line-item-user-photo">
                                <a href="#">
                                    <img src="../../public/fotos-perfil/<?php echo $row['usu_foto'] ?>" alt="<?php echo $row['usu_foto'] ?>">
                                </a>
                            </div>
                            <div class="activity-line-item-user-name"><?php echo $row['usu_nom'] . ' ' . $row['usu_ape']; ?></div>
                            <div class="activity-line-item-user-status">
                                <?php
                                if ($row['rol_id'] == 1) {
                                    echo 'Usuario';
                                } else {
                                    echo 'Soporte';
                                }
                                ?>
                            </div>
                        </div>
                    </header>
                    <div class="activity-line-action-list">
                        <section class="activity-line-action">
                            <div class="time"><?php echo date("H:i:s", strtotime($row["fech_crea"])); ?></div>
                            <div class="cont">
                                <div class="cont-in">
                                    <p>
                                        <?php echo $row["tickd_descrip"]; ?>
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            <?php } ?>
            <?php
        break;

    case "listardetalle_ingreso":
        $datos = $ticket->listar_ticketdetalle_x_ticket_ingreso($_POST["tick_id"]);
        ?>
        <?php
        $count = 0;
        foreach ($datos as $row) {
            if (empty($row["line_tef_ingreso"])) { ?>
                <article class="activity-line-item box-typical">
                    <div class="activity-line-date">
                        <?php echo date("d/m/Y", strtotime($row["fech_crea"])); ?>
                    </div>
                    <header class="activity-line-item-header">
                        <div class="activity-line-item-user">
                            <div class="activity-line-item-user-photo">
                                <a href="#">
                                <img src="../../public/fotos-perfil/<?php echo $row['usu_foto'] ?>" alt="<?php echo $row['usu_foto'] ?>">
                                </a>
                            </div>
                            <div class="activity-line-item-user-name"><?php echo $row['usu_nom'] . ' ' . $row['usu_ape']; ?></div>
                            <div class="activity-line-item-user-status">
                                <?php
                                if ($row['rol_id'] == 1) {
                                    echo 'Usuario';
                                } else {
                                    echo 'Soporte';
                                }
                                ?>
                            </div>
                        </div>
                    </header>
                    <div class="activity-line-action-list">
                        <section class="activity-line-action">
                            <div class="time"><?php echo date("H:i:s", strtotime($row["fech_crea"])); ?></div>
                            <div class="cont">
                                <div class="cont-in">
                                    <p>
                                        <?php echo $row["tickd_descrip"]; ?>
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            <?php } else { ?>
                <article class="activity-line-item box-typical">
                    <div class="activity-line-date">
                        <?php echo date("Y/m/d", strtotime($row["fech_crea"])); ?>
                    </div>
                    <header class="activity-line-item-header">
                        <div class="activity-line-item-user">
                            <div class="activity-line-item-user-photo">
                                <a href="#">
                                <img src="../../public/fotos-perfil/<?php echo $row['usu_foto'] ?>" alt="<?php echo $row['usu_foto'] ?>">
                                </a>
                            </div>
                            <div class="activity-line-item-user-name"><?php echo $row['usu_nom'] . ' ' . $row['usu_ape']; ?></div>
                            <div class="activity-line-item-user-status">
                                <?php
                                if ($row['rol_id'] == 1) {
                                    echo 'Usuario';
                                } else {
                                    echo 'Soporte';
                                }
                                ?>
                            </div>
                            <div class="activity-line-item-user-status"><?php echo date("H:i:s", strtotime($row["fech_crea_ingreso"])); ?></div>
                        </div>
                    </header>
                    <div class="activity-line-action-list">
                        <section class="activity-line-action">

                            <div class="cont">
                                <div class="row">
                                    <div class="col-lg-12 pregunta_2">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="tick_titulo"> Requiere Linea Telefonica</label>
                                            <?php if ($row["line_tef_ingreso"] == 1) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="linea_telefonica<?php echo $count?>" id="linea_telefonica_1" value="1" disabled checked>
                                                    <label for="linea_telefonica_1">Si</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="linea_telefonica<?php echo $count?>" id="linea_telefonica_2" value="2" disabled>
                                                    <label for="linea_telefonica_2">No</label>
                                                </div>
                                            <?php } else if ($row["line_tef_ingreso"] == 2) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="linea_telefonica<?php echo $count?>" id="linea_telefonica_1" value="1" disabled>
                                                    <label for="linea_telefonica_1">Si</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="linea_telefonica<?php echo $count?>" id="linea_telefonica_2" value="2" disabled checked>
                                                    <label for="linea_telefonica_2">No</label>
                                                </div>
                                            <?php } ?>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 pregunta_2">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="tipo_linea_telefonica">Tipo Linea Telefonica</label>
                                            <?php if ($row["tline_tef_ingreso"] == 1) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_1" value="linea_interna" disabled checked>
                                                    <label for="tipo_linea_telefonica_1">Linea Interna</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_2" value="linea_externa" disabled>
                                                    <label for="tipo_linea_telefonica_2">Linea Externa</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_3" value="ambas" disabled>
                                                    <label for="tipo_linea_telefonica_3">Ambas</label>
                                                </div>
                                            <?php } else if ($row["tline_tef_ingreso"] == 2) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_1" value="linea_interna" disabled>
                                                    <label for="tipo_linea_telefonica_1">Linea Interna</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_2" value="linea_externa " disabled checked>
                                                    <label for="tipo_linea_telefonica_2">Linea Externa</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_3" value="ambas" disabled>
                                                    <label for="tipo_linea_telefonica_3">Ambas</label>
                                                </div>
                                            <?php } else if ($row["tline_tef_ingreso"] == "") { ?>
                                                <label class="form-label semibold" for="tipo_linea_telefonica">Ninguna</label>
                                            <?php } else if ($row["tline_tef_ingreso"] == 3) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_1" value="linea_interna" disabled>
                                                    <label for="tipo_linea_telefonica_1">Linea Interna</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_2" value="linea_externa" disabled>
                                                    <label for="tipo_linea_telefonica_2">Linea Externa</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="tipo_linea_telefonica<?php echo $count?>" id="tipo_linea_telefonica_3" value="ambas" disabled  checked>
                                                    <label for="tipo_linea_telefonica_3">Ambas</label>
                                                </div>
                                            <?php } ?>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 pregunta_2">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="divisiones">A que tipo de información tendrá acceso</label>
                                            <p>El usuario tendra aceso a las siguientes divisiones:</p><br>
                                            <p><?php echo $row["tdivi_ingreso"] ?>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 pregunta_2">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="fech_ingreso">Indique las opciones a agregar para el perfil en ibes</label>
                                            <input type="text" class="form-control" id="nom_empleado" value="<?php echo $row["opt_ibes_ingreso"] ?>" name="nom_empleado" placeholder="" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 pregunta_2">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="tick_titulo">¿Requiere copia de perfil de ibes de algún usuario?</label>
                                            <?php if ($row["cop_perfil_ibes_ingreso"] == 1) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="perfil-ibes" id="perfil-ibes-1" value="linea-1" disabled checked>
                                                    <label for="perfil-ibes-1">Si</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="perfil-ibes" id="perfil-ibes-2" value="linea-2" disabled>
                                                    <label for="perfil-ibes-2">No</label>
                                                </div>
                                                <div class="col-lg-12 pregunta_2">
                                                    <fieldset class="form-group">
                                                        <label class="form-label semibold form-label" for="nom_empleado">Nombre de usuario que se requiere copiar de ibes</label>
                                                        <input type="text" class="form-control" id="nom_empleado" value="<?php echo $row["name_cop_perfil_ibes_ingreso"] ?>" name="nom_empleado" placeholder="" readonly>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12 pregunta_2">
                                                    <fieldset class="form-group">
                                                        <label class="form-label semibold" for="nom_jefe">Adicionales</label>
                                                        <input type="text" class="form-control" id="nom_jefe" name="nom_jefe" value="<?php echo $row["adicional_ingreso"] ?>" placeholder="" readonly>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12 pregunta_2">
                                                    <fieldset class="form-group">
                                                        <label class="form-label semibold" for="nom_depa">Excepciones</label>
                                                        <input type="text" class="form-control" id="nom_depa" name="nom_depa" value="<?php echo $row["exce_ingreso"] ?>" placeholder="" readonly>
                                                    </fieldset>
                                                </div>

                                            <?php } else if ($row["cop_perfil_ibes_ingreso"] == 2) { ?>
                                                <div class="radio">
                                                    <input type="radio" name="perfil-ibes" id="perfil-ibes-1" value="linea-1" disabled>
                                                    <label for="perfil-ibes-1">Si</label>
                                                </div>
                                                <div class="radio">
                                                    <input type="radio" name="perfil-ibes" id="perfil-ibes-2" value="linea-2" disabled checked>
                                                    <label for="perfil-ibes-2">No</label>
                                                </div>
                                            <?php } ?>
                                        </fieldset>
                                    </div>
                                    
                                    <div class="col-lg-12 pregunta_2">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Programas de acceso</label>
                                            <p>El usuario requiere acceso a los siguientes programas:</p><br>
                                            <ul>
                                                <?php echo $row["programas_ingreso"] ?>
                                            </ul>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="cont-in">
                                <label class="form-label semibold" for="tipo_linea_telefonica">Informacion Adicional</label>
                                    <p>
                                        <?php echo $row["tickd_descrip"]; ?>
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>

            <?php  }  ?>

        <?php $count++; } ?>
            <?php
        break;

    case "mostrar";
        $datos = $ticket->listar_ticket_x_id($_POST["tick_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["tick_id"] = $row["tick_id"];
                $output["usu_id"] = $row["usu_id"];
                $output["cat_id"] = $row["cat_id"];

                $output["tick_titulo"] = $row["tick_titulo"];
                $output["tick_descrip"] = $row["tick_descrip"];

                if ($row["tick_estado"] == "Abierto") {
                    $output["tick_estado"] = '<span class="label label-pill label-success">Abierto</span>';
                } else {
                    $output["tick_estado"] = '<span class="label label-pill label-danger">Cerrado</span>';
                }

                $output["tick_estado_texto"] = $row["tick_estado"];
                $output["nom_emp"] = $row["nom_emp"];
                $output["nom_jefe"] = $row["nom_jef"];
                $output["departamento"] = $row["departamento"];
                $output["cargo"] = $row["cargo"];
                $output["fech_ingreso"] = $row["fech_ingreso"];
                $output["fech_nac"] = $row["fech_nac"];
                $output["usu_cedula"] = $row["usu_cedula"];

                $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_ape"] = $row["usu_ape"];
                $output["cat_nom"] = $row["cat_nom"];
            }
            echo json_encode($output);
        }
        break;

    case "insertdetalle":
        $ticket->insert_ticketdetalle($_POST["tick_id"], $_POST["usu_id"], $_POST["tickd_descrip"]);
        break;

    case "insertdetalle_ingreso":
        $ticket->insert_ticketdetalle_ingreso($_POST["tick_id"], $_POST["usu_id"], $_POST["tickd_descrip"], $_POST["linea_tele"], $_POST["tipo_linea_tele"], $_POST["divisiones"], $_POST["opciones_ibes"], $_POST["copia_ibes"], $_POST["opcion_copia_usu_ibes"], $_POST["adicional"], $_POST["excepcion"], $_POST["programas"]);
        break;

    case "total";
        $datos = $ticket->get_ticket_total();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;

    case "totalabierto";
        $datos = $ticket->get_ticket_totalabierto();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;

    case "totalcerrado";
        $datos = $ticket->get_ticket_totalcerrado();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["TOTAL"] = $row["TOTAL"];
            }
            echo json_encode($output);
        }
        break;

    case "grafico";
        $datos = $ticket->get_ticket_grafico();
        echo json_encode($datos);
        break;
}
?>