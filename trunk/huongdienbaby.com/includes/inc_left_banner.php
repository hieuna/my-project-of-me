<?
$db_banner = new db_query("SELECT * FROM banners WHERE ban_type = 3 AND ban_active = 1 AND lang_id=" . $lang_id . " ORDER BY ban_order ASC");
if(mysql_num_rows($db_banner->result)){
?>
<div class="t_top" style="margin-left:2px;"><div><?=translate_display_text("quang_cao")?></div></div>
<div class="t_center" style="margin-left:2px;">
		<?
		while($row=mysql_fetch_array($db_banner->result)){
			showBanner($row["ban_picture"],$row["ban_name"],$row["ban_id"],$con_left_size-5);
		}
		?>
		<div style="text-align: center; width: 100%; padding: 5px 0;">
			<a href="https://sohapay.com" target="_blank"><img src="https://sohapay.com/images/merchant/logo_merchant2.png" style="border: none; margin: 0 auto; width: 195px;" /></a>
		</div>
</div>
<div class="t_bottom" style="margin-left:2px;"><div>&nbsp;</div></div>
<?
}
?>