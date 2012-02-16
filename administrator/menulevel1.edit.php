<?
ob_start();
session_start();
require '../config/config.php';
require $include_dir.'/clsCommons.php';
require $include_dir.'/FCKeditor/fckeditor.php';
require $include_dir.'/clsPaging.php';
require $include_dir.'/define.table.php';
require 'check.login.php';
#--------------------------------------------------------------------------
$cls = new clsCommons();
$lblDisplay='';
#--------------------------------------------------------------------------
#LOAD DATA
$mn_id=$_GET['mn_id'];
$sql_view="Select * from ".TBL_MENULEVEL1." where mn_id=".$mn_id;
$RowMenuLevel1Update=$cls->fns_Rows($sql_view);
#--------------------------------------------------------------------------
#POST DATA
if(isset($_POST['updateMenuLevel1']) && $_POST['updateMenuLevel1']=='updateMenuLevel1'){  
	
   $mn_name  =$_POST['mn_name'];
   $mn_order =$_POST['mn_order']; 
      
   $sql_check="select * from ".TBL_MENULEVEL1." where mn_id=$mn_id";  
   if($cls->fns_IsRecord($sql_check)) {      
      $sql=" UPDATE ".TBL_MENULEVEL1." 
	         SET     mn_name='$mn_name',
			         mn_order='$mn_order'		       
			WHERE    mn_id=$mn_id        
		   ";
		   $result=mysql_query($sql) or die("Not Update This MenuLevel1.");		  
		   header("Location: menulevel1.list.php?page=0");
	}
   else {   
    $lblDisplay="&bull; Xin vui lòng: <br>".$lblDisplay;	
   }	
 }

#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('RowMenuLevel1Update',$RowMenuLevel1Update);
$smarty->assign('lblDisplay',$lblDisplay);
#--------------------------------------------------------------------------

$smarty->display($template_root.'administrator/menulevel1.edit.tpl');
?>
