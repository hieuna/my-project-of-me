<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.menu.php";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel') $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		if ($task == 'edit') $page_title = "Cập nhật menu";
		else $page_title = "Thêm mới menu";
		
		$menu_id	= PGRequest::getInt('menu_id', 0, 'GET');
		
		$objMenu = new PGMenu();
		$thisMenu = $objMenu->load($menu_id);
		$where[] = " status=1";
		if ($task=='add') $where[] = "parent_id>=0";
		else $where[] = " parent_id<=".$thisMenu->parent_id;	
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$order = " ORDER BY ordering ASC, menu_id DESC";
		$lsMenu = $objMenu->loadList($where, $order);
		
		$smarty->assign('menu_id', $menu_id);
		$smarty->assign('thisMenu', $thisMenu);
		$smarty->assign('lsMenu', $lsMenu);
		break;
		
	case 'save':
		$menu_id			= PGRequest::getInt('menu_id', 0, 'POST');
		$menutype			= PGRequest::getInt('menutype', 0, 'POST');
		$name				= $database->getEscaped(PGRequest::getString('name', '', 'POST'));
		$alias				= $database->getEscaped(PGRequest::getString('alias', '', 'POST'));
		$link				= $database->getEscaped(PGRequest::getString('link', '', 'POST'));
		$type				= $database->getEscaped(PGRequest::getString('type', ''));
		$status				= PGRequest::GetInt('status', 0, 'POST');
		$ordering			= PGRequest::GetInt('ordering', 0, 'POST');
		$parent_id			= PGRequest::GetInt('parent_id', 0, 'POST');
		
		$objMenu = new PGMenu();
		$thisMenu = $objMenu->load($menu_id);
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
		$objMenu = new PGMenu();
		$message = $objMenu->published($cid, 1);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'unpublish':
		$objMenu = new PGMenu();
		$message = $objMenu->published($cid, 0);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'remove':
		$objMenu = new PGMenu();
		$objMenu->remove($cid);
		cheader($page);
		break;	
	
	default :
		$page_title = "Danh sách menu";
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
		$order = " ORDER BY ordering ASC, menu_id DESC";
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_MENU.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$obMenu =  new PGMenu();
		$lsMenu = $obMenu->loadList($where, $order, $offset, $limit);
		
		$smarty->assign('is_message', $is_message);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsMenu', $lsMenu);
		break;
}

$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign("page", $page);
$smarty->assign('error',$error);

$smarty->display($template_root.'administrator/admin.menu.tpl');

include "admin.footer.php";
?>