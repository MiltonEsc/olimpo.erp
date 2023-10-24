var tabla;
let date = new Date().toDateString();

function init(){

}

$(document).ready(function(){

    $.post("../../controller/galeria.php?op=get_gallery_perfil", function (data) {
        $('#gallery').html(data);
    }); 

});








function show_modal_crear_usuario(){
    $('#usuario_form_crear')[0].reset();
    $('#modal_crear_usuario').modal('show');
}


init();

