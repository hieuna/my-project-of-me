<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';

//Define page
$domain 	= 'http://dantri.com.vn/';

$aLink = array(
	//Doanh nhan Viet
	array('sectionid' => 11, 'catid' =>66 , 'link'=> 'http://dantri.com.vn/c76s82/doanhnghiep/trang-1.htm', 'url' => $domain), //Doanh nghiệp
	//Thông tin kinh tế
	array('sectionid' => 10, 'catid' =>15 , 'link'=> 'http://dantri.com.vn/c76s235/taichinh/trang-1.htm', 'url' => $domain), //Tài chính - Đầu tư
	array('sectionid' => 10, 'catid' =>77 , 'link'=> 'http://dantri.com.vn/c76s83/thitruong/trang-1.htm', 'url' => $domain), //Thị trường
	array('sectionid' => 10, 'catid' =>70 , 'link'=> 'http://dantri.com.vn/c76s767/nhadat/trang-1.htm', 'url' => $domain) //Nhà đất
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);

	$articles = array();
	foreach ($html->find('.mt3') as $index => $items) {	
		//Lấy ảnh đại diện
		$articles[$index]['image'] = $items->children(0)->children(0)->src;
		
		// Nội dung
		foreach ($items->find('div.mr1') as $item) {
			// Tiêu đề bài viết
			$articles[$index]['title'] = $item->children(0)->innertext;
			
			// Xem chi tiết bài viết
			$detail = $item->children(0)->href;
			$html_detail = file_get_html($array['url'] . $detail);
			
			// Mô tả bài viết
			$descriptions = $html_detail->find('div.fon33');
			foreach ($descriptions as $description) {
				$articles[$index]['description'] = $description->innertext;
			}
			$articles[$index]['description'] = str_replace("(Dân trí)", "<b>(Tapchidoanhnhanviet.vn)</b>", $articles[$index]['description']);
			
			// Nội dung bài viết
			$contents = $html_detail->find('div.fon34');
			foreach ($contents as $content) {
				$articles[$index]['content'] = $content->innertext.'<p style="text-align: right;" align="right"><b>(Theo Dantri.com)</b></p>';
			}
			$articles[$index][url] = '';
		}
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
		$fulltext 	= str_replace("'","\'", _cleanContent($content));
		$fulltext 	= str_replace(' src=','" src="', $fulltext);
		
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
				//Lấy đuôi ảnh và copy ảnh ra thư mục
				$info_image = pathinfo($article['image']);
				$extension = $info_image['extension'];
				$image_convert = $slug."-".time().".".$extension;
				copy($url.$article['image'],"../images/stories/".$image_convert);
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

mysql_close();
?>