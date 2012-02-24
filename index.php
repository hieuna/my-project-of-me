<?php 
include("header.php");
$page_title = "Shopping";

$smarty->assign('page_title', $page_title);
$smarty->display($dir_template.'/index.tpl');

include("footer.php");
?>