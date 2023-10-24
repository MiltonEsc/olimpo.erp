"use strict";

function init() {}

$(document).ready(function () {
  var tick_id = getUrlParameter('ID');
  listardetalle_ingreso(tick_id);
  $('#tickd_descrip').summernote({
    height: 400,
    lang: "es-ES",
    callbacks: {
      onImageUpload: function onImageUpload(image) {
        console.log("Image detect...");
        myimagetreat(image[0]);
      },
      onPaste: function onPaste(e) {
        console.log("Text detect...");
      }
    },
    toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']]]
  });
  $('#tickd_descripusu').summernote({
    height: 400,
    lang: "es-ES",
    toolbar: [['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']]]
  });
  $('#tickd_descripusu').summernote('disable'); //tabla para los documentos adicionales

  tabla = $('#documentos_data').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    dom: 'Bfrtip',
    "searching": false,
    lengthChange: false,
    colReorder: true,
    buttons: [],
    "ajax": {
      url: '../../controller/documento.php?op=listar',
      type: "post",
      data: {
        tick_id: tick_id
      },
      dataType: "json",
      error: function error(e) {
        console.log(e.responseText);
      }
    },
    "bDestroy": true,
    "responsive": true,
    "bInfo": true,
    "iDisplayLength": 10,
    "autoWidth": false,
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando un total de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando un total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }
  }).DataTable();
}); //funcion para tomar el parametro ID de la URL

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
}; //Boton para enviar el formulario


$(document).on("click", "#btnenviar", function () {
  var tick_id = getUrlParameter('ID');
  var usu_id = $('#user_idx').val();
  var tickd_descrip = $('#tickd_descrip').val();
  var cate_nom = $('#cat_nom').val(); //VARIABLES INGRESO USUARIO

  var linea_tele = $('input[name=linea_tele]:checked').val();
  var tipo_linea_tele = $('input[name=tipo_linea_tele]:checked').val();
  var opciones_ibes = $('#opciones_ibes').val();
  var opcion_copia_usu_ibes = $('#nom_copia_usu_ibes').val();
  var adicional = $('#adicional').val();
  var excepcion = $('#excepcion').val();
  var copia_ibes = $('input[name=copia_ibes]:checked').val();
  var array_2 = $('input:checkbox[name=divisiones]:checked').map(function () {
    return this.value;
  }).get();
  var divisiones = array_2.join(', ');
  var array_1 = $('input:checkbox[name=programa]:checked').map(function () {
    return this.value;
  }).get();
  var programas = array_1.join(', ');

  if (cate_nom == "Ingreso de Usuario nuevo en el sistema") {
    if ($.trim(linea_tele) == "") {
      toastr.error("responda la Pregunta #1", "Aviso!");
      return false;
    }

    if ($.trim(tipo_linea_tele) == "" && $.trim(linea_tele) == "1") {
      toastr.error("Selecione una linea de telefono", "Aviso!");
      return false;
    }

    $.post("../../controller/ticket.php?op=insertdetalle_ingreso", {
      tick_id: tick_id,
      usu_id: usu_id,
      tickd_descrip: tickd_descrip,
      linea_tele: linea_tele,
      tipo_linea_tele: tipo_linea_tele,
      divisiones: divisiones,
      opciones_ibes: opciones_ibes,
      copia_ibes: copia_ibes,
      opcion_copia_usu_ibes: opcion_copia_usu_ibes,
      adicional: adicional,
      excepcion: excepcion,
      programas: programas
    }, function (data) {
      listardetalle_ingreso(tick_id);
      $('#tickd_descrip').summernote('reset');
      swal("Correcto!", "Registrado Correctamente", "success");
    });
    $.post("../../controller/ticket.php?op=update", {
      tick_id: tick_id,
      usu_id: usu_id
    }, function (data) {});
    $.post("../../controller/email.php?op=ticket_cerrado", {
      tick_id: tick_id
    }, function (data) {});
  } else {
    if ($('#tickd_descrip').summernote('isEmpty')) {
      toastr.error("Ingrese una Descripcion", "Aviso!");
      return false;
    } else {
      // $('.pregunta_1').hide();
      $.post("../../controller/ticket.php?op=insertdetalle", {
        tick_id: tick_id,
        usu_id: usu_id,
        tickd_descrip: tickd_descrip,
        linea_tele: linea_tele,
        tipo_linea_tele: tipo_linea_tele,
        divisiones: divisiones,
        opciones_ibes: opciones_ibes,
        copia_ibes: copia_ibes,
        opcion_copia_usu_ibes: opcion_copia_usu_ibes,
        adicional: adicional,
        excepcion: excepcion,
        programas: programas
      }, function (data) {
        listardetalle_ingreso(tick_id);
        $('#tickd_descrip').summernote('reset');
        swal("Correcto!", "Registrado Correctamente", "success");
      });
    }
  }
}); // boton para cerrar la solicitud

