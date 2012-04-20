<div class="boxmenu">
            	<h2>:: GIỚI THIỆU</h2>
                <div class="menu">
                {foreach from=$about_menu item=about_menu}
                	<a href="{$smarty.const.SITE_URL}about/{$about_menu.About_ID}/{$about_menu.About_Title|removeMarks}.html">{$about_menu.About_Title}</a>
                   {/foreach}
                </div>
            </div>