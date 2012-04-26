<?
class excel{
	var $array_data_field; //ten truong
	var $array_data_alias; //tieu de 
	var $array_data_type; //kieu du lieu
	var $array_data_width;
	var $row_height='20';
	
	var $array_name_field;
	var $array_field_show;
	var $number_of_field =-1;
	var $categoryName='';
	var $categoryClass='';
	var $content='';
	var $style='';
	var $textHeader='';
	var $linkHeader='http://vatgia.com';
	/*
	add các trường vào mãng tương ứng với cột
	data_field: tên trường trong database
	data_alias: bí danh của tên trường
	data_type: kieu du lieu  String; Number;  Formula(cong thuc)
	*/
	function addCol($data_field,$data_alias,$data_type="String"){
		$this->number_of_field++;
		//khai bao array kieu du lieu xml mac dinh la kieu string
		$this->array_data_type[$data_field] 				= $data_type; //kieu du lieu
		$this->array_name_field[$data_field] 				= pow(2,$this->number_of_field);
		$this->array_data_field[$this->number_of_field] = $data_field;
		$this->array_data_alias[$data_field] 				= $data_alias;
	}
	
	//
	function addRow($listRow=array(),$cellClass='text',$row_height=20,$arrayColspan=array())
	{
		$height = 'ss:Height="' . $row_height .'" ';
		$this->content .=chr(13) . chr(9) . '<ss:Row ss:AutoFitHeight="1" ' . $height . ' >';
		for($i=0;$i<count($listRow);$i++){
			$type='String';
			$colspan = '';
			if(isset($arrayColspan[$i])) $colspan = 'ss:MergeAcross="' . intval($arrayColspan[$i]) . '"';
			$this->content .=chr(13) . chr(9) . chr(9) .'<ss:Cell ss:StyleID="' . $cellClass . '" ' . $colspan . '><ss:Data ss:Type="' . $type . '" xmlns="http://www.w3.org/TR/REC-html40">' . $listRow[$i] . '</ss:Data></ss:Cell>'; 
			unset($type);
			unset($colspan);
		}
		$this->content .=chr(13) . chr(9) . '</ss:Row>';
	}
	
	// phần header của file excel
	function getHeader(){
		$this->content .= '<?xml version="1.0"?>
									<ss:Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
									 xmlns:o="urn:schemas-microsoft-com:office:office"
									 xmlns:x="urn:schemas-microsoft-com:office:excel"
									 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
									 xmlns:html="http://www.w3.org/TR/REC-html40">
									 <ss:DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
									  <ss:Version>11.5606</Version>
									 </DocumentProperties>
									 <ss:ExcelWorkbook xmlns="urn:schemas-microsoft-com:office:excel">
									  <ss:WindowHeight>10005</WindowHeight>
									  <ss:WindowWidth>10005</WindowWidth>
									  <ss:WindowTopX>120</WindowTopX>
									  <ss:WindowTopY>135</WindowTopY>
									  <ss:HidePivotTableFieldList/>
									  <ss:ProtectStructure>False</ProtectStructure>
									  <ss:ProtectWindows>False</ProtectWindows>
									 </ss:ExcelWorkbook>
										 <ss:Styles>
											  <Style ss:ID="title">
												<Alignment  ss:Horizontal="Center" ss:Vertical="Center"/>
												<Borders>
												 <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												 <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												 <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												 <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												</Borders>
												<Font ss:Color="#FFFFFF" ss:Bold="1"/>
												<Interior ss:Color="#3F925A" ss:Pattern="Solid"/>
											  </Style>
											  <Style ss:ID="text">
												<Alignment ss:Vertical="Center" ss:WrapText="1"/>
												<Borders>
												 <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												 <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												 <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												 <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1" ss:Color="#993366"/>
												</Borders>
												<Font ss:Color="#000000"  ss:Size="10" ss:Family="Tahoma"/>
											  </Style>
											  <Style ss:ID="s34">
												<Alignment ss:Horizontal="Center" ss:Vertical="Center" ss:WrapText="1"/>
												<Font ss:FontName="Verdana" x:Family="Swiss" ss:Size="18" ss:Color="#0000FF"
												 ss:Bold="1"/>
											  </Style>
											  ' . $this->style . '
										 </ss:Styles>
													';
	}
	
	
	//kết thúc nội dung file excel
	function close()
	{
		$this->content .='</ss:Workbook>';
		return $this->content;
	}
	
