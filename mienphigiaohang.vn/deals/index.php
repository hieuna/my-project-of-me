<? 
include("lang.php");
require_once("../includes/inc_config.php");
ob_start("callback");
//die($_SESSION["city"]);
$act        =   getValue("act","str","GET","");
if($act == "logout"){
    if($_SESSION['loged'] == 1){       	
		unset($_SESSION['ses_email']);
		unset($_SESSION['ses_userid']); 
		unset($_SESSION['ses_username']); 
		unset	($_SESSION['loged']);
        redirect("../");
    }
}    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <title><?=$con_site_title;?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?=str_replace("\n","",htmlspecialchars($con_meta_keywords))?>" /> 
		<meta name="description" content="<?=str_replace("\n","",htmlspecialchars($con_meta_description))?>" /> 
		<meta name="robots" content="noodp,index,follow" />
		<meta name="AUTHOR" content="MienPhiGiaoHangVN">
		<meta http-equiv="content-language" content="vi" />
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<meta name="COPYRIGHT" content="Copyright (c) by MienPhiGiaoHang">
        <link href="../images/favico.png" rel="icon" type="images/x-icon" />
        <link href="../images/favico.png" rel="shortcut icon" />        
       
        <?=$load_header?> 	
		
		<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30272058-1']);
  _gaq.push(['_setDomainName', 'mienphigiaohang.vn']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
	
	<body style="background:#8B1A1A;"> <!--#9DCCF6url(../images/bg1.png) repeat " center fixed"#FBFBFB  #c5cdd0--> 
		<script language="JavaScript">
		function maxWindow()
		{window.moveTo(0,0);
		if (document.all){top.window.resizeTo(screen.availWidth,screen.availHeight);}
		else if (document.layers||document.getElementById)
		{if (top.window.outerHeight<screen.availHeight||top.window.outerWidth<screen.availWidth){
			top.window.outerHeight = screen.availHeight;top.window.outerWidth = screen.availWidth;}}
		}
		maxWindow();

		</script>

			<?php
			 if(!isset($_SESSION["city"]) || $_SESSION["city"]==""){
			 //include("index_over.php");// bỏ ghi chú
			}
			 ?>
			<div id="wrapper">
			<div id="header">
				  <? include("../includes/inc_header.php");?> 
			</div>
			<!-- End header-->
			<div id="menu-navi">
				 <? include("../includes/inc_menu.php");?> 
			</div>
			<!-- End navigation-->	
			<div id="container">
				<div class="main clearfix">
					<div class="top-banner">			
						<? include("../includes/inc_topbanner.php");?>
					</div>
					<div class="left">				
						<? include("../includes/inc_top_product.php");?>
					</div>
					<div class="right last">
						<div class="box">
							<? include("../includes/inc_right_support.php");?>
							<?// include("inc_right_hotdeals.php");?>
							<div class="title" style="margin-bottom:10px;">
							<h3>Video Sản Phẩm</h3>
								<object width="206" height="200">
								<param name="movie" value="https://www.youtube-nocookie.com/v/EGh76xwFHcY?version=3&amp;hl=vi_VN"></param>
								<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
								<embed src="https://www.youtube-nocookie.com/v/EGh76xwFHcY?version=3&amp;hl=vi_VN" type="application/x-shockwave-flash" width="206" height="200" allowscriptaccess="always" allowfullscreen="true"></embed>
								</object>
							</div>
							<div class="title">
							<h3>Cùng kết nối</h3>
							</div>
							<? include("../includes/inc_right_facebook.php");?>
							<? include("../includes/inc_right_adv_home.php");?>   </br></br>
							
						</div>
						<?// include("../includes/inc_right.php");?>
					</div>
					<div class="clear"></div>
					<div class="list-itemt clearfix">
						<? include("../includes/inc_list_pro_home.php");?>
					</div>			
				</div>
				<!--query gettime-->
				<script type="text/javascript">
		window.onload=function(){
			 GetCount(dateFuture1, 'countbox1');
			 GetCount(dateFuture2, 'countbox2');
			 GetCount(dateFuture3, 'countbox3');
			<?php for($t=1;$t <= $j; $t++ ) {?>
			GetCount(datecount<?php echo $t;?>, 'counttime<?php echo $t;?>');
			<?php }?>
			};
		</script>
				<!-- End main-->
				<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-26985817-2']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
				<div class="top-page">
						Lên đầu trang
						<a onclick="jQuery('html,body').animate({scrollTop: 0},1000);" href="javascript:void(0)" style="display: block;">&nbsp;</a>
				</div>
			</div>
			
			<!-- End container-->
			<div id="footer">			
					<? include("../includes/inc_footer.php");?>
			</div>
			<!-- End Footer -->	
			</div>
			
			<!-- End wrapper-->  
	</body>
</html>
<?
ob_end_flush();
?>