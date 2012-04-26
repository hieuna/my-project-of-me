function removeHTMLTags(strInputCode){
	strInputCode = strInputCode.replace(/&(lt|gt);/g, function (strMatch, p1){
		return (p1 == "lt")? "<" : ">";
	});
	var strTagStrippedText = strInputCode.replace(/<\/?[^>]+(>|$)/g, "");
	alert(strTagStrippedText);
}
