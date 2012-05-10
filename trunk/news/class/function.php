<?php
function _cleanContent($str)
{
	$filter = & JFilterInput::getInstance(array('a','input','select','font','span'), null, 1, 1);
	
	$str = $filter->clean($str);

	return $str;
}
function post_db_parse_html($t=""){
	if ( $t == "" ){
		return $t;
	}

	//-----------------------------------------
	// Remove <br>s 'cos we know they can't
	// be user inputted, 'cos they are still
	// &lt;br&gt; at this point :)
	//-----------------------------------------

	/*		if ( $this->pp_nl2br != 1 )
	{
	$t = str_replace( "<br>"    , "\n" , $t );
	$t = str_replace( "<br />"  , "\n" , $t );
	}*/

	$t = str_replace( "&#39;"   , "'", $t );
	$t = str_replace( "&#33;"   , "!", $t );
	$t = str_replace( "&#036;"  , "$", $t );
	$t = str_replace( "&#124;"  , "|", $t );
	$t = str_replace( "&amp;"   , "&", $t );
	$t = str_replace( "&gt;"    , ">", $t );
	$t = str_replace( "&lt;"    , "<", $t );
	$t = str_replace( "&quot;"  , '"', $t );

	//-----------------------------------------
	// Take a crack at parsing some of the nasties
	// NOTE: THIS IS NOT DESIGNED AS A FOOLPROOF METHOD
	// AND SHOULD NOT BE RELIED UPON!
	//-----------------------------------------

	$t = preg_replace( "/javascript/i" , "j&#097;v&#097;script", $t );
	$t = preg_replace( "/alert/i"      , "&#097;lert"          , $t );
	$t = preg_replace( "/about:/i"     , "&#097;bout:"         , $t );
	$t = preg_replace( "/onmouseover/i", "&#111;nmouseover"    , $t );
	$t = preg_replace( "/onmouseout/i", "&#111;nmouseout"    , $t );
	$t = preg_replace( "/onclick/i"    , "&#111;nclick"        , $t );
	$t = preg_replace( "/onload/i"     , "&#111;nload"         , $t );
	$t = preg_replace( "/onsubmit/i"   , "&#111;nsubmit"       , $t );
	//$t = preg_replace( "/object/i"   , "&#111;bject"       , $t );
	//$t = preg_replace( "/frame/i"   , "fr&#097;me"       , $t );
	$t = preg_replace( "/applet/i"   , "&#097;pplet"       , $t );
	$t = preg_replace( "/meta/i"   , "met&#097;"       , $t );
	//$t = preg_replace( "/embed/i"   , "met&#097;"       , $t );

	return $t;
}

function clean_value($val){
	$strip_space_chr = 1;
	$get_magic_quotes = @get_magic_quotes_gpc();

	if ($val == ""){
		return "";
	}

	//halm: them trim vao 22-3-2011
	$val = trim($val);
	$val = str_replace( "&#032;", " ", $val );

	if ( $strip_space_chr ){
		$val = str_replace( chr(0xCA), "", $val );  //Remove sneaky spaces
	}
	//$val = str_replace( "&"            , "&amp;"         , $val );
	$val = str_replace( "<!--"         , ""  , $val ); //&#60;&#33;--
	$val = str_replace( "-->"          , ""       , $val ); //--&#62;
	$val = preg_replace( "/<script/i"  , "&#60;script"   , $val );
	$val = str_replace( ">"            , "&gt;"          , $val );
	$val = str_replace( "<"            , "&lt;"          , $val );
	$val = str_replace( "\""           , "&quot;"        , $val );
	//$val = preg_replace( "/\n/"        , "<br />"        , $val ); // Convert literal newlines
	$val = preg_replace( "/\\\$/"      , "&#036;"        , $val );
	$val = preg_replace( "/\r/"        , ""              , $val ); // Remove literal carriage returns
	$val = str_replace( "!"            , "&#33;"         , $val );
	$val = str_replace( "'"            , "&#39;"         , $val ); // IMPORTANT: It helps to increase sql query safety.

	if ( $get_magic_quotes ){
		$val = stripslashes($val);
	}

	$val = preg_replace( "/\\\(?!&amp;#|\?#)/", "&#092;", $val );

	return $val;
}

function cleanString($string) {  
	$detagged = strip_tags($string);  
	if(get_magic_quotes_gpc()) {  
		$stripped = stripslashes($detagged);  
		$escaped = mysql_real_escape_string($stripped);  
	} else {  
		$escaped = mysql_real_escape_string($detagged);  
	}  
	return $escaped;  
}  

function replaceString($str) {
	$str = preg_replace('/\<a[\s\S]+?\<\/a\>/', '', $str);
	$str = str_replace( "<br />"  , "" , $str );
	$str = str_replace( "<br>"  , "" , $str );
	$str = preg_replace('/\<img[\s\S]+?\/>/', '' , $str);
	return $str;
}

function RemoveSign($str)
{
	$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ"
				,"ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ","ì","í","ị","ỉ","ĩ",
				"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
				,"ờ","ớ","ợ","ở","ỡ",
				"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
				"ỳ","ý","ỵ","ỷ","ỹ",
				"đ",
				"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
				,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
				"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
				"Ì","Í","Ị","Ỉ","Ĩ",
				"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
				,"Ờ","Ớ","Ợ","Ở","Ỡ",
				"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
				"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
				"Đ","ê","ù","à");
	$khongDau=array("a","a","a","a","a","a","a","a","a","a","a"
				,"a","a","a","a","a","a",
				"e","e","e","e","e","e","e","e","e","e","e",
				"i","i","i","i","i",
				"o","o","o","o","o","o","o","o","o","o","o","o"
				,"o","o","o","o","o",
				"u","u","u","u","u","u","u","u","u","u","u",
				"y","y","y","y","y",
				"d",
				"A","A","A","A","A","A","A","A","A","A","A","A"
				,"A","A","A","A","A",
				"E","E","E","E","E","E","E","E","E","E","E",
				"I","I","I","I","I",
				"O","O","O","O","O","O","O","O","O","O","O","O"
				,"O","O","O","O","O",
				"U","U","U","U","U","U","U","U","U","U","U",
				"Y","Y","Y","Y","Y",
				"D","e","u","a");
	return str_replace($coDau,$khongDau,$str);
}

function generateSlug($phrase, $maxLength)
{
	$result = strtolower($phrase);
	
	$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
	$result = trim(preg_replace("/[\s-]+/", " ", $result));
	$result = trim(substr($result, 0, $maxLength));
	$result = preg_replace("/\s/", "-", $result);
	
	return $result;
}

?>