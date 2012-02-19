<?php
/***************************************************************************
*                                                                          *
*    Copyright (c) 2004 Simbirsk Technologies Ltd. All rights reserved.    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/
//Tạo class nganluong
class NL_Checkout 
{
	// URL chheckout của nganluong.vn
	private $nganluong_url;

	// Mã merchante site 
	private $merchant_site_code;	// Biến này được nganluong.vn cung cấp khi bạn đăng ký merchant site

	// Mật khẩu bảo mật
	private $secure_pass; // Biến này được nganluong.vn cung cấp khi bạn đăng ký merchant site

	
	function __construct($nganluong_url,$merchant_site_code,$secure_pass)
	{
	     $this->nganluong_url=$nganluong_url;
		 $this->merchant_site_code=$merchant_site_code;
		 $this->secure_pass=$secure_pass;
	}
	
	//Hàm xây dựng url, trong đó có tham số mã hóa (còn gọi là public key)
	public function buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price)
	{
		
		// Mảng các tham số chuyển tới nganluong.vn
		$arr_param = array(
			'merchant_site_code'=>	strval($this->merchant_site_code),
			'return_url'		=>	strtolower(urlencode($return_url)),
			'receiver'			=>	strval($receiver),
			'transaction_info'	=>	strval($transaction_info),
			'order_code'		=>	strval($order_code),
			'price'				=>	strval($price)					
		);
		$secure_code ='';
		$secure_code = implode(' ', $arr_param) . ' ' . $this->secure_pass;
		$arr_param['secure_code'] = md5($secure_code);
		
		/* Bước 2. Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào*/
		$redirect_url = $this->nganluong_url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			// Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
			$redirect_url .= '&';			
		}
				
		/* Bước 3. tạo url*/
		$url = '';
		foreach ($arr_param as $key=>$value)
		{
			if ($url == '')
				$url .= $key . '=' . $value;
			else
				$url .= '&' . $key . '=' . $value;
		}
		
		return $redirect_url.$url;
	}
	
	/*Hàm thực hiện xác minh tính đúng đắn của các tham số trả về từ nganluong.vn*/
	
	public function verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code)
	{
		// Tạo mã xác thực từ chủ web
		$str = '';
		$str .= ' ' . strval($transaction_info);
		$str .= ' ' . strval($order_code);
		$str .= ' ' . strval($price);
		$str .= ' ' . strval($payment_id);
		$str .= ' ' . strval($payment_type);
		$str .= ' ' . strval($error_text);
		$str .= ' ' . strval($this->merchant_site_code);
		$str .= ' ' . strval($this->secure_pass);

        // Mã hóa các tham số
		$verify_secure_code = '';
		$verify_secure_code = md5($str);
		
		// Xác thực mã của chủ web với mã trả về từ nganluong.vn
		if ($verify_secure_code === $secure_code) return true;
		
		return false;
	}
}


//End class
// $Id: paypal.php 9088 2010-03-15 10:40:51Z 2tl $
//

if ( !defined('AREA') ) { die('Access denied'); }

//thuc hien add class nganluong
//require './../nganluong_checkout.php';

