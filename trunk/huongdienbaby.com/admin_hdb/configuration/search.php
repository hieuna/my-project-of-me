? require_once("../../functions/functions.php");?>	
<?
$type=getValue("type");
?>	
<table cellpadding="0" cellspacing="0">
	<tr>
		<td class="textBold" nowrap="nowrap" style="padding-left:3px; padding-right:3px;"><?=translate_text("filter_type");?> &nbsp; </td>
		<td>
			<select name="type" class="form" onChange="window.location.href='<?=$_SERVER['SCRIPT_NAME']?>?type=' + this.value;">
				<option value="1" <? if($type == 1) echo "selected"; ?>><?=translate_text("config_page");?></option>
				<option value="2" <? if($type == 2) echo "selected"; ?>><?=translate_text("config_static");?></option>
			</select>
		</td>
	</tr>
</table>
