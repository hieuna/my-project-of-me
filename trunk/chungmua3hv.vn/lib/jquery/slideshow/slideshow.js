// JavaScript Document
jQuery.fn.slideMe = function(t){
		var slide = this;
		var speedTime = t;
		var pre = 0;
		var cur = 0;
		var images = $(slide).children();	
		if(images!=null && images.length>0) $(images[0]).css({opacity:1.0});
		startSlide();
		function startSlide(){			
			pre = cur;
			if(cur+1<images.length){				
				cur = cur + 1;			
			}else{
				cur = 0;
			}

			$(images[pre]).animate({opacity: 0.0}, 1500);
			$(images[cur]).addClass('active').animate({opacity: 1.0}, 1000);	
			$(slide).css({height:$(images[cur]).height()});
			setTimeout(function(){startSlide();}, speedTime);
		}
}
