<?
ob_start();
session_start();
require '../config/config.php';
require $include_dir.'/clsCommons.php';
require $include_dir.'/FCKeditor/fckeditor.php';
require $include_dir.'/define.table.php';
require 'check.login.php';
#--------------------------------------------------------------------------
$cls = new clsCommons();
$lblDisplay='';
#--------------------------------------------------------------------------
if(isset($_POST['add']) && $_POST['add']=='add')
{
	$adv_title=$_POST['adv_title'];
	$adv_url=$_POST['adv_url'];
	$advpos=$_POST['chkpos'];
	
	if($_FILES['file']['name']<>''){
		$num=$cls->fns_Rand_digit(7,15,12);
		$namefile=$num.$_FILES['file']['name'];
		$dir="../images/contact/";
		$path_tmp=$_FILES['file']['tmp_name'];
		$pathimg=$dir.$namefile;
		$path="images/contact/".$namefile;	
   }
    
	if($_FILES['file']['name']<>'') copy($path_tmp,$pathimg);  
	    $sql_check="select * from ".TBL_ADV." where adv_title='$adv_title'";
		if(!$cls->fns_IsRecord($sql_check)) {
		$sql="	Insert Into ".TBL_ADV."(adv_title,adv_location,adv_link,adv_img)
				Values('$adv_title','$advpos','$adv_url','$path')";	
		$result=mysql_query($sql) or die("Not query");		
		header("Location: adv.list.php?page=0");		
		}
		else {  
		  $lblDisplay="&raquo; Tin này đã đăng rồi !".$lblDisplay;		 
		}	   	
}
#--------------------------------------------------------------------------
#SHOW DU LIEU RA NGOAI	
	$smarty->assign('lblDisplay',$lblDisplay);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/adv.add.tpl');
?>


