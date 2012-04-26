<? //dinhtoan1905
	ob_start();
	$lang_id 	= 1;
	$excelName	= "sua_gia.xls";
	require_once("../../functions/translate.php");
	require_once("../../functions/functions.php");
	require_once("../../functions/file_functions.php");
	require_once("../../functions/template.php");
	require_once("../../classes/database.php");
	require_once("../../classes/menu.php");
	
	$menuid 		= new menu();
	$menuid->getArray("categories_multi","cat_id","cat_parent_id"," cat_type='product' AND lang_id = " . $lang_id);
	$iCat	= getValue("iCat","int","POST");
	$listiCat		=  $menuid->getAllChildId($iCat);
	$sql = '';
	if($iCat!=0){
		$sql = ' AND cat_id IN(' . $listiCat . ')';
	}
	$array_currency = array(0=>"VNĐ",1=>"USD");	
	$arrayKho 	= 	array(-2=>translate_text("San_pham_chi_de_tham_khao")
						  ,-1=>translate_text("Sap_co_hang")
						  ,0=>translate_text("Het_hang")
						  ,1=>translate_text("Co_hang")
						  );
	
	//array chứa các trường đưa ra
	$arrayField 	= array(
							"pro_id"			=>array("Mã sản phẩm","{}",0)
							,"pro_name"			=>array("Tên sản phẩm","{}",0)
							,"pro_price"		=>array("Giá sản phẩm","{}",0)
							,"pro_stock"		=>array("Kho hàng","{}",0)
							//,"pro_code"		=>array("Model","{}",0)
							);
							

	//lenh query dua ra san pham
	$field = $arrayField;
	$db_product 	= new db_query("SELECT * 
									FROM products
									INNER JOIN categories_multi ON(cat_id = pro_category)
									WHERE products.lang_id = " . $lang_id . " " . $sql . "
									ORDER BY products.lang_id ASC,cat_id ASC");
	
	$db_supplier = new db_query("SELECT sup_id,sup_name
								 FROM supplier
								 ORDER BY sup_id");
	$total_row = mysql_num_rows($db_supplier->result);								

	require_once("../../classes/exportExcel.php");
	//gọi class excel
	$myExcel		=	new excel();
	//thêm style cho file excel
	$myExcel->style	=	'
						  <Style ss:ID="category">
								<Alignment  ss:Horizontal="Left" ss:Vertical="Center"/>
								<Borders>
								 <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
								 <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
								 <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
								 <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
								</Borders>
								<Font ss:Color="#000000" ss:Bold="1"/>
								<Interior ss:Color="#FFFF99" ss:Pattern="Solid"/>
						  </Style>
						  <Style ss:ID="header">
							<Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
							<Borders>
							 <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"
							  ss:Color="#993366"/>
							 <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"
							  ss:Color="#993366"/>
							 <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"
							  ss:Color="#993366"/>
							 <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"
							  ss:Color="#993366"/>
							</Borders>
							<Font x:Family="Swiss" ss:Size="18" ss:Bold="1"/>
							<Interior/>
							<NumberFormat/>
							<Protection/>
						  </Style>
	';
	//phan header
	$myExcel->getHeader();
	/*
	1 : sheet name
	2 : array gom cac phan tu chieu rong cua cot
	*/
	$arrayColum		=	array(130,280,60,40,150);
	//tạo sheet 1
	$myExcel->addWorksheet("Báo giá",$arrayColum);
	
	//phan header
	$arrayRecord		= array();
	$arrayRecord[0] 	= 'Cập nhật giá';
	$arrayColspan[0] 	= count($field)-1;
	//add to excel
	$myExcel->addRow($arrayRecord,"header",60,$arrayColspan);
	
	//phan title
	$arrayRecord=array();
	foreach($field as $key=>$value){
		$arrayRecord[] = isset($arrayField[$key]) ? $arrayField[$key][0] : '';
	}
	//add to excel
	$myExcel->addRow($arrayRecord,"title",25);
	
	//add tổng số người tham gia
	@mysql_data_seek($db_product->result,0);
	$cat_id=-1;
	while($row=mysql_fetch_array($db_product->result)){
		$arrayRecord	= array();
		$arrayColspan 	= array();
		if($cat_id!=$row["cat_id"]){	
			$cat_id = $row["cat_id"];
			$arrayRecord[0] 	= htmlspecialchars($row["cat_name"]);
			$arrayColspan[0] 	= count($field)-1;
			//add to excel
			$myExcel->addRow($arrayRecord,"category",20,$arrayColspan);
			
		}
		
		
		$arrayRecord = array();
		foreach($field as $key=>$value){
			$datavalue 		=	isset($row[$key]) ? $row[$key] : '';
			switch($key){
				default:
					$datavalue =	isset($row[$key]) ? $row[$key] : '';
				break;
			}
			$arrayRecord[] 	= 	$datavalue;
		}
		//add to excel
		$myExcel->addRow($arrayRecord,"text",20);

	}
	//close sheet 1
	$myExcel->closeWorksheet();
	//close Workbook
	$myExcel->close();
	//start download
	$myExcel->download($excelName);
	//$myExcel->save_file("../baogia/" . $excelName ."");
?>