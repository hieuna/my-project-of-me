shp.chargeGold = {
    'current_step'  : 1,
    'user_info'     : {},
    'gold_number'   : 0,
    'charge_type'   : 1,
    'card_code'     : '',
    'card_type'     : 1
};

shp.chargeGold.mixMoney = function(myfield){
	var thousands_sep = ',';
	myfield.value = shp.numberFormat(parseInt(myfield.value.replace(/,/gi, '')),0,'',thousands_sep);
}

shp.chargeGold.checkRadio = function(value){
	var str="";
	var str2="";
	if (value==1){
        $('#inputEmail').css('border','1px solid #CCCCCC');
		$('#inputEmail').css('color','#8A8A8A');
		//str += '<div><a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.step_2();"><span><span>Tiếp tục »</span></span></a></div>';
		str2 += '<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.step_21();"><span><span>Tiếp tục</span></span></a>';
	}else{
		$('#inputEmail').css('border','2px solid #8A2825');
		$('#inputEmail').css('color','#8A2825');
		//str += '<div><a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.step_3();"><span><span>Tiếp tục »</span></span></a></div>';
		str2 += '<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.step_4();"><span><span>Tiếp tục</span></span></a>';
	}
    shp.chargeGold.charge_type = (shp.chargeGold.current_step==1)?value:shp.chargeGold.charge_type;
    
	//$("#selectButton").html(str);
	$("#selectLoad").html(str2);
}

shp.chargeGold.focusInputTextbox = function(){
	$('#inputEmail').each(function() {
	    var default_value = this.value;
	    $(this).focus(function() {
            $('#chargeOther').attr("checked", "checked"); 
            shp.chargeGold.checkRadio(2);
	        if(this.value == default_value) {
	            this.value = '';
	        }
	    });
	    $(this).blur(function() {
	        if(this.value == '') {
	            this.value = default_value;
	        }
	    });
	});
}

//10.Begin nap gold vao tai khoan (1)

shp.chargeGold.step_1 = function (){
    shp.chargeGold.current_step = 1;
    shp.chargeGold.charge_type = 1;
    shp.chargeGold.user_info.user_fullname = shp.user.user_info['user_fullname'];
    shp.chargeGold.user_info.user_email = shp.user.user_info['user_email'];
    shp.chargeGold.user_info.user_mobile = shp.user.user_info['user_mobile'];
    shp.chargeGold.user_info.user_id = shp.user.user_info['user_id'];
    
    txtTitle = shp.join ('<div class="title_popup">')
    	('<div class="text">Nạp tiền vào tài khoản</div>')
    ('</div>')();

    txtContent = shp.join ('<div class="content_popup clearfix">')
    	('<div class="content_gold clearfix">')
            ('<div id="cError"></div>')
    		('<div class="radioBox"><input type="radio" id="chargeMe" name="gold" onchange="shp.chargeGold.checkRadio(this.value);" value="1" checked="checked" /></div>')
    		('<div class="content_gold_right">')
    			('<div class="gold_title"><label for="chargeMe">Nạp tiền vào tài khoản cá nhân (<a href="javascript:void(0);">'+shp.user.user_info['user_email']+'</a>)</label></div>')
    			('<ul>')
    				('<li>- Bạn đang có: <b class="FF5A00">'+shp.numberFormat(shp.user.user_info['user_gold'])+' đ</b></li>')
    				('<li>- Nạp thêm tiền để có thể mua hàng dễ dàng chỉ trong vài nhấp chuột</li>')
    			('</ul>')
    		('</div>')	
    	('</div>')
    	
    	('<div class="content_gold clearfix">')
    		('<div class="radioBox"><input type="radio" id="chargeOther" name="gold" onchange="shp.chargeGold.checkRadio(this.value)" value="2" /></div>')
    		('<div class="content_gold_right">')
    				('<div class="gold_title">')
    					('<div><label for="chargeOther">Nạp hộ tiền cho tài khoản khác</label></div>')
    					('<div><input type="textbox" id="inputEmail" class="inputtext" value="Nhập email cần nạp..." /></div>')
    				('</div>')
    			('<ul style="display: none;">')
    				('<li>- Để nạp <b class="red">100.000 đ</b> bạn cần thanh toán <b class="red">102.000 đ</b>, trong đó <b class="red">100.000 Gold</b> sẽ vào tài khoản của người được nạp hộ, <b class="red">2.000 đ</b> vào tài khoản của người nạp hộ</li>')
    			('</ul>')
    			('</div>')	
    		('</div>')
    	
    	('<div class="buttonDIV clearfix" id="selectButton">')
    			('<div>')
    				('<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.do_step_1();"><span><span>Tiếp tục</span></span></a>')
    			('</div>')
    	('</div>')();
     
     shp.show_overlay_popup(10, txtTitle, txtContent);
     shp.chargeGold.focusInputTextbox();
}

