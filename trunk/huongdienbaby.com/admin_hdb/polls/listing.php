<?
require_once("config_security.php");
$db_polls = new db_query("SELECT * FROM polls WHERE lang_id = " . $_SESSION["lang_id"] . " AND pol_parent_id = 0 ORDER BY pol_id DESC");
?>
<html>
<head>
<title>Listing</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("danh_sach_tham_do"))?>
		<? /*---------Body------------*/ ?>
		<table border="0" cellpadding="3" cellspacing="2" width="100%" style="border-collapse:collapse">
			<tr>
				<td width="20" class="textBold">No</td>
				<td width="40" align="center"><img src="<?=$fs_imagepath?>save.gif" border="0"></td>
				<td class="textBold">Tiêu đề câu hỏi </td>
				<td width="40" align="center" class="textBold">Số lần </td>
				<td width="80" align="center" class="textBold">Phần trăm </td>
				<td width="40" align="center"><img src="<?=$fs_imagepath?>active.gif" border="0"></td>
				<td width="40" align="center"><img src="<?=$fs_imagepath?>delete.png" border="0"></td>
			</tr>
			<?
			$countno=0;
			while ($row = mysql_fetch_array($db_polls->result))
				{
				$countno++;
			$db_count = new db_query("SELECT SUM(pol_hits) AS sums FROM polls WHERE lang_id = " . $_SESSION["lang_id"] . " AND pol_parent_id = " . $row["pol_id"]);
			$row_count = mysql_fetch_array($db_count->result);
			$total_hit = $row_count["sums"];
			if ($total_hit <=0) $total_hit = 1;
			?>
			<tr bgcolor="#FFE39A">
				<td align="center" class="textBold"><?=$countno;?></td>
				<td align="center"><img src="<?=$fs_imagepath?>save.gif" alt="SAVE" border="0" style="cursor:pointer" onClick="window.location.href='edit.php?iPol=<?=$row["pol_id"]?>&pol_name=' + document.all.pol_name_<?=$row["pol_id"];?>.value"></td>
				<td class="textBold"><input type="text" id="pol_name_<?=$row["pol_id"];?>" name="pol_name_<?=$row["pol_id"];?>" value="<?=$row["pol_name"];?>" size="80" class="form"></td>
				<td class="textBold" align="center"><?=$row_count["sums"]?></td>
				<td class="textBold" align="right">&nbsp;</td>
				<td class="textBold" align="center"><a href="active.php?iPol=<?=$row["pol_id"]?>&returnurl=<?=urlencode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row["pol_parent_active"];?>.gif"></a></td>
				<td align="center"><img src="<?=$fs_imagepath?>delete.png" alt="Delete" border="0" onClick="if (confirm('Are you sure to delete?')){ window.location.href='delete.php?iPol=<?=$row["pol_id"];?>&returnurl=<?=urlencode(getURL())?>';}" style="cursor:pointer"></td>
			</tr>
			<?
			unset($db_count);
			$db_get_sub = new db_query("SELECT *
										FROM polls
										WHERE lang_id = " . $_SESSION["lang_id"] . " AND pol_parent_id = " . $row["pol_id"] . "
										ORDER BY pol_order ASC");
			$i=0;
			while ($row_sub = mysql_fetch_array($db_get_sub->result)){
				$i++;
			?>
			<tr>
				<td align="center" class="textBold">&nbsp;</td>
				<td align="center"><img src="<?=$fs_imagepath?>save.gif" alt="SAVE" border="0" style="cursor:pointer" onClick="window.location.href='edit.php?iPol=<?=$row_sub["pol_id"]?>&pol_name=' + document.all.pol_name_<?=$row_sub["pol_id"];?>.value"></td>
				<td> Trả lời <?=$i;?>: 
				  <input type="text" id="pol_name_<?=$row_sub["pol_id"];?>" name="pol_name_<?=$row_sub["pol_id"];?>" value="<?=$row_sub["pol_name"];?>" size="50" class="form"></td>
				<td class="textBold" align="right"><?=$row_sub["pol_hits"];?> </td>												
				<td align="right"><?=number_format(($row_sub["pol_hits"] / $total_hit) * 100,2,".","");?> % </td>												
				<td align="center">
                	<? if($row_sub["pol_active"] == 0 ) { ?>
						<a href="_active.php?iApr=<?=$row_sub["pol_id"]?>&returnurl=<?=urlencode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row_sub["pol_active"];?>.gif" alt="Active data!"></a>
					<? } else { ?>
						<a href="_active.php?iUapr=<?=$row_sub["pol_id"]?>&returnurl=<?=urlencode(getURL())?>"><img border="0" src="<?=$fs_imagepath?>icon_<?=$row_sub["pol_active"];?>.gif" alt="DeActive data!"></a>
					<? } ?>
                </td>
				<td align="center"><img src="<?=$fs_imagepath?>delete.png" alt="Delete" border="0" onClick="if (confirm('Are you sure to delete the news: <?=str_replace("'","",$row_sub["pol_name"])?> ?')) { window.location.href='delete.php?iPol=<?=$row_sub["pol_id"];?>&returnurl=<?=urlencode(getURL())?>'}" style="cursor:pointer"></td>
			</tr>
			<?
			}
			unset($db_get_sub);
			}
			?>
		</table>
<? template_bottom() ?>
</body>
</html>
<? 
$db_polls->close();
unset($db_polls);
?>