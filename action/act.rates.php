<?php
require_once("inc/session.php");
require_once("classes/class.rates.php");
$class_rates = new RATES();

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_GET['category'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
		$milage = $_POST['milage'];
		$rate = $_POST['rate'];
	
		$result = $class_rates->updateRates($_GET['category'], $from, $to, $milage, $rate, $user_id);            
		if(isset($result['error']))
		{
			$error[] = SYSTEMERROR($result['error']);
		}else{
			$success = 'Rate Updated';
		}
	}else{
		$error[] = 'Please select category first';
	}
}

$categoriesData = '';
if($cAll = $class_rates->selectCategories())
{
	foreach($cAll as $cRec)
	{      
		if(isset($_GET['category']) && $_GET['category']==$cRec['id']){$slct = 'selected'; $ce = true;}else{$slct = '';}
		$categoriesData .= '<option '.$slct.' value="'.$cRec['id'].'"">'.$cRec['category'].'</option>';
	}	
}

$rates = '';
if(isset($_GET['category']) && isset($ce)){
	$branches = $class_rates->selectBranches();
	$bcount = $blcount = count($branches);
	foreach($branches as $branch){	
		$blcount--;
		for($i=0; $i<$blcount; $i++){
			if($rec = $class_rates->selectRates($_GET['category'], $branch['id'], $branches[$bcount-$blcount+$i]['id'])){
				$milage = $rec['milage'];
				$rate = $rec['rate'];
			}else{
				$milage = $rate = '';
			}

			$rates .= '
			<form action="" method="post">
				<div class="form-group row">
					<div class="col-sm-2">
						<input type="hidden" name="from" value="'.$branch['id'].'">
						<input readonly class="form-control" type="text" value="'.$branch['branch'].'">
					</div>
					<label for="username-input" class="col-sm-1 col-form-label"><center>TO</center></label>
					<div class="col-sm-2">
						<input type="hidden" name="to" value="'.$branches[$bcount-$blcount+$i]['id'].'">
						<input readonly class="form-control" type="text" value="'.$branches[$bcount-$blcount+$i]['branch'].'">
					</div>
					<label for="username-input" class="col-sm-1 col-form-label"><center>X</center></label>
					<div class="col-sm-2">
						<input required class="form-control" type="number" name="milage" placeholder="Milage (KM)" value="'.$milage.'">
					</div>
					<label for="username-input" class="col-sm-1 col-form-label"><center>=</center></label>
					<div class="col-sm-2">
						<input required class="form-control currency" step="0.01" type="number" name="rate" placeholder="Rate (LKR)" value="'.$rate.'">
					</div>
					<div class="col-sm-1">
						<button type="submit" name="submit" class="btn btn-warning">&nbsp;<i class="ion-edit "></i>&nbsp;</button>
					</div>
				</div>
			</form>';
		}
	}
}