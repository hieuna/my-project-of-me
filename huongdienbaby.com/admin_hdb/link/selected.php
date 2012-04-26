<?
include("inc_security.php");
$class_menu	= new menu();
$menu->show_count = 1; //tính count sản phẩm
$listAll		= $class_menu->getAllChild("categories_multi", "cat_id", "cat_parent_id", 0, "lang_id = " . $lang_id, "cat_id,cat_name,cat_type", "cat_type ASC,cat_order ASC,cat_name ASC", "cat_has_child", 0);
unset($class_menu);

$fs_title	= "Tạo link";
$fs_action	= getURL();

// Object sẽ nhận link trả về khi create
$object		= getValue("object", "str", "GET", "");
$iCat			= getValue("iCat");

// Xác định module khi user đã chọn category
$db_module	= new db_query("SELECT cat_type FROM categories_multi WHERE cat_id = " . $iCat . " AND lang_id = " . $lang_id);
$module		= ($row = mysql_fetch_array($db_module->result)) ? $row["cat_type"] : "";
$db_module->close();
unset($db_module);

// Generate query string to data
//$array_data["download"]	= array("downloads_multi", "dow_id", "dow_category_id", "dow_name", "dow_date", "iDow");
//$array_data["gallery"]	= array("galleries_multi", "gal_id", "gal_category_id", "gal_name", "gal_date", "iGal");
$array_data["news"]		= array("news", "new_id", "new_category", "new_title", "new_date", "iData");
//$array_data["product"]	= array("products_multi", "pro_id", "pro_category_id", "pro_name", "pro_date", "iPro");
$array_data["static"]	= array("statics", "sta_id", "sta_category", "sta_title", "sta_date", "iData");
$array_data["product"]	= array("products", "pro_id", "pro_category", "pro_name", "pro_date", "iData");
foreach($array_data as $key => $value){
	
	if($module == $key){
		$sql_count	= "SELECT COUNT(*) AS count
							FROM categories_multi, " . $value[0] . "
							WHERE cat_id = " . $value[2] . " AND cat_type = '" . $key . "' AND cat_id = " . $iCat;
		$sql_data	= "SELECT " . $value[1] . " AS dat_id, " . $value[3] . " AS dat_title, " . $value[4] . " AS dat_date
							FROM categories_multi, " . $value[0] . "
							WHERE cat_id = " . $value[2] . " AND cat_type = '" . $key . "' AND cat_id = " . $iCat;
		$data_type	= $value[5];
		$arrayData	= array(0 => $value[1], 1 => $value[3], 2 => $value[4]);
		break;
	}
	
}
?>
<html>
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css" media="all">@import "<?=$fs_stype_css?>";</style>
</head>
<body>
<?=template_top($fs_title . ' <a title="Đóng cửa sổ" href="javascript:window.close()"><img align="absmiddle" border="0" hspace="5" src="' . $fs_imagepath . 'close.gif" />Đóng</a>',0)?>
<?
//---------------------------- Create link to Category -----------------------------------
$db_category = new db_query("SELECT cat_name FROM categories_multi WHERE cat_id = " . $iCat);
$row=mysql_fetch_array($db_category->result);
$link_category	= ($iCat == 0) ? "" : createLink("type",array('module'=>strtolower($module),"title"=>$row["cat_name"],"iCat"=>$iCat),$fs_preview,$con_extenstion,$con_mod_rewrite);

$form = new form();
$form->create_form("create_link", $fs_action, "get", "multipart/form-data");
$form->create_table();
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<tr>
	<td class="form_name">Trang chính</td>
	<td>
		<select class="form" onChange="change_file(this.value)">
			<option value="">Chọn trang</option>
			<option value="index.php">Trang chủ</option>
			<option value="contact.php">Liên hệ</option>
			<option value="baogia.php">Báo giá</option>
			<option value="khuyenmai.php">Khuyến mại</option>
			<option value="type.php?module=news">Tin tức</option>
		</select>
	</td>
