<br>
<br>
<br>
<br><br><br><br><br><br>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        a {
            text-decoration: none;
        }
        .btn-nuevo {
            display: inline-block;
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
        }
        .btn-editar {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-eliminar {
            color: #dc3545;
            text-decoration: none;
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
    <h2>Lista de Productos</h2>
    <a href="?controller=productos&method=new" class="btn-nuevo">Nuevo Producto</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto): ?>
            <tr>
                <td><?= htmlspecialchars($producto->id_producto) ?></td>
                <td><?= htmlspecialchars($producto->nombre_producto) ?></td>
                <td>$<?= number_format($producto->precio, 2) ?></td>
                <td><?= htmlspecialchars($producto->stock) ?></td>
                <td><?= htmlspecialchars($producto->nombre_categoria) ?></td>
                <td>
                    <a href="?controller=productos&method=edit&id=<?= htmlspecialchars($producto->id_producto) ?>" class="btn-editar">Editar</a>
                    <a href="?controller=productos&method=delete&id=<?= htmlspecialchars($producto->id_producto) ?>" class="btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
