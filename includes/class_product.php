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
	//TBL_PRODUCT_IMAGE
	var $image1;
	var $image2;
	var $image3;
	var $image4;
	var $image5;
	
	function __construct(){
		//TBL_PRODUCT
		$this->product_id = 0;
		$this->code = "";
		$this->model = "";
		$this->price = 0;
		$this->price_ny = 0;
		$this->amount = 0;
		$this->weight = "";
		$this->length = "";
		$this->width = "";
		$this->height = "";
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
		//TBL_PRODUCT_IMAGE
		$this->image1 = "";
		$this->image2 = "";
		$this->image3 = "";
		$this->image4 = "";
		$this->image5 = "";
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
	 * Load List font-end
	 */
	public function loadListFontEnd($where = null, $order=null, $start=null, $limit=null){
		global $database;

		if (is_null($order)){
			$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		}else{
			$orderBy = $order;
		}
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.price_ny, p.price , pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
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
				$this->image1		= $objProduct->image1;
				$this->image2		= $objProduct->image2;
				$this->image3		= $objProduct->image3;
				$this->image4		= $objProduct->image4;
				$this->image5		= $objProduct->image5;
				
				//product color
				if ($objProduct->number_color > 0){
					$query = "SELECT color_id, value_color, price_color FROM ".TBL_PRODUCT_COLOR." WHERE product_id=".$objProduct->product_id;
					$results = $database->db_query($query);
					while ($row = $database->db_fetch_assoc($results)){
						$this->colors[] = $row;
					}
				}
				//product discount
				$sql_discount = "SELECT * FROM ".TBL_PRODUCT_DISCOUNT." WHERE product_id=".$objProduct->product_id." LIMIT 1";
				$rsDiscount = $database->db_query($sql_discount);
				while ($rowdiscount = $database->db_fetch_assoc($rsDiscount)){
					$this->discount = $rowdiscount["discount"];
					$this->percent = $rowdiscount["percent"];
					$this->start_date = $rowdiscount["start_date"];
					$this->end_date = $rowdiscount["end_date"];
				}
				
				//product group
				$sql_gr = "SELECT * FROM ".TBL_PRODUCT_GROUP." WHERE product_id=".$objProduct->product_id." LIMIT 1";
				$result_gr = $database->db_query($sql_gr);
				while ($rowgr = $database->db_fetch_assoc($result_gr)){
					$this->is_new 		= $rowgr["is_new"];
					$this->is_hot 		= $rowgr["is_hot"];
					$this->is_special	= $rowgr["is_special"];
					$this->is_seller	= $rowgr["is_seller"];
					$this->is_upcoming	= $rowgr["is_upcoming"];
					$this->is_stock		= $rowgr["is_stock"];
					$this->is_view		= $rowgr["is_view"];
				}
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
		    	'{$objProduct->code}', '{$objProduct->model}', '{$objProduct->price}', '{$objProduct->price_ny}', '{$objProduct->amount}', '{$objProduct->number_color}', '{$objProduct->weight}', '{$objProduct->length}', '{$objProduct->width}', '{$objProduct->height}', '{$objProduct->status}', '{$objProduct->ordering}', '".unFormatDate($objProduct->created,"Y-m-d h:i:s")."', '{$objProduct->admin_created}', '".unFormatDate($objProduct->modified, "Y-m-d h:i:s")."', '{$objProduct->admin_modified}', '{$objProduct->category_id}'
		    )";
      		
      		$query = "INSERT INTO ".TBL_PRODUCT_DESCRIPTION."(
      			name, alias, introtext, `fulltext`, meta_keywords, meta_description, search_words, page_title
      		) VALUES (
      			'{$objProduct->name}', '{$objProduct->alias}', '{$objProduct->introtext}', '{$objProduct->fulltext}', '{$objProduct->meta_keywords}', '{$objProduct->meta_description}', '{$objProduct->search_words}', '{$objProduct->page_title}'
      		)";
      		
      		$queryImage = "INSERT INTO ".TBL_PRODUCT_IMAGE."(
      			image1, image2, image3, image4, image5
      		) VALUES (
      			'{$objProduct->image1}', '{$objProduct->image2}', '{$objProduct->image3}', '{$objProduct->image4}', '{$objProduct->image5}'
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
					created='".unFormatDate($objProduct->created, "Y-m-d h:i:s")."',
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
					image1='{$objProduct->image1}', 
					image2='{$objProduct->image2}',
					image3='{$objProduct->image3}',
					image4='{$objProduct->image4}',
					image5='{$objProduct->image5}'
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
			$database->db_query("DELETE FROM ".TBL_PRODUCT_DESCRIPTION." WHERE ( $cid )");
			$database->db_query("DELETE FROM ".TBL_PRODUCT_COLOR." WHERE ( $cid )");
			$database->db_query("DELETE FROM ".TBL_PRODUCT_DISCOUNT." WHERE ( $cid )");
			$database->db_query("DELETE FROM ".TBL_PRODUCT_GROUP." WHERE ( $cid )");
			//unlink image
			$query = "SELECT * FROM ".TBL_PRODUCT_IMAGE." WHERE ( $cid )";
			$results = $database->db_query($query);
			while ($row = $database->db_fetch_assoc($results)){
				if(file_exists($dir_root.$row["image1"])) @unlink($dir_root.$row["image1"]);		  
				if(file_exists($dir_root.$row["image2"])) @unlink($dir_root.$row["image2"]);
				if(file_exists($dir_root.$row["image3"])) @unlink($dir_root.$row["image3"]);
				if(file_exists($dir_root.$row["image4"])) @unlink($dir_root.$row["image4"]);
				if(file_exists($dir_root.$row["image5"])) @unlink($dir_root.$row["image5"]);
			}
			
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
	
	/*
 	* FONT-END
 	*/
	public function ProducsHotDeal(){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id";
		$where[] = " p.status=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		
		$query = "SELECT category_id, name FROM ".TBL_CATEGORY." WHERE status=1";
		$results_cate = $database->db_query($query);
		$html = "";
		$i = 0;
		while ($rows = $database->db_fetch_assoc($results_cate)){
			$query_count = "SELECT COUNT(*) AS total FROM ".TBL_PRODUCT." WHERE category_id=".$rows["category_id"]." AND status=1";
			$result_count = $database->db_query($query_count);
			$count = $database->getRow($result_count);
			$total = $count["total"];
			if ($total > 0){
				$sql = "SELECT p.product_id, p.category_id, pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm ".$where." AND p.category_id=".$rows["category_id"].$orderBy;
				$results = $database->db_query($sql);
				while ($row = $database->db_fetch_assoc($results)){
					$html .= "<script type='text/javascript'>";
					$html .= "items[".$i."] = {name: '".$row["name"]."', link: 'index.php?dispatch=product.view&product_id=".$row["product_id"]."', image: '".$row["image1"]."', cat_id: '".$row["category_id"]."', width: 75, height: 75};";
					$html .= "</script>\n";
					$i++;
				}
				$html .= '<a name="'.$rows["category_id"].'" class="cm-deals-category">'.$rows["name"].'</a>&nbsp;&nbsp;';
			}
		}
		return $html;
	}
	
	//Load products Special
	public function ProductSpecial($start=null, $limit=null){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=pg.product_id";
		$where[] = " p.status=1";
		$where[] = " pg.is_special=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.price_ny, p.price, pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_PRODUCT_GROUP." AS pg ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		$i=1;
		while ($row = $database->db_fetch_assoc($results)){
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
			$row["stt"]	= $i;
			$lsProducts[] = $row;
			$i++;
		}
		return $lsProducts;
	}
	
	//Load products Seller
	public function ProductSeller($start=null, $limit=null){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=pg.product_id";
		$where[] = " p.status=1";
		$where[] = " pg.is_seller=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.price_ny, p.price, pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_PRODUCT_GROUP." AS pg ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		$i=1;
		while ($row = $database->db_fetch_assoc($results)){
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
			$row["stt"]	= $i;
			$lsProducts[] = $row;
			$i++;
		}
		return $lsProducts;
	}
	
	//Load products viewed
	public function ProductViewed($start=null, $limit=null){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=pg.product_id";
		$where[] = " p.status=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.category_id, p.price_ny, p.price, pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_PRODUCT_GROUP." AS pg ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		$i=1;
		while ($row = $database->db_fetch_assoc($results)){
			$sql = "SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".$row["category_id"]." LIMIT 0,1";
			$result = $database->db_query($sql);
			$field = $database->getRow($result);
			$row["name_cate"] = $field["name"];
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
			$row["stt"]	= $i;
			$lsProducts[] = $row;
			$i++;
		}
		return $lsProducts;
	}
	
	//Load products News
	public function ProductNews($start=null, $limit=null){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=pg.product_id";
		$where[] = " p.status=1";
		$where[] = " pg.is_new=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.price, pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_PRODUCT_GROUP." AS pg ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
			$lsProducts[] = $row;
		}
		return $lsProducts;
	}
	
	//load list products discount
	public function ProductDiscount($start=null, $limit=null){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=pdis.product_id";
		$where[] = " p.status=1";
		$where[] = " pdis.percent>0";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.price, pd.name, pm.image1, pdis.discount, pdis.percent FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_PRODUCT_DISCOUNT." AS pdis ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		$i = 1;
		while ($row = $database->db_fetch_assoc($results)){
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
			$row["stt"]	= $i;
			$row["price_sale"] = $row["price"]-$row["discount"]; 
			$lsProducts[] = $row;
			$i++;
		}
		return $lsProducts;
	}
	
	//load list product of day
	public function Product_of_day(){
		global $database;
		
		$where[] = " p.product_id=pd.product_id AND pd.product_id=pm.product_id AND pm.product_id=pg.product_id";
		$where[] = " p.status=1";
		$where[] = " pg.is_stock=1";
		$where = (count($where) ? ' WHERE '.implode(' AND ', $where) : '');
		$orderBy = " ORDER BY pg.is_view DESC";
		
		$sql = "SELECT p.product_id, p.code, p.price, pd.name, pd.introtext, pm.image1, pg.is_stock FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm, ".TBL_PRODUCT_GROUP." AS pg ".$where.$orderBy." LIMIT 0,1";
		$result = $database->db_query($sql);
		$row = $database->db_fetch_object($result);
		
		return $row;
	}
	
	public function showList($where=null, $order=null, $start=null, $limit=null){
		global $database;
				
		if (is_null($order)){
			$orderBy = " ORDER BY p.ordering ASC, p.created DESC";
		}else{
			$orderBy = $order;
		}
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT p.product_id, p.price, pd.name, pm.image1 FROM ".TBL_PRODUCT." AS p,".TBL_PRODUCT_DESCRIPTION." AS pd, ".TBL_PRODUCT_IMAGE." AS pm ".$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		$i=1;
		while ($row = $database->db_fetch_assoc($results)){
			$row["stt"]	= $i;
			$row["link"] = "index.php?dispatch=product.view&product_id=".$row["product_id"];
			$lsProducts[] = $row;
			$i++;
		}
		return $lsProducts;
	}
	
}

