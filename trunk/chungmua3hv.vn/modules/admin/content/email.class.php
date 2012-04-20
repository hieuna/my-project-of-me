<?php

class emailBack extends VS_Module_Base  
{
	function __construct(){
		@eval(getGlobalVars());
		parent::__construct($oDb,$oSmarty);
		$this->table = "tblmember";
		$this->_prefix="Member_";
		$this->vsDb->setTable($this->table);	
		$this->vsDb->setPrimaryKey($this->_prefix."ID");
		//$this->type ="gallery";	
		//$this->imagePath ="upload/image/";	
		//$this->thumbSize = array('w'=>275, 'h'=>140);
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
			case 'import':
				$this -> import();
				break;
			case 'export':
				$this -> export();
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
			case 'unpublish':
				$this->changeStatusMultiple(0);
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
				"field" => $this->_prefix."Email",
				"display" => "Địa chỉ email",
				"link"	=> "{$submit_url}&task=edit",
				"style" =>" font-size:11px;  text-align:center;",
				"sortable"	=> true
				),
			array(
				"field" => $this->_prefix."Name",
				"display" => "Họ Tên",
				"style" =>" font-size:11px;  text-align:center;"
				),
			array(
				"field" => $this->_prefix."Phone",
				"display" => "Số điện thoại",
				"style" =>" font-size:11px;  text-align:center;"
				),
			array(
				"field" => $this->_prefix."Status",
				"display" => "Kích hoạt",
				"style" =>" font-size:11px; text-align:center;",
				"datatype"	=> "publish",
				)
			
		);		
		
		$oDatagrid->setField($arr_cols);
		
		$oDatagrid->addFilter(
			array(
				'field'=> $this->_prefix.'email',
				'display' => "Tìm email",
				'type'=>'text',
				'name' => $this->_prefix.'email',
				'selected'=> $_REQUEST[$this->_prefix.'email']
			)
		);
		//$where.=" and {$this->_prefix}Type='".$this->type."' ";
		//if($_GET[$this->_prefix.'Name'])
			//$where.=" and{$this->_prefix}Name like '%".addslashes($_GET[$this->_prefix.'Title'])."%' ";
			
		//$table= $oDb->getAll("select *  from {$this->table} {$where} {$orderby}");
					
		$oDatagrid->setTask($this->getAct());
		
		$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));
		$oDatagrid -> setMessage( $_SESSION['msg'] );
		unset( $_SESSION['msg'] );
		//$oDatagrid->where(" ".$this->_prefix."Type='".$this->type."' ");
		$oDatagrid->displayGrid();
		//$oDatagrid->displayGridTable($table);
		//$oDatagrid->where(" ");
		echo '<input type="button" onclick="document.location.href=\'index.php?mod=admin&amod=content&atask=email&task=export\';" value="Xuất ra Excel" />';
		//$oDatagrid->displayGrid();
		
	}	
	
