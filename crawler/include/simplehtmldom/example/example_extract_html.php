<?php
include_once('../simple_html_dom.php');
include_once('../url_class.php');
function getContentArticle($url){
	// Create DOM from URL
	$html = file_get_html($url);
	
	// Find all article blocks
	$article = $html->find('div.o_h_b_l_r_s_1_ce',0);
	foreach ($article->find('*[src], *[href]') as $uri){
		if ( $uri->hasAttribute('src') ) $uri->src = rel2abs($uri->src, $url);
		else $uri->href = rel2abs($uri->href, $url);
	}
	
	foreach ($article->find('img') as $img){
		$item['images'][] =  $img->src;
	}
    $item['title']     	= trim($article->find('span[id=ctl00_ContentPlaceHolder1_ctl00_lblNews_Title]', 0)->plaintext);
    $item['time']     	= trim($article->find('span[id=ctl00_ContentPlaceHolder1_ctl00_lblNewsDate]', 0)->plaintext);
    $item['intro']    	= trim($article->find('span[id=ctl00_ContentPlaceHolder1_ctl00_lblNews_InitCont]', 0)->plaintext);
    $item['details'] 	= trim($article->find('div[id=ctl00_ContentPlaceHolder1_ctl00_divNewsContent]',0)->innertext);
    
    $articles = $item;
	return $articles;
}

$html = file_get_html('http://afamily.channelvn.net/song-khoe/tu-thuoc-gia-dinh');
$articles= array();
// Find all article blocks
foreach($html->find('span.link_contain_tit') as $link) {
    $url     	= "http://afamily.channelvn.net".trim($link->find('a',0)->href);
    $articles[] = getContentArticle($url);
    //echo $article->innertext;
}
print_r($articles); 
?>