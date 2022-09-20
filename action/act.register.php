<?php
require_once 'classes/class.settings.php';
$settings = new SETTINGS();
require_once 'classes/class.user.php';
$auth_user = new USER();

$username = $rpassword = $cpassword = $first_name = $last_name = $email = $telephone = '';

if(isset($_POST['register']))
{
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	$rpassword = $password = $_POST['password'];
	$cpassword = $_POST['c_password'];
	$user_type = 'Client';
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}     
           
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
    	
    if(!isset($error))
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        if($res = $auth_user->register($username, $password, $first_name, $last_name, $telephone, $email, $user_type))
        {   
            if($res=='usernameExist'){
                $error[] = 'Username '.$username.' already exist!';
                $username = '';
            }else if($res=='emailExist'){
                $error[] = 'Email '.$email.' already exist!';
                $email = '';
            }else{
                $success = 'Congratulations, your account has been successfully created.';
                $username = $rpassword = $cpassword = $first_name = $last_name = $email = $telephone = '';
            }            
        }
        else
        {
            $error[] = 'Please try again!';
        }
    }
}
?>