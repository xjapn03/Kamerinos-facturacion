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
                                            
                           
                            <!-- end row -->
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->




        <!-- App js -->
</body>
</html>