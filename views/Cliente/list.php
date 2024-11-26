<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Clientes - Kamerinos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
                            <a href="javascript:void(0)" id="nuevoClienteBtn" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalNuevoCliente">
                                Nuevo Cliente
                            </a>
                        </div>

                        <!-- Modal para agregar cliente -->
                        <div id="modalNuevoCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tituloModalNuevoCliente" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="tituloModalNuevoCliente">Agregar Nuevo Cliente</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formNuevoCliente">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" pattern="\+57[0-9]+" value="+57" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                                            </div>
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del Modal -->

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
                                        <td><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></td>
                                        <td><?= htmlspecialchars($cliente['fecha_registro']) ?></td>
                                        <td>
                                            <!-- Botón para ver documentos -->
                                            <a href="?controller=documentos&action=index&id_cliente=<?= urlencode($cliente['id_cliente']) ?>" class="btn btn-primary btn-sm">
                                                <i class="fa fa-file-archive-o"></i>
                                            </a>
                                            <!-- Botón para editar cliente -->
                                            <a href="javascript:void(0)" 
                                                class="btn btn-warning btn-sm btn-editar-cliente" 
                                                data-id="<?= htmlspecialchars($cliente['id_cliente']) ?>"
                                                data-nombre="<?= htmlspecialchars($cliente['nombre']) ?>"
                                                data-apellido="<?= htmlspecialchars($cliente['apellido']) ?>"
                                                data-telefono="<?= htmlspecialchars($cliente['telefono']) ?>"
                                                data-email="<?= htmlspecialchars($cliente['email']) ?>"
                                                data-direccion="<?= htmlspecialchars($cliente['direccion']) ?>"
                                                data-fecha-nacimiento="<?= htmlspecialchars($cliente['fecha_nacimiento']) ?>"
                                                data-toggle="modal" 
                                                data-target="#modalEditarCliente">
                                                Editar
                                            </a>

                                            <!-- Botón para eliminar cliente -->
                                            <a href="?controller=cliente&method=delete&id=<?= urlencode($cliente['id_cliente']) ?>" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="return confirm('¿Estás seguro de eliminar este cliente?');">
                                            Eliminar
                                            </a>
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

                        <!-- Modal para editar cliente -->
                        <div id="modalEditarCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tituloModalEditarCliente" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="tituloModalEditarCliente">Editar Cliente</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formEditarCliente">
                                            <input type="hidden" id="id_cliente" name="id_cliente">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" pattern="\+57[0-9]+" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="direccion">Dirección</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fechaNacimiento" name="fecha_nacimiento" required>
                                            </div>
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="ajax/ajaxClientes.js"></script>
    </body>
</html>
