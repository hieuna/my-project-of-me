<?php /* Smarty version 2.6.10, created on 2012-02-22 22:35:29
         compiled from D:/AppServ/www/projects/templates/administrator/admin.header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
templates/administrator/css/style.css" type="text/css" />
<script src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery-1.7.min.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/javascript.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/core.js" type="text/javascript"></script>

<link rel="stylesheet" media="all" type="text/css" href="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/css/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/css/jquery-ui-timepicker-addon.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery-ui-sliderAccess.js"></script>
<!-- jQuery Inline Content Editor Plugin -->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery.wysiwyg.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/css/jquery.wysiwyg.css" type="text/css" />
<!-- TinyMCE -->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	<?php echo '
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "fulltext",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	'; ?>

</script>
<!-- /TinyMCE -->

<!-- Pick Color -->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/colorpicker/js/layout.js?ver=1.0.2"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/colorpicker/css/colorpicker.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/colorpicker/css/layout.css" type="text/css" />
<!-- /Pick Color -->

<title>Quản trị hệ thống - <?php echo $this->_tpl_vars['page_title']; ?>
</title>
</head>
<body>
	<!-- TOP BACKGROUND -->
	<div id="top_background">
		<div>
			<div>
				<span class="version">Phiên bản 1.0</span>
				<span class="title">Hệ thống quản lý</span>
			</div>
		</div>
	</div>
	<!-- MENU TOP -->
	<div id="menutop">
		<div id="module-menu">
			<ul id="menu">
				<li class="node"><a href="admin.cpanel.php">Trang quản trị</a></li>
				<li class="node"><a href="admin.admins.php">Quản lý Admin</a></li>
				<li class="node"><a href="#">Quản lý menu chính</a></li>
				<li class="node"><a href="#">Quản lý submenu</a></li>
				<li class="node"><a href="admin.customer_hotdeal.php">Quản lý khách hàng</a></li>
				<li class="node"><a href="admin.banner.php">Quản lý banner</a></li>
				<li class="node"><a href="#">Tin tức giữa</a></li>
				<li class="node"><a href="#">Giới thiệu công ty</a></li>
			</ul>
		</div>
		<div id="module-status">
			<span class="preview"><a target="_blank" href="view.php">Xem trước</a></span>
			<a href="index.php?option=com_messages"><span class="no-unread-messages">0</span></a>
			<span class="loggedin-users">1</span>
			<span class="logout"><a href="logout.php">Thoát</a></span>
		</div>
		<div class="clr"></div>
	</div>
	<div id="main-form" class="clearfix">