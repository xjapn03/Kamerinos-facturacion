<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Clientes - Kamerinos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
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
                                    <li class="breadcrumb-item active">Clientes</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Clientes</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

				
			<div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Listado de Clientes</h4>
                        <p class="text-muted font-14 m-b-30">
                            Aquí puedes ver todos los clientes registrados.
                        </p>
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <a href="?controller=cliente&method=new" class="btn btn-primary mb-3">Nuevo Cliente</a>
                        </div>
                        <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Fecha de Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($clientes)): ?>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                                            <td><?= htmlspecialchars($cliente['apellido']) ?></td>
                                            <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                                            <td><?= htmlspecialchars($cliente['email']) ?></td>
                                            <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                                            <td><center><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></center></td>
                                            <td><?= htmlspecialchars($cliente['fecha_registro']) ?></td>
                                            <td>
                                                <a href="?controller=cliente&method=####=<?= urlencode($cliente['id_cliente']) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-file-archive-o"></i>
                                                </a>
                                                <a href="?controller=cliente&method=edit&id=<?= urlencode($cliente['id_cliente']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <a href="?controller=cliente&method=delete&id=<?= urlencode($cliente['id_cliente']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8">No hay clientes registrados</td>
                                    </tr>
                                <?php endif; ?>
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
