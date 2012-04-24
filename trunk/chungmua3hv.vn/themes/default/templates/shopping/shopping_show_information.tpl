<div class="pageDefault" id="capThongtin">
                <div class="pageTitle">XÁC NHẬN THÔNG TIN</div>
                <div class="payProcess">
                        <div class="payLeft"></div>
                        <div class="payMid">
                        	<div class="stepNum">1</div>
                            <span class="stepDesc">Chọn thanh toán</span>
                        </div>
                    	<div class="payArrow"></div>
                        <div class="payMid">
                        	<div class="stepNum">2</div>
                            <span class="stepDesc">Nhập thông tin</span>
                        </div>
                    	<div class="payArrow"></div>
                        <div class="payMid">
                        	<div class="stepNum02">3</div>
                            <span class="stepDesc02">Xác nhận thông tin</span>
                        </div>
                    	<div class="payRight"></div>
                </div>
                
                
                
                
                <div class="clr"></div>
                <p></p>
                <div class="method" id="mastercard">
                    <div class="pageTitle">Thông tin đơn hàng</div>			
    
    <table cellpadding="0" cellspacing="0" class="buyDeal" width="100%">
                	<col width="50%" /><col width="50%" />
                	<tr>
                    	<th style="text-align:left">MÃ SỐ ĐƠN HÀNG</th>
                    	<th  style="text-align:left">{$shopping.Shopping_Code}</th>
                    	
                    </tr>
                </table>
                <div class="clr"></div></div>
                <p></p>
                <div class="method" id="mastercard">
                    <div class="pageTitle">Thông tin sản phẩm </div>			
    
    <table cellpadding="0" cellspacing="0" class="buyDeal">
                	<col width="5%" /><col width="50%" /><col width="10%" /><col width="15%" /><col width="15%" />
                	<tr>
                    	<th>STT</th>
                    	<th>Thông tin chi tiết</th>
                    	<th>Số lượng</th>
                    	<th>Giá mua</th>
                    	<th>Thành tiền</th>
                    </tr>
                	<tr>
                    	<td>1</td>
                    	<td class="buyDealInfo">{$product.Product_Name}</td>
                    	<td>
                        	{$shopping.Shopping_Quantity}
                        </td>
                    	<td>{$product.Product_DealPrice|number_format}</td>
                    	<td><span id="totalhtml">{$shopping.Shopping_Total|number_format}</span></td>                        
                    </tr>
                </table>
                    
                    <div class="clr"></div>
                </div>
                   <p></p>
                      <div class="method" id="mastercard">
       
                        <div class="pageTitle">Thông tin khách hàng </div>	
      <table cellpadding="0" cellspacing="0" class="buyDeal" style="width:100%;">
                	<col width="40%" /><col width="60%" />
                	<tr>
                    	<th style="text-align:left">Tên khách hàng</th>
                    	<th  style="text-align:left">{$shopping.Shopping_Name}</th>
                    </tr>
                	<tr>
                    	<td  style="text-align:left">Địa chỉ email</td>
                    	<td  style="text-align:left">{$shopping.Shopping_Email}</td>
                    </tr>
                	<tr>
                    	<th  style="text-align:left">Số điện thoại liên hệ</th>
                    	<th  style="text-align:left">{$shopping.Shopping_Phone}</th>
                    </tr>
                	<tr>
                    	<td  style="text-align:left">Địa chỉ nhận hàng</td>
                    	<td  style="text-align:left">{$shopping.Shopping_Address}</td>
                    </tr>
                  	<tr>
                    	<th  style="text-align:left">Hình thức thanh toán</th>
                    	<th  style="text-align:left">{$shopping.Shopping_Type}</th>
                    </tr>
              </table>
          
                </div>
                	<input type="hidden" value="{$smarty.get.pmt_SID}" id="idsend" />
                    <div class="clr"></div>
                    <p>Sau khi quý khách xác nhận thông tin xin vui lòng click vào nút bấm dưới đây.</p>
                    {if $shopping.Shopping_Type=='Thanh toán tại nhà' || $shopping.Shopping_Type=='Thanh toán bằng chuyển phát nhanh'}
                    <input type="button" onclick="return showAlert()" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Đồng ý">
    {elseif $shopping.Shopping_Type=='Thanh toán trực tuến qua SohaPay'}	 <form method="post" name="frm" action="index.php?mod=shopping&task=sohapay">		 <input name="business" value="5" type="hidden">		 <input name="vs_Name_Booking" value="{$shopping.Shopping_Name} đặt mua dịch vụ {$product.Product_Name} với tổng số tiền {$shopping.Shopping_Total|number_format}" type="hidden">		 <input name="vs_Ship" value="{$product.Product_Ship}" type="hidden">		 <input name="vs_city" value="{$shopping.Shopping_City}" type="hidden">		 <input name="vs_Total" value="{$shopping.Shopping_Total}" type="hidden">		 <input name="vs_Price" value="{$shopping.Shopping_Total}" type="hidden">		 <input name="vs_Method" value="MT010" type="hidden">		 <input name="vs_email" value="{$shopping.Shopping_Email}" type="hidden">		 <input name="vs_mobile" value="{$shopping.Shopping_Phone}" type="hidden">		 <input name="vs_ShoppingCode" value="{$shopping.Shopping_Code}" type="hidden">		 <input name="vs_Currency" value="VND" type="hidden">		 <input name="vs_Returl_Url" value="{$smarty.const.SITE_URL}xac-nhan-don-hang.php?codeID={$shopping.Shopping_Code}" type="hidden">		 <input type="submit" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Tiếp tục">	</form>      {elseif $shopping.Shopping_Type=='Thanh toán bằng thẻ Visa hoặc MasterCard'}
 <form method="post" name="frm" action="http://smartbill.vn/payment.do">
 <input name="business" value="5" type="hidden">
 <input name="vs_Name_Booking" value="{$shopping.Shopping_Name} đặt mua dịch vụ {$product.Product_Name} với tổng số tiền {$shopping.Shopping_Total|number_format}" type="hidden">
 <input name="vs_Total" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Price" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Method" value="MT002" type="hidden">
 <input name="cartID" value="{$smarty.get.pmt_SID}" type="hidden">
 <input name="vs_ShoppingCode" value="{$shopping.Shopping_Code}" type="hidden">
 <input name="vs_Currency" value="VND" type="hidden">
 <input name="vs_Returl_Url" value="{$smarty.const.SITE_URL}xac-nhan-don-hang.php?codeID={$shopping.Shopping_Code}" type="hidden">
