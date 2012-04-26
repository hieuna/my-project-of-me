// JavaScript Document
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) {if (val.title!="") {nm=val.title;} else {nm=val.name;} if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- "'+nm+'" phải là một địa chỉ email.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- "'+nm+'" phải là một số.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- "'+nm+'" phải là số nằm giữa '+min+' và '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- Bạn chưa nhập "'+nm+'".\n'; }
  } if (errors) alert('Có những lỗi sau:\n'+errors);
  document.MM_returnValue = (errors == '');
}
function changeTypeForm(id){
		var valuetext 				= document.getElementById('pro_des_'+id).value;
		document.getElementById('span_'+id).innerHTML = '';
		var element 	= document.getElementById('span_'+id);
		var image   	= document.getElementById('image_'+id).src;
		var imagename	= image.indexOf('1.png');
		if(imagename != -1){
			var newElement 			= document.createElement('textarea');
			newElement.cols 			= 72;
			newElement.rows 			= 6;
			newElement.className 	= 'form';
			newElement.name 			= 'pro_des_'+id;
			newElement.id	 			= 'pro_des_'+id;
			newElement.value 			=	valuetext;
			element.appendChild(newElement);
			document.getElementById('image_'+id).src = '../images/0.png';
		}else{
			var newElement 			= document.createElement('input');
			newElement.type 			= 'text';
			newElement.className 	= 'form';
			newElement.name 			= 'pro_des_'+id;
			newElement.id	 			= 'pro_des_'+id;
			newElement.value 			=	valuetext;
			newElement.style.width 	= '400px';
			element.appendChild(newElement);
			document.getElementById('image_'+id).src = '../images/1.png';
		}
}

function changethuoctinh(value){
		document.getElementById('category_thuoctinh').style.height = (parseInt(value)*30)+'px';
		for(i=1;i<50;i++){
			if(i>parseInt(value)){
				document.getElementById('cat_form_'+i).value = '';
			}
		}
}
function check_all(start_loop, end_loop){
	for(i=start_loop; i<=end_loop; i++){
		try{
			document.getElementById("check_" + i).checked = true;
			document.getElementById("tr_" + i).className = "on_check";
		}
		catch(e){}
	}
}

function uncheck_all(start_loop, end_loop){
	for(i=start_loop; i<=end_loop; i++){
		try{
			document.getElementById("check_" + i).checked = false;
			document.getElementById("tr_" + i).className = "on_uncheck";
		}
		catch(e){}
	}
}

function change_bg(check_id, object_id){
	if(document.getElementById(check_id).checked == true){
		document.getElementById(object_id).className = "on_check";
	}
	else{
		document.getElementById(object_id).className = "on_uncheck";
	}
}

function creat_link(object){
	window.open("../link/selected.php?object=" + object, "","height=600,width=700,menubar=0,resizable=1,scrollbars=1,statusbar=0,titlebar=0,toolbar=0");
}
function Setcode(object,path,char){

	var pos = path.lastIndexOf(char);
	var pos2 = path.lastIndexOf(".");

	if(pos2>-1)
		fileName =path.substring(pos+1, pos2);
	else
		fileName =path.substring(pos+1);
		document.getElementById(object).value=fileName;
}

function check(start_loop, end_loop){
	if(document.all.check_all.checked == false){
		uncheck_all(start_loop, end_loop);
	}else{
		check_all(start_loop, end_loop);
	}
}
function submitAll(formname,iCat,id){
		document.getElementById("record_"+ iCat + "_" + id).checked = true;
		document.getElementById(formname).submit();
}
function changeCheck(iCat,id){
	document.getElementById("record_"+ iCat + "_" + id).checked = true;
}
// JavaScript Document
var isopen = 0;
var widthLeft = 200;
function change_left(){
	//dong left
	if (isopen==0){
		parent.resize_left(0);
		document.all.mybutton.value=' Hiển thị thanh menu ';
		isopen=1;
		widthLeft=0;
	}
	//mo left
	else{
		parent.resize_left(1);
		document.all.mybutton.value=' Ẩn thanh menu ';
		isopen=0;
		widthLeft=200;
	}
}

-->