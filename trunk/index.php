<?php 
include("header.php");
$page_title = "Shopping";

//Load left menu
$objMenu = new PGMenu();
$showMenuLeft = $objMenu->MenuVertical(" ORDER BY menu_id");

$smarty->assign('page_title', $page_title);
$smarty->assign('showMenuLeft', $showMenuLeft);

$smarty->display($dir_template.'/index.tpl');

include("footer.php");
?>