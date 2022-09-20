<?php
require_once("inc/session.php");

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

$username = $cpassword = $first_name = $last_name = $email = $telephone = '';

if(isset($_GET['id']))
{
	if($userDetails = $auth_user->selectUser($_GET['id']))
	{
		$username = $userDetails['username'];
		$first_name = $userDetails['first_name'];
		$last_name = $userDetails['last_name'];
		$email = $userDetails['email'];
		$telephone = $userDetails['telephone'];
	}
	else
	{
		$auth_user->redirect('view_users.php');
	}
	$title = 'Edit';
}
else
{
	$title = 'Add';
}

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	$u_type = 'Client';
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
     
    
	if(empty($password))
	{
		$password = $userDetails['password'];
	}
	else
	{        
        if($password != $cpassword){
            $error[] = "Password and confirmation password do not match!";
        }
        if(strlen($password) < 8) {
            $error[] = "Password must contain at least 8 Characters!";
        }
        if(!preg_match("#[0-9]+#",$password)) {
            $error[] = "Password must contain at least 1 Number!";
        }
        if(!preg_match("#[A-Z]+#",$password)) {
            $error[] = "Password must contain at least 1 Capital Letter!";
        }
        if(!preg_match("#[a-z]+#",$password)) {
            $error[] = "Password must contain at least 1 Lowercase Letter!";
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
	}
    	
    if(!isset($error))
    {
        if(isset($_GET['id']))
        {
            if($auth_user->editUser($_GET['id'],$username,$password,$first_name,$last_name,$telephone,$email,$u_type))
            {
                $success = 'Client '.$username.' edited';
                $cpassword = '';
            }
            else
            {
                $error[] = 'Username '.$username.' already exist!';
            }
        }
        else
        {	
            if($res = $auth_user->register($username,$password,$first_name,$last_name,$telephone,$email,$u_type))
            {                    
                if($res=='usernameExist'){
                    $error[] = 'Username '.$username.' already exist!';
                    $username = '';
                }else if($res=='emailExist'){
                    $error[] = 'Email '.$email.' already exist!';
                    $email = '';
                }else{
                    $success = 'New Client '.$username.' added';
                    $username = $cpassword = $first_name = $last_name = $email = $telephone = '';
                }  
            }
        }
    }
    else
    {
        $cpassword = '';
    }
}
?>