<?php
require_once("inc/session.php");
require_once("classes/class.bookings.php");
$class_bookings = new BOOKINGS();

if(isset($_GET['id']))
{   
	if($res = $class_bookings->updateBooking($_GET['id'], base64_decode($_GET['action']), $user_id))
	{         
        if($res=='true')
        {
            $auth_user->redirect('bookings');
        }
        else
        { 
            $error[] = $res;
        }
	}
}

if(isset($_POST['feedback']))
{   
	if($res = $class_bookings->updateFeedback($_POST['id'], $_POST['feedback'], $user_id))
	{         
        if($res=='true')
        {
            $success = 'Thank you for your feedback much appreciated!';
        }
        else
        { 
            $error[] = $res;
        }
	}
}

$datalist = '';

if($user_type=='Client'){
    if($bookingsAll = $class_bookings->selectBookingsbyClient($user_id))
    {
        foreach($bookingsAll as $bData)
        {
            if($bData['status']=='Processing' || $bData['status']=='Driver Accepted'){
                $actBtnTH = true;
                $actBtn = '<td><a class="actb" data-style="expand-right" href="bookings?id='.$bData['id'].'&action='.base64_encode('Cancelled').'"><span style="font-size:14px" class="badge badge-danger">Cancel</span></a></td>';                
            }elseif(!empty($bData['feedback'])){
                $actBtn = '<td></td>'; 
            }elseif($bData['status']=='Trip Completed' || $bData['status']=='Cancelled'){
                $actBtnTH = true;
                $actBtn = '<td><a data-style="expand-right" href="javascript:;"><span id="'.$bData['id'].'" style="font-size:14px" class="badge badge-success addf">Feedback</span></a></td>'; 
            }else{
                $actBtn = '<td></td>'; 
            }

            $datalist .= '
                <tr>
                    <td>'.$bData['id'].'</td>
                    <td>'.$bData['pickup_location_name'].'</td>
                    <td>'.$bData['pickup_address'].'</td>
                    <td>'.$bData['drop_location_name'].'</td>
                    <td>'.$bData['drop_address'].'</td>
                    <td>'.date('Y-m-d H:i A', strtotime($bData['pickup_date'].' '.$bData['pickup_time'])).'</td>
                    <td>'.$bData['milage'].' KM</td>
                    <td>Rs.'.number_format($bData['rate'], 2).'</td>
                    <td>'.$bData['plate_no'].'</td>
                    <td>'.$bData['category'].'</td>
                    <td>'.$bData['model'].'</td>
                    <td>'.$bData['passengers'].'</td>
                    <td>'.$bData['first_name'].' '.$bData['last_name'].'</td>
                    <td>'.$bData['telephone'].'</td>
                    <td>'.$bData['status'].'</td>
                    <td>'.$bData['feedback'].'</td>
                    '.$actBtn.'		
                </tr>';
        }	
    }
}elseif($user_type=='Driver'){
    if($bookingsAll = $class_bookings->selectBookingsbyDriver($user_id))
    {
        foreach($bookingsAll as $bData)
        {
            if($bData['status']=='Processing'){
                $actBtnTH = true;
                $actBtn = '<td><a data-style="expand-right" href="bookings?id='.$bData['id'].'&action='.base64_encode('Driver Accepted').'"><span style="font-size:14px" class="badge badge-info">Accept</span></a></td>';                 
            }elseif($bData['status']=='Driver Accepted'){
                $actBtnTH = true;
                $actBtn = '<td><a data-style="expand-right" href="bookings?id='.$bData['id'].'&action='.base64_encode('Picked up').'"><span style="font-size:14px" class="badge badge-warning">Picked up</span></a></td>';                
            }elseif($bData['status']=='Picked up'){
                $actBtnTH = true;
                $actBtn = '<td><a data-style="expand-right" href="bookings?id='.$bData['id'].'&action='.base64_encode('Trip Completed').'"><span style="font-size:14px" class="badge badge-success">Complete</span></a></td>'; 
            }else{
                $actBtn = '<td></td>'; 
            }

            $datalist .= '
                <tr>
                    <td>'.$bData['id'].'</td>
                    <td>'.$bData['c_first_name'].' '.$bData['c_last_name'].'</td>
                    <td>'.$bData['c_telephone'].'</td>
                    <td>'.$bData['pickup_location_name'].'</td>
                    <td>'.$bData['pickup_address'].'</td>
                    <td>'.$bData['drop_location_name'].'</td>
                    <td>'.$bData['drop_address'].'</td>
                    <td>'.date('Y-m-d H:i A', strtotime($bData['pickup_date'].' '.$bData['pickup_time'])).'</td>
                    <td>'.$bData['milage'].' KM</td>
                    <td>Rs.'.number_format($bData['rate'], 2).'</td>
                    <td>'.$bData['status'].'</td>
                    <td>'.$bData['feedback'].'</td>
                    '.$actBtn.'				
                </tr>';
        }	
    }
}else{

    if($bookingsAll = $class_bookings->selectBookings())
    {
        foreach($bookingsAll as $bData)
        {
            if($bData['status']=='Processing' || $bData['status']=='Driver Accepted'){
                $actBtnTH = true;
                $actBtn = '<td><a class="actb" data-style="expand-right" href="bookings?id='.$bData['id'].'&action='.base64_encode('Cancelled').'"><span style="font-size:14px" class="badge badge-danger">Cancel</span></a></td>';                       
            }elseif(!empty($bData['feedback'])){
                $actBtn = '<td></td>'; 
            }elseif($bData['modified_by']==$user_id && $bData['status']=='Cancelled'){
                $actBtnTH = true;
                $actBtn = '<td><a data-style="expand-right" href="javascript:;"><span id="'.$bData['id'].'" style="font-size:14px" class="badge badge-success addf">Feedback</span></a></td>'; 
            }else{
                $actBtn = '<td></td>'; 
            }

            $datalist .= '
                <tr>
                    <td>'.$bData['id'].'</td>
                    <td>'.$bData['c_first_name'].' '.$bData['c_last_name'].'</td>
                    <td>'.$bData['c_telephone'].'</td>
                    <td>'.$bData['pickup_location_name'].'</td>
                    <td>'.$bData['pickup_address'].'</td>
                    <td>'.$bData['drop_location_name'].'</td>
                    <td>'.$bData['drop_address'].'</td>
                    <td>'.date('Y-m-d H:i A', strtotime($bData['pickup_date'].' '.$bData['pickup_time'])).'</td>
                    <td>'.$bData['milage'].' KM</td>
                    <td>Rs.'.number_format($bData['rate'], 2).'</td>
                    <td>'.$bData['plate_no'].'</td>
                    <td>'.$bData['category'].'</td>
                    <td>'.$bData['model'].'</td>
                    <td>'.$bData['passengers'].'</td>
                    <td>'.$bData['first_name'].' '.$bData['last_name'].'</td>
                    <td>'.$bData['telephone'].'</td>
                    <td>'.$bData['branch_name'].'</td>
                    <td>'.$bData['status'].'</td>
                    <td>'.$bData['feedback'].'</td>
                    '.$actBtn.'				
                </tr>';
        }	
    }
}