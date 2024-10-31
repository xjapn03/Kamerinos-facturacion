<!DOCTYPE html>
<html lang="es">
<head>
    <title>Servicios - Kamerinos</title>
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
                                    <li class="breadcrumb-item active">Servicios</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Servicios</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


			<div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Listado de Servicios</h4>
                        <p class="text-muted font-14 m-b-30">
                            Aquí puedes ver todos los servicios disponibles en el salón.
                        </p>
                        
                        <div class="d-flex justify-content-center justify-content-md-start">
                             <a href="?controller=servicios&amp;method=new" class="btn btn-primary mb-3">Nuevo servicio</a>
                        </div>


                        <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID Servicio</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Duracion</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($servicios as $servicio): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($servicio->id_servicio); ?></td>
                                    <td><?php echo htmlspecialchars($servicio->nombre_servicio); ?></td>
                                    <td><?php echo htmlspecialchars($servicio->precio, 2); ?></td>
                                    <td><?php echo htmlspecialchars($servicio->duracion); ?></td>
                                    <td><?php echo htmlspecialchars($servicio->nombre_categoria); ?></td>
                                    <td>
                                        <a href="?controller=servicios&method=edit&id=<?php echo $servicio->id_servicio; ?>" class="btn btn-warning btn-sm">Editar</a>
                                        <a href="?controller=servicios&method=delete&id=<?php echo $servicio->id_servicio; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este servicio?');">Eliminar</a>
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