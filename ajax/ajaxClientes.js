$(document).ready(function () {
    // Manejo del envío del formulario para crear un cliente
    $('#formNuevoCliente').on('submit', function (e) {
        e.preventDefault();
        guardarCliente();
    });

    // Abrir modal de edición y cargar los datos del cliente
    $(document).on('click', '.btn-editar-cliente', function () {
        const idCliente = $(this).data('id'); // Obtener el ID del cliente
        $.ajax({
            url: `?controller=cliente&method=edit&id=${idCliente}`,
            type: 'GET',
            dataType: 'json',
            success: function (cliente) {
                if (cliente) {
                    $('#formEditarCliente #id_cliente').val(cliente.id_cliente);
                    $('#formEditarCliente #nombre').val(cliente.nombre);
                    $('#formEditarCliente #apellido').val(cliente.apellido);
                    $('#formEditarCliente #telefono').val(cliente.telefono);
                    $('#formEditarCliente #email').val(cliente.email);
                    $('#formEditarCliente #direccion').val(cliente.direccion);
                    $('#formEditarCliente #fechaNacimiento').val(cliente.fecha_nacimiento);
    
                    // Mostrar el modal
                    $('#modalEditarCliente').modal('show');
                } else {
                    alert('No se pudieron cargar los datos del cliente.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar los datos del cliente:', error);
                alert('Error al cargar los datos del cliente.');
            }
        });
    });
    
    

    // Manejo del envío del formulario para editar un cliente
    $('#formEditarCliente').on('submit', function (e) {
        e.preventDefault();
        actualizarCliente();
    });

    // Función para guardar un cliente
    function guardarCliente() {
        const data = $('#formNuevoCliente').serialize();
        $.ajax({
            url: '?controller=cliente&method=save',
            type: 'POST',
            data: data,
            success: function (response) {
                alert('Cliente guardado exitosamente.');
                $('#modalNuevoCliente').modal('hide'); // Cierra el modal
                location.reload(); // Recarga la página para ver los cambios
            },
            error: function (xhr, status, error) {
                console.error('Error al guardar el cliente:', error);
                alert('Error al guardar el cliente.');
            }
        });
    }

    // Función para cargar datos del cliente en el modal de edición
    function cargarDatosCliente(idCliente) {
        $.ajax({
            url: `?controller=cliente&method=edit&id=${idCliente}`,
            type: 'GET',
            dataType: 'json',
            success: function (cliente) {
                if (cliente) {
                    $('#formEditarCliente #id_cliente').val(cliente.id_cliente);
                    $('#formEditarCliente #nombre').val(cliente.nombre);
                    $('#formEditarCliente #apellido').val(cliente.apellido);
                    $('#formEditarCliente #telefono').val(cliente.telefono);
                    $('#formEditarCliente #email').val(cliente.email);
                    $('#formEditarCliente #direccion').val(cliente.direccion);
                    $('#formEditarCliente #fecha_nacimiento').val(cliente.fecha_nacimiento);
                    $('#formEditarCliente #fecha_registro').val(cliente.fecha_registro); // Asignar la fecha de registro
                } else {
                    console.error('Error: Datos del cliente no encontrados en la respuesta.');
                    alert('No se pudieron cargar los datos del cliente.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar los datos del cliente:', error);
                alert('Error al cargar los datos del cliente.');
            }
        });
    }

    // Función para actualizar un cliente
    function actualizarCliente() {
        const data = $('#formEditarCliente').serialize();
        $.ajax({
            url: '?controller=cliente&method=update',
            type: 'POST',
            data: data,
            success: function (response) {
                alert('Cliente actualizado exitosamente.');
                $('#modalEditarCliente').modal('hide'); // Cierra el modal
                location.reload(); // Recarga la página para ver los cambios
            },
            error: function (xhr, status, error) {
                console.error('Error al actualizar el cliente:', error);
                alert('Error al actualizar el cliente.');
            }
        });
    }

    // Evento para limpiar los formularios al cerrar los modales
    $('#modalNuevoCliente, #modalEditarCliente').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    });
});
