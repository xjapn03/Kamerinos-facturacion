<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>
<h2>Nuevo Servicio</h2>
<form action="?controller=servicios&method=save" method="POST">
    <label for="nombre_servicio">Nombre:</label>
    <input type="text" name="nombre_servicio" required>
    
    <label for="precio">Precio:</label>
    <input type="number" name="precio" required>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" required></textarea>

    <label for="id_categoriaS">Categoría:</label>
    <select name="id_categoriaS" required>
        <?php foreach($categorias as $categoria): ?>
            <option value="<?= $categoria->id_categoriaS ?>"><?= $categoria->nombre ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Guardar">
</form>
