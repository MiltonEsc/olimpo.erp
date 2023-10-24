var tabla;
let date = new Date().toDateString();

function init(){

}

$(document).ready(function(){
    

     //validacion de tipo de archivo foto de perfil
     $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
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

    //tabla de usuarios activos
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
            url: '../../controller/usuario.php?op=listar',
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

    //tabla de usuarios inactivos
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
            url: '../../controller/usuario.php?op=listar_usuarios_inactivos',
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
    $("#usuario_form_crear").on("submit",function(e){
        guardar_usuario(e);	
    });

    // listar departamento
    $.post("../../controller/departamento.php?op=combo",function(data, status){
        $('#usu_dpto').html(data);
    });

});

 //mostrar modal registro de usuario
 $(document).on("click","#btnnuevo", function(){
    $('.mdltitulo').html('Nuevo Registro');
    $('.mensaje-titulo').attr("disabled","disabled");
    show_modal_crear_usuario();
});

function mayus(e) {
    e.value = e.value.toUpperCase();
}
function guardar_usuario(e){
    e.preventDefault();
	var formData = new FormData($("#usuario_form_crear")[0]);
    var files = $('#file')[0].files;
      // Check file selected or not
    if(true){
        formData.append('file',files[0]);
        $.ajax({
            url: "../../controller/usuario.php?op=guardar_usuario",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                $('#file').attr("disabled","disabled");
                $('#usuario_form_crear').css("opacity",".5");
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
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    $('#usuario_form_crear')[0].reset();
                    $('#usuario_data').DataTable().ajax.reload();
                        // stuff needs to be done
                        $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Foto subida con exito...</span>');

                    $('#usuario_form_crear').css("opacity","");
                    $("#file").removeAttr("disabled");
                    swal({
                        title: "Completado",
                        text: "Persona agregada con exito.",
                        type: "success",
                        confirmButtonClass: "btn-success"
                    });
                    //$('#modal_crear_usuario').modal('hide');
                
                }else{
                    $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Algo Ocurrio al subir la imagen, Porfavor intenta de nuevo.</span>');
                    swal({
                        title: "Ups! Algo salio mal :C",
                        text: "Porfavor intenta de nuevo.",
                        type: "warning",
                        confirmButtonClass: "btn-success"
                    });
                    $('#usuario_form_crear').css("opacity","");
                    $("#file").removeAttr("disabled");
                }
                
            }
            
        });
    }else{
        swal({
            title: "¡Importante!",
            text: "Por favor suba una foto de perfil.",
            type: "warning",
            confirmButtonClass: "btn-success"
        });
     }
}

function eliminar(usu_id){
    swal({
        title: "Eliminar",
        text: "Esta seguro de Eliminar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.get("../../controller/usuario.php?op=eliminar", {usu_id : usu_id}, function (data) {

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

function habilitar_usuario(usu_id){
    swal({
        title: "Habilitar",
        text: "¿Quieres habilitar este usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.post("../../controller/usuario.php?op=habilitar_usuario", {usu_id : usu_id}, function (data) {

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

function eliminar_usuario_raiz(usu_id){
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
            var enviar = $.post("../../controller/usuario.php?op=eliminar_usuario_raiz", {usu_id : usu_id}, function (data) {

            }); 
            enviar.done(function( data ) {
                swal({
                    title: "Completado!",
                    text: "Usuario Eliminado Correctamente.",
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
                $('#usuario_inactivos_data').DataTable().ajax.reload();	
                $('#usuario_data').DataTable().ajax.reload();	
                
            });

           
        }
    });
}

function show_modal_crear_usuario(){
    $('#usuario_form_crear')[0].reset();
    $('#modal_crear_usuario').modal('show');
}


init();

