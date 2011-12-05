<?php
$page = "subscribe";

include("header.php");

$task		= PGRequest::getCmd('task', 'unsub');
$ct_message = '';

switch ( $task ){
	case 'unsub':
		$page_title_into = 'Ngừng nhận email thông báo khuyến mãi';
		$email		= PGRequest::getString('email', '', 'GET');
		$id			= PGRequest::getInt('id', 0, 'GET');
		
		if ($email!='' && $id>0){
			$sql = "SELECT NULL AS total FROM subscribe WHERE id=".$id." AND email='".$database->getEscaped($email)."'";
			$total = $database->db_num_rows( $database->db_query($sql) );

			if ($total == 1){
				$ct_message = 'Bạn muốn ngừng nhận email <b>'.$email.'</b> thông báo chương trình khuyến mãi từ <a href="https://sohapay.com" target="_blank">sohapay.com</a> !';
			}else{
				$ct_message = 'Email không tồn tại!';
			}
		}else{
			$ct_message = 'Dữ liệu không hợp lệ!';
		}

		$smarty->assign('email', $email);
		$smarty->assign('id', $id);
		$smarty->assign('total', $total);
		break;

	case 'dounsub':
		$page_title_into = 'Hủy bỏ nhận email thông báo khuyến mãi thành công';
		$email		= PGRequest::getString('email', '', 'POST');
		$id			= PGRequest::getInt('id', 0, 'POST');
		$sub		= PGRequest::getInt('sub', 0, 'POST');
		
		if ($sub == 1){
			$sql = "UPDATE subscribe SET status=0 WHERE id=".$id." AND email='".$database->getEscaped($email)."'";
			$database->db_query($sql);
			$ct_message = 'Email <b>'.$email.'</b> đã được <a href="https://sohapay.com" target="_blank">sohapay.com</a> loại ra khỏi danh sách nhận email thông báo khuyến mãi ! <br /> <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi !</p>';
		}
		break;

	case 'dosub':
		$page_title_into = 'Đăng ký nhận email thông báo khuyến mãi';
		$email		= PGRequest::getString('email', '', 'GET');
		$sub		= PGRequest::getInt('sub', 0, 'GET');	

		if ($sub == 1){
			$ct_message = 'Email <b>'.$email.'</b> đã được <a href="https://sohapay.com" target="_blank">sohapay.com</a> cập nhật nhận thông báo khuyến mãi! <br /> <p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>';
		}
		if ($sub == 2){
			$ct_message = 'Email <b>'.$email.'</b> đã tồn tại trong hệ thống gửi thông báo khuyến mãi của chúng tôi !';
		}
		break;
	
	case 'sub':
	default:
		$email		= PGRequest::getString('email', '', 'POST');	
		$sub		= PGRequest::getInt('sub', 0, 'POST');	
		include "include/class_validate.php";
		$page_title_into = 'Đăng ký nhận email thông báo khuyến mãi';
		
		if ($sub == 1 && $email!=''){
			$chkEmail->is_error_email = FALSE;
			$chkEmail = new Validation();
			$check = $chkEmail->isEmail($email);
			if ($check == 0){
				$chkEmail->is_error_email = "Email bạn nhập không hợp lệ!";
			}else{
				$sql = "SELECT NULL FROM subscribe WHERE email = '".$database->getEscaped($email)."'";
				$total = $database->db_num_rows( $database->db_query($sql) );
				
				if ($total == 0){
					$sql = "INSERT subscribe (email, status) VALUES ('".$database->getEscaped($email)."', 1)";
					$database->db_query($sql);
					cheader($uri->base().'subscribe.php?task=dosub&email='.$email.'&sub=1');
				}else{
					cheader($uri->base().'subscribe.php?task=dosub&email='.$email.'&sub=2');
				}
			}
			$is_error_email = $chkEmail->is_error_email;
		}
		
		$smarty->assign('is_error_email', $is_error_email);
		break;
}

$smarty->assign('page_title_into', $page_title_into);
$smarty->assign('ct_message', $ct_message);
$smarty->assign('page', $page);
$smarty->assign('task', $task);

include ("footer.php");
?>