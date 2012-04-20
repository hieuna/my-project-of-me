var value_defaul_photo = 0;
function changeLang(langid, url, tab){
	$.get(url+'&lang_id='+langid, function(result){
		document.getElementById(tab).parentNode.innerHTML = result;		
	});
}
function changeLangMulti(langid, url, tab1, tap2){
	$.get(url+'&task=chagedestination&lang_id='+langid, function(results){
		document.getElementById(tap2).parentNode.innerHTML = results;		
	});
	$.get(url+'&task=changeLang&lang_id='+langid, function(result){
		document.getElementById(tab1).parentNode.innerHTML = result;		
	});
}
function changeGroup(groupid, url, tab){
	$.get(url+'&group_id='+groupid, function(result){	
		document.getElementById(tab).innerHTML = result;
	});
}
function clearDivAttribute(tab)
{
	document.getElementById(tab).innerHTML = '';
}
function addUploadFields()
{	
	varBr = document.createElement("br");	
	img = document.createElement('INPUT');
	img.type = "file";
	img.name = "Product_Photo[]";
	img.style.width = "250";
	document.getElementById('div_photo').appendChild(varBr);
	document.getElementById('div_photo').appendChild(varBr);
	document.getElementById('div_photo').appendChild(img);	
}