<table cellpadding="0" cellspacing="0">
	<tr>							
	<?
	$db_banner = new db_query("SELECT * FROM banners WHERE ban_type = 4 AND ban_active = 1 AND lang_id=" . $lang_id . " LIMIT 1");
	while($row=mysql_fetch_array($db_banner->result)){
		echo '<td>';
		showBanner($row["ban_picture"],$row["ban_name"],$row["ban_id"],$con_page_size);
		echo '</td>';
	}
	?>		
	</tr>
</table>