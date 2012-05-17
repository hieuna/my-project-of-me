<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lấy tin Tin thể thao Dantri tự động</title>
</head>
<body>
<?php
include '../class/config.php';
include '../class/simple_html_dom.php';
include '../class/function.php';

//Define page
$domain 	= 'http://dantri.com.vn/';

$aLink = array(
	//Thể thao
	array('sectionid' => 7, 'catid' =>40 , 'link'=> 'http://dantri.com.vn/c26s406/bongdaanh/trang-1.htm', 'url' => $domain), //Bóng đá Anh
	array('sectionid' => 7, 'catid' =>41 , 'link'=> 'http://dantri.com.vn/c26s408/bongdataybannha/trang-1.htm', 'url' => $domain), //Bóng đá TBN
	array('sectionid' => 7, 'catid' =>42 , 'link'=> 'http://dantri.com.vn/c26s407/bongdaitalia/trang-1.htm', 'url' => $domain), //Bóng đá Ý
	array('sectionid' => 7, 'catid' =>39 , 'link'=> 'http://dantri.com.vn/c26s405/cupchauau/trang-1.htm', 'url' => $domain), //Cup Châu Âu
	array('sectionid' => 7, 'catid' =>38 , 'link'=> 'http://dantri.com.vn/c26s404/bongquocte/trang-1.htm', 'url' => $domain), //Bóng đá quốc tế
	array('sectionid' => 7, 'catid' =>37 , 'link'=> 'http://dantri.com.vn/c26s400/bongtrongnuoc/trang-1.htm', 'url' => $domain), //Bóng đá trong nước
	array('sectionid' => 7, 'catid' =>43 , 'link'=> 'http://dantri.com.vn/c26s410/tennisduaxe/trang-1.htm', 'url' => $domain), //Tennis-Đua xe
	array('sectionid' => 7, 'catid' =>44 , 'link'=> 'http://dantri.com.vn/c26s411/cacmonkhac/trang-1.htm', 'url' => $domain) //Cac môn khác
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);
	//var_dump($html); die;
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
					VALUES('" . $title . "', '" . $introtext . "', '" . $fulltext . "', '" . $image_convert . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', 1, '$slug', ".$array['sectionid'].", ".$array['catid'].")";
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
