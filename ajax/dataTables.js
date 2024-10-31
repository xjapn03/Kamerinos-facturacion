$(document).ready(function () {

    // Default Datatable
    $('#datatable').DataTable();

    // Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf']
    });

    // Key Tables
    $('#key-table').DataTable({
        keys: true
    });

    // Responsive Datatable
    $('#responsive-datatable').DataTable();

    // Multi Selection Datatable
    $('#selection-datatable').DataTable({
        select: {
            style: 'multi'
        }
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


    var d = new Date(Date.now()); // Tomamos la fecha del navegador

    function updateClock() {
        // Incrementar el tiempo
        d.setTime(d.getTime() + 1000);

        // Obtener las horas, minutos y segundos
        var currentHours = d.getHours();
        var currentMinutes = d.getMinutes();
        var currentSeconds = d.getSeconds();

        // Añadir ceros iniciales si es necesario
        currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
        currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

        // Determinar AM/PM
        var meridian = (currentHours < 12) ? "am" : "pm";

        // Convertir a formato de 12 horas
        currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
        currentHours = (currentHours == 0) ? 12 : currentHours;

        // Cadena final de la hora actual
        var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + meridian;

        // Actualizar la hora en el elemento con id="clock"
        document.getElementById("clock").textContent = currentTimeString;
    }

    window.onload = function () {
        updateClock();
        setInterval(updateClock, 1000);
    };



});
