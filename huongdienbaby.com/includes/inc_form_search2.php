<?
$keyword 	= getValue("keyword","str","GET","Từ khóa",1,1);
$module	 	= getValue("module","str","GET","",1);
$keyword 	= trim($keyword);
$keyword		= str_replace('\\','',$keyword);
$iCat			=	getValue("iCat");
$iData		=	getValue("iData");
$db_category	=	new db_query("SELECT cat_id,cat_name FROM categories_multi WHERE cat_parent_id=0 AND cat_type='product' ORDER BY cat_order ASC");
$db_supplier	=	new db_query("SELECT sup_name AS keyword FROM supplier ORDER BY sup_order LIMIT 3");
$arrHotKey=explode(',',$con_hotkey);
?>
<table cellpadding="0" cellspacing="0" align="center" border="0" background="/images/sea_2.jpg">
	<form action="<?=$lang_path?>type.php" method="get" name="formtopsearch" id="formtopsearch" onsubmit="fromtopsubmit('formtopsearch'); return false;">
	<input type="hidden" name="module" value="product" id="top_module" />
	<tr>
		<td align="left"><img src="/images/sea_1.jpg" border="0" /></td>
		<td><img src="/images/icon_search.png" border="0" class="png" /></td>
		<td><input type="hidden" name="product_id" id="product_id"  class="form"/>
			<table cellpadding="2" cellspacing="0" width="100%">
				<tr>
					<td class="textBold" nowrap="nowrap"><?=mb_strtoupper(translate_display_text("tim_kiem"),"UTF-8")?></td>
					<td><input type="text" class="form_search" name="keyword" id="keyword_top" style="width:200px;" onchange="fromtopsubmit('formtopsearch');" value="<?=str_replace("\"","&quot;",urldecode($keyword))?>" onblur="if(this.value=='') this.value='Từ khóa';" onfocus="if(this.value=='Từ khóa') this.value='';" /></td>
					<td class="textBold" nowrap="nowrap"><?=mb_strtoupper(translate_display_text("danh_muc"),"UTF-8")?></td>
					<td>
						<select class="form_search" name="iCat" id="top_iCat" style="width:200px;">
							<option value="0"><?=translate_display_text("tat_ca")?></option>
							<?
							while($row=mysql_fetch_array($db_category->result)){
							?>
								<option value="<?=$row["cat_id"]?>" <? if($iCat==$row["cat_id"]) echo "selected";?>><?=$row["cat_name"]?></option>
							<?
							}
							?>
						</select>
					</td>
					<td>
						<input type="image" src="/images/search_<?=$lang_id?>.jpg"/>
					</td>
				</tr>
				<tr>
                	<td colspan="5"><div class="div_search"><span class="count_cat"><b><?=translate_display_text("hot_keywords")?> : </b><? foreach($arrHotKey as $value){ ?><a href="<?=$lang_path?>type.php?module=product&keyword=<?=urlencode($value)?>" title="<?=htmlspecialchars($value)?>"><?=$value?></a> , <? }?></span></div></td>	
					<!--<td colspan="5"><div class="div_search"><span class="count_cat"><b><?=translate_display_text("hot_keywords")?> : </b><? while($row=mysql_fetch_array($db_supplier->result)){ ?><a href="<?=$lang_path?>type.php?module=product&keyword=<?=urlencode($row["keyword"])?>" title="<?=htmlspecialchars($row["keyword"])?>"><?=$row["keyword"]?></a>, <? }?></span></div></td>	-->
				</tr>
			</table>
		</td>
		<td align="right"><img src="/images/sea_3.jpg" border="0" /></td>
	</tr>
	</form>
</table>
<?
unset($db_category);
?>