// Check thông tin user chọn ở STEP 1
shp.chargeGold.do_step_1 = function(){
    // Check STEP 1 Value
    if (shp.chargeGold.charge_type==2){
        email = $('.content_gold #inputEmail').val();
		if(email == ''){
			shp.error.set('#inputEmail', 'Chưa nhập Email cần nạp tiền', 500, '.content_gold'); return;
		}else if(!shp.is_email(email)){
			shp.error.set('#inputEmail', 'Địa chỉ Email không hợp lệ', 500, '.content_gold'); return;
		}else if(email == shp.user.user_info['user_email']){
			shp.error.set('#inputEmail', 'Vui lòng tích vào lựa chọn ở trên nếu Quý khách tự nạp cho mình', 500, '.content_gold'); return;
		}
        shp.chargeGold.user_info.user_email = email;
        
        // Lấy thông tin user từ email
        shp.ajax_popup('task=getGoldInfoByEmail',"POST",{user_email: shp.chargeGold.user_info.user_email},
    	function(j){
    		if(j.err == 0)	{
                shp.chargeGold.user_info = j.user_info;
    			shp.chargeGold.step_3();
    		}else{
    			shp.error.set('inputEmail', j.msg, 340, '.content_gold');
    		}
    	},
    	{
    		loading:function(){
    			shp.show_loading('Đang tải thông tin khách hàng');
    		}
    	});
    }else{
        shp.chargeGold.step_4();   
    }
}

//11.Begin chon hinh thuc nap (2)
shp.chargeGold.step_2 = function(){
    
    shp.chargeGold.current_step = 2;
    
   var hdTitle = shp.join('<div class="title_popup">')
        ('<div class="text">Chọn hình thức nạp</div>')
        ('</div>')();
        
    var hdContent = shp.join('<div class="content_popup clearfix">')
        ('<div class="content_gold clearfix">')
        ('<div class="radioBox"><input type="radio" id="input-mobicharge" name="hd" onchange="shp.chargeGold.checkRadio(this.value);" value="1" checked="checked" /></div>')
        ('<div class="content_gold_right">')
        ('<div class="gold_title"><label for="input-mobicharge">Nạp từ thẻ cào điện thoại</label></div>')
        ('<div class="small">Hỗ trợ thẻ của mạng Vinaphone và Mobifone. Áp dụng cho mọi loại mệnh giá thẻ.</div>')
        ('<div class="small"><a href="javascript:void(0);"><span id="mobiphone"></span></a><a href="javascript:void(0);"><span id="vinaphone"></span></a></div>')
        ('</div>')	
        ('</div>')
        
        ('<div class="content_gold clearfix">')
        ('<div class="radioBox"><input type="radio" name="hd" id="input-creditcharge" onchange="shp.chargeGold.checkRadio(this.value);" value="2" /></div>')
        ('<div class="content_gold_right">')
        ('<div class="gold_title"><label for="input-creditcharge">Nạp từ thẻ Visa, Master Card, thẻ ATM, có Internet Banking</label></div>')
        //('<div class="small">Số tiền nạp được chuyển tương ứng thành Gold theo tỉ lệ <b class="red">1 Gold ~ 1 VNĐ</b></div>')
        ('<div class="small"><a href="javascript:void(0);"><span id="visa"></span></a><a href="javascript:void(0);"><span id="master"></span></a>')
        ('<a href="javascript:void(0);" class="f1"><span id="vcb"></span></a>')
        ('<a href="javascript:void(0);" class="f1"><span id="donga"></span></a>')
        ('<a href="javascript:void(0);" class="f1"><span id="techcombank"></span></a>')
        ('<a href="javascript:void(0);" class="f1"><span id="vietinbank"></span></a>')
        ('</div>')
        ('<div class="small"><a href="javascript:void(0);"><span id="hdbank"></span></a></a>')
        ('<a href="javascript:void(0);" class="f1"><span id="vib"></span></a>')
        ('<a href="javascript:void(0);" class="f1"><span id="tienphongbank"></span></a>')
        ('</div>')
        ('</div>')	
        ('</div>')
        
        ('<div class="buttonDIV clearfix">')
        ('<div id="selectLoad">')
        ('<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.step_21();"><span><span>Tiếp tục</span></span></a>')
        ('</div>')
        ('<div>')
        ('<a class="orangeButton btnLeft" href="javascript:void(0);" onclick="shp.chargeGold.step_1();"><span><span>Quay lại</span></span></a>')
        ('</div>')
        ('</div>')
        ('</div>')();
    
    shp.show_overlay_popup(11, hdTitle, hdContent);
}

