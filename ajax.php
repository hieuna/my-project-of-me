<?php
define('PG_PAGE_AJAX', TRUE);
$page = "ajax";
include "header.php";

// THIS FILE CONTAINS RANDOM JAVASCRIPT-Y FEATURES SUCH AS POSTING COMMENTS AND DELETING ACTIONS
$task = PGRequest::getVar('task', NULL, 'REQUEST');

// GET DEBUG INFO
if($task == "get_debug_info")
{
  	if( !is_object($admin) || !$admin->admin_exists ) exit();
  
  	if(isset($_POST['id'])) { $id = $_POST['id']; } elseif(isset($_GET['id'])) { $id = $_GET['id']; } else { exit(); }
  	$id = preg_replace('/[^a-zA-Z0-9\._]/', '', $id);
  
  	echo file_get_contents(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$id.'.html');
  
  	// Delete logs older than an hour
  	$dh = @opendir(PG_ROOT.DIRECTORY_SEPARATOR.'log');
  	if($dh)
  	{
	    while( ($file = @readdir($dh)) !== false )
	    {
	      	if( $file == "." || $file == ".." ) continue;
	      	if( filemtime(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$file)>time()-3600 ) continue;
	      	@unlink(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$file);
	    }
  	}
  
  	exit();
}

else if ($task=='checkmax')
{
	$order_session 	= PGRequest::getCmd('session', '', 'POST');
	$outputArray = checkMaxProduct($order_session);
	print json_encode($outputArray);
	exit();
}

else if ($task=='loadDistrictDropdown'){
	$city_id = PGRequest::getInt('city_id', 0, 'POST');
  $is_ship = PGRequest::getInt('is_ship', 0, 'POST');
	$districts = getDistrict();
	foreach ($districts AS $districtID => $district){
		if ($city_id!=$district['district_city_id']) continue;
    if ($is_ship && ($district['district_shippable']==0)) continue;
		$output[ $districtID ] = array('id'=>$districtID, 'title'=>$district['district_name'], 'is_urban'=>$district['district_is_urban']);
	}
	print json_encode($output);
	exit();
}

