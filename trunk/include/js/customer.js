shop.customer = {
	logout:function(){
		shop.ajax_popup('task=userLogout',"POST",{},
		function (j) {
			location.reload();
		});
	  return false;
	},
	test:{
		show:function(){
			return 'Test customer';
		}
	},
	password:{
		resendPassword:function(email){
			shop.show_overlay_popup('muachung-resend-password', '',
			shop.customer.password.theme.resendPassword('muachung-resend-password', email),
			{
				background: {'background-color' : 'transparent'},
				border: {
					'background-color' : 'transparent',
					'padding' : '0px'
				},
				title: {'display' : 'none'},
				content: {
					'padding' : '0px',
					'width' : shop.is_ie6() ? '325px' : '315px'
				},
				release:function(){
					//shop.enter('#forgot_email', shop.header.password.submit);
				}
			});
		},
		submit:function(){
			var email = shop.util_trim(jQuery('#forgot_email').val());
			if(email == ''){
				shop.error.set('#forgot_email', 'Chưa nhập email', 230, '.forgot_pasword');
				return false;
			}else if(!shop.is_email(email)){
				shop.error.set('#forgot_email', 'Email không hợp lệ', 230, '.forgot_pasword');
				return false;
			}else{
				shop.error.close('#forgot_email', '.forgot_pasword');
			}
			shop.ajax_popup('act=customer&code=resend-pass',"GET",{email: email},
			function (j) {
				if (j.err == 0 && j.msg == 'success') {
					shop.hide_overlay_popup('muachung-resend-password');
					alert("Thông tin hỗ trợ đã được gửi vào "+email+"\nQuý khách vui lòng làm theo hướng dẫn trong email");
				}else{
					shop.error.set('#forgot_email', j.msg, 230, '.forgot_pasword');
				}
			});
			return true;
		},
		submitFormResendPassword: function(frm){
			if(shop.util_trim(frm.pass.value) == ''){
				frm.pass.focus();
				alert('Chưa nhập mật khẩu');
				return false;
			}else if(frm.pass.value.length < 6){
				frm.pass.focus();
				alert('Mật khẩu tối thiểu phải có 6 kí tự');
				return false;
			}else if(frm.pass1.value == ''){
				frm.pass1.focus();
				alert('Chưa nhập lại mật khẩu');
				return false;
			}else if(frm.pass1.value != frm.pass.value){
				frm.pass1.focus();
				alert('Nhập lại mật khẩu không chính xác');
				return false;
			}
			frm.submit();
			return true;
		},
		theme:{
			resendPassword:function(id, email){
				return shop.popupSite(id, 'Quên mật khẩu', shop.join
					('<div class="content forgot_pasword" style="padding:1px 20px 10px">')
						('<div id="cError"></div>')
						('<div class="label mTop10">Email đã đăng kí:</div>')
						('<div class="input-txt" style="width:260px">')
							('<input type="text" id="forgot_email" name="email" class="txt" style="width:250px" value="'+(email?email:'')+'" />')
						('</div>')
						('<div class="f11">Vui lòng nhập đúng email đã đăng kí để nhận thông tin hỗ trợ lấy lại mật khẩu từ SohaPay</div>')
						('<div class="mTop10">')
							('<div style="width:150px;margin:0 auto">')
								('<a id="fr" class="blueButton mLeft10" onclick="shop.hide_overlay_popup(\''+id+'\')" href="javascript:void(0)"><span><span>Hủy bỏ</span></span></a>')
								('<a id="fr" class="blueButton" onclick="shop.customer.password.submit()" href="javascript:void(0)"><span><span>Gửi đi</span></span></a>')
								('<div class="c"></div>')
							('</div>')
						('</div>')
					('</div>')()
				);
			}
		}
	},
	active:{
		send:function(email){
			shop.show_overlay_popup('muachung-resend-active', '',
			shop.customer.active.theme.sendActive('muachung-resend-active', email),
			{
				background: {'background-color' : 'transparent'},
				border: {
					'background-color' : 'transparent',
					'padding' : '0px'
				},
				title: {'display' : 'none'},
				content: {
					'padding' : '0px',
					'width' : shop.is_ie6() ? '325px' : '315px'
				},
				release:function(){}
			});
		},
		submit:function(){
			var email = shop.util_trim(jQuery('#active_email').val());
			if(email == ''){
				shop.error.set('#active_email', 'Chưa nhập email', 230, '.active_email');
				return false;
			}else if(!shop.is_email(email)){
				shop.error.set('#active_email', 'Email không hợp lệ', 230, '.active_email');
				return false;
			}else{
				shop.error.close('#active_email', '.active_email');
			}
			shop.ajax_popup('act=customer&code=resend-active',"GET",{email: email},
			function (j) {
				if (j.err == 0 && j.msg == 'success') {
					shop.hide_overlay_popup('muachung-resend-active');
					alert("Thông tin kích hoạt đã được gửi vào "+email+"\nQuý khách vui lòng làm theo hướng dẫn trong email");
				}else{
					shop.error.set('#active_email', j.msg, 230, '.active_email');
				}
			});
			return true;
		},
		theme:{
			sendActive:function(id, email){
				return shop.popupSite(id, 'Kích hoạt tài khoản', shop.join
					('<div class="content active_email" style="padding:1px 20px 10px">')
						('<div id="cError"></div>')
						('<div class="label mTop10">Email của Quý khách:</div>')
						('<div class="input-txt" style="width:260px">')
							('<input type="text" id="active_email" name="email" class="txt" style="width:250px" value="'+(email?email:'')+'" />')
						('</div>')
						('<div class="f11">Vui lòng nhập đúng email để nhận được thông tin kích hoạt tài khoản</div>')
						('<div class="mTop10">')
							('<div style="width:205px;margin:0 auto">')
								('<a id="fr" class="blueButton mLeft10" onclick="shop.hide_overlay_popup(\''+id+'\')" href="javascript:void(0)"><span><span>Hủy bỏ</span></span></a>')
								('<a id="fr" class="blueButton" onclick="shop.customer.active.submit()" href="javascript:void(0)"><span><span>Nhận kích hoạt</span></span></a>')
								('<div class="c"></div>')
							('</div>')
						('</div>')
					('</div>')()
				);
			}
		}
	},
	loginHeader: function(){
		shop.customer.login.submit('customer_email','customer_password','customer_save_login',false);
		return false;
	},
	loginPopup: function(){
		shop.customer.login.submit('login_email','login_pass','save_login',true);
		return false;
	},
	login : {
		show:function(){
			if (shop.cart.conf.cart.type=='popup') {
				document.getElementById("tmp").style.display='';
				document.getElementById("tmp").innerHTML = shop.customer.login.theme.form('muachung-login', 'Đăng nhập');
			}
			else {
				shop.show_overlay_popup('muachung-login', 'Đăng nhập',
				shop.customer.login.theme.form('muachung-login', 'Đăng nhập'),
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
						'width' : '400px'
					}
				});
			}
		},
		cancel:function(){
			if (shop.cart.conf.cart.type=='popup') {
				document.getElementById("tmp").style.display='';
				document.getElementById("tmp").innerHTML = shop.cart.theme.regulations('cart-regulations','Chọn hình thức thanh toán');
			}
			else shop.hide_overlay_popup('muachung-login')
		},
		valid:function(id_email, id_pass , popup){
			var jemail = '#'+id_email;
			var jpass = '#'+id_pass;
			var email = shop.util_trim(jQuery(jemail).val());
			if(email == '' || email == 'email đăng nhập'){
				var $msg = 'Chưa nhập email!';
				if(!popup){
					shop.show_popup_message($msg, "Đăng nhập thất bại", -1);
				}
				else{
					shop.error.set(jemail, $msg, 230, '.login_form');
				}
				return false;
			}else if(!shop.is_email(email)){
				var $msg = 'Email không hợp lệ!';
				if(!popup){
					shop.show_popup_message($msg, "Đăng nhập thất bại", -1);
				}
				else{
					shop.error.set(jemail, $msg, 230, '.login_form');
				}
				return false;
			}else{
				shop.error.close(jemail, '.login_form');
			}
			var pass = shop.util_trim(jQuery(jpass).val());
			if(pass == ''){
				var $msg = 'Chưa nhập mật khẩu!';
				if(!popup){
					shop.show_popup_message($msg, "Đăng nhập thất bại", -1);
				}
				else{
					shop.error.set(jpass, $msg, 230, '.login_form');
				}
				return false;
			}else if(pass.length < 6){
				var $msg = 'Mật khẩu tối thiểu phải có 6 kí tự!';
				if(!popup){
					shop.show_popup_message($msg, "Đăng nhập thất bại", -1);
				}
				else{
					shop.error.set(jpass, $msg, 230, '.login_form');
				}
				return false;
			}
			return true;
		},
		submit: function(id_email, id_pass , id_save, popup){
			if(shop.customer.login.valid(id_email,id_pass,popup)){
				var jemail = '#'+id_email;
				var jpass = '#'+id_pass;
				var save = shop.get_ele(id_save);
				var cookie = save.checked ? 1 : 0;
				var post = {
					email: shop.util_trim(jQuery(jemail).val()),
					pass: shop.util_trim(jQuery(jpass).val()),
					save: cookie,
					order_session: shop.cart.conf.cart.order_session
				};
				shop.ajax_popup('task=userLogin','POST',post,
					function(j){
						if (j.err == 0 && j.msg == 'success') {
						  location.reload();
						} else {
							if(!popup){
								shop.show_popup_message(j.msg, "Đăng nhập thất bại", -1);
							}
							else{
								shop.error.set('', j.msg, 230, '.login_form');
							}
						  
						}
					});
			}
		},
		theme:{
			form:function(id, title, close, opt){
				return shop.popupSite(id, title, shop.join
					('<form onsubmit="return shop.customer.loginPopup();" method="post" id="customer_login_form">')
						('<div class="content login_form" style="padding:1px 0 10px">')
							('<div id="cError"></div>')
							('<div class="mTop10">')
								('<table cellpadding="0" cellspacing="5" width="100%">')
									('<tr class="reg_collapse">')
										('<td align="right" width="35%">Email đăng nhập:</td>')
										('<td width="60%"><input type="text" id="login_email" name="email" /></td>')
									('</tr>')
									('<tr class="mTop10 reg_collapse">')
										('<td align="right">Mật khẩu:</td>')
										('<td><input type="password" id="login_pass" name="pass" /></td>')
									('</tr>')
									('<tr>')
										('<td></td>')
										('<td align="left">')
											('<input type="checkbox" id="save_login" />&nbsp;')
											('<span class="login_oke" onclick="shop.customer.login.theme.check()" style="color:#006997">Ghi nhớ đăng nhập</span>')
										('</td>')
									('</tr>')
								('</table>')
							('</div>')
							('<div class="mTop10">')
								('<div style="width:200px;margin:0 auto">')
									('<a id="fr" class="blueButton mLeft10" onclick="shop.customer.login.cancel()" href="javascript:void(0)"><span><span>Hủy bỏ</span></span></a>')
									('<a id="fr" class="blueButton" onclick="shop.customer.loginPopup()" href="javascript:void(0)"><span><span>Đăng nhập</span></span></a>')
									('<input type="submit" onclick="shop.customer.loginPopup();" value="" class="hidden" />')
									('<div class="c"></div>')
								('</div>')
							('</div>')
						('</div>')
					('</form>')(), close, opt
				);
			},
			check:function(){
				var c = shop.get_ele('save_login');
				if(c){
					c.checked = !c.checked
				}
			}
		}
	},
	register : {
		show:function(){
			if (shop.cart.conf.cart.type=='popup') {
				document.getElementById("tmp").style.display='';
				document.getElementById("tmp").innerHTML = shop.customer.register.theme.form('muachung-register', 'Đăng kí');
			}
			else {
				shop.show_overlay_popup('muachung-register', 'Đăng kí',
				shop.customer.register.theme.form('muachung-register', 'Đăng kí'),
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
						'width' : '500px',
						'font-size': '12px'
					},
					release:function(){
						//shop.enter('#reg_full_name', shop.customer.register.submit);
						//shop.enter('#reg_email', shop.customer.register.submit);
						//shop.enter('#reg_pass', shop.customer.register.submit);
						//shop.enter('#reg_pass1', shop.customer.register.submit);
					}
				});
			}
		},
		cancel:function(){
			if (shop.cart.conf.cart.type=='popup') {
				document.getElementById("tmp").style.display='';
				document.getElementById("tmp").innerHTML = shop.cart.theme.regulations('cart-regulations','Chọn hình thức thanh toán');
			}
			else shop.hide_overlay_popup('muachung-register');
		},
		valid:function(){
			var reg_oke = shop.get_ele('reg_oke');
			if(reg_oke && !reg_oke.checked){
				shop.error.set('#reg_oke', 'Vui lòng chấp nhận các điều khoản & quy định của SohaPay', 430, '.register_form');
				return false;
			}
			var email = shop.util_trim(jQuery('#reg_email').val());
			if(email == ''){
				shop.error.set('#reg_email', 'Chưa nhập email', 430, '.register_form');
				return false;
			}else if(!shop.is_email(email)){
				shop.error.set('#reg_email', 'Email không hợp lệ', 430, '.register_form');
				return false;
			}else{
				shop.error.close('#reg_email', '.register_form');
			}
	
			var pass = shop.util_trim(jQuery('#reg_pass').val());
			if(pass == ''){
				shop.error.set('#reg_pass', 'Chưa nhập mật khẩu', 430, '.register_form');
				return false;
			}else if(pass.length < 6){
				shop.error.set('#reg_pass', 'Mật khẩu tối thiểu phải có 6 kí tự', 430, '.register_form');
				return false;
			}else{
				shop.error.close('#reg_pass', '.register_form');
				var pass1 = shop.util_trim(jQuery('#reg_pass1').val());
				if(pass1 == ''){
					shop.error.set('#reg_pass1', 'Chưa nhập lại mật khẩu', 430, '.register_form');
					return false;
				}else if(pass != pass1){
					shop.error.set('#reg_pass1', 'Mật khẩu không khớp', 430, '.register_form');
					return false;
				}else{
					shop.error.close('#reg_pass1', '.register_form');
				}
			}
	
			var reg_phone = shop.util_trim(jQuery('#reg_phone').val());
			if(reg_phone == ''){
				shop.error.set('#reg_phone', 'Chưa nhập số điện thoại', 430, '.register_form');
				return false;
			}else if(!shop.is_phone(reg_phone)){
				shop.error.set('#reg_phone', 'Số điện thoại di động không hợp lệ', 430, '.register_form');
				return false;
			}else{
				shop.error.close('#reg_phone', '.register_form');
			}
			return true;
		},
		submit: function(){
			if(shop.customer.register.valid()){
				var post = {
					email: shop.util_trim(jQuery('#reg_email').val()),
					pass: shop.util_trim(jQuery('#reg_pass').val()),
					phone: shop.util_trim(jQuery('#reg_phone').val()),
					uname: shop.util_trim(jQuery('#reg_full_name').val()),
					address: shop.util_trim(jQuery('#reg_address').val()),
					district: shop.util_trim(jQuery('#reg_listDistrict').val()),
					city: shop.util_trim(jQuery('#city').val()),
					order_session: shop.cart.conf.cart.order_session
				};
	
				shop.ajax_popup('task=Register','POST', post,function(j){
					if (j.err==0){
						shop.customer.register.cancel();
						alert(j.msg);
						window.location.reload();
					}else{
						shop.error.set('', j.msg, 430, '.register_form');
					}
				});
			}
		},
		showPassForm:function(email){
			shop.hide_overlay_popup('muachung-register');
			shop.customer.password.resendPassword(email);
		},
		sendActiveEmail:function(email, active){
			active = active ? active : 0;
			shop.ajax_popup('act=customer&code=email-active','GET',{email: email, active: active},function(j){
				if(j.err == 0){
					shop.hide_overlay_popup('muachung-register');
					alert('Email kích hoạt đã được gửi vào hòm thư:\n'+email+'\nVui lòng kiểm tra và kích hoạt tài khoản.');
				}else{
					alert('Có lỗi xảy ra! Vui lòng thực hiện lại thao tác.');
				}
			});
		},
		theme:{
			form:function(id, title, close, opt){
				var city = '<select name="city" id="city" onchange="shop.district.loadDistrictDropdown(this.value, \'reg_listDistrict\');">';
				city += '<option value="0"> Chọn tỉnh thành phố </option>';
				for(var i in city_list){
					city += '<option value="'+city_list[i].id+'">'+city_list[i].title+'</option>';
				}
				city += '</select>';
				
				return shop.popupSite(id, title, shop.join
					('<form id="bm_register_form">')
						('<div class="content register_form" style="padding:1px 0 10px">')
							('<div id="cError"></div>')
							('<div class="reg_collapse">')
								('<div class="title">Thông tin tài khoản:</div>')
								('<table cellpadding="0" cellspacing="5" align="center" width="100%">')
									('<tr>')
										('<td align="right" width="35%">Email đăng nhập:</td>')
										('<td width="30%"><input type="text" id="reg_email" name="email" /></td>')
										('<td align="left">(<font color="red">*</font>)</td>')
									('</tr>')
									('<tr>')
										('<td align="right">Mật khẩu:</td>')
										('<td><input type="password" id="reg_pass" name="pass" /></td>')
										('<td align="left">(<font color="red">*</font>)</td>')
									('</tr>')
									('<tr>')
										('<td align="right">Nhập lại mật khẩu:</td>')
										('<td><input type="password" id="reg_pass1" name="pass1" /></td>')
										('<td align="left">(<font color="red">*</font>)</td>')
									('</tr>')
								('</table>')
							('</div>')
							('<div class="reg_collapse mTop5">')
								('<div class="title">')
									('<div class="fl">Thông tin cá nhân, địa chỉ chuyển hàng:</div>')
									('<div class="c"></div>')
								('</div>')
								('<table cellpadding="0" cellspacing="5" id="more_info" width="100%">')
									('<tr>')
										('<td align="right" width="32%">Họ tên:</td>')
										('<td width="60%"><input type="text" id="reg_full_name" name="full_name" /></td>')
									('</tr>')
									('<tr>')
										('<td align="right">Địa chỉ nhận hàng:</td>')
										('<td><input type="text" id="reg_address" name="address" /></td>')
									('</tr>')
									('<tr>')
										('<td align="right">Tỉnh/Thành phố:</td>')
										('<td>'+city+'</td>')
									('</tr>')
									('<tr>')
										('<td align="right">Quận/Huyện/Phường:</td>')
										('<td class="customerRegister"><select id="reg_listDistrict" class="w290" name="district"></select></div></td>')
									('</tr>')
								('</table>')
							('</div>')
							('<div class="reg_collapse mTop5">')
								('<div class="title">Thông tin xác thực thanh toán:</div>')
								('<table cellpadding="0" cellspacing="5" width="100%">')
									('<tr>')
										('<td align="right" width="35%">Điện thoại di động:</td>')
										('<td width="30%"><input type="text" id="reg_phone" name="phone" onkeypress="return shop.numberOnly(this,event)" /></td>')
										('<td align="left">(<font color="red">*</font>)</td>')
									('</tr>')
									('<tr>')
										('<td>&nbsp;</td>')
										('<td colspan="2"><div style="color:#787878;font-size:11px;width:260px">(Quý khách phải nhập chính xác số điện thoại để nhận mã số phiếu mua hàng qua tin nhắn SMS)</div></td>')
									('</tr>')
								('</table>')
							('</div>')
							('<div class="mTop10 mLeft15" style="text-align:center;">')
								('<input type="checkbox" id="reg_oke" />')
								('<span class="reg_oke" onclick="shop.customer.register.theme.check()">&nbsp;Tôi đã đọc và chấp nhận các <a href="trang-the-le.html" target="_blank">điểu khoản</a> và <a href="trang-quy-dinh-refund.html" target="_blank">quy định</a> của SohaPay</span>')
							('</div>')
							('<div class="mTop15">')
								('<div style="margin:0 auto; margin-right:45%;">')
									('<a id="fr" class="blueButton mLeft10" onclick="shop.customer.register.cancel()" href="javascript:void(0)"><span><span>Hủy bỏ</span></span></a>')
									('<a id="fr" class="blueButton" onclick="shop.customer.register.submit()" href="javascript:void(0)"><span><span>Đăng kí</span></span></a>')
									('<div class="c"></div>')
								('</div>')
							('</div>')
						('</div>')
					('</form>')(), close, opt
				);
			},
			check:function(){
				var c = shop.get_ele('reg_oke');
				if(c){
					c.checked = !c.checked
				}
			}
		}
	}
};
