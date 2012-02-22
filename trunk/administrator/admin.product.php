<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.product.php";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel') $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		if ($task == 'edit') $page_title = "Cập nhật sản phẩm";
		else $page_title = "Thêm mới sản phẩm";
		
		$product_id	= PGRequest::getInt('product_id', 0, 'GET');
		
		$objProduct = new PGProduct();
		$thisProduct = $objProduct->load($product_id);
		
		//show category
		$where[] = " status=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$order = " ORDER BY ordering ASC, category_id DESC";
		
		$objCategory = new PGCategory();
		$lsCategory = $objCategory->loadList($where, $order);
		
		$smarty->assign('product_id', $product_id);
		$smarty->assign('thisProduct', $thisProduct);
		$smarty->assign('lsCategory', $lsCategory);
		break;
		
	case 'save':
		$product_id		= PGRequest::getInt('product_id', 0, 'POST');
		
		$objProduct = new PGProduct();
		$thisProduct = $objProduct->load($product_id);
		if (!$objProduct->is_message){
			foreach ($_POST as $key =>$value) {
				//echo $key."&nbsp;".$value."<br />";
				if ($objProduct->key == 'alias'){
					if ($objProduct->key != ""){
						$objProduct->alias 	= $objProduct->key;
					}else{
						if ($objProduct->key == 'name'){
							$name_alias			= RemoveSign($objProduct->key);
							$name_alias			= str_replace(" ", "-", $name_alias);
							$name_alias			= preg_replace('/[^a-z0-9]+/i','-',$name_alias);
							$objProduct->alias 	= $name_alias;
						}
					}
				}
				$objProduct->key	= $value;
			}
			$objProduct->save($thisProduct);
			cheader($page);
		}else{
			$error = $objProduct->is_message;
		}
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
		$page_title = "Danh sách sản phẩm";
		$mosmsg		= strval( ( stripslashes( strip_tags( PGRequest::getString('mosmsg', $mosmsg, '') ) ) ) );
		
		$filter_status = PGRequest::getInt('filter_status', 3, 'POST');
		$search = strtolower( PGRequest::getCmd('search', '', 'POST') );
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		//CONDITION
		$where[] = " p.product_id = pd.product_id";
		if ($search){
			$where[] = " pd.name LIKE'%$search%'";
		}
		if ($filter_status == 0) {			
			$where[] = " p.status=0";
		}else if ($filter_status == 3){
			$where[] = " p.status>=0";			
		}else{
			$where[] = " p.status=".$filter_status;
		}
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$order = " ORDER BY p.ordering ASC, p.created DESC";
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_PRODUCT." AS p, ".TBL_PRODUCT_DESCRIPTION." AS pd".$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$objProduct =  new PGProduct();
		$lsProducts = $objProduct->loadList($where, $order, $offset, $limit);
		
		$smarty->assign('is_message', $is_message);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsProducts', $lsProducts);
		break;
}

$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign("page", $page);
$smarty->assign('error',$error);

$smarty->display($template_root.'administrator/admin.product.tpl');

include "admin.footer.php";
?>