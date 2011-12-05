shop.gold = {
	conf:{
		customer: {gold:0, email:'', id: 0},
		re_customer:{name:'',avatar:'',email:'',phone:''},
		type: 'self',
		pay_type: 'card',
		card_type: 'vinaphone',
		re_email: '',
		gold: 0,
		rate: 95/100
	},
//	Hack step
	goRechargeStep3_card:function(){
		shop.gold.conf.type = 'self';
		shop.gold.conf.pay_type = 'card';
		shop.gold.rechargeStep3_card();
	},
//	Call Step Functions
	rechargeStep1:function(other, hack){
		shop.ajax_popup("task=getGoldInfo",'GET',{},
		function(json){
			if(json.err == 0){
				if(json.customer.is_active_mail > 0){
					if(other){
						shop.gold.conf.type = 'other';
					}
					shop.gold.conf.customer.gold = parseInt(json.customer.gold);
					shop.gold.conf.customer.email = json.customer.email;
					shop.gold.conf.customer.id = json.customer.id;
					if(hack == 'card'){
						shop.gold.goRechargeStep3_card();
					}else{
						//Turn on step one
						shop.show_overlay_popup('gold-recharge1','Nạp Gold vào tài khoản',
							shop.gold.theme.rechargeStep1('gold-recharge1','Nạp Gold vào tài khoản'),
							{
								background: {
									'background-color' : 'transparent'
								},
								border: {
									'background-color' : 'transparent',
									'padding' : '0px'
								},
								title: {
									'display' : 'none'
								},
								content: {
									'padding' : '0px',
									'width' : '580px',
									'font-size': '12px',
									'color': '#000'
								}
							}
						);
					}
				}else{
					alert('Quý khách vui lòng kích hoạt Email trước khi nạp Gold');
					shop.hide_overlay_popup('gold-recharge1');
					shop.customer.register.sendActiveEmail(json.customer.email, 1);
				}
			}else{
				alert('Vui lòng đăng nhập lại để thực hiện thao tác');
				window.location.reload();
			}
		});
	},
	rechargeStep2:function(){
		shop.show_overlay_popup('gold-recharge2','Chọn hình thức Nạp',
			shop.gold.theme.rechargeStep2('gold-recharge2','Chọn hình thức Nạp'),
			{
				background: {
					'background-color' : 'transparent'
				},
				border: {
					'background-color' : 'transparent',
					'padding' : '0px'
				},
				title: {
					'display' : 'none'
				},
				content: {
					'padding' : '0px',
					'width' : '580px',
					'font-size': '12px',
					'color': '#000'
				}
			}
		);
	},
	rechargeStep3_online:function(){
		shop.show_overlay_popup('gold-recharge3-online','Nạp Gold từ thẻ Visa, Master Card, thẻ ATM, có Internet Banking',
			shop.gold.theme.rechargeStep3_online('gold-recharge3-online','Nạp Gold từ thẻ Visa, Master Card, thẻ ATM, có Internet Banking'),
			{
				background: {
					'background-color' : 'transparent'
				},
				border: {
					'background-color' : 'transparent',
					'padding' : '0px'
				},
				title: {
					'display' : 'none'
				},
				content: {
					'padding' : '0px',
					'width' : '660px',
					'font-size': '12px',
					'color': '#000'
				}
			}
		);
	},
	rechargeStep3_card:function(){
		if (shop.cart.conf.cart.type=='popup') {
			document.getElementById("tmp").style.display='';
			return document.getElementById("tmp").innerHTML = shop.gold.theme.rechargeStep3_card('gold-recharge3-card','Nạp Gold từ thẻ cào điện thoại');
		}
		
		shop.show_overlay_popup('gold-recharge3-card','Nạp Gold từ thẻ cào điện thoại',
			shop.gold.theme.rechargeStep3_card('gold-recharge3-card','Nạp Gold từ thẻ cào điện thoại'),
			{
				background: {
					'background-color' : 'transparent'
				},
				border: {
					'background-color' : 'transparent',
					'padding' : '0px'
				},
				title: {
					'display' : 'none'
				},
				content: {
					'padding' : '0px',
					'width' : '470px',
					'font-size': '12px',
					'color': '#000'
				}
			}
		);
	},
//	Process steps
	doRechargeStep1:function(){
		var form = document.goldRecharge1Form, email = '';
		
		if(!shop.get_ele('radio_self').checked && !shop.get_ele('radio_other').checked){
			shop.error.set('', 'Chưa chọn Nạp thẻ vào đâu', 500, '.goldRecharge'); return;
		}
		
		shop.gold.conf.type = shop.get_ele('radio_self').checked ? 'self' : 'other';
		if(shop.gold.conf.type == 'other'){
			email = shop.util_trim(form.gold_email.value);
			if(email == ''){
				shop.error.set('#gold_email', 'Chưa nhập Email cần nạp Gold', 500, '.goldRecharge'); return;
			}else if(!shop.is_email(email)){
				shop.error.set('#gold_email', 'Địa chỉ Email không hợp lệ', 500, '.goldRecharge'); return;
			}else if(email == shop.gold.conf.customer.email){
				shop.error.set('#gold_email', 'Vui lòng tích vào lựa chọn ở trên nếu Quý khách tự nạp cho mình', 500, '.goldRecharge'); return;
			}
			shop.ajax_popup("act=gold&code=get-customer",'POST',{email:email},
			function(json){
				if(json.email && shop.is_exists(json.active) && (json.active >= 1) && shop.is_exists(json.email_active) && (json.email_active >= 1)){
					shop.gold.conf.re_email = email;
					shop.gold.conf.re_customer.name = json.fullname;
					shop.gold.conf.re_customer.avatar = json.avatar;
					shop.gold.conf.re_customer.phone = json.phone;
					shop.gold.conf.re_customer.email = json.email;
					shop.gold.rechargeStep2();
				}else{
					var def = 'Email <b>'+email+'</b> không tồn tại hoặc chưa kích hoạt tài khoản do đó không thể nạp thêm Gold. Quý khách vui lòng kiểm tra lại.';
					if(shop.is_exists(json.active) && (json.active < 1)){
						json.email = def;
					}else if(shop.is_exists(json.email_active) && json.email_active < 1){
						json.email = def;
					}else{
						json.email = json.email ? json.email : def;
					}
					shop.error.set('#gold_email', json.email, 500, '.goldRecharge'); return;
				}
			});
		}else{
			shop.gold.rechargeStep2();
		}
	},
	doRechargeStep2:function(){
		var form = document.goldRecharge2Form;
		
		if(shop.gold.conf.type != 'self'){
			shop.gold.conf.pay_type = 'online';
		}else{
			if(!shop.get_ele('radio_online_gold').checked && !shop.get_ele('radio_card_gold').checked){
				shop.error.set('', 'Quý khách chưa chọn hình thức Nạp thẻ', 500, '.goldRecharge2'); return;
			}
			shop.gold.conf.pay_type = shop.get_ele('radio_online_gold').checked ? 'online' : 'card';
		}
		
		if(shop.gold.conf.pay_type == 'online'){
			shop.gold.rechargeStep3_online();
		}else{
			shop._store.variable['recharge_gold_start'] = false;
			shop.gold.rechargeStep3_card();
		}
	},
	doRechargeStep3_online:function(){
		var form = document.goldRecharge3Form_online,
		email = (shop.gold.conf.type == 'self') ? shop.gold.conf.customer.email : shop.gold.conf.re_email,
		money = shop.util_trim(form.gold_money.value);
		if(money == ''){
			shop.error.set('#gold_money', 'Chưa nhập Gold', 500, '.goldRecharge3_online'); return;
		}else{
			money = parseInt(money.replace(/,/gi, ''));
			if(money < 50000){
				shop.error.set('#gold_money', 'Quý khách phải nạp tối thiểu 50.000 Gold', 500, '.goldRecharge3_online'); return;
			}
			shop.redirect(BASE_URL+'ca-nhan/nap-gold.html?action=recharge&gold='+money+'&email='+email);
		}
	},
	doRechargeStep3_card:function(){
		if(!shop._store.variable['recharge_gold_start']){
			var frm = document.goldRecharge3Form_card, code = '', card_type = '',
			email = (shop.gold.conf.type == 'self') ? shop.gold.conf.customer.email : shop.gold.conf.re_email;
			if(frm.gold_recharge_code){
				if(!shop.get_ele('r_gold_vinaphone').checked && !shop.get_ele('r_gold_mobifone').checked){
					shop.error.set('', 'Chưa chọn loại thẻ cào', 340, '.goldRecharge3_card'); return;
				}else{
					card_type = shop.get_ele('r_gold_vinaphone').checked ? 'vinaphone' : 'mobifone';
					shop.error.close('', '.goldRecharge3_card');
				}
				
				code = shop.util_trim(frm.gold_recharge_code.value);
				if(code == ''){
					shop.error.set('#'+frm.gold_recharge_code.id, 'Chưa nhập mã số thẻ cào', 340, '.goldRecharge3_card'); return;
				}else if(code.length < 12){
					shop.error.set('#'+frm.gold_recharge_code.id, 'Mã số thẻ không hợp lệ', 340, '.goldRecharge3_card'); return;
				}else{
					shop.error.close('#'+frm.gold_recharge_code.id, '.goldRecharge3_card');
				}
	
				shop.ajax_popup('task=chargeMobiCard',"POST",{code_card:code, card_type: card_type, email: email},
				function(j){
					shop._store.variable['recharge_gold_start'] = false;
					if(j.err == 0)	{
						shop.cart.conf.customer.gold = j.user_gold;
						var moreGold = shop.cart.conf.cart.total - shop.cart.conf.customer.gold;
						if (moreGold>0){
							msg = 'Bạn đã nạp được <b>'+j.recharge+'</b> Gold<br />Hiện tại của Quý khách đang có: <b>'+shop.cart.theme.numberFormat(j.user_gold, 0, '', '.')+'</b><br />Quý khách phải nạp thêm: <b style="color:red">'+shop.cart.theme.numberFormat(moreGold, 0, '', '.')+'</b> Gold';
							
							shop.error.set(0, msg, 340, '.goldRecharge3_card');
						}
						else shop.cart.register();
					}else{
						var id = '';
						switch(j.msg){
							case 'not_connect': j.msg = 'Không kết nối được với nhà cung cấp'; break;
							case 'cus_not_found': j.msg = 'Hiện tại bạn đang không đăng nhập.<br />Vui lòng tắt cửa sổ, mua lại'; break;
							case 'code_invalid': case 'invalid_card': case 'error':
								j.msg = 'Mã số thẻ không hợp lệ';
								id = '#'+frm.gold_recharge_code.id;
							break;
						}
						shop.error.set(id, j.msg, 340, '.goldRecharge3_card');
					}
				},
				{
					loading:function(){
						shop._store.variable['recharge_gold_start'] = true;
						shop.error.set('', 'Hệ thống đang kiểm tra mã thẻ.<br />Quý khách vui lòng <b>không tắt trình duyệt</b>.', 340, '.goldRecharge3_card');
						shop.show_loading('Đang kiểm tra Mã thẻ');
					}
				});
			}
		}
	},
//	Theme steps
	theme:{
		rechargeStep1:function(id, title){
			var type = shop.gold.conf.type, email = (shop.gold.conf.type == 'self') ? '' : shop.gold.conf.re_email;
			if(shop.util_trim(email) == ''){
				email = 'Nhập Email cần nạp...';
			}
			return shop.popupSite(id, title, shop.join
			('<div class="content goldRecharge" style="padding:10px 20px">')
				('<form name="goldRecharge1Form" id="goldRecharge1Form">')
					('<div id="cError"></div>')
					('<div class="gold-content">')
						('<div class="radioBox mTop5"><input type="radio" value="self" id="radio_self" name="radio_type_gold"'+(type == 'self' ? ' checked':'')+' onclick="shop.gold.extend.checkBox(true)" /></div>')
						('<div class="gold-right">')
							('<div class="gold-title"><label for="radio_self">Nạp Gold vào tài khoản cá nhân (<span>'+shop.gold.conf.customer.email+'</span>)</label></div>')
							('<ul>')
								('<li>- Bạn đang có: <b class="ff5a00">'+shop.numberFormat(shop.gold.conf.customer.gold,0,'','.')+' Gold</b></li>')
								('<li>- Nạp thêm Gold để có thể mua hàng dễ dàng chỉ trong vài nhấp chuột</li>')
							('</ul>')
						('</div>')
						('<div class="c"></div>')
					('</div>')
					('<div class="gold-content">')
						('<div class="radioBox mTop5"><input type="radio" value="other" id="radio_other" name="radio_type_gold"'+(type == 'other' ? ' checked':'')+' onclick="shop.gold.extend.checkBox(false)" /></div>')
						('<div class="gold-right">')
							('<div class="gold-title">')
								('<div class="fl"><label for="radio_other">Nạp hộ Gold cho tài khoản khác</label></div>')
								('<div class="fl mLeft5"><input type="text" value="'+email+'" title="Nhập Email cần nạp..." id="gold_email" class="gold_email'+(type == 'other' ? '_active':'')+'" name="gold_email" onfocus="shop.gold.extend.focusInput(true)" onblur="shop.gold.extend.focusInput(false)" /></div>')
								('<div class="c"></div>')
							('</div>')
							('<ul class="mTop5">')
								('<li>- Để nạp <b style="color:red">100.000 Gold</b> bạn cần thanh toán <b style="color:red">102.000 đ</b>, trong đó <b style="color:red">100.000 Gold</b> sẽ vào tài khoản của người được nạp hộ, <b style="color:red">2.000 Gold</b> vào tài khoản của người nạp hộ</li>')
							('</ul>')
						('</div>')
						('<div class="c"></div>')
					('</div>')
					('<div>')
						('<a href="javascript:void(0)" onclick="shop.gold.doRechargeStep1()" class="blueButton  mLeft10" id="fr"><span><span>TIẾP TỤC <b>&raquo;</b></span></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</form>')
			('</div>')());
		},
		rechargeStep2:function(id, title){
			var type = shop.gold.conf.pay_type,
			card = shop.join
			('<div class="gold-content">')
				('<div class="radioBox mTop5"><input type="radio" value="card" id="radio_card_gold" name="radio_pay_gold"'+(type == 'card'?' checked':'')+' /></div>')
				('<div class="gold-right">')
					('<div class="gold-title"><label for="radio_card_gold">Nạp từ thẻ cào điện thoại <font color="red">(Chỉ Khấu trừ <b style="font-size:16px">'+shop.gold.extend.calGoldRate()+'%</b>)</font></label></div>')
					('<div class="paymentText">Hỗ trợ thẻ của mạng Vinaphone và Mobifone. Áp dụng cho mọi loại mệnh giá thẻ.</div>')
					('<div class="bankPay">')
						('<a class="fl" href="javascript:void(0)"><span id="mobiphone"></span></a>')
						('<a class="fl" href="javascript:void(0)"><span id="vinaphone"></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</div>')
				('<div class="c"></div>')
			('</div>')(),
			online = shop.join
			('<div class="gold-content">')
				('<div class="radioBox mTop5">'+((shop.gold.conf.type != 'self') ? '' : '<input type="radio" value="online" id="radio_online_gold" name="radio_pay_gold"'+(type == 'online'?' checked':'')+' />')+'</div>')
				('<div class="gold-right">')
					('<div class="gold-title"><label for="radio_online_gold">Nạp từ thẻ Visa, Master Card, thẻ ATM, có Internet Banking</label></div>')
					('<div class="paymentText">Số tiền nạp được chuyển tương ứng thành Gold theo tỉ lệ <font color="red">1 Gold ~ 1 VNĐ</font></div>')
					('<div class="creditPay bankPay mTop5">')
						('<span id="visa"></span>')
						('<span id="master"></span>')
						('<a class="fl" href="javascript:void(0)"><span id="vcb"></span></a>')
						('<a class="fl" href="javascript:void(0)"><span id="donga"></span></a>')
						('<a class="fl" href="javascript:void(0)"><span id="techcom"></span></a>')
						('<a class="fl" href="javascript:void(0)"><span id="vietin"></span></a>')
						('<div class="c"></div>')
						('<div class="mTop5">')
							('<a class="fl" href="javascript:void(0)"><span id="hd"></span></a>')
							('<a class="fl" href="javascript:void(0)"><span id="vib"></span></a>')
							('<a class="fl" href="javascript:void(0)"><span id="tp"></span></a>')
						('<div class="c"></div></div>')
					('</div>')
				('</div>')
				('<div class="c"></div>')
			('</div>')(),
			information = '';
			
			if(shop.gold.conf.type != 'self'){
				card = '';
				information = shop.join
				('<div class="gold-customer-re">')
					('<img src="'+shop.gold.conf.re_customer.avatar+'" width="32" border="0" class="fl" />')
					('<div class="fl mLeft10">')
						('<div><b>Họ tên: </b>'+shop.gold.conf.re_customer.name+'</div>')
						('<div class="mTop5"><b>Điện thoại: </b>'+shop.gold.conf.re_customer.phone+'</div>')
						('<div class="mTop5"><b>Email: </b>'+shop.gold.conf.re_customer.email+'</div>')
					('</div>')
					('<div class="c"></div>')
				('</div>')();
			}
			return shop.popupSite(id, title, shop.join
			('<div class="content goldRecharge2" style="padding:10px 20px">')
				('<form name="goldRecharge2Form" id="goldRecharge2Form">')
					(information+'<div id="cError"></div>'+card+online)
					('<div>')
						('<a href="javascript:void(0)" onclick="shop.gold.doRechargeStep2()" class="blueButton  mLeft10" id="fr"><span><span>TIẾP TỤC <b>&raquo;</b></span></span></a>')
						('<a href="javascript:void(0)" onclick="shop.gold.rechargeStep1()" class="blueButton  mLeft10" id="fr"><span><span><b>&laquo;</b> QUAY LẠI</span></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</form>')
			('</div>')());
		},
		rechargeStep3_online:function(id, title){
			return shop.popupSite(id, title, shop.join
			('<div class="content goldRecharge3_online" style="padding:10px 20px">')
				('<form name="goldRecharge3Form_online" id="goldRecharge3Form_online">')
					('<div id="cError"></div>')
					('<div class="gold-content mTop10">')
						('<div class="gold-title" style="margin:0 0 10px 105px">')
							('<div class="fl"><label>Số Gold cần nạp :</label></div>')
							('<div class="fl mLeft5">')
								('<div><input type="text" value="'+shop.gold.conf.gold+'" id="gold_money" name="gold_money" onkeyup="shop.gold.extend.mixMoney(this)" onfocus="this.select()" onkeypress="return shop.numberOnly(this, event)" /> <b style="color:red">1 Gold ~ 1 VNĐ</b></div>')
								('<div class="paymentText" id="mTop5">Mỗi lần nạp phải từ <font color="red">50.000 Gold</font> trở lên</div>')
							('</div>')
							('<div class="c"></div>')
						('</div>')
						('<div class="lineSoha gold-right">')
							('<div class="fl"><a title="pay.soha.vn" target="_blank" href="https://pay.soha.vn/">')
								('<img width="136" height="55" border="0" src="style/images/logoSoha.png">')
							('</a></div>')
							('<div class="sohaInfo creditPay bankPay">')
								('<span id="visa"></span>')
								('<span id="master"></span>')
								('<a class="fl" href="javascript:void(0)"><span id="vcb"></span></a>')
								('<a class="fl" href="javascript:void(0)"><span id="donga"></span></a>')
								('<a class="fl" href="javascript:void(0)"><span id="techcom"></span></a>')
								('<a class="fl" href="javascript:void(0)"><span id="vietin"></span></a>')
								('<div class="c"></div>')
								('<div class="mTop5">')
									('<a class="fl" href="javascript:void(0)"><span id="hd"></span></a>')
									('<a class="fl" href="javascript:void(0)"><span id="vib"></span></a>')
									('<a class="fl" href="javascript:void(0)"><span id="tp"></span></a>')
								('<div class="c"></div></div>')
							('</div>')
							('<div class="c"></div>')
						('</div>')
					('</div>')
					('<div class="mTop10">')
						('<a href="javascript:void(0)" onclick="shop.gold.doRechargeStep3_online()" class="blueButton  mLeft10" id="fr"><span><span>TIẾP TỤC <b>&raquo;</b></span></span></a>')
						('<a href="javascript:void(0)" onclick="shop.gold.rechargeStep2()" class="blueButton  mLeft10" id="fr"><span><span><b>&laquo;</b> QUAY LẠI</span></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</form>')
			('</div>')());
		},
		rechargeStep3_card:function(id, title){
			var type = shop.gold.conf.card_type;
			return shop.popupSite(id, title, shop.join
			('<div class="content goldRecharge3_card" style="padding:10px 20px">')
				('<form name="goldRecharge3Form_card" id="goldRecharge3Form_card">')
					('<div id="cError"></div>')
					//('<center><b style="color:red">Lưu ý: Nạp Gold bằng thẻ cào điện thoại sẽ bị triết khấu <b style="font-size:16px">'+shop.gold.extend.calGoldRate()+'%</b></b><br />(<b>Ví dụ:</b> Thẻ mệnh giá 100.000đ ~ '+shop.numberFormat(shop.gold.conf.rate*100000,'','','.')+' Gold)</center>')
					('<center><b style="color:red">Khuyến mại nạp Gold đến 31/5/2011: Chỉ chiết khấu <span style="font-size:14px">5%</span> (mức cũ là <span style="font-size:14px">10%</span>)</b><br />(<b>Ví dụ:</b> Thẻ mệnh giá 100.000đ ~ '+shop.numberFormat(shop.gold.conf.rate*100000,'','','.')+' Gold)</center>')
					('<div class="gold-content mTop10">')
						('<div class="gold-title">')
							('<div class="fl mTop10"><label>Chọn thẻ cào của mạng :</label></div>')
							('<div class="fl mLeft5 card_type">')
								('<div class="fl" align="center">')
									('<img src="images/blank.gif" width="120" height="30" onclick="shop.gold.extend.chooseTelco(this, \'vinaphone\')" style="cursor:pointer;background:url(images/cards/vinaphone-small.gif) no-repeat 50% 50%" /><br />')
									('<input type="radio" value="vinaphone" id="r_gold_vinaphone" class="radio_info" name="card_gold_type" '+(type=='vinaphone'?'checked ':'')+'/>')
								('</div>')
								('<div class="fl" align="center">')
									('<img src="images/blank.gif" width="120" height="30" onclick="shop.gold.extend.chooseTelco(this, \'mobifone\')" style="cursor:pointer;background:url(images/cards/mobifone-small.gif) no-repeat 50% 50%" /><br />')
									('<input type="radio" value="mobifone" id="r_gold_mobifone" class="radio_info" name="card_gold_type" '+(type=='mobifone'?'checked ':'')+'/>')
								('</div>')
								('<div class="c"></div>')
							('</div>')
							('<div class="c"></div>')
						('</div>')
					('</div>')
					('<div class="gold-content mTop10">')
						('<div class="gold-title">')
							('<div class="fl"><label>Mã số thẻ cào :</label></div>')
							('<div class="fl mLeft5">')
								('<input type="text" id="gold_recharge_code" name="gold_recharge_code" value="" maxlength="30" />')
								('<div style="color: #787878;font-size: 11px;padding-top:5px;text-align: justify;">Vui lòng nhập chính xác mã số in trên thẻ.<br />Hệ thống chỉ cho phép nhập sai không quá 5 lần.</div>')
							('</div>')
							('<div class="c"></div>')
						('</div>')
					('</div>')
					('<div align="center" class="mTop20">')
						('<a href="javascript:void(0)" onclick="shop.gold.doRechargeStep3_card()" class="blueButton  mLeft10" id="fr"><span><span>TIẾP TỤC <b>&raquo;</b></span></span></a>')
						('<a href="javascript:void(0)" onclick="shop.cart.register()" class="blueButton  mLeft10" id="fr"><span><span><b>&laquo;</b> QUAY LẠI</span></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</form>')
			('</div>')());
		}
	},
// Extend process
	extend:{
		checkBox:function(disable){
			var obj = shop.get_ele('gold_email');
			if(disable){
				obj.className = 'gold_email';
				if(obj.value == ''){
					obj.value = obj.title;
				}else if(obj.value != obj.title){
					obj.className = 'gold_email_black';
				}
			}else{
				obj.className = 'gold_email_active';
			}
		},
		focusInput:function(focus){
			var obj = shop.get_ele('gold_email');
			if(focus){
				if(obj.value == obj.title){
					obj.value = '';
				}else{
					obj.select();
				}
				obj.className = 'gold_email_active';
				shop.get_ele('radio_other').checked = true;
				return;
			}
			if(obj.value == ''){
				obj.value = obj.title;
			}else if(!shop.get_ele('radio_other').checked){
				obj.className = 'gold_email_black';
			}
		},
		mixMoney:function(myfield){
			var thousands_sep = ',';
			myfield.value = shop.numberFormat(parseInt(myfield.value.replace(/,/gi, '')),0,'',thousands_sep);
		},
		chooseTelco:function(obj, type){shop.get_ele('r_gold_'+type).checked = true},
		calGoldRate:function(){return 100-(shop.gold.conf.rate*100)}
	}
};
