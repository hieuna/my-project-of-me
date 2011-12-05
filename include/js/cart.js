
shop.cart = {
//	--------------------------------- config -------------------------------- //
	conf:{
		extra:{},
		product:null,
		user:{fullname:'',email:'',mobile_phone:'',type:'guest',address:'',city:0,district:'',otp:'',note:''},
		customer:{},
		userInfo:1,
		userAddress:1,
		cart:null,
		loto:false,
		atm:{},
		cod:{},
		card:[50000,100000,200000,300000,500000],
		card_post: {},
		card_rate: 9/10,
		shipping:{active:false, COD:false, fee:0, fee_f:'0 đ', feeCOD:0, feeCOD_f:'0 đ', note:'', check:false, code:'SHIP', type:1},
		province: 0,
		bank:{
			'mb_bank': 	'%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+0651100016002%3Cstrong%3E%3Cbr%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+th%C6%B0%C6%A1ng+m%E1%BA%A1i+c%E1%BB%95+ph%E1%BA%A7n+Qu%C3%A2n+%C4%91%E1%BB%99i+-+CN+Hai+B%C3%A0+Tr%C6%B0ng+%28MB%29%3C%2Fstrong%3E',
			'acb_bank': '%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+37182319%3Cbr%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+%C3%81+Ch%C3%A2u+chi+nh%C3%A1nh+H%C3%A0+N%E1%BB%99i+%28ACB%29%3C%2Fstrong%3E',
			'vc_bank': 	'%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+002.1.00.183924.3%3Cbr%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+Vietcombank+%28VCB%29+H%C3%A0+N%E1%BB%99i%3C%2Fstrong%3E',
			'vib_bank': '%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+001704060035755%3Cbr%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+TMCP+Qu%E1%BB%91c+t%E1%BA%BF+Vi%E1%BB%87t+Nam+%28VIB%29%3C%2Fstrong%3E',
			'donga_bank': '%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+002387340001%3Cbr%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+%C4%90%C3%B4ng+%C3%81+chi+nh%C3%A1nh+B%E1%BA%A1ch+Mai+-+H%C3%A0+N%E1%BB%99i%3C%2Fstrong%3E',
			'techcom_bank': '%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+10320141354011%3Cbr%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+Techcombank+CN+Th%C4%83ng+Long%3C%2Fstrong%3E',
			'bidv_bank': '%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+12010000318895%3Cbr%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+BIDV+S%E1%BB%9F+Giao+d%E1%BB%8Bch%3C%2Fstrong%3E',
			'vietinbank': '%3Cp%3E%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+1020.1000.1108.169%3Cbr+%2F%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr+%2F%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+C%C3%B4ng+th%C6%B0%C6%A1ng+Vi%E1%BB%87t+Nam+chi+nh%C3%A1nh+Hai+B%C3%A0+Tr%C6%B0ng%3C%2Fstrong%3E%3C%2Fp%3E',
			'agribank': '%3Cp%3E%3Cstrong%3E-+S%E1%BB%91+TK%3A%3C%2Fstrong%3E+1483.2010.047.40%3Cbr+%2F%3E%3Cstrong%3E-+Ch%E1%BB%A7+t%C3%A0i+kho%E1%BA%A3n%3A%3C%2Fstrong%3E+C%C3%B4ng+ty+C%E1%BB%95+ph%E1%BA%A7n+Truy%E1%BB%81n+th%C3%B4ng+Vi%E1%BB%87t+Nam%3Cbr+%2F%3E%3Cstrong%3E-+Ng%C3%A2n+h%C3%A0ng+AGRIBANK+chi+nh%C3%A1nh+Th%E1%BB%A7+%C4%90%C3%B4%3C%2Fstrong%3E%3C%2Fp%3E'
		}
	},
	test:function(){
		return 'test cart';
	},
//	--------------------------------- main action -------------------------------- //
	buyShortcut: function(id, start, end, buyer, buyer_need, run, is_loto, is_atm, is_cod, is_cop, is_coo){
		run = false;//bo di theo y sep
		if(run && is_loto == 0){
			var theme = shop.cart.theme.buyShortcut(id, start, end, buyer, buyer_need, is_loto, is_atm, is_cod, is_cop, is_coo);
			if(theme != ''){
				shop.get_ele('fastPay'+id).innerHTML = theme;
				return '';
			}
		}
		shop.get_ele('blueTit'+id).style.display = 'none';
	},	
    
    noZeroStep: function (){
        return shop.cart.isOnline() && (!shop.cart.isMobiCard()) && (!shop.cart.isTransfer()) && (!shop.cart.isCOD());
    },
	
	// BEGIN SỰ KIỆN CLICK BUTTON Thanh toán
	addItem: function (jsonCart, type) {	
		shop.cart.doAddItem(jsonCart, type);
	},
	
	doAddItem: function(jsonCart, type){
		shop.cart.guest.restore();

		shop.cart.conf.cod.type = 0;
		shop.cart.conf.atm  = {bank:''};
		shop.cart.conf.shipping = {
			fee: parseInt(jsonCart.order.cart.fee_shipping),
			fee_f: jsonCart.order.cart.fee_shipping_f,
			code:'SHIP',
			feeCOD: parseInt(jsonCart.order.cart.fee_cod),
			feeCOD_f: jsonCart.order.cart.fee_cod_f,
			note: jsonCart.order.cart.note,
			active: false,
			COD: false,
			check: false,
      type: jsonCart.order.cart.ship_typef
		};
		shop.cart.conf.shipping.COD = (jsonCart.order.cart.ptCOD);
		shop.cart.conf.shipping.active = (jsonCart.order.cart.active_shipping==1);
		shop.cart.conf.cart = jsonCart.order;
		
		//cap nhat lai thong tin nguoi mua hang
		shop.cart.guest.update(jsonCart.user);
		if(jsonCart.user.type == 'customer'){
			shop.cart.conf.customer = jsonCart.user;
			shop.cart.conf.customer.gold = parseInt(shop.cart.conf.customer.gold);
			shop.cart.conf.card_rate = jsonCart.card_rate;
		}
		if((type == 'visa') ||
		   (type == 'cop' && shop.cart.isCOP()) ||
		   (type == 'cod' && shop.cart.isCOD()) ||
		   (type == 'coo' && shop.cart.isCOD()) ||
		   (type == 'mcard' && shop.cart.isGOLD()) ||
		   (type == 'atm' && shop.cart.showPaymentMoney())
		){
			shop.cart.conf.cart.payment_id = type;
		}
		shop.cart.conf.cart.type = shop.cart.conf.cart.cart.typeShow;
    if ((top===self) && (shop.cart.conf.cart.type=='popup')){
      return window.location = './merchant_redirect.php?session='+jsSettings.cart.session;
    }
        shop.cart.stepZero();
	},
	// END SỰ KIỆN CLICK BUTTON Thanh toán
	

//	--------------------------------- showing popup -------------------------------- //

	showExtra:function(id, extra){
		shop.show_overlay_popup('cart-extra', extra.title,
		shop.cart.theme.extra('cart-extra', extra.title, id, extra),
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
				'width' : '505px',
				'font-size': '12px'
			}
		});
	},
	stepZero:function(){
        if (shop.cart.noZeroStep()) return shop.cart.stepOne();
        
		if (shop.cart.conf.cart.type=='popup') {
			document.getElementById("tmp").style.display='';
			document.getElementById("tmp").innerHTML = shop.cart.theme.regulations('cart-regulations','Chọn hình thức Thanh toán');
		}
		if (shop.cart.conf.cart.type=='redirect'){
			document.getElementById("tmp").style.display='';
			document.getElementById("tmp").innerHTML = shop.cart.theme.regulations('cart-regulations','Chọn hình thức Thanh toán');
			$('.classic-popup-title').css('display','none');
			$('.bgCartInfoUser').css('display','none');
		}
		jQuery('.paymentChooseType').click(function(){shop.cart.choosePayment(this)})
		.hover(
			function(){
				if(!jQuery(this).hasClass(this.id+'NoActive')){
					jQuery('.pay_active').removeClass('pay_active');
					jQuery(this).addClass('pay_active');
					jQuery('.clicked').addClass('pay_active');
				}
			},
			function(){
				if(!jQuery(this).hasClass(this.id+'NoActive')){
					jQuery('.pay_active').removeClass('pay_active');
					jQuery('.clicked').addClass('pay_active');
				}
			}
		);
		var type = shop.is_exists(shop.cart.conf.cart.payment_id)?shop.cart.conf.cart.payment_id:'';
		if(type == 'atm'){
			shop.cart.restoreBank();
		}
		
		return;
		//////////////////////////////////////////////////////
		
		shop.show_overlay_popup('cart-regulations','Chọn hình thức Thanh toán',
		shop.cart.theme.regulations('cart-regulations','Chọn hình thức Thanh toán'),
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
				'width'   : '710px',
				'height'  : '900px',
				'font-size': '12px'
			},
			release: function(){
				jQuery('.paymentChooseType').click(function(){shop.cart.choosePayment(this)})
				.hover(
					function(){
						if(!jQuery(this).hasClass(this.id+'NoActive')){
							jQuery('.pay_active').removeClass('pay_active');
							jQuery(this).addClass('pay_active');
							jQuery('.clicked').addClass('pay_active');
						}
					},
					function(){
						if(!jQuery(this).hasClass(this.id+'NoActive')){
							jQuery('.pay_active').removeClass('pay_active');
							jQuery('.clicked').addClass('pay_active');
						}
					}
				);
				var type = shop.is_exists(shop.cart.conf.cart.payment_id)?shop.cart.conf.cart.payment_id:'';
				if(type == 'atm'){
					shop.cart.restoreBank();
				}
			}
		});
	},
	stepOne:function(){
		var tpl = shop.cart.theme.register('cart-check-out-step1', 'Nhập thông tin cá nhân');
		if (shop.cart.conf.cart.type=='popup') {
			document.getElementById("tmp").style.display='';
			document.getElementById("tmp").innerHTML = tpl;
			
		}
		if (shop.cart.conf.cart.type=='redirect'){
			document.getElementById("tmp").style.display='';
			document.getElementById("tmp").innerHTML = tpl;
			$('.classic-popup-title').css('display','none');
			$('.bgCartInfoUser').css('display','none');
		}
        
        if (shop.cart.noZeroStep()) $('#stepZeroBtn').css('display', 'none');
        if (shop.cart.conf.cart.type=='popup' || shop.cart.conf.cart.type=='redirect'){
            if (shop.cart.conf.cart.cart.min_order==shop.cart.conf.cart.cart.max_order){
                jQuery('#formQuantity').addClass('hidden');
            }else{
                jQuery('#formQuantity').jNice();
            }
            return;
        }
		/////////////////////////////////////////////////////////////////////
		
		if(tpl != ''){
			shop.show_overlay_popup('cart-check-out-step1', 'Nhập thông tin cá nhân',
			tpl,
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
					'width' : '655px',
					'font-size': '12px'
				},
				release:function(){
					jQuery('#formQuantity').jNice();
				}
			});
		}
	},
	stepTwo:function(back){
		if (shop.cart.conf.cart.type=='popup') {
			var tpl = "";
			if(shop.cart.conf.cart.payment_id == 'cod' || (shop.cart.conf.shipping.check && shop.cart.conf.shipping.active && shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.cart.payment_id != 'coo')){
				var district = (shop.cart.conf.user.type == 'customer' && shop.cart.conf.userAddress == 1) ? shop.cart.conf.customer.district : shop.cart.conf.user.district;
				tpl = shop.cart.theme.moreInfo('cart-check-out-step2', 'Thông tin giao hàng', district);
				
				document.getElementById("tmp").style.display='';
				document.getElementById("tmp").innerHTML = tpl;
				shop.district.loadDistrictDropdown(shop.cart.conf.user.city, 'listDistrict', false, shop.cart.conf.user.district, 1);
			}else{
				if(back){
					shop.cart.stepOne();
				}
				else{
					shop.cart.stepThree();
				}
			}
		}
		if (shop.cart.conf.cart.type=='redirect'){
			var tpl = "";
			if(shop.cart.conf.cart.payment_id == 'cod' || (shop.cart.conf.shipping.check && shop.cart.conf.shipping.active && shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.cart.payment_id != 'coo')){
				var district = (shop.cart.conf.user.type == 'customer' && shop.cart.conf.userAddress == 1) ? shop.cart.conf.customer.district : shop.cart.conf.user.district;
				tpl = shop.cart.theme.moreInfo('cart-check-out-step2', 'Thông tin giao hàng', district);
				
				document.getElementById("tmp").style.display='';
				document.getElementById("tmp").innerHTML = tpl;
				shop.district.loadDistrictDropdown(shop.cart.conf.user.city, 'listDistrict', false, shop.cart.conf.user.district, 1);
			}else{
				if(back){
					shop.cart.stepOne();
				}
				else{
					shop.cart.stepThree();
				}
			}
			$('.classic-popup-title').css('display','none');
			$('.bgCartInfoUser').css('display','none');
		}
		return;
		//////////////////////////////////////////////////////////
		
		
		if(shop.cart.conf.cart.payment_id == 'cod' || (shop.cart.conf.shipping.check && shop.cart.conf.shipping.active && shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.cart.payment_id != 'coo')){
			var district = (shop.cart.conf.user.type == 'customer' && shop.cart.conf.userAddress == 1) ? shop.cart.conf.customer.district : shop.cart.conf.user.district;
			shop.show_overlay_popup('cart-check-out-step2', 'Thông tin giao hàng',
			shop.cart.theme.moreInfo('cart-check-out-step2', 'Thông tin giao hàng', district),
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
					'width' : '415px',
					'font-size': '12px'
				},
				release:function(){
					shop.district.loadDistrictDropdown(shop.cart.conf.user.city, 'listDistrict', false, shop.cart.conf.user.district, 1);
				}
			});
		}else{
			if(back){
				shop.cart.stepOne();
			}
			else{
				shop.cart.stepThree();
			}
		}
	},
	stepThree: function(){
		if (shop.cart.conf.cart.type=='popup') {
			document.getElementById("tmp").style.display='';
			document.getElementById("tmp").innerHTML = shop.cart.theme.confirmProduct('cart-confirm','Thanh toán');
		}else if (shop.cart.conf.cart.type=='redirect') {
			document.getElementById("tmp").style.display='';
			document.getElementById("tmp").innerHTML = shop.cart.theme.confirmProduct('cart-confirm','Thanh toán');
			$('.classic-popup-title').css('display','none');
			$('.bgCartInfoUser').css('display','none');
		}
		else {
			shop.show_overlay_popup('cart-confirm','Thanh toán',
			shop.cart.theme.confirmProduct('cart-confirm','Thanh toán'),
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
					'width' : '815px',
					'font-size': '12px'
				}
			});
		}
	},
	stepRecharge: function(recharge,card_val){
		if (shop.cart.conf.cart.type=='popup') {
			document.getElementById("tmp").style.display='';
			return document.getElementById("tmp").innerHTML = shop.cart.theme.recharge('cart-recharge','Nạp thẻ',recharge,card_val);
		}
		if (shop.cart.conf.cart.type=='redirect'){
			document.getElementById("tmp").style.display='';
			return document.getElementById("tmp").innerHTML = shop.cart.theme.recharge('cart-recharge','Nạp thẻ',recharge,card_val);
			$('.classic-popup-title').css('display','none');
			$('.bgCartInfoUser').css('display','none');
		}
		shop.show_overlay_popup('cart-recharge','Nạp thẻ',
		shop.cart.theme.recharge('cart-recharge','Nạp thẻ',recharge,card_val),
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
				'width' : '415px',
				'font-size': '12px'
			}
		});
	},
	stepFinish: function(){
		if (shop.cart.conf.cart.type=='popup') {
			document.getElementById("tmp").style.display='';
			return document.getElementById("tmp").innerHTML = shop.cart.theme.finish('cart-step-finish','Cám ơn Quý khách đã mua hàng');
		}
		if (shop.cart.conf.cart.type=='redirect'){
			$('.classic-popup-title').css('display','none');
			$('.bgCartInfoUser').css('display','none');
		}
		shop.show_overlay_popup('cart-step-finish','Cám ơn Quý khách đã mua hàng',
		shop.cart.theme.finish('cart-step-finish','Cám ơn Quý khách đã mua hàng'),
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
				'width' : '415px',
				'font-size': '12px'
			}
		});
	},

