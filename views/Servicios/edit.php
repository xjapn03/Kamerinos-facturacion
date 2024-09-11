<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>
<h2>Editar Servicio</h2>
<form action="?controller=servicio&method=update" method="POST">
    <input type="hidden" name="id_servicio" value="<?= $servicio->id_servicio ?>">

    <label for="nombre_servicio">Nombre:</label>
    <input type="text" name="nombre_servicio" value="<?= $servicio->nombre_servicio ?>" required>
    
    <label for="precio">Precio:</label>
    <input type="number" name="precio" value="<?= $servicio->precio ?>" required>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required><?= $servicio->descripcion ?></textarea>

    <label for="id_categoriaS">Categoría:</label>
    <select name="id_categoriaS" required>
        <?php foreach($categorias as $categoria): ?>
            <option value="<?= $categoria->id_categoriaS ?>" <?= isset($servicio->fk_categorias_servicios) && $servicio->fk_categorias_servicios == $categoria->id_categoriaS ? 'selected' : '' ?>>
                <?= $categoria->nombre ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Actualizar">
</form>
