<?php
    require_once 'classes/class.settings.php';
    $settings = new SETTINGS();
    require_once 'classes/class.user.php';
    $auth_user = new USER();
	
	if(!$auth_user->is_loggedin()){
		$auth_user->redirect('login.php');
	}

	$user_id = $_SESSION['user_session'];
	if($userRow=$auth_user->selectUser($user_id)){
		$user_type = $userRow['user_type'];
		$user_name = $userRow['username'];
		$user_full_name = $userRow['first_name'].' '.$userRow['last_name'];
		$user_first_name = $userRow['first_name'];
	}