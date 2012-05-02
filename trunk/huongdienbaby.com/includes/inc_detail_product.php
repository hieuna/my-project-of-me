<? require_once("../classes/database.php");?>
<? require_once("../functions/functions.php");?>
<?
$sql='';
$iData=getValue("iData");
$iCat=getValue("iCat");
$checkhits = getValue("updatenew","str","SESSION","");
if(strpos($checkhits,"[" . $iData . "]") === false){
	$db_counter	= new db_execute("UPDATE products SET pro_hits = pro_hits + 1 WHERE pro_id = " . $iData);
	unset($db_counter);
	if(isset($_SESSION["updatenew"])){
		$_SESSION["updatenew"] = $_SESSION["updatenew"] . '[' . $iData . ']';
	}else{
		$_SESSION["updatenew"] = '[' . $iData . ']';
	}
}
$proprice = 0;
$db_detail_product = new db_query("SELECT *
																		FROM products
																		INNER JOIN categories_multi ON(cat_id = pro_category)
																		WHERE cat_active=1 AND pro_active = 1  AND pro_id=" . $iData . " 
																		");
?>
<?
if($row=mysql_fetch_array($db_detail_product->result)){
	$proprice 			= $row["pro_price"];
	$pro_description 	= $row["pro_description"];
?>
<script language="javascript">
function check_quantity(id){
	window.location.href='<?=$lang_path?>addtocart.php?iData=' + id + '&nQuantity=1&returnurl=<?=base64_encode($lang_path . "showcart.php")?>';
}
</script>
<link rel="stylesheet" href="/js/lightbox/engine/css/vlightbox1.css" type="text/css" />
<link rel="stylesheet" href="/js/lightbox/engine/css/visuallightbox.css" type="text/css" media="screen" />
<script src="/js/lightbox/engine/js/visuallightbox.js" type="text/javascript"></script>
<script src="/js/lightbox/engine/js/vlbdata.js" type="text/javascript"></script>
<div class="t_top"><div id="detail"><a href="<?=$lang_path?>type.php?module=product"><?=$row["pro_name"]?></a></div></div>
	<div class="t_center">
		<table cellpadding="5" cellspacing="0" border="0" width="100%"><br />
			<tr>
				<td valign="top" width="400">
					<div align="center">
						<a style="cursor:url(/images/zoomin.cur), pointer !important;" href="/pictures_products/<?=$row["pro_picture"]?>" class="vlightbox1"><img src="/pictures_products/medium_<?=$row["pro_picture"]?>"   onError="this.src='/images/noimage.jpg'"  border="0" /></a>
					</div>
					<div style="padding:2px;" align="center">
						<?
						$db_picture=new db_query("SELECT * FROM pictures_product WHERE pipr_product=" . $row["pro_id"]);
						?>
						<?
						while($rowp=mysql_fetch_array($db_picture->result)){
						?>
							<a  href="/pictures_products/<?=$rowp["pipr_name"]?>"  class="vlightbox1"><img src="<?="/pictures_products/small_" . $rowp["pipr_name"]?>" style="border:solid 1px #f4f4f4; padding:3px;" height="50" vspace="4" hspace="4" border="0"/></a>
						<?
						}
						?>
						<?
						unset($db_picture);
						?>
					</div>
					<div align="center" style="padding-top:10px;">
						<div style="line-height:25px; padding-left:40px; padding-top:5px; float:left; background:url(/images/gio_hang.gif) no-repeat" align="left"><a href="#" style="color:#FFFFFF" onclick="check_quantity(<?=$row["pro_id"]?>)"><?=translate_display_text("cho_vao_gio_hang")?></a>
                        <div style="float:right; padding-left:10px;">
	                       <!--code baokim TMH-->
	                       <?php 
						   if($row["pro_price"] >= 10000){?>
	                        <a href= "https://www.baokim.vn/payment/customize_payment/product?business=huongdienbaby@gmail.com&product_name=<?php echo urlencode($row["pro_name"]);?>&product_price=<?php echo $row["pro_price"];?>&product_quantity=1&total_amount=<?php echo $row["pro_price"];?>" target="_blank"><img style="width: 110px;" src="https://www.baokim.vn/application/uploads/buttons/btn_safety_payment_1.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn" ></a>
	                        <?php }else{?>
							
							<a href="https://www.baokim.vn/payment/deal_payment/product?receiver=huongdienbaby@gmail.com" target="_blank">
	<img style="width: 110px;" src="https://www.baokim.vn/application/uploads/buttons/btn_safety_payment_1.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn"  >
	</a>
							<?php }?>
	                        <br/><blink><a href="https://www.baokim.vn/payment_guide/huongdienbabycom.html" target="_blank" style="font:Arial, Helvetica, sans-serif; text-decoration:none; color:#666; font-size:10px">[Hướng dẫn thanh toán]</a></blink>
	                     
	                        <!--endboakim-->
                        	</div>
                        	<div style="float:right; padding-left:50px;">
                        		<!-- SOHAPAY -->
		                       <?php
		                       $transaction_info = 'Mua sản phẩm '.$row["pro_name"].' tại website huongdienbaby.com'; 
		                       ?>
		                       <a target="_blank" href="https://sohapay.com/payment_product.php?u=huongdienbaby@gmail.com&price=<?php echo $row["pro_price"];?>&transaction_info=<?php echo $transaction_info;?>">
		                       <img style="width: 110px;" align="absmiddle" border="0" src="https://sohapay.com/images/btn/thanhtoan_sohapay_orange.png">
		                       </a>
		                       <br/><blink><a href="https://sohapay.com/info/help/huong-dan-thanh-toan.html" target="_blank" style="font:Arial, Helvetica, sans-serif; text-decoration:none; color:#666; font-size:10px">[Hướng dẫn thanh toán]</a></blink>
		                       <!-- END -->
                        	</div>
                        </div>
                        
                  
						<!--<div style="width:118px; height:30px; line-height:25px; float:right; background:url(/images/zoom.gif)" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	<a href="/pictures_products/<?=$row["pro_picture"]?>" target="_blank" class="thickbox"><?=translate_display_text("xem_anh_lon")?></a></div>-->
					</div>
				</td>
				<td valign="top" style="padding-right:30px;">
					<div class="detail_1"><label><?=translate_display_text("gia_ban")?>: </label><span><?=formatNumber($row["pro_price"])?> <?=$con_currency?></span></div>
					<div class="detail_1"><label><?=translate_display_text("kho_hang")?>: </label><?=($row["pro_stock"]>0) ? translate_display_text("con_hang") : translate_display_text("het_hang")?></div>
					<? if(trim($row["pro_khuyenmai"])!=''){?><div class="detail_1"><label style="color:#FF0000"><?=translate_display_text("khuyen_mai")?>: </label><?=nl2br(trim($row["pro_khuyenmai"]))?></div><? }?>
					<? if($row["pro_warranty"]!=''){?><div class="detail_1"><label><?=translate_display_text("bao_hanh")?>: </label><?=$row["pro_warranty"]?></div><? }?>
					<div class="detail_teaser"><?=nl2br(trim($row["pro_teaser"]))?></div>
                    	<div>
							<div style="font-size:14px; color:#FF9900"> Hỗ trợ trực tuyến </div>
                            <div style="line-height:30px">
							<?
								$arraySupportOnline = array();
								$arraySupportOnline = explode(";", $con_support_online);
								echo '<ul>';
								for($i=0; $i<count($arraySupportOnline); $i++){
									$support = explode(",", $arraySupportOnline[$i]);
									$name		= '';
									$yahoo	= '';
									$skype	= '';
									if(isset($support[0])) $name		= trim($support[0]);
									if(isset($support[1])) $yahoo		= trim($support[1]);
									if(isset($support[2])) $skype		= trim($support[2]);
									
									?>
									<? if($yahoo != ""){ ?><li><a href="ymsgr:sendIM?<?=$yahoo?>"><img src="http://opi.yahoo.com/online?u=<?=$yahoo?>" border=0 align="absmiddle" /> <?=str_replace("'","\'",$name)?></a></li><? }?>
									<? if($skype != ""){ ?><li><a href="skype:<?=$skype?>?call"><img align="absmiddle" border="0" src="/images/07.png"/> <?=str_replace("'","\'",$name)?></a></li><? }?>
									<?
									
								}
								echo '</ul>';
							?>
							</div>
                        </div>
					
				</td>
			</tr>
		</table>
 	</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<table cellpadding="0" cellspacing="0" width="100%" border="0">
	<tr>
		<td>
			<div class="div_tab_top" id="div_tab" style="clear:right">
				<ul>
					 <!--<li id="detail_1" onclick="tabdetail(1,3)" class="tab_select"><a href="#1"><span><?=translate_display_text("thong_tin_chi_tiet")?></span></a></li>-->
					 <li id="detail_1" onclick="tabdetail(1,2)" class="tab_nomal"><a href="#1"><span><?=translate_display_text("San_pham_tuong_tu")?></span></a></li>
					 <li id="detail_2" onclick="tabdetail(2,2)" class="tab_nomal"><a href="#2"><span><?=translate_display_text("thong_tin_lien_quan")?></span></a></li>
				</ul>
			</div>
		</td>
	</tr>
	<tr>
		<td>	
				<div style="padding:2px; background:url(/images/bg_content.jpg);"></div>
                <?
				/*
				<div id="description_1" style="display:none" class="detail_product">
					<table cellpadding="6" cellspacing="0" align="center" width="100%" style="border-collapse:collapse" bordercolor="#F2f2f2" border="1">
						<?
						$i=0;
						$arrcat_form  = explode("|",$row["cat_form"]);
						$arrayDescrip = explode("|",$row["pro_description"]);
						foreach($arrcat_form as $key=>$value){
							$i++;
							if(trim($value)!=''){
							$datadetail = trim(isset($arrayDescrip[$i-1]) ? '' . $arrayDescrip[$i-1] . '' : '');
								if($datadetail != ''){
								?>
									<tr>
										<td bgcolor="<?=($i%2==0) ? '#F9F9F9' : ''?>" class="textBold" align="right" width="30%" nowrap="nowrap"><?=$value?></td>
										<td>: <?=$datadetail?></td>
									</tr>
								<?
								}
							}
						}
						?>
					</table>
					
				</div>*/
                ?>
				<div id="description_1" style="display:none" class="detail_product">
					<?
					$db_product = new db_query("SELECT *
												FROM products
												INNER JOIN categories_multi ON(pro_category=cat_id)
												WHERE  cat_active=1 AND pro_active=1 AND categories_multi.lang_id=" . $lang_id . " AND cat_id = " . $iCat . " AND pro_id <> " . $iData . " AND pro_price <= " . $proprice .
												" ORDER BY pro_price DESC
												 LIMIT 4");
					$total_product = mysql_num_rows($db_product->result);							 
					if($total_product>0){
					?>
					 <table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#f2f2f2" style="border-collapse:collapse">
						<tbody>
						<?
						$num_col = 2;
						
						$j=1;
						?>
						<tr>
							<td colspan="<?=$num_col?>" bgcolor="#FEE9D2" style="padding-left:25px; font-size:15px; font-weight:bold;" height="25" background="/images/bg_thap.gif"><?=translate_display_text("Gia_nho_hon")?> : <?=formatNumber($proprice)?> <?=$con_currency?></td>
						</tr>
						<?
						if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
						else $go_next = 0;
						while($go_next == 1){
						?>
							<tr>
							<?
							for($i=0;$i<$num_col;$i++){
							?>
								<td valign="top" width="" align="left">
												
								<?
								if($go_next == 1){
								 $link_pro	= createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["pro_name"],"iCat"=>$row["cat_id"],"iData"=>$row["pro_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
								 $tooltip	= tooltip($row["pro_name"],(trim($row["pro_teaser"])!='') ? $row["pro_teaser"] : '',$row["pro_price"],$row["pro_khuyenmai"],$con_currency);
								 $strhotnew = '';
								 if($row["pro_new"]==1) $strhotnew .= '<div class="new_hot"><img src="/images/new.gif" border="0"></div><br clear="all">';
								 if($row["pro_sp_khuyenmai"]==1) $strhotnew .= '<div class="new_sales"><img src="/images/sales.png" border="0"></div>';
								?>
									<table cellpadding="0" cellspacing="0">
										<tr>
											<td valign="top">
												<div style="width:179px;overflow:hidden; float:left" align="center">
													<div style="height:120px; line-height:120px;"><a href="<?=$link_pro?>"  onmouseover="showtip('<?=$tooltip?>')" onmouseout="hidetip();"><img src="/pictures_products/small_<?=$row["pro_picture"]?>" alt="<?=htmlspecialchars($row["pro_name"])?>"  onError="this.src='/images/noimage.jpg'" border="0"></a></div>
													<?=$strhotnew?>
													<div class="product"><a href="<?=$link_pro?>"><?=$row["pro_name"]?></a></div>
													<div style="color:#c61b32; font-size:12px"><?=formatNumber($row["pro_price"])?> <?=$con_currency?></div>
												</div>
											</td>
											<td valign="top">
												<div style="float:left; margin-left:5px;">
													<div class="div_cart" onclick="check_quantity(<?=$row["pro_id"]?>)">&nbsp;&nbsp;<a href="#"><?=translate_display_text("cho_vao_gio_hang")?></a></div>
													<? if($countCatId==1){?><div class="div_compe"><input type="checkbox"  align="absmiddle"  name="product_<?=$j?>"  id="product_<?=$j?>" value="<?=$row["pro_id"]?>"/><a href="#" onclick="sosanh(<?=$total_product?>)"><?=translate_display_text("so_sanh_san_pham")?></a></div><? }?>
													<div class="textBold" style="padding-left:8px; margin-top:5px;"><?=translate_display_text("kho_hang")?>: <?=($row["pro_stock"]>0) ? translate_display_text("con_hang") : translate_display_text("het_hang")?></div>
													<? if($row["pro_warranty"]!=''){?><div class="textBold" style="padding-left:8px; margin-top:8px;"><?=translate_display_text("bao_hanh")?>: <?=$row["pro_warranty"]?></div><? }?>
												</div>
											</td>
										</tr>
									</table>
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
					 <?
					 }
					 ?>
					<?
					$db_product = new db_query("SELECT *
												FROM products
												INNER JOIN categories_multi ON(pro_category=cat_id)
												WHERE  cat_active=1 AND pro_active=1 AND categories_multi.lang_id=" . $lang_id . " AND cat_id = " . $iCat . " AND pro_price > " . $proprice .
												" ORDER BY pro_price ASC
												 LIMIT 4");
					$total_product = mysql_num_rows($db_product->result);							 
					if($total_product>0){
					?>
					 <table cellpadding="5" cellspacing="0" width="100%" border="1" bordercolor="#f2f2f2" style="border-collapse:collapse">
						<tbody>
						<?
						$num_col = 2;
						
						$j=1;
						?>
						<tr>
							<td colspan="<?=$num_col?>" bgcolor="#E1ECF9" style="padding-left:25px; font-size:15px; font-weight:bold;" height="25" background="/images/bg_cao.gif"><?=translate_display_text("Gia_lon_hon")?> : <?=formatNumber($proprice)?> <?=$con_currency?></td>
						</tr>
						<?
						if($row = mysql_fetch_array($db_product->result)) $go_next = 1;
						else $go_next = 0;
						while($go_next == 1){
						?>
							<tr>
							<?
							for($i=0;$i<$num_col;$i++){
							?>
								<td valign="top" width="" align="left">
												
								<?
								if($go_next == 1){
								 $link_pro	= createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["pro_name"],"iCat"=>$row["cat_id"],"iData"=>$row["pro_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
								 $tooltip	= tooltip($row["pro_name"],(trim($row["pro_teaser"])!='') ? $row["pro_teaser"] : '',$row["pro_price"],$row["pro_khuyenmai"],$con_currency);
								 $strhotnew = '';
								 if($row["pro_new"]==1) $strhotnew .= '<div class="new_hot"><img src="/images/new.gif" border="0"></div><br clear="all">';
								 if($row["pro_sp_khuyenmai"]==1) $strhotnew .= '<div class="new_sales"><img src="/images/sales.png" border="0"></div>';
								?>
									<table cellpadding="0" cellspacing="0">
										<tr>
											<td valign="top">
												<div style="width:179px;overflow:hidden; float:left" align="center">
													<div style="height:120px; line-height:120px;"><a href="<?=$link_pro?>"  onmouseover="showtip('<?=$tooltip?>')" onmouseout="hidetip();"><img src="/pictures_products/small_<?=$row["pro_picture"]?>" alt="<?=htmlspecialchars($row["pro_name"])?>"  onError="this.src='/images/noimage.jpg'" border="0"></a></div>
													<?=$strhotnew?>
													<div class="product"><a href="<?=$link_pro?>"><?=$row["pro_name"]?></a></div>
													<div style="color:#c61b32; font-size:12px"><?=formatNumber($row["pro_price"])?> <?=$con_currency?></div>
												</div>
											</td>
											<td valign="top">
												<div style="float:left; margin-left:5px;">
													<div class="div_cart" onclick="check_quantity(<?=$row["pro_id"]?>)">&nbsp;&nbsp;<a href="#"><?=translate_display_text("cho_vao_gio_hang")?></a></div>
													<? if($countCatId==1){?><div class="div_compe"><input type="checkbox"  align="absmiddle"  name="product_<?=$j?>"  id="product_<?=$j?>" value="<?=$row["pro_id"]?>"/><a href="#" onclick="sosanh(<?=$total_product?>)"><?=translate_display_text("so_sanh_san_pham")?></a></div><? }?>
													<div class="textBold" style="padding-left:8px; margin-top:5px;"><?=translate_display_text("kho_hang")?>: <?=($row["pro_stock"]>0) ? translate_display_text("con_hang") : translate_display_text("het_hang")?></div>
													<? if($row["pro_warranty"]!=''){?><div class="textBold" style="padding-left:8px; margin-top:8px;"><?=translate_display_text("bao_hanh")?>: <?=$row["pro_warranty"]?></div><? }?>
												</div>
											</td>
										</tr>
									</table>
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
					 <?
					 }
					 ?>
				</div>
				<div id="description_2" style="display:none" class="detail_product">
					<?=$pro_description?>
				</div>
				<!--<div id="description_4" style="display:none" class="detail_product">
					<? //include("inc_review.php");?>
				</div>-->
		</td>
	</tr>
</table>
<script language="javascript">
url = window.location.href;
tabselect = url.split("#");
if(tabselect[1] != undefined){
	tabdetail(tabselect[1],2);
}else{
	tabdetail(1,2);
}
</script>
<?
}
?>