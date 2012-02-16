<?php
include "admin.header.php";
$task = PGRequest::GetCmd('task', '');
 
if ($task == 'cancel') $task = 'view';
$error = '';
switch($task){
	case 'edit':
	case 'add':
		include ("check.permission.php");
		if ($task == 'edit') $page_title = "Cập nhật khách hàng mua Hot Deal";
		else $page_title = "Thêm mới khách hàng mua Hot Deal";
		
		$id				= PGRequest::GetInt('id', 0, 'GET');
		
		$cus = new PGCustomerHotDeal();
		$thisCus = $cus->load($id);
		
		//show hot deal
		$hotdeal = new PGHotDeal();
		$lsHotDeal = $hotdeal->loadList();
		
		$smarty->assign('thisCus', $thisCus);
		$smarty->assign('lsHotDeal', $lsHotDeal);
		break;
		
	case 'save':
		include ("check.permission.php");
		$name			= $database->getEscaped(PGRequest::getString('name', '', 'POST'));
		$email			= $database->getEscaped(PGRequest::getString('email', '', 'POST'));
		$phone			= $database->getEscaped(PGRequest::getString('phone', '', 'POST'));
		$address		= $database->getEscaped(PGRequest::getString('address', '', 'POST'));
		$date			= unFormatDate($database->getEscaped(PGRequest::getString('date', '')),"Y-m-d h:i:s");
		$price			= intval(PGRequest::GetInt('price', 0, 'POST'));
		$hotdeal_id		= PGRequest::getInt('hotdeal_id', 0, 'POST');
		$is_promotion	= PGRequest::GetInt('is_promotion', 0, 'POST');
		$id				= PGRequest::GetInt('id', 0, 'POST');
		
		$customer = new PGCustomerHotDeal();
		$thisCus = $customer->load($id);
		//$hotdeal->check($category_id, $product_id, $price_hotdeal, $start_date, $end_date);
		if (!$customer->is_error){
			$customer->name			= $name;
			$customer->email		= $email;
			$customer->phone		= $phone;
			$customer->address		= $address;
			$customer->date			= $date;
			$customer->price		= $price;
			$customer->is_promotion	= $is_promotion;
			$customer->hotdeal_id	= $hotdeal_id;
			
			$customer->save($thisCus);
			/*
			if ($thisCus->id == 0){
				$maxid = $customer->loadMaxID();
				$maxcus = $customer->load($maxid);
				$id_max = $maxcus->hotdeal_id;
				$hotdeal = new PGHotDeal();
				$hotdeal->downcount($id_max, 1);
			}*/
			cheader('admin.customer_hotdeal.php');
		}else{
			$error = $customer->is_error;
		}
		break;
	case 'remove':
		include ("check.permission.php");
		$cus = new PGCustomerHotDeal();
		$cus->remove($cid);
		cheader('admin.customer_hotdeal.php');
		break;

	case 'export':
		include ("check.permission.php");
		require_once "../includes/excel/html_to_xls.inc.php";
		$css = file_get_contents("../includes/excel/styles.css");
		$query = "SELECT * FROM ".TBL_CUSTOMER_HOTDEAL." ORDER BY id DESC";
	    $results = $database->db_query($query);
		$aryCus = array();
		while (@$row = $database->db_fetch_assoc($results)){
			$aryCus[] = $row;
		}
		
		$smarty->assign('aryCus', $aryCus);
		$theme = $smarty->fetch($template_root."administrator/admin.export.tpl");
		$excel = new HTML_TO_XLS();
		$excel->setCSS(str_replace('\r\n','',$css));
		$excel->createXls($theme,'danh_sach_khach_mua_hotdeal_'.date("Ymdhis"),true);
		break;	

	default :
		include ("check.permission.php");
		$page_title = "Danh sách khách hàng mua hotdeal";
		
		$search = $database->getEscaped(PGRequest::getString('search', '', 'POST'));
		$filter_status = PGRequest::getInt('filter_status', 3, 'POST');
		$filter_hotdeal = PGRequest::getInt('filter_hotdeal', 0, 'POST');
		$filter_product = PGRequest::getInt('filter_product', 0, 'POST');
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		//CONDITION
		if ($search){
			$where[] = " name LIKE'%$search%' OR email LIKE'%$search%'";
		}
		if ($filter_status == 0) {			
			$where[] = " is_promotion=0";
		}else if ($filter_status == 3){
			$where[] = " is_promotion>=0";			
		}else{
			$where[] = " is_promotion=".$filter_status;
		}
		if ($filter_hotdeal) {
			$where[] = " hotdeal_id=".$filter_hotdeal;
		}
		if ($filter_product) {
			$where[] = " product_id=".$filter_product;
		}
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		
		//GET HOTDEL
		$sql = "SELECT id, title FROM ".TBL_HOTDEAL." WHERE published=1 ORDER BY id DESC";
		$result = $database->db_query($sql);
		while ($hotdeal = $database->db_fetch_assoc($result)){
			$lsHotdeals[] = $hotdeal;
		}
		
		//GET PRODUCT
		$sql = "SELECT p.product_id, p.name FROM ".TBL_PRODUCT_DESC." AS p, ".TBL_CUSTOMER_HOTDEAL." AS c WHERE p.product_id=c.product_id ORDER BY product_id DESC";
		$result = $database->db_query($sql);
		while ($products = $database->db_fetch_assoc($result)){
			$lsProducts[] = $products;
		}
		
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_CUSTOMER_HOTDEAL.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		
		// LAY DANH SACH CHI TIET
		$sql = "SELECT * FROM ".TBL_CUSTOMER_HOTDEAL.$where." ORDER BY id DESC LIMIT $offset, $limit";
		$result = $database->db_query($sql);
		while ($customer = $database->db_fetch_assoc($result)){
			$customers[] = $customer;
		}
		
		$smarty->assign('lsHotdeals', $lsHotdeals);
		$smarty->assign('lsProducts', $lsProducts);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_hotdeal', $filter_hotdeal);
		$smarty->assign('filter_product', $filter_product);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsCus', $customers);
		break;
}

$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign('error',$error);
$smarty->display($template_root.'administrator/admin.customer_hotdeal.tpl');

include "admin.footer.php"
?>