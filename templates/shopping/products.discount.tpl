<div class="unified_widget rcmBody" id="goldboxDotdContentRc">
	<table style="overflow:hidden;">
	 <tbody><tr>
	  <td style="overflow:hidden; padding:0px;">
	    <h2>Sản phẩm giảm giá</h2>
	  </td>
	 </tr>
	</tbody>
	</table>
	{section name=loops loop=$lsProductDiscount}
	<table style="overflow:hidden;">
	 <tbody><tr>
	  <td style="overflow:hidden; padding:0px 7px 0px 0px; margin:0; width: 1%;">
	   <left>
			<a href="{$lsProductDiscount[loops].link}" class="gbox" title="{$lsProductDiscount[loops].name}">
				<img src="{$lsProductDiscount[loops].image1}" class="gbox-img" alt="{$lsProductDiscount[loops].name}" width="100" height="100" border="0" />
			</a>
	   </left>
	  </td>
	  <td style="overflow:hidden; padding:0px;">
	    <table style="overflow:hidden;">
	      <tbody><tr>
	        <td style="overflow:hidden; padding:0px;">
	           <div style="margin-bottom:5px;">
					<a href="{$lsProductDiscount[loops].link}" class="gbox-b" title="{$lsProductDiscount[loops].name}" style="text-decoration: none;">
					{$lsProductDiscount[loops].name}
					</a>
	           </div>
	        </td>
	      </tr>
	      <tr>
	        <td valign="top" style="overflow:hidden; padding:0; margin-top:5px;">
	           <div class="gbox-dotd-container">
				<table style="width:70%;" id="gbox-pricing-div.A3305F5NNN7TSE">
				  <tbody><tr style="padding-top:2px;white-space:nowrap;overflow:hidden;margin-left:6px;" class="priceBlock">
				   <td style="font-family: 'Arial'; color: rgb(102, 102, 102); font-weight:normal; font-size: 11px;
				    text-align:right; margin-left:8px; padding:0.5px 0 0;" ,="" id="gbox-dotd-list-price-title">
				    Giá bán:
				   </td>
				   <td class="listPrice" style="color: rgb(102, 102, 102); font-size: 12px;font-family:'Arial';text-decoration:line-through;
				    text-align:left; padding:0 0 0 3px;" ,="" id="gbox-dotd-list-price">
				    {$lsProductDiscount[loops].price|number_format}{$menh_gia}
				   </td>
				  </tr>
				  <tr style="white-space:nowrap;overflow:hidden;margin-left:6px;" class="priceBlock">
				   <td style="font-family: 'Arial'; color: rgb(102, 102, 102); font-size: 11px;  font-weight:normal;text-align:right;
				    margin-left:4px; padding:1px 0 0;" ,="" id="gbox-dotd-promo-price-title">
				    Giảm giá: 
				   </td>
				   <td style="font-family:Arial;font-size:14px; text-align:left;color:#990000; padding:0 0 0 3px;" id="gbox-dotd-promo-price">
				    {$lsProductDiscount[loops].discount|number_format}{$menh_gia}
				   </td>
				  </tr>
				
				 <tr style="white-space:nowrap; overflow:hidden;margin-left:6px;" class="priceBlock">
				   <td style="font-family: 'Arial'; color: rgb(102, 102, 102); font-size: 11px; text-align:right; font-weight:normal;
				    margin-left:4px; padding:0;" ,="" id="gbox-dotd-discount-title">
				    Tiết kiệm:
				   </td>
				   <td style="color: rgb(102, 102, 102); font-size: 11px;font-family:'Arial'; text-align:left;font-weight:normal; padding:0 0 0 3px;" ,="" class="pricing" id="gbox-dotd-discount">
				    {$lsProductDiscount[loops].price_sale|number_format}{$menh_gia}
				    ({$lsProductDiscount[loops].percent}%)
				   </td>
				 </tr>
				</tbody>
				</table>
	           </div>
	        </td>
	      </tr>
	    </tbody>
	    </table>
	  </td>
	 </tr>
	</tbody>
	</table>
	{/section}
	<table style="overflow:hidden;">
	 <tbody><tr>
	  <td style="overflow:hidden; padding-top:10px; padding-bottom:0px;">
	   <p class="seemore" style="text-align: right;">
	    <span class="carat">
	     ›
	    </span>
	    <span style="margin-left:-4px;">
	     <a href="#">
	      Xem tất cả
	     </a>
	    </span>
	   </p>
	  </td>
	 </tr>
	</tbody>
	</table>
	
</div>