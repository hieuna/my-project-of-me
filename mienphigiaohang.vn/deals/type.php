<? 
include("lang.php");
require_once("../includes/inc_config.php");
ob_start("callback");
//echo($_SESSION["city"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <title><?=$con_site_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="<?=str_replace("\n","",htmlspecialchars($con_meta_keywords))?>" /> 
		<meta name="description" content="<?=str_replace("\n","",htmlspecialchars($con_meta_description))?>" /> 
        <link href="../images/favico.png" rel="icon" type="images/x-icon" />
        <link href="../images/favico.png" rel="shortcut icon" />        
        <?=$load_header?> 	
	</head>
<body style="background:#8B1A1A;">
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
			<div class="clear"></div>
			<div class="list-itemt clearfix">
			
            	<? include("../includes/inc_type.php");?>
            
			</div>
		<!-- End main-->
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
