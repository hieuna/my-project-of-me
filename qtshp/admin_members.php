<?php
/**
 * Logic xu ly cua module user
 */
$page = "admin_members";
include "admin_header.php";

$task = PGRequest::getCmd('task', 'view');
if ($task=='cancel') $task='view';

$objAcl = new PGAcl();
if (!$objAcl->checkPermission($page, $task)) {
	$objAcl->showErrorPage($smarty);
}

$sites = get_list_sites();
switch ($task) {
	case "view":
		$page_title = "Quản trị user";
		$filter_usertype = PGRequest::getInt('filter_usertype', 0, 'POST');
		$filter_statusemail = PGRequest::getInt('filter_statusemail', -1, 'POST');
		$filter_statusmobile = PGRequest::getInt('filter_statusmobile', -1, 'POST');
		$filter_status = PGRequest::getInt('filter_status', -1, 'POST');
		$search	= PGRequest::getFilter('membersearch', 'search', '');
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		$adminId = $admin->admin_info['admin_id'];
		
		//CHON TAT CA USER TRANG THAI KICH HOAT
		if ($filter_status != -1) {			
			$where[] = " user_enabled=".$filter_status;
		}
		if ($filter_statusemail != -1) {			
			$where[] = " user_verified=".$filter_statusemail;
		}
		if ($filter_statusmobile != -1) {			
			$where[] = " user_verified_mobile=".$filter_statusmobile;
		}
		if ($filter_usertype) {			
			$where[] = " user_type=".($filter_usertype);
		}
		if ($search) {
			$strSearch = $database->getEscaped($search);
			$where[] = "(user_email LIKE '%".$strSearch."%' OR user_fullname LIKE '%".$strSearch."%' OR user_mobile LIKE '%".$strSearch."%')";
		}
		// BUILD THE WHERE CLAUSE OF THE CONTENT RECORD QUERY
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM users $where";
		$results = $database->db_fetch_assoc($database->db_query($query));
		$totalRecords = $results['total'];
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		
		// LAY DANH SACH CHI TIET
		$query = "SELECT * FROM users $where $order LIMIT $offset, $limit";
		$results = $database->db_query($query);
		
		$district = getDistrict();
		$city = getCity();
		$typeUser = PGSettings::getTypeUser();
		while ($row = $database->db_fetch_assoc($results)){
			$row['user_district'] = $district[$row['user_district']]['district_name'];
			$row['user_city']	= $city[$row['user_city']]['city_name'];
			$row['user_type']	= $typeUser[$row['user_type']];
			$row['user_lastlogindate'] = $datetime->timestampToDateTime($row['user_lastlogindate']);
			$users[] = $row;
		}
		
		$smarty->assign('member', $users);
		$smarty->assign('typeUser', $typeUser);
		$smarty->assign('type_user', $filter_usertype);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_statusmobile', $filter_statusmobile);
		$smarty->assign('filter_statusemail', $filter_statusemail);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('arrGroup', $arrGroup);
		$smarty->assign('total_record', $totalRecords);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		break;

	case "detail":
		$page_title = "Chi tiết user";
	break;
	
	case "new":
		$page_title = "Thêm mới user";
    
    PGTheme::add_js('../templates/js/admin_members.js');
		
		$ajax = PGRequest::getInt('ajax', 0);
		
		if ($ajax) {
			$aryInput['user_email'] = PGRequest::getVar('user_email', '', 'POST');
			$aryInput['user_fullname'] = PGRequest::getVar('user_fullname', '', 'POST');
			$aryInput['user_password'] = PGRequest::getVar('user_password', '', 'POST');
			$aryInput['user_mobile'] = PGRequest::getVar('user_mobile', '', 'POST');
			$aryInput['user_address'] = PGRequest::getVar('user_address', '', 'POST');
			$aryInput['user_address2'] = PGRequest::getVar('user_address2', '', 'POST');
			$aryInput['user_district'] = PGRequest::getInt('user_district', 0, 'POST');
			$aryInput['user_district2'] = PGRequest::getInt('user_district2', 0, 'POST');
			$aryInput['user_city'] = PGRequest::getInt('user_city', 0, 'POST');
			$aryInput['user_city2'] = PGRequest::getInt('user_city2', 0, 'POST');
			$aryInput['user_verified'] = PGRequest::getInt('user_verified', 0, 'POST');
			$aryInput['user_verified_mobile'] = PGRequest::getInt('user_verified_mobile', 0, 'POST');
			$aryInput['user_enabled'] = PGRequest::getInt('user_enabled', 0, 'POST');
			$aryInput['user_type'] = PGRequest::getInt('user_type', 1, 'POST');
			$aryInput['user_signupdate'] = ($aryInput['user_lastlogindate'] = ($aryInput['user_lastactive'] = time()));
			$aryInput['user_ip_signup'] = ($aryInput['user_ip_lastactive'] = $_SERVER['REMOTE_ADDR']);
			
			$aryOutput = array();
			$aryOutput['intOK'] = 1;
			
			//THUC HIEN CHECK THONG TIN INPUT
			check_member_input($aryInput, $aryError);
			
      // Check tên shop
      $site_name = PGRequest::getVar('site_name', '', 'POST');
      if (empty($site_name)){
        $aryError[] = "Bạn hãy nhập vào tên shop";
      }
      
			if (!$aryError) {
				include "../include/class_user.php";
				$new_user = new PGUser();
				$signup_password = ($setting['setting_signup_randpass']) ? randomcode(10) : $aryInput['user_password'];
				$aryInput['user_password'] = $new_user->user_password_crypt($signup_password);
				$aryInput['user_code'] = $new_user->user_salt;
		    	if (!$uid=$database->insert("users", $aryInput)) {
		    		$aryOutput['strError'] = "Lỗi hệ thống";
		    		$aryOutput['intOK'] = 0;
		    	}
          
          // Thêm thông tin nếu là người bán
          if ($aryInput['user_type']==2){
            $aSite = array(
                'site_type' => 1,
                'site_code' => 'u'.$uid,
                'site_secure_secret'=> md5($uid.$aryInput['user_email'].'@mcp@'),
                'site_name' => PGRequest::getVar('site_name', '', 'POST'),
                'site_domain'=> PGRequest::getVar('site_domain', '', 'POST'),
                'site_qt_feename'=> PGRequest::getVar('site_qt_feename', '', 'POST'),
                'site_qt_feeper'=> PGRequest::getFloat('site_qt_feeper', 0, 'POST'),
                'site_qt_feefix'=> PGRequest::getInt('site_qt_feefix', 0, 'POST'),
                'site_nd_feename'=> PGRequest::getVar('site_nd_feename', '', 'POST'),
                'site_nd_feeper'=> PGRequest::getFloat('site_nd_feeper', 0, 'POST'),
                'site_nd_feefix'=> PGRequest::getInt('site_nd_feefix', 0, 'POST'),
                'site_merchant_qt_feename'=> PGRequest::getVar('site_merchant_qt_feename', '', 'POST'),
                'site_merchant_qt_feeper'=> PGRequest::getFloat('site_merchant_qt_feeper', 0, 'POST'),
                'site_merchant_qt_feefix'=> PGRequest::getInt('site_merchant_qt_feefix', 0, 'POST'),
                'site_merchant_nd_feename'=> PGRequest::getVar('site_merchant_nd_feename', '', 'POST'),
                'site_merchant_nd_feeper'=> PGRequest::getFloat('site_merchant_nd_feeper', 0, 'POST'),
                'site_merchant_nd_feefix'=> PGRequest::getInt('site_merchant_nd_feefix', 0, 'POST'),
                'site_use_coupon'=> PGRequest::getInt('site_use_coupon', 0, 'POST'),
                'site_phone'=> PGRequest::getFloat('user_mobile', 0, 'POST'),
                'site_emails'=> PGRequest::getInt('user_email', 0, 'POST'),
                'site_shipping_allow'=> PGRequest::getInt('site_shipping_allow', 0, 'POST'),
                'site_shipping_urban_fee'=> PGRequest::getInt('site_shipping_urban_fee', 0, 'POST'),
                'site_shipping_suburb_fee'=> PGRequest::getInt('site_shipping_suburb_fee', 0, 'POST')
            );
            
            $database->insert("sites", $aSite);
          }
          // END - Thêm thông tin nếu là người bán
		  	}
		  	else {
		  		$aryOutput['strError'] = (is_array($aryError))?join("<br>", $aryError):"";
		  		$aryOutput['intOK'] = 0;
		  	}
		  	
		  	echo json_encode($aryOutput);
			exit();
		}
		$district = getDistrict();
		$city = getCity();
		
		$smarty->assign('district', $district);
		$smarty->assign('city', $city);
		$smarty->assign('json_district', json_encode($district));
		$smarty->assign('userId', $userId);
		$smarty->assign('aryUser', $aryUser);
		
		break;
		
	case "edit":
		$page_title = "Sửa thông tin user";
    
    PGTheme::add_js('../templates/js/admin_members.js');
		
		//ARRAY GROUP USERS
		
		$userId = PGRequest::getInt('id', 0);
		$ajax = PGRequest::getInt('ajax', 0);
		
		$query = "SELECT * FROM users WHERE user_id={$userId} LIMIT 1";
		
		$aryUser = $database->getRow($database->db_query($query));
		if (!$aryUser) cheader($uri->base().'admin_members.php');
		
		$aryUser['user_signupdate'] = $datetime->timestampToDateTime($aryUser['user_signupdate']);
		$aryUser['user_lastlogindate'] = $datetime->timestampToDateTime($aryUser['user_lastlogindate']);
    
    // Lấy thêm thông tin của người bán hàng
    $arySite = array(
      'site_name'=> '',
      'site_domain'=> '',
      'site_qt_feename'=> '(Miễn phí)',
      'site_qt_feeper'=> 0.00,
      'site_qt_feefix'=> 0,
      'site_nd_feename'=> '(Miễn phí)',
      'site_nd_feeper'=> 0.00,
      'site_shipping_allow'=> 0,
      'site_shipping_urban_fee'=> 0,
      'site_shipping_suburb_fee'=> 0
    );
    if ($aryUser['user_type']==2){
      $arySite = $database->getRow($database->db_query("SELECT site_name, site_domain, site_qt_feename, site_qt_feeper, site_qt_feefix, site_nd_feename, site_nd_feeper, site_nd_feefix, site_merchant_qt_feename, site_merchant_qt_feeper, site_merchant_qt_feefix, site_merchant_nd_feename, site_merchant_nd_feeper, site_merchant_nd_feefix, site_shipping_allow, site_shipping_urban_fee, site_shipping_suburb_fee, site_use_coupon FROM sites WHERE site_code='u%d'", $userId));
    }
    
    if (!is_null($arySite)) $aryUser = array_merge($aryUser, $arySite);
    
		if ($ajax) {
			$aryInput['user_id'] = $userId;
			$aryInput['user_email'] = PGRequest::getVar('user_email', '', 'POST');
			$aryInput['user_fullname'] = PGRequest::getVar('user_fullname', '', 'POST');
			$aryInput['user_password'] = PGRequest::getVar('user_password', '', 'POST');
			$aryInput['user_mobile'] = PGRequest::getVar('user_mobile', '', 'POST');
			$aryInput['user_address'] = PGRequest::getVar('user_address', '', 'POST');
			$aryInput['user_address2'] = PGRequest::getVar('user_address2', '', 'POST');
			$aryInput['user_district'] = PGRequest::getInt('user_district', 0, 'POST');
			$aryInput['user_district2'] = PGRequest::getInt('user_district2', 0, 'POST');
			$aryInput['user_city'] = PGRequest::getInt('user_city', 0, 'POST');
			$aryInput['user_city2'] = PGRequest::getInt('user_city2', 0, 'POST');
			$aryInput['user_verified'] = PGRequest::getInt('user_verified', 0, 'POST');
			$aryInput['user_verified_mobile'] = PGRequest::getInt('user_verified_mobile', 0, 'POST');
			$aryInput['user_enabled'] = PGRequest::getInt('user_enabled', 0, 'POST');
			$aryInput['user_type'] = PGRequest::getInt('user_type', 1, 'POST');
			
			$aryOutput = array();
			$aryOutput['intOK'] = 1;
			
			//THUC HIEN CHECK THONG TIN INPUT
			check_member_input($aryInput, $aryError, true);
			
			if (!$aryError) {
				unset($aryInput['user_id']);
				if (!$aryInput['user_password']) {
					unset($aryInput['user_password']);
				}
				else {
					include "../include/class_user.php";
					$new_user = new PGUser();
					$signup_password = ($setting['setting_signup_randpass']) ? randomcode(10) : $aryInput['user_password'];
					$aryInput['user_password'] = $new_user->user_password_crypt($signup_password);
					$aryInput['user_code'] = $new_user->user_salt;
				}
	    	if (!$database->update("users", $aryInput, "user_id={$userId}")) {
	    		$aryOutput['strError'] = "Lỗi hệ thống";
	    		$aryOutput['intOK'] = 0;
	    	}
        
        if ($aryInput['user_type']==1){
          $database->delete('sites', "site_code='u".$userId."'");
        }else{
          // BEGIN - Thêm thông tin nếu là người bán
          $aUser = array(
            'site_type' => 1,
            'site_code' => 'u'.$userId,
            'site_secure_secret'=> md5($userId.$user_email.'@mcp@'),
            'site_name' => PGRequest::getVar('site_name', $aryInput['user_fullname'], 'POST'),
            'site_domain'=> PGRequest::getVar('site_domain', $aryInput['user_email'], 'POST'),
            'site_qt_feename'=> PGRequest::getVar('site_qt_feename', '', 'POST'),
            'site_qt_feeper'=> PGRequest::getFloat('site_qt_feeper', 0, 'POST'),
            'site_qt_feefix'=> PGRequest::getInt('site_qt_feefix', 0, 'POST'),
            'site_nd_feename'=> PGRequest::getVar('site_nd_feename', '', 'POST'),
            'site_nd_feeper'=> PGRequest::getFloat('site_nd_feeper', 0, 'POST'),
            'site_nd_feefix'=> PGRequest::getInt('site_nd_feefix', 0, 'POST'),
            'site_merchant_qt_feename'=> PGRequest::getVar('site_merchant_qt_feename', '', 'POST'),
            'site_merchant_qt_feeper'=> PGRequest::getFloat('site_merchant_qt_feeper', 0, 'POST'),
            'site_merchant_qt_feefix'=> PGRequest::getInt('site_merchant_qt_feefix', 0, 'POST'),
            'site_merchant_nd_feename'=> PGRequest::getVar('site_merchant_nd_feename', '', 'POST'),
            'site_merchant_nd_feeper'=> PGRequest::getFloat('site_merchant_nd_feeper', 0, 'POST'),
            'site_merchant_nd_feefix'=> PGRequest::getInt('site_merchant_nd_feefix', 0, 'POST'),
            'site_use_coupon'=> PGRequest::getInt('site_use_coupon', 0, 'POST'),
            'site_phone'=> PGRequest::getVar('user_mobile', 0, 'POST'),
            'site_emails'=> PGRequest::getVar('user_email', 0, 'POST'),
            'site_shipping_allow'=> PGRequest::getInt('site_shipping_allow', 0, 'POST'),
            'site_shipping_urban_fee'=> PGRequest::getInt('site_shipping_urban_fee', 0, 'POST'),
            'site_shipping_suburb_fee'=> PGRequest::getInt('site_shipping_suburb_fee', 0, 'POST')
          );
          
          if ($aryUser['user_type']!=$aryInput['user_type']){
            $database->insert("sites", $aUser);
          }else{
            unset($aUser['site_code']);
            unset($aUser['site_secure_secret']);
            $database->update("sites", $aUser, "site_code='u".$userId."'");
          }
          
        // END - Thêm thông tin nếu là người bán
        }
	  	}else {
		  		$aryOutput['strError'] = (is_array($aryError))?join("<br>", $aryError):"";
		  		$aryOutput['intOK'] = 0;
	  	}
	  	
	  	echo json_encode($aryOutput);
			exit();
		}
		$district = getDistrict();
		$city = getCity();
		
		$smarty->assign('district', $district);
		$smarty->assign('city', $city);
		$smarty->assign('json_district', json_encode($district));
		$smarty->assign('userId', $userId);
		$smarty->assign('aryUser', $aryUser);
		break;
		
	case "delete":
		$cid = PGRequest::getVar('cid', array(), '', 'array');
		if (count($cid)) {
		  	$database->db_query("DELETE FROM users WHERE user_id IN(".implode(",", $cid).")");
		}
		cheader($uri->base().'admin_members.php');
		
		break;
		
	case "unpublish":
	case "publish":
		$status = ($task == 'unpublish') ? 0 : 1;
		$cid = PGRequest::getVar( 'cid', array(), 'post', 'array' );
		
		if (count($cid)) {
			$query = "UPDATE users SET user_enabled={$status} WHERE user_id IN(".implode(",", $cid).")";
			$results = $database->db_query($query);
		}
		cheader($uri->base().'admin_members.php');
		break;
}


