<?php /* Smarty version 2.6.10, created on 2012-02-23 21:05:05
         compiled from D:/AppServ/www/projects/templates/administrator/admin.header.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template_root'])."/administrator/admin.header_global.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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