////////////////// ham tao file csv //////////////// /****************************************888/

	/*function import(){
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
<title></title>
</head>
<body>
<div style=\"padding:20px;\">
<h2>Import email từ excel (Chỉ chận định dạng '.CSV')</h2>
<form method=\"post\" enctype=\"multipart/form-data\">
<input type=\"file\" name=\"fileImportEmail\" />( Chọn file chứa email từ máy tính ví dụ: <i>danh-sach.csv</i>)
<p><input type=\"button\" onclick=\"history.go(-1)\" value=\"Quay lại\" />
<input type=\"submit\" value=\"Import file\" /></p>
</form>

		</div>
	</body></html>	
		";
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if($_FILES['fileImportEmail']['tmp_name']){
				
				// kiem tra xem file co dung dinh dang ko ////
				$dot = explode(".",$_FILES['fileImportEmail']['name']);
				$ext = $dot[count($dot)-1];
				if($ext == 'csv'){
				 $_CONTENT =  file_get_contents($_FILES['fileImportEmail']['tmp_name']); 
				 $_ARRCONTENT = explode("\n",$_CONTENT);
			 
				 if($_ARRCONTENT)
					foreach($_ARRCONTENT as $email){
						if($email!=""){
							$check = $this->getOne("select Member_ID from tblmember where Member_Email ='{$email}'");
							if(!$check){
								$this->query("insert into tblmember (Member_Email ,Member_Status) values ('{$email}','1')");
								echo " Email {$email} đã được thêm ! <br>";
							}else
								echo " Email {$email} bị trùng ! <br>";
						}
					}
				
			}else
					echo "Bạn chưa chọn file không đúng định dạng!";
			
			}else
					echo "Bạn chưa chọn file!";
		}
	}*/
	function export()
	{		
		$email= $this->getCol("select Member_Email from tblmember where Member_Status='1' order by  Member_Email asc");
		if($email){
			$index=0; $_STRING="";
		//********* tao file csv ///////////////////******////
			foreach($email as $colum){
				
				$_STRING.="{$colum}\n";  //tao ra chuoi email
				$index++; /// bien dem
				
				if($index % 500 == 0 and $index >= 500){
					$this->writeFileCsv("EmailAccount{$index}.csv",$_STRING); // ghi ra file moi file toi da 500 email
					$_STRING="";  //// khoi tao lai bien
					$index=0;
					
				}
			
			}
			if(count($email) < 500){
					$this->writeFileCsv("EmailAccount.csv",$_STRING); // ghi ra file moi file toi da 500 email
			
			}
		///////////////////////////////////
		}
		
/////////*****************************************************************************////////		
			$dir = SITE_DIR."upload/account/";
			echo "<div style=\"padding:20px;\"><h2>Danh sách file email (Mỗi file chứa tối đa 500 email)</h2>";
			$dh = opendir($dir);
			while (($file = readdir($dh)) !== false) {
				if ($file != '.' && $file != '..')
				{
					echo "<A HREF=\"".SITE_URL."upload/account/$file\">$file</A><BR>\n";
				}
			}
			
			closedir($dh);
					echo '<p><input type="button" onclick="javascript:history.go(-1)" value="Back" /></p></div>';
	
	 }
