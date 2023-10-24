<?php
    require_once("../config/conexion.php");
    require_once("../models/Galeria.php");
    $galeria = new Galeria();

    switch($_GET["op"]){
        case "get_gallery_perfil":
            $datos = $galeria->get_gallery_perfi();
            if(is_array($datos)==true and count($datos)>0){
    
                    foreach($datos as $row){ ?>
                        
                            <div class="gallery-col" id="<?php echo $row['usu_id'];?>">
                                <article class="gallery-item">
                                    <?php 
                                        if ($row['usu_foto'] == '' || $row['usu_foto'] == NULL) { ?>
                                            <img class="gallery-picture" src="../../public/img/avatar-1-256.png" title="<?php echo utf8_encode($row['usu_foto'])?>">

                                      <?php  } else { ?>
                                            <img class="gallery-picture" src="../../public/fotos-perfil/<?php echo utf8_encode($row['usu_foto'])?>" title="<?php echo utf8_encode($row['usu_foto'])?>">
                                       <?php } ?>
 
                                    <div class="gallery-hover-layout">
                                        <div class="gallery-hover-layout-in">
                                            <p class="gallery-item-title"><?php echo utf8_encode($row['usu_nom'].' '.$row['usu_ape']);?></p>
                                            <p><?php echo $row['usu_dpto'];?></p>
                                            <div class="btn-group">
                                                <button type="button" class="btn" data-toggle="modal" data-target="#uploadModal">
                                                    <i class="font-icon font-icon-cloud"></i>
                                                </button>
                                                <button type="button" class="btn">
                                                    <i class="font-icon font-icon-trash"></i>
                                                </button>
                                            </div>
                                            <p><?php echo $row['usu_correo'];?></p>
                                        </div>
                                    </div>
                                </article>
                             </div><!--.gallery-col-->
                        
                <?php }
            } 
        break;
    }
?>