<?php
$objBanner = new PGBanner();
$objMenu = new PGMenu();
$objProduct =  new PGProduct();
$objCategory = new PGCategory();

//Load Banner Topup
$topup = $objBanner->loadTopup();
//Load left menu
$showMenuLeft = $objMenu->MenuVertical(" ORDER BY menu_id");
//Load moduels product hotdeal
$lsProductHotdeal = $objProduct->ProducsHotDeal();
//Load modules new product
$lsProductNews = $objProduct->ProductNews(0, 5);

$smarty->assign('topup', $topup);
$smarty->assign('showMenuLeft', $showMenuLeft);
$smarty->assign('lsProductHotdeal', $lsProductHotdeal);
$smarty->assign('lsProductNews', $lsProductNews);
?>