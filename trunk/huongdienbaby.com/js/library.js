// JavaScript Document
function fsPosX(obj)
{
	obj = document.getElementById(obj);
	var curleft = 0;
	if(obj.offsetParent)
		while(1) 
		{
		  curleft += obj.offsetLeft;
		  if(!obj.offsetParent)
			break;
		  obj = obj.offsetParent;
		}
	else if(obj.x)
		curleft += obj.x;
	return curleft;
}

function fsPosY(obj)
{
	var curtop = 0;
	if(obj.offsetParent)
		while(1)
		{
		  curtop += obj.offsetTop;
		  if(!obj.offsetParent)
			break;
		  obj = obj.offsetParent;
		}
	else if(obj.y)
		curtop += obj.y;
	return curtop;
}
// JavaScript Document
showtime = 0;
function changtab(id,count,clear){
	for(i=1;i<=count;i++){
		document.getElementById('tab_'+i).className='tab_nomal';
	}
	document.getElementById('tab_'+id).className='tab_select';
	valueHtml = document.getElementById('content_'+id).innerHTML;
	//alert(removeHTMLTags(valueHtml));
	document.getElementById('tab_content').innerHTML = valueHtml;
	if(clear==1) clearInterval(showtime);
}

function removeHTMLTags(strInputCode){
	strInputCode = strInputCode.replace(/&(lt|gt);/g, function (strMatch, p1){
		return (p1 == "lt")? "<" : ">";
	});
	var strTagStrippedText = strInputCode.replace(/<\/?[^>]+(>|$)/g, "");
	alert(strTagStrippedText);
}

function mouseout(id,count){
	showtime = setInterval(function() {changtab(id,count,1)},6000);
}
function tabdetail(id,count){
	for(i=1;i<=count;i++){
		document.getElementById('detail_'+i).className='tab_nomal';
		document.getElementById('description_'+i).style.display='none';
	}
	document.getElementById('detail_'+id).className='tab_select';
	document.getElementById('description_'+id).style.display='block';
}
function start(id){
		for(i=1;i<=5;i++){
			if(i<=id){
				document.write('<img src="/images/star1.gif" border="0" />');
			}else{
				document.write('<img src="/images/star0.gif" border="0" />');
			}
		}
}

function showmenu(mnname,mnlink,mnulever){
	if(mnulever==2){
		stm_aix("p2i0","p0i0",[1,mnname,"","",-1,-1,0,mnlink,"","","","","",0,0,0,"","",0,0,0,0,0,"#ffffff",0,"#D91102",0,"","",0,0,1,1,"#F27400","#ffffff","#F27400","#ffffff","12px Arial","12px Arial",0,0],130);
	}else{
		stm_bm(["",400,"","/images/space.gif",0,"","",0,0,140,0,20,0,0,0,""],this);
		stm_bp("p0",[1,0,0,0,0,0,0,0,100,"",-2,"",-2,0,0,0,"","","",0,0,0,""]);
		stm_ai("p0i0",[1,"<a href='"+mnlink+"'>"+mnname+"</a>","","",-1,-1,0,"","","","","","",0,0,0,"","",0,0,0,0,1,"#FFFFF7",1,"#B5BED6",1,"","",0,0,0,0,"#FFFFF7","#000000","#FFFFFF","#FFCC00","11px Bold Tahoma","11px Bold Tahoma",0,0]);
		stm_bpx("p1","p0",[1,4,0,0,0,3,0,0,100,"",-2,"",-2,100,0,0,"#999999","#FFFFF7","",3,0,0]);
	}
}
function closemenu(){
	stm_ep();
	stm_ep();
	stm_sc(1,["transparent","transparent","","",3,3,0,0,"#FFFFF7","#000000","","",7,9,0,"","",7,9,0,0,200]);
	stm_em();
}

