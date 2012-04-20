<?php

class CategoryBack extends VS_Module_Base  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "news_category";
		$this->vsDb->setTable($this->table);	
		//$this->imagePath ="upload/advertising/";	
		$this->thumbSize = array('w'=>130, 'h'=>100);
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
		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}&atask={$_GET['atask']}";
		
		parent::getPath($root_path);
	 	$oDatagrid->setMethod($submit_url);
		
	 //	$oDatagrid->setTable($table);		
		
		$arr_cols= array(					
			array(
				"field" => "id",					
				"primary_key" =>true,
				"visible"=>"",
				"display" => $this->get_config_vars('id'),
				"style" =>" font-size:11px; font-weight:bold; text-align:center; width:30px;",
				"sortable" => true							
			),	
			array(
				"field" => "name",
				"display" => $this->get_config_vars('title'),
				"link"	=> "{$submit_url}&task=edit",
				"style" =>" font-size:11px; font-weight:bold; text-align:left; ",
				),
			array(
				"field" => "is_home",
				"display" => "Nổi bật",
				"style" =>" font-size:11px; font-weight:bold; text-align:center;",
				"datatype"	=> "publish",
				),
			array(
				"field" => "z_index",
				"display" => "Thứ tự",
				"style" =>" font-size:11px; font-weight:bold; text-align:left; width:10px;",
				"datatype"	=> "order",
				)
		);		
		
		$oDatagrid->setField($arr_cols);
		
		$oDatagrid->addFilter(
			array(
				'field'=> array('name'=>array("Tên danh mục",'text')),
				'type'=>'group',
				'name' => 'id_title',
				'selected'=> $_REQUEST['id_title']
			)
		);
		
		$where=" where 1";
		
		if($_GET["category_id"]){
				$where.=" and gid in (select id from news where category_id='".$_GET["category_id"]."') ";
		}
		if($_GET["id_title_group"]=='content'){
			if($_GET["id_title"])
				$where.=" and comment like '%".$_GET["id_title"]."%' ";
		}else{
			if($_GET["id_title"])
				$where.=" and C_Name like '%".$_GET["id_title"]."%' ";
		
		}
			
			
		$table= $oDb->getAll("select * from {$this->table} {$where}");
					
		$oDatagrid->setTask(array($this->getActionAdd(),$this-> getActionEdit()));
		///$this->getActionAdd();
		
		//$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));
		//$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));
		//$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));
		//$oDatagrid->debug();
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
		$form = new HTML_QuickForm('frmAdmin','post',"?mod=admin&amod=". $_GET["amod"]."&atask={$_GET['atask']}&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		$comment =  editor ('Z_Description', $arrData['Z_Description'], array ("width" => "800px", "height"	=> "300px") );
		
		$form->setDefaults($arrData);
		
		$siteUrl = SITE_URL;	
			
		//$arr1[0]='--- None ---';
		//$arr2 = $oDb->getAssoc("select Group_ID, Group_Name from tblgroup where Group_LangID='{$lang_id}' and Group_Type='groupNews'");
		$arrPanrent = $arr1 + $arr2;
		//$this->setParent(&$arrPanrent,$arrData['id'],0,'',$lang_id);
		
		//$form -> addElement('select',  'group_id',$this->get_config_vars('parent'),$arrPanrent);
					
		$form -> addElement('text', 'name',  "Tiêu đề", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('textarea', 'page_description',  "Miêu tả", array('cols' => 90, 'rows' => 5) );
		$form -> addElement('checkbox', 'is_home', "Nổi bật");
		$form -> addElement('text', 'z_index',  "Thứ tự", array('size' => 10, 'maxlength' => 255) );
		//$form -> addElement('static', NULL,  $this->get_config_vars('content'), $comment);		
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden', 'id', $arrData['id'] );
		$form -> addRule( 'name',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required');
		
		if( $form -> validate())
		{
			$aData = array(
				'name' => stripslashes($_POST['name']),
				'page_description' => stripslashes($_POST['page_description']),
				'z_index' => stripslashes($_POST['z_index']),
				'is_home'=>stripslashes($_POST['is_home'])
			);
			
			//print_r($aData); exit();
			
			if(isset($_POST['id']) && $_POST['id']){
				$this->vsDb->updateWithPk($_POST['id'], $aData);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');	
			}else{				
				$this->vsDb->insert($aData);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}&atask={$_GET['atask']}";
		
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
		$id = $_GET['id'];
		$this->vsDb->deleteWithPk($id);
		$_SESSION['msg'] =$this->get_config_vars('msg_delete');
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
	//	$aThumbSize = $this->thumbSize;
		//CImage::createThumbnail($folder."/".$filename,$folder."/thumbnail/".$filename,$aThumbSize['w'], $aThumbSize['h']);
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
