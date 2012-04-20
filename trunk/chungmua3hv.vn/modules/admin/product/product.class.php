<?php



class ProductBack extends VS_Module_Base  

{

	function __construct(){

		@eval(getGlobalVars());

		parent::__construct($oDb,$oSmarty);

		$this->table = "tblproduct";

		$this->_prefix = "Product_";

		$this->type = "deal";

		$this->vsDb->setTable($this->table);	

		$this->vsDb->setPrimaryKey($this->_prefix."ID");

		$this->imagePath ="upload/product/";	

		$this->thumbSize = array('w'=>500, 'h'=>500);

	}

	

	function run( $task )

	{	

		switch ( $task )

		{

			default:

				$this -> listItem();

				break;

			case 'changeOptions':

				//echo $_GET['lang_id'];				

				echo $this->buildOption($_GET['lang_id']);

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

			case "chagedestination":

				$this->chageDestination();

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

		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}&atask={$_GET['atask']}&atype={$_GET['atype']}";

		

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

				"field" => $this->_prefix."Photo",

				"display" => "Ảnh đại diện",				

				"datatype" => "img",

				"img_path" =>$this->imagePath ,

				"img_size"=>100

			),

			array(

				"field" => $this->_prefix."Deal",

				"display" => $this->get_config_vars('title'),

				"link"	=> "{$submit_url}&task=edit",

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				"sortable"	=> true

				),

			array(

				"field" => $this->_prefix."GroupID",

				"display" => "Danh mục",

				"style" =>" font-size:11px; text-align:center;",

				"datatype"	=> "text",

				"sql" => " select Group_Name from tblgroup where Group_ID = Product_GroupID "

				),

			array(

				"field" => $this->_prefix."Destination",

				"display" => "Địa danh",

				"style" =>" font-size:11px; text-align:center;",

				"datatype"	=> "text",

				"sql" => " select Group_Name from tblgroup where Group_ID = Product_DestinationID "

				),

			array(

				"field" => $this->_prefix."Status",

				"display" => "Kích hoạt",

				"style" =>" font-size:11px; text-align:center;",

				"datatype"	=> "publish",

				),

			array(

				"field" => $this->_prefix."Price",

				"display" => "Giá thực",

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				"datatype"	=> "text",

				),

