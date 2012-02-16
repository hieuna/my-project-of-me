<?php
require_once 'config/config.php';
require_once 'includes/phpmailer/class.phpmailer.php';

function send_email($recipient, $sender='', $subject, $message, $order_id)
{
	// DECODE SUBJECT AND EMAIL FOR SENDING
	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
	$message = htmlspecialchars_decode($message, ENT_QUOTES);

	// ENCODE SUBJECT FOR UTF8
	$subject="=?UTF-8?B?".base64_encode($subject)."?=";

	// REPLACE CARRIAGE RETURNS WITH BREAKS
	$message = str_replace("\n", "", $message);
	
	$message = '
	<div style="width: 723px; background-color: #FFFFFF; border: 1px solid #CDCDCD; position: relative; padding: 10px; font-family: Arial, Tahoma, Verdana; font-size: 12px; color: #999; display: inline-block; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px;">
	    <div style="width: 100%; height: 84px; border-bottom: 1px dotted #999999;"> <a href="'.$http_root.'" style="width: 200px; height: 53px; display: block; float: left;"><img src="'.$http_root.'images/email/logo.png" alt="Logo SohaPay" width="200" height="53" border="0" /></a>
	        <div style="float: right; font-size: 12px; color: #999; text-align:right">
	            <h2 style="color: #FE890A; font-size: 22px; margin: 0;">EMAIL THÔNG BÁO</h2>
	        </div>
	        <div style="clear:both"></div>
	        <div style="width:100%; height: 23px; float: left;">
	            <div style="float: left; line-height: 35px;">'.date('d/m/Y').'</div>
	            <ul style="float: right; margin: 0; padding: 0;">
	                <li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_soha.jpg" style="float:left; border:none;" />Sohapay.com</a></li>
	                <li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'info/contact.html" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none;" />Liên hệ</a></li>
	                <li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="http://www.facebook.com/pages/SohaPay/301383356548312" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_face.jpg" style="float:left; border:none;" />Facebook</a></li>
	            </ul>
	        </div>
	        <div style="clear:both"></div>
	    </div>
	    <div style="clear:both"></div>
	    <div id="maincontent">'.$message.'</div>
	    <div style="text-align: center; color: #FE890A; font-style: italic; font-size: 15px; width: 100%; float: left; padding-top: 10px; font-weight: bold; line-height: 25px;">Thanh toán an toàn và dễ dàng với SohaPay</div>
	</div>
	<div style="width: 723px; padding: 10px 0; text-align: center; color: #333; font-weight: normal; font-size: 12px; font-family: Arial, Tahoma, Verdana;">
	    <ul style="margin: 0; padding: 0; margin-left: 40px;">
	        <li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Điện thoại: 04.36321221 - máy lẻ: 123 hoặc 851</li>
	        <li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_mail.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Email: <a style="color: #FE890A; text-decoration: none;" href="mailto:hotro@sohapay.com">hotro@sohapay.com</a></li>
	        <li style="list-style: none; float: left; padding-left: 5px;"><img src="'.$http_root.'images/email/li_yahoo.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" /><a style="color: #FE890A; text-decoration: none;" href="ymsgr:sendim?sohapay">YM: sohapay</a></li>
	    </ul>
	</div>
	';
	
	//@date_default_timezone_set('Bangkok/Hanoi/Jakarta');
	
	$sendmail = false;
	$mail             = new PHPMailer();
	$mail->CharSet	  = "utf-8";
	
	// Do Sent mail
	if (!$sender) $sender=$setting['mail_smtpuser'];
  	$mail->AddReplyTo($sender);
	
	$mail->From       = $sender;
	$mail->FromName   = NAME_EMAIL_SYSTEM;
	$mail->IsHTML(true); // send as HTML
	
	$mail->Subject    = $subject;
	$mail->MsgHTML($message);
	$mail->AddAddress($recipient,"");
	$mail->AddBCC(EMAIL_SYSTEM);
	$mail->Send();
} // END FUNCTION


