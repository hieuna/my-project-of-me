<?php
$page = "admin_emails";
include "admin_header.php";

$task = PGRequest::getCmd('task', 'view');
if ($task=='cancel') $task='view';

$objAcl = new PGAcl();
if (!$objAcl->checkPermission($page, $task)) {
	$objAcl->showErrorPage($smarty);
}

$sites = get_list_sites();
require_once "include/functions_onepay.php";
switch ($task) {
	case "view":
		$page_title = "Danh sách các dạng email";
		
		$card_id = PGRequest::getFilter('orderserror_card_type', 'error_card_type', '', 'POST');

		// BUILD THE WHERE CLAUSE OF THE CONTENT RECORD QUERY
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		
		// LAY DANH SACH CHI TIET
		$query = "SELECT * FROM system_emails $where";
		$results = $database->db_query($query);
		
		while ($row = $database->db_fetch_assoc($results)){
			$aryEmail[] = $row;
		}
		
		$smarty->assign('aryEmail', $aryEmail);
		break;
		
	case "new":
		$page_title = "Thêm mới email";
		$emailType = $settingClass->getTypeEmail();

		$ajax = PGRequest::getInt('ajax', 0);
		if ($ajax) {
			$output = array();
			$output['intOK'] = 1;
			//GET DATA REQUEST
			$input['system_email_name'] = PGRequest::getVar('system_email_name', '', 'POST');
			$input['system_email_description'] = PGRequest::getVar('system_email_description', '', 'POST');
			$input['system_email_vars'] = PGRequest::getVar('system_email_vars', '', 'POST');
			$input['system_email_subject'] = PGRequest::getVar('system_email_subject', '', 'POST');
			$input['system_email_body'] = PGRequest::getVar('system_email_body', '', 'POST', NULL, 4);
			//$input['guide'] = PGRequest::getVar('error_guide', '', 'POST', NULL, 4);
			
			//THUC HIEN CHECK THONG TIN INPUT
			validate_emails($input, $errorValidate);
			if (count($errorValidate)) {
		    	$output['strError'] = (is_array($errorValidate)) ? join("<br>", $errorValidate) : "";
		  		$output['intOK'] = 0;
		  	}
		  	else {
		  		if (!($intOK = $database->insert("system_emails", $input))) {
		    		$output['strError'] = "Lỗi hệ thống";
		    		$output['intOK'] = 0;
		  		}
		  	}
		  	echo json_encode($output);
			exit();
		}
		$smarty->assign('emailType', $emailType);
		
		break;
	
	case "edit":
		$page_title = "Sửa thông tin email";

		$emailType = $settingClass->getTypeEmail();
		$emailId = PGRequest::getInt('id', 0);
		$ajax = PGRequest::getInt('ajax', 0);
		if ($ajax) {
			$output = array();
			$output['intOK'] = 1;
			//GET DATA REQUEST
			$input['system_email_name'] = PGRequest::getVar('system_email_name', '', 'POST');
			$input['system_email_description'] = PGRequest::getVar('system_email_description', '', 'POST');
			$input['system_email_vars'] = PGRequest::getVar('system_email_vars', '', 'POST');
			$input['system_email_subject'] = PGRequest::getVar('system_email_subject', '', 'POST');
			$input['system_email_body'] = PGRequest::getVar('system_email_body', '', 'POST', NULL, 4);
			//$input['guide'] = PGRequest::getVar('error_guide', '', 'POST', NULL, 4);
			
			//THUC HIEN CHECK THONG TIN INPUT
			validate_emails($input, $errorValidate);
			if (count($errorValidate)) {
		    	$output['strError'] = (is_array($errorValidate)) ? join("<br>", $errorValidate) : "";
		  		$output['intOK'] = 0;
		  	}
		  	else {
		  		if (!($intOK = $database->update("system_emails", $input, "system_email_id={$emailId}"))) {
		    		$output['strError'] = "Lỗi hệ thống";
		    		$output['intOK'] = 0;
		  		}
		  	}
		  	echo json_encode($output);
			exit();
		}
		
		$query = "SELECT * FROM system_emails WHERE system_email_id={$emailId} LIMIT 1";
		$aryEmail = $database->getRow($database->db_query($query));
		if (!$aryEmail) cheader($uri->base().'admin_emails.php');

		$smarty->assign('aryEmail', $aryEmail);
		$smarty->assign('emailType', $emailType);
	
		break;
		
	case "delete":
		$cid = PGRequest::getVar('cid', array(), 'post', 'array');
		if (count($cid)<0) cheader($uri->base().'admin_home.php');
		$results = $database->db_query("DELETE FROM system_emails WHERE system_email_id IN(".join(",", $cid).")");
		
		cheader($uri->base().'admin_emails.php');
	break;
}

//DUMMY DATA

$smarty->assign('task', $task);
$smarty->assign('settingPayment', $settingPayment);

$toolbar = ($task=='view')?createToolbar('new', 'delete'):createToolbar('save', 'cancel');

include "admin_footer.php";

function validate_emails($input, &$aryError=array(), $isEdit=false) {  
	global $database;
			
	//CHECK VARS
	/*if (!$isEdit && $input['system_email_vars'] == '') {
		$aryError[] = 'Từ khóa không được để trống';
	}*/
	
	//CHECK SUBJECT
	if ($input['system_email_subject'] == '') {
		$aryError[] = 'Tiêu đề không được để trống';
	}
	//CHECK BODY
	if ($input['system_email_body'] == '') {
		$aryError[] = 'Nội dung không được trống';
	}
	
	return;
}
?>