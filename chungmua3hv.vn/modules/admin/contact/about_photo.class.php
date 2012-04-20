<?php
require_once('models/baseAboutPhoto.php');
class aboutPhoto extends baseAboutPhoto 
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
				$this -> listItem();
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
			case 'multi_delete':
				$this -> multiDelete();
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
		$submit_url= "?mod=admin&amod={$_GET['amod']}&atask={$_GET['atask']}";
		
		$table = $this->table;	
		
		$arr_cols= array(					
			array(
				"field" => $this->_prefix."ID",					
				"primary_key" =>true,
				"display" => "ID",
				'sortable' => true
			),	
			array(
				"field" => $this->_prefix."Photo",
				"display" => $this->get_config_vars('photo'),
				"datatype" => "img",
				"img_path" => SITE_URL."upload/about_photo/",
			),		
				
			
			array(
				"field"	=> $this->_prefix."Status",
				"display"	=> $this->get_config_vars('status'),
				"datatype"	=> "publish",
				"sortable" => true
				)
			
		);		
		
		$arr_check = array(
			array(
				"task" => "multi_delete",
				"display" => "Delete"
			)
		);
		
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
	
		$oDatagrid->display_datagrid($table, $arr_cols, $arr_filter, $submit_url, $this -> getAct() ,120, $root_path, false,$arr_check);		
		
	}
	
	function addItem()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editItem()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod));
		$row = $this->getDetailObject($id);			
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteItem()
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
			@unlink("upload/partner/{$sImage}");			
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = "upload/about_photo";
		$filename = mktime() . $_FILES[$this->_prefix.'Photo']['name'];
		
		$file = CImage::uploadFile($_FILES[$this->_prefix.'Photo']['tmp_name'], $filename, $folder);
		return $filename;
	
	}
	function buildForm ( $task, $arrData = array() )
	{
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		
		if( $task == "edit" )
		{
			$form->setDefaults($arrData);
		}
			
		$form -> addElement('file', $this->_prefix.'Photo', $this->get_config_vars('photo').' (480 X 270) ', array('style' => 'width:150px') );
		if ( $arrData[$this->_prefix.'Photo']!= "" )
		{
			$sImage = "<image src = '".SITE_URL."upload/about_photo/".$arrData[$this->_prefix.'Photo']."' style = 'width:100px;'><br>
			<input type=\"checkbox\" name=\"removeImage\" value=\"1\"> <label style=\"font-size:11px\">Remove this</label>";
			$form -> addElement ( 'static', NULL, '', $sImage );
		}
		$form -> addElement('text', $this->_prefix.'Order',  $this->get_config_vars('order'), array('size' => 10, 'maxlength' => 255) );		
		$form -> addElement('checkbox', $this->_prefix.'Status', $this->get_config_vars('status'));
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
		$form->addElement( 'hidden', 'old_photo', $arrData[$this->_prefix.'Photo'] );
		
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
				if ( $_POST['removeImage'] )
				{
					if ( $_POST['old_photo'] != '' )
						$this -> unlinkPhoto( $_POST['old_photo'] );
					$this->arr_fields[$this->_prefix.'Photo'] = "";
				}
				
				if ( $_FILES[$this->_prefix.'Photo']['name'] != '')
				{
					$this->arr_fields[$this->_prefix.'Photo'] = $this -> uploadPhoto();
				}
				$this->edit($_POST['id']);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$this -> redirect($_COOKIE['re_dir']);
		}
		
		$form->display();
		
	}
	
}
?>
