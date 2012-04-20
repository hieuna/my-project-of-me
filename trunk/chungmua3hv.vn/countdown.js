function countdown(secondsRemaining,id) {
	var days = Math.floor(secondsRemaining / 86400),
	    hours = Math.floor((secondsRemaining - (days * 86400)) / 3600),
	    minutes = Math.floor((secondsRemaining - (days * 86400) - (hours * 3600)) / 60),
	    seconds = secondsRemaining - (days * 86400) - (hours * 3600) - (minutes * 60);
	if(secondsRemaining > 0) {
		if(days < 1){
			if(days < 10) { days = '0' + days; }
			if(hours < 10) { hours = '0' + hours; }
			if(minutes < 10) { minutes = '0' + minutes; }
			if(seconds < 10) { seconds = '0' + seconds; }
			$('#'+id+' .days > .number').html(days);
			$('#'+id+' .hours > .number').html(hours);
			$('#'+id+' .minutes > .number').html(minutes);
			$('#'+id+' .seconds > .number').html(seconds);
			$('#'+id+' .days').css({'display':'none'});
		}else{
			if(days < 10) { days = '0' + days; }
			if(hours < 10) { hours = '0' + hours; }
			if(minutes < 10) { minutes = '0' + minutes; }
			if(seconds < 10) { seconds = '0' + seconds; }
			$('#'+id+' .days > .number').html(days);
			$('#'+id+' .hours > .number').html(hours);
			$('#'+id+' .minutes > .number').html(minutes);
			$('#'+id+' .seconds').css({'display':'none'});
			
		
		}
		secondsRemaining--;
		
	} else {
	
		if(secondsRemaining == 0) {
	
			window.location.reload();
		
		}
		
	}
	window.setTimeout(function() {
	
   		countdown(secondsRemaining,id);
   		
	}, 1000);
	
}
