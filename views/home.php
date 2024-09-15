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
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard</h4>
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
                                            
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 col-xl-3">
                                    <div class="card-box mb-0 widget-chart-two">
                                        <div class="float-right">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#0acf97" value="37" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-muted mb-0 mt-2">Ventas mes</p>
                                            <h3 class="">$35,715</h3>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6 col-xl-3">
                                    <div class="card-box mb-0 widget-chart-two">
                                        <div class="float-right">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#f9bc0b" value="92" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-muted mb-0 mt-2">Sales Analytics</p>
                                            <h3 class="">$97,511</h3>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6 col-xl-3">
                                    <div class="card-box mb-0 widget-chart-two">
                                        <div class="float-right">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#f1556c" value="14" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-muted mb-0 mt-2">Statistics</p>
                                            <h3 class="">$954</h3>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6 col-xl-3">
                                    <div class="card-box mb-0 widget-chart-two">
                                        <div class="float-right">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#2d7bf4" value="60" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-muted mb-0 mt-2">Total Revenue</p>
                                            <h3 class="">$32,540</h3>
                                        </div>

                                    </div>
                                </div>
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