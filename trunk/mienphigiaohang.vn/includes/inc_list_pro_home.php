<?php 
		$j=0;
		$select_listpro_home = new db_query("SELECT * FROM products_multi 
													WHERE  pro_active = 1 AND pro_loca = '$city' 
													ORDER BY pro_end DESC , pro_id DESC
													LIMIT 3,15");					
		while($rows_listpro_home = mysql_fetch_assoc($select_listpro_home->result)){
			$thoigianconlai = $rows_listpro_home["pro_end"];
			$thoigianhethong = time();
			$slco = $rows_listpro_home["pro_quality"];
			$slban = $rows_listpro_home["pro_coupon"];			
			$j++;
	?>			
                
                <div class="itemt">
					<div class="icon-itemt"></div>
					<div class="top-itemt">
						<a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_listpro_home["pro_name"]) . '_' . $rows_listpro_home["pro_id"]?>.html"><strong><?=$rows_listpro_home["pro_name"]?>:</strong></a>
                        <a style="text-decoration:none;color:#000;"href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_listpro_home["pro_name"]) . '_' . $rows_listpro_home["pro_id"]?>.html"><?php echo cut_string($rows_listpro_home["pro_shot_title"],100);?></a>
					</div>
					<div class="center-itemt">
						<div class="pic">
                        <center>
							<a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_listpro_home["pro_name"]) . '_' . $rows_listpro_home["pro_id"]?>.html"><img src="../pictures/thumbnail/<?=$rows_listpro_home["pro_picture"]?>" style="max-width:286px; max-height:190px;"  alt="pic" /></a></center>
						</div>
						<div class="tranfer-itemt clearfix">
							<div class="fl"><strong class="clgreen">Free Shiping</strong><!--<strong class="clgreen"><?=$rows_listpro_home["pro_discount"]?>%</strong>--></div>
							<div class="fr"><strong class="clgreen"><?=$rows_listpro_home["pro_coupon"]?></strong> Người mua </div> 
						</div>
						<div class="view">
							<span class="price1"><?=number_format($rows_listpro_home["pro_price_deal"],0,"",".")?></span> <span class="price2">vnđ</span> <a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows_listpro_home["pro_name"]) . '_' . $rows_listpro_home["pro_id"]?>.html" class="btn-view">&nbsp;</a>
						</div>
					</div>
					<div class="bottom-itemt clearfix">
						<!--<div class="fl">Giá gốc:<br /><strong><?=number_format($rows_listpro_home["pro_price_merchant"],0,"",".")?> vnđ</strong></div>-->
						<div class="fl"> Free Ship<br/> <strong><?=number_format($rows_listpro_home["pro_price_merchant"],0,"",".")?> vnđ </strong></div>
<div class="fr">
<?php 								  
	$nn = date("Y", $rows_listpro_home["pro_end"]); // năm
	$tt= date("n", $rows_listpro_home["pro_end"]); // tháng
	$ng = date("j", $rows_listpro_home["pro_end"]); // ngày
	$gi = date("G", $rows_listpro_home["pro_end"]); // giờ
	$ph = date("i", $rows_listpro_home["pro_end"]); // phút
	$se = date("s", $rows_listpro_home["pro_end"]); //giây								  
?>
<script type="text/javascript">
  datecount<?=$j?> = new Date(<?=$nn?>,<?=$tt-1?>,<?=$ng?>,<?=$gi?>,<?=$ph?>,<?=$se?>);				 
  </script>

<?php 
	if($slban >= $slco || $thoigianconlai < $thoigianhethong)
		{
?>
	  <img src="../images/hethanbtn.png" width="104" height="34" border="0" /><br />
<?php }else{?>
			Thời gian còn lại: <br />
<div id="counttime<?=$j?>" style="height:21px"  class="s14"></div>
<?php }?>
</div>
					</div>
				</div>			
<?php }
	unset($select_listpro_home);
?>                
