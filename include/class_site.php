<?php

/**
 * @author langkhach
 * @copyright 2011
 */
 
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
  
  public function getUserId(){
  	$uid = str_replace('u', '', $this->data['site_code']);
  	return is_numeric($uid)?$uid:false;
  }
}

?>