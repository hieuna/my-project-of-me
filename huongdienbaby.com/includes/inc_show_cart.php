<? $listNotin = "0";?>
<div class="t_top"><div><?=translate_display_text("gio_hang_cua_ban")?></div></div>
	<div class="t_center">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		 <tr>
			  <td>
				<? /*------------------------*/ ?>
					<?
				if (!isset($_COOKIE['order'])){
					echo "<div class='title_left_menu' align='center'><br /><br /><h3>Không có sản phẩm nào</h3><br />";
				}
				else{
				?>
				<table width="100%" cellpadding="5" cellspacing="2">
				<form action="<?=$lang_path?>recount.php" method="post" name="payment">
					<tr>
						<td>
							<table width="100%" cellspacing="0" cellpadding="5" border="1" style="border-collapse:collapse" bordercolor="#FF9B0F">
								<tr>
								  <td class="textBold" align="center"><?=translate_display_text("stt")?></td>
								  <td class="textBold" align="center"><?=translate_display_text("san_pham")?></td>
								  <td class="textBold" align="center"><?=translate_display_text("so_luong")?></td>
								  <td class="textBold" align="right"><?=translate_display_text("gia")?> (<?=$con_currency?>)</td>
								  <td class="textBold" align="right"><?=translate_display_text("tong")?></td>
									<td class="textBold" align="center"><?=translate_display_text("xoa")?></td>
								</tr>
								<?
								
								$array_cookie = explode("|",$_COOKIE['order']);
								$total_money = 0;
								$j=1;
								$total_name = "";
								for ($i=0;$i<count($array_cookie)-1;$i=$i+3){
									$db_get = new db_query("SELECT pro_id,pro_name,cat_id,cat_name,cat_type,pro_price
																	  FROM categories_multi,products
																	  WHERE cat_id = pro_category AND pro_active = 1 AND pro_id =" . intval($array_cookie[$i]));
										if (mysql_num_rows($db_get->result)){
										$row_get = mysql_fetch_array($db_get->result);
										$listNotin .= "," . $row_get["pro_id"];
										$link_pro= createLink("detail",array('module'=>$row_get["cat_type"],"title"=>$row_get["pro_name"],"iCat"=>$row_get["cat_id"],"iData"=>$row_get["pro_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
								?>
									<tr>
										<td align="center" class="text"><b><?=(int)($i/3)+1;?></b> <input type="hidden" name="product_<?=$j?>" id="product_<?=$j?>" value="<?=$row_get["pro_id"];?>" /></td>
										<td align="left"><a class="textBold" href="<?=$link_pro?>"><?=$row_get["pro_name"];?></a></td>
										<td class="text" align="center"><input type="text" name="quantity<?=(int)($i/3)+1;?>" value="<?=$array_cookie[$i+2];?>" size="1" class="form" align="right" maxlength="10"/></td>
										<td align="right" class="text"><font color="#FF0000"><?=formatNumber($row_get["pro_price"]*doubleval($con_exchange));?></font> <?=$con_currency?></td>
										<td align="right" class="text"><font color="#FF0000"><?=formatNumber($row_get["pro_price"] * intval($array_cookie[$i+2])*doubleval($con_exchange));?></font> <?=$con_currency?></td>
										<td align="center" class="news_detail"><input type="checkbox" name="delete<?=(int)($i/3)+1;?>" value="1" class="search-form" /></td>
									</tr>
								<?
									$j++;
									$total_money+=$row_get["pro_price"] * intval($array_cookie[$i+2]);
									$total_name .= $row_get["pro_name"]. ', ';
									}
								}
								?>
								<tr><? $english_format_number = formatNumber($total_money); ?>
									<td colspan="7" class="textBold"><?=translate_display_text("tong_tien")?>: <b style="color:#F83E07"><?=formatNumber($total_money*$con_exchange);?></b>  <?=$con_currency?></td>
								</tr>
								<tr>
									<td colspan="7" align="center">
                                    	<input type="button" class="buttom" value="Tiếp tục mua hàng" onclick="window.location.href='/';" />&nbsp;
										<input type="submit" value="<?=translate_display_text("tinh_lai")?>" class="buttom" />&nbsp;
										<input type="button" value="<?=translate_display_text("xoa_gio_hang")?>" class="buttom" onClick="if (confirm('<?=translate_display_text("ban_muon_xoa_gio_hang")?> ?')){window.location.href='<?=$lang_path?>recount.php?clear=1'}">&nbsp;
										<input type="button" value="<?=translate_display_text("thanh_toan")?>" class="buttom" onclick="window.location.href='<?=$lang_path?>payment.php';" />
                                        <div style="float:right; padding-left:10px;">
                                        <!--SOHAPAY-->
									   <?php 
									   $money = $total_money*$con_exchange;
									   $transaction_info = 'Thanh toán đơn hàng gồm các sản phẩm: '.$total_name;
	                                   if($money >= 10000){?>
	                                    <a target="_blank" href="https://sohapay.com/payment_product.php?u=huongdienbaby@gmail.com&price=<?php echo $money;?>&transaction_info=<?php echo $transaction_info;?>">
				                       <img align="absmiddle" border="0" src="https://sohapay.com/images/btn/thanhtoan_sohapay_orange.png">
				                       </a>
				                       <br/><blink><a href="https://sohapay.com/info/help/huong-dan-thanh-toan.html" target="_blank" style="font:Arial, Helvetica, sans-serif; text-decoration:none; color:#666; font-size:12px">[Hướng dẫn thanh toán]</a></blink>
	                                    <?php }?>
	                                    <!--END SOHAPAY-->
                                        </div>
                                        
                                        <div style="float:right; padding-left:10px;">
                              <!--code baokim TMH-->
								   <?php 
								   $total_money = $total_money*$con_exchange;
                                   if($total_money >= 10000){?>
                                    <a href= "https://www.baokim.vn/payment/customize_payment/product?business=huongdienbaby@gmail.com&product_name=<?php echo $total_name;?>&product_price=<?php echo $total_money;?>&product_quantity=1&total_amount=<?php echo $total_money;?>" target="_blank"><img src="https://www.baokim.vn/application/uploads/buttons/btn_safety_payment_1.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn" ></a>
                                    <?php }else{?>
                                    
                                    <a href="https://www.baokim.vn/payment/deal_payment/product?receiver=huongdienbaby@gmail.com" target="_blank">
            						<img src="https://www.baokim.vn/application/uploads/buttons/btn_safety_payment_1.png" alt="Thanh toán an toàn với Bảo Kim !" border="0" title="Thanh toán trực tuyến an toàn dùng tài khoản Ngân hàng (VietcomBank, TechcomBank, Đông Á, VietinBank, Quân Đội, VIB, SHB,... và thẻ Quốc tế (Visa, Master Card...) qua Cổng thanh toán trực tuyến BảoKim.vn"  >
            						</a>
                                    <?php }?>
                                    <br/><blink><a href="https://www.baokim.vn/payment_guide/huongdienbabycom.html" target="_blank" style="font:Arial, Helvetica, sans-serif; text-decoration:none; color:#666; font-size:12px">[Hướng dẫn thanh toán]</a></blink>
                                 
                                    <!--endboakim-->
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</form>
				</table>
				<? } ?>
					<? /*------------------------*/ ?>
			  </td>
		 </tr>
	</table>
 </div>
<div class="t_bottom"><div>&nbsp;</div></div>
