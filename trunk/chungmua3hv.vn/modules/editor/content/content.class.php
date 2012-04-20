<?php

class ContentBack extends VS_Module_Base  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "tbl_content";
		$this->_prefix="Content_";
		$this->vsDb->setTable($this->table);	
		$this->vsDb->setPrimaryKey("Content_ID");
		$this->imagePath ="upload/content/";	
		$this->thumbSize = array('w'=>150, 'h'=>150);
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
			case 'publish':
				$this->changeStatusMultiple(1);
				break;
			case "changeLang":
				$this->changeLang();
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
		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}";
		
		parent::getPath($root_path);
	 	$oDatagrid->setMethod($submit_url);
		
	 //	$oDatagrid->setTable($table);		
		
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
				"display" => $this->get_config_vars('title'),
				"link"	=> "{$submit_url}&task=edit",
				"style" =>" font-size:11px; font-weight:bold; text-align:left;",
				"sortable"	=> true
				),
			array(
				"field" => $this->_prefix."Photo",
				"display" => "Ảnh đại diện",				
				"datatype" => "img",
				"style" =>" width:100px; font-size:11px;  text-align:left;",
				"img_path" =>TRUE_URL.$this->imagePath,
				"img_size"=>80
			),
			array(
				"field" => $this->_prefix."Type",
				"display" => "Danh mục",
				"style" =>" font-size:11px; text-align:center;",
				"sortable"	=> true
				),
			array(
				"field" => $this->_prefix."Active",
				"display" => "Kích hoạt",
				"style" =>" font-size:11px; text-align:center;",
				"datatype"	=> "publish",
				)
			
		);		
		
		$oDatagrid->setField($arr_cols);
		
		$oDatagrid->addFilter(
			array(
				'field'=> array('name'=>array("Tiêu đề",'number'), 'content'=> array("Nội dung",'text')),
				'type'=>'group',
				'name' => 'id_title',
				'selected'=> $_REQUEST['id_title']
			)
		);
		
		$oDatagrid->addFilter(
			array(
				'field'=> 'category_id',
				'display' => "Danh mục",
				'options' =>$oDb->getAssoc("select id, name from news_category"),
				'name' => 'category_id',
				'selected'=> $_REQUEST['category_id']
			)
		);
		
		$orderby=" order by {$this->_prefix}ID desc";
		$where=" where 1";
		if($_GET["sort_by"]){
			$field = $_GET["sort_by"];
			$sortby= $_GET["sort_value"];
			$orderby=" order by {$field} {$sortby} ";
		}
		if($_GET["category_id"]){
				$where.=" and category_id='".$_GET["category_id"]."' ";
		}
		if($_GET["id_title_group"]=='name'){
			if($_GET["id_title"])
				$where.=" and title like '%".$_GET["id_title"]."%' ";
		}elseif($_GET["id_title_group"]=='content'){
			if($_GET["id_title"])
				$where.=" and content like '%".$_GET["id_title"]."%' ";
		
		}
			
		$table= $oDb->getAll("select *  from {$this->table} {$where} {$orderby}");
					
		$oDatagrid->setTask($this->getAct());
		
		$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));
		$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));
		$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
	
		$oDatagrid->displayGridTable($table);
		
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
		$row = $this->vsDb->getRow($id);			
		$this -> buildForm( 'edit', $row );
	}	

	function buildForm ( $task, $arrData = array() )
	{
		global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',"?mod=admin&amod={$_GET['amod']}&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		$comment =  editor ($this->_prefix.'Content', $arrData[$this->_prefix.'Content'], array ("width" => "800px", "height"	=> "300px") );
		
		$form->setDefaults($arrData);
		
	////	$category = $oDb->getAssoc("select id, name from news_category");
		//$form -> addElement('select',  'category_id',"Danh mục tin",$category);
					
		$form -> addElement('text', $this->_prefix.'Name',  "Tiêu đề", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('file', 'photo', $this->get_config_vars('photo'), array('style' => 'width:150px') );
		if ( $arrData[ $this->_prefix.'Photo']!= "" )
		{
			//$filesize= array("width" => $arrData["AD_Width"],"height"=> $arrData["AD_Height"]);
			$sImage = $this -> showFlash(TRUE_URL.$this->imagePath.$arrData[$this->_prefix.'Photo'])."<br>
			<input type=\"checkbox\" name=\"removeImage\" value=\"1\"> <label style=\"font-size:11px\">{$this->get_config_vars('remove_this')}</label>";
			$form -> addElement ( 'static', NULL, '', $sImage );
		}		
		
		$form -> addElement('textarea', $this->_prefix.'Description',  "Miêu tả", array('cols' => 130, 'rows' => 5) );
		$form -> addElement('static', NULL,  "Nội dung", $comment);		
		
		$form -> addElement('checkbox', $this->_prefix.'Active', $this->get_config_vars('status'));
		//$form -> addElement('checkbox', 'home_id', "Chọn nổi bật");
		//$form -> addElement('checkbox', 'slide_id', "Hiện trên slide HomePage");
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden','id', $arrData[$this->_prefix.'ID'] );
		$form->addElement( 'hidden', 'oldPhoto', $arrData[$this->_prefix.'Photo'] );
		$form -> addRule( $this->_prefix.'Name',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required');
		
		if( $form -> validate())
		{
			$aData = array(
				$this->_prefix.'Name' => stripslashes($_POST[$this->_prefix.'Name']),
				$this->_prefix.'Description' => stripslashes($_POST[$this->_prefix.'Description']),
				$this->_prefix.'Content' => stripslashes($_POST[$this->_prefix.'Content']),
				$this->_prefix.'Active' =>$_POST[$this->_prefix.'Active'],
				$this->_prefix.'Type' =>$_POST[$this->_prefix.'Type']
			);
			
			if($_POST['removeImage']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$aData[$this->_prefix.'Photo'] = "";
			}
			
			if($_FILES['photo']['name']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$uploadFile = $this->uploadPhoto();
				if($uploadFile=='none' || $uploadFile == '') $aData[$this->_prefix.'Photo'] = "";
				else
					$aData[$this->_prefix.'Photo'] = $uploadFile;
					
			//	echo "Dsd".$uploadFile;
			//	$size = getimagesize(SITE_URL.$this->imagePath.$uploadFile);
				//print_r($size);
				/*if($size[0]>0){
					$aData["AD_Width"]= $size[0];
					$aData["AD_Height"]= $size[1];
				}
				$aData["AD_Type"]= $this->truncateExt($uploadFile);
			//	exit();*/
				
				
			}
			
			if(isset($_POST['id']) && $_POST['id']){
				$this->vsDb->updateWithPk($_POST['id'], $aData);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');	
			}else{				
				$this->vsDb->insert($aData);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			$submit_url= "?mod=admin&amod={$_GET['amod']}";
		
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
	function setParent(&$arrPanrent,$id,$idp=0,$text='',$lang_id=0,$type='', $partten = " --- ")
	{		
		global $oDb;
		$this->_prefix='Group_';
		if($type=="")
			$type='groupTruelocal';
		$stbl = 'news_category';
		// type of category
		if ($type == '') $type = $_GET['atask'];
		// default sql where
		$sWhere = "{$this->_prefix}ParentID={$idp} and {$this->_prefix}Type='{$type}'";
		// if use language
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
	
	function deleteItem()
	{
		global $oDb;
		$id = $_GET['id'];
		$photo=  $oDb->getOne("select photo from news where id='{$id}'");
		if($photo)
			$this->unlinkPhoto($photo);
		$this->vsDb->deleteWithPk($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);		
	}
	
	function multiDelete()
	{
		$arrId = $_GET['arr_check'];	
		foreach ( $arrId as $iId ){
			$photo=  $oDb->getOne("select photo from news where id='{$iId}'");
			if($photo)
				$this->unlinkPhoto($photo);
			$this->vsDb->deleteWithPk($iId);
		}
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
		$this -> redirect($_COOKIE['re_dir']);	
	}
	
	function changeStatus()
	{
		global $oDb;
		$id = $_GET['id'];
		$field= trim($_GET["field"]);
		$status = trim($_GET['status']);	
		$this -> vsDb -> updateWithPk ( $id, array ( $field => $status));		
		
	}	

	function unlinkPhoto( $sImage )
	{
		if( $sImage )
		{
			@unlink(TRUE_DIR.$this->imagePath."/{$sImage}");
			@unlink(TRUE_DIR.$this->imagePath."/thumbnail/{$sImage}");
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = TRUE_DIR.$this->imagePath;
		$filename = mktime() . $_FILES['photo']['name'];
		$file = CImage::uploadFile($_FILES['photo']['tmp_name'], $filename, $folder);
		$aThumbSize = $this->thumbSize;
		CImage::createThumbnail($folder."/".$filename,$folder."/thumbnail/".$filename,$aThumbSize['w'], $aThumbSize['h']);
		return $file;
	}
	
	function saveOrder()
	{
		$arrOrder = $_GET['z_index'];
		
		foreach ( $arrOrder as $key => $value )
		
			$this -> vsDb -> updateWithPk ( $key , array ( 'z_index' => $value ));		
		
		$_SESSION['msg'] = $this->get_config_vars("msg_saveorder");
		$this -> redirect($_COOKIE['re_dir']);	
	}
	
	function changeStatusMultiple($status)
	{		
		$sIds = implode(",", $_GET['arr_check']);
		$this -> vsDb -> updateWithPk ( $sIds , array ( 'status' => $status ));				
		
		if($status==1)
			$_SESSION['msg'] = $this->get_config_vars("msg_publish");
		else 
			$_SESSION['msg'] = $this->get_config_vars("msg_unpublish");
		$this -> redirect($_COOKIE['re_dir']);	
	}
	function changeLang()
	{
		global $oSmarty,$oDb;
		$lang_id = $_GET['lang_id'];
		$arrPanrent=array();		
		$name = 'group_id';
		$arrGroup[-1] = array('Group_Name'=>'--- none ---', 'Group_ID'=>0);
		$sql = "SELECT * FROM tblgroup WHERE Group_Type='groupNews' and Group_LangID='{$lang_id}'";
		$arrPanrent = $oDb->getAll($sql);
		$arrPanrent = $arrGroup + $arrPanrent;
		$sContent = "<select name=\"{$name}\" id=\"{$name}\">";
		foreach ($arrPanrent as $group){
			$sContent .= "<option value=\"{$group['Group_ID']}\">{$group['Group_Name']}</option>";
		}
		$sContent.= "</select>";
		echo $sContent;
	}	
	
}
?>
