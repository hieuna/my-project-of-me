<?php
$page = "signup_verify";
include "header.php";
$page_title = "Xác thực tài khoản";

$task 			= PGRequest::getCmd ( 'task', 'step2' );
$verify 		= PGRequest::getCmd ( 'verify', '' );
$u 				= PGRequest::getInt ( 'u', 0 );
$signup_email 	= PGRequest::getVar ( 'signup_email', '' );
$step = 2;

// SET ERROR VARS
$is_error = 0;
$result = 0;

// SET RESEND FOR APPROPRIATE TASK
if ($task == "resend") {
	$resend = 1;
} else {
	$resend = 0;
}

// IF VERIFICATIONS ARE TURNED OFF, RETURN TO HOME
if ($setting ['setting_signup_verify'] == 0)
	cheader ( 'index.php' );

	// RESEND EMAIL
if ($task == "resend_do") {
	$resend = 1;
	$resend_email = PGRequest::getVar ( 'resend_email', '' );
	if (empty($resend_email)) {
		$is_error = 'Hãy nhập địa chỉ email của bạn.';
	}
	else {
		$user_query = $database->db_query ( "SELECT user_id, user_username, user_fullname, user_code, user_verified FROM users WHERE user_email='" . $database->getEscaped ( $resend_email ) . "'" );
		
		// VERIFY USER EXISTS
		if ($database->db_num_rows ( $user_query ) != 1) {
			$is_error = 'Không có tài khoản nào đã đăng ký với địa chỉ Email này.';
			$user_info ['user_code'] = "";
			$user_info ['user_email'] = "";
			$user_info ['user_newemail'] = "";
			$user_info ['user_verified'] = "";
		} else {
			$user_info = $database->db_fetch_assoc ( $user_query );
			$thisuser = new PGUser ();
			$thisuser->user_exists = 1;
			$thisuser->user_info ['user_id'] = $user_info ['user_id'];
			$thisuser->user_info ['user_username'] = $user_info ['user_username'];
			$thisuser->user_info ['user_fullname'] = $user_info ['user_fullname'];
			$thisuser->user_info ['user_email'] = $resend_email;
			$thisuser->user_info ['user_code'] = $user_info ['user_code'];
		}
		
		// VERIFY USER IS NOT ALREADY VERIFIED  
		if ($user_info ['user_verified'] == 1) {
			$is_error = 'Địa chỉ email này đã xác thực.';
		}
	}
	
	// NO ERROR, RESEND EMAIL
	if (! $is_error) {
		$verify_code = md5 ( $thisuser->user_info ['user_code'] );
		$time = time ();
		$verify_link = $uri->base () . "signup_verify.php?u={$thisuser->user_info['user_id']}&verify={$verify_code}&d={$time}";
		
		$aryReplace ['[link]'] = $verify_link;
		$aryReplace ['[email]'] = $resend_email;
		$aryReplace ['[fullname]'] = $thisuser->user_info ['user_fullname'];
		$aryEmail = getSystemEmail ( 'verification', $aryReplace );
		send_email_system ( $resend_email, $sender = '', $aryEmail ['system_email_subject'], $aryEmail ['system_email_body'] );
		$result = 'Chúng tôi vừa gửi một Email chứa đường Link kích hoạt tài khoản tới địa chỉ ' . $resend_email . ' mà bạn đã đăng ký, vui lòng kiểm tra và Click vào đường Link đó để xác thực Email.';
	}
}

// CHECK VERIFICATION
elseif ($resend != 1 && $verify) {
	// VALIDATE USER ID
	$new_user = new PGUser ( Array ($u ) );
	if ($new_user->user_exists == 0) {
		$is_error = "Liên kết bạn vừa click không đúng hoặc đã hết hạn. <a href='signup_verify.php?task=resend'>Bấm vào đây</a> để chúng tôi gửi lại Email kích hoạt.";
	}
	
	// ENSURE NEW EMAIL NOT ALREADY TAKEN
	if ($database->db_num_rows ( $database->db_query ( "SELECT NULL FROM users WHERE user_email='{$new_user->user_info['user_email']}' AND user_id<>'{$new_user->user_info['user_id']}'" ) ) != 0) {
		$is_error = "Another user has already taken this email address.";
	}
	
	// CHECK VERIFICATION URL
	if (md5 ( $new_user->user_info ['user_code'] ) !== $verify) {
		$is_error = "Liên kết bạn vừa click không đúng hoặc đã hết hạn. <a href='signup_verify.php?task=resend'>Bấm vào đây</a> để chúng tôi gửi lại Email kích hoạt.";
	}
	
	// VERIFY EMAIL ADDRESS IF NO ERROR
	if (! $is_error) {
		$database->db_query ( "UPDATE users SET user_verified='1' WHERE user_id='{$new_user->user_info['user_id']}'" );
		
		$step = 3;
		// IF USER JUST SIGNED UP
		if (! $new_user->user_info ['user_verified']) {
			// SEND WELCOME EMAIL
		//send_systememail ( 'welcome', $new_user->user_info ['user_newemail'], Array ($new_user->user_displayname, $new_user->user_info ['user_newemail'], '', "<a href=\"" . $url->url_base . "login.php\">" . $url->url_base . "login.php</a>" ) );
		}
	}
}

// ASSIGN VARIABLES AND INCLUDE FOOTER
$smarty->assign ( 'is_error', $is_error );
$smarty->assign ( 'resend', $resend );
$smarty->assign ( 'result', $result );
$smarty->assign ( 'verify', $verify );
$smarty->assign ( 'signup_email', $signup_email );
$smarty->assign ( 'step', $step );
$smarty->assign ( 'task', $task );
include "footer.php";
?>