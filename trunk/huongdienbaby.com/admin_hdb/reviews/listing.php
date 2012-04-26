<?
require_once("config_security.php");
require_once("../../classes/database.php");
require_once("../../functions/functions.php");
$sql='';
$keyword=getValue("keyword","str","GET","",1);
if($keyword!='') $sql.=" AND rev_name LIKE '%" . $keyword . "%'";

$normal_class		="break_page";
$selected_class		="break_page";
$page_prefix 		= "Pages:&nbsp;";
$current_page 		= 1;
if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page 		= intval($current_page);
if ($current_page < 1) $current_page=1;
$page_size 			= 15;
$url = $_SERVER['SCRIPT_NAME'] . "?keyword=" . $keyword;

$db_count = new db_query("SELECT Count(*) AS count
							FROM " . $fs_table . " ,products 
							WHERE pro_id = rev_product AND " . $fs_table . ".lang_id=" . $_SESSION["lang_id"] . " " . $sql . " 
							");
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);
$db_supplier=new db_query("SELECT * FROM " . $fs_table . ",products 
							WHERE pro_id = rev_product AND " . $fs_table . ".lang_id=" . $_SESSION["lang_id"] . " " . $sql . " 
							ORDER BY rev_date DESC
							LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
?>
<html>
<head>
<title>Channel Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("danh_sach_danh_gia"))?>
		<? /*---------Body------------*/ ?>
		<table border="1" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse" bordercolor="#CCCCCC">
			<tr class="textBold"> 
				<td>Người đánh giá</td>
				<td>Sản phẩm</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="center" width="16"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
			<? $countno=0;?>
			<? 
			while($row=mysql_fetch_array($db_supplier->result)){
			$countno++;
			?>
				<tr <?=$fs_change_bg?>>
					<td width="20" class="textBold" align="center"><?=$countno?></td>
					<td class="textBold" width="100" nowrap="nowrap" align="center">
						<div><?=$row["rev_name"]?></div>
					</td>
					<td class="textBold" width="100" nowrap="nowrap" align="center">
						<div><?=$row["pro_name"]?></div>
					</td>
					<td><?=$row["rev_description"]?></td>
					<td align="center" width="20"><img src="<?=$fs_imagepath?>delete.gif" alt="DELETE" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?record_id=<?=$row["rev_id"]?>&returnurl=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
				</tr>

			<? } ?>
			</table>
			<? if($total_record > $page_size){ ?>
			<table cellpadding="5" cellspacing="0" width="100%">
			<tr>
				<td align="center" style="padding-right:5px" class="break_page">
				<?=generatePageBar($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>				</td>
			</tr>
			</table>
			<? } ?>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
</body>
</html>