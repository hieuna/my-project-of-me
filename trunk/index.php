<?php
$page = "index";
$page_title = "Cổng thanh toán trực tuyến SohaPay";
include "header.php";
$task = PGRequest::getVar('task', '');

if ($task=='cancel_pay'){
	$sessionCookie = PGRequest::getCmd('sessionCookie', '', 'COOKIE');
	clearSession();
	if ($sessionCookie){
		$returnURL = makeReturnURL($sessionCookie, 'Giao dịch thanh toán bị huỷ bỏ');
		if (substr($returnURL, 0, 4)=='http') cheader($returnURL);
		
		$page = "error";
	    $smarty->assign('error_urlReturn', '');
	  	$smarty->assign('error_header', 'Thanh toán không thành công!');
	  	$smarty->assign('error_message', 'Giao dịch thanh toán bị hủy.');
	  	include "footer.php";
	    exit();
	}
}

include "footer.php";
?>
