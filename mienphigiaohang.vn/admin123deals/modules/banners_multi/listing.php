<?
	require_once("inc_security.php");
	$record_id	= getValue("record_id", "int", "POST", 0);               
	//khoi tao object Datagird
	$list = new fsDataGird($id_field, $name_field,"Danh sách Banner quảng cáo!");
	
	$list->add("ban_title","Tiêu đề banner","string",1,1);
	$list->add("ban_des","Nội dung banner","string",1,1);
	$list->add("ban_link","Liên kết tới đối tác","string",1,1);
	$list->add("ban_picture","Ảnh đại diện","string",1,1);
	$list->add("ban_order","Thứ tự","int",1,1);
	$list->add("ban_active","Kích hoạt","int",1,1);
	
	$list->add("",translate_text("Copy"),"copy");
	$list->add("",translate_text("Edit"),"edit");
	$list->add("",translate_text("Delete"),"delete");
	
	//Search data
//$id			= getValue("id");
$keyword	= getValue("keyword", "str", "GET", "", 1);
$category	= getValue("category");
$sqlWhere	= "";

//Tìm theo keyword
if($keyword != ""){
	
		$sqlWhere	.= " AND (ban_admin LIKE '%" . $keyword . "%' OR ban_link LIKE '%" . $keyword . "%' OR ban_title LIKE '%" . $keyword . "%') ";
	}
$sqlOrderBy = "ban_id DESC";

//Get page break params
$page_size		= 5;
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
										 FROM banners_multi
									 	 WHERE ban_id <> " . $record_id. $sqlWhere;
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
									 FROM banners_multi
									 WHERE  ban_id <> " . $record_id . $sqlWhere ."
									 ORDER BY " . $sqlOrderBy . "
									 LIMIT " . ($current_page - 1) * $page_size . ", " . $page_size);
$countno= 0;	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?=$load_header?>
<?=$list->headerScript()?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*---------Body------------*/ ?>
<?=template_top("Danh sách Banner")?>
    <table border="1" cellpadding="3" cellspacing="0" class="table" width="100%" bordercolor="<?=$fs_border?>">
    <tr><?	if($total_record > $page_size){?>
		<td colspan="3" nowrap="nowrap"><?=generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
        <td style="color:#333; font-weight:bold">Tổng Số bản ghi: <?=$total_record?></td>
        <td align="right">
			<table cellpadding="0" cellspacing="0">
			<form name="search" action="<?=getURL(0,0,1,0)?>" method="get">
				<tr>
					<td class="form_search" nowrap="nowrap">
						
						Từ khóa:
						<input title="Từ khóa" type="text" class="form_control" id="keyword" name="keyword" value="<?=htmlspecialbo($keyword)?>" maxlength="255" style="width:100px">&nbsp;
					</td>
					<td class="form_search" style="padding-left:5px"><input title="Tìm kiếm" type="image" src="<?=$fs_imagepath?>search.gif" border="0"></td>
				</tr>
			</form>
			</table>
		</td>
	<? }?></tr>
		<tr style="font-weight:bold;"> 
        	
			<td  width="5" align="center">STT</td>
            <td width="5" align="center"></td>
            <td  align="center">Acc</td>
			<td  align="center">Tiêu đề Banner</td>
            <td  align="center">Nội dung Banner</td>
			<td  align="center">Link liên kết</td>
            <td  align="center">Đuôi file</td>
			<td  align="center" width="5">Vị trí hiển thị</td>
            <td  align="center" width="5">Active</td>
			<td  align="center" width="16"><img src="<?=$fs_imagepath?>edit.png" border="0" width="16"></td>
			<td  align="center" width="16"><img src="<?=$fs_imagepath?>delete.gif" border="0"></td>
		</tr>
		<form action="quickedit.php?returnurl=<?=base64_encode(getURL())?>" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
		<input type="hidden" name="iQuick" value="update" />	
		<?php
    	    while($row = mysql_fetch_array($db_listing->result)){
                $countno++;
				$cat_id = $row["ban_cat"];
				
				// get tên category hiển thị
				$cat_name_query = new db_query("SELECT * FROM categories_multi WHERE cat_id = '$cat_id'");
				$row_cat_name = mysql_fetch_array($cat_name_query->result);
    	?>
        <tr>
            <td width="5" align="center"><?=$countno?></td>
            <td><input type="checkbox" name="record_id[]" id="record_<?=$countno?>" value="<?=$row["ban_id"]?>" /></td>
            <td align="center" ><?=$row["ban_admin"]?></td>
			<td align="center" ><?=$row["ban_title"]?></td>
            <td align="center" ><?=$row["ban_des"]?></td>
			<td align="center" ><?=$row["ban_link"]?></td>
            <td align="center" ><?=getExtension($row["ban_picture"])?></td>
			<td align="center" width="20%"><?=$arrayLocation[$row["ban_location"]]?> / <?php echo $row_cat_name["cat_name"];?></td>
            <td align="center" width="5%"><a onClick="loadactive(this); return false;" href="active.php?record_id=<?=$row["ban_id"]?>&type=ban_active&value=<?=abs($row["ban_active"]-1)?>&url=<?=base64_encode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>check_<?=$row["ban_active"];?>.gif" title="Active!" /></a></td>
			<td align="center" width="5%"><a class="text" href="edit.php?record_id=<?=$row["ban_id"]?>&returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.png" border="0" width="16" /></a></td>
			<td align="center" width="5%"><img src="<?=$fs_imagepath?>delete.gif" border="0" onClick="if (confirm('Bạn có chắc muốn xóa?')){ window.location.href='delete.php?record_id=<?=$row["ban_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer" /></td>
        </tr>
        <?php
            }
        ?>
        </form> 

		</table>
<?=template_bottom() ?>
<? /*---------Body------------*/ ?>
</body>
</html>
