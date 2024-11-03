<!DOCTYPE html>
<html lang="es">
<head>
    <title>Productos - Kamerinos</title>
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
                                    <li class="breadcrumb-item active">Productos</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Productos</h4>
                        </div>
                    </div>
                </div>


			<div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title">Listado de Productos</h4>
                        <p class="text-muted font-14 m-b-30">
                            Aquí puedes ver todos los productos disponibles en el salón.
                        </p>
                        
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <a href="javascript:void(0)" id="nuevoProductoBtn" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNuevoProducto">
                                Nuevo Producto
                            </a>
                        </div>

                        <!-- Modal para nuevo producto -->
                        <div id="modalNuevoProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tituloModalNuevoProducto" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="tituloModalNuevoProducto">Agregar Nuevo Producto</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario para agregar un nuevo producto -->
                                        <form id="formNuevoProducto">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="precio">Precio</label>
                                                <input type="number" class="form-control" id="precio" name="precio" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input type="number" class="form-control" id="stock" name="stock" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="categoria">Categoría</label>
                                                <select class="form-control" id="categoria" name="categoria" required>
                                                    <option value="">Cargando categorías...</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">Guardar Producto</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <table id="responsive-datatable" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($producto->id_producto); ?></td>
                                    <td><?php echo htmlspecialchars($producto->nombre_producto); ?></td>
                                    <td><?php echo htmlspecialchars($producto->precio, 2); ?></td>
                                    <td><?php echo htmlspecialchars($producto->stock); ?></td>
                                    <td><?php echo htmlspecialchars($producto->nombre_categoria); ?></td>
                                    <td>
                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm btn-editar-producto" data-id="<?php echo $producto->id_producto; ?>" data-toggle="modal" data-target="#modalEditarProducto">Editar</a>
                                    <a href="?controller=productos&method=delete&id=<?php echo $producto->id_producto; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este producto?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <div id="modalEditarProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tituloModalEditarProducto" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title" id="tituloModalEditarProducto">Editar Producto</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario para agregar un nuevo producto -->
                                                    <form id="formEditarProducto">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="precio">Precio</label>
                                                            <input type="number" class="form-control" id="precio" name="precio" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stock">Stock</label>
                                                            <input type="number" class="form-control" id="stock" name="stock" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="categoria">Categoría</label>
                                                            <select class="form-control" id="categoria" name="categoria" required>
                                                                <option value="">Cargando categorías...</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Guardar Producto</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                        </table>
                    </div>
                </div>
            </div>


            </div> <!-- end container -->
        </div>
        <script src="ajax/ajaxProductos.js"></script>
    </body>
</html>