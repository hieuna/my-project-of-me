<?php
include ("header.php");

//Define page
$domain 	= 'http://hn.24h.com.vn/';
$source		= '24h.com.vn';

$aLink = array(
	//24H.COM.VN
	array('sectionid' => 13, 'catid' =>58 , 'link'=> 'http://hn.24h.com.vn/am-thuc-c460.html', 'url' => $domain), //Tin tức ẩm thực
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);
	$articles = $cronjob->getPage24h($html, $array['url']);
	insert_db_tapchi($articles, $array['sectionid'], $array['catid']);
}

mysql_close();
?>