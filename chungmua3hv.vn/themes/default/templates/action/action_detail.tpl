<div class="col_center">
        	
        	<div class="boxCenter">
            	<h2 class="caption">{#HOME#} &raquo; {#ACTION#} &raquo; {$action_item.Content_Title|truncate_utf8:60}</h2>
                <div class="content">
               {if $action_item.Content_Photo}<img src="{$smarty.const.SITE_URL}upload/content/thumbnail/{$action_item.Content_Photo}" width="120" align="left" class="img" border="0" />{/if}
                {$action_item.Content_Content}<div class="clear"></div>
               <span class="date">{#updateon#} {$action_item.Content_CreateDate|echo_date:'h:i:s A d M,Y'}</span>
                	
               <div class="clear dotted"></div>
               <b>{#other_item#}</b>
               <ul class="otherItems">
               {foreach from=$action_other item=action_other}
               	<li><a href="{$smarty.const.SITE_URL}action/{$action_other.Content_ID}/{$action_other.Content_Title|removeMarks}.html">{$action_other.Content_Title}</a> <span class="date">({$action_other.Content_CreateDate|echo_date:'d/M/Y'})</span></li>
               	{/foreach}               </ul>
                </div>
            
            </div>
        	
        </div>