function test() {
	alert("da vao day");
}

function validateEmail(obj)
{
	apos=obj.value.indexOf("@");
	dotpos=obj.value.lastIndexOf(".");
	if(obj.value == '')
	{
		return 1;		
	}
	else if (apos<1||dotpos-apos<2) 
	 {
		  return 2;			
	 }			 
	return true;
}

function checkLength(obj, strlength = 6)
{
	var val=obj.value;
	var isOk = true;
	if(val == '')
	{
		isOk = false;
		return 1;
	} else if (nick.length < strlength ) {
		return 2;		
	}
	if (!isOk) {
		obj.style.background = "yellow";
		obj.focus();
		return false;
	}		
	return true;
}
