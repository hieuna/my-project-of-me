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
$re_id=$_REQUEST['re_id'];

$sql_view="Select A1.* from ".TBL_REPRESENT." as A1 where A1.re_id=".$re_id;
$RowNew=$cls->fns_Rows($sql_view);


#NEW LONG LOAD
$sBasePath='../includes/FCKeditor/';
 #NEW LONG FCKEditor Load
  $oFCKeditor1=new FCKeditor('represent');
  $oFCKeditor1->BasePath = $sBasePath; 
  $oFCKeditor1->Value = $RowNew[0]["re_content"];
  $oFCKeditor1->Toolbar = 'Basic';
  $oFCKeditor1->Height = '200';
  $oFCKeditor1->Width = '450';
#--------------------------------------------------------------------------


#POST DATA
if(isset($_POST['updateRe']) && $_POST['updateRe']=='updateRe'){ 		
     
   
   $represent =  trim($_POST['represent']);   
   $re_status =  $_POST['re_status'];
   $re_sum    =  $_POST['re_sum'];  

	   $sql=" UPDATE ".TBL_REPRESENT." 
				 SET     
						 re_sum='$re_sum',
						 re_content='$represent',
						 re_status='$re_status'
						 	       
				WHERE    re_id=$re_id ";      
	$result=mysql_query($sql) or die("Not Update This New.");		  
	header("Location: represent.list.php?page=0");
	
 }
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('RowNew',$RowNew);
$smarty->assign('lblDisplay',$lblDisplay);
#LOAD NEW LONG DISPLAY
$smarty->assign('represent',$oFCKeditor1->CreateHtml());
#--------------------------------------------------------------------------

$smarty->display($template_root.'administrator/represent.edit.tpl');
?>
