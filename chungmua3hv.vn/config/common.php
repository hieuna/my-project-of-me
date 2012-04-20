<?php

/*	start define const */

define("SITE_URL", "http://{$_SERVER['SERVER_NAME']}/");

define("SITE_DIR", "/home/guidevn/public_html/chungmua3hv/");

define("DEFAULT_THEME", "default");

define("DEFAULT_LANG", "vn");

define("SEO_STRING_SEPARATE",'-');

define("URL_FRIENDLY", false);

define("SESSION_PREFIX", "vietsmarty_");

define("SESSION_DOMAIN", "vs_");

define("SITE_URL_EXT", ".html");

/*	end define const */



/* start define global variable	*/







if(URL_FRIENDLY==true)



{		



	rewriteUrl();



}







/*	end define global variable	*/











function loadModule($modul, $task= '', $other= array())	



{



	global $oDb;



	global $oSmarty;



	if($task=="")



		$task= $_GET['task'];







	



	$template_dir= $oSmarty->template_dir;



	if($_SESSION["theme"]=="" || !is_dir("themes/{$_SESSION["theme"]}/templates/$modul"))



	{



		 $oSmarty->template_dir= "themes/default/templates/$modul";



		$oSmarty->compile_dir= "templates_c/default";



	}



	else



	{



		$oSmarty->template_dir= "themes/{$_SESSION["theme"]}/templates/$modul";



		$oSmarty->compile_dir= "templates_c/{$_SESSION["theme"]}";



	}



	



	if(file_exists("modules/$modul/$modul.modul.php")) {



		$model= "base". ucfirst($modul);



		if(file_exists("models/{$model}.php")) {



			include_once("models/{$model}.php");



		}



		include_once("modules/$modul/$modul.modul.php");



		$mod = new $modul();



		$mod->run($task);



	}



}







/**



 * redirect to url



 *



 * $url is url want to



 * $time is time to url



 * @param string $url



 * @param datetime $time



 */



function redirect($url= "", $time=0)



{



	if($url=="")



		$url= SITE_URL;



	echo '<meta http-equiv="refresh" content="'.$time.';'.$url.'" />';



}







/* start functions for friendly_url */







/**



 * cusString



 *



 * @param String $string



 * @param String $separate



 * @desc spilit $string to 2 part



 * part1: from 0 to position of $separate



 * part2: from position of $separate to end of string



 */



function cutString ($string, $separate)



{



	if(strlen(trim($string))==0)



	{



		return false;



	} 



	elseif(strpos($string, $separate)===false)



	{



		return $string;



	}



	else 



	{



		$separateLen 	= strlen($separate);



		$separatePos	= strpos($string, $separate);



		



		if($separatePos === false || $separateLen ==0)



		{



			$part[0] = $string;



			$part[1] = '';



		}



		else 



		{



			$part[0] = substr($string, 0, $separatePos);



			$part[1] = substr($string, $separatePos + $separateLen);



		}



		return $part;



	}



	



}







/**



 * makeFriendlyUrl



 *



 * Name:     makeFriendlyUrl<br>



 * Purpose:  convert dynamic url to friendly url for SEO



 * @author   thanhnv



 * @param string dynamic_url



 * @return string friendly_url



 */



function makeUrlFriendly($string)



{



	$urlPart = cutString($string, '?');



	//php self



	$self = $urlPart[0];



	



	



	//query string



	$params = $urlPart[1];



	



	//remove html special chars



	$string = str_replace('&amp;','&',$params);



	



	//spilit params



	$pattern = '/&/';



	



    $split_array = preg_split($pattern,$string);



    



    $newUrl = $self;



    foreach ($split_array as $pItem)



    {



    	unset($aItem);



    	$aItem = cutString($pItem,'=');



    	



    	if(!is_array($aItem))



    	{



    		$newUrl .= '/'.$aItem;



    	}



    	else 



    	{



    		$newUrl .= '/'.implode(SEO_STRING_SEPARATE, $aItem);



			



    	}



    	



    }



	$newUrl.= SITE_URL_EXT;



	$newUrl= str_replace("?", '', $newUrl);



	



    return $newUrl;



}







/**



 * rewrite url



 */



function rewriteUrl()



{



	$self = $_SERVER['PHP_SELF'];



	



	$self= str_replace(SITE_URL_EXT, "", $self);



	



	$stringParams = substr($self,strpos($self,'.php')+5);



	



	$arrayParams = explode('/', $stringParams);



	foreach ($arrayParams as $param)



	{



		$aItem = cutString($param, SEO_STRING_SEPARATE);



		$_GET[$aItem[0]] = $aItem[1];



	}



	



}











function getGlobalVars(){



	return "global \$oDb, \$oSmarty, \$oDatagrid;";



}







