<div class="boxRight">
    <div class="boxTitle">Đang giảm giá</div>
    {foreach from=$discount item=discount}
    <div class="boxDiscount">
        <a href="san-pham-{$discount.Product_ID}/{$discount.Product_LinkName}.html" title="{$discount.Product_Name}" class="discountTitle">{$discount.Product_Deal}</a>
        <div class="discountImg">
            <img src="upload/product/thumb/{$discount.Product_Photo}" title="{$discount.Product_Name}" />
        </div>
        <div class="discountDetai"><b>{$discount.DestinationID|default:'Toàn quốc'}</b>: {$discount.Product_Name}</div>

        <div class="discountBot">
            <div class="discountLabel">Giảm {$discount.Product_Price-$discount.Product_DealPrice|percent:$discount.Product_Price}%</div>
            <div class="discountView"><a href="san-pham-{$discount.Product_ID}/{$discount.Product_LinkName}.html" title="{$discount.Product_Name}">Xem chi tiết +</a></div>
            <div class="clr"></div>
        </div>
    </div>
    {/foreach}      
</div>