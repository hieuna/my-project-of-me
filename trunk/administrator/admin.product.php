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
		$title_alias 		= $database->getEscaped(PGRequest::GetString('name', '', 'POST'));
		$title_seo			= RemoveSign($title_alias);
		$title_seo_en		= str_replace(" ", "-", $title_seo);
		$title_seo_en		= preg_replace('/[^a-z0-9]+/i','-',$title_seo_en)."-".time();
		
		if ($_FILES["img"]["name"] != ""){
            $fileName =  get_new_file_name($_FILES["img"]["name"], $title_seo_en."-image1");
            $dir	=$dir_upload."products/".$fileName;
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir))
            {
            	if ($thisProduct->product_id == 0){
            		$image1 = "image/products/".$fileName;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->image1)) {
					  @unlink($dir_root.$thisProduct->image1);		  
					}
            		$image1 = "image/products/".$fileName;
            	}
            }
            else
            {
            	if ($thisProduct->product_id == 0) $image1 = "";
            	else $image1 = $thisProduct->image1;
            }
		}else{
			$image1 = $thisProduct->image1;
		}
		//file2
		if ($_FILES["img2"]["name"] != ""){
            $fileName2 =  get_new_file_name($_FILES["img2"]["name"], $title_seo_en."-image2");
            $dir2	=$dir_upload."products/".$fileName2;
            if (move_uploaded_file($_FILES["img2"]["tmp_name"], $dir2))
            {
            	if ($thisProduct->product_id == 0){
            		$image2 = "image/products/".$fileName2;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->image2)) {
					  @unlink($dir_root.$thisProduct->image2);		  
					}
            		$image2 = "image/products/".$fileName2;
            	}
            }
            else
            {
            	if ($thisProduct->product_id == 0) $image2 = "";
            	else $image2 = $thisProduct->image2;
            }
		}else{
			$image2 = $thisProduct->image2;
		}
		//file3
		if ($_FILES["img3"]["name"] != ""){
            $fileName3 =  get_new_file_name($_FILES["img3"]["name"], $title_seo_en."-image3");
            $dir3	=$dir_upload."products/".$fileName3;
            if (move_uploaded_file($_FILES["img3"]["tmp_name"], $dir3))
            {
            	if ($thisProduct->product_id == 0){
            		$image3 = "image/products/".$fileName3;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->image3)) {
					  @unlink($dir_root.$thisProduct->image3);		  
					}
            		$image3 = "image/products/".$fileName3;
            	}
            }
            else
            {
            	if ($thisProduct->product_id == 0) $image3 = "";
            	else $image3 = $thisProduct->image3;
            }
		}else{
			$image3 = $thisProduct->image3;
		}
		//file4
		if ($_FILES["img4"]["name"] != ""){
            $fileName4 =  get_new_file_name($_FILES["img4"]["name"], $title_seo_en."-image4");
            $dir4	=$dir_upload."products/".$fileName4;
            if (move_uploaded_file($_FILES["img4"]["tmp_name"], $dir4))
            {
            	if ($thisProduct->product_id == 0){
            		$image4 = "image/products/".$fileName4;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->image4)) {
					  @unlink($dir_root.$thisProduct->image4);		  
					}
            		$image4 = "image/products/".$fileName4;
            	}
            }
            else
            {
            	if ($thisProduct->product_id == 0) $image4 = "";
            	else $image4 = $thisProduct->image4;
            }
		}else{
			$image4 = $thisProduct->image4;
		}
		//file5
		if ($_FILES["img5"]["name"] != ""){
            $fileName5 =  get_new_file_name($_FILES["img5"]["name"], $title_seo_en."-image5");
            $dir5	=$dir_upload."products/".$fileName5;
            if (move_uploaded_file($_FILES["img5"]["tmp_name"], $dir5))
            {
            	if ($thisProduct->product_id == 0){
            		$image5 = "image/products/".$fileName5;
            	}else{
	            	if(file_exists($dir_root.$thisProduct->image5)) {
					  @unlink($dir_root.$thisProduct->image5);		  
					}
            		$image5 = "image/products/".$fileName5;
            	}
            }
            else
            {
            	if ($thisProduct->product_id == 0) $image5 = "";
            	else $image5 = $thisProduct->image5;
            }
		}else{
			$image5 = $thisProduct->image5;
		}
		//var_dump($_FILES);
		//End upload
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
				$objProduct->$key			= $value;
				$objProduct->admin_created	= $admin_id;
				$objProduct->image1 		= $image1;
				$objProduct->image2 		= $image2;
				$objProduct->image3 		= $image3;
				$objProduct->image4 		= $image4;
				$objProduct->image5 		= $image5;
			}
			$objProduct->save($thisProduct);
			if ($product_id == 0) $pro_id = $objProduct->product_info['product_id'];
			else $pro_id = $thisProduct->product_id;
			
			//product color
			$objColor = new PGColor();
			$database->db_query("DELETE FROM ".TBL_PRODUCT_COLOR." WHERE product_id=".$pro_id);
			$i=1;
			while ($i<=$number_color){
				//echo PGRequest::GetCmd('price_color_'.$i, '', 'POST');
				$objColor->save($pro_id, PGRequest::GetCmd('colors_'.$i, '', 'POST'), PGRequest::GetCmd('colors_'.$i, '', 'POST'), PGRequest::GetInt('price_color_'.$i, 0, 'POST'), 1);
				$i++;
			}
			
			//product discount
			if (PGRequest::GetInt('discount', 0, 'POST') > 0){
				$muc_giam 	= PGRequest::GetInt('price', 0, 'POST') - PGRequest::GetInt('discount', 0, 'POST');
				$percent	= ($muc_giam/PGRequest::GetInt('price', 0, 'POST'))*100;
				$start_date = PGRequest::GetVar('start_date', '', 'POST');
				$end_date 	= PGRequest::GetVar('end_date', '', 'POST');
				$objDiscount = new PGDiscount();
				$objDiscount->save($pro_id, PGRequest::GetInt('discount', 0, 'POST'), $percent, $start_date, $end_date);	
			}
			
			//product group
			$is_new 		= PGRequest::GetInt('is_new', 0, 'POST');
			$is_hot 		= PGRequest::GetInt('is_hot', 0, 'POST');
			$is_special 	= PGRequest::GetInt('is_special', 0, 'POST');
			$is_seller		= PGRequest::GetInt('is_seller', 0, 'POST');
			$is_upcoming	= PGRequest::GetInt('is_upcoming', 0, 'POST');
			$is_stock		= PGRequest::GetInt('is_stock', 0, 'POST');
			$objGroup = new PGGroup();
			$objGroup->save($pro_id, $is_new, $is_hot, $is_special, $is_seller, $is_upcoming, $is_stock);
			
		}else{
			$error = $objProduct->is_message;
		}
		cheader($page);
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
		$order = " ORDER BY p.ordering ASC, p.product_id DESC";
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