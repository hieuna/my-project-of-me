<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.banner.php";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel') $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		if ($task == 'edit') $page_title = "Cập nhật Banner";
		else $page_title = "Thêm mới Banner";
		
		$banner_id				= PGRequest::GetInt('banner_id', 0, 'GET');
		$banner_web				= PGRequest::getInt('banner_web', 0, 'GET');
		$banner_id				= PGRequest::GetInt('banner_id', 0, 'GET');
		$category_id			= PGRequest::getInt('category_id', 0, 'GET');
		$product_id				= PGRequest::getInt('product_id', 0, 'GET');
		
		//show category product
		$sql = "SELECT c.category_id, cd.name FROM category AS c, category_description AS cd WHERE c.category_id=cd.category_id AND c.status=1 ORDER BY c.category_id";
		$results = $database->db_query($sql);
		while ($rowcat = $database->db_fetch_assoc($results)){
			$categorys[] = $rowcat;
		}
		//show list product
		if ($category_id > 0 ){
			$condition = " AND pc.category_id=".$category_id;
		}else{
			$condition = "";
		}
		$sql = "SELECT p.product_id AS product_id, p.price AS price, p.image AS image, d.name AS name FROM product AS p, product_description AS d, product_to_category AS pc WHERE p.product_id=d.product_id AND p.product_id=pc.product_id".$condition." ORDER BY d.name ASC";
    	$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$products[] = $row;
		}
		
		$banner = new PGBanner();
		$thisBanner = $banner->load($banner_id);
		//selected category
		$sql = "SELECT name FROM ".TBL_CATEGORY_DESC." WHERE category_id=".$thisBanner->category_id;
		$name_category = $database->db_fetch_object($database->db_query($sql));
		$name_category_banner = $name_category->name;
		
		$smarty->assign('task', $task);
		$smarty->assign('banner_id', $banner_id);
		$smarty->assign('category_id', $category_id);
		$smarty->assign('product_id', $product_id);
		$smarty->assign('categorys', $categorys);
		$smarty->assign('products', $products);
		$smarty->assign('thisBanner', $thisBanner);
		$smarty->assign('name_category_banner', $name_category_banner);
		break;
		
	case 'save':
		$banner_web			= PGRequest::getInt('banner_web', 0, 'POST');
		$banner_url			= $database->getEscaped(PGRequest::getString('banner_url', '', 'POST'));
		$banner_page		= $database->getEscaped(PGRequest::getString('banner_page', '', 'POST'));
		$banner_position	= $database->getEscaped(PGRequest::getString('banner_position', '', 'POST'));
		$banner_create		= unFormatDate($database->getEscaped(PGRequest::getString('banner_create', '')),"Y-m-d h:i:s");
		$banner_status		= PGRequest::GetInt('banner_status', 0, 'POST');
		$banner_title		= $database->getEscaped(PGRequest::getString('banner_title', '', 'POST'));
		$banner_description	= $database->getEscaped(PGRequest::getString('banner_description', '', 'POST'));
		$banner_id			= PGRequest::GetInt('banner_id', 0, 'POST');
		$category_id		= PGRequest::getInt('category_id', 0, 'POST');
		$category_id_value	= PGRequest::getInt('category_id_value', 0, 'POST');
		$product_id			= PGRequest::getInt('product_id', 0, 'POST');
		
		$banner = new PGBanner();
		$thisBanner = $banner->load($banner_id);
		$is_message = $banner->check_input_banner($banner_web, $banner_title);
		
		if (!$is_message){
			//Upload file img
			if ($_FILES["image"]["name"] != ""){
	            $fileName =  $_FILES["image"]["name"];
	            $dir=$dir_upload."banners/".$fileName;
	            if (move_uploaded_file($_FILES["image"]["tmp_name"], $dir))
	            {
	            	if ($thisBanner->banner_id == 0){
	            		$image = "image/banners/".$fileName;
	            	}else{
		            	if(file_exists($dir_root.$thisBanner->banner_image)) {
						  @unlink($dir_root.$thisBanner->banner_image);		  
						}
	            		$image = "image/banners/".$fileName;
	            	}
	            }
	            else
	            {
	            	if ($thisBanner->banner_id == 0){
	            		$image = "";
	            	}else{
	            		$image = $thisBanner->banner_image;
	            	}
	            }	
			}else{
				$image = $thisBanner->banner_image;
			}
			
			$banner->banner_web 		= $banner_web;
			$banner->banner_image		= $image;
			$banner->banner_url			= $banner_url;
			$banner->banner_status		= $banner_status;
			$banner->banner_web			= $banner_web;
			$banner->banner_page		= $banner_page;
			$banner->banner_position	= $banner_position;
			$banner->banner_title		= $banner_title;
			$banner->banner_description	= $banner_description;
			$banner->banner_create		= $banner_create;
			$banner->category_id		= $category_id_value;
			$banner->product_id			= $product_id;
			$banner->save($thisBanner);
			cheader('admin.banner.php');
		}else{
			$smarty->assign('is_message', $is_message);
		}
		break;

	case 'publish':
		$banner = new PGBanner();
		$message = $banner->published($cid, 1);
		cheader('admin.banner.php?is_message='. $message);
		break;

	case 'unpublish':
		$banner = new PGBanner();
		$message = $banner->published($cid, 0);
		cheader('admin.banner.php?is_message='. $message);
		break;

	case 'remove':
		$banner= new PGBanner();
		$banner->remove($cid);
		cheader('admin.banner.php');
		break;	
	
	default :
		$page_title = "Danh sách Banner";
		
		$filter_status = PGRequest::getInt('filter_status', 3, 'POST');
		$search = $database->getEscaped(PGRequest::getString('search', '', 'POST'));
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		//CONDITION
		if ($search){
			$where[] = " banner_title LIKE'%$search%'";
		}
		if ($filter_status == 0) {			
			$where[] = " banner_status=0";
		}else if ($filter_status == 3){
			$where[] = " banner_status>=0";			
		}else{
			$where[] = " banner_status=".$filter_status;
		}
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_HOTDEAL.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$banner =  new PGBanner();
		$lsBanner = $banner->loadList($where, $offset, $limit);
		
		$smarty->assign('is_message', $is_message);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsBanner', $lsBanner);
		break;
}

$smarty->assign('page', $page);
$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign('is_message',$is_message);
$smarty->display($template_root.'administrator/admin.banner.tpl');

include "admin.footer.php";
?>