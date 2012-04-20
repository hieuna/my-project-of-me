<?php
class baseInfocart extends VS_Module_Base
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb,$oSmarty);
		$this -> table = "tbl_shopping_cart_info";
		$this->_prefix ="";
		$this->pk = 'id';			
		$this->vsDb->setPrimaryKey($this->pk);
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			'name' 		=> stripcslashes($_POST['name']),
			'info_cart' 	=> stripcslashes($_POST['info_cart']),
			'tex_info' 	=> stripcslashes($_POST['tex_info']),
			'address' 		=> $_POST['address'],
			'total' 		=> $_POST['total'],
			'email' 		=> $_POST['email'],
			'tell' 		=>$_POST['tell']
			
		);
	}
//-----------------------------------------------------------------------//
	function getAssocContact ($id = NULL) {
		if ($id !== NULL) {
			$id = $this->_prefix . "ID ='" . $id . "'";
		}
		
		return $this -> vsDb->getAssoc(array ($this->_prefix .'ID', $this->_prefix .'Title'));
	}
	/**
	 * 
	 * 
	 * 	@param integer $id
	*/
	function getDetailObject($id) {
		return  $this->vsDb->getRow($id);
	}
	
	/**
	 * get list about orther
	 *
	 */
	function getOther($id){		
			$where = " {$this->_prefix}LangID = {$this->lang_id} AND {$this->_prefix}Status = 1";
		if($id)
			$where .= " AND {$this->_prefix}ID != {$id} ";
		return $this->vsDb->getAllLimit($this->table,$where,"{$this->_prefix}CreateDate","","10");	
	}
	
		
	/**
	 * get list about orther
	 *
	 */
	function getHome($id=''){
		$where = " {$this->_prefix}LangID = {$this->lang_id} AND {$this->_prefix}Status = 1";	
		$res = $this->vsDb->getAllLimit($this->table,$where,"{$this->_prefix}CreateDate", 'asc', 1);	
		return $res['0'];
	}
	/**
	 * 
	 * add record into database
	 *
	 */
	 function insert(){	 	
	 	$this -> vsDb ->insert($this->arr_fields);
	 }
	
	 
	/**
	 * edit record into database
	 *
	 */
	 function edit($id){	 	
	 	$this -> vsDb ->updateWithPk($id,$this->arr_fields);
	 }
	 
	 /**
	 * delete record into database
	 *
	 */
	 function delete($id){	 	
	 	$this -> vsDb -> deleteWithPk ($id);	
	 }
}
?>