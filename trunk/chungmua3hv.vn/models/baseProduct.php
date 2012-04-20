<?php
class baseProduct extends VS_Module_Base
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
		require_once('models/baseGroup.php');
		$this->group = new baseGroup();
		$this -> table = "tblproduct";
		$this->_prefix ="Product_";
		$this->pk =  $this->_prefix.'ID';	
		$this->vsDb->setPrimaryKey($this->pk);		
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'Title' 		=> stripcslashes($_POST[$this->_prefix.'Title']),			
			$this->_prefix.'Content' 	=> stripcslashes($_POST[$this->_prefix.'Content']),
			$this->_prefix.'Summary' 		=>stripcslashes( $_POST[$this->_prefix.'Summary']),
			$this->_prefix.'GroupID' 		=> $_POST[$this->_prefix.'GroupID'],
			$this->_prefix.'LangID' 		=> $_POST[$this->_prefix.'LangID'],
			$this->_prefix.'Order' 		=> stripcslashes($_POST[$this->_prefix.'Order']),
			$this->_prefix.'Hot' 		=>$_POST[$this->_prefix.'Hot'],
			$this->_prefix.'Price' 		=>$_POST[$this->_prefix.'Price'],
			$this->_prefix.'Status' 		=>$_POST[$this->_prefix.'Status']			
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
	function pagingData($iPerpage =10, $iCurrentPage=1, $sUrlPath='', $sCondition='', $sOrder='', $sLimit=''){
		global $oDb, $oSmarty;
		
		// get Total record		
		if ($sCondition!= '') {
			$sCondition = " AND {$sCondition}";
		}
		
		$sQuery = "	SELECT count(*) as Counter
					FROM {$this->table} JOIN tblgroup g ON ({$this->_prefix}GroupID = g.Group_ID)  
					WHERE  g.Group_LangID ={$this->lang_id} AND {$this->_prefix}Status =1 {$sCondition}";
		
		$iTotalRecord = $oDb->getOne($sQuery);
		
		if($iTotalRecord){
			include_once(SITE_DIR."lib/paging/paging.php");
			$iCurrentPage = ($iCurrentPage)?$iCurrentPage:1;
			if($sOrder != '') $sOrder = " ORDER BY {$sOrder}";
			if($sLimit!='') $sLimit = " LIMIT {$sLimit}"; 
			
			$oPaging = new paging($iPerpage, $iTotalRecord, $iCurrentPage, $sUrlPath);
			$sPaging = $oPaging->getStringPaging();
			
			$sQuery = "	SELECT *
					FROM {$this->table} JOIN tblgroup g ON ({$this->_prefix}GroupID = g.Group_ID)  
					WHERE  g.Group_LangID ={$this->lang_id} AND {$this->_prefix}Status =1 {$sCondition}";
			$sQuery = $sQuery. $sOrder. $sLimit;			 
			$aResultSet = $oDb->getAll($sQuery);			
		foreach($aResultSet as $key=>$valule)	
		{
		// attribute for this product
   		$sql = "select t1.id, t1.title, t2.attribute_value from tbl_attribute t1 join tbl_product_attribute t2 on(t1.id=t2.attribute_id) where t2.product_id='".$valule['Product_ID']."'";
   		$aAttribute = $oDb->getAll($sql);
   		$aResultSet[$key]['options'] = $aAttribute;
		}

			$oSmarty->assign("sPaging", $sPaging);
			$oSmarty->assign("aProducts", $aResultSet);
			
		}else{
			$oSmarty->assign("sPaging", $sPaging);
			$oSmarty->assign("resItem", $aResultSet);
		}
	}
	
	/**
	 * Get limit product
	 *
	 * @param unknown_type $cond
	 * @param unknown_type $order
	 * @param unknown_type $sort
	 * @param unknown_type $limit
	 * @return unknown
	 */
	function getLimitProduct($cond ='',$order = '', $sort= "DESC", $limit = 20) {
		 
		$sql = "SELECT * 
		 		FROM {$this->table}  JOIN tblgroup g ON ({$this->_prefix}GroupID = g.Group_ID)  
		 		WHERE  g.Group_Type = 'groupproduct' AND g.Group_LangID ={$this->lang_id} AND {$this->_prefix}Status =1";
		if ($cond) {
			$sql .= " AND " . $cond;
		}
        $sql .= ' order by ' . $order . ' ' . $sort;
		if ($limit !== NULL) {
			$sql .= " LIMIT ". $limit;
		}		
        $res = $this -> db -> getAll($sql);  		
		return $res;
	}
	
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
	 function getPhotoByPro($pro_id){
	 	global $oDb;
	 	$sql = "SELECT Photo_Default,Photo_Name,Photo_ID FROM tblproduct_photo WHERE Photo_ProductID=".$pro_id;
	 	$arrPhoto = $oDb->getAll($sql);
	 	return $arrPhoto;
	 }
	 
	 /**
	  * get Product Category
	  */
	 function getCategory(){
	 	global $oDb;
	 	$sQuery = "SELECT * FROM tblgroup WHERE Group_Status='1' AND Group_Type='groupproduct' and Group_LangID='{$this->lang_id}' ORDER BY Group_Order";
	 	
	 	$aResult = $oDb->getAll($sQuery);
	 	
	 	return $aResult;
	 }
	 
	 /**
	  * Get child category
	  *
	  * @param unknown_type $categoryId
	  */
	 function getCategoryChild($categoryId){
	 	global $oDb;
	 	$tmp = $categoryId;
	 	$aResult[] = $categoryId;
	 	while ($tmp!=''){
		 	$sQuery = "SELECT Group_ID FROM tblgroup WHERE Group_Status='1' AND Group_Type='groupproduct' and Group_LangID='{$this->lang_id}' and Group_ParentID in({$tmp}) ORDER BY Group_Order";
		 	$aChild = $oDb->getCol($sQuery);
		 	$aResult = array_merge($aResult, $aChild);		 	
		 	$tmp = implode(',',$aChild);
	 	}
	 	
	 	return $aResult;
	 }
}
?>