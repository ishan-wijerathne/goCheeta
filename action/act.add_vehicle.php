<?php
require_once("inc/session.php");
require_once("classes/class.vehicles.php");
$class_vehicles = new VEHICLES();

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

$category = $branch = $plate_no = $model = $passengers = $username = $cpassword = $first_name = $last_name = $email = $telephone = $u_type = $cuser_type = '';

if(isset($_GET['id']))
{
	if($vehicleDetails = $class_vehicles->selectvehicle($_GET['id']))
	{
		$category = $vehicleDetails['category_id'];
		$branch = $vehicleDetails['branch_id'];
		$plate_no = $vehicleDetails['plate_no'];
		$model = $vehicleDetails['model'];
		$passengers = $vehicleDetails['passengers'];
		$driver_id = $vehicleDetails['driver_id'];
		$username = $vehicleDetails['username'];
		$first_name = $vehicleDetails['first_name'];
		$last_name = $vehicleDetails['last_name'];
		$email = $vehicleDetails['email'];
		$telephone = $vehicleDetails['telephone'];
	}
	else
	{
		$auth_user->redirect('vehicles');
	}
	$title = 'Update';
}
else
{
	$title = 'Add';
}

if(isset($_POST['submit']))
{
    $category = $_POST['category'];
    $branch = $_POST['branch'];
    $plate_no = strtoupper($_POST['plate_no']);
    $model = $_POST['model'];
    $passengers = $_POST['passengers'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address !';
	}
     
    
	if(empty($password))
	{
		$password = $vehicleDetails['password'];
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
            if($res = $class_vehicles->editVehicle($_GET['id'], $driver_id, $category, $branch, $plate_no, $model, $passengers, $username,$password,$first_name,$last_name,$telephone,$email, $user_id))
            {                
                if($res=='usernameExist'){
                    $error[] = 'Username '.$username.' already exist!';
                    $username = '';
                }else if($res=='emailExist'){
                    $error[] = 'Email '.$email.' already exist!';
                    $email = '';
                }else if($res=='plateNoExist'){
                    $error[] = 'Plate No '.$plate_no.' already exist!';
                    $plate_no = '';
                }else if($res=='true'){
                    $success = 'vehicle '.$plate_no.' updated';
                    $password = $cpassword = '';
                }else{
                    $error[] = $res;
                }
            }
        }
        else
        {	
            if($res = $class_vehicles->addVehicle($category, $branch, $plate_no, $model, $passengers, $username,$password,$first_name,$last_name,$telephone,$email,$u_type, $user_id))
            {                    
                if($res=='usernameExist'){
                    $error[] = 'Username '.$username.' already exist!';
                    $username = '';
                }else if($res=='emailExist'){
                    $error[] = 'Email '.$email.' already exist!';
                    $email = '';
                }else if($res=='plateNoExist'){
                    $error[] = 'Plate No '.$plate_no.' already exist!';
                    $plate_no = '';
                }else if($res=='true'){
                    $success = 'New vehicle '.$plate_no.' added';
                    $category = $branch = $plate_no = $model = $passengers = $username = $cpassword = $first_name = $last_name = $email = $telephone = '';
                }else{
                    $error[] = $res;
                }
            }
        }
    }
    else
    {
        $cpassword = '';
    }
}

$categoriesData = '';
if($cAll = $class_vehicles->selectCategories())
{
	foreach($cAll as $cRec)
	{      
		if($category==$cRec['id']){$slct = 'selected'; $ce = true;}else{$slct = '';}
		$categoriesData .= '<option '.$slct.' value="'.$cRec['id'].'"">'.$cRec['category'].'</option>';
	}	
}

$branchesData = '';
if($bAll = $class_vehicles->selectBranches())
{
	foreach($bAll as $bRec)
	{      
		if($branch==$bRec['id']){$slct = 'selected';}else{$slct = '';}
		$branchesData .= '<option '.$slct.' value="'.$bRec['id'].'"">'.$bRec['branch'].'</option>';
	}	
}
?>