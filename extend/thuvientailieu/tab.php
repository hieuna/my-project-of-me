<div class="clear"></div>
<h2 class="blockhead">
	<b>{vb:rawphrase vinavb_payment_account_info}</b>
</h2> 
<div class="blockbody formcontrols settings_form_border"> 
    <div class="section">
        <div class="blockrow">
            <label for="currentpassword">{vb:rawphrase username}:</label> 
            <div class="for_ie7"><b>{vb:raw bbuserinfo.username}</b></div> 
        </div>
        <div class="blockrow">
            <label for="currentpassword">{vb:rawphrase vinavb_payment_account_amount}:</label> 
            <div class="for_ie7"><b>{vb:number {vb:raw bbuserinfo.money}}</b> {vb:raw vboptions.money_currency}</div> 
        </div>
    </div>
</div>

<div class="notice" style="margin-top:10px;">
	<h3>{vb:rawphrase vinavb_payment_desc,{vb:raw bbuserinfo.musername}, {vb:raw vboptions.money_currency}}</h3>
</div>

<div class="payment">
    <ul class="mytabs">
        <li><a href="#">{vb:rawphrase vinavb_payment_sms}</a></li>
        {vb:raw template_hook.vinavb_payment_tab}
		<li><a style="cursor: pointer;">Nạp tiền qua SohaPay</a></li>
    </ul>
    <div class="panes clearfix">
        <section>
			<div class="section">
				<div class="blockrow">
					{vb:rawphrase vinavb_payment_sms_desc, {vb:raw vboptions.money_currency}, {vb:raw bbuserinfo.userid}}
				</div>
			</div>
		</section>
		{vb:raw template_hook.vinavb_payment_section}
		<section>
			<div class="section">
				<div class="blockrow">
					<script type="text/javascript">
					var form = document.shp_form;
					function check(form){					
						if (form.price_shp.value == "" || form.price_shp.value == 0){
							alert('Vui lòng nhập số tiền lớn hơn 0');
							form.price_shp.focus();
							return false;
						}
						else if (form.email_shp.value==''){
							alert('vui lòng nhập địa chỉ email !');
							form.email.focus();
							return false;
						}
						else if (form.email_shp.value.indexOf('@',0) == -1 || form.email_shp.value.indexOf('.',0) == -1){
							alert("Địa chỉ email không hợp lệ !") ;
							form.email.select() ;
							return false ;
						}
						return true;
						}
					</script>
					<form action="http://thuvientailieu.net/API/sohapay_api.php" method="POST" name="shp_form" onsubmit="javascript:return check(this);">
						<table cellpadding="5" cellspacing="5" border="0">
							<tr>
								<td valign="top">Nhập số tiền cần nạp</td>
								<td valign="top" style="padding-left: 10px;">
									<input type="text" name="price_shp" value="0" style="height:30px;width:200px" />
								</td>
							</tr>
							<tr>
								<td colspan="2" style="height: 10px;"></td>
							</tr>
							<tr>
								<td valign="top">Email của bạn</td>
								<td valign="top" style="padding-left: 10px;">
									<input type="text" name="email_shp" value="" style="height:30px;width:200px" />
								</td>
							</tr>
							<tr>
								<td colspan="2" style="height: 10px;"></td>
							</tr>
							<tr>
								<td valign="top">Số điện thoại của bạn</td>
								<td valign="top" style="padding-left: 10px;">
									<input type="text" name="phone_shp" value="" style="height:30px;width:200px" />
								</td>
							</tr>
							<tr>
								<td colspan="2" style="height: 10px;"></td>
							</tr>
							<tr>
								<td></td>
								<td valign="top" style="padding-left: 10px;"><input type="submit" style="width:80px;height:30px" value="Nạp Thẻ" name="sbNapThe"></td>
							</tr>
							<input type="hidden" name="hid" value="1" />
							<input type="hidden" name="userid" value="{vb:raw bbuserinfo.userid}" />
						</table>
					</form>
				</div>
			</div>
		</section>
    </div>
</div>
<script type="text/ecmascript">
	$("ul.mytabs").tabs("div.panes > section");
</script>