</tr>
<tr>
	<td class="form_name"><font class="form_asterisk">* </font>Category :</td>
	<td class="form_text">
		<select class="form" id="iCat" name="iCat" onChange="change_category()">
			<option value="0">--[Chọn category]--</option>
		<?
		$cat_type = "";
		for($i=0; $i<count($listAll); $i++){
		?>
			<?
			if($cat_type != $listAll[$i]["cat_type"]){
				$cat_type = $listAll[$i]["cat_type"];
			?>
				<optgroup label="<?=ucwords($listAll[$i]["cat_type"])?>"></optgroup>
			<?
			}
			?>
			<option value="<?=$listAll[$i]["cat_id"]?>"<? if($listAll[$i]["cat_id"] == $iCat) echo ' selected="selected"';?>> &nbsp; |-- <?=$listAll[$i]["cat_name"]?> <?=$listAll[$i]["count"];?></option>
		<?
		}
		?>
		</select>
	</td>
</tr>
<?=$form->text("Link tới category", "link_category", "link_category", $link_category, "Link tới category", 0, 250, "", 1000, "", 'disabled="disabled"', "")?>
<?=$form->button("button", "create_link_category", "create_link_category", "Tạo link", "Tạo link tới category", '" onClick="link_to_category()"', "");?>
<?=$form->hidden("object", "object", $object, "");?>
<?
$form->close_table();
$form->close_form();
unset($form);

