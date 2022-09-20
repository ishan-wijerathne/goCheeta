<?php

$db = '';

if($rURI=='/index')
{
	$db = 'active';
}

?>      
 

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <div class="left-side-logo d-block d-lg-none">
        <div class="text-center">

            <a href="index.html" class="logo"><img src="assets/images/logo-dark.png" height="20" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li><a href="dashboard" class="waves-effect"><i class="ion-ios7-speedometer"></i><span> Dashboard</span></a></li>
                
                <?php if(in_array($user_type, array('Admin', 'Staff'))){ ?>  
                    
                    <li><a href="bookings" class="waves-effect"><i class="ion-android-note"></i> Bookings</a></li>
                    
                    <li><a href="clients" class="waves-effect"><i class="ion-android-contacts"></i> Clients</a></li>
                    
                    <li><a href="branches" class="waves-effect"><i class="ion-network"></i> Branches</a></li>
                    
                    <li><a href="categories" class="waves-effect"><i class="ion-ios7-cog"></i> Vehicle Categories</a></li>
                    
                    <li><a href="vehicles" class="waves-effect"><i class="ion-model-s"></i> Vehicles</a></li>
                    
                    <li><a href="rates" class="waves-effect"><i class="ion-calculator"></i> Rates</a></li>

                    <?php if(in_array($user_type, array('Admin'))){ ?>  
                                
                        <li><a href="users" class="waves-effect"><i class="ion-android-social"></i> Users</a></li>

                    <?php } ?> 
                
                <?php }elseif(in_array($user_type, array('Client', 'Driver'))){ ?> 
                    
                    <li><a href="bookings" class="waves-effect"><i class="ion-android-note"></i> Bookings</a></li>
                    
                    <li><a href="add_user?id=<?=$user_id?>" class="waves-effect"><i class="ion-android-social"></i> Profile</a></li>
                
                <?php } ?> 
                
                <li><a href="logout" class="waves-effect"><i class="ion-log-out"></i> Log Out</a></li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->