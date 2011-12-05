		</div>
		<div class="b"><div class="b"><div class="b"></div></div></div>
	</div>
  	<div class="clr"></div>

</td>
</tr>
</table>

<br />
<br />
	{if $smarty.const.PG_DEBUG && $admin->admin_info.admin_group==1}
	{include file="admin_footer_debug.tpl"}
	{literal}
	<script language="javascript">
		function deleteCache(key) {
			if (!confirm('Do you want to delete cache : '+key)) return;
			var sUrl = 'action_cache.php';
			$.ajax({
				type: "POST",
				url: sUrl,
				data: 'task=deleteCache&key='+key,
				dataType: "json",
				success: function(xmlhttp){
					var objData = xmlhttp;
					if (parseInt(objData.intOK) > 0) {
						alert("Delete cache successfull");
					} 
				}
			});
		}
	</script>
	{/literal}
	{/if}
</body>
</html>