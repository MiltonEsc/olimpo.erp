<header class="site-header">
    <div class="container-fluid">

        <a href="../Home/index.php" class="site-logo">
            <img class="hidden-md-down" src="../../public/img/timer.png" alt="">
            <img class="hidden-lg-up" src="../../public/img/timer.png" alt="">
        </a>

        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
            <span>toggle menu</span>
        </button>

        <button class="hamburger hamburger--htla">
            <span>toggle menu</span>
        </button>
        
        <div class="site-header-content">
            <div class="site-header-content-in">
                <div class="site-header-shown">
                    <div class="dropdown user-menu">
                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../../public/fotos-perfil/<?php echo $_SESSION["usu_foto"]?>" alt="">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
                            <a class="dropdown-item" href="../perfilUsuario/perfilUsuario.php"><span class="font-icon glyphicon glyphicon-user"></span>Perfil</a>
                            <a class="dropdown-item" href="#"><span class="font-icon glyphicon glyphicon-question-sign"></span>Ayuda</a>
                            <a class="dropdown-item" href="..\Setting\"><span class="font-icon glyphicon glyphicon-cog"></span>Configuración</a>
                            <a class="dropdown-item" href="../permisosRoles/permisos_roles.php"><span class="font-icon glyphicon glyphicon-th-large"></span>Permisos y roles</a>
                            <a class="dropdown-item" href="../gestionUsuarios/gestionUsuarios.php"><span class="font-icon glyphicon glyphicon-user"></span>Gestión de usuarios</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../Logout/logout.php"><span class="font-icon glyphicon glyphicon-log-out"></span>Cerrar Sesion</a>
                        </div>
                    </div>
                </div>

                <div class="mobile-menu-right-overlay"></div>

                <input type="hidden" id="user_idx" value="<?php echo $_SESSION["usu_id"] ?>"><!-- ID del Usuario-->
                <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["rol_id"] ?>"><!-- Rol del Usuario-->

                <div class="dropdown dropdown-typical">
                    <a href="#" class="dropdown-toggle no-arr">
                        
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>