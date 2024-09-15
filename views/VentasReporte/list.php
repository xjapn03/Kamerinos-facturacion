<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>KAMERINOS 2024</2>
    <h1>Reporte de Ventas del Día</h1><br>
    
    <p>Fecha: <?php echo date('Y-m-d'); ?></p>
    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Cliente</th>
                <th>Empleado</th>
                <th>Promocion</th>
                <th>fecha</th>
                <th>TOTAL</th>
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
                </td>    
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
