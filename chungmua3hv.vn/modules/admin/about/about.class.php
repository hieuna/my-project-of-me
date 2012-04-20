<?php
define("WIDTH","200");
require_once('models/baseAbout.php');
class AboutBack extends baseAbout  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);		
		$this->mod = 'about';
	}
	
	function run( $task )
	{		
		
		switch ( $task )
		{
			default:
				$this -> listAbout();
				break;
			case 'add':
				$this -> addAbout() ;
				break;
			case 'edit':
				$this -> editAbout();
				break;
			case 'delete':
				$this -> deleteAbout();
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
	
	function listAbout()
	{
		global $oDb;
		global $oDatagrid;			
	
		$root_path = $this->get_config_vars('list_root_'.$this->mod);
		parent::getPath($root_path);						
		$submit_url= "?mod=admin&amod=about&atask=about";
		
		/*$lang_id = $_SESSION['lang_id'];
		$table = "((SELECT * from ".$this->table." WHERE ".$this->_prefix."LangID = '{$lang_id}') AS ".$this->table.")";*/
	 
		/*if($this->islang) 	
	 		$table = "((SELECT *,l.name as ".$this->_prefix."Lang from ".$this->table." i INNER JOIN  lang l ON(i.".$this->_prefix."LangID = l.id)  ) AS ".$this->table.")";*/
		
		$table = $this->table;
	 	$oDatagrid->setMethod($submit_url);
	 	$oDatagrid->setTable($table);	
	 		
		$oDatagrid->addFilter(
			array(
				'field' => $this->_prefix.'Title',
				'display' => 'Title',
				'type' => 'text',
				'name' => 'title',
				'selected' => $_REQUEST['title'],
				'filterable' => true
			)
		); 
		
		$arr_cols= array(					
			array(
				"field" => $this->_prefix."ID",					
				"primary_key" =>true,
				"display" => $this->get_config_vars('id'),
				"sortable" => true							
			),	
			array(
				"field" => $this->_prefix."Title",
				"display" => $this->get_config_vars('title'),
				"link"	=> "{$submit_url}&task=edit",
				"datatype" => "text",
				
			),					
			array(
				"field" => $this->_prefix."Photo",
				"display" => $this->get_config_vars('photo'),
				"datatype" => "img",
				"img_path" => SITE_URL."upload/about/thumb/",
			),	
			array(
				"field" => $this->_prefix."Order",
				"display" => $this->get_config_vars('order'),				
				"datatype" => "order",
				
			),		
			array(
				"field"	=> $this->_prefix."CreateDate",
				"display"	=> $this->get_config_vars('create_date'),
				"datatype"	=> "date",
				"sortable"	=> true
			),
			array(
				"field"	=> $this->_prefix."Status",
				"display"	=> $this->get_config_vars('status'),
				"datatype"	=> "publish",
				"sortable" => true									
				)
			
		);		
		
		$oDatagrid->setField($arr_cols);		
		
		$oDatagrid->addFilter(
			array(
			"field" 	=> $this->_prefix."LangID",
			"display" 	=> $this->get_config_vars('language'),
			"name" 		=> $this->_prefix."LangID",
			"selected" 	=> isset($_REQUEST[$this->_prefix."LangID"])?$_REQUEST[$this->_prefix."LangID"]: '',
			'options'=>$oDb->getAssoc('SELECT id,name FROM lang WHERE 1 order by isdefault desc'),		
			)
		);			
		
		
		$oDatagrid->addTaskAll(array(
				"task" => "multi_delete",
				"display" => "Delete"
			));
			
		$oDatagrid->setTask($this->getAct());
		//print_r($this->getAct());
		
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
	
		$oDatagrid->displayGrid();
		
	}
	
	function addAbout()	
	{
		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));
		$this -> buildForm('add');
	}
	
	function editAbout()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod).": {$id}");
		$row = $this->getDetailObject($id);			
		$this -> buildForm( 'edit', $row );
	}
	
	
	function deleteAbout()
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
			@unlink("upload/about/{$sImage}");
			@unlink("upload/about/thumb/{$sImage}");
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = "upload/about";
		$filename = mktime() . $_FILES[$this->_prefix.'Photo']['name'];
		$file = CImage::uploadFile($_FILES[$this->_prefix.'Photo']['tmp_name'], $filename, $folder);
		CImage::createThumbnail($folder."/".$filename,$folder."/thumb/".$filename,WIDTH,0);
		return $file;
	}
	function buildForm ( $task, $arrData = array() )
	{
		global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		///$summarize =  editor ( $this->_prefix.'Summarize', $arrData[$this->_prefix.'Summarize'], array ("width" => "800px", "height"	=> "250px") );
		
		
		$content =  editor ( $this->_prefix.'Content', $arrData[$this->_prefix.'Content'], array ("width" => "800px", "height"	=> "600px") );
		
		if( $task == "edit" )
		{
			$form->setDefaults($arrData);
		}
		
		$arrLang = $oDb->getAssoc('SELECT id,name FROM lang WHERE 1 order by isdefault desc');		
		$form -> addElement('select', $this->_prefix.'LangID', $this->get_config_vars('language'),$arrLang);
			
		$form -> addElement('text', $this->_prefix.'Title',  $this->get_config_vars('title'), array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('file', $this->_prefix.'Photo', $this->get_config_vars('photo'), array('style' => 'width:150px') );
		if ( $arrData[$this->_prefix.'Photo']!= "" )
		{
			$sImage = "<image src = '".SITE_URL."upload/about/thumb/".$arrData[$this->_prefix.'Photo']."' style = 'width:100px;'>";
			$form -> addElement ( 'static', NULL, '', $sImage );
		}
		//$form -> addElement('static', NULL,  $this->get_config_vars('summarize'), $summarize);
		$form -> addElement('textarea', $this->_prefix.'Summarize',  $this->get_config_vars('summarize'), array('style' =>'width:800px;height:100px') );
		$form -> addElement('static', NULL,  $this->get_config_vars('content'), $content);
		$form -> addElement('text', $this->_prefix.'Order', $this->get_config_vars('order'), array('size' => 10, 'maxlenght' => 50) );
		$form -> addElement('checkbox', $this->_prefix.'Status', $this->get_config_vars('status'));
		$form -> addElement('checkbox', $this->_prefix.'Populer', "Chọn làm bài viết nổi bật");
		
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );
		$form->addElement( 'hidden', 'old_photo', $arrData[$this->_prefix.'Photo'] );
		
		$form -> addRule( $this->_prefix.'Title',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required',null,'client' );
		
		if( $form -> validate())
		{
			
			if($_POST[$this->_prefix.'Populer']){
				$this->query("update {$this->table} set {$this->_prefix}Populer='0' where {$this->_prefix}LangID='".$_POST[$this->_prefix.'LangID']."'");
			}
			if( $_POST['id'] == '' )
			{
				if ( $_FILES[$this->_prefix.'Photo']['name'] != '')
				{
					$this->arr_fields[$this->_prefix.'Photo'] = $this -> uploadPhoto();
				}
				//$this->arr_fields[$this->_prefix.'CreateDate'] = date("Y/m/d H:i:s");
				
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
