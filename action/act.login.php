<?php
require_once 'classes/class.settings.php';
$settings = new SETTINGS();
require_once("classes/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('dashboard');
}

if(isset($_POST['txt_uname_email']))
{
	$uname = $_POST['txt_uname_email'];
	$upass = $_POST['txt_password'];
    
    if(!isset($error))
    {		
        if($user = $login->doLogin($uname, $upass))
        { 
            if($_GET['act']=='h')
            {
                $login->redirect('/');
            }
            else
            {
                $login->redirect('dashboard');
            }
        }
        else
        {
            $error[] = "Wrong Details!";
        }	
    }
}
?>