function send_email_system($recipient, $sender='', $subject, $message)
{
	// DECODE SUBJECT AND EMAIL FOR SENDING
	$subject = htmlspecialchars_decode($subject, ENT_QUOTES);
	$message = htmlspecialchars_decode($message, ENT_QUOTES);

	// ENCODE SUBJECT FOR UTF8
	$subject="=?UTF-8?B?".base64_encode($subject)."?=";

	// REPLACE CARRIAGE RETURNS WITH BREAKS
	$message = str_replace("\n", "", $message);
	
	$message = '
	<div style="width: 723px; background-color: #FFFFFF; border: 1px solid #CDCDCD; position: relative; padding: 10px; font-family: Arial, Tahoma, Verdana; font-size: 12px; color: #999; display: inline-block; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px;">
	    <div style="width: 100%; height: 84px; border-bottom: 1px dotted #999999;"> <a href="'.$http_root.'" style="width: 200px; height: 53px; display: block; float: left;"><img src="'.$http_root.'images/email/logo.png" alt="Logo SohaPay" width="200" height="53" border="0" /></a>
	        <div style="float: right; font-size: 12px; color: #999; text-align:right">
	            <h2 style="color: #FE890A; font-size: 22px; margin: 0;">EMAIL THÔNG BÁO</h2>
	        </div>
	        <div style="clear:both"></div>
	        <div style="width:100%; height: 23px; float: left;">
	            <div style="float: left; line-height: 35px;">'.date('d/m/Y').'</div>
	            <ul style="float: right; margin: 0; padding: 0;">
	                <li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_soha.jpg" style="float:left; border:none;" />Sohapay.com</a></li>
	                <li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'info/contact.html" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none;" />Liên hệ</a></li>
	                <li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="http://www.facebook.com/pages/SohaPay/301383356548312" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_face.jpg" style="float:left; border:none;" />Facebook</a></li>
	            </ul>
	        </div>
	        <div style="clear:both"></div>
	    </div>
	    <div style="clear:both"></div>
	    <div id="maincontent">'.$message.'</div>
	    <div style="text-align: center; color: #FE890A; font-style: italic; font-size: 15px; width: 100%; float: left; padding-top: 10px; font-weight: bold; line-height: 25px;">Thanh toán an toàn và dễ dàng với SohaPay</div>
	</div>
	<div style="width: 723px; padding: 10px 0; text-align: center; color: #333; font-weight: normal; font-size: 12px; font-family: Arial, Tahoma, Verdana;">
	    <ul style="margin: 0; padding: 0; margin-left: 40px;">
	        <li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Điện thoại: 04.36321221 - máy lẻ: 123 hoặc 851</li>
	        <li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_mail.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Email: <a style="color: #FE890A; text-decoration: none;" href="mailto:hotro@sohapay.com">hotro@sohapay.com</a></li>
	        <li style="list-style: none; float: left; padding-left: 5px;"><img src="'.$http_root.'images/email/li_yahoo.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" /><a style="color: #FE890A; text-decoration: none;" href="ymsgr:sendim?sohapay">YM: sohapay</a></li>
	    </ul>
	</div>
	';

	$sendmail = false;
	//echo $setting['mail_type'];
	//print_r($setting);
	$mail             = new PHPMailer();
	$mail->CharSet	  = "utf-8";
	
	// Do Sent mail
	if (!$sender) $sender=$setting['mail_smtpuser'];
  	$mail->AddReplyTo($sender);
	
	$mail->From       = $sender;
	$mail->FromName   = NAME_EMAIL_SYSTEM;
	$mail->IsHTML(true); // send as HTML
	
	$mail->Subject    = $subject;
	$mail->MsgHTML($message);
	$mail->AddAddress($recipient,"");
	$mail->AddBCC(EMAIL_SYSTEM);
	return $mail->Send();
} // END FUNCTION

