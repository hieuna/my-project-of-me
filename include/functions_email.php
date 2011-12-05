<?php
defined('PG_PAGE') or die();
require_once PG_ROOT.'/include/phpmailer/class.phpmailer.php';

function send_email($recipient, $sender='', $subject, $message, $order_id)
{
	global $setting, $database;
	if (PGRequest::getBool('test_mode', false, 'COOKIE')) return true;
	
	// DECODE SUBJECT AND EMAIL FOR SENDING
	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
	$message = htmlspecialchars_decode($message, ENT_QUOTES);

	// ENCODE SUBJECT FOR UTF8
	$subject="=?UTF-8?B?".base64_encode($subject)."?=";

	// REPLACE CARRIAGE RETURNS WITH BREAKS
	$message = str_replace("\n", "", $message);
	
	$content = '
    <table cellpadding="0" cellspacing="0" width="600" align="center" style="border:1px solid #333; padding:10px 0;">
		<tr>
			<td align="center">
			<table cellpadding="0" cellspacing="0" width="560px">
				<thead>
					<tr>
						<td><h1 style="margin: 0; padding: 10px 0; border-bottom: 1px solid #ccc;"><a rel="nofollow" title="SohaPay.com" target="_blank" style="color:#892691;" href="'.$uribase.'"><img src="'.$uribase.'templates/images/logo-header-mail-shp.gif" alt="SohaPay.com" border="0" width="215" height="48"/></a></h1></td>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td align="center">
						'.$message.'
						</td>
					</tr>
				</tbody>
				
				<tfoot>
					<tr>
						<td align="center" style="color:#008FD7; font-size: 11px; font-family: Arial, Tahoma, Verdana; padding:5px 0;">
						Bản quyền © 2010 SohaPay.com
						</td>
					</tr>
					<tr>
						<td align="center" style="color:#008FD7; font-size: 11px; font-family: Arial, Tahoma, Verdana;">
						<ul>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'" target="_blank" style="color:#008FD7; text-decoration: none;">Trang chủ</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li> 
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/" target="_blank" style="color:#008FD7; text-decoration: none;">Giới thiệu</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li> 
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/help/quy-dinh-chinh-sach/dieu-khoan-su-dung.html" target="_blank" style="color:#008FD7; text-decoration: none;">Điều khoản sử dụng</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/help/quy-dinh-chinh-sach/chinh-sach-bao-mat.html" target="_blank" style="color:#008FD7; text-decoration: none;">Chính sách bảo mật</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/help.html" target="_blank" style="color:#008FD7; text-decoration: none;">Trợ giúp</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/contact.html" target="_blank" style="color:#008FD7; text-decoration: none;">Liên hệ</a></li>
						</ul>
						</td>
					</tr>
				</tfoot>
			</table>
			</td>
		</tr>
	</table>
	';
	
	//@date_default_timezone_set('Bangkok/Hanoi/Jakarta');
	
	$sendmail = false;
	//echo $setting['mail_type'];
	//print_r($setting);
	$mail             = new PHPMailer();
	$mail->CharSet	  = "utf-8";
	//$mail->SetLanguage("vn",PG_ROOT.'/include/phpmailer/language/');
	
	if ($setting['mail_type']=='smtp'){
		$mail->IsSMTP();
		$mail->SMTPAuth   = $setting['mail_smtpauth'];                  // enable SMTP authentication
		$mail->SMTPSecure = $setting['mail_smtpsecure'];                 // sets the prefix to the servier
		$mail->Host       = $setting['mail_smtphost'];      // sets GMAIL as the SMTP server
		$mail->Port       = $setting['mail_smtpport'];                   // set the SMTP port for the GMAIL server
		
		$mail->Username   = $setting['mail_smtpuser'];  // GMAIL username
		$mail->Password   = $setting['mail_smtppass'];            // GMAIL password
	}
	else {
		$mail->IsSendmail();
		$mail->Sendmail	= $setting['mail_sendmailpath'];
	}
	
	// Do Sent mail
	if (!$sender) $sender=$setting['mail_smtpuser'];
  	$mail->AddReplyTo($sender);
	
	$mail->From       = $sender;
	$mail->FromName   = "Cong thanh toan SohaPay";
	$mail->IsHTML(true); // send as HTML
	
	$mail->Subject    = $subject;
	$mail->MsgHTML($content);
	$mail->AddAddress($recipient,"");
	//$mail->AddBCC('khaitranquang@vccorp.vn');
	if ($mail->Send()==true){
		$database->db_query("UPDATE orders SET order_sendmail=1 WHERE order_id=$order_id");
	}
	else return false;
} // END FUNCTION

