<div class="mainbox-container">
	{literal}
	<script type="text/javascript">
	//<![CDATA[
	var items = [];
	//]]>
	</script>
	{/literal}
</div>
<div class="border deals-main">
	<div class="subheaders-group">
		<h2 class="subheader"><span>Hot Deals</span></h2>
	</div>
	<div class="deals-container-24">
		<div class="pagination cm-deals-pagination-list right"></div>
		<div class="clear"></div>
		<div class="hot-deals-skin-tango">
			<div class="hot-deals-container clear">
				<div class="hot-deals-prev cm-deals-left"></div>
				<div class="hot-deals-next cm-deals-right"></div>
				<div class="hot-deals-list">
						<div class="hot-deals-item cm-deals-item-0"></div>
						<div class="hot-deals-item cm-deals-item-1"></div>
						<div class="hot-deals-item cm-deals-item-2"></div>
						<div class="hot-deals-item cm-deals-item-3"></div>
				</div>
			</div>
		</div>
		
		<div class="updates-wrapper deals-footer cm-deals-categories">
			<a name="0" class="cm-deals-category">Tất cả</a>&nbsp;&nbsp;
			{$lsProductHotdeal}
		</div>	
	</div>
	{literal}
	<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready(function()
	{
		parent_elm = jQuery('.deals-container-24');
		var deals24 = new Deals(items, parent_elm, 24);
	});
	//]]>
	</script>
	{/literal}
</div>