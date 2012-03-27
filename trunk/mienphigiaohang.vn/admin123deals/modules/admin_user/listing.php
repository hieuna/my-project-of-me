<?
include("inc_security.php");

//Khai báo biến khi hiển thị danh sách
$fs_title		= $module_name . " | Danh sách";
$fs_action		= "listing.php" . getURL(0,0,0,1,"record_id");
$fs_redirect	= "listing.php" . getURL(0,0,0,1,"record_id");
$fs_errorMsg	= "";

/*****----- Quick Edit -----*****/
$action			= getValue("action", "str", "POST", "");
if($action == "execute"){
	
	//Get data edit
	$record_id	= getValue("record_id", "int", "POST", 0);
	$db_edit		= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);
	if(mysql_num_rows($db_edit->result) == 0){
		$fs_errorMsg .= "&bull; Không tìm thấy dữ liệu, bạn hãy liên hệ với ban quản trị Website!<br />";
	}
	else{

		$edit		= mysql_fetch_array($db_edit->result);
		unset($db_edit);
		
		//Lấy dữ liệu đề giữ nguyên trạng thái khi submit error
		$adm_name			= getValue("adm_name", "str", "POST", $edit["adm_name"]);
			
		/*
		Call class form:
		1). Ten truong
		2). Ten form
		3). Kieu du lieu , 0 : string , 1 : kieu int, 2 : kieu email, 3 : kieu double, 4 : kieu hash password
		4). Noi luu giu data  0 : post, 1 : variable
		5). Gia tri mac dinh, neu require thi phai lon hon hoac bang default
		6). Du lieu nay co can thiet hay khong
		7). Loi dua ra man hinh
		8). Chi co duy nhat trong database
		9). Loi dua ra man hinh neu co duplicate
		*/
		$myform = new generate_form();
		//Add table insert data
		$myform->addTable($fs_table);
		$myform->add("adm_name", "adm_name", 0, 1, " ", 1, "Bạn chưa nhập họ và tên.", 0, "");
		
		//Check form data
		$fs_errorMsg .= $myform->checkdata();
		
		if($fs_errorMsg == ""){
			
			//Update to database
			$myform->removeHTML(0);
			$db_update = new db_execute($myform->generate_update_SQL($id_field, $record_id));
			unset($db_update);
			
		}//End if($fs_errorMsg == "")
		unset($myform);
	
	}
	
	if($fs_errorMsg != ""){
		$arr_str		= array("&bull; ", "<br />");
		$arr_rep		= array("- ", "\\n");
		$fs_errorMsg= str_replace($arr_str, $arr_rep, $fs_errorMsg);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		echo '<script language="javascript">alert("Có những lỗi sau:\\n' . $fs_errorMsg . '")</script>';
	}
	
	//Redirect
	redirect($fs_redirect);
	
}
/*****----- End Quick Edit -----*****/

$record_id	= getValue("record_id");

//Search data
$id			= getValue("id");
$keyword	= getValue("keyword", "str", "GET", "", 1);
$category	= getValue("category");
$sqlWhere	= "";
//Tìm theo ID
if($id > 0)	$sqlWhere .= " AND adm_id = " . $id . " ";
//Tìm theo keyword
if($keyword != ""){
	if(validateDate($keyword) == 1){
		$startTime	= convertDateTime($keyword, "00:00:00");
		$endTime		= convertDateTime($keyword, "23:59:59");
		$sqlWhere	.= " AND adm_date >= " . $startTime . " AND adm_date <= " . $endTime . " ";
	}
	else{
		$sqlWhere	.= " AND (adm_loginname LIKE '%" . $keyword . "%' OR adm_name LIKE '%" . $keyword . "%' OR adm_email LIKE '%" . $keyword . "%') ";
	}
}

$sqlOrderBy = "adm_name ASC";

//Get page break params
$page_size		= 100;
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
										 FROM admin_user
									 	 WHERE adm_isadmin = 0 AND adm_id <> " . $record_id . $sqlWhere;
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
									 FROM admin_user
									 WHERE adm_isadmin = 0 AND adm_id <> " . $record_id . $sqlWhere . "
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
<?=template_top("Danh sách người dùng")?>
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
			<div>Tài khoản</div>
		</th>
		<th nowrap="nowrap">
			<div>Họ và tên</div>
		</th>
		<th>Module truy cập</th>
		<th>
			<div>Ngày tạo</div>
		</th>
		<th>Kích hoạt</th>
		<th>Lưu</th>
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
	preg_match_all('/\[(.*?)\]/is', $listing["adm_access_module"], $matches);
	$list_id	= "";
	for($i=0; $i<count($matches[0]); $i++){
		$list_id .= intval($matches[1][$i]) . ",";
	}
	$list_id .= 0;

	//Danh sách module mà user được phép truy cập
	$db_list_module= new db_query("SELECT mod_id, mod_name
											 FROM modules
											 WHERE mod_id IN (" . $list_id . ")
											 ORDER BY mod_order ASC, mod_name ASC");
	$list_module	= "";
	$i	= 0;
	$br= 0;
	while($list = mysql_fetch_array($db_list_module->result)){
		$i++;
		$br++;
		$list_module .= $list["mod_name"] . '<font color="#FF0000"> <b>|</b> </font>';
		if($br == 3 && ($i<mysql_num_rows($db_list_module->result))){
			$list_module .= "<br />";
			$br = 0;
		}
	}
	unset($db_list_module);
?>
	<?
	$form->create_form("quick_edit_" . $No, $fs_action, "post", "multipart/form-data");
	?>
	<tr id="tr_<?=$No?>" <?=$fs_change_bg?>>
		<td class="No"><?=$No?></td>
		<td align="center" style="font-weight:bold"><?=$listing["adm_loginname"]?></td>
		<td align="center"><input title="Họ và tên" type="text" id="adm_name_<?=$No?>" name="adm_name" value="<?=htmlspecialbo($listing["adm_name"])?>" class="form_control" style="width:150px" /></td>
		<td align="left"><?=$list_module?></td>
		<td align="right">
			<div><?=date("d/m/Y", $listing["adm_date"])?></div>
			<div class="form_text_note"><?=date("H:i:s A", $listing["adm_date"])?></div>
		</td>
		<td align="center"><a href="active.php?record_id=<?=$listing["adm_id"]?>&redirect=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>active_<?=$listing["adm_active"]?>.gif" /></a></td>
		<td align="center"><input title="Lưu dữ liệu" type="image" hspace="5" src="<?=$fs_imagepath?>save.gif" onClick="MM_validateForm('adm_name_<?=$No?>','','R'); return document.MM_returnValue" /></td>
		<td align="center"><a title="Sửa dữ liệu" href="edit.php?record_id=<?=$listing["adm_id"]?>&redirect=<?=base64_encode(getURL())?>"><img border="0" hspace="5" src="<?=$fs_imagepath?>edit.gif"></a></td>
		<td align="center"><img title="Xóa dữ liệu" hspace="5" src="<?=$fs_imagepath?>delete.gif" style="cursor:pointer" onClick="if(confirm('Bạn có muốn xóa tài khoản này không?')){window.location.href='delete.php?record_id=<?=$listing["adm_id"]?>&redirect=<?=base64_encode(getURL())?>'}" /></td>
	</tr>
	<?=$form->hidden("record_id_" . $No, "record_id", $listing["adm_id"], "");?>
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
		<td align="right"><a title="Go to top" accesskey="T" class="top" href="#">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.gif"></a></td>
	</tr>
</table>
<? }?>
</div>
</body>
</html>
<script language="javascript">ButtonLeftFrame();</script>