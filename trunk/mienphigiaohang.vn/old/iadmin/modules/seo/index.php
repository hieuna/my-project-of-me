<?php

if($_REQUEST['action']='editseo')
{
	if($_POST)
	{
	
	$google_key=$_REQUEST['google_key'];
	$alexa_key=$_REQUEST['alexa_key'];
	$yahoo_key=$_REQUEST['yahoo_key'];
	$google_analytics=$_REQUEST['google_analytics'];
	$meta=$_REQUEST['meta'];
	
	
	
	mysql_query("UPDATE seo SET google_key='{$google_key}',alexa_key='{$alexa_key}',yahoo_key='{$yahoo_key}', google_analytics='{$google_analytics}', meta='{$meta}' where id=1") or die('Khong the cap nhat');
	
	$mess=alert_success($config['domain'],"Cập nhật SEO thành công!");
	}



$listsys=listseo();
$smarty->assign("mess",$mess);
$smarty->assign("info",$listsys);
$smarty->assign("module_name",$view_path."/editseo.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


?>





