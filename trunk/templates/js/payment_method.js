shp.paymentMethod = {};
var aCardType = {
  'Mastercard': {name: 'mastercard'}, 
  'Visa': {name: 'visacard'},
  1   :  {name: 'vietcombank', title: 'Vietcombank', help: ' <p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ <b>Internet Banking và SMS Banking</b> để thanh toán với thẻ Connect 24 của Vietcombank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-vietcombank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  2   : {name: 'techcombank', title: 'Techcombank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ F@ss i-Bank để thanh toán trực tuyến với ngân hàng Techcombank. Xem <a href="./info/help/huong-dan-thanh-toan/fast-i-bank-techcombank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  3   : {name: 'tienphongbank', title: 'TienPhongBank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ <b>Internet Banking</b> để thanh toán với thẻ ghi nợ nội địa của TienphongBank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-tienphongbank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  4   : {name: 'vietinbank', title: 'VietinBank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải <b>kích hoạt dịch vụ thanh toán trực tuyến</b> để thanh toán với thẻ E-partner của ngân hàng VietinBank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-vietinbank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  5   : {name: 'vibbank', title: 'VIB', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ <b>VIB4U</b> để thanh toán với thẻ ghi nợ nội địa của ngân hàng VIB. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-vib.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  6   : {name: 'dongabank', title: 'DongA Bank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ <b>Internet Banking</b> để thanh toán trực tuyến với ngân hàng Đông Á. Xem <a href="./info/help/huong-dan-thanh-toan/internet-banking-dong-a.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  7   : {name: 'hdbank', title: 'HD Bank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ <b>eBanking và SMS/Vasco Token Key</b> để thanh toán với thẻ ghi nợ nội địa của HDBank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-hdbank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  8   : {name: 'mbbank', title: 'MB Bank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span></p>'},
  9   : {name: 'vietabank', title: 'VietABank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn cần đăng ký sử dụng dịch vụ <b>thanh toán trực tuyến</b> để thanh toán với thẻ ghi nợ của VietABank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-vietabank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  10  : {name: 'maritimebank', title: 'Maritime Bank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn cần sở hữu bộ sản phẩm M1 Account của ngân hàng Maritime Bank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-maritimebank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  11  : {name: 'eximbank', title: 'EximBank', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn phải đăng ký dịch vụ <b>Internet Banking và SMS Banking</b> để thanh toán với thẻ ATM của EximBank. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-eximbank.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  12  : {name: 'shbbank', title: 'SHB', help: '<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn cần có <b>Mã khách hàng</b> hoặc <b>Số tài khoản/Số thẻ</b> của ngân hàng SHB để thanh toán trực tuyến. Xem <a href="./info/help/huong-dan-thanh-toan/the-atm-shb.html" target="_blank">hướng dẫn chi tiết tại đây</a></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-check"></span>Phí thanh toán: (miễn phí)</p>'},
  17  : {name: 'namabank', title: 'Nam Á Bank', help: ''}
};

var aOnsitePaymentBank = [1, 4, 5, 7, 8, 9, 10, 11, 17];
var objCard = 
{
	1: {name:'Vietcombank', precode:['970436','686868']},
	4: {name:'Vietinbank', precode:['6201','9704']},
	5: {name:'VIB', precode:['1809','970441']},
	7: {name:'HD Bank', precode:['970437']}
};

var orderInfo = {};

/* Thực hiện các thao tác khi một ngân hàng/loại thẻ được chọn */
shp.paymentMethod.chooseBank = function (obj){
  $('.payment-wrapper .logobank').addClass('disabled');
  $(obj).removeClass('disabled');
  $('.logobank input[name=vpc_Bank]').attr('checked', false);
  $('input', obj).attr('checked', true);
  
  /* BẮT ĐẦU - Hiện form thanh toán */
  cardType = $('input[name=vpc_Bank]', obj).val();
  if (aCardType[cardType]==null) return;
  
  formType = (parseInt(cardType))?'.atmcard':'.creditcard';
  notFormType = (parseInt(cardType))?'.creditcard':'.atmcard';
  
  if (formType=='.atmcard'){
    $('.payment-method-info').html("Thẻ nội địa - ATM của "+aCardType[cardType]['title']);
    
    $('.order_fee_val').html(shop.numberFormat(orderInfo['order_fee_2'],0,'',',')+'₫');
    new_price = parseFloat(orderInfo['order_fee_2'])+parseFloat(orderInfo['order_price']);
    $('.order_price_val').html(shop.numberFormat(new_price,0,'',',')+'₫');
    
  } else {
    $('.payment-method-info').html("Thẻ quốc tế "+cardType);
  
    $('.order_fee_val').html(shop.numberFormat(orderInfo['order_fee_1'],0,'',',')+'₫');
    new_price = parseFloat(orderInfo['order_fee_1'])+parseFloat(orderInfo['order_price']);
    $('.order_price_val').html(shop.numberFormat(new_price,0,'',',')+'₫');
  }
  $(formType+' .payment-form').attr('class', 'payment-form clearfix '+aCardType[cardType]['name']);
  $(formType+' .payment-form input[name=vpc_card]').val(cardType);
  if ($.browser.msie) $('.payment-info'+formType).show(function (){$('.input-text:first', this).focus();});
  else $('.payment-info'+formType).slideDown(function (){$('.input-text:first', this).focus();});
  $('.payment-info'+notFormType).css('display', 'none');
  if (cardType==2 && (!$.browser.msie)){
    $(formType+' .payment-form .bank-notice').html('<p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-alert"></span><font color="red"><span style="text-decoration: underline;"><strong>Lưu ý:</strong></span> <span style="color: #ff0000;">Dịch vụ thanh toán trực tuyến bằng <strong>F@st i-Bank</strong> của Techcombank chỉ được hỗ trợ thanh toán bởi trình duyệt <strong>Internet Explorer (IE)</strong></span></font></p><p><span style="float: left; margin-right: 0.3em;" class="ui-icon ui-icon-info"></span>Bạn hãy copy đường link sau và dán vào thanh địa chỉ của IE để tiếp tục thanh toán: <input id="linkTech" value="" type="text" class="input-text"></p>');
		$('#linkTech').val(window.location);
    $('#linkTech').focus(function (){$(this).select();});
    $(formType+' .confirm-field').attr('style', 'display: none !important;');
  }
  else{
    /*if (aCardType[cardType]['help']!=null){
      $(formType+' .payment-form .bank-notice').html(aCardType[cardType]['help']);
    }*/
    $(formType+' .payment-form .bank-notice').html("");
    $(formType+' .confirm-field').attr('style', 'display: block !important;');
  }

  if (cardType==3){
	  $('#label-card-no').html('Số thẻ/Số tài khoản');
  }
  else {
	  $('#label-card-no').html('Số thẻ');
  }
  /* HẾT - Hiện form thanh toán */
}

$(function() {
  
  /* Get Order Info */
  orderInfo = {
    'order_price': $('input[name=order_price]').val(),
    'order_fee_1': $('input[name=order_fee_1]').val(),
    'order_fee_2': $('input[name=order_fee_2]').val()
  };
  
  $('.payment-wrapper .logobank').click(function (){
    shp.paymentMethod.chooseBank(this);
  }); 
  
  /* Kiểm tra default bank/card select */
  if (jsSettings.payment_method!=null && jsSettings.payment_method.vpc_Bank!=null && aCardType[jsSettings.payment_method.vpc_Bank]!=null){
    if ($('input[name=vpc_Bank][value='+jsSettings.payment_method.vpc_Bank+']').length>0){
      //$('input[name=vpc_Bank][value='+jsSettings.payment_method.vpc_Bank+']').attr('checked', true);
      shp.paymentMethod.chooseBank($('input[name=vpc_Bank][value='+jsSettings.payment_method.vpc_Bank+']').parent());
    }
  }
  
  $('.payment-form').each(function (){
    var par = $(this);
    $('.input-text', this).focus(function (){
      fieldType = $(this).attr('name');
      $('.card-image', par).attr('class', 'card-image '+fieldType);
    });
    $('.input-text', this).blur(function (){
      $('.card-image', par).attr('class', 'card-image');
    });
  })
  
  /* Form submit validate */
  $('#payment-method form').submit(function(e){
    paymentMethod = $('input[name=method]', this).val();
    if (parseInt(paymentMethod)==1){
      return (validateCard(this, $('input[name=vpc_card]', this), $('input[name=vpc_CardNum]', this), $('input[name=vpc_CardName]', this), $('select[name=expiry_month]', this), $('select[name=expiry_year]', this), $('input[name=vpc_CardSecurityCode]', this)));
    }else{
      cardType = parseInt($('input[name=vpc_card]', this).val());
      if ($.inArray(cardType, aOnsitePaymentBank)>=0){
        return validateCardATM(this, $('input[name=vpc_CardNum]', this), $('input[name=expiry_month]', this), $('input[name=expiry_year]', this),$('input[name=vpc_CardName]', this), cardType);
      }else return true;
    }
  })
});

/* BEGIN validate credit card */
function validateCard(oForm, oCardType, oCardNum, oCardName, oCardExpMonth, oCardExpYear, oCardCVV) {
	var msgErrorCardNumber = 'Hãy nhập vào số thẻ chính xác. Chỉ sử dụng chữ số. Không sử dụng dấu cách hay dấu gạch ngang.';
  cardType      = oCardType.val();
  cardNumber    = oCardNum.val();
  cardName      = oCardName.val();
  cardMonth     = oCardExpMonth.val();
  cardYear      = oCardExpYear.val();
  cardCVV       = oCardCVV.val();
	if(cardNumber.length == 0) {
		alert(msgErrorCardNumber);
		$(oCardNum).focus();
		return false;
	}
	
	for( var i = 0; i < cardNumber.length; ++i ) {
		var c = cardNumber.charAt(i);
		if( c < '0' || c > '9' ) {
			alert(msgErrorCardNumber);
			oCardNum.focus();
			return false;
		}
	}
  
  var length = cardNumber.length;

	switch( cardType ) {
		case 'Amex':
			if( length != 15 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			var prefix = parseInt( cardNumber.substring(0,2));

			if( prefix != 34 && prefix != 37 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			break;
		case 'JCB':
			if( length != 16 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			var prefix = parseInt( cardNumber.substring(0,4));
			if( prefix < 3528 || prefix > 3589 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			break;
		case 'Mastercard':
			if( length != 16 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			var prefix = parseInt( cardNumber.substring(0,2));
			if( prefix < 51 || prefix > 55) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			break;
		case 'Visa':
			if( length != 16 && length != 13 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			var prefix = parseInt( cardNumber.substring(0,1));
			if( prefix != 4 ) {
				alert(msgErrorCardNumber);
				oCardNum.focus();
				return false;
			}
			break;
	}
	if( !Mod10( cardNumber ) ) {
		alert(msgErrorCardNumber);
		oCardNum.focus();
		return false;
	}
  
	if( expired( cardMonth, cardYear ) ) {
		alert("Ngày hết hạn của thẻ không chính xác");
		return false;
	}
  
  if(!(shop.is_ascii_fullname(cardName))){
		alert("Hãy nhập tên in trên thẻ, gõ không dấu");
		oCardName.focus();
		return false;
	}
	if( !checkCSC(cardType, cardCVV) ) {
		alert("Hãy nhập đúng số bảo mật CVV/CVC2");
		oCardCVV.focus();
		return false;
	}
	
	return true;
}

function checkCSC(cardType,cscValue){
    var re = null;
    if(cardType != null){
        if(cardType == "Amex"){
            re = /^[0-9]{4}$/;
            return re.test(cscValue);
        } else {
            re = /^[0-9]{3}$/;
            return re.test(cscValue);
        }
    }
}

function expired( month, year ) {
	var now = new Date();
	var expiresIn = new Date(year,month,0,0,0);
	expiresIn.setMonth(expiresIn.getMonth()+1);
	if( now.getTime() < expiresIn.getTime() ) return false;
	return true;
}

function Mod10(ccNumb) {
	var valid = "0123456789";  // Valid digits in a credit card number
	var len = ccNumb.length;  // The length of the submitted cc number
	var iCCN = parseInt(ccNumb);  // integer of ccNumb
	var sCCN = ccNumb.toString();  // string of ccNumb
	sCCN = sCCN.replace (/^\s+|\s+$/g,'');  // strip spaces
	var iTotal = 0;  // integer total set at zero
	var bNum = true;  // by default assume it is a number
	var bResult = false;  // by default assume it is NOT a valid cc
	var temp;  // temp variable for parsing string
	var calc;  // used for calculation of each digit
	
	// Determine if the ccNumb is in fact all numbers
	for (var j=0; j<len; j++) {
	  temp = "" + sCCN.substring(j, j+1);
	  if (valid.indexOf(temp) == "-1"){bNum = false;}
	}
	
	// if it is NOT a number, you can either alert to the fact, or just pass a failure
	if(!bNum){
	  bResult = false;
	}
	
	// Determine if it is the proper length 
	if((len == 0)&&(bResult)){  // nothing, field is blank AND passed above # check
	  bResult = false;
	} else{  // ccNumb is a number and the proper length - let's see if it is a valid card number
	  if(len >= 15){  // 15 or 16 for Amex or V/MC
	    for(var i=len;i>0;i--){  // LOOP throught the digits of the card
	      calc = parseInt(iCCN) % 10;  // right most digit
	      calc = parseInt(calc);  // assure it is an integer
	      iTotal += calc;  // running total of the card number as we loop - Do Nothing to first digit
	      i--;  // decrement the count - move to the next digit in the card
	      iCCN = iCCN / 10;                               // subtracts right most digit from ccNumb
	      calc = parseInt(iCCN) % 10 ;    // NEXT right most digit
	      calc = calc *2;                                 // multiply the digit by two
	      // Instead of some screwy method of converting 16 to a string and then parsing 1 and 6 and then adding them to make 7,
	      // I use a simple switch statement to change the value of calc2 to 7 if 16 is the multiple.
	      switch(calc){
	        case 10: calc = 1; break;       //5*2=10 & 1+0 = 1
	        case 12: calc = 3; break;       //6*2=12 & 1+2 = 3
	        case 14: calc = 5; break;       //7*2=14 & 1+4 = 5
	        case 16: calc = 7; break;       //8*2=16 & 1+6 = 7
	        case 18: calc = 9; break;       //9*2=18 & 1+8 = 9
	        default: calc = calc;           //4*2= 8 &   8 = 8  -same for all lower numbers
	      }                                               
	    iCCN = iCCN / 10;  // subtracts right most digit from ccNum
	    iTotal += calc;  // running total of the card number as we loop
	  }  // END OF LOOP
	  if ((iTotal%10)==0){  // check to see if the sum Mod 10 is zero
	    bResult = true;  // This IS (or could be) a valid credit card number.
	  } else {
	    bResult = false;  // This could NOT be a valid credit card number
	    }
	  }
	}
	
  	return bResult;
}
/* END validate credit card */

/* BEGIN validate ATM card */
function validateCardATM(oForm, oCardNumber, oCardMonth, oCardYear, oCardName, cardType) {
	var msgErrorCardNumber = 'Hãy nhập vào số thẻ chính xác. Chỉ sử dụng chữ số. Không sử dụng dấu cách hay dấu gạch ngang.';
	var msgErrorCardExpired = 'Ngày phát hành của thẻ không chính xác';
	var msgErrorCardName = 'Hãy nhập tên in trên thẻ, gõ không dấu';
  
  cardNumber    = oCardNumber.val();
  cardName      = oCardName.val();
  cardMonth     = oCardMonth.val();
  cardYear      = oCardYear.val();
  
	if(cardName == '' || cardName.length < 6){
		alert(msgErrorCardName);
		oCardName.focus();
		return false;
	}
	
	if( cardNumber.length != 16 && cardNumber.length != 19 ) {
		alert(msgErrorCardNumber);
		oCardNumber.focus();
		return false;
	}
	for( var i = 0; i < cardNumber.length; ++i ) {
		var c = cardNumber.charAt(i);

		if( c < '0' || c > '9' ) {
			alert(msgErrorCardNumber);
			oCardNumber.focus();
			return false;
		}
	}
  
  if (!checkCardPreCode(cardType, cardNumber)){
    alert(msgErrorCardNumber);
    oCardNumber.focus();
    return false;
  }

  if (cardType!=11 && cardType!=10 && cardType!=9 && cardType!=17){
  	if( cardMonth.length == 0 || cardYear.length == 0 ) {
  		alert(msgErrorCardExpired);
  		oCardMonth.focus();
  		return false;
  	}
  	for( var i = 0; i < cardMonth.length; ++i ) {
  		var c = cardMonth.charAt(i);
  		if( c < '0' || c > '9' ) {
  			alert(msgErrorCardExpired);
  			oCardMonth.focus();
  			return false;
  		}
  	}
  	for( var i = 0; i < cardYear.length; ++i ) {
  		var c = cardYear.charAt(i);
  		if( c < '0' || c > '9' ) {
  			alert(msgErrorCardExpired);
  			oCardYear.focus();
  			return false;
  		}
  	}
  }
	return true;
}

function checkCardPreCode(cardType, cardNum){
  if (objCard[cardType]!=null){
    cardPreCode = objCard[cardType]['precode'];
    for (i=0; i<cardPreCode.length; i++){
      if (cardNum.indexOf(cardPreCode[i])>=0) return true;
    }
  }else return true;
  
  return false;
}

function popCVVup() {
	newwindow=window.open('','popCVVup','height=580,width=600');
	var tmp = newwindow.document;
	tmp.write('<html><head><title>CSC là gì?</title></head><body>');
	tmp.write('<h2>CSC là gì?</h2>');
	tmp.write('<p>Đối với thẻ Visa, MasterCard hoặc JCB, CSC là ba chữ số cuối trên dải chữ ký ở phía sau mặt thẻ của quý vị.</p>');
	tmp.write('<p align="center"><img src="images/cards/cvv2.gif" /></p>');
	tmp.write('<p>Đối với thẻ American Express, CSC là  bốn chữ số ở trước mặt thẻ.</p>');
	tmp.write('<p align="center"><img src="images/cards/cvv1.gif" /></p>');
	tmp.write('</body></html>');
	tmp.close();
}