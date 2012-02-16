    	<div id="main-hotdeal" class="clearfix">
    		<!--  
    		<div id="top">
    			<div class="name">
    				Điện thoại <b>| {$page_title}</b>
    			</div>
    			<div class="contact">Liên hệ mua hàng: <b>012-77-73-73-73</b></div>
    		</div>
    		-->
    		<div class="rows clearfix">
	    		<div id="slideshow">
	    		<ul>
	    		{foreach from=$oBanner key=stt item=banner}
	    			<li>
	    			<a href="{$banner.banner_url}" target="_blank">
	    				<img src="{$banner.banner_image}" />
	    			</a>
	    			</li>
	    		{/foreach}
	    		</ul>
	    		</div>
    		</div>
    		<div class="rows clearfix">
    			{foreach from=$lsHotDeal key=stt item=hotdeals}
    			<div class="cols"{if $hotdeals.stt%2==0}{else} style="margin-right:0; float:right;"{/if}>
    				<div class="title_hotdeal">
    					<div class="date_time">Cập nhật: Ngày {$hotdeals.start_date|date_format:"%d/%m/%Y"},  {$hotdeals.start_date|date_format:$config.time}| Lượt xem: {$hotdeals.view}</div>
    					<div class="clearfix"></div>
    					<div class="namesp">
    						<a href="index.php?route=product/product&product_id={$hotdeals.product_id}">{$hotdeals.title}</a>
    					</div>
    				</div>
    				<div class="box-hotdeal">
    					{if $hotdeals.image == ""}
    					<!--<div class="box_title_hotdeal">Hot-Deal</div>-->
    					<div class="giam_gia">{$hotdeals.discount}%</div>
    					<div class="hangsx">{if $hotdeals.image_cat == ""} {$hotdeals.name_cat} {else} {$hotdeals.name_cat}{/if}</div>
    					<div class="box-image">
	    					<a href="index.php?route=product/product&product_id={$hotdeals.product_id}">
	    						<img src="image/{$hotdeals.imagesp}" class="not_full" />
	    					</a>
	    					<div class="feauture">{$hotdeals.title_feauture}</div>
	    					<div class="box_tinh_nang">
	    						<img src="images/tinh_nang.jpg" />
	    					</div>
    					</div>
    					{else}
    						<!--<div class="box_title_hotdeal">Hot-Deal</div>-->
    						<div class="giam_gia">{$hotdeals.discount}%</div>
    						<a href="index.php?route=product/product&product_id={$hotdeals.product_id}">
    							<img src="{$hotdeals.image}" class="full" />
    						</a>
    					{/if}
    					<div class="lsInfomation">
    						<div class="title_info">Tính năng nổi bật</div>
    						<div class="content_info">
    							<!--  
    							<ul>
								{foreach from=$hotdeals.ft item=foo}
								    {if $foo!=""}<li>{$foo}</li>{/if}
								{/foreach}
								</ul>
								-->
								{$hotdeals.description}
    						</div>
    						<div class="ct_info ct_info_bgnone">
    							<ul style="float:left; margin-left: 120px;">
    								<li class="icon" style="padding-right: 0px;"><a href="http://www.facebook.com/xtechonline?ref=tn_tnmn"><img src="images/facebook.jpg" height="15" border="0" /></a></li>
    								<li class="icon" style="padding-right: 0px;"><a href="https://plus.google.com/u/0/113079457263731184385/posts#113079457263731184385/posts"><img src="images/google.jpg" height="15" border="0" /></a></li>
    								<li class="icon" style="padding-right: 0px;"><a href="http://twitter.com/#!/xtechonline1"><img src="images/switter.jpg" height="15" border="0" /></a></li>
    							</ul>
    							<ul style="float:right; margin-right: 10px;">
    								<li class="icon"><a href="index.php?route=product/product&product_id={$hotdeals.product_id}"><img src="images/detail.jpg" width="95" border="0" /></a></li>
    							</ul>
    						</div>
    						<div class="ct_info">
    							<ul class="clearfix">
    								<li>Nhân viên bán hàng : <span>{$hotdeals.ct_name}</span></li>
    							</ul>
    							<ul>	
    								<li class="icon"><img vspace="5" src="images/icon-phone.png" border="0" /><span class="bluper">{$hotdeals.ct_phone}</span></li>
    								<li class="icon"><a href="ymsgr:sendim?{$hotdeals.ct_yahoo}" title="{$hotdeals.ct_yahoo}"><img vspace="5" src="images/icon-yahoo.png" border="0" /><span>{$hotdeals.ct_yahoo}</span></a></li>
    								<li class="icon"><a href="skype:{$hotdeals.ct_skype}?chat" title="{$hotdeals.ct_skype}"><img vspace="5" src="images/icon-skype.png" border="0" /><span>{$hotdeals.ct_skype}</span></a></li>
    							</ul>
    						</div>
    					</div>
    				</div>
    				<div class="desciption">
    				</div>
    				<div class="all_price">
    					<div class="price">
    						<h2>{$hotdeals.price_hotdeal|number_format} <span>VNĐ</span></h2>
    						<span class="price_others">Giá niêm yết: <b>{if $hotdeals.price_ny == 0} {$hotdeals.price|number_format} đ  {else}{$hotdeals.price_ny|number_format} đ {/if}</b>| Mức giảm: <b>{$hotdeals.muc_giam|number_format} đ</b></span>
    					</div>
    					<div class="kham_pha">
    						<input type="button" class="button" value="Khám phá" onclick="javascript:document.location.href='index.php?route=product/product&product_id={$hotdeals.product_id}'" />
    					</div>
    					<div class="clearfix"></div>
    					<div class="thong_ke">
    						<div class="buy">Đã mua: <b>{$hotdeals.da_mua|number_format}/{$hotdeals.count|number_format}</b> | {if $hotdeals.da_mua==0}Danh sách{else}<a href="javascript:void(0);" id="hd_{$hotdeals.id}">Danh sách</a>{/if}</div>
    						<div class="time" id="clock_{$hotdeals.id}">Thời gian còn lại: <b><span id="days_{$hotdeals.id}"></span> ngày, <span id="hours_{$hotdeals.id}"></span>h : <span id="minutes_{$hotdeals.id}"></span> : <span id="seconds_{$hotdeals.id}"></span></b></div>
    						<div class="lsCustomer" id="cus_{$hotdeals.id}"></div>
    					</div>
    				</div>
    				<!--  
    				<div class="box_end">
    					<div class="lsbutton">
    						<input type="button" class="bt_loantin" value="Loan tin" />
    						<input type="button" class="bt_number" value="500" />
    					</div>
    					<div class="lstext">
    						Bấm loan tin đến bạn bè để nhận <b>500đ</b> từ xtech.vn<br />
    						<div>[<a href="#">tài khoản tiền thưởng của bạn</a>] [<a href="#">cách dùng tiền thưởng</a>]</div>
    					</div>
    				</div>
    				-->
    			</div>
    			<script type="text/javascript">
    			{literal}
				$(function() {
				 	// ***** thay 2011/01/01 là năm  tháng ngày *************************     
				 	$('div#clock_'+{/literal}{$hotdeals.id}{literal}).countdown({/literal}'{$hotdeals.end_date|date_format:"%Y/%m/%d"}'{literal} , function(event) {
					 var $this = $(this);
						 switch(event.type) {
							 case "seconds":
							 case "minutes":
							 case "hours":
							 case "days":
							 case "weeks":
							 case "daysLeft":
							 $this.find('span#'+event.type+'_'+{/literal}{$hotdeals.id}{literal}).html(event.value);
							 break;
							 case "finished":
							 $this.hide();
							 break;
						 }
					 });
					 /* slideshow */
					$(function() {
						$('#slideshow ul').cycle({
					        fx:     'fade',
					        timeout: 5000,
					        pager:  '#page_slide',
					        pagerAnchorBuilder: function(idx, slide) { 
					            return '<a href="#"><span>' + idx + '</span></a>'; 
					        },
					        before: function (curr, next, opts){
					        	var bgColor = $(next).attr('rel');
					        	if (bgColor!=null) $('#bgslide').animate({backgroundColor: bgColor});
					        }
					    });
					});		 
				});
				{/literal}
				</script>
				{if $hotdeals.stt != 0}
				<div class="clrFixBorder"></div>
				{/if}
    			{/foreach}
    		</div>
    	</div>