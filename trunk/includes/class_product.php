<?php
/*
 * Version: 1.0
 * Code By: Kiều Văn Ngọc
 * Email: ngockv@gmail.com
 * Mobile: 097.8686.055
 * Website:
 * Name Table Defined: TBL_PRODUCT
 */
class PGProduct{
	var $is_message;
	var $product_info;
	
	//TBL_PRODUCT
	var $product_id;
	var $code;
	var $model;
	var $price;
	var $price_ny;
	var $amount;
	var $weight;
	var $length;
	var $width;
	var $height;
	var $number_color;
	var $status;
	var $ordering;
	var $created;
	var $admin_created;
	var $modified;
	var $admin_modified;
	var $category_id;
	//TBL_PRODUCT_DESCRIPTION
	var $name;
	var $alias;
	var $introtext;
	var $fulltext;
	var $meta_keywords;
	var $meta_description;
	var $search_words;
	var $page_title;
	//TBL_PRODUCT_DISCOUNT
	var $discount;
	var $percent;
	//TBL_PRODUCT_IMAGE
	var $small_image;
	var $medium_image;
	var $large_image;
	
	function __construct(){
		//TBL_PRODUCT
		$this->product_id = 0;
		$this->code = "";
		$this->model = "";
		$this->price = 0;
		$this->price_ny = 0;
		$this->amount = 0;
		$this->weight = 0;
		$this->length = 0;
		$this->width = 0;
		$this->height = 0;
		$this->number_color = 0;
		$this->status = 1;
		$this->ordering = 0;
		$this->created = date("Y-m-d h:i:s");
		$this->admin_created = 0;
		$this->modified = "";
		$this->admin_modified = 0;
		$this->category_id = 0;
		//TBL_PRODUCT_DESCRIPTION
		$this->name = "";
		$this->alias = "";
		$this->introtext = "";
		$this->fulltext = "";
		$this->meta_keywords = "";
		$this->meta_description = "";
		$this->search_words = "";
		$this->page_title = "";
		//TBL_PRODUCT_DISCOUNT
		$this->discount = 0;
		$this->percent = 0;
		//TBL_PRODUCT_IMAGE
		$this->small_image = "";
		$this->medium_image = "";
		$this->large_image = "";
	}
	
	/*
	 * Load list fields
	 * $where : Điều Kiện câu truy vấn
	 * $order: Điều kiện sắp xếp câu truy vấn
	 * $start, $limit: LIMIT cho câu truy vấn
	 */
	public function loadList($where = null, $order=null, $start=null, $limit=null){
		global $database;

		if (is_null($order)){
			$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		}else{
			$orderBy = $order;
		}
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.*, pd.name FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd " .$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$res_created = $database->db_query("SELECT admin_name FROM ".TBL_ADMIN." WHERE admin_id=".$row["admin_created"]);
			$this_user_create = $database->getRow($res_created);
			$res_created2 = $database->db_query("SELECT admin_name FROM ".TBL_ADMIN." WHERE admin_id=".$row["admin_modified"]);
			$this_user_create2 = $database->getRow($res_created2);
			$res_cate = $database->db_query("SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".$row["category_id"]);
			$thisCategory = $database->getRow($res_cate);
			
			$row['name_created'] = $this_user_create["admin_name"];
			$row['admin_modified'] = $this_user_create2["admin_name"];
			$row["name_category"] = $thisCategory["name"];
			
			$lsProducts[] = $row;
		}
		
