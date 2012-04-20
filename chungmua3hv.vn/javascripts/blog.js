//------------------------------------------------------------------------------
//
//  Copyright(c) 2004 truelocal.vn. All rights reserved.
//
//  design by nhocconvn 
//  email dinhhungvn@gmail.com
// all function for truelocal network
//------------------------------------------------------------------------------
$(document).ready(function() {
  // Handler for .ready() called.
$(".slide").focus(function(){
			 $(this).css('height','100px');
			 $("#closeShare").css('display','');
});

$(".shared").mouseover(function() {
	 var text= $(this).attr('rel');
    $(this).append($("<div id='sharedHtml'>"+ text +"</div>"));
  }).mouseout(function(){
    $(this).find("div:last").remove();
  });
$("input[type=button]").blur(function() {
	 var text= $(this).attr('rel');
    $(this).append($("<div id='sharedHtml'>"+ text +"</div>"));
  }).mouseout(function(){
    $(this).find("div:last").remove();
  });
$("#closeShare").click(function(){
	$(".slide").css('height','60px');
			 $("#closeShare").css('display','none');
	return false;
})

});