			array(

				"field" => $this->_prefix."DealPrice",

				"display" => "Giá deal",

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				"datatype"	=> "text",

				)

			

		);		

		

		$oDatagrid->setField($arr_cols);

		

		$oDatagrid->addFilter(

			array(

				'field'=>$this->_prefix."Name",

				'display' => "Nhập từ khóa",

				'type'=>'text',

				'name' => $this->_prefix."Name",

				'selected'=> $_REQUEST[$this->_prefix."Name"]

			)

		);

		$this->setParent(&$arrPanrent,0,0,'',$this->type);

		$this->setParent(&$desti,0,0,'','destination');

		

		$oDatagrid->addFilter(

			array(

				'field'=> $this->_prefix.'GroupID',

				'display' => "Tìm trong danh mục",

				'options' =>$arrPanrent,

				'name' => $this->_prefix.'GroupID',

				'selected'=> $_REQUEST[$this->_prefix.'GroupID']

			)

		);

		$oDatagrid->addFilter(

			array(

				'field'=> $this->_prefix.'DestinationID',

				'display' => "theo địa danh",

				'options' =>$desti,

				'name' => $this->_prefix.'DestinationID',

				'selected'=> $_REQUEST[$this->_prefix.'DestinationID']

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

		

		$oDatagrid->setTask($this->getAct());

		

		$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));

		$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));

		$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));

		$oDatagrid -> setMessage( $_SESSION['msg'] );

		unset( $_SESSION['msg'] );

	

		$oDatagrid->displayGrid();

		

	}	

	function explodeTime($time){

		if($time =='')

			return mktime();

			

		$arr= explode(" ",trim($time));

		$return = array();

		$date= explode("/",$arr[0]);

		$time= explode(":",$arr[1]);

		$return["day"]= $date[0];

		$return["month"]= $date[1];

		$return["year"]= $date[2];

		$return["hour"]= $time[0];

		$return["minute"]= $time[1];

		return $return;

	}

	function loadData(){

		

		

			$aData= array(

				$this->_prefix."Deal" => $_POST["txtName"],

				$this->_prefix."Name" => $_POST["txtNameFull"],

				$this->_prefix."GroupID" => $_POST["selCategory"],

				$this->_prefix."DestinationID" => $_POST["selCity"],

				$this->_prefix."Description" => $_POST["txtDescription"],

				$this->_prefix."Content" => $_POST["txtContent"],

				$this->_prefix."Terms_of_Use" => $_POST["txtDieukhoan"],
				$this->_prefix."Note" => $_POST["txtNote"],

				$this->_prefix."Price" => $_POST["txtValue"],

				$this->_prefix."Status" => $_POST["chekStatus"],

				$this->_prefix."Hot" => $_POST["chekHot"],

				$this->_prefix."Sold" => $_POST["chekSold"],

				$this->_prefix."DealPrice" => $_POST["txtOutValue"],

				$this->_prefix."Buy" => $_POST["txtNumberBuy"],

				$this->_prefix."Minimun" => $_POST["txtNumberMinimun"],

				$this->_prefix."NumberView" => $_POST["txtNumberView"],

				$this->_prefix."Quantity" => $_POST["txtNumber"]

			);

			if(!$_POST["txtAddress"] || $_POST["txtAddress"] =="")

			// lay dia chi url

					$aData[$this->_prefix."LinkName"] = strtolower(removeMarks($aData[$this->_prefix."Deal"]));

					

			else

					$aData[$this->_prefix."LinkName"] = strtolower(trim($_POST["txtAddress"]));

				

			///////

			

			

					

			// upload hình ảnh ///

			if($_FILES['photo']['name']){

				/*********/

				$uploadFile = $this->uploadPhoto();

				if($uploadFile=='none' || $uploadFile == '') $aData[$this->_prefix.'Photo'] = "";

				else

					$aData[$this->_prefix.'Photo'] = $uploadFile;

					

				/*********/

					

			}

				

			// upload hình ảnh ///

			// upload bản đồ ///

			if($_FILES['photoMap']['name']){

				/*********/

				$uploadFile = $this->uploadPhoto('photoMap',"upload/map/",1);

				if($uploadFile=='none' || $uploadFile == '') $aData[$this->_prefix.'Map'] = "";

				else

					$aData[$this->_prefix.'Map'] = $uploadFile;

					

				/*********/

					

			}

				

			// upload bản đồ ///

				

			$date=$this->explodeTime($_POST["txtFromTime"]);

			$aData[$this->_prefix."StartDate"]= mktime($date["hour"],$date["minute"],0,$date["month"],$date["day"],$date["year"]);

			$date=$this->explodeTime($_POST["txtEndTime"]);

			$aData[$this->_prefix."EndDate"]= mktime($date["hour"],$date["minute"],0,$date["month"],$date["day"],$date["year"]);

		

		

		return $aData;

	

	}

	function addItem()

	{		

		$this -> getPath($this->get_config_vars('edit_root_news'));

		global $oSmarty;

//		echo $oSmarty->template_dir;

		if($_SERVER['REQUEST_METHOD']=='POST'){

		//	print_r($_POST);

				$aData= $this->loadData();

				$pro_id= $this->vsDb->insert($aData);

				$_SESSION['msg']=" Thêm dữ liệu thành công!";

				$this -> redirect("?mod=admin&amod=product&atask=product&atype=deal&msg=Thêm thành công");	

		}

		$category= $this->getAll("select * from tblgroup where Group_Type='deal'");

		$destination= $this->getAll("select * from tblgroup where Group_Type='destination'");

		$this->assign("category",$category);

		$this->assign("destination",$destination);

		$this->display("tplEditProduct.tpl");

		//$this -> buildForm( 'add' );

	}

	

	function editItem()

	{

		if($_SERVER['REQUEST_METHOD']=='POST'){

		//	//////

				$aData= $this->loadData();

				if($_POST["ID"])

					// sua du lieu //

					$this -> vsDb -> updateWithPk ( $_POST['ID'],$aData);

					/////////////////// *****//////

				$_SESSION['msg']=" Sửa dữ liệu thành công!";

				$this -> redirect("?mod=admin&amod=product&atask=product&atype=deal");	

					

				/////////

		}

		

		$id = intval($_GET['id']);		

		$this -> getPath($this->get_config_vars('edit_root_news').": {$id}");

		$row = $this->vsDb->getRow($id);			

		$category= $this->getAll("select * from tblgroup where Group_Type='deal'");

		$destination= $this->getAll("select * from tblgroup where Group_Type='destination'");

		$this->assign("rowItem",$row);

		$this->assign("category",$category);

		$this->assign("destination",$destination);

		$this->display("tplEditProduct.tpl");

	}	







	

	function deleteItem()

	{

		global $oDb;

		$id = $_GET['id'];

			$photo=  $this->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$iId}'");

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

			$photo=  $this->getOne("select {$this->_prefix}Photo from {$this->table} where {$this->_prefix}ID='{$iId}'");

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

			@unlink(SITE_DIR.$this->imagePath."/{$sImage}");

			@unlink(SITE_DIR.$this->imagePath."/thumb/{$sImage}");

		}

	}



	function uploadPhoto ($name='photo',$path="",$thumbnail=0)

	{

		include_once(SITE_DIR."classes/image.class.php");

		if($path=="")

			$path=$this->imagePath;

		$folder = SITE_DIR.$path;

		

		

		$filename = mktime() . $_FILES[$name]['name'];

		$file = CImage::uploadFile($_FILES[$name]['tmp_name'], $filename, $folder);

		$aThumbSize = $this->thumbSize;

		if($thumbnail==0)

			CImage::createThumbnail($folder."/".$filename,$folder."/thumb/".$filename,$aThumbSize['w'], $aThumbSize['h']);

		return $file;

		unset($file);

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

		//$arrPanrent=array();		

		$name = 'Product_GroupID';

		$arrGroup[-1] = array('Group_Name'=>'--- none ---', 'Group_ID'=>0);

		//$arrParent[0]='--- None ---';	

		$this->setParent(&$arrParent,0,0,'',$this->type,$lang_id);

		$sContent.="<select name=\"{$name}\" id=\"{$name}\">";

		if($arrParent)

		foreach($arrParent as $k=>$v){

			$sContent .= "<option value=\"{$k}\">{$v}</option>";

		}

		$sContent.="</select>";

		echo $sContent;

	}	

	function chageDestination()

	{

		global $oSmarty,$oDb;

		$lang_id = $_GET['lang_id'];

		$arrPanrent=array();		

		$name = 'Product_DestinationID';

		$this->setParent(&$arrParent,0,0,'','destination',$lang_id);

		$sContent.="<select name=\"{$name}\" id=\"{$name}\">";

		if($arrParent)

		foreach($arrParent as $k=>$v){

			$sContent .= "<option value=\"{$k}\">{$v}</option>";

		}

		$sContent.="</select>";

		echo $sContent;

	}	

	function setParent(&$arrPanrent,$id,$idp=0,$text='',$type='',$lang='', $partten = " --- ")

	{		

		global $oDb;

		$prefix='Group_';

		$stbl = 'tblgroup';

		// type of category

		if ($type == '') $type = $_GET['amod'];

		// default sql where

		$sWhere = "{$prefix}ParentID={$idp} and {$prefix}Type='{$type}'";

		// if use language

		//if has id of current item, get other item

		if($lang!=""){

			$sWhere.= " and {$prefix}LangID ='".$lang."'";

		}

		elseif($_SESSION["lang_id"]){

			$sWhere.= " and {$prefix}LangID ='".$_SESSION["lang_id"]."'";

		}

		if($id){

			$sWhere.= " and {$prefix}ID<>{$id}";

		}

		

		$sql="select {$prefix}ID,".$prefix."Name from {$stbl} where {$sWhere}";	

		$rows=$oDb->getAll($sql);				

		if(count($rows)){

		  	foreach($rows as $row)

		    {

				 $arrPanrent[$row["{$prefix}ID"]] =$text. $row["{$prefix}Name"];

				 $this->setParent($arrPanrent,$id,$row["{$prefix}ID"],$text.$partten,$type,$lang);

			}

		}

	}

	

}

?>

