{literal}<script>
<!--//
function get_deals_ajax(page) {
	$('#waiting').show(500);
	$("#waiting").fadeOut(1000);
    $('#ajax_sold_deals').load('{/literal}{$smarty.const.SITE_URL}{literal}index.php?mod=deals&task=ajaxsolddeals&ajax=true&page='+page);
    return false;
}
//-->
</script>{/literal}
<div class="soldContent">
                <div class="searchTitle">
                	<div class="searchTitleInside">{#product_sold#}</div>     
                </div>
                <div id="waiting" style="display:none;width:100%;">
				<center>
					<img src="{$smarty.const.SITE_URL}upload/ajax-loader.gif" title="Loader" alt="Loader" />
				</center>
				</div>
                <div id="ajax_sold_deals">
                	<script>
						get_deals_ajax({$smarty.get.page|default:1});
					</script>
                </div>
                <!-- Mot box hien thi-->
                <div class="clr"></div>
 </div>