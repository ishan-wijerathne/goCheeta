<?php
require_once 'classes/class.settings.php';
$settings = new SETTINGS();
require_once("classes/class.index.php");
$class_index = new INDEX();


if(isset($_POST['pickup_location']))
{
	$pickup_location = $_POST['pickup_location'];
	$drop_location = $_POST['drop_location'];
	$pickup_address = $_POST['pickup_address'];
	$drop_address = $_POST['drop_address'];
	$pickup_date = $_POST['pickup_date'];
	$pickup_time = $_POST['pickup_time'];
	$vehicle = $_POST['vehicle'];

    if($res = $class_index->newBooking($pickup_location, $drop_location, $pickup_address, $drop_address, $pickup_date, $pickup_time, $vehicle, $_SESSION['user_session']))
    {                    
        if($res=='true'){
            $success = 'You successfully created your booking';
        }else{
            $error = $res;
        }  
    }
}

$categoriesData = '';
if($cAll = $class_index->selectCategories())
{
	foreach($cAll as $cRec)
	{   if(!isset($fv)){$fv = $cRec['id']; $fvs='active';}else{$fvs='';} 
        if($cRec['icon']=='luxury-car.png'){$tc = 'red';}else{$tc = '';}
		$categoriesData .= '<a href="#" data-value="'.$cRec['id'].'" onclick="priceCalculate('.$cRec['id'].')" class="'.$fvs.' '.$tc.'" style="background-image: url(\'assets/cs/images/'.$cRec['icon'].'\')">'.$cRec['category'].'</a>';
	}	
}

$locations = '';
if($cAll = $class_index->selectLocations())
{
	foreach($cAll as $cRec)
	{      
		$locations .= '<option value="'.$cRec['id'].'"">'.$cRec['branch'].'</option>';
	}	
}