function remove_marks($string)



{



 $trans = array ('é' => 'e', '‘' => '', '’' => '', '“' => '', '�?' => '', 'ẻ' => 'e', 'ẽ' => 'e', 'ằ' => 'a', 'ắ' => 'a', '�?' => 'o', 'ẽ' => 'e', '�?' => 'o', 'ẹ' => 'e', 'ặ' => 'a', '�?' => 'e', 'ặ' => 'a', 'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẫ' => 'a', 'ẩ' => 'a', 'ậ' => 'a', 'ú' => 'a', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'à' => 'a', 'á' => 'a', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ó' => 'o', 'ò' => 'o', '�?' => 'o', 'õ' => 'o', '�?' => 'o', 'ê' => 'e', 'ế' => 'e', '�?' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ơ' => 'o', 'ớ' => 'o', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', '�?' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'đ' => 'd', 'À' => 'A', '�?' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'À' => 'A', 'Ẫ' => 'A', 'Ẩ' => 'A', 'Ậ' => 'A', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ô' => 'O', '�?' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', '�?' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ư' => 'U', 'Ừ' => 'U', 'Ứ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', '�?' => 'D', '�?' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', 'a�?' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ă�?' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'â�?' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'u�?' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ư�?' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'i�?' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'o�?' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ô�?' => 'o', 'ồ' => 'ô', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ơ�?' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'đ' => 'd', '�?' => 'D', 'y�?' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'A�?' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Ă' => 'A', 'Ă�?' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Â' => 'A', 'Â�?' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A', 'E�?' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ê�?' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'U�?' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ư' => 'U', 'Ư�?' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'I�?' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'O�?' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ô�?' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ơ�?' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Y�?' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', ' ' => '-', '/'=>'');



	return strtr( trim($string), $trans );



}



/* end functions for friendly_url */



	



	/* truncate string with space character and limit character 



		@parameter:



			$data: string source.



			$limit_char: get limit character.



		@return : return string with number character greater or equal $limit_char



	*/



	function truncate( $data, $limit_char){



		if( strlen( $data) <= $limit_char) return $data;



		$max_word = 10;



		while ( substr( $data, $limit_char, 1 ) != ' ' && $max_word > 0 && $limit_char > 0) {



			$limit_char --;



			$max_word --;



		}



		



		if( $limit_char <= 0) return $data;



		else return substr( $data, 0, $limit_char);



	}



	



	/**



	 * Get value config on system



	 *



	 * @param string $var



	 * @return $val



	 */



	function getConfig($var)



	{



		 global $oDb;



		 $val =$oDb->getOne("select System_Value from tblsystem where System_Code='{$var}'");



		 return $val;



	}



	



	/**



	 * Setup  default language of system



	 *



	 * @param string $lang



	 */

	function loadCity(){

		

		$_SESSION["ppcity"]= $_GET["CID"];

		if(isset($_COOKIE["ppcity"]))

			$_COOKIE["ppcity"]=$_SESSION["ppcity"];

		else

			setcookie("ppcity", $_SESSION["ppcity"], time()+86400);

			

	

	}

	function getDefaultLang($lang){



		global $oDb;		



		if(!$lang )		



			$lang=$oDb->getRow("select * from lang where isdefault='1'");



		else 



			$lang=$oDb->getRow("select * from lang where name='".$lang."' or filename='".$lang.".conf"."'");



				



	 //	print_r($lang);



		$_SESSION["lang"]=  substr( $lang['filename'], 0, strlen($lang['filename']) - 5);



		$_SESSION["lang_id"] = $lang['id'];		



		$_SESSION["langname"] = $lang['name'];		



		$_SESSION["lang_file"]=  $lang['filename'];



		



	}



	function pre($str)



	{



		echo "<pre align=\"left\" >";



		print_r($str);



		echo "</pre>";



	}



	



	/**



	 * check Error 



	 *



	 * @param boolean $var



	 */



	function checkError($var){



			if($var){



				ini_set("display_errors", 1);



				error_reporting(E_ALL);



			}



	}







	function toSEOUrl($sText=''){



		$seoUrl = trim($sText);		



		$seoUrl = preg_replace('/\s+/', '_', $seoUrl); // Replace all white space



		$pattern = "/[^-a-z0-9A-Z\_,]/";



		$seoUrl = preg_replace( $pattern,"",$seoUrl );						



		return $seoUrl;



	}



	



	function updateSession(){



		global $oDb;



		$session = session_id();



		$sessionId = md5($session);



		$time = mktime();



		$ip = $_SERVER['REMOTE_ADDR'];



		$sTbl = "tbl_user_online";



		



			// check exist			



			$sQuery = "SELECT * FROM {$sTbl} WHERE session='{$sessionId}'";



			$aRow = $oDb->getRow($sQuery);



			



			if(is_array($aRow) && count($aRow)){



				// update time



				$sQuery = "UPDATE {$sTbl} SET time='{$time}', ip_address='{$ip}', number_view=number_view+1  WHERE session='{$sessionId}'";



			}else{



				$sQuery = "INSERT INTO {$sTbl}(session,time,ip_address,number_view) VALUES('{$sessionId}', '{$time}','{$ip}','1')";



			}



			$res = $oDb->query($sQuery);



			



			$_SESSION['userOnline'.$session] = $sessionId;			



		



	}







	