	//add Worksheet
	function addWorksheet($sheetName,$colum=array())
	{
		$this->content .='<ss:Worksheet ss:Name="' . $sheetName . '"><ss:Table>';
		for($i=0;$i<count($colum);$i++){
			$this->content .=chr(13) .'<ss:Column ss:Width="' . $colum[$i]  . '"/>';
		}
		if($this->textHeader!=''){
		$this->content .='
								<Row ss:AutoFitHeight="1" ss:Height="10">
								 <Cell ss:MergeAcross="' . (count($colum)-1) . '" ss:StyleID="s34"><ss:Data ss:Type="String"
									xmlns="http://www.w3.org/TR/REC-html40"> </ss:Data></Cell>
								</Row>
								<Row ss:AutoFitHeight="1" ss:Height="96.75">
								 <Cell ss:MergeAcross="' . (count($colum)-1) . '" ss:StyleID="s34" ss:HRef="' . $this->linkHeader . '"><ss:Data ss:Type="String"
									xmlns="http://www.w3.org/TR/REC-html40">' . $this->textHeader . '</ss:Data></Cell>
								</Row>
							';
		}
	}
	
	//close Worksheet
	function closeWorksheet()
	{
		$this->content .='</ss:Table>
								<ss:WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
								<ss:ProtectObjects>False</ProtectObjects>
								<ss:ProtectScenarios>False</ProtectScenarios>
							  </ss:WorksheetOptions>
							 </ss:Worksheet>';
	}

	// function download
	function download($filename)
	{
	  header("Content-type: application/xls");
	  header("Content-Disposition: attachment; filename=$filename.xls");
	  header("Pragma: no-cache");
	  header("Expires: 0");
	  print $this->content;
	}


	function save_file($filename)
	{
		 $contents = $this->content;
		 #if file exist -> open -> get number for var -> var++ -> write back -> close file
		 #if file !exist -> create -> set var = 0 -> write back -> close file
		 if(is_file($filename))
		 {
			  $fd = fopen($filename, "r"); 
			  if($fd)
			  {
					fclose ($fd); 
			  
					$contents++; 
			  
					$fp = fopen ($filename, "w"); 
					if($fp)
					{
						 fwrite ($fp,$contents); 
						 fclose ($fp); 
					}
					return $contents;
			  }
		 }else{
			  $fp = fopen ($filename, "w"); 
			  if($fp)
			  {
					fwrite ($fp,$contents); 
					fclose ($fp); 
			  }
			  return $contents;
		 }
		return save_file($filename,$contents);
	}

	/*
	list_table: danh sách các bảng
	require_where: câu lệnh where đi kèm
	list_order: sắp xếp
	intShow: điều kiện lựa chon (binary)
	*/
	function getContent($list_table,$require_where,$list_order){
		$i=-1;
		//dua ra tat ca cac truong 
		foreach($this->array_name_field as $key=>$value){
				$i++;
				$this->array_field_show[$i]	 =	$key;
				$this->list_field					.=	$key . ',';	
		}
			
		$this->list_field					.=	substr($this->list_field,0,strlen($this->list_field)-1);	
		if($this->categoryName!='')	$this->list_field .= "," . $this->categoryName;
	
	
		//dua ra phan title
		$this->content	.=chr(13) . '<ss:Row ss:Height="25">';
		//kiểm tra và dưa ra dữ liệu
		foreach($this->array_field_show as $key=>$value){
			if(isset($this->array_data_alias[$value])) $this->content	.=chr(13) . chr(9) . '<ss:Cell   ss:StyleID="title"><ss:Data ss:Type="String">' . htmlspecialchars($this->array_data_alias[$value]) . '</ss:Data></ss:Cell>';
		}
		$this->content	.=chr(13) . '</ss:Row>';
				
		//đưa ra dữ liệu bảng
		$db_data			=new db_query("SELECT " . $this->list_field . "
												FROM " . $list_table . "
												WHERE " . $require_where . "
												ORDER BY " . $list_order . "
							 					");	
												
		//hiện thị nội dung các trường
		while($row=mysql_fetch_array($db_data->result)){
		
			$this->content	.=chr(13) . '<ss:Row ss:Height="' . $this->row_height .'">';
				//kiểm tra và dưa ra dữ liệu
				foreach($this->array_field_show as $key=>$value){
					if(isset($row[$value])) $this->content	.=chr(13) . chr(9) . '<ss:Cell ss:StyleID="text"><ss:Data ss:Type="' . $this->array_data_type[$value] . '">' . htmlspecialchars($row[$value]) . '</ss:Data></ss:Cell>';
				}
			$this->content	.=chr(13) . '</ss:Row>';
		}//end while
		
	}
	
}
?>
