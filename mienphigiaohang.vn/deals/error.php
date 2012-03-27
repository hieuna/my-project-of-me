<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5; URL=/deals/" />
<meta name="robots" content="noodp,index,follow" />
<meta name="AUTHOR" content="MienPhiGiaoHangVN">
<meta http-equiv="content-language" content="vi" />
<title>Page not found</title>
<style type="text/css">
a{
color:#003399;
text-decoration:underline;
}
a:hover{
color:#e97d13;
}
body{
font-family:Arial, Helvetica;
margin:0px;
text-align:center;
}
div{
background:#F2F2F2;
border:1px #E2E2E2 solid;
border-radius:0.5em 0.5em 0.5em 0.5em;
-moz-border-radius:0.5em 0.5em 0.5em 0.5em;
font-size:13px;
line-height:22px;
padding:30px;
margin:100px auto;
width:600px;
text-align:center;
}
</style>
<?php
include_once("lang.php");

/**
    Set 404 Page
*/
//header("HTTP/1.0 404 Not Found"); 

$error = getValue("error","str","GET","");
if($error == ""){
    redirect(getURL(1,0,0,0));
}
?>
</head>
<body>
<div>
<b>Địa chỉ bạn truy cập hiện không tồn tại</b><br />
Bạn hãy <a href="/deals/">ấn vào đây</a> để quay lại trang chủ. Hoặc website sẽ tự động về trang chủ  trong 5 giây nữa!
</div>
</body>
</html>
