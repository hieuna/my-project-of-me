<?php

class CRoll extends VS_Module_Base{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct( $oDb );
		$sTbl = "tbl_roll";
		$this -> vsDb -> setTable( $sTbl );
	}
	
	function addItem()
	{	
		$this -> getPath("System Config >> Manage Roll >> Add Item");		
		$this -> buildForm( $row );
	}

	function editItem()
	{
		$id = $_GET['id'];
		$this -> getPath("System Config >> Manage Roll >> Edit Item with id: {$id}");
		$row = $this -> vsDb -> getRow( $id );
		$this -> buildForm( $row );
	}

	function deleteItem()
	{	
		global  $oDb;
		$id = $_GET["id"];
		$sql = "delete from tbl_usertype_moduleroll where module_roll_id in (select id from tbl_module_roll where roll_id ='{$id}')";
		$res = $oDb -> query( $sql );
		$sql = "delete from tbl_module_roll where roll_id ='{$id}'";
		$res = $oDb -> query( $sql );
		$this -> vsDb -> deleteWithPk( $id );
		$msg = "Item has been deleted at ". date('Y-m-d h:i:s');
		$this -> listItem( $msg );
	}	
	
	function saveOrder(){	
		$aItem = $_GET['ordered'];
		if(is_array($aItem) && count( $aItem ) > 0){
			// save order for item.
			foreach( $aItem as $key => $value){
				if( !is_numeric($value)) $value = 0;				
				$this -> vsDb -> updateWithPk( $key, array('ordered' => $value ));
			}
		}	
		$msg = "Item(s) has been save order successfull!";
		$this -> listItem( $msg );
	}
	
	function buildForm( $data=array() , $msg = ''){
		
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style='padding:10px 15px 0 20px;'");
		
		$form -> setDefaults($data);

		$form -> addElement('text', 'name', 'Roll Name', array('size' => 50, 'maxlength' => 255, "{$sAttReadonly}" => ""));
		//$form -> addElement('file', 'icon', "Icon Roll");
		$form -> addElement('text', "ordered", 'Order');
		
		$btn_group[] = $form -> createElement('submit',null,'Save',array("style"=> "border:1px solid gray; padding:0 5px 0 5px;"));		
        $btn_group[] = $form -> createElement('button',null,'Go Back',array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'', "style"=> "border:1px solid gray;"));      
        $form -> addGroup($btn_group);
      
		$form->addElement('hidden', 'id', $data['id']);		
        $form -> addRule('variable','Title cannot be blank','required',null,'client');
		
		if( $form -> validate())
		{
			if( !$_POST['id'] ){
				 $this -> vsDb -> insert($_POST);
				 $msg = "Item has been inserted at ". date('Y-m-d h:i:s');
			}else {
				$id = $_POST['id'];
				$this -> vsDb -> updateWithPk($id, $_POST);
				$msg = "Item has been updated at ". date('Y-m-d h:i:s');
			}
			
			$this -> redirect($_COOKIE['re_dir']."&msg={$msg}");
		}
		
		$form->display();
	}	
	
	function listItem( $sMsg = '')
	{		
		global $oDb;
		global $oDatagrid;				
		
		$this->getPath("System Config > Manage Roll > List Roll");
		$submit_url= "?mod=admin&amod={$_REQUEST['amod']}&atask={$_REQUEST['atask']}";
		$oDatagrid->setMethod($submit_url);
		$oDatagrid->setTable($this->vsDb->getTable());
		
		$oDatagrid->addField(array("field" => "id","primary_key" =>true,"display" => "Id","sortable" => true));
		$oDatagrid->addField(array("field" => "name","display" => "Name","link"	=> "{$submit_url}&task=edit","sortable" => true));
		$oDatagrid->addField(array("field" => "ordered","display" => "Order","datatype"	=> "order","sortable" => true,"order_default"=> "asc"));
		$oDatagrid->addField(array("field" => "editable","visible" => "hidden"));
		
		$aAction = $this->getAct();
		$aAction[1]['display'] = array('field' => 'editable', 'operation' => 'equal', 'value' => '1');	
		$aAction[2]['display'] = array('field' => 'editable', 'operation' => 'equal', 'value' => '1');	
		
		$oDatagrid->setTask($aAction);
		if ( $sMsg )
			$oDatagrid -> setMessage( $sMsg );
		$oDatagrid->displayGrid();
		
	}		
	
}

?>