function emailPayInfo($order_session){
	global $database, $datetime, $uri, $settingClass;
	
	$uribase = PG_URL_ROOT;
	
	// GET Order info
	$sql = "SELECT o.order_id, o.order_email, o.order_code, o.order_price, o.order_info, o.order_time, o.order_status, s.site_name, s.site_domain, s.site_use_coupon, p.payment_type, p.payment_name, p.payment_total, p.payment_time   
			FROM orders AS o 
			INNER JOIN sites AS s ON (s.site_id=o.order_site_id) 
			INNER JOIN payments AS p ON (p.payment_id = o.order_paylastest) 
			WHERE o.order_session='{$order_session}' AND o.order_status=1 AND s.site_publish=1 AND p.payment_status=1 
			LIMIT 1";
	$result = $database->db_query($sql);
	if ($database->db_num_rows($result)!=1) return false;
	
	$order = $database->db_fetch_assoc($result);
	
	$settingMethod = $settingClass->getPaymentMethod(NULL, $order_session);
	
	$order['order_price'] = intval($order['order_price']);
	$order['order_price_out'] = formatMoney($order['order_price']);
	$order['order_fee'] = feeOrder($order['order_price'], $order['payment_type']);
	$order['order_fee_out'] = formatMoney($order['order_fee']);
	$order['order_total_out'] = formatMoney($order['payment_total']);
	$order['methodChoosed'] = $order['payment_name'];
	$order['payment_time'] = $datetime->datetimeDisplay($order['payment_time']);
  
  	// Lay danh sach coupon
  	$coupon_content = $coupon_note = "";
  	if ($order['site_use_coupon']==1){
	    $res = $database->db_query("SELECT coupon_code FROM coupons WHERE coupon_order_id=%s", $order['order_id']);
	    $aCoupon = array();
	    while ($coupon = $database->db_fetch_assoc($res)){
	      	$aCoupon[] = $coupon['coupon_code'];
	    }
	    
	    if (count($aCoupon)>0){
	      	$coupon_content = '<tr><td valign="top" align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Mã coupon</td><td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">%s</td></tr>';
	      	$coupon_content = sprintf($coupon_content, implode('<br/>', $aCoupon));
	      	$coupon_note = '<li style="color: #000; margin-bottom: 5px;">Bạn chỉ cần ghi lại Mã số phiếu mua hàng và qua nhà cung cấp để sử dụng ngay dịch vụ.</li>';
	    }
  	}
	
	$content = '
    <table cellpadding="0" cellspacing="0" width="600" align="center" style="border:none; padding:10px 0;">
		<tr>
			<td align="center">
			<table cellpadding="0" cellspacing="0" width="560px">
				<thead>
					<tr>
						<td><h1 style="margin: 0; padding: 10px 0; border-bottom: 1px solid #ccc;"><a rel="nofollow" title="SohaPay.com" target="_blank" style="color:#008FD7;" href="'.$uribase.'"><img src="'.$uribase.'templates/images/logo-header-mail-shp.gif" alt="SohaPay.com" border="0" width="215" height="48"/></a></h1></td>
					</tr>
					<tr>
						<td><h3 style="padding-top: 10px; color:#666;">Chúc mừng bạn đã thanh toán thành công tại <b style="color:#0086CD; text-transform: uppercase;">Soha</b><b style="color:#008FD7; text-transform: uppercase;">Pay</b><b style="text-transform: uppercase;">.com!</b></h1></td>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td align="center">
						<table cellpadding="0" cellspacing="0" width="558" style="border: 1px solid #ccc; font-family: Arial, Tahoma; font-size: 12px;">
							<tr bgcolor="008FD7">
								<td colspan="2" style="padding-left: 10px; color:#fff; line-height: 28px; text-transform: uppercase; background: url(./templates/images/tick.gif) no-repeat 530px top;">Thông tin chi tiết</td>
							</tr>
							<tr>
								<td align="right" width="40%" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Mã hóa đơn</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;"><a href="'.$uribase.'payment_info.php?session='.$order_session.'" rel="nofollow" style="color:#0086CD; text-decoration:none" target="_blank">'.$order['order_code'].'</a></td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Phương thức thanh toán</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['methodChoosed'].'</td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Tổng giá trị đơn hàng</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['order_price_out'].' VNÐ</td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Phí thanh toán</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['order_fee_out'].' VNÐ</td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Tổng giá trị thanh toán</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['order_total_out'].' VNÐ</td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Thời gian thanh toán</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['payment_time'].'</td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Thanh toán cho</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['site_name'].'</td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Website mua hàng</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;"><a href="http://'.$order['site_domain'].'" rel="nofollow" target="_blank" style="text-decoration:none; color:#008FD7;">'.$order['site_domain'].'</a></td>
							</tr>
							<tr>
								<td align="right" style="padding-right: 8px; border-top: 1px solid #ccc; border-right: 1px solid #ccc; font-weight: bold; line-height: 28px;">Thông tin đơn hàng</td>
								<td align="left" style="padding-left: 8px; border-top: 1px solid #ccc; line-height: 28px;">'.$order['order_info'].'</td>
							</tr>
              				'.$coupon_content.'
							<tr bgcolor="008FD7">
								<td colspan="2" style="padding-left: 10px; color:#fff; line-height: 28px; text-transform: uppercase; background: url(./templates/images/tick.gif) no-repeat 530px top;">Lưu ý</td>
							</tr>
							<tr>
								<td colspan="2" align="left" style="padding: 5px; font-size: 11px; color:#000;">
								<ul style="margin: 0 0 0 10px; padding: 0;">
									'.$coupon_note.'
									<li style="margin-bottom: 5px;"><a href="'.$uribase.'payment_info.php?session='.$order_session.'" rel="nofollow" target="_blank" style="color:#0086CD; text-decoration:none">Xem chi tiết thông tin thanh toán trên website</a>.</li>
									<li style="color: #000; margin-bottom: 5px;">Email này được gửi tự động khi bạn thanh toán thành công tại Cổng thanh toán <a rel="nofollow" title="SohaPay.com" target="_blank" style="color:#000; font-weight:bold;" href="'.$uribase.'">SohaPay</a>. Đề nghị bạn không trả lời email này. Nếu cần hỗ trợ xin gửi email tới <a rel="nofollow" title="SohaPay.com" target="_blank" style="color:#000; font-weight:bold;" href="'.$uribase.'">sohapay.com</a>.</li>
									<li style="color: #000; margin-bottom: 5px;">Vui lòng thêm địa chỉ <a href="mailto:noreply@sohapay.com" style="color:#000; text-decoration:none; font-weight:bold;">noreply@sohapay.com</a> và <a href="mailto:hotro@sohapay.com" style="color:#000; text-decoration:none; font-weight:bold;">hotro@sohapay.com</a> vào danh bạ email của bạn để đảm bảo nhận được các thông báo và hỗ trợ từ <a rel="nofollow" title="SohaPay.com" target="_blank" style="color:#000; font-weight:bold;" href="'.$uribase.'">sohapay.com</a></li>
								</ul>
								</td>
							</tr>
						</table>
						</td>
					</tr>
				</tbody>
				
				<tfoot>
					<tr>
						<td align="center" style="color:#008FD7; font-size: 11px; font-family: Arial, Tahoma, Verdana; padding:5px 0;">
						Bản quyền © 2010 SohaPay.com
						</td>
					</tr>
					<tr>
						<td align="center" style="color:#008FD7; font-size: 11px; font-family: Arial, Tahoma, Verdana;">
						<ul style="margin-left: 50px;">
							<li style="float:left; list-style: none; margin: 0;"><a href="'.$uribase.'" target="_blank" style="color:#008FD7; text-decoration: none;">Trang chủ</a></li> <li style="float:left; list-style: none; padding: 0 5px; margin:0;">|</li> 
							<li style="float:left; list-style: none; margin: 0;"><a href="'.$uribase.'info/" target="_blank" style="color:#008FD7; text-decoration: none;">Giới thiệu</a></li> <li style="float:left; list-style: none; padding: 0 5px; margin:0;">|</li> 
							<li style="float:left; list-style: none; margin: 0;"><a href="'.$uribase.'info/help/quy-dinh-chinh-sach/dieu-khoan-su-dung.html" target="_blank" style="color:#008FD7; text-decoration: none;">Điều khoản sử dụng</a></li> <li style="float:left; list-style: none; padding: 0 5px; margin:0;">|</li>
							<li style="float:left; list-style: none; margin: 0;"><a href="'.$uribase.'info/help/quy-dinh-chinh-sach/chinh-sach-bao-mat.html" target="_blank" style="color:#008FD7; text-decoration: none;">Chính sách bảo mật</a></li> <li style="float:left; list-style: none; padding: 0 5px; margin:0;">|</li>
							<li style="float:left; list-style: none; margin: 0;"><a href="'.$uribase.'info/contact.html" target="_blank" style="color:#008FD7; text-decoration: none;">Liên hệ</a></li>
						</ul>
						</td>
					</tr>
				</tfoot>
			</table>
			</td>
		</tr>
	</table>
	';
	//<li><a href="'.$uribase.'complaints.php?session='.$order_session.'" rel="nofollow" target="_blank">Khiếu nại giao dịch này.</a></li>
	return $content;
}

