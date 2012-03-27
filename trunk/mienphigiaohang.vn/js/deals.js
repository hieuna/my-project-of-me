function popup(url){
    var width  = 600;
    var height = 400;
    var left   = (screen.width  - width)/2;
    var top    = (screen.height - height)/2;
    var params = 'width='+width+', height='+height;
    params += ', top='+top+', left='+left;
    params += ', directories=no';
    params += ', location=no';
    params += ', menubar=no';
    params += ', resizable=no';
    params += ', scrollbars=no';
    params += ', status=no';
    params += ', toolbar=no';
    var newwin=window.open(url,'windowname5', params);
    if (window.focus) {newwin.focus()}
    return false;
}

function openWindow(url, wname, width, height) {
    var left   = (screen.width  - width)/2;
    var top    = (screen.height - height)/2;
    
    window.open(url, wname, "height=" + height + ",width=" + width + ", top="+top+", left="+left+",location = no, status = no, resizable = 0, scrollbars=no, toolbar = 0");
    return true;
}

function checkall(total){
	if(document.getElementById("check_all").checked==true){		
		for(i=1;i<=total;i++){
			try{
				document.getElementById("record_"+i).checked = true;	
			}
			catch(e){}
		}
	}else{
		for(i=1;i<=total;i++){
			try{
				document.getElementById("record_"+i).checked = false;	
			}
			catch(e){}
		}
	}
};

$(document).ready(function() {
		   $('#checkhome').click(function(){
			 $('#viadeal').hide();
			 $('#giaonhan').show();
			 document.getElementById("checkdeal").checked= false;
		   });
		   $('#checkdeal').click(function(){
			 $('#viadeal').show();
			 $('#giaonhan').hide();
			 document.getElementById("checkhome").checked= false;
		   });		   
 		});
	  
	  //check script
	  function kiemtra1()
	{
		if(document.deal_checkcart_1.user_name.value=="")
		{
			alert ("Bạn phải nhập Họ tên");
			return false;
		}
				
		
		if(document.deal_checkcart_1.user_phone.value=="")
		{
			alert ("Hãy điền số điện thoại để chúng tôi liên hệ với bạn");
			return false;
		}
		
		if(document.deal_checkcart_1.user_add.value=="")
		{
			alert ("Bạn hãy điền địa chỉ của bạn");
			return false;
		}
		if (isNaN(document.deal_checkcart_1.user_phone.value))
		{
			alert("Số điện thoại của bạn không hợp lệ! Chỉ nhập số!");
			return false;
		}
		
		return true;
	}
	
	function kiemtra2()
	{
		if(document.deal_checkcart_2.user_name2.value=="")
		{
			alert ("Bạn phải nhập Họ tên");
			return false;
		}
				
		
		if(document.deal_checkcart_2.user_phone2.value=="")
		{
			alert ("Hãy điền số điện thoại để chúng tôi liên hệ với bạn");
			return false;
		}
				
		if (isNaN(document.deal_checkcart_2.user_phone2.value))
		{
			alert("Số điện thoại của bạn không hợp lệ! Chỉ nhập số!");
			return false;
		}
		
		return true;
	}