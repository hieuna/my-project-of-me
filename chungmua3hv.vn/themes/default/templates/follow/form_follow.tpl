<div class="pageDefault">
<div class="pageTitle">THEO DÕI ĐƠN HÀNG</div>
<div class="signinBox">
	<div class="err_signin">
    	{if $msg}
        	{$msg}
        {/if}
    </div>
    <form name="frmFollow" method="post" onsubmit="return checkFollowForm(this)">
    <div style="float:left; width:280px; border:1px solid #4B3E35; padding:10px; height:200px; margin-right:10px;">
        <label class="formLabel" style="width:auto;" for="Email"><strong>MÃ ĐƠN HÀNG</strong><span class="formRequest">*</span></label>
        <input class="formInput" id="_follow" name="_follow" style="width:250px;" title="" type="text" value="{$smarty.request._follow}"><br>
<p>Xin vui lòng nhập mã số đơn hàng bạn muốn theo dõi.</p>
        </div>
        <div style="float:left; padding-top:30px; margin-right:10px; font-weight:bold; font-size:20px;">HOẶC</div>
         <div style="float:left; width:290px;  border:1px solid #4B3E35; padding:10px; height:200px;">
        <label class="formLabel" style="width:auto;" for="Email"><strong>ĐỊA CHỈ EMAIL</strong><span class="formRequest">*</span></label>
        <input class="formInput" style="width:270px;" id="_email" name="_email" title="" type="text" value="{$smarty.request._email}"><br>
         <p style="margin-left:30px;"><label class="formLabel"></label></p>
        <label class="formLabel" style="width:auto;" for="Email"><strong>SỐ ĐIỆN THOẠI</strong><span class="formRequest">*</span></label>
          <input class="formInput" style="width:270px;"  id="_phone" name="_phone" title="" type="text" value="{$smarty.request._phone}">
       <div style="clear:both"></div>
        </div>
        <p style="margin-left:30px;"><label class="formLabel"></label></p>
        <div style="clear:both; margin-top:10px;"></div>
        <center>
       <input class="formBtn" style=" margin-top:30px; margin-bottom:10px;" value="KIỂM TRA NGAY" type="submit">
    </center>
    </form>
</div>
{if !$cart && !$productview}<p>Không tìm thấy đơn hàng nào.</p>{/if}
{if $cart}

<div class="pageTitle" id="ttOrder">THÔNG TIN ĐƠN HÀNG MÃ SỐ: {$cart.Shopping_Code}</div>

<div class="followDealName">{$product.Product_Name}</div>
                <ul class="followDeal">
                	<li><b>Tên khách hàng:</b> {$cart.Shopping_Name} </li>
                	<li><b>Địa chỉ giao hàng:</b> {$cart.Shopping_Address} </li>
                	<li><b>Số lượng đặt mua:</b> {$cart.Shopping_Quantity} </li>
                	<li><b>Tình trạng đơn hàng:</b> {if $cart.Shopping_Complete==1}Đã xử lý thành công{else}Đang xử lý{/if}</li>
                 	<li><b>Thời điểm đặt hàng:</b> {$cart.Shopping_Create|echo_date:'H:i A - d/m/Y'} </li>
               </ul>
                <div class="clr"></div>
 {literal}
               <script>
				$(document).ready(function(){
					gotoTop('ttOrder');
				
				})
                </script>
 {/literal}
                
                

{/if}
{if $productview}
<div class="pageTitle" id="ttOrder">THÔNG TIN ĐƠN HÀNG ĐẶT MUA</div>
{foreach from=$productview item=_product name=_productname}

<div class="followDealName">MÃ ĐƠN HÀNG: {$_product.Shopping_Code}</div>
                <ul class="followDeal">
                	<li><b>Mã đơn hàng:</b> {$_product.Shopping_Code} </li>
                	<li><b>Tên sản phẩm mua:</b> {$_product.product_name} </li>
                	<li><b>Địa chỉ giao hàng:</b> {$_product.Shopping_Address} </li>
                	<li><b>Số lượng đặt mua:</b> {$_product.Shopping_Quantity} </li>
                	<li><b>Tình trạng đơn hàng:</b> {if $_product.Shopping_Complete==1}Đã xử lý thành công{else}Đang xử lý{/if}</li>
                 	<li><b>Thời điểm đặt hàng:</b> {$_product.Shopping_Create|echo_date:'H:i A - d/m/Y'} </li>
               </ul>
                <div class="clr"></div>
{/foreach}
                
                
                <div class="clr"></div>
 {literal}
               <script>
				$(document).ready(function(){
					gotoTop('ttOrder');
				
				})
                </script>
 {/literal}
                
                

{/if}
</div>
{literal}
<script>
function checkFollowForm(frm){
	if(frm._email.value=='' && frm._phone.value=='' && frm._follow.value=='' ){
		alert('Xin vui lòng nhập mã số đơn hàng.');
		frm._follow.focus();
		return false;
	}
	 
	
}
</script>
{/literal}
            