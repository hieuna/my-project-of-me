<?php
class PGHotDeal{
	var $is_error;	
	
	public $id;
	public $category_id;
	public $product_id;
	public $price_ny;
	public $price_hotdeal;
	public $muc_giam;
	public $discount;
	public $title;
	public $title_feauture;
	public $description;
	public $image;
	public $view;
	public $count;
	public $feauture;
	public $ct_name;
	public $ct_phone;
	public $ct_yahoo;
	public $ct_skype;
	public $published;
	public $start_date;
	public $end_date;
	public $ordering;
	
	function __construct(){
		$this->id = 0;
		$this->category_id = 0;
		$this->product_id = 0;
		$this->price_ny = 0;
		$this->price_hotdeal = 0;
		$this->muc_giam = 0;
		$this->discount = 0;
		$this->title = "";
		$this->title_feauture = "";
		$this->description = "";
		$this->image = "";
		$this->view = 0;
		$this->count = 0;
		$this->feauture = "";
		$this->ct_name = "";
		$this->ct_phone = "";
		$this->ct_yahoo = "";
		$this->ct_skype = "";
		$this->published = 0;
		$this->start_date = "";
		$this->end_date = "";
		$this->ordering = 0;	
	}
	
	public function load($id = null){
		global $database;
		if (!is_null($id) && is_numeric($id) && ($id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_HOTDEAL." WHERE id=$id LIMIT 1");
			if ($oDeal = $database->db_fetch_object($result)){
				$this->id				= $oDeal->id;
				$this->category_id		= $oDeal->category_id;
				$this->product_id		= $oDeal->product_id;
				$this->price_ny			= $oDeal->price_ny;
				$this->price_hotdeal	= $oDeal->price_hotdeal;
				$this->muc_giam			= $oDeal->muc_giam;
				$this->discount			= $oDeal->discount;
				$this->title			= $oDeal->title;
				$this->title_feauture	= $oDeal->title_feauture;
				$this->description		= $oDeal->description;
				$this->image			= $oDeal->image;
				$this->view				= $oDeal->view;
				$this->count			= $oDeal->count;
				$this->feauture			= explode("|", $oDeal->feauture);
				$this->ct_name			= $oDeal->ct_name;
				$this->ct_phone			= $oDeal->ct_phone;
				$this->ct_yahoo			= $oDeal->ct_yahoo;
				$this->ct_skype			= $oDeal->ct_skype;
				$this->published		= $oDeal->published;
				$this->start_date		= $oDeal->start_date;
				$this->end_date			= $oDeal->end_date;
				$this->ordering			= $oDeal->ordering;
			}
		}
		return $this;
	}
	
