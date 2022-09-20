<?php
require_once 'classes/class.settings.php';
$settings = new SETTINGS();
require_once("classes/class.index.php");
$class_index = new INDEX();

$milage = 0;
$rate = 0.00;

if($rec = $class_index->selectRates($_GET['category'], $_GET['pickup_location'], $_GET['drop_location']))
{
    $milage = $rec['milage'];
    $rate = $rec['rate'];
}

$vehicles = '';
$vc = 0;
if(empty($_GET['date']))
{
    $vehicles .= '<option selected style="color:orange" disabled value="">Please select Pick-up Date first</option>';
}
else if($cAll = $class_index->selectAvailableVehicles($_GET['category'], $_GET['pickup_location'], $_GET['date']))
{
    $vc = count($cAll);
	foreach($cAll as $cRec)
	{      
		$vehicles .= '<option value="'.$cRec['id'].'">'.$cRec['model'].' (Max passengers: '.$cRec['passengers'].')</option>';
	}	
}else{    
    $vehicles .= '<option style="color:red" disabled value="">No any available vehicles</option>';
}
?>

<div class="row form-with-labels">
    <div class="col-md-12">
        <div class="form-group">
            <select id="vehicle" name="vehicle" class="ajaxField pc" required>
                <option selected disabled value="">Select Vehicle (<?=$vc?> Vehicles available)</option>
                <?=$vehicles?>
            </select>
        </div>
    </div>
</div>

<div class="row form-with-labels">
    <div class="col-md-6">
        <div class="form-group">
            <span class="pcr">Milage: <lable id="milage"><?=$milage?></lable> KM</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <span class="pcr">LKR <lable id="rate"><?=number_format($rate,2)?></lable></span>
        </div>
    </div>
</div>