<div class="col_center">
        	
        	<div class="boxCenter">
            	<h2 class="caption">{#ACTION#}</h2>
                <div class="content">
                {foreach from=$action_item_list item=action_item_list}
                	{if $action_item_list.Content_Photo}<img src="{$smarty.const.SITE_URL}upload/content/thumbnail/{$action_item_list.Content_Photo}" width="120" class="img" border="0" />{/if}
                    <a href="{$smarty.const.SITE_URL}action/{$action_item_list.Content_ID}/{$action_item_list.Content_Title|removeMarks}.html" class="link">{$action_item_list.Content_Title}</a>
                   {$action_item_list.Content_Description}<span class="date">({$action_item_list.Content_CreateDate|echo_date:'d M,Y'})</span>
                <a href="{$smarty.const.SITE_URL}action/{$action_item_list.Content_ID}/{$action_item_list.Content_Title|removeMarks}.html" class="readmore">{#readmore#} &raquo;</a>
               <div class="clear dotted"></div>
              {/foreach} 
                <div class="clear paging">{$sPaging}</div>	
               
                </div>
            
            </div>
        	
        </div>