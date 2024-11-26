$(document).ready(function() {
    // Cargar categorías al abrir el modal
    $('#modalNuevoProducto').on('shown.bs.modal', function() {
        cargarCategorias();
    });

    // Manejo del envío del formulario dentro del modal
    $('#formNuevoProducto').on('submit', function(e) {
        e.preventDefault();
        guardarProducto();
    });

    // Abrir modal de edición y cargar los datos del Producto
    $(document).on('click', '.btn-editar-Producto', function() {
        const idProducto = $(this).data('id'); // Obtener el ID del Producto
        cargarDatosProducto(idProducto); // Cargar los datos del Producto
        $('#modalEditarProducto').modal('show'); // Mostrar el modal de edición
    });

    // Manejo del envío del formulario dentro del modal de edición
    $('#formEditarProducto').on('submit', function(e) {
        e.preventDefault();
        actualizarProducto();
    });

    // Función para guardar el Producto con AJAX
    function guardarProducto() {
        const data = $('#formNuevoProducto').serialize(); 
        $.ajax({
            url: '?controller=Productos&method=save',
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Producto guardado exitosamente.');
                $('#modalNuevoProducto').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página
            },
            error: function(xhr, status, error) {
                alert('Error al guardar el Producto: ' + error);
            }
        });
    }

    function cargarCategorias(categoriaSeleccionada = null, selectId = '#categoria') {
        $.ajax({
            url: '?controller=categoriaProductos&method=cargarCategorias',
            type: 'GET',
            dataType: 'json',
            success: function(categorias) {
                const categoriaSelect = $(selectId);
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>'); // Default
        
                categorias.forEach(function(categoria) {
                    const selected = categoria.id_categoriaP == categoriaSeleccionada ? 'selected' : ''; // Selección
                    categoriaSelect.append(`<option value="${categoria.id_categoriaP}" ${selected}>${categoria.nombre}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar las categorías:', error);
                alert('No se pudieron cargar las categorías.');
            }
        });
    }
     
    

// Función para cargar datos del Producto en el modal de edición
function cargarDatosProducto(idProducto) {
    $.ajax({
        url: `?controller=Productos&method=edit&id=${idProducto}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);  // Para depuración

            if (response.producto && response.categorias) {
                $('#formEditarProducto #nombre').val(response.producto.nombre_producto);
                $('#formEditarProducto #precio').val(response.producto.precio);
                $('#formEditarProducto #stock').val(response.producto.stock);
            
                // Cargar el select de categorías con las categorías obtenidas en la respuesta
                const categoriaSelect = $('#formEditarProducto #categoria');
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>'); // Opción predeterminada
            
                // Llenamos el select con las categorías y seleccionamos la categoría actual del Producto
                response.categorias.forEach(function(categoria) {
                    // Log para depuración de valores
                    console.log(`Categoria ID: ${categoria.id_categoriaP}, Producto Categoria ID: ${response.producto.fk_categorias_productos}`);
            
                    // Aseguramos que los valores sean números y comparamos correctamente
                    const selected = (parseInt(categoria.id_categoriaP) === parseInt(response.producto.fk_categorias_productos)) ? 'selected' : '';
                    
                    categoriaSelect.append(`<option value="${categoria.id_categoriaP}" ${selected}>${categoria.nombre}</option>`);
                });
            } else {
                console.error('Error: Datos del Producto o categorías no encontrados en la respuesta.');
                alert('No se pudieron cargar los datos del Producto.');
            }
            
            
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar los datos del Producto:', error);
            alert('Error al cargar los datos del Producto.');
        }
    });
}





$('#modalEditarProducto').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget); // El botón que activó el modal
    const idProducto = button.data('id'); // Obtener el ID del producto

    // Asignar valores del botón a los inputs
    $(this).find('#id_producto').val(idProducto);
    $(this).find('#nombre').val(button.data('nombre'));
    $(this).find('#precio').val(button.data('precio'));
    $(this).find('#stock').val(button.data('stock'));

    // Cargar categorías y seleccionar la categoría del producto
    const idCategoria = button.data('categoria');
    cargarCategorias(idCategoria, '#categoriaEditar'); // Usar la función de categorías
});



    // Función para actualizar el Producto con AJAX
    function actualizarProducto() {
        const data = $('#formEditarProducto').serialize(); // Serializar datos del formulario
        $.ajax({
            url: '?controller=Productos&method=update', // URL para actualizar el Producto
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Producto actualizado exitosamente.');
                $('#modalEditarProducto').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página para ver los cambios
            },
            error: function(xhr, status, error) {
                alert('Error al actualizar el Producto: ' + error);
            }
        });
    }

});
