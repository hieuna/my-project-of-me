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
$newMid_id=$_REQUEST['newMid_id'];

$sql_view="Select A1.* from ".TBL_NEWMID." as A1 where A1.newMid_id=".$newMid_id;
$RowNew=$cls->fns_Rows($sql_view);


#NEW LONG LOAD
$sBasePath='../includes/FCKeditor/';
 #NEW LONG FCKEditor Load
  $oFCKeditor1=new FCKeditor('newMid_details');
  $oFCKeditor1->BasePath = $sBasePath; 
  $oFCKeditor1->Value = $RowNew[0]["newMid_details"];
  $oFCKeditor1->Toolbar = 'Basic';
  $oFCKeditor1->Height = '200';
  $oFCKeditor1->Width = '450';
#--------------------------------------------------------------------------


#POST DATA
if(isset($_POST['updatenewMid']) && $_POST['updatenewMid']=='updatenewMid'){ 		
     
   $newMid_title =  $_POST['newMid_title'];
   $newMid_sums =  $_POST['newMid_sums'];
   $newMid_details =  trim($_POST['newMid_details']);   
   $newMid_status =  $_POST['newMid_status'];  
   $newMid_order =  $_POST['newMid_order'];    
   $oldImg =  $RowNew[0]["newMid_img"];
   
   if($_FILES['file']['name']<>''){
		$num=$cls->fns_Rand_digit(7,15,12);
		$namefile=$num.$_FILES['file']['name'];
		$dir="../images/newsmid/";
		$path_tmp=$_FILES['file']['tmp_name'];
		$pathimg=$dir.$namefile;
		$path="images/newsmid/".$namefile;	
   }
	
   if($_FILES['file']['name']<>'') copy($path_tmp,$pathimg);     
   if($_FILES['file']['name']<>'')
   {
	   $sql=" UPDATE ".TBL_NEWMID." 
				 SET     
						 newMid_title='$newMid_title',
						 newMid_sums='$newMid_sums',
						 newMid_img='$path',
						 newMid_details='$newMid_details',
						 newMid_status='$newMid_status',
						 newMid_order='$newMid_order'		       
				WHERE    newMid_id=$newMid_id ";      
	}
	else
	{
		$sql=" UPDATE ".TBL_NEWMID." 
				 SET     
						 newMid_title='$newMid_title',
						 newMid_sums='$newMid_sums',
						 newMid_img='$oldImg',
						 newMid_details='$newMid_details',
						 newMid_status='$newMid_status',
						 newMid_order='$newMid_order'		       
				WHERE    newMid_id=$newMid_id ";    
	}		
       $result=mysql_query($sql) or die("Not Update This New.");		  
	   header("Location: newsmid.list.php?page=0");
	
 }
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('RowNew',$RowNew);
$smarty->assign('lblDisplay',$lblDisplay);
#LOAD NEW LONG DISPLAY
$smarty->assign('newMid_details',$oFCKeditor1->CreateHtml());
#--------------------------------------------------------------------------

$smarty->display($template_root.'administrator/newsmid.edit.tpl');
?>
