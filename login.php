<?php
$page = "login";
$page_title = "Đăng nhập tài khoản";
include "header.php";

// USER IS LOGGED IN, FORWARD TO USER HOME
if ($user->user_exists) cheader('index.php');

$task = PGRequest::getCmd ( 'task', '' );

// CHECK FOR REDIRECTION URL
$return_url = urldecode ( PGRequest::getVar ( 'return_url', '' ) );
$return_url = str_replace ( "&amp;", "&", $return_url );
if ($return_url == "") $return_url = "user_transaction.php?task=dashboard";

// INITIALIZE ERROR VARS
$is_error = 0;

if (! isset ( $_SESSION ['failed_login_count'] ))
	$failed_login_count = $_SESSION ['failed_login_count'] = 0;
else
	$failed_login_count = $_SESSION ['failed_login_count'];

// GET POST
$email = PGRequest::getVar ( 'email', '', 'POST' );
$password = PGRequest::getVar ( 'password', '', 'POST' );
$persistent = PGRequest::getInt ( 'persistent', 0, 'POST' );
$forgotpass_email = PGRequest::getVar ( 'forgotpass_email', '', 'POST' );

// TRY TO LOSTPASSWORD
if ($task == "lostPassword") {
	include "include/class_validate.php";
	$page_title = "Quên mật khẩu";
	$chkEmail->is_error_email = FALSE;
	
	if ($forgotpass_email == ''){
		$chkEmail->is_error_email = FALSE;
	}else{
		$chkEmail = new Validation();
		$check = $chkEmail->isEmail($forgotpass_email);
		if ($check == 0){
			$chkEmail->is_error_email = "Email không hợp lệ !";
		}else{
			$sql = "SELECT user_id, user_email FROM users WHERE user_email='".$forgotpass_email."'";
			$result = $database->db_fetch_assoc($database->db_query(sprintf($sql)));
			//echo $result['user_id'];
			//die;
			if ($result['user_id']>0){
				$newpass = randomcode();	
				$user = new PGUser(array($result["user_id"], '', ''));
				
				$title_email	= 'Gửi mật khẩu mới !';
				$content_email = 'Yêu cầu gửi mật khẩu mới của bạn đã thành công ! Mật khẩu mới để bạn truy cập hệ thống <a href="'.PG_URL_ROOT.'login.php">đăng nhập</a> SohaPay.com là:'.$newpass;
				
				if(send_email_system($result['user_email'], $sender='', $title_email, $content_email)){
					$input['user_password'] = $user->user_password_crypt($newpass);
					$input['user_code'] = $user->user_salt;
					if (!$database->update("users", $input, "user_id=".$result['user_id'])) {
			    		$chkEmail->is_error_email = "Lỗi hệ thống";
			    	}else{
			    		$chkEmail->is_error_email = "Chúng tôi đã gửi mật khẩu mới của bạn đến email ".$result['user_email'].", vui lòng <a href='".PG_URL_ROOT."login.php'>đăng nhập</a> hệ thống SohaPay.com bằng mật khẩu mới này !";
			    	}
				}else{
					$chkEmail->is_error_email = "Có lỗi xảy ra trong quá trình yêu cầu gửi mật khẩu mới, vui lòng thử lại !";
				}
			}else{
				$chkEmail->is_error_email = "Email bạn nhập không tồn tại !";
			}	
		}
		
		$is_error_email = $chkEmail->is_error_email;
	}
}
// TRY TO LOGIN
if ($task == "dologin") {
	$user->is_error = FALSE;
	
	if (! empty ( $setting ['setting_login_code'] ) || (! empty ( $setting ['setting_login_code_failedcount'] ) && $_SESSION ['failed_login_count'] >= $setting ['setting_login_code_failedcount'])) {
		$code = $_SESSION ['code'];
		if ($code == "") {
			$code = randomcode (4);
		}
		$login_secure = $_POST ['login_secure'];
		
		if ($login_secure != $code)
			$user->is_error = "Mã xác nhận không đúng";
	}
	if (! $user->is_error)
		$user->user_login ( array($email), $password, $_POST ['javascript_disabled'], $persistent );
	
	if ($user->user_exists && !$user->user_info['user_verified'] && $setting['setting_signup_verify']){
		cheader ( 'signup_verify.php?signup_email='.$user->user_info['user_email'] );
	}
		
	// IF USER IS LOGGED IN SUCCESSFULLY, FORWARD THEM TO SPECIFIED URL
	if (! $user->is_error) {
		$failed_login_count = $_SESSION ['failed_login_count'] = 0;
		cheader ( $return_url );
	}

	// IF THERE WAS AN ERROR, SET ERROR MESSAGE
	else {
		$failed_login_count = ++ $_SESSION ['failed_login_count'];
		$is_error = $user->is_error;
		$user = new PGuser ();
	}
}

// ASSIGN VARIABLES AND INCLUDE FOOTER
$smarty->assign ( 'email', $email );
$smarty->assign ( 'password', $password );
$smarty->assign ( 'is_error', $is_error );
$smarty->assign ( 'return_url', $return_url );
$smarty->assign ( 'failed_login_count', $failed_login_count );

$smarty->assign ( 'is_error_email', $is_error_email );

$smarty->assign ( 'task', $task );

include "footer.php";
?>