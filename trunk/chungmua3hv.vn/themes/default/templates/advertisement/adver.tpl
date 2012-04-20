<div class="boxAdvert">
<div class="boxTitle">Quảng Cáo</div>
    <div class="adver">
    {foreach from=$adver item=adver}
    	{if $adver.Image_Type == 'swf'}
        	{$adver.str}
        {else}
        	<a href="{$adver.Image_Link}">{$adver.str}</a>
        {/if}        
    {/foreach}
    </div>
</div>