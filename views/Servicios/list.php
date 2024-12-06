<!DOCTYPE html>
<html lang="es">
<head>
    <title>Servicios - Kamerinos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
                            <a href="javascript:void(0)" id="nuevoServicioBtn" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNuevoServicio">
                                Nuevo Servicio
                            </a>
                        </div>

                         <!-- Modal para nuevo Servicio -->
                         <div id="modalNuevoServicio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tituloModalNuevoServicio" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="tituloModalNuevoServicio">Agregar Nuevo Servicio</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario para agregar un nuevo Servicio -->
                                        <form id="formNuevoServicio">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <input type="number" class="form-control" id="precio" name="precio" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="duracion">Duracion</label>
                                                <input type="number" class="form-control" id="duracion" name="duracion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripciom</label>
                                                <input type="text" class="form-control" id="duracion" name="descripcion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria">Categoría</label>
                                                <select class="form-control" id="categoria" name="categoria" required>
                                                    <option value="">Cargando categorías...</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">Crear</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->



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
                                            <a href="javascript:void(0)" 
                                                class="btn btn-warning btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#modalEditarServicio"
                                                data-id="<?php echo $servicio->id_servicio; ?>"
                                                data-nombre="<?php echo $servicio->nombre_servicio; ?>"
                                                data-precio="<?php echo $servicio->precio; ?>"
                                                data-duracion="<?php echo $servicio->duracion; ?>"
                                                data-categoria="<?php echo $servicio->fk_categorias_servicios; ?>"  
                                                data-descripcion="<?php echo $servicio->descripcion; ?>">
                                                Editar
                                            </a>
                                            <a href="?controller=servicios&method=delete&id=<?php echo $servicio->id_servicio; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este servicio?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Modal para editar Servicio (Fuera del bucle) -->
                        <div id="modalEditarServicio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulomodalEditarServicio" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="titulomodalEditarServicio">Editar Servicio</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formEditarServicio">
                                            <input type="hidden" id="id_servicio" name="id_servicio">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <input type="number" class="form-control" id="precio" name="precio" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="duracion">Duración</label>
                                                <input type="number" class="form-control" id="duracion" name="duracion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria">Categoría</label>
                                                <select class="form-control" id="categoriaEditar" name="categoria" required>
                                                    <option value="">Cargando categoría...</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

    <script src="ajax/ajaxServicios.js"></script>

    </body>
</html>