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
$advid=$_GET['advid'];
#--------------------------------------------------------------------------
#LOAD
$sql_load="select * from ".TBL_ADV." where adv_id=$advid";
$r=$cls->fns_Rows($sql_load);
#--------------------------------------------------------------------------
if(isset($_POST['add']) && $_POST['add']=='add'){
	
		$adv_title=$_POST['adv_title'];
		$adv_url=$_POST['adv_url'];
		$advpos=$_POST['chkpos'];
		$oldImg=$r[0]["adv_img"];
		
	if($_FILES['file']['name']<>''){
		$num=$cls->fns_Rand_digit(7,15,12);
		$namefile=$num.$_FILES['file']['name'];
		$dir="../images/contact/";
		$path_tmp=$_FILES['file']['tmp_name'];
		$pathimg=$dir.$namefile;
		$path="images/contact/".$namefile;
   }
    
	if($_FILES['file']['name']<>'') copy($path_tmp,$pathimg); 	 
	
		if($_FILES['file']['name']<>'')
		{	
			$sql="	UPDATE ".TBL_ADV."
					SET      adv_title='$adv_title',
							 adv_location='$advpos',
							 adv_link='$adv_url',
							 adv_img='$path'
					WHERE    adv_id=$advid
				 ";			
		}
		else
		{
			$sql="	UPDATE ".TBL_ADV."
					SET      adv_title='$adv_title',
							 adv_location='$advpos',
							 adv_link='$adv_url',
							 adv_img='$oldImg'
					WHERE    adv_id=$advid
				 ";		
		}
	
	$result=mysql_query($sql) or die("Not query");		
	header("Location: adv.list.php");

}
#--------------------------------------------------------------------------
#SHOW DU LIEU RA NGOAI	
	$smarty->assign('r',$r);
	$smarty->assign('lblDisplay',$lblDisplay);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/adv.edit.tpl');
?>


