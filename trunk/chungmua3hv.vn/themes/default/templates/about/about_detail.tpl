<div class="boxContent">
                        <div class="caption">
                            <span class="captionLeft">{$about_item.About_Title}</span>
                        </div>
                        <div class="boxItemList" style="border:0;">
                           
                            {$about_item.About_Content}
                            <div class="clr"></div>
                <div class="clr"></div>
                      </div>
  <div style="clear:both; margin-top:10px;">
     <h2 class="other">{#other_article#}</h2>
         <div class="clr"></div>
    {foreach from=$about_other item=about_other}
        	<a class="link_other" href="{$smarty.const.SITE_URL}{$smarty.session.lang}?mod=about&task=view&id={$about_other.About_ID}">{$about_other.About_Title}</a>
        {/foreach}

     </div>                      
                    </div>
                    
                    
                    


