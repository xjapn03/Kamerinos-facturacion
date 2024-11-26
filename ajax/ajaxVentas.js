document.addEventListener('DOMContentLoaded', function() {
    // Inicialización de Selects
    cargarEmpleados();
    cargarClientes();

    // Función para cargar empleados
    function cargarEmpleados() {
        fetch('?controller=empleados&method=getAll')
            .then(response => response.json())
            .then(data => {
                const empleadoSelect = document.getElementById('empleado');
                data.empleados.forEach(empleado => {
                    const option = document.createElement('option');
                    option.value = empleado.id_empleado;
                    option.text = empleado.nombre;
                    empleadoSelect.appendChild(option);
                });
            });
    }

    // Función para cargar clientes
    function cargarClientes() {
        fetch('?controller=clientes&method=getAll')
            .then(response => response.json())
            .then(data => {
                const clienteSelect = document.getElementById('cliente');
                data.clientes.forEach(cliente => {
                    const option = document.createElement('option');
                    option.value = cliente.id_cliente;
                    option.text = cliente.nombre;
                    clienteSelect.appendChild(option);
                });
            });
    }

    // Función para cargar productos y servicios
    function cargarItems() {
        Promise.all([
            fetch('?controller=productos&method=getAll').then(res => res.json()),
            fetch('?controller=servicios&method=getAll').then(res => res.json())
        ]).then(([productosData, serviciosData]) => {
            const itemsDiv = document.getElementById('items');
            productosData.productos.forEach(producto => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('item');
                itemDiv.innerHTML = `
                    <select name="id_producto">
                        <option value="${producto.id_producto}">${producto.nombre}</option>
                    </select>
                    <input type="number" name="cantidad" placeholder="Cantidad" required>
                    <input type="number" name="precio_unitario" value="${producto.precio}" placeholder="Precio Unitario" readonly>
                    <input type="number" name="total_item" readonly>
                    <button type="button" class="remove-item">Eliminar</button>
                `;
                itemsDiv.appendChild(itemDiv);
            });

            serviciosData.servicios.forEach(servicio => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('item');
                itemDiv.innerHTML = `
                    <select name="id_servicio">
                        <option value="${servicio.id_servicio}">${servicio.nombre}</option>
                    </select>
                    <input type="number" name="cantidad" placeholder="Cantidad" required>
                    <input type="number" name="precio_unitario" value="${servicio.precio}" placeholder="Precio Unitario" readonly>
                    <input type="number" name="total_item" readonly>
                    <button type="button" class="remove-item">Eliminar</button>
                `;
                itemsDiv.appendChild(itemDiv);
            });

            // Función para eliminar ítems
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.item').remove();
                    calcularTotales();
                });
            });

            // Función para calcular totales
            itemsDiv.addEventListener('input', calcularTotales);
        });
    }

    // Calcular los totales
    function calcularTotales() {
        let total = 0;
        let totalEmpleado = 0;

        document.querySelectorAll('#items .item').forEach(item => {
            const cantidad = item.querySelector('[name="cantidad"]').value;
            const precioUnitario = item.querySelector('[name="precio_unitario"]').value;
            const totalItem = cantidad * precioUnitario;
            item.querySelector('[name="total_item"]').value = totalItem;

            const idProducto = item.querySelector('[name="id_producto"]') ? item.querySelector('[name="id_producto"]').value : null;
            const idServicio = item.querySelector('[name="id_servicio"]') ? item.querySelector('[name="id_servicio"]').value : null;

            // Obtener comisión del producto o servicio
            let porcentajeComision = 0;
            if (idProducto) {
                porcentajeComision = obtenerComisionProducto(idProducto);
            } else if (idServicio) {
                porcentajeComision = obtenerComisionServicio(idServicio);
            }

            // Calcular total
            total += totalItem;
            totalEmpleado += totalItem * (porcentajeComision / 100);
        });

        const gananciaTotal = total - totalEmpleado;

        // Actualizar los totales en el formulario
        document.getElementById('total').value = total;
        document.getElementById('total_empleado').value = totalEmpleado;
        document.getElementById('ganancia_total').value = gananciaTotal;
    }

    // Funciones para obtener la comisión de un producto o servicio
    function obtenerComisionProducto(idProducto) {
        // Aquí deberías hacer la consulta al backend para obtener el porcentaje de comisión del producto
        // En este ejemplo está hardcodeado, pero en tu proyecto debes traerlo del servidor
        return 10; // Ejemplo de porcentaje de comisión para productos
    }

    function obtenerComisionServicio(idServicio) {
        // Aquí deberías hacer la consulta al backend para obtener el porcentaje de comisión del servicio
        // En este ejemplo está hardcodeado, pero en tu proyecto debes traerlo del servidor
        return 15; // Ejemplo de porcentaje de comisión para servicios
    }

    // Al abrir el modal, cargar los productos y servicios
    cargarItems();

    // Enviar el formulario
    document.querySelector('#formVenta').addEventListener('submit', function(e) {
        e.preventDefault();

        const empleado = document.querySelector('#empleado').value;
        const cliente = document.querySelector('#cliente').value;
        const items = [...document.querySelectorAll('#items .item')].map(item => ({
            id_servicio: item.querySelector('[name="id_servicio"]').value || null,
            id_producto: item.querySelector('[name="id_producto"]').value || null,
            cantidad: item.querySelector('[name="cantidad"]').value,
            precio_unitario: item.querySelector('[name="precio_unitario"]').value
        }));

        fetch('?controller=ventas&method=registrarVenta', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id_empleado: empleado, id_cliente: cliente, items })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  alert('Venta registrada exitosamente.');
              } else {
                  alert('Error: ' + data.message);
              }
          });
    });
});
