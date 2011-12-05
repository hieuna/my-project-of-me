<?php
defined('PG_PAGE') or die();

// THIS FUNCTION CHANGES LOCATION HEADER TO REDIRECT FOR IIS PRIOR TO SETTING COOKIES
// INPUT: $url REPRESENTING THE URL TO REDIRECT TO
// OUTPUT: 

function cheader($url)
{
  	if( strpos(strtolower($_SERVER['SERVER_SOFTWARE']), 'microsoft') !== false )
  	{
    	header("Refresh: 0; URL=".$url);
  	}
  	else
  	{
    	header("Location: $url");
  	}
  	exit();
}

// END cheader() FUNCTION

// THIS FUNCTION RETURNS APPROPRIATE PAGE VARIABLES
// INPUT: $total_items REPRESENTING THE TOTAL NUMBER OF ITEMS
//	  $items_per_page REPRESENTING THE NUMBER OF ITEMS PER PAGE
//	  $p REPRESENTING THE CURRENT PAGE
// OUTPUT: AN ARRAY CONTAINING THE STARTING ITEM, THE PAGE, AND THE MAX PAGE

function make_page($total_items, $items_per_page, $p)
{
	if( !$items_per_page ) $items_per_page = 1;
  $maxpage = ceil($total_items / $items_per_page);
	if( $maxpage <= 0 ) $maxpage = 1;
  $p = ( ($p > $maxpage) ? $maxpage : ( ($p < 1) ? 1 : $p ) );
	$start = ($p - 1) * $items_per_page;
	return array($start, $p, $maxpage);
}

// END make_page() FUNCTION

// THIS FUNCTION RETURNS A RANDOM CODE OF DEFAULT LENGTH 8
// INPUT: $len (OPTIONAL) REPRESENTING THE LENGTH OF THE RANDOM STRING
// OUTPUT: A RANDOM ALPHANUMERIC STRING

function randomcode($len=8)
{
	$code = $lchar = NULL;
	for( $i=0; $i<$len; $i++ )
  	{
	  	$char = chr(rand(48,122));
	  	while( !ereg("[a-zA-Z0-9]", $char) )
    	{
		    if( $char == $lchar ) continue;
		    $char = chr(rand(48,90));
	  	}
	  	$pass .= $char;
	  	$lchar = $char;
	}
	return $pass;
}

// END randomcode() FUNCTION

// THIS FUNCTION CHECKS IF PROVIDED STRING IS AN EMAIL ADDRESS
// INPUT: $email REPRESENTING THE EMAIL ADDRESS TO CHECK
// OUTPUT: TRUE/FALSE DEPENDING ON WHETHER THE EMAIL ADDRESS IS VALIDLY CONSTRUCTED

function is_email_address($email)
{
	$regexp = "/^[a-z0-9]+([a-z0-9_\+\\.-]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
	return (bool) preg_match($regexp, $email);
}

// END is_email_address() FUNCTION

// THIS FUNCTION SETS STR_IREPLACE IF FUNCTION DOESN'T EXIST
// INPUT: $search REPRESENTING THE STRING TO SEARCH FOR
//	  $replace REPRESENTING THE STRING TO REPLACE IT WITH
//	  $subject REPRESENTING THE STRING WITHIN WHICH TO SEARCH
// OUTPUT: RETURNS A STRING IN WHICH ONE STRING HAS BEEN CASE-INSENSITIVELY REPLACED BY ANOTHER

if( !function_exists('str_ireplace') )
{
  function str_ireplace($search, $replace, $subject)
  {
    $search = preg_quote($search, "/");
    return preg_replace("/".$search."/i", $replace, $subject); 
  } 
}

// END str_ireplace() FUNCTION


// THIS FUNCTION SETS HTMLSPECIALCHARS_DECODE IF FUNCTION DOESN'T EXIST
// INPUT: $text REPRESENTING THE TEXT TO DECODE
//	  $ent_quotes (OPTIONAL) REPRESENTING WHETHER TO REPLACE DOUBLE QUOTES, ETC
// OUTPUT: A STRING WITH HTML CHARACTERS DECODED

