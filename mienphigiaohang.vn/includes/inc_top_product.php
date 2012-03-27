<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php 
		$i=0;
		$select_toppro_home = new db_query("SELECT * FROM products_multi 
													WHERE   pro_active = 1 
													AND pro_loca = '$city' 
													ORDER BY pro_id DESC
													LIMIT 3");					
		while($rows_toppro_home = mysql_fetch_assoc($select_toppro_home->result)){	
			$pro_id = 	$rows_toppro_home["pro_id"];				
			$i++;
			$dis = $rows_toppro_home["pro_price_merchant"] - $rows_toppro_home["pro_price_deal"];
			if($rows_toppro_home["pro_coupon"] >= $rows_toppro_home["pro_quality"]){$donguoimua=100;}
			else if($rows_toppro_home["pro_coupon"]==0 || $rows_toppro_home["pro_coupon"] == ""){$donguoimua=0;}
			else{
			$donguoimua = 100 - ($rows_toppro_home["pro_quality"] - $rows_toppro_home["pro_coupon"])*100/$rows_toppro_home["pro_quality"];}
	?>	
<div class="box"><div class="count"><?=$i?></div>
					<div class="slideshow">
				<h2 class="title-box clearfix">
                	<a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html"><strong class="clorange"><?=$rows_toppro_home["pro_name"]?>: </strong> </a>
				<a style="text-decoration:none;color:#000"href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html"><?=$rows_toppro_home["pro_shot_title"]?> </a>
                </h2>
        		<div class="slide-thumbs clearfix">
					<div class="left-slide">
                        <div class="price"> <div class="icon-price"></div>
							<span class="price1"><?=number_format($rows_toppro_home["pro_price_deal"],0,"",".")?></span> <span class="price2">vnđ</span> <a class="btn-view" href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html">&nbsp;</a>
						</div>
						<div class="center-left-slide"><div class="shadow"></div>
							<div class="compare-price clearfix">
								<div class="compare-item begin-item">
									<div class="style-top">Phí Ship</div>
									<div class="style-bottom"><?=number_format($rows_toppro_home["pro_price_merchant"],0,"",".")?> vnđ</div>
								<!--	<div class="style-top">Giá gốc</div>
									<div class="style-bottom"><?=number_format($rows_toppro_home["pro_price_merchant"],0,"",".")?> vnđ</div>-->
								</div>
								<div class="compare-item center-item">
									<div class="style-top"><strong>Free Shiping</strong></div>
									<!--<div class="style-bottom"><?=$rows_toppro_home["pro_discount"]?>%</div>-->
								</div>
								<div class="compare-item last">
								<div class="share-link clearfix">
										<p> Cùng chia sẻ </p>
										<a class="icon-facebook" href="http://www.facebook.com/MienPhiGiaoHang">&nbsp;</a>
										<a class="icon-youtube" href="http://www.youtube.com/mienphigiaohang">&nbsp;</a>
										<a class="icon-z" href=" http://twitter.com/MienPhiGiaoHang">&nbsp;</a>
								</div>
								<!--	<div class="style-top">Tiết kiệm</div>
									<div class="style-bottom"><?=number_format($dis,0,"",".")?> vnđ</div>
								-->
								</div>
							</div>
							<div class="point">
								<div class="number-point"><?=$rows_toppro_home["pro_coupon"]?></div>
								 <div class="buyer"><i>Người mua</i></div>
							</div>
							<div class="time-end">
									<span ><b>Thời gian còn lại:</b></span><br />
								 <?php 								  
										$nam = date("Y", $rows_toppro_home["pro_end"]); // năm
								 		$thang= date("n", $rows_toppro_home["pro_end"]); // tháng
										$ngay = date("j", $rows_toppro_home["pro_end"]); // ngày
									 	$gio = date("G", $rows_toppro_home["pro_end"]); // giờ
									  	$phut = date("i", $rows_toppro_home["pro_end"]); // phút
									   	$giay = date("s", $rows_toppro_home["pro_end"]); //giây								  
								   ?>
                                   <script type="text/javascript">
									  dateFuture<?=$i?> = new Date(<?=$nam?>,<?=$thang-1?>,<?=$ngay?>,<?=$gio?>,<?=$phut?>,<?=$giay?>);				
									</script>
                                    
									<div id="countbox<?=$i?>" style="height:21px"  class="s14"></div>
							</div>
						</div>
						<div class="bottom-left-slide">
							<div class="percent" style="width:210px">
								<div class="inner-percent" style="width:<?=$donguoimua?>%"></div>
							</div>
							<div class="">Chỉ còn lại <strong class="s14 clblue"><?=$rows_toppro_home["pro_quality"] - $rows_toppro_home["pro_coupon"]?></strong> cơ hội!</div>
						</div>
					</div>
					<div class="right-slide">
                       
                        	<?php 
							$select_slidetoppro_home = new db_query("SELECT * FROM pic_pro 
													WHERE pic_pro_id = '$pro_id' AND pic_active = 1 
													ORDER BY pic_id DESC
													LIMIT 1");					
							$rows_slidetoppro_home = mysql_fetch_assoc($select_slidetoppro_home->result);	
							?>
                            <center><a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html"><img src="../pictures/slide_pro/<?=$rows_slidetoppro_home["pic_link"]?>" alt="<?=$rows_slidetoppro_home["pic_link"]?>" style="width:450px;height:300px" /></a></center>
                            <?php 
								unset($select_slidetoppro_home);
							?>                            
                                                                                             
                    </div>
        		</div>               
				<div class="share-facebook" >
                 <div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-like" data-href="http://mienphigiaohang.vn/deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html" data-send="true" data-width="450" data-show-faces="true"></div>
				 <!--    <div class="fb-like" data-href="http://mienphigiaohang.com/deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html" data-send="false" data-width="300" data-show-faces="false"></div>-->
					 <!-- Google++-->
					 <div class="san-pham" id="google style="float:right;margin-top:2px;" >
						<g:plusone size="medium"></g:plusone>
						<script type="text/javascript">
						  (function() {
							var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							po.src = 'https://apis.google.com/js/plusone.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						  })();
						</script>
					</div>
				</div>
          </div>
  </div>
<?php  }	
	unset($select_toppro_home);
?>                                  