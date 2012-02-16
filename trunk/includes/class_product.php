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
	
	var $product_id;
	var $name;
	var $code;
	var $model;
	var $slogan;
	var $intro;
	var $description;
	var $meta_keywords;
	var $price;
	var $price_ny;
	var $image;
	var $state;
	var $ordering;
	var $created;
	var $admin_created;
	var $modified;
	var $admin_modified;
	var $hot;
	var $new;
	
	function __construct(){
		$this->product_id = 0;
		$this->name = "";
		$this->code = "";
		$this->model = "";
		$this->slogan = "";
		$this->intro = "";
		$this->description = "";
		$this->meta_keywords = "";
		$this->price = 0;
		$this->price_ny = 0;
		$this->image = "";
		$this->state = 1;
		$this->ordering = 0;
		$this->created = "";
		$this->admin_created = 0;
		$this->modified = "";
		$this->admin_modified = 0;
		$this->hot = 0;
		$this->new = 0;
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
			$orderBy = "\n ORDER BY ordering ASC, created DESC";
		}else{
			$orderBy = $order;
		}
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = "\n LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT * FROM ".TBL_PRODUCT.$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$res = $database->db_query("SELECT admin_name FROM ".TBL_ADMIN." WHERE admin_id=".$row["admin_created"]);
			$this_user_create = $database->getRow($res);
			$row['name_created'] = $this_user_create["admin_name"];
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
			$result = $database->db_query("SELECT * FROM ".TBL_PRODUCT." WHERE product_id=$product_id LIMIT 1");
			if ($objProduct = $database->db_fetch_object($result)){
				$this->product_id		= $objProduct->product_id;
				$this->name				= $objProduct->name;
				$this->code				= $objProduct->code;
				$this->model			= $objProduct->model;
				$this->slogan			= $objProduct->slogan;
				$this->intro			= $objProduct->intro;
				$this->description		= $objProduct->description;
				$this->meta_keywords	= $objProduct->meta_keywords;
				$this->price			= $objProduct->price;
				$this->price_ny			= $objProduct->price_ny;
				$this->image			= $objProduct->image;
				$this->state			= $objProduct->state;
				$this->ordering			= $objProduct->ordering;
				$this->created			= $objProduct->created;
				$this->admin_created	= $objProduct->admin_created;
				$this->modified			= $objProduct->modified;
				$this->admin_modified	= $objProduct->admin_modified;
				$this->hot				= $objProduct->hot;
				$this->new				= $objProduct->new;	
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
      			name,
		        code,
		        model,
		        slogan,
		        intro,
        		description,
		        meta_keywords,
		        price,
		        price_ny,
		        image,
		        state,
		        ordering,
		        created,
		        admin_created,
		        modified,
		        admin_modified,
		        hot,
		        new
		    ) VALUES (
		    	'{$objProduct->name}',
		    	'{$objProduct->code}',
		        '{$objProduct->model}',
		        '{$objProduct->slogan}',
		        '{$objProduct->intro}',
		        '{$objProduct->description}',
		        '{$objProduct->meta_keywords}',
		        '{$objProduct->price}',
		        '{$objProduct->price_ny}',
		        '{$objProduct->image}',
		        '{$objProduct->state}',
		        '{$objProduct->ordering}',
		        '{$objProduct->created}',
		        '{$objProduct->admin_created}',
		        '{$objProduct->modified}',
		        '{$objProduct->admin_modified}',
		        '{$objProduct->hot}',
		        '{$objProduct->new}'
		    )";
	      	if ($database->db_query($sql)) $this->is_message = "Thêm mới sản phẩm thành công !";	
		}else{
			$sql = "UPDATE ".TBL_PRODUCT." SET 
					name='{$objProduct->name}', 
					code='{$objProduct->code}', 
					model='{$objProduct->model}',
					slogan='{$objProduct->slogan}',
					intro='{$objProduct->intro}',
					description='{$objProduct->description}',
					meta_keywords='{$objProduct->meta_keywords}',
					price='{$objProduct->price}',
					price_ny='{$objProduct->price_ny}',
					image='{$objProduct->image}',
					state='{$objProduct->state}',
					ordering='{$objProduct->ordering}',
					created='{$objProduct->created}',
					admin_created='{$objProduct->admin_created}',
					modified='{$objProduct->modified}',
					admin_modified='{$objProduct->admin_modified}',
					hot='{$objProduct->hot}',
					new='{$objProduct->new}'
					WHERE product_id='{$objProduct->product_id}' LIMIT 1";
			if ($database->db_query($sql)) $this->is_message = "Cập nhật sản phẩm thành công !";	
		}
		return $this->is_message;
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
			echo "<script> alert('Chọn một banner để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'product_id=' . implode( ' OR product_id=', $cid );
		
		$database->db_query("UPDATE ".TBL_PRODUCT." SET admin_enabled=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$this->is_message = $total .' quản trị viên đã mở khóa thành công !';
				break;
	
			case 0:
			default:
				$this->is_message = $total .' quản trị viên đã khóa thành công !';
				break;
		}
		
		return $this->is_message;
	}
}
?>