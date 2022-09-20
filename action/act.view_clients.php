<?php
require_once("inc/session.php");

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

if(isset($_GET['delete']))
{   
    $user_id= $_GET['delete'];
	if($auth_user->deleteUser($user_id))
	{         
		$success = 'User '.$user_id.' deleted';
	}
	else
	{
		$error[] = 'Error occurred while deleting user '.$user_id;
	}
}

$datalist = '';

if($usersAll = $auth_user->selectClients())
{
	foreach($usersAll as $uData)
	{
		$datalist .= '
			<tr>
				<td>'.$uData['user_id'].'</td>
				<td>'.$uData['username'].'</td>
				<td>'.$uData['first_name'].'</td>
				<td>'.$uData['last_name'].'</td>
				<td>'.$uData['email'].'</td>
				<td>'.$uData['telephone'].'</td>
				<td>
					<a data-style="expand-right" href="add_client.php?id='.$uData['user_id'].'"><span style="font-size:14px" class="badge badge-warning"><i class="ion-edit "></i></span></a> 
					<a data-style="expand-right" href="clients.php?delete='.$uData['user_id'].'" onclick="return confirm(\'Are you sure you want to delete this client?\');"><span style="font-size:14px" class="badge badge-danger"><i class="ion-trash-a "></i></span></a>
				</td>				
			</tr>
		';
	}	
}