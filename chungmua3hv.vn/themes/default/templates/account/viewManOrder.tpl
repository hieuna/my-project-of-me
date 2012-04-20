
    	<div id="pageCenter">
            <div class="orderLeft">
            	<img src="{$smarty.const.SITE_URL}themes/default/images/memberinfo.jpg"/>
                <p>Tên: {$info.Ac_name}</p>
                <p>Email: {$info.Ac_email}</p>
                <p>SĐT: {$info.Ac_phone}</p>
            </div>  
            <div class="orderRight">
            	<div style="padding-bottom:20px;border-bottom:1px solid #FF3;"> <img src="{$smarty.const.SITE_URL}themes/default/images/order.png"/>
</div>
                <div class="infoOrder">
                    <p class="nameOrder" style="font-weight:20px;font-weight:bold;color:#FF0;">Tên sản phẩm</p>
                    <p class="qtyOrder" style="font-weight:20px;font-weight:bold;color:#FF0;">Số lượng</p>
                    <p class="unitOrder" style="font-weight:20px;font-weight:bold;color:#FF0;">Đơn giá</p>
                    <p class="statusOrder" style="font-weight:20px;font-weight:bold;color:#FF0;">Tình Trạng</p>
                    <p class="statusPay" style="font-weight:20px;font-weight:bold;color:#FF0;">Mua Deal</p>
                  <div class="clr"></div>
                {foreach from=$content item=item}
                    <p class="nameOrder"><a href="{$smarty.const.SITE_URL}deals/{$item.Shopping_ProductID}/{$item.name|removeMarks}.html">{$item.name|truncate:30}</a></p>
                    <p class="qtyOrder">{$item.Shopping_Quantity}</p>
                    <p class="unitOrder">{$item.Shopping_Total|number_format} đ</p>
                    <p class="statusOrder">{if $item.Shopping_Complete=='0'}Chưa thanh toán{else}Đã thanh toán{/if}</p>
                    <p class="statusPay">{if $item.Shopping_Complete=='0'}<a onclick="return buydeal(this);" href="{$smarty.const.SITE_URL}buydeals?DealsID={$item.Shopping_ProductID}&size=600x400" id="popupHtmlDealsBuy"> Mua &raquo;</a>{else}Đã mua{/if}</p>
                 {/foreach}
                </div>
            <div class="clr"></div>
            <div class="paging">{$sPaging}</div>
            </div>         
        <div class="clr"></div>
        
        </div>     
    <!--ket thuc #pageContent-->
    