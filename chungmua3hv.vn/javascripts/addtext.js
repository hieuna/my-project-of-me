//------------------------------------------------------------------------------
//
//  Copyright(c) 2004 truelocal.vn. All rights reserved.
//
//  design by nhocconvn 
//  email dinhhungvn@gmail.com
// all function for truelocal network
//------------------------------------------------------------------------------
function focusText(textTitle){
$('#textBlock').val('#' +textTitle);
$("#textValue").val($("#"+ textTitle).attr("title"));
	
	}
function changeText(){
	if($("#textValue").val()==""){
		alert("Please select bock to edit!");
		return false;
	}
var textTitle= $("#textBlock").val();
$(textTitle).html($("#textValue").val());
$(textTitle).val($("#textValue").val());
var font_type= $("#fontType").val();
var doituong= $("#textBlock").val();

$(doituong).css("font-family",font_type);
$(doituong).css("font-size",$("#fontSize").val());
$(doituong).css("color",$("#colorCoupon").val());

$(textTitle).attr({title:$("#textValue").val()});
if($("#textStyleB").hasClass('boxStyle-hover2'))	
	$(doituong).css("font-weight",'bold');
else
	$(doituong).css("font-weight",'normal');

if($("#textStyleI").hasClass('boxStyle-hover2'))	
	$(doituong).css("font-style",'italic');
else
	$(doituong).css("font-style",'normal');
if($("#textStyleU").hasClass('boxStyle-hover2'))	
	$(doituong).css("text-decoration",'underline');
else
	$(doituong).css("text-decoration",'none');

$("#ValueCoupon").val($("#CouponView").html());

}

$(".boxStyle").hover(
   function () {
    $(this).addClass("boxStyle-hover");
  },
  function () {
    $(this).removeClass("boxStyle-hover");
  }

);
$(".boxStyle").click(
   function () {
	if($(this).hasClass('boxStyle-hover2'))
		$(this).removeClass("boxStyle-hover2");
	else
		$(this).addClass("boxStyle-hover2");
		
	changeText();
  }

);

function updateValue(){
$("#ValueCoupon").val($("#CouponView").html());

}
function imageEdit(url){
newwindow=window.open(url,'name','height=600,width=850');

}
function loadDefault(){
$("#ValueCoupon").val($("#CouponView").html());

}

$(document).ready(function()
{	
	$("#ValueCoupon").val($("#CouponView").html());
	$(".addTextLabel").hover(
	   function () {
			$(this).addClass("addTextLabelHover");
			$(this).removeClass("addTextLabel");
	  }, 
  function () {
			$(this).removeClass("addTextLabelHover");
			$(this).addClass("addTextLabel");
  }

	
	);
});

