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
        <link rel="shortcut icon" href="assets/images/formato.png">

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
                             <a href="?controller=ventas&amp;method=new" class="btn btn-primary mb-3">Nueva Venta</a>
                        </div>


                        <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID Venta</th>
                                <th>Cliente</th>
                                <th>Empleado</th>
                                <th>Promoción</th>
                                <th>Fecha de Generación</th>
                                <th>Monto Total</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($ventas as $venta): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($venta['id_venta']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['nombre_cliente']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['nombre_empleado']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['id_promocion']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['fecha_generacion']); ?></td>
                                    <td><?php echo htmlspecialchars($venta['monto_total']); ?></td>
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