<?php
	function bb_encode($encodeStr="")
	{
		$returnStr = "";
		if(!empty($encodeStr)) {
			$enc = base64_encode($encodeStr);
			$enc = str_replace('=','',$enc);
			$enc = str_rot13($enc);
			$returnStr = $enc;
		}
		return $returnStr;
	}
	
	function bb_decode($encodedStr="",$type=0)
	{
	  $returnStr = "";
	  $encodedStr = str_replace(" ","+",$encodedStr);
		if(!empty($encodedStr)) {
			 $dec = str_rot13($encodedStr);
			 $dec = base64_decode($dec);
			$returnStr = $dec;
		}
	  return $returnStr;
	}
	
	//ham check link tu chuoi text khong co the html
	
	function bb_link($string){
		
		//domain redirect
		$domainredirect = "http://tin247.com/";
		
		//*	mã hóa những thẻ đã có để bắt các link
		$i=0;
		$patterns[$i] = "#\[url=([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#sie";
		$replacements[$i] = "'[url=" . $domainredirect . "'.bb_encode('\\1\\2').']'.bb_encode('\\3').'[/url]'";
		
		//*/
		$i++;// bắt url chỉ có wwww.domain.xxx có http ở đầu
		$patterns[$i] = "#(((http://){1}([(.www|)a-z0-9]+).(com.vn|com|net|vn|info))(?=[^\]]*\[))(?=[^>]*<)#sie";
		$replacements[$i] = "'[url=". $domainredirect . "'.bb_encode('\\1').']'.bb_encode('\\1').'[/url]'";
		
		//*
		$i++;// bắt url chỉ có wwww.domain.xxx không có http ở đầu
		$patterns[$i] = "#(((www.){1}([a-z0-9]+).(com.vn|com|net|vn|info))(?=[^\]]*\[))(?=[^>]*<)#sie";
		$replacements[$i] = "'[url=". $domainredirect . "'.bb_encode('http://\\1').']'.bb_encode('\\1').'[/url]'";
		
		//*
		$i++;
		$patterns[$i] = "#\[url=([a-z]+?://){1}([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+\(\)]+)\](.*?)\[/url\]#sie";
		$replacements[$i] = "'<a href=\"\\1\\2/'.removeChr(bb_decode('\\3')).'\">'.bb_decode('\\3').'</a>'";
		
		return preg_replace($patterns,$replacements,$string);
		
	}
	
	//ham loai bo ky tu dac biet
	function removeChr($string){
		$string 	=  preg_replace('/[^A-Za-z0-9.]+/', ' ', $string);
		$string	=	str_replace(" ","-",$string);
		$string	=	str_replace("--","-",$string);
		$string	=	str_replace("--","-",$string);
		$string	=	str_replace(chr(92),"",$string);
		return urlencode($string);
	}

	$domainrederect = "tin247.com/";
		
		//*/
		
$value="[url=http://vatgia.com]javascript:alert(432432432)[/url] <font  http://wwW.vaTgia.com> http://wwW.vaTgia.com</font> thử toan tiếp xem sao <fdsjflds www.vatgia.com >www.vatgia.info<fdslfld> www.vatgia.vn  www.vatgia.net www.vatgia.com.vn them http dau [url=javascript:///**/alert(3213213213213)]phpBB[/url]</font>";
echo bb_link($value);

?>