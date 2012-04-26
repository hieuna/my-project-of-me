<?
$iCat			=	getValue("iCat");
$list			=	getValue("list","str","GET","");
$listid		=	$list;
$url			=	base64_decode(getValue("url","str","GET",base64_encode($lang_path . "index.php")));
$list			=	explode(",",$list);
$proid		=	'';
$sql			=	'';
if(isset($list[0])){
	for($i=0;$i<count($list);$i++){
		if(isset($list[$i]) && intval($list[$i])!=0){
			$proid	.=	intval($list[$i]) . ",";
		}
	}
}
	$proid=$proid . "0";
	$sql			=	" AND pro_id IN(" . $proid . ")";
	$sql			.=	" AND cat_id =" . $iCat;
$db_list_product = new db_query("SELECT *
											  FROM products,categories_multi
											  WHERE cat_id = pro_category AND cat_active=1 AND cat_type='product' " . $sql . "
											  ORDER BY pro_date DESC
											  ");
$pro_name			='';	
$pro_pirce			='';
$market_price		='';
$picture_pro		='';
$teaser_pro			='';	
$on_sale				='';
$addcart				='';
$remove				='';
$colspan				=0;
$stock				='';
$warranty			='';
$arrayDes			= array();
$i = 0;
$arrayCat 			= array();
$cat_description	= "";
while($row=mysql_fetch_array($db_list_product->result)){		
	$colspan++;
   $link_pro=createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["pro_name"],"iCat"=>$row["cat_id"],"iData"=>$row["pro_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
	if($row["pro_picture"]!=""){
		$picture_pro	.=	'<td class="text"  align="center"><a class="product_name" href="' . $link_pro . '"><img src="' . $product_path . 'small_' . $row["pro_picture"] . '" onError="this.src=\'/images/noimage.jpg\'" border=0></a></td>';	
	}else{
		$picture_pro	.=	'<td class="text">&nbsp;</td>';
	}
	$pro_name			.=	'<td class="textBold" align="center"><a class="product_name" href="' . $link_pro . '">' . $row["pro_name"] . '</a></td>';
	if($row["pro_price"]>0){
		$pro_pirce		.= '<td nowrap="nowrap" class="textBold" align="right"><font color="#FF0000">' . formatNumber($row["pro_price"]*doubleval($con_exchange)) . '</font> ' . $con_currency . '</td>';
	}else{
		$pro_pirce		.= '<td>&nbsp;</td>';
	}
	$stock				.= '<td nowrap="nowrap" class="textBold" align="right">' . (($row["pro_stock"]>0) ? translate_display_text("con_hang") : translate_display_text("het_hang")) . '</td>';
	$warranty			.= '<td nowrap="nowrap" class="textBold" align="right">' . $row["pro_warranty"] . '</td>';
	$addcart				.= '<td align="center"><a href="#" class="product_name" onclick="check_quantity(' .$row["pro_id"]. ');"><img src="/images/chovaogiohang.gif" border="0" /></a></td>';
	$teaser_pro			.= '<td width=240 valign="top"><div class="text" align="justify">' . str_replace(chr(13),"<br>",$row["pro_teaser"]) . '</div></td>';
	$listremove			=  "0" . str_replace("," . $row["pro_id"] . ",",",","," . $listid . ",") . "0";
	$remove				.= '<td nowrap="nowrap" class="textBold" align="center"><a class="product_name" href="so_sanh_san_pham.php?iCat=' .  $iCat . '&list=' . str_replace($row["pro_id"] . ",","",$listid) . '&url=' . getValue("url","str","GET","") . '"><img src="/images/loaikhoisosanh.gif" border="0" /></a></td>';
	$prodes				= explode("|",$row["pro_description"]);
	foreach($prodes as $key=>$value){
		$prodes[$key]	= '<td>' . $value . '</td>';
	}
	$cat_description 	= $row["cat_form"];
	$arrayDes[$i]		= $prodes;
	$i++;
}
	$arrayCat			= explode("|",$cat_description);

	//print_r($arrayCat);
	$arrayOut 			= array();
	for($j=0;$j<count($arrayCat);$j++){
		for($i=0;$i<count($arrayDes);$i++){
				if(isset($arrayOut[$j])){
					$arrayOut[$j] .= isset($arrayDes[$i][$j]) ? $arrayDes[$i][$j] : '';
				}else{
					$arrayOut[$j] = isset($arrayDes[$i][$j]) ? $arrayDes[$i][$j] : '';
				}
		}
	}
	//print_r($arrayOut);

?>
<div class="t_top"><div><a href="<?=$url?>"><img src="/images/back.gif" height="15" border="0" align="absmiddle"></a>&nbsp;&nbsp;<a href="<?=$url?>" class="compare" style="color:#FFFFFF; text-decoration:none"><?=translate_display_text("quay_lai")?></a></div></div>
<div class="t_center">
	<table cellpadding="4" cellspacing="0" align="center" border="1" bordercolor="#f2f2f2" bgcolor="#FFFFFF" style="border-collapse:collapse">
		<tr>
			<td colspan="<?=$colspan+1?>"  class="compare"><div style="float:left"></div></td>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5"><?=translate_display_text("san_pham")?></td>	
			<?=$pro_name?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5" ><?=translate_display_text("hinh_anh")?></td>	
			<?=$picture_pro?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5" ><?=translate_display_text("gia")?></td>	
			<?=$pro_pirce?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap"  bgcolor="#E5E5E5"><?=translate_display_text("kho_hang")?></td>	
			<?=$stock?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5" ><?=translate_display_text("bao_hanh")?></td>	
			<?=$warranty?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap"  bgcolor="#E5E5E5"><?=translate_display_text("gio_hang")?></td>	
			<?=$addcart?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5" ><?=translate_display_text("loai_khoi_so_sanh")?></td>	
			<?=$remove?>
		</tr>
		<tr>
			<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5" ><?=translate_display_text("thong_tin_tom_tat")?></td>	
			<?=$teaser_pro?>
		</tr>
		<?
		foreach($arrayCat as $key=>$value){
		?>
			<tr>
				<td class="textBold" nowrap="nowrap" bgcolor="#E5E5E5"><?=$value?></td>
				<?=isset($arrayOut[$key]) ? $arrayOut[$key] : '<td>&nbsp;</td>'?>
			</tr>
		<?
		}
		?>
	</table>
 </div>
<div class="t_bottom"><div>&nbsp;</div></div>
