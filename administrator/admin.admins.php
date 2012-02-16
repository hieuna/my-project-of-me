<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.admins.php";
$page_title = "Quản trị thành viên";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel' || !$task ) $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		if ($task == 'edit') $page_title = "Cập nhật thành viên";
		else $page_title = "Thêm mới thành viên";

		$admin_of_id				= PGRequest::GetInt('admin_id', 0, 'GET');
		
		//ARRAY GROUP USERS
		$objAcl = new PGAcl();
		$arrGroup = $objAcl->apl;
		$arrPermiss = $objAcl->atl;
		$pages = $objAcl->pages;
		
		$admins = new PGAdmin();
		$thisAdmin = $admins->load($admin_of_id);
		
		$pageAccess = array();
		foreach ($pages as $key1=>$ps1) {
			$pageAccess[$key1] = PGRequest::getVar($key1, '', 'POST');
		}
		
		$aryPages = array();
		foreach ($pages as $key1=>$ps1) {
			foreach ($ps1 as $key2=>$ps2) {
				$aryPages[$key1][$ps2] = $arrPermiss[$ps2];
			}
		}
		
		$smarty->assign('admin_of_id', $admin_of_id);
		$smarty->assign('thisAdmin', $thisAdmin);
		$smarty->assign('arrGroup', $arrGroup);
		$smarty->assign('aryPages', $aryPages);
		
		break;
		
	case 'save':
		$aryInput['admin_id']			= PGRequest::GetInt('admin_id', 0, 'POST');
		$aryInput['admin_name']			= $database->getEscaped(PGRequest::getString('admin_name', '', 'POST'));
		$aryInput['admin_password']		= $database->getEscaped(PGRequest::getString('admin_password', '', 'POST'));
		$aryInput['admin_password_new']	= $database->getEscaped(PGRequest::getString('admin_password_new', '', 'POST'));
		$aryInput['admin_password_conf']= $database->getEscaped(PGRequest::getString('admin_password_conf', '', 'POST'));
		$aryInput['admin_group']		= PGRequest::GetInt('cbo_group', 0, 'POST');
		
		$aryInput['admin_admins']		= PGRequest::getVar('admin_admins', '', 'POST');
		$aryInput['admin_sites'] 		= PGRequest::getVar('admin_sites', '', 'POST');
		$aryInput['admin_hotdeal'] 		= PGRequest::getVar('admin_hotdeal', '', 'POST');
		$aryInput['admin_customer_hotdeal'] = PGRequest::getVar('admin_customer_hotdeal', '', 'POST');
		//ARRAY GROUP USERS
		$objAcl = new PGAcl();
		$arrGroup = $objAcl->apl;
		$arrPermiss = $objAcl->atl;
		$pages = $objAcl->pages;
		
		$admins = new PGAdmin();
		$thisUser = $admins->load($aryInput['admin_id']);
		
		if($thisUser->admin_username){
			$aryInput['admin_username'] = $thisUser->admin_username;
			$aryInput['admin_email'] = $thisUser->admin_email;
		}else{
			$aryInput['admin_username'] = $database->getEscaped(PGRequest::getString('admin_username', '', 'POST'));
			$aryInput['admin_email'] = $database->getEscaped(PGRequest::getString('admin_email', '', 'POST'));;
		}
		
		//THUC HIEN CHECK THONG TIN INPUT
		$admins->check_account_input($aryInput);
		
		$pageAccess = array();
		foreach ($pages as $key1=>$ps1) {
			$pageAccess[$key1] = PGRequest::getVar($key1, '', 'POST');
		}

		$group = $aryInput['admin_group'];
		$access = (count($pageAccess)) ? serialize($pageAccess) : '';
		if ($group == 1) $access = '';
		if (!$admins->is_message){
			$admins->admin_name 		= $aryInput['admin_name'];
			if ($aryInput['admin_id'] == 0){
				$admins->admin_email		= $aryInput['admin_email'];
				$admins->admin_username		= $aryInput['admin_username'];
				$admins->admin_password		= $aryInput['admin_password'];
				$admins->admin_created		= $admin_id;
				$admins->admin_registerDate = date("Y-m-d h:i:s");
			}else{
				$admins->admin_modify		= $admin_id;
				if ($aryInput['admin_password_new']!="" && $aryInput['admin_password_conf']!=""){
					if ($aryInput['admin_password_new'] != $aryInput['admin_password_conf'])
						$is_message = "Mật khẩu xác nhận không đúng !";
					else if (md5($aryInput['admin_password']) != $thisUser->admin_password)
						$is_message = "Mật khẩu cũ không đúng !";
					else
						$admins->admin_password = md5($aryInput['admin_password_new']);
				}
			}
			$admins->admin_group		= $aryInput['admin_group'];
			$admins->admin_access		= $access;

			if (!$admins->save($thisUser)) {
	    		$is_message = "Lỗi hệ thống";
	    		break;
	    	}
	    	else {
	    		$is_message = "Thêm quản trị viên thành công !";
	    		cheader('admin.admins.php');
	    	}
		}else{
			$is_message = $admins->is_message;
		}
		break;

	case 'publish':
		$admins = new PGAdmin();
		$message = $admins->published($cid, 1);
		cheader('admin.admins.php?task=view&is_message='. $message);
		break;

	case 'unpublish':
		$admins = new PGAdmin();
		$message = $admins->published($cid, 0);
		cheader('admin.admins.php?task=view&is_message='. $message);
		break;

	case 'remove':
		$admins = new PGAdmin();
		$admins->remove($cid);
		cheader('admin.admins.php?task=view&is_message='. $message);
		break;	
	
	default :
		$page_title = "Danh sách quản trị viên";
		
		$filter_status = PGRequest::getInt('filter_status', 3, 'POST');
		$search = $database->getEscaped(PGRequest::getString('search', '', 'POST'));
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		//CONDITION
		$where[] = "admin_group>=".$admin_group;
		if ($search){
			$where[] = "admin_name LIKE'%$search%'";
		}
		if ($filter_status == 0) {			
			$where[] = "admin_enabled=0";
		}else if ($filter_status == 3){
			$where[] = "admin_enabled>=0";			
		}else{
			$where[] = "admin_enabled=".$filter_status;
		}
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_ADMIN.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$admins =  new PGAdmin();
		$lsAdmin = $admins->loadList($where, $offset, $limit);
		
		$smarty->assign('is_message', $is_message);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsAdmin', $lsAdmin);
		break;
}

$smarty->assign('page', $page);
$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign('is_message',$is_message);
$smarty->display($template_root.'administrator/admin.admins.tpl');

include "admin.footer.php";
?>