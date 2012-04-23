<div class="boxAdvert">
<div class="boxTitle">Quảng Cáo</div>
    <div class="adver">	<a href="https://sohapay.com" target="_blank"><img src="https://sohapay.com/images/merchant/logo_merchant1.png" style="border: none; width: 220px;" /></a>
    {foreach from=$adver item=adver}
    	{if $adver.Image_Type == 'swf'}
        	{$adver.str}
        {else}
        	<a href="{$adver.Image_Link}">{$adver.str}</a>
        {/if}        
    {/foreach}
    </div>
</div>