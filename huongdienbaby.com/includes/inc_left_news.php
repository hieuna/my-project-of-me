<?
$db_news=new db_query("SELECT *,count(*) as count
									FROM categories_multi,news
									WHERE  new_category = cat_id AND cat_active = 1 AND new_approve = 1 AND categories_multi.lang_id = " . $lang_id ."
									GROUP BY cat_id
									ORDER BY cat_order ASC
									");
$db_product=new db_query("SELECT cat_name,cat_id
									FROM categories_multi
									WHERE cat_parent_id = 0 AND cat_active = 1 AND cat_type='product' AND categories_multi.lang_id = " . $lang_id ."
									ORDER BY cat_order ASC
									");
?>
<div class="t_top"><div><a href="<?=$lang_path?>type.php?module=news"><?=translate_display_text("tin_tuc")?></a></div></div>
<div class="t_center">
	<?
	while($row=mysql_fetch_array($db_news->result)){
		$link_detail = createLink("type",array('module'=>$row["cat_type"],"title"=>$row["cat_name"],"iCat"=>$row["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
	?>
		<div class="list_news"><a href="<?=$link_detail?>" style="font-size:12px"><?=$row["cat_name"]?></a></div>
	<?
	}
	?>
	<div class="title_left"><img src="/images/ten_trai.gif" border="0" align="absmiddle" /><?=translate_display_text("San_pham")?></div>
	<?
	while($row=mysql_fetch_array($db_product->result)){
		$link_detail = createLink("type",array('module'=>'product',"title"=>$row["cat_name"],"iCat"=>$row["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
		$db_count = new db_query("SELECT count(*) AS count FROM products WHERE pro_active = 1 AND pro_category IN(" . $menuid->getAllChildId($row["cat_id"]) . ")");
		if($cou = mysql_fetch_array($db_count->result)){
			$count = $cou["count"];
		}
		unset($db_count);
	?>
		<div class="list_news"><a href="<?=$link_detail?>" style="font-size:12px"><?=$row["cat_name"]?></a> <? if(intval($count)>0){?> <font class="textSmall">(<?=$count?>)</font>	<? }?></div>
	<?
	}
	?>
</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<?
unset($db_category);
?>