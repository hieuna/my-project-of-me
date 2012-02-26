<?php
//Load left menu
$objMenu = new PGMenu();
$showMenuLeft = $objMenu->MenuVertical(" ORDER BY menu_id");
$objProduct =  new PGProduct();
//Load moduels product hotdeal
$lsProductHotdeal = $objProduct->ProducsHotDeal();
//Load modules new product
$lsProductNews = $objProduct->ProductNews(0, 5);

$smarty->assign('showMenuLeft', $showMenuLeft);
$smarty->assign('lsProductHotdeal', $lsProductHotdeal);
$smarty->assign('lsProductNews', $lsProductNews);
?>