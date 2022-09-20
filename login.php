<?php require_once("action/act.login.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="assets/cs/images/favicon.png">

	<title>Login</title>

	<link href="assets/cs/css/bootstrap-grid.css" rel="stylesheet">
	<link href="assets/cs/css/font-awesome.css" rel="stylesheet">
	<link href="assets/cs/css/swiper.css" rel="stylesheet">
	<link href="assets/cs/css/swipebox.css" rel="stylesheet">
	<link href="assets/cs/css/zoomslider.css" rel="stylesheet">
	<link href="assets/cs/css/stylee45e.css?03" rel="stylesheet">
	<link rel="stylesheet" href="../../ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:700,800%7COpen+Sans:400,600,700" rel="stylesheet"> 

	<script type="text/javascript" src="assets/cs/js/modernizr-2.6.2.min.js"></script>
</head>
<body>
	<?php require_once("inc/header_c.php"); ?>

	<div id="homepage-block-3" data-zs-speed="12000" data-zs-interval="7000" data-zs-bullets="false" data-zs-switchSpeed="4000" data-zs-src='["assets/cs/images/_homepage-3-2-bg.jpg", "assets/cs/images/_homepage-3-bg.jpg"]'>
		<div class="container">

			<section class="form-taxi-short">
				<div class="container">
					<form action="" method="post">
						<h3 class="aligncenter">GoCheeta <span class="yellow">Login</span></h3>
    
                        <?php
                            if(isset($error))
                            {
                                foreach($error as $error){
                                ?>
                                <div class="alert alert-black">
                                    <div class="header"><span class="fa fa-times-circle"></span>Error</div>
                                    <p><?php echo $error; ?></p>
                                </div>
                                <?php
                                }
                            }

							if(isset($_GET['act'])){
                                ?>
                                <div class="alert alert-black">
                                    <div class="header"><span class="fa fa-info-circle"></span>Warning</div>
                                    <p>Please login first</p>
                                </div>
                                <?php								
							}
                        ?>
						<div class="row form-with-labels">
							<div class="col-md-12">
								<div class="form-group">
									<input required type="text" name="txt_uname_email" value="" placeholder="Username" class="ajaxField required"><span class="fa fa-user"></span>
								</div>
							</div>
						</div>
						<div class="row form-with-labels">							
							<div class="col-md-12">
								<div class="form-group">
									<input required type="password" name="txt_password" value="" placeholder="Password" class="ajaxField required"><span class="fa fa-lock"></span>
								</div>
							</div>
						</div>
						<input type="submit" value="Login" class="btn btn-lg btn-yellow aligncenter">
                        
                        <!-- <a href="forget_password" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a> -->
					</form>
				</div>
			</section>

		</div>
	</div>
	<div class="homepage-block-yellow-3" id="contacts">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<h3><span class="fa fa-phone"></span> 0112-800-800</h3>
				</div>
				<div class="col-lg-2 col-md-6  col-sm-6">
					<h4><span class="fa fa-skype"></span> GoCheeta</h4>
				</div>
				<div class="col-lg-5 col-md-6  col-sm-6">
					<h4><span class="fa fa-map-marker"></span> No.500, Baseline Road, Colombo 14</h4>
				</div>
				<div class="col-lg-2 col-md-6  col-sm-6">
					<a href="index#tariffs" class="btn btn-black-bordered btn-lg pull-right">Our Tariffs</a>
				</div>				
			</div>
		</div>
	</div>

	<footer>
		<div class="container">
			<a href="/">GoCheeta</a> 2022 © All Rights Reserved
			<a href="#" class="go-top hidden-xs hidden-ms"></a>
		</div>
	</footer>

	<script type="text/javascript" src="assets/cs/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/cs/js/plugins.min.js"></script>		
	<script type="text/javascript" src="assets/cs/js/scripts.js"></script>

</body>
</html>