<?php
$page = "admin_errors";
include "admin_header.php";

$task = PGRequest::getCmd('task', 'view');
if ($task=='cancel') $task='view';

$objAcl = new PGAcl();
if (!$objAcl->checkPermission($page, $task)) {
	$objAcl->showErrorPage($smarty);
}

$sites = get_list_sites();

$aryCard = $settingClass->getDomesticBank() + $settingClass->getInternationalCard() + $settingClass->getMobileCard();
		
switch ($task) {
	case "view":
		$page_title = "Thông báo lỗi";
		
		$card_id = PGRequest::getFilter('orderserror_card_type', 'error_card_type', '', 'POST');

		if ($card_id){
			$where[] = "error_card_type='".$card_id."'";
		}
		// BUILD THE WHERE CLAUSE OF THE CONTENT RECORD QUERY
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		
		// LAY DANH SACH CHI TIET
		$query = "SELECT * FROM errors $where";
		$results = $database->db_query($query);
		
		while ($row = $database->db_fetch_assoc($results)){
			$row['card_type_name'] = $aryCard[$row['error_card_type']];
			$row['error_message'] = post_db_parse_html($row['error_message']);
			$row['error_guide'] = post_db_parse_html($row['error_guide']);
			$aryError[] = $row;
		}
		
		$smarty->assign('aryError', $aryError);
		$smarty->assign('aryCard', $aryCard);
		$smarty->assign('card_id', $card_id);
		break;
		
	case "new":
		$page_title = "Thêm mới thông tin lỗi";

		$errorId = PGRequest::getInt('id', '');
		$code = PGRequest::getCmd('code', '');

		$ajax = PGRequest::getInt('ajax', 0);
		
		if ($ajax) {
			$aryOutput = array();
			$aryOutput['intOK'] = 1;
			//GET DATA REQUEST
			$input['error_id'] = $errorId;
			$input['response_code'] = $code;
			$input['card_type'] = PGRequest::getCmd('typecard', '', 'POST');
			$input['title'] = PGRequest::getVar('error_title', '', 'POST');
			$input['message'] = PGRequest::getVar('error_message', '', 'POST', NULL, 4);
			$input['guide'] = PGRequest::getVar('error_guide', '', 'POST', NULL, 4);
			
			//THUC HIEN CHECK THONG TIN INPUT
			validate_errors($input, $errorValidate);
			if (count($errorValidate)) {
		    	$aryOutput['strError'] = (is_array($errorValidate)) ? join("<br>", $errorValidate) : "";
		  		$aryOutput['intOK'] = 0;
		  	}
		  	else {
		  		$sql = "INSERT errors(
		  						error_card_type, 
		  						error_response_code, 
		  						error_title, 
		  						error_message, 
		  						error_guide)
		  				VALUES (
		  						'".$database->getEscaped($input['card_type'])."', 
		  						'".$database->getEscaped($input['response_code'])."', 
		  						'".$database->getEscaped($input['title'])."', 
		  						'".$database->getEscaped($input['message'])."', 
		  						'".$database->getEscaped($input['guide'])."'
		  						)";
		  		
		  		if (!$database->db_query($sql)) {
		    		$aryOutput['strError'] = "Lỗi hệ thống";
		    		$aryOutput['intOK'] = 0;
		  		}
		  	}
		  	echo json_encode($aryOutput);
			exit();
		}
		$smarty->assign('cardType', $cardType);
		$smarty->assign('aryCard', $aryCard);
		
		break;
	
	case "edit":
		$page_title = "Sửa thông tin lỗi";

		$errorId = PGRequest::getInt('id', '');
		$code = PGRequest::getCmd('code', '');

		$ajax = PGRequest::getInt('ajax', 0);
		
		if ($ajax) {
			$aryOutput = array();
			$aryOutput['intOK'] = 1;
			//GET DATA REQUEST
			$input['error_id'] = $errorId;
			$input['response_code'] = $code;
			$input['card_type'] = PGRequest::getCmd('typecard', '', 'POST');
			$input['title'] = PGRequest::getVar('error_title', '', 'POST');
			$input['message'] = PGRequest::getVar('error_message', '', 'POST', NULL, 4);
			$input['guide'] = PGRequest::getVar('error_guide', '', 'POST', NULL, 4);
			
			//THUC HIEN CHECK THONG TIN INPUT
			validate_errors($input, $errorValidate, true);
			if (count($errorValidate)) {
		    	$aryOutput['strError'] = (is_array($errorValidate)) ? join("<br>", $errorValidate) : "";
		  		$aryOutput['intOK'] = 0;
		  	}
		  	else {
		  		$sql = "UPDATE errors SET 
		  						error_response_code='".$database->getEscaped($input['response_code'])."', 
		  						error_title='".$database->getEscaped($input['title'])."', 
		  						error_message='".$database->getEscaped($input['message'])."', 
		  						error_guide='".$database->getEscaped($input['guide'])."'
		  				WHERE error_id=$errorId";
		  		
		  		if (!$database->db_query($sql)) {
		    		$aryOutput['strError'] = "Lỗi hệ thống";
		    		$aryOutput['intOK'] = 0;
		  		}
		  	}
		  	
		  	echo json_encode($aryOutput);
			exit();
		}
		
		$query = "SELECT * FROM errors WHERE error_id={$errorId} LIMIT 1";
		$aryError = $database->getRow($database->db_query($query));
		if (!$aryError) cheader($uri->base().'admin_errors.php');
		$aryError['error_card_name'] = $aryCard[$aryError['error_card_type']];
		
		$smarty->assign('cardType', $cardType);
		$smarty->assign('aryCard', $aryCard);
		$smarty->assign('code', $code);
		$smarty->assign('aryError', $aryError);
	
		break;
		
	case "unpublish":
	case "publish":
		$status = ($task=='unpublish')?0:1;
		$cid = PGRequest::getVar( 'cid', array(), 'post', 'array' );
		if (count($cid)<0) cheader($uri->base().'admin_home.php');
		$results = $database->db_query("UPDATE errors SET error_show={$status} WHERE error_id IN(".join(",", $cid).")");
		
		cheader($uri->base().'admin_errors.php');
	break;
	
	case "delete":
		$cid = PGRequest::getVar('cid', array(), 'post', 'array');
		if (count($cid)<0) cheader($uri->base().'admin_home.php');
		$results = $database->db_query("DELETE FROM errors WHERE error_id IN(".join(",", $cid).")");
		
		cheader($uri->base().'admin_errors.php');
	break;
}

function validate_errors($aryInput, &$aryError=array(), $isEdit=false) {  
	global $database;
			
	//CHECK SITE_CODE
	if (trim($aryInput['response_code']) == '') {
		$aryError[] = 'Hãy nhập mã lỗi trả về';
	}
	else {
		$query = "SELECT COUNT(error_id) FROM errors WHERE error_card_type='".$database->getEscaped($aryInput['card_type'])."' AND error_response_code='".$database->getEscaped($aryInput['response_code'])."'";
		if ($isEdit) {
			$query .= " AND error_id <> ".$aryInput['error_id'];
		}
		
		if ($database->getOne($database->db_query($query))) {
			$aryError[] = 'Đã tồn tại mã lỗi trả về. Hãy nhập mã lỗi khác';
		}
	}
	if ($aryInput['title'] == '') {
		$aryError[] = 'Tiêu đề lỗi không được rỗng';
	}
	
	return;
}
//DUMMY DATA

$smarty->assign('task', $task);
$smarty->assign('settingPayment', $settingPayment);

$toolbar = ($task=='view')?createToolbar('new', 'publish', 'unpublish', 'delete'):createToolbar('save', 'cancel');

include "admin_footer.php";
?>