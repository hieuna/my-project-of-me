<?php
class baseGroup extends VS_Module_Base
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb);
		$this -> table = "tblgroup";
		$this->_prefix ="Group_";
		$this->pk =  $this->_prefix.'ID';			
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'Name' 		=> stripcslashes($_POST[$this->_prefix.'Name']),
			$this->_prefix.'ParentID' 	=> stripcslashes($_POST[$this->_prefix.'ParentID']),
			$this->_prefix.'Content' 	=> stripcslashes($_POST[$this->_prefix.'Content']),
			$this->_prefix.'Description' 	=> stripcslashes($_POST[$this->_prefix.'Description']),
			$this->_prefix.'Order' 		=> $_POST[$this->_prefix.'Order'],
			$this->_prefix.'LangID' 	=>$_POST[$this->_prefix.'LangID']?$_POST[$this->_prefix.'LangID']:$this->lang_id,
			$this->_prefix.'Status' 		=> $_POST[$this->_prefix.'Status'],
		);
		
	}
	function run($task){
		
		switch ($task)
		{			
			case "add":
				$this->addItem();
				break;
			case "edit":
				$this->editItem();
				break;
			case "slide":
				redirect(SITE_URL."?mod=admin&amod=product&atask=photo&gid=".$_GET["id"]);
				break;
			case "delete":
				$this->deleteItem();
				break;
			case "multi_delete":
				$this->multiDeleteItem();
				break;
			case 'change_status':
				$this->changeStatus();
				break;		
			case "save_order":
				$this->saveOrder();
				break;	
			case "changeLangForAtt":
				$this->changeLangForAtt();
				break;
			case "changeLang":
				$this->changeLang();
				break;			
			case "option":
				$this -> buildFormOptions();
				break;			
			
			case "list" :	
			default: 			
				$this->listItem();
				 break;
		}
	}

	function addItem()	
	{		
		parent::getPath($this->get_config_vars('add_root_'.$_GET['atask']));
		$this -> buildForm('add');
	}
	
	function editItem()
	{
		$id = intval($_GET['id']);		
		parent::getPath($this->get_config_vars('edit_root_'.$_GET['atask']).": {$id}");		
		$row = $this -> vsDb -> getRow ( $id );
		$this -> buildForm( 'edit', $row );
	}
	
	function checkDelete($group_id)
	{
		global $oDb;
		$sql = "SELECT count(Group_ID) FROM tblgroup WHERE Group_ParentID IN (".$group_id.")";
		$count = $oDb->getOne($sql);
		if ($count)
		{
			return false;
		}
		return true;
	}
	
	function deleteItem()
	{
		$id = $_GET['id'];
		if ($this->checkDelete($id))
		{
			$this -> vsDb -> deleteWithPk ($id);
			$_SESSION['msg'] = $this->get_config_vars('msg_delete');
		}
		else 
			$_SESSION['msg'] = $this->get_config_vars('msg_no_delete_group');
		
		$this->listItem();	
	}
	
	function multiDeleteItem()
	{
		$arrId = $_GET['arr_check'];	
		$strId = implode(',',$arrId);
		if ($this->checkDelete($strId))
		{
			foreach ( $arrId as $iId )
			{
				$this -> vsDb -> deleteWithPk ($iId);
			}
			$_SESSION['msg'] = $this->get_config_vars('msg_delete');
		}
		else 
			$_SESSION['msg'] = $this->get_config_vars('msg_no_delete_group');
		$this->listItem();	
	}
	
	
	
	function saveOrder()
	{
		$arrOrder = $_GET[ $this->_prefix.'Order'];
		foreach ( $arrOrder as $key => $value )		{
			$this -> vsDb -> updateWithPk ( $key , array ( $this->_prefix.'Order' => $value ));		
	//		echo $key."- {$value},";
		}
		
		$_SESSION['msg'] = $this->get_config_vars('msg_saveorder');
		$this->listItem();
	}
	
	function buildForm ( $task, $arrData = array())
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
				
		if( $task == "edit" )
		{
			$form->setDefaults($arrData);
		}
		
		if( $task == "edit" ){			
			$idt=$arrData[ $this->_prefix.'ID'];
		}
		
		$siteUrl = SITE_URL;	
		echo "<script type=\"text/javascript\" src=\"{$siteUrl}lib/js/language.js\"></script>";
		$url = "?mod=admin&amod={$_REQUEST['amod']}&atask={$_GET['atask']}&task=changeLang&categoryid={$idt}&ajax";
		
		//$lang_default = $this->getLangDefault();
		//$lang_id = isset($arrData['Group_LangID'])?$arrData['Group_LangID']:$lang_default;
		//'onchange'=>"changeLang(this.value,'{$url}', '".$this->_prefix."ParentID"."'),changeLang(this.value,'{$url_att}', 'div_attribute')"
		//,'onchange'=>"changeLang(this.value,'{$url}', '".$this->_prefix."ParentID"."')"
		
		if ($_GET['atask'] == 'groupproduct')
			$arrAttribute = array('width' => 200);
		else 
			$arrAttribute = array('width' => 200);
		if($this->islang)
			$form -> addElement('select', $this->_prefix.'LangID', $this->get_config_vars('language'),$this->getAssocLang(), $arrAttribute );
			
		
		
		/*$arrPanrent[0]='--- None ---';		
		$this->setParent(&$arrPanrent,$idt,0,'',$lang_id);
		
		$form -> addElement('select',  $this->_prefix.'ParentID',$this->get_config_vars('parent'),$arrPanrent);*/
		$form -> addElement('text',  $this->_prefix.'Name',  $this->get_config_vars('name'), array('size' => 50, 'maxlength' => 255) );			
		$form -> addElement('text', $this->_prefix.'Order', $this->get_config_vars('order'), array('size' => 10, 'maxlenght' => 50) );
		
		$form -> addElement('checkbox', $this->_prefix.'Status', $this->get_config_vars('publish'));
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button'));
		$btn_group[] = $form -> createElement( 'button',null,'Back',array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );		
		$form -> addRule( $this->_prefix.'Name',$this->get_config_vars('title')." ".$this->get_config_vars('no_blank'),'required',null,'client' );
		$form -> addRule( $this->_prefix.'Order',$this->get_config_vars('order')." ".$this->get_config_vars('no_number'),'numeric',null,'client');		
		
		if( $form -> validate())
		{
			if( $_POST['id'] == '' )
			{
				$this->arr_fields[$this->_prefix.'Type'] =$_GET['atask'];
				$group_id = $this -> vsDb ->insert($this->arr_fields);
				$_SESSION['msg'] = $this->get_config_vars('msg_add');
			}
			else 		
			{	
				$this -> vsDb -> updateWithPk ( $_POST['id'],$this->arr_fields );
				$group_id = $_POST['id'];
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			
			$this -> redirect($_COOKIE['re_dir']);
		}		
		$form->display();		
	}
	
	function listItem()
	{
		global $oDb,$oSmarty;
		global $oDatagrid;	
		$root_path = $this->get_config_vars('list_root_'.$_GET['atask']);
		$this->getPath($root_path);		
		
		$table = $this->table;
		$where[] = $this->_prefix."Type = '".$_GET['atask']."'";
		if($this->islang) {
			if($_GET[$this->_prefix."LangID"]){
				
				$where[] = "{$this->_prefix}LangID='{$_GET[$this->_prefix."LangID"]}'";
			}
			
			$sSelectLang = ",(select name from lang where id={$this->_prefix}LangID) as {$this->_prefix}LangID";
		}
		
		$condition = implode(" AND ", $where);
		$order = ($_GET['sort_by'])?($_GET['sort_by']): $this->_prefix."ID";
		$orderType = $_GET['sort_value'];
		
		$aData = $this -> multiLevel( $table, $this->_prefix."ID",  $this->_prefix."ParentID", "*{$sSelectLang}", "{$condition}", "{$order} {$orderType}");
		
		
		foreach ( $aData as $key => $row){
			if( $row['level'] > 0){				
				$aData[$key][ $this->_prefix."Name"] = $this -> getPrefix( $row['level']).$row[ $this->_prefix."Name"];
			}
		}
		
		$oDatagrid->setMethod("?mod=admin&amod={$_REQUEST['amod']}&atask={$_GET['atask']}");
		$oDatagrid->setTable($table);
		
		$oDatagrid->addField(array("field"=>$this->_prefix."ID","primary_key"=>true,"display"=>$this->get_config_vars('id'),"sortable"=>true,"width"=>50));
		$oDatagrid->addField(array("field"=>$this->_prefix."Name","display" => $this->get_config_vars('title'),"sortable" => true));
		$oDatagrid->addField(array("field"=>$this->_prefix."Order","display"=>$this->get_config_vars('order'),"datatype"=>"order","sortable"=>true));		
		
		if($this->islang){
			$oDatagrid->addFilter(array("field"=>$this->_prefix."LangID","display"=>$this->get_config_vars('language'),"name"=>$this->_prefix."LangID",
				"selected"=>isset($_REQUEST[$this->_prefix."LangID"])?$_REQUEST[$this->_prefix."LangID"]: '',"options"=>$this->getAssocLang()));
			
			$oDatagrid->addField(array("field"=>$this->_prefix."LangID","display"=>$this->get_config_vars('language')));		
		}
		
		$oDatagrid->addField(array("field"=>$this->_prefix."Status","display"=>$this->get_config_vars('publish'),"datatype"=>"publish"));
		
		$oDatagrid->addTaskAll(array("task" => "multi_delete","display" => $this->get_config_vars('delete')));
		$oDatagrid->setTask($this->getAct());
		
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		$oDatagrid->displayGridTable($aData);		
	}
	
	/** 
		get category as array with parent-child
	*/
	function setParent(&$arrPanrent,$id,$idp=0,$text='',$lang_id=0,$type='', $partten = " --- ")
	{		
		global $oDb;
		$stbl = $this-> table;
		// type of category
		if ($type == '') $type = $_GET['atask'];
		// default sql where
		$sWhere = "{$this->_prefix}ParentID={$idp} and {$this->_prefix}Type='{$type}'";
		// if use language
		if ($this->islang){
			$sWhere .= " and {$this->_prefix}LangID = '".$lang_id."'";			
		}
		//if has id of current item, get other item
		if($id){
			$sWhere.= " and {$this->_prefix}ID<>{$id}";
		}
		
		$sql="select {$this->_prefix}ID,".$this->_prefix."Name from {$stbl} where {$sWhere}";	
		$rows=$oDb->getAll($sql);		
		if(count($rows)){
		  	foreach($rows as $row)
		    {
				 $arrPanrent[$row["{$this->_prefix}ID"]] =$text. $row["{$this->_prefix}Name"];
				 $this->setParent($arrPanrent,$id,$row["{$this->_prefix}ID"],$text.$partten,$lang_id,$type);
			}
		}
	}

	/**
	 * Get Assoc 
	 *
	 * @param integer $lang_id
	 * @param string $type
	 * @return array
	 */
	function getAssocGroupLangID($lang_id = NULL,$type='groupnews'){
		if($lang_id == NULL)
			$lang_id = $this->lang_id;		
	
		$where  = "Group_Type = '".$type."' AND Group_LangID =".$lang_id;		
		return  $this-> vsDb ->getAssocTable('tblgroup',array('0'=>'Group_ID','1'=>'Group_Name'),$where);
	}
	
	function changeLang()
	{
		global $oSmarty;
		$lang_id = $_GET['lang_id'];
		$categoryId = $_GET['categoryid'];
		$arrParent[0]='--- None ---';	
		$this->setParent(&$arrParent,0,0,'',$lang_id,$_GET["atype"]);
		
		$sContent.="<select name=\"{$this->_prefix}ParentID\" id=\"{$this->_prefix}ParentID\">";
		foreach($arrParent as $k=>$v){
			$sContent .= "<option value=\"{$k}\">{$v}</option>";
		}
		$sContent.="</select>";
		echo $sContent;
	}
	
	function changeLangForAtt()
	{
		$lang_id = $_GET['lang_id'];
		include("models/baseGroupProduct.php");
		$obj = new baseGroupProduct();
		$value = $obj->getAssocAttribute($lang_id);	
		$default = $obj->getDefaultAttribute(0,$lang_id);
		echo $obj->getFormAttribute('attribute',$value,$default,'div_attribute');
	}
	
	function changeStatus(){
		global $oDb;
		$status =$_GET['status'];
		$id = $_GET['id'];
		$this-> vsDb ->updateWithPk($id, array("{$this->_prefix}Status" => $status));
		return ;
	}
	
	function getRootPath(&$aResult,$iCategoryId=0){
		global $oDb;
		if(!$iCategoryId) return ;
		$sQuery = "select * from {$this->table} where Group_ID='{$iCategoryId}'";
		$result = $oDb->getRow($sQuery);
		if($result){
			$aResult[] = $result;
			$this->getPath(&$aResult, $result['Group_ParentID']);
		}
		return $aResult;
	}
	
	function buildFormOptions ()
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
			$action=$_GET["action"];	
		if( $action == "edit" )
		{
			$arrData= $this->db->getRow("select * from tbl_reviewofcategory where RType_ID='".$_GET["oid"]."'");
			$form->setDefaults($arrData);
		}
		
		
		$siteUrl = SITE_URL;	
		//$lang_default = $this->getLangDefault();
		//$lang_id = isset($arrData['Group_LangID'])?$arrData['Group_LangID']:$lang_default;
		//'onchange'=>"changeLang(this.value,'{$url}', '".$this->_prefix."ParentID"."'),changeLang(this.value,'{$url_att}', 'div_attribute')"
		//,'onchange'=>"changeLang(this.value,'{$url}', '".$this->_prefix."ParentID"."')"
		$opt=$this->db->getAll("select * from tbl_reviewofcategory where RType_GroupID='".$_GET["id"]."'");
			$this->showAllOption($opt);
			//$form -> addElement('select', $this->_prefix.'LangID', $this->get_config_vars('language'),$this->getAssocLang(), $arrAttribute );
			
		$form -> addElement('text', 'RType_Name',  $this->get_config_vars('name'), array('size' => 50, 'maxlength' => 255) );			
		$form -> addElement('text', 'RType_Percent',  "Percent", array('size' => 50, 'maxlength' => 255) );			
		$form -> addElement('textarea','RType_Description', "Description", array('style' => 'width:400px;height:90px') );
		
		$form -> addElement('checkbox', 'RType_Status', $this->get_config_vars('publish'));
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button'));
		$btn_group[] = $form -> createElement( 'button',null,'Back',array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);		
		$form->addElement( 'hidden', 'id', $arrData['RType_ID'] );		
		$form->addElement( 'hidden', 'groupid', $_GET["id"]);		
		$form -> addRule( 'RType_Name',$this->get_config_vars('title')." ".$this->get_config_vars('no_blank'),'required',null,'client' );
		
		if( $form -> validate())
		{
			$aDataT= array(
			"RType_Name" => $_POST["RType_Name"],
			"RType_Description" => $_POST["RType_Description"],
			"RType_Status" => $_POST["RType_Status"],
			"RType_Percent" => $_POST["RType_Percent"],
			"RType_GroupID" => $_POST["groupid"],
			);
			$this -> vsDb -> setTable( ' tbl_reviewofcategory');	
			if( $_POST['id'] == '' )
			{
				$group_id = $this -> vsDb ->insert($aDataT);
				$_SESSION['msg'] = $this->get_config_vars('msg_add');
			}
			else 		
			{	
				$this -> vsDb -> updateWithPk ( $_POST['id'],$aDataT );
				$group_id = $_POST['id'];
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$this -> vsDb -> setTable( $this->table );	
			
			$this -> redirect("?mod=admin&amod=business&atask=groupTruelocal&task=option&id=".$_POST["groupid"]);
		}		
		$form->display();		
	}
	
	function showAllOption($adata){
		if($adata){
			echo"<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\"><tr><td  align='center'>#</td><td>Name</td><td>Description</td><td>Percent</td><td></td></tr>";
			foreach($adata as $key=> $value){
				echo"<tr><td width='30' align='center'>".($key+1)."</td><td width='150'>".$value["RType_Name"]."</td><td width='400'>".$value["RType_Description"]."</td><td width='150'>".$value["RType_Percent"]." %</td><td><a href='?mod=admin&amod=business&atask=groupTruelocal&task=option&id=".$_GET["id"]."&action=edit&oid=".$value["RType_ID"]."'>Edit</a>, <a href=''>Delete</a></td></tr>";
			}
			echo"</table>
			<h3>Form </h3>";
		}
	}
}
?>