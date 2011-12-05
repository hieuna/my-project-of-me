<?php
defined('PG_PAGE') or die();
function update_sites($aryInput, $isEdit=false) {
	global $database;
	$sql = "INSERT INTO sites(
					site_code,
					site_secure_secret,
					site_name,
					site_domain,
					site_phone,
					site_emails,
					site_qt_feename,
					site_qt_feeper,
					site_qt_feefix,
					site_nd_feename,
					site_nd_feeper,
					site_nd_feefix,
					site_publish
				) VALUES (
					'".$database->getEscaped($aryInput['site_code'])."',
					'".md5(time())."',
					'".$database->getEscaped($aryInput['site_name'])."',
					'".$database->getEscaped($aryInput['site_domain'])."',
					'".$database->getEscaped($aryInput['site_phone'])."',
					'".$database->getEscaped($aryInput['site_emails'])."',
					'".$database->getEscaped($aryInput['site_qt_feename'])."',
					'{$aryInput['site_qt_feeper']}',
					'{$aryInput['site_qt_feefix']}',
					'".$database->getEscaped($aryInput['site_nd_feename'])."',
					'{$aryInput['site_nd_feeper']}',
					'{$aryInput['site_nd_feefix']}',
					'0'
				)";
	
	
	if ($isEdit) {
		$sql = "UPDATE sites SET
					site_name='".$database->getEscaped($aryInput['site_name'])."',
					site_domain='".$database->getEscaped($aryInput['site_domain'])."',
					site_phone='".$database->getEscaped($aryInput['site_phone'])."',
					site_emails='".$database->getEscaped($aryInput['site_emails'])."',
					site_qt_feename='".$database->getEscaped($aryInput['site_qt_feename'])."',
					site_qt_feeper='{$aryInput['site_qt_feeper']}',
					site_qt_feefix='{$aryInput['site_qt_feefix']}',
					site_nd_feename='".$database->getEscaped($aryInput['site_nd_feename'])."',
					site_nd_feeper='{$aryInput['site_nd_feeper']}',
					site_nd_feefix='{$aryInput['site_nd_feefix']}',
					site_sendemail='{$aryInput['site_sendemail']}'
				WHERE site_id='{$aryInput['site_id']}'
				";
	}
	return $database->db_query($sql);
}
function get_data() {
	$aryInput['site_code'] = PGRequest::getVar('site_code', '', 'POST');
	$aryInput['site_name'] = PGRequest::getVar('site_name', '', 'POST');
	$aryInput['site_domain'] = PGRequest::getVar('site_domain', '', 'POST');
	$aryInput['site_phone'] = PGRequest::getVar('site_phone', '', 'POST');
	$aryInput['site_emails'] = PGRequest::getVar('site_emails', '', 'POST');
	$aryInput['site_qt_feename'] = (PGRequest::getVar('site_qt_feename', '', 'POST')) ? PGRequest::getVar('site_qt_feename', '', 'POST') : "";
	$aryInput['site_qt_feeper'] = PGRequest::getVar('site_qt_feeper', '', 'POST');
	$aryInput['site_qt_feefix'] = PGRequest::getVar('site_qt_feefix', '', 'POST');
	$aryInput['site_nd_feename'] = (PGRequest::getVar('site_nd_feename', '', 'POST')) ? PGRequest::getVar('site_nd_feename', '', 'POST') : "";
	$aryInput['site_nd_feeper'] = PGRequest::getVar('site_nd_feeper', '', 'POST');
	$aryInput['site_nd_feefix'] = PGRequest::getVar('site_nd_feefix', '', 'POST');
	$aryInput['site_sendemail'] = PGRequest::getInt('site_sendemail', 0, 'POST');
	
	return $aryInput;
}
function validate_sites($aryInput, &$aryError=array(), $isEdit=false) {  
	global $database;
			
	//CHECK SITE_CODE
	if (!$isEdit && strlen($aryInput['site_code']) < 1) {
		$aryError[] = 'Mã site phải ít nhất 1 ký tự';
	}
	else if (!Validation::isAlnum($aryInput['site_code'])) {
		$aryError[] = 'Mã site phải là dạng chữ số';
	}
	//CHECK NAME
	if ($aryInput['site_name'] == '') {
		$aryError[] = 'Tên site không được rỗng';
	}
	//CHECK DOMAIN
	if ($aryInput['site_domain'] == '') {
		$aryError[] = 'Domain không được rỗng';
	}
	else if (!Validation::isURL($aryInput['site_domain'], true)) {
		$aryError[] = 'Domain không đúng định dạng';
	} 
	//CHECK PHONE
	if (!is_numeric($aryInput['site_phone'])) {
		$aryError[] = 'Số điện thoại phải là dạng số';
	}
	//CHECK EMAIL
	if ($aryInput['site_emails'] == '') {
		$aryError[] = 'Hãy nhập Email';
	}
	else if ($aryInput['site_email'] !='') {
		if (!Validation::isEmail($aryInput['site_email'])) {
			$aryError[] = 'Email không đúng định dạng';
		}
	}
	//CHECK FEEFIX
	if ($aryInput['site_qt_feeper'] != '' && !is_numeric($aryInput['site_qt_feeper'])) {
		$aryError[] = 'Phí thanh toán (Quốc tế) phải là dạng số thực';
	}
	//CHECK FEEFIX
	if ($aryInput['site_nd_feeper'] != '' && !is_numeric($aryInput['site_nd_feeper'])) {
		$aryError[] = 'Phí thanh toán (Nội địa) phải là dạng số thực';
	}
	//CHECK FEEFIX
	if ($aryInput['site_qt_feefix'] != '' && !is_numeric($aryInput['site_qt_feefix'])) {
		$aryError[] = 'Phí cố định (Quốc tế) phải là dạng số thực';
	}
	//CHECK FEEFIX
	if ($aryInput['site_nd_feefix'] != '' && !is_numeric($aryInput['site_nd_feefix'])) {
		$aryError[] = 'Phí cố định (Nội địa) phải là dạng số thực';
	}
	return;
}
?>