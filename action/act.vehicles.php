<?php
require_once("inc/session.php");
require_once("classes/class.vehicles.php");
$class_vehicles = new VEHICLES();

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

if(isset($_GET['delete']))
{   
    $vehicle_id= $_GET['delete'];
	if($class_vehicles->deleteVehicle($vehicle_id))
	{         
        if(isset($result['error']))
        {
            if($result['error']!='DNE'){
                $error[] = SYSTEMERROR($result['error']);
            }
        }
        else
        {                  
            $success = 'Vehicle Deleted';

        }
	}
}

$datalist = '';

if($vehiclesAll = $class_vehicles->selectvehicles())
{
	foreach($vehiclesAll as $vData)
	{
		$datalist .= '
			<tr>
				<td>'.$vData['id'].'</td>
				<td>'.$vData['plate_no'].'</td>
				<td>'.$vData['category'].'</td>
				<td>'.$vData['model'].'</td>
				<td>'.$vData['passengers'].'</td>
				<td>'.$vData['first_name'].' '.$vData['last_name'].'</td>
				<td>'.$vData['telephone'].'</td>
				<td>
					<a data-style="expand-right" href="add_vehicle?id='.$vData['id'].'"><span style="font-size:14px" class="badge badge-warning"><i class="ion-edit "></i></span></a> 
					<a data-style="expand-right" href="vehicles?delete='.base64_encode($vData['id'].'-'.$vData['driver_id']).'" onclick="return confirm(\'Are you sure you want to delete this vehicle?\');"><span style="font-size:14px" class="badge badge-danger"><i class="ion-trash-a "></i></span></a>
				</td>				
			</tr>
		';
	}	
}