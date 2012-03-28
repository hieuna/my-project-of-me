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
		<li><a style="cursor: pointer;">Nạp thẻ cào qua SohaPay</a></li>
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
						return true;
					}
					</script>
					<form action="http://thuvientailieu.net/API/sohapay_api.php" method="POST" name="shp_form" onsubmit="javascript:return check(this);">
						<table cellpadding="5" cellspacing="5" border="0" align="center">
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
								<td></td>
								<td valign="top" style="padding-left: 10px;"><input type="submit" style="width:80px;height:30px" value="Nạp Tiền" name="sbNapThe"></td>
							</tr>
							<input type="hidden" name="hid" value="1" />
							<input type="hidden" name="userid" value="{vb:raw bbuserinfo.userid}" />
							<input type="hidden" name="user_email" value="{vb:raw bbuserinfo.email}" />
						</table>
					</form>
				</div>
			</div>
		</section>
		<!-- THE CAO -->
		<section>
			<div class="section">
				<div class="blockrow">
					<script type="text/javascript">
					var form = document.shp_form2;
					function check(form){					
						if (form.price_shp.value == "" || form.price_shp.value == 0){
							alert('Vui lòng nhập số tiền lớn hơn 0');
							form.price_shp.focus();
							return false;
						}						
						return true;
					}
					</script>
					<form name="payment" method="post" action="http://thuvientailieu.net/API/naptheshp_api.php">
					<table border="0" cellpadding="5" cellspacing="5" align="center">
						<tr>
							<td align="right" valign="top"><font color="red">(*)</font> Di Động khách hàng</td>
							<td align="left" valign="top" style="padding-left: 10px;"><input type="text" value="" name="order_mobile" style="height:30px;width:200px" /></td>
						</tr>
						<tr>
							<td colspan="2" style="height: 10px;"></td>
						</tr>
						<tr>
							<td align="right" valign="top"><font color="red">(*)</font> Loại thẻ</td>
							<td align="left" valign="top" style="padding-left: 10px;">
								<select name="card_type" onchange="javascript:if(this.value=='vcoin' || this.value=='viettel'){document.getElementById('cardSeri').style.display='block';}else{document.getElementById('cardSeri').style.display='none';}">
									<option value='vinaphone'>vinaphone</option>
									<option value='mobifone'>mobifone</option>
									<option value='viettel'>viettel</option>
									<option selected="selected" value='vcoin'>thẻ Vcoin</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="height: 10px;"></td>
						</tr>
						<tr>
							<td align="right" valign="top"><font color="red">(*)</font> Số seri</td>
							<td align="left" valign="top" style="padding-left: 10px;"><input id="cardSeri" type="text" value="" name="card_seri" style="height:30px;width:200px" /></td>
						</tr>
						<tr>
							<td colspan="2" style="height: 10px;"></td>
						</tr>
						<tr>
							<td align="right" valign="top"><font color="red">(*)</font> Mã thẻ</td>
							<td align="left" valign="top" style="padding-left: 10px;"><input type="text" value="" name="card_code" style="height:30px;width:200px" /><br /><small>(Phải là chữ số, nhiều hơn 11 ký tự)</small></td>
						</tr>
						<tr>
							<td colspan="2" style="height: 10px;"></td>
						</tr>						
						<tr><td colspan="2" valign="top" align="center" style="padding-left: 10px;"><input type="submit" value="Nạp thẻ" style="width:80px;height:30px" name="submit" /></td></tr>
						<input type="hidden" name="hid" value="1" />
						<input type="hidden" name="userid" value="{vb:raw bbuserinfo.userid}" />
						<input type="hidden" name="user_email" value="{vb:raw bbuserinfo.email}" />
						<input type="hidden" name="user_name" value="{vb:raw bbuserinfo.username}" />
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