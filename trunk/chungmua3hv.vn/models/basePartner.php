<?php
class basePartner extends VS_Module_Base
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb);
		$this -> table = "tblpartner";
		$this->_prefix ="Partner_";
		$this->pk =  $this->_prefix.'ID';			
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'LangID' 		=> $_POST[$this->_prefix.'LangID'],			
			$this->_prefix.'Name' 			=> stripcslashes($_POST[$this->_prefix.'Name']),			
			$this->_prefix.'Link' 			=>stripcslashes( $_POST[$this->_prefix.'Link']),
			$this->_prefix.'Order' 			=>stripcslashes( $_POST[$this->_prefix.'Order']),
			$this->_prefix.'Summary' 		=>stripcslashes( $_POST[$this->_prefix.'Summary']),
			$this->_prefix.'Status' 		=>$_POST[$this->_prefix.'Status']
		);
	}
//-----------------------------------------------------------------------//
	function getAssocPosition ($id = NULL) {
		if ($id !== NULL) {
			$id = "Position_ID ='" . $id . "'";
		}
		return $this -> vsDb->getAssocTable('tblposition',array ('Position_ID', 'Position_Name'));
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