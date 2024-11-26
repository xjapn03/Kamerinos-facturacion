<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <title>Empleados - Kamerinos</title>
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
                                    <li class="breadcrumb-item active">Empleados</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Empleados</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

				
			<div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Listado de Empleados</h4>
                        <p class="text-muted font-14 m-b-30">
                            Aquí puedes ver todos los empleados habilitados en el salon.
                        </p>
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <a href="?controller=empleado&method=new" class="btn btn-primary mb-3">Nuevo Empleado</a>
                        </div>
                        <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                                <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['nombre']) ?></td>
                                        <td><?= htmlspecialchars($user['apellido']) ?></td>
                                        <td><?= htmlspecialchars($user['telefono']) ?></td>
                                        <td><?= htmlspecialchars($user['direccion']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= htmlspecialchars($user['nombre_rol']) ?></td>
                                        <td>
                                            <a href="?controller=documentosEmpleado&action=index&id_empleado=<?= urlencode($user['id_empleado']) ?>" class="btn btn-primary btn-sm">
                                               <i class="fa fa-file-archive-o"></i>
                                            </a>
                                            <a href="?controller=empleado&method=edit&id=<?= urlencode($user['id_empleado']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                            <a href="?controller=empleado&method=delete&id=<?= urlencode($user['id_empleado']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                         <td colspan="4">No hay empleados registrados</td>
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