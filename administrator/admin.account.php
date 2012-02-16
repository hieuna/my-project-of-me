<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.account";
$page_title = "Thông tin tài khoản";

$task = PGRequest::getCmd('task', 'view');
if ($task=='cancel') $task='view';

switch ($task) {
	case "view":
	case "save":
		
		$errFlag = 0;
		$query = "SELECT * FROM ".TBL_ADMIN." WHERE admin_id=".$_SESSION['admin_id'];
		$aryAdmin = $database->getRow($database->db_query($query));
		
		// DANH SACH QUYEN ADMIN
		$objAcl = new PGAcl();
		$arrGroup = $objAcl->apl;
		$arrPermiss = $objAcl->atl;
		
		$aryAdmin['admin_registerDate'] = $datetime->datetimeDisplay($aryAdmin['admin_registerDate']);
		$aryAdmin['admin_lastvisitDate']	= $datetime->datetimeDisplay($aryAdmin['admin_lastvisitDate']);
		$aryAdmin['admin_group']	= $arrGroup[$aryAdmin['admin_group']];
		if ($aryAdmin['admin_access']) {
			foreach ($arrPermiss as $key=>$perm) {
				$aryAdmin['admin_access'] = str_replace((string)$key, $perm, $aryAdmin['admin_access']);
			}
		}
		
		var_dump($admin);
		$adminId = PGRequest::getInt('adminId', 0, 'POST');
		if ($adminId) {
			$aryInput['admin_name'] = PGRequest::getVar('admin_name', '', 'POST');
			$aryInput['admin_email'] = PGRequest::getVar('admin_email', '', 'POST');
			$aryInput['admin_password_old'] = PGRequest::getVar('admin_password_old', '', 'POST');
			$aryInput['admin_password_new'] = PGRequest::getVar('admin_password_new', '', 'POST');
			$aryInput['admin_password_conf'] = PGRequest::getVar('admin_password_conf', '', 'POST');
			$aryInput['admin_group'] = PGRequest::getVar('admin_group', '', 'POST');
			$aryInput['admin_username'] = PGRequest::getVar('admin_username', '', 'POST');
			$aryInput['admin_registerDate'] = PGRequest::getVar('admin_registerDate', '', 'POST');
			$aryInput['admin_lastvisitDate'] = PGRequest::getVar('admin_lastvisitDate', '', 'POST');

			//THUC HIEN CHECK THONG TIN INPUT
			$admin->check_account_input($aryInput);
			
			if (!$admin->is_error) {
				$name = $database->db_real_escape_string($aryInput['admin_name']);
				$email = $database->db_real_escape_string($aryInput['admin_email']);
				$password = $aryInput['admin_password_new'];
				
		    	if (!$admin->admin_edit($username, $password, $name, $email)) {
		    		$errFlag = 1;
		    		$errorTxt = "Lỗi hệ thống !";
		    	}
		    	else {
		    		$errorTxt = "Sửa thành công. Bạn cần đăng nhập lại để cập nhật được thông tin của mình";
		    	}
		  	}
		  	else {
		    	$errFlag = 1;
		  		$errorTxt = (is_array($admin->is_error))?join("<br>", $admin->is_error):"";
		  	}
		}
		if ($errFlag) $aryUser = $aryInput;
		else $aryUser = $aryAdmin;
		
		$smarty->assign('users', $aryUser);
		$smarty->assign('adminId', $admin_id);
		break;		
}

$smarty->assign('page', $page);
$smarty->assign('page_title', $page_title);
$smarty->assign('errorTxt', $errorTxt);
$smarty->assign('errFlag', $errFlag);
$smarty->assign('sites', $sites);
$smarty->assign('task', $task);
$smarty->display($template_root.'administrator/admin.account.tpl');

$toolbar = createToolbar('save');

include "admin.footer.php";
?>