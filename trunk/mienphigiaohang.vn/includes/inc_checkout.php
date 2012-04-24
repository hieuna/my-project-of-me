<?php
// thanh toán và nhận phiếu tại nhà payment_type = 1 / nhận tại mienphigiaohang.vn : 2 / thanh toán qua bảo kim :3 / thanh toán qua ngân lượng: 4
// order_status : trạng thái đơn hàng : 1: đang xử lý / 2: đã hoàn thành / 3: hủy
$user_id_cart = $_SESSION['ses_userid'];
$date = time();
if(isset($_POST['form_checkout3'])){
		$total_amount = $_POST['total3'];
		//die($total_amount);
		$soluong = $_POST['soluong3'];		
		$pro_id = $_POST['pro_id3'];
		$user_name = $_POST['user_name3'];
		$user_email = $_POST['user_email3'];
		$user_phone = $_POST['user_phone3'];
		$user_mess = $_POST['user_mess3'];
		
		//get local produc
		$db_cart_loca           = new db_query("SELECT * 
                                        FROM products_multi Where pro_id = '$pro_id'");									 
		$row_cart_loca  = mysql_fetch_array($db_cart_loca->result);
		$cart_loca = $row_cart_loca["pro_loca"];
		unset($db_cart_loca);
		//die($pro_id);
		$db_insert	       = new db_execute_return();
		$last_id		   = $db_insert->db_execute("
													INSERT INTO `cart_multi` 
													(														
														`pro_id` ,
														`cart_quality` ,
														`total_amount` ,
														`time_sent` ,
														`payment_type` ,
														`oder_status` ,
														`cart_loca` ,
														`user_id`
													)
													VALUES
													(														
														'$pro_id', 
														'$soluong',
														'$total_amount', 
														'$date', 
														'1', 
														'1',
														'$cart_loca',
														'$user_id_cart'
													);
												  "); 
		unset($db_insert);	
		//insert vào bảng chi tiết đơn hàng:
		$db_insert_detail	       = new db_execute_return();
		$last_id_detail		   = $db_insert_detail->db_execute("
													INSERT INTO `cart_detail` 
													(														
														`cart_id` ,														
														`date_update`
													)
													VALUES
													(														
														'$last_id', 														
														'$date'
													);
												  "); 
		unset($db_insert_detail);
		
		//insert vào bảng người đặt hàng : custom_cart:
		$db_insert_cus	       = new db_execute_return();
		$last_id_cus		   = $db_insert_cus->db_execute("
													INSERT INTO `custom_cart` 
													(														
														`cart_id` ,	
														`user_id` ,	
														`cus_name` ,
														`cus_email` ,
														`cus_phone` ,
														`cus_mes`												
													)
													VALUES
													(														
														'$last_id', 
														'$user_id_cart',
														'$user_name',	
														'$user_email',
														'$user_phone',	
														'$user_mess'														
													);
												  "); 
		unset($db_insert_cus);		
			//update số lượng sp:
			
	  		$db_update = new db_execute("UPDATE products_multi 
										  SET pro_coupon = pro_coupon + '$soluong'
										  WHERE pro_id = '".$pro_id."'");
		  unset($db_update);
		  unset($check_soluong); 				
		//Location SohaPay
		include("../classes/class_payment.php");
		$sohapay = new PG_checkout();
		
		$return_url = $pg_root_url.'/payment_info.php';
		$transaction_info = $user_mess;
		$order_code = time().'';
		$price = $total_amount*$soluong;
		$order_email = $user_email;
		$order_mobile = $user_phone;
		
		$url = $sohapay->buildCheckoutUrl($return_url, $transaction_info, $order_code, $price, $order_email, $order_mobile);
		header('Location:' . $url);
}
if(isset($_POST['form_checkout1']))
	{
		$total_amount = $_POST['total1'];
		//die($total_amount);
		$soluong = $_POST['soluong1'];		
		$pro_id = $_POST['pro_id1'];
		$user_name = $_POST['user_name'];
		$user_phone = $_POST['user_phone'];
		$user_add = $_POST['user_add'];
		$user_mess = $_POST['user_mess'];
		
		//get local produc
		$db_cart_loca           = new db_query("SELECT * 
                                        FROM products_multi Where pro_id = '$pro_id'");									 
		$row_cart_loca  = mysql_fetch_array($db_cart_loca->result);
		$cart_loca = $row_cart_loca["pro_loca"];
		unset($db_cart_loca);
		//die($pro_id);
		$db_insert	       = new db_execute_return();
		$last_id		   = $db_insert->db_execute("
													INSERT INTO `cart_multi` 
													(														
														`pro_id` ,
														`cart_quality` ,
														`total_amount` ,
														`time_sent` ,
														`payment_type` ,
														`oder_status` ,
														`cart_loca` ,
														`user_id`
													)
													VALUES
													(														
														'$pro_id', 
														'$soluong',
														'$total_amount', 
														'$date', 
														'1', 
														'1',
														'$cart_loca',
														'$user_id_cart'
													);
												  "); 
		unset($db_insert);	
		//insert vào bảng chi tiết đơn hàng:
		$db_insert_detail	       = new db_execute_return();
		$last_id_detail		   = $db_insert_detail->db_execute("
													INSERT INTO `cart_detail` 
													(														
														`cart_id` ,														
														`date_update`
													)
													VALUES
													(														
														'$last_id', 														
														'$date'
													);
												  "); 
		unset($db_insert_detail);
		
		//insert vào bảng người đặt hàng : custom_cart:
		$db_insert_cus	       = new db_execute_return();
		$last_id_cus		   = $db_insert_cus->db_execute("
													INSERT INTO `custom_cart` 
													(														
														`cart_id` ,	
														`user_id` ,	
														`cus_name` ,
														`cus_phone` ,
														`cus_mes` ,												
														`cus_add`
													)
													VALUES
													(														
														'$last_id', 
														'$user_id_cart',
														'$user_name',	
														'$user_phone',	
														'$user_mess',														
														'$user_add'
													);
												  "); 
		unset($db_insert_cus);		
			//update số lượng sp:
			
	  		$db_update = new db_execute("UPDATE products_multi 
										  SET pro_coupon = pro_coupon + '$soluong'
										  WHERE pro_id = '".$pro_id."'");
		  unset($db_update);
		  unset($check_soluong); 				
	chuyen_trang("../deals/checkout_success.php?city=1&cart_id=".$last_id."");	
	}
// thanh toán và nhận coupon ngay tại Mienphigiaohang
if(isset($_POST['form_checkout2']))
	{
		$total_amount = $_POST['total2'];
		//die($total_amount);
		$soluong = $_POST['soluong2'];		
		$pro_id = $_POST['pro_id2'];
		$user_name = $_POST['user_name2'];
		$user_phone = $_POST['user_phone2'];
		$user_mess = $_POST['user_mess2'];
		$user_add = 'Tại trụ sở mienphigiaohang.vn';
		
		//get local
		//get local produc
		$db_cart_loca           = new db_query("SELECT * 
                                        FROM products_multi Where pro_id = '$pro_id'");									 
		$row_cart_loca  = mysql_fetch_array($db_cart_loca->result);
		$cart_loca = $row_cart_loca["pro_loca"];
		unset($db_cart_loca);
		//die($pro_id);
		$db_insert	       = new db_execute_return();
		$last_id		   = $db_insert->db_execute("
													INSERT INTO `cart_multi` 
													(														
														`pro_id` ,
														`cart_quality` ,
														`total_amount` ,
														`time_sent` ,
														`payment_type` ,
														`oder_status` ,
														`cart_loca` ,
														`user_id`
													)
													VALUES
													(														
														'$pro_id', 
														'$soluong',
														'$total_amount', 
														'$date', 
														'1', 
														'1',
														'$cart_loca',
														'$user_id_cart'
													);
												  "); 
		unset($db_insert);	
		//insert vào bảng chi tiết đơn hàng:
		$db_insert_detail	       = new db_execute_return();
		$last_id_detail		   = $db_insert_detail->db_execute("
													INSERT INTO `cart_detail` 
													(														
														`cart_id` ,														
														`date_update`
													)
													VALUES
													(														
														'$last_id', 														
														'$date'
													);
												  "); 
		unset($db_insert_detail);		
		//insert vào bảng người đặt hàng : custom_cart:
		$db_insert_cus	       = new db_execute_return();
		$last_id_cus		   = $db_insert_cus->db_execute("
													INSERT INTO `custom_cart` 
													(														
														`cart_id` ,	
														`user_id` ,	
														`cus_name` ,
														`cus_phone` ,
														`cus_mes` ,												
														`cus_add`
													)
													VALUES
													(														
														'$last_id', 
														'$user_id_cart',
														'$user_name',	
														'$user_phone',	
														'$user_mess',														
														'$user_add'
													);
												  "); 
		unset($db_insert_cus);
		
		//update số lượng sp:
			
	  		$db_update = new db_execute("UPDATE products_multi 
										  SET pro_coupon = pro_coupon + '$soluong'
										  WHERE pro_id = '".$pro_id."'");
		  unset($db_update);
		   unset($check_soluong);
							
	chuyen_trang("../deals/checkout_success.php?city=1&cart_id=".$last_id."");	
	}
	
?>