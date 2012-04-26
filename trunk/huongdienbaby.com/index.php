<?
include("lang.php");
function callback($buffer) 
{
  // replace all the apples with oranges
	$str= array(chr(9),chr(10));
	$buffer=str_replace($str,"",$buffer);//bo dau tab
	$buffer=str_replace("        "," ",$buffer);//bo dau tab
	return $buffer;
}
ob_start("callback");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$con_site_title?></title>
<!--// lap trinh boi dinhtoan1905@gmail.com Ym:dinhtoan1905 //-->
<meta name="keywords" content="<?=str_replace("\n","",htmlspecialchars($con_meta_keywords))?>"> 
<meta name="description" content="<?=str_replace("\n","",htmlspecialchars($con_meta_description))?>">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<script language="javascript" src="/js/library.js"></script>
<script language="javascript" src="/js/tooltip.js"></script>
</head>
<body >
	<table cellpadding="0" cellspacing="0" width="<?=$con_page_size?>" align="center" class="table_home" style="background:url(/images/bg.gif) repeat-x;">
			<tr>
				<td><? include("../includes/inc_home_header.php");?></td>
			</tr>
			<tr>
				<td><? include("../includes/inc_menu_top.php");?></td>
			</tr>
			<tr>
				<td><? include("../includes/inc_intro.php");?></td>
			</tr>
			<tr>
				<td><? include("../includes/inc_home.php");?></td>
			</tr>
			<tr>
				<td><? include("../includes/inc_footer.php");?></td>
			</tr>
	</table>
	</body> 
</html>