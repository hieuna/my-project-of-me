<?php
        $pro_id = getValue("id","int","GET",0);
        $select_pro = new db_query(" SELECT *
									 FROM products_multi									 
									 WHERE  pro_id = " . $pro_id);
        $rows = mysql_fetch_assoc($select_pro->result);		
			$i++;
			$dis = $rows["pro_price_merchant"] - $rows["pro_price_deal"];
			if($rows["pro_coupon"] >= $rows["pro_quality"]){$donguoimua=100;}
			else if($rows["pro_coupon"]==0 || $rows["pro_coupon"] == ""){$donguoimua=0;}
			else{
			$donguoimua = 100 - ($rows["pro_quality"] - $rows["pro_coupon"])*100/$rows["pro_quality"];}
			
			$thoigianconlai = $rows["pro_end"];
			$thoigianhethong = time();
			$slco = $rows["pro_quality"];
			$slban = $rows["pro_coupon"];
      
        ?>
<script type="text/javascript">
window.onload=function(){
	 GetCount(dateFuture1, 'countbox1');
	 GetCount(dateFuture1, 'countbox2');
	};
</script>
<script type="text/javascript">
	$(function(){	
		$("#slide_detail").vSlider();			
		});
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="box"><div class="count">1</div>
					<div class="slideshow">
				<h2 class="title-box clearfix"><strong class="clorange"><?=$rows["pro_name"]?>: </strong> <?=$rows["pro_shot_title"]?></h2>
        		<div class="slide-thumbs clearfix">
					<div class="left-slide">
                        <div class="price"> <div class="icon-price"></div>
							<span class="price1"><?=number_format($rows["pro_price_deal"],0,"",".")?></span> <span class="price2">vnđ</span> 
                            <?php 
							if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
							?>
                             <a class="btn-buy" href="#" style="margin-top:15px" onclick="alert('Chương trình cho sản phẩm này đã hết, bạn không thể đặt hàng .');">&nbsp;</a>
                            <?php }else{?>
                           <a class="btn-buy" style="margin-top:15px" href="../deals/thanh-toan-san-pham-<?=$rows["pro_id"]?>.html">&nbsp;</a>
                            <?php }?>
                            
						</div>
						<div class="center-left-slide"><div class="shadow"></div>
							<div class="compare-price clearfix">
								<div class="compare-item begin-item">
									<div class="style-top">Phí Ship </div>
									<div class="style-bottom"><?=number_format($rows["pro_price_merchant"],0,"",".")?> vnđ</div>
								<!--	<div class="style-top">Giá gốc</div>
									<div class="style-bottom"><?//=number_format($rows["pro_price_merchant"],0,"",".")?> vnđ</div>
								-->	
								</div>
								<div class="compare-item center-item">
									<div class="style-top"><strong>Free Shiping</strong></div>
									<!--<div class="style-bottom"><?=$rows["pro_discount"]?>%</div>-->
								</div>
								<div class="compare-item last">
									<div class="share-link clearfix">
										<p> Cùng chia sẻ </p>
										<a class="icon-facebook" href="http://www.facebook.com/MienPhiGiaoHang">&nbsp;</a>
										<a class="icon-youtube" href="http://www.youtube.com/mienphigiaohang">&nbsp;</a>
										<a class="icon-z" href=" http://twitter.com/MienPhiGiaoHang">&nbsp;</a>
									</div>
								<!--
									<div class="style-top">Tiết kiệm</div>
									<div class="style-bottom"><?=number_format($dis,0,"",".")?> vnđ</div>
									-->
								</div>
							</div>
							<div class="point">
								<div class="number-point"><?=$rows["pro_coupon"]?></div>
								 <div class="buyer"><i>Người mua</i></div>
							</div>
							<div class="time-end">
									
                                      <?php 								  
										$nam = date("Y", $rows["pro_end"]); // năm
								  		$thang= date("n", $rows["pro_end"]); // tháng
										$ngay = date("j", $rows["pro_end"]); // ngày
									 	$gio = date("G", $rows["pro_end"]); // giờ
									  	$phut = date("i", $rows["pro_end"]); // phút
									   	$giay = date("s", $rows["pro_end"]); //giây								  
								   ?>
                              <script type="text/javascript">
									  dateFuture1 = new Date(<?=$nam?>,<?=$thang-1?>,<?=$ngay?>,<?=$gio?>,<?=$phut?>,<?=$giay?>);				 
									  </script>
                                       <?php 
							if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
							?>
                              <img src="../images/hethanbtn.png" width="104" height="34" border="0" /><br />
