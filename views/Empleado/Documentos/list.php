<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Empleados - Documentos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Gestión de documentos de clientes" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/icons.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
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
                                <li class="breadcrumb-item active">Documentos de Empleados</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Documentos</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Upload Section -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <form action="?controller=DocumentosEmpleado&method=upload" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>">
                            <div class="input-group">
                                <input type="file" name="documento" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-upload"></i> Subir Documento
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end upload section -->

                <!-- File List -->
            <div class="row">
                <?php if (!empty($documentos)): ?>
                    <?php foreach ($documentos as $documento): ?>
                        <div class="col-lg-3 col-xl-2">
                            <div class="file-man-box">
                    

                               <!-- Formulario de eliminación dentro de un enlace -->
                              <!-- Formulario de eliminación dentro de un enlace -->
                            <form method="POST" action="?controller=DocumentosEmpleado&method=delete" style="display:inline;" onsubmit="return confirmDeletion()">
                                <input type="hidden" name="id_documento" value="<?php echo $documento['id_documento']; ?>">
                                <button type="submit" class="file-close" title="Eliminar documento" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <i class="mdi mdi-close-circle"></i>
                                </button>
                            </form>

                            <!-- Script para mostrar la alerta de confirmación -->
                            <script>
                                function confirmDeletion() {
                                    return confirm("¿Estás seguro de que deseas eliminar este archivo?");
                                }
                            </script>

                                <!-- Ícono del archivo -->
                                <div class="file-img-box">
                                    <?php 
                                    // Convertir la extensión a minúsculas antes de buscar el ícono
                                    $ext = strtolower($documento['extension']);
                                    $icono = file_exists("assets/images/file_icons/{$ext}.svg") 
                                            ? $ext 
                                            : 'default';
                                    ?>
                                    <img src="assets/images/file_icons/<?php echo $icono; ?>.svg" alt="icon">
                                </div>
                                
                                <!-- Botón para descargar el archivo -->
                                <a href="?controller=DocumentosEmpleado&method=downloadFile&id=<?php echo $documento['id_documento']; ?>" 
                                class="file-download" 
                                title="Descargar documento">
                                    <i class="mdi mdi-download"></i>
                                </a>
                                
                                <!-- Información del archivo -->
                                <div class="file-man-title">
                                    <h5 class="mb-0 text-overflow" title="<?php echo $documento['nombre_documento']; ?>">
                                        <?php echo $documento['nombre_documento']; ?>
                                    </h5>
                                    <p class="mb-0">
                                        <small>
                                            <?php 
                                            // Mostrar tamaño en KB o un mensaje de tamaño desconocido
                                            echo ($documento['size'] > 0) 
                                                ? $documento['size'] . ' KB' 
                                                : 'Tamaño desconocido'; 
                                            ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-muted text-center">No se encontraron documentos para este cliente.</p>
                    </div>
                <?php endif; ?>
            </div>
            <!-- end file list -->


        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <?php echo date('Y'); ?> © Sistema de Gestión de Documentos.
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</body>
</html>
