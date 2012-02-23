<?php /* Smarty version 2.6.10, created on 2012-02-23 19:59:11
         compiled from admin.footer_global.tpl */ ?>
<?php echo '
<script type="text/javascript">
$(function(){
	$(\'#start_date, #end_date, #date\').datetimepicker();
	$("ul#menu li").hover(function(){
		$(this).addClass(\'hover\');
	},
	function(){
		$(this).removeClass(\'hover\');
	});

	//jQuery Inline Content Editor Plugin
	$(\'#wysiwyg\').wysiwyg();
});
</script>
'; ?>

</html>