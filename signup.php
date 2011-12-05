<?php
$page = "signup";
include "header.php";
$page_title = "Đăng ký tài khoản";

$task = PGRequest::getCmd('task', '');

// SET ERROR VARS
$is_error = 0;
// IF USER IS ALREADY LOGGED IN, FORWARD TO USER HOME PAGE
if( $user->user_exists ) cheader("index.php");

if($task == "merchant"){
}

if($task == "doregister")
{
	$input['user_type']		= trim(PGRequest::getInt('user_type', '', 'POST'));
	$input['user_email'] 	= trim(PGRequest::getVar('user_email', '', 'POST'));
	$input['user_password'] = trim(PGRequest::getVar('user_password', '', 'POST'));
	$input['repassword'] 	= trim(PGRequest::getVar('repassword', '', 'POST'));
	$input['user_fullname'] = trim(PGRequest::getVar('user_fullname', '', 'POST'));
	$input['user_mobile'] 	= trim(PGRequest::getCmd('user_mobile', '', 'POST'));
	$input['user_address'] 	= trim(PGRequest::getVar('user_address', '', 'POST'));
    $input['user_district'] = trim(PGRequest::getInt('user_district', '', 'POST'));
	$input['user_city'] 	= trim(PGRequest::getInt('user_city', '', 'POST'));
	
	$new_user = new PGUser();
	
	// Check Captcha if turn on Captcha
	if ($setting['setting_signup_code']){
		$code = $_SESSION['code'];
		if ($code == "") {
			$code = randomcode (6);
		}
		$signup_secure = PGRequest::getCmd('captcha', '', 'POST');
		
		if ($signup_secure != $code)
			$new_user->is_error = "Mã xác nhận không đúng";
	}
	
	// TEMPORARILY SET PASSWORD IF RANDOM PASSWORD ENABLED
  	if($setting['setting_signup_randpass'] != 0)
  	{
    	$input['user_password'] = "temporary";
    	$input['repassword'] = "temporary";
  	}
  
	// CHECK USER ERRORS
  	//if (!$new_user->is_error) $new_user->user_password('', $input['user_password'], $input['repassword'], 0, $focus);
  	//if (!$new_user->is_error) $new_user->user_account($input['user_email'], '', $input['user_fullname'], $input['user_mobile'], $input['user_address'], $input['user_district'], $input['user_city'], $focus);
  	$focus = 0;
  	check_user_input($input, $aryError, $focus);

	// INSERT NEW USER
	if (!$focus){
		$doCreate = $new_user->user_create($input['user_email'], '', $input['user_password'], $input['user_fullname'], $input['user_mobile'], $input['user_address'], $input['user_district'], $input['user_city'], $input['user_type']);
		$sql = "SELECT max(user_id) AS maxid FROM users";
		$results = $database->db_fetch_assoc( $database->db_query($sql) );
		// Thêm thông tin nếu là người bán
          if ($input['user_type']==2){
          	$uid=$database->insert("users", $aryInput);
            $aSite = array(
            	'site_type' => 1,
            	'site_code' => 'u'.$results['maxid'],
            	'site_secure_secret'=> md5($results['maxid'].$input['user_email'].'@mcp@'),
                'site_name' => PGRequest::getVar('site_name', '', 'POST'),
                'site_domain'=> PGRequest::getVar('site_domain', '', 'POST')
            );
            
            $database->insert("sites", $aSite);
          }
          // END - Thêm thông tin nếu là người bán
		// SET SIGNUP COOKIE
	    $em = $new_user->user_info['user_email'];
	    setcookie("signup_email", "$em", 0, "/");
	    
		if ($doCreate) cheader('signup_verify.php?task=step2');
	}

	$is_error = (is_array($aryError))?join("<br>", $aryError):(string)$aryError;
	
}

function check_user_input($input, &$aryError, &$focus) { 
		global $database;
		$aryError = array();
		include "include/class_validate.php";
		//CHECK EMAIL
		if ($input['user_email'] == '') {
			$aryError[] = 'Hãy nhập Email';
		}
		else if (!Validation::isEmail($input['user_email'])) {
				$aryError[] = 'Email không đúng định dạng';
		}
		else {
			$email = strtolower($input['user_email']);
			$sql = "SELECT user_id FROM users WHERE LOWER(user_email)='".$database->getEscaped(strtolower($email))."'";
		  	if ($database->db_num_rows($database->db_query($sql))) {
				$aryError[] = 'Email này đã được đăng ký. Hãy chọn 1 email khác.';
			}
		}
		if (count($aryError)) $focus = 1;
		else {
			if (strlen($input['user_password']) < 6) {
				$aryError[] = 'Mật khẩu phải tối thiểu 6 ký tự';
				$focus = 2;
			}
			else if ($input['user_password'] != $input['repassword']){
				$aryError[] = 'Mật khẩu nhập lại không đúng';
				$focus = 3;
			}
			elseif (strlen($input['user_fullname']) < 6) {
				$aryError[] = 'Họ tên phải ít nhất 6 ký tự';
				$focus = 4;
			}
			elseif (strlen($input['user_mobile'])<10 || strlen($input['user_mobile'])>11) {
				$aryError[] = 'Độ dài của trường số điện thoại di động là 10 hoặc 11 số.';
				$focus = 5;
			}
			elseif ($input['user_address'] == '') {
				$aryError[] = 'Hãy nhập địa chỉ hiện tại của bạn.';
				$focus = 6;
			}
			elseif ($input['user_district'] == '') {
				$aryError[] = 'Hãy chọn Quận huyện.';
				$focus = 7;
			}
			elseif ($input['user_city'] == '' || $input['user_city'] == 0) {
				$aryError[] = 'Hãy chọn Tỉnh/Thành phố.';
				$focus = 8;
			}
		}
		
    	return ;
    }
//Set is_error
/*
if ($is_error == 'Họ tên phải ít nhất 6 ký tự.') $focus = 1; //fullname
if ($is_error == 'Số điện thoại không được để trống.' || $is_error == 'Độ dài của trường số điện thoại di động là 10 hoặc 11 số.') $focus = 2; //phone
if ($is_error == 'Hãy nhập địa chỉ hiện tại của bạn.') $focus = 3; //address
if ($is_error == 'Bạn chưa nhập mật khẩu.' || $is_error == 'Mật khẩu không được dưới 6 ký tự.' || $is_error == 'Mật khẩu không được gõ tiếng Việt có dấu.') $focus = 4; //password
if ($is_error == 'Mật khẩu xác nhận không đúng. Xin hãy thử lại.' || $is_error == 'Mật khẩu xác nhận không được gõ tiếng Việt có dấu.') $focus = 5; //rpassword
*/

// Lấy danh sách Tỉnh/Thành phố & Quận/Huyện trong DB
$district = getDistrict();
$city = getCity();
$arrCity = array();

foreach ($city as $cID => $c ){
	$arrCity[$cID] = array('id' => $cID, 'title' => $c['city_name']);
}
$arrDistrict = array();
foreach ($district as $id => $dis){
    $arrDistrict[$dis['district_city_id']][$id] = $dis['district_name'];
}
$smarty->assign('jsonCity', json_encode($arrCity));
$smarty->assign('jsonDistrict', json_encode($arrDistrict));
		
$smarty->assign('is_error', $is_error);
$smarty->assign('focus', $focus);
$smarty->assign('input', $input);
$smarty->assign('step', 1);
$smarty->assign('remember', (int)PGRequest::getVar('remember', 0, 'POST'));
$smarty->assign('task', $task);
include "footer.php";
?>
