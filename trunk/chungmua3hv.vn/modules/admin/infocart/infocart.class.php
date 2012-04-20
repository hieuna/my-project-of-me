<?php

 

require_once('models/baseInfocart.php');

class InfocartBack extends baseInfocart  

{

	function __construct(){

		@eval(getGlobalVars());

		parent::__construct($oDb,$oSmarty);

		$this->table = "tbl_shopping";

		$this->_prefix="Shopping_";

		$this->vsDb->setTable($this->table);	

		$this->vsDb->setPrimaryKey("Shopping_ID");

		

	}

	

	function run( $task )

	{		

		

		switch ( $task )

		{

			default:

			

				$this -> listInfocart();

				break;

			case 'export':
				$this -> exportCSV(trim($_GET["CODE"])) ;
				break;
				
			case 'exportall':
				$this -> exportCSVAll() ;
				break;
				
			case 'add':

				$this -> addInfocart() ;

				break;

			case 'edit':

				$this -> editInfocart();

				break;

			case 'delete':

				$this -> deleteInfocart();

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

	

	function listInfocart()

	{

		global $oDb;

		global $oDatagrid;			

	

		$root_path = $this->get_config_vars('list_root_news');						

		$submit_url= "?mod={$_GET['mod']}&amod={$_GET['amod']}&ajax=true";

		

		parent::getPath($root_path);

	 	$oDatagrid->setMethod($submit_url);

		
		$where = " where 1 ";
		if($_GET[$this->_prefix."Name"])
			$where.=" and LOWER({$this->_prefix}Name) like '%".strtolower(trim($_GET[$this->_prefix."Name"]))."%' ";
			
		if($_GET[$this->_prefix."Code"])
			$where.=" and {$this->_prefix}Code = '".trim($_GET[$this->_prefix."Code"])."' ";
			
		if($_GET[$this->_prefix."ProductID"])
			$where.=" and {$this->_prefix}ProductID = '".$_GET[$this->_prefix."ProductID"]."'";
	
		if($_GET[$this->_prefix.'Create']){
			$_date=explode("-",trim($_GET[$this->_prefix.'Create']));
			//print_r($_date);
			if(count($_date)==1){
				$_mktime=mktime(0,0,0,1,1,$_date[0]);
				$where.=" and Shopping_Create >= '".mktime(0,0,0,1,1,$_date[0])."' and Shopping_Create <= '".mktime(0,0,0,31,12,$_date[0])."' ";
			}elseif(count($_date)==2){
				$_mktime=mktime(0,0,0,$_date[1],1,$_date[0]);
				 $where.=" and Shopping_Create >= '".mktime(0,0,0,$_date[1],1,$_date[0])."' and Shopping_Create <= '".mktime(0,0,0,$_date[1],31,$_date[0])."' ";
			}
			else{
				$_mktime=mktime(0,0,0,$_date[1],$_date[2],$_date[0]);
				$where.=" and Shopping_Create >= '".mktime(0,0,0,$_date[1],$_date[2],$_date[0])."' and Shopping_Create <= '".mktime(24,0,0,$_date[1],$_date[2],$_date[0])."' ";
			}
		}
			
		$count =$oDb->getOne("select count({$this->_prefix}ID) from {$this->table} {$where}");	
		
		$sql="select *,(select Product_Deal from tblproduct where Product_ID =  {$this->_prefix}ProductID) as Product_Deal,(select Group_Name from tblgroup where Group_ID =  {$this->_prefix}City) as {$this->_prefix}City from {$this->table} {$where} ";
			$iCurrentPage = (isset($_GET['page'])&&$_GET['page']>0)?$_GET['page']:1;
			$stepPage = (isset($_GET['per_page'])&&$_GET['per_page']>0)?$_GET['per_page']:20;
			$sOrder=" order by  {$this->_prefix}ID desc ";
			if($_GET["sort_by"]){
				$sOrder =" order by ".$_GET["sort_by"]." ".$_GET["sort_value"]." ";
			}
			if($iCurrentPage > 0)
				$iCurrentPage__=($iCurrentPage-1)*$stepPage;
				
			$sLimit = " LIMIT 0,".($iCurrentPage__+$stepPage);
		//	echo $sql.$sOrder.$sLimit; 
			$items =$oDb->getAll($sql.$sOrder.$sLimit);	
		

		$arr_cols= array(					

			array(

				"field" => $this->_prefix."ID",					

				"primary_key" =>true,

				"visible"=>"hidden",

				"display" => $this->get_config_vars('id'),

				"sortable" => true							

			),	
			array(

				"field" => $this->_prefix."Code",

				"display" => "Mã ĐH",

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				"sortable"	=> true
				),

			array(

				"field" => $this->_prefix."Name",

				"display" => "Tên KH",

				"link"	=> "{$submit_url}&task=edit",

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				"sortable"	=> true

				),
			array(

				"field" => $this->_prefix."Address",

				"display" => "Ðịa chỉ",

				"style" =>" font-size:11px; text-align:left;",

				),
			array(

				"field" => $this->_prefix."City",

				"display" => "Quận",	

				"datatype"=>"text",
				"style" =>" font-size:11px;  text-align:left;",

			),
			array(

				"field" => $this->_prefix."Phone",

				"display" => "ĐT",

				"style" =>" font-size:11px; font-weight:bold; text-align:center;",

				),

			array(

				"field" => "Product_Deal",

				"display" => "SP",	

				"datatype"=>"text",
				"style" =>" font-size:11px;  text-align:left;",

			//	"sql"=>" select Product_Deal from tblproduct where Product_ID=".$this->_prefix."ProductID "	

			),

			array(

				"field" => $this->_prefix."Create",

				"display" => "Ngày đặt",
				"datatype"=>"date",

				"style" =>" font-size:11px; text-align:center;",

				"sortable"	=> true

				),
			array(

				"field" => $this->_prefix."Quantity",

				"display" => "SL",

				"style" =>" font-size:11px; text-align:center;",

				"sortable"	=> true

				),
			array(

				"field" => $this->_prefix."Type",

				"display" => "Thanh toán",

				"style" =>" font-size:11px; text-align:left;"

				),


			array(

				"field" => $this->_prefix."Complete",

				"display" => "Tình trạng TT",

				"style" =>" font-size:11px; text-align:center;",

				"datatype"	=> "boolean",

				)

			

		);		

		

		$oDatagrid->setField($arr_cols);

		

		$oDatagrid->addFilter(

			array(

				'field'=> $this->_prefix.'Name',

				'display' => "Tìm theo thên",

				'type'=>'text',

				'name' => $this->_prefix.'Name',

				'selected'=> $_REQUEST[$this->_prefix.'Name']

			)

		);
		$oDatagrid->addFilter(

			array(

				'field'=> $this->_prefix.'Code',

				'display' => "Mã đơn hàng",

				'type'=>'text',

				'name' => $this->_prefix.'Code',

				'selected'=> $_REQUEST[$this->_prefix.'Code']

			)

		);
		$oDatagrid->addFilter(

			array(

				'field'=> $this->_prefix.'Create',

				'display' => "Thời gian(yy-mm/dd)",

				'type'=>'date',

				'name' => $this->_prefix.'Create',

				'selected'=> $_REQUEST[$this->_prefix.'Create']

			)

		);


			$oDatagrid->addFilter(

				array(

				"field" 	=> $this->_prefix."ProductID",

				"display" 	=> "Theo sản phẩm",
				"style" =>	"width:200px;",

				"name" 		=> $this->_prefix."ProductID",

				"selected" 	=> isset($_REQUEST[$this->_prefix."ProductID"])?$_REQUEST[$this->_prefix."ProductID"]: '',

				"options"	=> $this->getAssoc("select Product_ID, Product_Deal from tblproduct where Product_Status='1'
				order by Product_ID desc")

				)			

			);	


		

		/*$oDatagrid->addFilter(

			array(

				'field'=> $this->_prefix.'Type',

				'display' => "Loáº¡i ná»™i dung",

				'options' =>$this->arrType,

				'name' => $this->_prefix.'Type',

				'selected'=> $_REQUEST[$this->_prefix.'Type']

			)*/

		//);

		

		$orderby=" order by {$this->_prefix}ID desc";

		$where=" where 1";

		if($_GET["sort_by"]){

			$field = $_GET["sort_by"];

			$sortby= $_GET["sort_value"];

			$orderby=" order by {$field} {$sortby} ";

		}

		

		if($_GET[$this->_prefix.'namedeal'])

			$where.=" and Shopping_namedeal like '%".addslashes($_GET[$this->_prefix.'namedeal'])."%' ";

		/*if($_GET[$this->_prefix.'LangID'])

			$where.=" and Shopping_LangID = '".addslashes($_GET[$this->_prefix.'LangID'])."' ";*/

			

		$table= $oDb->getAll("select *,(select Product_Name from tblproduct where Product_ID=".$this->_prefix."ProductID) as Shopping_namedeal from {$this->table} ");

					

		$act2 = $this-> getActionEdit();

		$act3 = $this-> getActionDelete();

			$result = array( $act2,$act3);

			$oDatagrid->setTask($result);

		

		//$oDatagrid->addTaskAll(array('task'=>'multi_delete','display'=>$this->get_config_vars('delete')));

		$oDatagrid->addTaskAll(array('task'=>'publish','display'=>$this->get_config_vars('publish')));

		$oDatagrid->addTaskAll(array('task'=>'unpublish','display'=>$this->get_config_vars('unpublish')));
		$oDatagrid->addTaskAll(array('task'=>'exportall','display'=>"Export excel"));

		$oDatagrid -> setMessage( $_SESSION['msg'] );

		unset( $_SESSION['msg'] );

		//print_r($table);

		$oDatagrid->displayGridTable($items,$count);

		

	}	

	

	function addInfocart()	

	{

		$this -> getPath( $this->get_config_vars('add_root_'.$this->mod));

		$this -> buildForm('add');

	}

	

	function editInfocart()

	{

		$id = intval($_GET['id']);		

		$this -> getPath($this->get_config_vars('edit_root_'.$this->mod));

		$row = $this->getDetailObject($id);			

		$this -> buildForm( 'edit', $row );

	}

	

	

	function deleteInfocart()

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
		global $oDb;
		$id = $_GET['id'];

		$field= trim($_GET["field"]);

		$status = trim($_GET['status']);	
		$sql = $oDb->getRow("select * from tbl_shopping where Shopping_ID ='{$id}'");
		$productID = $sql['Shopping_ProductID'];
		$qty = $sql['Shopping_Quantity'];
		$buy = $oDb->getOne("select Product_Buy from tblproduct where Product_ID='{$productID}' ");
		$aData =	array(
						'Product_Buy' 	=>	$buy+$qty,
					);
		$oDb->autoExecute("tblproduct", $aData,DB_AUTOQUERY_UPDATE, "Product_ID='{$productID}'"); 
		$this -> vsDb -> updateWithPk ( $id, array ( $field => $status));		

		

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
		global $oDb;
		$form = new HTML_QuickForm('frmAdmin','post',"?mod=admin&amod={$_GET['amod']}&task=".$_GET['task']."&atask=".$_GET['atask'], '', "style=\"padding:10px 10px 0 25px\"");

		

		

		

		//$content =  editor ( 'info_cart', $arrData['info_cart'], array ("width" => "800px", "height"	=> "300px", "readonly"=>"readonly") );

		//$info =  editor ( 'tex_info', $arrData['tex_info'], array ("width" => "800px", "height"	=> "300px") );

		

		

		if( $task == "edit" )

		{

			$form->setDefaults($arrData);

		}

		

		

			

		$form -> addElement('text', 'Shopping_Code',  'Mã đơn hàng', array('size' => 20, 'maxlength' => 255,'readonly' =>'readonly') );
		$form -> addElement('text', 'Shopping_Name',  'Tên khách hàng', array('size' => 50, 'maxlength' => 255,'readonly' =>'readonly') );
		$form -> addElement('text', 'Shopping_Address',  'Địa chỉ nhận hàng', array('size' => 50, 'maxlength' => 255,'readonly' =>'readonly') );
		$form -> addElement('text', 'Shopping_Phone',  'Số điện thoại liên hệ', array('size' => 50, 'maxlength' => 255,'readonly' =>'readonly') );
	
	if($arrData["Shopping_ProductID"]){
		
			$catestmp =  $this->getOne("select Product_Deal from tblproduct where Product_ID ='".$arrData["Shopping_ProductID"]."'");
		$form -> addElement('static', NULL,  "Tên sản phẩm mua", $catestmp,array('readonly' =>'readonly'));
			
		}
	
		$form -> addElement('text', 'Shopping_Quantity',  'Số lượng mua', array('size' => 10, 'maxlength' => 255,'readonly' =>'readonly') );
		$form -> addElement('text', 'Shopping_Type',  'Cách thức thanh toán', array('size' => 20, 'maxlength' => 255,'readonly' =>'readonly') );
		$form -> addElement('text', 'Shopping_Total',  'Tổng tiền', array('size' => 10, 'maxlength' => 255,'readonly' =>'readonly') );
		if($arrData["Shopping_Create"]){
			$catestmp =  date("d/m/Y",$arrData["Shopping_Create"]);
		$form -> addElement('static', NULL,  "Ngày đặt", $catestmp,array('readonly' =>'readonly'));
			
		}
		$aray_ = array("Chua giao hang"=>"Chưa giao hàng","Da giao hang"=>"Đã giao hàng");
		$form -> addElement('checkbox', $this->_prefix.'Complete', 'Tình Trạng thanh toán');
		$form -> addElement('select', $this->_prefix.'Giaohang', "Tình trạng giao hàng",$aray_ );

		//$form -> addElement('text', 'tell',  $this->get_config_vars('phone'), array('size' => 50, 'maxlength' => 255,'readonly' =>'readonly') );

		//$form -> addElement('text', 'address',  $this->get_config_vars('address'), array('size' => 50, 'maxlength' => 455,'readonly' =>'readonly') );$form -> addElement('text', 'total',  "Tá»•ng tiá»n ", array('size' => 50, 'maxlength' => 455,'readonly' =>'readonly') );

		

		

		//$form -> addElement('static', NULL,  "",$arrData['info_cart'],array('readonly' =>'readonly') );

		//	$form -> addElement('static', NULL,  "ThÃ´ng tin thÃªm", $info,array('readonly' =>'readonly'));

		

		

		$btn_group[] = $form -> createElement( 'submit',null,$this->get_config_vars('btn_submit'),array('class'=>'button') );

		$btn_group[] = $form -> createElement( 'button',null,$this->get_config_vars('btn_back') ,array('onclick'=>'window.location.href = \''.$_COOKIE['re_dir'].'\'','class'=>'button') );
				
		$btn_group[] = $form -> createElement( 'button',null,"Xuất ra excel" ,array('onclick'=>'window.location.href = \'?mod=admin&amod=infocart&ajax=true&task=export&CODE='.$arrData[$this->_prefix.'Code'].'\'','class'=>'button') );	
			
		$btn_group[] = $form -> createElement( 'button',null,"In" ,array('onclick'=>'window.print();return false;','class'=>'button') );		

		$form->addElement( 'hidden', 'id', $arrData['Shopping_ID'] );
		$form -> addGroup($btn_group);

		


	

		
/*
	$form -> addRule( $this->_prefix.'Title',$this->get_config_vars('title').$this->get_config_vars('no_blank'),'required',null,'client' );*/

		

		if( $form -> validate())

		{

			

			$aData = array(



				$this->_prefix.'Complete' =>$_POST[$this->_prefix.'Complete'],
				$this->_prefix.'Giaohang' =>$_POST[$this->_prefix.'Giaohang']


			);
				if(isset($_POST['id']) && $_POST['id']){
				$id = $_POST['id'];
				print_r($aData);
				$oDb->autoExecute($this->table, $aData,DB_AUTOQUERY_UPDATE, "Shopping_ID='".$_POST['id']."'"); 

			//	$this->vsDb->updateWithPk($_POST['id'], $aData);

				$_SESSION['msg'] = $this->get_config_vars('msg_edit');	

			}
			//$this -> redirect($_COOKIE['re_dir']);

		}

		

		$form->display();

		

	}

	

	function saveOrder()

	{

		$arrOrder = $_GET[$this->_prefix.'Order'];

		

		foreach ( $arrOrder as $key => $value )

		

			$this -> bsgDb -> updateWithPk ( $key , array ( $this->_prefix.'Order' => $value ));		

		

		$_SESSION['msg'] = "Items have been updated at ".date("Y/m/d H:i:s");

		$this -> redirect($_COOKIE['re_dir']);	

	}

	function exportCSV($code)

	{		

		$product= $this->getRow("select *,(select Product_Deal from tblproduct where Product_ID=Shopping_ProductID) as name from tbl_shopping where 	Shopping_Code='".$code."'");
		$_STRING="";
		if($product){
			if($product["Shopping_Complete"]=='1') 
				$_STATUS='Đã thành công';
			else
				$_STATUS='Chưa thành công';

		$_STRING="
			ID:".$product["Shopping_Code"].",
			MA DON HANG,".$product["Shopping_Code"]."
			TEN KHACH HANG,".$product["Shopping_Name"]."
			DIA CHI NHAN HANG,".$product["Shopping_Address"]."
			SO DIEN THOAI,".$product["Shopping_Phone"]."
			SAN PHAM DAT MUA,".$product["name"]."
			SO LUONG,".$product["Shopping_Quantity"]."
			CACH THUC THANH TOAN,".$product["Shopping_Type"]."
			TONG TIEN,".$product["Shopping_Total"]."
			NGAY DAT,".date("d/m/Y",$product["Shopping_Create"])."(dd/mm/yy)
			TÌNH TRẠNG GIAO HÀNG,".$product["Shopping_Giaohang"]."
			TINH TRANG THANH TOAN,".$_STATUS."\n	
		";		
		}
		require 'lib/php-excel.class.php';
		
		// create a simple 2-dimensional array
		$data = array(
		1 => array ('Mã đơn hàng', $product["Shopping_Code"]),
		array('Tên khách hàng', $product["Shopping_Name"]),
		array('Địa chỉ nhận hàng', $product["Shopping_Address"]),
		array('Số điện thoại', $product["Shopping_Phone"]),
		array('Sản phẩm đặt mua', $product["name"]),
		array('Số lượng', $product["Shopping_Quantity"]),
		array('Ngày đặt(dd/mm/yy)', date("d/m/Y",$product["Shopping_Create"])),
		array('Tình trạng giao hàng', $product["Shopping_Giaohang"]),
		array('Cách thức thanh toán', $product["Shopping_Type"]),
		array('Tổng tiền', $product["Shopping_Total"]),
		array('Tình trạng thanh toán', $_STATUS)
		);
		
		// generate file (constructor parameters are optional)
		$xls = new Excel_XML('UTF-8', false, $product["Shopping_Code"]);
		$xls->addArray($data);
		$xls->generateXML($product["Shopping_Code"]);

//echo $_STRING;
	 }
	function exportCSVAll()

	{		

		require 'lib/php-excel.class.php';
		
		$arrId = $_GET['arr_check'];	
		//$data=array();
		$i=1;
		$data[0] = array("Mã đơn hàng","Tên khách hàng","Địa chỉ","Quận(huyện)","Số điện thoại","Tên sản phẩm","Số lượng","Ngày mua","Phương thức thanh toán","Tình trạng giao hàng","Tình trạng thanh toán","Đơn giá","Thành tiền");
//		$data= array(1=>array("Mã đơn hàng","Tên khách hàng","Địa chỉ","Số điện thoại","Tên sản phẩm","Số lượng","Phương thức thanh toán","Tình trạng thanh toán"));
		foreach ( $arrId as $iId ){

			$product= $this->getRow("select *,(select Product_Deal from tblproduct where Product_ID=Shopping_ProductID) as name,(select Product_DealPrice from tblproduct where Product_ID=Shopping_ProductID) as price,(select Group_Name from tblgroup where Group_ID=Shopping_City) as city from tbl_shopping where Shopping_ID='".$iId."'");
			if($product){
				if($product["Shopping_Complete"]=='1') 
					$_STATUS='Đã thành công';
				else
					$_STATUS='Chưa thành công';
	
			$data[] = array ( 
			$product["Shopping_Code"],
			$product["Shopping_Name"],
			$product["Shopping_Address"],
			$product["city"],
			$product["Shopping_Phone"],
			$product["name"],
			number_format($product["Shopping_Quantity"]),
			date("d/m/Y",$product["Shopping_Create"]),
			$product["Shopping_Type"],
			$product["Shopping_Giaohang"],
			$_STATUS,
			$product["price"],
			$product["Shopping_Total"],
			);
			
			$i++;
			}

		}

		// generate file (constructor parameters are optional)
		$filename= date("dmY",mktime()).rand();
		$xls = new Excel_XML('UTF-8', true, $filename);
		$xls->addArray($data);
		$xls->generateXML($filename);
		

//echo $_STRING;
	 }
		
	function writeFileCsv($filename,$content){

			
			$file_path = SITE_DIR."upload/shopping/".$filename;			

			$handle = fopen($file_path,'w');

			$contents = fwrite($handle, $content);	

			fclose($handle);				

	}



}

?>

