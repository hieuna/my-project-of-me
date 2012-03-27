<div class="box-style">
					<div class="title">
					<h3>Sản phẩm nhiều người mua</h3>
					</div>
					<div class="box-cont clearfix">
                     <?php 
					$select_dealshot_right = new db_query("SELECT * FROM products_multi 
																WHERE   pro_active = 1 
																AND pro_loca = '$city' 
																ORDER BY pro_coupon DESC
                                    							LIMIT 8");					
					while($rows_dealshot_right = mysql_fetch_assoc($select_dealshot_right->result)){
					?>
                    
						<div class="product">
							<h4><a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_dealshot_right["pro_name"]) . '_' . $rows_dealshot_right["pro_id"]?>.html"><?=$rows_dealshot_right["pro_name"]?></a></h4>
							<a class="img"  href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_dealshot_right["pro_name"]) . '_' . $rows_dealshot_right["pro_id"]?>.html"><center><img src="../pictures/products/normal_<?=$rows_dealshot_right["pro_picture"]?>" alt="pic" /></center></a>
							<p class="r-img"><strong class="clblue1 s14"><?=number_format($rows_dealshot_right["pro_price_deal"],0,"",".")?> vnđ</strong><br />
							Free Shiping <!-- <?=$rows_dealshot_right["pro_discount"]?>%--><br />
							<span class="clblue1"><strong><?=$rows_dealshot_right["pro_coupon"]?></strong> người mua</span>
							
							</p>
							<p>
								<a class="button" href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_dealshot_right["pro_name"]) . '_' . $rows_dealshot_right["pro_id"]?>.html"><span>Xem</span></a>
							</p>
						</div>
                        
                         <?php }
				  unset($select_dealshot_right);
				 ?>
                        
						
					</div>
				</div>