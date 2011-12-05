<?php
$page = "user_info";

include "header.php";

if (!$user->user_info) {
	$page = "error";
  	$smarty->assign('error_header', 'Thông báo lỗi');
  	$smarty->assign('error_message', 'Mời bạn liên hệ với Quản trị viên để được trợ giúp.');
  	include "footer.php";
}
$task = PGRequest::getCmd ( 'task', 'view' );

$user->user_info['user_signupdate_format'] = date('H:m:i d/m/Y', $user->user_info['user_signupdate']);

if ($task=='view'){
	$page_title = "Thông tin tải khoản";
	
	$update = PGRequest::getCmd ( 'update', '' );
	if ($update=='editUserInfo'){
		$page_title = "Cập nhật tài khoản";
		
		$user_fullname = PGRequest::getVar('fullname', '', 'POST');
		$user_mobile = PGRequest::getCmd('mobile', '', 'POST');
		$user_address = PGRequest::getVar('address', '', 'POST');
		
		$input['user_fullname'] 	= $user_fullname;
		$input['user_mobile'] 		= $user_mobile;
		$input['user_address'] 		= $user_address;
		
		if ($user_fullname == ''){
			$strError = "Không thành công ! Vui lòng không để trống các mục chủ tài khoản !";
			$focus = 1;
		}
		else if ($user_mobile == ''){
			$strError = "Không thành công ! Vui lòng không để trống các mục số điện thoại !";
			$focus = 2;
		}
		else if ($user_address == ''){
			$strError = "Không thành công ! Vui lòng không để trống các mục địa chỉ nhận hàng !";
			$focus = 3;
		}
		else if (strlen($user_mobile)<10 || strlen($user_mobile)>11){
			$strError = 'Không thành công ! Độ dài của trường số điện thoại di động phải là 10 hoặc 11 số.';
			$focus = 2;
		}
		else{
			if (!$database->update("users", $input, "user_id=".$user->user_info['user_id'])) {
		    	$strError = "Lỗi hệ thống";
		    }else{
		    	$strError = "Cập nhật tài khoản thành công";
		    	header("Refresh: 0.3; url=user_info.php");
		    }
		}
	    
	    $smarty->assign ( 'strError', $strError );
	    $smarty->assign ( 'focus', $focus );
	}
}
elseif ($task=='changePass'){
	$page_title = "Thay đổi mật khẩu";
	$userId = PGRequest::getInt('userId', 0, 'POST');
	
	if ($userId == $user->user_info['user_id']) {
		$old = PGRequest::getVar('user_password_old', '', 'POST');
		$new = PGRequest::getVar('user_password_new', '', 'POST');
		$conf = PGRequest::getVar('user_password_conf', '', 'POST');
		// CHECK PASSWORDS
	    if ($new || $conf) {
        	if (!$old) {
		      	$strError = 'Hãy vào mật khẩu cũ.';
		    }
		    else if ($user->user_password_crypt($old) != $user->user_info['user_password']) {
		       	$strError = 'Mật khẩu cũ không đúng.';
		    }
		    else if (strlen($new) < 6) {
		        $strError = 'Mật khẩu phải tối thiểu 6 ký tự.';
		    }
		    else if ($new != $conf) {
		        $strError = 'Mật khẩu xác nhận không đúng.';
		    }
		    else if ( mb_detect_encoding($new) == 'UTF-8' || mb_detect_encoding($conf) == 'UTF-8'){
		    	$strError = 'Mật khẩu mới không được gõ tiếng Việt có dấu.';
		    }
		    if (!$strError) {
				$input['user_password'] = $user->user_password_crypt($new);
				$input['user_code'] = $user->user_salt;
				if (!$database->update("users", $input, "user_id=".$user->user_info['user_id'])) {
		    		$strError = "Lỗi hệ thống";
		    	}
		    	else {
		    		cheader($uri->base().'login.php');
		    	}
			}
    	}
	}
	$smarty->assign ( 'strError', $strError );
	$smarty->assign ( 'userId', $user->user_info['user_id'] );
}

// ASSIGN VARIABLES AND INCLUDE FOOTER
$smarty->assign ( 'email', $email );
$smarty->assign ( 'task', $task );
$save = $smarty->fetch('user_info_save.tpl');
PGTheme::set_page_title_right($save);
      
include "footer.php";
?>