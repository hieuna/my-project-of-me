<?
$order		= getValue("order","str","COOKIE","");
$arrayOrder = explode("|",$order);
?>
<?
$tongtien = 0;
for ($i=0;$i<count($arrayOrder)-1;$i=$i+3){
	$tongtien += isset($arrayOrder[$i+1]) ? (doubleval($arrayOrder[$i+1])*intval($arrayOrder[$i+2])) : 0;
}
if(count($arrayOrder)>1){
?>
<div class="t_top"><div><?=translate_display_text("Thong_tin_gio_hang")?></div></div>
	<div class="t_center">
		<div style="padding:5px;">
			<div><strong><?=translate_display_text("Co")?></strong>: <font color="#FF0000"><?=intval(count($arrayOrder)/3)?></font> <?=translate_display_text("san_pham")?></div>
			<div style="margin-top:5px;"><strong><?=translate_display_text("Tong_tien")?></strong>: <font color="#FF0000"><?=formatNumber($tongtien)?> <?=$con_default_currency?></font></div>
			<div style="margin-top:5px;"><a href="<?=$lang_path?>showcart.php?lg=<?=$lang_id?>"><?=translate_display_text("Xem_chi_tiet_don_hang")?></a></div>
		</div>
	</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<?
}
?>
