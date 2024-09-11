<br>
<br>
<br>
<br><br><br><br><br><br><br>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        .btn-nuevo {
            display: inline-block;
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn-nuevo:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-editar {
            color: #007bff;
        }
        .btn-eliminar {
            color: #dc3545;
        }
        .btn-eliminar:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead tr {
            background-color: #f2f2f2;
            text-align: left;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Lista de Servicios</h2>
    <a href="?controller=servicios&method=new" class="btn-nuevo">Nuevo Servicio</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Duracion</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($servicios as $servicio): ?>
            <tr>
                <td><?= htmlspecialchars($servicio->id_servicio) ?></td>
                <td><?= htmlspecialchars($servicio->nombre_servicio) ?></td>
                <td>$<?= number_format($servicio->precio, 2) ?></td>
                <td><?= htmlspecialchars($servicio->duracion) ?></td>
                <td><?= htmlspecialchars($servicio->descripcion) ?></td>
                <td><?= htmlspecialchars($servicio->nombre_categoria) ?></td>
                <td>
                    <a href="?controller=servicios&method=edit&id=<?= htmlspecialchars($servicio->id_servicio) ?>" class="btn-editar">Editar</a>
                    <a href="?controller=servicios&method=delete&id=<?= htmlspecialchars($servicio->id_servicio) ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este servicio?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

