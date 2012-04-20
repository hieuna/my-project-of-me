<?php
	include_once '../data.php';
	include_once '../baokim_lib/commons.php';
	include_once '../baokim_lib/BaoKimPayment.php';
	session_start();
		
	if (array_key_exists('cart', $_SESSION)){
		$cart = $_SESSION['cart'];
	}else{
		$cart = array();
	}
	
	if (empty($cart)){
		header('Location:index.php');
	}
	$total_amount = 0;
	foreach ($cart as $product_id => $quantity){
		$product = find_product($product_id);
		$total_amount += $product->price * $quantity;
	}

	/*
	 * Lưu thông tin giỏ hàng vào database.
	 * Sau khi lưu xong sẽ có mã đơn hàng. Chương trình demo này không thực hiện việc lưu 
	 * vào database mà chỉ tạo ra 1 mã đơn hàng ngẫu nhiên.
	 */
	
	
	//Tạo thông tin submit lên baokim.vn
	$order_id = 'BKTEST_' . time();
	$business = "nhaj_ben@yahoo.com.vn";
	$order_description = 'Thanh toán cho đơn hàng ' . $order_id;
	$shipping_fee = 0; //Nếu có tính thêm phí vận chuyển thì thiết lập tại đây
	$tax_fee = 0; //Nếu có tính thêm phí VAT thì thiết lập tại đây
	$url_success = 'http://localhost:8888/baokimdemo/shopping_cart/update_baokim_trans.php'; //Thiết lập url callback để update thông tin thanht toán
	$url_cancel = ''; //Url khi click link "Tôi không muốn thanh toán đơn hàng này" trên cổng thanh toán Bảo Kim
	$url_detail = ''; //Url chứa thông tin chi tiết đơn hàng
	
	//$baokim = new BaoKimPayment();
	//$request_url = $baokim->createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail);
	//redirect sang cổng thanh toán Bảo Kim
	header('Location:' . $request_url);
?>