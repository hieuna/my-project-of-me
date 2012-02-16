<?
require '../config/config.php';
#--------------------------------------------------------------------------
$smarty->assign('style',$http_root.'administrator/style.css');
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/foot.tpl');
?>