//class color of product
class PGColor{
	//TBL_PRODUCT_COLOR
	var $color_id;
	var $product_id;
	var $name_color;
	var $value_color;
	var $price_color;
	var $show_color;
	
	function __construct(){
		//TBL_PRODUCT_COLOR
		$this->color_id = 0;
		$this->product_id = 0;
		$this->name_color = "";
		$this->value_color = "";
		$this->price_color = 0;
		$this->show_color = 1;
	}
	
	public function save($product_id, $name_color, $value_color, $price_color, $show_hide = null){
		global $database;
    	//echo $show_hide; die;
		if (!is_object($objColor)) $objColor = $this;
		//echo $sql = "INSERT INTO ".TBL_PRODUCT_COLOR."(product_id, name_color, value_color, price_color, show_color) VALUES('{$product_id}', '{$value_color}', '{$value_color}', '{$price_color}', '{$show_hide}')";
		$database->db_query("INSERT INTO ".TBL_PRODUCT_COLOR."(product_id, name_color, value_color, price_color, show_color) VALUES('{$product_id}', '{$value_color}', '{$value_color}', '{$price_color}', '{$show_hide}')");
	}
}


//class discount of product
class PGDiscount{
	//TBL_PRODUCT_DISCOUNT
	var $product_id;
	var $discount;
	var $percent;
	var $start_date;
	var $end_date;
	