$smarty->assign('sites', $sites);
$smarty->assign('task', $task);
$smarty->assign('settingPayment', $settingPayment);

////////////////////////
if ($task == 'view') {	
	$toolbar = createToolbar('new','delete','publish','unpublish');
}
elseif ($task == 'edit' || $task == 'new') {
	$toolbar = createToolbar('save','cancel');
}

	function check_member_input($input, &$aryError, $isUpdate=false) {  
		global $database;
    	
		//CHECK EMAIL
		if ($input['user_email'] == '') {
			$aryError[] = 'Hãy nhập Email';
		}
		else if ($input['user_email'] !='') {
			if (!Validation::isEmail($input['user_email'])) {
				$aryError[] = 'Email không đúng định dạng';
			}
			else {
				$email = strtolower($input['user_email']);
				$sql = "SELECT user_id FROM users WHERE LOWER(user_email)='{$email}'";
				if ($isUpdate) {
					$sql .= " AND user_id <>".$input['user_id'];
				}
			  	if ($database->db_num_rows($database->db_query($sql))) {
					$aryError[] = 'Email này đã có trong hệ thống. Hãy chọn 1 email khác.';
				}
			}
		}
		//CHECK ADMIN NAME
		if (strlen($input['user_fullname']) < 6) {
			$aryError[] = 'Họ tên phải ít nhất 6 ký tự';
		}
		//CHECK PASSWORDS
	    if (($isUpdate && trim($input['user_password'])!= '' && strlen($input['user_password']) < 6) || (!$isUpdate && strlen($input['user_password']) < 6)) {
	        $aryError[] = 'Mật khẩu phải tối thiểu 6 ký tự.';
	    }
	    //CHECK MOBILE
		if (strlen($input['user_mobile']) < 6) {
			$aryError[] = 'Hãy nhập số điện thoại';
		}
		//CHECK ADDRESS
		if (trim($input['user_address']) == '' || (int)$input['user_district'] == 0 || (int)$input['user_city'] == 0) {
			$aryError[] = 'Địa chỉ, Quận/Huyện/Thị xã, Tỉnh/Thành phố phải có';
		}
	    
    	return true;
    }

include "admin_footer.php";
?>