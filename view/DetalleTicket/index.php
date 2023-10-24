<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
?>
  <!DOCTYPE html>
  <html>
  <?php require_once("../MainHead/head.php"); ?>
  </head>

  <body class="with-side-menu">

    <?php require_once("../MainHeader/header.php"); ?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php"); ?>

    <!-- Contenido -->
    <div class="page-content">
      <div class="container-fluid">

        <header class="section-header">
          <div class="tbl">
            <div class="tbl-row">
              <div class="tbl-cell">
                <h4 id="lblnomidticket"></h4>
                <div id="lblestado"></div>
                <span class="label label-pill label-primary" id="lblnomusuario"></span>
                <span class="label label-pill label-default" id="lblfechcrea"></span>
                <ol class="breadcrumb breadcrumb-simple">
                  <li><a href="#">Home</a></li>
                  <li class="active">Detalle de la solicitud</li>
                </ol>
              </div>
            </div>
          </div>
        </header>

        <div class="box-typical box-typical-padding">
          <div class="row">

            <div class="col-lg-6">
              <fieldset class="form-group">
                <label class="form-label semibold" for="cat_nom">Categoria</label>
                <input type="text" class="form-control" id="cat_nom" name="cat_nom" readonly>
              </fieldset>
            </div>

            <div class="col-lg-6" id="titulo_id">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_titulo">Titulo</label>
                <input type="text" class="form-control" id="tick_titulo" name="tick_titulo" readonly>
              </fieldset>
            </div>
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold" for="usu_cedula">Cedula</label>
                <input type="text" class="form-control" id="usu_cedula" name="usu_cedula" readonly>
              </fieldset>
            </div>
            <div class="col-lg-12" id="documeto_adicional">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tick_titulo">Documentos Adicionales</label>
                <table id="documentos_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                  <thead>
                    <tr>
                      <th style="width: 90%;">Nombre</th>
                      <th class="text-center" style="width: 10%;"></th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </fieldset>
            </div>
            
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold form-label" for="nom_empleado">Nombre completo del empleado</label>
                <input type="text" class="form-control" id="nom_empleado" name="nom_empleado" placeholder="" readonly>
              </fieldset>
            </div>
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold" for="nom_jefe">Jefe inmediato de la persona a ingresar</label>
                <input type="text" class="form-control" id="nom_jefe" name="nom_jefe" placeholder="" readonly>
              </fieldset>
            </div>
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold" for="nom_depa">Departamento</label>
                <input type="text" class="form-control" id="nom_depa" name="nom_depa" placeholder="" readonly>
              </fieldset>
            </div>
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold" for="cargo_emp">Cargo del empleado</label>
                <input type="text" class="form-control" id="cargo_emp" name="cargo_emp" placeholder="" readonly>
              </fieldset>
            </div>
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold" for="fech_nac">fecha de nacimiento</label>
                <input type="text" class="form-control" id="fech_nac" name="fech_nac" placeholder="" readonly>
              </fieldset>
            </div>
            <div class="col-lg-6 fecha_ingreso" style="display: none;">
              <fieldset class="form-group">
                <label class="form-label semibold" for="fech_ingreso">Fecha ingreso del empleado</label>
                <input type="text" class="form-control" id="fech_ingreso" name="fech_ingreso" readonly>
              </fieldset>
            </div>
            <div class="col-lg-12" id="descripcion">
              <fieldset class="form-group">
                <label class="form-label semibold" for="tickd_descripusu">Comentarios</label>
                <div class="summernote-theme-1">
                  <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
                </div>
              </fieldset>
            </div>

          </div>
        </div>

        <section class="activity-line" id="lbldetalle">

        </section>
        <?php // if ($_SESSION["rol_id"] == '2') { ?>
          <div class="box-typical box-typical-padding" id="pnldetalle">
            <p>
              Ingrese su respuesta
            </p>
            <div class="row">

              <!-- ingreso de personal-->
              <div class="col-lg-12 pregunta_1" style="display: none;">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="linea_telefonica">Requiere Linea Telefonica</label>
                  <div class="radio">
                    <input type="radio" name="linea_tele" id="linea_tele_1" value="1">
                    <label for="linea_tele_1">Si</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="linea_tele" id="linea_tele_2" value="2">
                    <label for="linea_tele_2">No</label>
                  </div>
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;" id="pregunta_2">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="tipo_linea_tele">Tipo Linea Telefonica</label>
                  <div class="radio">
                    <input type="radio" name="tipo_linea_tele" id="tipo_linea_tele_1" value="1">
                    <label for="tipo_linea_tele_1">Linea Interna</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="tipo_linea_tele" id="tipo_linea_tele_2" value="2">
                    <label for="tipo_linea_tele_2">Linea Externa</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="tipo_linea_tele" id="tipo_linea_tele_3" value="3">
                    <label for="tipo_linea_tele_3">Ambas</label>
                  </div>
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="divisiones">A que tipo de información tendrá acceso</label>
                  <div class="checkbox">
                    <input type="checkbox" name="divisiones" id="division_1" value="Divi_Admon">
                    <label for="division_1">Divi_Admon</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="divisiones" id="division_2" value="Divi_cial">
                    <label for="division_2">Divi_cial</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="divisiones" id="division_3" value="Divi_Tec">
                    <label for="division_3">Divi_Tec</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="divisiones" id="division_4" value="Divi_Prod">
                    <label for="division_4">Divi_Prod</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="divisiones" id="division_5" value="Ninguna">
                    <label for="division_5">Ninguna</label>
                  </div>
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="opciones_ibes">Indique las opciones a agregar para el perfil en ibes(*opcional)</label>
                  <textarea class="form-control" id="opciones_ibes" name="opciones_ibes" placeholder=""></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="copia_ibes">¿Requiere copia de perfil de ibes de algún usuario?</label>
                  <div class="radio">
                    <input type="radio" name="copia_ibes" id="copia_ibes_1" value="1">
                    <label for="copia_ibes_1">Si</label>
                  </div>
                  <div class="radio">
                    <input type="radio" name="copia_ibes" id="copia_ibes_2" value="2">
                    <label for="copia_ibes_2">No</label>
                  </div>
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;" id="nom_usu_a_copiar">
                <fieldset class="form-group">
                  <label class="form-label semibold form-label" for="nom_copia_usu_ibes">Nombre de usuario que se requiere copiar de ibes(*opcional)</label>
                  <input type="text" class="form-control" id="nom_copia_usu_ibes" name="nom_copia_usu_ibes" placeholder="Nombre completo">
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;" id="adic_usu_a_copiar">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="adicional">Adicionales(*opcional)</label>
                  <input type="text" class="form-control" id="adicional" name="adicional" placeholder="Adicional">
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;" id="excep_usu_a_copiar">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="excepcion">Excepciones(*opcional)</label>
                  <input type="text" class="form-control" id="excepcion" name="excepcion" placeholder="">
                </fieldset>
              </div>
              <div class="col-lg-12 pregunta_1" style="display: none;">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="programas">Programas de acceso</label>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Google Drive" id="programa_1">
                    <label for="programa_1">Google Drive</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Solid Work" id="programa_2">
                    <label for="programa_2">Solid Work</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Softventas" id="programa_3">
                    <label for="programa_3">Softventas</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Supercom" id="programa_4">
                    <label for="programa_4">SuperCom</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Ibesweb" id="programa_5">
                    <label for="programa_5">IbesWeb</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Ibeserex" id="programa_7">
                    <label for="programa_7">IBES SEREX</label>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" name="programa" value="Ninguna" id="programa_6">
                    <label for="programa_6">Ninguna</label>
                  </div>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset class="form-group">
                  <label class="form-label semibold" for="tickd_descrip">Informacion Adicional</label>
                  <div class="summernote-theme-1">
                    <textarea id="tickd_descrip" name="tickd_descrip" class="summernote" name="name"></textarea>
                  </div>
                </fieldset>
              </div>

              <!-- fin de opciones  -->
              <div class="col-lg-12">
                <button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning">Cerrar Ticket</button>
              </div>
            </div>
          </div>
        <?php //} ?>
      </div>
    </div>
    <!-- Contenido -->

    <?php require_once("../MainJs/js.php"); ?>

    <script type="text/javascript" src="detalleticket.js"></script>

  </body>

  </html>
<?php
} else {
  // header("Location:" . Conectar::ruta() . "index.php");
  include("index2.php");
}
?>