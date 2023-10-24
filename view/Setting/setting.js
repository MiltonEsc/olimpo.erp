function init(){
    list_setting();
}
$(document).ready(function(){
       
    // formulario guardar y editar
    $("#settings_form").on("submit",function(e){
        save_settings(e);	
    });

    $('.summernote').summernote({
        height: 150,
        lang: "es-ES",
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        },
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

});

function save_settings(e){
    e.preventDefault();
	var formData = new FormData($("#settings_form")[0]);
        $.ajax({
            url: "../../controller/setting.php?op=save_setting",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                $('#file').attr("disabled","disabled");
                $('#settings_form').css("opacity",".5");
                swal({
                    title: "Enviando...",
                    text: "Por favor  espere",
                    imageUrl: "../../public/img/loader.gif",
                    showConfirmButton: false,
                    allowOutsideClick: false
                    });
            },
            success: function(msg){ 
                
                // editar(id)
               
                if(msg == 'ok'){
                    $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Datos actualizados...</span>');
                    $('#settings_form').css("opacity","");
                    swal({
                        title: "Completado",
                        text: "Cambios guardados con exito.",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });
                    //$('#modal_crear_usuario').modal('hide');
                
                }else{
                   alert('error');
                }
                
            }
            
        });
}

function list_setting(){
    $.post("../../controller/setting.php?op=list_setting", function (data) {
      data = JSON.parse(data);
      $('#nom_app').val(data.nom_app);
      $('#slogan_app').val(data.slogan_app);
      $('#mision_app').summernote("code", data.mision_app);
      $('#vision_app').summernote("code", data.vision_app);
      $('#city_app').val(data.city_app);
      $('#dpto_app').val(data.dpto_app);
      $('#direccion_app').val(data.direccion_app);
      $('#supersite_app').val(data.supersite_app);
      $('#web_app').val(data.web_app);
      $('#usu_new_des').summernote("code",data.usu_new_des);
      $('#usu_edit_title').val(data.usu_edit_title);
      $('#usu_new_title').val(data.usu_new_title);
      $('#dpto_name').val(data.dpto_name);
      $('#dpto_des').summernote("code", data.dpto_des);

      $('#correo_soli_abierta').val(data.correo_soli_abierta);
      $('#correo_soli_asignada').val(data.correo_soli_asignada);
      $('#correo_soli_cerrada').val(data.correo_soli_cerrada);
      
    });
  
  
  
  }

  init();