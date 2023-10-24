<?php
require_once '../../controller/modulosController/modulos_controller.php';

$controller = new ModulosController();
$modulosAsignados = $controller->mostrarModulos();
?>

<nav class="side-menu">
    <ul class="side-menu-list">
        <?php if (empty($modulosAsignados)) : ?>
            <div style=" height: 100vh; display: flex; align-items: center; justify-content: center">
                <span>Sin módulos asignados</span>
            </div>
        <?php else : ?>
            <?php foreach ($modulosAsignados as $moduloNivel1) : ?>
                <li class="with-sub">
                    <span>
                        <span class="glyphicon glyphicon-th-large"></span>
                        <span class="lbl"><?php echo $moduloNivel1['nombre']; ?></span>
                    </span>
                    <?php if (!empty($moduloNivel1['submodulos'])) : ?>
                        <ul>
                            <?php foreach ($moduloNivel1['submodulos'] as $moduloNivel2) : ?>
                                <li class="with-sub">
                                    <span>
                                        <span class="lbl"><?php echo $moduloNivel2['nombre']; ?></span>
                                    </span>
                                    <?php if (!empty($moduloNivel2['submodulos'])) : ?>
                                        <ul>
                                            <?php foreach ($moduloNivel2['submodulos'] as $moduloNivel3) : ?>
                                                <li>
                                                    <a href="#"><span class="lbl"><?php echo $moduloNivel3['nombre']; ?></span></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</nav>
