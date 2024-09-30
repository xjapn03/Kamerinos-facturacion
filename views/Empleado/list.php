<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <title>Inicio - Kamerinos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/formato.png">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>
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
                        <div class="card-box">
                            <h4 class="header-title mb-4"><b><?php echo date('d-m-Y'); ?>
                            <div>
                                <?php date_default_timezone_set('UTC');?>
                                    <html>
                                        <head>
                                            <script>
                                                var d = new Date(<?php echo time() * 1000 ?>);

                                                function updateClock() {
                                                // Increment the date
                                                d.setTime(d.getTime() + 1000);

                                                // Translate time to pieces
                                                var currentHours = d.getHours();
                                                var currentMinutes = d.getMinutes();
                                                var currentSeconds = d.getSeconds();

                                                // Add the beginning zero to minutes and seconds if needed
                                                currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                                                currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

                                                // Determine the meridian
                                                var meridian = (currentHours < 12) ? "am" : "pm";

                                                // Convert the hours out of 24-hour time
                                                currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
                                                currentHours = (currentHours == 0) ? 12 : currentHours;

                                                // Generate the display string
                                                var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + meridian;

                                                // Update the time
                                                document.getElementById("clock").firstChild.nodeValue = currentTimeString;
                                                }

                                                window.onload = function() {
                                                updateClock();
                                                setInterval('updateClock()', 1000);
                                                }
                                            </script>
                                        </head>
                                            <body>
                                            <div lass="header-title mb-4"><b><div id="clock">&nbsp;</div>
                                            </body>
                                    </html>
                            </div></b></h4>  
                                            
                            
                                <div class="container mt-0">
                                   <center> <h2 class="mb-4">Listado de empleados</h2></center>
                                    <a href="?controller=empleado&method=new" class="btn btn-primary mb-3">Nuevo empleado</a>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
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
                                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                                    <td><?= htmlspecialchars($user['nombre_rol']) ?></td>
                                                    <td>
                                                        <a href="?controller=empleado&method=edit&id=<?= urlencode($user['id_empleado']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                                        <a href="?controller=empleado&method=delete&id=<?= urlencode($user['id_empleado']) ?>" class="bbtn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
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
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

		<script src="plugins/jquery-knob/jquery.knob.js"></script>

        <!-- Dashboard Init -->
        <script src="assets/pages/jquery.dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

</body>
</html>