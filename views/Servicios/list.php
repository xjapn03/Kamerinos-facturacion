<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Lista de Servicios</h2>
<a href="?controller=servicios&method=new">Nuevo Servicio</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($servicios as $servicio): ?>
        <tr>
            <td><?= $servicio->id_servicio ?></td>
            <td><?= $servicio->nombre_servicio ?></td>
            <td><?= $servicio->precio ?></td>
            <td><?= $servicio->descripcion ?></td>
            <td><?= $servicio->nombre_categoria ?></td>
            <td>
                <a href="?controller=servicios&method=edit&id=<?= $servicio->id_servicio ?>">Editar</a>
                <a href="?controller=servicios&method=delete&id=<?= $servicio->id_servicio ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>