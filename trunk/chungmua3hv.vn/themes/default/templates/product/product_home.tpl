
<!-- 2 deal hot tren -->
<div class="mb-wrapper">
<div class="mb-top-home">
      <div class="mbt-l"></div>
      <div class="mbt-m-home"></div>
      <div class="mbt-r"></div>
      <div class="clear"></div>
   </div>
   <div class="mb-mid-home">
      <div class="coupon-title-home">
      <p style="float: left;font-size:18px; text-transform:uppercase;">Deal HOT hôm nay</p>
</div>
     
</div>
      <div class="clear"></div>
      </div>
      <div class="wrap-top">
      {section loop=$product_item_home max=2  name=foo}
<form action="?mod=product&task=baokim" method="post">
<input type="hidden" value="{$product_item_home[foo].Product_ID}" name="productID"/>
 <div class="wrap-top-deal" {if $smarty.section.foo.index%2==0}style=" margin-right:10px;"{/if}>



<div class="wrap-top-deal-img"><a title="{$product_item_home[foo].Product_Name}" href="san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html"><img class="" src="upload/product/{$product_item_home[foo].Product_Photo}" /></a>
  <div class="wrap-top-deal-percent">
<span>Giảm</span>
<span style="font-size: 20px; font-weight: bolder; margin-left: 5px;">{$product_item_home[foo].Product_Price-$product_item_home[foo].Product_DealPrice|percent:$product_item_home[foo].Product_Price}%</span></div>
<div class="block_2_home_top" style="display: none;">
 {literal}
<script>
var launchDate = new Date("{/literal}{$product_item_home[foo].Product_EndDate|echo_date:'F d,Y H:i:s'}{literal}");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,'down{/literal}{$product_item_home[foo].Product_ID}{literal}');
</script>{/literal}

 
  <div class="bl2-mid-home" id="down{$product_item_home[foo].Product_ID}" align="center">
            <p class="middle-white">Thời hạn mua còn:&nbsp;</p>
      <div class="time-remain">
         <div class="days"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="hours"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="minutes"><label class="number">00</label></div>
      </div>
      <table width="90%">
         <tbody><tr>
            <td align="center" width="33%">Ngày</td>
            <td align="center" width="33%">Giờ</td>
            <td align="center" width="33%">Phút</td>
         </tr>
      </tbody></table>
         </div>
</div>

 <div class="wrap-top-deal-buynow" style="display: none;"><a title="{$product_item_home[foo].Product_Name}" href="san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html"></a></div>
<div class="wtd_bg_numberorder"></div>

</div>
<div class="wtd_title">
<p><a title="{$product_item_home[foo].Product_Name}" href="san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html" style="color: rgb(51, 51, 51); margin: 6px 0px;">{$product_item_home[foo].Product_Deal}</a></p>
<div style="font-size:12px; font-family:Arial, Helvetica, sans-serif; height:40px; overflow-y:hidden">{$product_item_home[foo].Product_Description}</div>

</div>
<div class="wrap-top-deal-info">
<div class="wrap-top-deal-buy">
<div class="wrap-top-deal-price"><span>{$product_item_home[foo].Product_DealPrice|number_format}&nbsp;đ</span></div>
<div class="wrap-top-deal-percen">
<span style="color: #333333;">{$product_item_home[foo].Product_Price|number_format}&nbsp;đ</span>
</div>
<div class="clear"></div>
</div>
<!--button buy-->
<div class="wtdi_loantin">
 <div class="dealPriceHome">
                    	
                 	                   <a href="mua-hang.php?ID={$product_item_home[foo].Product_ID}"></a>
                 	                    <div class="baokim">
                 	                      <div style="background-image:url(https://www.baokim.vn/promote/paymentbk.png);width:180px;height:50px;margin-left:-4px;margin-bottom:0px">
                 	                        <div style="padding-top:5px;margin-left:40px">
                 	                          
                 	                          <input style="background-color: rgb(120, 171, 42); border: medium none; color: rgb(255, 255, 255); font-size: 14px; height: 41px; padding-bottom: 10px; font-weight: bold; width: 130px;" id="target" name="submit" value="Mua Trực Tuyến" type="submit">
               	                            </div>
                 <div style="font-size:11px;margin-left:75px;color:#FFF;margin-top:-14px">Tích lũy : <b>{$product_item_home[foo].Product_DealPrice/100|number_format}</b> đ  </div>
   					                      </div>
    									 </div> 
                                                                             
     </div>
 <!--end button buy-->                 
<div class="clear"></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div style="border-top: dotted 1px #e3e3e3; padding-top: 7px; margin-top: 5px;">
<div class="wtdi_transpost" align="center">
<p style="color:#333333; margin-top:2px;"> <iframe src="http://www.facebook.com/plugins/like.php?href={$smarty.const.SITE_URL}san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:60px"></iframe></p></div>
<div style="float: right;">
<p class="wtd_numberorder">Có&nbsp;<span style="font-size: 14px;font-weight: bold;color: #ff0000; ">{$product_item_home[foo].Product_Buy|default:0}</span>&nbsp;người đặt mua</p>
</div>
</div>
</div>
</div></form>{/section}


<div class="clear">
</div>
      </div>    
      <div class="mb-bot-home">
      <div class="mbb-l"></div>
      <div class="mbb-m-home"></div>
      <div class="mbb-r"></div>
      <div class="clear"></div>
   </div>