//---------------------------- Create link to data -----------------------------------
if(isset($arrayData)){
	//Search data
	$id			= getValue("id");
	$keyword		= getValue("keyword", "str", "GET", "", 1);
	$sqlWhere	= "";
	//Tìm theo ID
	if($id > 0)			$sqlWhere .= " AND " . $arrayData[0] . " = " . $id . " ";
	//Tìm theo keyword
	if($keyword != "")$sqlWhere .= " AND (" . $arrayData[1] . " LIKE '%" . $keyword . "%') ";
	
	//Sort data
	$sort	= getValue("sort");
	switch($sort){
		case 1: $sqlOrderBy = $arrayData[0] . " ASC"; break;
		case 2: $sqlOrderBy = $arrayData[0] . " DESC"; break;
		case 3: $sqlOrderBy = $arrayData[1] . " ASC"; break;
		case 4: $sqlOrderBy = $arrayData[1] . " DESC"; break;
		case 5: $sqlOrderBy = $arrayData[2] . " ASC"; break;
		case 6: $sqlOrderBy = $arrayData[2] . " DESC"; break;
		default:$sqlOrderBy = $arrayData[0] . " DESC"; break;
	}
	
	//Get page break params
	$page_size		= 5;
	$page_prefix	= "Trang: ";
	$normal_class	= "page";
	$selected_class= "page_current";
	$previous		= "<";
	$next				= ">";
	$first			= "<<";
	$last				= ">>";
	$break_type		= 1;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
	$url				= getURL(0,0,1,1,"page");
	$db_count		= new db_query($sql_count . $sqlWhere);
	$listing_count	= mysql_fetch_array($db_count->result);
	$total_record	= $listing_count["count"];
	$current_page	= getValue("page", "int", "GET", 1);
	if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
	else $num_of_page = (int)($total_record / $page_size) + 1;
	if($current_page > $num_of_page) $current_page = $num_of_page;
	if($current_page < 1) $current_page = 1;
	$db_count->close();
	unset($db_count);
	//End get page break params
	$db_listing	= new db_query($sql_data . $sqlWhere . " ORDER BY " . $sqlOrderBy . " LIMIT " . ($current_page - 1) * $page_size . ", " . $page_size);
?>
	<? //Page break and search data?>
	<table width="98%" cellpadding="2" cellspacing="2">
		<tr>
		<?	if($total_record > $page_size){?>
			<td nowrap="nowrap" class="textBold"><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
		<? }?>
			<td align="right">
				<table cellpadding="0" cellspacing="0">
				<form name="search" action="<?=getURL(0,0,1,0)?>" method="get">
					<tr>
						<td class="textBold" nowrap="nowrap">
							ID:
							<input title="ID" type="text" class="form" id="id" name="id" value="<?=$id?>" maxlength="11" style="width:50px">&nbsp;
							Từ khóa:
							<input title="Từ khóa" type="text" class="form" id="keyword" name="keyword" value="<?=$keyword?>" maxlength="255" style="width:100px">&nbsp;
							<input type="hidden" name="sort" value="<?=$sort?>" />
							<input type="hidden" name="object" value="<?=$object?>" />
							<input type="hidden" name="iCat" value="<?=$iCat?>" />
						</td>
						<td class="textBold" style="padding-left:5px"><input title="Tìm kiếm" type="image" src="<?=$fs_imagepath?>search.gif" border="0"></td>
					</tr>
				</form>
				</table>
			</td>
		</tr>
	</table>
	<? //End page break and search data?>
	<table border="1" style="border-collapse:collapse" bordercolor="#CCCCCC" cellpadding="3" cellspacing="0" width="98%">
		<tr class="textBold">
			<td>Stt.</td>
			<td nowrap="nowrap" align="center">
				<div>ID</div>
				<div>
					<?=generate_sort("asc", 1, $sort, $fs_imagepath)?>
					<?=generate_sort("desc", 2, $sort, $fs_imagepath)?>
				</div>
			</td>
			<td align="center">
				<div>Tên/ Tiêu đề</div>
				<div>
					<?=generate_sort("asc", 3, $sort, $fs_imagepath)?>
					<?=generate_sort("desc", 4, $sort, $fs_imagepath)?>
				</div>
			</td>
			<td nowrap="nowrap" align="center">
				<div>Ngày cập nhật</div>
				<div>
					<?=generate_sort("asc", 5, $sort, $fs_imagepath)?>
					<?=generate_sort("desc", 6, $sort, $fs_imagepath)?>
				</div>
			</td>
			<td align="center">Link</td>
			<td align="center">Tạo link</td>
		</tr>
	<?
	// Đếm số thứ tự
	$No = ($current_page - 1) * $page_size;
	while($listing = mysql_fetch_array($db_listing->result)){
		$No++;
		$link= createLink("detail",array('module'=>strtolower($module),"title"=>$listing["dat_title"],"iCat"=>$iCat,"iData"=>$listing["dat_id"]),$fs_preview,$con_extenstion,$con_mod_rewrite);
	?>
		<tr id="tr_<?=$No?>">
			<td class="No"><?=$No?></td>
			<td align="right" class="text_normal_bold">
				<?=$listing["dat_id"]?>
			</td>
			<td><a style="text-decoration:none" href="<?=$fs_preview . $link?>" target="_blank"><?=$listing["dat_title"]?></a></td>
			<td align="center">
				<div><?=(isset($listing["dat_date"]) ? date("d/m/Y", $listing["dat_date"]) : "No update !")?></div>
				<div style="color:#666666; font-size:10px"><?=(isset($listing["dat_date"])) ? date("H:i A", $listing["dat_date"]) : '';?></div>
			</td>
			<td nowrap="nowrap" style="color:#0000FF"><?=$link?></td>
			<td align="center"><img title="Tạo link" hspace="5" src="<?=$fs_imagepath?>create_link.gif" style="cursor:pointer" onClick="link_to_data('<?=$link?>')" /></td>
		</tr>
	<? }?>
	</table>
	<? if($total_record > $page_size){?>
	<table width="98%" cellpadding="2" cellspacing="2">
		<tr>
			<td class="textBold"><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
			<td class="textBold" align="right"><a title="Go to top" accesskey="T" class="top" href="#">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.gif"></a></td>
		</tr>
	</table>
	<? }?>
	<?
	$db_listing->close();
	unset($db_listing);
	?>
<?
}// End if(isset($arrayData))
?>
<?=template_bottom()?>

</body>
</html>
<script language="javascript">
function change_category(){
	frm = document.create_link;
	frm.submit();
}
function change_file(filename){
	document.getElementById("link_category").value = '<?=$fs_preview?>'+filename;
}
function link_to_category(){
	ob = document.getElementById( "iCat" );
	/*if( ob.value == 0 ){
		alert( "Bạn phải chọn một category !" );
		ob.focus();
		return false;
	}*/
	window.opener.document.getElementById("<?=$object?>").value = document.getElementById("link_category").value;
	window.close();
}

function link_to_data(str_link){
	window.opener.document.getElementById("<?=$object?>").value = str_link;
	window.close();
}
</script>
<script language="javascript">self.moveTo((screen.width-document.body.clientWidth)/2, (screen.height-document.body.clientHeight)/2);</script>