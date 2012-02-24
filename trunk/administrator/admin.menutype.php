<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.menutype.php";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel') $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		if ($task == 'edit') $page_title = "Cập nhật nhóm menu";
		else $page_title = "Thêm mới nhóm menu";
		
		$menutype_id	= PGRequest::getInt('menutype_id', 0, 'GET');
		
		$objMenuType = new PGMenuType();
		$thisMenuType = $objMenuType->load($menutype_id);
		
		$smarty->assign('menutype_id', $menutype_id);
		$smarty->assign('thisMenuType', $thisMenuType);
		break;
		
	case 'save':
		$menutype_id		= PGRequest::getInt('menutype_id', 0, 'POST');
		$name				= $database->getEscaped(PGRequest::getString('name', '', 'POST'));
		$status				= PGRequest::GetInt('status', 0, 'POST');
		
		$objMenuType = new PGMenuType();
		$thisMenuType = $objMenuType->load($menutype_id);
		if (!$objMenuType->is_message){
			$objMenuType->name			= $name;
			$objMenuType->status		= $status;
			$objMenuType->save($thisMenuType);
			cheader($page);
		}else{
			$mosmsg = $objMenu->is_message;
		}
		$smarty->assign('mosmsg', $mosmsg);
		break;

	case 'publish':
		$objMenuType = new PGMenuType();
		$message = $objMenuType->published($cid, 1);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'unpublish':
		$objMenuType = new PGMenuType();
		$message = $objMenuType->published($cid, 0);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'remove':
		$objMenuType = new PGMenuType();
		$objMenuType->remove($cid);
		cheader($page);
		break;	
	
	default :
		$page_title = "Danh sách nhóm menu";
		$mosmsg		= strval( ( stripslashes( strip_tags( PGRequest::getString('mosmsg', $mosmsg, '') ) ) ) );
		
		$filter_status = PGRequest::getInt('filter_status', 3, 'POST');
		$search = strtolower( PGRequest::getCmd('search', '', 'POST') );
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		//CONDITION
		if ($search){
			$where[] = " name LIKE'%$search%'";
		}
		if ($filter_status == 0) {			
			$where[] = " status=0";
		}else if ($filter_status == 3){
			$where[] = " status>=0";			
		}else{
			$where[] = " status=".$filter_status;
		}
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$order = " ORDER BY menutype_id DESC";
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_MENUTYPE.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$objMenuType =  new PGMenuType();
		$lsMenuType = $objMenuType->loadList($where, $order, $offset, $limit);
		
		$smarty->assign('is_message', $is_message);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsMenuType', $lsMenuType);
		break;
}

$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign("page", $page);
$smarty->assign('error',$error);

$smarty->display($template_root.'administrator/admin.menutype.tpl');

include "admin.footer.php";
?>