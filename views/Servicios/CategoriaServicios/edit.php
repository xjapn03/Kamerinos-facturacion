<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Editar Categoría</h2>
<form action="?controller=categoriaServicios&method=update" method="POST">
    <input type="hidden" name="id_categoriaS" value="<?= $categoria->id_categoriaS ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $categoria->nombre ?>" required> <!-- Usando la propiedad correcta 'nombre' -->
    <input type="submit" value="Actualizar">
</form>

