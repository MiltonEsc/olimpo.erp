"use strict";

var tabla;

function init() {
  $('#cat_id').val('1');
}

$.post("../../controller/categoria.php?op=combo", function (data) {
  $('#cat_id').html(data);
}); // $('#cat_id').on('change',function(){
//     var selectValor = $(this).val();
//     var fech_inicial = $('#fech_inicial').val();
//     var fech_final = $('#fech_final').val();
//     console.log(fech_inicial);
//     if(fech_inicial == "" || fech_final == ""){
//         console.log('primer if');
//         tabla=$('#ticket_data').dataTable({
//             "aProcessing": true,
//             "aServerSide": true,
//             dom: 'Bfrtip',
//             "searching": true,
//             lengthChange: false,
//             colReorder: true,
//             buttons: [		          
//                     ],
//             "ajax":{
//                 url: '../../controller/ticket.php?op=listar_ticket_x_cat',
//                 type : "POST",
//                 dataType : "json",
//                 data:{ cat_id : selectValor},					
//                 error: function(e){
//                     console.log(e.responseText);	
//                 }
//             },
//             "bDestroy": true,
//             "responsive": true,
//             "bInfo":true,
//             "iDisplayLength": 10,
//             "autoWidth": false,
//             "language": {
//                 "sProcessing":     "Procesando...",
//                 "sLengthMenu":     "Mostrar _MENU_ registros",
//                 "sZeroRecords":    "No se encontraron resultados",
//                 "sEmptyTable":     "Ningún dato disponible en esta tabla",
//                 "sInfo":           "Mostrando un total de _TOTAL_ registros",
//                 "sInfoEmpty":      "Mostrando un total de 0 registros",
//                 "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//                 "sInfoPostFix":    "",
//                 "sSearch":         "Buscar:",
//                 "sUrl":            "",
//                 "sInfoThousands":  ",",
//                 "sLoadingRecords": "Cargando...",
//                 "oPaginate": {
//                     "sFirst":    "Primero",
//                     "sLast":     "Último",
//                     "sNext":     "Siguiente",
//                     "sPrevious": "Anterior"
//                 },
//                 "oAria": {
//                     "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                     "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//                 }
//             }     
//         }).DataTable();
//     }else{
//         console.log('segundo if');
//         tabla=$('#ticket_data').dataTable({
//             "aProcessing": true,
//             "aServerSide": true,
//             dom: 'Bfrtip',
//             "searching": true,
//             lengthChange: false,
//             colReorder: true,
//             buttons: [		          
//                     ],
//             "ajax":{
//                 url: '../../controller/ticket.php?op=listar_ticket_x_cat_y_fecha',
//                 type : "POST",
//                 dataType : "json",
//                 data:{ cat_id : selectValor, fech_inicial : fech_inicial, fech_final : fech_final},					
//                 error: function(e){
//                     console.log(e.responseText);	
//                 }
//             },
//             "bDestroy": true,
//             "responsive": true,
//             "bInfo":true,
//             "iDisplayLength": 10,
//             "autoWidth": false,
//             "language": {
//                 "sProcessing":     "Procesando...",
//                 "sLengthMenu":     "Mostrar _MENU_ registros",
//                 "sZeroRecords":    "No se encontraron resultados",
//                 "sEmptyTable":     "Ningún dato disponible en esta tabla",
//                 "sInfo":           "Mostrando un total de _TOTAL_ registros",
//                 "sInfoEmpty":      "Mostrando un total de 0 registros",
//                 "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//                 "sInfoPostFix":    "",
//                 "sSearch":         "Buscar:",
//                 "sUrl":            "",
//                 "sInfoThousands":  ",",
//                 "sLoadingRecords": "Cargando...",
//                 "oPaginate": {
//                     "sFirst":    "Primero",
//                     "sLast":     "Último",
//                     "sNext":     "Siguiente",
//                     "sPrevious": "Anterior"
//                 },
//                 "oAria": {
//                     "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                     "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//                 }
//             }     
//         }).DataTable();
//     }
//     console.log(selectValor);
// }).change();
// var selectValor = $(this).val();
// listar(){
// }

$(document).ready(function () {
  $("#ticket_form").on("submit", function (e) {
    filtrar(e);
  });
  var usu_id = $('#user_idx').val();

  if ($('#rol_idx').val() == 1) {
    $.post("../../controller/usuario.php?op=total", {
      usu_id: usu_id
    }, function (data) {
      data = JSON.parse(data);
      $('#lbltotal').html(data.TOTAL);
    });
    $.post("../../controller/usuario.php?op=totalabierto", {
      usu_id: usu_id
    }, function (data) {
      data = JSON.parse(data);
      $('#lbltotalabierto').html(data.TOTAL);
    });
    $.post("../../controller/usuario.php?op=totalcerrado", {
      usu_id: usu_id
    }, function (data) {
      data = JSON.parse(data);
      $('#lbltotalcerrado').html(data.TOTAL);
    });
    $.post("../../controller/usuario.php?op=grafico", {
      usu_id: usu_id
    }, function (data) {
      data = JSON.parse(data);
      new Morris.Bar({
        element: 'divgrafico',
        data: data,
        xkey: 'nom',
        ykeys: ['total'],
        labels: ['Value'],
        barColors: ["#1AB244"]
      });
    });
  } else {
    $.post("../../controller/ticket.php?op=total", function (data) {
      data = JSON.parse(data);
      $('#lbltotal').html(data.TOTAL);
    });
    $.post("../../controller/ticket.php?op=totalabierto", function (data) {
      data = JSON.parse(data);
      $('#lbltotalabierto').html(data.TOTAL);
    });
    $.post("../../controller/ticket.php?op=totalcerrado", function (data) {
      data = JSON.parse(data);
      $('#lbltotalcerrado').html(data.TOTAL);
    });
    $.post("../../controller/ticket.php?op=grafico", function (data) {
      data = JSON.parse(data);
      new Morris.Bar({
        element: 'divgrafico',
        data: data,
        xkey: 'nom',
        ykeys: ['total'],
        labels: ['Value']
      });
    });
  }
});

function filtrar(e) {
  e.preventDefault();
  var selectValor = $('#cat_id').val();
  var fech_inicial = $('#fech_inicial').val();
  var fech_final = $('#fech_final').val();

  if (fech_inicial == "" || fech_final == "") {
    console.log('primer if');
    tabla = $('#ticket_data').dataTable({
      "aProcessing": true,
      "aServerSide": true,
      dom: 'Bfrtip',
      "searching": true,
      lengthChange: false,
      colReorder: true,
      buttons: [],
      "ajax": {
        url: '../../controller/ticket.php?op=listar_ticket_x_cat',
        type: "POST",
        dataType: "json",
        data: {
          cat_id: selectValor
        },
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
  } else {
    console.log('segundo if');
    tabla = $('#ticket_data').dataTable({
      "aProcessing": true,
      "aServerSide": true,
      dom: 'Bfrtip',
      "searching": true,
      lengthChange: false,
      colReorder: true,
      buttons: [],
      "ajax": {
        url: '../../controller/ticket.php?op=listar_ticket_x_cat_y_fecha',
        type: "POST",
        dataType: "json",
        data: {
          cat_id: selectValor,
          fech_inicial: fech_inicial,
          fech_final: fech_final
        },
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
  }
}

init();