function fromtopsubmit(id){
		if(document.getElementById("keyword_top").value=='Từ khóa'){
			alert("Bạn chưa nhập từ khóa tìm kiếm");
			return;
		}
		document.getElementById(id).submit();
}
function check_quantity(url){
	window.location.href=url;
}
var div_id = 0;
function addCommas(nStr){
nStr += ''; x = nStr.split('.');x1 = x[0];x2 = x.length > 1 ? '.' + x[1] : '';
var rgx = /(\d+)(\d{3})/;
while (rgx.test(x1)) {x1 = x1.replace(rgx, '$1' + '.' + '$2');}
return x1;
}
function formatCurrency(div_id,str_number){
	/*Convert tu 1000->1.000*/
	var mynumber=1000;
	str_number = str_number.toString();
	str_number = str_number.replace(/\./g,"");
	
	document.getElementById(div_id).innerHTML = addCommas(str_number);
}

function show_left_menu(id){
	object = document.getElementById("div_sub2_" + id);
	try{
		document.getElementById("div_sub2_"+div_id).style.display = 'none';
		//document.getElementById("div_left_"+div_id).className = 'div_left_0';
	}
	catch(e){}

if (object != undefined) {
		if (object.style.display == "none") {
			object.style.display = "block";
			//alert(object.style.display);
			//document.getElementById("div_left_"+id).className = 'div_left_1';
			div_id = id;
		}
		else {
			object.style.display = "none";
		}
	}
	else return;
}
var closeing = 0;
function open_special(id_showhidden,height){
	obj		  = document.getElementById(id_showhidden);
	obj_height = parseInt(obj.style.height);
	if(obj_height<height && closeing == 0){
		obj.style.height = (obj_height+1)+'px';
		setInterval(function() {open_special(id_showhidden,height)},50);
	}else{
		return;
	}
}
function close_special(id_showhidden){
	obj		  = document.getElementById(id_showhidden);
	obj_height = parseInt(obj.style.height);
	if(obj_height>0){
		obj.style.height = (obj_height-1)+'px';
		setInterval(function() {close_special(id_showhidden)},50);
	}else{
		return;
	}
}
function special(id_showhidden,height){
	if(closeing==0){
		open_special(id_showhidden,height);
		closeing = 1;
	}else{
		closeing = 0;
		close_special(id_showhidden);
	}
}
function showhidden(id_showhidden){
		obj = document.getElementById(id_showhidden);
		obj.style.display = (obj.style.display=='none') ? 'block' : 'none';
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
function load_data(obj_response,file_action){
	makeRequest(file_action, obj_response, 'GET', '')
}
function makeRequest(url, obj_response, method, parameters) {
	var http_request	= false;
	var show_id			= document.getElementById(obj_response);
	if (!show_id) {
		//alert('Cannot find object response data !');	
		return false;
	}
	if(url == ""){
		return false;
	}
	show_id.innerHTML	= 'Searching...';
	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		http_request	= new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			//set type accordingly to anticipated content type
			http_request.overrideMimeType('text/html');
		}
	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject('Msxml2.XMLHTTP');
		} catch (e) {
			try {
				http_request = new ActiveXObject('Microsoft.XMLHTTP');
			} catch (e) {}
		}
	}
	if (!http_request) {
		alert('Cannot create XMLHTTP instance');
		return false;
	}
	
	http_request.onreadystatechange=	function(){
	if (http_request.readyState == 4) {
		if (http_request.status == 200) {
			//alert(http_request.responseText);
			show_id.innerHTML = http_request.responseText;     
		} else {
			//alert('There was a problem with the request.');
			return false;
		}
	}
	}
	if(method == 'GET'){
		http_request.open('GET', url, true);
		http_request.send('');
	}
	else if(method == 'POST'){
		http_request.open('POST', url, true);
		http_request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http_request.setRequestHeader('Content-length', parameters.length);
		http_request.setRequestHeader('Connection', 'close');
		http_request.send(parameters);
	}
}

