<?php
defined ( 'PG_PAGE' ) or die ();

class PGLog {
	var $user_obj;
	
	var $user_info;
	
	var $user_exists;
	
	var $is_error;
	
	function __construct($userObj){
		if (!is_object($userObj)) return false;
		
		$this->user_obj = $userObj;
		$this->user_info = $this->user_obj->user_info;
		$this->user_exists = $this->user_obj->user_exists;
			
		if (!$this->user_exists){
			$this->is_error = 'Thành viên này không tồn tại';
			return false;
		}
		return true;
	}
	
	function log_gold($action, $action_id = '',$action_type = '', $gold_after, $gold_before, $note = ''){
		global $database, $user;
		
		if(!$action) return false;
        
        $aAction = array(
            'napGold'           => PG_TRANSACTION_TYPE_DEPOSIT,
            'congGoldThanhToan' => PG_TRANSACTION_TYPE_RECEIVE
        );
        
        // Log transaction
        if (($action_type=='payments')&&isset($aAction[$action])){
            $oTrans = new PGTransaction();
            $oTrans->transaction_type = $aAction[$action];
            $oTrans->transaction_payment_id = $action_id;
            $oTrans->transaction_user_id = $this->user_info['user_id'];
            
            if ($action=='napGold') $oTrans->transaction_status=PG_TRANSACTION_STATUS_COMPLETED;
            
            $result = $database->db_query("SELECT 
                s.site_code,
                s.site_type,
                p.payment_order_id 
            FROM 
                payments p, 
                sites s
            WHERE (p.payment_id=".$action_id.") AND (p.payment_site_id=s.site_id)");
            if ($result = $database->db_fetch_object($result)){
                $oTrans->transaction_order_id = $result->payment_order_id;
                $oTrans->save();
                if ($result->site_type==1){
                  if (($action=='congGoldThanhToan') && ($user->user_exists)){
                      $oTrans->transaction_user_id = $user->user_info['user_id'];
                      $oTrans->transaction_type = PG_TRANSACTION_TYPE_PAYMENT;
                      $oTrans->transaction_id = null;
                      $oTrans->save();
                  }
                }
                
            }            
        }
		
		$sql = "INSERT INTO loggolds 
				(
					loggold_user_id, 
					loggold_user_email, 
					loggold_action, 
					loggold_action_type, 
					loggold_action_id, 
					loggold_ip, 
					loggold_createdate, 
					loggold_gold_after, 
					loggold_gold_before, 
					loggold_note
				)
				VALUES 
				(
					'{$this->user_info['user_id']}', 
					'{$this->user_info['user_email']}',
					'{$action}',
					'{$action_type}',
					'{$action_id}',
					'".$_SERVER['REMOTE_ADDR']."',
					'".time()."',
					'{$gold_after}',
					'{$gold_before}',
					'".$database->getEscaped($note)."'
				)";
		$result = $database->db_query($sql);
		return $result;
	}
}
?>