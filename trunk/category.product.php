<?php
$category_id	= PGRequest::GetInt('category_id', 0, 'GET');

//load name Category
$objCategory = new PGCategory();
$category = $objCategory->load($category_id);

//load parent_id of Category
$lsIDCategory = $objCategory->showCategoryID($category_id);
//echo count($lsIDCategory);
if (count($lsIDCategory) == 0){
	$where[] = " p.category_id=".$category_id;
}else{
	$in_array = "(";
	for ($i=0; $i<count($lsIDCategory); $i++) {
		//echo $lsIDCategory[$i]["category_id"];
		if ($i == (count($lsIDCategory)-1)) $str = ""; else $str = ",";
		$in_array .= $lsIDCategory[$i]["category_id"].$str; 
	}
	$in_array .= ")";
	$where[] = " ((p.category_id IN ".$in_array.") OR (p.category_id=".$category_id."))";
}
//load product of Category
$objProduct = new PGProduct();
$where[] = " p.product_id=pd.product_id";
$where[] = " p.product_id=pm.product_id";
$where[] = " p.status=1";

$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');

$lsProduct = $objProduct->showList($where);

$smarty->assign('category', $category);
$smarty->assign('lsProduct', $lsProduct);
$smarty->display($dir_template."/category.product.tpl");
?>