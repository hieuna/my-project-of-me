<h2>{#finishStep#}</h2>
{*<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frmPaypan" >
        	<input type="hidden" name="cmd" value="_cart"/>
        	<input type="hidden" name="locale.x" value="en_us"/>*}
			{*<input type="hidden" name="cpp_header_image" value="{$smarty.const.SITE_URL}logopayment.png">*}
		    <input type="hidden" name="upload" value="1"/>
		    <input type="hidden" name="country" value="us"/>
		    <input type="hidden" name="business" value="dinhhungvn@gmail.com"/>
		   {* <input type="hidden" name="return" value="{$smarty.const.SITE_URL}checkpay.html" />*}
		   {* <input type="hidden" name="item_name_1" value="TLD-ID-{$guest.Shopping_ID}"/>
		    <input type="hidden" name="amount_1" value="{$guest.Shopping_Total}"/>
		    <input type="hidden" name="quantity_1" value=""/>				
		    <input type="hidden" name="cartID" value="{$cart.id}"/>				
		    <input type="hidden" name="discount_rate_1" value="">*}	
            
 <form method="post" action="http://pay.smartnet.vn/payment.do">
 <input type="hidden" name="business" value="1" />
 <input type="hidden" name="vs_Name_Booking" value="{$guest.Shopping_Name} dang ky mua {$deals.Product_Name} voi so luong {$guest.Shopping_Quantity}. Yeu cau {$guest.Shopping_Messege} " />
 <input type="hidden" name="vs_Total" value="{$guest.Shopping_Total}" />
 <input type="hidden" name="vs_Total" value="{$guest.Shopping_Total}" />
 <input type="hidden" name="vs_Price" value="{$deals.Product_DealPrice}" />
 <input type="hidden" name="vs_Currency" value="VND" />
 <input type="hidden" name="vs_Returl_Url" value="{$smarty.const.SITE_URL}?mod=buydeals&task=paid&id={$deals.Product_ID}&sid={$guest.Shopping_ID}&qty={$guest.Shopping_Quantity}" />
            
<div class="modal_box_left">
<h3>{#yourInfomation#}</h3>

<ul class="modal_box_step3">
<!--<li><a href="{$smarty.const.SITE_URL}buydeals?task=step2&DealsID={$deals.Deals_ID}&ajax=true&action={$guest.Shopping_ID}">Edit</a></li>-->
<li><span>{#yourName#}:</span>{$guest.Shopping_Name}</li>
<li><span>{#yourEmail#}:</span>{$guest.Shopping_Email}</li>
<li><span>{#dateUse#}:</span>{$guest.Shopping_Create}</li>
<li><span>{#buyqty#}:</span>{$guest.Shopping_Quantity}</li>
<li><span>{#poppriceDeals#}:</span>{$deals.Product_DealPrice|number_format}</li>
<li><span>{#total#}:</span>{$guest.Shopping_Total|number_format} VND</li>
<li><span>{#messbuyDeal#}:</span>{$guest.Shopping_Messege}</li>
</ul>
<input type="button" onclick="history.go(-1)" class="form_button" value="{#prev#}" /><input type="submit" style=" margin:0 0 0 10px" class="form_button" value="{#payment#}" />

</div>
<div class="modal_box_right">
<h3>{$deals.Product_Name|truncate:80}</h3>
<img src="{$smarty.const.SITE_URL}upload/product/{$deals.Product_Photo}" />

<div class="modal_box_deals_info"> {$deals.Product_Description|truncate_utf8:150}</div>
<div class="clear"></div>
</div>
</form>


