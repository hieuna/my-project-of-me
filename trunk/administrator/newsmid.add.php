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
  $oFCKeditor1=new FCKeditor('newMid_details');
  $oFCKeditor1->BasePath = $sBasePath;  
  $oFCKeditor1->Toolbar = 'Basic';
  $oFCKeditor1->Height = '200';
  $oFCKeditor1->Width = '450';
#--------------------------------------------------------------------------

#VIEW NEWS 
if (isset($_POST['addnewMid']) && $_POST['addnewMid']=='addnewMid')
 {
 	
   $tontai=0;      
   $newMid_title =  $_POST['newMid_title'];
   $newMid_sums =  $_POST['newMid_sums'];
   $newMid_details =  trim($_POST['newMid_details']);   
   $newMid_status =  $_POST['newMid_status'];  
   $newMid_order =  $_POST['newMid_order'];        
   
   if($_FILES['file']['name']<>''){
		$num=$cls->fns_Rand_digit(7,15,12);
		$namefile=$num.$_FILES['file']['name'];
		$dir="../images/newsmid/";
		$path_tmp=$_FILES['file']['tmp_name'];
		$pathimg=$dir.$namefile;
		$path="images/newsmid/".$namefile;	
   }
	
   if($_FILES['file']['name']<>'') copy($path_tmp,$pathimg);  
	
	$sql_check="select * from ".TBL_NEWMID." where newMid_title='$newMid_title'";
   
   	if (!$cls->fns_IsRecord($sql_check)){   
	 if($_FILES['file']['name']<>'')		
    	{
			$sql=" INSERT INTO ".TBL_NEWMID." (newMid_title,newMid_sums,newMid_img,newMid_details,newMid_status,newMid_order)
			VALUES ('$newMid_title','$newMid_sums','$path','$newMid_details','$newMid_status','$newMid_order')
			";    	 
		}
   	 else 
		{
     		$image="";
	 		$sql=" INSERT INTO ".TBL_NEWMID." (newMid_title,newMid_sums,newMid_img,newMid_details,newMid_status,newMid_order)
	        	VALUES ('$newMid_title','$newMid_sums','$image','$newMid_details','$newMid_status','$newMid_order')
	      		";    	 
   		}
    	$result=mysql_query($sql) or die("Not Query Insert !");
    	header("Location: newsmid.list.php?page=0");
   }
   else
   {
     $lblDisplay="&raquo; Xin lỗi tin này đã đưa lên rồi !";
   }    
  }
  else {
    $lblDisplay="&raquo; Nhập chi tiết cho nội dung của tin.";
  }
 
 
#--------------------------------------------------------------------------
#SHOW
$smarty->assign('lblDisplay',$lblDisplay);
#LOAD NEW LONG DISPLAY
$smarty->assign('newMid_details',$oFCKeditor1->CreateHtml());
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/newsmid.add.tpl');
?>
