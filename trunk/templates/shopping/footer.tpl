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
	       		{include file = "$dir_template/products.viewed.tpl"}
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

{include file = "$dir_template/topup.tpl"}
{literal}
<script type="text/javascript">
	$(function() {
		//Slide next prev
	    $('#tab_content').cycle({
	        fx:     'scrollHorz',
	        timeout: 0,
	        next: '#btn_next',
	        prev: '#btn_prev'
	    });
	});
</script>
{/literal}
</body>
</html>