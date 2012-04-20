<script src="function.js"></script>
<div class="pageBottom">
        <div class="pageFooter">
        	<div class="logo02"><img src="themes/default/images/logo02.png" alt="photo" /></div>
        	<div class="logo02" style="clear:both; margin-top:60px;">
          <a href="http://www.smartnet.vn" title="Công ty TNHH Dịch Vụ Công Nghệ truyền thông SmartNet - Smartnet Co.,Ltd">  <img src="upload/smarnet.png" alt="Công ty TNHH Dịch Vụ Công Nghệ truyền thông SmartNet - Smartnet Co.,Ltd" /></a>
            </div>
        	<div class="footerNav"><a href="{$smarty.const.SITE_URL}">Trang chủ</a>|<a href="san-pham-da-ban.html" title="Sản phẩm đã bán">Sản phẩm đã bán</a>|
            	{foreach from=$footer item=item}
                	<a href="thong-tin/{$item.Content_Marks}.html" title="{$item.Content_Title}">{$item.Content_Title}</a>{if $item.Content_ID!=$maxid}|{/if}
                {/foreach}
            </div>

            <div class="clr"></div>
            <div class="copyRight">
                © 2011 <b>{#company_copy#}</b><br />
                <span>{#company_address#}<br />
               Email: <a style="color:#fff;" href="mailto:{#company_email#}">{#company_email#}</a> - Phone: {#company_phone#} -  Fax: {#company_fax#}</span>
            </div>
            <div class="icoFooter">
            	<a href="#"><img src="themes/default/images/icoFooter01.png" alt="photo" /></a>
            	<a href="#"><img src="themes/default/images/icoFooter02.png" alt="photo" /></a>
            	<a href="#"><img src="themes/default/images/icoFooter03.png" alt="photo" /></a>
            	<a href="#"><img src="themes/default/images/icoFooter04.png" alt="photo" /></a>
            </div>
            <div class="clr"></div>
        </div>
    </div>
    
    <div id="loading" style="display:none;">
<div id="closePopup"><a href="javascript:void(0)" onclick="return closeForm();" title="Click  hoặc nhấn ESC để đóng cửa sổ">X</a></div>
   	<div id="loadingcontrol"><img src="themes/default/images/loading.gif" border="0" align="loading" title="loading"/></div>
   <div id="popupCoupon"></div>
</div>
