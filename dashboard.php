<?php require_once("action/act.dashboard.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="GoCheeta" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <style>
            @media (min-width: 768px) {
              .grid_title{
                  min-height: 130px !important;
              }
            }
            @media (min-width: 1200px) {
              .grid_title{
                  min-height: 70px !important;
              }
            }
        </style>

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">
            
            <?php require_once("inc/sidebar.php"); ?>

            <!-- Start right Content here -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    
                    <?php require_once("inc/header.php"); ?>

                    <div class="page-content-wrapper ">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="float-right page-breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">GoCheeta</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h5 class="page-title">Dashboard</h5>
                                </div>
                            </div>

                            <div class="row">
                                <?=$reports?>
                            </div>

                        </div><!-- container fluid -->

                    </div> <!-- Page content Wrapper -->

                </div> <!-- content -->

                <?php require_once("inc/footer.php"); ?>

            </div>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- skycons -->
        <script src="assets/plugins/skycons/skycons.min.js"></script>

        <!-- skycons -->
        <script src="assets/plugins/peity/jquery.peity.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- dashboard -->
        <script src="assets/pages/dashboard.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>