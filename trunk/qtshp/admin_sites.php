<?php
$page = "admin_sites";
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
		$page_title = "Danh sách site";
		$method = PGRequest::getInt('method', 0, 'POST');
		$site_publish 	= PGRequest::getInt('site_publish', -1, 'POST');
		$search = strtolower( PGRequest::getCmd('search', '', 'POST') );
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		$adminId = $admin->admin_info['admin_id'];
		if ($site_publish!=-1){
			$where[] = 'site_publish='.$site_publish;
		}
		// BUILD THE WHERE CLAUSE OF THE CONTENT RECORD QUERY
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM sites $where";
		$results = $database->db_fetch_assoc($database->db_query($query));
		
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		
		// LAY DANH SACH CHI TIET
		$query = "SELECT * FROM sites $where $order LIMIT $offset, $limit";
		$results = $database->db_query($query);
		
		while ($row = $database->db_fetch_assoc($results)){
			$arySite[] = $row;
		}
		
		$smarty->assign('arySite', $arySite);
		$smarty->assign('method', $method);
		$smarty->assign('search', $search);
		$smarty->assign('site_publish', $site_publish);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		break;
		
	case "new":
		$page_title = "Thêm mới site";
		
		$ajax = PGRequest::getInt('ajax', 0);
		if ($ajax) {
			$aryOutput = array();
			$aryOutput['intOK'] = 1;
			//GET DATA REQUEST
			$aryInput = get_data();			
			
			//THUC HIEN CHECK THONG TIN INPUT
			validate_sites($aryInput, $aryError);
			
			if ( count($aryError) ) {
		    	$aryOutput['strError'] = (is_array($aryError)) ? join("<br>", $aryError) : "";
		  		$aryOutput['intOK'] = 0;
		  	}
		  	else if ( !update_sites($aryInput) ) {
	    		$aryOutput['strError'] = "Lỗi hệ thống";
	    		$aryOutput['intOK'] = 0;
		  	}
		  	echo json_encode($aryOutput);
			exit();
		}
		
		break;
		
	case "edit":
		$page_title = "Sửa thông tin site";
		
		$siteId = PGRequest::getInt('id', 0);
		$ajax = PGRequest::getInt('ajax', 0);
		
		if ($ajax) {
			$aryOutput = array();
			$aryOutput['intOK'] = 1;
			//GET DATA REQUEST
			$aryInput = get_data();
			
			//THUC HIEN CHECK THONG TIN INPUT
			validate_sites($aryInput, $aryError, true);
			$aryInput['site_id'] = $siteId;
			if (count($aryError)) {
		    	$aryOutput['strError'] = (is_array($aryError)) ? join("<br>", $aryError) : "";
		  		$aryOutput['intOK'] = 0;
		  	}
		  	else if (!update_sites($aryInput, true)) {
	    		$aryOutput['strError'] = "Lỗi hệ thống";
	    		$aryOutput['intOK'] = 0;
		  	}
		  	
		  	echo json_encode($aryOutput);
			exit();
		}
		
		$query = "SELECT * FROM sites WHERE site_id={$siteId}";
		$arySite = $database->getRow($database->db_query($query));
		if (!$arySite) cheader($uri->base().'admin_users.php');
		
		$smarty->assign('siteId', $siteId);
		$smarty->assign('arySite', $arySite);
		break;
		
	case "publish":
	case "unpublish":
		$cid = PGRequest::getVar('cid', array(), 'post', 'array');
		$status = ($task == 'unpublish') ? 0 : 1;
		if (count($cid)) {
		  	$database->db_query("UPDATE sites SET site_publish={$status} WHERE site_id IN(".implode(",", $cid).")");
		}
		cheader($uri->base().'admin_sites.php');
		
		break;
	case "delete":
		$cid = PGRequest::getVar('cid', array(), 'post', 'array');
		if (count($cid)) {
		  	$database->db_query("DELETE FROM sites WHERE site_id IN(".implode(",", $cid).")");
		}
		cheader($uri->base().'admin_sites.php');
		
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

include "admin_footer.php";
?>