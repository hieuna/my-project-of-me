<?php



class newsBack extends VS_Module_Base  

{

	function __construct(){

		@eval(getGlobalVars());

		parent::__construct($oDb,$oSmarty);

		$this->table = "tblcontent";

		$this->_prefix="Content_";

		$this->vsDb->setTable($this->table);	

		$this->vsDb->setPrimaryKey("Content_ID");

		//$this->type ="news";	

		$this->imagePath ="upload/content/";	

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

		

		 $oDatagrid->setTable($this->table);		

		

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

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				"sortable"	=> true

				),

			/*array(

				"field" => $this->_prefix."Photo",

				"display" => "Ảnh đại diện",				

				"datatype" => "img",

				"style" =>" width:100px; font-size:11px;  text-align:left;",

				"img_path" =>$this->imagePath,

				"img_size"=>80

			),

			array(

				"field" => $this->_prefix."Category",

				"display" => "Danh mục",

				"style" =>" font-size:11px; text-align:center;",

				"sortable"	=> true

				),

			array(

				"field" => $this->_prefix."LangID",

				"display" => $this->get_config_vars('language'),				

				"style" =>" font-size:11px; text-align:center;",

				"sql" => "select name from lang where id = ".$this->_prefix."LangID"

				

			),*/		

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

				'field'=> $this->_prefix.'Title',

				'display' => "Tìm theo tên",

				'type'=>'text',

				'name' => $this->_prefix.'Title',

