<?
require_once("config_security.php");
$sql					=	'';
$keyword				=	getValue("keyword","str","GET","",1);
if($keyword!='') $sql	.=	" AND (mail_title LIKE '%" . $keyword . "%' OR mail_to LIKE '%" . $keyword . "%' OR mail_content LIKE '%" . $keyword . "%' OR mail_from LIKE '%" . $keyword . "%' )";

//get page break params
$normal_class			=	"break_page";
$selected_class			=	"break_page";
$page_prefix 			= "Pages:&nbsp;";
$current_page 			= 1;
$page_size 				= 30;

if (isset($_GET["page"])) $current_page = $_GET["page"];
$current_page = intval($current_page);
if ($current_page < 1) $current_page=1;
$url = $_SERVER['SCRIPT_NAME'] . "?keyword=" . $keyword;

$db_count = new db_query("SELECT Count(*) AS count 
						  FROM webmails 
						  WHERE lang_id=" . $_SESSION["lang_id"] . " " . $sql);
$row_count = mysql_fetch_array($db_count->result);
$total_record = $row_count['count'];
$db_count->close();
unset($db_count);

$db_supplier			=	new db_query("SELECT * 
											FROM webmails 
											WHERE lang_id=" . $_SESSION["lang_id"] . " " . $sql . " 
											ORDER BY mail_time DESC,mail_id DESC 
											LIMIT " . ($current_page-1) * $page_size . "," . $page_size);
?>
<html>
<head>
<title>Channel Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css">
</head>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("Danh_sach_email"))?>
	<? /*---------Body------------*/ ?>
		<form action="<?=$_SERVER['SCRIPT_NAME']?>" method="get" style="margin:0px; padding:0px; float:left" >
			<input type="text" name="keyword" id="keyword" value="<?=$keyword?>">
			<input type="submit" value="Tìm kiếm">
		</form>
		<table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse" border="1" bordercolor="#CCCCCC">
			<tr>
				<td class="textBold" bgcolor="#FFFF99">STT</td>
				<td class="textBold" bgcolor="#FFFF99">Gửi từ email</td>
				<td class="textBold" bgcolor="#FFFF99">Gửi đến email</td>
				<td class="textBold" bgcolor="#FFFF99">Tiêu đề</td>
				<td class="textBold" bgcolor="#FFFF99">Xem chi tiết</td>
				<td class="textBold" bgcolor="#FFFF99">Thời gian gửi</td>
				<td align="center"><img src="../images/delete.gif" border="0"></td>
			</tr>
			<?
			$i=0;
			while($row=mysql_fetch_assoc($db_supplier->result)){
				$i++;
			?>
			<tr>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" align="center"><?=$i?></td>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" style="padding:3px;"><strong><a href="<?=$_SERVER['SCRIPT_NAME']?>?keyword=<?=$row["mail_from"]?>"><?=$row["mail_from"]?></a></strong></td>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" style="padding:3px;"><strong><a href="<?=$_SERVER['SCRIPT_NAME']?>?keyword=<?=$row["mail_to"]?>"><?=$row["mail_to"]?></a></strong></td>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" style="padding:3px;"><a href="detail.php?record_id=<?=$row["mail_id"]?>&url=<?=base64_encode(getURL())?>"><?=$row["mail_title"]?></a></td>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" style="padding:3px;"><a href="detail.php?record_id=<?=$row["mail_id"]?>&url=<?=base64_encode(getURL())?>">Xem chi tiết</a></td>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" style="padding:3px;"><?=date("H:i:s d/m/Y",$row["mail_time"])?></td>
				<td bgcolor="<?=($row["mail_status"]==0) ? '#FFFFFF' : '#F4F4F4'?>" align="center"><img src="../images/delete.gif" border="0"  onClick="if (confirm('Bạn muốn xóa email này?')) { window.location.href='delete.php?record_id=<?=$row["mail_id"];?>&url=<?=base64_encode(getURL())?>'}" style="cursor:pointer"></td>
			</tr>
			<?
			}
			?>
		</table>
	<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>