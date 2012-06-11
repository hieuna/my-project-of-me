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
$domain	= 'http://doanhnhansaigon.vn';

$aLink = array(
	//DOANHNHAN.NET
	//Doanh Nhân Việt
	array('sectionid' => 11, 'catid' =>78 , 'link'=> 'http://doanhnhansaigon.vn/online/su-kien-doanh-nghiep/dnsg-tieu-bieu/', 'url' => $domain), //Doanh nhân tiêu biểu
	array('sectionid' => 11, 'catid' =>87 , 'link'=> 'http://doanhnhansaigon.vn/online/su-kien-doanh-nghiep/nguoi-viet-hang-viet/', 'url' => $domain) //Dùng hàng Việt
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
		$articles[$index]['description'] 	= '(Tapchidoanhnhanviet.vn) - '.$items->children(2)->innertext;
		// Xem chi tiết bài viết
		$detail = $items->children(0)->href;
		$html_detail = file_get_html($array['url'] . $detail);
		$contents = $html_detail->find(".html");
		foreach ($contents as $content) {
			$articles[$index]['content'] = $content->innertext;
		}
		$articles[$index]['content'] = str_replace('src="', 'src="'.$array['url'], $articles[$index]['content']).'<p style="text-align: right;" align="right"><b>(Theo Doanhnhansaigon.vn)</b></p>';
		$articles[$index]['url'] = $array['url'];
		//echo $articles[$index]['content']; die;
	}
	//var_dump($articles); die;
	
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
