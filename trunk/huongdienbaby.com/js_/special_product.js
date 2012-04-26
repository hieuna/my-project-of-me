var group_id = 0;
//Biến đang đóng, nếu đang đóng thì ko có 1 cái nào đc mở 
var closeing = 0;
function open_special(){
	if (closeing==1) return;
	document.getElementById("mydiv_special_product").className='mydiv_special_product';
	if (parseInt(document.getElementById("mydiv_special_product").style.height) > 290) {
		//load_data("/ajax/get_special_product.php?group_id=" + group_id, "mydiv_special_product");
		return;
	}
	else{
		document.getElementById("mydiv_special_product").innerHTML = '';
	}
	document.getElementById("mydiv_special_product").style.height = (parseInt(document.getElementById("mydiv_special_product").style.height) + 10)+'px';
	setTimeout("open_special()",20);
}

function close_special(){
	if (parseInt(document.getElementById("mydiv_special_product").style.height) <= 10) {
		document.getElementById("mydiv_special_product").style.height = "1px";
		document.getElementById("mydiv_special_product").className='mydiv_special_product_close';
		closeing = 0;
		return;
	}
	closeing = 1;
	document.getElementById("mydiv_special_product").style.height = (parseInt(document.getElementById("mydiv_special_product").style.height) - 10)+'px';
	setTimeout("close_special()",20);
}

function FadeIn(obj){
	obj.style.filter="progid:DXImageTransform.Microsoft.Alpha(opacity=100)";
	obj.filters[0].apply();
	obj.filters[0].play();
}

function FadeOut(obj){
	obj.style.filter="progid:DXImageTransform.Microsoft.Alpha(opacity=50)";
	obj.filters[0].apply();
	obj.filters[0].play();
}