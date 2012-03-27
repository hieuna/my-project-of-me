<?
include("inc_security.php");

//Khai báo biến khi hiển thị danh sách
$fs_title		= $module_name . " | Danh sách";
$fs_action		= "listing.php" . getURL(0,0,0,1,"record_id");
$fs_redirect	= "listing.php" . getURL(0,0,0,1,"record_id");
$fs_errorMsg	= "";



$record_id	= getValue("record_id");

//Search data
$id			= getValue("id");
$keyword	= getValue("keyword", "str", "GET", "", 1);
//$active	= getValue("active", "int", "GET", "", 1);

$sqlWhere	= "";
//Tìm theo ID
if($id > 0)	$sqlWhere .= " AND MaTin = " . $id . " ";
//Tìm theo keyword
if($keyword != ""){
		$sqlWhere	.= " AND (TieuDe LIKE '%" . $keyword . "%') ";
	}
//tìm theo active:
/*if($active != ""){
	$sqlWhere	.= " AND (active =" . $active . ") ";
	}*/

$sqlOrderBy = "MaTin DESC";

//Get page break params
$page_size		= 10;
$page_prefix	= "Trang: ";
$normal_class	= "page";
$selected_class= "page_current";
$previous		= "<";
$next			= ">";
$first			= "<<";
$last			= ">>";
$break_type		= 1;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$url			= getURL(0,0,1,1,"page");
$db_count_query = "SELECT COUNT(*) AS count
										 FROM tintuc
									 	 WHERE MaTin <> " . $record_id . $sqlWhere;
$db_count		= new db_query($db_count_query);

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
$db_listing	= new db_query("SELECT *
									 FROM tintuc
									 WHERE  MaTin <> " . $record_id . $sqlWhere . "
									 ORDER BY " . $sqlOrderBy . "
									 LIMIT " . ($current_page - 1) * $page_size . ", " . $page_size);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$fs_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?=$load_header?>
</head>
<body>
<?=template_top("Danh sách tin bài")?>
<div align="center" class="content">
<? //Page break and search data?>
<table width="98%" cellpadding="2" cellspacing="2">
	<tr>
	<?	if($total_record > $page_size){?>
		<td nowrap="nowrap"><?=generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
	<? }?>
		<td align="right">
			<table cellpadding="0" cellspacing="0">
			<form name="search" action="<?=getURL(0,0,1,0)?>" method="get">
				<tr>
					<td class="form_search" nowrap="nowrap">
						ID:
						<input title="ID" type="text" class="form_control" id="id" name="id" value="<?=$id?>" maxlength="11" style="width:60px; text-align:right">&nbsp;
						Từ khóa:
						<input title="Từ khóa" type="text" class="form_control" id="keyword" name="keyword" value="<?=htmlspecialbo($keyword)?>" maxlength="255" style="width:100px">&nbsp;
                       <!-- Trạng thái:
						
                        <select class="form_control" id="active" name="active">
                       	  <option selected="selected" value="">-- Chọn trạng thái--</option>                        
                          <option value="1">Kích hoạt</option>
                          <option value="0">Chưa kích hoạt</option>
                        </select>
                        &nbsp;-->
					</td>
					<td class="form_search" style="padding-left:5px"><input title="Tìm kiếm" type="image" src="<?=$fs_imagepath?>search.gif" border="0"></td>
				</tr>
			</form>
			</table>
		</td>
	</tr>
</table>
<? //End page break and search data?>
<table class="table" border="1" cellpadding="3" cellspacing="0" width="98%">
	<tr class="h">
		<th class="h">Stt</th>
		<th nowrap="nowrap">
			<div>Tiêu đề</div>
		</th>
		<th nowrap="nowrap">
			<div>Trích dẫn</div>
		</th>
        <th nowrap="nowrap">
			<div>Ngày đăng</div>
		</th>
		<th>Kích hoạt</th>
		<th>Sửa</th>
		<th>Xóa</th>
	</tr>
<?
//Call class form
$form = new form();
$form->class_form_name = "form_name_2";
?>
<?
$record_id = getValue("record_id", "int", "POST");
//Đếm số thứ tự
$No = ($current_page - 1) * $page_size;
while($listing = mysql_fetch_array($db_listing->result)){
	$No++;
	
	//Tìm tất cả trong [ ... ]
	preg_match_all('/\[(.*?)\]/is', $listing["MaTin"], $matches);
	$list_id	= "";
	for($i=0; $i<count($matches[0]); $i++){
		$list_id .= intval($matches[1][$i]) . ",";
	}
	$list_id .= 0;

	
?>
	<?
	$form->create_form("quick_edit_" . $No, $fs_action, "post", "multipart/form-data");
	?>
	<tr id="tr_<?=$No?>" <?=$fs_change_bg?>>
		<td class="No" align="center" style="font-weight:bold"><?=$No?></td>
		<td align="center" style="font-weight:bold; width:200px"><?=$listing["TieuDe"]?></td>
		<td align="center"><textarea title="Trích Dẫn" id="news_<?=$No?>" name="TrichDan"  class="form_control"  style="width:400px; height:50px" rows="5"  cols="75" readonly="readonly"><?php echo removeHTML($listing["TrichDan"]);?></textarea>
        </td>
		<td align="center" style="width:150px"><?=date("d/m/Y-h:m:s",$listing["NgayDangTin"])?></td>

		<td align="center"><a href="active.php?record_id=<?=$listing["MaTin"]?>&redirect=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>active_<?=$listing["active"]?>.gif" /></a></td>
		
		<td align="center"><a title="Sửa dữ liệu" href="edit.php?record_id=<?=$listing["MaTin"]?>&redirect=<?=base64_encode(getURL())?>"><img border="0" hspace="5" src="<?=$fs_imagepath?>edit.gif"></a></td>
		<td align="center"><img title="Xóa dữ liệu" hspace="5" src="<?=$fs_imagepath?>delete.gif" style="cursor:pointer" onClick="if(confirm('Bạn có muốn xóa tài khoản này không?')){window.location.href='delete.php?record_id=<?=$listing["MaTin"]?>&redirect=<?=base64_encode(getURL())?>'}" /></td>
	</tr>
	<?=$form->hidden("record_id_" . $No, "record_id", $listing["MaTin"], "");?>
	<?
	$form->close_form();
	?>
<?
}// End while($listing = mysql_fetch_array($db_listing->result))
?>
<?
unset($form);
?>
</table>

<? if($total_record > $page_size){?>
<table width="98%" cellpadding="2" cellspacing="2">
	<tr>
		<td><?=generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
		<td align="right"><a title="Go to top" accesskey="T" class="top" href="#">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.gif"></a></td>
	</tr>
</table>
<? }?>
</div>
</body>
</html>
<script language="javascript">ButtonLeftFrame();</script>