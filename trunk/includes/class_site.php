<?php
class PGSite{
  public $data = array();
  function PGSite($param=null){
    global $database;
    if (!is_null($param)){
      return $this->load($param);
    }
    
    $this->data = array(
      'site_id'             => 0,
      'site_type'           => 0,
      'site_code'           => '',
      'site_secure_secress' => ''
    );
    
    return $this;
  }
  
  public function load($param){
    global $database;
    
    $qWhere = "";
    if (is_array($param)){
      foreach ($param as $key=>$val){
        $qWhere .= (is_numeric($val))?" (".$key."=%d)":" (".$key."='%s')";
      }
    }elseif (is_numeric($param)){
      $qWhere = " site_id=%d";
    }else
      return false;
      
    $res = $database->db_query("SELECT * FROM sites WHERE ".$qWhere." LIMIT 1", $param);
    if ($row = $database->db_fetch_assoc($res)){
      $this->data = $row;
      return $this;
    }else
      return false;
  }
  
  public function loadFromOrderSession($order_session=""){
    global $database;
    
    if (empty($order_session)) return false;
    
    $res = $database->db_query("SELECT s.* FROM sites s INNER JOIN orders o ON s.site_id=o.order_site_id WHERE o.order_session='%s'", $order_session);
    
    if ($row=$database->db_fetch_assoc($res)){
      $this->data = $row;
      return $this;
    }else
      return false;
  }
  
  public function orderSuccess($order){
    global $user, $database;
    
    if ($this->loadFromOrderSession($order['order_session'])){
      // Lưu transaction
      if ($this->data['site_type']==1){
        // GET USER ID
        $uid = $this->getUserId();
        $u = new PGUser(array($uid));
        $goldClass = new PGGold($u);
        $merchantReceive = $this->calculateMerchantGold($order);
  		  $res = $goldClass->gold_add_pay($merchantReceive, $order['order_paylastest']);
        
        /* Log Transaction */
        $oTrans = new PGTransaction();
        $oTrans->transaction_type = PG_TRANSACTION_TYPE_RECEIVE;
        $oTrans->transaction_payment_id = $order['order_paylastest'];
        $oTrans->transaction_user_id = $uid;
        $oTrans->transaction_total = $order['order_price'];
        $oTrans->transaction_ship_fee = $order['order_ship_fee'];
        $oTrans->transaction_pay_user_fee = $this->calculateUserFee($order);
        $oTrans->transaction_pay_merchant_fee = $this->calculateMerchantFee($order);
        $oTrans->transaction_order_id = $order['order_id'];
        $oTrans->save();
        
        if (($user->user_exists)){
          $oTrans->transaction_user_id = $user->user_info['user_id'];
          $oTrans->transaction_type = PG_TRANSACTION_TYPE_PAYMENT;
          $oTrans->transaction_id = null;
          $oTrans->save();
        }
        
        // Tang so luong san pham da mua
        if ($order['order_product_id']>0) 
          $database->db_query("UPDATE products SET product_total_buy=product_total_buy+%d WHERE product_id=%d LIMIT 1", $order['order_product_quantity'], $order['order_product_id']);
      }else{
        if ($user->user_exists){
          require_once('include/class_transaction.php');
                    
          $oTrans = new PGTransaction();
          $oTrans->transaction_type = ($this->data['site_code']=='mcpvi')?PG_TRANSACTION_TYPE_DEPOSIT:PG_TRANSACTION_TYPE_PAYMENT;
          $oTrans->transaction_status = PG_TRANSACTION_STATUS_COMPLETED;
          $oTrans->transaction_payment_id = $order['order_paylastest'];
          $oTrans->transaction_user_id = $user->user_info['user_id'];
          $oTrans->transaction_order_id = $order['order_id'];
          $oTrans->save();
        }
      }
      
      // Tạo coupon
      if ($this->data['site_use_coupon']==1){
        require_once('include/class_coupon.php');
        $coupon = new PGCoupon(array('order_id'=>$order['order_id'], 'site_id'=>$this->data['site_id']));
        $coupon->set($order['order_product_quantity']);
        //$database->db_query("UPDATE coupons SET coupon_order_id=%d, coupon_site_id=%d WHERE coupon_order_id=0 ORDER BY RAND() LIMIT %d", $row['order_id'], $site->data['site_id'], $row['order_product_quantity']);
      }
      
      
    }
  }
  
  private function calculateMerchantFee($order){
    $price = $order['order_price']-$order['order_ship_fee'];
    if ($order['order_paylastest_type']==1){
      return ceil($price*$this->data['site_merchant_qt_feeper']+$this->data['site_merchant_qt_feefix']);
    }elseif ($order['order_paylastest_type']==2){
      return ceil($price*$this->data['site_merchant_nd_feeper']+$this->data['site_merchant_nd_feefix']);
    }else return 0;
  }
  
  private function calculateUserFee($order){
    return feeOrder($order['order_price'], $order['order_paylastest_type']);
  }
  
  private function calculateMerchantGold($order){
    $merchantFee = $this->calculateMerchantFee($order);    
    return $order['order_price']-$order['order_ship_fee']-$merchantFee;
  }
    
  public function getUserId(){
  	$uid = str_replace('u', '', $this->data['site_code']);
  	return is_numeric($uid)?$uid:false;
  }
}

?>