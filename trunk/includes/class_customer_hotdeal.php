<?php
class PGCustomerHotDeal{
	var $message;
	public $id;
	public $name;
	public $email;
	public $phone;
	public $address;
	public $price;
	public $date;
	public $hotdeal_id;
	public $product_id;
	public $number_register;
	public $order_product;
	public $is_promotion;
	public $payment;
	
	function __construct(){
		$this->id 			= 0;
		$this->name			= "";
		$this->email		= "";
		$this->phone		= "";
		$this->address		= "";
		$this->price		= 0;
		$this->date			= "";
		$this->hotdeal_id 	= 0;
		$this->product_id = 0;
		$this->number_register = 1;
		$this->order_product= 0;
		$this->is_promotion = 0;
		$this->payment = "";
	}
	
	public function load($id = null){
		global $database;
		if (!is_null($id) && is_numeric($id) && ($id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_CUSTOMER_HOTDEAL." WHERE id=$id LIMIT 1");
			if ($oCus = $database->db_fetch_object($result)){
				$this->id				= $oCus->id;
				$this->name				= $oCus->name;
				$this->email			= $oCus->email;
				$this->phone			= $oCus->phone;
				$this->address			= $oCus->address;
				$this->price			= $oCus->price;
				$this->date				= $oCus->date;
				$this->hotdeal_id		= $oCus->hotdeal_id;
				$this->product_id		= $oCus->product_id;
				$this->number_register	= $oCus->number_register;
				$this->order_product	= $oCus->order_product;
				$this->is_promotion		= $oCus->is_promotion;
				$this->payment			= $oCus->payment;
			}
		}
		return $this;
	}
	
	public function loadMaxID(){
		global $database;
		$result = $database->db_query("SELECT max(id) AS max FROM ".TBL_CUSTOMER_HOTDEAL);
		$max = $database->getRow($result);
		$maxID = $max["max"];
		return $maxID;
	}
	
	public function loadList($hotdeal_id = null){
		global $database;
		if (!is_null($hotdeal_id) && is_numeric($hotdeal_id) && ($hotdeal_id>0)){
			$condition = " WHERE hotdeal_id=".$hotdeal_id;
		}else{
			$condition = "";
		}
		$sql = "SELECT * FROM ".TBL_CUSTOMER_HOTDEAL.$condition." ORDER BY id DESC";
		$result = $database->db_query($sql);
		while ($customer = $database->db_fetch_assoc($result)){
			$query = "SELECT title FROM ".TBL_HOTDEAL." WHERE id=".$customer["hotdeal_id"];
			$result2 = $database->db_query($query);
			$this_field = $database->getRow($result2);
			$customer["hotdeal_name"] = $this_field["title"];
			
			$customers[] = $customer;
		}
		return $customers;
	}
	
	public function check_input_customer($name, $phone, $address){
		global $database;
		
		if($name == "" && $phone == "" && $address == ""){
			$message = "Vui lòng nhập đầy đủ thông tin dưới đây !";
		}
		else if ($name == ""){
			$message = "Họ và tên không để trống !";
		}
		else if ($phone == ""){
			$message = "Số điện thoại không để trống !";
		}
		else if ($address == ""){
			$message = "Địa chỉ không để trống !";
		}
		
		return $message;
	}
	
	public function save($oCus = NULL){
		global $database;
		if (!is_object($oCus)) $oCus = $this;
		
		if (!isset($oCus->id) || is_null($oCus->id) || ($oCus->id==0)){
			$sql = "INSERT INTO ".TBL_CUSTOMER_HOTDEAL . " (
			name,
			email,
			phone,
			address,
			price,
			date,
			hotdeal_id,
			product_id,
			number_register,
			order_product,
			is_promotion,
			payment
			) VALUES(
			'".$oCus->name."',
			'".$oCus->email."',
			'".$oCus->phone."',
			'".$oCus->address."',
			".$oCus->price.",
			'".$oCus->date."',
			".$oCus->hotdeal_id.",
			".$oCus->product_id.",
			".$oCus->number_register.",
			".$oCus->order_product.",
			".$oCus->is_promotion.",
			'".$oCus->payment."'
			)";
			if ($database->db_query($sql)) return true;
		}else{
			$sql = "UPDATE ".TBL_CUSTOMER_HOTDEAL . " SET
			name='".$oCus->name."',
			email='".$oCus->email."',
			phone ='".$oCus->phone."',
			address='".$oCus->address."',
			price=".$oCus->price.",
			date='".$oCus->date."',
			hotdeal_id=".$oCus->hotdeal_id.",
			product_id=".$oCus->product_id.",
			number_register=".$oCus->number_register.",
			order_product=".$oCus->order_product.",
			is_promotion=".$oCus->is_promotion.",
			payment='".$oCus->payment."'
			WHERE id=".$oCus->id;
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
			$sql = "DELETE FROM ".TBL_CUSTOMER_HOTDEAL." WHERE ( $cids )";
			$database->db_query($sql);
			return false;
		}
	}
}
?>