<input type="submit" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Tiếp tục"></form>
  {elseif $shopping.Shopping_Type=='Thanh toán bằng Thẻ nội địa'}
 <form method="post" name="frm" action="http://smartbill.vn/payment.do"  onsubmit="return showAlertPay();">
 <input name="business" value="5" type="hidden">
 <input name="vs_Name_Booking" value="{$shopping.Shopping_Name} đặt mua dịch vụ {$product.Product_Name} với tổng số tiền {$shopping.Shopping_Total|number_format}" type="hidden">
 <input name="vs_Total" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Price" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Method" value="MT001" type="hidden">
 <input name="cartID" value="{$smarty.get.pmt_SID}" type="hidden">
 <input name="vs_ShoppingCode" value="{$shopping.Shopping_Code}" type="hidden">
 <input name="vs_Currency" value="VND" type="hidden">
 <input name="vs_Returl_Url" value="{$smarty.const.SITE_URL}xac-nhan-don-hang.php?codeID={$shopping.Shopping_Code}" type="hidden">
<input type="submit" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Tiếp tục"></form>

  {elseif $shopping.Shopping_Type=='Nộp tiền tại quầy ngân hàng'}
   <form method="post" name="frm" action="http://smartbill.vn/payment.do">
 <input name="business" value="5" type="hidden">
 <input name="vs_Name_Booking" value="{$shopping.Shopping_Name} đặt mua dịch vụ {$product.Product_Name} với tổng số tiền {$shopping.Shopping_Total|number_format}" type="hidden">
 <input name="vs_Total" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Price" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_ShoppingCode" value="{$shopping.Shopping_Code}" type="hidden">
 <input name="vs_Method" value="MT003" type="hidden">
 <input name="cartID" value="{$smarty.get.pmt_SID}" type="hidden">
 <input name="vs_Currency" value="VND" type="hidden">
 <input name="vs_Returl_Url" value="{$smarty.const.SITE_URL}xac-nhan-don-hang.php?codeID={$shopping.Shopping_Code}" type="hidden">
<input type="submit" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Tiếp tục"></form>

  {elseif $shopping.Shopping_Type=='Thanh toán qua Internet Banking'}
   <form method="post" name="frm" action="http://smartbill.vn/payment.do">
 <input name="business" value="5" type="hidden">
 <input name="vs_Name_Booking" value="{$shopping.Shopping_Name} đặt mua dịch vụ {$product.Product_Name} với tổng số tiền {$shopping.Shopping_Total|number_format}" type="hidden">
 <input name="vs_Total" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Price" value="{$product.Shopping_Total}" type="hidden">
 <input name="vs_ShoppingCode" value="{$shopping.Shopping_Code}" type="hidden">
 <input name="vs_Method" value="MT004" type="hidden">
 <input name="cartID" value="{$smarty.get.pmt_SID}" type="hidden">
 <input name="vs_Currency" value="VND" type="hidden">
 <input name="vs_Returl_Url" value="{$smarty.const.SITE_URL}xac-nhan-don-hang.php?codeID={$shopping.Shopping_Code}" type="hidden">
<input type="submit" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Tiếp tục"></form>
  {elseif $shopping.Shopping_Type=='Thanh toán bằng thẻ ATM'}
   <form method="post" name="frm" action="http://smartbill.vn/payment.do">
 <input name="business" value="5" type="hidden">
 <input name="vs_Name_Booking" value="{$shopping.Shopping_Name} đặt mua dịch vụ {$product.Product_Name} với tổng số tiền {$shopping.Shopping_Total|number_format}" type="hidden">
 <input name="vs_Total" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_Price" value="{$shopping.Shopping_Total}" type="hidden">
 <input name="vs_ShoppingCode" value="{$shopping.Shopping_Code}" type="hidden">
 <input name="vs_Method" value="MT005" type="hidden">
 <input name="cartID" value="{$smarty.get.pmt_SID}" type="hidden">
 <input name="vs_Currency" value="VND" type="hidden">
 <input name="vs_Returl_Url" value="{$smarty.const.SITE_URL}xac-nhan-don-hang.php?codeID={$shopping.Shopping_Code}" type="hidden">
<input type="submit" class="formBtn" style="float:right; margin-right:20px; margin-top:20px;" value="Tiếp tục"></form>
                 {/if}   <div class="clr"></div>
              
            </div>
            
            <div class="pageDefault" style="margin-top:20px; min-height:0;">
                <div class="pageTitle">CÁCH THỨC MUA HÀNG</div>
                <div class="clr"></div>
                <p></p>
                <p>
                <img src="upload/payment.jpg" style="margin-left:10px;" /></p>
                <p></p>
                     <div class="clr"></div>
            </div>
{literal}
<script>
$(document).ready(function(){ gotoTop('capThongtin');});

function showAlert(){
alert('Cảm ơn bạn đã mua hàng tại Chung Mua 3HV.');
window.location="{/literal}{$smarty.const.SITE_URL}{literal}";
}
</script>
{/literal}