<?
function translate_text($variable){
	global $lang;
	if (isset($lang[$variable])){
		if($lang[$variable] !=''){
			return $lang[$variable];
		}else{
			return "";
		}
	}
	else{
		writeToTranslate($variable,"../0/translate.txt");
		return "-{" . $variable . "}-";
	}
}
function translate_display_text($variable){
	global $lang_display;
	if (isset($lang_display[$variable])){
		if($lang_display[$variable]==''){
			return "#" . $variable . "#";
		}else{
			return $lang_display[$variable];
		}
	}
	else{
		writeToTranslate($variable);
		return "-{" . $variable . "}-";
	}
}
function writeToTranslate($variable,$url="../administrator/0/translate_display.txt"){
	$content = @file_get_contents($url);
	$arrayTranslate = explode("\n",$content);
	$arrayTranslate = array_flip($arrayTranslate);
	$arrayCheck = array();
	$content = '';
	@arsort($arrayTranslate);
	foreach($arrayTranslate as $key=>$value){
		$arrayCheck[trim(str_replace("\n","",$key))]=0;
		$content .= trim(str_replace("\n","",$key)) . "\n";
	}
	//print_r($arrayCheck);
	if(!isset($arrayCheck[$variable])){
		$content = $content . $variable;
		@file_put_contents($url,$content);
	}
}
?>