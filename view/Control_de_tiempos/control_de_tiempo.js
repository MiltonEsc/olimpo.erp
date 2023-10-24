var tabla;
let date = new Date().toDateString();

$(document).ready(function(){

    function init(){
        $("#listar").on("submit", function (e) {
            filtrar(e);
        });
    }
    $('#taller').multiselect({
        includeSelectAllOption: true,
        buttonWidth: '220px',
        selectAllText: 'Todos',
        allSelectedText: 'Todos...',
    });
    $('#pagos').multiselect({
    includeSelectAllOption: true,
    buttonWidth: '220px',
    selectAllText: 'Todos',
    allSelectedText: 'Todos...',
    maxHeight: 400,
    dropDowm: true
    });

    function filtrar(e) {
    e.preventDefault();
    var instructivo = $('#instructivo').val();
    var orden = $('#orden').val();
    var idempleado = $('#idempleado').val();
    var fech_inicial = $('#fech_inicial').val();
    var fech_final = $('#fech_final').val();
    var taller = $('#taller').val().toString();
    var pagos = $('#pagos').val().toString();
    console.log(taller);

    if(Array.isArray(taller)){
    alert("Filtre la Informacion por fecha u orden de Produccion");
    }else{
    tabla=$('#example2').dataTable({
    "aProcessing": false,
    "aServerSide": true,
    "paging":   true,
    "searching": true,
    dom: 'Bfrtip',
    lengthChange: false,
    colReorder: true,
    buttons: [		          
            'excelHtml5'
            ],
    "ajax":{
        url: "../../controller/control_tiempo.php?op=listar2",
        type : "post",
        dataType : "json",					
        data:{ orden: orden, taller:taller, idempleado:idempleado, instructivo : instructivo, fech_inicial : fech_inicial, fech_final : fech_final, pagos : pagos},			
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
    }
    }

    //
    $('#ct_op').on('change',function(){

        var selectValor = $(this).val();
        console.log(selectValor);
    
        if (selectValor == 'CNC') {
            $(".est_maquina").show();
        }else{
            $(".est_maquina").hide();
           
        }
    
            
    }).change();

    //tabla de Control de tiempos
    tabla=$('#tabla_tiempo_X_usuario').dataTable({
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
            url: '../../controller/control_tiempo.php?op=listar',
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
    $("#control_tiempo_form_crear").on("submit",function(e){
        validarFormulario(e);
    });

    $("#modal_control_tiempo_form_crear").on("submit",function(e){
        validarFormularioEditado(e);
    });

    init();
});




function editar(coti_id){
    $('#mdltitulo').html('Editar Orden de Produccion');

    $.post("../../controller/control_tiempo.php?op=mostrar", {coti_id : coti_id}, function (data) {
        data = JSON.parse(data);
        console.log(data);
        $('#modal_nhoras').val(data.coti_cantidad_tiempo);
        $('#modal_num_op').val(data.coti_num_op);
        $('#modal_coti_id').val(data.coti_id);
        // $("#modal_ct_op").val(data.coti_ct_ejecuto);
        $('#modal_ct_op').on('change', function() {
            var selectValor = $(this).val();
            console.log(selectValor);
            
            if (selectValor === 'CNC') {
                $(".modal_est_maquina").show();
                $("#modal_maquina").val(data.coti_maquina_cnc);
            } else {
                $(".modal_est_maquina").hide();
            }
        });
        
        // Asegúrate de que data.coti_ct_ejecuto esté definido antes de este código
        $("#modal_ct_op").val(data.coti_ct_ejecuto).change();
    }); 

    $('#modal_crear_registro_op').modal('show');
}

function eliminar(coti_id){
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
            $.post("../../controller/control_tiempo.php?op=eliminar", {coti_id : coti_id}, function (data) {

            }); 

            $('#tabla_tiempo_X_usuario').DataTable().ajax.reload();	
            swal({
                title: "Completado!",
                text: "Registro Eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

function validarFormulario(e) {
    e.preventDefault();

    var num_op = $('#num_op').val();

    if (num_op === '') {
       // Existe un registro con el mismo ID
       var formData = new FormData($("#control_tiempo_form_crear")[0]);
       $.ajax({
           url: "../../controller/control_tiempo.php?op=guardar_tiempo_op",
           type: "POST",
           data: formData,
           contentType: false,
           processData: false,
           success: function(datos){ 
               if(datos == 'ok'){
                   $('#control_tiempo_form_crear')[0].reset();
                   $('#tabla_tiempo_X_usuario').DataTable().ajax.reload();

                   swal({
                       title: "Completado!",
                       text: "Registro guardado con exito.",
                       type: "success",
                       confirmButtonClass: "btn-success"
                   });
               }else{
                   swal({
                       title: "Error!",
                       text: "No se guardo el Registro.",
                       type: "error",
                       confirmButtonClass: "btn-warning"
                   });
               }    
           }
       });
    }else{
        // Realiza la solicitud AJAX con jQuery
    $.ajax({
        url: '../../controller/control_tiempo.php?op=validar',
        type: 'POST',
        dataType: 'json',
        data: { num_op: num_op },
        success: function(response) {
          if (response.existe) {
            // Existe un registro con el mismo ID
            var formData = new FormData($("#control_tiempo_form_crear")[0]);
            $.ajax({
                url: "../../controller/control_tiempo.php?op=guardar_tiempo_op",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos){ 
                    if(datos == 'ok'){
                        $('#control_tiempo_form_crear')[0].reset();
                        $('#tabla_tiempo_X_usuario').DataTable().ajax.reload();
    
                        swal({
                            title: "Completado!",
                            text: "Registro guardado con exito.",
                            type: "success",
                            confirmButtonClass: "btn-success"
                        });
                    }else{
                        swal({
                            title: "Error!",
                            text: "No se guardo el Registro.",
                            type: "error",
                            confirmButtonClass: "btn-warning"
                        });
                    }    
                }
            });
          } else {
            // No existe un registro con el mismo ID,No puedes enviar el formulario
            swal({
              title: "Alerta OP!",
              text: "Verifica el estado de la OP: podria estar cerrada o anulada.",
              type: "warning",
              confirmButtonClass: "btn-success"
          });
            
          }
        },
        error: function(xhr, status, error) {
          console.log(error); // Maneja el error de acuerdo a tus necesidades
        }
      });
    } 
    
}
function validarFormularioEditado(e) {
    e.preventDefault();
    var num_op = $('#modal_num_op').val(); // Obtén el valor del campo de entrada del ID
    // Realiza la solicitud AJAX con jQuery
    $.ajax({
      url: '../../controller/control_tiempo.php?op=validar',
      type: 'POST',
      dataType: 'json',
      data: { num_op: num_op },
      success: function(response) {
        if (response.existe) {
          // Existe un registro con el mismo ID
          var formData = new FormData($("#modal_control_tiempo_form_crear")[0]);
          $.ajax({
              url: "../../controller/control_tiempo.php?op=editar_tiempo_op",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              success: function(datos){ 
                  if(datos == 'ok'){
                      
                      $('#tabla_tiempo_X_usuario').DataTable().ajax.reload();
  
                      swal({
                          title: "Completado!",
                          text: "Registro guardado con exito.",
                          type: "success",
                          confirmButtonClass: "btn-success"
                      });
                      $('#modal_crear_registro_op').modal('hide');
                  }else{
                      swal({
                          title: "Error!",
                          text: "No se guardo el Registro.",
                          type: "error",
                          confirmButtonClass: "btn-warning"
                      });
                  }    
              }
          });
        } else {
          // No existe un registro con el mismo ID,No puedes enviar el formulario
          swal({
            title: "Alerta OP!",
            text: "Verifica el estado de la OP: podria estar cerrada o anulada.",
            type: "warning",
            confirmButtonClass: "btn-success"
        });
          
        }
      },
      error: function(xhr, status, error) {
        console.log(error); // Maneja el error de acuerdo a tus necesidades
      }
    });
}
function show_modal_crear_departamento(){
    $('#departamento_form_crear')[0].reset();
    $('#modal_crear_registro_op').modal('show');
}

 //mostrar modal registro de usuario
$(document).on("click","#btnnuevo", function(){
    $('#mdltitulo').html('Editar Registro');
    show_modal_crear_departamento();
});




