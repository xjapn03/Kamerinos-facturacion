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
                            <div class="row">
                                <div class="col-lg-3">
                                    <a href="#" id="agendar-cita" data-toggle="modal" data-target="#add-event" class="btn btn-lg btn-custom btn-block waves-effect m-t-20 waves-light">
                                        <i class="fi-circle-plus"></i> Agendar nueva cita
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-lg btn-custom btn-block waves-effect m-t-20 waves-light">
                                        <i class="fi-circle-plus"></i> Agendar nueva categoria 
                                    </a>
                                    <div id="external-events" class="m-t-20">
                                        <br>
                                        <p class="text-muted">Haz click en la fecha o arrastra y suelta el evento en el calendario</p>
                                        <div class="external-event bg-success" data-class="bg-success">
                                            <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Cepillado | Alisado | Peinado
                                        </div>
                                        <div class="external-event bg-info" data-class="bg-info">
                                            <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Uñas | Acrilicas | Pedicure
                                        </div>
                                        <div class="external-event bg-warning" data-class="bg-warning">
                                            <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Cejas | Limpieza | Facial
                                        </div>
                                        <div class="external-event bg-purple" data-class="bg-purple">
                                            <i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>Corte simple
                                        </div>
                                    </div>

                                    <!-- checkbox -->
                                    <div class="checkbox checkbox-primary mt-3">
                                        <input type="checkbox" id="drop-remove">
                                        <label for="drop-remove">
                                            Borrar despues de arrastrar
                                        </label>
                                    </div>

                                    <div class="mt-5 d-none d-xl-block">
                                        <h5 class="text-center">¿ Como funciona ?</h5>

                                        <ul class="pl-3">
                                            <li class="text-muted mb-3">
                                                Puedes simplemente oprimir el boton superior, ó seleccionar la fecha en el calendario.
                                            </li>
                                            <li class="text-muted mb-3">
                                                Tambien puedes cambiar la cita cuando quieras! arrastrala o dale click para editarla.
                                            </li>
                                            <li class="text-muted mb-3">
                                                Recuerda verificar los datos, llenar todos los campos si es necesario.
                                            </li>
                                        </ul>
                                    </div>
                                </div> <!-- end col-->
                                <div class="col-lg-9">
                                    <div id="calendar"></div>
                                </div> <!-- end col -->
                            </div>  <!-- end row -->
                        </div>

                        <!-- BEGIN MODAL -->
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-center border-bottom-0 d-block">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Añadir / Editar cita</h4>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Crear</button>
                                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Borrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Add Category -->
                        <div class="modal fade" id="add-category" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center border-bottom-0 d-block">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title mt-2">Agregar Cita</h4>
                                </div>
                                <div class="modal-body p-4">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Servicio</label>
                                                    <select class="form-control" name="id_servicio" id="id_servicio"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Cliente</label>
                                                    <select class="form-control" name="id_cliente" id="id_cliente"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Empleado</label>
                                                    <select class="form-control" name="id_empleado" id="id_empleado"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Fecha</label>
                                                    <input class="form-control" type="datetime-local" name="fecha_cita" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Abono</label>
                                                    <input class="form-control" placeholder="Abono" type="number" name="abono" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Estado</label>
                                                    <select class="form-control" name="estado" id="estado"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Nota</label>
                                                    <textarea class="form-control" name="event_description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="text-right">
                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-custom ml-1 waves-effect waves-light save-category" data-dismiss="modal">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="add-event" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center border-bottom-0 d-block">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title mt-2">Agregar Cita</h4>
                                </div>
                                <div class="modal-body p-4">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Servicio</label>
                                                    <select class="form-control" name="id_servicio" id="id_servicio"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Cliente</label>
                                                    <select class="form-control" name="id_cliente" id="id_cliente"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Empleado</label>
                                                    <select class="form-control" name="id_empleado" id="id_empleado"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Fecha</label>
                                                    <input class="form-control" type="datetime-local" name="fecha_cita" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Abono</label>
                                                    <input class="form-control" placeholder="Abono" type="number" name="abono" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Estado</label>
                                                    <select class="form-control" name="estado" id="estado"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Nota</label>
                                                    <textarea class="form-control" name="event_description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="text-right">
                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-custom ml-1 waves-effect waves-light save-event" data-dismiss="modal">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                        <!-- END MODAL -->
                    </div>
                    <!-- end col-12 -->
                </div> <!-- end row -->

    </div> <!-- end container -->
</div>
<!-- end wrapper -->

        <!-- Jquery-Ui -->
        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- SCRIPTS -->
        <script src="plugins/moment/moment.js"></script>
        <script src='plugins/fullcalendar/js/fullcalendar.min.js'></script>
        <script src="assets/pages/jquery.calendar.js"></script>

</body>
</html>