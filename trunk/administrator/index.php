<?
ob_start();
session_start();

include "admin.header.php";
include "check.login.php";
header("Location: login.php");
#--------------------------------------------------------------------------


#--------------------------------------------------------------------------
//$smarty->assign('style',$http_root.'administrator/style.css');
#--------------------------------------------------------------------------
$smarty->display($template_root.'administrator/login.tpl');
?>
