<?php

class CModule extends VS_Module_Base{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct( $oDb );
		$sTbl = "admin_menu";
		$this -> vsDb -> setTable( $sTbl );
	}

	function addItem()
	{
		$this -> getPath("System Config >> Manage Module >> Add Module ");		
		$this -> buildForm();
	}
	
	function editItem()
	{
		$id = $_GET['id'];
		$this -> getPath("System Config >> Manage Module >> Edit Module with id: {$id}");	
		$row = $this -> vsDb -> getRow( $id );
		$this -> buildForm( $row );
	}

	function deleteItem()
	{
		global  $oDb;
		$id = $_GET["id"];
		$sql = "delete from tbl_usertype_moduleroll where module_roll_id in (select id from tbl_module_roll where module_id ='{$id}')";
		$res = $oDb -> query( $sql );
		$sql = "delete from tbl_module_roll where module_id ='{$id}'";
		$res = $oDb -> query( $sql );
		$this -> vsDb -> deleteWithPk( $id );
		$msg = "Item has been deleted at ". date('Y-m-d h:i:s');
		$this -> listItem( $msg );
	}
	
	function deleteItems()
	{
		global $oDb;
		$aItems	 = $_GET['arr_check'];
		if(is_array( $aItems) && count( $aItems) > 0){
			$sItems = implode( ',', $aItems );
			$sql = "delete from tbl_usertype_moduleroll where module_roll_id in (select id from tbl_module_roll where module_id in ({$sItems}))";
		$oDb -> query( $sql );
		$sql = "delete from tbl_module_roll where module_id in ({$sItems})";
		$oDb -> query( $sql );
			$this -> vsDb -> deleteWithPk( $sItems );
		}
		$msg = "Item(s) has been deleted successfull!";
		$this -> listItem( $msg );
	}
	
	function changeStatusMultiple( $status = 0 )
	{
		$aItems	 = $_GET['arr_check'];
		if(is_array( $aItems) && count( $aItems) > 0){
			$sItems = implode( ',', $aItems );
			$this -> vsDb -> updateWithPk( $sItems, array("showed" => $status) );
		}
		$msg = "Item(s) has been change status successfull!";
		$this -> listItem( $msg );
	}
	
	function saveOrder(){	
		$aItem = $_GET['z_index'];
		if(is_array($aItem) && count( $aItem ) > 0){
			// save order for item.
			foreach( $aItem as $key => $value){
				if( !is_numeric($value)) $value = 0;				
				$this -> vsDb -> updateWithPk( $key, array('z_index' => $value ));
			}
		}	
		$msg = "Item(s) has been save order successfull!";
		$this -> listItem( $msg );
	}
	
	function getRoll($moduleId){
		global $oDb;
		$sResult = "";
		$stbl1 = 'tbl_roll';
		$aChecked = array();
		if( $moduleId ){
			$stbl2 = 'tbl_module_roll';
			if($moduleId ) $where = " and module_id = '{$moduleId}'";
			$sql = "SELECT t1.id FROM {$stbl1} t1 join (SELECT * FROM {$stbl2} WHERE 1 {$where}) t2 on(t1.id = t2.roll_id) WHERE 1";
			$aChecked = $oDb -> getCol( $sql );
		}
		
		$sql = "SELECT  id, name FROM {$stbl1} WHERE 1 ORDER BY ordered";
		$result = $oDb -> getAssoc( $sql );
		if(count($result) > 0){
			foreach ( $result as $key => $val){
				if( in_array( $key, $aChecked )) $sChecked = "checked=\"checked\"";
				else $sChecked = "";
				$sResult .= "<input type=\"checkbox\" name=\"module_roll[]\" value=\"{$key}\" {$sChecked}>{$val} &nbsp;&nbsp;&nbsp;";
			}
		}
		
		return $sResult;
	}
	
	function removeRoll( $moduleId ){
		global $oDb ;
		$stbl ="tbl_module_roll";
		if( $moduleId ){			
			$sql = "DELETE FROM {$stbl} WHERE module_id = '{$moduleId}'";
			$oDb -> query ( $sql );
		}
	}
	
	function addRoll( $moduleId, $aRollId ){
		global $oDb ;
		$stbl = "tbl_module_roll";
		foreach( $aRollId as $key => $val ){
			$sql = "INSERT INTO {$stbl}(module_id, roll_id) VALUES ('{$moduleId}', '{$val}')";
			$oDb -> query ( $sql );
		}
	}
	
	function buildForm( $data=array() , $msg = ''){
		
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style='padding:10px 15px 0 20px;'");
		
		$form -> setDefaults($data);		
		$form -> addElement('text', 'title', 'Title', array('size' => 50, 'maxlength' => 255));
		$form -> addElement('text', 'link', 'Link', array('size' => 50, 'maxlength' => 255));
		$aParent = array(0 => "- - - Root Module - - -" ) + $this -> getParentModule();
		$form -> addElement('select', 'parent_id', 'Parent', $aParent);
		$form -> addElement('text', 'z_index', 'Order', array('size' => 10, 'maxlength' => 50));
		$aShowed = array( 0 , 1);
		$form -> addElement('checkbox', 'showed', 'Showed');
		$form -> addElement("static", null, "Select Roll", $this -> getRoll( $data['id']));
		$btn_group[] = $form -> createElement('submit',null,'Save',array("style"=> "border:1px solid gray; padding:0 5px 0 5px;"));		
        $btn_group[] = $form -> createElement('button',null,'Go Back',array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'', "style"=> "border:1px solid gray;"));      
        $form -> addGroup($btn_group);
      
		$form->addElement('hidden', 'id', $data['id']);		
		
        $form -> addRule('title','Title cannot be blank','required',null,'client');
		//$reg = "/[a-zA-Z0-9\_]+$/";
		//$form -> addRule('title', "Title can not contain special character or space", 'regex', $reg);
		$form -> addRule('order', 'Order must be a number', 'numeric');
		
		if( $form -> validate())
		{	
			$aData  = array(
				"title" => $_POST['title'],
				"link" => $_POST['link'],
				"parent_id" => $_POST['parent_id'],
				"z_index" 	=> $_POST['z_index'],
				"showed" 	=> $_POST['showed']
			);
			if( !$_POST['id'] ){
				
				 $id = $this -> vsDb -> insert($aData);
				 if( is_array($_POST['module_roll']) && count( $_POST['module_roll']) > 0){
				 	$this -> addRoll( $id, $_POST['module_roll']);
				 }
				 $msg = "Item has been inserted at ". date('Y-m-d h:i:s');
			}else {
				$id = $_POST['id'];				
				$this -> vsDb -> updateWithPk($id, $aData);
				$this -> removeRoll( $id );
				if( is_array($_POST['module_roll']) && count( $_POST['module_roll']) > 0){
				 	$this -> addRoll( $id, $_POST['module_roll']);
				}
				$msg = "Item has been updated at ". date('Y-m-d h:i:s');
			}
			
			$this -> redirect($_COOKIE['re_dir']. "&msg={$msg}");
		}
		
		$form->display();
	}
	
	function getParentModule(){
		@eval( getGlobalVars());
		$sTbl = $this -> vsDb -> getTable();

		$query = "SELECT id, title FROM {$sTbl} WHERE parent_id=0";
		$result = $oDb -> getAssoc( $query );
		
		return $result;
	}
	
	function changeStatus( $itemId , $status ){
		$aData = array( 'showed' => $status );
		$this -> vsDb -> updateWithPk( $itemId, $aData );
		return true;
	}
	
	function listItem( $sMsg= '' )
	{		
		global $oDb;
		global $oDatagrid;				
		
		$this->getPath("User module > Manage Module > List Module");						
		$submit_url= "?mod=admin&amod={$_REQUEST['amod']}&atask=module";
		$oDatagrid->setMethod($submit_url);
		
		$table = $this -> vsDb -> getTable();
		
		$order = ($_GET['sort_by'])?($_GET['sort_by']):'z_index';
		$orderType = $_GET['sort_value'];
		if( $_GET['filter_title']!= '')
			$where[] = " title like '{$_GET['filter_title']}'";
		if( $_GET['filter_show']!= '')
			$where[] = " showed = '{$_GET['filter_show']}'";
		
		$where[] = " editable = '1'";	
		if( is_array( $where) && count( $where )> 0)
			$condition = implode( " and ", $where );
		
		$aData = $this -> multiLevel( $table, "id", "parent_id", "*", "{$condition}", "{$order} {$orderType}");
		
		foreach ( $aData as $key => $row){
			if( $row['level'] > 0){				
				$aData[$key]['title'] = $this -> getPrefix( $row['level']).$row['title'];
			}
		}
		
		$oDatagrid->setTable($table);
		
		$oDatagrid->addFilter(array('field' => 'title','display' => 'Title','type' => 'text','name' => 'filter_title','selected' => $_REQUEST['filter_title']));
		$oDatagrid->addFilter(array('field'=>'showed','display'=>'Showed','name'=>'filter_show','selected'=>$_REQUEST['filter_show'],'options'=>array('No','Yes')));
		
		$oDatagrid->addField(array("field" => "id","primary_key" =>true,"display" => "Id","sortable" => true));
		$oDatagrid->addField(array("field" => "title","display" => "Title","sortable" => true,"style"=>"text-align:left;"));
		$oDatagrid->addField(array("field" => "z_index","display"=> "Order","datatype" => "order","sortable" => true,"order_default"=> "asc"));
		$oDatagrid->addField(array("field" => "showed","display" => "Showed","datatype" => "publish","sortable" => true));
		$oDatagrid->addField(array("field" => "create_date","display" => "Create Date","datatype" => "date","sortable" => true));
		
		$oDatagrid->addTaskAll(array("task" => "delete_multile","display" => "Delete"));
		$oDatagrid->addTaskAll(array("task" => "delete_multile","display" => "Delete"));
		$oDatagrid->addTaskAll(array("task" => "unpublish","display" => "UnPublish"));
		
		$oDatagrid->setTask($this->getAct());
		
		if( $sMsg )
			$oDatagrid -> setMessage( $sMsg );
		$oDatagrid->displayGridTable($aData);		
	}		
	
}

?>