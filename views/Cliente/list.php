<!-- list.php -->
<br>
<br>
<br>
<br><br><br><br><br><br><br>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
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
    <h2>Lista de Clientes</h2>
    <a href="?controller=cliente&method=new" class="btn-nuevo">Nuevo Cliente</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                        <td><?= htmlspecialchars($cliente['apellido']) ?></td>
                        <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                        <td><?= htmlspecialchars($cliente['email']) ?></td>
                        <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                        <td><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($cliente['fecha_registro']) ?></td>
                        <td>
                            <a href="?controller=cliente&method=edit&id=<?= urlencode($cliente['id_cliente']) ?>" class="btn-editar">Editar</a>
                            <a href="?controller=cliente&method=delete&id=<?= urlencode($cliente['id_cliente']) ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No hay clientes registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
