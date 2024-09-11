<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Editar Empleado</h2>
<form action="?controller=empleado&method=update" method="POST">
    <!-- Campo oculto para el ID del empleado -->
    <input type="hidden" name="id_empleado" value="<?php echo htmlspecialchars($user['id_empleado']); ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required><br>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" value="<?php echo htmlspecialchars($user['apellido']); ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

    <label for="id_rol">Rol:</label>
    <select name="id_rol" required>
        <option value="1" <?php echo $user['id_rol'] == 1 ? 'selected' : ''; ?>>Administrador</option>
        <option value="2" <?php echo $user['id_rol'] == 2 ? 'selected' : ''; ?>>Empleado</option>
        <!-- Agrega más opciones de roles según tu base de datos -->
    </select><br>

    <button type="submit">Actualizar</button>
</form>
