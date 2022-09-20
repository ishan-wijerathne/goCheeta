<?php require_once("action/act.index.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" href="assets/cs/images/favicon.png">

	<title>GoCheeta</title>

	<link href="assets/cs/css/bootstrap-grid.css" rel="stylesheet">
	<link href="assets/cs/css/font-awesome.css" rel="stylesheet">
	<link href="assets/cs/css/swiper.css" rel="stylesheet">
	<link href="assets/cs/css/swipebox.css" rel="stylesheet">
	<link href="assets/cs/css/zoomslider.css" rel="stylesheet">
	<link href="assets/cs/css/stylee45e.css?03" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed:700,800%7COpen+Sans:400,600,700" rel="stylesheet"> 

	<script type="text/javascript" src="assets/cs/js/modernizr-2.6.2.min.js"></script>
	<style>
		.pcr{
			color: #e49703 !important;
		}
	</style>
</head>
<body>
	<?php require_once("inc/header_c.php"); ?>
	
	<div id="homepage-block-3" data-zs-speed="12000" data-zs-interval="7000" data-zs-bullets="false" data-zs-switchSpeed="4000" data-zs-src='["assets/cs/images/_homepage-3-2-bg.jpg", "assets/cs/images/_homepage-3-bg.jpg"]'>
		<div class="container">

		<?php if(!isset($_SESSION['user_type']) || $_SESSION['user_type']=='Client'){?>
			<section class="form-taxi-short" id="get-taxi">
				<div class="container">
					<form action="" method="post" id="bookRide">
						<h3 class="aligncenter">Get Taxi <span class="yellow">Online</span></h3>
    
						<?php
							if(isset($error))
							{
								?>
								<div class="alert alert-black">
									<div class="header"><span class="fa fa-times-circle"></span>Error</div>
									<p><?php echo $error; ?></p>
								</div>
								<?php
							}

							if(isset($success)){
								?>
								<div class="alert alert-black">
									<p><?=$success?></p>
								</div>
								<?php								
							}
						?>

						<div class="menu-types">
							<?=$categoriesData?>
							<input type="hidden" name="category" class="type-value ajaxField" id="category" value="<?=$fv?>">
						</div>
						<div class="row form-with-labels">
							<div class="col-md-6">
								<div class="form-group">
									<select id="pickup_location" name="pickup_location" class="ajaxField pc" required>
										<option selected disabled value="">Select Pick-up Location</option>
										<?=$locations?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<select id="drop_location" name="drop_location" class="ajaxField pc" required>
										<option selected disabled value="">Select Drop Location</option>
										<?=$locations?>
									</select>
								</div>
							</div>
						<div class="col-md-12" style="color:red; font-size:13px; display:none; bottom:10px;" id="dle">You can't select same location for Pick-up & Drop Locations</div>
						</div>
						<div class="row form-with-labels">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" name="pickup_address" value="" placeholder="Pick-up Street Address" class="ajaxField" required><span class="fa fa-map-marker"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" name="drop_address" value="" placeholder="Drop Street Address" class="ajaxField" required><span class="fa fa-map-marker"></span>
								</div>
							</div>
						</div>
						<div class="row form-with-labels">							
							<div class="col-md-6">
								<div class="form-group">
									<input type="date" name="pickup_date" id="date" value="" placeholder="Pick-up Date" class="ajaxField pc" required min="<?=date('Y-m-d')?>"><span class="fa fa-calendar"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="time" name="pickup_time" value="" placeholder="Pick-up Time" class="ajaxField" required><span class="fa fa-clock-o"></span>
								</div>
							</div>
						</div>
						<div id="res">
							<div class="row form-with-labels">
								<div class="col-md-12">
									<div class="form-group">
										<select id="vehicle" name="vehicle" class="ajaxField pc" required>
											<option selected disabled value="">Select Vehicle</option>
											<option disabled value="">Please select all data first</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row form-with-labels">
								<div class="col-md-6">
									<div class="form-group">
										<span class="pcr">Milage: <lable id="milage">0</lable> KM</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="pcr">LKR <lable id="rate">0.00</lable></span>
									</div>
								</div>
							</div>
						</div>
						<br>
						<?php if(isset($_SESSION['user_session'])){ ?>
							<input type="submit" value="PLACE A BOOKING" name="booking" id="booking" class="btn btn-lg btn-yellow aligncenter">
						<?php }else{ ?>
							<input type="button" value="PLACE A BOOKING" class="btn btn-lg btn-yellow aligncenter gtr">
						<?php } ?>
						<input type="hidden" id="type" name="type" value="2" class="ajaxField">
					</form>
				</div>
			</section>
		<?php } ?>

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
					<a href="#tariffs" class="btn btn-black-bordered btn-lg pull-right">Our Tariffs</a>
				</div>				
			</div>
		</div>
	</div>

	<section id="services">
		<div class="container">
			<h4 class="yellow">Welcome</h4>
			<h2 class="h1">Our Services</h2>
			<div class="row">
				<div class="col-md-3 col-sm-6 col-ms-6 matchHeight">	
					<div class="image"><img src="assets/cs/images/_services-1.png" alt="Service"></div>
					<h5>Rapid city transfer</h5>
					<p>We will bring you quickly and comfortably to anywhere in your city</p>
				</div>
				<div class="col-md-3 col-sm-6 col-ms-6 matchHeight">	
					<div class="image"><img src="assets/cs/images/_services-2.png" alt="Service"></div>
					<h5>Booking a hotel</h5>
					<p>If you need a comfortable hotel, our operators will book it for you, and take a taxi to the address</p>
				</div>
				<div class="col-md-3 col-sm-6 col-ms-6 matchHeight">	
					<div class="image"><img src="assets/cs/images/_services-3.png" alt="Service"></div>
					<h5>Airport transfer</h5>
					<p>We will bring you quickly and comfortably to anywhere in your city</p>
				</div>
				<div class="col-md-3 col-sm-6 col-ms-6 matchHeight">	
					<div class="image"><img src="assets/cs/images/_services-4.png" alt="Service"></div>
					<h5>Baggage transport</h5>
					<p>If you need a comfortable hotel, our operators will book it for you, and take a taxi to the address</p>
				</div>
			</div>
		</div>
	</section>
	<section id="tariffs">
		<div class="container">
			<h4 class="yellow">See Our</h4>
			<h2 class="h1">Tariffs</h2>
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="item matchHeight">
						<div class="image"><img src="assets/cs/images/_tariff-1.png" class="full-width" alt="Tariff"></div>
						<h4>Mini-Car</h4>
						<p>Standard sedan for a drive around the city at your service</p>
						<div class="price">Rs.100<span>/km</span></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="item matchHeight">
						<div class="image"><img src="assets/cs/images/_tariff-2.png" class="full-width" alt="Tariff"></div>
						<h4>Car</h4>
						<p>Standard sedan for a drive around the city at your service</p>
						<div class="price">Rs.130<span>/km</span></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="item matchHeight vip">
						<div class="image"><img src="assets/cs/images/_tariff-3.png" class="full-width" alt="Tariff"></div>
						<h4 class="red">Vip</h4>
						<p>Standard sedan for a drive around the city at your service</p>
						<div class="price">Rs.250<span>/km</span></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="item matchHeight">
						<div class="image"><img src="assets/cs/images/_tariff-4.png" class="full-width" alt="Tariff"></div>
						<h4>Van</h4>
						<p>Standard sedan for a drive around the city at your service</p>
						<div class="price">Rs.170<span>/km</span></div>
					</div>
				</div>												
			</div>
		</div>
	</section>
	<section id="download" class="parallax" style="background-image: url(assets/cs/images/_download-bg.jpg);">
		<div class="container">
			<h4 class="yellow">Get More Benefits</h4>
			<h2 class="h1">Download The App</h2>
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<div class="items row">
						<div class="col-md-2 visible-md visible-lg"><span class="num">01.</span></div>
						<div class="col-md-10">
							<h5 class="yellow">Fast booking</h5>
							<p> &nbsp;</p>
						</div>
						<div class="col-md-2 visible-md visible-lg"><span class="num">02.</span></div>
						<div class="col-md-10">
							<h5 class="yellow">Easy to use</h5>
							<p>&nbsp; </p>
						</div>						
					</div>
				</div>
				<div class="col-md-4 col-md-push-4 col-sm-12">
					<div class="items items-right row">
						<div class="col-md-10">
							<h5 class="yellow">GPS searching</h5>
							<p> &nbsp;</p>
						</div>
						<div class="col-md-2 visible-md visible-lg"><span class="num">03.</span></div>
						<div class="col-md-10">
							<h5 class="yellow">Bonuses for ride</h5>
							<p> &nbsp;</p>
						</div>						
						<div class="col-md-2 visible-md visible-lg"><span class="num">04.</span></div>
					</div>				
				</div>				
				<div class="col-md-4 col-md-pull-4 col-sm-12">
					<div class="mob">
						<a href="#"><img src="assets/cs/images/_app-google.png" alt="App"></a>
						<a href="#"><img src="assets/cs/images/_app-apple.png" alt="App"></a>
					</div>
				</div>

			</div>
		</div>
	</section>
	<section id="car-block">
	 	<div class="car-right animation-block"><img src="assets/cs/images/_car-big-side.png" alt="Car"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<h4 class="yellow">For Drivers</h4>
					<h2 class="h1">Do You Want To Earn With Us?</h2>
				</div>
				<div class="col-md-6">
					<p>If you have a driving license, We got rides for you! Join the largest network of drivers in the country & make driving fun while you earn over 100,000 Rupees per month.</p>

					<ul class="check two-col strong">
						<li>Luxury cars</li>
						<li>No fee</li>
						<li>Weekly payment</li>
						<li>Fixed price</li>
						<li>Good application</li>
						<li>Stable orders</li>
					</ul>

					<a href="#" class="btn btn-yellow btn-lg btn-white">Become a Driver</a>
				</div>
			</div>
		</div>
	</section>
	<section id="testimonials">
		<hr class="lg">
		<div class="container">
			<h4 class="yellow">Happy Client's</h4>
			<h2 class="h1">Testimonials</h2>
			
			<div class="swiper-container row" id="testimonials-slider">
				<div class="swiper-wrapper">
					<div class="col-md-4 col-sm-6 swiper-slide">
						<div class="inner matchHeight">
							<div class="text">
								<p>Everything went perfectly! Incredibly punctual, friendly drivers, and a very fast customer service that answered my questions within minutes the night before my return trip. I highly recommend booking here, and will definitely do so again in the future.</p>
							</div>
							<div class="quote">
								<span class="fa fa-quote-left"></span>
								<div class="name">Amanda Jayasinghe</div>
								<img src="assets/cs/images/_client-1.jpg" alt="Client">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 swiper-slide">
						<div class="inner matchHeight">
							<div class="text">
								<p>Fantastic service. Driver on time despite very very tricky hotel location. Would defiantly recommend 100%.</p>
							</div>				
							<div class="quote">		
								<span class="fa fa-quote-left"></span>
								<div class="name">Ashen Fernando</div>
								<img src="assets/cs/images/_client-2.jpg" alt="Client">
							</div>
						</div>
					</div>	
					<div class="col-md-4 col-sm-6 swiper-slide">
						<div class="inner matchHeight">
							<div class="text">
								<p>The service was excellent - thank you. My driver was waiting at Arrivals for me with a clear sign. He introduced himself, was very polite and friendly and drove me to my hotel with no delay. I will be pleased to recommend this service to my family and friends.</p>
							</div>			
							<div class="quote">			
								<span class="fa fa-quote-left"></span>
								<div class="name">Anya Gamage</div>
								<img src="assets/cs/images/_client-3.jpg" alt="Client">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 swiper-slide">
						<div class="inner matchHeight">
							<div class="text">
								<p>Excellent service. My driver was waiting at Arrivals for me with a clear sign. He was very polite and friendly and drove me with no delay.</p>
							</div>
							<div class="quote">
								<span class="fa fa-quote-left"></span>
								<div class="name">Dilan Kavinda</div>
								<img src="assets/cs/images/_client-4.jpg" alt="Client">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 swiper-slide">
						<div class="inner matchHeight">
							<div class="text">
								<p>Driver prompt and courteous. He was helpful with the luggage and dropped us near the airport door for our airlines in spite of large numbers of other travelers. Thank you. </p>
							</div>				
							<div class="quote">		
								<span class="fa fa-quote-left"></span>
								<div class="name">Nipuni Dias</div>
								<img src="assets/cs/images/_client-5.jpg" alt="Client">
							</div>
						</div>
					</div>	
					<div class="col-md-4 col-sm-6 swiper-slide">
						<div class="inner matchHeight">
							<div class="text">
								<p>Our flight was delayed by two hours, so we arrived at katunayake airport at 2am. The driver was awaiting at the arrivals hall for me, when we finally got their. All the people I communicated with were pleasant and cheerful.</p>
							</div>			
							<div class="quote">			
								<span class="fa fa-quote-left"></span>
								<div class="name">Gayan Perera</div>
								<img src="assets/cs/images/_client-6.jpg" alt="Client">
							</div>
						</div>
					</div>					
				</div>
				<div class="arrows">
					<a href="#" class="arrow-left fa fa-caret-left"></a>
					<a href="#" class="arrow-right fa fa-caret-right"></a>
				</div>				
			</div>
		</div>
	</section>

	<section id="block-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 col-ms-6">
					<h4>About us</h4>
					<p>The GoCheeta software is a platform that facilitates a real time connection between the taxi passenger and the taxi driver, enabling mutual engagement for the receipt and delivery of a seamless service.</p>

					<div class="social-small social-yellow">
						<a href="#" class="fa fa-twitter"></a>
						<a href="#" class="fa fa-facebook"></a>
						<a href="#" class="fa fa-instagram"></a>
						<a href="#" class="fa fa-google-plus"></a>
						<a href="#" class="fa fa-pinterest"></a>
					</div>					
				</div>
				<div class="col-lg-5 col-md-5 hidden-md hidden-sm hidden-xs hidden-ms">					
					<h4>Explore</h4>
					<div class="row">
						<div class="col-md-5">
							<ul class="nav navbar-nav">
								<li><a href="#get-taxi">Get Taxi</a></li>
								<li><a href="#services">Services</a></li>
								<li><a href="#tariffs">Tariffs</a></li>
								<li><a href="#download">Application</a></li>

							</ul>						
						</div>
						<div class="col-md-5">
							<ul class="nav navbar-nav">
								<li><a href="#car-block">Become a driver</a></li>
								<li><a href="#testimonials">Testimonials</a></li>
								<li><a href="login">Login</a></li>
								<li><a href="register">Register</a></li>
							</ul>						
						</div>						
					</div>

				</div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-ms-6">					
					<h4>Contact us</h4>
					<p><span class="yellow">Address:</span> No.500, Baseline Road, Colombo 14</p>

					<ul class="address">
						<li><span class="fa fa-phone"></span>0112-800-800</li>
						<li><span class="fa fa-envelope"></span><a href="#">info@gocheeta.lk</a></li>
						<li><span class="fa fa-skype"></span>GoCheeta</li>
					</ul>					
				</div>		
			</div>
		</div>
	</section>

	<footer>
		<?php require_once("inc/footer_c.php"); ?>
	</footer>

	<script type="text/javascript" src="assets/cs/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/cs/js/plugins.min.js"></script>	
	<script type="text/javascript" src="assets/cs/js/scripts.js"></script>

	<script>
		$('.gtr').click(function() {
			window.location.href='login?act=h';
		});

		function priceCalculate(e){
			if(e > 0){
				var category = e;
			}else{
				var category = $('#category').val();
			}
			var pickup_location = $('#pickup_location').val();
			var drop_location = $('#drop_location').val();
			var date = $('#date').val();

			$("#dle").hide();
			if(pickup_location!==null && pickup_location==drop_location){
				$("#dle").show();
				$('#milage').text('0');
				$('#rate').text('0.00');
			}else if(pickup_location!==null && drop_location!==null){
				$("#res").load("price_calculate.php?category="+category+"&pickup_location="+pickup_location+"&drop_location="+drop_location+"&date="+date);
			}
		}

		$('.pc').change(function() {
			priceCalculate(0)
		});

		

	</script>
</body>
</html>