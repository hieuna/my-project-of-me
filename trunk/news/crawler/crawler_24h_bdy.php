<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';

//Define page
$domain 	= 'http://hn.24h.com.vn/';

$aLink = array(
	//24H.COM.VN
	//Thể thao
	array('sectionid' => 7, 'catid' =>42 , 'link'=> 'http://hn.24h.com.vn/bong-da-y-c150.html', 'url' => $domain) //Bóng đá Ý
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);

	$articles = array();
	foreach ($html->find('.boxDonItem') as $index => $items) {
		// Xem chi tiết bài viết
		$detail = $items->children(1)->children(0)->children(0)->href;
		if ($detail == NULL) break;
		$html_detail = file_get_html($array['url'] . $detail);
		//Lấy ảnh đại diện
		foreach ($html_detail->find(".baivietMainBox-img200") as $id => $image) {
			$articles[$index]['image'] = $image->children(0)->src;
		}
		// Tiêu đề bài viết
		$titles = $html_detail->find(".baiviet-title");
		foreach ($titles as $title) {
			$articles[$index]['title'] = $title->innertext;
		}
		// Mô tả bài viết
		$descriptions = $html_detail->find(".baiviet-head-noidung");
		foreach ($descriptions as $des) {
			$articles[$index]['description'] = $des->innertext;
		}
		$articles[$index]['description'] 	= '<b>(Tapchidoanhnhanviet.vn)</b> - '.$articles[$index]['description'];
		// Chi tiết bài viết
		$contents = $html_detail->find(".text-conent");
		foreach ($contents as $content) {
			$articles[$index]['content'] = $content->innertext;
		}
		$i = strpos($articles[$index]['content'], "</p>");
		$articles[$index]['content'] = substr($articles[$index]['content'], $i).'<p style="text-align: right;" align="right"><b>(Nguồn từ 24H.COM.VN)</b></p>';;
		$articles[$index]['content'] = str_replace('<a href="http://www1.24h.com.vn/download/install_flash_player.exe">Nếu không xem được video vui lòng bấm vào đây để tải và cài flash player</a>', '', $articles[$index]['content']);
		$articles[$index]['url'] = $array['url'];
		//var_dump($articles); die;
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
			if (strlen($fulltext)>=1000){
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
	
				$array_in[$index]['title'] = $title;
				
				if (!$result_article) {
					$check = true;
					echo 'Cập nhật không thành công';
					return;
				} 	
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