//	--------------------------------- process cart -------------------------------- //

	processExtra:function(id){
		var checked = false, extra = '';
		jQuery('.radio_extra').each(function(){
			if(this.checked){
				checked = true;
				extra = this.title;
			}
		});
		if(checked){
			shop.cart.doAddItem(id, extra);
		}
	},
	processStepZero:function(){
		if(!jQuery('.paymentChooseType').hasClass('clicked')){
			alert('Quý khách chưa chọn hình thức Thanh toán');
			return;
		}
		var choose = jQuery('.clicked').attr('id');
		if(choose == 'atm' && shop.cart.conf.atm.bank == ''){
			alert('Quý khách chưa chọn ngân hàng để chuyển tiền vào');
			return;
		}
		shop.cart.conf.cart.payment_id = choose;
		if(shop.cart.conf.cart.payment_id=='visa'){
			shop.cart.conf.cart.payment = 1;
		}else if(shop.cart.conf.cart.payment_id=='mcard'){
			shop.cart.conf.cart.payment = 2;
			if(shop.cart.conf.customer.active == 0){
				alert('Quý khách vui lòng kích hoạt Email trước khi nạp Gold');
				shop.hide_overlay_popup('cart-regulations');
				shop.customer.register.sendActiveEmail(shop.cart.conf.customer.email, 1);
				return;
			}
		}else{
			shop.cart.conf.cart.payment = 0;
		}
		
		shop.cart.stepOne();
	},
	register:function(){
		var frm = document.cartRegisterForm, fname = '',tel   = '',email = '',otp = '';
		if(shop.cart.conf.user.type == 'customer' && shop.cart.conf.userInfo == 1){
			fname = shop.cart.conf.customer.fullname;
			tel = shop.cart.conf.customer.mobile_phone;
			email = shop.cart.conf.customer.email;
		}else{
			if(frm.cart_fullname){
				fname = shop.util_trim(frm.cart_fullname.value);
				if(fname == ''){
					shop.error.set('#'+frm.cart_fullname.id, 'Chưa nhập họ tên', 430, '.reg_cart_form');
					return;
				}else if(!shop.is_fullname(fname)){
					shop.error.set('#'+frm.cart_fullname.id, 'Họ tên bạn nhập vào không hợp lệ', 430, '.reg_cart_form');
					return;
				}else{
					shop.error.close('#'+frm.cart_fullname.id, '.reg_cart_form');
				}
			}

			if(frm.cart_tel){
				tel = shop.util_trim(frm.cart_tel.value);
				if(tel == ''){
					shop.error.set('#'+frm.cart_tel.id, 'Chưa nhập Số điện thoại', 430, '.reg_cart_form');
					return;
				}else if (!shop.is_phone(tel)){
				    shop.error.set('#'+frm.cart_tel.id, 'Số điện thoại không hợp lệ', 430, '.reg_cart_form');
					return;
				}
				else{
					shop.error.close('#'+frm.cart_tel.id, '.reg_cart_form');
				}
			}

			if(frm.cart_email){
				email = shop.util_trim(frm.cart_email.value);
				if(email == ''){
					shop.error.set('#'+frm.cart_email.id, 'Chưa nhập địa chỉ email', 430, '.reg_cart_form');
					return;
				}else if(!shop.is_email(email)){
					shop.error.set('#'+frm.cart_email.id, 'Địa chỉ email không hợp lệ', 430, '.reg_cart_form');
					return;
				}
				else{
					shop.error.close('#'+frm.cart_email.id, '.reg_cart_form');
				}
			}
		}

		var shipping = -1;
		if(shop.cart.conf.cart.payment_id == 'cop' || shop.cart.conf.cart.payment_id == 'cod' || shop.cart.conf.cart.payment_id == 'coo'){
			//ship process
			shipping = shop.cart.conf.shipping.feeCOD;
			shop.cart.conf.shipping.code = "COD";
			shop.cart.conf.shipping.check = true;
			if(shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.customer.ignore_otp){
				//bo qua buoc nhap OTP
				otp = '';
			}else{
				//opt process
				var checkOtp = '',limit = 1;
				if(shop.cart.conf.cart.payment_id == 'cop'){
					limit = shop.cart.conf.cart.numberOtp;
				}
				for(var i=1;i<=limit;i++){
					checkOtp = shop.get_ele('otp'+i);
					if(checkOtp && shop.util_trim(checkOtp.value)!=''){
						otp = otp+checkOtp.value+(i==limit?'':',');
						shop.error.close('#otp'+i, '.reg_cart_form');
					}else{
						shop.error.set('#otp'+i, 'Chưa nhập mật khẩu', 430, '.reg_cart_form');
						return;
					}
				}
				//kiem tra ma otp trug nhau
				if(shop.cart.conf.cart.payment_id == 'cop'){
					for(var i=1;i<=limit;i++){
						var nowOtp = shop.util_trim(shop.get_ele('otp'+i).value);
						for(var j=1;j<=limit;j++){
							if(i!=j){
								if(nowOtp == shop.util_trim(shop.get_ele('otp'+j).value)){
									shop.error.set('#otp'+j, 'Mật khẩu trùng nhau', 430, '.reg_cart_form');
									return;
								}
							}
						}
					}
				}
			}
		}else{
			shipping = shop.cart.conf.shipping.fee;
			shop.cart.conf.shipping.code = "SHIP";
			if(shop.get_ele('shipping-check')){
				shop.cart.conf.shipping.check = shop.get_ele('shipping-check').checked;
			}else{
				shop.cart.conf.shipping.check = false;
			}
		}

		shop.ajax_popup('task=cartRegister',"POST",{
			email: email, tel: tel, fullname: fname, address:'', otp: otp,
			shipping: shop.cart.conf.shipping.check ? shipping : -1,
			ship_active: (shop.cart.conf.shipping.active || shop.cart.conf.shipping.COD) ? 1 : 0,
			ship_code: shop.cart.conf.shipping.code,
			quantity: shop.cart.conf.cart.numberOtp,
      session: (jsSettings.cart.session!='undefined')?jsSettings.cart.session:''
		},
		function (j) {
			if (j.err == 0) {
				//shop.hide_overlay_popup('cart-check-out-step1');
				//update cart
				shop.cart.conf.cart.total = parseInt(j.total);
				shop.cart.conf.cart.total_price = j.total_price;
				shop.cart.conf.cart.cart.shipping_fee_f = j.total_ship;
				shop.cart.conf.cart.cart.price_total_f = j.total_price_noship;
				//update user info
				shop.cart.conf.user.email = j.email;
				shop.cart.conf.user.fullname = j.fullname;
				shop.cart.conf.user.mobile_phone = j.mobile_phone;
				shop.cart.conf.user.otp = j.otp;
				//save user info by cookie
				shop.cart.guest.save(j);
				shop.cart.stepTwo();
			} else {
				switch(j.msg){
					case 'email':shop.error.set('#cart_'+j.msg, 'Email đã được sử dụng', 430, '.reg_cart_form');break;
					case 'empty_mail':shop.error.set('#cart_'+j.msg, 'Chưa nhập địa chỉ email', 430, '.reg_cart_form');break;
					case 'otp_input':shop.error.set('#reg_otp', 'Chưa nhập mật khẩu', 430, '.reg_cart_form');break;
					case 'otp_expired':case 'otp_duplicate':
						for(var i in j.data){
							shop.error.set('#otp'+i, (j.msg=='otp_expired'?'Mật khẩu không đúng hoặc đã hết hạn':'Mật khẩu bị trùng nhau'), 430, '.reg_cart_form');
						}
					break;
					case 'invalid_min':shop.error.set('', 'Bạn phải mua tối thiểu '+shop.cart.conf.cart.cart.min_order+' sản phẩm', 430, '.reg_cart_form');break;
					case 'invalid_quantity':
						j.msg = 'Sản phẩm đã bán hết';
						if(j.quantity > 0){
							j.msg = 'Chỉ còn '+j.quantity+' sản phẩm';
						}
						shop.error.set('', j.msg, 430, '.reg_cart_form');
					break;
					case 'loto_overflow':
						j.msg = 'Quý khách đã mua <b>'+j.loto_now+'</b> vé số. Do đó Quý khách chỉ được mua thêm <b>'+j.loto_valid+'</b> vé số.';
						shop.error.set('', j.msg, 520, '.reg_cart_form');
					break;
				}
			}
		});
	},
	moreInfo:function(back){
		var frm = document.cartAddressForm;
		if(shop.cart.conf.user.type == 'customer' && shop.cart.conf.userAddress == 1){
			shop.cart.conf.user.address = shop.cart.conf.customer.address;
			shop.cart.conf.user.city = shop.cart.conf.customer.city;
			shop.cart.conf.user.district = shop.cart.conf.customer.district;
      shop.cart.conf.user.district_id = shop.cart.conf.customer.district_id;
			shop.cart.conf.user.note = shop.util_trim(frm.cart_note2.value);
		}
		else{
			var address = '', city = 0, district = '';
			if(frm.cart_address){
				address = shop.util_trim(frm.cart_address.value);
				if(address == ''){
					shop.error.set('#'+frm.cart_address.id, 'Chưa nhập Số nhà, Đường/Phố, Phường/Xã', 320, '.cartMoreAddress'); return;
				}else if(address.length < 10){
					shop.error.set('#'+frm.cart_address.id, 'Vui lòng nhập chi tiết hơn', 320, '.cartMoreAddress');
					return;
				}else{
					shop.error.close('#'+frm.cart_address.id, '.cartMoreAddress');
				}
			}
			if(frm.district){
				district = shop.util_trim(frm.district.value);
				if(district == ''){
					shop.error.set('#'+frm.district.id, 'Chưa nhập Quận/Huyện', 320, '.cartMoreAddress');
					return;
				}else{
					shop.error.close('#'+frm.district.id, '.cartMoreAddress');
				}
			}
			if(frm.cart_city){
				city = parseInt(frm.cart_city.value);
				if(city <= 0){
					shop.error.set('#'+frm.cart_city.id, 'Chưa chọn tỉnh thành', 320, '.cartMoreAddress');
					return;
				}else{
					shop.error.close('#'+frm.cart_city.id, '.cartMoreAddress');
				}
			}
			shop.cart.conf.user.address = address;
			shop.cart.conf.user.city = city;
			shop.cart.conf.user.district = frm.district.options[frm.district.selectedIndex].innerHTML;
      shop.cart.conf.user.district_id = frm.district.options[frm.district.selectedIndex].value;
      shop.cart.conf.user.is_urban = shop.district.listDistrictDropdown[frm.district.value].is_urban;
			shop.cart.conf.user.note = shop.util_trim(frm.cart_note.value);
		}
		shop.cart.guest.save(shop.cart.conf.user);
    
    // Tính toán lại tiền ship hàng
    shop.cart.conf.shipping.fee = (shop.cart.conf.user.is_urban=='0')?jsonCart.order.site_shipping_suburb_fee:jsonCart.order.site_shipping_urban_fee;
    shop.cart.conf.shipping.fee_f = shop.numberFormat(shop.cart.conf.shipping.fee)+' đ';
    shop.cart.conf.cart.cart.shipping_fee_f = shop.cart.conf.shipping.fee_f; 
    
    shop.cart.conf.cart.total = parseInt(shop.cart.conf.cart.cart.price)*shop.cart.conf.cart.numberOtp+parseInt(shop.cart.conf.shipping.fee);
		shop.cart.conf.cart.total_price = shop.numberFormat(shop.cart.conf.cart.total)+' đ';
    
		shop.cart.stepThree();
	},
	finishOrder: function(){
		var post, card = shop.cart.conf.cart.payment,	note =  '', city = 0, district_id=0, district = '', address = '', g_note = '';

		/*if(shop.cart.conf.user.type == 'guest' && !shop.get_ele('check-regulations').checked){
			alert('Quý khách chưa tích vào mục đã đọc và đồng ý các điều khoản và quy định của SohaPay');
			return;
		}*/
		if(shop.cart.conf.cart.payment_id == 'cod' || (shop.cart.conf.shipping.check && shop.cart.conf.shipping.active && shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.cart.payment_id != 'coo')){
			city = shop.cart.conf.user.city;
			district = shop.cart.conf.user.district;
      district_id = shop.cart.conf.user.district_id;
			address = shop.cart.conf.user.address;
			g_note = shop.cart.conf.user.note;
			if(city == 0 || district == '' || address == ''){
				alert('Vui lòng kiểm tra lại thông tin giao hàng.\nHiện tại đang thiếu thông tin: '+(address==''?' Địa chỉ.':'')+(district==''?' Quận/Huyện/Phường.':'')+(city<=0?' Tỉnh/Thành phố.':''));
				return;
			}
		}

		if(shop.cart.conf.cart.payment_id == 'cod'){
			note = 'Giao+h%C3%A0ng+v%C3%A0+Nh%E1%BA%ADn+ti%E1%BB%81n+t%E1%BA%A1i+nh%C3%A0';
		}else if(shop.cart.conf.cart.payment_id == 'coo'){
			note = 'Tr%E1%BA%A3+ti%E1%BB%81n+v%C3%A0+Nh%E1%BA%ADn+h%C3%A0ng+t%E1%BA%A1i+V%C4%83n+ph%C3%B2ng+c%E1%BB%A7a+SohaPay';
		}else if(shop.cart.conf.atm.bank!= ''){
			if(shop.is_exists(shop.cart.conf.bank[shop.cart.conf.atm.bank])){
				note += shop.cart.conf.bank[shop.cart.conf.atm.bank];
			}else{
				shop.cart.conf.atm.bank = 'mb_bank';
				note += shop.cart.conf.bank[shop.cart.conf.atm.bank];
			}
		}
    
		post = {
			paymentType: card,
			atm: shop.cart.conf.atm.bank,
			adminNote:note,
			quantity:shop.cart.conf.cart.numberOtp,
			city: city,
			district: district,
      district_id: district_id,
      
			address: address,
			note: g_note,
      session: (jsSettings.cart.session!='undefined')?jsSettings.cart.session:''
		};
		//submit
		shop.cart.finishSubmit(post);
	},
	recharge:function(){
		if(!shop.is_exists(shop._store.variable['recharge_start'])){
			shop._store.variable['recharge_start'] = false;
		}
		if(!shop._store.variable['recharge_start']){
			var frm = document.cartRechargeForm, code = '', card_type = '';
			if(frm.cart_recharge){
				if(!shop.get_ele('r_vinaphone').checked && !shop.get_ele('r_mobifone').checked){
					shop.error.set('', 'Chưa chọn loại thẻ cào', 340, '.cartRecharge'); return;
				}else{
					card_type = shop.get_ele('r_vinaphone').checked ? 'vinaphone' : 'mobifone';
					shop.error.close('', '.cartRecharge');
				}
				
				code = shop.util_trim(frm.cart_recharge.value);
				if(code == ''){
					shop.error.set('#'+frm.cart_recharge.id, 'Chưa nhập mã số thẻ cào', 340, '.cartRecharge'); return;
				}else if(code.length < 12){
					shop.error.set('#'+frm.cart_recharge.id, 'Mã số thẻ không hợp lệ', 340, '.cartRecharge'); return;
				}else{
					shop.error.close('#'+frm.cart_recharge.id, '.cartRecharge');
				}
	
				shop.cart.cardType.save(card_type);
				shop.ajax_popup('act=cart&code=recharge',"POST",{code_card:code, card_type: card_type, total:shop.cart.conf.cart.total},
				function(j){
					shop._store.variable['recharge_start'] = false;
					if(j.err == 0)	{
						shop.cart.conf.customer.gold = parseInt(j.gold);
						if(shop.cart.conf.customer.gold >= shop.cart.conf.cart.total){
							shop.cart.finishSubmit(shop.cart.conf.card_post);
						}else{
							shop.cart.stepRecharge(j.recharge,j.card_val);
						}
					}else{
						var id = '';
						switch(j.msg){
							case 'not_connect': j.msg = 'Không kết nối được với nhà cung cấp'; break;
							case 'cus_not_found': j.msg = 'Hiện tại bạn đang không đăng nhập.<br />Vui lòng tắt cửa sổ, mua lại'; break;
							case 'code_invalid': case 'invalid_card': case 'error':
								j.msg = 'Mã số thẻ không hợp lệ';
								id = '#'+frm.cart_recharge.id;
							break;
						}
						shop.error.set(id, j.msg, 340, '.cartRecharge');
					}
				},
				{
					loading:function(){
						shop._store.variable['recharge_start'] = true;
						shop.error.set('', 'Hệ thống đang kiểm tra mã thẻ.<br />Quý khách vui lòng <b>không tắt trình duyệt</b>.', 340, '.cartRecharge');
						shop.show_loading('Đang kiểm tra Mã thẻ');
					}
				});
			}
		}
	},
	finishSubmit:function(post){
		shop.ajax_popup('task=cartFinish',"POST",post,
		function(j){
			if(j.err == 0)	{
				shop.cart.conf.cart.payment == 2
				switch(post.paymentType){
					case 0:
						shop.cookie.set('guest_otp', '');
						shop.cart.stepFinish();
						window.parent.location.href = j.url;
						break;
					case 1:
						shop.cart.conf.cart = j;
						window.parent.location.href = j.urlSohaPay;
						break;
					case 2:
						if(shop.is_exists(j.more_gold)){
							shop.cart.conf.card_post = post;
							shop.cart.conf.customer.gold = j.gold;
							shop.cart.conf.customer.more_gold = j.more_gold;
							shop.cart.conf.cart.total = j.total;
							shop.cart.stepRecharge();
						}else{
							shop.cart.stepFinish();
							window.parent.location.href = j.url;
						}
						break;
				}
			}else{
				switch(j.msg){
					case 'otp_expired': j.msg = 'Mật khẩu đã hết hạn hoặc không đúng'; break;
					case 'invalid_min': j.msg = 'Bạn phải mua tối thiểu '+shop.cart.conf.cart.cart.min_order+' sản phẩm'; break;
					case 'invalid_quantity':
						j.msg = 'Sản phẩm đã bán hết';
						if(j.quantity > 0){
							j.msg = 'Chỉ còn '+j.quantity+' sản phẩm';
						}
					break;
					case 'cus_not_found': j.msg = 'Hiện tại bạn đang không đăng nhập.<br />Vui lòng tắt cửa sổ, mua lại'; break;
					case 'loto_overflow':
						j.msg = 'Quý khách đã mua '+j.loto_now+' vé số.<br />Do đó Quý khách chỉ được mua thêm '+j.loto_valid+' vé số';
					break;
				}
				shop.show_popup_message(j.msg,'Thông báo lỗi',-1);
			}
		});
	},