if( !function_exists('htmlspecialchars_decode') )
{
  function htmlspecialchars_decode($text, $ent_quotes = ENT_COMPAT)
  {
    if( $ent_quotes === ENT_QUOTES   ) $text = str_replace("&quot;", "\"", $text);
    if( $ent_quotes !== ENT_NOQUOTES ) $text = str_replace("&#039;", "'", $text);
    $text = str_replace("&lt;", "<", $text);
    $text = str_replace("&gt;", ">", $text);
    $text = str_replace("&amp;", "&", $text);
    return $text;
  }
}

// END htmlspecialchars() FUNCTION

// THIS FUNCTION SETS STR_SPLIT IF FUNCTION DOESN'T EXIST
// INPUT: $string REPRESENTING THE STRING TO SPLIT
//	  $split_length (OPTIONAL) REPRESENTING WHERE TO CUT THE STRING
// OUTPUT: AN ARRAY OF STRINGS 
if( !function_exists('str_split') )
{
  function str_split($string, $split_length = 1)
  {
    $count = strlen($string);
    if($split_length < 1)
    {
      return false;
    }
    elseif($split_length > $count)
    {
      return array($string);
    }
    else
    {
      $num = (int)ceil($count/$split_length);
      $ret = array();
      for($i=0;$i<$num;$i++)
      {
        $ret[] = substr($string,$i*$split_length,$split_length);
      }
      return $ret;
    }
  }
}

// END str_split() FUNCTION


// THIS FUNCTION STRIPSLASHES AND ENCODES HTML ENTITIES FOR SECURITY PURPOSES
// INPUT: $value REPRESENTING A STRING OR ARRAY TO CLEAN
// OUTPUT: THE ARRAY OR STRING WITH HTML CHARACTERS ENCODED

function security($value)
{
	if( is_array($value) )
  	{
	  $value = array_map('security', $value);
	}
  	else
  	{
	  	if( !get_magic_quotes_gpc() )
    	{
	    	$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	  	}
    	else
    	{
	    	$value = htmlspecialchars(stripslashes($value), ENT_QUOTES, 'UTF-8');
	  	}
	  	$value = str_replace("\\", "\\\\", $value);
	}
	return $value;
}

// END security() FUNCTION

// THIS FUNCTION CENSORS WORDS FROM A STRING
// INPUT: $field_value REPRESENTING THE VALUE TO CENSOR
// OUTPUT: THE VALUE WITH BANNED WORDS CENSORED

function censor($field_value)
{
	global $setting;

	$censored_array = explode(",", trim($setting['setting_banned_words']));
	foreach($censored_array as $key => $value)
	{
		$trimvalue = trim($value);
		if (preg_match("/\b".$trimvalue."\b/i", $field_value)){
			$replace_value = str_pad("", strlen(trim($value)), "*");
			$field_value   = preg_replace("/\b".$trimvalue."\b/i", $replace_value, $field_value);
		}
	}

	return $field_value;
} 

// END censor() FUNCTION



// THIS FUNCTION RETURNS TIME IN SECONDS WITH MICROSECONDS
// INPUT:
// OUTPUT: RETURNS THE TIME IN SECONDS WITH MICROSECONDS

if( !function_exists('getmicrotime') )
{
  	function getmicrotime()
  	{
        list($usec, $sec) = explode(" ",microtime());
        return ((float)$usec + (float)$sec);
  	}
}

// END getmicrotime() FUNCTION


// THIS FUNCTION CLEANS HTML TAGS FROM TEXT
// INPUT: $text REPRESENTING THE STRING TO CLEAN
//	  $allowable_tags REPRESENTING THE ALLOWABLE HTML TAGS (AS A COMMA-DELIMITED STRING)
//	  $forbidden_attr (OPTIONAL) REPRESENTING AND ARRAY OF ANY ADDITIONAL FORBIDDEN ATTRIBUTES (SUCH AS A STYLE TAG)
// OUTPUT: THE CLEANED TEXT

