<?php
/*
 * Version: 1.0
 * Code By: Kiều Văn Ngọc
 * Email: ngockv@gmail.com
 * Mobile: 097.8686.055
 * Website:
 * Name Table Defined: TBL_MENU
 */
class PGMenu{
	var $menu_id;
	var $menutype;
	var $name;
	var $alias;
	var $link;
	var $type;
	var $status;
	var $parent_id;
	var $ordering;
	
	function __construct(){
		$this->menu_id = 0;
		$this->menutype = "";
		$this->name = "";
		$this->alias = "";
		$this->link = "";
		$this->type = "";
		$this->status = 1;
		$this->parent_id = 0;
		$this->ordering = 0;
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
			$orderBy = " ORDER BY ordering ASC, menu_id DESC";
		}else{
			$orderBy = $order;
		}
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT * FROM ".TBL_MENU.$where.$orderBy.$wLimit;
		$results = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($results)){
			$lsMenu[] = $row;
		}
		
		return $lsMenu;
	}
	
	/*
	 * Load field
	 * $menu_id : ID of field
	 */
	public function load($menu_id = null){
		global $database;
		if (!is_null($menu_id) && is_numeric($menu_id) && ($menu_id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_MENU." WHERE memu_id=$menu_id LIMIT 1");
			if ($objMenu = $database->db_fetch_object($result)){
				$this->menu_id			= $objMenu->menu_id;
				$this->menutype			= $objMenu->menutype;
				$this->name				= $objMenu->name;
				$this->alias			= $objMenu->alias;
				$this->link				= $objMenu->link;
				$this->type				= $objMenu->type;
				$this->status			= $objMenu->status;
				$this->parent_id		= $objMenu->parent_id;
				$this->ordering			= $objMenu->ordering;
			}
		}
		return $this;
	}
	
	/*
	 * Save Menu
	 * Truyền các trường bằng tham số
	 * VD: $objMenu->name = "Tên menu";
	 */
	public function save($objMenu = null){
		global $database;
    
		if (!is_object($objMenu)) $objMenu = $this;

		if (!isset($objMenu->menu_id) || is_null($objMenu->menu_id) || ($objMenu->menu_id==0)){
      		$sql = "INSERT INTO ".TBL_MENU." (
      			menutype,
      			name,
		        alias,
		        link,
		        type,
		        status,
        		ordering,
		        parent_id
		    ) VALUES (
		    	'{$objMenu->menutype}',
		    	'{$objMenu->name}',
		    	'{$objMenu->alias}',
		        '{$objMenu->link}',
		        '{$objMenu->type}',
		        '{$objMenu->status}',
		        '{$objMenu->ordering}',
		        '{$objMenu->parent_id}'
		    )";
	      	if ($database->db_query($sql)) $this->is_message = "Thêm mới menu thành công !";	
		}else{
			$sql = "UPDATE ".TBL_MENU." SET 
					menutype='{$objMenu->menutype}',
					name='{$objMenu->name}', 
					alias='{$objMenu->alias}', 
					link='{$objMenu->link}',
					type='{$objMenu->type}',
					status='{$objMenu->status}',
					ordering='{$objMenu->ordering}',
					parent_id='{$objMenu->parent_id}'
					WHERE menu_id='{$objMenu->menu_id}' LIMIT 1";
			if ($database->db_query($sql)) $this->is_message = "Cập nhật menu thành công !";	
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
			$cids = 'menu_id=' . implode( ' OR menu_id=', $cid );
			$sql = "DELETE FROM ".TBL_MENU." WHERE ( $cids )";
			$database->db_query($sql);
			
			$this->is_message = 'Đã xóa '.$total.' menu thành công !';
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
			echo "<script> alert('Chọn một menu để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'menu_id=' . implode( ' OR menu_id=', $cid );
		
		$database->db_query("UPDATE ".TBL_MENU." SET status=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$this->is_message = $total .' menu đã hiển thị thành công !';
				break;
	
			case 0:
			default:
				$this->is_message = $total .' menu đã ẩn thành công !';
				break;
		}
		
		return $this->is_message;
	}
}