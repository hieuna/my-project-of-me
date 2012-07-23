<?php
include ("header.php");

//Define page
$domain 	= 'http://hn.24h.com.vn/';
$source		= '24h.com.vn';

$task		= $_GET['task'];

//24H.COM.VN
if ($task == 'amthuc'){
	$aLink = array(
		//Ẩm thực
		array('sectionid' => 13, 'catid' =>58 , 'link'=> 'http://hn.24h.com.vn/am-thuc-c460.html', 'url' => $domain), //Tin tức ẩm thực
		array('sectionid' => 13, 'catid' =>61 , 'link'=> 'http://hn.24h.com.vn/dac-san-3-mien-c465.html', 'url' => $domain) //Món ngon Việt
	);
}
if ($task == 'sport'){
	$aLink = array(
		//24H.COM.VN
		//Thể thao
		array('sectionid' => 7, 'catid' =>40 , 'link'=> 'http://hn.24h.com.vn/bong-da-ngoai-hang-anh-c149.html', 'url' => $domain), //Bóng đá Anh
		array('sectionid' => 7, 'catid' =>41 , 'link'=> 'http://hn.24h.com.vn/bong-da-tay-ban-nha-c151.html', 'url' => $domain), //Bóng đá TBN
		array('sectionid' => 7, 'catid' =>42 , 'link'=> 'http://hn.24h.com.vn/bong-da-y-c150.html', 'url' => $domain), //Bóng đá Ý
		array('sectionid' => 7, 'catid' =>60 , 'link'=> 'http://hn.24h.com.vn/bong-da-duc-c152.html', 'url' => $domain), //Bóng đá Đức
		array('sectionid' => 7, 'catid' =>39 , 'link'=> 'http://hn.24h.com.vn/cup-c1-champions-league-c153.html', 'url' => $domain), //Cup Châu Âu		
		array('sectionid' => 7, 'catid' =>38 , 'link'=> 'http://hn.24h.com.vn/cac-giai-bong-da-khac-c315.html', 'url' => $domain), //Bóng đá quốc tế
		array('sectionid' => 7, 'catid' =>37 , 'link'=> 'http://hn.24h.com.vn/bong-da-viet-nam-c182.html', 'url' => $domain), //Bóng đá trong nước
		array('sectionid' => 7, 'catid' =>44 , 'link'=> 'http://hn.24h.com.vn/cac-mon-the-thao-khac-c124.html', 'url' => $domain), //Cac môn khác
		array('sectionid' => 7, 'catid' =>158 , 'link'=> 'http://hn.24h.com.vn/euro-2012-c377.html', 'url' => $domain) //Euro-2012
	);
}
if ($task == 'giaoduc'){
	$aLink = array(
		//24H.COM.VN
		//Giáo dục
		array('sectionid' => 2, 'catid' =>7 , 'link'=> 'http://hn.24h.com.vn/giao-duc-du-hoc-c216.html', 'url' => $domain), //Giáo dục 24h
		array('sectionid' => 2, 'catid' =>5 , 'link'=> 'http://hn.24h.com.vn/tuyen-sinh-dh-cd-c365.html', 'url' => $domain), //Tuyển sinh
		array('sectionid' => 2, 'catid' =>8 , 'link'=> 'http://hn.24h.com.vn/du-hoc-c261.html', 'url' => $domain) //Du học
	);
}
if ($task == 'suckhoe'){
	$aLink = array(
		//24H.COM.VN
		//Sức khỏe
		array('sectionid' => 5, 'catid' =>149 , 'link'=> 'http://hn.24h.com.vn/an-toan-thuc-pham-c304.html', 'url' => $domain), //An toàn thực phẩm
		array('sectionid' => 5, 'catid' =>152 , 'link'=> 'http://hn.24h.com.vn/nhan-khoa-c255.html', 'url' => $domain), //Nhãn khoa
		array('sectionid' => 5, 'catid' =>156 , 'link'=> 'http://hn.24h.com.vn/noi-khoa-c244.html', 'url' => $domain), //Lão, Phụ, Nội khoa
		array('sectionid' => 5, 'catid' =>156 , 'link'=> 'http://hn.24h.com.vn/phu-khoa-c245.html', 'url' => $domain), //Lão, Phụ, Nội khoa
		array('sectionid' => 5, 'catid' =>156 , 'link'=> 'http://hn.24h.com.vn/lao-khoa-c246.html', 'url' => $domain), //Lão, Phụ, Nội khoa
		array('sectionid' => 5, 'catid' =>34 , 'link'=> 'http://hn.24h.com.vn/suc-khoe-sinh-san-c247.html', 'url' => $domain), //Sức khỏe và giới tính
		array('sectionid' => 5, 'catid' =>32 , 'link'=> 'http://hn.24h.com.vn/bac-si-cua-ban-c66.html', 'url' => $domain), //Bác sỹ của bạn
		array('sectionid' => 5, 'catid' =>150 , 'link'=> 'http://hn.24h.com.vn/da-lieu-c318.html', 'url' => $domain), //Da liễu
		array('sectionid' => 5, 'catid' =>151 , 'link'=> 'http://hn.24h.com.vn/stress-c256.html', 'url' => $domain), //Stress
		array('sectionid' => 5, 'catid' =>153 , 'link'=> 'http://hn.24h.com.vn/khoa-nhi-c254.html', 'url' => $domain), //Khoa nhi
		array('sectionid' => 5, 'catid' =>154 , 'link'=> 'http://hn.24h.com.vn/rang-ham-mat-c249.html', 'url' => $domain), //Răng - Hàm - Mặt
		array('sectionid' => 5, 'catid' =>157 , 'link'=> 'http://hn.24h.com.vn/tieu-duong-c242.html', 'url' => $domain), //Tiểu đường
		array('sectionid' => 5, 'catid' =>155 , 'link'=> 'http://hn.24h.com.vn/tai-mui-hong-c248.html', 'url' => $domain), //Tai - Mũi - Họng
		array('sectionid' => 5, 'catid' =>33 , 'link'=> 'http://hn.24h.com.vn/bai-thuoc-dan-gian-c67.html', 'url' => $domain) //Bài thuốc hay
	);
}


foreach ($aLink as $array) {
	$get_link = $array['link'];
	$html = file_get_html($get_link);
	$articles = $cronjob->getPage24h($html, $array['url']);
	insert_db_tapchi($articles, $array['sectionid'], $array['catid']);
}

mysql_close();
?>