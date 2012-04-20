<?php
 
require_once('models/baseContact.php');
class ContactBack extends baseContact  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
			
				$this -> listContact();
				break;
			case 'add':
				$this -> addContact() ;
				break;
			case 'edit':
				$this -> editContact();
				break;
			case 'delete':
				$this -> deleteContact();
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
	
	function listContact()
	{
		global $oDb;
		global $oDatagrid;			
	
		$this->getPath($this->get_config_vars('list_root_'.$this->mod));
		$submit_url= "?mod=admin&amod=contact&atask=tocontact";
		$oDatagrid->setMethod($submit_url);
		
		$table = $this->table;
	 
	
	 
		$oDatagrid->setTable($table);
		
		$oDatagrid->addFilter(array('field'=>'name','display'=>$this->get_config_vars('title'),'type'=>'text','name'=>'filter_title','selected'=> $_REQUEST['filter_title'])); 
		
	
		
		$oDatagrid->addField(array("field" => "id","primary_key" =>true,"display" => $this->get_config_vars('id'),"sortable"=> true));
		$oDatagrid->addField(array("field" => "name","display" => $this->get_config_vars('title'),"link"=> "{$submit_url}&task=edit"));
		
		$oDatagrid->addField(array("field"=> "email","display"=> $this->get_config_vars('email'),"datatype"=> "text","sortable"=> true));
		
		$oDatagrid->setTask($this->getAct());
		
		$oDatagrid->addTaskAll(array("task" => "multi_delete","display" => "Delete"));
		
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
	
		$oDatagrid->displayGrid();	
	
	}
	
	function addContact()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editContact()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod));
		$row = $this->getDetailObject($id);			
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteContact()
	{
		$id = $_GET['id'];
		$this->delete($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
	
	function multiDelete()
	{
		$arrId = $_GET['arr_check'];	
		foreach ( $arrId as $iId ){
				$this->delete($iId);
		}
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);	
	}
	
	function changeStatus()
	{
		$id = $_GET['id'];
		$status = $_GET['status'];		
		$this -> vsDb -> updateWithPk ( $id, array ( $this->_prefix.'Status' => $status));		
		
	}	

	function unlinkPhoto( $sImage )
	{
		if( $sImage )
		{
			@unlink("upload/contact/{$sImage}");
			@unlink("upload/contact/thumb/{$sImage}");
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = "upload/contact";
		$filename = mktime() . $_FILES[$this->_prefix.'Photo']['name'];
		$file = CImage::uploadFile($_FILES[$this->_prefix.'Photo']['tmp_name'], $filename, $folder);
		CImage::createThumbnail($folder."/".$filename,$folder."/thumb/".$filename,WIDTH,HEIGHT);
		return $file;
	}
	function buildForm ( $task, $arrData = array() )
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		
		
		$content =  editor ( 'content', $arrData['content'], array ("width" => "800px", "height"	=> "300px") );
		
		if( $task == "edit" )
		{
			$form->setDefaults($arrData);
		}
		
		
			
		$form -> addElement('text', 'name',  $this->get_config_vars('name'), array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('text', 'email',  $this->get_config_vars('email'), array('size' => 50, 'maxlength' => 255) );
		
		
		$form -> addElement('static', NULL,  $this->get_config_vars('content'), $content);

		if( $task == "add" )
		{
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );}
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
	
		
	$form -> addRule( $this->_prefix.'Title',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required',null,'client' );
		
		if( $form -> validate())
		{
			
			if( $_POST['id'] == '' )
			{
				if ( $_FILES[$this->_prefix.'Photo']['name'] != '')
				{
					$this->arr_fields[$this->_prefix.'Photo'] = $this -> uploadPhoto();
				}
				$this->arr_fields[$this->_prefix.'CreateDate'] = date("Y/m/d H:i:s");
				
				$this->insert();
				$_SESSION['msg'] = $this->get_config_vars('msg_insert');
			}
			else 		
			{	
				if ( $_FILES[$this->_prefix.'Photo']['name'] != '')
				{
					if ( $_POST['old_photo'] != '' )
						$this -> unlinkPhoto( $_POST['old_photo'] );
					$this->arr_fields[$this->_prefix.'Photo'] = $this -> uploadPhoto();
				}
				$this->edit($_POST['id']);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();
		
	}
	
	function saveOrder()
	{
		$arrOrder = $_GET[$this->_prefix.'Order'];
		
		foreach ( $arrOrder as $key => $value )
		
			$this -> vsDb -> updateWithPk ( $key , array ( $this->_prefix.'Order' => $value ));		
		
		$_SESSION['msg'] = "Items have been updated at ".date("Y/m/d H:i:s");
		$this -> redirect($_COOKIE['re_dir']);	
	}
	
}
?>
