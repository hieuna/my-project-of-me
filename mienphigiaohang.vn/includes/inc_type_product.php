<?php
require_once("../functions/pagebreak.php");
$current_page 			= 	1;
$page_size 				=	12;
$current_page 			= 	getValue("page");
if ($current_page < 1) $current_page=1;
if ($current_page >= 100) $current_page=100;
$normal_class 			= "";
$selected_class 		= "active";
$page_prefix 			= "Trang: ";
if($cat_id == ""){
	if($city==1){
	$url		 			= "../deals/san-pham-ha-noi";
	}
	else if($city==2){
	$url		 			= "../deals/san-pham-ho-chi-minh";
		}
$db_count 		= new db_query ("SELECT Count(*) AS count
								FROM products_multi
								WHERE pro_active = 1 AND pro_loca = '$city'");
}
else
{
if($city==1){
	$url		 			= "../deals/san-pham-ha-noi&cat_id=".$cat_id;;
	}
	else if($city==2){
	$url		 			= "../deals/san-pham-ho-chi-minh&cat_id=".$cat_id;;
		}

$db_count 		= new db_query ("SELECT Count(*) AS count
								FROM products_multi
								WHERE pro_active = 1 AND pro_loca = '$city' AND pro_category_id = '$cat_id'");
	}

$row_count 		= mysql_fetch_array($db_count->result);
$total_record 	= $row_count['count'];
$db_count->close();
unset($db_count);

if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;

if($total_record <= 0 || $current_page > $num_of_page ) echo "Chưa có sản phẩm nào";
//die($total_record);
?>
<!--phantrang-->     
<?php
if($total_record>$page_size){
?>
<div class="fillter clearfix">
	<ul class="paging">    	
			<?=generatePageBar_deal($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>       
    </ul>
</div>
<?
}
?>
<!--endphantrang-->            
<div class="itemts">
            
<?php
$i=0;
if($cat_id == ""){
$select = new db_query("    SELECT *
                            FROM products_multi
                            WHERE pro_active = 1  AND pro_loca = '$city' 
                            ORDER BY pro_end DESC , pro_id  DESC LIMIT " . ($current_page-1) * $page_size . "," . $page_size . "");
}
else
{
	$select = new db_query("    SELECT *
                            FROM products_multi
                            WHERE pro_active = 1 AND pro_category_id = '$cat_id'  AND pro_loca = '$city' 
                            ORDER BY pro_end DESC , pro_id DESC LIMIT " . ($current_page-1) * $page_size . "," . $page_size . "");
	}
while($rows = mysql_fetch_assoc($select->result))
{   
			$thoigianconlai = $rows["pro_end"];
			$thoigianhethong = time();
			$slco = $rows["pro_quality"];
			$slban = $rows["pro_coupon"];
	$i++;
	?>
	<div class="itemt">
					<div class="icon-itemt"></div>
					<div class="top-itemt">
						<a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows["pro_name"]) . '_' . $rows["pro_id"]?>.html"><strong><?=$rows["pro_name"]?>:</strong></a>
                        <a style="text-decoration:none;color:#000" href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows["pro_name"]) . '_' . $rows["pro_id"]?>.html"><?php echo cut_string($rows["pro_shot_title"],100);?></a>
					</div>
					<div class="center-itemt">
						<div class="pic">
                        <center>
							<a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows["pro_name"]) . '_' . $rows["pro_id"]?>.html"><img src="../pictures/thumbnail/<?=$rows["pro_picture"]?>" style="max-width:286px; max-height:190px;"  alt="pic" /></a></center>
						</div>
						<div class="tranfer-itemt clearfix">
							<div class="fl"><strong class="clgreen">Free Shiping</strong> <!--<strong class="clgreen"><?=$rows["pro_discount"]?>%</strong>--></div>
							<div class="fr"><strong class="clgreen"><?=$rows["pro_coupon"]?></strong> Người mua </div> 
						</div>
						<div class="view"> <!--giá thực-->
							<span class="price1"><?=number_format($rows["pro_price_deal"],0,"",".")?></span> <span class="price2">vnđ</span> <a href="../deals/<?php if($city == 1){echo 'ha-noi';} else if($city == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($rows["pro_name"]) . '_' . $rows["pro_id"]?>.html" class="btn-view">&nbsp;</a>
						</div>
					</div>
					<div class="bottom-itemt clearfix">
						<!--<div class="fl">Giá gốc:<br /><strong><?=number_format($rows["pro_price_merchant"],0,"",".")?> vnđ</strong></div>-->
						<div class="fl"> Phí Ship <br/> <strong><?=number_format($rows["pro_price_merchant"],0,"",".")?> vnđ</strong></div>
<div class="fr">
<?php 								  
	$ye = date("Y", $rows["pro_end"]); // năm
	$mo= date("n", $rows["pro_end"]); // tháng
	$da = date("j", $rows["pro_end"]); // ngày
	$ho = date("G", $rows["pro_end"]); // giờ
	$min = date("i", $rows["pro_end"]); // phút
	$sec = date("s", $rows["pro_end"]); //giây								  
?>
<script type="text/javascript">
  datecount<?=$i?> = new Date(<?=$ye?>,<?=$mo-1?>,<?=$da?>,<?=$ho?>,<?=$min?>,<?=$sec?>);				 
  </script>
<?php 
	if($slban >= $slco || $thoigianconlai < $thoigianhethong)
		{
?>
	  <img src="../images/hethanbtn.png" width="104" height="34" border="0" /><br />
<?php }else{?>
			Thời gian còn lại: <br />
<div id="counttime<?=$i?>" style="height:21px"  class="s14"></div>
<?php }?>

</div>
					</div>
				</div>			
<?php }
?>            				
				
</div>
    </div> 
    <script type="text/javascript">
window.onload=function(){	
	<?php for($t=1;$t <= $i; $t++ ) {?>
	GetCount(datecount<?php echo $t;?>, 'counttime<?php echo $t;?>');
	<?php }?>
	};
</script>       
<!--phantrang-->     
<?php
if($total_record>$page_size){
?>
<div class="fillter clearfix">
	<ul class="paging">    	
			<?=generatePageBar_deal($page_prefix,$current_page,$page_size,$total_record,$url,$normal_class,$selected_class);?>       
    </ul>
</div>
<?
}
?>
<!--endphantrang-->