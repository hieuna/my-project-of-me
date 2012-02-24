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
		$where[] = " status=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$order = " ORDER BY menutype_id DESC";
		$lsMenuType = $objMenuType->loadList($where, $order);
		
		$smarty->assign('menutype_id', $menutype_id);
		$smarty->assign('thisMenu', $thisMenuType);
		$smarty->assign('lsMenuType', $lsMenuType);
		break;
		
	case 'save':
		$menutype_id		= PGRequest::getInt('menutype_id', 0, 'POST');
		$menutype			= PGRequest::getInt('menutype', 0, 'POST');
		$name				= $database->getEscaped(PGRequest::getString('name', '', 'POST'));
		$status				= PGRequest::GetInt('status', 0, 'POST');
		
		$objMenuType = new PGMenuType();
		$thisMenuType = $objMenuType->load($menutype_id);
		if (!$objMenu->is_message){
			$objMenu->menutype 		= $menutype;
			$objMenu->name			= $name;
			if ($alias != ""){
				$objMenu->alias 	= $alias;
			}else{
				$name_alias			= RemoveSign($name);
				$name_alias			= str_replace(" ", "-", $name_alias);
				$name_alias			= preg_replace('/[^a-z0-9]+/i','-',$name_alias);
				$objMenu->alias 	= $name_alias;
			}
			$objMenu->link			= $link;
			$objMenu->status		= $status;
			$objMenu->type			= $type;
			$objMenu->ordering		= $ordering;
			$objMenu->parent_id		= $parent_id;
			$objMenu->save($thisMenu);
			cheader($page);
		}else{
			$mosmsg = $objMenu->is_message;
		}
		$smarty->assign('mosmsg', $mosmsg);
		break;

	case 'publish':
		$objMenu = new PGMenuType();
		$message = $objMenu->published($cid, 1);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'unpublish':
		$objMenu = new PGMenuType();
		$message = $objMenu->published($cid, 0);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'remove':
		$objMenu = new PGMenuType();
		$objMenu->remove($cid);
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
		$order = " ORDER BY ordering ASC, menutype_id DESC";
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_MENU.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$obMenuType =  new PGMenuType();
		$lsMenuType = $obMenuType->loadList($where, $order, $offset, $limit);
		
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