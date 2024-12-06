<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <title>Ventas - Kamerinos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <!-- App css -->

</head>
<body>
		<div class="wrapper">
            <div class="container-fluid">
				<!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="?controller=Welcome&method=inicio">Inicio</a></li>
                                    <li class="breadcrumb-item active">Ventas</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ventas</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


			<div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Listado de Ventas</h4>
                        <p class="text-muted font-14 m-b-30">
                            Aquí puedes ver todas las ventas realizadas en el salón.
                        </p>
                        
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <a href="javascript:void(0)" id="nuevaVentaBtn" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNuevaVenta">
                                Nueva Venta
                            </a>
                        </div>

                        <!-- Modal para nueva Venta -->
                        <div id="modalNuevaVenta" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tituloModalNuevaVenta" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="tituloModalNuevaVenta">Agregar Nueva Venta</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario para agregar una nueva Venta -->
                                        <form id="formNuevaVenta">
                                            <!-- Selección de Cliente -->
                                            <div class="form-group">
                                                <label for="id_cliente">Cliente</label>
                                                <select class="form-control" id="id_cliente" name="id_cliente" required>
                                                    <option value="">Cargando clientes...</option>
                                                </select>
                                            </div>
                                            
                                            <!-- Selección de Empleado -->
                                            <div class="form-group">
                                                <label for="id_empleado">Empleado</label>
                                                <select class="form-control" id="id_empleado" name="id_empleado" required>
                                                    <option value="">Cargando empleados...</option>
                                                </select>
                                            </div>

                                            <!-- Selección de Servicios -->
                                            <div class="form-group">
                                                <label for="servicios">Servicios</label>
                                                <select class="form-control" id="servicios" name="servicios[]" multiple required>
                                                    <option value="">Cargando servicios...</option>
                                                </select>
                                                <small class="form-text text-muted">Seleccione los servicios que desea agregar a la venta</small>
                                            </div>

                                            <!-- Selección de Productos -->
                                            <div class="form-group">
                                                <label for="productos">Productos</label>
                                                <select class="form-control" id="productos" name="productos[]" multiple required>
                                                    <option value="">Cargando productos...</option>
                                                </select>
                                                <small class="form-text text-muted">Seleccione los productos que desea agregar a la venta</small>
                                            </div>

                                            <!-- Ingreso de Monto Total -->
                                            <div class="form-group">
                                                <label for="total">Monto Total</label>
                                                <input type="number" class="form-control" id="total" name="total" required>
                                            </div>

                                            <!-- Ingreso de Monto para Empleado -->
                                            <div class="form-group">
                                                <label for="total_empleado">Total para Empleado</label>
                                                <input type="number" class="form-control" id="total_empleado" name="total_empleado" required>
                                            </div>

                                            <!-- Ingreso de Ganancia Total -->
                                            <div class="form-group">
                                                <label for="ganancia_total">Ganancia Total</label>
                                                <input type="number" class="form-control" id="ganancia_total" name="ganancia_total" required>
                                            </div>

                                            <!-- Botones -->
                                            <button type="submit" class="btn btn-success">Crear Venta</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID Venta</th>
                                <th>Empleado</th>
                                <th>Cliente</th>
                                <th>Fecha de Generación</th>
                                <th>Total</th>
                                <th>Total para Empleado</th>
                                <th>Ganancia</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['nombre_empleado']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['nombre_cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['fecha_hora']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['total']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['total_empleado']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['ganancia_total']); ?></td>
                                    <td>
                                        <a href="?controller=ventas&method=edit&id=<?php echo $venta['id_venta']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="?controller=ventas&method=delete&id=<?php echo $venta['id_venta']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta venta?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

</body>
</html>