function cleanHTML($text, $allowable_tags = null, $forbidden_attr = null)
{
  	// INCLUDE FILTER CLASS
  	if( !class_exists("InputFilter") )
  	{
    	require(PG_ROOT."/include/class_inputfilter.php");
  	}

  	// New method
  	if( !method_exists('InputFilter', 'safeSQL') )
  	{
    	return InputFilter::process($text, array(
      		'allowedTags' => $allowable_tags,
      		'forbiddenAttributes' => $forbidden_attr,
    	));
  	}
  
  	// Old method
  	else
  	{
	    // INSTANTIATE INPUT FILTER CLASS WITH APPROPRIATE TAGS
	    $xssFilter = new InputFilter(explode(",", str_replace(" ", "", $allowable_tags)), "", 0, 1, 1);
	
	    // ADD NECESSARY BLACKLIST ITEMS
	    for($i=0;$i<count($forbidden_attr);$i++)
	    {
	      	$xssFilter->attrBlacklist[] = $forbidden_attr[$i];
	    }
	
	    // RETURN PROCESSED TEXT
	    return $xssFilter->process($text);
  	}
}

// END cleanHTML() FUNCTION


// THIS FUNCTION TRIMS A GIVEN STRING PRESERVING HTML
// INPUT: $string REPRESENTING THE STRING TO SHORTEN
//	  $start REPRESENTING THE CHARACTER TO START WITH
//	  $length REPRESENTING THE LENGTH OF THE STRING TO RETURN
// OUTPUT: THE CLEANED TEXT

function chopHTML($string, $start, $length=false)
{
  $pattern = '/(\[\w+[^\]]*?\]|\[\/\w+\]|<\w+[^>]*?>|<\/\w+>)/i';
  $clean = preg_replace($pattern, chr(1), $string);

  if(!$length)
      $str = substr($clean, $start);
  else {
      $str = substr($clean, $start, $length);
      $str = substr($clean, $start, $length + substr_count($str, chr(1)));
  }
  $pattern = str_replace(chr(1),'(.*?)',preg_quote($str));
  if(preg_match('/'.$pattern.'/is', $string, $matched))
      return $matched[0];
  return $string;
}

// END chopHTML() FUNCTION

// THIS FUNCTION CHOPS A GIVEN STRING AND INSERTS A STRING AT THE END OF EACH CHOP
// INPUT: $string REPRESENTING THE STRING TO CHOP
//        $length REPRESENTING THE LENGTH OF EACH SEGMENT
//        $insert_char REPRESENTING THE STRING TO INSERT AT THE END OF EACH SEGMENT

function choptext($string, $length=32, $insert_char=' ')
{
  return preg_replace("!(?:^|\s)([\w\!\?\.]{" . $length . ",})(?:\s|$)!e",'chunk_split("\\1",' . $length . ',"' . $insert_char. '")',$string);
}

// END choptext() FUNCTION


// THIS FUNCTION CHOPS A GIVEN STRING AND INSERTS A STRING AT THE END OF EACH CHOP (PRESERVING HTML ENTITIES)
// INPUT: $html REPRESENTING THE STRING TO CHOP
//        $size REPRESENTING THE LENGTH OF EACH SEGMENT
//        $delim REPRESENTING THE STRING TO INSERT AT THE END OF EACH SEGMENT

function chunkHTML_split($html, $size, $delim)
{
  $pos=$unsafe=0;
  for($i=0;$i<strlen($html);$i++)
  {
    if($pos >= $size && !$unsafe)
    {
      $out .= $delim;
      $unsafe = 0;
      $pos = 0;
    }
    $c = substr($html,$i,1);
    if($c == "&")
      $unsafe = 1;
    elseif($c == ";")
      $unsafe = 0;
    $out .= $c;
    $pos++;
  }
  return $out;
}

// END chunkHTML_split


