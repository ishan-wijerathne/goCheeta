<?php require_once("action/act.rates.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Rates</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="GoCheeta" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

        <style>
            .currency {
                padding-left:22px;
            }
            .currency-symbol {
                position:absolute;
                padding: 6px 5px;
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
                                            <li class="breadcrumb-item"><a href="dashboard">LotusCare</a></li>
                                            <li class="breadcrumb-item active">Rates</li>
                                        </ol>
                                    </div>
                                    <h5 class="page-title">
                                        <span style="float:left;">Rates</span>                                         
                                        <select  class="form-control" id="category" style="width:400px; margin: -6px 0 0 40px; float:left;">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            <?=$categoriesData?>
                                        </select>
                                    </h5>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">
            
<!--                                            <h4 class="mt-0 header-title">User Details</h4>-->
                                            
                                              <?php
                                                if(isset($success))
                                                {
                                                    echo'<div class="alert alert-success">
                                                            <strong>Success!</strong> '.$success.'
                                                        </div>';
                                                }
                                                if(isset($error))
                                                {
                                                    foreach($error as $error)
                                                    {
                                                        echo'<div class="alert alert-danger">
                                                                <strong>Error!</strong> '.$error.'
                                                            </div>';
                                                    }
                                                }
                                              ?>

                                              <?=$rates?>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
            
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            $('#category').change(function() {
            window.location = 'rates?category='+$(this).val();
            });

            (function($) {
                $.fn.currencyInput = function() {
                    this.each(function() {
                    var wrapper = $("<div class='currency-input' />");
                    $(this).wrap(wrapper);
                    $(this).before("<span class='currency-symbol'>Rs.</span>");
                    $(this).change(function() {
                        var min = parseFloat($(this).attr("min"));
                        var max = parseFloat($(this).attr("max"));
                        var value = this.valueAsNumber;
                        if(value < min)
                        value = min;
                        else if(value > max)
                        value = max;
                        $(this).val(value.toFixed(2)); 
                    });
                    });
                };
            })(jQuery);

            $(document).ready(function() {
            $('input.currency').currencyInput();
            });
        </script>
    </body>
</html>