<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Editar Categoría</h2>
<form action="?controller=categoriaProductos&method=update" method="POST">
    <input type="hidden" name="id_categoriaP" value="<?= $categoria->id_categoriaP ?>">
    <label for="nombre_categoria">Nombre:</label>
    <input type="text" name="nombre_categoria" value="<?= $categoria->nombre_categoria ?>" required>
    <input type="submit" value="Actualizar">
</form>