<?php
//error_reporting(E_ALL);
class supportBack extends VS_Module_Base  
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		@eval(getGlobalVars()); 
		parent::__construct($oDb);
		$this -> table = "tblsupport";
		$this->_prefix ="Support_";
		$this->pk =  $this->_prefix.'ID';			
		$this -> vsDb -> setTable( $this->table );	
		
		if($this->isPost())
		$this->arr_fields = array(
			$this->_prefix.'ID' 			=> stripcslashes($_POST[$this->_prefix.'ID']),		
			$this->_prefix.'Order' 			=> stripcslashes($_POST[$this->_prefix.'Order']),
			$this->_prefix.'Name' 			=> stripcslashes($_POST[$this->_prefix.'Name']),
			$this->_prefix.'Phone' 			=> stripcslashes($_POST[$this->_prefix.'Phone']),
			$this->_prefix.'Value' 			=> stripcslashes($_POST[$this->_prefix.'Value']),
			$this->_prefix.'Type' 			=> stripcslashes($_POST[$this->_prefix.'Type']),
			$this->_prefix.'Status' 			=> stripcslashes($_POST[$this->_prefix.'Status']),
			$this->_prefix.'LangID' 		=>$_POST[$this->_prefix.'LangID']?$_POST[$this->_prefix.'LangID']:$this->lang_id
						
		);
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> ListItem();
				break;
			case 'add':
				$this -> addItem() ;
				break;
			case 'edit':
				$this -> editItem();
				break;
			case 'delete':
				$this -> deleteItem();
				break;
			case 'change_status':
				$this -> changeStatus();
				break;
		}
		
	}
	
	function listItem()
	{
		global $oDb;
		global $oDatagrid;			
	
		$root_path = $this->get_config_vars('list_root_'.$this->mod);	
		parent::getPath($root_path);					
		$submit_url= "?mod=admin&amod=support&atask=".$this->mod;
		
		$oDatagrid->setMethod($submit_url);
		$oDatagrid->setTable($this->table);
		
		$arr_cols= array(					
			array(
				"field" => $this->_prefix."ID",					
				"primary_key" =>true,
				"display" => $this->get_config_vars('id'),
				"sortable"=> true,	
				"hidden" => true						
			),	
			array(
				"field" => $this->_prefix."Order",					
				"display" => $this->get_config_vars('order'),
				"sortable"=> true							
			),	
			array(
				"field" => $this->_prefix."Name",
				"display" => $this->get_config_vars('name')
				
			),
			array(
				"field" => $this->_prefix."Value",
				"display" => $this->get_config_vars('nick')				
				
			),
			array(
				"field" => $this->_prefix."Phone",
				"display" => 'Điện thoại hỗ trợ'							
			),
			array(
				"field" => $this->_prefix."Type",
				"display" => $this->get_config_vars('type'),				
				"datatype" => "text",
				
			),
			array(
				"field" =>$this->_prefix."Status",
				"display"	=> $this->get_config_vars("status"),
				"datatype"	=> "publish"
			
			)
		);		
		
		$oDatagrid->setField($arr_cols);
		
		if($this->islang){		
			$oDatagrid->addFilter(
				array(
				"field" 	=> $this->_prefix."LangID",
				"display" 	=> $this->get_config_vars('language'),
				"name" 		=> $this->_prefix."LangID",
				"type" 		=> "select",				
				"style" 	=> "width:160px;",
				"selected" 	=> isset($_REQUEST[$this->_prefix."LangID"])?$_REQUEST[$this->_prefix."LangID"]: '',
				"options"	=> $this->getAssocLang()
				)
			);			
		}
				
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		$oDatagrid->setTask($this -> getAct());
				
		$oDatagrid->displayGrid();
		
	}
	
	function addItem()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editItem()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod).": {$id}");
		$row = $this->vsDb->getRow($id);	
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteItem()
	{
		$id = $_GET['id'];
		$this -> vsDb -> deleteWithPk ($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
	
	function changeStatus()
	{
		$id = $_GET['id'];
		$status = $_GET['status'];		
		$this -> vsDb -> updateWithPk ( $id, array ( $this->_prefix.'Status' => $status));		
		
	}		

		
	function buildForm ( $task, $arrData = array() )
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		if( $task == "edit" ){
			$form->setDefaults($arrData);
		}
		
		$form -> addElement('select', $this->_prefix.'Type', $this->get_config_vars('type'),array('yahoo' => 'Yahoo','skype' => 'Skype'), array('width' => 200) );
		$form -> addElement('text', $this->_prefix.'Value',  $this->get_config_vars('nick'), array('size' => 50, 'maxlength' => 255) );
		
		$form -> addElement('text', $this->_prefix.'Name',  $this->get_config_vars('name'), array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('text', $this->_prefix.'Phone',  'Điện thoại hỗ trợ', array('size' => 50, 'maxlength' => 255) );
		
		$form -> addElement('checkbox', $this->_prefix.'Status',  $this->get_config_vars('status') );
		
		$form -> addElement('text', $this->_prefix.'Order',  $this->get_config_vars('order') );
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
	
		$form -> addRule( $this->_prefix.'Value',$this->get_config_vars('name').$this->get_config_vars('no_blank'),'required',null,'client' );
		$form -> addRule( $this->_prefix.'Link',$this->get_config_vars('link').$this->get_config_vars('no_blank'),'required',null,'client' );
		
		if( $form -> validate())
		{
			
			if( $_POST['id'] == '' )
			{					 	
				 $this -> vsDb ->insert($this->arr_fields);
				$_SESSION['msg'] = $this->get_config_vars('msg_insert');
			}
			else 		
			{	
				$this -> vsDb ->updateWithPk($_POST['id'],$this->arr_fields);				
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();
		
	}
	
}
?>
