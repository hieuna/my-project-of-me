<div id="pageRight">
        	<div class="boxRight">
            	<div class="boxTitle">
                	<div class="boxIcon"><img src="{$smarty.const.SITE_URL}themes/default/images/boxIcon01.png" alt="photo"/></div>
                	{#discount#}
                </div>
                {foreach from=$deals item=deals}
                <div class="boxDiscount">
                	<a href="{$smarty.const.SITE_URL}{$smarty.session.lang}/deals/{$deals.Product_ID}/{$deals.Product_LinkName|removeMarks}.html" class="discountTitle">{$deals.Product_Deal}</a>
                    <div class="discountImg">

                    	<div class="discountLabel">Giảm<p>{$deals.save}%</p></div>
                    	<img src="{$smarty.const.SITE_URL}upload/product/{$deals.Product_Photo}" alt="" title="{$deals.Product_Deal}" />
                        <a href="{$smarty.const.SITE_URL}{$smarty.session.lang}/deals/{$deals.Product_ID}/{$deals.Product_LinkName|removeMarks}.html" class="discountView">Chi tiết</a>
                    </div>
                    <div class="discountDetai">{$deals.Product_Name}</div>

                </div>  
                {/foreach}             
            </div>
        	<div class="boxRight">
            	<div class="boxTitle">
                	<div class="boxIcon"><img src="{$smarty.const.SITE_URL}themes/default/images/boxIcon02.png" alt="photo"/></div>
                	{#learn_more#}
                </div>
                <div class="boxDiscount">
                	<ul>

                    	<li class="question">
                        	<div class="helpIcon">{#why_be_cheap#}</div>
                        	<div class="helpContent">{#because1#}</div>
                        </li>
                    	<li class="online">
                        	<div class="helpIcon">{#payonline#}</div>
                        	<div class="helpContent">{#card_visa#}<br />{#atm_bank#}</div>

                        </li>
                    	<li class="cast">
                        	<div class="helpIcon">{#pay_money#}</div>
                        	<div class="helpContent">{#transfer#}</div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>