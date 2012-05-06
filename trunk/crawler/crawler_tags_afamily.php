<?php
$database_host = 'localhost';
$database_username = 'root';
$database_password = 'vertrigo';
$database_name = 'tintuc_20100419';
set_time_limit(0);
require_once('include/simple_html_dom.php');
require_once('include/class_curl.php');
include "include/class_database.php";
include "include/class_autokeyword.php";

header('Content-type: text/html; charset=utf-8');

// INITIATE DATABASE CONNECTION
$db =& SEDatabase::getInstance();
// SET LANGUAGE CHARSET
$db->database_set_charset('utf8');

//$baseURL = 'http://www.baomoi.com/Source/Giadinhnet/20/p/';
$baseURL = 'http://www.baomoi.com/Source/Bao-Phu-Nu-Online/91/p/';
//$baseURL = 'http://www.baomoi.com/Source/aFamily/89/p/';
for ($i=2; $i<1000; $i++){
	$url = $baseURL.$i.".epi";
	
	// Create DOM from URL
	$html = file_get_html($url);
	$article = $html->find('div[class=Col1CateRaw]',0);
	
	// Nếu link bị die
	if (!is_object($article)) return false;
	
	foreach ($article->find('a[rel=tag]') as $element){
		insertTag($element->innertext);
	}
	$html->clear();
	print ('<div align="center">--------- Trang số '.$i.' ---------</div>');
}

function insertTag($tag){
	global $db;
	$tag = str_replace("'","\'", $tag);
	
	$results = $db->database_fetch_assoc( $db->database_query("SELECT id, weight FROM gdn_tag_term WHERE name='$tag' LIMIT 1") );
	if ($results['id']){
		$save = $db->database_query("UPDATE gdn_tag_term SET name='$tag', weight=weight+1, publish=1 WHERE id=".$results['id']);
		print $tag.": ".($save?"Update":"ERROR")."<br/>";
	}
	else {
		$save = $db->database_query("INSERT INTO gdn_tag_term (name, weight, created, publish) VALUES ('$tag', '1', '".date("Y-m-d H:i:s")."', '1')");
		print $tag.": ".($save?"INSERT":"ERROR")."<br/>";
	}
	return ;
}
?>