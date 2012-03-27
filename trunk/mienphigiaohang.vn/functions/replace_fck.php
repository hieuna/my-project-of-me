<?
function replace_fck($str){
$myarr = array(
			'À'=>'&Agrave;',
			'Á'=>'&Aacute;',
			'Â'=>'&Acirc;',
			'Ã'=>'&Atilde;',
			'È'=>'&Egrave;',
			'É'=>'&Eacute;',
			'Ê'=>'&Ecirc;',
			'Ì'=>'&Igrave;',
			'Í'=>'&Iacute;',
			'Î'=>'&Icirc;',
			'Ï'=>'&Iuml;',
			'Ð'=>'&ETH;',
			'Ò'=>'&Ograve;',
			'Ó'=>'&Oacute;',
			'Ô'=>'&Ocirc;',
			'Õ'=>'&Otilde;',
			'Ù'=>'&Ugrave;',
			'Ú'=>'&Uacute;',
			'Ý'=>'&Yacute;',
			'à'=>'&agrave;',
			'á'=>'&aacute;',
			'â'=>'&acirc;',
			'ã'=>'&atilde;',
 			'è'=>'&egrave;',
			'é'=>'&eacute;',
			'ê'=>'&ecirc;',
 			'ì'=>'&igrave;',
			'í'=>'&iacute;',
 			'ò'=>'&ograve;',
			'ó'=>'&oacute;',
			'ô'=>'&ocirc;',
			'õ'=>'&otilde;',
 			'ù'=>'&ugrave;',
			'ú'=>'&uacute;',
			'û'=>'&ucirc;',
 			'ý'=>'&yacute;',
 	);
	foreach ($myarr as $key => $value){
		$str = str_replace($key,$value,$str);
	} 
	return $str;
}
//echo replace_fck("mục đích sử dụng");
?>
