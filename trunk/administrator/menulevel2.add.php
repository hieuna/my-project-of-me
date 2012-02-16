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


$sql_view="Select * from ".TBL_MENULEVEL1;
$RowaMenuLevel1=$cls->fns_Rows($sql_view);
#POST DATA
if(isset($_POST['addMenuLevel2']) && $_POST['addMenuLevel2']=='addMenuLevel2')
 {
   $submn_name  =$_POST['submn_name'];
   $submn_order =$_POST['submn_order'];   
   $mn_id       =$_POST['mn_id'];
   $sql=" INSERT INTO ".TBL_MENULEVEL2." (mn_id,submn_name,submn_order)
	         VALUES ('$mn_id','$submn_name','$submn_order')	         
		   ";
	$result=mysql_query($sql) or die("Not Insert This MenuLevel2.");		  
	header("Location: menulevel2.list.php?page=0");	
   
 }
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('lblDisplay',$lblDisplay);
$smarty->assign('RowaMenuLevel1',$RowaMenuLevel1);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/menulevel2.add.tpl');
?>
