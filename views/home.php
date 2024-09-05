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
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                                    <li class="breadcrumb-item"><a href="#">Highdmin</a></li>
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
                            <h4 class="header-title mb-4">Account Overview</h4>

                            <div class="row">
                                <div class="col-sm-6 col-lg-6 col-xl-3">
                                    <div class="card-box mb-0 widget-chart-two">
                                        <div class="float-right">
                                            <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                   data-fgColor="#0acf97" value="37" data-skin="tron" data-angleOffset="180"
                                                   data-readOnly=true data-thickness=".1"/>
                                        </div>
                                        <div class="widget-chart-two-content">
                                            <p class="text-muted mb-0 mt-2">Daily Sales</p>
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



                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title">Order Overview</h4>

                            <div id="website-stats" style="height: 350px;" class="flot-chart mt-5"></div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title">Sales Overview</h4>

                            <div id="combine-chart">
                                <div id="combine-chart-container" class="flot-chart mt-5" style="height: 350px;">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-box">
                            <h4 class="header-title mb-3">Wallet Balances</h4>

                            <div class="table-responsive">
                                <table class="table table-hover table-centered m-0">

                                    <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Currency</th>
                                        <th>Balance</th>
                                        <th>Reserved in orders</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">Tomaslau</h5>
                                            <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                        </td>

                                        <td>
                                            <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                        </td>

                                        <td>
                                            0.00816117 BTC
                                        </td>

                                        <td>
                                            0.00097036 BTC
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-custom"><i class="mdi mdi-plus"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-minus"></i></a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-3.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">Erwin E. Brown</h5>
                                            <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                        </td>

                                        <td>
                                            <i class="mdi mdi-currency-eth text-primary"></i> ETH
                                        </td>

                                        <td>
                                            3.16117008 ETH
                                        </td>

                                        <td>
                                            1.70360009 ETH
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-custom"><i class="mdi mdi-plus"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-minus"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-4.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">Margeret V. Ligon</h5>
                                            <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                        </td>

                                        <td>
                                            <i class="mdi mdi-currency-eur text-primary"></i> EUR
                                        </td>

                                        <td>
                                            25.08 EUR
                                        </td>

                                        <td>
                                            12.58 EUR
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-custom"><i class="mdi mdi-plus"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-minus"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-5.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">Jose D. Delacruz</h5>
                                            <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                        </td>

                                        <td>
                                            <i class="mdi mdi-currency-cny text-primary"></i> CNY
                                        </td>

                                        <td>
                                            82.00 CNY
                                        </td>

                                        <td>
                                            30.83 CNY
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-custom"><i class="mdi mdi-plus"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-minus"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/users/avatar-6.jpg" alt="contact-img" title="contact-img" class="rounded-circle thumb-sm" />
                                        </td>

                                        <td>
                                            <h5 class="m-0 font-weight-normal">Luke J. Sain</h5>
                                            <p class="mb-0 text-muted"><small>Member Since 2017</small></p>
                                        </td>

                                        <td>
                                            <i class="mdi mdi-currency-btc text-primary"></i> BTC
                                        </td>

                                        <td>
                                            2.00816117 BTC
                                        </td>

                                        <td>
                                            1.00097036 BTC
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-sm btn-custom"><i class="mdi mdi-plus"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="mdi mdi-minus"></i></a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title">Total Wallet Balance</h4>


                            <div id="donut-chart">
                                <div id="donut-chart-container" class="flot-chart mt-5" style="height: 340px;">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
		<script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>

        <!-- Flot chart -->
        <script src="plugins/flot-chart/jquery.flot.min.js"></script>
        <script src="plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="plugins/flot-chart/jquery.flot.crosshair.js"></script>
        <script src="plugins/flot-chart/curvedLines.js"></script>
        <script src="plugins/flot-chart/jquery.flot.axislabels.js"></script>

        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="plugins/jquery-knob/jquery.knob.js"></script>

        <!-- Dashboard Init -->
        <script src="assets/pages/jquery.dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
</body>
</html>