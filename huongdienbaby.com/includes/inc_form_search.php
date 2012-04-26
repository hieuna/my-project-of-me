		<?
		$keyword 	= getValue("keyword","str","GET","Từ khóa",1,1);
		$module	 	= getValue("module","str","GET","",1);
		$keyword 	= trim($keyword);
		$keyword		= str_replace('\\','',$keyword);
		$iCat			=	getValue("iCat");
		$iData		=	getValue("iData");
		$db_category	=	new db_query("SELECT cat_id,cat_name FROM categories_multi WHERE cat_parent_id=0 AND cat_type='product' ORDER BY cat_order ASC");
		
		?>
<table cellpadding="0" cellspacing="0" align="center" width="100%" border="0" height="30">
	<form action="<?=$lang_path?>type.php" method="get" name="formtopsearch" id="formtopsearch" onsubmit="fromtopsubmit('formtopsearch'); return false;">
	<input type="hidden" name="module" value="product" id="top_module" />
	<tr>
		<td width="40%" class="textBold"><?=$title_page?> <span id="end_address" class="textBold"></span></td>
		<td>&nbsp;&nbsp;</td>
		<td class="textBoldcolor"><img src="/images/search.png" border="0"  align="absmiddle"/></td>
		<td><input type="text" class="form" name="keyword" id="keyword_top" onchange="fromtopsubmit('formtopsearch');" value="<?=str_replace("\"","&quot;",urldecode($keyword))?>" onblur="if(this.value=='') this.value='Từ khóa';" onfocus="if(this.value=='Từ khóa') this.value='';" />
		</td>
		<td><input type="hidden" name="product_id" id="product_id"  class="form"/>
			<select class="form" name="iCat" id="top_iCat">
				<option value="0">Tất cả</option>
				<?
				while($row=mysql_fetch_array($db_category->result)){
				?>
					<option value="<?=$row["cat_id"]?>" <? if($iCat==$row["cat_id"]) echo "selected";?>><?=$row["cat_name"]?></option>
				<?
				}
				?>
			</select>
		</td>
		<td><input type="button" value="<?=translate_display_text("tim_kiem")?>" class="buttom"  onclick="fromtopsubmit('formtopsearch');"/></td>
		<td width="167" background="/images/sanphamdaxem.gif" style="background-repeat:no-repeat; padding-bottom:8px; font-weight:bold; padding-left:10px;"><a href="<?=$lang_path?>spdaxem.php?width=800&height=500"  title="<?=translate_display_text("san_pham_da_xem")?>" class="thickbox noborder"><?=translate_display_text("san_pham_da_xem")?></a></td>
		<td>&nbsp;</td>
	</tr>
	</form>
</table>
<?
unset($db_category);
?>