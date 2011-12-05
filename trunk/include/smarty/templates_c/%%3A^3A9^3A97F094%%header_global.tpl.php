<?php /* Smarty version 2.6.26, created on 2011-12-05 23:44:46
         compiled from header_global.tpl */ ?>
<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<title><?php echo $this->_tpl_vars['page_title']; ?>
</title>
<base href='<?php echo $this->_tpl_vars['uri']->base(); ?>
' />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<meta http-equiv="X-UA-Compatible" content="IE=7" /> 
<meta name="keywords" content="thanh toán trực tuyến, cổng thanh toán, thẻ tín dụng, thẻ nội địa, thẻ ATM, visa, mastercard, thanh toán an toàn, bảo vệ người mua" />
<meta name="description" content="Cổng thanh toán trung gian SohaPay" />

<link rel="shortcut icon" href="./images/favicon.ico?v=0.3" />
<link rel="stylesheet" href="./include/js/jquery/themes/ui-lightness/jquery.ui.all.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./include/js/jquery/js/jquery.ui.tooltip.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./templates/css/chargeGold.css?v=0.2" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./templates/css/styleclassic.css?v=0.4" title="stylesheet" type="text/css" />
<?php echo $this->_tpl_vars['pgThemeCss']; ?>

<script type="text/javascript" src="./include/js/jquery/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="./include/js/jquery/js/jquery.cookie.3.2.js"></script>
<script type="text/javascript" src="./include/js/jquery/js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="./include/js/jquery/js/slideshow.js"></script>
<script type="text/javascript" src="./include/js/core.js"></script>
<script type="text/javascript" src="./include/js/shp.js"></script>
<script type="text/javascript" src="./include/js/chargeGold.js"></script>
<?php echo $this->_tpl_vars['pgThemeJs']; ?>

<script language="javascript" type="text/javascript">
var jsSettings = <?php echo $this->_tpl_vars['pgJsSettings']; ?>
;
</script>
<script type="text/javascript">
<?php echo '
var _gaq = _gaq || [];
_gaq.push([\'_setAccount\', \'UA-16561602-9\']);
_gaq.push([\'_trackPageview\']);

(function() {
  var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
  ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
  var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
})();
'; ?>

</script>
<script type="text/javascript" language="javascript">
    shp.setUserInfo(<?php echo $this->_tpl_vars['jsonUser']; ?>
);
    shp.setBaseURI('<?php echo $this->_tpl_vars['uri']->base(); ?>
');
</script>
</head>
<body id="<?php echo $this->_tpl_vars['global_page']; ?>
" class="<?php if ($this->_tpl_vars['user']->user_exists): ?>logged_in<?php endif; ?> <?php echo $this->_tpl_vars['pgBodyClass']; ?>
" >
