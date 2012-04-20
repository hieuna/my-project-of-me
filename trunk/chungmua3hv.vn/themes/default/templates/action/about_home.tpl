<div class="boxAbout">
            	<img src="{$smarty.const.SITE_URL}upload/about/{$about_item_home.About_Photo}" width="512" />
                <a href="{$smarty.const.SITE_URL}about/{$about_item_home.About_ID}/{$about_item_home.About_Title|removeMarks}.html">{$about_item_home.About_Title}</a>
                {$about_item_home.About_Summarize}<a href="{$smarty.const.SITE_URL}about/{$about_item_home.About_ID}/{$about_item_home.About_Title|removeMarks}.html" class="readmore">{#readmore#} &raquo;</a>
           	<div class="clear"></div>
            </div>