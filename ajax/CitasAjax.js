!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$modal = $('#event-modal'),
        this.$event = ('#external-events div.external-event'),
        this.$calendar = $('#calendar'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$categoryForm = $('#add-category form'),
        this.$extEvents = $('#external-events'),
        this.$calendarObj = null
    };

    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
        var originalEventObject = eventObj.data('eventObject');
        var $categoryClass = eventObj.attr('data-class');
        var copiedEventObject = $.extend({}, originalEventObject);
        copiedEventObject.start = date;
        if ($categoryClass)
            copiedEventObject['className'] = [$categoryClass];
        $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
        if ($('#drop-remove').is(':checked')) {
            eventObj.remove();
        }
    },

    /* on click on event */
    CalendarApp.prototype.onEventClick = function (calEvent, jsEvent, view) {
        alert('Cita: ' + calEvent.title + '\nDescripción: ' + calEvent.description);
    },

    /* on select */
    CalendarApp.prototype.onSelect = function (start, end, allDay) {
        var $this = this;
    
        // Mostrar el modal para agregar un nuevo evento
        $this.$modal.modal({
            backdrop: 'static'
        });
    
        // Crear y configurar el formulario
        var form = $("<form id='event-form'></form>");
        form.append("<div class='row'></div>");
        form.find(".row")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Servicio</label><input class='form-control' placeholder='ID Servicio' type='text' name='id_servicio'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Cliente</label><input class='form-control' placeholder='ID Cliente' type='text' name='id_cliente'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Promoción</label><input class='form-control' placeholder='ID Promoción' type='text' name='id_promocion'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Empleado</label><input class='form-control' placeholder='ID Empleado' type='text' name='id_empleado'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Fecha</label><input class='form-control' type='datetime-local' name='fecha_cita'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Abono</label><input class='form-control' placeholder='Abono' type='number' name='abono'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Estado</label><input class='form-control' placeholder='Estado' type='text' name='estado'/></div></div>")
            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Nota</label><textarea class='form-control' placeholder='Nota' name='nota'></textarea></div></div>");
    
        // Configurar el modal
        $this.$modal.find('.delete-event').hide()
            .end().find('.save-event').show()
            .end().find('.modal-body').empty().prepend(form)
            .end().find('.save-event').unbind('click').click(function () {
                form.submit();
            });
    
        // Manejar el envío del formulario
        $this.$modal.find('form').on('submit', function (e) {
            e.preventDefault(); // Prevenir el comportamiento por defecto del formulario
    
            var formData = $(this).serialize(); // Obtener todos los datos del formulario
    
            $.ajax({
                url: '?controller=citas&method=save',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $this.$calendar.fullCalendar('refetchEvents');
                        $this.$modal.modal('hide');
                    } else {
                        alert('Error al guardar la cita.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error al guardar la cita: ", textStatus, errorThrown);
                    alert('Error en la solicitud AJAX.');
                }
            });
        });
    
        // Deseleccionar el calendario
        $this.$calendarObj.fullCalendar('unselect');
    },
    
    /* Fetch events from server */
    CalendarApp.prototype.fetchEvents = function (start, end, callback) {
        $.ajax({
            url: '?controller=citas&method=getAll',
            type: 'GET',
            dataType: 'json',
            success: function (response) {  
                if (Array.isArray(response)) {
                    callback(response);
                } else {
                    console.error('Formato de respuesta inesperado:', response);
                    alert('Error: Formato de respuesta inesperado.');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error: ", textStatus, errorThrown);
                console.error("Respuesta del servidor: ", jqXHR.responseText);
                alert('Error al cargar las citas. Revisa la consola para más detalles.');
            }
        });
    },

    /* Initializing */
    CalendarApp.prototype.init = function() {
        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00',
            minTime: '08:00:00',
            maxTime: '19:00:00',
            defaultView: 'month',
            handleWindowResize: true,
            height: $(window).height() - 200,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true,
            eventLimit: true,
            selectable: true,
            events: function (start, end, timezone, callback) {
                $this.fetchEvents(start, end, callback);
            },
            drop: function (date) { $this.onDrop($(this), date); },
            select: function (start, end, allDay) { $this.onSelect(start, end, allDay); },
            eventClick: function (calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }
        });

        // on new event
        this.$saveCategoryBtn.on('click', function() {
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>' + categoryName + '</div>')
                $this.enableDrag();
            }
        });
    },
    

   //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
}(window.jQuery),

//initializing CalendarApp
function($) {
    "use strict";
    $.CalendarApp.init()
}(window.jQuery);

