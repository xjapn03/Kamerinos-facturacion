<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Lista de Productos</h2>
<a href="?controller=productos&method=new">Nuevo Producto</a>
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
            <td><?= $producto->id_producto ?></td>
            <td><?= $producto->nombre_producto ?></td>
            <td><?= $producto->precio ?></td>
            <td><?= $producto->stock ?></td>
            <td><?= $producto->nombre_categoria ?></td>
            <td>
                <a href="?controller=productos&method=edit&id=<?= $producto->id_producto ?>">Editar</a>
                <a href="?controller=productos&method=delete&id=<?= $producto->id_producto ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>