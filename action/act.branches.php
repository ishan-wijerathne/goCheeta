<?php
require_once("inc/session.php");
require_once("classes/class.branches.php");
$class_branches = new BRANCHES();

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

if(isset($_GET['deleteb']))
{
    if($result = $class_branches->deleteBranch($_GET['deleteb']))
    { 
        if(isset($result['error']))
        {
            if($result['error']!='DNE'){
                $error[] = SYSTEMERROR($result['error']);
            }
        }
        else
        {                  
            $success = 'Branch Deleted';

        }
    }
}
elseif($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$id = $_POST['id'];
	$branch = $_POST['branch'];

    if(empty($id)){
        $result = $class_branches->addBranch($branch, $user_id);            
        if(isset($result['error']))
        {
            $error[] = SYSTEMERROR($result['error']);
        }else{
            $success = 'New branch added';
        }
    }else{
        $result = $class_branches->editBranch($id, $branch, $user_id);            
        if(isset($result['error']))
        {
            $error[] = SYSTEMERROR($result['error']);
        }
        else
        {
            $success = 'Branch Edited';
        }
    }


}

$branchesData = '';
if($bAll = $class_branches->selectBranchs())
{
	foreach($bAll as $bRec)
	{      
		$branchesData .= '
			<tr>
                <td id="b-'.$bRec['id'].'">'.$bRec['branch'].'</td>
                <td>'.$bRec['first_name'].' '.$bRec['last_name'].'</td>
                <td>'.$bRec['modified_date'].'</td>
				<td>                
				    <a data-style="expand-right" href="javascript:;" class="addm bedit" id="'.$bRec['id'].'"><span style="font-size:14px" class="badge badge-warning"><i class="ion-edit "></i></span></a>
                    <a data-style="expand-right" href="branches?deleteb='.$bRec['id'].'"><span style="font-size:14px" class="badge badge-danger dlt"><i class="ion-trash-a "></i></span></a>  
                </td>				
			</tr>
		';
	}	
}