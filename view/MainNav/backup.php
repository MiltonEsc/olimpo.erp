
<?php

    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="green with-sub">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th-large"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-tags"></span>
                            <span class="lbl">Nueva Solicitudes</span>
                        </a>
                    </li>

                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-tag"></span>
                            <span class="lbl">Consultar Solicitudes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }else if($_SESSION["rol_id"]==2){
        
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue with-sub">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th-large"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    
                    <li class="magenta with-sub">
                        <a href="..\MntUsuario\">
                            <span class="glyphicon glyphicon-lock"></span>
                            <span class="lbl">Administracion usuario</span>
                        </a>
                    </li>
                          
                    <li class="brown with-sub">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-tag"></span>
                            <span class="lbl">Consultar Solicitudes</span>
                        </a>
                    </li>
                    <li class="gold with-sub">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-tags"></span>
                            <span class="lbl">Nueva Solicitudes</span>
                        </a>
                    </li>  
                    <li class="blue-dirty">
                        <a href="..\Departamento\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Departamentos</span>
                        </a>
                    </li>
                    <li class="brown with-sub">
                        <a href="..\Galeria\">
                        <i class="font-icon font-icon-picture-2"></i>
                            <span class="lbl">Galeria</span>
                        </a>
                    </li>
                    <li class="brown with-sub">
                        <a href="..\Control_de_tiempos\">
                        <i class="font-icon font-icon-picture-2"></i>
                            <span class="lbl">Control de Tiempo</span>
                        </a>
                    </li>

                    <!-- Nested Menu -->
                    <li class="grey with-sub">
                        <span>
                            <span class="font-icon font-icon-burger"></span>
                            <span class="lbl">Nested Menu</span>
                        </span>
                        <ul style="">
                            <li><a href="#"><span class="lbl">Level 1</span></a></li>
                            <li><a href="#"><span class="lbl">Level 1</span></a></li>
                            <li class="with-sub">
                                <span>
                                    <span class="lbl">Level 2</span>
                                </span>
                                <ul style="">
                                    <li><a href="#"><span class="lbl">Level 2</span></a></li>
                                    <li><a href="#"><span class="lbl">Level 2</span></a></li>
                                    <li class="with-sub">
                                        <span>
                                            <span class="lbl">Level 3</span>
                                        </span>
                                        <ul>
                                            <li><a href="#"><span class="lbl">Level 3</span></a></li>
                                            <li><a href="#"><span class="lbl">Level 3</span></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
	                </li>
                    
                </ul>
            </nav>
        <?php
    }else if($_SESSION["rol_id"]==3){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="gold with-sub">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-tags"></span>
                            <span class="lbl">Nueva Solicitudes</span>
                        </a>
                    </li>        
                    <li class="brown with-sub">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-tag"></span>
                            <span class="lbl">Consultar Solicitudes</span>
                        </a>
                    </li>
                    <li class="brown with-sub">
                        <a href="..\Galeria\">
                        <i class="font-icon font-icon-picture-2"></i>
                            <span class="lbl">Galeria</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }
?>




