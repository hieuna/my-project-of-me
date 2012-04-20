<?php
class DestinationBack extends baseGroup
{
	var $table;
	var $pk;
	var $_prefix;
	var $arr_fields;
	var $mod;
	function __construct() {
		parent::__construct();
		
		$this->imagePath = "upload/group";
		$this->type = "destination";
	
	}
	
	function unlinkPhoto( $sImage )
	{
		if( $sImage )
		{
			@unlink(SITE_DIR.$this->imagePath."/{$sImage}");			
		}
	}

	function uploadPhoto ()
	{
		include(SITE_DIR."classes/image.class.php");
		$folder = SITE_DIR.$this->imagePath;
		$filename = mktime() . $_FILES[$this->_prefix.'Photo']['name'];
		
		$file = CImage::uploadFile($_FILES[$this->_prefix.'Photo']['tmp_name'], $filename, $folder);	
		
		return $filename;
	
	}
	
	function buildForm ( $task, $arrData = array())
	{
		global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',$_COOKIE['re_dir']."&task=".$_GET['task'], '', "style=\"padding:10px 10px 0 25px\"");
		
		
		$aOption = array('disabled'=>"disabled", "id"=> "s_construct");
		if( $task == "edit" )
		{
			$form->setDefaults($arrData);
		}
		
		if( $task == "edit" ){			
			$idt=$arrData[ $this->_prefix.'ID'];
			if( $arrData[$this->_prefix.'ParentID'] == 1){
				$aOption = array( "id"=> "s_construct");
			}
		}
			
		$siteUrl = SITE_URL;	
		echo "<script type=\"text/javascript\" src=\"{$siteUrl}lib/js/language.js\"></script>";
		$url = "?mod=admin&amod={$_REQUEST['amod']}&atask={$_GET['atask']}&atype=destination&task=changeLang&categoryid={$idt}&ajax";
		
		//$lang_default = $this->getLangDefault();
		//$lang_id = isset($arrData['Group_LangID'])?$arrData['Group_LangID']:$lang_default;		
		
		$arrAttribute = array('width' => 200, 'onchange'=>"changeLang(this.value,'{$url}', '".$this->_prefix."ParentID"."')");
		
		/*if($this->islang)
			$form -> addElement('select', $this->_prefix.'LangID', $this->get_config_vars('language'),$this->getAssocLang(), $arrAttribute );*/
		
		$arrPanrent[0]='--- None ---';		
		//$this->setParent(&$arrPanrent,$idt,0,'',$lang_id,$_GET["atype"]);
		
	//	$form -> addElement('select',  $this->_prefix.'ParentID',$this->get_config_vars('parent'),$arrPanrent, array("onchange"=>"if(this.value==1) $('#s_construct').attr('disabled',''); else $('#s_construct').attr('disabled','disabled');"));
		
		$form -> addElement('text',  $this->_prefix.'Name',  $this->get_config_vars('name'), array('size' => 50, 'maxlength' => 255) );							
		/*$form -> addElement('file', $this->_prefix.'Photo', $this->get_config_vars('photo'), array('style' => 'width:150px') );
		if ( $arrData[$this->_prefix.'Photo']!= "" )
		{
			$sImage = "<image src = '".SITE_URL.$this->imagePath.'/'.$arrData[$this->_prefix.'Photo']."' style = 'width:130px;'>";
			$form -> addElement ( 'static', NULL, '', $sImage );
		}	*/	
		if($arrData['Group_ID']){
			$aOptions = $oDb->getCol("select attribute_id from tbl_group_attribute where group_id='{$arrData['Group_ID']}'");	
		}		 
		//$comment =  editor ('Group_Description', $arrData['Group_Description'], array ("width" => "800px", "height"	=> "300px",) );
		//$comment =  editor ($this->_prefix.'Content', $arrData[$this->_prefix.'Content'], array ("width" => "100%", "height"	=> "600px","skin"=>'v2') );
		//$sOptions = $this -> buildOption($aOptions);
		//$form -> addElement('static',null, $this->get_config_vars('options'), $sOptions);
		
		$form -> addElement('text', $this->_prefix.'Order', $this->get_config_vars('order'), array('size' => 10, 'maxlenght' => 50) );		
		
	//	$form -> addElement('checkbox', $this->_prefix.'Option', $this->get_config_vars('computer_contruction'),"<label style='font-size:11px;'>".$this->get_config_vars('help_contruction')."</label>", $aOption);
		$form -> addElement('checkbox', $this->_prefix.'Status', $this->get_config_vars('publish'));
		//$form -> addElement('checkbox', $this->_prefix.'Hot', $this->get_config_vars('publish'));
	//	$form -> addElement('textarea', $this->_prefix.'Description', $this->get_config_vars('Description'), array('cols' => 120, 'rows' => 7) );		
	//	$content =  editor (  $this->_prefix.'Content', $arrData[$this->_prefix.'Content'], array ("width" => "800px", "height"	=> "600px") );		
	//	$form -> addElement('static', NULL,  $this->get_config_vars('content'), $content);		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button'));
		$btn_group[] = $form -> createElement( 'button',null,'Back',array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );
		
		$form -> addGroup($btn_group);		
		$form->addElement( 'hidden', 'id', $arrData[$this->_prefix.'ID'] );		
		$form->addElement( 'hidden', 'old_photo', $arrData[$this->_prefix.'Photo'] );		
		$form -> addRule( $this->_prefix.'Name',$this->get_config_vars('title')." ".$this->get_config_vars('no_blank'),'required',null,'client' );
		$form -> addRule( $this->_prefix.'Order',$this->get_config_vars('order')." ".$this->get_config_vars('no_number'),'numeric',null,'client');		
		
		if( $form -> validate())
		{	$this->arr_fields[$this->_prefix.'Mark'] =  removeMarks($_POST[$this->_prefix.'Name']);
			$this->arr_fields[$this->_prefix.'Hot'] =$_POST[$this->_prefix.'Hot'];
			if( $_POST['id'] == '' ){
				if ( $_FILES[$this->_prefix.'Photo']['name'] != '')
				{
					$this->arr_fields[$this->_prefix.'Photo'] = $this -> uploadPhoto();
				}
				
				$this->arr_fields[$this->_prefix.'Type'] = $this->type;
				$group_id = $this -> vsDb ->insert($this->arr_fields);
				$_SESSION['msg'] = $this->get_config_vars('msg_add');
			}
			else 		
			{	$this->arr_fields[$this->_prefix.'Mark'] = removeMarks($_POST[$this->_prefix.'Name']);		
				$this->arr_fields[$this->_prefix.'Type'] = $this->type;
				if ( $_FILES[$this->_prefix.'Photo']['name'] != '')
				{
					if ( $_POST['old_photo'] != '' )
						$this -> unlinkPhoto( $_POST['old_photo'] );
						$this->arr_fields[$this->_prefix.'Photo'] = $this -> uploadPhoto();
				}
				$this -> vsDb -> updateWithPk ( $_POST['id'],$this->arr_fields );
				//$group_id = $_POST['id'];
				//$this->deleteAttr($group_id);
				$_SESSION['msg'] = $this->get_config_vars('msg_edit');
			}
			
			if(isset($_POST['options'])){
				$this->addAttribute($group_id, $_POST['options']);
			}
			
			$this -> redirect($_COOKIE['re_dir']);
		}		
		$form->display();		
	}
	
