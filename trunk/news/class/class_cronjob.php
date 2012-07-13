<?php
include_once 'simple_html_dom.php';
class Cronjob{
	//Page 24h.com.vn
	function getPage24h($html, $url){
		$inputTags='.boxDonItem'; 
		$source='24h.com.vn';
		$articles = array();
		foreach ($html->find($inputTags) as $index => $items) {
			// Xem chi tiết bài viết
			$detail = $items->children(1)->children(0)->children(0)->href;
			if ($detail == NULL) break;
			$html_detail = file_get_html($url . $detail);
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
			$articles[$index]['content'] = substr($articles[$index]['content'], $i).'<p style="text-align: right;" align="right"><b>(Nguồn từ '.$source.')</b></p>';
			$articles[$index]['content'] = str_replace('<a href="http://www1.24h.com.vn/download/install_flash_player.exe">Nếu không xem được video vui lòng bấm vào đây để tải và cài flash player</a>', '', $articles[$index]['content']);
			$articles[$index]['url'] = $array['url'];
		}
		//var_dump($articles); die;
		return $articles;
	}
}