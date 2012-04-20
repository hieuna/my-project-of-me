<?php

class imageBack extends VS_Module_Base  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "tbl_image";
		$this->_prefix="Image_";
		$this->vsDb->setTable($this->table);	
		$this->vsDb->setPrimaryKey($this->_prefix."ID");
		$this->imagePath ="upload/image/";	
		$this->thumbSize = array('w'=>275, 'h'=>140);
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
			case 'delete':
				$this -> deleteItem();
				break;
			case 'edit':
				$this -> editItem();
				break;
			case 'change_status':
				$this -> changeStatus();
				break;
			case 'multi_delete':
				$this -> multiDelete();
				break;
			case 'publish':
				$this->changeStatusMultiple(1);
				break;	
			case 'unpublish':
				$this->changeStatusMultiple(0);
				break;
			case 'save_order':
				$this -> saveOrder();
				break;
		}		
	}
	
	function listItem()
	{
		global $oDb;
		global $oDatagrid;			
	
		$root_path = $this->get_config_vars('list_root_news');						
		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}&atask={$_GET['atask']}";
		parent::getPath($root_path);
	 	$oDatagrid->setMethod($submit_url);
		
	 	$oDatagrid->setTable($this->table);		
		$arr_cols= array(					
			array(
				"field" => $this->_prefix."ID",					
				"primary_key" =>true,
				"visible"=>"hidden",
				"display" => $this->get_config_vars('id'),
				"sortable" => true							
			),	
			array(
				"field" => $this->_prefix."Name",
				"display" => "Hướng dẫn",
				"link"	=> "{$submit_url}&task=edit",
				"style" =>" font-size:11px; font-weight:bold; text-align:center;",
				"sortable"	=> true
				),
			array(
				"field" => $this->_prefix."Link",
				"display" => "Đường Link",
				"style" =>" font-size:11px; font-weight:bold; text-align:center;",
				"sortable"	=> true
				),
			array(
				"field" => $this->_prefix."Content",
				"display" => "Tên ảnh",
				"style" =>" font-size:11px; font-weight:bold; text-align:center;",
				"sortable"	=> true
				),
			array(
				"field" => $this->_prefix."Photo",
				"display" => "Ảnh quảng cáo",				
				"datatype" => "img",
				"style" =>" width:100px; font-size:11px;  text-align:center;",
				"img_path" =>$this->imagePath,
				"img_size"=>80
			),
			array(
				"field" => $this->_prefix."Order",
				"display" => $this->get_config_vars('order'),				
				"datatype" => "order",
				
			),					
			array(
				"field" => $this->_prefix."Status",
				"display" => "Kích hoạt",
				"style" =>" width:80px;font-size:11px; text-align:center;",
				"datatype"	=> "publish",
				)
		);		
		$oDatagrid->setField($arr_cols);
		
		$oDatagrid->addFilter(
			array(
				'field'=>$this->_prefix."Name",
				'display' => "Nhập từ khóa hướng dẫn",
				'type'=>'text',
				'name' => $this->_prefix."Name",
				'selected'=> $_REQUEST[$this->_prefix."Name"]
			)
		);
		$oDatagrid->setTask($this->getAct());
		$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));
		$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));
		$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		//$oDatagrid->where(" ".$this->_prefix."Type='".$this->type."' ");
	
		$oDatagrid->displayGrid();
		
	}	

	function addItem()
	{		
		$this -> getPath($this->get_config_vars('edit_root_news'));
		$this -> buildForm( 'add' );
	}
	
	function editItem()
	{
		$id = intval($_GET['id']);		
		$this -> getPath($this->get_config_vars('edit_root_news').": {$id}");
		$row = $this->getRow("select * from {$this->table} where {$this->_prefix}ID='{$id}'");		
		$this -> buildForm( 'edit', $row );
	}	

	function buildForm ( $task, $arrData = array() )
	{
		global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',"?mod=admin&amod={$_GET['amod']}&task=".$_GET['task']."&atask=".$_GET['atask'], '', "style=\"padding:10px 10px 0 25px\"");

		
		$form->setDefaults($arrData);					
		$form -> addElement('text', $this->_prefix.'Name',  "Hướng dẫn", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('text', $this->_prefix.'Link',  "Đường Link", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('text', $this->_prefix.'Content',  "Tên Ảnh", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('file', 'photo', $this->get_config_vars('photo'), array('style' => 'width:150px') );
		if ( $arrData[ $this->_prefix.'Photo']!= "" )
		{
			$sImage = $this -> showFlash($this->imagePath.$arrData[$this->_prefix.'Photo'],$arrData[$this->_prefix.'Type'],'')."<br>
			<input type=\"checkbox\" name=\"removeImage\" value=\"1\"> <label style=\"font-size:11px\">{$this->get_config_vars('remove_this')}</label>";
			$form -> addElement ( 'static', NULL, '', $sImage );
		}		
		$form -> addElement('checkbox', $this->_prefix.'Status', $this->get_config_vars('status'));
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden','id', $arrData[$this->_prefix.'ID'] );
		$form->addElement( 'hidden', 'oldPhoto', $arrData[$this->_prefix.'Photo'] );
		$form -> addRule( $this->_prefix.'Name','Hướng dẫn '.$this->get_config_vars('no_blank'),'required');
		
		if( $form -> validate())
		{
			$aData = array(
				$this->_prefix.'Name' => stripslashes($_POST[$this->_prefix.'Name']),
				$this->_prefix.'Link' => stripslashes($_POST[$this->_prefix.'Link']),
				$this->_prefix.'Content' => stripslashes($_POST[$this->_prefix.'Content']),
				$this->_prefix.'Status' =>$_POST[$this->_prefix.'Status'],
				
			);
			if($_POST['removeImage']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$aData[$this->_prefix.'Photo'] = "";
				$aData[$this->_prefix.'Type'] = "";
			}
			
			if($_FILES['photo']['name']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$str = $_FILES['photo']['name'];
				$tmp = explode('.',$str);
				$stt = count($tmp)-1;
				$file =  $tmp[$stt];
				$uploadFile = $this->uploadPhoto();
				if($uploadFile=='none' || $uploadFile == '') $aData[$this->_prefix.'Photo'] = "";
				else
					$aData[$this->_prefix.'Photo'] = $uploadFile;
					$aData[$this->_prefix.'Type'] = $file;
			}
			
			if(isset($_POST['id']) && $_POST['id']){
			//	print_r($_POST['id']);
				$this->vsDb->updateWithPk($_POST['id'], $aData);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');	
			}else{				
				$this->vsDb->insert($aData);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$submit_url= "?mod=admin&amod={$_GET['amod']}&atask={$_GET['atask']}";
		
			$this -> redirect($submit_url);
		}
		
		$form->display();
		
	}		
	function truncateExt($string){
		
		$arr = explode(".",$string);
		if($arr)
			return $arr[count($arr)-1];
		else
			return 0;
	}
	function changeStatus()
	{
		global $oDb;
		$id = $_GET['id'];
		$field= trim($_GET["field"]);
		$status = trim($_GET['status']);	
		$this -> vsDb -> updateWithPk ( $id, array ( $field => $status));		
	}	
	function multiDelete()
	{
		$arrId = $_GET['arr_check'];	
		foreach ( $arrId as $iId ){
			$photo=  $this->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$iId}'");
			if($photo)
				$this->unlinkPhoto($photo);
				$this->vsDb->deleteWithPk($iId);
		}
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);	
	}
	function unlinkPhoto( $sImage )
	{
		if( $sImage )
		{
			@unlink($this->imagePath."/{$sImage}");
			@unlink($this->imagePath."/thumbnail/{$sImage}");
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = $this->imagePath;
		$filename = mktime() . $_FILES['photo']['name'];
		$file = CImage::uploadFile($_FILES['photo']['tmp_name'], $filename, $folder);
		$aThumbSize = $this->thumbSize;
		CImage::createThumbnail($folder."/".$filename,$folder."/thumbnail/".$filename,$aThumbSize['w'], $aThumbSize['h']);
		return $file;
	}	
	function changeStatusMultiple($status)
	{		
		$sIds = implode(",", $_GET['arr_check']);
		$this -> vsDb -> updateWithPk ( $sIds , array ( 'Image_Status' => $status ));				
		
		if($status==1)
			$_SESSION['msg'] = $this->get_config_vars("msg_publish");
		else 
			$_SESSION['msg'] = $this->get_config_vars("msg_unpublish");
		$this -> redirect($_COOKIE['re_dir']);	
	}
	function saveOrder()
	{
		$arrOrder = $_GET[$this->_prefix.'Order'];
		
		foreach ( $arrOrder as $key => $value )
		
			$this -> vsDb -> updateWithPk ( $key , array ( $this->_prefix.'Order' => $value ));		
		
		$_SESSION['msg'] = "Items have been updated at ".date("Y/m/d H:i:s");
		$this -> redirect($_COOKIE['re_dir']);	
	}	
	function deleteItem()
	{
		global $oDb;
		$id = $_GET['id'];
/*		$photo=  $oDb->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$id}'");
		if($photo)
			$this->unlinkPhoto($photo);
*/		$this->vsDb->deleteWithPk($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
}
?>
