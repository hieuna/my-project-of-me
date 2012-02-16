<?php /* Smarty version 2.6.10, created on 2012-01-05 11:32:05
         compiled from header.tpl */ ?>
<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="css/gateway.css" type="text/css" />
        <link rel="stylesheet" href="css/css3.css" type="text/css" />
        <script src="js/jquery-1.7.min.js" type="text/javascript"></script>
         <!-- Search Auto Complete -->
		<script type="text/javascript" src="js/jquery-autocomplete.js"></script>
		<script src="js/jquery.cycle.all.min.js" type="text/javascript"></script>
        <title>XTech-Gateway</title>
    </head>
    <body>
    	<div id="header">
    		<div id="top_header">
    			<div class="main_top_header">
    				<div class="logo">
    					<a href="gateway.php"><img src="images/logo.png" width="87" height="34" /></a>
    				</div>
    				<?php echo '<?php'; ?>
 include("inc/menutop.php");<?php echo '?>'; ?>

    			</div>
    		</div>
    		<div id="bottom_header">
    			<div id="main_bottom_header" class="clearfix">
    				<div class="home">
    					<a href="gateway.php"><img src="images/home.jpg" width="38" height="39" /></a>
    				</div>
    				<div class="search">
    					<div class="keyword">Từ khóa HOT :  
    						<a href="index.php?route=product/search&keyword=Iphone">iPhone</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=iPad">iPad</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=Kindle fire">Kindle fire</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=HTC">HTC</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=Nokia">Nokia</a>, 
    						<a href="index.php?route=product/searchnangcao&txt-search=Samsung">Samsung</a>,
    						<a href="index.php?route=product/searchnangcao&txt-search=Sony Ericsson">Sony Ericsson</a>
    					</div>
    					<div class="formSearch">
    						<form autocomplete="off" name="frmSearch" method="post" action="newsearch.php" border="0">
				                <input id="autocomplete" type="text" class="text" style="float:left;" name="txtKeyword" value="Nhập tên sản phẩm cần tìm" onfocus="if (this.value=='Nhập tên sản phẩm cần tìm') this.value='';" onblur="if (this.value.trim()=='') this.value='Nhập tên sản phẩm cần tìm';" />
			                	<a href="javascript:if (document.frmSearch.txtKeyword.value!='Nhập tên sản phẩm cần tìm') document.frmSearch.submit();" style="border: none; margin: 0px; padding: 0px;">
			                    <img src="images/search.jpg" border="0" style="border: none; margin: 0px; padding: 0px; margin-top:10px; float:left;" alt="search" align="absmiddle" />
				                </a>
				            </form>
    					</div>
    				</div>
    				<div class="my-account">
    					<div><a href="index.php?route=checkout/shipping">Tài khoản của tôi</a></div>
    				</div>
    			</div>
    		</div>
    	</div>
    	
    	    