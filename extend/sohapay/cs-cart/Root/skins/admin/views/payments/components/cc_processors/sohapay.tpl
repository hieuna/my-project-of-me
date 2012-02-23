{* $Id: paypal.tpl 8176 2009-11-05 09:20:20Z zeke $ *}


<!--SOHAPAY-->
<div class="form-field">
	<label for="merchant">Mã site code(ID) :</label>
	<input type="text" name="payment_data[processor_params][site_code]" id="merchant_site_code" value="{$processor_params.site_code}" class="input-text" />
</div>

<div class="form-field">
	<label for="checkout">Mật khẩu(Secure Secret):</label>
	<input type="text" name="payment_data[processor_params][secure_secret]" id="merchant_secure_secret" value="{$processor_params.secure_secret}" class="input-text" />
</div>

<div class="form-field">
	<label for="url">Tên website của bạn:</label>
	<input type="text" name="payment_data[processor_params][website]" id="website" value="{$processor_params.website}" class="input-text" />
</div>
<!--End SOHAPAY-->

<p>{$lang.see_demo}: <a href="https://www.sohapay.com">sohapay.com</a></p>
