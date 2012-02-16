// JavaScript Document
function isDate(dateStr){
	var datePat = /^(\d{1,2})(-)(\d{1,2})(\/|-)(\d{4})$/;
	var matchArray = dateStr.match(datePat); // is the format ok?
	
	if (dateStr=='')return false;
	if (matchArray == null) return false;
	
	month = matchArray[3]; // parse date into variables
	day = matchArray[1];
	year = matchArray[5];
	
	if (day < 1 || day > 31)return false;
	if (month < 1 || month > 12) return false;
	if ((month==4 || month==6 || month==9 || month==11) && (day==31)) return false;
	if (month == 2){ // check for february 29th
		var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
		
		if (day > 29 || (day==29 && !isleap)) return false; 
	}
	if ((year<1900) || (year>2099)) return false;
	return true; // date is valid
}

function checkDate(from_ngay,to_ngay) {	
	if (from_ngay == "" || to_ngay == "") return true;
	var arrDate1;
	var arrDate2;
	arrDate1 = from_ngay.split("-");
	arrDate2 = to_ngay.split("-");
	
	if (arrDate1[1].length == 1) arrDate1[1]= "0" + arrDate1[1];
	if (arrDate1[0].length == 1) arrDate1[0]= "0" + arrDate1[0];
	if (arrDate2[1].length == 1) arrDate2[1]= "0" + arrDate2[1];
	if (arrDate2[0].length == 1) arrDate2[0]= "0" + arrDate2[0];
	
	var strDate1 = arrDate1[2] + arrDate1[1] + arrDate1[0];
	var strDate2 = arrDate2[2] + arrDate2[1] + arrDate2[0];
	if (strDate1 <= strDate2) return true;
	else return false;
}

function IsEmail(email){	
	if (email.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
		return true;
	else			
		return false;
}