	function __construct(){
		//TBL_PRODUCT_DISCOUNT
		$this->product_id = 0;
		$this->discount = 0;
		$this->percent = 0;
		$this->start_date = "";
		$this->end_date = "";
	}
	
	public function save($product_id, $discount, $percent, $start_date, $end_date){
		global $database;
		//echo $product_id; die;
		if ($product_id > 0){
			$sql = "SELECT COUNT(*) AS total FROM ".TBL_PRODUCT_DISCOUNT." WHERE product_id=".$product_id;
			$result = $database->db_query($sql);
			$total = $database->db_fetch_assoc($result);
			$count = $total["total"];
			if ($count == 0)
				$database->db_query("INSERT INTO ".TBL_PRODUCT_DISCOUNT." VALUES (".$product_id.", ".$discount.", ".$percent.", '".unFormatDate($start_date, "Y-m-d h:i:s")."', '".unFormatDate($end_date, "Y-m-d h:i:s")."')");
			else{
				$database->db_query("UPDATE ".TBL_PRODUCT_DISCOUNT." SET discount={".$discount."}, percent={".$percent."}, start_date={'".unFormatDate($start_date, "Y-m-d h:i:s")."'}, end_date={'".unFormatDate($end_date, "Y-m-d h:i:s")."'} WHERE product_id=".$product_id);
			}	
		}
		return;
	}
}

