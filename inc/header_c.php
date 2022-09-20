<?php 
    $curi = basename($_SERVER['PHP_SELF']);
    if(!in_array($curi, array('login.php', 'register.php', 'index.php'))){session_start();}
?>

	<div class="navbar-gray-yellow-transparent">
        <div class="nav-wrapper" id="nav-wrapper">
            <nav class="navbar navbar-static navbar-affix" data-spy="affix">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                        <a class="logo" href="/"><img src="assets/cs/images/logo-inner.png" alt="TaxiPark"></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <button type="button" class="navbar-toggle collapsed">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                        <ul class="nav navbar-nav">
                            <li <?php if($curi=='index.php'){echo 'class="current_page_item"';}?>><a href="/">Home</a></li>
                            <!-- <li <?php if($curi=='about_us.php'){echo 'class="current_page_item"';}?>><a href="/">About Us</a></li> -->
                            <?php if(isset($_SESSION['user_session'])){ ?>
                                <li><a href="dashboard">My Account</a></li>
                                <li><a href="logout">Logout</a></li>
                            <?php }else{ ?>
                                <li <?php if($curi=='login.php'){echo 'class="current_page_item"';}?>><a href="login">Login</a></li>
                                <li <?php if($curi=='register.php'){echo 'class="current_page_item"';}?>><a href="register">Register</a></li>
                            <?php } ?>			
                        </ul>
                    </div>		
                </div>
            </nav>
        </div>
    </div>