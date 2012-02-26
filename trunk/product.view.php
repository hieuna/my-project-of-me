<?php
echo $product_id	= PGRequest::GetInt('product_id', 0, 'GET');

//load name Category
$objCategory = new PGCategory();
$category = $objCategory->load($category_id);

//load product of Category
$objProduct = new PGProduct();
$where[] = " p.product_id=pd.product_id";
$where[] = " p.product_id=pm.product_id";
$where[] = " p.status=1";
$where[] = " p.category_id=".$category_id;
$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');

$lsProduct = $objProduct->showList($where);

$smarty->assign('category', $category);
$smarty->assign('lsProduct', $lsProduct);
$smarty->display($dir_template."/product.view.tpl");
?>