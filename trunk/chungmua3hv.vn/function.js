
$(document).ready(function() {
$(".commentUserContent").hover(function(){
	$(this).css({"border-color":"#BEB7A5"});
},function(){
	$(this).css({"border-color":"#E5DECA"});

});
$("#noLoginClick").click(function(){
	var url = $(this).attr('rel');
	popup('<center><p>Bạn cần đăng nhập để thực hiện chức năng này.</p><a class="formBtn" href="javascript:void(0)" onclick="return closeForm();">Thoát</a><a class="formBtn" href="dang-nhap.html?url='+url+'"  style="clear:both; margin-top:10px;margin-left:5px; ">Đăng nhập</a></center>','300x100'); return false;
})
$('#loading').click(function() {
	//$(this).fadeOut();
})
$('.links').click(function() {
	var task= $(this).attr("href");
	var stateObj = { foo: "bar" };
	history.pushState(stateObj, "curentpage", task);
	url= document.location.href;
	//alert(url);
	$("#loading").fadeIn('1');
	$("#loadingcontrol").fadeIn('1');
		//$.get(url+'&ajax=true', function(data) {
		//$(".homeload").load(url+'&ajax=true');
		$.get(url+'&ajax=true', function(data) {
			$('.homeload').html(data);
			$("#loading").fadeOut('1');
		});
		return false;
});
})
 function vs_clicks(obj) {
	var task= $(obj).attr("href");
	var stateObj = { foo: "bar" };
	history.pushState(stateObj, "curentpage", task);
	url= document.location.href;
	//alert(url);
	//$("#loading").html('loading...');
		$("#loading").fadeIn('1');
		$("#loadingcontrol").fadeIn('1');
		//$.get(url+'&ajax=true', function(data) {
		//$(".homeload").load(url+'&ajax=true');
		$.get(url+'&ajax=true', function(data) {
			$('.homeload').html(data);
			$("#loading").fadeOut('1');
		});
	//	$("#loadingcontrol").fadeOut(1);
		return false;
	};
function reloadPage(){
location.reload(true)

}
function closeForm(){
		$("#loading").fadeOut(1);
		$("#loadingcontrol").fadeOut(1);
		$("#popupCoupon").fadeOut('100');
		$("#popupCoupon").html('');
		return false;

}
function hung(){
	alert('sdsd');
	}
 function vs_popup(obj) {
	var task= $(obj).attr("href");
	//var stateObj = { foo: "bar" };
	//history.pushState(stateObj, "curentpage", task);
	url= siteURL + 'user'+task;
	//$("#loading").html('loading...');
		$("#loading").fadeIn('1');
		$("#popupCoupon").fadeIn('1');
		//$.get(url+'&ajax=true', function(data) {
		$("#popupCoupon").html("<iframe frameborder='0'  src=\""+url+"&ajax=true\" width=\"950px\" height=\"400px\"><p>Your browser does not support iframes.</p></iframe>");
		//$("#loadingcontrol").fadeOut(1);
//		$("#loading").fadeOut('1');
		return false;
	};
 /*function popup(obj) {
	var url= $(obj).attr("href");
	//var stateObj = { foo: "bar" };
	//history.pushState(stateObj, "curentpage", task);
	//url= ser'+task;
	//$("#loading").html('loading...');
	$('#popupCoupon').css({"width":"0px","height":"0","left":"50%","top":"50%"});
	$("#popupCoupon").fadeIn('100');
	$("#loading").fadeIn('1');
		$('#popupCoupon').animate({
		  width: '500px',
		  height: '150px',
		  top: '30%',
		  left: '30%',
		},300,function(){
			$(this).load(url+"?ajax=true");
		
		});	
	//	$(".")
		//$.get(url+'&ajax=true', function(data) {
		//$("#loadingcontrol").fadeOut(1);
//		$("#loading").fadeOut('1');
		return false;
	};*/
