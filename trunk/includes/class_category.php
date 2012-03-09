<?php
/*
 * Version: 1.0
 * Code By: Kiều Văn Ngọc
 * Email: ngockv@gmail.com
 * Mobile: 097.8686.055
 * Website:
 * Name Table Defined: TBL_CATEGORIES
 */
class PGCategory{
	var $is_message;
	
	var $category_id;
	var $name;
	var $alias;
	var $description= "";
	var $status;
	var $ordering;
	var $created;
	var $created_by;
	var $parent_id;
	
	function __construct(){
		$this->category_id = 0;
		$this->name = "";
		$this->alias = "";
		$this->description = "";
		$this->status = 1;
		$this->ordering = 0;
		$this->created = date("Y-m-d h:i:s");
		$this->created_by = 0;
		$this->parent_id = 0;
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
			$orderBy = " ORDER BY ordering ASC, created DESC";
		}else{
			$orderBy = $order;
		}
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT * FROM ".TBL_CATEGORY.$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$res = $database->db_query("SELECT admin_name FROM ".TBL_ADMIN." WHERE admin_id=".$row["created_by"]);
			$this_user_create = $database->getRow($res);
			$row['name_created'] = $this_user_create["admin_name"];
			$result = $database->db_query("SELECT COUNT(*) AS total FROM ".TBL_PRODUCT." WHERE category_id=".$row["category_id"]);
			$total = $database->getRow($result);
			$row["product_count"] = $total["total"];
			$result_cate = $database->db_query("SELECT name FROM ".TBL_CATEGORY." WHERE category_id=".$row["parent_id"]);
			$name_category_parent = $database->getRow($result_cate);
			$row["name_parent"] = $name_category_parent["name"];	
			
			$lsCategories[] = $row;
		}
		
		return $lsCategories;
	}
	
	/* show category_id có parent_id */
	public function showCategoryID($category_id){
		global $database;
		if ($category_id > 0){
			$sql = "SELECT category_id FROM ".TBL_CATEGORY." WHERE parent_id=".$category_id;
			$results = $database->db_query($sql);
			while ($row = $database->db_fetch_assoc($results)){
				$lsIDCategory[] = $row;
			}
			return $lsIDCategory;
		}
	}
	
	/*
	 * Load field
	 * $category_id : ID of field
	 */
	public function load($category_id = null){
		global $database;
		if (!is_null($category_id) && is_numeric($category_id) && ($category_id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_CATEGORY." WHERE category_id=$category_id LIMIT 1");
			if ($objCategory = $database->db_fetch_object($result)){
				$this->category_id		= $objCategory->category_id;
				$this->name				= $objCategory->name;
				$this->alias			= $objCategory->alias;
				$this->description		= $objCategory->description;
				$this->status			= $objCategory->status;
				$this->ordering			= $objCategory->ordering;
				$this->created			= $objCategory->created;
				$this->created_by		= $objCategory->created_by;
				$this->parent_id		= $objCategory->parent_id;
			}
		}
		return $this;
	}
	
	/*
	 *Check input category
	 */
	public function checkInput($name){
		if ($name == "") $this->is_message = "Tên nhóm sản phẩm không để trống !";
		if ($this->is_message) return;
		
		return;
	}
	
	/*
	 * Save Category
	 * Truyền các trường bằng tham số
	 * VD: $objCategory->name = "Kiều Văn Ngọc";
	 * $objCategory->model = "Nokia";
	 * $objCategory->code = "ABR8F97";
	 */
	public function save($objCategory = null){
		global $database, $setting, $datetime, $admin_id;
    
		if (!is_object($objCategory)) $objCategory = $this;

		if (!isset($objCategory->category_id) || is_null($objCategory->category_id) || ($objCategory->category_id==0)){
      		$sql = "INSERT INTO ".TBL_CATEGORY." (
      			name,
		        alias,
		        description,
		        status,
        		ordering,
		        created,
		        created_by,
		        parent_id
		    ) VALUES (
		    	'{$objCategory->name}',
		    	'{$objCategory->alias}',
		        '{$objCategory->description}',
		        '{$objCategory->status}',
		        '{$objCategory->ordering}',
		        '{$objCategory->created}',
		        '{$objCategory->created_by}',
		        '{$objCategory->parent_id}'
		    )";
	      	if ($database->db_query($sql)) $this->is_message = "Thêm mới nhóm sản phẩm thành công !";	
		}else{
			$sql = "UPDATE ".TBL_CATEGORY." SET 
					name='{$objCategory->name}', 
					alias='{$objCategory->alias}', 
					description='{$objCategory->description}',
					status='{$objCategory->status}',
					ordering='{$objCategory->ordering}',
					created='{$objCategory->created}',
					created_by='{$objCategory->created_by}',
					parent_id='{$objCategory->parent_id}'
					WHERE category_id='{$objCategory->category_id}' LIMIT 1";
			if ($database->db_query($sql)) $this->is_message = "Cập nhật nhóm sản phẩm thành công !";	
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
			$cids = 'category_id=' . implode( ' OR category_id=', $cid );
			$sql = "DELETE FROM ".TBL_CATEGORY." WHERE ( $cids )";
			$database->db_query($sql);
			
			$this->is_message = 'Đã xóa '.$total.' nhóm sản phẩm thành công !';
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
			echo "<script> alert('Chọn một nhóm sản phẩm để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'category_id=' . implode( ' OR category_id=', $cid );
		
		$database->db_query("UPDATE ".TBL_CATEGORY." SET status=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$this->is_message = $total .' nhóm sản phẩm đã hiển thị thành công !';
				break;
	
			case 0:
			default:
				$this->is_message = $total .' nhóm sản phẩm đã ẩn thành công !';
				break;
		}
		
		return $this->is_message;
	}
}
?>