$(document).on("click", "#btncerrarticket", function () {
  swal({
    title: "Atencion",
    text: "Esta seguro de Cerrar el Ticket?",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-warning",
    confirmButtonText: "Si",
    cancelButtonText: "No",
    closeOnConfirm: false
  }, function (isConfirm) {
    if (isConfirm) {
      var tick_id = getUrlParameter('ID');
      var usu_id = $('#user_idx').val();
      $.post("../../controller/ticket.php?op=update", {
        tick_id: tick_id,
        usu_id: usu_id
      }, function (data) {});
      listardetalle_ingreso(tick_id);
      swal({
        title: "Completado!",
        text: "Ticket Cerrado correctamente.",
        type: "success",
        confirmButtonClass: "btn-success"
      });
    } else {}
  });
}); //lista las preguntas y los datos del formulario de la persona

function listardetalle_ingreso(tick_id) {
  $.post("../../controller/ticket.php?op=listardetalle_ingreso", {
    tick_id: tick_id
  }, function (data) {
    $('#lbldetalle').html(data);
  });
  $.post("../../controller/ticket.php?op=mostrar", {
    tick_id: tick_id
  }, function (data) {
    data = JSON.parse(data);
    $('#lblestado').html(data.tick_estado);
    $('#lblnomusuario').html(data.usu_nom + ' ' + data.usu_ape);
    $('#lblfechcrea').html(data.fech_crea);
    $('#lblnomidticket').html("Solicitud #" + data.tick_id);
    $('#cat_nom').val(data.cat_nom);
    $('#tick_titulo').val(data.tick_titulo);
    $('#tickd_descripusu').summernote('code', data.tick_descrip);

    if (data.cat_nom == "Ingreso de Usuario nuevo en el sistema") {
      $('.pregunta_1').show();
      $('#titulo_id').hide();
      $('#documeto_adicional').hide();
      $('#descripcion').hide();
      $('.fecha_ingreso').show();
      $("input[name='linea_tele']:radio").change(function () {
        if ($(this).val() == '2') {
          $('#pregunta_2').hide();
          $('input[name="tipo_linea_tele"]').prop('checked', false);
        }

        if ($(this).val() == '1') {
          $('#pregunta_2').show();
        }
      });
      $("input[name='copia_ibes']:radio").change(function () {
        if ($(this).val() == '2') {
          $('#nom_usu_a_copiar').hide();
          $('#adic_usu_a_copiar').hide();
          $('#excep_usu_a_copiar').hide();
          $('input[name=nom_copia_usu_ibes').val('');
          $('input[name=adicional').val('');
          $('input[name=excepcion').val('');
        }

        if ($(this).val() == '1') {
          $('#nom_usu_a_copiar').show();
          $('#adic_usu_a_copiar').show();
          $('#excep_usu_a_copiar').show();
        }
      });
      $('#btncerrarticket').hide();
      $('#nom_empleado').val(data.nom_emp);
      $('#nom_jefe').val(data.nom_jefe);
      $('#nom_depa').val(data.departamento);
      $('#cargo_emp').val(data.cargo);
      $('#usu_recomendacion').val(data.recomendacion);
      $('#fech_ingreso').val(data.fech_ingreso);
      $('#usu_cedula').val(data.usu_cedula);
      $('#fech_nac').val(data.fech_nac);
    } // console.log( data.cat_nom);


    if (data.tick_estado_texto == "Cerrado") {
      $('#pnldetalle').hide();
    }
  });
} //estas son las alertas de los input


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