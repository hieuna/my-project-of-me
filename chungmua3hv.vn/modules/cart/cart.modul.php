<?php 
/**
 * Shopping cart class for haingocmobi
 * @name DNKien - BSG Co.ltd
 *
 */
class cart{

	public $products,$cart_content, $expiretime, $table;

	function __construct()
	{
		$this->table ="tbl_shopping_cart";
		$this->expiretime = time()+24*3600*5;
		global $oSmarty;
		$oSmarty->assign('currency', getConfig('currency'));
		$oSmarty->assign('rate', getConfig('rate_currency'));
	}
	
	function run($task= "")
	{
		$session = session_id();	
		$product_id = $_GET['pid'];
		$quantity = $_GET['qty'] ? $_GET['qty'] : 1;
		switch($task){
	      	case 'add':
	      		$this->add_item($session,$product_id,$quantity);
	      		$this->redirect();
	      		break;
	      	case 'delete':
	      		$this->delete_item($session, $product_id);
	      		$this->redirect();
	      		break;
	      	case 'update_quantity':
	      		$this->modify_quantity($session,$product_id,$quantity);
	      		$this->redirect();
	      		break;
	      	case 'clear':
	      		$this->clear_cart($session);
	      		$this->redirect();
	      		break;
	      	case 'checkout':
	      		$this->checkout($session);
	      		break;
	      	case 'defaultCart':
				$this->showDefaultCart();
				break;
	      	case 'print':
	      		$this->printCart($session);
	      		break;
	      	case 'update_cart':
	      		$this->updateCart($session);
	      		break;
		  	default:
		       $this->display_contents($session); 
				break;		
		  }

    }
    
    function  getPageInfo($sTask){
		global $oSmarty;
		switch ($sTask){
			case 'checkout':
				$aPageinfo['title'] = $oSmarty->get_config_vars("title_checkout");				
				break;
			default:
				$aPageinfo['title'] = $oSmarty->get_config_vars("title_shopping_cart");				
				break;
		}
		
		$aPageinfo['keyword'] = $oSmarty->get_config_vars("keyword_shopping_cart");
		$aPageinfo['description'] = $oSmarty->get_config_vars("description_shopping_cart");
		
		return $aPageinfo;
	}
	
	function showDefaultCart(){
		global $oSmarty, $oDb;
		$sTable = $this->table;
		$session = session_id();
		$sQuery = "SELECT count(*) from {$sTable} WHERE sessionid='{$session}' and completed<>'1' ";
		$result = $oDb->getOne($sQuery);
		$oSmarty->assign("ncart", $result);
		
		$oSmarty->display('defaultCart.tpl');
	}
	
	function redirect()
	{
		$cart_url = makeUrlFriendly(SITE_URL."index.php?mod=cart");
	      echo '<script>location.href="'.$cart_url.'"</script>';
	}

	function check_item($session, $product_id) {
		global $oDb;
		$query = "SELECT * FROM $this->table WHERE sessionid='$session' AND product_id='$product_id'  and completed<>'1' ";
		$result = $oDb->getAll($query);
		
		if(!$result) {
			return 0;
		}

		$numRows = count($result);

		if($numRows == 0) {
			return 0;
		} else {			
			return $result[0]['quantity'];
		}
	}

	function add_item($session, $product_id, $quantity=1) {
		global $oDb;

		$qty = $this->check_item($session, $product_id);
		if($qty == 0) {
			$arr_record = array(
				"sessionid"	=> $session,				
				"product_id"	=> $product_id,
				"quantity"		=> $quantity,
			);

			$oDb->autoExecute($this->table,$arr_record,DB_AUTOQUERY_INSERT);

		} else {
			$quantity = $qty+$quantity;
			$arr_record = array(
				"sessionid"	=> $session,					
				"product_id"	=> $product_id,
				"quantity"		=> $quantity,
			);

			$oDb->autoExecute($this->table,$arr_record,DB_AUTOQUERY_UPDATE,"product_id = $product_id");
			
		}			
	}

	function delete_item($session, $product_id) {
		global $oDb;
		
		$oDb->query("DELETE FROM {$this->table} WHERE sessionid='{$session}' AND product_id={$product_id} ");
	}
	

	function clear_cart($session) {
		global $oDb;
		
		$oDb->query("DELETE FROM {$this->table} WHERE sessionid='{$session}'");
	}

	function display_contents($session) {
		global $oDb, $oSmarty;
		
		$sTbl2 = "tblproduct";
		$query = "SELECT * FROM $this->table t1 join {$sTbl2} t2 on(t1.product_id=t2.Product_ID) WHERE t1.sessionid='$session' and completed<>'1'  ORDER BY id ";
		$result = $oDb->getAll($query);
		$total = 0;
		
		foreach ($result as $key => $value) {
			$subtotal = $value['Product_Price']*$value['quantity'];
			$result[$key]['subtotal'] = $subtotal;			
			$total = $total + $subtotal;
		}
		
		$oSmarty->assign('result',$result);
		$oSmarty->assign('total',$total);
		$oSmarty->display('view_cart.tpl');
	}
	