// Return from paypal website
if (defined('PAYMENT_NOTIFICATION')) {
	if ($mode == 'notify' && !empty($_REQUEST['order_id'])) {
		
		if (fn_check_payment_script('nganluong.php', $_REQUEST['order_id'], $processor_data)) {

			$pp_response = array();
			
			$order_info = fn_get_order_info($_REQUEST['order_id']);
			
			$pp_mc_gross = !empty($_REQUEST['mc_gross']) ? $_REQUEST['mc_gross'] : 0;
			
			if ($pp_mc_gross != $order_info['total']) {
				$pp_response['order_status'] = 'F';
				$pp_response['reason_text'] = fn_get_lang_var('order_total_not_correct');
				$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
			} elseif (stristr($_REQUEST['payment_status'], 'Completed')) {
				$params = $processor_data['params'];
				$paypal_host = ($params['mode'] == 'test' ? "www.sandbox.nganluong.vn" : "www.nganluong.vn");
				$post_data = array();
				$paypal_post = $_REQUEST;
				unset($paypal_post['dispatch']);
	
				$paypal_post["cmd"] = "_notify-validate";
				foreach ($paypal_post as $k => $v) {
					$post_data[] = "$k=$v";
				}
	
				list($headers, $result) = fn_https_request('POST', "https://www.nganluong.vn/checkout.php", $post_data);
	
				if (stristr($result, 'VERIFIED')) {
					$pp_response['order_status'] = 'P';
					$pp_response['reason_text'] = '';
					$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
				} elseif (stristr($result, 'INVALID')) {
					$pp_response['order_status'] = 'D';
					$pp_response['reason_text'] = '';
					$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
				} else {
					$pp_response['order_status'] = 'F';
					$pp_response['reason_text'] = '';
					$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
				}
			} elseif (stristr($_REQUEST['payment_status'], 'Pending')) {
					$pp_response['order_status'] = 'O';
					$pp_response['reason_text'] = '';
					$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
	
			} elseif (stristr($_REQUEST['payment_status'], 'Refunded')) {
					$_order = db_get_row("SELECT status, total FROM ?:orders WHERE order_id = ?i", $_REQUEST['order_id']);
	
					$pp_response['order_status'] = (floatval($_order['total']) - abs(floatval($_REQUEST['payment_gross'])) == 0) ? 'I' : $_order['status'];
					$pp_response['reason_text'] = '';
					$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
	
			} else {
					$pp_response['order_status'] = 'D';
					$pp_response['reason_text'] = '';
					$pp_response['transaction_id'] = @$_REQUEST['txn_id'];
			}
	
			fn_finish_payment($_REQUEST['order_id'], $pp_response);
		}
		exit;

	} elseif ($mode == 'return') {
		fn_order_placement_routines($_REQUEST['order_id'], false);

	} elseif ($mode == 'cancel') {
		$order_info = fn_get_order_info($_REQUEST['order_id']);

		$pp_response['order_status'] = 'F';
		$pp_response["reason_text"] = fn_get_lang_var('text_transaction_declined');

		fn_finish_payment($_REQUEST['order_id'], $pp_response, false);
		fn_order_placement_routines($_REQUEST['order_id']);
	}

} else { //Het phan nganluong tra ve

    //thực hiện lấy các biến cần thiết để tạo link
	
	$merchant_site_code=$processor_data['params']['merchant_site_code'];//id của site
	$secure_pass=$processor_data['params']['secure_pass'];//mật khẩu giao tiếp api
    $return_url=$processor_data['params']['return_url'];//Địa chị trả về
	$receiver=$processor_data['params']['receiver'];//tài khoản nhận tiền
	$nganluong_url=$processor_data['params']['nganluong_url'];//tài khoản nhận tiền
	$current_location = Registry::get('config.current_location');

	if ($processor_data['params']['mode'] == 'test') {
		$nganluong_url = "http://sandbox.nganluong.vn/checkout.php";
	} else {
		$nganluong_url = $processor_data['params']['nganluong_url'];
	}
	$nganluong_currency = $processor_data['params']['currency'];
	$paypal_item_name = $processor_data['params']['item_name'];
	//Order Total
	$nganluong_total1 = fn_format_price($order_info['total']);
	
	$nganluong_total=str_replace('.','',$nganluong_total1);
	
	$nganluong_shipping = fn_order_shipping_cost($order_info);
	$transaction_info = "";//fn_order_shipping_cost($order_info);
	$nganluong_order_id = $processor_data['params']['order_code'].(($order_info['repaid']) ? ($order_id .'_'. $order_info['repaid']) : $order_id);
	$nl = new NL_Checkout($nganluong_url,$merchant_site_code,$secure_pass);
	$nganluong_checkout_url = $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $nganluong_order_id, $nganluong_total);
	//die($nganluong_checkout_url);
	$msg = fn_get_lang_var('text_cc_processor_connection');
	$msg = str_replace('[processor]', 'Quá trình thanh toán với ngân lượng bắt đầu', $msg);
	echo <<<EOT
	<html>
	<body onLoad="document.nganluong_form.submit();">
	<form action="{$nganluong_checkout_url}" method="post" name="nganluong_form">
 
	</form>
	<div align=center>{$msg}</div>
	</body>
	</html>
EOT;


	fn_flush();
}
exit;
?>