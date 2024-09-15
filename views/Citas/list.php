<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link href="plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />
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
                            <li class="breadcrumb-item"><a href="?controller=Welcome&method=home">Inicio</a></li>
                            <li class="breadcrumb-item active">Calendario</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Calendario de Citas</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">

                    <div class="col-lg-auto">
                        <div id="calendar"></div>
                    </div> <!-- end col -->
                </div>
              

                <!-- BEGIN MODAL -->
                <div class="modal fade" id="event-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header text-center border-bottom-0 d-block">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Añadir/Editar Cita</h4>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form id="event-form">
                    <!-- Campo oculto para el ID de la cita -->
                    <input type="hidden" name="id_cita" id="id_cita">

                    <!-- Servicio -->
                    <div class="form-group">
                        <label for="id_servicio">Servicio</label>
                        <input type="text" class="form-control" name="id_servicio" id="id_servicio" required>
                    </div>

                    <!-- Cliente -->
                    <div class="form-group">
                        <label for="id_cliente">Cliente</label>
                        <input type="text" class="form-control" name="id_cliente" id="id_cliente" required>
                    </div>

                    <!-- Promoción -->
                    <div class="form-group">
                        <label for="id_promocion">Promoción</label>
                        <input type="text" class="form-control" name="id_promocion" id="id_promocion">
                    </div>

                    <!-- Empleado -->
                    <div class="form-group">
                        <label for="id_empleado">Empleado</label>
                        <input type="text" class="form-control" name="id_empleado" id="id_empleado" required>
                    </div>

                    <!-- Fecha y hora de inicio -->
                    <div class="form-group">
                        <label for="fecha_cita">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" name="fecha_cita" id="fecha_cita" required>
                    </div>

                    <!-- Abono -->
                    <div class="form-group">
                        <label for="abono">Abono</label>
                        <input type="number" class="form-control" name="abono" id="abono">
                    </div>

                    <!-- Estado -->
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado">
                    </div>

                    <!-- Nota -->
                    <div class="form-group">
                        <label for="nota">Nota</label>
                        <textarea class="form-control" name="nota" id="nota"></textarea>
                    </div>
                </form>
            </div>

            <!-- Pie del modal -->
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success save-event waves-effect waves-light" id="save-event">Guardar</button>
                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" id="delete-event" style="display:none;">Eliminar</button>
            </div>
        </div>
    </div>
</div>


                <!-- END MODAL -->
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</div>
<!-- end wrapper -->

<!-- Scripts -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/moment/moment.js"></script>
<script src="plugins/fullcalendar/js/fullcalendar.min.js"></script>
<script src="ajax/CitasAjax.js"></script>
<!-- <script src="assets/pages/jquery.calendar.js"></script>-->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
 <!-- Asegúrate de que la ruta sea correcta -->
</body>
</html>
