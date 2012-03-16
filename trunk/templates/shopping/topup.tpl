<div style="position: absolute; z-index:100; display: block;" id="popupContact">		
	<a href="topup.php" target="_blank" id="closeWidth">
		<img src="{$topup->banner_topup}" width="650" border="0" />
	</a>
	<br>
	<div>
		<a href="topup.php" style="float:left; color:white; font-weight:bold; font-size:14px; text-decoration:none;">Xem chi tiết</a>
		<a id="popupContactClose" href="javascript:;">[x] Đóng lại</a>
	</div>
</div>	
<div style="height: 100%; opacity: 0.7; display: block;" id="backgroundPopup"></div>
{literal}
<script type="text/javascript">
	var popupStatus = 0;
	function loadPopup(){
		if(popupStatus==0){
			$("#backgroundPopup").css({
				"opacity": "0.7"
			});
			$("#backgroundPopup").fadeIn("slow");
			$("#popupContact").fadeIn("slow");
			popupStatus = 1;
		}
	}
	
	function disablePopup(){
		if(popupStatus==1){
			$("#backgroundPopup").fadeOut("slow");
			$("#popupContact").fadeOut("slow");
			popupStatus = 0;
		}
	}
	
	function centerPopup(){
		var windowWidth = document.documentElement.clientWidth;
		var windowHeight = document.documentElement.clientHeight;
		var popupHeight = $("#popupContact").height();
		var popupWidth = $("#popupContact").width();
		$("#popupContact").css({
			"position": "absolute",
			"top": windowHeight/2-popupHeight/2,
			"left": windowWidth/2-popupWidth/2
		});
		
		$("#backgroundPopup").css({
			"height": windowHeight
		});
		
	}
	
	$(function() {
	  	//LOADING POPUP
		centerPopup();
		loadPopup();
		$("#button").click(function(){
			centerPopup();
			loadPopup();
		});
					
		//CLOSING POPUP
		$("#popupContactClose").click(function(){
			disablePopup();
		});
		$("#closeWidth").click(
			function(){
				disablePopup();
			}
		)
		$("#backgroundPopup").click(function(){
			//disablePopup();
		});
		$(document).keypress(function(e){
			if(e.keyCode==27 && popupStatus==1){
				disablePopup();
			}
		});
	});
</script>
{/literal}