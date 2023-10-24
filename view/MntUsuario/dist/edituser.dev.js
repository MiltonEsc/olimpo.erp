"use strict";

var tabla;
var date = new Date().toDateString();
var urlSearchParams = new URLSearchParams(window.location.search);
var usu_id = urlSearchParams.get("id");
console.log("El id es:", usu_id);

function init() {}

$(document).ready(function () {
  mostrar(usu_id);
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
  }); //validar extensión de archivo foto de perfil
  // ACTUALIZAR DATOS

  $("#usuario_form").on("submit", function (e) {
    editar_usuario(e);
    $("#cumpleaniosModal").modal('show');
    setTimeout(function () {
      tomar_imagen_cumpleanios('contenedor-cumpleanios2', usu_id);
      hide_modal_cumpleanios();
    }, 3000);
  });
  $.post("../../controller/departamento.php?op=editar_combo", {
    usu_id: usu_id
  }, function (data, status) {
    $('#usu_dpto').html(data);
  });
}); //mostrar modal registro de usuario

$(document).on("click", "#enviar_cumpleanios", function () {
  tomar_imagen_cumpleanios_enviar('contenedor-cumpleanios', usu_id);
});
$(document).on("click", "#enviar_bienvenida", function () {
  tomar_imagen_bienvenida('contenedor-bienvenida', usu_id);
});
$(document).on("click", "#enviar_despedida", function () {
  tomar_imagen_despedida('contenedor-despedida', usu_id);
});

function tomar_imagen_cumpleanios_enviar(div, nombre) {
  swal({
    title: "Atención!",
    text: "¿Estas seguro de enviar esta plantilla por correo?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-success",
    confirmButtonText: "Si, Enviala!",
    closeOnConfirm: false
  }, function () {
    html2canvas(document.querySelector("#" + div), {
      letterRendering: 1,
      useCORS: true,
      allowTaint: true,
      onrendered: function onrendered(canvas) {}
    }) // Llamar a html2canvas y pasarle el elemento  
    .then(function (canvas) {
      var dataURL = canvas.toDataURL(); // Cuando se resuelva la promesa traerá el canvas

      var base = "img=" + dataURL + "&nombre=" + nombre;
      console.log(base);
      $.ajax({
        type: "POST",
        url: "../../controller/capturadora.php?captura=cumpleanios",
        data: base,
        beforeSend: function beforeSend() {
          swal({
            title: "Enviando...",
            text: "Por favor  espere",
            imageUrl: "../../public/img/loader.gif",
            showConfirmButton: false,
            allowOutsideClick: false
          });
        },
        success: function success(respuesta) {
          respuesta = parseInt(respuesta);
          console.log(respuesta);

          if (respuesta > 0) {
            var enviar = $.post("../../controller/email.php?op=mensaje_cumpleanios", {
              tick_id: usu_id
            });
            enviar.done(function (data) {
              swal({
                title: "Completado!",
                text: "Imagen enviada con exito!",
                type: "success"
              });
            });
          } else {
            swal({
              title: "Completado!",
              text: "Imagen no actualizada!",
              type: "error"
            });
          }
        }
      });
    });
  });
}

function tomar_imagen_cumpleanios(div, nombre) {
  html2canvas(document.querySelector("#" + div), {
    letterRendering: 1,
    useCORS: true,
    allowTaint: true,
    onrendered: function onrendered(canvas) {}
  }) // Llamar a html2canvas y pasarle el elemento  
  .then(function (canvas) {
    var dataURL = canvas.toDataURL(); // Cuando se resuelva la promesa traerá el canvas

    var base = "img=" + dataURL + "&nombre=" + nombre;
    console.log(base);
    $.ajax({
      type: "POST",
      url: "../../controller/capturadora.php?captura=cumpleanios",
      data: base,
      beforeSend: function beforeSend() {
        toastr.success("Generando plantilla...", "Aviso!");
      },
      success: function success(respuesta) {
        respuesta = parseInt(respuesta);
        console.log(respuesta);

        if (respuesta > 0) {
          toastr.success("Foto tomada exitosamente", "Aviso!"); //   setInterval("location.reload(true)",1200);
        } else {
          toastr.info("no actualizo la foto", "Opcional");
        }
      }
    });
  });
}