$(document).keyup(function(e) {

  if (e.keyCode == 27) {
		return closeForm();	  }   // esc
});

 function buydeal(obj) {
	var url= $(obj).attr("href");
	var splitted=url.split("?");
	var tmplink= splitted[0];
	var string = explode('?', url);
	var demo = string[1];
	var demo= explode('=', demo);
	var demo = demo[1];
	var size= explode('x',demo);
//	alert(tmplink);
	//alert(size);
	//var stateObj = { foo: "bar" };
	//history.pushState(stateObj, "curentpage", task);
	//url= ser'+task;
	//$("#loading").html('loading...');

	var width= parseInt(size[0]);
	var height= parseInt(size[1]);
//	alert(height);
	var left = (screen.width/2)-(width/2);
	var top = (screen.height/2)-(height/2);
	$('#popupCoupon').css({"width":width+'px',"height":height+'px',"left":left,"overflow-y":"auto","top":top-80,"margin":"auto","padding":"10px"});
	var cleft= width+left-10;
	$('#closePopup').css({"left":cleft,"top":top-75,"margin":"auto"});
	$("#loading").css({"display":"block"});
	$("#loading").css({"height":screen.height});
	$("#popupCoupon").css({"display":"block"});
	$('#popupCoupon').load(tmplink+"?ajax=true",function(){
		$("#loadingcontrol").fadeOut('1');
	
	});
	//	$(".")
		//$.get(url+'&ajax=true', function(data) {
		//$("#loadingcontrol").fadeOut(1);
//		$("#loading").fadeOut('1');
		return false;
	};
 function popup(msg,demo) {
	var size= explode('x',demo);
//	alert(tmplink);
	//alert(size);
	//var stateObj = { foo: "bar" };
	//history.pushState(stateObj, "curentpage", task);
	//url= ser'+task;
	//$("#loading").html('loading...');

	var width= parseInt(size[0]);
	var height= parseInt(size[1]);
//	alert(height);
	var left = (screen.width/2)-(width/2);
	var top = (screen.height/2)-(height/2);
	$('#popupCoupon').css({"width":width+'px',"height":height+'px',"left":left,"overflow-y":"auto","top":top-80,"margin":"auto","padding":"10px"});
	var cleft= width+left-10;
	$('#closePopup').css({"left":cleft,"top":top-75,"margin":"auto"});
	$("#loading").css({"display":"block"});
	$("#loading").css({"height":screen.height});
	$("#popupCoupon").css({"display":"block"});
	$('#popupCoupon').html(msg);
	vsgClose();
	//	$(".")
		//$.get(url+'&ajax=true', function(data) {
		//$("#loadingcontrol").fadeOut(1);
//		$("#loading").fadeOut('1');
		return false;
	};
function vsgShow(){
		$("#loadingcontrol").fadeIn('1');
}
function vsgClose(){
		$("#loadingcontrol").fadeOut('1');
}

function explode (delimiter, string, limit) {
    // http://kevin.vanzonneveld.net
    // +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: kenneth
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: d3x
    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: explode(' ', 'Kevin van Zonneveld');
    // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    // *     example 2: explode('=', 'a=bc=d', 2);
    // *     returns 2: ['a', 'bc=d']
    var emptyArray = {
        0: ''
    };

    // third argument is not required
    if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {
        return null;
    }

    if (delimiter === '' || delimiter === false || delimiter === null) {
        return false;
    }

    if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
        return emptyArray;
    }

    if (delimiter === true) {
        delimiter = '1';
    }

    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument
        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;
    }
}

function gotoTop(id){
		$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
		return false;

}
function memberLogOut(url){
	var smtpl = confirm("Bạn chắc chắn muốn thoát?");
	if(smtpl){
		document.location="dang-xuat.html?url="+url;
	}
}
function checkLoginComment(frm){
	if(frm.frmComment.value=='')
	{
		alert('Xin vui lòng nhập nội dung bình luận.');
		frm.frmComment.focus();
		return false;
	}
	if(frm.frmComment.value.length < 50)
	{
		alert('Nội dung quá ngắn, tối thiểu 50 kí tự.');
		frm.frmComment.focus();
		return false;
	}
}


 function checkFormReport(frm){
	$(this).submit(function() {
		vsgShow();
		$.post('bao-cao-vi-pham-p-'+frm.ID.value+'.html', {id:frm.ID.value}, function(data) {
			vsgClose();
		  $('#resultReport').html(data);
		});	 	 
		return false;
	});	 
	 return false;
   }
   function checkFormLike(frm){
	$(this).submit(function() {
		vsgShow();
		$.post('dong-y-voi-binh-luan-p-'+frm.ID.value+'.html', {id:frm.ID.value}, function(data) {
			vsgClose();
		  $('#resultReport').html(data);
		});	 	 
		return false;
	});	 
	 return false;
   }

