<div id="rhf_shvl_div" class="rhfWrapper">
<table cellspacing="0" cellpadding="0" border="0" style="margin-top: 10px; width: 100%;">
    <tbody><tr valign="top">
        <td id="rviColumn">
            <div class="rhfHistoryWrapper">
                <span><strong id="rhfHistoryColumnTitle">You have no recently viewed items.</strong></span>
				<p>After viewing product detail pages or search results, look here to find an easy way to navigate back to pages you are interested in.</p>
				<div style="display: none;" id="rhfUpsellDescription">
					<p>Look to the right column to find helpful suggestions for your shopping session.</p>
				</div>
			</div>
        </td>
        <td valign="top" id="rhfUpsellColumnContent">
            <div style="padding: 0pt 0px 0pt 10px;">
				<div id="rhf_upsell_div">
					<div id="rhf0Shvl" class="shoveler ">
				    <div class="shoveler-heading">
				        <div class="rhfUpsellColumnTitle"><strong>Tiếp tục mua hàng: </strong> Sản phẩm đã xem</div>
				    </div>
				    <div id="rhf0ButtonWrapper" class="shoveler-button-wrapper">
				        <div class="back-button">
					        <a id="btn_prev" href="javascript: void(0);" title="Quay lại">
						        <span class="bg-text">Quay lại</span>
						        <span title="Quay lại" class="bg-image"></span>
					        </a>
				        </div>
				        <div class="shoveler-content" id="tab_content">
				            <ul>
				            	{section name=loops loop=$lsProductViewed}
								<li class="shoveler-cell" style="margin-left: 15px; margin-right: 15px;">
									<div>
										<span>
											<a title="{$lsProductViewed[loops].name}" class="title" href="{$lsProductViewed[loops].link}"> 
												<div style="margin-bottom: 6px; margin-top: 0px;" class="imageContainer">
									                 <img height="135" width="99" src="{$lsProductViewed[loops].image1}" alt="{$lsProductViewed[loops].name}" border="0" />
									            </div>
									            {$lsProductViewed[loops].name}
											</a>
										</span>
										<div class="rating">
											<span class="rating-stars">
												<span class="crAvgStars">
													<span class="asinReviewsSummary">
														<a href="#">
															<img height="12" width="55" align="absbottom" title="4.5 sao/5 sao" alt="4.5 sao/5 sao" src="{$url_template}/images/stars-4-5.gif" border="0" />
														</a>&nbsp;
													</span>(<a href="#">5,274</a>)
												</span>
											</span>
										</div>
									    <div class="binding">{$lsProductViewed[loops].name_cate}</div>
									    <div class="price">{$lsProductViewed[loops].price|number_format}{$menh_gia}</div>
									    <div class="reason-text"></div>
									</div>
								</li>
								{if $lsProductViewed[loops].stt%5==0}
								</ul><ul>
								{/if}
								{/section}
							</ul>
				        </div>
				        <div class="next-button">
					        <a id="btn_next" href="javascript: void(0);" title="Xem tiếp">
						        <span class="bg-text">Xem tiếp</span>
						        <span title="Xem tiếp" class="bg-image"></span>
					        </a>
				        </div>
				    </div>
</div>
</div></div></td></tr><tr><td colspan="2"></td></tr></tbody></table>
</div>