<!-- new.php -->
<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<h2>Crear Nuevo Empleado</h2>

<form action="?controller=empleado&method=save" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" required>

    <label for="id_rol">Rol:</label>
    <select name="id_rol" required>
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
        <!-- Agrega más roles según los tengas en tu base de datos -->
    </select>

    <button type="submit">Guardar</button>
</form>
