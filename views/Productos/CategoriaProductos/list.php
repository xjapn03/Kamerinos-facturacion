<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Lista de Categorías</h2>
<a href="?controller=categoriaProductos&method=new">Nueva Categoría</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categorias as $categoria): ?>
        <tr>
            <td><?= $categoria->id_categoriaP ?></td>
            <td><?= $categoria->nombre ?></td>
            <td>
                <a href="?controller=categoriaProductos&method=edit&id=<?= $categoria->id_categoriaP ?>">Editar</a>
                <a href="?controller=categoriaProductos&method=delete&id=<?= $categoria->id_categoriaP ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
