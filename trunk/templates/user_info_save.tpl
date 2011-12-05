<div id="toolbar" class="toolbar">
	<table class="toolbar"><tbody><tr>
		<td id="toolbar-save" class="button">
		{if $task=='view'}
			<a class="toolbar" onclick="document.userEditInfo.submit();" href="javascript:void(0)">
				<span title="Lưu" class="icon-32-save"></span> Cập nhật
			</a>
		{elseif $task=='changePass'}
			<a class="toolbar" onclick="document.userEditInfo.submit();" href="javascript:void(0)">
				<span title="Lưu" class="icon-32-save"></span> Cập nhật
			</a>
		{/if}
		</td>
	</tr></tbody>
	</table>
</div>