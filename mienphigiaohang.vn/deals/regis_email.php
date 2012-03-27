<?php
include("lang.php");
require_once("../includes/inc_config.php");
ob_start("callback");

$con_site_title = 'GỬI EMAIL - NHẬN KHUYẾN MẠI!';

$con_meta_description = $con_site_title . ', ' . $con_meta_description;
$con_meta_keywords = str_replace(" ",", ",$con_site_title) . ', ' . $con_meta_keywords;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title><?=$con_site_title?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="<?=str_replace("\n","",htmlspecialchars($con_meta_keywords))?>" /> 
	<meta name="description" content="<?=str_replace("\n","",htmlspecialchars($con_meta_description))?>" />
	<meta name="robots" content="noodp,index,follow" />
	<meta name="AUTHOR" content="MienPhiGiaoHangVN">
	<meta http-equiv="content-language" content="vi" />
    <style type="text/css">

a{

	color:#09C;

	text-decoration:underline;

}

a:hover{

	color:#e97d13;

}

body{

	font-family:Arial, Helvetica, sans-serif;

	margin:0px;

	text-align:center;

}

div{

	background:#FFC;

	border:1px #E2E2E2 solid;

	border-radius:0.5em 0.5em 0.5em 0.5em;

	-moz-border-radius:0.5em 0.5em 0.5em 0.5em;

	font-size:13px;

	line-height:22px;

	padding:30px;

	margin:50px auto;

	width:500px;

	text-align:center;
	color:#333 ;

}

</style>
</head>

<body>

<?php
$email     = getValue("email","str","GET","");
//die($email);
$date = time();
$msg        = "Bạn đã gửi thông tin thành công! <br />Cám ơn bạn đã quan tâm tới Mienphigiaohang.vn!";
if($email != ""){ 
$db_insert_rep = new db_execute("INSERT INTO `email_multi`
													(
														`email_title` ,														
														`email_date`
													) 
													
													VALUES
													(														
														'$email',
														'$date'
													)"																												
												);
												unset($db_insert);
}
?>
<div>
<b><?=$msg?></b><br />
<img src="../images/bg-footer.png" width="187" height="88" />
 Bạn hãy <a href="../deals/">ấn vào đây</a> để quay lại trang chủ!<br /> 
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26985817-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>	
</div>
</body>
</html>