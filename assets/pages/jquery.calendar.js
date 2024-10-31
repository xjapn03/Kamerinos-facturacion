/**
* Theme: Highdmin - Responsive Bootstrap 4 Admin Dashboard
* Author: Coderthemes
* Component: Full-Calendar
*/


!function($) {
    "use strict";

    var CalendarApp = function() {
        this.$body = $("body")
        this.$modal = $('#event-modal'),
        this.$event = ('#external-events div.external-event'),
        this.$calendar = $('#calendar'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$categoryForm = $('#add-category form'),
        this.$saveEventBtn = $('.save-event'),
        this.$eventForm = $('#add-event form'),
        this.$extEvents = $('#external-events'),
        this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function (eventObj, date) { 
        var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
    },

        // Definición del método dentro del objeto CalendarApp
    CalendarApp.prototype.formatTimestampToDateTimeLocal = function (timestamp) {
        // Crear el objeto Date desde el timestamp (en milisegundos)
        var date = new Date(timestamp);
        
        // Obtener la fecha y hora en UTC
        var year = date.getUTCFullYear();
        var month = (date.getUTCMonth() + 1).toString().padStart(2, '0'); // Mes (0-11)
        var day = date.getUTCDate().toString().padStart(2, '0'); // Día
        var hours = date.getUTCHours().toString().padStart(2, '0'); // Horas
        var minutes = date.getUTCMinutes().toString().padStart(2, '0'); // Minutos

        // Ajustar la hora a la zona horaria local
        var localDate = new Date(year, date.getUTCMonth(), day, hours, minutes);
        
        return `${localDate.getFullYear()}-${(localDate.getMonth() + 1).toString().padStart(2, '0')}-${localDate.getDate().toString().padStart(2, '0')}T${localDate.getHours().toString().padStart(2, '0')}:${localDate.getMinutes().toString().padStart(2, '0')}`;
    },

    
    CalendarApp.prototype.modalCita = function (start, end, allDay) {
        // Elimina cualquier listener anterior para evitar duplicación
        $('#add-event').off('show.bs.modal');
    
        // Detecta cuando se abre el modal
        $('#add-event').one('show.bs.modal', function() {
            // Selecciona el formulario dentro del modal
            var $form = $('#add-event').find('form');
            
            // Cargar opciones de servicio
            CalendarApp.prototype.cargarServicios($form.find('#id_servicio'));
            // Cargar opciones de cliente
            CalendarApp.prototype.cargarClientes($form.find('#id_cliente'));
            // Cargar opciones de empleado
            CalendarApp.prototype.cargarEmpleados($form.find('#id_empleado'));
            // Cargar opciones de estado
            CalendarApp.prototype.cargarEstados($form.find('#estado'));
    
            // Establece la fecha en el campo de fecha
            $form.find('input[name="fecha_cita"]').val(start ? start.format('YYYY-MM-DDTHH:mm') : '');
    
        });
    
        // Detecta cuando se haga clic en el enlace para abrir el modal
        $('#agendar-cita').on('click', function(e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del enlace
            $('#add-event').modal('show'); // Muestra el modal
        });
    },
    
        

    /* on click on event */
    CalendarApp.prototype.onEventClick = function (calEvent, jsEvent, view) {
        var $this = this;
        var formattedDate = $this.formatTimestampToDateTimeLocal(calEvent.start); // Convertir timestamp a formato adecuado
        var form = $("<form></form>");
        form.append("<div class='row'></div>");
        form.find(".row")
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Servicio</label><select class='form-control' name='id_servicio' id='id_servicio'></select></div></div>") // Selector vacío, se llenará con cargarServicios
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Cliente</label><select class='form-control' name='id_cliente' id='id_cliente'></select></div></div>") // Selector vacío, se llenará con cargarClientes
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Empleado</label><select class='form-control' name='id_empleado' id='id_empleado'></select></div></div>") // Selector vacío, se llenará con cargarEmpleados
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Fecha</label><input class='form-control' type='datetime-local' name='fecha_cita' value='" + formattedDate + "'/></div></div>")
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Abono</label><input class='form-control' placeholder='Abono' type='number' name='abono' value='" + calEvent.abono + "'/></div></div>")
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Estado</label><select class='form-control' name='estado' id='estado'></select></div></div>") // Selector vacío, se llenará con cargarEstados
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Nota</label><textarea class='form-control' name='event_description'>" + calEvent.description + "</textarea></div></div>")
        .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Cambiar nombre del evento</label><input class='form-control' type='text' name='event_name' value='" + calEvent.title + "' /></div></div>")
        // Configurar y mostrar el modal
        $this.$modal.modal({
            backdrop: 'static'
        });

    
        // Preparar el modal con el formulario
        // Configurar y mostrar el modal
    $this.$modal.modal({
        backdrop: 'static'
    });

    // Preparar el modal con el formulario
    $this.$modal.find('.delete-event').show().end()
        .find('.save-event').text('Guardar').end()  // Cambiar texto del botón a "Guardar"
        .find('.modal-body').empty().prepend(form).end()
        .find('.delete-event').unbind('click').click(function () {
            // Solicitar la eliminación del evento al servidor
            $.ajax({
                url: '?controller=citas&method=delete', // Ruta para la eliminación
                type: 'POST',
                dataType: 'json',
                data: { id_cita: calEvent._id }, // ID del evento a eliminar
                success: function (response) {
                    if (response.success) {
                        // Eliminar el evento del calendario
                        $this.$calendarObj.fullCalendar('removeEvents', function (ev) {
                            return (ev._id == calEvent._id);
                        });
                        $this.$modal.modal('hide');
                    } else {
                        alert('Error al eliminar el evento: ' + response.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error al eliminar el evento: ", textStatus, errorThrown);
                    alert('Error al eliminar el evento. Revisa la consola para más detalles.');
                }
            });
        });

    $this.cargarServicios(calEvent.id_servicio);
    $this.cargarClientes(calEvent.id_cliente);
    $this.cargarEmpleados(calEvent.id_empleado);
    $this.cargarEstados(calEvent.estado);

    // Guardar los cambios al hacer clic en el botón "Guardar" del modal
    $this.$modal.find('.save-event').unbind('click').on('click', function () {
        var clienteText = form.find("select[name='id_cliente'] option:selected").text();
        var idServicio = form.find("select[name='id_servicio']").val(); // ID del servicio

        var eventoData = {
            servicio: idServicio, // Enviar el ID del servicio
            cliente: form.find("select[name='id_cliente']").val(),
            empleado: form.find("select[name='id_empleado']").val(),
            fecha_cita: form.find("input[name='fecha_cita']").val(),
            abono: form.find("input[name='abono']").val(),
            estado: form.find("select[name='estado']").val(),
            description: form.find("textarea[name='event_description']").val(),
            title: clienteText + ' - ' + form.find("select[name='id_servicio'] option:selected").text(), // Título actualizado
            id_evento: calEvent._id
        }

        $.ajax({
            url: '?controller=citas&method=update',
            type: 'POST',
            dataType: 'json',
            data: eventoData,
            success: function (response) {
                if (response.success) {
                    calEvent.servicio = form.find("select[name='id_servicio'] option:selected").text(); // Actualiza el texto del servicio
                    calEvent.cliente = clienteText;
                    calEvent.empleado = form.find("select[name='id_empleado'] option:selected").text();
                    calEvent.fecha_cita = eventoData.fecha_cita;
                    calEvent.abono = eventoData.abono;
                    calEvent.estado = eventoData.estado;
                    calEvent.description = eventoData.description;
                    calEvent.title = eventoData.title;

                    $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                    location.reload();
                    $this.$modal.modal('hide');
                } else {
                    alert('Error al guardar los cambios: ' + response.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al guardar el evento: ", textStatus, errorThrown);
                alert('Error al guardar el evento. Revisa la consola para más detalles.');
            }
        });
    });

    },    
        /* on select */
        CalendarApp.prototype.onSelect = function (start, end, allDay) {
            var $this = this;
            var formattedStart = $this.formatTimestampToDateTimeLocal(start);

        
            // Preparar el modal
            $this.$modal.modal({
                backdrop: 'static'
            });
        
            var form = $("<form></form>");
            form.append("<div class='row'></div>");
            
            form.find(".row")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Servicio</label><select class='form-control' name='id_servicio' id='id_servicio'></select></div></div>") // Selector vacío, se llenará con cargarServicios
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Cliente</label><select class='form-control' name='id_cliente' id='id_cliente'></select></div></div>") // Selector vacío, se llenará con cargarClientes
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Empleado</label><select class='form-control' name='id_empleado' id='id_empleado'></select></div></div>") // Selector vacío, se llenará con cargarEmpleados
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Fecha</label><input class='form-control' type='datetime-local' name='fecha_cita' value='" + formattedStart + "'/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Abono</label><input class='form-control' placeholder='Abono' type='number' name='abono' value=''/></div></div>")
                .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Estado</label><select class='form-control' name='estado' id='estado'></select></div></div>") // Selector vacío, se llenará con cargarEstados
                .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Nota</label><textarea class='form-control' name='event_description'></textarea></div></div>");
        
            // Mostrar el modal y configurar los botones
            $this.$modal.find('.delete-event').hide().end()
                .find('.save-event').text('Crear').end()  // Cambiar el texto del botón a "Crear"
                .find('.modal-body').empty().prepend(form).end()
                .find('.save-event').unbind('click').on('click', function () {
                    form.submit();
                });
        
            // Llamar a las funciones para cargar los selectores con datos del servidor
            $this.cargarServicios();
            $this.cargarClientes();
            $this.cargarEmpleados();
            $this.cargarEstados();
        
            // Cuando se envíe el formulario
            $this.$modal.find('form').on('submit', function () {
                var clienteText = form.find("select[name='id_cliente'] option:selected").text();
                var servicioText = form.find("select[name='id_servicio'] option:selected").text();
                var idServicio = form.find("select[name='id_servicio']").val(); // ID del servicio
            
                // Obtener la fecha en el formato adecuado (yyyy-mm-dd hh:mm:ss)
                var fechaCita = form.find("input[name='fecha_cita']").val();
            
                // Verifica que la fecha no esté vacía
                if (!fechaCita) {
                    alert('Por favor, selecciona una fecha para la cita.');
                    return false;
                }
            
                // Formato de los datos a enviar
                var eventoData = {
                    servicio: idServicio,
                    cliente: form.find("select[name='id_cliente']").val(),
                    empleado: form.find("select[name='id_empleado']").val(),
                    fecha_cita: fechaCita, // Fecha seleccionada
                    abono: form.find("input[name='abono']").val(),
                    estado: form.find("select[name='estado']").val(),
                    description: form.find("textarea[name='event_description']").val(),
                    title: clienteText + ' - ' + servicioText
                };
            
        
                // Enviar los datos del nuevo evento al servidor
                $.ajax({
                    url: '?controller=citas&method=create', // Ajustar según tu controlador y método de creación
                    type: 'POST',
                    dataType: 'json',
                    data: eventoData,
                    success: function (response) {
                        if (response.success) {
                            // Renderizar el nuevo evento en el calendario
                            $this.$calendarObj.fullCalendar('renderEvent', {
                                title: eventoData.title,
                                start: start,
                                end: end,
                                allDay: allDay,
                                className: '' // Puedes ajustar esto si tienes categorías de clases
                            }, true);
                            
                            $this.$modal.modal('hide');
                            location.reload();

                        } else {
                            alert('Error al crear el evento: ' + response.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error al crear el evento: ", textStatus, errorThrown);
                        alert('Error al crear el evento. Revisa la consola para más detalles.');
                    }
                });
        
                return false;
            });
        
            $this.$calendarObj.fullCalendar('unselect');
        },            //FUNCION DE ARRASTRE EN EL CALENDARIO
    CalendarApp.prototype.enableDrag = function() {
        //init events
        $(this.$event).each(function () {
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
        });
    },

    CalendarApp.prototype.fetchEvents = function (start, end, callback) {
        $.ajax({
            url: '?controller=citas&method=getAll',
            type: 'GET',
            dataType: 'json',
            success: function (response) {  
                console.log('Respuesta recibida:', response);  // Verifica la estructura de la respuesta
    
                if (response && Array.isArray(response.eventos)) {
                    // FullCalendar espera un array de eventos, no un objeto con la clave 'eventos'
                    callback(response.eventos);
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
    
    
    
    // Función para cargar los servicios con AJAX
    CalendarApp.prototype.cargarServicios = function (selectedServiceId) {
        console.log("ID del servicio seleccionado:", selectedServiceId); // Verificar el ID del servicio seleccionado
        var $this = this;
    
        // Solicitud AJAX para obtener todos los servicios
        $.ajax({
            url: '?controller=servicios&method=getAlljson', // Cambia esto según tu endpoint real
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data); // Verificar los datos que se están recibiendo
                var $select = $('#id_servicio');
                $select.empty();
    
                // Iterar sobre los servicios obtenidos y agregarlos como opciones
                $.each(data, function (index, servicio) {
                    // Agregar la opción del servicio seleccionado actualmente
                    if (servicio.id_servicio == selectedServiceId) {
                        $select.append("<option value='" + servicio.id_servicio + "' selected>" + servicio.nombre_servicio + "</option>");
                    } else {
                        $select.append("<option value='" + servicio.id_servicio + "'>" + servicio.nombre_servicio + "</option>");
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al cargar los servicios: ", textStatus, errorThrown);
                alert('Error al cargar los servicios. Revisa la consola para más detalles.');
            }
        });
    },
    
    
    // Función para cargar clientes
    CalendarApp.prototype.cargarClientes = function (selectedCliente) {
        var $this = this;
        $.ajax({
            url: '?controller=cliente&method=getAlljson',  // Asegúrate que este sea el endpoint correcto
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var $select = $('#id_cliente');
                $select.empty();
    
                // Agregar las opciones de clientes obtenidos
                $.each(data, function (index, cliente) {
                    $select.append("<option value='" + cliente.id_cliente + "' " + (cliente.id_cliente == selectedCliente ? 'selected' : '') + ">" + cliente.nombre + " " + cliente.apellido + "</option>");
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al cargar los clientes: ", textStatus, errorThrown);
                alert('Error al cargar los clientes. Revisa la consola para más detalles.');
            }
        });
    },
    
    

    // Función para cargar empleados
    CalendarApp.prototype.cargarEmpleados = function (selectedEmpleado) {   //REALIZAR LOS MISMO PARA LAS DEMAS Y GUARDAR
        var $this = this;
        $.ajax({
            url: '?controller=empleado&method=getAlljson',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var $select = $('#id_empleado');
                $select.empty();

                // Agregar las opciones de empleados obtenidos
                $.each(data, function (index, empleado) {
                    $select.append("<option value='" + empleado.id_empleado + "' " + (empleado.id_empleado == selectedEmpleado ? 'selected' : '') + ">" + empleado.nombre + " " + empleado.apellido + "</option>");
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al cargar los empleados: ", textStatus, errorThrown);
            }
        });
    },

    // Función para cargar estados
    CalendarApp.prototype.cargarEstados = function (selectedEstado) {
        var $this = this;
        $.ajax({
            url: '?controller=citas&method=getAll',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var $select = $('#estado');
                $select.empty();

                // Agregar las opciones de estados obtenidos
                // Agregar las opciones de estados obtenidos
            $.each(data.estados, function (index, estado) {
                $select.append("<option value='" + estado + "' " + (estado == selectedEstado ? 'selected' : '') + ">" + estado.charAt(0).toUpperCase() + estado.slice(1) + "</option>");
            });
        },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error al cargar los estados: ", textStatus, errorThrown);
            }
        });
    },


    /* Initializing */
    CalendarApp.prototype.init = function() {
        this.enableDrag();
        /*  Initialize the calendar  */
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var form = '';
        var today = new Date($.now());
    
        var $this = this;
        $this.$calendarObj = $this.$calendar.fullCalendar({
            slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
            minTime: '09:00:00',
            maxTime: '20:00:00',  
            defaultView: 'month',  
            handleWindowResize: true,   
            height: $(window).height(),   
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
          
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            events: function (start, end, timezone, callback) {
                $this.fetchEvents(start, end, callback);
            },
            drop: function(date) {
                $this.onDrop($(this), date);
            },
            select: function (start, end, allDay) {
                $this.onSelect(start, end, allDay);
            },
            eventClick: function(calEvent, jsEvent, view) {
                $this.onEventClick(calEvent, jsEvent, view);
            },
            eventDrop: function(event, delta, revertFunc) {
                // Cuando un evento es arrastrado, actualizar la fecha
                if (!confirm("¿Estás seguro de que quieres cambiar la fecha de este evento?")) {
                    revertFunc(); // Revertir el arrastre si se cancela la acción
                    return; // Salir si se cancela
                }
    
                // Preparar los datos para enviar al servidor
                var eventoData = {
                    id_evento: event.id, // ID del evento
                    fecha_cita: event.start.format('YYYY-MM-DD HH:mm:ss'), // Nueva fecha
                    // Puedes incluir más datos si es necesario
                };
    
                // Enviar los datos al servidor para actualizar la fecha
                $.ajax({
                    url: '?controller=citas&method=updateFecha', // Método en el controlador para actualizar la fecha
                    type: 'POST',
                    dataType: 'json',
                    data: eventoData,
                    success: function(response) {
                        if (response.success) {
                            alert('La fecha del evento ha sido actualizada.');
                        } else {
                            alert('Error al actualizar el evento: ' + response.message);
                            revertFunc(); // Revertir el cambio en caso de error
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al actualizar el evento: ", textStatus, errorThrown);
                        alert('Error al actualizar el evento. Revisa la consola para más detalles.');
                        revertFunc(); // Revertir el cambio en caso de error
                    }
                });
            }
        });
    
        //on new event
        this.$saveCategoryBtn.on('click', function(){
            var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
            var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
            if (categoryName !== null && categoryName.length != 0) {
                $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>' + categoryName + '</div>');
                $this.enableDrag();
            }
        });
        this.$saveEventBtn.on('click', function(){
            var eventName = $this.$eventForm.find("input[name='event-name']").val();
            var eventColor = $this.$eventForm.find("select[name='event-color']").val();
            if (eventName !== null && eventName.length != 0) {
                $this.$extEvents.append('<div class="external-event bg-' + eventColor + '" data-class="bg-' + eventColor + '" style="position: relative;"><i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>' + eventName + '</div>');
                $this.enableDrag();
            }
        });
    };
    
    //init CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
    
    }(window.jQuery),
    
    //initializing CalendarApp
    function($) {
        "use strict";
        $.CalendarApp.init();
    }(window.jQuery);
    