<!-- EmpleadoList.php -->
<br>
<br>
<br>
<br><br><br><br><br><br><br>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
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
    </style>
</head>
<body>
    <h2>Lista de Empleados</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['nombre']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['nombre_rol']) ?></td>
                        <td>
                            <a href="?controller=empleado&method=edit&id=<?= urlencode($user['id_empleado']) ?>" class="btn-editar">Editar</a>
                            <a href="?controller=empleado&method=delete&id=<?= urlencode($user['id_empleado']) ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay empleados registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
