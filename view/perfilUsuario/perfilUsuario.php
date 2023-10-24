<?php
require_once("../../config/conexion.php"); 
require_once("../../controller/perfilUsuarioController/perfil_usuario_controller.php");
$controller = new PerfilUsuarioController();
$informacionEmpleado = $controller->mostrarInformacionDeEmpleado();

if(isset($_SESSION["usu_id"])) { 
?>

<!DOCTYPE html>
<html>
<?php require_once("../MainHead/head.php"); ?>

<style>
    *{
        box-sizing: border-box
    }
    
    body {
        margin-top:20px;
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;   
    }
    .main-body {
        padding: 15px;
    }

    .nav-link {
        color: #4a5568;
    }
    .nav.nav-pills .nav-link{
        border-radius: 0em;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
    input{
        margin: .5em 0em 1em 0em
    }
</style>
</head>
<body class="with-side-menu">
    <?php require_once("../MainHeader/header.php"); ?>
    <div class="mobile-menu-left-overlay"></div>
    <?php require_once("../MainNav/nav.php"); ?>
    <div class="page-content">
        <div class="container-fluid">
            <div class="box-typical box-typical-padding">
                <section class="row gutters-sm">
                    <!-- Contenido de la barra lateral -->
                    <aside class="col-md-4 d-none d-md-block">
                        <div class="card">
                            <div class="card-body">
                                <nav class="nav flex-column nav-pills nav-gap-y-1" id="nav">
                                    <a href="#profile" data-toggle="tab" class="nav-link py-3 rounded-0 active">
                                        Información del perfil
                                    </a>
                                    <a href="#account" data-toggle="tab" class="nav-link py-3 rounded-0">
                                        Configuración de cuenta
                                    </a>
                                    <a href="#security" data-toggle="tab" class="nav-link py-3 rounded-0">
                                        Seguridad de la cuenta
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </aside>
                    <!-- Contenido principal -->
                    <main class="col-md-8">
                        <div class="card">
                            <div class="card-body tab-content">
                                <section class="tab-pane active" id="profile">
                                    <h2>Tu información de pérfil</h2>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                            <label for="fullName">Nombre completo</label>
                                            <input type="text" class="form-control" id="fullName" placeholder="" value="<?php echo $informacionEmpleado['nombre']?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="url">Cédula de ciudadanía</label>
                                            <input type="text" class="form-control" id="id" placeholder="" value="<?php echo $informacionEmpleado['cedula']?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Departamento</label>
                                            <input type="text" class="form-control" id="departament" placeholder="" value="<?php echo $informacionEmpleado['departamento']?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Cargo</label>
                                            <input type="text" class="form-control" id="job" placeholder="" value="<?php echo $informacionEmpleado['cargo']?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="location">Correo</label>
                                            <input type="text" class="form-control" id="job" placeholder="" value="<?php echo $informacionEmpleado['correo']?>" disabled>
                                        </div>
                                        <div class="form-text text-muted">
                                            * Estos datos no pueden ser modificados y solo están en visualización. Si deseas modificar tu información, contacta con el administrador del sistema.
                                        </div>
                                    </form>
                                </section>
                                <section class="tab-pane" id="account">
                                    <h2>Configuración de la cuenta</h2>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                            <label class="d-block text-danger">Deshabilitar cuenta</label>
                                            <p class="text-muted font-size-sm">Una vez deshabilites tu cuenta, perderás el acceso a ella. Para más información, contacta con el administrador del sistema.</p>
                                        </div>
                                        <button class="btn btn-danger" type="button">Deshabilitar cuenta</button>
                                    </form>
                                </section>
                                <section class="tab-pane" id="security">
                                    <h2>Seguridad de la cuenta</h2>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                            <label class="d-block">Cambiar contraseña</label>
                                            <input type="password" class="form-control mt-1" placeholder="Nueva contraseña">
                                            <input type="password" class="form-control mt-1" placeholder="Confirmar nueva contraseña">
                                        </div>
                                        <button type="button" class="btn btn-primary">Cambiar contraseña</button>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </main>
                </section>
            </div>
        </div>
    </div>
    
    <?php require_once("../MainJs/js.php"); ?>

    <script>
    const nav = document.getElementById('nav');
    const tabContent = document.querySelector('.tab-content');

    nav.addEventListener('click', function(event) {
        if (event.target.tagName === "A") {
            // Elimina la clase "active" de todos los enlaces
            const anchors = nav.getElementsByTagName('a');
            for (const element of anchors) {
                element.classList.remove('active');
            }
            // Agrega la clase "active" al enlace clickeado
            event.target.classList.add('active');

            // Muestra la sección correspondiente
            const sectionId = event.target.getAttribute('href').substring(1);
            const section = document.getElementById(sectionId);

            if (section) {
                // Oculta todas las secciones
                const sections = tabContent.querySelectorAll('.tab-pane');
                sections.forEach(function(section) {
                    section.classList.remove('active');
                });

                // Muestra la sección seleccionada
                section.classList.add('active');
            }
        }
    });

    const btnDeshabilitarCuenta = document.querySelector('.btn-danger');

    btnDeshabilitarCuenta.addEventListener('click', function() {
        Swal.fire({
            title: '¿Estás seguro de deshabilitar tu cuenta?',
            text: 'Una vez deshabilites tu cuenta, perderás el acceso a ella.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, deshabilitar cuenta',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes agregar la lógica para deshabilitar la cuenta
                Swal.fire('Cuenta deshabilitada', '', 'success');
            }
        });
    });


</script>

</body>
</html>

<?php
} else {
    header("Location:" . Conectar::ruta() . "index.php");
}
?>
