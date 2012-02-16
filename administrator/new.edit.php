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
$news_id=$_REQUEST['news_id'];
$sql_view="Select * from ".TBL_NEWS."  where news_id=".$news_id;

$RowNew=$cls->fns_Rows($sql_view);
$status = $RowNew[0]["news_status"];
$hot = $RowNew[0]["news_hot"];

function getTenLoaiTin($news_cat){
	$str = '';	
	$cls1   = new clsCommons();
	if(substr($news_cat,0,2) ==  'mn'){
		$tem = substr($news_cat,2,strlen($news_cat));
		$sqlmn = "Select mn_name from ".TBL_MENULEVEL1." where mn_id ='$tem'";
		$rmn=$cls1->fns_Rows($sqlmn);
		$str = $rmn[0]['mn_name'];
	}
	else if(substr($news_cat,0,5) ==  'submn')
	{
		$tem = substr($news_cat,3,strlen($news_cat));
		$sqlsubmn = "Select submn_name from ".TBL_MENULEVEL2." where submn_id ='$tem'";
		$rsubmn=$cls1->fns_Rows($sqlsubmn);
		$str = $rsubmn[0]['submn_name'];
	}
	
	return $str;
	
}
$tenloai = getTenLoaiTin($RowNew[0]["news_cat"]);

#NEW LONG LOAD
$sBasePath='../includes/FCKeditor/';
 #NEW LONG FCKEditor Load
  $oFCKeditor1=new FCKeditor('news_details');
  $oFCKeditor1->BasePath = $sBasePath; 
  $oFCKeditor1->Value = $RowNew[0]["news_details"];
  $oFCKeditor1->Toolbar = 'Basic';
  $oFCKeditor1->Height = '200';
  $oFCKeditor1->Width = '450';
#--------------------------------------------------------------------------


#POST DATA
if(isset($_POST['updatenew']) && $_POST['updatenew']=='updatenew'){  		
   
   $news_title =  $_POST['news_title'];
   $news_sums =  $_POST['news_sums'];
   $news_details =  trim($_POST['news_details']);   
   $news_status =  $_POST['news_status'];  
   $news_hot =  $_POST['news_hot'];   
   $oldImg = $RowNew[0]["news_img"];
   
   if($_FILES['file']['name']<>'')
    {	
     	$num=$cls->fns_Rand_digit(7,15,12);
		$namefile=$num.$_FILES['file']['name'];
		$dir="../images/news/";
		$path_tmp=$_FILES['file']['tmp_name'];
		$pathimg=$dir.$namefile;
		$path="images/news/".$namefile;		 
	}	
   
	
   if($_FILES['file']['name']<>'') copy($path_tmp,$pathimg);     
   if($_FILES['file']['name']<>'')
   {	 		
			 $sql=" UPDATE ".TBL_NEWS." 
	         SET     
			 		 news_title='$news_title',
					 news_sums='$news_sums',
					 news_img='$path',
					 news_details='$news_details',
					 news_status='$news_status',
			         news_hot='$news_hot'		       
			WHERE    news_id=$news_id  ";      
	}
	else
	{
			$sql=" UPDATE ".TBL_NEWS." 
				 SET     
						 news_title='$news_title',
						 news_sums='$news_sums',
						 news_img='$oldImg',
						 news_details='$news_details',
						 news_status='$news_status',
						 news_hot='$news_hot'		       
				WHERE    news_id=$news_id  ";      
	}
		
       $result=mysql_query($sql) or die("Not Update This New.");		  
	   header("Location: new.list.php?page=0");
  	
 }
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('RowNew',$RowNew);
$smarty->assign('status',$status);
$smarty->assign('tenloai',$tenloai);
$smarty->assign('lblDisplay',$lblDisplay);
#LOAD NEW LONG DISPLAY
$smarty->assign('news_details',$oFCKeditor1->CreateHtml());
#--------------------------------------------------------------------------

$smarty->display($template_root.'administrator/new.edit.tpl');
?>
