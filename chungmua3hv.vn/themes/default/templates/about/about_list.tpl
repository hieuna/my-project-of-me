<div class="boxContent">
                        <div class="caption">
                            <span class="captionLeft"><a href="{$smarty.const.SITE_URL}">{#HOME#}</a> &raquo; <a>{#ABOUT#} </a></span>
                        </div>


        
        {foreach from=$about_item_list item=about_item_list}
        
        <div class="boxItemList">
                	{if $about_item_list.About_Photo}<img class="img" src="{$smarty.const.SITE_URL}upload/about/thumb/{$about_item_list.About_Photo}" style="float:left; width:130px; margin-bottom:5px; margin-right:10px;" border="0" />{/if}
                            <a href="{$smarty.const.SITE_URL}{$smarty.session.lang}?mod=about&task=view&id={$about_item_list.About_ID}">{$about_item_list.About_Title}</a>
                            {$about_item_list.About_Summarize}
                           <div class="clr"></div>
              <a href="{$smarty.const.SITE_URL}{$smarty.session.lang}?mod=about&task=view&id={$about_item_list.About_ID}" class="book"  style="font-size:12px">{#view_more#}</a>
                            <div class="clr"></div>
                      </div>
                        
        
              {/foreach} 

  </div>
  
  
