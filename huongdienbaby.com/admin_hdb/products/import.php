<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("edit");
//Khai bao Bien

require_once("../../classes/database.php");
require_once("../../classes/Excel/import.php");
require_once("../../functions/functions.php");
$action 		= getValue("action","int","POST");
$arrayFeld		= array(1=>array("pro_id",1)
						   ,2=>array("pro_name",0)
						   ,3=>array("pro_price",3)
						   //,4=>array("pro_warranty",0)
						   ,4=>array("pro_stock",1)
						   //,6=>array("pro_promotion",1)
						   //,7=>array("pro_clear",1)
						  );
$arrayFeldSubmit 	= array();
$excel_default 		= '';
//print_r($arrayFeldSubmit);
if($action != 0){
	foreach($arrayFeld as $key=>$value){
		$poskey = getValue("feldname_" . $key,"int","POST");
		if($poskey!=0){
			$arrayFeldSubmit[$poskey] = $arrayFeld[$poskey];
		}
	}
	unset($arrayFeldSubmit[2]);
	$myexcel = new importExcel("excel",$arrayFeldSubmit);
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo "<script language='javascript'>alert('Bạn đã cập nhật giá thành công')</script>";;
	redirect($_SERVER['REQUEST_URI']);
}
?>
<? /*---------Body------------*/ ?>
	<form ACTION="<?=$_SERVER['REQUEST_URI']?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
		<input type="hidden" name="action" value="1" />
		<br>
		<div align="center" style="padding:10px;" class="textBold">Tương ứng với file Excel upload</div>
		<div align="center" style="padding:10px;" class="textBold">Chọn file Excel: <input type="file" name="excel">
		<input type="submit" value="Import Excel"></div>
	</form>
	<form action="export.php" method="post">
		<strong>Chọn danh mục để export ra Excel: </strong>
					<select name="iCat" id="iCat">
						<option value="">--[Tất cả]--</option>
						<?
						for($i=0;$i<count($listAll);$i++){
						?>
							<option value="<?=$listAll[$i]["cat_id"]?>">
							<?
							for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
								echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
							?>
							</option>
						<?
						}
						?>
					</select>
			<input type="submit" value="Download file Excel">
	</form>
	<hr color="#FF0000">
<? /*------------------------------------------------------------------------------------------------*/ ?>
