<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';

//Define page
$domain 	= 'http://www.tinmoi.vn/';

$aLink = array(
	//TINMOI.VN
	//Thế giới
	array('sectionid' => 10, 'catid' =>77 , 'link'=> 'http://www.tinmoi.vn/C/Thi-truong', 'url' => $domain), //Kinh tế thị trường
	array('sectionid' => 10, 'catid' =>170 , 'link'=> 'http://www.tinmoi.vn/C/Goc-chuyen-gia', 'url' => $domain) // Góc nhìn chuyên gia
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);

	$articles = array();
	$i = 0;
	foreach ($html->find('ul.list-post li') as $index => $items) {
		$i++;
		if ($i>1){
			// Tiêu đề bài viết
			$articles[$index]['title'] = $items->children(0)->children(0)->innertext;
			// Mô tả bài viết
			$articles[$index]['description'] = '<b>(Tapchidoanhnhanviet.vn)</b> - '.$items->children(1)->innertext;
			// Xem chi tiết bài viết
			$detail = $items->children(0)->children(0)->href;
			$html_detail = file_get_html($detail);
			// Hình ảnh bài viết
			$images = $html_detail->find("#tm-content img");
			$k = 0;
			foreach ($images as $image) {
				$k++;
				if ($k == 1){
					$articles[$index]['image'] = $image->src;
				}
			}
			// Chi tiết bài viết
			$contents = $html_detail->find("#tm-content");
			foreach ($contents as $content) {
				$articles[$index]['content'] = $content->innertext;
			}
			$j = strpos($articles[$index]['content'], "<center>");
			$articles[$index]['content'] = substr($articles[$index]['content'], 0, $j).'<p style="text-align: right;" align="right"><b>(Nguồn từ TINMOI.VN)</b></p>';
			$articles[$index]['url'] = $array['url'];
			
			$check = false;
			$array_in = array();
			$array_un = array();
			foreach ($articles as $index => $article) {
				$title = isset($article['title']) ? replaceString(_cleanContent($article['title'])) : null;
				$description = isset($article['description']) ? replaceString($article['description']) : '';
				$content = isset($article['content']) ? str_replace("'", "", $article['content']) : '';
				$url = isset($article['url']) ? $article['url'] : '';
				
				$introtext 	= str_replace("'","\'", _cleanContent(preg_replace('#<noscript(.*?)>(.*?)</noscript>#is', '', $description)));
				$fulltext	= str_replace("'","\'", _cleanContent($content));
				
				if (strlen($fulltext)>=1000){
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
}

mysql_close();
?>