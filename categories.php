<?php require_once("action/act.categories.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Categories</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
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
            .mbabtn
            {
                padding: 5px 5px 5px 6px;
            }
            
            .marcolor_morning
            {
                background-color: lightcyan;
            }
            
            .marcolor_noon
            {
                background-color: #FFFCDB;
            }
            
            .marcolor_afternoon
            {
                background-color: #FCEBE1;
            }
            
            .marcolor_evening
            {
                background-color: lightgray;
            }
            .marbtr tr{
                border: 2px solid cadetblue;
            }
        </style>
    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">
            
            <?php require_once("inc/sidebar.php"); ?>
            
            <!-- sidebar -->

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
                                            <li class="breadcrumb-item active">Categories</li>
                                        </ol>
                                    </div>
                                    <h5 class="page-title">Categories <a href="javascript:;" style="margin-left:50px" class="btn btn-success waves-effect waves-light mad" id="dr">Add Category</a></h5>
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
                                                
                                                <div class="col-xl-12">
                                                    <div class="card m-b-30">
                                                        <div class="card-body">
                                                            
                                                                <div class="tab-pane active p-3" id="DutyRota" role="tabpanel">
                                                                    <div class="table-rep-plugin">
                                                                        <div class="table-responsive b-0" data-pattern="priority-columns">
                                                                            <table id="datatable" class="table datatable table-bordered dt-responsive nowrap table-striped focus-on display-all" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th data-priority="1">Category Name</th>
                                                                                        <th data-priority="1">Last Modified By</th>
                                                                                        <th data-priority="1">Last Modified Date</th>
                                                                                        <th>ACTION</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?=$categoriesData?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div>
            
                                                            <!-- sample modal content -->
                                                            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form action="categories" method="post">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title mt-0" id="myModalLabel"></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                    <input type="hidden" name="id" id="bid">
                                                                                    <input required placeholder="Category Name" class="form-control" name="category" id="category">
                                                                                    <br>
                                                                                    <select name="icon" id="icon" class="form-control">
                                                                                        <option selected value="">Select Icon</option>
                                                                                        <option value="mini-car.png">Mini Car</option>
                                                                                        <option value="car.png">Car</option>
                                                                                        <option value="luxury-car.png">Luxury Car</option>
                                                                                        <option value="van.png">Van</option>
                                                                                    </select>
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
                                                </div>
                                                
                                            </div>
            
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
            
            $('#datatable').dataTable( {
                "order": [[0, 'asc']]
            });
            
            jQuery(".mad").click(function(){
                var id = this.id;                  
                $('#myModalLabel').text('Add Category'); 
                $('#myModal').modal('show');
            });
            
            $('.dlt').click(function() {
                return confirm('Are you sure you want to Delete this Category?')
            });
            
            jQuery(".bedit").click(function(){
                var id = this.id;
                $('#myModalLabel').text('Edit Category'); 
                $("#bid").val(id);
                $("#category").val($("#b-"+id).text());
                $("#icon").val($("#i-"+id).val());
                $('#myModal').modal('show');
            });
        </script>

    </body>
</html>