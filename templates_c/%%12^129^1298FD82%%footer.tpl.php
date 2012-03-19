<?php /* Smarty version 2.6.10, created on 2012-03-19 17:24:07
         compiled from D:/AppServ/www/projects/templates/shopping/footer.tpl */ ?>
<div id="page-footer">
       <br />
       <div id="rhf" style="clear:both">
	<table id="rhf_table" align="center" width="100%" cellpadding="0" cellspacing="0">
	    <tr>
	        <td class="rhf-box-corner-sprite rhf-box-tl" width="10"></td>
	        <td class="rhf-box-corner-sprite rhf-box-tc">
	        <div class="rhf_header"><span id="rhfMainHeading">Các sản phẩm bạn xem gần đây</span></div>
	
	        </td>
	        <td class="rhf-box-corner-sprite rhf-box-tr" width="10"></td>
	    </tr>
	    <tr>
	        <td class="rhf-box-sides-sprite rhf-box-l" width="10">&nbsp;</td>
	        <td>
	       <div id="rhf_container">
	       		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/products.viewed.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
	<div id="rhf_error" style="display:none;">
	
	
	
	
	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px">
	
	    <tr valign="top">
	        <td valign="top">
	            <div class="rhfHistoryWrapper">
	    <p>After viewing product detail pages or search results, look here to find an easy way to navigate back to pages you are interested in.</p>
	            </div>
	        </td>
	    </tr>
	    <tr><td>
	
	    <div style="padding:10px 10px 0 10px; text-align:left;">
	        <b><span style="color: rgb(204, 153, 0); font-weight: bold; font-size: 13px;"> &#8250; </span>
	        <a href="/gp/yourstore/pym/ref=pd_pyml_rhf">View and edit your browsing history</a>
	        </b></div>
	    </td></tr>
	</table>
	</div>
	        </td>
	
	        <td class="rhf-box-sides-sprite rhf-box-r" width="10"></td>
	    </tr>
	    <tr>
	        <td class="rhf-box-corner-sprite rhf-box-bl" width="10">&nbsp;</td>
	        <td class="rhf-box-corner-sprite rhf-box-bc">&nbsp;</td>
	        <td class="rhf-box-corner-sprite rhf-box-br" width="10">&nbsp;</td>
	    </tr>
	</table>
       </div>
        <br />
	<div id="navFooter">
	</div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['dir_template'])."/topup.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">
	$(function() {
		//Slide next prev
	    $(\'#tab_content\').cycle({
	        fx:     \'scrollHorz\',
	        timeout: 0,
	        next: \'#btn_next\',
	        prev: \'#btn_prev\'
	    });
	});
</script>
'; ?>

</body>
</html>