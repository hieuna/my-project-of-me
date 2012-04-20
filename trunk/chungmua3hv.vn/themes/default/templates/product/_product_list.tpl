{if $product_item_list}{foreach from=$product_item_list item=oProduct}<div class="dealBox">
            	<a title="{$oProduct.Product_Deal}" href="san-pham-{$oProduct.Product_ID}/{$oProduct.Product_LinkName}.html" class="dealTitle"><span>{if $oProduct.DestinationID}{$oProduct.DestinationID}{else} Toàn quốc {/if}:</span>{$oProduct.Product_Name}</a>

                    <div class="clr"></div>
                <div class="dealLeft">
                	<div class="dealPrice">{$oProduct.Product_DealPrice|number_format} đ <a href="mua-hang.php?ID={$oProduct.Product_ID}"></a></div>
                    <div class="dealPriceRight"></div>
                    <div class="featurePrice02"> 
                        <div class="featureValue">Giá trị<p>{$oProduct.Product_Price|number_format} đ</p></div>
                        <div class="featureSave">Tiết kiệm<p>{$oProduct.Product_Price-$oProduct.Product_DealPrice|number_format} đ</p></div>

                    </div>
                	<div class="featureTime">
                    	<div class="timeTitle">THÒI GIAN CÒN LẠI</div>
{literal}
<script>
var launchDate = new Date("{/literal}{$oProduct.Product_EndDate|echo_date:'F d,Y H:i:s'}{literal}");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,'down{/literal}{$oProduct.Product_ID}{literal}');
</script>{/literal}

                        <p><div class="countdownTimer" id="down{$oProduct.Product_ID}">
						<div class="days">
							<label class="number">00</label> Ngày, </div>
						<div class="hours">
							<label class="number">00</label> Giờ</div>
						<div class="minutes">
							<label class="number">00</label> Phút</div>
						<div class="seconds">
							<label class="number">00</label> Giây</div>
					</div></p>
                    <div class="clear"></div>
                        <span>(Tức {$oProduct.Product_EndDate|fulldate})</span>
                    </div>
                	<div class="featureBought">

                    	<div class="boughtTitle">Đã có <span>{$oProduct.Product_Buy|default:0}</span> người mua</div>
                        <div class="boughtBar"><div class="boughtPercent" style="width:{$oProduct.Product_Buy|default:0|percent:$oProduct.Product_Quantity|default:1}%"></div></div>
                        <div class="boughtStatus">Còn <span>{$oProduct.Product_Quantity-$oProduct.Product_Buy|default:0}/{$oProduct.Product_Quantity|default:0}</span> phiếu</div>
                    
                    <b>{if $oProduct.Product_Buy >= $oProduct.Product_Minimun} Đã đạt đủ số lượng để có giá tốt {else}
                    Cần có thêm {$oProduct.Product_Minimun-$oProduct.Product_Buy|default:0} người mua nữa để đạt giá tốt
                    {/if}</b>
                    </div>
                    <div class="pageView">Lượt xem: <span>{$oProduct.Product_NumberView|number_format}</span></div>

                  {*  <div class="share">{literal}
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style " addthis:title="{Title}" addthis:url="{Permalink}">
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_4"></a>
    <a class="addthis_button_compact"></a>
    <a class="addthis_counter addthis_bubble_style"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e715fd827ed25a2"></script>
    <!-- AddThis Button END -->
    {/literal}</div>*}
                    <div class="dealBottom">
                    	<!--BUTTON XEM CHI TIET-->
                    	<a href="san-pham-{$oProduct.Product_ID}/{$oProduct.Product_LinkName}.html" class="viewDetail">XEM CHI TIẾT +</a>
                    </div>
                </div>
            	<div class="dealRight">
                    <div class="dealImage">

                    	<a href="san-pham-{$oProduct.Product_ID}/{$oProduct.Product_LinkName}.html"><img src="upload/product/{$oProduct.Product_Photo}" alt=""/></a>
                    </div>
                    <div class="dealHomeContent">
                        <p>
                        {$oProduct.Product_Description}</p>
                                           <p> <iframe src="http://www.facebook.com/plugins/like.php?href={$smarty.const.SITE_URL}san-pham-{$oProduct.Product_ID}/{$oProduct.Product_LinkName}.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe></p> </div>
                </div>
                <div class="dealLabel"><span>GIẢM</span><br />{$oProduct.Product_Price-$oProduct.Product_DealPrice|percent:$oProduct.Product_Price}%</div>
                <div class="clr"></div>     
                
            </div>
            {/foreach}
            {else}
            Chưa có dữ liệu
            {/if}