function setSubscribeBody($subscribe = array(), $flag = false) {
	if ($flag) {
		$content = '
			<div style="width: 723px; background-color: #FFFFFF; border: 1px solid #CDCDCD; position: relative; padding: 10px; font-family: Arial, Tahoma, Verdana; font-size: 12px; color: #999; display: inline-block; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px;">	
				<div style="width: 100%; height: 84px; border-bottom: 1px dotted #999999;">
					<a href="'.$http_root.'" style="width: 200px; height: 53px; display: block; float: left;"><img src="'.$http_root.'images/email/logo.png" alt="Logo SohaPay" width="200" height="53" border="0" /></a>
					<div style="float: right; font-size: 12px; color: #999; text-align:right">
						<h2 style="color: #FE890A; font-size: 22px; margin: 0;">THƯ ĐIỆN TỬ</h2>
						<a href="'.$http_root.'subscribe.php?task=unsub&email=@subcribe_email&id=@subcribe_id" target="_blank" style="color: #999; text-decoration:none;">Huỷ nhận email khuyễn mãi từ sohapay.com</a>
					</div>
					<div style="clear:both"></div>
					<div style="width:100%; height: 23px; float: left;">
						<div style="float: left; line-height: 35px;">[product_date]</div>
						<ul style="float: right; margin: 0; padding: 0;">
							<li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_soha.jpg" style="float:left; border:none;" />Sohapay.com</a></li>
							<li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'info/contact.html" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none;" />Liên hệ</a></li>
							<li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="http://www.facebook.com/pages/SohaPay/301383356548312" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_face.jpg" style="float:left; border:none;" />Facebook</a></li>
						</ul>
					</div>
				</div>
				<div style="font-size: 22px; line-height: 30px; font-weight: bold; color: #333; padding-top: 3px;">
				<a style="color:#333; text-decoration: none;" target="_blank" href="[product_link]">[product_title]</a>
				</div>
				<div style="clear:both"></div>
				<div style="width: 280px; float: left; display: block;">
					<div style="background: #ECF0F4; position: relative; color: #000; line-height: 20px; padding:5px 0; -moz-border-radius:8px; -webkit-border-radius:8px; border-radius:8px;">				
						<div style="padding: 10px; margin: 0;line-height:150%;">[product_description]</b></div>
						<p style="padding: 10px; margin: 0;" align="center">
							<div style="width: 140px; height: 47px; background: #01498B; text-align: center; color: #fff; font-weight: bold; cursor: pointer; position: relative; display: block; line-height: 47px; margin-left: 66px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;">						
								<a target="_blank" style="color: #fff; text-decoration: none;" href="[product_link]">Xem chi tiết</a>
							</div>
						</p>
					</div>
					<div style="border: 1px solid #CCCCCC; position: relative; margin-top: 10px; text-align: center; color: #CC3300; font-weight: bold; font-size: 16px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;">				
						<p style="margin: 5px 0;">Giảm <br /> 
						<b style="font-size: 30px;">[product_discount]%</b></p>
					</div>
				</div>
				<div style="width: 15px; float:left; margin-top:20px;"><img src="'.$http_root.'images/email/rowi.jpg" border="0" /></div>
				<div style="width: 408px; float: right; display: block; margin-right: 10px;">
					<div style="padding: 3px; text-align: center; border: 1px solid #A6C0D8;">
						<a href="[product_link]"><img src="[product_image]" width="398" height="266" alt="Ảnh sản phẩm" style="margin: 0 auto; border: none;" /></a>			</div>
					<div style="clear:both"></div>
					<div style="width: 100%; border-bottom: 1px dotted #ccc; float: left;">
						<div style="color: #CC3300; float: left;">Giá bán: <b style="font-size: 26px;">[product_price] đ</b></div>
						<div style="color: #01498B; float: right;">Giá gốc: <b style="font-size: 26px;">[product_cost] đ</b></div>
					</div>
				</div>
				<div style="text-align: center; color: #FE890A; font-style: italic; font-size: 15px; width: 100%; float: left; padding-top: 10px; font-weight: bold; line-height: 25px;">Thanh toán an toàn và dễ dàng với SohaPay</div>
			</div>
			<div style="width: 723px; padding: 10px 0; text-align: center; color: #333; font-weight: normal; font-size: 12px; font-family: Arial, Tahoma, Verdana;">
				<ul style="margin: 0; padding: 0; margin-left: 40px;">
					<li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Điện thoại: 04.36321221 - máy lẻ: 123 hoặc 851</li>
					<li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_mail.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Email: <a style="color: #FE890A; text-decoration: none;" href="mailto:hotro@sohapay.com">hotro@sohapay.com</a></li>
					<li style="list-style: none; float: left; padding-left: 5px;"><img src="'.$http_root.'images/email/li_yahoo.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" /><a style="color: #FE890A; text-decoration: none;" href="ymsgr:sendim?sohapay">YM: sohapay</a></li>
				</ul>
			</div>
		';
		return $content;
	}
	$content = '
		<div style="width: 723px; background-color: #FFFFFF; border: 1px solid #CDCDCD; position: relative; padding: 10px; font-family: Arial, Tahoma, Verdana; font-size: 12px; color: #999; display: inline-block; border-radius:5px; -webkit-border-radius:5px; -moz-border-radius:5px;">	
			<div style="width: 100%; height: 84px; border-bottom: 1px dotted #999999;">
				<a href="'.$http_root.'" style="width: 200px; height: 53px; display: block; float: left;"><img src="'.$http_root.'images/email/logo.png" alt="Logo SohaPay" width="200" height="53" border="0" /></a>
				<div style="float: right; font-size: 12px; color: #999; text-align:right">
					<h2 style="color: #FE890A; font-size: 22px; margin: 0;">THƯ ĐIỆN TỬ</h2>
					<a href="'.$http_root.'subscribe.php?task=unsub&email=@subcribe_email&id=@subcribe_id" target="_blank" style="color: #999; text-decoration:none;">Huỷ nhận email khuyễn mãi từ sohapay.com</a>
				</div>
				<div style="clear:both"></div>
				<div style="width:100%; height: 23px; float: left;">
					<div style="float: left; line-height: 35px;">' . $subscribe['time'] .'</div>
					<ul style="float: right; margin: 0; padding: 0;">
						<li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_soha.jpg" style="float:left; border:none;" />Sohapay.com</a></li>
						<li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="'.$http_root.'info/contact.html" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none;" />Liên hệ</a></li>
						<li style="list-style: none; float: left; margin-right: 20px; padding: 10px 0;"><a href="http://www.facebook.com/pages/SohaPay/301383356548312" target="_blank" style="color: #FE890A; text-decoration: none; line-height: 20px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_face.jpg" style="float:left; border:none;" />Facebook</a></li>
					</ul>
				</div>
			</div>
			<div style="font-size: 22px; line-height: 30px; font-weight: bold; color: #333; padding-top: 3px;">
			<a style="color:#333; text-decoration: none;" target="_blank" href="' . $subscribe['link'] . '">' . $subscribe['title']. '</a>
			</div>
			<div style="clear:both"></div>
			<div style="width: 280px; float: left; display: block;">
				<div style="background: #ECF0F4; position: relative; color: #000; line-height: 20px; padding:5px 0; -moz-border-radius:8px; -webkit-border-radius:8px; border-radius:8px;">				
					<div style="padding: 10px; margin: 0;line-height:150%;">' . $subscribe['description'] . '</div>
					<p style="padding: 10px; margin: 0;" align="center">
						<div style="width: 140px; height: 47px; background: #01498B; text-align: center; color: #fff; font-weight: bold; cursor: pointer; position: relative; display: block; line-height: 47px; margin-left: 66px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;">						
							<a target="_blank" style="color: #fff; text-decoration: none;" href="'.$http_root.'info/san-pham-cong-nghe/42-dien-thoai-thoi-trang-qmobile-f363-2sim-2song.html">Xem chi tiết</a>
						</div>
					</p>
				</div>
				<div style="border: 1px solid #CCCCCC; position: relative; margin-top: 10px; text-align: center; color: #CC3300; font-weight: bold; font-size: 16px; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;">				
					<p style="margin: 5px 0;">Giảm <br /> 
					<b style="font-size: 30px;">' . $subscribe['discount'] .'%</b></p>
				</div>
			</div>
			<div style="width: 15px; float:left; margin-top:20px;"><img src="'.$http_root.'images/email/rowi.jpg" border="0" /></div>
			<div style="width: 408px; float: right; display: block; margin-right: 10px;">
				<div style="padding: 3px; text-align: center; border: 1px solid #A6C0D8;">
					<a href="' . $subscribe['link']  . '"><img src="' . $subscribe['image'] . '" width="398" height="266" alt="Ảnh sản phẩm" style="margin: 0 auto; border: none;" /></a>			</div>
				<div style="clear:both"></div>
				<div style="width: 100%; border-bottom: 1px dotted #ccc; float: left;">
					<div style="color: #CC3300; float: left;">Giá bán: <b style="font-size: 26px;">' .  $subscribe['price'] . ' đ</b></div>
					<div style="color: #01498B; float: right;">Giá gốc: <b style="font-size: 26px;">' .  $subscribe['cost'] . ' đ</b></div>
				</div>
			</div>
			<div style="text-align: center; color: #FE890A; font-style: italic; font-size: 15px; width: 100%; float: left; padding-top: 10px; font-weight: bold; line-height: 25px;">Thanh toán an toàn và dễ dàng với SohaPay</div>
		</div>
		<div style="width: 723px; padding: 10px 0; text-align: center; color: #333; font-weight: normal; font-size: 12px; font-family: Arial, Tahoma, Verdana;">
			<ul style="margin: 0; padding: 0; margin-left: 40px;">
				<li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_contact.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Điện thoại: 04.36321221 - máy lẻ: 123 hoặc 851</li>
				<li style="list-style: none; float: left; margin-right: 30px; padding-left: 5px;"><img src="'.$http_root.'images/email/li_mail.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" />Email: <a style="color: #FE890A; text-decoration: none;" href="mailto:hotro@sohapay.com">hotro@sohapay.com</a></li>
				<li style="list-style: none; float: left; padding-left: 5px;"><img src="'.$http_root.'images/email/li_yahoo.jpg" style="float:left; border:none; padding-right:3px; margin-top:-3px;" /><a style="color: #FE890A; text-decoration: none;" href="ymsgr:sendim?sohapay">YM: sohapay</a></li>
			</ul>
		</div>
	';
	return $content;
}
?>