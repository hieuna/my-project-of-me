<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$aPageinfo.title}</title>
<meta name="description" content="{$aPageinfo.description}" />
<meta name="keywords" content="{$aPageinfo.keyword}" />
<LINK REL="SHORTCUT ICON" HREF="{$smarty.const.SITE_URL}favicon.png">
</head>
<link rel="stylesheet" href="{$smarty.const.SITE_URL}themes/default/site.css" />
<script src="http://code.jquery.com/jquery-1.5.js"></script>
<div id="all">

{loadModule name=control task=header}
<div class="main">
{loadModule name=control task=left}
{loadModule name=action task=$smarty.get.task}
{loadModule name=control task=right}
{loadModule name=control task=footer}
</div>
</div>
</body>
</html>
