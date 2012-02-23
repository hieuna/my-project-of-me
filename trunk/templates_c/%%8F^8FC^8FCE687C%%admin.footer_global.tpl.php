<?php /* Smarty version 2.6.10, created on 2012-02-23 22:28:54
         compiled from D:/AppServ/www/projects/templates//administrator/admin.footer_global.tpl */ ?>
<?php echo '
<script type="text/javascript">
$(function(){
	$("#save").click(function(){
		document.adminForm.submit();
	});
	$(\'#start_date, #end_date, #date\').datetimepicker();
	$("ul#menu li").hover(function(){
		$(this).addClass(\'hover\');
	},
	function(){
		$(this).removeClass(\'hover\');
	});

	//jQuery Inline Content Editor Plugin
	$(\'#wysiwyg\').wysiwyg();
	//Validate
	$("form.form-validate").validate();
});
</script>
'; ?>

</html>