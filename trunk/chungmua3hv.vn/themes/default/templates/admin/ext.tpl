<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>{$aPageinfo.title}</title>
<meta name="description" content="{$aPageinfo.description}" />
<meta name="keywords" content="{$aPageinfo.keyword}" />
<link rel="shortcut icon" href="http://vinamba.com/favicon.gif" type="image/x-icon" />
<script type="text/javascript" src="{$smarty.const.SITE_URL}lib/jquery/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="{$smarty.const.SITE_URL}lib/ext/resources/css/ext-all.css"/>
<script type="text/javascript" src="{$smarty.const.SITE_URL}lib/ext/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}lib/ext/ext-all.js"></script>
	
<script type="text/javascript">
	{$menu}
</script>

{literal}
<style type="text/css">
a:link, a:visited, a:hover 
{
	color: #18397E;
	text-decoration: none;
}

a:hover
{
	text-decoration: underline;
}

p {
	margin:5px;
}
.settings {
	background-image:url(images/folder_wrench.png);
}
.nav {
	background-image:url(images/folder_go.png);
}
.leftmenu_item, .leftmenu_item_selected, .leftmenu_item_hover{
	width: 100%;
	height: 25px;
	text-align: left;
	text-decoration: none;
	font-size: 12px;
	border-bottom: 1px solid #99BBE8;
	background-color:#DAE9FB;
	cursor: pointer;
	padding-top: 5px;
	padding-left: 20px;
}
.leftmenu_item_selected{		
	background-color:#F0F6FD;
}
.leftmenu_item_hover{	
	background-color:#F0F6FD;
}

</style>

{/literal}	
</head>
<body>

<div id="north" style="padding: 3px 10px 3px 10px; border-bottom: 1px solid #99bbe8;">
	<div style="float: left; font-weight: bold; height:30px; line-height:30px;">{#title_admin#}</div>
	<div style="float: right;font-size:12px;  line-height:30px;">
	{assign var=id value=$smarty.session.user_id}
	{assign var=prefix value=$smarty.session.prefix_}
		<b>{#welcome#}: <a href="#"  onClick="content.document.location.href='{$smarty.const.SITE_URL}{"index.php?mod=admin&amod=user&atask=user&task=edit&id=$id"|url_friendly}'">{$smarty.session.$prefix.username}</a></b>&nbsp; |
		<a href="{$smarty.const.SITE_URL}" target="_blank">{#to_home#}</a>&nbsp; |		
		<a href="{$smarty.const.SITE_URL}{'index.php?mod=user&task=logout'|url_friendly}">{#logout#}</a></div>
</div>

<div id="west">

</div>


</body>
</html>