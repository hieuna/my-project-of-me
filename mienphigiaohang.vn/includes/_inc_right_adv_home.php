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