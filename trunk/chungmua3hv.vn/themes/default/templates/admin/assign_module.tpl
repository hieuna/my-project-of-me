<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{literal}
<script  type="text/javascript">
	function show_hide_roll(obj,img)
	{
		if(obj.style.display == 'none'){
			obj.style.display = 'block';
			img.innerHTML = "[Hide roll]";
		}else{
			obj.style.display = 'none';
			img.innerHTML = "[Show roll]";
		}
	}
	
	function select_module(moduleID){
		var selected = 	document.getElementById('module_'+moduleID).checked;
		
		var i = 0;
		var obj = document.getElementById('roll' + moduleID + '_' + i.toString());		
		while(obj){
			obj.checked = selected;
			i ++;
			obj = document.getElementById('roll' + moduleID + '_' + i.toString());
		}
	}
	
	function select_roll(moduleID,objroll){
		
		if(objroll != null && objroll.checked){
			document.getElementById('module_' + moduleID).checked = true;
		}else if(!objroll.checked){
			var i = 0;
			var obj = document.getElementById('roll' + moduleID + '_' + i.toString());		
			var flag = false;
			while(obj){
				if(obj.checked){
					flag = true;
					break;
				}
				i ++;
				obj = document.getElementById('roll' + moduleID + '_' + i.toString());
			}
			if(!flag) document.getElementById('module_' + moduleID).checked = false;
		}
	}
</script>
{/literal}
<body style="overflow:auto" leftmargin="0" rightmargin="0" topmargin="0">
<form action="" name="" method="post" style="margin:0px;" >
<div style="height:40px;background-color:#D0E0F4; font-weight:bold; font-size:18px; line-height:2; text-align:center">
	Decentralize User Group
</div>
{assign var="counter" value=0}
{foreach from = $modules item = module name=modul }
	
	<div style="height:auto; padding:5px; border:1px solid gray; {if $smarty.foreach.modul.index != 0} border-top:none;{/if} padding-left:30px; {if $smarty.foreach.modul.index % 2 != 0} background-color:#EFEFEF; {/if}">	
		{if $module.level == 0}
		{assign var="counter" value=$counter+1}
		<font color="#FF6600"  size="+1">{$counter} &nbsp;</font>
		{else}
			<font color="#FF6600"  size="+1"> &nbsp;&nbsp;&nbsp;</font>
		{/if}
		<label style="font-weight:bold">{$module.title}&nbsp;</label>
		{if !$module.hashchild }
		<input name="module[]" id="module_{$module.id}" onClick="select_module('{$module.id}');" type="checkbox" value="{$module.id}" {if $module.checked} checked {/if}/></label>				
		<span onClick="show_hide_roll(document.getElementById('container'+'{$module.title}'),this)" style="cursor:pointer; ">[Show roll]</span>			
		<span id="container{$module.title}" style="display:none; padding-left:60px;">
			 {foreach from = $module.roll item = roll name =roll }
				<label style="font-weight:bold">{$roll.name}
				<input name="roll{$module.id}[]" id="roll{$module.id}_{$smarty.foreach.roll.index}" onClick="select_roll('{$module.id}',this);" type="checkbox" value="{$roll.id}" {if $roll.checked} checked {/if}/></label>&nbsp;&nbsp;&nbsp;
			 {/foreach}			 
		</span>
		{/if}
	</div>
{/foreach}
<div style="margin-top:5px; text-align:center">
	<input type="submit" name="" value="Assign" style="border:1px solid gray">&nbsp;&nbsp;&nbsp;
	<input type="button" name="" value="Cancel" onClick="window.close();" style="border:1px solid gray">
</div>
</form>
</body>