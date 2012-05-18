<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lấy tin DoanhNhanSaiGon.vn tự động</title>
</head>
<body>
<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';
//Define page
$domain	= 'http://doanhnhansaigon.vn/';

$aLink = array(
	//DOANHNHAN.NET
	//Doanh Nhân Việt
	array('sectionid' => 11, 'catid' =>47 , 'link'=> 'http://doanhnhansaigon.vn/online/doanh-nhan/chan-dung-doanh-nhan/', 'url' => $domain) //Chân dung doanh nhân
	
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);

	$articles = array();
	foreach ($html->find('.sum-item') as $index => $items) {
		//Lấy ảnh đại diện
		$articles[$index]['image'] 			= $items->children(0)->first_child()->src;
		// Tiêu đề bài viết
		$articles[$index]['title'] 			= $items->children(1)->innertext;
		// Mô tả bài viết
		$articles[$index]['description'] 	= $items->children(2)->innertext;
		// Xem chi tiết bài viết
		$detail = $items->children(0)->href;
		$html_detail = file_get_html($array['url'] . $detail);
		var_dump($html_detail); die;
		$descriptions = $html_detail->find(".html");
		var_dump($descriptions); die;
		
		// Nội dung
		foreach ($items->find('.sum-item') as $item) {
			// Tiêu đề bài viết
			echo $articles[$index]['title'] = $item->children(0)->innertext; die;
			
			// Xem chi tiết bài viết
			$detail = $item->children(0)->href;
			
			$html_detail = file_get_html($array['url'] . $detail);
			var_dump($html_detail); die;
			
			// Mô tả bài viết
			$descriptions = $html_detail->find('<strong>');
			foreach ($descriptions as $description) {
				$articles[$index]['description'] = '(Tapchidoanhnhanviet.vn) - '.$description->innertext;
			}
			
			// Nội dung bài viết
			$contents = $html_detail->find('div.detailCT');
			foreach ($contents as $content) {
				echo $articles[$index]['content'] = $content->innertext; die;
			}
			$i = strpos($articles[$index]['content'], "</p>");
			$j = strpos($articles[$index]['content'], "div class='detailNS'>");
			$articles[$index]['content'] = substr($articles[$index]['content'], $i, $j-$i);
			$articles[$index]['content'] = str_replace('src="', 'src="'.$array['url'], $articles[$index]['content']).'<p style="text-align: right;" align="right"><b>(Theo Ngoisao.net)</b></p>';
			$articles[$index]['url'] = $array['url'];
		}
	}
	
	$check = false;
	$array_in = array();
	$array_un = array();

	foreach ($articles as $index => $article) {
		$title = isset($article['title']) ? clean_value(replaceString($article['title'])) : null;
		$description = isset($article['description']) ? clean_value(replaceString($article['description'])) : '';
		$content = isset($article['content']) ? str_replace("'", "", $article['content']) : '';
		$url = isset($article['url']) ? $article['url'] : '';
		
		$introtext	= str_replace("'","\'", _cleanContent($description));
		$fulltext 	= str_replace("'","\'", _cleanContent($content));
		
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
</body>
</html>