<?php }else{?>
                          			<span >Thời gian còn lại:</span><br />
							  <div id="countbox1" style="height:21px" class="s14"></div>
                            <?php }?>
                                    
                                 
                                   
                              		
                          </div>
						</div>
						<div class="bottom-left-slide">
							<div class="percent" style="width:210px">
                             <?php 
							if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
							?>
                            <div class="inner-percent-red" style="width:100%;"></div>
<?php }else{?>
                          			<div class="inner-percent" style="width:<?=$donguoimua?>%"></div>
                            <?php }?>
                            
								
							</div>
                             <?php 
							if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
							?>
                             <div class=""><strong class="s14 clblue">Hết cơ hội!</strong></div>
<?php }else{?>
                          			<div class="">Chỉ còn lại <strong class="s14 clblue"><?=$rows["pro_quality"] - $rows["pro_coupon"]?></strong> cơ hội!</div>
                            <?php }?>
                            
                            
							
						</div>
					</div>
                    
					<div class="right-slide" >
                    
                                <ul id="slide_detail">
                                
                                <?php 
                                $select_slide_detail = new db_query("SELECT * FROM pic_pro 
                                                        WHERE pic_pro_id = '$pro_id' AND pic_active = 1 
                                                        ORDER BY pic_id DESC
                                                        LIMIT 5");					
                                while($rows_slide_detail = mysql_fetch_assoc($select_slide_detail->result)){	
								
								
                                ?>
                                
                                <li><center>
                                <?php 
								//echo khi hết hạn hoặc hét hàng
								
								if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
								?>
                                <div class="chayhang"> HẾT HẠN </div>
                                <?php }?>
                                <a><img src="../pictures/slide_pro/normal_<?=$rows_slide_detail["pic_link"]?>" alt="<?=$rows_slide_detail["pic_link"]?>" style="width:450px;height:300px" /></a></center></li>
                                <?php  }	
                                    unset($select_slide_detail);
                                ?>                            
                            </ul>   
                        </div>
        		</div>
				<div class="share-facebook">
                		
						<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-like" data-href="http://mienphigiaohang.vn/deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows["pro_name"]) . '_' . $rows["pro_id"]?>.html" data-send="true" data-width="450" data-show-faces="true"></div>
				<!--		<div class="fb-like" data-href="http://mienphigiaohang.com/deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_toppro_home["pro_name"]) . '_' . $rows_toppro_home["pro_id"]?>.html" data-send="false" data-width="300" data-show-faces="false"></div>					-->
						<div class="san-pham" id="google" style="float:right;margin-top:2px;">
									<!-- Đặt thẻ này ở nơi bạn muốn nút +1 hiển thị -->
									<g:plusone size="medium"></g:plusone>

									<!-- Đặt cuộc gọi hiển thị này ở nơi thích hợp -->
									<script type="text/javascript">
									  (function() {
										var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
										po.src = 'https://apis.google.com/js/plusone.js';
										var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
									  })();
									</script>
						</div>
				</div>
				<div class="box-module nopad clearfix">
					<div class="icon-module-left"></div><div class="icon-module-right"></div>
					<div class="col1">
						<div class="box-item">
						<div class="title-module">
						<h3>Điểm nổi bật</h3>
						</div>
						<div class="box-item-cont clearfix">
							<div class="detail1">
								<?=$rows["pro_special"]?>
							</div>
						</div>
						</div>
					</div>
					<div class="col2 last">
						<div class="box-item">
						<div class="title-module">
						<h3>Hướng dẫn mua hàng</h3>
						</div>
						<div class="box-item-cont clearfix">
							<div class="detail1">
									<?=$rows["pro_dieukien"]?>							
                            </div>
						</div>
						</div>
					</div>
				</div>
				<div class="box-module nopad bottom clearfix">
					<div class="icon-module-left"></div><div class="icon-module-right"></div>
		<!--			<div class="col1 hd">
						<div class="box-item">
							<div class="title-module">
								<h3 class="nobor">Bản đồ</h3>
							</div>
							<div class="box-item-cont clearfix">
								<script src="../js/jquery-1.4.2.min"></script>
								<script src="../js/map.js"></script>							
									<form  action="" name="adminForm" id="adminForm" > 
										<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
										<input type="hidden" name="lat" id="lat" value="0" />
										<input type="hidden" name="long" id="long" value="0" />
										<input type="hidden" name="default_gmap_address" id="default_gmap_address" value="<?=$rows["pro_gmap"]?>" />
										<div>
											<div id="load_gmap"	style="width: 696px; height: 300px; border: 1px solid #cdcdcd; margin: 0 auto;"></div>
										</div>
									</form>                            
							</div>
                            
						</div>
					</div> -->
					<!--
					<div class="col1 let">
						<div class="box-item" style="padding-left:20px">
						<div class="title-module">
						<h3>Địa chỉ đổi voucher</h3><div class="drop-style"></div>
						</div>
						<div class="box-item-cont clearfix">
							<?=$rows["pro_address"]?>	
						</div>
						</div>
					</div>
					-->
					<div class="clear"></div>
					<div class=" detail-style clearfix">
						<div class="title-module">
						<h3>Thông tin sản phẩm</h3>
						</div>
							<?=$rows["pro_description"]?>
					</div>
					
					<div class="col1 hd">
						<div class="box-item">
							<div class="title-module">
								<h3 class="nobor">Bản đồ</h3>
							</div>
							<div class="box-item-cont clearfix">
								<script src="../js/jquery-1.4.2.min"></script>
								<script src="../js/map.js"></script>							
									<form  action="" name="adminForm" id="adminForm" > 
										<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
										<input type="hidden" name="lat" id="lat" value="0" />
										<input type="hidden" name="long" id="long" value="0" />
										<input type="hidden" name="default_gmap_address" id="default_gmap_address" value="<?=$rows["pro_gmap"]?>" />
										<div>
											<div id="load_gmap"	style="width: 696px; height: 300px; border: 1px solid #cdcdcd; margin: 0 auto;"></div>
										</div>
									</form>                            
							</div>
                            
						</div>
					</div>
					<div class="clear"></div>
					<div class="tool clearfix">
                    	
						<div class="fl">
							<a class="icon-comment" href="<?php if($city == 1){echo '../deals/ha-noi-binh-luan-san-pham-'.$pro_id.'.html';}else if($city == 2){echo '../deals/ho-chi-minh-binh-luan-san-pham-'.$pro_id.'.html';}?>"><strong>Xem bình luận</strong></a>
						</div>
						<div class="fr">
							<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style ">
							<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
							<a class="addthis_button_tweet"></a>
							<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
							<a class="addthis_counter addthis_pill_style"></a>
							</div>
							<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ef7f6d579000458"></script>
							<!-- AddThis Button END -->
						</div>
						
					</div>
				</div>
				</div>
        		</div>
				<div class="box">
				<div class="price-style clearfix">
					<div class="view">
							<span class="price1"><?=number_format($rows["pro_price_deal"],0,"",".")?></span> <span class="price2">vnđ</span> 					<?php 
							if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
							?>
                             <a class="btn-buy" href="#" onclick="alert('Chương trình cho sản phẩm này đã hết, bạn không thể đặt hàng .');">&nbsp;</a>
                            <?php }else{?>
                            <a class="btn-buy" href="../deals/thanh-toan-san-pham-<?=$rows["pro_id"]?>.html">&nbsp;</a>
                            <?php }?>
						</div>
				<div class="compare-price clearfix">
						<div class="compare-item begin-item">
							<div class="style-top1">Người mua</div>
							<div class="style-bottom1"><strong class="clorange"><?=$rows["pro_coupon"]?></strong> người</div>
						</div>
						<div class="compare-item center-item">
							<div class="style-top"><strong>Free Shiping</strong></div>
				<!--			<div class="style-bottom"><?=number_format($rows_toppro_home["pro_price_merchant"],0,"",".")?> vnđ</div> -->
							<div class="style-bottom"><//?=$rows["pro_discount"]?><!--%--></div>
						</div>
						<div class="compare-item last">
                        
                        <?php 
							if($slban >= $slco || $thoigianconlai < $thoigianhethong)
								{
							?>
                             <div class="style-top1"><img src="../images/hethanbtn.png" width="104" height="34" border="0" /></div>
							<div class="style-bottom1"></div>
							<?php }else{?>
							<div class="style-top1">Thời gian còn lại:</div>
							<div class="style-bottom1"><div id="countbox2"  class="s14"></div></div>
                            <?php }?>
							
						</div>
					</div>
				</div>
				</div>	
                
                