	function buildOption($aOptions = ''){
		global $oDb;
		$sReturn = "<div style=\"border:1px solid gray; padding:10px 0px 10px 10px; width:700px; line-height:35px;\">";
		
		$stbl = "tbl_attribute";
		$sql = "SELECT id,title FROM {$stbl} WHERE 1 order by z_index, id desc";
		$result = $oDb->getAssoc($sql);			
		if( count($result) >0 ){
			foreach ($result as $k=>$v){
				$sSelect="";
				if(is_array($aOptions) && in_array($k, $aOptions)) $sSelect = "checked";
				
				$sReturn .= "<input type=\"checkbox\" name=\"options[{$k}]\" {$sSelect}> {$v} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}else{
			return '';
		}		
		
		$sReturn .= "</div>";
		return $sReturn;
	}
	
	function deleteAttr($group_id){
		global $oDb;
		$sql = "delete from tbl_group_attribute where group_id='{$group_id}'";
		$oDb->query($sql);
	}
	
	function addAttribute( $group_id, $aOptions){
		global $oDb;
		foreach ($aOptions as $k=>$v){
			$sql ="insert into tbl_group_attribute(`group_id`,`attribute_id`) values('{$group_id}', '{$k}');";
			$res = $oDb->query($sql);
		}		
	}
	
	function listItem()
	{
		global $oDb,$oSmarty;
		global $oDatagrid;	
			//print_r($oDatagrid);			
		parent::getPath($this->get_config_vars('list_root_'.$_GET['atask']));
		$submit_url= "?mod=admin&amod={$_REQUEST['amod']}&atask={$_GET['atask']}&atype={$_GET['atype']}";
		$oDatagrid->setMethod($submit_url);
		
		
		$table = $this->table;
		//$oDatagrid->setTable($table);
		if($_GET[$this->_prefix."Name"])
				$aData= $this->getAll("select *,(select name from lang where id={$this->_prefix}LangID) as {$this->_prefix}LangID from {$this->table} where ".$this->_prefix."Type = '".$this->type."'
				 and LOWER(Group_Name) like '%".strtolower(trim($_GET["Group_Name"]))."%' 
				");
		else{
			$where[] = $this->_prefix."Type = '".$this->type."'";
	
			if($this->islang) {
				if($_GET[$this->_prefix."LangID"]){
					
					$where[] = "{$this->_prefix}LangID='{$_GET[$this->_prefix."LangID"]}'";
				}
				
				$sSelectLang = ",(select name from lang where id={$this->_prefix}LangID) as {$this->_prefix}LangID";
			}
			
			$condition = implode(" AND ", $where);
			$order = ($_GET['sort_by'])?($_GET['sort_by']): $this->_prefix."ID";
			$orderType = $_GET['sort_value'];
			
			$aData = $this -> multiLevel( $table, $this->_prefix."ID",  $this->_prefix."ParentID", "*{$sSelectLang}", "{$condition}", "{$order} {$orderType}");
			
			foreach ( $aData as $key => $row){
				if( $row['level'] > 0){				
					$aData[$key][ $this->_prefix."Name"] = $this -> getPrefix( $row['level']).$row[ $this->_prefix."Name"];
				}
			}
			
		}
			$oDatagrid->addField(array("field"=>$this->_prefix."ID","primary_key"=>true,"display"=>$this->get_config_vars('id'),"sortable"=>true,"width"=>50));
			$oDatagrid->addField(array("field"=> $this->_prefix."Name","link"	=> "{$submit_url}&task=edit","display"=>$this->get_config_vars('title'),"sortable"=>true,"style"=>"text-align:center;"));		
			$oDatagrid->addField(array("field"=>$this->_prefix."Order","display"=>$this->get_config_vars('order'),"datatype"=>"order","sortable"=>true));
		$oDatagrid->addFilter(
			array(
				'field'=>$this->_prefix."Name",
				'display' => "Nhập từ khóa",
				'type'=>'text',
				'name' => $this->_prefix."Name",
				'selected'=> trim($_REQUEST[$this->_prefix."Name"])
			)
		);
		/*if($this->islang){		
			$oDatagrid->addFilter(
				array(
				"field" 	=> $this->_prefix."LangID",
				"display" 	=> $this->get_config_vars('language'),
				"name" 		=> $this->_prefix."LangID",
				"selected" 	=> isset($_REQUEST[$this->_prefix."LangID"])?$_REQUEST[$this->_prefix."LangID"]: '',
				"options"	=> $this->getAssocLang()
				)			
			);	
			
			$oDatagrid->addField(array("field" => $this->_prefix."LangID","display" => $this->get_config_vars('language')));		
		}*/
		
		$oDatagrid->addField(array("field"=>$this->_prefix."Status","display"=> $this->get_config_vars('publish'),"datatype"=>"publish"));
		if($_SESSION[$_SESSION["prefix_"]]['user_type']==1){
			
			$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));
//			$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));
//			$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));
		}
		
		if($_SESSION[$_SESSION["prefix_"]]['user_type']==1){
		$oDatagrid->setTask(
			array(
			array(
				"task" => "add",
				"action" => "",
				"icon" => "add.png",
				"tooltip" => "Add record"		
			),		
			array(
				"task" => "edit",
				"text" => "Edit",
				"icon" => "edit.png",
				"action" => "",
				"tooltip" => "Edit record"		
			),		
			array(
			
				"task" => "delete",
				"text" => "Delete",
				"icon" => "delete.jpg",
				"confirm" => "Are you sure want to delete this item ?",
				"action" => "",
				"tooltip" => "Delete record"
			)
		));}else{
		$oDatagrid->setTask(
			array(
			array(
				"task" => "add",
				"action" => "",
				"icon" => "add.png",
				"tooltip" => "Add record"		
			)));	
		}
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		
		$oDatagrid->displayGridTable($aData);
	}
	
	
	function deleteItem()
	{
		$id = $_GET['id'];
		if($id==1){			
			$_SESSION['msg'] = $this->get_config_vars('msg_no_delete_group');
			$this->listItem();	
			return ;
		}
		if ($this->checkDelete($id))
		{
			$this -> vsDb -> deleteWithPk ($id);
			$_SESSION['msg'] = $this->get_config_vars('msg_delete');
		}
		else 
			$_SESSION['msg'] = $this->get_config_vars('msg_no_delete_group');
			
		
		$this->listItem();	
	}
	
	function multiDeleteItem()
	{
		$arrId = $_GET['arr_check'];	
		$strId = implode(',',$arrId);
		if ($this->checkDelete($strId))
		{
			foreach ( $arrId as $iId )
			{
				if($iId!=1)
					$this -> vsDb -> deleteWithPk ($iId);
			}
			$_SESSION['msg'] = $this->get_config_vars('msg_delete');
		}
		else 
			$_SESSION['msg'] = $this->get_config_vars('msg_no_delete_group');
		$this->listItem();	
	}
	
}
?>