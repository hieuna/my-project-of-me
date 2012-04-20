<?php

class ContactBack extends VS_Module_Base  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "tbl_contact";
		$this->vsDb->setTable($this->table);		
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> listItem();
				break;
			case 'edit':
				$this -> editItem();
				break;
		}
		
	}
	
	function listItem()
	{
		global $oDb;
		global $oDatagrid;			
	
		$root_path = $this->get_config_vars('list_root_contact');						
		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}";
		
		parent::getPath($root_path);
	 	$oDatagrid->setMethod($submit_url);
	 	$oDatagrid->setTable($this->table);		
		
		$arr_cols= array(					
			array(
				"field" => "id",					
				"primary_key" =>true,
				"display" => $this->get_config_vars('id'),
				"sortable" => true							
			),	
			array(
				"field" => "email",
				"display" => $this->get_config_vars('email'),
				"link"	=> "{$submit_url}&task=edit",
				"datatype" => "text",
				
			),
			array(
				"field" => "lang_id",
				"display" => $this->get_config_vars('language'),				
				"sql" => "select name from lang where id=lang_id",
				
			)
		);		
		
		$oDatagrid->setField($arr_cols);
					
		$oDatagrid->addTask($this->getAct('edit'));
		//$oDatagrid->debug();
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
	
		$oDatagrid->displayGrid();
		
	}	

	function editItem()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod).": {$id}");
		$row = $this->vsDb->getRow($id);			
		$this -> buildForm( 'edit', $row );
	}	

	function buildForm ( $task, $arrData = array() )
	{global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
				
		$content =  editor ('content', $arrData['content'], array ("width" => "800px", "height"	=> "600px") );
		
		$form->setDefaults($arrData);
		
		$arrLang = $oDb->getAssoc('SELECT id,name FROM lang WHERE 1 order by isdefault desc');
		$form -> addElement('select', 'lang_id', $this->get_config_vars('language'),$arrLang);	
		$form -> addElement('text', 'email',  $this->get_config_vars('email'), array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('static', NULL,  $this->get_config_vars('content'), $content);		
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
		
		$form -> addRule( 'email',$this->get_config_vars('email').$this->get_config_vars('no_blank'),'required');
		
		if( $form -> validate())
		{
			$aData = array(
				'lang_id' => $_POST['lang_id'],
				'email' => $_POST['email'],
				'content' => stripslashes($_POST['content'])
			);
			$this->vsDb->updateWithPk($_POST['id'], $aData);
			$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();
		
	}	
	
}
?>
