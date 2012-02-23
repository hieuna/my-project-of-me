<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.category.php";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel') $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		if ($task == 'edit') $page_title = "Cập nhật nhóm sản phẩm";
		else $page_title = "Thêm mới nhóm sản phẩm";
		
		$category_id	= PGRequest::getInt('category_id', 0, 'GET');
		
		$objCategory = new PGCategory();
		$thisCategory = $objCategory->load($category_id);
		$where[] = " status=1";
		if ($task=='add') $where[] = "parent_id>=0";
		else $where[] = " parent_id<=".$thisCategory->parent_id;	
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$order = " ORDER BY ordering ASC, category_id DESC";
		$lsCategory = $objCategory->loadList($where, $order);
		
		$smarty->assign('category_id', $category_id);
		$smarty->assign('thisCategory', $thisCategory);
		$smarty->assign('lsCategory', $lsCategory);
		break;
		
	case 'save':
		$category_id		= PGRequest::getInt('category_id', 0, 'POST');
		$category_id_value	= PGRequest::getInt('category_id_value', 0, 'POST');
		$name				= $database->getEscaped(PGRequest::getString('name', '', 'POST'));
		$alias				= $database->getEscaped(PGRequest::getString('alias', '', 'POST'));
		$description		= $database->getEscaped(PGRequest::getString('description', '', 'POST'));
		$created			= $database->getEscaped(PGRequest::getString('created', ''));
		$status				= PGRequest::GetInt('status', 0, 'POST');
		$ordering			= PGRequest::GetInt('ordering', 0, 'POST');
		
		$objCategory = new PGCategory();
		$thisCategory = $objCategory->load($category_id);
		$objCategory->checkInput($name);
		if (!$objCategory->is_message){
			$objCategory->category_id 	= $category_id_value;
			$objCategory->name			= $name;
			if ($alias != ""){
				$objCategory->alias 	= $alias;
			}else{
				$name_alias				= RemoveSign($name);
				$name_alias				= str_replace(" ", "-", $name_alias);
				$name_alias				= preg_replace('/[^a-z0-9]+/i','-',$name_alias);
				$objCategory->alias 	= $name_alias;
			}
			$objCategory->description	= $description;
			$objCategory->status		= $status;
			$objCategory->created		= $created;
			$objCategory->created_by	= $admin_id;
			$objCategory->ordering		= $ordering;
			$objCategory->parent_id		= $category_id;
			$objCategory->save($thisCategory);
			cheader($page);
		}else{
			$mosmsg = $objCategory->is_message;
		}
		$smarty->assign('mosmsg', $mosmsg);
		break;

	case 'publish':
		$objCategory = new PGCategory();
		$message = $objCategory->published($cid, 1);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'unpublish':
		$objCategory = new PGCategory();
		$message = $objCategory->published($cid, 0);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'remove':
		$objCategory = new PGCategory();
		$objCategory->remove($cid);
		cheader($page);
		break;	
	
	default :
		$page_title = "Danh sách nhóm sản phẩm";
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
		$order = " ORDER BY ordering ASC, created DESC";
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_CATEGORY.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$obCategory =  new PGCategory();
		$lsCategory = $obCategory->loadList($where, $order, $offset, $limit);
		
		$smarty->assign('is_message', $is_message);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsCategory', $lsCategory);
		break;
}

$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign("page", $page);
$smarty->assign('error',$error);

$smarty->display($template_root.'administrator/admin.category.tpl');

include "admin.footer.php";
?>