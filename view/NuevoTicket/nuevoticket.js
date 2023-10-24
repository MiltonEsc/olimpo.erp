
function init(){
   
    $("#ticket_form").on("submit",function(e){
        guardaryeditar(e);	
    });
    
}

$(document).ready(function() {

    $('#tick_descrip').summernote({
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

    $.post("../../controller/categoria.php?op=combo",function(data, status){
        $('#cat_id').html(data);
    });

    $.post("../../controller/departamento.php?op=combo",function(data, status){
        $('#nom_depa').html(data);
    });

    var simple = new Datepicker('#simple')
});

$('#cat_id').on('change',function(){

    var selectValor = $(this).val();
    console.log(selectValor);

    if (selectValor == 6) {
        $(".fecha_ingreso").show();
        $('#fileElement').hide();
        $('#descripcion').hide();
    }else{
        $(".fecha_ingreso").hide();
        $('#descripcion').show();
        $('#fileElement').show();
    }

        
}).change();

function guardaryeditar(e){
    e.preventDefault();
    

if($('#cat_id').val() == 6){
        // ESTOS CAMPOS SON PARA UN TICKET DE INGRESO DE PERSONA
        var nom_emp = $('#nom_emp').val();
        var ape_emp = $('#ape_emp').val();
        var nom_depa = $('#nom_depa').val();
        var fech_ingreso = $('#fech_ingreso').val();
        var usu_cargo = $('#usu_cargo').val();
        var nom_jefe = $('#nom_jefe').val();
        var fech_nac = $('#fech_nac').val();
        var usu_cedula = $('#usu_cedula').val();
        var correo = $('#correo').val();
        // ESTOS CAMPOS SON POR DEFECTO DE UN TICKET NORMAL
        var usu_id=$('#usu_id').val();
        var cat_id = $('#cat_id').val();
        var tick_titulo = $('#tick_titulo').val();
        var tick_descrip = $('#tick_descrip').val();
        var rol_id = "1";
        var usu_ext = "";
        var est = "2";
        // if($.trim(nom_emp) == ""){
        //     toastr.error("Por favor ingrese un nombre","Aviso!");
        //         return false;
        // }else if($.trim(nom_depa) == ""){
        //     toastr.error("Campo departamento vacio","Aviso!");
        //         return false;
        // }else if($.trim(fech_ingreso) == ""){
        //     toastr.error("Fecha de ingreso Invalida","Aviso!");
        //         return false;
        // }else if($.trim(usu_cargo) == ""){
        //     toastr.error("Campo  cargo vacio","Aviso!");
        //         return false;
        // }else if($.trim(nom_jefe) == ""){
        //     toastr.error("No ha ingresado Nombre de jefe","Aviso!");
        //         return false;
        // }else if($.trim(fech_nac) == ""){
        //     toastr.error("Fecha de nacimiento Invalida","Aviso!");
        //         return false;
        // }else if($.trim(usu_cedula) == ""){
        //     toastr.error("No ha ingresado una Cedula","Aviso!");
        //         return false;
        // }else if($.trim(correo) == ""){
        //     toastr.error("No ha ingresado una Correo","Aviso!");
        //         return false;
        // }else{
            
            $.post("../../controller/ticket.php?op=insert",{usu_id:usu_id,cat_id:cat_id, tick_titulo:tick_titulo,tick_descrip:tick_descrip,nom_emp:nom_emp, ape_emp:ape_emp, nom_depa:nom_depa,fech_ingreso:fech_ingreso,usu_cargo:usu_cargo,nom_jefe:nom_jefe,fech_nac:fech_nac,usu_cedula:usu_cedula,correo:correo}, function (data) {
                data = JSON.parse(data);
                
                console.log(data);
                console.log(data['tick_id']);
                $('#tick_titulo').val('');
                $('#fech_ingreso').val('');
                $('#nom_emp').val('');
                $('#ape_emp').val('');
                $('#usu_cedula').val('');
                $('#nom_jefe').val('');
                $('#correo').val('');
                $('#nom_depa').val('');
                $('#usu_cargo').val('');
                $('#fileElem').val('');
                $('#fech_nac').val('');
                $('#tickd_descrip').summernote('reset');

                var enviar = $.post("../../controller/usuario.php?op=guardar_usuario", {usu_nom: nom_emp, usu_ape:ape_emp, usu_correo:correo, usu_pass:usu_cedula,usu_cargo:usu_cargo, usu_ext:usu_ext, usu_dpto:nom_depa,fech_nac:fech_nac,fech_ingreso:fech_ingreso, rol_id:rol_id, est:est}, function (data) {
                });
                enviar.done(function() {
                    $.post("../../controller/email.php?op=ticket_abierto", {tick_id : data['tick_id'], usu_correo:correo}, function (data) {
    
                    });
                    swal("Correcto!", "Registrado Correctamente", "success");
                });
                
                
            });
            
        // }
    }else{
        if($('#tick_descrip').summernote('isEmpty')){
            toastr.error("Ingrese una Descripcion","Aviso!");
                return false;
        }else if($('#tick_titulo').val()==''){
            toastr.error("Ingrese un Titulo","Aviso!");
                return false;
        }else{
            var totalfiles = $('#fileElem').val().length;
            var formData = new FormData($("#ticket_form")[0]);
            
            for (var i = 0; i < totalfiles; i++) {
                formData.append("files[]", $('#fileElem')[0].files[i]);
            }
    
    
            $.ajax({
                url: "../../controller/ticket.php?op=insert",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    data = JSON.parse(data);
                    console.log(data.tick_id);
                   $.post("../../controller/email.php?op=ticket_abierto", {tick_id : data.tick_id, correo:correo}, function (data) {
    
                    });
    
                    $('#tick_titulo').val('');
                    $('#tick_descrip').summernote('reset');
                    swal("Correcto!", "Registrado Correctamente", "success");
                }
            });
            
        }
    }
    
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
  }
init();