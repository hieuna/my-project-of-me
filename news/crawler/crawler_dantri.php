<?php
include_once '../class/config.php';
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';

//Define page
$domain 	= 'http://dantri.com.vn/';

$aLink = array(
	//DANTRI.COM
	//Xã hội
	array('sectionid' => 1, 'catid' =>1 , 'link'=> 'http://dantri.com.vn/c20s134/phongsu/trang-1.htm', 'url' => $domain), //Phóng sự - Ký sự
	array('sectionid' => 1, 'catid' =>2 , 'link'=> 'http://dantri.com.vn/c20s255/moitruong/trang-1.htm', 'url' => $domain), //Môi trường
	array('sectionid' => 1, 'catid' =>84 , 'link'=> 'http://dantri.com.vn/c20s696/chinhtri/trang-1.htm', 'url' => $domain), //Chính trị
	//Văn hóa
	array('sectionid' => 4, 'catid' =>28 , 'link'=> 'http://dantri.com.vn/c23s730/vanhoa/trang-1.htm', 'url' => $domain), //Góc nhìn văn hóa
	//Thế giới
	array('sectionid' => 9, 'catid' =>19 , 'link'=> 'http://dantri.com.vn/c36s172/tgdiemnong/trang-1.htm', 'url' => $domain), //Thế giới 24h
	//Giáo dục
	array('sectionid' => 2, 'catid' =>5 , 'link'=> 'http://dantri.com.vn/c25s201/tuyensinh/trang-1.htm', 'url' => $domain), //Tuyển sinh
	array('sectionid' => 2, 'catid' =>6 , 'link'=> 'http://dantri.com.vn/c25s181/guongsang/trang-1.htm', 'url' => $domain), //Điểm sáng giao dục Việt
	array('sectionid' => 2, 'catid' =>8 , 'link'=> 'http://dantri.com.vn/c25s146/duhoc/trang-1.htm', 'url' => $domain), //Du hoc
	//Sức khỏe
	array('sectionid' => 5, 'catid' =>32 , 'link'=> 'http://dantri.com.vn/c7/suckhoe.htm', 'url' => $domain), //Tin tức sức khỏe
	array('sectionid' => 5, 'catid' =>34 , 'link'=> 'http://dantri.com.vn/c7s160/gioitinh/trang-1.htm', 'url' => $domain) //Sức khỏe giới tính
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
		$title = isset($article['title']) ? replaceString($article['title']) : null;
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