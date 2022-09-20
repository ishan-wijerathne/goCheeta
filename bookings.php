<?php require_once("action/act.bookings.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Bookings</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="GoCheeta" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css" media="screen">
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <style>
            .focus-btn-group, .dropdown-btn-group{
                display: none;
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
                                            <li class="breadcrumb-item"><a href="dashboard">GoCheeta</a></li>
                                            <li class="breadcrumb-item active">Bookings</li>
                                        </ol>
                                    </div>
                                    <h5 class="page-title">bookings <?php if($user_type=='Client'){ ?><a href="/" style="margin-left:50px" class="btn btn-success waves-effect waves-light">Plan Your Trip</a> <?php } ?></h5>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">

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
            
                                            <div class="table-rep-plugin">
                                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                                    <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped focus-on" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th data-priority="1">ID</th>
                                                                <?php if($user_type=='Client'){ ?>
                                                                    <th data-priority="1">Pick-up Location</th>
                                                                    <th>Pick-up Street Address</th>
                                                                    <th data-priority="1">Drop Location</th>
                                                                    <th>Drop Street Address</th>
                                                                    <th data-priority="1">Pick-up Date/Time</th>
                                                                    <th data-priority="1">Milage</th>
                                                                    <th data-priority="1">Rate (LKR)</th>
                                                                    <th data-priority="1">Vehicle No</th>
                                                                    <th>Category</th>
                                                                    <th>Model</th>
                                                                    <th>Max passengers</th>
                                                                    <th data-priority="1">Driver's Name</th>
                                                                    <th data-priority="1">Driver's Contact No</th>
                                                                    <th data-priority="1">Status</th>
                                                                    <th>Feedback</th>
                                                                    <?php if(!empty($actBtnTH)){ echo'<th data-priority="1">Action</th>';}?>
                                                                <?php }elseif($user_type=='Driver'){ ?>
                                                                    <th data-priority="1">Client Name</th>
                                                                    <th data-priority="1">Client's Contact No</th>
                                                                    <th data-priority="1">Pick-up Location</th>
                                                                    <th>Pick-up Street Address</th>
                                                                    <th data-priority="1">Drop Location</th>
                                                                    <th>Drop Street Address</th>
                                                                    <th data-priority="1">Pick-up Date/Time</th>
                                                                    <th data-priority="1">Milage</th>
                                                                    <th data-priority="1">Rate (LKR)</th>
                                                                    <th data-priority="1">Status</th>
                                                                    <th>Feedback</th>
                                                                    <?php if(!empty($actBtnTH)){ echo'<th data-priority="1">Action</th>';}?>
                                                                <?php }else{ ?>
                                                                    <th data-priority="1">Client Name</th>
                                                                    <th data-priority="1">Client's Contact No</th>
                                                                    <th data-priority="1">Pick-up Location</th>
                                                                    <th>Pick-up Street Address</th>
                                                                    <th data-priority="1">Drop Location</th>
                                                                    <th>Drop Street Address</th>
                                                                    <th data-priority="1">Pick-up Date/Time</th>
                                                                    <th data-priority="1">Milage</th>
                                                                    <th data-priority="1">Rate (LKR)</th>
                                                                    <th data-priority="1">Vehicle No</th>
                                                                    <th>Category</th>
                                                                    <th>Model</th>
                                                                    <th>Max passengers</th>
                                                                    <th>Driver's Name</th>
                                                                    <th>Driver's Contact No</th>
                                                                    <th>Branch</th>
                                                                    <th data-priority="1">Status</th>
                                                                    <th>Feedback</th>
                                                                    <?php if(!empty($actBtnTH)){ echo'<th data-priority="1">Action</th>';}?>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?=$datalist?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
            
                                            <!-- sample modal content -->
                                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-0" id="myModalLabel">Feedback</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                    <input type="hidden" name="id" id="fid">
                                                                    <textarea required placeholder="Write your feedback" class="form-control" name="feedback" id="feedback"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
            
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            
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

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Responsive-table-->
        <script src="assets/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

        <script>
            $(function() {
                $('.table-responsive').responsiveTable({
                    addDisplayAllBtn: 'btn btn-secondary'
                });
            });

            $('.actb').click(function() {
                return confirm('Are you sure to perform this action?')
            });
            
            jQuery(".addf").click(function(){
                var id = this.id;
                $("#fid").val(id);
                $('#myModal').modal('show');
            });
        </script>

    </body>
</html>