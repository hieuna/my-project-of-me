{literal}
<script type="text/javascript">
$(function(){
	$("#save").click(function(){
		document.adminForm.submit();
	});
	$('#start_date, #end_date, #date').datetimepicker();
	$("ul#menu li").hover(function(){
		$(this).addClass('hover');
	},
	function(){
		$(this).removeClass('hover');
	});

	//jQuery Inline Content Editor Plugin
	$('#wysiwyg').wysiwyg();
	//Validate
	$("form.form-validate").validate();
});
</script>
{/literal}
</html>