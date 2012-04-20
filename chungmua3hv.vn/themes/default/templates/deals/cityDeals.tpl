 <!-- slide-->          
{loadModule name=slideshow} 
{foreach from=$deals item=deals}
<div class="dealBox">
            	<div class="dealTitle"><a href="{$smarty.const.SITE_URL}{$smarty.session.lang}/deals/{$deals.Product_ID}/{$deals.Product_LinkName|removeMarks}.html">{$deals.Product_Name}</a></div>
                    <div class="clr"></div>

                <div class="dealLeft">
                	<div class="dealPrice{$smarty.session.lang_id}">{$deals.Product_DealPrice|number_format} đ 
                    <a onclick="return buydeal(this);" href="{$smarty.const.SITE_URL}{$smarty.session.lang}/buydeals?DealsID={$deals.Product_ID}&size=600x400" id="popupHtmlDealsBuy"></a></div>
                    <div class="featurePrice02"> 
                        <div class="featureValue">{#value#}<p>{$deals.Product_Price|number_format} đ</p></div>
                        <div class="featureSave">{#save1#}<p>{$deals.Product_Price-$deals.Product_DealPrice|number_format} đ</p></div>
                    </div>
                    {literal}
<script>
$(function () {
				var day = $('#{/literal}PROD{$deals.Product_ID}{literal}').val();
				//window.alert(day); 
				austDay = new Date(day);
				$('#DAY_{/literal}PROD{$deals.Product_ID}{literal}').countdown({until: austDay, format: 'dHMS'});
				});
</script>
{/literal}
                	<div class="featureTime"><br>
						<input type="hidden" value="{$deals.Product_EndDate|echo_date:"M d, Y h:i:s"}" id="PROD{$deals.Product_ID}" />
                    	<div class="timeTitle3">{#time_left#}<p><div id="DAY_PROD{$deals.Product_ID}"></div></p></div>
                    </div>
                	<div class="featureBought">
                    	<div class="boughtTitle">{#also#} <span>{$deals.Product_Quantity-$deals.Product_Buy}/{$deals.Product_Quantity}</span> {#votes#}</div>
                        <div class="boughtBar{$deals.match}"></div>
                        <div class="boughtStatus">({#included#} <span>{$deals.Product_Buy}</span> {#buyer#})</div>

                    </div>
                    <div class="dealBottom">
                    	<!--BUTTON XEM CHI TIET-->
                    	<div id="viewOpen" rel='PRO{$deals.Product_ID}' class="viewQuick">{#quick_view#} <span>[ + ]</span></div>
                    	{*<div id="viewClose" class="viewQuick viewClose">XEM NHANH <span>[ - ]</span></div>*}
                    	<a href="{$smarty.const.SITE_URL}{$smarty.session.lang}/deals/{$deals.Product_ID}/{$deals.Product_LinkName|removeMarks}.html" class="viewDetail">{#view_detail#}</a>

                    </div>
                </div>
            	<div class="dealRight">
                    <img src="{$smarty.const.SITE_URL}upload/product/{$deals.Product_Photo}" alt=""/>
                </div>
                <div class="share1">
                	<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e1fb7b43f40304d"></script>
<!-- AddThis Button END -->
                </div>
                <div class="dealLabel">{$deals.save}%</div>
                <div class="clr"></div>

<!--NOI DUNG AN HIEN-->
                <div id="PRO{$deals.Product_ID}" class="dealShortContent shortContent">
                	<div id="boxShortContent" class="boxShortContent boxShortContent">
                        <div class="dealNote">
                        	<div class="dealNoteTitle">{#important_customer#}</div>
                            <div class="dealNoteContent">{$dnotes.Content_Content}</div>
                        </div>
                        <div class="dealConditions">

                            <div class="dealConditionsTitle">{#term_of_use#}</div>
                            <div class="dealNoteContent">{$deals.Product_Terms_of_Use}</div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>                       
            </div>
{/foreach}
