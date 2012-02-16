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
$page = new clsPaging();
$lblDisplay='';

#--------------------------------------------------------------------------
#LAY DU LIEU GET/POST
	if(isset($_POST['str_id']) && $_POST['str_id']<>'')
	{
		$pid=$_POST['str_id'];
		$sql1="DELETE FROM ".TBL_ADV." WHERE adv_id in ($pid)";
		//echo $sql1;
		$result1=mysql_query($sql1) or die("Not query");		
	}
#--------------------------------------------------------------------------
#RENT VIEW
	$sql=" SELECT *
       FROM ".TBL_ADV." as A1	   
       ORDER BY A1.adv_id DESC 
     ";
$result=mysql_query($sql) or die("Not View SQL.");	 
$total_records=mysql_num_rows($result);
$scroll=7;
$record_per_page=15;
$page->set_page_data($_SERVER['PHP_SELF'],$total_records,$scroll,$record_per_page,true,true,true);
$r=$cls->fns_Rows($page->get_limit_query($sql));
$showPage=$page->get_page_nav();
#--------------------------------------------------------------------------
#SHOW DU LIEU RA NGOAI
	$smarty->assign('style',$http_root.'administrator/style.css');
	$smarty->assign('r',$r);
	$smarty->assign('lblDisplay',$lblDisplay);
	$smarty->assign('showPage',$showPage);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/adv.list.tpl');
?>
