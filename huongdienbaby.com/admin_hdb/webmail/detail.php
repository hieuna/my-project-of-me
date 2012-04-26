<?
require_once("config_security.php");
$record_id 	= getValue("record_id");
$db_email 	= new db_query("SELECT * 
							FROM webmails
							WHERE mail_id =  " . $record_id);
$db_update = new db_execute("UPDATE " . $fs_table . " SET mail_status= 1 WHERE mail_id = " . $record_id);							
?>
<html>
<head>
<title>Channel Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css">
</head>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? template_top(translate_text("Thong_tin_email"))?>
	<? /*---------Body------------*/ ?>
		<?
		if($row=mysql_fetch_assoc($db_email->result)){
		?>
			<table cellpadding="5" cellspacing="0" width="100%">
				<tr>
					<td class="textBold" align="right">Email gửi đến:</td>
					<td><?=$row["mail_to"]?></td>
				</tr>
				<tr>
					<td class="textBold" align="right">Tiêu đề:</td>
					<td><?=$row["mail_title"]?></td>
				</tr>
				<tr>
					<td class="textBold" align="right" valign="top">Nội dung:</td>
					<td><?=nl2br($row["mail_content"])?></td>
				</tr>
			</table>
		<?
		}
		?>
	<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>