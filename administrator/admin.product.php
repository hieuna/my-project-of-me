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
		$number_color	= PGRequest::getInt('number_color', 0, 'POST');
		
		$objProduct = new PGProduct();
		$thisProduct = $objProduct->load($product_id);
		
		//Upload file img
		if ($_FILES["img"]["name"] != ""){
            $fileName =  $_FILES["img"]["name"];
            $dir_large	=$dir_upload."products/large/".$fileName;
            $dir_medium	= $dir_upload."products/medium/".$fileName;
            $dir_small	= $dir_upload."products/small/".$fileName;
            //large image
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir_large))
            {
            	if ($thisProduct->product_id == 0){
            		$large_image = "image/products/large/".$fileName;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->large_image)) {
					  @unlink($dir_root.$thisProduct->large_image);		  
					}
            		$large_image= "image/products/large/".$fileName;
            	}
            }
            else
            {
            	if ($thisProduct->product_id == 0) $large_image = "";
            	else $large_image = $thisProduct->large_image;
            }
			//medium image
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir_medium))
            {
            	if ($thisProduct->product_id == 0){
            		$large_image = "image/products/medium/".$fileName;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->medium_image)) {
					  @unlink($dir_root.$thisProduct->medium_image);		  
					}
            		$large_image= "image/products/medium/".$fileName;
            	}
            	Resize_File($_FILES["img"]["tmp_name"], $dir_medium, _WIDTH_MEDIUM_IMAGE_PRODUCT);
            }
            else
            {
            	if ($thisProduct->product_id == 0) $medium_image = "";
            	else $medium_image = $thisProduct->medium_image;
            }
			//small image
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir_small))
            {
            	if ($thisProduct->product_id == 0){
            		$large_image = "image/products/small/".$fileName;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->small_image)) {
					  @unlink($dir_root.$thisProduct->small_image);		  
					}
            		$large_image= "image/products/small/".$fileName;
            	}
            	Resize_File($_FILES["img"]["tmp_name"], $dir_small, _WIDTH_SMALL_IMAGE_PRODUCT);
            }
            else
            {
            	if ($thisProduct->product_id == 0) $small_image = "";
            	else $small_image = $thisProduct->small_image;
            }	
		}else{
			$large_image = $thisProduct->large_image;
			$medium_image = $thisProduct->medium_image;
			$small_image = $thisProduct->small_image;
		}
		if (!$objProduct->is_message){
			foreach ($_POST as $key =>$value) {
				//echo $key."&nbsp;".$value."<br />";
				if ($key == 'alias' && $value != ""){
					$name_alias 		= $value;
					$objProduct->alias 	= $name_alias;
				}else{
					if ($key == 'name'){
						$name_alias			= RemoveSign($value);
						$name_alias			= str_replace(" ", "-", $name_alias);
						$name_alias			= preg_replace('/[^a-z0-9]+/i','-',$name_alias);
					}
					$objProduct->alias 	= $name_alias;
				}
				$objProduct->$key		= $value;
				$objProduct->admin_created	= $admin_id;
				$objProduct->large_image = $large_image;
				$objProduct->medium_image = $medium_image;
				$objProduct->small_image = $small_image;
			}
			$objProduct->save($thisProduct);
			$objColor = new PGColor();
			for ($i=1; $i<=$number_color; $i++){
				//echo PGRequest::GetCmd('colors_'.$i, '', 'POST');
				$objColor->save($objProduct->product_info['product_id'], PGRequest::GetCmd('colors_'.$i, '', 'POST'), '#'.PGRequest::GetCmd('colors_'.$i, '', 'POST'));
			}
			cheader($page);
		}else{
			$error = $objProduct->is_message;
		}
		break;

	case 'publish':
		$objProduct = new PGProduct();
		$message = $objProduct->published($cid, 1);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'unpublish':
		$objProduct = new PGProduct();
		$message = $objProduct->published($cid, 0);
		cheader($page.'?mosmsg='. $message);
		break;

	case 'remove':
		$objProduct = new PGProduct();
		$objProduct->remove($cid);
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