function send_email_system($recipient, $sender='', $subject, $message)
{
	global $setting, $database;
	
	// DECODE SUBJECT AND EMAIL FOR SENDING
	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
	$message = htmlspecialchars_decode($message, ENT_QUOTES);

	// ENCODE SUBJECT FOR UTF8
	$subject="=?UTF-8?B?".base64_encode($subject)."?=";

	// REPLACE CARRIAGE RETURNS WITH BREAKS
	$message = str_replace("\n", "", $message);
	
	$content = '
    <table cellpadding="0" cellspacing="0" width="600" align="center" style="border:1px solid #333; padding:10px 0;">
		<tr>
			<td align="center">
			<table cellpadding="0" cellspacing="0" width="560px">
				<thead>
					<tr>
						<td><h1 style="margin: 0; padding: 10px 0; border-bottom: 1px solid #ccc;"><a rel="nofollow" title="SohaPay" target="_blank" style="color:#008FD7;" href="'.$uribase.'"><img src="'.$uribase.'templates/images/logo-header-mail-shp.gif" alt="SohaPay" border="0" width="215" height="48"/></a></h1></td>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<td align="center">
						'.$message.'
						</td>
					</tr>
				</tbody>
				
				<tfoot>
					<tr>
						<td align="center" style="color:#008FD7; font-size: 11px; font-family: Arial, Tahoma, Verdana; padding:5px 0;">
						Bản quyền © 2010 SohaPay.com
						</td>
					</tr>
					<tr>
						<td align="center" style="color:#008FD7; font-size: 11px; font-family: Arial, Tahoma, Verdana;">
						<ul>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'" target="_blank" style="color:#008FD7; text-decoration: none;">Trang chủ</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li> 
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/" target="_blank" style="color:#008FD7; text-decoration: none;">Giới thiệu</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li> 
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/help/quy-dinh-chinh-sach/dieu-khoan-su-dung.html" target="_blank" style="color:#008FD7; text-decoration: none;">Điều khoản sử dụng</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/help/quy-dinh-chinh-sach/chinh-sach-bao-mat.html" target="_blank" style="color:#008FD7; text-decoration: none;">Chính sách bảo mật</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/help.html" target="_blank" style="color:#008FD7; text-decoration: none;">Trợ giúp</a></li> <li style="float:left; list-style: none; padding: 0 5px;">|</li>
							<li style="float:left; list-style: none;"><a href="'.$uribase.'info/contact.html" target="_blank" style="color:#008FD7; text-decoration: none;">Liên hệ</a></li>
						</ul>
						</td>
					</tr>
				</tfoot>
			</table>
			</td>
		</tr>
	</table>
	';
	$content = $message;
	$sendmail = false;
	//echo $setting['mail_type'];
	//print_r($setting);
	$mail             = new PHPMailer();
	$mail->CharSet	  = "utf-8";
	//$mail->SetLanguage("vn",PG_ROOT.'/include/phpmailer/language/');
	
	if ($setting['mail_type']=='smtp'){
		$mail->IsSMTP();
		$mail->SMTPAuth   = $setting['mail_smtpauth'];                  // enable SMTP authentication
		$mail->SMTPSecure = $setting['mail_smtpsecure'];                 // sets the prefix to the servier
		$mail->Host       = $setting['mail_smtphost'];      // sets GMAIL as the SMTP server
		$mail->Port       = $setting['mail_smtpport'];                   // set the SMTP port for the GMAIL server
		
		$mail->Username   = $setting['mail_smtpuser'];  // GMAIL username
		$mail->Password   = $setting['mail_smtppass'];            // GMAIL password
	}
	else {
		$mail->IsSendmail();
		$mail->Sendmail	= $setting['mail_sendmailpath'];
	}
	
	// Do Sent mail
	if (!$sender) $sender=$setting['mail_smtpuser'];
  	$mail->AddReplyTo($sender);
	
	$mail->From       = $sender;
	$mail->FromName   = "Cong thanh toan SohaPay";
	$mail->IsHTML(true); // send as HTML
	
	$mail->Subject    = $subject;
	$mail->MsgHTML($content);
	$mail->AddAddress($recipient,"");
	//$mail->AddBCC('khaitranquang@vccorp.vn');
	return $mail->Send();
} // END FUNCTION

function getSystemEmail($name, $aryReplace=null) {
	global $setting, $database;
	$sql = "SELECT * FROM system_emails WHERE system_email_name='".mysql_escape_string($name)."' ORDER BY system_email_id DESC";
	$aryEmail = $database->getRow($database->db_query($sql));
	
	if ($aryEmail['system_email_body'] != '') {
		$aryEmail['system_email_body'] = str_replace(array_keys($aryReplace), $aryReplace, $aryEmail['system_email_body']);
	}
	return $aryEmail;
}
?>