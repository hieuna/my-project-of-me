var emailTxt='mời bạn nhập email...';
$(document).ready(function(){
	if ($("#email") && $("#email").value==''){
		$("#email").value=emailTxt;
		$("#email").focus(function (){ 
			   $("#email").val('');
		})
	
		$("#email").blur(function (){
			if($("#email").val() == ''){
			   $("#email").val(emailTxt);
			}
		});
	}
});

function submitButton()
{
	var form = document.paymentMethod;
	if (form.email && isEmail(form.email.value)==false) {
		alert('Hãy nhập địa chỉ email của bạn');
		form.email.focus();
		return false;
	}
	//return submitForm();
	
	if (form.method.value==2) return submitForm();
	
	if ( validateCard(form.vpc_CardNum.value, form.vpc_card.value, form.expiry_month.value, form.expiry_year.value, form.vpc_CardSecurityCode.value, form.vpc_CardName.value) ) return submitForm();
	else return false;
}

function submitForm(){
	$('#paymentMethod').submit();
}

function isEmail(_email) {
	var emailReg = /^[a-z][a-z-_0-9\.]+@[a-z-_=>0-9\.]+\.[a-z]{2,3}$/i;
	return emailReg.test(_email);
}

function validateCard(cardNumber,cardType,cardMonth,cardYear,cardCVV,cardName) {
	var msgErrorCardNumber = 'Hãy nhập vào số thẻ chính xác';
	if( cardNumber.length == 0 ) {
		alert(msgErrorCardNumber);
		return false;
	}
	for( var i = 0; i < cardNumber.length; ++i ) {
		var c = cardNumber.charAt(i);

		if( c < '0' || c > '9' ) {
			alert("Hãy nhập vào số thẻ chính xác. Chỉ sử dụng chữ số. Không sử dụng dấu cách hay dấu gạch ngang.");
			return false;
		}
	}
    var length = cardNumber.length;

	switch( cardType ) {
		case 'Amex':
			if( length != 15 ) {
				alert(msgErrorCardNumber);
				return;
			}
			var prefix = parseInt( cardNumber.substring(0,2));

			if( prefix != 34 && prefix != 37 ) {
				alert(msgErrorCardNumber);
				return;
			}
			break;
		case 'JCB':
			if( length != 16 ) {
				alert(msgErrorCardNumber);
				return;
			}
			var prefix = parseInt( cardNumber.substring(0,4));
			if( prefix < 3528 || prefix > 3589 ) {
				alert(msgErrorCardNumber);
				return;
			}
			break;
		case 'Mastercard':
			if( length != 16 ) {
				alert(msgErrorCardNumber);
				return;
			}
			var prefix = parseInt( cardNumber.substring(0,2));
			if( prefix < 51 || prefix > 55) {
				alert(msgErrorCardNumber);
				return;
			}
			break;
		case 'Visa':
			if( length != 16 && length != 13 ) {
				alert(msgErrorCardNumber);
				return;
			}
			var prefix = parseInt( cardNumber.substring(0,1));
			if( prefix != 4 ) {
				alert(msgErrorCardNumber);
				return;
			}
			break;
	}
	if( !Mod10( cardNumber ) ) {
		alert(msgErrorCardNumber);
		return false;
	}
	if( expired( cardMonth, cardYear ) ) {
		alert("Ngày hết hạn của không chính xác");
		return false;
	}
	if( cardName == '' || cardName.length < 6 ){
		alert("Hãy nhập tên in trên thẻ");
		return false;
	}
	if( checkCSC( cardType, cardCVV ) ) {
		alert("Hãy nhập đúng số bảo mật");
		return false;
	}
	
	return true;
}

function checkCSC(cardType,cscValue){
    var re = null;
    if(cardType != null){
        if(cardType == "Amex"){
            re = /^\\d{4}$/;
            return re.test(cscValue);
        } else {//Mastercard, Visa, Discover
            re = /^\\d{3}$/;
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
	var valid = "0123456789"  // Valid digits in a credit card number
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