// THIS FUNCTION RETURNS THE LENGTH OF A STRING, ACCOUNTING FOR UTF8 CHARS
// INPUT: $str REPRESENTING THE STRING
// OUTPUT: THE LENGTH OF THE STRING

function strlen_utf8($str)
{
  $i = 0;
  $count = 0;
  $len = strlen($str);
  while($i < $len)
  {
    $chr = ord ($str[$i]);
    $count++;
    $i++;
    if($i >= $len)
      break;
    
    if($chr & 0x80)
    {
      $chr <<= 1;
      while ($chr & 0x80)
      {
        $i++;
        $chr <<= 1;
      }
    }
  }
  return $count;
}

// END strlen_utf8() FUNCTION


// THIS FUNCTION MAKES UTF8 CHARS WORK IN SERIALIZE BY BASICALLY IGNORING THE STRING LENGTH PARAM
// INPUT: $str REPRESENTING THE SERIALIZED STRING
// OUTPUT: THE UNSERIALIZED DATA

function mb_unserialize($serial_str)
{
  $out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
  return unserialize($out);
} 

// END mb_unserialize() FUNCTION


function get_simple_cookie_domain($host = null)
{
  // Quick config
  if( defined('PG_COOKIE_DOMAIN') )
  {
    return PG_COOKIE_DOMAIN;
  }
  
  if( !$host )
  {
    $host = $_SERVER["HTTP_HOST"];
  }
  
  $host = parse_url($host);
  $host = $host['path'];
  $parts = explode('.', $host);
  
  switch( TRUE )
  {
    // Do not use custom for these:
    // IP Address
    case ( preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $host) ):
    // Intranet host
    case ( count($parts) === 1 ):
      return null;
      break;
    
    // Second level ccld
    case ( strlen($parts[count($parts)-1]) == 2 && strlen($parts[count($parts)-2]) <= 3 ):
      array_splice($parts, 0, count($parts) - 3);
      return join('.', $parts);
      break;
    
    // tld or first-level ccld
    default:
      array_splice($parts, 0, count($parts) - 2);
      return join('.', $parts);
  }
  
  return null;
}
function check_ip_in_banned_list($ip, $list)
{
  // We were passed a string address
  if( !is_numeric($ip) )
  {
    $ip = ip2long($ip);
  }

  // Wth it's not an ip!
  if( !$ip )
  {
    trigger_error('That isn\'t an IP address!', E_USER_NOTICE);
    return false;
  }

  // Passed a , separated string
  if( !is_array($list) )
  {
    $list = explode(',', $list);
  }

  // No banned ips
  if( empty($list) )
  {
    return false;
  }

  // Sort into banned specific IPs and ranges
  $banned_ip_addr = array();
  $banned_ip_ranges = array();

  foreach( $list as $banned_ip )
  {
    if( strpos($banned_ip, '*') !== false )
    {
      // Decode
      $tmp_low = ip2long(str_replace('*', '0', $banned_ip));
      $tmp_high = ip2long(str_replace('*', '255', $banned_ip)); // this might not work for some bytes

      // If failed to decode, or low is larger than high, skip
      if( !$tmp_low || !$tmp_high || $tmp_low > $tmp_high )
      {
        continue;
      }
      
      // Add
      $banned_ip_ranges[] = array(
        $tmp_low,
        $tmp_high
      );
    }
    else if( strpos($banned_ip, '-') !== false )
    {
      // Decode
      list($tmp_low, $tmp_high) = explode('-', $banned_ip, 2);
      $tmp_low = ip2long($tmp_low);
      $tmp_high = ip2long($tmp_high);

      // If failed to decode, or low is larger than high, skip
      if( !$tmp_low || !$tmp_high || $tmp_low > $tmp_high )
      {
        continue;
      }

      // Add
      $banned_ip_ranges[] = array(
        $tmp_low,
        $tmp_high
      );
    }
    else
    {
      $tmp = ip2long($banned_ip);
      if( $tmp )
      {
        $banned_ip_addr[] = $tmp;
      }
    }
  }

  // Now check against ip lists
  if( in_array($ip, $banned_ip_addr) )
  {
    return true;
  }

  // Check against IP ranges
  foreach( $banned_ip_ranges as $range )
  {
    if( $ip >= $range[0] && $ip <= $range[1] )
    {
      return true;
    }
  }

  return false;
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
	$t = preg_replace( "/object/i"   , "&#111;bject"       , $t );
	$t = preg_replace( "/frame/i"   , "fr&#097;me"       , $t );
	$t = preg_replace( "/applet/i"   , "&#097;pplet"       , $t );
	$t = preg_replace( "/meta/i"   , "met&#097;"       , $t );
	$t = preg_replace( "/embed/i"   , "met&#097;"       , $t );

	return $t;
}

