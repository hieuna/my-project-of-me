    	<div id="pageLeft">
<form action="?mod=product&task=baokim" method="post" id="frmPOST_{$product_item.Product_ID}" name="frmPOST_{$product_item.Product_ID}">
<input type="hidden" value="{$product_item.Product_ID}" name="productID"/>
<div class="dealBox">
            	<a class="dealTitle"><span>{if $product_item.DestinationID}{$product_item.DestinationID}{else} Toàn quốc {/if}:</span>{$product_item.Product_Name}</a>
                    <div class="clr"></div>
                <div class="dealLeft">
                	<div class="dealPrice">{$product_item.Product_DealPrice|number_format} đ 
						
                    	{if $checkbtdetail}
                   		 <a  {if $product_item.Product_Sold !=1} href="mua-hang.php?ID={$product_item.Product_ID}"{/if}></a>
                         {/if}                                                  
                         <div style="background-image:url(https://www.baokim.vn/promote/paymentbk.png);width:180px;height:50px;margin-left:-4px;margin-top:8px">
    					<div style="padding-top:5px;margin-left:40px">      		 				  <div style="cursor: pointer; background-color:#78AB2A;border:none;color:#FFF;font-size:14px;height:22px;padding:8px 0 12px 0;font-weight:bold;width:130px" id="target_{$product_item.Product_ID}">Mua trực tuyến</div>        				</div>
     					<div style="font-size:11px;margin-left:75px;color:#FFF;margin-top:-14px">Tích lũy : <b>{$product_item.Product_DealPrice/100|number_format}</b> đ
                        </div>
   					 </div>	                    </div>					
                    <div class="dealPriceRight"></div>
                    <div class="featurePrice02"> 
                        <div class="featureValue">Giá trị<p>{$product_item.Product_Price|number_format} đ</p></div>
                        <div class="featureSave">Tiết kiệm<p>{$product_item.Product_Price-$product_item.Product_DealPrice|number_format} đ</p></div>

                    </div>
                	<div class="featureTime">
                    	<div class="timeTitle">THÒI GIAN CÒN LẠI</div>
                        {if $product_item.Product_Sold !=1}
{literal}
<script>
var launchDate = new Date("{/literal}{$product_item.Product_EndDate|echo_date:'F d,Y H:i:s'}{literal}");
var secondsRemaining = Math.floor(launchDate.getTime() / 1000) - Math.floor(new Date().getTime() / 1000);
countdown(secondsRemaining,'down{/literal}{$product_item.Product_ID}{literal}');
</script>{/literal}

                        <p><div class="countdownTimer" id="down{$product_item.Product_ID}">
						<div class="days">
							<label class="number">00</label> Ngày, </div>
						<div class="hours">
							<label class="number">00</label> Giờ</div>
						<div class="minutes">
							<label class="number">00</label> Phút</div>
						<div class="seconds">
							<label class="number">00</label> Giây</div>
					</div></p>
                    <div class="clear"></div>
                        <span>(Tức {$product_item.Product_EndDate|fulldate})</span>
                        {else}
                        <b>Sản phẩm đã bán hoặc đã hết hạn sử dụng</b>
                        {/if}
                    </div>
                	<div class="featureBought">

                    	<div class="boughtTitle">Đã có <span>{$product_item.Product_Buy|default:0}</span> người mua</div>
                        <div class="boughtBar"><div class="boughtPercent" style="width:{$product_item.Product_Buy|default:0|percent:$product_item.Product_Quantity|default:1}%"></div></div>
                        <div class="boughtStatus">Còn <span>{$product_item.Product_Quantity-$product_item.Product_Buy|default:0}/{$product_item.Product_Quantity|default:0}</span> phiếu</div>
                    
                    <b>{if $product_item.Product_Buy >= $product_item.Product_Minimun} Đã đạt đủ số lượng để có giá tốt {else}
                    Cần có thêm {$product_item.Product_Minimun-$product_item.Product_Buy|default:0} người mua nữa để đạt giá tốt
                    {/if}</b>
                    </div>
                    <div class="pageView">Lượt xem: <span>{$product_item.Product_NumberView|number_format}</span></div>
                    <div class="pageComment" style="cursor:pointer" title="Xem bình luận" onclick="return gotoTop('CommentID')">Bình luận: <span>{$product_item.comment|default:0}</span></div><br />

                   {* <div class="share">{literal}
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_default_style " addthis:title="{Title}" addthis:url="{Permalink}">
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_4"></a>
    <a class="addthis_button_compact"></a>
    <a class="addthis_counter addthis_bubble_style"></a>
    </div>
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e715fd827ed25a2"></script>
    <!-- AddThis Button END -->
    {/literal}</div>*}
                    <div class="dealBottom">
                    	<!--BUTTON XEM CHI TIET-->
                    </div>
                </div>
            	<div class="dealRight">
                    <div class="dealImage">
                    	<a title="{$product_item.Product_Name}"><img src="upload/product/{$product_item.Product_Photo}" alt="{$product_item.Product_Name}"/></a>
                    </div>
                    <div class="dealHomeContent">
                       <p>
                        {$product_item.Product_Description}</p>
                           <p> <iframe src="http://www.facebook.com/plugins/like.php?href={$smarty.const.SITE_URL}san-pham-{$product_item.Product_ID}/{$product_item.Product_LinkName}.html"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe></p>
                    </div>
                </div>
                <div class="dealLabel"><span>GIẢM</span><br />{$product_item.Product_Price-$product_item.Product_DealPrice|percent:$product_item.Product_Price}%</div>
                <div class="clr"></div>     
              
               <!--Hien thi phan Luu y khach hang-->
                <div id="boxShortContent" class="boxShortContent">
                    <div class="bgDotted">
                        <div class="dealNote">
                            <div class="dealNoteTitle">ĐIỂM NỔI BẬT</div>
                            <div class="dealNoteContent">{$product_item.Product_Note}</div>
                        </div>
                        <div class="dealConditions">
                            <div class="dealConditionsTitle">ĐIỀU KHOẢN SỬ DỤNG</div>
                            <div class="dealNoteContent">{$product_item.Product_Terms_of_Use}</div>
                        </div>
                        <div class="clr"></div>
                    </div>
                </div>
                
               <!--Hien thi HOI DAP-->
               <a onclick="return buydeal(this);" href="thac-mac-p-{$product_item.Product_ID}.html?size=600x430" id="popupHtmlDealsBuy"  class="reQuest"></a>
                <div class="clr"></div>
               <!--Hien thi thong tin chi tiet-->
                <div class="pageTitle">THÔNG TIN CHI TIẾT</div>
                <div class="dealDetailContent">
               {$product_item.Product_Content}
               </div>
            </div>
</form>  
            {if $product_item.Product_Map}
            <div class="dealBox">
                <div class="pageTitle">BẢN ĐỔ</div>
              <div style="margin-top:10px;"  >
           <img src="upload/map/{$product_item.Product_Map}">
           </div>
            </div>{/if}
            
            <div class="dealBox" id="CommentID">
                <div class="pageTitle">BÌNH LUẬN (<span>{$product_item.comment|default:0}</span>)</div>
            {loadModule name=comment task=view}
            </div>
            {if $smarty.get.goto}
{literal}
<script>
	$(document).ready(function(){ gotoTop('CommentID');})
</script>
{/literal}
            {/if}
            </div>
                   {loadModule name=control task=right}

          