<?php
class baseGuide extends VS_Module_Base
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	var $group;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb,$oSmarty);
		//require_once('models/baseGroup.php');
	//	$this->group = new baseGroup();
		$this -> table = "tbl_guide";
		$this->_prefix ="Guide_";
		$this->pk =  $this->_prefix.'ID';	
		$this->vsDb->setPrimaryKey($this->pk);		
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'Name' 		=> stripcslashes($_POST[$this->_prefix.'Name']),			
			$this->_prefix.'Address' 	=> stripcslashes($_POST[$this->_prefix.'Address']),
			$this->_prefix.'Email' 		=>stripcslashes( $_POST[$this->_prefix.'Email']),
			$this->_prefix.'Birthday' 		=> $_POST[$this->_prefix.'Birthday'],
			$this->_prefix.'Sex' 		=> $_POST[$this->_prefix.'Sex'],
			$this->_prefix.'Yahoo' 		=> stripcslashes($_POST[$this->_prefix.'Yahoo']),
			$this->_prefix.'Skype' 		=>$_POST[$this->_prefix.'Skype'],
			$this->_prefix.'English' 		=>$_POST[$this->_prefix.'English'],
			$this->_prefix.'Info' 		=>stripcslashes( $_POST[$this->_prefix.'Info']),
			$this->_prefix.'Status' 		=>$_POST[$this->_prefix.'Status'],
			$this->_prefix.'Phone' 		=>$_POST[$this->_prefix.'Phone']
		);
	}
//-----------------------------------------------------------------------//
	function getAssocGroupProduct ($id = NULL) {
		if ($id !== NULL) {
			$id = $this->_prefix . "ID ='" . $id . "'";
		}
		return $this -> vsDb->getAssocTable('tblgroup',array ('Group_ID', 'Group_Name'),"Group_Type = 'groupproduct'");
	}
	/**
	 * 
	 * 
	 * 	@param integer $id
	*/
	function getDetailObject($id) {
		return  $this->vsDb->getRow($id);
	}
	
	function getOther($id){
		if($id)
			$where .= " {$this->_prefix}ID != {$id} ";
		return $this->getLimitProduct($where,"{$this->_prefix}CreateDate","","10");	
		
	}
	
	/**
	 * Function paging data for product
	 *
	 * @param  $iPerpage: record per page
	 * @param  $iCurrentPage: current page display
	 * @param  $sCondition: condition in where clause
	 * @param  $sOrder: order data
	 * @param  $sLimit: limit data
	 */
	
	/**
	 * Get limit product
	 *
	 * @param unknown_type $cond
	 * @param unknown_type $order
	 * @param unknown_type $sort
	 * @param unknown_type $limit
	 * @return unknown
	 */
	/**
	 * Get category of news
	 *
	 * @param unknown_type $iCategory: category id
	 * @return unknown
	 */
	function getDetailCategory($iCategory){
		global $oDb;
		$sql = "select * from tblgroup where Group_Type='groupproduct' and Group_ID='{$iCategory}'";
		$aResult = $oDb->getRow($sql);		
		return $aResult;
	}
	
	/**
	 * add record into database
	 *
	 */
	 function insert(){	 	
	 	return $this -> vsDb ->insert($this->arr_fields);
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
	
	 /**
	  * get Photo by product id
	  */
}
?>