else if ($task=='cartRegister'){
	$email = PGRequest::getVar('email','','POST');
	$tel = PGRequest::getCmd('tel','','POST');
	$fullname = PGRequest::getVar('fullname','','POST');
	$address = PGRequest::getVar('address','','POST');
	$otp = PGRequest::getInt('otp','','POST');
	$shipping = PGRequest::getInt('shipping','','POST');
	$ship_active = PGRequest::getInt('ship_active','','POST');
	$ship_code = PGRequest::getCmd('ship_code','','POST');
	$quantity = PGRequest::getInt('quantity','','POST', 1);
	$order_session = $session->get('order_session');
  if (is_null($order_session)) $order_session = PGRequest::getVar('session','','POST');
	
	$query = "SELECT * FROM orders WHERE order_session='{$order_session}' LIMIT 1";
	$order = $database->db_fetch_assoc( $database->db_query($query) );
	
	// Tinh phi COD hoac SHIP
	$total_ship_fee = 0;
	if ($ship_code=='COD' && $ship_active){
		if ($order['order_cod_type']==0){
			$total_ship_fee = $order['order_cod_fee'];
		}
		else {
			$total_ship_fee = $order['order_cod_fee']*$quantity;
		}
	}
	if ($ship_code=='SHIP' && $shipping>0 && $order['order_ship']){
		if ($order['order_ship_type']==1) $total_ship_fee = $order['order_ship_fee']*$quantity;
		else $total_ship_fee = $order['order_ship_fee'];
		$database->db_query("UPDATE orders SET order_is_ship=1 WHERE order_session='{$order_session}'");
	}
	else {
		$database->db_query("UPDATE orders SET order_is_ship=0 WHERE order_session='{$order_session}'");
	}
	
	// Tinh tong tien hang
	$total_product_fee = $order['order_product_price']*$quantity;
	
	$data = array(
		'err' => 0,
		'msg' => 'success',
        'fullname' => $fullname,
        'email'    => $email,
        'mobile_phone' => $tel
    );
    
	if ($user->user_exists){
		$customer_type = 'customer';
		$id = $user->user_info['user_id'];
		$database->db_query("UPDATE orders SET order_user_id={$id}, order_email='%s', order_mobile='%s' WHERE order_session='{$order_session}'", $email, $tel);
	}
	else {
		$customer_type = 'guest';
		if (!$order['order_guest_id']){
			$result = $database->db_query("INSERT INTO guests (guest_fullname, guest_email, guest_created, guest_ip_signup, guest_mobile, guest_address, guest_status) VALUES 
											(
											'".$database->getEscaped($fullname)."',
											'".$database->getEscaped($email)."',
											'".time()."',
											'".$_SERVER['REMOTE_ADDR']."',
											'{$tel}',
											'".$database->getEscaped($address)."',
											1
											)");
			$id = $database->db_insert_id();
			$database->db_query("UPDATE orders SET order_guest_id={$id}, order_email='%s', order_mobile='%s' WHERE order_session='{$order_session}'", $email, $tel);
		}
		else {
			$database->db_query("UPDATE guests SET 
									guest_fullname='".$database->getEscaped($fullname)."',
									guest_email='".$database->getEscaped($email)."',
									guest_mobile='{$tel}',
									guest_address='".$database->getEscaped($address)."' 
									WHERE guest_id={$order['order_guest_id']}");
			$id = $order['order_guest_id'];
		}
	}
	$otp_code='';
	$data['id'] = $id;
    $data['type'] = $user->user_exists ? 'customer' : 'guest';
    $data['otp'] = $otp_code;
	$data['total'] = $total_product_fee+$total_ship_fee;
    $data['total_price'] = formatMoney($data['total']).' đ';
    $data['total_price_noship'] = formatMoney($total_product_fee).' đ';
    $data['total_ship'] = formatMoney($total_ship_fee).' đ';
    
    print json_encode($data);
    exit();
}

elseif ($task=='cartFinish'){
	$paymentType 		= PGRequest::getInt('paymentType', 1);
	$shipping_address 	= PGRequest::getVar('address','','POST');
	$shipping_city 		= PGRequest::getInt('city','','POST');
	$shipping_district 	= PGRequest::getVar('district','','POST');
  $shipping_district_id 	= PGRequest::getVar('district_id','','POST');
	$shipping_note 		= PGRequest::getVar('note','','POST');
	$quantity 			= PGRequest::getInt('quantity','','POST', 1);
	$adminNote 			= PGRequest::getVar('adminNote','','POST');
	$atm 				= PGRequest::getCmd('atm','','POST');
	$order_session 		= $session->get('order_session');
  if (is_null($order_session)) $order_session = PGRequest::getVar('session','','POST');
	
	$query = "SELECT * FROM orders WHERE order_session='{$order_session}' LIMIT 1";
	$order = $database->db_fetch_assoc( $database->db_query($query) );
	
	$total_product_price = $quantity*$order['order_product_price'];
	$total_ship_price = 0;
  
  $districts = getDistrict();
	if ($order['order_is_ship']){
		if ($order['order_ship_type']==1) $total_ship_price = $quantity*$order['order_ship_fee'];
		elseif ($order['order_ship_type']==3){
		  $site = $database->db_fetch_assoc($database->db_query("SELECT site_shipping_urban_fee, site_shipping_suburb_fee FROM sites WHERE site_id='%d' LIMIT 1", $order['order_site_id']));
		  $total_ship_price = ($districts[$shipping_district_id]['district_is_urban'])?$site['site_shipping_urban_fee']:$site['site_shipping_suburb_fee'];
		}else $total_ship_price = $order['order_ship_fee'];
	}
	$total_price = intval($total_product_price+$total_ship_price);
	
	$query = "UPDATE orders SET 
				order_price={$total_price}, 
				order_shipinfo_address='".$database->getEscaped($shipping_address)."',
				order_shipinfo_city='{$shipping_city}',
				order_shipinfo_district='".$database->getEscaped($shipping_district)."',
				order_shipinfo_note='".$database->getEscaped($shipping_note)."',
				order_product_quantity='".$database->getEscaped($quantity)."',
        order_ship_fee='".$database->getEscaped($total_ship_price)."'
				WHERE order_session='{$order_session}'";
	$update = $database->db_query($query);
	if ($update){
		if ($paymentType==0){
			// CREATE PAYMENT
			$sql = "INSERT INTO payments
				(
					payment_site_id,
					payment_order_id,
					payment_type,
					payment_name,
					payment_total,
					payment_time,
					payment_ip,
					payment_status
				) VALUES (
					'{$order['order_site_id']}',
					'{$order['order_id']}',
					'4',
					'{$atm}',
					'{$total_price}',
					'" . $datetime->timestampToDateTime () . "',
					'{$_SERVER['REMOTE_ADDR']}',
					'-1'
				)";
			
			$insertPayment = $database->db_query ( $sql );
			$payment_id = $database->db_insert_id ();
			
			// UPDATE ORDER
			$query = "UPDATE orders SET order_paynumber=order_paynumber+1, order_paylastest={$payment_id}, order_paylastest_type='4', order_paylastest_status='-1' WHERE order_id=" . $order ['order_id'];
			$database->db_query ( $query );

			$payment_transfer_expires = TIME_NOW + $setting['setting_transfer_expires'];
			$sql = "INSERT INTO payments_transfer 
					(
						payment_transfer_payment_id,
						payment_transfer_expires,
						payment_transfer_note,
						payment_transfer_status
					) VALUES (
						'{$payment_id}',
						'{$payment_transfer_expires}',
						'".$database->getEscaped($adminNote)."',
						'0'
					)";
			$database->db_query ( $sql );
			
			$url_return = makeReturnURLGold($order['order_session']);
			
			echo JsonSuccess('success', array('url' => $url_return));
			exit();
		}
		else if ($paymentType==1){
			setcookie('sessionCookie', $order_session, time() + 1800);
			print json_encode(array('err'=>0, 'urlSohaPay' => PG_URL_ROOT.'payment_method.php?session='.$order_session));
			exit();
		}
		else if ($paymentType==2){
			if (!$user->user_exists){
				echo JsonErr('cus_not_found'); exit();
			}
			$gold_before = $user->user_info['user_gold'];
			if ($gold_before >= $total_price){
				$goldClass = new PGGold($user);
				
				$truGold = $goldClass->gold_change($total_price, false);
				
				if ($truGold!==false){
					$gold_after = $truGold;
					
					// CREATE PAYMENT
					$sql = "INSERT INTO payments
						(
							payment_site_id,
							payment_order_id,
							payment_type,
							payment_name,
							payment_total,
							payment_time,
							payment_ip,
							payment_status
						) VALUES (
							'{$order['order_site_id']}',
							'{$order['order_id']}',
							'6',
							'Gold',
							'{$total_price}',
							'" . $datetime->timestampToDateTime () . "',
							'{$_SERVER['REMOTE_ADDR']}',
							1
						)";
					
					$insertPayment = $database->db_query ( $sql );
					$payment_id = $database->db_insert_id ();
					
					// UPDATE ORDER
					$query = "UPDATE orders SET order_paynumber=order_paynumber+1, order_paylastest={$payment_id}, order_paylastest_type='6', order_paylastest_status='1' WHERE order_id=" . $order ['order_id'];
					$database->db_query ( $query );
	
					//Insert Logs
					$logClass = new PGLog($user);
					$logClass->log_gold('truGoldThanhToan', $payment_id, 'payments', $gold_after, $gold_before);
					
					$url_return = makeReturnURLGold($order['order_session']);
					
					echo JsonSuccess('success', array('url' => $url_return));
					exit();
				}
			}
			else {
				$more_gold = $total_price - $gold_before;
				echo JsonSuccess('thieuGold', array('more_gold' => $more_gold, 'gold' => $gold_before, 'total' => $total_price));
				exit();
			}
		}
	}
}

else if ($task=='getGoldInfo'){
	if (!$user->user_exists) {
		print json_encode(array('err'=>1, 'msg' => 'Chưa đăng nhập tài khoản'));
		exit();
	}
	$output = array(
		'err' => 0,
		'msg' => 'success',
		'customer' => array(
			'id' => $user->user_info['user_id'],
			'is_active_mail' => $user->user_info['user_verified'],
			'gold' => $user->user_info['user_gold'],
			'email' => $user->user_info['user_email']
		)
	);
	print json_encode($output);
	exit();
}
// DzungDH 2011-05-11 - Charge Gold
else if ($task=='getGoldInfoByEmail'){
    $user_email = PGRequest::getVar('user_email','');
	$u = new PGUser(array('', $user_email, ''));
    if (!$u->user_exists) {
		print json_encode(array('err'=>1, 'msg' => 'Email không tồn tại hoặc chưa được kích hoạt')); exit();
	}
    
	$output = array(
		'err' => 0,
		'msg' => 'success',
		'user_info' => array(
			'user_id' => $u->user_info['user_id'],
            'user_mobile' => substr($u->user_info['user_mobile'], 0, 4).'***',
			'user_gold' => $u->user_info['user_gold'],
			'user_email' => $u->user_info['user_email'],
            'user_fullname' => $u->user_info['user_fullname']
		)
	);
	print json_encode($output);
	exit();
}

else if ($task=='chargeMobiCard'){
	$code = PGRequest::getVar('code_card','');
	$type = PGRequest::getCmd('card_type','');
	$email= PGRequest::getVar('email','');

	if($code == '' || ($type != 'mobifone' && $type != 'vinaphone')){
		echo JsonErr('code_invalid');exit();
	}
	if (!$user->user_exists){
		echo JsonErr('cus_not_found');exit();
	}
	
	require_once 'include/functions_merchant.php';
	require_once 'include/class_merchant.php';
	if($email == '' || $email == $user->user_info['user_email']){
		$return = addGoldByCard($code,$type,$user);
		if(is_array($return)){
			echo JsonSuccess("success", $return);exit();
		}
		echo JsonErr($return);exit();
	}
	
}

else if ($task=='userLogout'){
	$user->user_logout();
	echo JsonSuccess("success");exit();
}

else if ($task=='userLogin'){
	// GET POST
	$email = PGRequest::getVar ( 'email', '', 'POST' );
	$password = PGRequest::getVar ( 'pass', '', 'POST' );
	$persistent = PGRequest::getInt ( 'save', 0, 'POST' );
	$order_session = PGRequest::getCmd ('order_session', '', 'POST');
	
	$user->user_login ( array($email), $password, 0, $persistent );
	// IF USER IS LOGGED IN SUCCESSFULLY, FORWARD THEM TO SPECIFIED URL
	if (! $user->is_error) {
		$order = $database->db_fetch_assoc( $database->db_query("SELECT order_site_id, order_email FROM orders WHERE order_session='{$order_session}' LIMIT 1") );
		if ($order['order_email']){
			$checkAvai = $database->db_num_rows( $database->db_query("SELECT NULL FROM users_link WHERE userlink_user_id={$user->user_info['user_id']} AND userlink_site_id={$order['order_site_id']} AND userlink_userclient_email='{$order['order_email']}'") );
			if (!$checkAvai){
				$database->db_query("INSERT INTO users_link (userlink_user_id, userlink_site_id, userlink_userclient_email, userlink_created) VALUES ({$user->user_info['user_id']}, {$order['order_site_id']}, '{$order['order_email']}', '".time()."')");
			}
		}
	
		echo JsonSuccess("success");exit();
	}

	// IF THERE WAS AN ERROR, SET ERROR MESSAGE
	else {
		echo JsonErr($user->is_error);exit();
	}
}
else if ($task=='Register'){	
	$input['user_email'] 	= trim(PGRequest::getVar('email', '', 'POST'));
	$input['user_password'] = trim(PGRequest::getVar('pass', '', 'POST'));
	$input['user_fullname'] = trim(PGRequest::getVar('uname', '', 'POST'));
	$input['user_mobile'] 	= trim(PGRequest::getCmd('phone', '', 'POST'));
	$input['user_address'] 	= trim(PGRequest::getVar('address', '', 'POST'));
	$input['user_district'] = trim(PGRequest::getInt('district', '', 'POST'));
	$input['user_city'] 	= trim(PGRequest::getInt('city', '', 'POST'));
	$order_session 			= PGRequest::getCmd ('order_session', '', 'POST');
	
	$new_user = new PGUser();
	
	// CHECK USER ERRORS
  	$new_user->user_account($input['user_email'], '', $input['user_fullname'], $input['user_mobile'], $input['user_address'], $input['user_district'], $input['user_city']);

	// INSERT NEW USER
	if (!$new_user->is_error){
		$doCreate = $new_user->user_create($input['user_email'], '', $input['user_password'], $input['user_fullname'], $input['user_mobile'], $input['user_address'], $input['user_district'], $input['user_city']);
		
		// SET SIGNUP COOKIE
	    $em = $new_user->user_info['user_email'];
	    setcookie("signup_email", "$em", 0, "/");
	    
		if ($doCreate) {
			$order = $database->db_fetch_assoc( $database->db_query("SELECT order_site_id, order_email FROM orders WHERE order_session='{$order_session}' LIMIT 1") );
			if ($order['order_email']){
				$database->db_query("INSERT INTO users_link (userlink_user_id, userlink_site_id, userlink_userclient_email, userlink_created) VALUES ({$new_user->user_info['user_id']}, {$order['order_site_id']}, '{$order['order_email']}', '".time()."')");
			}

			echo JsonSuccess("Bạn đã tạo tài khoản thành công trên Cổng thanh toán MuachungPay. \nEmail kích hoạt đã được gửi vào hòm thư:".$input['user_email']."\nVui lòng kiểm tra và kích hoạt tài khoản.");exit();
		}
	}
	echo JsonErr($new_user->is_error);exit();
}

else if ($task=='checkUserLogin'){
	if (!$setting['setting_signup_enable']) return '';
	if ($user->user_exists){
		$token = md5 ( uniqid ( mt_rand (), true ) );
		$session->set ( 'token', $token );
		$return['template'] = '	<link rel="stylesheet" href="'.PG_URL_ROOT.'templates/css/chargeGold.css" title="stylesheet" type="text/css" /><div class="showUser" id="logout" style="width:200px">
						<form name="frmLogout">
						<div class="user">Xin chào: <a href="'.PG_URL_ROOT.'user_info.php">'.$user->user_info['user_fullname'].'</a> 
						<a href="'.PG_URL_ROOT.'user_logout.php?token='.$token.'"><font color="red">[thoát]</font></a></div>
						<div class="account">Tài khoản: <b><span id="user_gold"></span>₫</b> <a href="javascript:void(0);" onclick="shp.chargeGold.step_1();">[ Nạp tiền ]</a></div>
						</form>
					</div>';
				
	}
	else {
		$return['template'] = '<div class="showUser" id="login">
					<form action="'.PG_URL_ROOT.'login.php" method="POST" id="login" name="login">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td colspan="3">
								<a href="'.PG_URL_ROOT.'login.php?task=lostPassword">Quên mật khẩu?</a> | <a href="'.PG_URL_ROOT.'signup.php">Đăng ký</a> | <a href="'.PG_URL_ROOT.'signup_verify.php?task=resend">Kích hoạt</a>
							</td>
						</tr>
						<tr height="10"><td colspan="3"></td></tr>
						<tr>
							<td>
								<label for="email">Email đăng nhập</label>
								<input type="text" id="email" name="email" class="inputtextbox">
							</td>
							<td>
								<label for="password">Mật khẩu</label>
								<input type="password" class="inputtextbox" id="password" name="password">
							</td>
							<td>
								<input type="submit" value="Đăng nhập" class="inputbutton" onclick="shop.customer.loginHeader();"/>
							</td>
						</tr>
					</table>
					<input type="hidden" name="task" value="dologin" />
					<NOSCRIPT><input type="hidden" name="javascript" value="no"/></NOSCRIPT>
					</form>
				</div>';
	}
	$return['jsonUser'] = $user;
	$return['urlBase'] = PGURI::getInstance()->base();
	
	echo json_encode($return);exit();
}

else if ($task == 'khuyenmai'){
	$user_id 	= PGRequest::getInt('user_id', 0, 'GET');
	$product_id	= PGRequest::getInt('product_id', 0, 'GET');
	
	$sql = "SELECT product_total_buy FROM products WHERE product_id=".$product_id;
	$results = $database->db_fetch_assoc( $database->db_query($sql) );
	$totalRecords = $results['product_total_buy'];

	$html = 'Số phiếu đã mua: <br /><b>'.$totalRecords.' người</b>';
	
	echo $html;
}
?>