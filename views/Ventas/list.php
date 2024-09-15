<br>
<br>
<br>
<br><br><br><br><br><br><br>

<div class="container mt-5">
        <h2 class="mb-4">Listado de Ventas</h2>
        <a href="?controller=ventas&method=new" class="btn btn-primary mb-3">Nueva Venta</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>ID Cliente</th>
                    <th>ID Empleado</th>
                    <th>ID Promoción</th>
                    <th>Fecha de Generación</th>
                    <th>Monto Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                        <td><?php echo htmlspecialchars($venta['nombre_cliente']); ?></td>
                        <td><?php echo htmlspecialchars($venta['nombre_empleado']); ?></td>
                        <td><?php echo htmlspecialchars($venta['id_promocion']); ?></td>
                        <td><?php echo htmlspecialchars($venta['fecha_generacion']); ?></td>
                        <td><?php echo htmlspecialchars($venta['monto_total']); ?></td>
                        <td>
                            <a href="?controller=ventas&method=edit&id=<?php echo $venta['id_venta']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?controller=ventas&method=delete&id=<?php echo $venta['id_venta']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta venta?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>