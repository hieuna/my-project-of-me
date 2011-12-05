<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<title>{$page_title}</title>
<base href='{$uri->base()}' />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta http-equiv="X-UA-Compatible" content="IE=7" /> 
<meta name="keywords" content="thanh toán trực tuyến, cổng thanh toán, thẻ tín dụng, thẻ nội địa, thẻ ATM, visa, mastercard, thanh toán an toàn, bảo vệ người mua" />
<meta name="description" content="Cổng thanh toán trung gian SohaPay" />

{* INLUCDE MAIN STYLESHEET *}
<link rel="shortcut icon" href="./images/favicon.ico?v=0.3" />
<link rel="stylesheet" href="./include/js/jquery/themes/ui-lightness/jquery.ui.all.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./include/js/jquery/js/jquery.ui.tooltip.css" title="stylesheet" type="text/css" />
{*<link rel="stylesheet" href="./templates/css/styles.css" title="stylesheet" type="text/css" />*}
<link rel="stylesheet" href="./templates/css/chargeGold.css?v=0.2" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./templates/css/styleclassic.css?v=0.4" title="stylesheet" type="text/css" />
{$pgThemeCss}
<script type="text/javascript" src="./include/js/jquery/js/jquery-1.4.2.min.js"></script>
{*<script type="text/javascript" src="./include/js/jquery/js/jquery-ui-1.8.2.custom.min.js"></script>
<script type="text/javascript" src="./include/js/jquery/js/jquery.ui.tooltip.js"></script>*}
<script type="text/javascript" src="./include/js/jquery/js/jquery.cookie.3.2.js"></script>
<script type="text/javascript" src="./include/js/jquery/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="./include/js/jquery/js/slideshow.js"></script>
<script type="text/javascript" src="./include/js/core.js"></script>
<script type="text/javascript" src="./include/js/shp.js"></script>
<script type="text/javascript" src="./include/js/chargeGold.js"></script>
{$pgThemeJs}
<script language="javascript" type="text/javascript">
var jsSettings = {$pgJsSettings};
</script>
<script type="text/javascript">
{literal}
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-16561602-9']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
{/literal}
</script>
<script type="text/javascript" language="javascript">
    shp.setUserInfo({$jsonUser});
    shp.setBaseURI('{$uri->base()}');
</script>
</head>
<body id="{$global_page}" class="{if $user->user_exists}logged_in{/if} {$pgBodyClass}" >

{* GLOBAL IFRAME FOR AJAX FUNCTIONALITY *}
{*<iframe id='ajaxframe' name='ajaxframe' style='display: none;' src='javascript:false;'></iframe>*}
