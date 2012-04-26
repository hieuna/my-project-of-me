<?

$module	= getValue("module","str","GET","");
if($module == 'news'){
	include("inc_left_news.php");
}else{
	include("inc_left_menu.php");
}

//include("inc_support_online.php");
include("inc_left_banner.php");
//include("inc_left_email.php");
include("inc_left_poll.php");
//include("inc_left_thoitiet.php");
?>