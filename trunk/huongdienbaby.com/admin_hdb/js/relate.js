function removeOptionSelected(id)
{
  var elSel = document.getElementById(id);
  var i;
  for (i = elSel.length - 1; i>=0; i--) {
    if (elSel.options[i].selected) {
      elSel.remove(i);
    }
  }
}

function appendOption(id1,id2)
{
	for(i=0;i<document.getElementById(id1).options.length;i++){
		if(document.getElementById(id1).options[i].selected){
			title=document.getElementById(id1).options[i].text;	
			giatri=document.getElementById(id1).options[i].value;
			addOption(id2,giatri,title);
		}
	}
	removeOptionSelected(id1);
}
function addOption(id2,giatri,title){
	checkthemmoi=1;
	for(j=0;j<document.getElementById(id2).options.length;j++){
		if(document.getElementById(id2).options[j].value==giatri){
			checkthemmoi=0;
			break;
		}
	}
	if(checkthemmoi==1){
		var elOptNew 		= document.createElement('option');
		elOptNew.text 		= title;
		elOptNew.title		= title;
		elOptNew.value 	= giatri;
		var elSel 			= document.getElementById(id2);
		 try {
			 elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
		 }
		 catch(ex) {
			elSel.add(elOptNew); // IE only
		 }
	}
}
function selectAll(id){
	for(i=0;i<document.getElementById(id).options.length;i++){
		document.getElementById(id).options[i].selected=true;
	}
}
function load_data(obj_response){
	if(document.getElementById('keyword_relate').value==''){
		//alert("nhap category can tim !");
		return;
	}
	file_action='searchrelate.php?keyword=' + encodeURI(document.getElementById('keyword_relate').value);
	makeRequest(file_action, obj_response, 'GET', '')
}
function loadUser(obj_response,userlogin){
	file_action='checkuser.php?uselogin=' + encodeURI(userlogin);
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
function removeOptionLast()
{
  var elSel = document.getElementById('room_select');
  if (elSel.length > 0)
  {
    elSel.remove(elSel.length - 1);
  }
}
//-->
