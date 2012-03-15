<?php
class PGBanner{
	var $is_message;
	
	var $banner_id;
	var $banner_topup;
	var $banner_image;
	var $banner_url;
	var $banner_status;
	var $banner_web;
	var $banner_page;
	var $banner_position;
	var $banner_title;
	var $banner_description;
	var $banner_click;
	var $banner_create;
	var $category_id;
	var $product_id;
	
	function __construct(){
		$this->banner_id = 0;
		$this->banner_topup = "";
		$this->banner_image = "";
		$this->banner_url = "";
		$this->banner_status = 1;
		$this->banner_web = 0;
		$this->banner_page = "";
		$this->banner_position = "";
		$this->banner_title = "";
		$this->banner_description = "";
		$this->banner_click = 0;
		$this->banner_create = "";
		$this->category_id = 0;
		$this->product_id = 0;
	}
	
	public function loadList($where = null, $start=null, $limit=null){
		global $database;
		
		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		} 
		
		$sql = "SELECT * FROM ".TBL_BANNER.$where." ORDER BY banner_id DESC".$wLimit;
		$result = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($result)){
			$banner[] = $row;
		}
		
		return $banner;
	}
	
	public function check_input_banner($group, $title){
		global $database;
		
		if ($group == 0){
			$this->is_message = "Hãy lựa chọn nhóm banner !";
		}
		
		if ($title == ""){
			$this->is_message = "Tiêu đề banner không để trống !";
		}
		
		return $this->is_message;
	}
	
	public function load($banner_id = null){
		global $database;
		if (!is_null($banner_id) && is_numeric($banner_id) && ($banner_id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_BANNER." WHERE banner_id=$banner_id LIMIT 1");
			if ($oBanner = $database->db_fetch_object($result)){
				$this->banner_id			= $oBanner->banner_id;
				$this->banner_topup			= $oBanner->banner_topup;
				$this->banner_image			= $oBanner->banner_image;
				$this->banner_url			= $oBanner->banner_url;
				$this->banner_status		= $oBanner->banner_status;
				$this->banner_web			= $oBanner->banner_web;
				$this->banner_page			= $oBanner->banner_page;
				$this->banner_position		= $oBanner->banner_position;
				$this->banner_title			= $oBanner->banner_title;
				$this->banner_description	= $oBanner->banner_description;
				$this->banner_click			= $oBanner->banner_click;
				$this->banner_create		= $oBanner->banner_create;
				$this->category_id			= $oBanner->category_id;
				$this->product_id			= $oBanner->product_id;
			}
		}
		return $this;
	}
	
	public function save($oBanner = null){
		global $database;
		if (!is_object($oBanner)) $oBanner = $this;
		
		if (!isset($oBanner->banner_id) || is_null($oBanner->banner_id) || ($oBanner->banner_id==0)){
			$sql = "INSERT INTO ".TBL_BANNER . " (
			banner_topup,
			banner_image,
			banner_url,
			banner_status,
			banner_web,
			banner_page,
			banner_position,
			banner_title,
			banner_description,
			banner_click,
			banner_create,
			category_id,
			product_id
			) VALUES(
			'".$oBanner->banner_topup."',
			'".$oBanner->banner_image."',
			'".$oBanner->banner_url."',
			".$oBanner->banner_status.",
			".$oBanner->banner_web.",
			'".$oBanner->banner_page."',
			'".$oBanner->banner_position."',
			'".$oBanner->banner_title."',
			'".$oBanner->banner_description."',
			".$oBanner->banner_click.",
			'".$oBanner->banner_create."',
			'".$oBanner->category_id."',
			'".$oBanner->product_id."'
			)";
			//echo $sql; die;
			if ($database->db_query($sql)) $this->is_message = 'Thêm mới banner thành công !';
		}else{
			$sql = "UPDATE ".TBL_BANNER . " SET
			banner_topup='".$oBanner->banner_topup."',
			banner_image='".$oBanner->banner_image."',
			banner_url='".$oBanner->banner_url."',
			banner_status =".$oBanner->banner_status.",
			banner_web=".$oBanner->banner_web.",
			banner_page='".$oBanner->banner_page."',
			banner_position='".$oBanner->banner_position."',
			banner_title='".$oBanner->banner_title."',
			banner_description='".$oBanner->banner_description."',
			banner_click=".$oBanner->banner_click.",
			banner_create='".$oBanner->banner_create."',
			category_id=".$oBanner->category_id.",
			product_id=".$oBanner->product_id."
			WHERE banner_id=".$oBanner->banner_id;
			//echo $sql; die;
			if ($result = $database->db_query($sql)) $this->is_message = 'Cập nhật banner thành công !';
		}
		
		return $this->is_message;
	}
	
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
			$cids = 'banner_id=' . implode( ' OR banner_id=', $cid );
			$sql = "DELETE FROM ".TBL_BANNER." WHERE ( $cids )";
			$database->db_query($sql);
			
			$this->is_message = 'Đã xóa '.$total.' banner thành công !';
		}
		
		return $this->is_message;
	}
	
	public function published($cid=null, $published = 0){
		global $database;

		if (count( $cid ) < 1) {
			$action = $published == 1 ? 'hiển thị' : 'Ẩn đi';
			echo "<script> alert('Chọn một banner để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'banner_id=' . implode( ' OR banner_id=', $cid );
		$database->db_query("UPDATE ".TBL_BANNER." SET banner_status=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$this->is_message = $total .' banner đã hiển thị thành công !';
				break;
	
			case 0:
			default:
				$this->is_message = $total .' banner đã ẩn đi thành công !';
				break;
		}
		
		return $this->is_message;
	}
}