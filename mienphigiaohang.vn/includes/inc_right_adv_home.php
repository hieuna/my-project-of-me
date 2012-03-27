<?php if($city==1){?>
<div class="ad"  style="margin-top:10px">
				

					<div class="title-ad">
						<img src="../images/bg-ad.png" width="210" height="15" alt="ad" />
					</div>
                <?php 
					$select_banner_right = new db_query("SELECT * FROM banners_multi WHERE ban_location = 2 AND ban_active = 1 ORDER BY ban_id DESC
                                    LIMIT 2");					
					while($rows_banner_right = mysql_fetch_assoc($select_banner_right->result)){
				?>
					<div class="item-ad" align="center">
						<a href="<?=$rows_banner_right["ban_link"]?>" target="_blank"><img src="../pictures/banners/<?=$rows_banner_right["ban_picture"]?>"  style="max-width:206px;" alt="<?=$rows_banner_right["ban_picture"]?>" title="<?=$rows_banner_right["ban_des"]?>" /></a>
					</div>
                 <?php }
				  unset($select_banner_right);
				 ?>
</div>
<?php } else if($city==2){?>
<div class="ad"  style="margin-top:10px">
				

					<div class="title-ad">
						<img src="../images/bg-ad.png" width="210" height="15" alt="ad" />
					</div>
               <!--
					<div class="item-ad" align="center">
						<iframe width="206" height="465" src="http://raovatdoanhnghiep.yutoweb.net/ads.aspx" frameborder="0" scrolling="no" ></iframe>

					</div>          -->     
</div>
<?php }?>
<div align="center"><a target="_blank" href="http://mienphigiaohang.com/deals/huong-dan-thanh-toan.html"><img width="202" height="250" border="0" align="middle" src="http://mienphigiaohang.com/images/cachthanhtoan.jpg" /></a></div>
<div style="margin-top:15px;" align="center"><a target="_blank" href="https://sohapay.com/info/help/huong-dan-thanh-toan.html"><img width="160" border="0" align="middle" src="https://sohapay.com/images/merchant/logo_merchant1.png" /></a></div>
<div style="margin-top:15px;" align="center"><a target="_blank" href="https://www.baokim.vn/payment_guide/mienphigiaohangcom.html"><img width="176" height="105" border="0" align="middle" src="https://www.baokim.vn/application/uploads/buttons/hung-dan-thanh-toan---banner.jpg" /></a></div>

