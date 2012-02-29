<?php 
include("header.php");
include("application.php");

$dispatch		= PGRequest::GetCmd('dispatch', '');

if ($dispatch == 'category.view'){
	require_once 'category.product.php';
}else if ($dispatch == 'product.view'){
	require_once 'product.view.php';
}else{
	$page_title = "Shopping";
	
	//Load product of day
	$product_of_day = $objProduct->Product_of_day();
	//Load modules special product
	$lsProductSpecial = $objProduct->ProductSpecial(0, 9);
	//load moduels discount product
	$lsProductDiscount = $objProduct->ProductDiscount(0, 9);
	
	$smarty->assign('page_title', $page_title);
	$smarty->assign('product_of_day', $product_of_day);
	$smarty->assign('lsProductSpecial', $lsProductSpecial);
	$smarty->assign('lsProductDiscount', $lsProductDiscount);	
	
	$smarty->display($dir_template.'/index.tpl');
}
	
include("footer.php");
?>