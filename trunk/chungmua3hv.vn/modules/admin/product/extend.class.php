<?php
class CExtend extends VS_Module_Base
{	
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);		
		$this->table = "tbl_attribute";
		$this->vsDb->setTable($this->table);
		$this->mod = "attribute";
		$this->type = "tour";
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> listItem();
				break;
			case 'add':
				$this -> addItem();
				break;
			case 'edit':
				$this -> editItem();
				break;
			case 'delete':
				$this -> deleteItem();
				break;
			case 'multi_delete':
				$this -> multiDelete();
				break;
			case 'change_status':
				$this -> changeStatus();
				break;
			case 'save_order':
				$this -> saveOrder();
				break;
		}
		
	}
	
	function listItem( $sMsg ='')
	{		
		global $oDb, $oSmarty, $oDatagrid;		
		
		$this -> getPath($oSmarty->get_config_vars('list_root_'.$this->mod));					
		$submit_url= "?mod=admin&amod={$_GET['amod']}&atask={$_GET['atask']}";
		$oDatagrid->setMethod($submit_url);
		$oDatagrid->setTable($this->table);
		$oDatagrid->addFilter(
			array(
				'field'=>"title",
				'display' => "Nhập từ khóa",
				'type'=>'text',
				'name' => $this->_prefix."title",
				'selected'=> $_REQUEST["title"]
			)
		);
		if($this->islang){		
			$oDatagrid->addFilter(
				array(
				"field" 	=> "lang_id",
				"display" 	=> $this->get_config_vars('language'),
				"name" 		=> "lang_id",
				"selected" 	=> isset($_REQUEST["lang_id"])?$_REQUEST["lang_id"]: '',
				"options"	=> $this->getAssocLang()
				)			
			);	}
		
		$oDatagrid->addField(array("field" =>"id","primary_key" =>true,"display"=>$oSmarty->get_config_vars('id'),"sortable"=>true));
		$oDatagrid->addField(array("field" => "title","display" => $oSmarty->get_config_vars('title'),"link" => "{$submit_url}&task=edit","sortable"=>true));
		$oDatagrid->addField(array("field"	=> "type","display"	=> $oSmarty->get_config_vars('type'),"sortable"=>true));
		$oDatagrid->addField(array("field"	=> "z_index","display"	=> $oSmarty->get_config_vars('order'),"datatype"=>"order","sortable"=>true));		
		$oDatagrid->addField(array("field"	=> "status","display"=> $oSmarty->get_config_vars('status'),"datatype"=>"publish","sortable"=>true));		
			
		$oDatagrid -> setMessage( $_SESSION['sMsg'] );
		$_SESSION['sMsg']="";				
		
		#$oDatagrid->debug();
		$oDatagrid->addTaskAll(array("task" => "multi_delete","display" => "Delete"));
		$oDatagrid->setTask($this->getAct());
		$oDatagrid->where(" product_type ='{$this->type}' ");
		
		$oDatagrid->displayGrid();
	}
	
	function addItem()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));		
		$this -> buildForm('add');
	}
	
	function editItem()
	{
		global $oDb,$oSmarty;
		$id = intval($_GET['id']);
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod));			
		$row = $oDb->getRow("SELECT * FROM {$this->table} WHERE id='{$id}'");	
		$this -> buildForm( 'edit', $row );
	}
	
	function saveItem(){
		if($_REQUEST['id']){
			$this->editItem($_REQUEST['id']);
		}else{
			$this->addItem();	
		}
		
	}
	
	function deleteItem()
	{
		global $oDb,$oSmarty;
		$id = $_GET['id'];
		$oDb->query("DELETE FROM {$this->table} WHERE id='{$id}'");
		$_SESSION['msg'] =$oSmarty->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}	

	function multiDelete()
	{
		$arrId = $_GET['arr_check'];	
		foreach ( $arrId as $iId ){
			$this->vsDb->deleteWithPk($iId);
		}
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);	
	}
		
	function buildForm ( $task, $arrData = array() )
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		@eval(getGlobalVars());				
		if( $task == "edit" ){			
			$form->setDefaults($arrData);			
		}
		$aExtendType = array('text'=>'Text','number'=>'Number');
		$lang_default = $this->getLangDefault();
		$lang_id = isset($arrData['lang_id'])?$arrData['lang_id']:$lang_default;		
		
		if($this->islang)
			$form -> addElement('select', 'lang_id', $this->get_config_vars('language'),$this->getAssocLang(), $arrAttribute );
		
		$form -> addElement('text', 'title',  $oSmarty->get_config_vars('title'), array('size' => 50, 'maxlength' => 255) );	
		$form->addElement('select','type',$oSmarty->get_config_vars('type'), $aExtendType);
		$form -> addElement('text', 'z_index',  $oSmarty->get_config_vars('order'), array('size' => 10, 'maxlength' => 50) );			
		$form -> addElement('textarea', 'description',  $oSmarty->get_config_vars('summarize'), array('rows' => 8, 'cols' => 70));	
		$form->addElement('checkbox','status',$oSmarty->get_config_vars('status'));
	//	$form->addElement('checkbox','is_home','Home');
			
		$form->addElement( 'hidden', 'id', $arrData['id'] );	
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addRule('title',$oSmarty->get_config_vars('required'),"required");
		$form->addRule('name',$oSmarty->get_config_vars('required'),"required");	
		$form->addRule("z_index",$oSmarty->get_config_vars('numeric'),"numeric");		
		
		if( $form -> validate())
		{
			$aData = array(				
				'title'		=>$_POST['title'],
				'type'		=>$_POST['type'],
				'product_type'		=>$this->type,
				'description'=>$_POST['description'],
				'lang_id'=> stripcslashes($_POST['lang_id']),
				'z_index' 	=> isset($_POST['z_index'])?$_POST['z_index']:0,				
				'status'	=> isset($_POST['status'])?$_POST['status']:0,
				'is_home'	=> isset($_POST['is_home'])?$_POST['is_home']:0
			);
			
			$_SESSION['sMsg'] = $this->saveData($aData);				
			parent::redirect($_COOKIE['re_dir']);
			return ;
		}		
			
		$form->display();
		
	}
	
	function saveData($aData=array()){
		global $oDb,$oSmarty;
		if(count($aData)<=0){
			$sMsg = "No data!";
			return $sMsg;
		}
		//print_r($aData); die();
		if( !$_POST['id']){		 	
			$res = $oDb->autoExecute($this->table,$aData, DB_AUTOQUERY_INSERT);
			/*if(PEAR::isError($res)){
				print_r($res); die();
			}*/
			$sMsg = $oSmarty->get_config_vars('msg_insert');				
		}else{	
			$oDb->autoExecute($this->table,$aData, DB_AUTOQUERY_UPDATE,"id='{$_POST['id']}'");
			$sMsg = $oSmarty->get_config_vars('msg_edit');
		}
		
		return $sMsg;
	}
	
	
	function changeStatus(){
		global $oDb;
		$status = $_GET['status'];
		$id = $_GET['id'];
		$aData = array('status'=>$status);
		$oDb->autoExecute($this->table, $aData, DB_AUTOQUERY_UPDATE,"id='{$id}'");
		return;
		
	}
	
	function doRequire($status){
		global $oDb;
		$id = $_GET['id'];
		$aData = array('required'=>$status);
		$oDb->autoExecute($this->table, $aData, DB_AUTOQUERY_UPDATE,"id='{$id}'");
		return;		
	}
	
	function saveOrder()
	{
		global $oDb,$oSmarty;
		$arrOrder = $_GET['z_index'];
		
		foreach ( $arrOrder as $key => $value ){
			$oDb->query("UPDATE {$this->table} SET z_index='{$value}' WHERE id='{$key}'");
		}			
		
		$_SESSION['sMsg'] = $oSmarty->get_config_vars('msg_saveorder');
		parent::redirect($_COOKIE['re_dir']);
	}
	
	function publishItem(){
		global $oDb, $oSmarty;
		$aId = $_GET['aId'];
		$sQuery = "UPDATE {$this->table} SET activated='1' WHERE id in (".implode(",", $aId).")";
		$iRs = $oDb->query($sQuery);
		$_SESSION['sMsg'] = $oSmarty->get_config_vars('msg_publish');
		parent::redirect($_COOKIE['re_dir']);
		return ;		
	}
	
	function unpublishItem(){
		global $oDb, $oSmarty;
		$aId = $_GET['aId'];
		$sQuery = "UPDATE {$this->table} SET activated='0' WHERE id in (".implode(",", $aId).")";
		$iRs = $oDb->query($sQuery);
		$_SESSION['sMsg'] = $oSmarty->get_config_vars('msg_unpublish');
		parent::redirect($_COOKIE['re_dir']);
		return ;		
	}
	
	/* End of class*/
}	
?>
