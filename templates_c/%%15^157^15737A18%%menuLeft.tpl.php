<?php /* Smarty version 2.6.10, created on 2012-03-19 17:51:55
         compiled from D:/AppServ/www/projects/templates/shopping/menuLeft.tpl */ ?>
<div id="nav_exposed_anchor" class="nav_exposed_sbd">
	<div id="nav_exposed_skin" style="top: -8px; left: -15px; display: block;" class="">
		<table cellspacing="0" cellpadding="0">
			<tbody>
			<tr>
				<td class="nav_pop_tl nav_pop_h">
					<div class="nav_pop_lr_min"></div>
				</td>
				<td class="nav_pop_tc nav_pop_h"></td>
				<td class="nav_pop_tr nav_pop_h">
					<div class="nav_pop_lr_min"></div>
				</td>
			</tr>
			<tr>
				<td class="nav_pop_cl nav_pop_v"></td>
				<td class="nav_pop_cc ap_content">
					<div id="nav_exposed_cats">
						<div class="nav_browse_wrap" id="nav_cats_wrap">
							<?php echo $this->_tpl_vars['showMenuLeft']; ?>

      						<div class="nav-sprite" id="nav_cat_indicator" style=""></div>
    					</div>
    				</div>
    			</td>
    			<td class="nav_pop_cr nav_pop_v"></td>
    		</tr>
    		<tr>
    			<td class="nav_pop_bl nav_pop_v"></td>
    			<td class="nav_pop_bc nav_pop_h"></td>
    			<td class="nav_pop_br nav_pop_v"></td>
    		</tr>
    		</tbody>
    	</table>
    </div>
</div>
<?php echo '
<script type="text/javascript">
$(function(){
	$("#nav_cats li").hover(function(){
		$(this).addClass(\'nav_hover\');
	},
	function(){
		$(this).removeClass(\'nav_hover\');
	}
	);
});
</script>
'; ?>