	public function loadList($id = null, $published = null){
		global $database;
		if (!is_null($id) && is_numeric($id) && ($id>0)){
			if (!is_null($published) && is_numeric($published))
				$condition = " WHERE published=".$published." AND id!=$id";
			else
				$condition = " WHERE id!=$id";
		}else{
			if (!is_null($published) && is_numeric($published))
				$condition = " WHERE published=".$published;
			else
				$condition = "";
		}
		$sql = "SELECT * FROM ".TBL_HOTDEAL.$condition." ORDER BY start_date DESC";
		$result = $database->db_query($sql);
		$i = 0;
		while ($hotdeal = $database->db_fetch_assoc($result)){
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
		//print_r($hotdeals);
		return $hotdeals;
	}
	
	public function check($category_id, $product_id, $price_hotdeal, $count, $start_date, $end_date){
		global $database;
		if ($category_id == 0 || $category_id== "") $this->is_error = "Phải lựa chọn nhóm sản phẩm !";
		
		if ($product_id == 0 || $product_id == "") $this->is_error = "Phải lựa chọn sản phẩm trực thuộc !";
		
		if ($price_hotdeal == 0) $this->is_error = "Giá khuyến mãi phải lớn hơn 0";
		
		if ($count == 0) $this->is_error = "Số lượng sản phẩm đề ra phải lớn hơn 0";
		
		if ($start_date == "") $this->is_error = "Ngày bắt đầu phải xác định !";
		
		if ($end_date == "") $this->is_error = "Ngày bắt đầu phải xác định !";
		
		if ($this->is_error) return ;
		
		return;
	}
	
	public function save($oDeal = null){
		global $database;
		if (!is_object($oDeal)) $oDeal = $this;
		
		if (!isset($oDeal->id) || is_null($oDeal->id) || ($oDeal->id==0)){
			$sql = "INSERT INTO ".TBL_HOTDEAL . " (
			category_id,
			product_id,
			price_ny,
			price_hotdeal,
			muc_giam,
			discount,
			title,
			title_feauture,
			description,
			image,
			view,
			count,
			feauture,
			ct_name,
			ct_phone,
			ct_yahoo,
			ct_skype,
			published,
			start_date,
			end_date,
			ordering
			) VALUES(
			".$oDeal->category_id.",
			".$oDeal->product_id.",
			".$oDeal->price_ny.",
			".$oDeal->price_hotdeal.",
			".$oDeal->muc_giam.",
			".$oDeal->discount.",
			'".$oDeal->title."',
			'".$oDeal->title_feauture."',
			'".$oDeal->description."',
			'".$oDeal->image."',
			".$oDeal->view.",
			".$oDeal->count.",
			'".$oDeal->feauture."',
			'".$oDeal->ct_name."',
			'".$oDeal->ct_phone."',
			'".$oDeal->ct_yahoo."',
			'".$oDeal->ct_skype."',
			".$oDeal->published.",
			'".$oDeal->start_date."',
			'".$oDeal->end_date."',
			".$oDeal->ordering."
			)";
			if ($database->db_query($sql)) return true;
		}else{
			$sql = "UPDATE ".TBL_HOTDEAL . " SET
			category_id=".$oDeal->category_id.",
			product_id=".$oDeal->product_id.",
			price_ny =".$oDeal->price_ny.",
			price_hotdeal=".$oDeal->price_hotdeal.",
			muc_giam=".$oDeal->muc_giam.",
			discount=".$oDeal->discount.",
			title='".$oDeal->title."',
			title_feauture='".$oDeal->title_feauture."',
			description='".$oDeal->description."',
			image='".$oDeal->image."',
			view=".$oDeal->view.",
			count=".$oDeal->count.",
			feauture='".$oDeal->feauture."',
			ct_name='".$oDeal->ct_name."',
			ct_phone='".$oDeal->ct_phone."',
			ct_yahoo='".$oDeal->ct_yahoo."',
			ct_skype='".$oDeal->ct_skype."',
			published=".$oDeal->published.",
			start_date='".$oDeal->start_date."',
			end_date='".$oDeal->end_date."',
			ordering=".$oDeal->ordering."
			WHERE id=".$oDeal->id;
			//echo $sql; die;
			if ($result = $database->db_query($sql)) return true;
		}
		
		return false;
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
			$cids = 'id=' . implode( ' OR id=', $cid );
			$sql = "DELETE FROM ".TBL_HOTDEAL." WHERE ( $cids )";
			$database->db_query($sql);
			return false;
		}
	}
	
	public function published($cid, $published = 0){
		global $database;
		if (count( $cid ) < 1) {
			$action = $published == 1 ? 'hiển thị' : 'Ẩn đi';
			echo "<script> alert('Chọn một mục để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'id=' . implode( ' OR id=', $cid );
		
		$database->db_query("UPDATE ".TBL_HOTDEAL." SET published=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$msg = $total .' hotdeal đã hiển thị thành công !';
				break;
	
			case 0:
			default:
				$msg = $total .' hotdeal đã ẩn đi thành công !';
				break;
		}
		return $msg;
	}
	
	public function upview($id){
		global $database;
		$sql = "SELECT view FROM ".TBL_HOTDEAL." WHERE id=".$id;
		$result = $database->db_query($sql);
		$row = $database->getRow($result);
		$view = $row["view"]+1;
		
		if (!is_null($id) && is_numeric($id) && ($id>0)){
			$sql = "UPDATE ".TBL_HOTDEAL." SET view=".$view." WHERE id=$id";
			$database->db_query($sql);
		}
		return false;
	}
	
	public function downcount($id, $number_count=1){
		global $database;
		$sql = "SELECT count FROM ".TBL_HOTDEAL." WHERE id=".$id;
		$result = $database->db_query($sql);
		$row = $database->getRow($result);
		if (!is_null($number_count) && is_numeric($number_count) && ($number_count>0))
			$count = $row["count"]-$number_count;

		if (!is_null($id) && is_numeric($id) && ($id>0)){
			$sql = "UPDATE ".TBL_HOTDEAL." SET count=".$count." WHERE id=$id";
			$database->db_query($sql);
		}
		return false;
	}
	
	public function refresh($id){
		global $database;
		$date = strtotime("1 day");
		$beforeDate = date("Y-m-d h:s:i", $date);
		$sql = "UPDATE ".TBL_HOTDEAL." SET published=1, count=0, view=0, start_date='".date("Y-m-d h:s:i")."', end_date='".$beforeDate."', discount=0, muc_giam=0, price_hotdeal=0, price_ny=0, feauture='' WHERE id=".$id;
		$query = "DELETE FROM ".TBL_CUSTOMER_HOTDEAL." WHERE hotdeal_id=".$id;
		//die;
		if ($database->db_query($sql) && $database->db_query($query)){
			$msg = 'Làm mới hotdeal thành công !';
		}else{
			$msg = 'Làm mới hotdeal không thành công !';
		}
		
		return $msg;
	}
}