"use strict";

var tabla;
var date = new Date().toDateString();

function init() {}

$(document).ready(function () {
  //validacion de tipo de archivo foto de perfil
  $("#file").change(function () {
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];

    if (!(imagefile == match[0] || imagefile == match[1] || imagefile == match[2])) {
      swal({
        title: "Atencion!",
        text: "Porfavor seleciona un formato valido de imagen (JPEG/JPG/PNG).",
        type: "warning",
        confirmButtonClass: "btn-success"
      });
      $("#file").val('');
      return false;
    }
  });
  $.post("../../controller/galeria.php?op=get_gallery_perfi", function (data) {
    $('#gallery').html(data);
  });
});

function guardar_usuario(e) {
  e.preventDefault();
  var formData = new FormData($("#usuario_form_crear")[0]);
  var files = $('#file')[0].files; // Check file selected or not

  if (files.length > 0) {
    formData.append('file', files[0]);
    $.ajax({
      url: "../../controller/usuario.php?op=guardar_usuario",
      type: "POST",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        $('#file').attr("disabled", "disabled");
        $('#usuario_form_crear').css("opacity", ".5");
        swal({
          title: "Enviando...",
          text: "Por favor  espere",
          imageUrl: "../../public/img/loader.gif",
          showConfirmButton: false,
          allowOutsideClick: false
        });
      },
      success: function success(msg) {
        // editar(id)
        $('.statusMsg').html('');

        if (msg == 'ok') {
          $('#usuario_form_crear')[0].reset();
          $('#usuario_data').DataTable().ajax.reload(); // stuff needs to be done

          $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Foto subida con exito...</span>');
          $('#usuario_form_crear').css("opacity", "");
          $("#file").removeAttr("disabled");
          swal({
            title: "Completado",
            text: "Persona agregada con exito.",
            type: "success",
            confirmButtonClass: "btn-success"
          }); //$('#modal_crear_usuario').modal('hide');
        } else {
          $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Algo Ocurrio al subir la imagen, Porfavor intenta de nuevo.</span>');
          swal({
            title: "Ups! Algo salio mal :C",
            text: "Porfavor intenta de nuevo.",
            type: "warning",
            confirmButtonClass: "btn-success"
          });
          $('#usuario_form_crear').css("opacity", "");
          $("#file").removeAttr("disabled");
        }
      }
    });
  } else {
    swal({
      title: "¡Importante!",
      text: "Por favor suba una foto de perfil.",
      type: "warning",
      confirmButtonClass: "btn-success"
    });
  }
}

function eliminar(usu_id) {
  swal({
    title: "Eliminar",
    text: "Esta seguro de Eliminar el registro?",
    type: "error",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si",
    cancelButtonText: "No",
    closeOnConfirm: false
  }, function (isConfirm) {
    if (isConfirm) {
      $.post("../../controller/usuario.php?op=eliminar", {
        usu_id: usu_id
      }, function (data) {});
      $('#usuario_data').DataTable().ajax.reload();
      $('#usuario_inactivos_data').DataTable().ajax.reload();
      swal({
        title: "HelpDesk!",
        text: "Registro Eliminado.",
        type: "success",
        confirmButtonClass: "btn-success"
      });
    }
  });
}

function eliminar_usuario_raiz(usu_id) {
  swal({
    title: "Eliminar",
    text: "Esta seguro de Eliminar el usuario Permanentemente?",
    type: "error",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si",
    cancelButtonText: "No",
    closeOnConfirm: false
  }, function (isConfirm) {
    if (isConfirm) {
      $.post("../../controller/usuario.php?op=eliminar_usuario_raiz", {
        usu_id: usu_id
      }, function (data) {});
      $('#usuario_inactivos_data').DataTable().ajax.reload();
      $('#usuario_data').DataTable().ajax.reload();
      swal({
        title: "Completado!",
        text: "Usuario Eliminado Correctamente.",
        type: "success",
        confirmButtonClass: "btn-success"
      });
    }
  });
}

function show_modal_crear_usuario() {
  $('#usuario_form_crear')[0].reset();
  $('#modal_crear_usuario').modal('show');
}

init();