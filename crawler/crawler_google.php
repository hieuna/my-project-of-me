<?php
header('Content-type: text/html; charset=iso-8859-1');
set_time_limit(0);
$database_host = 'localhost';
$database_username = 'root';
$database_password = 'vertrigo';
$database_name = 'tintuc_20100419';
require_once('include/simple_html_dom.php');
include "include/class_database.php";
include "include/filterinput.php";
require_once('include/class_curl.php');

// INITIATE DATABASE CONNECTION
$db =& SEDatabase::getInstance();
// SET LANGUAGE CHARSET
$db->database_set_charset('utf8');

crawlGoogleKeyword();
//print_r(getGoogleKeywords('vầng trăng'));

function crawlGoogleKeyword(){
	global $db;
	
	$arrKeywords = getKeywords(10000);
	if (count($arrKeywords)<1) return false;
	
	foreach ($arrKeywords as $k){
		$googleKeywords = getGoogleKeywords($k['name']);
		if ($googleKeywords===false){
			print $k['name']." : Crawl false<br />";
			continue;
		}
		
		if (count($googleKeywords)>0 && is_array($googleKeywords)){
			foreach ($googleKeywords as $googleKeyword){
				$googleKeyword = str_replace("'","\'",$googleKeyword);
				
				$check = $db->database_query("SELECT id, weight, parents FROM gdn_tag_term WHERE name='".$googleKeyword."' LIMIT 1");
				
				// If avaiabled
				if ($db->database_num_rows($check)==1){
					$result = $db->database_fetch_assoc($check);
					$parents = ($result['parents'])?$result['parents'].$k['id'].":":":".$k['id'].":";
					
					$db->database_query("UPDATE gdn_tag_term SET weight=weight+50, created='".date("Y-m-d H:i:s")."', google=1, parents='".$parents."', publish=1 WHERE id=".$result['id']);
				}
				else {
					$db->database_query("INSERT INTO gdn_tag_term (name, weight, created, google, parents, publish) VALUES ('".$googleKeyword."', 50, '".date("Y-m-d H:i:s")."', 1, ':".$k['id'].":', 1)");
				}
			}
			print $k['name']." : ".count($googleKeywords)." keywords<br />";
		}
		else {
			print $k['name']." : no keyword<br />";
		}
		
		$db->database_query("UPDATE gdn_tag_term SET weight=weight+50, created='".date("Y-m-d H:i:s")."', google=1, google_craw=1, publish=1 WHERE id=".$k['id']);
		
	}
	return ;
}

function getKeywords($numKeyword=100)
{
	global $db;
	
	$sql = "SELECT id, name FROM gdn_tag_term WHERE google=0 AND google_craw=0 AND publish=1 ORDER BY weight DESC LIMIT 0, $numKeyword";
	$results = $db->database_query($sql);
	while ($row = $db->database_fetch_assoc($results)){
		$keywords[] = $row;
	}
	return $keywords;
}

function getGoogleKeywords($keyword)
{
	$urlBase = 'http://www.google.com.vn/search?hl=vi&source=hp&q='.urlencode($keyword).'&meta=&aq=f&aqi=g10&aql=&oq=&gs_rfai=&fp=2eab7327c92e6988';
	
	$arr1 = array(
		'\x3c' => '<',
		'\x3e' => '>',
		'\x3d' => '=',
		'\x22' => '"',
	);
	
	//$curl = new cURL($urlBase);
	//$content = $curl->get();
	
	$content = file_get_contents($urlBase);

	$html = str_get_html($content);
	
	$temp = $html->find('div[id=res]',0);
	// Nếu link bị die
	if (!is_object($html) || !is_object($temp) ){
		unset($content, $temp);
		$html->clear();
		return false;
	}
	
	$content = $html->find('div[class=e]',0);
	
	// Nếu link khong co keyword
	if (!is_object($content)) {
		$content = $html->find('div[id=brs]',0);
		if (!is_object($content)){
			return ;
		}
	}
	
	
	foreach ($content->find('a') as $a){
		$arrKeyWords[] = filter($a->plaintext);
	}
	unset($content, $temp);
	$html->clear();
	return $arrKeyWords;
}

function filter($str){
	$strlen = mb_strlen($str);
	$temp = array(225,224,7843,227,7841,259,7855,7857,7859,7861,7863,226,7845,7847,7849,7851,7853,233,232,7867,7869,7865,234,7871,7873,7875,7877,7879,237,236,7881,297,7883,243,242,7887,245,7885,244,7889,7891,7893,7895,7897,417,7899,7901,7903,7905,7907,250,249,7911,361,7909,432,7913,7915,7917,7919,7921,253,7923,7927,7929,7925,273,193,192,7842,195,7840,258,7854,7856,7858,7860,7862,194,7844,7846,7848,7850,7852,201,200,7866,7868,7864,202,7870,7872,7874,7876,7878,205,204,7880,296,7882,211,210,7886,213,7884,212,7888,7890,7892,7894,7896,416,7898,7900,7902,7904,7906,218,217,7910,360,7908,431,7912,7914,7916,7918,7920,221,7922,7926,7928,7924,272);
	for ($i=0; $i<$strlen; $i++){
		$thisChr = mb_substr($str, $i, 1);
		
		if (in_array(ord($thisChr), $temp, true)){
			$newstr .= '&#'.ord($thisChr).';';
		}
		else $newstr .= $thisChr;
	}
	return $newstr;
}
?>