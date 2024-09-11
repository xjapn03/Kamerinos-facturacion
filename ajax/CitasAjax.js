$(document).ready(function () {
    // Inicializa el calendario
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: '?controller=citas&method=getAll',
                type: 'GET',
                dataType: 'json',
                success: function (response) {  
                    // Verifica si la respuesta es un array de eventos
                    if (Array.isArray(response)) {
                        callback(response);
                    } else {
                        console.error('Formato de respuesta inesperado:', response);
                        alert('Error: Formato de respuesta inesperado.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error: ", textStatus, errorThrown);
                    console.error("Respuesta del servidor: ", jqXHR.responseText); // Registra el contenido JSON recibido
                    alert('Error al cargar las citas. Revisa la consola para más detalles.');
                }
            });
        },
        eventClick: function (event) {
            alert('Cita: ' + event.title + '\nDescripción: ' + event.description);
        }
    });

    // Guardar una nueva cita
    $('#save-event').on('click', function () {
        var formData = $('#event-form').serialize();
        $.ajax({
            url: '?controller=citas&method=save',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Cita guardada con éxito');
                    $('#calendar').fullCalendar('refetchEvents');
                } else {
                    alert('Error al guardar la cita.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al guardar la cita: ", textStatus, errorThrown);
                console.error("Respuesta del servidor: ", jqXHR.responseText);
                alert('Error en la solicitud AJAX.');
            }
        });
    });

    // Eliminar una cita
    $(document).on('click', '.delete-event', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '?controller=citas&method=delete',
            type: 'POST',
            data: { id_cita: id },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert('Cita eliminada con éxito');
                    $('#calendar').fullCalendar('refetchEvents');
                } else {
                    alert('Error al eliminar la cita.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al eliminar la cita: ", textStatus, errorThrown);
                console.error("Respuesta del servidor: ", jqXHR.responseText);
                alert('Error en la solicitud AJAX.');
            }
        });
    });
});
