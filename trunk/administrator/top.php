<?
require '../config/config.php';
$ad_username=$_SESSION['ad_username'];

#--------------------------------------------------------------------------
$smarty->assign('style',$http_root.'administrator/style.css');
$smarty->assign('ad_username',$ad_username);
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/top.tpl');
?>
