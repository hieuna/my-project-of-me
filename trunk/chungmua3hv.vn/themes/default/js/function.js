$(document).ready(function() {
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
 function popup(obj) {
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
	};
 function buydeal(obj) {
	var url= $(obj).attr("href");
	var splitted=url.split("?");
	var tmplink =  splitted[0];
	var string = explode('?', url);
	var demo = string[1];
	var demo= explode('=', demo);
	var demo = demo[1];
	var size= explode('x',demo);
	var stateObj = { foo: "bar" };
	//history.pushState(stateObj, "curentpage", task);
	//url= ser'+task;
	//$("#loading").html('loading...');
	var width= size[0];
	var height=  size[1];
//	alert(height);
	$('#popupCoupon').css({"left":"30%","top":"30%","paging":"10px","margin":"auto", "width": width+'px', "height": height+'px'});
	$("#popupCoupon").fadeIn('100');
	$("#loading").fadeIn('1');
		$('#popupCoupon').fadeIn(1,function(){
			$(this).load(tmplink+"?ajax=true");
		});	
	//	$(".")
		//$.get(url+'&ajax=true', function(data) {
		//$("#loadingcontrol").fadeOut(1);
//		$("#loading").fadeOut('1');
		return false;
	};


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