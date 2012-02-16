<?php
include "admin.header.php";
include "check.login.php";

$page		= "admin.sites";
$page_title	= "Quản trị merchant";
$task = PGRequest::getCmd('task', 'view');
if ($task == 'cancel') $task='view';
/*
$objAcl = new PGAcl();

if (!$objAcl->checkPermission($page, $task)) {
	$objAcl->showErrorPage($smarty);
}
$sites = get_list_sites();
*/

switch ($task) {
	case "view":

		$page_title				= "Danh sách merchant";
		$method					= PGRequest::getInt('method', 0, 'POST');
		$filter_site_code		= PGRequest::getFilter('site_filter_site_code', 'filter_site_code', '', 'cmd');
		$filter_site_name		= PGRequest::getFilter('site_filter_site_name', 'filter_site_name', '');
		$filter_site_domain		= PGRequest::getFilter('site_filter_site_domain', 'filter_site_domain', '', 'cmd');
		$filter_site_emails		= PGRequest::getFilter('site_filter_site_emails', 'filter_site_emails', '');
		$filter_site_publish	= PGRequest::getFilter('site_filter_site_publish', 'filter_site_publish', 3, 'int');

		$p			 			= PGRequest::getFilter('site_p', 'p', 1, 'int');
		$limit		 			= PGRequest::getFilter('site_limit', 'limit', $setting['setting_list_limit'], 'int');

		$adminId				= $admin->admin_info['admin_id'];
        
    	$order = ' ORDER BY site_type ASC, site_id DESC';
	
		//Make query conditions
		if ($filter_site_code != '') {
			$where[] = " site_code = '".$filter_site_code."'";
		}

		if ($filter_site_name != '') {
			$where[] = " site_name LIKE '%".$database->getEscaped($filter_site_name)."%'";
		}

		if ($filter_site_domain != '') {
			$where[] = " site_domain LIKE '%".$filter_site_domain."%'";
		}

		if ($filter_site_emails != '') {
			$where[] = " site_emails = '".$database->getEscaped($filter_site_emails)."'";
		}

		if ($filter_site_publish != 3){
			$where[] = ' site_publish = '.$filter_site_publish;
		}

		// BUILD THE WHERE CLAUSE OF THE CONTENT RECORD QUERY
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		
		// GET THE TOTAL NUMBER OF RECORDS
		$query		= "SELECT COUNT(*) AS total FROM ".TBL_SITE." $where";
		$results	= $database->db_fetch_assoc($database->db_query($query));
		
		// PHAN TRANG
		$pager		= new pager($limit, $results['total'], $p);
		$offset		= $pager->offset;
		
    	// LAY DANH SACH CHI TIET
		if ($results['total']>0){
    		echo $query		= "SELECT * FROM ".TBL_SITE." $where $order LIMIT $offset, $limit";
    		$results	= $database->db_query($query);
    		
    		while (@$row = $database->db_fetch_assoc($results)){
    			$arySite[] = $row;
    		}
    		
    		$smarty->assign('arySite', $arySite);
		}
		
		$smarty->assign('method', $method);
        $smarty->assign('filter_site_code', $filter_site_code);
        $smarty->assign('filter_site_name', $filter_site_name);
        $smarty->assign('filter_site_domain', $filter_site_domain);
        $smarty->assign('filter_site_emails', $filter_site_emails);
        $smarty->assign('filter_site_publish', $filter_site_publish);
        //$smarty->assign('datapage', $pager->page_link());
        $smarty->assign('p', $p);
        break;
		
	case "new":
		$page_title = "Thêm mới site";
    
    PGTheme::add_js('../templates/js/admin_members.js');
		
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
    
    	PGTheme::add_js('../templates/js/admin_members.js');
		
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
		  	$database->db_query("UPDATE ".TBL_SITE." SET site_publish={$status} WHERE site_id IN(".implode(",", $cid).")");
		}
		cheader($uri->base().'admin.sites.php');
		
		break;
}

$smarty->assign('page', $page);
$smarty->assign('page_title', $page_title);
$smarty->assign('sites', $sites);
$smarty->assign('task', $task);
$smarty->display($template_root.'administrator/admin.sites.tpl');

include "admin.footer.php";
?>