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
#NEW LONG LOAD
$sBasePath='../includes/FCKeditor/';
 #NEW LONG FCKEditor Load
  $oFCKeditor1=new FCKeditor('represent');
  $oFCKeditor1->BasePath = $sBasePath;  
  $oFCKeditor1->Toolbar = 'Basic';
  $oFCKeditor1->Height = '200';
  $oFCKeditor1->Width = '450';
#--------------------------------------------------------------------------

#VIEW NEWS 
if (isset($_POST['addRe']) && $_POST['addRe']=='addRe')
 {
 	
   $represent =  trim($_POST['represent']);   
   $re_status =  $_POST['re_status'];  
   $re_sum =  $_POST['re_sum'];  
   $sql=" INSERT INTO ".TBL_REPRESENT." (re_sum,re_content,re_status)
			VALUES ('$re_sum','$represent','$re_status')";
   $result=mysql_query($sql) or die("Not Query Insert !");
    	header("Location: represent.list.php?page=0");
}
 
 
#--------------------------------------------------------------------------
#SHOW
$smarty->assign('lblDisplay',$lblDisplay);
#LOAD NEW LONG DISPLAY
$smarty->assign('represent',$oFCKeditor1->CreateHtml());
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/represent.add.tpl');
?>
