<script>
	setInterval(function(){ 
		$.get("<?=$fpath?>inc/check.php", function(data){
			if(data=='0'){
                window.location.href="<?=$fpath?>logout.php?logout=timeout";
            }
		}); 
	}, 150*60*1000);
</script>



<!-- Top Bar Start -->
<div class="topbar">

    <div class="topbar-left	d-none d-lg-block">
        <div class="text-center">

            <a href="index.php" class="logo"><img src="assets/images/logo-w.png" height="40" alt="logo"></a>
        </div>
    </div>

    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item notification-list dropdown d-none d-sm-inline-block">
                <?=$user_full_name?>
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="assets/images/users/avatar.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                    <a class="dropdown-item" href="add_user.php?id=<?=$user_id?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                    <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="list-inline-item">
                <button type="button" class="button-menu-mobile open-left waves-effect">
                    <i class="ion-navicon"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>
<!-- Top Bar End -->