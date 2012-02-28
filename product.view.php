<?php
$product_id	= PGRequest::GetInt('product_id', 0, 'GET');

//load name Category
$objCategory = new PGCategory();
$category = $objCategory->load($category_id);

//load product of Category
$objProduct = new PGProduct();
$product = $objProduct->load($product_id);
$objGroup = new PGGroup();
$objGroup->upview($product_id);

$smarty->assign('category', $category);
$smarty->assign('product', $product);
$smarty->display($dir_template."/product.view.tpl");
?>