	function printCart($session) {
		global $oDb, $oSmarty;
		
		$sTbl2 = "tblproduct";
		$query = "SELECT * FROM $this->table t1 join {$sTbl2} t2 on(t1.product_id=t2.Product_ID) WHERE t1.sessionid='$session' and completed<>'1'  ORDER BY id ";
		$result = $oDb->getAll($query);
		$total = 0;
		
		foreach ($result as $key => $value) {
			$subtotal = $value['Product_Price']*$value['quantity'];
			$result[$key]['subtotal'] = $subtotal;			
			$total = $total + $subtotal;
		}
		
		$datetime = array('date'=>date('d'), 'month'=>date('m'), 'year'=>date('Y'));
		$oSmarty->assign('result',$result);
		$oSmarty->assign('total',$total);
		$oSmarty->assign('datetime',$datetime);
		
		$oSmarty->display('printCart.tpl');
	}

	function checkout($session)
	{
		global $oDb, $oSmarty;
		
		$sTbl2 = "tblproduct";
		$query = "SELECT * FROM $this->table t1 join {$sTbl2} t2 on(t1.product_id=t2.Product_ID) WHERE t1.sessionid='$session'  and completed<>'1'  ORDER BY id ";
		$result = $oDb->getAll($query);
		$total = 0;
		
		foreach ($result as $key => $value) {			
			$subtotal = $value['Product_Price']*$value['quantity'];
			$result[$key]['subtotal'] = $subtotal;			
			$total = $total + $subtotal;
		}
		
		if (isset($_SESSION['user_id'])) {
			$user = $oDb->getRow("SELECT * FROM user WHERE id= {$_SESSION['user_id']}");
			$oSmarty->assign('user',$user);
		}
		
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'From :'.$_POST['txt_name'].'<'.$_POST['txt_email'].'>';
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";			
			
			//$to = "khanhnk@bsg.vn";
			$info = array(
				"name"	=> $_POST['txt_name'],
				"email"	=> $_POST['txt_email'],
				"address"	=> $_POST['txt_address'],
				"phone"		=> $_POST['txt_phone'],
				"tour_name"	=> $tour['title'],
				"addition_request"	=> $_POST['txt_addition_request']
			);
			
			$oSmarty->assign('info',$info);
			$oSmarty->assign('cart',$result);
			$oSmarty->assign('total',$total);
			$content = $oSmarty->fetch('checkout_mail_content.tpl');
			$subject = $oSmarty->get_config_vars('title_mail_shopping');
			
			$contacts = $this -> getContact();
			if( $contacts ){
				foreach( $contacts as $key => $val){
					@mail( $val['email'], $subject, $content, $headers );
				}
			}else{
				$contact = getConfig('email_contact');
				@mail( $contact, $subject, $content, $headers );
			}
			
			/*	remove cart */
			$info_cart="<ul>";
			foreach($result as $key => $value){
			$info_cart.="<li>".$key.".<b>".$value["Product_Title"]."</b> Số lượng đặt mua: ".$value["quantity"].", đơn giá: ".$value["Product_Price"]."</li>";
			}
			$info_cart.="</ul>";
			$oDb->query("insert into tbl_shopping_cart_info (name,email,address,tell,tex_info,info_cart,total) values('{$info['name']}','{$info['email']}','{$info['address']}','{$info['phone']}','{$info['addition_request']}','{$info_cart}',{$total})");
			$this->removeCart($session);
			
			$oSmarty -> assign("msg", $oSmarty->get_config_vars('checkout_success'));
			$oSmarty -> display("checkout_success.tpl");
		}
		else {					
			$oSmarty->assign('tour',$tour);
			$oSmarty->display('frm_checkout.tpl');
		}
	}
	
	function getContact(){
		global $oDb;
		$lang_id = $_SESSION['lang_id'];
		$stbl = "tbl_contact";
		$query = "select * from {$stbl} where status='1' and lang_id='{$lang_id}'";
		$result = $oDb -> getAll( $query );
		return $result;
	}
	
	function removeCart($session){
		global $oDb;
		$sTable = $this->table;
		$sQuery = "UPDATE {$sTable} SET completed='1' WHERE sessionid='{$session}'";
		$oDb->query($sQuery);
	}
	
	function updateCart($session){
		$aQuantity = $_POST['quantity'];
		foreach ($aQuantity as $id => $number){
			if($number<=0){
				$this->delete_item( $session, $id);
			}else{
				echo $number, $id;
				$this->modify_quantity( $session, $id, $number);
			}
		}
		$this->redirect();
	}
	
	function modify_quantity($session, $product_id, $quantity) {
		global $oDb;
		$record['quantity']=$quantity;
		 
		$oDb->autoExecute($this->table,$record,DB_AUTOQUERY_UPDATE,"sessionid='{$session}' AND product_id = $product_id");
	}

}


?>