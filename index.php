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
	
	//Load modules special product
	$lsProductSpecial = $objProduct->ProductSpecial(" ORDER BY RAND()", 0, 5);
	
	//Load modules seller product
	$lsProductSeller = $objProduct->ProductSeller(" ORDER BY RAND()", 0, 5);
	
	//load moduels discount product
	$lsProductDiscount = $objProduct->ProductDiscount(" ORDER BY RAND()", 0, 3);
	
	//Load product of day
	$product_of_day = $objProduct->Product_of_day();
	
	//Load categories products
	$where[] = " status=1";
	$where[] = " parent_id=0";
	$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
	
	$lsCategories = $objCategory->loadList($where);
	foreach ($lsCategories as $lsCate) {
		$condition = " WHERE p.product_id=pd.product_id AND pd.product_id=pm.product_id AND p.status=1 AND p.category_id=".$lsCate["category_id"];
		
		$sql = "SELECT COUNT(*) AS total FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm ".$condition;
		$result = $database->db_query($sql);
		$count = $database->getRow($result);
		$total = $count["total"];
		
		if ($total > 0){
			$lsProducts = $objProduct->loadListFontEnd($condition, " ORDER BY RAND()", 0, 5);
			$html .= '<div class="unified_widget rcm widget small_heading" id="widget_'.$lsCate["category_id"].'">';
				$html .= '<h2>'.$lsCate["name"].'</h2>';
				foreach ($lsProducts as $lsPro) {
					$html .= '<div style="float: left; width: 20%" class="fluid asin s9a0">';
						$html .= '<div class="inner">';
							$html .= '<div style="position: relative" class="s9hl">';
								$html .= '<a title="'.$lsPro["name"].'" class="title ntTitle noLinkDecoration" href="'.$lsPro["link"].'">';
									$html .= '<div class="imageContainer">';
										$html .= '<img width="135" height="94" alt="'.$lsPro["name"].'" src="'.$lsPro["image1"].'">';
									$html .= '</div>';
									$html .= $lsPro["name"];
								$html .= '</a>';
								$html .= '<br clear="none">';
								$html .= '<span class="newListprice gry t11">'.$lsPro[price_ny].$menh_gia.'</span>';
								$html .= '<span class="red t14">'.$lsPro["price"].$menh_gia.'</span>';
							$html .= '</div>';
						$html .= '</div>';
					$html .= '</div>';
				}
				$html .= '<div style="clear: left; width: 100%; height: 1px; margin: 0; padding: 0; overflow: hidden"></div>';
				$html .= '<div class="action">';
					$html .= '<span class="carat">&rsaquo;</span>';
					$html .= '<a href="'.$lsCate["link"].'">Xem thêm</a>';
				$html .= '</div>';
				$html .= '<div class="h_rule"></div>';
			$html .= '</div>';
		}
	}
	
	//Load modules viewed product
	$lsProductViewed = $objProduct->ProductViewed();
	
	$smarty->assign('page_title', $page_title);
	$smarty->assign('lsProductSpecial', $lsProductSpecial);
	$smarty->assign('lsProductSeller', $lsProductSeller);
	$smarty->assign('lsProductDiscount', $lsProductDiscount);
	$smarty->assign('product_of_day', $product_of_day);
	$smarty->assign('html', $html);
	$smarty->assign('lsProductViewed', $lsProductViewed);
	
	$smarty->display($dir_template.'/index.tpl');
}
	
include("footer.php");
?>