function tomar_imagen_bienvenida(div, nombre) {
  swal({
    title: "Atención!",
    text: "¿Estas seguro de enviar esta plantilla por correo?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-success",
    confirmButtonText: "Si, Enviala!",
    closeOnConfirm: false
  }, function () {
    html2canvas(document.querySelector("#" + div), {
      letterRendering: 1,
      useCORS: true,
      allowTaint: true,
      onrendered: function onrendered(canvas) {}
    }) // Llamar a html2canvas y pasarle el elemento  
    .then(function (canvas) {
      var dataURL = canvas.toDataURL(); // Cuando se resuelva la promesa traerá el canvas

      var base = "img=" + dataURL + "&nombre=" + nombre;
      console.log(base);
      $.ajax({
        type: "POST",
        url: "../../controller/capturadora.php?captura=bienvenida",
        data: base,
        beforeSend: function beforeSend() {
          swal({
            title: "Enviando...",
            text: "Por favor  espere",
            imageUrl: "../../public/img/loader.gif",
            showConfirmButton: false,
            allowOutsideClick: false
          });
        },
        success: function success(respuesta) {
          respuesta = parseInt(respuesta);

          if (respuesta > 0) {
            var enviar = $.post("../../controller/email.php?op=mensaje_bienvenida", {
              tick_id: usu_id
            });
            enviar.done(function (data) {
              toastr.success("mensaje bienvenida enviado con exito!", "Aviso!");
              var form_ingreso = $.post("../../controller/email.php?op=form_ingreso", {
                tick_id: usu_id
              });
              form_ingreso.done(function (data) {
                toastr.success("formulario enviado con exito!", "Aviso!");
                swal({
                  title: "Completado!",
                  text: "Base de datos actualizada con exito!",
                  type: "success"
                });
              });
            }); //   setInterval("location.reload(true)",1200);
          } else {
            swal({
              title: "Completado!",
              text: "Imagen no actualizada!",
              type: "error"
            });
          }
        }
      });
    });
  });
}

function tomar_imagen_despedida(div, nombre) {
  swal({
    title: "Atención!",
    text: "¿Estas seguro de enviar esta plantilla por correo?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-success",
    confirmButtonText: "Si, Enviala!",
    closeOnConfirm: false
  }, function () {
    html2canvas(document.querySelector("#" + div), {
      letterRendering: 1,
      useCORS: true,
      allowTaint: true,
      onrendered: function onrendered(canvas) {}
    }) // Llamar a html2canvas y pasarle el elemento  
    .then(function (canvas) {
      var dataURL = canvas.toDataURL(); // Cuando se resuelva la promesa traerá el canvas

      var base = "img=" + dataURL + "&nombre=" + nombre;
      console.log(base);
      $.ajax({
        type: "POST",
        url: "../../controller/capturadora.php?captura=despedida",
        data: base,
        beforeSend: function beforeSend() {
          swal({
            title: "Enviando...",
            text: "Por favor  espere",
            imageUrl: "../../public/img/loader.gif",
            showConfirmButton: false,
            allowOutsideClick: false
          });
        },
        success: function success(respuesta) {
          respuesta = parseInt(respuesta);
          console.log(respuesta);

          if (respuesta > 0) {
            var enviar = $.post("../../controller/email.php?op=mensaje_despedida", {
              tick_id: usu_id
            });
            enviar.done(function (data) {
              swal({
                title: "Completado!",
                text: "Correo enviado con exito!",
                type: "success"
              });
            }); //   setInterval("location.reload(true)",1200);
          } else {
            swal({
              title: "Completado!",
              text: "Imagen no actualizada!",
              type: "error"
            });
          }
        }
      });
    });
  });
}

function editar_usuario(e) {
  e.preventDefault();
  var formData = new FormData($("#usuario_form")[0]);
  var files = $('#file')[0].files; // Check file selected or not

  if (true) {
    formData.append('file', files[0]);
    $.ajax({
      url: "../../controller/usuario.php?op=editar",
      type: "POST",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function beforeSend() {
        toastr.success("Actualizando datos", "Espere...");
        $('#file').attr("disabled", "disabled");
        $('#usuario_form').css("opacity", ".5");
      },
      success: function success(msg) {
        $('.statusMsg').html('');

        if (msg == 'ok' && files.length > 0) {
          $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Foto de perfil actualizada.</span>');
        } else {
          $('.statusMsg').html('<span style="font-size:18px;color:#FF0000">Foto de perfil No actualizada.</span>');
        }

        $('#usuario_form').css("opacity", "");
        $("#file").removeAttr("disabled"); // swal({
        //   title: "Completado",
        //   text: "Persona actualizada con exito.",
        //   type: "success",
        //   timer: 3000,
        // });

        setTimeout(function () {
          toastr.success("Datos actualizados con exito", "Aviso!");
        }, 2000);
        mostrar(usu_id);
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

function mostrar(usu_id) {
  $.post("../../controller/usuario.php?op=mostrar", {
    usu_id: usu_id
  }, function (data) {
    data = JSON.parse(data);
    $('#usu_id').val(data.usu_id);
    $('#usu_nom').val(data.usu_nom);
    $('#usu_ape').val(data.usu_ape);
    $('#usu_correo').val(data.usu_correo);
    $('#usu_pass').val(data.usu_pass);
    $('#usu_cargo').val(data.usu_cargo);
    $('#usu_ext').val(data.usu_ext);
    $('#usu_dpto').val(data.usu_dpto);
    $('#fech_nac').val(data.fech_nac);
    $('#fech_ingreso').val(data.fech_ingreso);
    $('#rol_id').val(data.rol_id).trigger('change'); //plantilla cumpleaños

    $('.nombre').html(data.usu_nom + ' ' + data.usu_ape);
    $('.cargo').html(data.usu_cargo);
    $('.fech_actual').html(data.fech_actual);
    $('.correo').html(data.usu_correo);
    $('.usu_foto').attr("src", '../../public/fotos-perfil/' + data.usu_foto);
    $('.ext').html(data.usu_ext);
    $('.departamento').html(data.usu_dpto);
  });
}

function hide_modal_cumpleanios() {
  $('#cumpleaniosModal').modal('hide');
}

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};
init();