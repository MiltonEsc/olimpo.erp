$(document).ready(function() {
    $('#user_info').hide();

    let dataTable = $('#user_data').DataTable({
        search: {
            regex: true
        }
    });

    $('#user_filter').on('submit', function(e) {
        e.preventDefault();
        let selectedDepartment = $('#dep_id').val();
        dataTable.column(3).search("^" + selectedDepartment + "$", true, false, true).draw();
    });

    $('#user_data tbody').on('click', 'td.selectable-id', function() {
        $('#user_info').show();
        let selectedId = $(this).data('id'); // Obtener el ID seleccionado

        $('#title-moduls').text('Módulos de: ' + selectedId);
        // Hacer una solicitud Fetch para obtener datos de departamentos
    });

    fetch('../../controller/permisosRolesController/permisos_roles_controller.php/mostrarDepartamentos',{
        method: 'POST',
        headers: {
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta de la solicitud Fetch
        console.log(data);
        if (data && !data.error) {
            $('#dep_id').empty(); // Limpia la lista desplegable
            data.forEach(departamento => {
                $('#dep_id').append($('<option>', {
                    value: departamento.id,
                    text: departamento.nombre
                }));
            });
        } else {
            // Manejar errores, como "No se encontraron departamentos"
            console.error('Error al obtener datos de departamentos:', data.error);
        }
    })
    .catch(error => {
        console.error('Error en la solicitud Fetch:', error);
    });
});