//12.BEGIN NAP GOLD TU THE CAO DIEN THOAI(2.1)
shp.chargeGold.step_21 = function (){
    shp.chargeGold.current_step = 21;
    
    var cardphone_Title = shp.join ('<div class="title_popup">')
        ('<div class="text">Nạp tiền từ thẻ cào điện thoại</div>')
        ('</div>')();
    
    var cardphone_Content = shp.join ('<div class="content_popup clearfix">')
        ('<div class="content_gold clearfix">')
            ('<div id="cError"></div>')
        	('<p>(<b>Ví dụ:</b> Thẻ mệnh giá 100.000đ ~ 95.000 đ)</p>')
        	('<div class="content_gold_right">')
        		('<div class="gold_title"><div><b>Chọn thẻ cào của mạng :</b></div>')
        			('<div class="f1"><label for="card_gold_type_vinaphone"><img src="'+shp.baseURI+'templates/css/images/chargeGold/vinaphone.png" height="19" border="0" /></label><br /><input type="radio" checked="" name="card_gold_type" id="card_gold_type_vinaphone" class="radio_info" value="vinaphone" checked="checked" /></div>')
        			('<div class="f1" style="margin-top:-4px;"><label for="card_gold_type_mobifone"><img src="'+shp.baseURI+'templates/css/images/chargeGold/mobiphone.png" height="12" border="0" /></label><br /><input type="radio" id="card_gold_type_mobifone" name="card_gold_type" class="radio_info" value="mobifone" /></div>')
        		('</div>')
        		('<div class="gold_title" style="margin-top:15px;"><div><b>Mã số thẻ cào :</b></div>')
        			('<div><input type="textbox" id="card_code" class="inputcard" value="" /><br /><div class="small">Vui lòng nhập chính xác mã số in trên thẻ.<br />Hệ thống chỉ cho phép nhập sai không quá 5 lần.</div></div>')
        		('</div>')
        	('</div>')	
        ('</div>')
        
        ('<div class="buttonDIV clearfix">')
        	('<div>')
        		('<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.do_step_21();"><span><span>Tiếp tục</span></span></a>')
        	('</div>')
        	('<div>')
        		('<a class="orangeButton btnLeft" href="javascript:void(0);" onclick="shp.chargeGold.step_2();"><span><span>Quay lại</span></span></a>')
        	('</div>')
        ('</div>')
        ('</div>')();
    
    shp.show_overlay_popup(12, cardphone_Title, cardphone_Content);
}

