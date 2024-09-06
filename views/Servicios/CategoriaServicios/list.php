<h2>Lista de Categorías</h2>
<a href="?controller=categoriaServicios&method=new">Nueva Categoría</a>
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
            <td><?= $categoria->id_categoriaS ?></td>
            <td><?= $categoria->nombre_categoria ?></td>
            <td>
                <a href="?controller=categoriaServicios&method=edit&id=<?= $categoria->id_categoriaS ?>">Editar</a>
                <a href="?controller=categoriaServicios&method=delete&id=<?= $categoria->id_categoriaS ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
