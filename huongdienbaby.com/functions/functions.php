<?
function randomkey($str,$keyword = 0){
	$return = '';
	$strreturn = explode(" ",trim($str));
	$i=0;
	$listid = '';
	while($i<count($strreturn)){
		$id = rand(0,count($strreturn));
		if(strpos($listid,'[' . $id . ']')===false){
			if(isset($strreturn[$id])){
				$return .= $strreturn[$id] . ' ';
				$i++;
				if($keyword == 1 && ($i%2)==0 && $i<count($strreturn))  $return .= ',';
				$listid .= '[' . $id . ']';
			}
		}
	}
	return $return;
}
function formatNumber($value){
	return number_format($value,0,"",".");
}
function random(){
	$rand_value = "";
	$rand_value.=rand(1000,9999);
	$rand_value.=chr(rand(65,90));
	$rand_value.=rand(1000,9999);
	$rand_value.=chr(rand(97,122));
	$rand_value.=rand(1000,9999);
	$rand_value.=chr(rand(97,122));
	$rand_value.=rand(1000,9999);
	return $rand_value;
}
function str_encode($encodeStr="")
{
	$returnStr = "";
	if($encodeStr == '') return $encodeStr;
	if(!empty($encodeStr)) {
		$enc = base64_encode($encodeStr);
		$enc = str_replace('=','',$enc);
		$enc = str_rot13($enc);
		$returnStr = $enc;
	}
	return $returnStr;
}

