<?php
class baseAbout extends VS_Module_Base
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb,$oSmarty);
		$this -> table = "tblabout";
		$this->_prefix ="About_";
		$this->pk =  $this->_prefix.'ID';			
		$this->vsDb->setPrimaryKey($this->pk);
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'Title' 		=> stripcslashes($_POST[$this->_prefix.'Title']),
			$this->_prefix.'Content' 	=> stripcslashes($_POST[$this->_prefix.'Content']),
			$this->_prefix.'Summarize' 		=>stripcslashes( $_POST[$this->_prefix.'Summarize']),
			$this->_prefix.'Status' 		=>$_POST[$this->_prefix.'Status'],
			$this->_prefix.'Order' 		=>$_POST[$this->_prefix.'Order'],
			$this->_prefix.'Populer' 		=>$_POST[$this->_prefix.'Populer'],
			$this->_prefix.'CreateDate' 		=>mktime(),
			$this->_prefix.'LangID' 		=>$_POST[$this->_prefix.'LangID']?$_POST[$this->_prefix.'LangID']:$this->lang_id
			
		);
	}
//-----------------------------------------------------------------------//
	function getAssocAbout ($id = NULL) {
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
	function getHome( $iId=0){
		$where = " {$this->_prefix}LangID = {$this->lang_id} AND {$this->_prefix}Status = 1";		
		$res = $this->vsDb->getAllLimit($this->table,$where,"{$this->_prefix}Order", 'asc', 1);	
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