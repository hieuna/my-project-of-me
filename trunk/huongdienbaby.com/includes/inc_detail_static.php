<?
$iData 	= getValue("iData");
$iCat 	= getValue("iCat");
$db_detail = new db_query("SELECT *
									 FROM statics
									 WHERE sta_id = " . $iData);
?>
<? if($row  = mysql_fetch_array($db_detail->result)){ ?>
<div class="t_top"><div id="detail"><?=$row["sta_title"]?></div></div>
	<div class="t_center">
		<div class="description" style="padding:5px;">
			<?=$row["sta_description"]?>
		</div>
 	</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<? } ?>
<?
$db_detail->close();
unset($db_detail);
?>


