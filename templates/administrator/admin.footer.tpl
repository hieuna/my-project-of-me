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
{literal}
<script type="text/javascript">
$(function(){
	$('#start_date, #end_date, #date').datetimepicker();
	$("ul#menu li").hover(function(){
		$(this).addClass('hover');
	},
	function(){
		$(this).removeClass('hover');
	});
});
</script>
{/literal}
</html>