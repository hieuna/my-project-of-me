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
		<meta name="robots" content="noodp,index,follow" />
		<meta name="AUTHOR" content="MienPhiGiaoHangVN">
		<meta http-equiv="content-language" content="vi" />
        <link href="../images/favico.png" rel="icon" type="images/x-icon" />
        <link href="../images/favico.png" rel="shortcut icon" />        
        <?=$load_header?> 	
	</head>
	<body style="background:#8B1A1A;">
<!--<body style="background:url(../images/bg123_noel.jpg) no-repeat top center fixed"> -->
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
						<div id="cse" style="width: 100%;">Loading</div>
							<script src="http://www.google.com.vn/jsapi" type="text/javascript"></script>
							<script type="text/javascript"> 
							  google.load('search', '1', {language : 'vi',style : google.loader.themes.DEFAULT});
							  google.setOnLoadCallback(function() {
								var customSearchOptions = {};
								var imageSearchOptions = {};
								imageSearchOptions['layout'] = google.search.ImageSearch.LAYOUT_POPUP;
								customSearchOptions['enableImageSearch'] = true;
								customSearchOptions['imageSearchOptions'] = imageSearchOptions;  var customSearchControl = new google.search.CustomSearchControl(
								  '007446901747837198769:zef90uzy374', customSearchOptions);
								customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
								customSearchControl.draw('cse');
							  }, true);
							</script>
							<link rel="stylesheet" href="http://www.google.com/cse/style/look/default.css" type="text/css" />	
				<!--		<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-comments" data-href="http://mienphigiaohang.vn" data-num-posts="2" data-width="746"></div>-->
				<?// include("../includes/inc_detail.php");?> 
			</div>
            <div class="right last">
            	<? include("../includes/inc_right_comment.php");?>
				<? include("../includes/inc_detail_pro_right.php");?>
			</div>	
		</div>
		<!-- End main-->
		<!-- End main-->
		<div class="top-page">
				Lên đầu trang
				<a onclick="jQuery('html,body').animate({scrollTop: 0},1000);" href="javascript:void(0)" style="display: block;">&nbsp;</a>
		</div>
	</div>
	<!-- End container-->
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
