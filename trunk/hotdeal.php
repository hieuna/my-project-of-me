<?php 
include("header.php");
$page_title = "Hot - Deal";

$config['date'] = '%I:%M %p'; 
$config['time'] = '%H:%M:%S';

//load Banner Hotdeal
$whereBn[] = "banner_web=1";
$whereBn[] = "banner_status=1";
$whereBn = (count($whereBn) ? ' WHERE '.implode(' AND ', $whereBn) : '');
$banner = new PGBanner();
$oBanner = $banner->loadList($whereBn);

//Load HotDeal
$hotdeal = new PGHotDeal();
$lsHotDeal = $hotdeal->loadList(null, 1);

$smarty->assign('page_title', $page_title);
$smarty->assign('oBanner', $oBanner);
$smarty->assign('lsHotDeal', $lsHotDeal);
$smarty->assign('config', $config);
$smarty->display($template_root.'hotdeal.tpl');

include("footer.php");
?>
