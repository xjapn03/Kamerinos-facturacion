<br>
<br>
<br>
<br><br><br><br><br><br><br><br><br><br>

<div class="container mt-5">
        <h2 class="mb-4">Editar Venta</h2>
        <form action="?controller=venta&method=update" method="POST">
            <input type="hidden" name="id_venta" value="<?php echo htmlspecialchars($venta['id_venta']); ?>">
            <div class="form-group">
                <label for="id_cliente">ID Cliente</label>
                <input type="number" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo htmlspecialchars($venta['id_cliente']); ?>" required>
            </div>
            <div class="form-group">
                <label for="id_empleado">ID Empleado</label>
                <input type="number" class="form-control" id="id_empleado" name="id_empleado" value="<?php echo htmlspecialchars($venta['id_empleado']); ?>" required>
            </div>
            <div class="form-group">
                <label for="id_promocion">ID Promoción</label>
                <input type="number" class="form-control" id="id_promocion" name="id_promocion" value="<?php echo htmlspecialchars($venta['id_promocion']); ?>">
            </div>
            <div class="form-group">
                <label for="monto_total">Monto Total</label>
                <input type="number" step="0.01" class="form-control" id="monto_total" name="monto_total" value="<?php echo htmlspecialchars($venta['monto_total']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="?controller=venta" class="btn btn-secondary">Cancelar</a>
        </form>
</div>
