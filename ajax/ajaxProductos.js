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

    // Abrir modal de edición y cargar los datos del producto
    $(document).on('click', '.btn-editar-producto', function() {
        const idProducto = $(this).data('id'); // Obtener el ID del producto
        cargarDatosProducto(idProducto); // Cargar los datos del producto
        $('#modalEditarProducto').modal('show'); // Mostrar el modal de edición
    });

    // Manejo del envío del formulario dentro del modal de edición
    $('#formEditarProducto').on('submit', function(e) {
        e.preventDefault();
        actualizarProducto();
    });

    // Función para guardar el producto con AJAX
    function guardarProducto() {
        const data = $('#formNuevoProducto').serialize(); 
        $.ajax({
            url: '?controller=productos&method=save',
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Producto guardado exitosamente.');
                $('#modalNuevoProducto').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página
            },
            error: function(xhr, status, error) {
                alert('Error al guardar el producto: ' + error);
            }
        });
    }

    // Función para cargar las categorías en el select del formulario
    function cargarCategorias(categoriaSeleccionada = null, selectId = '#categoria') {
        $.ajax({
            url: '?controller=categoriaProductos&method=cargarCategorias',
            type: 'GET',
            dataType: 'json',
            success: function(categorias) {
                const categoriaSelect = $(selectId);
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>');
                categorias.forEach(function(categoria) {
                    const selected = categoria.id_categoriaP == categoriaSeleccionada ? 'selected' : '';
                    categoriaSelect.append(`<option value="${categoria.id_categoriaP}" ${selected}>${categoria.nombre}</option>`);
                });
            },
            error: function(xhr, status, error) {
                alert('Error al cargar las categorías: ' + error);
            }
        });
    }

// Función para cargar datos del producto en el modal de edición
function cargarDatosProducto(idProducto) {
    $.ajax({
        url: `?controller=productos&method=edit&id=${idProducto}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Verificar si la respuesta tiene datos de producto y categorías
            if (response.producto && response.categorias) {
                // Llenar los campos del formulario de edición
                $('#formEditarProducto #nombre').val(response.producto.nombre_producto);
                $('#formEditarProducto #precio').val(response.producto.precio);
                $('#formEditarProducto #stock').val(response.producto.stock);

                // Llenar el select de categorías con las categorías en la respuesta
                const categoriaSelect = $('#formEditarProducto #categoria');
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>');
                
                response.categorias.forEach(function(categoria) {
                    const selected = categoria.id_categoriaP == response.producto.fk_categorias_productos ? 'selected' : '';
                    categoriaSelect.append(`<option value="${categoria.id_categoriaP}" ${selected}>${categoria.nombre}</option>`);
                });
            } else {
                console.error('Error: Datos del producto o categorías no encontrados en la respuesta.');
                alert('No se pudieron cargar los datos del producto. Verifica la consola para más detalles.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error al cargar los datos del producto:', error);
            alert('Error al cargar los datos del producto. Revisa la consola para más detalles.');
        }
    });
}


    // Función para actualizar el producto con AJAX
    function actualizarProducto() {
        const data = $('#formEditarProducto').serialize(); // Serializar datos del formulario
        $.ajax({
            url: '?controller=productos&method=update', // URL para actualizar el producto
            type: 'POST',
            data: data,
            success: function(response) {
                alert('Producto actualizado exitosamente.');
                $('#modalEditarProducto').modal('hide'); // Cerrar el modal
                location.reload(); // Recargar la página para ver los cambios
            },
            error: function(xhr, status, error) {
                alert('Error al actualizar el producto: ' + error);
            }
        });
    }

});
