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
 $ql_del="DELETE FROM ".TBL_NEWMID." WHERE newMid_id=".$hnrid;
 $result_del=mysql_query($ql_del) or die("Not Delete.");
}
#--------------------------------------------------------------------------
#VIEW HOUSE TO RENT 
$sql=" SELECT *
       FROM ".TBL_NEWMID." as A1 ORDER BY A1.newMid_order ";
	   
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
$smarty->assign('showPage',$showPage);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/newsmid.list.tpl');
?>

