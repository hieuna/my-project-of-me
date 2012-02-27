<?php
include "admin.header.php";
include "check.login.php";

$page = "admin.hotdeal.php";

$task = PGRequest::GetCmd('task', '');
if ($task == 'cancel') $task = 'view';

switch($task){
	case 'edit':
	case 'add':
		include ("check.permission.php");
		if ($task == 'edit') $page_title = "Cập nhật Hot Deal";
		else $page_title = "Thêm mới Hot Deal";
		
		$id				= PGRequest::GetInt('id', 0, 'GET');
		$category_id	= PGRequest::getInt('category_id', 0, 'GET');
		
		$hotdeal = new PGHotDeal();
		$thisHotDeal = $hotdeal->load($id);
		
		//selected category
		$sql = "SELECT name FROM ".TBL_CATEGORY_DESC." WHERE category_id=".$thisBanner->category_id;
		$name_category = $database->db_fetch_object($database->db_query($sql));
		$name_category_banner = $name_category->name;
		
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
			$row["price"] = intval($row["price"]);
			$products[] = $row;
		}
		
		$smarty->assign('thisHotDeal', $thisHotDeal);
		$smarty->assign('category_id', $category_id);
		$smarty->assign('categorys', $categorys);
		$smarty->assign('products', $products);
		$smarty->assign('name_category_banner', $name_category_banner);
		break;
		
	case 'save':
		include ("check.permission.php");
		$category_id	= PGRequest::getInt('category_id', 0, 'POST');
		$category_id_value	= PGRequest::getInt('category_id_value', 0, 'POST');
		$product_id		= PGRequest::GetInt('product_id', 0, 'POST');
		$price_ny		= intval(PGRequest::GetInt('price_ny', 0, 'POST'));
		$price_hotdeal	= PGRequest::GetInt('price_hotdeal', 0, 'POST');
		$title			= $database->getEscaped(PGRequest::getString('title', '', 'POST'));
		$title_feauture	= $database->getEscaped(PGRequest::getString('title_feauture', '', 'POST'));
		$description	= $database->getEscaped(PGRequest::getString('description', '', 'POST'));
		$start_date		= $database->getEscaped(PGRequest::getString('start_date', ''));
		$end_date		= $database->getEscaped(PGRequest::getString('end_date', ''));
		$count			= PGRequest::GetInt('count', 0, 'POST');
		$ct_name		= $database->getEscaped(PGRequest::getString('ct_name', '', 'POST'));
		$ct_phone		= $database->getEscaped(PGRequest::getString('ct_phone', '', 'POST'));
		$ct_yahoo		= $database->getEscaped(PGRequest::getString('ct_yahoo', '', 'POST'));
		$ct_skype		= $database->getEscaped(PGRequest::getString('ct_skype', '', 'POST'));
		$published		= PGRequest::GetInt('published', 0, 'POST');
		$id				= PGRequest::GetInt('id', 0, 'POST');
		$feauture		= $_POST['feauture'];
		
		$total = count($feauture);
		$i = 0;
		$arr_ft = "";
		foreach ($feauture as $fea){
			$i++;
			if ($i == $total) $str = "";
			else $str = "|";
			$arr_ft .= $fea.$str;
		}
		echo $arr_ft;		
		
		//Lấy product trực thuộc để tính giá và giảm giá
		$sql = "SELECT price FROM ".TBL_PRODUCT." WHERE product_id=$product_id";
		$result = $database->db_query($sql);
		$this_product = $database->getRow($result);
		//var_dump($price_product);
		if ($price_ny == 0){
			$price = intval($this_product["price"]);
			if ($price_hotdeal > $price){
				$muc_giam = 0;
				$discount = 0;
			}else{
				$muc_giam = $price - $price_hotdeal;
				$discount = ($muc_giam/$price)*100;	
			}
		}else{
			if ($price_hotdeal > $price_ny){
				$muc_giam = 0;
				$discount = 0;
			}else{
				$muc_giam = $price_ny - $price_hotdeal;
				$discount = ($muc_giam/$price_ny)*100;	
			}
		}
		
		$hotdeal = new PGHotDeal();
		$thisHotDeal = $hotdeal->load($id);
		//Upload file img
		if ($_FILES["img"]["name"] != ""){
            $fileName =  $_FILES["img"]["name"];
            $dir=$dir_upload."hotdeal/".$fileName;
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $dir))
            {
            	if ($thisHotDeal->id == 0){
            		$image = "image/hotdeal/".$fileName;
            	}else{
	            	if(file_exists($dir_root.$thisHotDeal->image)) {
					  @unlink($dir_root.$thisHotDeal->image);		  
					}
            		$image = "image/hotdeal/".$fileName;
            	}
            }
            else
            {
            	if ($thisHotDeal->id == 0){
            		$image = "";
            	}else{
            		$image = $thisHotDeal->image;
            	}
            }	
		}else{
			$image = $thisHotDeal->image;
		}
		//$hotdeal->check($category_id, $product_id, $price_hotdeal, $start_date, $end_date);
		if (!$hotdeal->is_error){
			$hotdeal->category_id 	= $category_id_value;
			$hotdeal->product_id	= $product_id;
			$hotdeal->price_ny		= $price_ny;
			$hotdeal->price_hotdeal	= $price_hotdeal;
			$hotdeal->muc_giam		= $muc_giam;
			$hotdeal->discount		= $discount;
			$hotdeal->title			= $title;
			$hotdeal->title_feauture= $title_feauture;
			$hotdeal->description	= $description;
			$hotdeal->image			= $image;
			$hotdeal->published		= $published;
			$hotdeal->start_date	= $start_date;
			$hotdeal->end_date		= $end_date;
			$hotdeal->count			= $count;
			$hotdeal->feauture		= $arr_ft;
			$hotdeal->ct_name		= $ct_name;
			$hotdeal->ct_phone		= $ct_phone;
			$hotdeal->ct_yahoo		= $ct_yahoo;
			$hotdeal->ct_skype		= $ct_skype;
			$hotdeal->ordering		= 0;
			$hotdeal->save($thisHotDeal);
			cheader('admin.hotdeal.php');
		}else{
			$error = $hotdeal->is_error;
		}
		break;

	case 'publish':
		include ("check.permission.php");
		$hotdeal = new PGHotDeal();
		$message = $hotdeal->published($cid, 1);
		cheader('admin.hotdeal.php?mosmsg='. $message);
		break;

	case 'unpublish':
		include ("check.permission.php");
		$hotdeal = new PGHotDeal();
		$message = $hotdeal->published($cid, 0);
		cheader('admin.hotdeal.php?mosmsg='. $message);
		break;

	case 'remove':
		include ("check.permission.php");
		$hotdeal = new PGHotDeal();
		$hotdeal->remove($cid);
		cheader('admin.hotdeal.php');
		break;
	case 'refresh':
		$id			= PGRequest::GetInt('id', 0, 'GET');
		$hotdeal = new PGHotDeal();
		$hotdeal->refresh($id);
		cheader('admin.hotdeal.php');
		break;		
	
	default :
		$date = date("Y-m-d h:s:i");
		$now = strtotime($date);
		include ("check.permission.php");
		$page_title = "Danh sách Hot Deal";
		$mosmsg		= strval( ( stripslashes( strip_tags( PGRequest::getString('mosmsg', $mosmsg, '') ) ) ) );
		
		$filter_status = PGRequest::getInt('filter_status', 3, 'POST');
		$search = strtolower( PGRequest::getCmd('search', '', 'POST') );
		
		$p = PGRequest::getInt('p', 1, 'POST');
		$limit = PGRequest::getInt('limit', $setting['setting_list_limit'], 'POST');
		
		//CONDITION
		if ($search){
			$where[] = " title LIKE'%$search%'";
		}
		if ($filter_status == 0) {			
			$where[] = " published=0";
		}else if ($filter_status == 3){
			$where[] = " published>=0";			
		}else{
			$where[] = " published=".$filter_status;
		}
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		// GET THE TOTAL NUMBER OF RECORDS
		$query = "SELECT COUNT(*) AS total FROM ".TBL_HOTDEAL.$where;
		$results = $database->db_fetch_assoc($database->db_query($query));
		// PHAN TRANG
		$pager = new pager($limit, $results['total'], $p);
		$offset = $pager->offset;
		// LAY DANH SACH CHI TIET
		$sql = "SELECT * FROM ".TBL_HOTDEAL.$where." ORDER BY ordering ASC, id DESC LIMIT $offset, $limit";
		$result = $database->db_query($sql);
		while ($hotdeal = $database->db_fetch_assoc($result)){
			//echo strtotime($hotdeal["end_date"])."<br />";
			if($now > strtotime($hotdeal["end_date"])){
				$database->db_query("UPDATE ".TBL_HOTDEAL." SET published=0 WHERE id=".$hotdeal["id"]);
			}
			$query = "SELECT p.price AS price_ny, pd.name AS namesp, pm.image AS imagesp, c.image AS image_cat, cd.name AS name_cat"
					."\n FROM ".TBL_PRODUCT." AS p, ".TBL_PRODUCT_DESC." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_CATEGORY." AS c, ".TBL_CATEGORY_DESC." AS cd, ".TBL_PRODUCT_CATEGORY." AS pc"
					."\n WHERE p.product_id=pd.product_id AND p.product_id=pm.product_id AND p.product_id=pc.product_id AND pc.category_id=c.category_id AND pc.category_id=cd.category_id AND p.product_id=".$hotdeal["product_id"]
					." LIMIT 1"
					;
			$result2 = $database->db_query($query);
			$this_field = $database->getRow($result2);
			
			$query3 = "SELECT COUNT(*) AS total FROM ".TBL_CUSTOMER_HOTDEAL." WHERE hotdeal_id=".$hotdeal["id"];
			$result3 = $database->db_query($query3);
			$total = $database->getRow($result3);

			$hotdeal["price"] 		= intval($this_field["price_ny"]);
			$hotdeal["name"]		= $this_field["namesp"];
			$hotdeal["imagesp"] 	= $this_field["imagesp"];
			$hotdeal["image_cat"]	= $this_field["image_cat"];
			$hotdeal["name_cat"]	= $this_field["name_cat"];
			$hotdeal["ft"]			= explode("|", $hotdeal["feauture"]);
			$i++;
			$hotdeal["stt"]			= ($i+1)%2;
			$hotdeal["da_mua"]		= $total["total"];
			$hotdeal["con_lai"]		= intval($hotdeal["count"] - $hotdeal["da_mua"]); 
			$hotdeals[] = $hotdeal;
		}
		
		$smarty->assign('mosmsg', $mosmsg);
		$smarty->assign('filter_status', $filter_status);
		$smarty->assign('filter_group', $filter_group);
		$smarty->assign('search', $search);
		$smarty->assign('datapage', $pager->page_link());
		$smarty->assign('p', $p);
		$smarty->assign('lsHotDeal', $hotdeals);
		break;
}

$smarty->assign('page'. $page);
$smarty->assign('task', $task);
$smarty->assign("page_title", $page_title);
$smarty->assign('error',$error);

$smarty->display($template_root.'administrator/admin.hotdeal.tpl');

include "admin.footer.php";
?>