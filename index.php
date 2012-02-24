<?php 
include("header.php");
$page_title = "Shopping";

//Load left menu
$objMenu = new PGMenu();
$lsMenuLeft = $objMenu->loadList();

$smarty->assign('page_title', $page_title);
$smarty->assign('lsMenuLeft', $lsMenuLeft);

$smarty->display($dir_template.'/index.tpl');

include("footer.php");
?>