function removeMarks($string)



{



  $trans = array ('"'=>'','�'=>'o','"'=>'',' - '=>'-','!'=>'','.'=>'','&'=>'',','=>'',' & '=>'-','é' => 'e', "'" => "",  '"' => '', '"' => '', 'ẻ' => 'e', 'ẽ' => 'e', 'ằ' => 'a', 'ắ' => 'a', 'ọ' => 'o', 'ẽ' => 'e', 'ờ' => 'o', 'ẹ' => 'e', 'ặ' => 'a', 'ề' => 'e', 'ặ' => 'a', 'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẫ' => 'a', 'ẩ' => 'a', 'ậ' => 'a', 'ú' => 'a', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'à' => 'a', 'á' => 'a', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ê' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ơ' => 'o', 'ớ' => 'o', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'đ' => 'd', 'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'À' => 'A', 'Ẫ' => 'A', 'Ẩ' => 'A', 'Ậ' => 'A', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ư' => 'U', 'Ừ' => 'U', 'Ứ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Đ' => 'D', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', 'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'đ' => 'd', 'Đ' => 'D', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Ă' => 'A', 'Ắ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A', 'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ố' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y','?'=>'', ' ' => '-', '/'=>'');



	$string= strtr(trim($string), $trans);



   $string     =    trim(preg_replace('/[^\w\d_ -]/si', '', $string));//remove all illegal chars



   $string = preg_replace("/^[^a-z0-9]?(.*?)[^a-z0-9]?$/i", "$1", $string);



   // return strtr(trim($string), $trans);



   return strtolower($string);



}







	function checkMultiLang(){



		$multiLang = getConfig("multilanguage");



		if($multiLang=='Yes') $_SESSION['multilang'] = 1;



		else  $_SESSION['multilang'] = 0;



	}



 function highlightWords($string)



 {



        $words="VietSmarty";



		$link="http://www.vietsmarty.com";



		$title="Viet Smarty";



		$string = highlightFun($string,$words,$link,$title);



		$string = highlightFun($string,"SEO","http://www.vietsmarty.com/Seo-Optimizer/","Seo Optimizer");



		$string = highlightFun($string,"website","http://www.vietsmarty.com/Website-Design/","Website Design");



		$string = highlightFun($string,"thiết kế","http://www.vietsmarty.com/Website-Design/","Website Design");



		$string = highlightFun($string,"marketing","http://www.vietsmarty.com/Seo-Optimizer/","Seo Optimizer");



    return $string;



 }



 function highlightFun($string,$words,$link,$title)



 {



		$string = str_ireplace($words, '<a href="'.$link.'" title="'.$title.'"><span class="highlight_word">'.$words.'</span></a>', $string);



    /*** return the highlighted string ***/



    return $string;



 }



function decode($string){



	return base64_decode((base64_decode($string)));



}



function encode($string){



	return base64_encode(base64_encode($string));



}