//class group of product
//TBL_PRODUCT_GROUP
class PGGroup{
	var $product_id;
	var $is_new;
	var $is_hot;
	var $is_special;
	var $is_seller;
	var $is_stock;
	var $is_upcoming;
	var $is_view;
	
	function __construct(){
		$this->product_id = 0;
		$this->is_new = 0;
		$this->is_hot = 0;
		$this->is_special = 0;
		$this->is_seller = 0;
		$this->is_upcoming = 0;
		$this->is_stock = 1;
		$this->is_view = 0;
	}
	
	public function save($product_id, $new, $hot, $special, $seller, $upcoming, $stock, $view=null){
		global $database;
		
		if ($product_id > 0){
			$sql = "SELECT COUNT(*) AS total FROM ".TBL_PRODUCT_GROUP." WHERE product_id=".$product_id;
			$result = $database->db_query($sql);
			$total = $database->db_fetch_assoc($result);
			$count = $total["total"];
			if ($count == 0){
				$query = "INSERT INTO ".TBL_PRODUCT_GROUP."
				\n VALUES(".$product_id.", ".$new.", ".$hot.", ".$special.", ".$seller.", ".$upcoming.", ".$stock.", 0)
				";
				$database->db_query($query);
			}else{
				$query = "UPDATE ".TBL_PRODUCT_GROUP."
				\n SET is_new=".$new.", is_hot=".$hot.", is_special=".$special.", is_seller=".$seller.", is_upcoming=".$upcoming.", is_stock=".$stock."
				\n WHERE product_id=".$product_id."
				";
				$database->db_query($query);
			}
		}
		return;
	}
	
	public function upview($product_id){
		global $database;
		$sql = "SELECT is_view FROM ".TBL_PRODUCT_GROUP." WHERE product_id=".$product_id;
		$result = $database->db_query($sql);
		$row = $database->getRow($result);
		$count = $row["is_view"]+1;

		if (!is_null($product_id) && is_numeric($product_id) && ($product_id>0)){
			$sql = "UPDATE ".TBL_PRODUCT_GROUP." SET is_view=".$count." WHERE product_id=$product_id";
			$database->db_query($sql);
		}
		return;
	}
}
?>