//	--------------------------------- cart theme -------------------------------- //

	theme:{
		buyShortcut:function(id, start, end, buyer, buyer_need, is_loto, is_atm, is_cod, is_cop, is_coo){
			var online = shop.join
			('<div class="shortcut">')
				('<a href="javascript:void(0)" class="sc_online" onclick="shop.cart.addItem('+id+', '+start+', '+end+', '+buyer+', '+buyer_need+', \'visa\')" onmouseover="shop.cart.showTip(this)" onmouseout="shop.cart.hideTip(this)"></a>')
				('<div class="tipc hidden"><div class="tool_tip_arrow"></div><div class="tool_tip" style="width:245px">Visa/MasterCard, thẻ ATM, InternetBanking</div></div>')
			('</div>')(),
			gold = shop.join
			('<div class="shortcut">')
				('<a href="javascript:void(0)" class="sc_gold" onclick="shop.cart.addItem('+id+', '+start+', '+end+', '+buyer+', '+buyer_need+', \'mcard\')" onmouseover="shop.cart.showTip(this)" onmouseout="shop.cart.hideTip(this)"></a>')
				('<div class="tipc hidden"><div class="tool_tip_arrow"></div><div class="tool_tip" style="width:140px;left:-54px">Gold, Thẻ cào điện thoại</div></div>')
			('</div>')(),
			cod = shop.join
			('<div class="shortcut">')
				('<a href="javascript:void(0)" class="sc_cod" onclick="shop.cart.addItem('+id+', '+start+', '+end+', '+buyer+', '+buyer_need+', \'cod\')" onmouseover="shop.cart.showTip(this)" onmouseout="shop.cart.hideTip(this)"></a>')
				('<div class="tipc hidden"><div class="tool_tip_arrow"></div><div class="tool_tip" style="width:90px;left:-27px">Thu tiền tại nhà</div></div>')
			('</div>')(),
			cop = shop.join
			('<div class="shortcut">')
				('<a href="javascript:void(0)" class="sc_cop" onclick="shop.cart.addItem('+id+', '+start+', '+end+', '+buyer+', '+buyer_need+', \'cop\')" onmouseover="shop.cart.showTip(this)" onmouseout="shop.cart.hideTip(this)"></a>')
				('<div class="tipc hidden"><div class="tool_tip_arrow"></div><div class="tool_tip" style="width:120px;left:-47px">Trả tiền tại cửa hàng</div></div>')
			('</div>')(),
			coo = shop.join
			('<div class="shortcut">')
				('<a href="javascript:void(0)" class="sc_coo" onclick="shop.cart.addItem('+id+', '+start+', '+end+', '+buyer+', '+buyer_need+', \'coo\')" onmouseover="shop.cart.showTip(this)" onmouseout="shop.cart.hideTip(this)"></a>')
				('<div class="tipc hidden"><div class="tool_tip_arrow"></div><div class="tool_tip" style="width:205px;left:-90px">Thanh toán tại VP của SohaPay</div></div>')
			('</div>')(),
			atm = shop.join
			('<div class="shortcut">')
				('<a href="javascript:void(0)" class="sc_atm" onclick="shop.cart.addItem('+id+', '+start+', '+end+', '+buyer+', '+buyer_need+', \'atm\')" onmouseover="shop.cart.showTip(this)" onmouseout="shop.cart.hideTip(this)"></a>')
				('<div class="tipc hidden"><div class="tool_tip_arrow"></div><div class="tool_tip" style="width:80px;left:-27px">Chuyển khoản</div></div>')
			('</div>')(),
			payment = is_loto ? '' : online;
			payment += gold;
			if(is_cod){
				payment += cod;
			}else if(is_cop){
				payment += cop;
			}else if(is_coo){
				payment += coo;
			}
			if(is_atm){
				payment += atm;
			}
			return payment;
		},
		extra:function(id, title, item_id, extra){
			if(extra && shop.is_exists(extra.opts)){
				var extra_html = '';//'<div>'+extra.title+'</div>';
				for(var i=0;i<extra.opts.length;i++){
					extra_html += '<div class="mTop10"><input type="radio" class="radio_extra" name="extra" id="extra'+i+'" title="'+extra.opts[i]+'" /> <label for="extra'+i+'">'+extra.opts[i]+'</label></div>';
				}
				return shop.popupSite(id, title, shop.join
				('<div class="content" style="padding:20px">')
					('<div id="cError"></div>')
					('<div>'+extra_html+'</div>')
					('<div align="center" class="mTop15">')
						('<a href="javascript:void(0)" onclick="shop.cart.processExtra('+item_id+')" class="orangeButton"><span><span>Tiếp tục</span></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</div>')());
			}
			return '';
		},
		regulations:function(id, title){
			moreInfo = '';
			/*if(shop.cart.conf.user.type == 'customer'){
				moreInfo = '<div class="bgCartInfoUser"><div style="width:136px; height:40px; float:left;"><img src="templates/images/logo-footer.png" height="35" /></div><div style="top:40px;" class="customerLogin" id="userHeader"><div class="user_hello mt1">Xin chào <a href="user_info.php" target="_blank">'+shop.cart.conf.customer.fullname+'</a>, <a href="javascript:void(0);" onclick="shop.customer.logout();"><font color="red">[thoát]</font></a></div><div class="user_gold mt1">Gold: <b>'+shop.cart.theme.numberFormat(shop.cart.conf.customer.gold)+'</b> &nbsp;&nbsp;</div></div></div>';
			}
			else {
				moreInfo = '<div class="bgCartInfoUser"><div style="width:136px; height:40px; float:left;"><img src="templates/images/logo-footer.png" height="35" /></div><div style="top:40px;padding: 20px 0 0 60px;border:none;" class="customerLogin" id="userHeader"><a href="javascript:void(0)" onclick="shop.customer.login.show()">Đăng nhập</a> | <a href="javascript:void(0)" onclick="shop.customer.register.show()">Đăng ký</a></div></div>';	
			}*/
			var type = shop.is_exists(shop.cart.conf.cart.payment_id)?shop.cart.conf.cart.payment_id:'',
			notActive= '<div class="notActive"></div>',
			
			visaCard = shop.join
			('<div class="paymentChooseType sendOnline'+(!shop.cart.isOnline()?' hidden': ( type=='visa'?' pay_active clicked':'') )+'" id="visa">')
				('<div class="arrowRight">')
					('<div class="radioBox"><input type="radio" name="radio_pay" id="radio_visa" value="visa" '+(type=='visa'?'checked':'')+' /></div>')
					('<div class="paymentContent">')
						('<div class="paymentTitle">Thanh toán online dùng Visa, Master Card, thẻ ATM, tài khoản có Internet Banking</div>')
						('<div class="paymentText">Thanh toán nhanh gọn và có thể mua hàng hoặc sử dụng ngay dịch vụ sau khi Thanh toán.</div>')
						('<div class="creditPay bankPay">')
							('<span id="visa"></span>')
							('<span id="master"></span>')
							('<a class="fl" href="javascript:void(0)"><span id="vcb"></span></a>')
							('<a class="fl" href="javascript:void(0)"><span id="donga"></span></a>')
							('<a class="fl" href="javascript:void(0)"><span id="techcom"></span></a>')
							('<a class="fl" href="javascript:void(0)"><span id="vietin"></span></a>')
							('<a class="bank_more_link" href="javascript:void(0)" onclick="shop.cart.showOnlineBank(this)">[ Thêm... ]</a>')
							('<div class="c"></div>')
							('<div class="view_more_bank hidden mTop5">')
								('<a class="fl" href="javascript:void(0)"><span id="hd"></span></a>')
								('<a class="fl" href="javascript:void(0)"><span id="vib"></span></a>')
								('<a class="fl" href="javascript:void(0)"><span id="tp"></span></a>')
								('<div class="c"></div>')
							('</div>')
						('</div>')
					('</div>')
					('<div class="c"></div>')
					('<ul class="paymentText paymentGuide'+(type=='visa' ? '' : ' hidden')+'">')
						('<li>Không mất phí Thanh toán</li>')
						('<li>Thẻ của Quý khách phải được kích hoạt chức năng Thanh toán trực tuyến hoặc đã đăng ký Internet Banking</li>')
						('<li>Thanh toán nhanh gọn và có thể sử dụng dịch vụ ngay sau khi Thanh toán.</li>')
					('</ul>')
				('</div>')
			('</div>')(),
			mcard = shop.join
			('<div class="paymentChooseType sendGold'+(!shop.cart.isMobiCard()?' hidden': (type=='mcard'?' pay_active clicked':'') )+'" id="mcard">')
				('<div class="arrowRight">')
					('<div class="radioBox"><input type="radio" name="radio_pay" id="radio_mcard" value="mcard" '+(type=='mcard'?'checked':'')+' /></div>')
					('<div class="paymentContent">')
						('<div class="paymentTitle">Thanh toán bằng Soha Gold <span>(1 Gold ~ 1 VNĐ)</span></div>')
						('<div class="paymentText"> Dùng Gold có trong tài khoản để thanh toán. Quý khách có thể nạp thêm Gold để mua hàng được nhanh chóng và dễ dàng hơn.</div>')
						//('<div class="bankPay">')
							//('<a class="fl" href="javascript:void(0)"><span id="mobiphone"></span></a>')
							//('<a class="fl" href="javascript:void(0)"><span id="vinaphone"></span></a>')
							//('<div class="c"></div>')
						//('</div>')
					('</div>')
					('<div class="c"></div>')
					('<ul class="paymentText paymentGuide'+((type=='mcard'&&shop.cart.isGOLD()) ? '' : ' hidden')+'">')
						('<li>Soha Gold có được do Quý khách đã nạp vào tài khoản tại SohaPay</li>')
						('<li>Quý khách có thể nạp Soha Gold bằng thẻ cào điện thoại. Nạp thẻ sẽ bị trừ 5% phí (VD thẻ cào 100.000đ sẽ được 95.000 Gold)</li>')
						('<li>Quý khách có thể nhờ người khác nạp hộ Soha Gold vào tài khoản của Quý khách bằng chức năng Nạp Gold trong trang cá nhân tại SohaPay.</li>')
					('</ul>')
				('</div>')
			('</div>')(),
			cod = shop.join
			('<div class="paymentChooseType sendCod'+(type=='cod'?' pay_active clicked':'')+(shop.cart.isCOD()?'':' hidden')+'" id="cod">')
				('<div class="arrowRight pBottom10">')
					('<div class="radioBox"><input type="radio" name="radio_pay" id="radio_cod" value="cod" '+(type=='cod'?'checked':'')+' /></div>')
					('<div class="paymentContent">')
						('<div class="paymentTitle">Giao phiếu và Thu tiền tại nhà <span>('+(shop.cart.conf.shipping.feeCOD>0?('Mất thêm phí '+shop.cart.conf.shipping.feeCOD_f+'/'+shop.cart.conf.cart.cart.unit):'Miễn phí')+')</span></div>')
						('<div class="paymentText">Trong thời gian từ 2-7 ngày làm việc, nhân viên '+shop.cart.conf.cart.site_name+' sẽ giao phiếu đến tận nơi cho Quý khách và thu tiền.</div>')
					('</div>')
					('<div class="c"></div>')
					('<ul class="paymentText paymentGuide'+((type=='cod' && shop.cart.isCOD()) ? '' : ' hidden')+'">')
						('<li>Quý khách có thể bị mất phí khi chọn hình thức này.</li>')
						('<li>Nhân viên giao phiếu của '+shop.cart.conf.cart.site_name+' sẽ liên hệ với Quý khách trước khi giao</li>')
						('<li>Quý khách chỉ được sử dụng dịch vụ sau khi đã Thanh toán tiền cho nhân viên giao phiếu.</li>')
					('</ul>')
				('</div>')
			('</div>')(),
			bank = shop.join
			('<div class="bank'+(shop.cart.conf.cart.payment_id == 'atm'?'':' hidden')+'">')
				('<div class="bank_title">Chọn ngân hàng của SohaPay mà Quý khách sẽ chuyển tiền vào:</div>')
				('<div class="bank_info">')
					('<div class="bank_detail"></div>')
					('<div>')
						('<a href="javascript:void(0)" onclick="shop.cart.listBank()" class="bank_go">Chọn ngân hàng khác</a>')
						('<div class="c"></div>')
					('</div>')
				('</div>')
				('<div class="bank_list">')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'vc_bank\')" class="fl'+(shop.cart.conf.atm.bank=='vc_bank'?' active':'')+'"><span id="vcb"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'donga_bank\')" class="fl'+(shop.cart.conf.atm.bank=='donga_bank'?' active':'')+'"><span id="donga"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'techcom_bank\')" class="fl'+(shop.cart.conf.atm.bank=='techcom_bank'?' active':'')+'"><span id="techcom"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'agribank\')" class="fl'+(shop.cart.conf.atm.bank=='agribank'?' active':'')+'"><span id="agri"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'bidv_bank\')" class="fl'+(shop.cart.conf.atm.bank=='bidv_bank'?' active':'')+'"><span id="bidv"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'vietinbank\')" class="fl'+(shop.cart.conf.atm.bank=='vietinbank'?' active':'')+'"><span id="vietin"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'mb_bank\')" class="fl'+(shop.cart.conf.atm.bank=='mb_bank'?' active':'')+'"><span id="mb"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'acb_bank\')" class="fl'+(shop.cart.conf.atm.bank=='acb_bank'?' active':'')+'"><span id="acb"></span></a>')
					('<a href="javascript:void(0)" onclick="shop.cart.chooseBank(this, \'vib_bank\')" class="fl'+(shop.cart.conf.atm.bank=='vib_bank'?' active':'')+'"><span id="vib"></span></a>')
					('<div class="c"></div>')
				('</div>')
			('</div>')(),
			atm = shop.join
			('<div class="paymentChooseType sendAtm '+(!shop.cart.isTransfer()?'hidden' : (type=='atm'?' pay_active clicked':'') )+'" id="atm">')
				('<div class="arrowRight">')
					('<div class="radioBox"><input type="radio" name="radio_pay" id="radio_atm" value="atm" '+(type=='atm'?'checked':'')+' /></div>')
					('<div class="paymentContent">')
						('<div class="paymentTitle">Chuyển khoản <span>(Quý khách tự Thanh toán chi phí chuyển khoản)</span></div>')
						('<div class="paymentText">Sau khi đặt hàng thành công, Quý khách chuyển tiền vào tài khoản của SohaPay. Quý khách phải chờ từ <b style="color:#5b5b5b">4-24</b> giờ để '+shop.cart.conf.cart.site_name+' xác nhận đơn hàng của Quý khách.</div>')
					('</div>')
					('<div class="c"></div>'+bank)
					('<ul class="paymentText paymentGuide'+((type=='atm' && shop.cart.showPaymentMoney()) ? '' : ' hidden')+'">')
						('<li>Khi chuyển khoản qua Internet Banking hoặc Quầy giao dịch, Quý khách vui lòng tự chịu phí chuyển khoản.</li>')
						('<li>Sau khi chuyển khoản, Quý khách vui lòng thông báo cho '+shop.cart.conf.cart.site_name+' được biết</li>')
						('<li>Đơn hàng của Quý khách chỉ được chấp nhận khi tiền đã về tài khoản của SohaPay</li>')
					('</ul>')
				('</div>')
			('</div>')(),
			payment = visaCard + mcard;
			payment += cod;
			payment += atm;
			return shop.popupSite(id, title, shop.join
			(moreInfo+'<div class="content" style="padding:0 0 10px">'+payment)
				('<div class="c"></div>')
				('<div align="center" class="mRight20 mTop10">')
					('<a href="javascript:void(0)" onclick="shop.cart.processStepZero()" class="orangeButton" id="fr"><span><span>Tiếp tục</span></span></a>')
					('<div class="c"></div>')
				('</div>')
			('</div>')());
		},
		
		
		// ===== REGISTER USER FORM =====
		
		register:function(id, title){
			var fname = shop.join
			('<div class="newCustomerInfo">')
				('<div class="input">Họ tên: ')
					('<input type="text" style="width:210px" id="cart_fullname" name="fullname" value="'+shop.cart.conf.user.fullname+'" />')
				('</div>')
				('<div class="description">Vui lòng cho chúng tôi biết Họ tên của Quý khách, Thông tin này sẽ được hiển thị ra ngoài Danh sách</div>')
			('</div>')(),
			email = shop.join
			('<div class="newCustomerInfo mTop5">')
				('<div class="input">Email: ')
					('<input type="text" style="width:218px" id="cart_email" name="email" value="'+shop.cart.conf.user.email+'" />')
				('</div>')
				('<div class="description">Vui lòng nhập chính xác địa chỉ email để nhận được thông báo mua hàng</div>')
			('</div>')(),
			mobile_phone = shop.join
			('<div class="newCustomerInfo mTop5">')
				('<div class="input">Điện thoại di động: ')
					('<input type="text" style="width:121px" id="cart_tel" name="tel" value="'+shop.cart.conf.user.mobile_phone+'" maxlength="20" onkeypress="return shop.numberOnly(this, event)" />')
				('</div>')
				('<div class="description">Vui lòng nhập đúng số điện thoại di động để nhận mã số phiếu qua tin nhắn SMS</div>')
			('</div>')(),
			notice = '',
			shipping = '',
			otp = '',
			allPrice = '',
			price = parseInt(shop.cart.conf.cart.cart.price),
			quantity = shop.join
			('<div id="formQuantity" class="jNice">')
				('<div class="newLabel">Số lượng Quý khách cần mua:</div>')
				('<div class="mTop5">')
					('<select style="width: 70px" id="quantity" name="select" onchange="shop.cart.theme.newOtp(this.value)">')();
			if(shop.cart.conf.cart.cart.price != shop.cart.conf.cart.cart.first_pay){
				price = parseInt(shop.cart.conf.cart.cart.first_pay);
			}
			if(!shop.is_exists(shop.cart.conf.cart.numberOtp)){
				shop.cart.conf.cart.numberOtp = parseInt(shop.cart.conf.cart.cart.min_order);
			}
			for(var i = parseInt(shop.cart.conf.cart.cart.min_order);i<=shop.cart.conf.cart.cart.max_order;i++){
				quantity += '<option value="'+i+'"'+(shop.cart.conf.cart.numberOtp == i ? ' selected':'')+'>'+i+'</option>';
			}
			quantity += shop.join
					('</select>')
				('</div>')
				('<div class="xprice">')
				('x '+shop.cart.theme.numberFormat(price)+' đ = <span id="numPrice">'+shop.cart.theme.numberFormat(price*shop.cart.conf.cart.numberOtp)+' đ</span>')
				('</div>')
			('</div>')();

			allPrice = price*shop.cart.conf.cart.numberOtp;
			if(shop.cart.conf.cart.payment_id == 'cod' || shop.cart.conf.cart.payment_id == 'coo'){
				//allPrice += shop.cart.conf.cart.numberOtp*shop.cart.conf.shipping.feeCOD;
			}else if(shop.cart.conf.shipping.check && shop.cart.conf.cart.payment_id != 'cop'){
				//allPrice += shop.cart.conf.cart.numberOtp* shop.cart.conf.shipping.fee;
			}
			allPrice = shop.join
			('<div class="mTop15">')
				('<div class="bgAllPrice">Tổng tiền: <span style="color:red"><span id="bgAllPrice">'+shop.cart.theme.numberFormat(allPrice)+'</span> đ</span></div>')
			('</div>')();

			//notice
			if(shop.cart.conf.cart.payment_id == 'coo' || shop.cart.conf.cart.payment_id == 'cod' || shop.cart.conf.cart.payment_id == 'cop'){
				var otpArr = new Array(), limit = 1;
				if(shop.cart.conf.cod.note != ''){
					shipping = '';//'<div class="newCartNotice mTop10 hidden" style="padding:5px 10px">'+shop.cart.conf.cod.note+'</div>';
				}
				if(shop.cart.conf.cart.payment_id != 'cop'){
					shipping = shop.join
					('<div class="mTop20">')
						('<label class="infoInputCheck">')
							('Phí giao hàng và thu tiền: <span style="color:#f60000">'+((shop.cart.conf.shipping.feeCOD>0) ? ('<span id="feePrice">'+shop.cart.theme.numberFormat(shop.cart.conf.shipping.feeCOD*shop.cart.conf.cart.numberOtp)+' đ</span>') : 'Miễn phí')+'</span>')
						('</label>')
					('</div>'+shipping)();
				}else{
					limit = shop.cart.conf.cart.numberOtp;
				}

				notice = allPrice;

				if(shop.cart.conf.user.otp != ''){
					otpArr = shop.cart.conf.user.otp.split(',');
				}

				for(var i=1;i<=limit;i++){
					otp += shop.join
					('<div class="mTop10 otp">')
						('<div class="newLabel">Mật khẩu:</div>')
						('<div class="infoInputTxt" style="width:140px">')
							('<input type="text" value="'+(shop.cart.conf.user.otp != '' ? otpArr[i-1] : '')+'" name="otp'+i+'" id="otp'+i+'" class="txt" style="width:130px"/>')
						('</div>')
					('</div>')();
				}
				otp = '<div class="otp_container">'+otp+'</div>';
				//bo check OTP voi hinh thuc COD cac khach hang da mua hang
				if(shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.customer.ignore_otp){
					otp = '';
				}else{
					notice += shop.join
					('<div class="newCartNotice mTop10">')
						('<div class="mBottom10"><b>Lưu ý:</b> Để hoàn thành đơn đặt hàng của bạn, xin vui lòng soạn <b id="sms_number" style="color:red">'+(shop.cart.conf.cart.payment_id=='cop'?limit:'')+'</b> tin nhắn có nội dung:</div>')
						('<div class="mBottom10" align="center"><span class="sms_style">SOHAPAY</span> gửi về số <span class="sms_style">'+((shop.cart.conf.cart.payment_id=='cop')?'8601':'8001')+'</span> (phí '+((shop.cart.conf.cart.payment_id=='cop')?'10.000':'500')+'đ/tin)</div>')
						('<div>Mật khẩu sẽ được gửi vào điện thoại của Quý khách, Quý khách vui lòng nhập vào '+(limit>1?'các ':'')+'ô bên dưới để Tiếp tục thực hiện mua hàng.</div>')
					('</div>')();
				}
			}else{
				if(shop.cart.conf.shipping.active){
					notice = '<div class="newCartNotice mTop10">'+shop.cart.conf.shipping.note+'</div>'+allPrice;
					shipping = shop.join
					('<div class="mTop20">')
						('<input type="checkbox" class="checkbox" id="shipping-check" '+(shop.cart.conf.shipping.check?'checked':'')+'/>')
						('<label for="shipping-check" class="infoInputCheck">')
							(' Giao hàng tận nhà')
						('</label>')
					('</div>')();
				}else{
					notice = allPrice;
				}
			}
			if(fname != '' || email != '' || mobile_phone != ''){
				var customerInfo = '', moreInfo = '';
				if(shop.cart.conf.user.type == 'customer'){
					//moreInfo = '<div class="bgCartInfoUser"><div style="width:136px; height:40px; float:left;"><img src="templates/images/logo-footer.png" height="35" /></div><div style="top:40px;" class="customerLogin" id="userHeader"><div class="user_hello mt1">Xin chào <a href="user_info.php" target="_blank">'+shop.cart.conf.customer.fullname+'</a>, <a href="javascript:void(0);" onclick="shop.customer.logout();"><font color="red">[thoát]</font></a></div><div class="user_gold mt1">Gold: <b>'+shop.cart.theme.numberFormat(shop.cart.conf.customer.gold)+'</b> &nbsp;&nbsp;</div></div></div>';
          moreInfo = '';
					customerInfo = shop.join
					('<div class="newLabel"><input type="radio" id="radio_info1" class="radio_info" value="1" '+(shop.cart.conf.userInfo == 1?'checked':'')+' onclick="shop.cart.showUserInfo(1)" /> <span onclick="shop.cart.showUserInfo(1)">Sử dụng thông tin cá nhân</span></div>')
					('<div class="customerInfoC'+(shop.cart.conf.userInfo == 0 ? ' hidden' : '')+'">')
						('<div class="infoInputText f11 mTop0">(SohaPay sẽ dùng các thông tin bên dưới để gửi thông tin hóa đơn mua hàng cho Quý khách)</div>')
						('<div class="box-info">')
							('<div><label>Họ tên:</label> '+shop.cart.conf.customer.fullname+'</div>')
							('<div class="mTop5"><label>Điện thoại:</label> '+shop.cart.conf.customer.mobile_phone+'</div>')
							('<div class="mTop5"><label>Email:</label> '+shop.cart.conf.customer.email+'</div>')
						('</div>')
					('</div>')
					('<div class="newLabel mTop10"><input type="radio" id="radio_info0" class="radio_info" value="0" '+(shop.cart.conf.userInfo == 0?'checked':'')+' onclick="shop.cart.showUserInfo(0)" /> <span onclick="shop.cart.showUserInfo(0)">Dùng thông tin khác</span></div>')
					('<div class="guestInfo mTop5'+(shop.cart.conf.userInfo == 1 ? ' hidden' : '')+'">'+fname+email+mobile_phone+'<div class="c"></div></div>')();
				}else{
					customerInfo = '<div class="guestInfo">'+fname+email+mobile_phone+'<div class="c"></div></div>';
					//moreInfo = '<div class="bgCartInfoUser"><div style="width:136px; height:40px; float:left;"><img src="templates/images/logo-footer.png" height="35" /></div><div style="top:40px;padding: 20px 0 0 60px;border:none;" class="customerLogin" id="userHeader"><a href="javascript:void(0)" onclick="shop.customer.login.show()">Đăng nhập</a> | <a href="javascript:void(0)" onclick="shop.customer.register.show()">Đăng ký</a></div></div>';	
          moreInfo = '';
				}
				return shop.popupSite(id, title, shop.join
				(moreInfo+'<div class="content">')
					('<div class="reg_cart_form">')
						('<form name="cartRegisterForm" id="cartRegisterForm">')
							('<div class="cartNewForm">')
								('<div id="cError"></div>')
								('<div class="infoInputLeft">'+customerInfo+'</div>')
								('<div class="infoInputRight">'+quantity+shipping+notice+otp+'</div>')
								('<div class="c"></div>')
							('</div>')
						('</form>')
						('<div class="mTop10">')
							('<a href="javascript:void(0)" onclick="shop.cart.register()" class="orangeButton mLeft10 fr"><span><span>Tiếp tục</span></span></a>')
							('<a href="javascript:void(0)" onclick="shop.cart.stepZero()" class="orangeButton fr btnLeft" id="stepZeroBtn"><span><span> Quay lại</span></span></a>')
							('<div class="c"></div>')
						('</div>')
						('<div class="c"></div>')
					('</div>')
				('</div>')());
			}
			return '';
		},
		moreInfo:function(id, title, def){
			var more = '',
				cityList = '<select name="city" id="cart_city" style="width:150px;padding:4px" onchange="shop.district.loadDistrictDropdown(this.value, \'listDistrict\', false, \''+def+'\', 1)">';
				cityList+= '<option value="0">--- Chọn ---</option>';
				for(var i in city_list){
					cityList += '<option value="'+city_list[i].id+'"'+(shop.cart.conf.user.city==i?' selected':'')+'>'+city_list[i].title+'</option>';
				}
				cityList += '</select>';
				more = shop.join
				('<div align="left">Vui lòng cho SohaPay biết chi tiết <b>địa chỉ Quý khách sẽ dùng để nhận hàng</b> để SohaPay gửi hàng được nhanh và chính xác nhất</div>')
				('<div id="cError"></div>')
				('<div align="left">')
					('<div id="pTop5" class="newCustomerInfo mTop5">')
						('<div class="input">Số nhà, Đường/Phố, Phường/Xã:</div>')
						('<input type="text" id="cart_address" name="address" style="width:330px" value="'+shop.cart.conf.user.address+'" />')
					('</div>')
					('<div class="mTop5">')
						('<div id="pTop5" class="newCustomerInfo fl">')
							('<div class="input">Tỉnh/Thành phố:</div>')
							('<div>'+cityList+'</div>')
						('</div>')
						('<div id="pTop5" class="newCustomerInfo fr">')
							('<div class="input">Quận/Huyện:</div>')
							('<div>')
								('<select id="listDistrict" name="district" style="width:150px"></select>')
							('</div>')
						('</div>')
						('<div class="c"></div>')
					('</div>')
					('<div id="pTop5" class="newCustomerInfo mTop5">')
						('<div class="input">Thời giao hàng, Ghi chú thêm:</div>')
						('<textarea id="cart_note" name="note" style="width:330px">'+shop.cart.conf.user.note+'</textarea>')
						('<div class="description">Vui lòng cho SohaPay biết thời gian Quý khách có thể nhận hàng hoặc các yêu cầu thêm nếu có (Lưu ý: SohaPay không giao hàng vào buổi tối)</div>')
					('</div>')
				('</div>')();
				if(shop.cart.conf.user.type == 'customer' && shop.cart.conf.customer.address != '' && shop.cart.conf.customer.district != '' && shop.cart.conf.customer.city > 0 && shop.is_exists(city_list[shop.cart.conf.customer.city])){
					more = shop.join
					('<div class="newLabel">')
						('<input type="radio" id="radio_address1" class="radio_address" value="1" '+(shop.cart.conf.userAddress == 1?'checked':'')+' onclick="shop.cart.showUserAddress(1)" />')
						('<span onclick="shop.cart.showUserAddress(1)">Sử dụng thông tin cá nhân</span>')
					('</div>')
					
					('<div class="customerAddressC'+(shop.cart.conf.userAddress == 0 ? ' hidden' : '')+'">')
						('<div class="infoInputText f11 mTop0" style="width:355px">(SohaPay sẽ dùng các thông tin bên dưới để gửi hàng cho Quý khách)</div>')
						('<div style="background:#fff;border:3px solid #D9F2FB;padding:10px;width:330px;overflow:hidden;color:#000">')
							('<div><b style="color:#0A9CCA">Số nhà, Đường/Phố, Phường/Xã:</b> '+shop.cart.conf.customer.address+'</div>')
							('<div class="mTop5"><b style="color:#0A9CCA">Quận/Huyện:</b> '+shop.cart.conf.customer.district+'</div>')
							('<div class="mTop5"><b style="color:#0A9CCA">Tỉnh/Thành phố:</b> '+city_list[shop.cart.conf.customer.city].title+'</div>')
						('</div>')
						('<div id="pTop5" class="newCustomerInfo mTop5">')
							('<div class="input">Thời giao hàng, Ghi chú thêm:</div>')
							('<textarea id="cart_note2" name="note" style="width:330px">'+shop.cart.conf.user.note+'</textarea>')
							('<div class="description">Vui lòng cho SohaPay biết thời gian Quý khách có thể nhận hàng hoặc các yêu cầu thêm nếu có (Lưu ý: SohaPay không giao hàng vào buổi tối)</div>')
						('</div>')
					('</div>')
					('<div class="newLabel mTop5">')
						('<input type="radio" id="radio_address0" class="radio_address" value="0" '+(shop.cart.conf.userAddress == 0?'checked':'')+' onclick="shop.cart.showUserAddress(0)" />')
						('<span onclick="shop.cart.showUserAddress(0)">Dùng thông tin khác</span>')
					('</div>')
					('<div class="guestAddress mTop5'+(shop.cart.conf.userAddress == 1 ? ' hidden' : '')+'">'+more+'<div class="c"></div></div>')();
				}else{
					shop.cart.conf.userAddress = 0;
				}

			return shop.popupSite(id, title, shop.join
			('<div class="content cartMoreAddress" style="padding:10px 20px">')
				('<form name="cartAddressForm" id="cartAddressForm">')
					(more+'<div align="center" class="mTop10">')
						('<a href="javascript:void(0)" onclick="shop.cart.moreInfo()" class="orangeButton  mLeft10" id="fr"><span><span>Tiếp tục</span></span></a>')
						('<a href="javascript:void(0)" onclick="shop.cart.stepOne()" id="fr" class="orangeButton btnLeft"><span><span> Quay lại</span></span></a>')
						('<div class="c"></div>')
					('</div>')
				('</form>')
			('</div>')());
		},
		confirmProduct:function(id, title){
			var paymentViSa = '',data = shop.cart.conf.cart.cart, note='',t='',warning='',logo='',bt_checkout='ĐẶT HÀNG';

			if(shop.cart.conf.cart.payment == 1){
				t = "Thanh toán Online";
				logo = '<a href="https://pay.soha.vn/" target="_blank" title="pay.soha.vn"><img src="templates/css/images/logoSoha.png" width="136" height="55" border="0" /></a>';
				note = shop.join
				('<div class="mLeft25">')
					('<div>')
						('<div><strong style="color:red">Chú ý:</strong> Quý khách phải có <b>thẻ Visa/Master</b> đã kích hoạt Thanh toán online</div>')
						('<div class="mTop5">hoặc <b>thẻ ATM đã đăng kí sử dụng internet banking</b> với ngân hàng phát hành thẻ</div>')
					('</div>')
					('<div class="mTop10">Thanh toán Online được đảm bảo bởi <a href="https://pay.soha.vn/" target="_blank" title="pay.soha.vn">Soha Payment</a></div>')
				('</div>')();
				bt_checkout='Thanh toán';
			}else if(shop.cart.conf.cart.payment == 2){
				var moreGold = '', suggest = '';
				
				if(shop.cart.conf.customer.gold < shop.cart.conf.cart.total){
					moreGold = shop.cart.conf.cart.total - shop.cart.conf.customer.gold;
					var need = shop.cart.cardSuggest(moreGold);
					if(need){
						suggest = '<div class="title">Gợi ý nạp thẻ:</div>';
						for(var i in need){
							suggest += '<div class="mTop5 mLeft25">- <b style="color:red">'+need[i]+'</b> thẻ mệnh giá <span style="color:blue">'+shop.cart.theme.numberFormat(i,0,'','.')+'</span> đ (~<span style="color:blue">'+shop.cart.theme.numberFormat(need[i]*i*shop.cart.conf.card_rate,0,'','.')+'</span> Gold)</div>';
						}
						suggest = '<div class="mTop10">'+suggest+'<div class="mTop5 mLeft25">- <span style="color:red">Số Gold thừa sẽ được cộng lại vào tài khoản của Quý khách</span></div></div>';
					}
					moreGold = shop.cart.theme.numberFormat(moreGold, 0, '', '.');
					moreGold = 'Quý khách phải nạp thêm: <b style="color:red">'+moreGold+'</b> Gold';
					//bt_checkout = 'NẠP THẺ';
					bt_checkout = '';
				}else{
					moreGold = shop.cart.conf.customer.gold-shop.cart.conf.cart.total;
					moreGold = shop.cart.theme.numberFormat(moreGold, 0, '', '.');
					moreGold = 'Sau khi Thanh toán Quý khách còn: <b style="color:red">'+moreGold+'</b> Gold';
					bt_checkout = 'Thanh toán';
				}
				t = "Thanh toán bằng Gold hoặc Thẻ cào Vinaphone và MobiFone";
				logo = '';
				note = shop.join
				('<div class="mLeft25">')
					('<div>- Hiện tại của Quý khách đang có: <b>'+shop.cart.theme.numberFormat(shop.cart.conf.customer.gold, 0, '', '.')+'</b> Gold</div>')
					('<div class="mTop5">- Đơn hàng này có giá trị tương ứng với: <b>'+shop.cart.theme.numberFormat(shop.cart.conf.cart.total, 0, '', '.')+'</b> Gold</div>')
					('<div class="mTop5 mBottom10">- '+moreGold+'</div>'+(suggest != '' ? '<a href="javascript:void(0)" onclick="shop.gold.rechargeStep1(false, \'card\')" id="fl" class="orangeButton"><span><span>NẠP GOLD</span></span></a><div class="c"></div>' : ''))
				('</div>')();
				//('</div>'+suggest)();
			}else{
				if(shop.cart.conf.cart.payment_id == 'cod' || shop.cart.conf.cart.payment_id == 'cop' || shop.cart.conf.cart.payment_id == 'coo'){
					if(shop.cart.conf.cod.type == 0){
						t = "Nộp tiền & nhận hàng tại nhà";
					}else if(shop.cart.conf.cod.type == 1){
						t = "Giao phiếu & Thanh toán tại cửa hàng";
					}else{
						t = "Nộp tiền & nhận hàng tại Văn phòng của SohaPay";
					}
					logo = '';
					note = '';
				}else{
					t = "Chuyển khoản Thanh toán qua ATM hoặc nộp tiền tại quầy GD ngân hàng về:";
					warning = '<div style="color:#BE0D0D" class="mTop5 f11">(Quý khách vui lòng tự Thanh toán chi phí Chuyển khoản)</div>';
					if(shop.cart.conf.atm.bank!= '' && shop.cart.conf.atm.bank != 'check_cash'){
						if(!shop.is_exists(shop.cart.conf.bank[shop.cart.conf.atm.bank])){
							shop.cart.conf.atm.bank = 'mb_bank';
						}
					}else{
						shop.cart.conf.atm.bank = 'mb_bank';
					}
					note = decodeURIComponent(shop.cart.conf.bank[shop.cart.conf.atm.bank]);
					note = '<div class="mTop10">'+note.replace(/\+/gi,' ')+'</div>';
					logo = '<div class="'+shop.cart.conf.atm.bank+'"></div>';
				}
			}

			var shipping_fee = (shop.cart.conf.shipping.code == 'SHIP') ? shop.cart.conf.shipping.fee : shop.cart.conf.shipping.feeCOD,
			shipping_fee_f = (shop.cart.conf.shipping.code == 'SHIP') ? shop.cart.conf.shipping.fee_f : shop.cart.conf.shipping.feeCOD_f,
			ship = '';
			if((shop.cart.conf.shipping.active || shop.cart.conf.shipping.COD) && shop.cart.conf.shipping.check && shipping_fee > 0){
				ship = shop.join
				('<tr>')
					('<td valign="top" align="center" class="item bRight">2</td>')
					('<td valign="top" class="item bRight" colspan="2">'+(shop.cart.conf.shipping.COD ? 'Phí giao hàng và thu tiền' : 'Phí giao tận nơi')+'</td>')
					('<td valign="top" align="right" class="item bRight">'+shipping_fee_f+'</td>')
					('<td valign="top" align="center" class="item bRight">'+(shop.cart.conf.shipping.type==1?shop.cart.conf.cart.numberOtp:1)+'</td>')
					('<td valign="top" align="right" class="item">'+shop.cart.conf.cart.cart.shipping_fee_f+'</td>')
				('</tr>')();
			}
			if(shop.cart.conf.cart.payment_id == 'cop'){
				ship = '';
			}

			/*var regulations = shop.cart.conf.user.type == 'guest' ? shop.join
			('<div class="mTop10" style="font-size:16px;width:758px">')
				('<input type="checkbox" id="check-regulations" class="checkbox" />')
				('<label for="check-regulations">')
					('<strong>Tôi đã đọc và đồng ý với các <a href="trang-the-le.html" target="_blank">điều khoản</a> và <a href="trang-quy-dinh-refund.html"  target="_blank">quy định</a> của SohaPay</strong>')
				('</label>')
			('</div>')() : '';*/
      var regulations = '';
			var address = '',
			back = '';//'<a href="javascript:void(0)" onclick="shop.cart.stepOne()" class="orangeButton" id="fr"><span><span>Sửa thông tin cá nhân</span></span></a>';
			if(shop.cart.conf.cart.payment_id == 'cod' || (shop.cart.conf.shipping.check && shop.cart.conf.shipping.active && shop.cart.conf.cart.payment_id != 'cop' && shop.cart.conf.cart.payment_id != 'coo')){
				address = '<div class="mTop5"><strong>Địa chỉ nhận hàng:</strong> <span>'+shop.cart.conf.user.address+' ('+shop.cart.conf.user.district+'/'+city_list[shop.cart.conf.user.city].title+(shop.cart.conf.user.note!=''?(' - '+shop.cart.conf.user.note):'')+')'+'</span>'+back+'</div>';
			}else{
				address = back;
			}
			return shop.popupSite(id, title, shop.join
			('<div class="content" style="padding:10px 20px">')
				('<div class="box-gradien">')
					('<div class="title">Thông tin khách hàng <a class="btn-edit" href="javascript:void(0)" onclick="shop.cart.stepOne()">[ <span>Sửa thông tin cá nhân</span> ]</a></div>')
					('<div class="content" id="pTop10">')
						('<div><strong>Họ tên:</strong> <span>'+shop.cart.conf.user.fullname+'</span></div>')
						('<div class="mTop5"><strong>Email:</strong> <span>'+shop.cart.conf.user.email+'</span></div>')
						('<div class="mTop5"><strong>Điện thoại di động:</strong> <span>'+shop.cart.conf.user.mobile_phone+'</span></div>')
						(address+'<div class="c"></div>')
					('</div>')
				('</div>')
				('<div class="box-gradien" id="box-gradien2">')
					('<div class="title mTop10 mLeft10">Thông tin sản phẩm</div>')
					('<div class="content" id="pTop5">')
						('<table class="cart-finish" cellpadding="0" cellspacing="0" width="100%" border="0">')
						('<thead><tr>')
							('<th class="head bRight" width="25">STT</th>')
							('<th class="head bRight">Sản phẩm</th>')
							('<th class="head bRight" width="70">Đơn vị</th>')
							('<th class="head bRight" width="80">Đơn Giá</th>')
							('<th class="head bRight" width="25">SL</th>')
							('<th class="head" width="80">Thành Tiền</th>')
						('</tr></thead>')
						('<tr>')
							('<td valign="top" align="center" class="item bRight">1</td>')
							('<td valign="top" class="item bRight">'+data.title+(shop.is_exists(data.extra) ? (' ('+data.extra+')') : '')+'</td>')
							('<td valign="top" align="center" class="item bRight">'+data.unit+'</td>')
							('<td valign="top" align="right" class="item bRight">'+(data.price == data.first_pay ? data.price_f : data.first_pay_f)+'</td>')
							('<td valign="top" align="center" class="item bRight">'+shop.cart.conf.cart.numberOtp+'</td>')
							('<td valign="top" align="right" class="item">'+data.price_total_f+'</td>')
						('</tr>')
						(ship+'<tr>')
							('<td align="right" class="item total-all" colspan="6">'+ (data.total < data.price ? 'Tiền đặt cọc' : 'Tổng tiền') +' = <span id="total-all">'+shop.cart.conf.cart.total_price+'</span></td>')
						('</tr></table>')
					('</div>')
				('</div>'+regulations)
				('<div align="center" class="mTop10">'+(bt_checkout != '' ? '<a href="javascript:void(0)" onclick="shop.cart.finishOrder()" class="orangeButton  mLeft10" id="fr"><span><span>'+bt_checkout+'</span></span></a>' : ''))
					('<a href="javascript:void(0)" onclick="shop.cart.stepTwo(true)" id="fr" class="orangeButton btnLeft"><span><span> Quay lại</span></span></a>')
					('<div class="c"></div>')
				('</div>')
			('</div>')());
		},
		recharge:function(id, title, recharge, card_val){
			var note = '', moreGold = '', suggest = '', recharge_txt = '',
			card_type = shop.cart.cardType.get(),
			moreGold = shop.cart.conf.cart.total - shop.cart.conf.customer.gold,
			need = shop.cart.cardSuggest(moreGold);
			if(need){
				suggest = '<div class="title"><b>Gợi ý nạp thẻ:</b></div>';
				for(var i in need){
					suggest += '<div class="mTop5 mLeft25">- <b style="color:red">'+need[i]+'</b> thẻ mệnh giá <span style="color:blue">'+shop.cart.theme.numberFormat(i,0,'','.')+'</span> đ (~<span style="color:blue">'+shop.cart.theme.numberFormat(need[i]*i*shop.cart.conf.card_rate,0,'','.')+'</span> Gold)</div>';
				}
				suggest = '<div class="mTop10">'+suggest+'<div class="mTop5 mLeft25">- <span style="color:red">Số Gold thừa sẽ được cộng lại vào tài khoản của Quý khách</span></div></div>';
			}
			if(card_val && recharge && card_val != '' && recharge != ''){
				recharge_txt = '<center style="width:340px;color:green;margin:5px auto 10px;padding:10px;background:rgb(255, 249, 215);border:1px solid #008000;font-size: 14px;">Quý khách vừa nạp thẻ mệnh giá <b style="color:red">'+card_val+'</b> đ<br />tương đương với <b style="color:red">'+recharge+'</b> Gold.<br /><br /><b>Vui lòng nạp tiếp thẻ khác.</b></center>';
			}
			note = shop.join
			('<div>')
				(recharge_txt+'<div>Hiện tại của Quý khách đang có: <b>'+shop.cart.theme.numberFormat(shop.cart.conf.customer.gold, 0, '', '.')+'</b> Gold</div>')
				('<div class="mTop5">Đơn hàng này có giá trị tương ứng với: <b>'+shop.cart.theme.numberFormat(shop.cart.conf.cart.total, 0, '', '.')+'</b> Gold</div>')
				('<div class="mTop5">Quý khách phải nạp thêm: <b style="color:red">'+shop.cart.theme.numberFormat(moreGold, 0, '', '.')+'</b> Gold</div>')
			('</div>')();

			return shop.popupSite(id, title, shop.join
			('<div class="content cartRecharge" style="padding:10px 20px">')
				('<form name="cartRechargeForm" id="cartRechargeForm">')
					(note+'<div id="cError" class="mTop10"></div>')
					('<div align="left">')
						('<div id="pTop5" class="newCustomerInfo mTop5">')
							('<div class="input">Loại thẻ cào:</div>')
							('<div style="margin-left:30px" class="card_type">')
								('<div class="fl" align="center">')
									('<img src="images/blank.gif" width="120" height="30" onclick="shop.cart.chooseTelco(this, \'vinaphone\')" style="cursor:pointer;background:url(/images/payment/vinaphone.png) no-repeat 50% 50%" /><br />')
									('<input type="radio" value="vinaphone" id="r_vinaphone" class="radio_info" name="card_type" '+(card_type=='vinaphone'?'checked ':'')+'/>')
								('</div>')
								('<div class="fl mLeft15" align="center">')
									('<img src="images/blank.gif" width="120" height="30" onclick="shop.cart.chooseTelco(this, \'mobifone\')" style="cursor:pointer;background:url(style/images/payment/mobiphone.png) no-repeat 50% 50%" /><br />')
									('<input type="radio" value="mobifone" id="r_mobifone" class="radio_info" name="card_type" '+(card_type=='mobifone'?'checked ':'')+'/>')
								('</div>')
								('<div class="c"></div>')
							('</div>')
						('</div>')
						('<div id="pTop10" class="newCustomerInfo mTop5">')
							('<div class="input fl" style="width:115px">Mã số thẻ cào: </div>')
							('<div class="fl"><input type="text" id="cart_recharge" name="cart_recharge" style="width:210px" value="" maxlength="30" /></div>')
							('<div class="c"></div>')
						('</div>')
					('</div>')
					('<div align="center" class="mTop10">')
						('<a href="javascript:void(0)" onclick="shop.cart.recharge()" class="orangeButton  mLeft10" id="fr"><span><span>NẠP THẺ</span></span></a>')
						('<a href="javascript:void(0)" onclick="shop.cart.backRecharge()" id="fr" class="orangeButton btnLeft"><span><span> Quay lại</span></span></a>')
						('<div class="c"></div>')
					('</div>'+suggest)
				('</form>')
			('</div>')());
		},
		finish:function(id, title){
			return shop.popupSite(id, title, shop.join
			('<div class="content" style="padding:15px 20px 25px;font-size:18px" align="center">')
				('<b>Hệ thống đang cập nhật đơn hàng... </b><br /><br />')
				('Quý khách vui lòng <b style="color:red">không tắt trình duyệt</b>')
			('</div>')());
		},
		paymentViSa:function(){
			return shop.join
			('<form id="checkoutSoHa" method="post" action="'+shop.cart.conf.cart.url+'">')
				('<input type="hidden" value="'+shop.cart.conf.cart.quantity+'" name="quantity" />')
				('<input type="hidden" value="'+shop.cart.conf.cart.order_id+'" name="id" />')
				('<input type="hidden" value="'+shop.cart.conf.cart.total+'" name="total" />')
				('<input type="hidden" value="'+shop.cart.conf.cart.good_name+'" name="good" />')
				('<input type="hidden" value="'+shop.cart.conf.cart.item_ids+'" name="item_ids" />')
				('<input type="hidden" value="'+shop.cart.conf.user.fullname+'" name="fullname" />')
				('<input type="hidden" value="'+shop.cart.conf.user.mobile_phone+'" maxlength="50" name="mobiphone" />')
				('<input type="hidden" value="'+shop.cart.conf.user.email+'" maxlength="50" name="email" />')
				('<input type="hidden" value="'+shop.cart.conf.user.id+'" maxlength="50" name="uid" />')
			('</form>')();
		},
		bankInfo:function(){
			if(shop.cart.conf.atm.bank!= '' && shop.cart.conf.atm.bank != 'check_cash'){
				if(!shop.is_exists(shop.cart.conf.bank[shop.cart.conf.atm.bank])){
					shop.cart.conf.atm.bank = 'mb_bank';
				}
			}else{
				shop.cart.conf.atm.bank = 'mb_bank';
			}
			var logo = '<div class="'+shop.cart.conf.atm.bank+'"></div>',
			note = decodeURIComponent(shop.cart.conf.bank[shop.cart.conf.atm.bank]);
			note = '<div class="mTop10">'+note.replace(/\+/gi,' ')+'</div>';

			jQuery('.bank_list').hide();
			jQuery('.bank_info .bank_detail').html(shop.join
				('<div class="fl">'+logo+'</div>')
				('<div class="fl" style="width:380px">'+note)
				('<div style="color:#BE0D0D" class="f11 mTop5">(Quý khách vui lòng tự Thanh toán chi phí Chuyển khoản)</div></div>')
				('<div class="c"></div>')()
			)
			jQuery('.bank_info').show();
		},
		newPrice:function(obj){
			var checked = false, price = parseInt(shop.cart.conf.cart.cart.price);
			if(shop.cart.conf.cart.cart.price != shop.cart.conf.cart.cart.first_pay){
				price = parseInt(shop.cart.conf.cart.cart.first_pay);
			}
			if(shop.is_obj(obj)){
				if(obj.checked == true){
					shop.cart.conf.cart.priceAndShip = shop.cart.conf.cart.numberOtp*(price+parseInt(shop.cart.conf.cart.cart.fee_shipping));
					checked = true;
				}
			}
			if(checked == false){
				shop.cart.conf.cart.priceAndShip = shop.cart.conf.cart.numberOtp*price;
			}
			if((shop.cart.conf.cart.payment_id == 'cod' || shop.cart.conf.cart.payment_id == 'coo') && shop.cart.conf.shipping.feeCOD > 0){
				shop.cart.conf.cart.priceAndShip = shop.cart.conf.cart.numberOtp*(price+shop.cart.conf.shipping.feeCOD);
			}
      shop.cart.conf.cart.priceAndShip = shop.cart.conf.cart.numberOtp*price;
			jQuery('#bgAllPrice').html(shop.cart.theme.numberFormat(shop.cart.conf.cart.priceAndShip));
		},
		newOtp:function(number){
			shop.cart.conf.cart.numberOtp = number;
			var otp = '', limit = 1, price = parseInt(shop.cart.conf.cart.cart.price);
			if(shop.cart.conf.cart.cart.price != shop.cart.conf.cart.cart.first_pay){
				price = parseInt(shop.cart.conf.cart.cart.first_pay);
			}
			if(shop.cart.conf.cart.payment_id == 'cop'){
				limit = shop.cart.conf.cart.numberOtp;
			}
			for(var i=1;i<=limit;i++){
				otp += shop.join
				('<div class="mTop10 otp">')
					('<div class="newLabel">Mật khẩu:</div>')
					('<div class="infoInputTxt" style="width:140px">')
						('<input type="text" name="otp'+i+'" id="otp'+i+'" class="txt" style="width:130px"/>')
					('</div>')
				('</div>')();
			}
			jQuery('.otp_container').html(otp);
			if(shop.cart.conf.cart.payment_id == 'cop'){
				jQuery('#sms_number').html(limit);
			}
			//doi gia tien
			if((shop.cart.conf.cart.payment_id != 'cod' || shop.cart.conf.cart.payment_id != 'cop'  || shop.cart.conf.cart.payment_id != 'coo') && shop.cart.conf.shipping.fee > 0){
				jQuery('#feePrice').html(shop.cart.theme.numberFormat(number*shop.cart.conf.shipping.fee)+' đ');
			}
			if((shop.cart.conf.cart.payment_id == 'cod' || shop.cart.conf.cart.payment_id == 'coo') && shop.cart.conf.shipping.feeCOD > 0){
				jQuery('#feePrice').html(shop.cart.theme.numberFormat(number*shop.cart.conf.shipping.feeCOD)+' đ');
			}
			jQuery('#numPrice').html(shop.cart.theme.numberFormat(number*price)+" đ");
			shop.cart.theme.newPrice(document.getElementById('shipping-check'));
		},
		numberFormat:function( number, decimals, dec_point, thousands_sep ){
			var n = number, prec = decimals;
			n = !isFinite(+n) ? 0 : +n;
			prec = !isFinite(+prec) ? 0 : Math.abs(prec);
			var sep = (typeof thousands_sep == "undefined") ? '.' : thousands_sep;
			var dec = (typeof dec_point == "undefined") ? ',' : dec_point;
			var s = (prec > 0) ? n.toFixed(prec) : Math.round(n).toFixed(prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;
			var abs = Math.abs(n).toFixed(prec);
			var _, i;
			if (abs >= 1000) {
				_ = abs.split(/\D/);
				i = _[0].length % 3 || 3;
				_[0] = s.slice(0,i + (n < 0)) +
					  _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
				s = _.join(dec);
			} else {
				s = s.replace(',', dec);
			}
			return s;
		},
		systemAlert:function(msg, title){
			var key = shop.get_uuid();
			title = title ? title : 'Thông báo từ hệ thống';
			shop._active_popup(key, "", "",
			{
				type: "overlay",
				auto_hide: 8900,
				overlay : {
					'opacity' : 0.3,
					'background-color' : '#000'
				}
			});
			shop._active_popup('system-alert',title,
			shop.popupSite('system-alert',title,shop.join
			('<div class="content" style="padding:20px">')
					('<div class="box-gradien" id="site-regulations" style="padding:20px 10px;width:435px;overflow:hidden">'+msg+'</div>')
			('</div>')(), key),
			{
				type: 'one-time',
				auto_hide: 9000,
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
					'width' : '500px'
				}
			});
		}
	},