///88*******************************************/888888888/*************///////////////

	function writeFileCsv($filename,$content){
			$file_path = SITE_DIR."upload/account/".$filename;			
			$handle = fopen($file_path,'w');
			$contents = fwrite($handle, $content);	
			fclose($handle);				
	}
	
	
	///////////////////////////////////////////////
	
	
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
		
	//	$comment =  editor ($this->_prefix.'Content', $arrData[$this->_prefix.'Content'], array ("width" => "100%", "height"	=> "600px","skin"=>'v2') );
		
		$form->setDefaults($arrData);
		
		//$this->setParent(&$arrPanrent,0,0,1);
		//$form -> addElement('select',   $this->_prefix.'GroupID',"Danh mục",$arrPanrent);
					
		$form -> addElement('text', $this->_prefix.'Email',  "Email", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('text', $this->_prefix.'Name',  "Họ Tên", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('text', $this->_prefix.'Phone',  "Số điện thoại", array('size' => 50, 'maxlength' => 255) );
		/*$form -> addElement('text', $this->_prefix.'Link',  "Đường dẫn", array('size' => 50, 'maxlength' => 255) );
		$form -> addElement('file', 'photo', $this->get_config_vars('photo'), array('style' => 'width:150px') );
		if ( $arrData[ $this->_prefix.'Photo']!= "" )
		{
			//$filesize= array("width" => $arrData["AD_Width"],"height"=> $arrData["AD_Height"]);
			$sImage = $this -> showFlash($this->imagePath.$arrData[$this->_prefix.'Photo'])."<br>
			<input type=\"checkbox\" name=\"removeImage\" value=\"1\"> <label style=\"font-size:11px\">{$this->get_config_vars('remove_this')}</label>";
			$form -> addElement ( 'static', NULL, '', $sImage );
		}	*/	
		
		//$form -> addElement('textarea', $this->_prefix.'Content',  "Miêu tả", array('cols' => 130, 'rows' => 7) );
		//$form -> addElement('static', NULL,  "Nội dung", $comment);		
	//	$form -> addElement('date', $this->_prefix.'CreateDate',  "Ngày", array('size' => 50, 'maxlength' => 255) );
		//$form -> addElement('text', $this->_prefix.'Order',  "Thứ tự", array('size' => 10, 'maxlength' => 255) );
		$form -> addElement('checkbox', $this->_prefix.'Status', "Kích hoạt");
		//$form -> addElement('checkbox', 'home_id', "Chọn nổi bật");
		//$form -> addElement('checkbox', 'slide_id', "Hiện trên slide HomePage");
		
		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );
		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		
		$form -> addGroup($btn_group);
		
		$form->addElement( 'hidden','id', $arrData[$this->_prefix.'ID'] );
		//$form->addElement( 'hidden', 'oldPhoto', $arrData[$this->_prefix.'Photo'] );
		$form -> addRule( $this->_prefix.'email',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required');
		
		if( $form -> validate())
		{
			$aData = array(
				$this->_prefix.'Email' => stripslashes($_POST[$this->_prefix.'Email']),
				$this->_prefix.'Name' => stripslashes($_POST[$this->_prefix.'Name']),
				$this->_prefix.'Phone' => stripslashes($_POST[$this->_prefix.'Phone']),
			//	$this->_prefix.'Content' => stripslashes($_POST[$this->_prefix.'Content']),
				$this->_prefix.'Status' =>$_POST[$this->_prefix.'Status']
			//	$this->_prefix.'GroupID' =>$_POST[$this->_prefix.'GroupID'],
			//	$this->_prefix.'Order' =>$_POST[$this->_prefix.'Order'],
			//	$this->_prefix.'CreateDate' => mktime(),
			//	$this->_prefix.'Type' =>$this->type
			//	$this->_prefix.'LangID' =>$_POST[$this->_prefix.'LangID']
			);
			/*f($_POST['removeImage']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$aData[$this->_prefix.'Photo'] = "";
			}
			
			if($_FILES['photo']['name']){
				$this->unlinkPhoto($_POST['oldPhoto']);
				$uploadFile = $this->uploadPhoto();
				if($uploadFile=='none' || $uploadFile == '') $aData[$this->_prefix.'Photo'] = "";
				else
					$aData[$this->_prefix.'Photo'] = $uploadFile;
					*/
			//	echo "Dsd".$uploadFile;
			//	$size = getimagesize(SITE_URL.$this->imagePath.$uploadFile);
				//print_r($size);
				/*if($size[0]>0){
					$aData["AD_Width"]= $size[0];
					$aData["AD_Height"]= $size[1];
				}
				$aData["AD_Type"]= $this->truncateExt($uploadFile);
			//	exit();*/
				
				
			//}
			
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
	
	function multiDelete()
	{
		$arrId = $_GET['arr_check'];	
		foreach ( $arrId as $iId ){
/*			$photo=  $oDb->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$iId}'");
			if($photo)
				$this->unlinkPhoto($photo);
*/			$this->vsDb->deleteWithPk($iId);
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
		$aThumbSize = $this->thumbSize;
		CImage::createThumbnail($folder."/".$filename,$folder."/thumbnail/".$filename,$aThumbSize['w'], $aThumbSize['h']);
		return $file;
	}
	
	function saveOrder()
	{
		$arrOrder = $_GET[$this->_prefix."Order"];
	//	print_r($arrOrder);
		foreach ( $arrOrder as $key => $value )
		
			$this -> vsDb -> updateWithPk ( $key , array ( $this->_prefix."Order" => $value ));		
		
		$_SESSION['msg'] = $this->get_config_vars("msg_saveorder");
		$this -> redirect($_COOKIE['re_dir']);	
	}
	
	function changeStatusMultiple($status)
	{		
		$sIds = implode(",", $_GET['arr_check']);
		$this -> vsDb -> updateWithPk ( $sIds , array ( 'Content_Status' => $status ));				
		
		if($status==1)
			$_SESSION['msg'] = $this->get_config_vars("msg_publish");
		else 
			$_SESSION['msg'] = $this->get_config_vars("msg_unpublish");
		$this -> redirect($_COOKIE['re_dir']);	
	}	
}
?>
