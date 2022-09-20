<?php
require_once("inc/session.php");
require_once("classes/class.dashboard.php");
$class_dashboard = new DASHBOARD();

$reports = '';
$total_bookings = $on_going_bookings = $cancelled_bookings = $completed_bookings = $users = $clients = $vehicles = $branches = 0;
if(in_array($user_type, array('Admin', 'Staff'))){
    
    if($bAll = $class_dashboard->bookings())
    {
        $total_bookings = count($bAll);
        foreach($bAll as $bRec)
        {      
            if($bRec['status']=='Cancelled'){$cancelled_bookings++;}
            elseif($bRec['status']=='Trip Completed'){$completed_bookings++;}
            else{$on_going_bookings++;}
        }	
    }
    
    if($uAll = $class_dashboard->users())
    {
        foreach($uAll as $uRec)
        {      
            if($uRec['user_type']=='Client'){$clients++;}
            elseif($uRec['user_type']=='Admin' || $uRec['user_type']=='Staff'){$users++;}
        }	
    }

    $vehicles = $class_dashboard->vehicles();

    $branches = $class_dashboard->branches();

}elseif(in_array($user_type, array('Client'))){
    
    if($bAll = $class_dashboard->bookingsbyClient($user_id))
    {
        $total_bookings = count($bAll);
        foreach($bAll as $bRec)
        {      
            if($bRec['status']=='Cancelled'){$cancelled_bookings++;}
            elseif($bRec['status']=='Trip Completed'){$completed_bookings++;}
            else{$on_going_bookings++;}
        }	
    }

}elseif(in_array($user_type, array('Driver'))){
    
    if($bAll = $class_dashboard->bookingsbyDriver($user_id))
    {
        $total_bookings = count($bAll);
        foreach($bAll as $bRec)
        {      
            if($bRec['status']=='Cancelled'){$cancelled_bookings++;}
            elseif($bRec['status']=='Trip Completed'){$completed_bookings++;}
            else{$on_going_bookings++;}
        }	
    }
}
    
$reports .= '
<div class="col-xl-3 col-md-6">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="mdi mdi-diamond float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0">Total Bookings</h6>
        </div>
        <div class="card-body">
            <div class="mt-4 text-muted">
                <center><h1>'.$total_bookings.'</h1></center>
            </div>
        </div>
    </div>
</div>';

$reports .= '
<div class="col-xl-3 col-md-6">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="mdi mdi-clipboard-check float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0">On Going Bookings</h6>
        </div>
        <div class="card-body">
            <div class="mt-4 text-muted">
                <center><h1>'.$on_going_bookings.'</h1></center>
            </div>
        </div>
    </div>
</div>';

$reports .= '
<div class="col-xl-3 col-md-6">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="mdi mdi-close-octagon float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0">Cancelled Bookings</h6>
        </div>
        <div class="card-body">
            <div class="mt-4 text-muted">
                <center><h1>'.$cancelled_bookings.'</h1></center>
            </div>
        </div>
    </div>
</div>';

$reports .= '
<div class="col-xl-3 col-md-6">
    <div class="card mini-stat m-b-30">
        <div class="p-3 bg-primary text-white">
            <div class="mini-stat-icon">
                <i class="mdi mdi-star-circle float-right mb-0"></i>
            </div>
            <h6 class="text-uppercase mb-0">Completed Bookings</h6>
        </div>
        <div class="card-body">
            <div class="mt-4 text-muted">
                <center><h1>'.$completed_bookings.'</h1></center>
            </div>
        </div>
    </div>
</div>';

if(in_array($user_type, array('Admin'))){
    
    $reports .= '
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-account-multiple float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Users</h6>
            </div>
            <div class="card-body">
                <div class="mt-4 text-muted">
                    <center><h1>'.$users.'</h1></center>
                </div>
            </div>
        </div>
    </div>';

} if(in_array($user_type, array('Admin', 'Staff'))){
    
    $reports .= '
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-account-convert float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Clients</h6>
            </div>
            <div class="card-body">
                <div class="mt-4 text-muted">
                    <center><h1>'.$clients.'</h1></center>
                </div>
            </div>
        </div>
    </div>';
    
    $reports .= '
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="ion-model-s float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Vehicles</h6>
            </div>
            <div class="card-body">
                <div class="mt-4 text-muted">
                    <center><h1>'.$vehicles.'</h1></center>
                </div>
            </div>
        </div>
    </div>';
    
    $reports .= '
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
                <div class="mini-stat-icon">
                    <i class="mdi mdi-home-map-marker float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Branches</h6>
            </div>
            <div class="card-body">
                <div class="mt-4 text-muted">
                    <center><h1>'.$branches.'</h1></center>
                </div>
            </div>
        </div>
    </div>';
}
?>