shp.chargeGold.do_step_21 = function(){
    shp.chargeGold.card_type = $('.content_gold input[name=card_gold_type]:checked').val();
    shp.chargeGold.card_code = $('.content_gold #card_code').val();
    if (shp.chargeGold.card_code.length<=11){
        $('.content_gold #card_code').focus();
        return shp.error.set('#card_code', 'Mã số thẻ không hợp lệ. Bạn vui lòng chỉ nhập vào các chữ số in trên thẻ.', 340, '.content_gold');
    }
    
    shp.ajax_popup('task=chargeMobiCard',"POST",{code_card:shp.chargeGold.card_code, card_type: shp.chargeGold.card_type, email: shp.chargeGold.user_info.user_email},
	function(j){
		shp._store.variable['recharge_gold_start'] = false;
		if(j.err == 0)	{
            $('.user_gold_value').html(shp.numberFormat(j.user_gold)+'₫');
			shp.chargeGold.step_5();
		}else{
			var id = 0;
			switch(j.msg){
				case 'not_connect': j.msg = 'Không kết nối được với nhà cung cấp'; break;
				case 'cus_not_found': j.msg = 'Hiện tại bạn đang không đăng nhập.<br />Vui lòng tắt cửa sổ, mua lại'; break;
				case 'code_invalid': case 'invalid_card': case 'error':
					j.msg = 'Mã số thẻ không hợp lệ';
					id = '#card_code';
				break;
			}
			shp.error.set(id, j.msg, 340, '.content_gold');
		}
	},
	{
		loading:function(){
			shp.error.set('', 'Hệ thống đang kiểm tra mã thẻ.<br />Quý khách vui lòng <b>không tắt trình duyệt</b>.', 340, '.goldRecharge3_card');
			shp.show_loading('Đang kiểm tra Mã thẻ');
		}
	});
}


//13.CHON HINH THUC NAP HO GOLD(3)

shp.chargeGold.step_3 = function(){
    shp.chargeGold.current_step = 3;
    var hdTitleNH = shp.join ('<div class="title_popup">')
        ('<div class="text">Chọn hình thức nạp</div>')
        ('</div>')();
    
    var hdContentNH = shp.join ('<div class="content_popup clearfix">')
        ('<div class="content_gold clearfix">')
        	('<div class="emailNH">')
        		('<p><b>Họ tên :</b> '+shp.chargeGold.user_info.user_fullname+'</p>')
        		('<p><b>Điện thoại :</b> '+shp.chargeGold.user_info.user_mobile+'</p>')
        		('<p><b>Email :</b> '+shp.chargeGold.user_info.user_email+'</p>')
        	('</div>')
        ('</div>')
        
        ('<div class="content_gold clearfix">')
        	('<div class="content_gold_right">')
        		('<div class="gold_title">Nạp từ thẻ Visa, Master Card, thẻ ATM, có Internet Banking</b></div>')
        		//('<div class="small">Số tiền nạp được chuyển tương ứng thành Gold theo tỉ lệ <b class="red">1 Gold ~ 1 VNĐ</b></div>')
        		('<div class="small"><a href="javascript:void(0);"><span id="visa"></span></a><a href="javascript:void(0);"><span id="master"></span></a>')
        			('<a href="javascript:void(0);" class="f1"><span id="vcb"></span></a>')
        			('<a href="javascript:void(0);" class="f1"><span id="donga"></span></a>')
        			('<a href="javascript:void(0);" class="f1"><span id="techcombank"></span></a>')
        			('<a href="javascript:void(0);" class="f1"><span id="vietinbank"></span></a>')
        		('</div>')
        		('<div class="small"><a href="javascript:void(0);"><span id="hdbank"></span></a></a>')
        			('<a href="javascript:void(0);" class="f1"><span id="vib"></span></a>')
        			('<a href="javascript:void(0);" class="f1"><span id="tienphongbank"></span></a>')
        		('</div>')
        	('</div>')	
        ('</div>')
        
        ('<div class="buttonDIV clearfix">')
        	('<div>')
        		('<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.step_4();"><span><span>Tiếp tục</span></span></a>')
        	('</div>')
        	('<div>')
        		('<a class="orangeButton btnLeft" href="javascript:void(0);" onclick="shp.chargeGold.step_1();"><span><span>Quay lại</span></span></a>')
        	('</div>')
        ('</div>')
        ('</div>')();
        
    shp.show_overlay_popup(13, hdTitleNH, hdContentNH);
}

