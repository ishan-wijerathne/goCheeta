<?php require_once("action/act.add_user.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?=$title?> User</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="GoCheeta" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

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
                                            <li class="breadcrumb-item"><a href="users">Users</a></li>
                                            <li class="breadcrumb-item active"><?=$title?> User</li>
                                        </ol>
                                    </div>
                                    <h5 class="page-title"><?=$title?> User Details</h5>
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
                                            <form action="<?php if(!isset($_GET['id'])){echo'add_user.php';}?>" method="post">
                                                <div class="form-group row">
                                                    <label for="username-input" class="col-sm-2 col-form-label">Username *</label>
                                                    <div class="col-sm-10">
                                                        <input required class="form-control" type="text" name="username" value="<?=$username?>" id="username-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="password-input" class="col-sm-2 col-form-label">Password <?php if(!isset($_GET['id'])){echo'*';}?></label>
                                                    <div class="col-sm-10">
                                                        <input <?php if(!isset($_GET['id'])){echo'required';}?> value="<?=$cpassword?>" name="password" class="form-control" type="password" value="" id="password-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cpassword-input" class="col-sm-2 col-form-label">Confirm Password <?php if(!isset($_GET['id'])){echo'*';}?></label>
                                                    <div class="col-sm-10">
                                                        <input <?php if(!isset($_GET['id'])){echo'required';}?> value="<?=$cpassword?>" name="cpassword" class="form-control" type="password" value="" id="cpassword-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="first_name-input" class="col-sm-2 col-form-label">First Name *</label>
                                                    <div class="col-sm-10">
                                                        <input required class="form-control" type="text" name="first_name" value="<?=$first_name?>" id="first_name-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="last_name-input" class="col-sm-2 col-form-label">Last Name *</label>
                                                    <div class="col-sm-10">
                                                        <input required class="form-control" type="text" name="last_name" value="<?=$last_name?>" id="last_name-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email-input" class="col-sm-2 col-form-label">Email *</label>
                                                    <div class="col-sm-10">
                                                        <input required class="form-control" type="email" name="email" value="<?=$email?>" id="email-input">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="telephone-input" class="col-sm-2 col-form-label">Telephone</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" maxlength="10" type="text" name="telephone" id="telephone" value="<?=$telephone?>" id="telephone-input">
                                                    </div>
                                                </div>
                                                <?php if(in_array($user_type, array('Admin'))){ ?>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">User Type *</label>
                                                    <div class="col-sm-10">
                                                        <select required class="form-control" name="user_type">
                                                            <option value="" selected="" disabled="">Select User Type</option>
                                                            <option <?php if($cuser_type=='Admin'){echo 'selected';}?> value="Admin">Admin</option>	
                                                            <option <?php if($cuser_type=='Staff'){echo 'selected';}?> value="Staff">Staff</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <div class="form-group row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" name="submit" class="btn btn-success">Submit
                                                        </button>
                                                        &nbsp;
                                                        <button type="reset" class="btn btn-warning bttn_reset">
                                                            Reset
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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

    </body>
</html>