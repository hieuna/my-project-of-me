<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$aPageinfo.title}</title>
<meta name="description" content="{$aPageinfo.description}" />
<meta name="keywords" content="{$aPageinfo.keyword}" />
<LINK REL="SHORTCUT ICON" HREF="{$smarty.const.SITE_URL}favicon.png">
<script type="text/javascript" src="{$smarty.const.SITE_URL}themes/default/jquery-1.4.2.min.js"></script> 

<script type="text/javascript" src="{$smarty.const.SITE_URL}themes/default/jquery.jcarousel.min.js"></script> 
<link rel="stylesheet" href="{$smarty.const.SITE_URL}themes/default/style.css" />

</head>
<body>
<div id="page">
{loadModule name=control task=header}
    <div id="bodypage">
	<div id="mainarea">
{loadModule name=control task=left}
<div id="contentarea" style="padding:10px;">
	<div class="titleDetailt"><a href="{$smarty.const.SITE_URL}">{#HOME#}</a> &raquo; <span style=" color:#F00">Giỏ hàng</span></div>
{loadModule name=cart task=$smarty.get.task}
<div class="clr"></div>
</div>
{loadModule name=control task=footer}
</div>
</div>
</div>
</body>
</html>
