<?php 
include("header.php");
$page_title = "Shopping";
$dispatch		= PGRequest::GetCmd('dispatch', '');

//Load left menu
$objMenu = new PGMenu();
$showMenuLeft = $objMenu->MenuVertical(" ORDER BY menu_id");

$objProduct =  new PGProduct();
//Load moduels product hotdeal
$lsProductHotdeal = $objProduct->ProducsHotDeal();
//Load modules new product
$lsProductNews = $objProduct->ProductNews(0, 5);
//Load modules special product
$lsProductSpecial = $objProduct->ProductSpecial(0, 9);

$smarty->assign('page_title', $page_title);
$smarty->assign('showMenuLeft', $showMenuLeft);
$smarty->assign('lsProductHotdeal', $lsProductHotdeal);
$smarty->assign('lsProductNews', $lsProductNews);
$smarty->assign('lsProductSpecial', $lsProductSpecial);	

if ($dispatch){
	
}else{
	$smarty->display($dir_template.'/index.tpl');
}
	
include("footer.php");
?>