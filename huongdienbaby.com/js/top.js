//Url="http://www.vatgia.com";
Url="";

/************************************************************************************************/
/* timeInterVal : Interval Time                                                                 */
/* imgHeight : Height of the Top Button                                                         */
/* topDir : Calculated Direction true (top->bottom) / false (bottom->top)/ default (true)       */
/* bwrHeight : Height of the Browser                                                            */
/* limitBwrHeight - The miminum height when the browser's height is reduced under limit.        */
/* baseGap : the gap between specified postion and the browser                                  */
/* isNS4 : Check the version of Netscape 4                                                      */
/* isNS6 : Check the version of Netscape 6                                                      */
/* isMSIE : Check the Internet Explorer                                                         */
/************************************************************************************************/
var timeInterVal = 100;
var imgHeight = 16;
var topDir = true;
var bwrHeight = 0;
var limitBwrHeight = 550;
var baseGap = 20;
var isNS4 = false;
var isNS6 = false;
var isMSIE = false;
//var position = 50;
/************************************************************************************************/
/* Top Button Position Direction Change Function                                                */
/************************************************************************************************/
function setTopDir(dVal){
	topDir = dVal;
}

/************************************************************************************************/
/* Get Browser Function                                                                         */
/************************************************************************************************/
function getBrowser() {
	isNS4 = ((document.layers)==null)?false:true;
	isNS6 = ((!document.all && document.getElementById)==null || (!document.all && document.getElementById) == false)?false:true;
	isMSIE = ((document.all)==null)?false:true;
}

/************************************************************************************************/
/* Call Browser Size Function                                                                   */
/************************************************************************************************/
function chgWinSize() {
	initTopButton();
}

/************************************************************************************************/
/* Initial Top Button Function                                                                  */
/************************************************************************************************/
function initTopButton() {
	if (isNS4 || isNS6) {
		bwrHeight = window.innerHeight; 
	} else if(isMSIE) {
		bwrHeight = document.body.clientHeight;
	}
	if (isNS4) document.goTop.top = limitBwrHeight;
	if (isNS6) document.getElementById('goTop').style.top = limitBwrHeight +'px';
	if (isMSIE) goTop.style.pixelTop = limitBwrHeight +'px';
}

/************************************************************************************************/
/* Move Top Button Function                                                                     */
/************************************************************************************************/
function TopMovec() {
	var topPos = (topDir)?bwrHeight-(baseGap+imgHeight):baseGap;
	if (isNS4) document.goTop.top = topPos+window.pageYOffset;
	if (isNS6) document.getElementById('goTop').style.top = topPos+scrollY;
	if (isMSIE) goTop.style.pixelTop = topPos+document.body.scrollTop;
	if(topDir) {
		if (isNS4 && document.goTop.top <= limitBwrHeight) {
			if (document.goTop.top == limitBwrHeight) return;
			document.goTop.top = limitBwrHeight;
			return;
		}
		if (isNS6 && parseInt(document.getElementById('goTop').style.top) <= limitBwrHeight) {
			if (document.getElementById('goTop').style.top == limitBwrHeight) return;
			document.getElementById('goTop').style.top = limitBwrHeight;
			return;
		}
		if (isMSIE && goTop.style.pixelTop <= limitBwrHeight) {
			if (goTop.style.pixelTop == limitBwrHeight) return;
			goTop.style.pixelTop = limitBwrHeight;
			return;
		}
	}
}

/************************************************************************************************/
/* State Chage Top Button Function                                                              */
/************************************************************************************************/
function chgStateTop(sVal) {
	if (isNS4) document.goTop.style.display = sVal;
	if (isNS6) document.getElementById('goTop').style.display = sVal;
	if (isMSIE) goTop.style.display = sVal;
}

function topc() {
	getBrowser();
	initTopButton();
	setInterval("TopMovec()",timeInterVal);
}

document.write('\
<layer name="goTop">\
	<div id="goTop" class="div_goTop" name="goTop" onMouseOver="this.className=\'div_goTop_hover\'" onMouseOut="this.className=\'div_goTop\'" style="position:absolute;right:5px;top:'+limitBwrHeight+'">\
		<a title="Về đầu trang" class="goTop" href="#" onFocus="this.blur()"><img align="absmiddle" border="0" src="'+Url+'/images/top.gif"> Về đầu</a> &nbsp;\
		<a title="Thêm vào trang ưa thích" class="goTop" href="#addFavorites" onClick="window.external.AddFavorite(\'http://www.tin247.com\', \'Tin247.com - Cập nhật tin tức tự động liên tục\')"><img align="absmiddle" border="0" src="'+Url+'/images/add.gif"> Lưu vào Favorites</a> &nbsp;\
		<a title="Đặt làm trang chủ" class="goTop" href="#setHomePage" onClick="this.style.behavior=\'url(#default#homepage)\';this.setHomePage(\'http://www.tin247.com\');"><img align="absmiddle" border="0" src="'+Url+'/images/home.gif"> Đặt làm trang chủ </a>\
	</div>\
</layer>');