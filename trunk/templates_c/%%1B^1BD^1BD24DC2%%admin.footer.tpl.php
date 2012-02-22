<?php /* Smarty version 2.6.10, created on 2012-02-22 23:25:37
         compiled from D:/AppServ/www/projects/templates/administrator/admin.footer.tpl */ ?>
	</div>
	<!-- BORDER BOTTOM -->
	<div id="border-bottom"><div><div></div></div></div>
	
	<!-- FOOTER -->
	<div id="footer">
		<p class="copyright">
			<a target="_blank" href="http://www.joomla.org">Joomla!</a>
			là phần mềm miễn phí lưu hành theo giấy phép GNU/GPL.
		</p>
	</div>
</body>
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