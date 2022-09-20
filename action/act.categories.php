<?php
require_once("inc/session.php");
require_once("classes/class.categories.php");
$class_categories = new CATEGORIES();

if(!in_array($user_type, array('Admin', 'Staff'))){$auth_user->redirect('bookings.php');}

if(isset($_GET['deleteb']))
{
    if($result = $class_categories->deleteCategory($_GET['deleteb']))
    { 
        if(isset($result['error']))
        {
            if($result['error']!='DNE'){
                $error[] = SYSTEMERROR($result['error']);
            }
        }
        else
        {                  
            $success = 'Category Deleted';

        }
    }
}
elseif($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$id = $_POST['id'];
	$category = $_POST['category'];
	$icon = $_POST['icon'];

    if(empty($id)){
        $result = $class_categories->addCategory($category, $icon, $user_id);            
        if(isset($result['error']))
        {
            $error[] = SYSTEMERROR($result['error']);
        }else{
            $success = 'New Category added';
        }
    }else{
        $result = $class_categories->editCategory($id, $category, $icon, $user_id);            
        if(isset($result['error']))
        {
            $error[] = SYSTEMERROR($result['error']);
        }
        else
        {
            $success = 'Category Edited';
        }
    }


}

$categoriesData = '';
if($bAll = $class_categories->selectCategories())
{
	foreach($bAll as $bRec)
	{      
		$categoriesData .= '
			<tr>
                <td id="b-'.$bRec['id'].'">'.$bRec['category'].'</td>
                <td>'.$bRec['first_name'].' '.$bRec['last_name'].'</td>
                <td>'.$bRec['modified_date'].'</td>
				<td>          
                    <input type="hidden" id="i-'.$bRec['id'].'" value="'.$bRec['icon'].'">   
				    <a data-style="expand-right" href="javascript:;" class="addm bedit" id="'.$bRec['id'].'"><span style="font-size:14px" class="badge badge-warning"><i class="ion-edit "></i></span></a>
                    <a data-style="expand-right" href="categories?deleteb='.$bRec['id'].'"><span style="font-size:14px" class="badge badge-danger dlt"><i class="ion-trash-a "></i></span></a>  
                </td>				
			</tr>
		';
	}	
}