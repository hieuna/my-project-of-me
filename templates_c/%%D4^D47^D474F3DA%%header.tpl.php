<?php /* Smarty version 2.6.10, created on 2012-02-24 14:32:07
         compiled from D:/AppServ/www/projects/templates//header.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_global.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <body style="background: url('<?php echo $this->_tpl_vars['bg']; ?>
') no-repeat center center fixed;">
    	<div id="header" class="clearfix">
    		<div id="top_header">
    			<div class="main_top_header clearfix">
    				<div class="logo">
    					<a href="<?php echo $this->_tpl_vars['http_root']; ?>
"><img src="images/logo.png" width="87" height="34" /></a>
    				</div>
    				<div class="my-account">
    					<div><a href="javascript:alert('Hệ thống quản lý tài khoản khách hàng đang hoàn thiện !');">Tài khoản của tôi</a></div>
    				</div>
    				<div class="formSearch">
    					<form autocomplete="off" name="frmSearch" method="post" action="newsearch.php" border="0">
    						<img src="images/home.jpg" width="24" style="float:left;" />
			                <input id="autocomplete" type="text" class="text" style="float:left;" name="txtKeyword" value="Nhập tên sản phẩm cần tìm" onfocus="if (this.value=='Nhập tên sản phẩm cần tìm') this.value='';" onblur="if (this.value.trim()=='') this.value='Nhập tên sản phẩm cần tìm';" />
		                	<a href="javascript:if (document.frmSearch.txtKeyword.value!='Nhập tên sản phẩm cần tìm') document.frmSearch.submit();" style="border: none; margin: 0px; padding: 0px;">
		                    <img src="images/search.jpg" border="0" style="border: none; margin: 0px; padding: 0px; float:left;" alt="search" align="absmiddle" />
			                </a>
			            </form>
    				</div>
    			</div>
    		</div>
    		<div id="bottom_header">
    			<div class="main_bottom_header clearfix">
    				<div class="keyword">Từ khóa HOT :  
    					<a href="index.php?route=product/search&keyword=Iphone">iPhone</a>, 
    					<a href="index.php?route=product/searchnangcao&txt-search=iPad">iPad</a>, 
    					<a href="index.php?route=product/searchnangcao&txt-search=Kindle fire">Kindle fire</a>, 
    					<a href="index.php?route=product/searchnangcao&txt-search=HTC">HTC</a>, 
    					<a href="index.php?route=product/searchnangcao&txt-search=Nokia">Nokia</a>, 
    					<a href="index.php?route=product/searchnangcao&txt-search=Samsung">Samsung</a>,
    					<a href="index.php?route=product/searchnangcao&txt-search=Sony Ericsson">Sony Ericsson</a>
    				</div>
    				<div class="menu">
	    				<ul>
	    					<li class="phone"><a href="<?php echo $this->_tpl_vars['http_root']; ?>
dienthoaididong">Điện thoại</a></li>
	    					<li class="tablet"><a href="<?php echo $this->_tpl_vars['http_root']; ?>
tablet">Máy tính bảng</a></li>
	    					<li class="laptop"><a href="<?php echo $this->_tpl_vars['http_root']; ?>
laptop">Máy tính</a></li>
	    					<li class="thietbiso"><a href="<?php echo $this->_tpl_vars['http_root']; ?>
camera">Thiết bị số</a></li>
	    					<li class="phukien"><a href="<?php echo $this->_tpl_vars['http_root']; ?>
phukien">Phụ kiện</a></li>
	    				</ul>
	    			</div>
    			</div>
    		</div>
    	</div>
    	
    	    