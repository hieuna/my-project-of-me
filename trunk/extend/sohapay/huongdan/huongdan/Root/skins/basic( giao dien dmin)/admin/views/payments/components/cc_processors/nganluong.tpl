{* $Id: paypal.tpl 8176 2009-11-05 09:20:20Z zeke $ *}


<!--Phan moi cua nganluong.vn-->
<div class="form-field">
	<label for="receiver">Tài khoản nhận tiền:</label>
	<input type="text" name="payment_data[processor_params][receiver]" id="receiver" value="{$processor_params.receiver}" class="input-text" />
</div>

<div class="form-field">
	<label for="Api">Mật khẩu giao tiếp API:</label>
	<input type="text" name="payment_data[processor_params][secure_pass]" id="secure_pass" value="{$processor_params.secure_pass}" class="input-text" />
</div>

<div class="form-field">
	<label for="merchant">Merchant site (ID):</label>
	<input type="text" name="payment_data[processor_params][merchant_site_code]" id="merchant_site_code" value="{$processor_params.merchant_site_code}" class="input-text" />
</div>

<div class="form-field">
	<label for="checkout">Địa chỉ check out ngan luong:</label>
	<input type="text" name="payment_data[processor_params][nganluong_url]" id="ngaluong_url" value="{$processor_params.nganluong_url}" class="input-text" />
</div>

<div class="form-field">
	<label for="url">Địa chỉ trả về:</label>
	<input type="text" name="payment_data[processor_params][return_url]" id="return_url" value="{$processor_params.return_url}" class="input-text" />
</div>



<!--End Phan moi cua nganluong.vn-->


<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="VNĐ" {if $processor_params.currency == "VNĐ"}selected="selected"{/if}>{$lang.currency_code_vnd}</option>
		
	</select>
</div>





<p>
{$lang.see_demo}: <a href="https://www.nganluong.vn">http:nganluong.com.vn</a></p>
