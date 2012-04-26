<?
require_once("../classes/database.php");
require_once("../classes/menu.php");
$menu = new menu();
$menu->getArray("categories_multi","cat_id","cat_parent_id"," cat_type='product'");
$db_category = new db_query("SELECT cat_id,cat_name,cat_type
									 FROM categories_multi
									 WHERE cat_parent_id = 0 AND cat_active = 1 AND cat_show = 1 AND cat_type='product'
									 ORDER BY cat_order ASC");
while($cat = mysql_fetch_array($db_category->result)){
	$link_cat = createLink("type",array('module'=>$cat["cat_type"],"title"=>$cat["cat_name"],"iCat"=>$cat["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);									 
	$db_product = new db_query("SELECT pro_picture,pro_id,pro_name,pro_price,pro_teaser,pro_khuyenmai,pro_new,pro_category
										 FROM products
										 WHERE pro_active = 1 AND pro_category IN(" . $menu->getAllChildId($cat["cat_id"]) . ") AND pro_hot = 1
										 ORDER BY RAND() 
										 LIMIT " . intval($con_home_product));
	if(mysql_num_rows($db_product->result)>0){
?>
	<div style="padding:4px"></div>
	<div class="tem_top"><div><a href="<?=$link_cat?>"><?=mb_strtoupper($cat["cat_name"],"UTF-8")?></a></div></div>
	<div class="tem_center">
	 <table cellpadding="5" cellspacing="0" width="100%">
		<tbody>
		<?
		$num_col = 5;
		$j=0;
		?>
		<?
		if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
		else $go_next = 0;
		while($go_next == 1){
		?>
			<tr>
			<?
			for($i=0;$i<$num_col;$i++){
			?>
				<td valign="top" align="center" width="<?=round(100/$num_col)?>%">
				<?
				if($go_next == 1){
					$lin_pro = createLink("detail",array('module'=>$cat["cat_type"],"title"=>$row["pro_name"],"iCat"=>$row["pro_category"],"iData"=>$row["pro_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
					 $tooltip	= tooltip($row["pro_name"],(trim($row["pro_teaser"])!='') ? $row["pro_teaser"] : '',$row["pro_price"],$row["pro_khuyenmai"],$con_currency);;
					 $strhotnew = '';
					 if($row["pro_new"]==1) $strhotnew .= '<div class="new_hot"><img src="/images/new.gif" border="0"></div>';
				?>
					<div style="width:176px;">
					<div align="center"><img src="/images/top_pro.gif" border="0"></div>
					<div style="width:174px; height:115px; border-left:solid 1px #e2e2e2; border-right:solid 1px #e2e2e2; overflow:hidden">
						<a href="<?=$lin_pro?>" <? if($tooltip!=''){?> onmouseover="showtip('<?=$tooltip?>')" onmouseout="hidetip();" <? }?>><img src="/pictures_products/small_<?=$row["pro_picture"]?>" onError="this.src='/images/noimage.jpg'" border="0"></a>
					</div>
					<?=$strhotnew?>
					<div style="background:url(/images/bg_pro.gif) repeat-y center; line-height:14px; padding:4px;">
						<div style="height:30px; line-height:15px;"><a href="<?=$lin_pro?>" <? if($tooltip!=''){?> onmouseover="showtip('<?=$tooltip?>')" onmouseout="hidetip();" <? }?>><?=$row["pro_name"]?></a></div>
						<font class="price"><?=formatNumber($row["pro_price"]*doubleval($con_exchange))?> </font> <font style=" font-size:13px;"><?=$con_currency?></font>
					</div>
					<div align="center"><img src="/images/bottom_pro.gif" border="0"></div>
					</div>
				<?
				$j++;
				}
				if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
				else $go_next = 0;
				?>
				</td>
			<? 
			}
			?>
			</tr>
		<?
		}
		?>
		</tbody>
	 </table>
	</div>
	<div class="tem_bottom"><div>&nbsp;</div></div>
<?	
	}	
	unset($db_product);								 
}
?>
