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
$category	= getValue("category");
$sqlWhere	= "";
//tìm theo id
if($id > 0)	$sqlWhere .= " AND par_id = " . $id . " ";
//Tìm theo keyword
if($keyword != ""){	
		$sqlWhere	.= " AND ( par_name LIKE '%" . $keyword . "%' OR par_namelogin LIKE '%" . $keyword . "%' OR par_email LIKE '%" . $keyword . "%' OR par_tel LIKE '%" . $keyword . "%' OR par_date LIKE '%" . $keyword . "%') ";
	}

$sqlOrderBy = "par_id DESC";

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
										 FROM partner_multi
									 	 WHERE par_id <> " . $record_id . $sqlWhere;
$db_count		= new db_query($db_count_query);
//echo $db_count_query;
//die();
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
									 FROM partner_multi
									 WHERE par_id <> " . $record_id . $sqlWhere . "
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
<?=template_top("Danh sách thành viên")?>
<div align="center" class="content">
<? //Page break and search data?>
<table width="98%" cellpadding="2" cellspacing="2">
	<tr>
	<?	if($total_record > $page_size){?>
		<td nowrap="nowrap"><?=generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
	<? }?> 
    <td>Tổng số: <?=$total_record?> Bản ghi</td>
		<td align="right">
			<table cellpadding="0" cellspacing="0">
			<form name="search" action="<?=getURL(0,0,1,0)?>" method="get">
				<tr>
					<td class="form_search" nowrap="nowrap">
                    ID:
						<input title="ID" type="text" class="form_control" id="id" name="id" value="<?=$id?>" maxlength="11" style="width:60px; text-align:right">&nbsp;						
						Từ khóa:
						<input title="Từ khóa" type="text" class="form_control" id="keyword" name="keyword" value="<?=htmlspecialbo($keyword)?>" maxlength="355" style="width:250px">&nbsp;
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
	<tr class="h" style="background:#CCC">
		<th class="h">Stt</th>
		<th nowrap="nowrap">
			<div>Tài khoản truy cập</div>
		</th>
		<th nowrap="nowrap">
			<div>Tên đối tác</div>
		</th>
		<th>Số ĐT</th>
		<th>
			<div>Ngày tạo</div>
		</th>
        <th>Địa chỉ</th>
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
?>
	<?
	$form->create_form("quick_edit_" . $No, $fs_action, "post", "multipart/form-data");
	?>
	<tr id="tr_<?=$No?>" <?=$fs_change_bg?>>
		<td class="No"><?=$No?></td>
		<td align="center" style="font-weight:bold"><?=$listing["par_namelogin"]?></td>
		<td align="center"><?=$listing["par_name"]?></td>
		<td align="center"><?=$listing["par_tel"]?></td>
		<td align="center">
			<div><?=date("d/m/Y-h:m:s",$listing["par_date"])?></div>
		</td>
        <td align="center">
        	<div><?=$listing["par_add"]?></div>
        </td>
		<td align="center"><a href="active.php?record_id=<?=$listing["par_id"]?>&redirect=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>active_<?=$listing["par_active"]?>.gif" /></a></td>
		
		<td align="center"><a title="Sửa dữ liệu" href="edit.php?record_id=<?=$listing["par_id"]?>&redirect=<?=base64_encode(getURL())?>"><img border="0" hspace="5" src="<?=$fs_imagepath?>edit.gif"></a></td>
		<td align="center"><img title="Xóa dữ liệu" hspace="5" src="<?=$fs_imagepath?>delete.gif" style="cursor:pointer" onClick="if(confirm('Bạn có muốn xóa tài khoản này không?')){window.location.href='delete.php?record_id=<?=$listing["par_id"]?>&redirect=<?=base64_encode(getURL())?>'}" /></td>
	</tr>
	<?=$form->hidden("record_id_" . $No, "record_id", $listing["par_id"], "");?>
	<?=$form->hidden("action_" . $No, "action", "execute", "");?>
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
	</tr>
</table>
<? }?>
</div>
</body>
</html>
<script language="javascript">ButtonLeftFrame();</script>