		return $lsProducts;
	}
	
	/*
	 * Load field
	 * $product_id : ID of field
	 */
	public function load($product_id = null){
		global $database;
		if (!is_null($product_id) && is_numeric($product_id) && ($product_id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_PRODUCT." AS p, ".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm WHERE p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=$product_id LIMIT 1");
			if ($objProduct = $database->db_fetch_object($result)){
				//TBL_PRODUCT
				$this->product_id		= $objProduct->product_id;
				$this->code				= $objProduct->code;
				$this->model			= $objProduct->model;
				$this->price			= $objProduct->price;
				$this->price_ny			= $objProduct->price_ny;
				$this->amount			= $objProduct->amount;
				$this->weight			= $objProduct->weight;
				$this->length			= $objProduct->length;
				$this->width			= $objProduct->width;
				$this->height			= $objProduct->height;
				$this->number_color		= $objProduct->number_color;
				$this->status			= $objProduct->status;
				$this->ordering			= $objProduct->ordering;
				$this->created			= $objProduct->created;
				$this->admin_created	= $objProduct->admin_created;
				$this->modified			= $objProduct->modified;
				$this->admin_modified	= $objProduct->admin_modified;
				$this->category_id		= $objProduct->category_id;
				
				//TBL_PRODUCT_DESCRIPTION
				$this->name				= $objProduct->name;
				$this->alias			= $objProduct->alias;
				$this->introtext		= $objProduct->introtext;
				$this->fulltext			= $objProduct->fulltext;
				$this->meta_keywords	= $objProduct->meta_keywords;
				$this->meta_description	= $objProduct->meta_description;
				$this->search_words		= $objProduct->search_words;
				$this->page_title		= $objProduct->page_title;
				
				//TBL_PRODUCT_IMAGE
				$this->small_image		= $objProduct->small_image;
				$this->medium_image		= $objProduct->medium_image;
				$this->large_image		= $objProduct->large_image;
			}
		}
		return $this;
	}
	
	/*
	 * Save Product
	 * Truyền các trường bằng tham số
	 * VD: $objProduct->name = "Kiều Văn Ngọc";
	 * $objProduct->model = "Nokia";
	 * $objProduct->code = "ABR8F97";
	 */
	public function save($objProduct = null){
		global $database, $setting, $datetime, $admin_id;
    
		if (!is_object($objProduct)) $objProduct = $this;

		if (!isset($objProduct->product_id) || is_null($objProduct->product_id) || ($objProduct->product_id==0)){
      		$sql = "INSERT INTO ".TBL_PRODUCT." (
		        code, model, price, price_ny, amount, number_color, weight, length, width, height, status, ordering, created, admin_created, modified, admin_modified, category_id
		    ) VALUES (
		    	'{$objProduct->code}', '{$objProduct->model}', '{$objProduct->price}', '{$objProduct->price_ny}', '{$objProduct->amount}', '{$objProduct->number_color}', '{$objProduct->weight}', '{$objProduct->length}', '{$objProduct->width}', '{$objProduct->height}', '{$objProduct->status}', '{$objProduct->ordering}', '{$objProduct->created}', '{$objProduct->admin_created}', '{$objProduct->modified}', '{$objProduct->admin_modified}', '{$objProduct->category_id}'
		    )";
      		
      		$query = "INSERT INTO ".TBL_PRODUCT_DESCRIPTION."(
      			name, alias, introtext, `fulltext`, meta_keywords, meta_description, search_words, page_title
      		) VALUES (
      			'{$objProduct->name}', '{$objProduct->alias}', '{$objProduct->introtext}', '{$objProduct->fulltext}', '{$objProduct->meta_keywords}', '{$objProduct->meta_description}', '{$objProduct->search_words}', '{$objProduct->page_title}'
      		)";
      		
      		$queryImage = "INSERT INTO ".TBL_PRODUCT_IMAGE."(
      			small_image, medium_image, large_image
      		) VALUES (
      			'{$objProduct->small_image}', '{$objProduct->medium_image}', '{$objProduct->large_image}'
      		)";
      		
	      	if ($database->db_query($sql) && $database->db_query($query) && $database->db_query($queryImage)) $this->is_message = "Thêm mới sản phẩm thành công !";
	      	else $this->is_message = "Không thêm được sản phẩm !";
	      	//Lay Product ID
			$product_id = $database->db_insert_id();
			$this->product_info = $database->db_fetch_assoc($database->db_query("SELECT * FROM ".TBL_PRODUCT." WHERE product_id='{$product_id}' LIMIT 1"));
		}else{
			$sql = "UPDATE ".TBL_PRODUCT." SET 
					code='{$objProduct->code}', 
					model='{$objProduct->model}',
					price='{$objProduct->price}',
					price_ny='{$objProduct->price_ny}',
					amount='{$objProduct->amount}',
					number_color='{$objProduct->number_color}',
					weight='{$objProduct->weight}',
					length='{$objProduct->length}',
					width='{$objProduct->width}',
					height='{$objProduct->height}',
					status='{$objProduct->status}',
					ordering='{$objProduct->ordering}',
					created='{$objProduct->created}',
					modified='".date("Y-m-d h:i:s")."',
					admin_modified='{$admin_id}',
					category_id='{$objProduct->category_id}'
					WHERE product_id='{$objProduct->product_id}' LIMIT 1";
			
			$query = "UPDATE ".TBL_PRODUCT_DESCRIPTION." SET 
					name='{$objProduct->name}', 
					alias='{$objProduct->alias}',
					introtext='{$objProduct->introtext}',
					`fulltext`='{$objProduct->fulltext}',
					meta_keywords='{$objProduct->meta_keywords}',
					meta_description='{$objProduct->meta_description}',
					search_words='{$objProduct->search_words}',
					page_title='{$objProduct->page_title}'
					WHERE product_id='{$objProduct->product_id}' LIMIT 1";
			
			$queryImage = "UPDATE ".TBL_PRODUCT_IMAGE." SET 
					small_image='{$objProduct->small_image}', 
					medium_image='{$objProduct->medium_image}',
					large_image='{$objProduct->large_image}'
					WHERE product_id='{$objProduct->product_id}' LIMIT 1";
			if ($database->db_query($sql) && $database->db_query($query) && $database->db_query($queryImage)) $this->is_message = "Cập nhật sản phẩm thành công !";
		}
		return true;
	}
	
	/*
	 * Remove Product
	 */
	public function remove($cid = null){
		global $database;
		if (!is_array($cid)){
			$this->error = 'Tham số truyền vào không tồn tại !';
		}else{
			$total = count( $cid );
			if ( $total < 1) {
				echo "<script> alert('Lựa chọn một mục để xóa !'); window.history.go(-1);</script>\n";
				exit;
			}
			mosArrayToInts( $cid );
			$cids = 'product_id=' . implode( ' OR product_id=', $cid );
			$sql = "DELETE FROM ".TBL_PRODUCT." WHERE ( $cids )";
			$database->db_query($sql);
			
			$this->is_message = 'Đã xóa '.$total.' sản phẩm thành công !';
		}
		
		return $this->is_message;
	}
	
	/*
	 * Publish and unpublish Product
	 */
	public function published($cid, $published = 0){
		global $database;
		if (count( $cid ) < 1) {
			$action = $published == 1 ? 'Mở khóa' : 'Khóa';
			echo "<script> alert('Chọn một sản phẩm để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'product_id=' . implode( ' OR product_id=', $cid );
		
		$database->db_query("UPDATE ".TBL_PRODUCT." SET status=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$this->is_message = $total .' sản phẩm đã hiển thị thành công !';
				break;
	
			case 0:
			default:
				$this->is_message = $total .' sản phẩm đã ẩn thành công !';
				break;
		}
		
		return $this->is_message;
	}
}

//class color of product
class PGColor{
	//TBL_PRODUCT_COLOR
	var $name_color;
	var $value_color;
	var $price_color;
	var $show_color;
	
	function __construct(){
		//TBL_PRODUCT_COLOR
		$this->name_color = "";
		$this->value_color = "";
		$this->price_color = 0;
		$this->show_color = 1;
	}
	
	function save($product_id, $value_color, $price_color, $show_hide = null){
		global $database;
    
		if (!is_object($objColor)) $objColor = $this;
		echo $product_id;
		if ($product_id>0){
			for ($i=0; $i<=$number; $i++){
				$database->db_query("INSERT INTO ".TBL_PRODUCT_COLOR." VALUES('{$product_id}', '{$value_color}', '#{$value_color}', '{$price_color}', '{$show_hide}')");
			}
		}
	}
}
?>