function get_debug_info($id)
{
  	$id = preg_replace('/[^a-zA-Z0-9\._]/', '', $id);
  
  	// Delete logs older than an hour
  	$dh = @opendir(PG_ROOT.DIRECTORY_SEPARATOR.'log');
  	if( $dh )
  	{
	    while( ($file = @readdir($dh)) !== false )
	    {
	      	if( $file == "." || $file == ".." ) continue;
	      	if( filemtime(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$file)>time()-3600 ) continue;
	      	@unlink(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$file);
	    }
  	}
  
  	return file_get_contents(PG_ROOT.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR.$id.'.html');
}

function isIE () {
	$msie='/msie/i';
	return isset($_SERVER['HTTP_USER_AGENT']) &&
		preg_match($msie,$_SERVER['HTTP_USER_AGENT']) &&
		!preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']);
}
	
function errorSet($errorTitle, $errorText, $order_session=''){
	setcookie('errorText', $errorText, time()+60, '/');

	$session_object =& PGSession::getInstance();
	$session_object->set('errorText', $errorText);
	$session_object->set('errorTitle', $errorTitle);
	if ($order_session) {
		$session_object->set('errorUrlReturn', makeReturnURL($order_session,'Thanh toán bị huỷ bỏ'));
	}
	return true;
}

function errorGet(){
	global $database;
	$errorID = PGRequest::getCmd('error', '', 'GET');
	$order_session = PGRequest::getCmd('session', '', 'GET');
	if (!$errorID) return array();
	
	$result = $database->db_fetch_assoc( $database->db_query("SELECT error_title, error_message FROM errors WHERE error_id='{$errorID}' AND error_show=1 LIMIT 1") );
	if (empty($result)){
		$error['errorText'] = 'Giao dịch thanh toán của bạn không thành công. Vui lòng liên hệ với Hỗ trợ viên để được giải đáp';
		$error['errorTitle'] = 'Thanh toán không thành công';
	}
	else {
		$error['errorText'] = $result['error_message'];
		$error['errorTitle'] = $result['error_title'];
	}
	if ($order_session){
		$error['errorText'] .= '<br />Nếu bạn cần trợ giúp, xin hãy gọi 04.36321221 - máy lẻ: 123 hoặc 851<br />Mời bạn thanh toán lại hoặc sử dụng <a href="payment_method.php?session='.$order_session.'">phương thức thanh toán khác</a>';
		$error['errorUrlReturn'] = makeReturnURL($order_session,'Thanh toán bị huỷ bỏ');
	}

	return $error;
}