function str_decode($encodedStr="",$type=0)
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
function getURLR($mod_rewrite = 1,$serverName=0, $scriptName=0, $fileName=1, $queryString=1, $varDenied=''){
	if($mod_rewrite==1){
		return $_SERVER['REQUEST_URI'];
	}else{
		return getURL($serverName, $scriptName, $fileName, $queryString, $varDenied);
	}
}
//hàm get URL
function getURL($serverName=0, $scriptName=0, $fileName=1, $queryString=1, $varDenied=''){
	$url	 = '';
	$slash = '/';
	if($scriptName != 0)$slash	= "";
	if($serverName != 0){
		if(isset($_SERVER['SERVER_NAME'])){
			$url .= 'http://' . $_SERVER['SERVER_NAME'];
			if(isset($_SERVER['SERVER_PORT'])) $url .= ":" . $_SERVER['SERVER_PORT'];
			$url .= $slash;
		}
	}
	if($scriptName != 0){
		if(isset($_SERVER['SCRIPT_NAME']))	$url .= substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if($fileName	!= 0){
		if(isset($_SERVER['SCRIPT_NAME']))	$url .= substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/') + 1);
	}
	if($queryString!= 0){
		$dau = 0;
		$url .= '?';
		reset($_GET);
		if($varDenied != ''){
			$arrVarDenied = explode('|', $varDenied);
			while(list($k, $v) = each($_GET)){
				if(array_search($k, $arrVarDenied) === false){
					 $url .= (($dau==0) ? '' : '&') . $k . '=' . urlencode($v);
					 $dau  = 1;
				}
			}
		}
		else{
			while(list($k, $v) = each($_GET)) $url .= '&' . $k . '=' . urlencode($v);
		}
	}
	$url = str_replace('"', '&quot;', strval($url));
	return $url;
}
//hàm tạo link khi cần thiết chuyển sang mod rewrite
function createLink($type="detail",$url=array(),$path="",$con_extenstion='html',$rewrite = 1){
	$menuReturn = '';
	$keyReplace = '_';
	//neu ko de mod rewrite
	if($rewrite == 0){
		$menuReturn = $path . $type . ".php?";
		foreach($url as $key=>$value){
			if($key == "module") $value = strtolower($value);
			if($key != "title"){
				$menuReturn .= $key . "=" . $value . "&";	
			}
		}
		$menuReturn = substr($menuReturn,0, strrpos($menuReturn, "&"));
		//tra ve url ko rewrite
		return $menuReturn;
	}
	//tao luat cho mod rewrite
	switch($type){
		case "detail":
			$menuReturn = $path . removeTitle($url["title"],$keyReplace) . $keyReplace . strtolower($url["module"]) . $keyReplace . $url["iCat"] . $keyReplace . $url["iData"] . '.' . $con_extenstion;
		break;
		case "type":
				$menuReturn = $path .  removeTitle($url["title"],$keyReplace) . $keyReplace  . strtolower($url["module"]) . $keyReplace . $url["iCat"] . '.' . $con_extenstion;
				if(isset($url["iSup"])) $menuReturn = $path .  removeTitle($url["title"],$keyReplace) . $keyReplace  . strtolower($url["module"]) . $keyReplace . $url["iCat"] . $keyReplace . 'hsx_' . $url["iSup"] . '.' . $con_extenstion;
				if(isset($url["iPri"])) $menuReturn = $path .  removeTitle($url["title"],$keyReplace) . $keyReplace  . strtolower($url["module"]) . $keyReplace . $url["iCat"] . $keyReplace . 'gia_' . $url["iPri"] . '.' . $con_extenstion;
		break;
	}
	return $menuReturn;
}
//hàm getvalue : 1 tên biến; 2 kiểu; 3 phương thức; 4 giá trị mặc định; 5 remove quote
function getValue($value_name, $data_type = "int", $method = "GET", $default_value = 0, $advance = 0){
	$value = $default_value;
	switch($method){
		case "GET": if(isset($_GET[$value_name])) $value = $_GET[$value_name]; break;
		case "POST": if(isset($_POST[$value_name])) $value = $_POST[$value_name]; break;
		case "COOKIE": if(isset($_COOKIE[$value_name])) $value = $_COOKIE[$value_name]; break;
		case "SESSION": if(isset($_SESSION[$value_name])) $value = $_SESSION[$value_name]; break;
		default: if(isset($_GET[$value_name])) $value = $_GET[$value_name]; break;
	}
	$valueArray	= array("int" => intval($value), "str" => trim(strval($value)), "flo" => floatval($value), "dbl" => doubleval($value), "arr" => $value);
	foreach($valueArray as $key => $returnValue){
		if($data_type == $key){
			if($advance != 0){
				switch($advance){
					case 1:
						$returnValue = str_replace('"', '&quot;', $returnValue);
						$returnValue = str_replace("\'", "'", $returnValue);
						$returnValue = str_replace("'", "''", $returnValue);
						break;
					case 2:
						$returnValue = htmlspecialbo($returnValue);
						break;
				}
			}
			//Do số quá lớn nên phải kiểm tra trước khi trả về giá trị
			if((strval($returnValue) == "INF") && ($data_type != "str")) return 0;
			return $returnValue;
			break;
		}
	}
	return (intval($value));
}

//loại bỏ hoạt động của các thẻ html, vô hiệu hóa
function htmlspecialbo($str){
	$arrDenied	= array('<', '>', '"');
	$arrReplace	= array('&lt;', '&gt;', '&quot;');
	$str = str_replace($arrDenied, $arrReplace, $str);
	return $str;
}

// loại bỏ các thẻ html, javascript
function removeHTML($string){
	$string = preg_replace ('/<script.*?\>.*?<\/script>/si', ' ', $string); 
	$string = preg_replace ('/<style.*?\>.*?<\/style>/si', ' ', $string); 
	$string = preg_replace ('/<.*?\>/si', ' ', $string); 
	$string = str_replace ('&nbsp;', ' ', $string);
	$string = html_entity_decode ($string);
	return $string;
}

// hàm redirect : 1 url
function redirect($url, $http=0){
  $url = str_replace("'","\'",$url);
  echo '<script type="text/javascript">';
  echo 'window.location.href="'.$url.'";';
  echo '</script>';
  echo '<noscript>';
  echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
  echo '</noscript>'; exit;
  exit();
}

//hàm cắt chuổi
function cut_string($str,$length){
	if (mb_strlen($str,"UTF-8") > $length) return mb_substr($str,0,$length,"UTF-8") . "...";
	else return $str;
}

//
function replaceMQ($text){
	$text	= str_replace("\'", "'", $text);
	$text	= str_replace("'", "''", $text);
	return $text;
}
function RemoveSign($str)
{
	$coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
	"ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề" ,"ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
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
function removeTitle($string,$keyReplace){
	$string	=	preg_replace('|[\/ ;,"\'&= \--?]|i',"-",RemoveSign($string));
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace("--","-",$string);
	$string	=	str_replace($keyReplace,"-",$string);
	$string	=	str_replace(chr(92),"",$string);
	return urlencode($string);
}
function generate_sort($type, $sort, $current_sort, $image_path){
	if($type == "asc"){
		$title = "Tăng dần";
		if($sort != $current_sort) $image_sort = "sortasc.gif";
		else $image_sort = "sortasc_selected.gif";
	}
	else{
		$title = "Giảm dần";
		if($sort != $current_sort) $image_sort = "sortdesc.gif";
		else $image_sort = "sortdesc_selected.gif";
	}
	return '<a title="' . $title . '" href="' . getURL(0,0,1,1,"sort") . '&sort=' . $sort . '"><img border="0" vspace="2" src="' . $image_path . $image_sort . '" /></a>';
}
 function int_to_words($x)
 {
	 $nwords = array(    "không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy",
								 "tám", "chín", "mười", "mười một", "mười hai", "mười ba",
								 "mười bốn", "mười lăm", "mười sáu", "mười bảy", "mười tám",
								 "mười chín", "hai mươi", 30 => "ba mươi", 40 => "bốn mươi",
								 50 => "năm mươi", 60 => "sáu mươi", 70 => "bảy mươi", 80 => "tám mươi",
								 90 => "chín mươi" );
      if(!is_numeric($x))
      {
          $w = '#';
      }else if(fmod($x, 1) != 0)
      {
          $w = '#';
      }else{
          if($x < 0)
          {
              $w = 'minus ';
              $x = -$x;
          }else{
              $w = '';
          }
          if($x < 21)
          {
              $w .= $nwords[$x];
          }else if($x < 100)
          {
              $w .= $nwords[10 * floor($x/10)];
              $r = fmod($x, 10);
              if($r > 0)
              {
                  $w .= ' '. $nwords[$r];
              }
          } else if($x < 1000)
          {
              $w .= $nwords[floor($x/100)] .' trăm';
              $r = fmod($x, 100);
              if($r > 0)
              {
                  $w .= '  '. int_to_words($r);
              }
          } else if($x < 1000000)
          {
              $w .= int_to_words(floor($x/1000)) .' ngàn';
              $r = fmod($x, 1000);
              if($r > 0)
              {
                  $w .= ' ';
                  if($r < 100)
                  {
                      $w .= ' ';
                  }
                  $w .= int_to_words($r);
              }
          } else {
              $w .= int_to_words(floor($x/1000000)) .' triệu';
              $r = fmod($x, 1000000);
              if($r > 0)
              {
                  $w .= ' ';
                  if($r < 100)
                  {
                      $word .= ' ';
                  }
                  $w .= int_to_words($r);
              }
          }
      }
      return $w . '';
 }
function getArray($sql,$field_id = ''){
	$db_query = new db_query($sql);
	$arrayReturn = array();
	$i=0;
	while($row=mysql_fetch_assoc($db_query->result)){
		if($field_id!=''){
			$arrayReturn[$row[$field_id]] = $row;
		}else{
			$i++;
			$arrayReturn[$i] = $row;
			
		}
	}
	unset($db_query);
	return $arrayReturn;
}
?>