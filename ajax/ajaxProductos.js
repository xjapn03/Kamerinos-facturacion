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
    function cargarCategorias() {
        $.ajax({
            url: '?controller=categoriaProductos&method=cargarCategorias',
            type: 'GET',
            dataType: 'json',
            success: function(categorias) {
                const categoriaSelect = $('#categoria');
                categoriaSelect.empty();
                categoriaSelect.append('<option value="">Seleccione una categoría</option>');
                categorias.forEach(function(categoria) {
                    categoriaSelect.append(`<option value="${categoria.id_categoriaP}">${categoria.nombre}</option>`);
                });
            },
            error: function(xhr, status, error) {
                alert('Error al cargar las categorías: ' + error);
            }
        });
    }
});
