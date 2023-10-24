<?php
require_once("../../config/conexion.php");
if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {
    require_once("../../models/Usuario.php");
    $usuario = new Usuario();
    $usuario->login_2();
}
?>
<!DOCTYPE html>
<html>
<?php require_once("../MainHead/head.php"); ?>
</head>

<body>
    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">
                <form class="sign-box" action="" method="post" id="login_form">
                    <input type="hidden" id="rol_id" name="rol_id" value="1">

                    <div class="img-fluid">
                        <img src="../../public/img/tickets.png" alt="" style="width: 100%;">
                    </div>
                    <br>
                    <header class="sign-title" id="lbltitulo">Acceso Usuario</header>

                    <?php
                    if (isset($_GET["m"])) {
                        switch ($_GET["m"]) {
                            case "1";
                    ?>
                                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <i class="font-icon font-icon-warning"></i>
                                    El Usuario y/o Contraseña son incorrectos.
                                </div>
                            <?php
                                break;

                            case "2";
                            ?>
                                <div class="alert alert-warning alert-icon alert-close alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <i class="font-icon font-icon-warning"></i>
                                    Los campos estan vacios.
                                </div>
                    <?php
                                break;
                        }
                    }
                    ?>

                    <div class="form-group">
                        <input type="text" id="usu_correo" name="usu_correo" class="form-control" placeholder="E-Mail" />
                    </div>
                    <div class="form-group">
                        <input type="password" id="usu_pass" name="usu_pass" class="form-control" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <div class="float-right reset">
                            <a href="reset-password.html">Cambiar Contraseña</a>
                        </div>
                    </div>
                    <input type="hidden" name="enviar" class="form-control" value="si">
                    <button type="submit" class="btn btn-rounded">Acceder</button>
                </form>
            </div>
        </div>
    </div>
    <!--.page-center-->


    <?php require_once("../MainJs/js.php"); ?>

    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function() {
                setTimeout(function() {
                    $('.page-center').matchHeight({
                        remove: true
                    });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                }, 100);
            });
        });
    </script>
    <script type="text/javascript" src="datos.js"></script>
</body>

</html>