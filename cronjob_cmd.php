<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lấy tin tự động</title>
</head>
<body>
<?php

// Connection DB
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'ngockieuvan@vccorp.vn');
define('DB', 'database_projects');

ini_set("memory_limit","128M");
include_once 'class/simple_html_dom.php';
include_once 'class/filterinput.php';
include_once 'class/function.php';

$JFilter = new JFilterInput();

$dantri = 'http://dantri.com.vn/c26/thethao.htm';

$html = new simple_html_dom();
$html = file_get_html($dantri); 	
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
		$html_detail = file_get_html($dantri . $detail);		
		
		// Mô tả bài viết
		$descriptions = $html_detail->find('div.fon33');
		foreach ($descriptions as $description) {
			$articles[$index]['description'] = $description->innertext;
		}
		
		// Nội dung bài viết
		$contents = $html_detail->find('div.fon34');
		foreach ($contents as $content) {
			$articles[$index]['content'] = $content->innertext;
		}
	}
}



// Kết nối db
$link = @mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die('Unable to establish a DB connection');
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $link);
mysql_select_db(DB,$link);

$check = false;
$array_in = array();
$array_un = array();

//print_r($articles);
//die;
foreach ($articles as $index => $article) {
	$title = isset($article['title']) ? clean_value(replaceString($article['title'])) : null;
	$description = isset($article['description']) ? clean_value(replaceString($article['description'])) : '';
	$content = isset($article['content']) ? str_replace("'", "", $article['content']) : '';
	
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
			// Cập nhật bảng articles
			$sql = "INSERT INTO jos_content(title, introtext, `fulltext`, images, created, state, alias, sectionid, catid) 
				VALUES('" . $title . "', '" . $introtext . "', '" . $fulltext . "', '" . $article['image'] . "', '" . date('Y-m-d H:i:s') . "', 1, '$slug', 7, 38)";
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

if (!empty($array_un)) {
	$count = 1;
	echo '<b>Các tin đã tồn tại không được thêm vào</b><br>';
	foreach ($array_un as $ar) {
		echo $count . ': ' . $ar['title'] . '<br>';
		$count++;
	}
	echo '------------------------------------------------<br>';
}

if (!empty($array_in)) {
	$count = 1;
	echo '<b>Các tin đã đã được thêm</b><br>';
	foreach ($array_in as $ar) {
		echo $count . ': ' . $ar['title'] . '<br>';
		$count++;
	}
	echo '------------------------------------------------<br>';
	if (!$check) {
		echo 'Cập nhật thành công';
	} 
}

mysql_close();
?>
</body>
</html>