<!-- End 2 deal hot tren -->
    </form>

    <!-- Cac deal khac dang luoi -->
<div class="mb-wrapper">
<div class="mb-top-home">
      <div class="mbt-l"></div>
      <div class="mbt-m-home"></div>
      <div class="mbt-r"></div>
      <div class="clear"></div>
   </div>
   <div class="mb-mid-home">
   <a id="filter_deal"></a>
<div class="wrap-bottom-nav">
<a id="tab_menu_deal"></a>
<ul class="wrap-bottom-ul">
<li class="wrap-bottom-ul-all wrap-bottom-ul-all-active"><a><span>Tất cả Deal</span></a></li>
<li class="wrap-bottom-ul-buy "><a href="dang-giam-gia.html"><span>Đang giảm giá</span></a></li>
<div class="clear"></div>
</ul>



<div class="clear"></div>
</div>
<div class="wrap-bottom-list">
      {section loop=$product_item_home start=2  name=foo}
<form action="?mod=product&task=baokim" method="post">
<input type="hidden" value="{$product_item_home[foo].Product_ID}" name="productID"/>

<div class="wrap-bottom-deal">
<div class="wrap-bottom-deal-img">
<a title="{$product_item_home[foo].Product_Deal}" href="san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html"><img  src="upload/product/{$product_item_home[foo].Product_Photo}"></a>
<div class="wrap-bottom-deal-buynow" style="display: none;"><a title="{$product_item_home[foo].Product_Deal}" href="san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html"></a></div>
      
      <div class="like-block-bottom"></div>
            
<div class="wrap-bottom-deal-percent">
<span>Giảm</span>
<span style="margin-top: 0px; font-size: 18px;">{$product_item_home[foo].Product_Price-$product_item_home[foo].Product_DealPrice|percent:$product_item_home[foo].Product_Price}%</span></div>
<div class="block-2-home" style="display: none;">
 {literal}
<script>
var launchDate = new Date("{/literal}{$product_item_home[foo].Product_EndDate|echo_date:'F d,Y H:i:s'}{literal}");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,'down{/literal}{$product_item_home[foo].Product_ID}{literal}');
</script>{/literal}

 
  <div class="bl2-mid-home" id="down{$product_item_home[foo].Product_ID}" align="center">
            <p class="middle-white">Thời hạn mua còn:&nbsp;</p>
      <div class="time-remain">
         <div class="days"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="hours"><label class="number">00</label></div>
         <div class="dot-dot">:</div>
         <div class="minutes"><label class="number">00</label></div>
      </div>
      <table width="90%">
         <tbody><tr>
            <td align="center" width="33%">Ngày</td>
            <td align="center" width="33%">Giờ</td>
            <td align="center" width="33%">Phút</td>
         </tr>
      </tbody></table>
         </div>
</div>
</div>
<div class="wbd_title">
<p><a title="{$product_item_home[foo].Product_Name}" href="san-pham-{$product_item_home[foo].Product_ID}/{$product_item_home[foo].Product_LinkName}.html" style="color: rgb(51, 51, 51); margin: 6px 0px;">{$product_item_home[foo].Product_Deal}</a></p>
<div style="font-size:12px; font-family:Arial, Helvetica, sans-serif; height:40px; overflow-y:hidden">{$product_item_home[foo].Product_Description}</div>
</div>
<div class="wrap-bottom-deal-info">
<div class="wrap-bottom-deal-buy">
<div class="wrap-top-deal-price"><span>{$product_item_home[foo].Product_DealPrice|number_format}đ</span></div>
<div class="wrap-top-deal-percen"><span>{$product_item_home[foo].Product_Price|number_format}đ</span></div>
<div class="clear"></div>
</div>
<div class="wbdi_loantin">
  <div class="dealPriceHome-list"> <a title="{$product_item_home[foo].Product_Name}" href="mua-hang.php?ID={$product_item_home[foo].Product_ID}"></a>
                    <div class="baokim-list">
          <div style="background-image:url(themes/default/images/baokim_03.png);width:80px;height:42px;margin-left:-4px;margin-bottom:0px;">
            <div style="padding-top:5px;margin-left:27px">
              <input style="background-color: rgb(120, 171, 42); border: medium none; color: rgb(255, 255, 255); font-size: 10px; height: 12px; padding-bottom: 9px; width: 50px;" id="target2" name="target" value="Tích lũy" type="submit" />
            </div>
            <div style="font-size:10px;margin-left:37px;color:#FFF;margin-top:5px"> <b>4,300</b> đ </div>
          </div>
        </div>
    </div>
<div class="clear"></div>

</div>
<div class="clear"></div>
<div style="border-top: dotted 1px #e3e3e3; margin-top: 4px;">
<div class="wbdi_transpost" style="margin-top: 5px;" align="center">
</div>
<div style="float: right; margin-top: 6px;">
<p class="wtd_numberorder">Có&nbsp;<span style="font-size: 14px;font-weight: bold; color: #ff0000;">{$product_item_home[foo].Product_Buy|default:0}</span>&nbsp;người đặt mua</p>
</div>
</div>
</div>

</div></form>{/section}



<div class="clear"></div>
</div>
</div>
   <div class="mb-bot-home">
      <div class="mbb-l"></div>
      <div class="mbb-m-home"></div>
      <div class="mbb-r"></div>
      <div class="clear"></div>
</div>
</div>
