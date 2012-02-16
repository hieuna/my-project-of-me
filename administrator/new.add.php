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
  $oFCKeditor1=new FCKeditor('news_details');
  $oFCKeditor1->BasePath = $sBasePath;  
  $oFCKeditor1->Toolbar = 'Basic';
  $oFCKeditor1->Height = '200';
  $oFCKeditor1->Width = '450';
#--------------------------------------------------------------------------
$sql_view1="Select * from ".TBL_MENULEVEL1 . " where mn_id not in ". "(Select mn_id from ".TBL_MENULEVEL2.")";
$RowMenuLevel1=$cls->fns_Rows($sql_view1);

$sql_view2="Select * from ".TBL_MENULEVEL2 ;
$RowMenuLevel2=$cls->fns_Rows($sql_view2);

#VIEW NEWS 
if (isset($_POST['addnew']) && $_POST['addnew']=='addnew')
{  
   $news_cat =  $_POST['news_cat'];      
   $news_title =  $_POST['news_title'];
   $news_sums =  $_POST['news_sums'];
   $news_details =  trim($_POST['news_details']);   
   $news_status =  $_POST['news_status'];  
   $news_hot =  $_POST['news_hot'];         
   
   if($_FILES['file']['name']<>''){
		$num=$cls->fns_Rand_digit(7,15,12);
		$namefile=$num.$_FILES['file']['name'];
		$dir="../images/news/";
		$path_tmp=$_FILES['file']['tmp_name'];
		$pathimg=$dir.$namefile;
		$path="images/news/".$namefile;	
   }
   
	if($_FILES['file']['name']<>'') copy($path_tmp,$pathimg);  
   
   $sql_check="select * from ".TBL_NEWS." where news_title='$news_title'";   
   if (!$cls->fns_IsRecord($sql_check)) { 		
		
   		$sql=" INSERT INTO ".TBL_NEWS." (news_cat,news_title,news_sums,news_details,news_status,news_hot,news_img)
	        	VALUES ('$news_cat','$news_title','$news_sums','$news_details','$news_status','$news_hot','$path')
	      		";  	   		
    	$result=mysql_query($sql) or die("Not Query Insert !");
    	header("Location: new.list.php?page=0");		
   }
   else
   {
     $lblDisplay="&raquo; Xin lỗi tin này đã đưa lên rồi !";
   }      
 }
 
#--------------------------------------------------------------------------
#SHOW
$smarty->assign('lblDisplay',$lblDisplay);
$smarty->assign('RowMenuLevel1',$RowMenuLevel1);
$smarty->assign('RowMenuLevel2',$RowMenuLevel2);

#LOAD NEW LONG DISPLAY
$smarty->assign('news_details',$oFCKeditor1->CreateHtml());
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/new.add.tpl');
  
?>
