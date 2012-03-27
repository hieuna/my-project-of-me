<? 
include("lang.php");
require_once("../includes/inc_config.php");
ob_start("callback");
//echo($_SESSION["city"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <title>Dịch vụ Topup - nạp thẻ điện thoại qua 123re.vn - nạp thẻ nhanh chóng, an toàn và tiện lợi - <?=$con_site_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?=str_replace("\n","",htmlspecialchars($con_meta_keywords))?>" /> 
		<meta name="description" content="<?=str_replace("\n","",htmlspecialchars($con_meta_description))?>" /> 
        <link href="../images/favico.png" rel="icon" type="images/x-icon" />
        <link href="../images/favico.png" rel="shortcut icon" />        
       
        <?=$load_header?> 	
	</head>
<body style="background:url(../images/bg123_noel.jpg) no-repeat top center fixed"> 
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
            	<div class="box"  style="background-color:#ffffff">				
					<div class="title-style1">
                    <div align="center">
                    <img src="../images/steps.png" width="614" height="86" />
                    <iframe   src="http://napthe365.net/home/affiliate.php?affiliate_id=123re"  style="width:100%; min-height:350px;" frameborder="0"></iframe> 
                   </div>
					<div style="background:#FC6; padding:5px; border-top:2px #069 solid"> <span>Chú ý: </span><span style="font-size:14px; color:#F00">Để nạp thẻ được nhanh chóng, chúng tôi khuyến cáo bạn chọn Phương thức thanh toán là Trực tiếp với các cổng thanh toán Bảo Kim - Ngân lượng</span></div>
                    </div>
                </div>
                <div class="box"  style="background-color:#ffffff">
                <? include("../includes/inc_partner.php");?>
                </div>
			</div>
			<div class="right last">
				<? include("../includes/inc_right.php");?>
			</div>					
		</div>
		<!-- End main-->
		<div class="top-page">
				Lên đầu trang
				<a onclick="jQuery('html,body').animate({scrollTop: 0},1000);" href="javascript:void(0)" style="display: block;">&nbsp;</a>
		</div>
	</div>
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
