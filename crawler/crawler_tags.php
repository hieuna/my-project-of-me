<?php
$database_host = 'localhost';
$database_username = 'root';
$database_password = 'ngockv842006';
$database_name = 'db_tintuc';
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

//set the length of keywords you like
$params['min_word_length'] = 3;  //minimum length of single words
$params['min_word_occur'] = 3;  //minimum occur of single words

$params['min_2words_length'] = 2;  //minimum length of words for 2 word phrases
$params['min_2words_phrase_length'] = 6; //minimum length of 2 word phrases
$params['min_2words_phrase_occur'] = 3; //minimum occur of 2 words phrase

$params['min_3words_length'] = 2;  //minimum length of words for 3 word phrases
$params['min_3words_phrase_length'] = 9; //minimum length of 3 word phrases
$params['min_3words_phrase_occur'] = 3; //minimum occur of 3 words phrase

$params['min_4words_length'] = 2;  //minimum length of words for 4 word phrases
$params['min_4words_phrase_length'] = 12; //minimum length of 3 word phrases
$params['min_4words_phrase_occur'] = 3; //minimum occur of 3 words phrase

$params['min_5words_length'] = 2;  //minimum length of words for 4 word phrases
$params['min_5words_phrase_length'] = 15; //minimum length of 3 word phrases
$params['min_5words_phrase_occur'] = 3; //minimum occur of 3 words phrase

$params['min_5words_length'] = 2;  //minimum length of words for 4 word phrases
$params['min_5words_phrase_length'] = 17; //minimum length of 3 word phrases
$params['min_5words_phrase_occur'] = 3; //minimum occur of 3 words phrase
	
$toID = 19631;
$max = 1000;
for($i=$toID;$i>18718;$i--){
	auto_tags($i, $params);
}

function auto_tags($contentID, $params){
	global $db;
	$check = $db->database_query("SELECT NULL FROM gdn_tag_make WHERE cid=".$contentID." LIMIT 1");
	if ($db->database_num_rows($check)==1) return ;
	
	$sql = $db->database_query("SELECT id, title, introtext, `fulltext` FROM gdn_content WHERE id=$contentID");
	$content = $db->database_fetch_assoc($sql);

	$params['content'] = $content['title']." ".$content['introtext']." ".$content['fulltext']."";
	
	$keyword = new autokeyword($params, "UTF-8");
	$arrKeywords = ($keyword->get_keywords()) ;
	
	foreach ($arrKeywords as $kw => $kweight){
		$check = $db->database_query("SELECT id, weight, publish FROM gdn_tag_term WHERE name='".$kw."' LIMIT 1");
				
		// If avaiabled
		if ($db->database_num_rows($check)==1){
			$result = $db->database_fetch_assoc($check);
			$db->database_query("UPDATE gdn_tag_term SET weight=weight+{$kweight} WHERE id=".$result['id']);
			if ($result['publish']!=0) $db->database_query("INSERT INTO gdn_tag_term_content (tid, cid) VALUES ('{$result['id']}', '{$contentID}')");
		}
		else {
			$db->database_query("INSERT INTO gdn_tag_term (name, weight, created, publish) VALUES ('$kw', $kweight, '".date("Y-m-d H:i:s")."', -1)");
			$result['id'] = $db->database_insert_id();
		}
	}
	$db->database_query("INSERT INTO gdn_tag_make (cid) VALUES ({$contentID})");
	print "Content ID ".$contentID." : ".count($arrKeywords)." tags<br />";
	
	unset($arrKeywords, $content, $params['content']);
	return ;
}

function crawlTags($baseURL){
	$links = getLinks($baseURL);

	foreach ($links as $link){
		$numTags = getTags($link);
		//if ($numTags==0) break;
		print $link." : ".$numTags . " tags<br />";
	}
}

function getLinks($baseURL){
	$maxPage = 2000;
	$arrLink[] = $baseURL;
	for ($i=20;$i<=$maxPage;$i=$i+20){
		$arrLink[] = $baseURL."p/20/".$i."/";
	}
	return $arrLink;
}

function getTags($contentLink){
	global $db;
	
	$check = $db->database_query("SELECT NULL FROM tag_url WHERE url='".$contentLink."' LIMIT 1");
	if ($db->database_num_rows($check)==1) return 0;
	
	$curl = new cURL($contentLink);
	$content = $curl->get();

	$html = str_get_html($content);
	// Nếu link bị die
	if (!is_object($html)) return false;
	
	foreach ($html->find('p[class=tagscat]') as $boxtag){
		foreach ($boxtag->find('a') as $tag){
			$arrayTags[$tag->plaintext] = (isset($arrayTags[$tag->plaintext]))?$arrayTags[$tag->plaintext]+1:1;
		}
	}
	
	if (count($arrayTags)>0){
		foreach ($arrayTags as $tagName => $tagWeight){
			$check = $db->database_query("SELECT id, weight FROM tag_term WHERE name='".$tagName."' LIMIT 1");
			
			// If avaiabled
			if ($db->database_num_rows($check)==1){
				$result = $db->database_fetch_assoc($check);
				$db->database_query("UPDATE tag_term SET weight=weight+{$tagWeight} WHERE id=".$result['id']);
			}
			else {
				$db->database_query("INSERT INTO tag_term (name, weight) VALUES ('$tagName', $tagWeight)");
			}
		}
		
		$db->database_query("INSERT INTO tag_url (url) VALUES ('$contentLink')");
	}
	
	$totalTags = count($arrayTags);
	unset($content, $html, $arrayTags);
	
	return $totalTags;
}
?>