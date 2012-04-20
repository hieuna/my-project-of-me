<?php /* Smarty version 2.6.19, created on 2011-09-17 00:33:42
         compiled from ext.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'url_friendly', 'ext.tpl', 70, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $this->_tpl_vars['aPageinfo']['title']; ?>
</title>
<meta name="description" content="<?php echo $this->_tpl_vars['aPageinfo']['description']; ?>
" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['aPageinfo']['keyword']; ?>
" />
<link rel="shortcut icon" href="http://vinamba.com/favicon.gif" type="image/x-icon" />
<script type="text/javascript" src="<?php echo @SITE_URL; ?>
lib/jquery/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo @SITE_URL; ?>
lib/ext/resources/css/ext-all.css"/>
<script type="text/javascript" src="<?php echo @SITE_URL; ?>
lib/ext/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="<?php echo @SITE_URL; ?>
lib/ext/ext-all.js"></script>
	
<script type="text/javascript">
	<?php echo $this->_tpl_vars['menu']; ?>

</script>

<?php echo '
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

'; ?>
	
</head>
<body>

<div id="north" style="padding: 3px 10px 3px 10px; border-bottom: 1px solid #99bbe8;">
	<div style="float: left; font-weight: bold; height:30px; line-height:30px;"><?php echo $this->_config[0]['vars']['title_admin']; ?>
</div>
	<div style="float: right;font-size:12px;  line-height:30px;">
	<?php $this->assign('id', $_SESSION['user_id']); ?>
	<?php $this->assign('prefix', $_SESSION['prefix_']); ?>
		<b><?php echo $this->_config[0]['vars']['welcome']; ?>
: <a href="#"  onClick="content.document.location.href='<?php echo @SITE_URL; ?>
<?php echo ((is_array($_tmp="index.php?mod=admin&amod=user&atask=user&task=edit&id=".($this->_tpl_vars['id']))) ? $this->_run_mod_handler('url_friendly', true, $_tmp) : smarty_modifier_url_friendly($_tmp)); ?>
'"><?php echo $_SESSION[$this->_tpl_vars['prefix']]['username']; ?>
</a></b>&nbsp; |
		<a href="<?php echo @SITE_URL; ?>
" target="_blank"><?php echo $this->_config[0]['vars']['to_home']; ?>
</a>&nbsp; |		
		<a href="<?php echo @SITE_URL; ?>
<?php echo ((is_array($_tmp='index.php?mod=user&task=logout')) ? $this->_run_mod_handler('url_friendly', true, $_tmp) : smarty_modifier_url_friendly($_tmp)); ?>
"><?php echo $this->_config[0]['vars']['logout']; ?>
</a></div>
</div>

<div id="west">

</div>


</body>
</html>