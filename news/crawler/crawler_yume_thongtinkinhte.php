<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';

//Define page
$domain 	= 'http://yume.vn/';

$aLink = array(
	//YUME.VN
	//Thông tin kinh tế
	array('sectionid' => 10, 'catid' =>18 , 'link'=> 'http://yume.vn/news/thoi-su-kinh-te/tieu-dung', 'url' => $domain), // Tiêu dùng
	array('sectionid' => 10, 'catid' =>175 , 'link'=> 'http://yume.vn/news/thoi-su-kinh-te/mua-gi-hom-nay', 'url' => $domain) // Mua gì hôm nay
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);

	$articles = array();
	foreach ($html->find('.news-tweener') as $index => $items) {
		// Tiêu đề bài viết
		$articles[$index]['title'] = $items->children(1)->children(0)->innertext;
		// Ảnh mô tả bài viết
		$articles[$index]['image'] = $items->children(0)->children(0)->src;
		// Mô tả bài viết
		$articles[$index]['description'] = '<b>(Tapchidoanhnhanviet.vn)</b> - '.$items->children(2)->innertext;
		// Xem chi tiết bài viết
		$detail = $items->children(0)->href;
		$html_detail = file_get_html($detail);
		// Chi tiết bài viết
		$contents = $html_detail->find(".fck_details");
		foreach ($contents as $content) {
			$articles[$index]['content'] = $content->innertext;
		}
		$articles[$index]['content'] = $articles[$index]['content'].'<p style="text-align: right;" align="right"><b>(Nguồn từ Yume.vn)</b></p>';
		$articles[$index]['url'] = $array['url'];
		
		$check = false;
		$array_in = array();
		$array_un = array();
		foreach ($articles as $index => $article) {
			$title = isset($article['title']) ? replaceString(_cleanContent($article['title'])) : null;
			$description = isset($article['description']) ? replaceString($article['description']) : '';
			$content = isset($article['content']) ? str_replace("'", "", $article['content']) : '';
			$url = isset($article['url']) ? $article['url'] : '';
			
			$introtext 	= str_replace("'","\'", _cleanContent($description));
			$fulltext	= str_replace("'","\'", _cleanContent($content));
			
			if ($title != null) { 
				// Tao slug từ tiêu đề
				$slug = RemoveSign($title);
				$slug = generateSlug($slug, strlen($slug));
				
				// Kiểm tra xem slug này có tồn tại trong articles không
				$sql = "SELECT COUNT(*) AS number FROM jos_content WHERE alias = '$slug'";
				$result = mysql_query($sql);
				$number = mysql_fetch_row($result);
				
				// Nếu không tồn tại thêm mới vào
				if ($number[0] == 0) {
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
		
					$array_in[$index]['title'] = $title;
					
					if (!$result_article) {
						$check = true;
						echo 'Cập nhật không thành công';
						return;
					} 
				} else {
					$array_un[$index]['title'] = clean_value(replaceString($article['title']));
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
}
mysql_close();
?>