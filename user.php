<?php
$page = "login";
include "header.php";

$task = PGRequest::getCmd('task', '');

// INITIALIZE ERROR VARS
$is_error = 0;
$email = PGRequest::getVar('forgotpass_email', '', 'POST');
$user_id = PGRequest::getInt('user_id', 0, 'GET');
$validate_key = PGRequest::getVar('validate_key', '', 'GET');
// TRY TO LOGIN
switch ($task) {
	case 'forgotpass':
		$user->is_error = FALSE;
		//check email
		$sql = "SELECT * FROM users WHERE user_email='".$database->getEscaped($email)."' WHERE user_enabled=1 LIMIT 1";
		$query = $database->db_query($sql);
		if($database->db_num_rows($query) != 1) {
			$is_error = "Email nhập chưa đúng hoặc chưa được kích hoạt.";
		}
		else {
			//send mail to user
			$aryUser = $database->getRow($query);
			$key = md5($aryUser['user_id']."_".$aryUser['user_email'].$aryUser['user_password']);
			$aryReplace['[user_link]'] = PG_URL_ROOT."user.php?task=changePass&user_id={$aryUser['user_id']}&validate_key={$key}";
			$aryReplace['[user_email]'] = $aryUser['user_email'];
			$aryReplace['[user_name]'] = $aryUser['user_fullname'];
			$aryEmail = getSystemEmail('ForgotPass', $aryReplace);
			send_email_system($aryUser['user_email'], $sender='', $aryEmail['system_email_subject'], $aryEmail['system_email_body']);
			$is_error = "Một Email đã được gửi đến {$aryUser['user_email']}. Vui lòng kiểm tra email và làm theo hướng dẫn.";
		}
	break;
	
	case 'changePass':
		$sql = "SELECT user_email, user_password FROM users WHERE user_id={$user_id} AND user_enabled=1 LIMIT 1";
		$row = $database->getRow($database->db_query($sql));
		if (count($row) > 0) {
			$key = md5($user_id."_".$row['user_email'].$row['user_password']);
		}
		
		if ($key != $validate_key) {
			$message = "Lỗi bảo mật. Kiểm tra lại url";
		} else {
			$rdString = createRandString(6);
			$input['user_password'] = $user->user_password_crypt($rdString);
			$database->update("users", $input, "user_id={$user_id}");
			
			$aryReplace['[user_password]'] = $rdString;
			$aryReplace['[user_name]'] = $aryUser['user_fullname'];
			$aryEmail = getSystemEmail('ForgotPass', $aryReplace);
			send_email_system($aryUser['user_email'], $sender='', $aryEmail['system_email_subject'], $aryEmail['system_email_body']);
			$message = "Mật khẩu của bạn đã được reset. Hãy check mail để xem thông tin mật khẩu mới";
		}
	break;
	
	case 'active':
		$sql = "SELECT user_email, user_password FROM users WHERE user_id={$user_id} LIMIT 1";
		$row = $database->getRow($database->db_query($sql));
		if (count($row) > 0) {
			$key = md5($row['user_email'].$row['user_password']);
		}
		
		if ($key != $validate_key) {
			$message = "Lỗi bảo mật. Kiểm tra lại url";
		} else {
			$input['user_enabled'] = 1;
			$input['user_verified'] = 1;
			$database->update("users", $input, "user_id={$user_id}");
			$message = "Kích hoạt tài khoản thành công.";
		}
	break;
}


// ASSIGN VARIABLES AND INCLUDE FOOTER
$smarty->assign('forgotpass_email', $email);
$smarty->assign('message', $message);
$smarty->assign('is_error_email', $is_error);
$smarty->assign('task', $task);
$smarty->assign('return_url', $return_url);
$smarty->assign('failed_login_count', $failed_login_count);

include "footer.php";
?>