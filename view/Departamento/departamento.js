var tabla;
let date = new Date().toDateString();

function init(){

}

$(document).ready(function(){

    //tabla de departamento activos
    tabla=$('#usuario_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [		          
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/departamento.php?op=listar',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }     
    }).DataTable(); 

    //tabla de departamento inactivos
    tabla=$('#usuario_inactivos_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [		          
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '../../controller/departamento.php?op=listar_departamento_inactivo',
            type : "post",
            dataType : "json",						
            error: function(e){
                console.log(e.responseText);	
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }     
    }).DataTable();
       
    // formulario guardar y editar
    $("#departamento_form_crear").on("submit",function(e){
        guardar_y_editar(e);	
    });

});

 //mostrar modal registro de usuario
 $(document).on("click","#btnnuevo", function(){
   $('#mdltitulo').html('Editar Registro');
    show_modal_crear_departamento();
});

// function guardar_departamento(e){
//     e.preventDefault();
// 	var formData = new FormData($("#departamento_form_crear")[0]);
//         $.ajax({
//             url: "../../controller/departamento.php?op=guardar_departamento",
//             type: "POST",
//             data: formData,
//             contentType: false,
//             cache: false,
//             processData: false,
//             beforeSend: function(){
//                 $('#file').attr("disabled","disabled");
//                 $('#usuario_form_crear').css("opacity",".5");
//                 swal({
//                     title: "Enviando...",
//                     text: "Por favor  espere",
//                     imageUrl: "../../public/img/loader.gif",
//                     showConfirmButton: false,
//                     allowOutsideClick: false
//                     });
//             },
//             success: function(msg){ 
                
//                 // editar(id)
//                 $('.statusMsg').html('');
//                 if(msg == 'ok'){
//                     $('#departamento_form_crear')[0].reset();
//                     $('#usuario_data').DataTable().ajax.reload();
//                         // stuff needs to be done
//                         $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Foto subida con exito...</span>');

//                     $('#departamento_form_crear').css("opacity","");
//                     $("#file").removeAttr("disabled");
//                     swal({
//                         title: "Completado",
//                         text: "Persona agregada con exito.",
//                         type: "success",
//                         confirmButtonClass: "btn-success"
//                     });
//                     //$('#modal_crear_usuario').modal('hide');
                
//                 }else{
//                     $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Algo Ocurrio al subir la imagen, Porfavor intenta de nuevo.</span>');
//                     swal({
//                         title: "Ups! algo salio mal :C",
//                         text: "Por favor intenta de nuevo.",
//                         type: "warning",
//                         confirmButtonClass: "btn-success"
//                     });
//                     $('#departamento_form_crear').css("opacity","");
//                     $("#file").removeAttr("disabled");
//                 }
                
//             }
            
//         });
// }

function guardar_y_editar(e){
    e.preventDefault();
	var formData = new FormData($("#departamento_form_crear")[0]);
    $.ajax({
        url: "../../controller/departamento.php?op=guardar_y_editar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){    
            console.log(datos);
            $('#departamento_form_crear')[0].reset();
            $("#modal_crear_departamento").modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

            swal({
                title: "Completado!",
                text: "Registro guardado con exito.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

function editar(id_departamento){
    $('#mdltitulo').html('Editar Registro');

    $.post("../../controller/departamento.php?op=mostrar", {id_departamento : id_departamento}, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#id_departamento').val(data.id_departamento);
        $('#nom_departamento').val(data.nom_departamento);
        $('#cod_departamento').val(data.cod_departamento);
        $('#des_departamento').val(data.des_departamento);
    }); 

    $('#modal_crear_departamento').modal('show');
}

function eliminar(id_departamento){
    swal({
        title: "Desactivar",
        text: "Esta seguro de Desactivar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/departamento.php?op=eliminar", {id_departamento : id_departamento}, function (data) {

            }); 

            $('#usuario_data').DataTable().ajax.reload();	
            $('#usuario_inactivos_data').DataTable().ajax.reload();	
            swal({
                title: "Completado!",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function habilitar_usuario(id_departamento){
    swal({
        title: "Habilitar drpartamento",
        text: "¿Quieres habilitar este departamento?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/departamento.php?op=habilitar_departamento", {id_departamento : id_departamento}, function (data) {

            }); 

            $('#usuario_data').DataTable().ajax.reload();	
            $('#usuario_inactivos_data').DataTable().ajax.reload();	
            swal({
                title: "Listo!",
                text: "Registro habilitado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function eliminar_usuario_raiz(id_departamento){
    swal({
        title: "Eliminar",
        text: "Esta seguro de Eliminar el usuario Permanentemente?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/departamento.php?op=eliminar_departamento_raiz", {id_departamento : id_departamento}, function (data) {

            }); 

            $('#usuario_inactivos_data').DataTable().ajax.reload();	
            $('#usuario_data').DataTable().ajax.reload();	
            swal({
                title: "Completado!",
                text: "Departamento Eliminado Correctamente.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function show_modal_crear_departamento(){
    $('#departamento_form_crear')[0].reset();
    $('#modal_crear_departamento').modal('show');
}


init();