function createToolbar(){
	global $page, $page_title;
	
	$numargs = func_num_args();
	if (!$numargs) return ;
	$arrButtons = array('export' => 'Xuất file excel', 'publish' => 'Hiển thị', 'unpublish' => 'Ẩn', 'delete'=>'Xóa', 'edit'=>'Sửa', 'new'=>'Tạo mới', 'save'=>'Lưu', 'apply' => 'Lưu & tiếp', 'cancel'=>'Bỏ', 'search'=>'Tìm kiếm', 'sms'=>'Gửi SMS', 'email'=>'Gửi email', 'send'=>'Gửi đi', 'refund'=>'Hoàn tiền');
	$out = '<div style="margin-bottom: 10px;"><div id="toolbar-box">
				<div class="t"><div class="t"><div class="t"></div></div></div>
				<div class="m">
					<div class="toolbar" id="toolbar">
					<table class="toolbar"><tbody><tr>';
	$arg_list = func_get_args();
	for ($i = 0; $i < $numargs; $i++) {
		$button = $arg_list[$i];
		if ($arrButtons[$button]){
			if ($button=='unpublish' || $button=='publish' || $button=='delete' || $button=='edit')
			$out .= '<td class="button" id="toolbar-'.$button.'">
						<a href="javascript:void(0)" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert(\'Xin hãy chọn ít nhất một mục để '.$arrButtons[$button].'\');}else{  submitbutton(\''.$button.'\')}" class="toolbar">
							<span class="icon-32-'.$button.'" title="'.$arrButtons[$button].'"></span> '.$arrButtons[$button].'
						</a>
					</td>';
			else 
			$out .= '<td class="button" id="toolbar-'.$button.'">
						<a href="javascript:void(0)" onclick="javascript:submitbutton(\''.$button.'\')" class="toolbar">
							<span class="icon-32-'.$button.'" title="'.$arrButtons[$button].'"></span> '.$arrButtons[$button].'
						</a>
					</td>';
		}
	}
	$out .=			'</tr></tbody></table>
					</div>
					<div class="header icon-48-addedit">'.$page_title.'</div>
					<div class="clr"></div>
				</div>
				<div class="b"><div class="b"><div class="b"></div></div></div>
			</div></div>';
	return $out;
}

function convertMobileNumber($mobinumber){
	$mobinumber = preg_replace('/[^0-9]/', '', $mobinumber);
	return $mobinumber;
	
	if (substr($mobinumber,0,1)==0) return "84".substr($mobinumber,1);
	elseif (substr($mobinumber,0,2)==84) return $mobinumber;
	else return '';
}

function getCity(){
	global $database;
	//Cache getCity
	$cacheTime = 2592000; // 30d
	$cacheKey = 'getCity';
	$output = CacheLib::get($cacheKey, $cacheTime);
	if ($output) return $output;
	
	$query = $database->db_query("SELECT city_id, city_name, city_shippable FROM city ORDER BY city_order ASC");
	while ($row = $database->db_fetch_assoc($query)){
		$output[$row['city_id']] = $row;
	}
	
	CacheLib::set($cacheKey, $output, $cacheTime);
	
	return $output;
}

function getDistrict(){
	global $database;
	//Cache getDistrict
	$cacheTime = 2592000; // 30d
	$cacheKey = 'getDistrict';
	$output = CacheLib::get($cacheKey, $cacheTime);
	if ($output) return $output;
	
	$query = $database->db_query("SELECT district_id, district_city_id, district_name, district_is_urban, district_shippable FROM districts ORDER BY district_name");
	while ($row = $database->db_fetch_assoc($query)){
		$output[ $row['district_id'] ] = $row;
	}
	
	CacheLib::set($cacheKey, $output, $cacheTime);
	
	return $output;
}

function getBank(){
	global $database;
	//Cache getCity
	$cacheTime = 2592000; // 30d
	$cacheKey = 'getBank';
	$output = CacheLib::get($cacheKey, $cacheTime);
	if ($output) return $output;
	
	$output = array();
	$query = $database->db_query("SELECT * FROM banks WHERE bank_publish=1 ORDER BY bank_order ASC, bank_name ASC");
	while ($row = $database->db_fetch_assoc($query)){
		$output[$row['bank_id']] = $row;
	}
	
	CacheLib::set($cacheKey, $output, $cacheTime);
	
	return $output;
}

function JsonErr($msg = '', $mixed = array()){
	$arr = array('err' => -1, 'msg' => $msg);
	if(!empty($mixed)){
		$arr = $arr + $mixed;
	}
	return json_encode($arr);
}
function JsonSuccess($msg, $mixed = array()){
	$arr = array('err' => 0, 'msg' => $msg);
	if(!empty($mixed)){
		$arr = $arr + $mixed;
	}
	return json_encode($arr);
}
function convertKhongdau($string)
{
	$trans = array(
	"đ"=>"d","ă"=>"a","â"=>"a","á"=>"a","à"=>"a","ả"=>"a","ã"=>"a","ạ"=>"a",
	"ấ"=>"a","ầ"=>"a","ẩ"=>"a","ẫ"=>"a","ậ"=>"a",
	"ắ"=>"a","ằ"=>"a","ẳ"=>"a","ẵ"=>"a","ặ"=>"a",
	"é"=>"e","è"=>"e","ẻ"=>"e","ẽ"=>"e","ẹ"=>"e",
	"ế"=>"e","ề"=>"e","ể"=>"e","ễ"=>"e","ệ"=>"e","ê"=>"e",
	"í"=>"i","ì"=>"i","ỉ"=>"i","ĩ"=>"i","ị"=>"i",
	"ú"=>"u","ù"=>"u","ủ"=>"u","ũ"=>"u","ụ"=>"u",
	"ứ"=>"u","ừ"=>"u","ử"=>"u","ữ"=>"u","ự"=>"u","ư"=>"u",
	"ó"=>"o","ò"=>"o","ỏ"=>"o","õ"=>"o","ọ"=>"o",
	"ớ"=>"o","ờ"=>"o","ở"=>"o","ỡ"=>"o","ợ"=>"o","ơ"=>"o",
	"ố"=>"o","ồ"=>"o","ổ"=>"o","ỗ"=>"o","ộ"=>"o","ô"=>"o",
	"ú"=>"u","ù"=>"u","ủ"=>"u","ũ"=>"u","ụ"=>"u",
	"ứ"=>"u","ừ"=>"u","ử"=>"u","ữ"=>"u","ự"=>"u","ư"=>"u",
	"ý"=>"y","ỳ"=>"y","ỷ"=>"y","ỹ"=>"y","ỵ"=>"y",
	"Đ"=>"D","Ă"=>"A","Â"=>"A","Á"=>"A","À"=>"A","Ả"=>"A","Ã"=>"A","Ạ"=>"A",
	"Ấ"=>"A","Ầ"=>"A","Ẩ"=>"A","Ẫ"=>"A","Ậ"=>"A",
	"Ắ"=>"A","Ằ"=>"A","Ẳ"=>"A","Ẵ"=>"A","Ặ"=>"A",
	"É"=>"E","È"=>"E","Ẻ"=>"E","Ẽ"=>"E","Ẹ"=>"E",
	"Ế"=>"E","Ề"=>"E","Ể"=>"E","Ễ"=>"E","Ệ"=>"E","Ê"=>"E",
	"Í"=>"I","Ì"=>"I","Ỉ"=>"I","Ĩ"=>"I","Ị"=>"I",
	"Ú"=>"U","Ù"=>"U","Ủ"=>"U","Ũ"=>"U","Ụ"=>"U",
	"Ứ"=>"U","Ừ"=>"U","Ử"=>"U","Ữ"=>"U","Ự"=>"U","Ư"=>"U",
	"Ó"=>"O","Ò"=>"O","Ỏ"=>"O","Õ"=>"O","Ọ"=>"O",
	"Ớ"=>"O","Ờ"=>"O","Ở"=>"O","Ỡ"=>"O","Ợ"=>"O","Ơ"=>"O",
	"Ố"=>"O","Ồ"=>"O","Ổ"=>"O","Ỗ"=>"O","Ộ"=>"O","Ô"=>"O",
	"Ú"=>"U","Ù"=>"U","Ủ"=>"U","Ũ"=>"U","Ụ"=>"U",
	"Ứ"=>"U","Ừ"=>"U","Ử"=>"U","Ữ"=>"U","Ự"=>"U","Ư"=>"U",
	"Ý"=>"Y","Ỳ"=>"Y","Ỷ"=>"Y","Ỹ"=>"Y","Ỵ"=>"Y");
	
	$string = strtr($string, $trans);
	return $string;
}
?>
