<?php /* Smarty version 2.6.10, created on 2012-02-26 04:39:54
         compiled from D:/AppServ/www/projects/templates/shopping/hotdeals.tpl */ ?>
<div class="mainbox-container">
	<?php echo '
	<script type="text/javascript">
	//<![CDATA[
	var items = [];
	//]]>
	</script>
	'; ?>

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
			<a name="0" class="cm-deals-category">All categories</a>&nbsp;&nbsp;
			<?php echo $this->_tpl_vars['lsProductHotdeal']; ?>

		</div>	
	</div>
	<?php echo '
	<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready(function()
	{
		parent_elm = jQuery(\'.deals-container-24\');
		var deals24 = new Deals(items, parent_elm, 24);
	});
	//]]>
	</script>
	'; ?>

</div>