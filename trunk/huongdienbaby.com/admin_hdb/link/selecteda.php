<?
session_start();
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
require_once("../../functions/date_function.php");

$module		= "";
$object		= getValue("object", "str", "GET", "");
$iCha			= getValue("iCha", "int");
$iCat			= getValue("iCat", "int");
$iDat			= getValue("iDat", "int");
$source		= getValue("source", "str");
$action		= getValue("action", "str");
//Create link
if($action == "create"){
	$link = "";
	exit();
}

$sql_data = "";
$cat_type=strtolower(getValue("cat_type","str","GET","product",1));
switch($cat_type){
	case "news":
		$sql_data = "SELECT new_id AS dat_id, new_title AS dat_title, new_date AS dat_date,cat_type,cat_id,cat_name
					 FROM categories_multi, news
					 WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = new_category  AND cat_id = " . $iCat . "
					 ORDER BY new_date DESC, new_id DESC";
		$data_type = "iNew";
		break;
	case "product":
		$sql_data = "SELECT pro_id AS dat_id, pro_name AS dat_title, pro_date AS dat_date,cat_type,cat_id,cat_name
					 FROM categories_multi, products
					 WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . "  AND cat_id = pro_category AND cat_id = " . $iCat . "
					 ORDER BY pro_date DESC, pro_id DESC";
		$data_type = "iPro";
		break;
	case "static":
		$sql_data = "SELECT sta_id AS dat_id, sta_title AS dat_title, sta_date AS dat_date,cat_type,cat_id,cat_name
					 FROM categories_multi, statics
					 WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = sta_category AND cat_id = " . $iCat . "
					 ORDER BY sta_date DESC, sta_id DESC";
		$data_type = "iSta";
		break;
	default:
		$sql_data = "SELECT sta_id AS dat_id, sta_title AS dat_title, sta_date AS dat_date,cat_type,cat_id,cat_name
						 FROM categories_multi, statics
						 WHERE categories_multi.lang_id = " . $_SESSION["lang_id"] . " AND cat_id = sta_category AND cat_id = " . $iCat . "
						 ORDER BY sta_date DESC, sta_id DESC";
		$data_type = "iSta";
		break;
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body bgcolor="#F2F2F2">
<link href="../css/FSportal.css" rel="stylesheet" type="text/css">
<script language="javascript">
	function change(){
		create_link.action.value = "";
		create_link.submit();
	}
	function check_form(source, title){
		frm = create_link;
		if(source.value == 0){alert("You must select source data !");
			source.focus();
			return;
		}
		if(title == "Create link to channel"){
			window.opener.document.getElementById("<?=$object?>").value = document.all.link_channel.value;
			window.close();
		}
		if(title == "Create link to category"){
			window.opener.document.getElementById("<?=$object?>").value = document.all.link_category.value;
			window.close();
		}
		if(title == "Create link to data"){
			window.opener.document.getElementById("<?=$object?>").value = document.all.link_data.value;
			window.close();
		}
	}
	/*
	function check_form(source,value){
		frm = create_link;
		if(source.value == 0){
			alert("You must select source data !");
			source.focus();
			return;
		}
		if(value == "Create link to category"){
			window.returnValue = document.all.link_category.value;
			window.close();
		}
		if(value == "Create link to data"){
			window.returnValue = document.all.link_data.value;
			window.close();
		}
	}
	*/
	function change_data(){
		if(create_link.iDat.value == 0){
			document.all.link_data.value = "";
		}
		else{
			document.all.link_data.value = "/<?=$_SESSION["lang_path"]?>/detail.php?module=<?=$module?>&iCat=<?=$iCat?>&<?=$data_type?>=" + create_link.iDat.value;
		}
	}
</script>
<center>
<p class="textBold" style="font-size:14px; color:#660066">CREATE LINK</p>
<table cellpadding="3" cellspacing="3">
<?
$iCat=getValue("iCat");
$db_channel = new db_query("SELECT cat_type,cat_name,cat_id
							FROM categories_multi
							WHERE cat_active = 1 AND cat_id=" . $iCat . "
							ORDER BY cat_type ASC, cat_order ASC, cat_name ASC");
$linkcategory='';
if($row=mysql_fetch_array($db_channel->result)){
	$linkcategory="/" . $_SESSION["lang_path"] . "/" . strtolower($row["cat_type"]) . "/" . urlencode(preg_replace("|[ -']|Ui","_",RemoveSign($row["cat_name"]))) . "-" . $row["cat_id"] . ".html";
}							
$mod = "";
?>
<form name="create_link" action="selected.php" method="get" target="_self">
	<tr>
		<td class="textBold" align="right">Trang lẻ</td>
		<td>
			<select name="iCha" class="form" onChange="document.all.link_channel.value=this.value">
				<option value="0">--[Chọn trangl]--</option>
				<option value="/<?=$_SESSION["lang_path"]?>/">Trang chủ</option>
				<option value="/<?=$_SESSION["lang_path"]?>/contact.php">Liên hệ</option>
				<option value="/<?=$_SESSION["lang_path"]?>/showcart.php">Giỏ hàng</option>
				<option value="/<?=$_SESSION["lang_path"]?>/uniform">Uniform</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="textBold" align="right">Đường dẫn</td>
		<td><input disabled="disabled" value="" class="form" type="text" size="70" id="link_channel" name="link_channel" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input onClick="check_form(create_link.iCha,this.value)" style="width:150px" type="button" class="form" value="Create link to channel" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><hr size="1" width="100%" /></td>
	</tr>
<?
require_once("../../classes/menu.php");
$array_value = array("STATIC"=>"TRANG TĨNH"
							,"PRODUCT"=>"SẢN PHẨM"
							,"UNIFORM"=>"UNIFORM"
							,"NEWS"=>"TIN TỨC"
							);
$cat_type=getValue("cat_type","str","GET","PRODUCT",1);							
$menu = new menu();
$listAll = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0","cat_type='" . strtolower($cat_type) . "' AND lang_id = " . $_SESSION["lang_id"],"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_type ASC,cat_order ASC, cat_name ASC","cat_has_child");
$cat_id = 0;
?>
	<tr>
		<td class="textBold" align="right">TYPE</td>
		<td>
				<select name="cat_type" class="form" onChange="change()">
					<?
					foreach($array_value as $key => $value){
					?>
					<option class="form" value="<?=$key?>" <? if($key == $cat_type) echo "selected='selected'";?>><?=$value?></option>
					<? } ?>
				</select>
		</td>
	</tr>
	<tr>
		<td class="textBold" align="right">CATEGORY</td>
		<td>
			<select name="iCat" class="form" onChange="change()">
					<option value="0">--[select category]--</option>
					<?
					$iCat = getValue("iCat","int","GET",0);
					for($i=0;$i<count($listAll);$i++){
					?>
						<option value="<?=$listAll[$i]["cat_id"]?>" <? if($iCat==$listAll[$i]["cat_id"]) echo "selected";?>>
						<?
						for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
							echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
						?>
						</option>
					<?
					}
					?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="textBold" align="right">LINK TO CATEGORY</td>
		<td><input disabled="disabled" value="<?=$linkcategory?>" class="form" type="text" size="70" name="link_category" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input onClick="check_form(create_link.iCat,this.value)" style="width:150px" type="button" class="form" value="Create link to category" /></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><hr size="1" width="100%" /></td>
	</tr>
<?
$db_data = new db_query($sql_data);
?>
	<tr>
		<td class="textBold" align="right">DATA</td>
		<td>
			<select name="iDat" class="form" onChange="document.all.link_data.value=this.value">
				<option value="0">--[Select one data]--</option>
				<?
				while($data = mysql_fetch_array($db_data->result)){
					echo "<option value='/" . $_SESSION["lang_path"] .  "/" . strtolower($data["cat_type"]) . "/" . urlencode(preg_replace("|[ -']|Ui","_",RemoveSign($data["cat_name"]))) . "/" . $data["cat_id"] . "/" . $data["dat_id"] . "'>" . $data["dat_title"] . "</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="textBold" align="right">LINK TO DATA</td>
		<td><input disabled="disabled" class="form" type="text" size="70" id="link_data" name="link_data" /></td>
	</tr>
	<tr>
		<td></td>
		<td><input onClick="check_form(create_link.iDat,this.value)" style="width:150px" type="button" class="form" value="Create link to data" /></td>
	</tr>
	<input type="hidden" name="object" value="<?=$object?>" />
	<input type="hidden" name="action" value="create" />
</form>
</table>
</center>
<?
unset($db_category);
$db_channel->close();
unset($db_channel);
?>
</body>
<script language="javascript">self.moveTo((screen.width-document.body.clientWidth)/2, (screen.height-document.body.clientHeight)/2);</script>