function frmPasswordTest(frm){
	if(frm.frmPassword.value==''){
		alert('Bạn chưa nhập mật khẩu cũ.');
		frm.frmPassword.focus();
		return false;
	}
	if(frm.frmPasswordNew.value==''){
		alert('Bạn chưa nhập mật khẩu mới.');
		frm.frmPasswordNew.focus();
		return false;
	}
	if(frm.frmPasswordNewConfirm.value==''){
		alert('Bạn chưa xác nhận mật khẩu mới.');
		frm.frmPasswordNewConfirm.focus();
		return false;
	}
	if(frm.frmPasswordNewConfirm.value!=frm.frmPasswordNew.value){
		alert('Bạn xác nhận mật khẩu chưa đúng.');
		frm.frmPasswordNewConfirm.select();
		return false;
	}
}
function checkfrmEditInformation(frm){
	if(frm.frmName.value==''){
		alert('Xin vui lòng nhập họ tên của bạn.');
		frm.frmName.focus();
		return false;
	}
	if(frm.frmEmail.value==''){
		alert('Xin vui lòng nhập email của bạn.');
		frm.frmEmail.focus();
		return false;
	}
	if(frm.frmPhone.value==''){
		alert('Xin vui lòng nhập số điện thoại.');
		frm.frmPhone.focus();
		return false;
	}
	if(frm.frmAddress.value==''){
		alert('Xin vui lòng nhập địa chỉ của bạn. Thông tin này sẽ được cập nhật để chúng tôi giao hàng cho bạn.');
		frm.frmAddress.focus();
		return false;
	}
	
	
}
function frmRegisterAccount(frm)
{
	var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
	var email = frm.email.value;
	var ph = /^[0-9]{7,11}$/;
	var phone = frm.phone.value;
	if(frm.fullname.value=='')
	{
		alert('Xin vui lòng nhập họ tên của bạn.');
		frm.fullname.focus();
		return false;	
	}
	if(frm.password.value=='')
	{
		alert('Xin vui lòng nhập mật khẩu.');
		frm.password.focus();
		return false;	
	}
	if(frm.passconf.value=='')
	{
		alert('Xin vui lòng nhập mật khẩu xác nhận.');
		frm.passconf.focus();
		return false;	
	}
	if(frm.passconf.value!=frm.password.value)
	{
		alert('Bạn xác nhận mật khẩu chưa đúng.');
		frm.passconf.focus();
		return false;	
	}
	if(frm.email.value=='')
	{
		alert('Xin vui lòng nhập email.');
		frm.email.focus();
		return false;	
	}
	if ( !email.match(re) )
	{
		alert ("Email của bạn không chính xác");
		frm.email.focus();
		return false;		
	}
	if(frm.phone.value=='')
	{
		alert('Xin vui lòng nhập số điện thoại.');
		frm.phone.focus();
		return false;	
	}
	if ( !phone.match(ph) )
	{
		alert ("Số điện thoại bạn nhập không chính xác!");
		frm.phone.focus();
		return false;		
	}
	if(frm.security.value=='')
	{
		alert('Xin vui lòng nhập mã số xác nhận.');
		frm.security.focus();
		return false;	
	}
	if(frm.termofuse.checked == false)
	{
		alert('Bạn chưa chọn đồng ý với yêu cầu của chungmua3hv.');
		frm.termofuse.focus();
		return false;	
	}
}


function checkSelectMethod(frm){
	if(frm.pmt_method.value==''){
		alert('Bạn chưa chọn phương thức thanh toán!');
		gotoTop('chonphuongthuc');
		return false;
	}
}
$(".method").hover(
  function () {
    $(this).addClass('method_hover'); 
  }, 
  function () {
    $(this).removeClass('method_hover');
  }
);

