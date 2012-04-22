<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$aPageinfo.title}</title>
<meta name="description" content="{$aPageinfo.description}" />
<meta name="keywords" content="{$aPageinfo.keyword}" />
{if $smarty.get.mod==shopping}
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
{else}
<meta content="INDEX,FOLLOW" name="robots" />
{/if}
<base href="{$smarty.const.SITE_URL}" />
<link rel="image_src" href="http://www.chungmua3hv.vn/themes/default/images/logo.png" />
<meta name="copyright" content="SmartNet Media Co.,Ltd" />
<meta name="author" content="SmartNet Media Co.,Ltd" />
<meta http-equiv="audience" content="General" />
<meta name="resource-type" content="Document" />
<meta name="distribution" content="Global" />
<link rel="shortcut icon" href="favicon.png" type="image/x-icon" /> 
<meta name="revisit-after" content="1 days" />
<meta name="GENERATOR" content="SmartNet Media Co.,Ltd" />
<link rel="stylesheet" type="text/css" href="themes/default/site.css" media="screen" />
<link rel="stylesheet" type="text/css" href="themes/default/addon.css" media="screen" />
<link rel="stylesheet" type="text/css" href="themes/default/popup.css" media="screen" />
<script src="themes/default/js/jquery-1.4.2.min.js"></script>
<script src="countdown.js"></script>
<script type="text/javascript" src="3hv.js"></script>
{literal}
<script type="text/javascript">
$(document).ready(function(){
//TEXT BOX LABEL
		$('.labelInput').each(function(){
			this.value = $(this).attr('title');
		
			$(this).focus(function(){
				if(this.value == $(this).attr('title')) {
					this.value = '';
				}
			});
		
			$(this).blur(function(){
				if(this.value == '') {
					this.value = $(this).attr('title');
				}
			});
		});
});
</script>
<script>
	  var timeout         = 700;
	  var closetimer		= 0;
	  var ddmenuitem      = 0;
	  
	  function jsddm_open()
	  {	jsddm_canceltimer();
		  jsddm_close();
		  ddmenuitem = $('.dropDown').css('visibility', 'visible');}
		  
	  function jsddm_cate_open()
	  {	jsddm_canceltimer();
		  jsddm_close();
		  ddmenuitem = $('.cate_dropDown').css('visibility', 'visible');}
	  function jsddm_account_open()
	  {	jsddm_canceltimer();
		  jsddm_close();
		  ddmenuitem = $('.account_dropDown').css('visibility', 'visible');}
		  
	  function jsddm_close()
	  {	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}
	  
	  function jsddm_timer()
	  {	closetimer = window.setTimeout(jsddm_close, timeout);}
	  
	  function jsddm_canceltimer()
	  {	if(closetimer)
		  {	window.clearTimeout(closetimer);
			  closetimer = null;}}
	  
	  $(document).ready(function()
	  {
		  $('.cityName').bind('mouseover', jsddm_open);
		  $('.cityName').bind('mouseout',  jsddm_timer);
		  $('.listName').bind('mouseover', jsddm_cate_open);
		  $('.listName').bind('mouseout',  jsddm_timer);
		  $('.listAccount').bind('mouseover', jsddm_account_open);
		  $('.listAccount').bind('mouseout',  jsddm_timer);
	  });
	  
	  document.onclick = jsddm_close;
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26697680-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
{/literal}

</head>
