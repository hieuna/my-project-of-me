<?php
include ("header.php");

$name 		= $database->getEscaped(PGRequest::getString('name', '', 'POST'));
$phone		= $database->getEscaped(PGRequest::getString('phone', '', 'POST'));
$address	= $database->getEscaped(PGRequest::getString('address', '', 'POST'));
$product_id = PGRequest::getInt('product_id', 0, 'GET');
$payment	= $database->getEscaped(PGRequest::getString('payment', '', 'POST'));

$date = date("Y-m-d h:i:s");

//show banner of product
$banner = new PGBanner();
$where[] = "product_id=".$product_id;
$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');

$thisBanner = $banner->loadList($where);

//show name product
$sql = "SELECT name FROM ".TBL_PRODUCT_DESC." WHERE product_id=".$product_id;
$product = $database->db_fetch_object($database->db_query($sql));

$page_title = "Đăng ký nhận điện thoại ".$product->name;

//register get phone
$customer = new PGCustomerHotDeal();
$message = $customer->check_input_customer($name, $phone, $address);
if (!$message){
	$customer->name = $name;
	$customer->phone = $phone;
	$customer->address = $address;
	$customer->product_id = $product_id;
	$customer->payment = $payment;
	$customer->date = $date;
	
	$sql = "SELECT COUNT(*) AS total FROM ".TBL_CUSTOMER_HOTDEAL." WHERE name='$name' AND phone='$phone' AND address='$address' AND product_id=".$product_id;
	$result = $database->db_fetch_assoc($database->db_query($sql));
	$total = $result['total']; 
	if ($total == 0){
		if ($customer->save()) 
		$message = "Bạn đã đăng ký mua sản phẩm ".$product->name." thành công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất !";
	}else{
		$sql = "SELECT number_register FROM ".TBL_CUSTOMER_HOTDEAL." WHERE name='$name' AND phone='$phone' AND address='$address' AND product_id=".$product_id;
		$count = $database->db_fetch_object($database->db_query($sql));
		$nubmer = $count->number_register+1;
		$database->db_query("UPDATE ".TBL_CUSTOMER_HOTDEAL." SET number_register=".$nubmer." WHERE name='$name' AND phone='$phone' AND address='$address' AND product_id=".$product_id);
		$message = "Thông tin đăng ký mua ".$product->name." này đã tồn tại. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất !";		
	}
}

$smarty->assign('page_title', $page_title);
$smarty->assign('message', $message);
$smarty->assign('thisBanner', $thisBanner);
$smarty->display($template_root.'register_get_phone.tpl');

include ("footer.php");
?>