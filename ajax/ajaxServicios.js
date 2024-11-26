$(document).ready(function() {
    // Cargar categorías al abrir el modal
    $('#modalNuevoServicio').on('shown.bs.modal', function() {
        cargarCategorias();
    });

    // Manejo del envío del formulario dentro del modal
    $('#formNuevoServicio').on('submit', function(e) {
        e.preventDefault();
        guardarServicio();
    });

    // Abrir modal de edición y cargar los datos del Servicio
    $(document).on('click', '.btn-editar-Servicio', function() {
        const idServicio = $(this).data('id'); // Obtener el ID del Servicio
        cargarDatosServicio(idServicio); // Cargar los datos del Servicio
        $('#modalEditarServicio').modal('show'); // Mostrar el modal de edición
    });

    // Manejo del envío del formulario dentro del modal de edición
    $('#formEditarServicio').on('submit', function(e) {
        e.preventDefault();
        actualizarServicio();
    });

    // Función para guardar el Servicio con AJAX
    function guardarServicio() {
        const data = $('#formNuevoServicio').serialize(); 
        $.ajax({
            url: '?controller=servicios&method=save',
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Servicio guardado exitosamente.');
                $('#modalNuevoServicio').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página
            },
            error: function(xhr, status, error) {
                alert('Error al guardar el Servicio: ' + error);
            }
        });
    }

    function cargarCategorias(categoriaSeleccionada = null, selectId = '#categoria') {
        $.ajax({
            url: '?controller=categoriaServicios&method=cargarCategorias',
            type: 'GET',
            dataType: 'json',
            success: function(categorias) {
                const categoriaSelect = $(selectId);
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>'); // Opcional: agregamos una opción predeterminada
    
                categorias.forEach(function(categoria) {
                    const selected = categoria.id_categoriaS == categoriaSeleccionada ? 'selected' : ''; // Verificamos si la categoría es la seleccionada
                    categoriaSelect.append(`<option value="${categoria.id_categoriaS}" ${selected}>${categoria.nombre}</option>`);
                });
            },
            error: function(xhr, status, error) {
                alert('Error al cargar las categorías: ' + error);
            }
        });
    }    
    

// Función para cargar datos del Servicio en el modal de edición
function cargarDatosServicio(idServicio) {
    $.ajax({
        url: `?controller=Servicios&method=edit&id=${idServicio}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.Servicio && response.categorias) {
                $('#formEditarServicio #nombre').val(response.Servicio.nombre_Servicio);
                $('#formEditarServicio #precio').val(response.Servicio.precio);
                $('#formEditarServicio #duracion').val(response.Servicio.duracion);

                // Cargar el select de categorías con las categorías obtenidas en la respuesta
                const categoriaSelect = $('#formEditarServicio #categoria');
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>'); // Opción predeterminada

                // Llenamos el select con las categorías y seleccionamos la categoría actual del servicio
                response.categorias.forEach(function(categoria) {
                    const selected = categoria.id_categoriaS == response.Servicio.fk_categorias_servicios ? 'selected' : ''; // Verificamos si coincide con la categoría del servicio
                    categoriaSelect.append(`<option value="${categoria.id_categoriaS}" ${selected}>${categoria.nombre}</option>`);
                });
            } else {
                console.error('Error: Datos del Servicio o categorías no encontrados en la respuesta.');
                alert('No se pudieron cargar los datos del Servicio.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar los datos del Servicio:', error);
            alert('Error al cargar los datos del Servicio.');
        }
    });
}


$('#modalEditarServicio').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // El botón que abre el modal
    var id = button.data('id'); // Extrae la ID del servicio
    var nombre = button.data('nombre');
    var precio = button.data('precio');
    var duracion = button.data('duracion');
    var categoria = button.data('categoria'); // El id de la categoría
    var descripcion = button.data('descripcion');

    var modal = $(this);

    // Asignamos los valores al modal
    modal.find('#id_servicio').val(id);
    modal.find('#nombre').val(nombre);
    modal.find('#precio').val(precio);
    modal.find('#duracion').val(duracion);
    modal.find('#descripcion').val(descripcion);

    // Llamamos a la función para cargar las categorías y seleccionar la categoría del servicio
    cargarCategorias(categoria, '#categoriaEditar'); // Pasamos el id de la categoría y el id del select
});




    // Función para actualizar el Servicio con AJAX
    function actualizarServicio() {
        const data = $('#formEditarServicio').serialize(); // Serializar datos del formulario
        $.ajax({
            url: '?controller=Servicios&method=update', // URL para actualizar el Servicio
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Servicio actualizado exitosamente.');
                $('#modalEditarServicio').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página para ver los cambios
            },
            error: function(xhr, status, error) {
                alert('Error al actualizar el Servicio: ' + error);
            }
        });
    }

});
