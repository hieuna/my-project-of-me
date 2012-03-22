// JavaScript Document
$(document).ready(function() {
	//When page loads...
	$(".tabs_vncontent").hide(); //Hide all content
	$("ul.tabs_vnchoice li:first").addClass("active").show(); //Activate first tab
	$(".tabs_vncontent:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs_vnchoice li").click(function() {

		$("ul.tabs_vnchoice li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tabs_vncontent").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});