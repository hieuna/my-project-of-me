<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';
//Define page
$domain	= 'http://www.kinhte24h.com';

$aLink = array(
	//KinhTe24h.com
	//Thông tin kinh tế
	array('sectionid' => 10, 'catid' =>16 , 'link'=> 'http://www.kinhte24h.com/gl/35/', 'url' => $domain), //Chứng khoán
	array('sectionid' => 10, 'catid' =>70 , 'link'=> 'http://www.kinhte24h.com/gl/16/', 'url' => $domain), //Bất động sản
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);

	$articles = array();
	foreach ($html->find('.list_news_content') as $index => $items) {
		//Lấy ảnh đại diện
		$articles[$index]['image'] 			= $items->children(1)->first_child()->src;
		// Tiêu đề bài viết
		$articles[$index]['title'] 			= $items->children(0)->first_child()->innertext;
		// Mô tả bài viết
		$articles[$index]['description'] 	= '(Tapchidoanhnhanviet.vn) - '.$items->children(2)->innertext;
		// Xem chi tiết bài viết
		$detail = $items->children(0)->first_child()->href;
		if ($detail == NULL) break;
		$html_detail = file_get_html($array['url'] . $detail);
		$contents = $html_detail->find('div[style="text-align:justify; top:1px; border:1px"]');
		//var_dump($contents); die;
		foreach ($contents as $content) {
			$articles[$index]['content'] = $content->innertext;
		}
		$articles[$index]['content'] = $articles[$index]['content'].'<p style="text-align: right;" align="right"><b>(Theo kinhte24h.com)</b></p>';
		$articles[$index]['url'] = $array['url'];
	}
	$check = false;
	$array_in = array();
	$array_un = array();

	foreach ($articles as $index => $article) {
		$title = isset($article['title']) ? replaceString(_cleanContent($article['title'])) : null;
		$description = isset($article['description']) ? replaceString($article['description']) : '';
		$content = isset($article['content']) ? str_replace("'", "", $article['content']) : '';
		$url = isset($article['url']) ? $article['url'] : '';
		
		$introtext	= str_replace("'","\'", _cleanContent($description));
		$fulltext 	= str_replace("'","\'", _cleanContent(preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content)));
		
		// Tao slug từ tiêu đề
		$slug = RemoveSign($title);
		$slug = generateSlug($slug, strlen($slug));
		
		// Kiểm tra xem slug này có tồn tại trong articles không
		$sql = "SELECT COUNT(*) AS number FROM jos_content WHERE alias = '$slug'";
		$result = mysql_query($sql);
		$number = mysql_fetch_row($result);
		
		if ($number[0] > 0 || $title == NULL) break;
		else{
			if ($article['image'] != ""){
				//Lấy đuôi ảnh và copy ảnh ra thư mục
				$info_image = pathinfo($article['image']);
				$extension = $info_image['extension'];
				$image_convert = $slug."-".time().".".$extension;
				copy($article['image'],"../images/stories/".$image_convert);
				// Cập nhật bảng articles
				$sql = "INSERT INTO jos_content(title, introtext, `fulltext`, images, created, publish_up, state, alias, sectionid, catid) 
					VALUES('" . $title . "', '" . $introtext . "', '" . $fulltext . "', '" . $image_convert . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d') . "', 1, '$slug', ".$array['sectionid'].", ".$array['catid'].")";
				//die;
				$result_article = mysql_query($sql);
			}else{
				// Cập nhật bảng articles
				$sql = "INSERT INTO jos_content(title, introtext, `fulltext`, created, publish_up, state, alias, sectionid, catid) 
					VALUES('" . $title . "', '" . $introtext . "', '" . $fulltext . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d') . "', 1, '$slug', ".$array['sectionid'].", ".$array['catid'].")";
				//die;
				$result_article = mysql_query($sql);
			}
		}
	}
	
	if (!empty($array_in)) {
		$count = 1;
		foreach ($array_in as $ar) {
			$count++;
			echo $count . ': ' . $ar['title'] . '<br>';
		}
		if (!$check) {
			echo 'Cập nhật thành công';
		} 
	}
}

mysql_close();
?>