function editor($name="", $content="", $att=array('width'=>'auto', 'height'=>'300px','skin'=>'kama'),$language='vi')

	{

		if(!$att["skin"])	

			$skin='kama';

		else

			$skin=$att["skin"];

		$content="<div id=\"editorHtml\"><textarea cols=\"200\" style=\"width:".$att['width']."; height:".$att['height']."\" id=\"$name\" name=\"$name\" rows=\"10\">$content</textarea>";

		$content.="	<script type=\"text/javascript\">

			//<![CDATA[



				// This call can be placed at any point after the

				// <textarea>, or inside a <head><script> in a

				// window.onload event handler.



				// Replace the <textarea id=\"editor\"> with an CKEditor

				// instance, using default configurations.

			CKEDITOR.replace( '$name',

    {

        filebrowserBrowseUrl : '".SITE_URL."lib/ckfinder/ckfinder.html',

        filebrowserImageBrowseUrl : '".SITE_URL."lib/ckfinder/ckfinder.html?Type=Images',

        filebrowserFlashBrowseUrl : '".SITE_URL."lib/ckfinder/ckfinder.html?Type=Flash',

        filebrowserUploadUrl : '".SITE_URL."lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

        filebrowserImageUploadUrl : '".SITE_URL."lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

        filebrowserFlashUploadUrl : '".SITE_URL."lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

    });

CKEDITOR.config.height='".$att["height"]."';

CKEDITOR.config.width='".$att["width"]."';

CKEDITOR.config.skin = '".$skin."';

CKEDITOR.config.language = '".$language."';

			//]]>

			</script></div>

";





		return $content;			

	}	

 function editorcontrol($name, $content="", $att=array('width'=>'800', 'height'=>'700'))

	{

			

		$str="<div id=\"editorHtml\"><script type=\"text/javascript\" src=\"".SITE_URL."lib/ckeditor/adapters/jquery.js\"></script>

<script type=\"text/javascript\">

	//<![CDATA[



$(function()

{

	var config = {

		toolbar:

		[

			['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],

			['UIColor'],['Image','Flash','Table','Smiley','PageBreak'],['Styles','Format','Font','FontSize'],



		]

	};



	// Initialize the editor.

	// Callback function can be passed and executed after full instance creation.

	$('.jquery_ckeditor').ckeditor(config);

});



	//]]>

	</script>

	

	<textarea class=\"jquery_ckeditor\" cols=\"80\"  id=\"{$name}\" name=\"{$name}\" rows=\"10\">{$content}</textarea></div>

";





		return $str;			

	}	

 function smalleditor($name, $content="", $att=array('width'=>'500', 'height'=>'200'))

	{

			

		$str="<textarea  cols=\"5\" style=\"width:{$att['width']}px; height:{$att['height']}px\" id=\"$name\" name=\"$name\" rows=\"5\">$content</textarea>

			<script type=\"text/javascript\">

		//<![CDATA[

			// Replace the <textarea id=\"editor1\"> with an CKEditor instance.

			var editor = CKEDITOR.replace( '$name',

				{

					// Defines a simpler toolbar to be used in this sample.

					// Note that we have added out \"MyButton\" button here.

		toolbar:

		[

			['Bold', 'Italic', 'Underline', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink'],

			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

			['TextColor','BGColor','Font','FontSize'],



		]

				});



			// Listen for the \"pluginsLoaded\" event, so we are sure that the

			// \"dialog\" plugin has been loaded and we are able to do our

			// customizations.

			editor.on( 'pluginsLoaded', function( ev )

				{

					// If our custom dialog has not been registered, do that now.

					if ( !CKEDITOR.dialog.exists( 'myDialog' ) )

					{

						// We need to do the following trick to find out the dialog

						// definition file URL path. In the real world, you would simply

						// point to an absolute path directly, like \"/mydir/mydialog.js\".

						var href = document.location.href.split( '/' );

						href.pop();

						href.push( 'api_dialog', 'my_dialog.js' );

						href = href.join( '/' );



						// Finally, register the dialog.

						CKEDITOR.dialog.add( 'myDialog', href );

					}



					// Register the command used to open the dialog.

					editor.addCommand( 'myDialogCmd', new CKEDITOR.dialogCommand( 'myDialog' ) );



					// Add the a custom toolbar buttons, which fires the above

					// command..

					editor.ui.addButton( 'MyButton',

						{

							label : 'My Dialog',

							command : 'myDialogCmd'

						} );

				});

		//]]>

	</script>

";





		return $str;			

	}	



function agoTime($time)

{

   $periods = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "thập kỷ");

   $lengths = array("60","60","24","7","4.35","12","10");



   $now = time();



       $difference     = $now - $time;

       $tense         = "trước";



   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

       $difference /= $lengths[$j];

   }



   $difference = round($difference);



   if($difference != 1) {

       $periods[$j].= "";

   }



   return "$difference $periods[$j] ";

}



	function randomPassword($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')

	{

		// Length of character list

		$chars_length = (strlen($chars) - 1);

	

		// Start our string

		$string = $chars{rand(0, $chars_length)};

	   

		// Generate random string

		for ($i = 1; $i < $length; $i = strlen($string))

		{

			// Grab a random character from our list

			$r = $chars{rand(0, $chars_length)};

		   

			// Make sure the same two characters don't appear next to each other

			if ($r != $string{$i - 1}) $string .=  $r;

		}

	   

		// Return the string

		return $string;

	}	

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

function selfURL($mod='')

{

	

			

			$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 

			

			return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 

			



}



/* vim: set expandtab: */



function checkLogin(){

	$_selfUrl = encode(selfURL());

	$__redirectUrl=encode(SITE_URL."dang-nhap.html?url=$_selfUrl");

	if(!$_SESSION["_user"]["ID"]){

		header("Location:".SITE_URL."thong-bao.html?url=$__redirectUrl&msg=". encode(" Bạn chưa đăng nhập. Xin vui lòng đăng nhập để thực hiện chức năng này."));

	}

}



?>