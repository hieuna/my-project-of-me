$(document).ready(function (){
  $('#user_order_advance_search input[name=keyword]').focus(function (e){if ($(this).val()=='T? khóa') $(this).val('');})
  $('#user_order_advance_search input[name=keyword]').blur(function (e){if ($(this).val()=='') $(this).val('T? khóa');})
  var dates = $("#fromDate, #toDate").datepicker({
    dateFormat: 'dd/mm/yy',
    onSelect: function( selectedDate ) {
    	var option = this.id == "fromDate" ? "minDate" : "maxDate",
    		instance = $( this ).data( "datepicker" ),
    		date = $.datepicker.parseDate(
    			instance.settings.dateFormat ||
    			$.datepicker._defaults.dateFormat,
    			selectedDate, instance.settings );
    	dates.not( this ).datepicker( "option", option, date );
    }
  });
    
  if (searchAdvance){
    $("#trans-search li").removeClass("active");
    $("#trans-search li:last").addClass('active');
  }
  $("#trans-search .advance-search .title").click(function (e){
    e.preventDefault();
    var par = $(this).parent();
    if ($('.content', par).height()==0) $('.content', par).css('display', 'block').stop().animate({height: 70});
    else $('.content', par).stop().animate({height: 0});
  });
  
  $("#simpleSearch select[name=recentTrans]").change(function (){
    shp.redirect(crPage+"?date="+$(this).val());
  })
})