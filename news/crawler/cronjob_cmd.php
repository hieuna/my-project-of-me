<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lấy tin tự động</title>
</head>
<body>
<?php
include '../class/config.php';

//ini_set("memory_limit","256M");
include_once '../class/simple_html_dom.php';
include_once '../class/function.php';

//Define page
$dantri 	= 'http://dantri.com.vn/';
$vnexpress	= 'http://vnexpress.net/';
$ngoisao	= 'http://ngoisao.net/';

$aLink = array(
	//NGOISAO.NET
	//Văn hóa
	array('sectionid' => 4, 'catid' =>29 , 'link'=> 'http://ngoisao.net/tin-tuc/showbiz-viet/', 'url' => $ngoisao), //Show biz
	//DANTRI.COM
	//Xã hội
	array('sectionid' => 1, 'catid' =>1 , 'link'=> 'http://dantri.com.vn/c20s134/phongsu/trang-1.htm', 'url' => $dantri), //Phóng sự - Ký sự
	array('sectionid' => 1, 'catid' =>2 , 'link'=> 'http://dantri.com.vn/c20s255/moitruong/trang-1.htm', 'url' => $dantri), //Môi trường
	array('sectionid' => 1, 'catid' =>84 , 'link'=> 'http://dantri.com.vn/c20s696/chinhtri/trang-1.htm', 'url' => $dantri), //Chính trị
	//Văn hóa
	array('sectionid' => 4, 'catid' =>28 , 'link'=> 'http://dantri.com.vn/c23s730/vanhoa/trang-1.htm', 'url' => $dantri), //Góc nhìn văn hóa
	//Thể thao
	array('sectionid' => 7, 'catid' =>37 , 'link'=> 'http://dantri.com.vn/c26s400/bongtrongnuoc/trang-1.htm', 'url' => $dantri), //Bóng đá trong nước
	array('sectionid' => 7, 'catid' =>38 , 'link'=> 'http://dantri.com.vn/c26s404/bongquocte/trang-1.htm', 'url' => $dantri), //Bóng đá quốc tế
	array('sectionid' => 7, 'catid' =>39 , 'link'=> 'http://dantri.com.vn/c26s405/cupchauau/trang-1.htm', 'url' => $dantri), //Cup Châu Âu
	array('sectionid' => 7, 'catid' =>40 , 'link'=> 'http://dantri.com.vn/c26s406/bongdaanh/trang-1.htm', 'url' => $dantri), //Bóng đá Anh
	array('sectionid' => 7, 'catid' =>42 , 'link'=> 'http://dantri.com.vn/c26s407/bongdaitalia/trang-1.htm', 'url' => $dantri), //Bóng đá Ý
	array('sectionid' => 7, 'catid' =>41 , 'link'=> 'http://dantri.com.vn/c26s408/bongdataybannha/trang-1.htm', 'url' => $dantri), //Bóng đá TBN
	array('sectionid' => 7, 'catid' =>43 , 'link'=> 'http://dantri.com.vn/c26s410/tennisduaxe/trang-1.htm', 'url' => $dantri), //Tennis-Đua xe
	array('sectionid' => 7, 'catid' =>44 , 'link'=> 'http://dantri.com.vn/c26s411/cacmonkhac/trang-1.htm', 'url' => $dantri), //Cac môn khác
	//Thế giới
	array('sectionid' => 9, 'catid' =>19 , 'link'=> 'http://dantri.com.vn/c36s172/tgdiemnong/trang-1.htm', 'url' => $dantri), //Thế giới 24h
	//Giáo dục
	array('sectionid' => 2, 'catid' =>5 , 'link'=> 'http://dantri.com.vn/c25s201/tuyensinh/trang-1.htm', 'url' => $dantri), //Tuyển sinh
	array('sectionid' => 2, 'catid' =>6 , 'link'=> 'http://dantri.com.vn/c25s181/guongsang/trang-1.htm', 'url' => $dantri), //Điểm sáng giao dục Việt
	array('sectionid' => 2, 'catid' =>8 , 'link'=> 'http://dantri.com.vn/c25s146/duhoc/trang-1.htm', 'url' => $dantri), //Du hoc
	//Sức khỏe
	array('sectionid' => 5, 'catid' =>32 , 'link'=> 'http://dantri.com.vn/c7/suckhoe.htm', 'url' => $dantri) //Tin tức sức khỏe
	
);

foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);
	//DAN TRI
	if ($array['url'] == $dantri){
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
				
				//$html_detail = new simple_html_dom();
				//$html_detail->load_file($dantri . $detail);
				$html_detail = file_get_html($array['url'] . $detail);
				
				// Mô tả bài viết
				$descriptions = $html_detail->find('div.fon33');
				foreach ($descriptions as $description) {
					$articles[$index]['description'] = $description->innertext;
				}
				
				// Nội dung bài viết
				$contents = $html_detail->find('div.fon34');
				foreach ($contents as $content) {
					$articles[$index]['content'] = $content->innertext.'<p align="right"><b>(Theo Dantri.com)</b></p>';
				}
				$articles[$index][url] = '';
			}
		}
	}
	//NGOI SAO
	if ($array['url'] == $ngoisao){
		$articles = array();
		foreach ($html->find('ul.news li') as $index => $items) {
			//Lấy ảnh đại diện
			$articles[$index]['image'] = $items->children(0)->children(0)->src;
			
			// Nội dung
			foreach ($items->find('h3') as $item) {
				// Tiêu đề bài viết
				$articles[$index]['title'] = $item->children(0)->innertext;
				
				// Xem chi tiết bài viết
				$detail = $item->children(0)->href;
				
				//$html_detail = new simple_html_dom();
				//$html_detail->load_file($dantri . $detail);
				$html_detail = file_get_html($array['url'] . $detail);
				
				// Mô tả bài viết
				$descriptions = $html_detail->find('h2.Lead');
				foreach ($descriptions as $description) {
					$articles[$index]['description'] = $description->innertext;
				}
				
				// Nội dung bài viết
				$contents = $html_detail->find('div.detailCT');
				foreach ($contents as $content) {
					$articles[$index]['content'] = $content->innertext;
				}
				$i = strpos($articles[$index]['content'], "</p>");
				$j = strpos($articles[$index]['content'], "div class='detailNS'>");
				$articles[$index]['content'] = substr($articles[$index]['content'], $i, $j-$i);
				$articles[$index]['content'] = str_replace('src="', 'src="'.$array['url'], $articles[$index]['content']).'<p style="text-align: right;"><b>(Theo Ngoisao.net)</b></p>';
				$articles[$index]['url'] = $array['url'];
			}
		}
	}
	//var_dump($articles); die;
	
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
				$sql = "INSERT INTO jos_content(title, introtext, `fulltext`, images, created, state, alias, sectionid, catid) 
					VALUES('" . $title . "', '" . $introtext . "', '" . $fulltext . "', '" . $image_convert . "', '" . date('Y-m-d H:i:s') . "', 1, '$slug', ".$array['sectionid'].", ".$array['catid'].")";
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
	/*
	if (!empty($array_un)) {
		$count = 1;
		echo '<b>Các tin đã tồn tại không được thêm vào</b><br>';
		foreach ($array_un as $ar) {
			echo $count . ': ' . $ar['title'] . '<br>';
			$count++;
		}
		echo '------------------------------------------------<br>';
	}
	*/
	
	if (!empty($array_in)) {
		$count = 1;
		//echo '<b>Các tin đã đã được thêm</b><br>';
		foreach ($array_in as $ar) {
			//echo $count . ': ' . $ar['title'] . '<br>';
			$count++;
		}
		//echo '------------------------------------------------<br>';
		if (!$check) {
			echo 'Cập nhật thành công';
		} 
	}
}

mysql_close();
?>
</body>
</html>
