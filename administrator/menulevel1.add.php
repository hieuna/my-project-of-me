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
#POST DATA
if(isset($_POST['addMenuLevel1']) && $_POST['addMenuLevel1']=='addMenuLevel1')
 {
   $mn_name  =$_POST['mn_name'];
   $mn_order =$_POST['mn_order'];   
   
   $sql=" INSERT INTO ".TBL_MENULEVEL1." (mn_name,mn_order)
	         VALUES ('$mn_name','$mn_order')	         
		   ";
	$result=mysql_query($sql) or die("Not Insert This MenuLevel1.");		  
	header("Location: menulevel1.list.php?page=0");	
   
 }
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('lblDisplay',$lblDisplay);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/menulevel1.add.tpl');
?>