				'selected'=> $_REQUEST[$this->_prefix.'Title']

			)

		);

		if($this->islang){		

			$oDatagrid->addFilter(

				array(

				"field" 	=> $this->_prefix."LangID",

				"display" 	=> $this->get_config_vars('language'),

				"name" 		=> $this->_prefix."LangID",

				"selected" 	=> isset($_REQUEST[$this->_prefix."LangID"])?$_REQUEST[$this->_prefix."LangID"]: '',

				"options"	=> $this->getAssocLang()

				)			

			);	

		}

		

	



					

		$act2 = $this-> getActionEdit();

			$result = array( 	$act2	);

			$oDatagrid->setTask($this->getAct());

		

		//$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));

		$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));

		$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));

		$oDatagrid -> setMessage( $_SESSION['msg'] );

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

		$row = $this->vsDb->getRow($id);		

		$this -> buildForm( 'edit', $row );

	}	



	function buildForm ( $task, $arrData = array() )

	{

		global $oDb;

		$form = new HTML_QuickForm('frmAdmin','post',"?mod=admin&amod={$_GET['amod']}&task=".$_GET['task']."&atask=".$_GET['atask'], '', "style=\"padding:10px 10px 0 25px\"");

		

		$comment = editor ($this->_prefix.'Content', $arrData[$this->_prefix.'Content'], array ("width" => "100%", "height"	=> "600px","skin"=>'v2') );

		

		$form->setDefaults($arrData);

		if($this->islang){

			$arrLang = $oDb->getAssoc('SELECT id,name FROM lang WHERE 1 order by isdefault desc');		

			$form -> addElement('select', $this->_prefix.'LangID', $this->get_config_vars('language'),$arrLang);

		}

		//$this->setParent(&$arrPanrent,0,0,1);

	//	$form -> addElement('text', $this->_prefix.'Category',"Danh mục",array('size' => 50, 'maxlength' => 255,'readonly'=>true));

					

		$form -> addElement('text', $this->_prefix.'Title',  "Tiêu đề bài viết", array('size' => 50, 'maxlength' => 255) );

		/*$form -> addElement('file', 'photo', $this->get_config_vars('photo'), array('style' => 'width:150px') );

		if ( $arrData[ $this->_prefix.'Photo']!= "" )

		{

			//$filesize= array("width" => $arrData["AD_Width"],"height"=> $arrData["AD_Height"]);

			$sImage = $this -> showFlash($this->imagePath.$arrData[$this->_prefix.'Photo'])."<br>

			<input type=\"checkbox\" name=\"removeImage\" value=\"1\"> <label style=\"font-size:11px\">{$this->get_config_vars('remove_this')}</label>";

			$form -> addElement ( 'static', NULL, '', $sImage );

		}*/		

		

		$form -> addElement('textarea', $this->_prefix.'Description',  "Miêu tả ngắn gọn (Nếu có)", array('cols' => 130, 'rows' => 7) );

		$form -> addElement('static', NULL,  "Nội dung đầy đủ", $comment);		

	//	$form -> addElement('date', $this->_prefix.'CreateDate',  "Ngày", array('size' => 50, 'maxlength' => 255) );

	//	$form -> addElement('text', $this->_prefix.'Order',  "Thứ tự sắp xếp", array('size' => 10, 'maxlength' => 255) );

		$form -> addElement('checkbox', $this->_prefix.'Status', $this->get_config_vars('status'));

		//$form -> addElement('checkbox', 'home_id', "Chọn nổi bật");

		//$form -> addElement('checkbox', 'slide_id', "Hiện trên slide HomePage");

		

		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );

		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );		

		$form -> addGroup($btn_group);

		

		$form->addElement( 'hidden','id', $arrData[$this->_prefix.'ID'] );

		$form->addElement( 'hidden','typect', $arrData[$this->_prefix.'Type'] );

		$form->addElement( 'hidden', 'oldPhoto', $arrData[$this->_prefix.'Photo'] );

		$form -> addRule( $this->_prefix.'Title',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required');

		/*if($arrData[$this->_prefix.'ID']=='28')

		{

				$this->type = 'terms';			

		}

		if($arrData[$this->_prefix.'ID']=='29')

		{

				$this->type = 'guide';

		}*/

		if( $form -> validate())

		{			

			$aData = array(

				$this->_prefix.'Title' => stripslashes($_POST[$this->_prefix.'Title']),

				$this->_prefix.'Description' => stripslashes($_POST[$this->_prefix.'Description']),

				$this->_prefix.'Content' => stripslashes($_POST[$this->_prefix.'Content']),

				$this->_prefix.'Status' =>$_POST[$this->_prefix.'Status'],

//				$this->_prefix.'GroupID' =>$_POST[$this->_prefix.'GroupID'],

				$this->_prefix.'Marks' =>removeMarks($_POST[$this->_prefix.'Title']),
//				$this->_prefix.'Category' => $_POST[$this->_prefix.'Category'],

//				$this->_prefix.'Type' =>$_POST['typect'],

			//	$this->_prefix.'LangID' =>$_POST[$this->_prefix.'LangID']

			);

			//print_r($aData);

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

	function setParent(&$arrPanrent,$id,$idp=0,$lang_id=1,$type='', $partten = "")

	{		

		global $oDb;

		$prefix='Group_';

		if($type=="")

			$type='news';

		$stbl = 'tblgroup';

		// type of category

		$sWhere = "{$prefix}ParentID={$idp} and {$prefix}Type='{$type}'";

		// if use language

		//if has id of current item, get other item

		if($id){

			$sWhere.= " and {$prefix}ID<>{$id}";

		}

		

		$sql="select {$prefix}ID,".$prefix."Name from {$stbl} where {$sWhere}";	

		$rows=$oDb->getAll($sql);		

		if(count($rows)){

		  	foreach($rows as $row)

		    {

				 $arrPanrent[$row["{$prefix}ID"]] =$partten. $row["{$prefix}Name"];

				 $this->setParent($arrPanrent,$id,$row["{$prefix}ID"],$lang_id,$type,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');

			}

		}

	}

	

	function deleteItem()

	{

		global $oDb;

		$id = $_GET['id'];

		$photo=  $oDb->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$id}'");

		if($photo)

			$this->unlinkPhoto($photo);

		$this->vsDb->deleteWithPk($id);

		$_SESSION['msg'] =$this->get_config_vars('msg_delete');

		$this -> redirect($_COOKIE['re_dir']);		

	}

	

	function multiDelete()

	{

		global $oDb;

		$arrId = $_GET['arr_check'];	

		foreach ( $arrId as $iId ){

			$photo=  $oDb->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$iId}'");

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

