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
$submn_id=$_GET['submn_id'];
$sql_view="Select * from ".TBL_MENULEVEL2." as A1 inner join ".TBL_MENULEVEL1." as A2 on A1.mn_id=A2.mn_id where A1.submn_id=".$submn_id;
$RowMenuLevel2Update=$cls->fns_Rows($sql_view);
#--------------------------------------------------------------------------
#POST DATA
if(isset($_POST['updateMenuLevel2']) && $_POST['updateMenuLevel2']=='updateMenuLevel2'){  
   $tontai=0;   
   $submn_name  =$_POST['submn_name'];
   $submn_order =$_POST['submn_order'];     
   
   $sql_check="select * from ".TBL_MENULEVEL2." where submn_order=".$submn_order; 
   
   //if($cls->fns_IsRecord($sql_check)) {
       //echo "if0";
      //$tontai=1;
	 // $lblDisplay="&raquo; Thu tu cua menu con nay da ton tai !";
  // }
   //if($permis==0){
   		//echo "if1";
	  $sql=" UPDATE ".TBL_MENULEVEL2." 
	         SET     submn_name='$submn_name',
			         submn_order='$submn_order'		       
			WHERE    submn_id=$submn_id        
		   ";
	$result=mysql_query($sql) or die("Not Update This MenuLevel2.");		  
	   header("Location: menulevel2.list.php?page=0");
	//} 
	
 }
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('RowMenuLevel2Update',$RowMenuLevel2Update);
$smarty->assign('lblDisplay',$lblDisplay);
#--------------------------------------------------------------------------

$smarty->display($template_root.'administrator/menulevel2.edit.tpl');
?>
