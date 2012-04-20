<div class="searchContent">
    <div class="searchTitle">
        <div class="searchTitleInside">GIỚI THIỆU</div>     
    </div>
    {foreach from=$intro item=item}
    <div class="intro">
         	<a href="{$smarty.const.SITE_URL}{$smarty.session.lang}/introduction/{$item.About_ID}/{$item.About_Title|removeMarks}.html"><img src="{$smarty.const.SITE_URL}upload/about/thumb/{$item.About_Photo}" /></a>
         <div class="intro-content">
         	<p style="font-weight:bold;font-size:13px;"><a style="color:#FC0;" href="{$smarty.const.SITE_URL}{$smarty.session.lang}/introduction/{$item.About_ID}/{$item.About_Title|removeMarks}.html">{$item.About_Title}</a></p>
    		{$item.About_Summarize|truncate:500}
         </div>
    </div>
    <div style="clear:both;"></div>
    {/foreach}
    <div style="clear:both;""></div>
    <div class="paging">{$sPaging}</div>
</div>  
                     


  
