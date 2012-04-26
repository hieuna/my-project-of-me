<?
//khai báo và cấu hình bảng báo giá list cách nhau bởi dấu phẩy

$list_field			="pro_name,pro_teaser,pro_price,pro_warranty,pro_stock";//các trường đưa ra

$arrayFieldvalue	=	array("pro_name"=>1,"pro_khuyenmai"=>64,"pro_teaser"=>2,"pro_price"=>4,"pro_warranty"=>8,"pro_stock"=>16);

$arrayNote			=	array("pro_name"=>"Tên sản phẩm","pro_teaser"=>"Tóm tắt","pro_price"=>"Giá (VND)","pro_warranty"=>"Bảo hành","pro_stock"=>"Kho hàng","pro_khuyenmai"=>"Khuyến mại");//tên trường tương ứng
$arrayStock			=	array(1=>"Yes",2=>"yes",3=>"Order",4=>"call");

//mãng cấu hình cho trường tương ứng
$list_style			= "width=200,width=500 align=justify,width=100 align=center,width=100 align=center,width=100 align=center";

$arrayStyle			= split(",",$list_style);
$arrayField			= split(",",$list_field);
$arrayTemp			= array();
foreach($arrayFieldvalue as $key=>$value){
	if(($value & $listField) !=0) $arrayTemp[]=$key;
}

$arrayField=$arrayTemp;

$sql					='';
$listid			= getValue("listid","arr","POST","");
$listicat			= "";
if(isset($listid[0])){
	for($i=0;$i<count($listid);$i++){
		if(isset($listid[$i]) && intval($listid[$i])!=0){
			$listicat	.=	intval($listid[$i]) . ",";
		}
	}
}
$listicat .= "0";
$sql	= " AND cat_id IN(" . $listicat . ")";
//end get page break params
$db_product=new db_query("SELECT " . $list_field . ",cat_name,cat_id
										FROM products
										INNER JOIN categories_multi ON (pro_category=cat_id)
										WHERE cat_active=1  AND pro_active=1 " . $sql . "
										ORDER BY  cat_id ASC,pro_price ASC,cat_id ASC,pro_name ASC
										");
$total_num_page=mysql_num_rows($db_product->result);
	$action=getValue("action","str","POST","");
	$stt=0;
	$excelName = "Bao_gia_Quangtuan" . date("-H_i_s_d_m_y") . ".xls";
?>
<?
//get realpath
$realpath = realpath(".");
$timecache	=	600;
//search all file
foreach (glob("../baogia/*.*") as $filename) {
	if((time() - fileatime($filename))>$timecache){
		@unlink($filename);
	}
}
?>
<?
if($action=="view"){
?>
<div align="center" style="padding:5px"><input type="button" value="Download file excel" class="button_poll" onclick="window.location.href='<?="../baogia/" . $excelName .""?>'" /></div>
<table cellpadding="3" cellspacing="0" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC" border="1">
	<tbody>
	<tr>
		<td>&nbsp;</td>
	<? for($i=0;$i<count($arrayField);$i++){?>
		<td align="center" bgcolor="#F4F4F4" class="textBold"><?=chr(65+$i)?></td>
	<? }?>
	</tr>
	<tr>
		<? $stt++;?>
		<td bgcolor="#F4F4F4" align="center" width="20" class="textBold"><?=$stt?></td>
		<? 
		for($i=0;$i<count($arrayField);$i++){?>
		<td align="center" bgcolor="#CCFFCC" class="textBold"><? if(isset($arrayNote[$arrayField[$i]])) echo $arrayNote[$arrayField[$i]];?></td>
		<? 
		}
		?>
	</tr>
	<?
	$id=0;
	$cat_id=-1;
	while($row=mysql_fetch_array($db_product->result)){

	$stt++;
	$id++;
		if($cat_id!=$row["cat_id"]){	
		$cat_id=$row["cat_id"];
		?>
			<tr bgcolor="#FFFF99">
				<td bgcolor="#F4F4F4" align="center" width="20" class="textBold"><?=$stt?></td>
				<td colspan="<?=count($arrayField)?>" class="textBold"><?=$row["cat_name"]?></td>
			</tr>
		<?
		}
	?>
		<tr>
			<td bgcolor="#F4F4F4" align="center" width="20" class="textBold"><?=$stt?></td>
		<? for($i=0;$i<count($arrayField);$i++){?>
			<td class="text" <? if(isset($arrayStyle[$i])) echo $arrayStyle[$i];?> onClick="changetro('td_<?=$id?>_<?=$i?>'); this.className='troexcel'" id="td_<?=$id?>_<?=$i?>" style="cursor:crosshair">
				<? 
				if($arrayField[$i]=="pro_stock"){
					if(isset($arrayStock[$row[$arrayField[$i]]])) echo $arrayStock[$row[$arrayField[$i]]];
				}else{
					if($arrayField[$i]=="pro_price"){
						echo '<font color="#FF0000">' . formatNumber(doubleval($row[$arrayField[$i]])*doubleval($con_exchange)) . '</font> VNĐ';	
					}else{
						if(isset($row[$arrayField[$i]])) echo str_replace(chr(13)," ",$row[$arrayField[$i]]);
					}	
				}
				?>
			</td>
		<? }?>
		</tr>
	<?
	}
	?>
	</tbody>
</table>
<?
}
?>
<?
if($listid !=""){
	require_once("../classes/exportExcel.php");
	//gọi class excel
	$myExcel=new excel();
	//thêm style cho file excel
	$myExcel->style='
						  <Style ss:ID="category">
								<Alignment  ss:Horizontal="Center" ss:Vertical="Center"/>
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
							<Font ss:Bold="1"/>
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
	$arrayColum=array(150,300,50,50);
	//tạo sheet 1
	$myExcel->addWorksheet("Báo giá Quang tuân",$arrayColum);
	
	//phan header
	$arrayRecord=array();
	$arrayRecord[0] 	= '';
	$arrayColspan[0] 	= count($arrayField)-1;
	//add to excel
	$myExcel->addRow($arrayRecord,"header",120,$arrayColspan);
	
	//phan title
	$arrayRecord=array();
	for($i=0;$i<count($arrayField);$i++){
		if(isset($arrayNote[$arrayField[$i]])) $arrayRecord[$i] = $arrayNote[$arrayField[$i]];
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
			$arrayColspan[0] 	= count($arrayField)-1;
			//add to excel
			$myExcel->addRow($arrayRecord,"category",20,$arrayColspan);
			
		}
		
		
		$arrayRecord = array();
		for($i=0;$i<count($arrayField);$i++){
			if($arrayField[$i]=="pro_stock"){
				if(isset($arrayStock[$row[$arrayField[$i]]])) $arrayRecord[$i] = $arrayStock[$row[$arrayField[$i]]];
			}else{
				if(isset($row[$arrayField[$i]])) $arrayRecord[$i] = str_replace(chr(13)," ",$row[$arrayField[$i]]);
			}
		}
		//add to excel
		$myExcel->addRow($arrayRecord,"text",70);

	}
	//close sheet 1
	$myExcel->closeWorksheet();
	//close Workbook
	$myExcel->close();
	//start download
	$myExcel->save_file("../baogia/" . $excelName ."");
}
?>