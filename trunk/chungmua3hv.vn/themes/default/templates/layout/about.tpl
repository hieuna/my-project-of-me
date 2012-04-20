<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>{$aPageinfo.title}</title>
<meta name="description" content="{$aPageinfo.description}" />
<meta name="keywords" content="{$aPageinfo.keyword}" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK REL="SHORTCUT ICON" HREF="{$smarty.const.SITE_URL}favicon.png">
 <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="{$smarty.const.SITE_URL}themes/default/jquery-1.4.1.js"></script>
<link rel=stylesheet href="{$smarty.const.SITE_URL}themes/default/style.css" type="text/css" media=screen>
{literal}<script>
	 function tapmenu(id) {
		 
		 $("#selectTap li a").removeClass("active");
		 $("#"+id).addClass('active');
		// var name= $(this).attr("rel");
		// var divToSlide = $(this).find("#content-"+id);
		 var html = $("#content-"+id).html();
		 $(".searchContent").html(html);
	//	divToSlide.css({"display":""});
		return false;
	 }; 
$(document).ready(function() {
  // Handler for .ready() called.
		 $(".searchContent").html($("#content-tour").html());
				
$(".menu li").hover(
	 function () {
		 $(this).children('a').addClass('active');
		 var divToSlide = $(this).find(".sub");
		divToSlide.fadeIn(100);
	  }, 
	  function () {
		 $(this).children('a').removeClass('active');
		 var divToSlide = $(this).find(".sub");
		divToSlide.fadeOut(100);
	  });

});
</script>{/literal}
</head>

<body>
<div id="page">
{loadModule name=control task=header}
	<div id="mainarea">
		{loadModule name=control task=left}
		
		<div id="right">
                   {loadModule name=about task=$smarty.get.task}
            </div>
	</div>
	{loadModule name=control task=footer}
  
</div>
</body>

</html>