//14.Nạp Gold từ thẻ Visa, Master Card, thẻ ATM, có Internet Banking (NH)
shp.chargeGold.step_4 = function(){
    shp.chargeGold.current_step = 4;
    var returnFunction = (shp.chargeGold.user_info.user_email==shp.user.user_info['user_email'])?"shp.chargeGold.step_1()":"shp.chargeGold.step_3()";
    var hdTitleGoldNH = shp.join ('<div class="title_popup">')
        ('<div class="text">Nạp tiền từ thẻ Visa, MasterCard, thẻ ATM, Internet Banking</div>')
        ('</div>')();

    var hdContentGoldNH = shp.join ('<div class="content_popup clearfix">')
    	('<div class="content_gold clearfix">')
            ('<div id="cError"></div>')
    		('<div class="content_gold_right">')
    			('<div class="gold_title" style="text-align:center;">Số tiền cần nạp : ')
    				('<input id="input-goldnumber" type="textbox" value="50,000" name="gold_number" onkeyup="shp.chargeGold.mixMoney(this)" onfocus="this.select()" onkeypress="return shp.numberOnly(this, event)" class="inputtext" style="font-weight: bold; color: #000;">')
    			('</div>')
    			('<div class="small" style="text-align:center;">Mỗi lần nạp phải từ <b class="red">50.000 đ</b> trở lên</div>')
    		('</div>')
    	('</div>')
    	
    	('<div style="border-bottom:1px solid #CCCCCC; width:100%; height:1px; float:left; margin-bottom:20px;"></div>')
    	
    	('<div class="content_gold clearfix">')
    		//('<img src="images/logoSoha.png" style="float:left; width:100px;" border="0" />')
    		('<div class="content_gold_right" style="width:550px;">')
    			('<div class="small" style="width:500px; margin-left:20px;"><a href="javascript:void(0);"><span id="visa"></span></a><a href="javascript:void(0);"><span id="master"></span></a>')
    				('<a href="javascript:void(0);" class="f1"><span id="vcb"></span></a>')
    				('<a href="javascript:void(0);" class="f1"><span id="donga"></span></a>')
    				('<a href="javascript:void(0);" class="f1"><span id="techcombank"></span></a>')
    				('<a href="javascript:void(0);" class="f1"><span id="vietinbank"></span></a>')
    			('</div>')
    			('<div class="small" style="width:500px; margin-left:20px;"><a href="javascript:void(0);"><span id="hdbank"></span></a></a>')
    				('<a href="javascript:void(0);" class="f1"><span id="vib"></span></a>')
    				('<a href="javascript:void(0);" class="f1"><span id="tienphongbank"></span></a>')
    			('</div>')
    		('</div>')	
    	('</div>')
    	
    	('<div class="buttonDIV clearfix">')
    		('<div>')
    			('<a class="orangeButton" href="javascript:void(0);" onclick="shp.chargeGold.do_step_4();"><span><span>Tiếp tục</span></span></a>')
    		('</div>')
    		('<div>')
    			('<a class="orangeButton btnLeft" href="javascript:void(0);" onclick="'+returnFunction+';"><span><span>Quay lại</span></span></a>')
    		('</div>')
    	('</div>')
    ('</div>')();
    
    shp.show_overlay_popup(14, hdTitleGoldNH, hdContentGoldNH);
}

shp.chargeGold.do_step_4 = function(){
    shp.chargeGold.gold_number = $('.content_gold input[name=gold_number]').val();
    shp.chargeGold.gold_number = shp.chargeGold.gold_number.replace(/,/gi, '');
    if (shp.chargeGold.gold_number<50000){
        shp.error.set('#input-goldnumber', 'Bạn phải nạp ít nhất là 50,000đ', 500, '.content_gold'); return;
    }else if (shp.chargeGold.gold_number>=1000000000){
        shp.error.set('#input-goldnumber', 'Số tiền bạn nạp quá lớn', 500, '.content_gold'); return;
    }
    shp.redirect(shp.baseURI+'charge_gold.php?task=docheckout&user_email='+shp.chargeGold.user_info.user_email+'&gold_number='+shp.chargeGold.gold_number);
}


//15.Thong bao thanh cong
shp.chargeGold.step_5 = function(){
    shp.chargeGold.current_step = 5;
    var titleTC = shp.join('<div class="title_popup">')
        ('<div class="text">Bạn đã nạp tiền thành công</div>')
        ('</div>')();
    
    var contentTC = shp.join('<div class="content_popup clearfix">')
        ('<div class="content_gold clearfix">')
        	('<div class="content_gold_right">')
        		('<div class="gold_title" style="text-align:center;">Bạn đã thực hiện giao dịch nạp tiền thành công, xin cảm ơn ! </div>')
        	('</div>')
        ('</div>')
        
        ('</div>')();

     shp.show_overlay_popup(15, titleTC, contentTC);
}