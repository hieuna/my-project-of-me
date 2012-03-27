<?php
$soluong = $_POST['soluong'];
$name_shp = $_POST['name'];
$price_shp = $_POST['price'];
include("../classes/class_payment.php");
$params = array(
	'transaction_info'  	=> 'Mua sản phẩm '.$name_shp.' từ mienphigiaohang.vn',
	'price'                 => $price_shp,
	'order_product_title' 	=> $name_shp,
	'order_number_min'		=> $soluong,	
	'order_ship'          	=> 0,	
	'return_url'	      	=> 'http://mienphigiaohang.vn/deals'				
);
$classPayment = new PG_checkout();
print $classPayment->buildEmbedHTML($params);		
?>