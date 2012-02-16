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
$cls   = new clsCommons();
$page  = new clsPaging();
$ad_id =$_SESSION['ad_id'];
$lblDisplay='';
#--------------------------------------------------------------------------
if(isset($_POST['str_id']) && $_POST['str_id']<>'') {
 $hnrid=$_POST['str_id'];
 $ql_del="DELETE FROM ".TBL_NEWS." WHERE news_id=".$hnrid;
 $result_del=mysql_query($ql_del) or die("Not Delete.");
}
#--------------------------------------------------------------------------
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
 


 
#VIEW HOUSE TO RENT 
$sql=" SELECT *
       FROM ".TBL_NEWS." as A1 ORDER BY A1.news_date desc 
     ";
$result=mysql_query($sql) or die("Not View SQL.");	 
$total_records=mysql_num_rows($result);
$scroll=7;
$record_per_page=15;
$page->set_page_data($_SERVER['PHP_SELF'],$total_records,$scroll,$record_per_page,true,true,true);
$r=$cls->fns_Rows($page->get_limit_query($sql));

$showPage=$page->get_page_nav();
#--------------------------------------------------------------------------
#SHOW DATA
$smarty->assign('r',$r);
$smarty->assign('total_records',$total_records);
//$smarty->assign('arrTenLoai',$arrTenLoai);
$smarty->assign('showPage',$showPage);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/new.list.tpl');
?>

