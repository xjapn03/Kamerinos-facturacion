<br>
<br>
<br>
<br><br>
<div class="container mt-5">
        <h2 class="mb-4">Nueva Venta</h2>
        <form action="?controller=ventas&method=save" method="POST">
            <div class="form-group">
                <label for="id_cliente">ID Cliente</label>
                <input type="number" class="form-control" id="id_cliente" name="id_cliente" required>
            </div>
            <div class="form-group">
                <label for="id_empleado">ID Empleado</label>
                <input type="number" class="form-control" id="id_empleado" name="id_empleado" required>
            </div>
            <div class="form-group">
                <label for="id_promocion">ID Promoción</label>
                <input type="number" class="form-control" id="id_promocion" name="id_promocion">
            </div>
            <div class="form-group">
                <label for="monto_total">Monto Total</label>
                <input type="number" step="0.01" class="form-control" id="monto_total" name="monto_total" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="?controller=ventas&method=index" class="btn btn-secondary">Cancelar</a>
        </form>
        <br><br>
    </div>