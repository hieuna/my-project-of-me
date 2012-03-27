<?php
include("../deals/lang.php");
//check user name
if (isset($_GET["q"])){
$user_name = $_GET["q"];

$select_count = new db_query(" SELECT count(*) as count
									 FROM users									 
									 WHERE  username = '".$user_name."'");
$row_count = mysql_fetch_assoc($select_count->result);
$i = $row_count["count"];
if($i != 0){
	echo 'Rất tiếc, tài khoản '.$user_name.' đã có người dùng! Bạn hãy chọn một tên khác!';
	}
else{echo 'Chưa có người dùng!';}
}
//check email:
if (isset($_GET["email"])){
$email = $_GET["email"];

$select_count_email = new db_query(" SELECT count(*) as count
									 FROM users									 
									 WHERE  email = '".$email."'");
$row_count_email = mysql_fetch_assoc($select_count_email->result);
$num_email = $row_count_email["count"];
if($num_email != 0){
	echo ''.$email.' đã có người dùng. Bạn hãy dùng một email khác để đăng kí!';
	}
else{echo 'Chưa có người dùng';}
}

?>