// ------------------------------------- extra function --------------------------------- //
	showUserInfo:function(id){
		if(id == 0 || id == 1){
			if(id != shop.cart.conf.userInfo){
				shop.cart.conf.userInfo = id;
				jQuery('.radio_info').each(function(){
					if(this.id == 'radio_info'+id){
						this.checked = true;
					}else{
						this.checked = false;
					}
				});
				if(id == 1){
					jQuery('.guestInfo').hide();
					jQuery('.customerInfoC').show();
				}else{
					jQuery('.guestInfo').show();
					jQuery('.customerInfoC').hide();
				}
			}
		}
	},
	showUserAddress:function(id){
		id = parseInt(id);
		if(id == 0 || id == 1){
			if(id != shop.cart.conf.userAddress){
				shop.cart.conf.userAddress = id;
				jQuery('.radio_address').each(function(){
					if(this.id == 'radio_address'+id){
						this.checked = true;
					}else{
						this.checked = false;
					}
				});
				if(id == 1){
					jQuery('.guestAddress').hide();
					jQuery('.customerAddressC').show();
				}else{
					jQuery('.guestAddress').show();
					jQuery('.customerAddressC').hide();
				}
			}
		}
	},
	chooseTelco:function(obj, type){shop.get_ele('r_'+type).checked = true},
	showOnlineBank:function(){
		if(jQuery('.view_more_bank').hasClass('hidden')){
			jQuery('.view_more_bank').slideDown().removeClass('hidden');
		}else{
			jQuery('.view_more_bank').slideUp().addClass('hidden');
		}
	},
	choosePayment:function(obj, checked){
		if(!jQuery(obj).hasClass(obj.id+'NoActive')){
			if(shop.cart.conf.user.type == 'guest' && obj.id == 'mcard'){
				shop.get_ele('radio_'+obj.id).checked = false;
				if(confirm('Quý khách phải đăng nhập để Tiếp tục mua hàng bằng Gold hoặc Thẻ cào VinaPhone, MobiFone\nQuý khách sẽ Đăng Nhập luôn ?')){
					shop.customer.login.show();
				}
			}else{
				//kich hoat
				jQuery('.pay_active').removeClass('pay_active').removeClass('clicked');
				jQuery(obj).addClass('pay_active clicked');
				//khoi tao lai chieu cao
				if(obj.id == 'atm'){
					jQuery('.bank').slideDown();
				}else{
					jQuery('.bank').slideUp();
				}
				//select radio
				shop.get_ele('radio_'+obj.id).checked = true;
				jQuery('.paymentGuide').hide();
				jQuery('.paymentGuide', obj).show();
			}
		}else{
			shop.get_ele('radio_'+obj.id).checked = false;
			var id = jQuery('.clicked').attr('id');
			if(id){
				shop.get_ele('radio_'+id).checked = true;
			}
		}
	},
	chooseBank:function(obj, id){
		jQuery('.bank .active').removeClass('active');
		jQuery(obj).addClass('active');
		shop.cart.conf.atm.bank = id;
		shop.cart.theme.bankInfo();
	},
	restoreBank:function(){
		if(shop.cart.conf.atm.bank != '' && shop.cart.conf.cart.payment_id == 'atm'){
			jQuery('.bank_list a').each(function(){
				if(jQuery(this).hasClass('active')){
					shop.cart.chooseBank(this, shop.cart.conf.atm.bank);
				}
			});
		}
	},
	listBank:function(){
		jQuery('.bank_info').hide();
		jQuery('.bank_list').show();
	},
	showPaymentMoney:function(){
		var item = shop.cart.conf.cart.cart, atm = shop.cart.conf.atm;
		//return (parseInt(item.buyer) < atm.people) && (TIME_NOW < parseInt(item.endTime)) && (TIME_NOW > parseInt(item.startTime)) && ( TIME_NOW < atm.atm);
	},
	backRecharge:function(){
		if(!shop.is_exists(shop._store.variable['recharge_start'])){
			shop._store.variable['recharge_start'] = false;
		}
		if(!shop._store.variable['recharge_start']){
			shop.cart.stepThree();
		}
	},
	isOnline:function(){ return shop.cart.conf.cart.cart.ptOnline },
	isMobiCard:function(){ return shop.cart.conf.cart.cart.ptMobiCard },
	isTransfer:function(){ return shop.cart.conf.cart.cart.ptTransfer },
	isCOD:function(){ return shop.cart.conf.cart.cart.ptCOD },
	isCOO:function(){ return shop.cart.conf.shipping.COD && shop.cart.conf.cod.type == 2 },
	isCOP:function(){ return shop.cart.conf.shipping.COD && shop.cart.conf.cod.type == 1 },
	isGOLD:function(){ return shop.cart.conf.user.type == 'customer' },
	cardType:{
		get:function(){ return shop.cookie.get('card_type') },
		save:function(v){ shop.cookie.set('card_type', v, 86400*30*12, '/') }
	},
	showTip:function(obj){
		jQuery('.tipc', jQuery(obj).parent()).show();
	},
	hideTip:function(obj){
		jQuery('.tipc', jQuery(obj).parent()).hide();
	},
	guest:{
		update:function(u){
			if(u){
				if(shop.is_exists(u.fullname) && u.fullname != ''){
					shop.cart.conf.user.fullname = u.fullname;
				}
				if(shop.is_exists(u.email) && u.email != ''){
					shop.cart.conf.user.email = u.email;
				}
				if(shop.is_exists(u.mobile_phone) && u.mobile_phone != ''){
					shop.cart.conf.user.mobile_phone = u.mobile_phone;
				}
				if(shop.is_exists(u.type) && (u.type == 'guest' || u.type == 'customer')){
					shop.cart.conf.user.type = u.type;
				}
				if(shop.is_exists(u.address) && u.address != ''){
					shop.cart.conf.user.address = u.address;
				}
				if(shop.is_exists(u.district) && u.district != ''){
					shop.cart.conf.user.district = u.district;
				}
				if(shop.is_exists(u.note) && u.note != ''){
					shop.cart.conf.user.note = u.note;
				}
				if(shop.is_exists(u.city) && u.city != ''){
					shop.cart.conf.user.city = u.city;
				}
				if(shop.is_exists(u.otp) && u.otp != ''){
					shop.cart.conf.user.otp = u.otp;
				}
			}
		},
		restore:function(){
			var u = {
				fullname : shop.cookie.get('guest_fullname'),
				email	: shop.cookie.get('guest_email'),
				mobile_phone : shop.cookie.get('guest_mobile_phone'),
				address : shop.cookie.get('guest_address'),
				district : shop.cookie.get('guest_district'),
				city : shop.cookie.get('guest_city'),
				otp : shop.cookie.get('guest_otp'),
				note: shop.cookie.get('guest_note')
			};
			shop.cart.guest.update(u);
		},
		save:function(u){
			if(u){
				var year = 86400*30*12;
				if(shop.is_exists(u.fullname)){
					shop.cookie.set('guest_fullname', u.fullname, year, '/');
				}
				if(shop.is_exists(u.email)){
					shop.cookie.set('guest_email', u.email, year, '/');
				}
				if(shop.is_exists(u.mobile_phone)){
					shop.cookie.set('guest_mobile_phone', u.mobile_phone, year, '/');
				}
				if(shop.is_exists(u.type)){
					shop.cart.conf.user.type = u.type;
				}
				if(shop.is_exists(u.address) && u.address != ''){
					shop.cookie.set('guest_address', u.address, year, '/');
				}
				if(shop.is_exists(u.district) && u.district != ''){
					shop.cookie.set('guest_district', u.district, year, '/');
				}
				if(shop.is_exists(u.note) && u.note != ''){
					shop.cookie.set('guest_note', u.note, year, '/');
				}
				if(shop.is_exists(u.city) && u.city != ''){
					shop.cookie.set('guest_city', u.city, year, '/');
				}
				if(shop.is_exists(u.otp) && u.otp != ''){
					shop.cookie.set('guest_otp', u.otp, 2*60*60, '/');
				}
			}
		}
	},
	cardSuggest:function(number, bug){
		if(number > 0){
			var stop = 0, temp = 0, idx = 0, need = {}, i = 0;
			//cong them gold do triet khau
			number = Math.ceil(number/shop.cart.conf.card_rate);
			while(stop == 0){
				if(number < shop.cart.conf.card[0]){
					stop = 1;
					if(number > 0){
						if(shop.is_exists(need[shop.cart.conf.card[0]])){
							need[shop.cart.conf.card[0]]++;
						}else{
							need[shop.cart.conf.card[0]] = 1;
						}
					}
				}else{
					for(i=0;i<shop.cart.conf.card.length;i++){
						if((number < shop.cart.conf.card[i]) || (i == shop.cart.conf.card.length-1)){
							idx = i;
							if(number < shop.cart.conf.card[i]){
								idx = i-1;
							}
							if(number < shop.cart.conf.card[i] && number > shop.cart.conf.card[idx]){
								idx = i;
								number = 0;
								if(shop.is_exists(need[shop.cart.conf.card[idx]])){
									need[shop.cart.conf.card[idx]]++
								}else{
									need[shop.cart.conf.card[idx]] = 1;
								}
							}else{
								temp = Math.floor(number/shop.cart.conf.card[idx]);
								number = number - temp*shop.cart.conf.card[idx];
								need[shop.cart.conf.card[idx]] = temp;
							}
							break;
						}
					}
				}
			}
			if(bug){
				bug = '';
				for(i in need){
					bug += '<div class="mTop5 mLeft10">- <b>'+need[i]+'</b> thẻ mệnh giá <span style="color:red">'+shop.cart.theme.numberFormat(i,0,'','.')+'</span> đ</div>';
				}
				jQuery('body').prepend(bug);
			}
			return need;
		}
		return false;
	}
};