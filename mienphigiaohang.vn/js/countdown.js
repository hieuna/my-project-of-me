//######################################################################################
// Author: ricocheting.com
// Version: v2.0
// Date: 2011-03-31
// Description: displays the amount of time until the "dateFuture" entered below.

// NOTE: the month entered must be one less than current month. ie; 0=January, 11=December
// NOTE: the hour is in 24 hour format. 0=12am, 15=3pm etc
// format: dateFuture1 = new Date(year,month-1,day,hour,min,sec)
// example: dateFuture1 = new Date(2003,03,26,14,15,00) = April 26, 2003 - 2:15:00 pm


// TESTING: comment out the line below to print out the "dateFuture" for testing purposes
//document.write(dateFuture +"<br />");


//###################################
//nothing beyond this point
function GetCount(ddate,iid){

	dateNow = new Date();	
	amount = ddate.getTime() - dateNow.getTime();	
	delete dateNow;

	// if time is already past
	if(amount < 0){
		document.getElementById(iid).innerHTML="CHÁY DEAL";
	}
	// else date is still good
	else{
		days=0;hours=0;mins=0;secs=0;out="";

		amount = Math.floor(amount/1000);

		days=Math.floor(amount/86400);
		amount=amount%86400;

		hours=Math.floor(amount/3600);
		amount=amount%3600;

		mins=Math.floor(amount/60);
		amount=amount%60;

		secs=Math.floor(amount);

		if(days != 0){out += '<strong>'+days+'</strong>' +" "+((days==1)?"Ngày":"Ngày")+" ";}
		if(hours != 0){out += '<strong>'+hours+'</strong>' +" "+((hours==1)?"giờ":"giờ")+" ";}
		out +='<strong>'+mins+'</strong>' +" "+((mins==1)?"phút":"phút")+" ";
		out += '<strong>'+secs+'</strong>' +" "+((secs==1)?"giây":"giây")+", ";
		out = out.substr(0,out.length-2);
		document.getElementById(iid).innerHTML=out;

		setTimeout(function(){GetCount(ddate,iid)}, 1000);
	}
}

