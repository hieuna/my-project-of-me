<?php /* Smarty version 2.6.10, created on 2012-01-11 11:43:31
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/admin.header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
templates/administrator/css/style.css" type="text/css" />
<script src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery-1.7.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['http_root']; ?>
templates/administrator/css/Calendar.css" type="text/css" />
<script src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery.ui.core.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['http_root']; ?>
includes/js/JQuery/jquery.ui.datepicker.js" type="text/javascript"></script>
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
				<li class="node"><a href="#">Trang quản trị</a></li>
				<li class="node"><a href="#">Quản lý Admin</a></li>
				<li class="node"><a href="#">Quản lý menu chính</a></li>
				<li class="node"><a href="#">Quản lý submenu</a></li>
				<li class="node"><a href="#">Quản lý tin tức</a></li>
				<li class="node"><a href="#">Quản lý banner</a></li>
				<li class="node"><a href="#">Tin tức giữa</a></li>
				<li class="node"><a href="#">Giới thiệu công ty</a></li>
			</ul>
		</div>
		<div id="module-status">
			<span class="preview"><a target="_blank" href="http://localhost/ccbm/">Xem trước</a></span>
			<a href="index.php?option=com_messages"><span class="no-unread-messages">0</span></a>
			<span class="loggedin-users">1</span>
			<span class="logout"><a href="index.php?option=com_login&amp;task=logout">Thoát</a></span>
		</div>
		<div class="clr"></div>
	</div>
	<div id="main-form" class="clearfix">