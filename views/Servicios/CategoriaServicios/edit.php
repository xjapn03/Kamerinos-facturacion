<h2>Editar Categoría</h2>
<form action="?controller=categoriaServicios&method=update" method="POST">
    <input type="hidden" name="id_categoriaS" value="<?= $categoria->id_categoriaS ?>">
    <label for="nombre_categoria">Nombre:</label>
    <input type="text" name="nombre_categoria" value="<?= $categoria->nombre_categoria ?>" required>
    <input type="submit" value="Actualizar">
</form>
