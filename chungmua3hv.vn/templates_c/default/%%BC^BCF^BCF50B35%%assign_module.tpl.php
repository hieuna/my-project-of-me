<?php /* Smarty version 2.6.19, created on 2011-09-19 03:00:04
         compiled from assign_module.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo '
<script  type="text/javascript">
	function show_hide_roll(obj,img)
	{
		if(obj.style.display == \'none\'){
			obj.style.display = \'block\';
			img.innerHTML = "[Hide roll]";
		}else{
			obj.style.display = \'none\';
			img.innerHTML = "[Show roll]";
		}
	}
	
	function select_module(moduleID){
		var selected = 	document.getElementById(\'module_\'+moduleID).checked;
		
		var i = 0;
		var obj = document.getElementById(\'roll\' + moduleID + \'_\' + i.toString());		
		while(obj){
			obj.checked = selected;
			i ++;
			obj = document.getElementById(\'roll\' + moduleID + \'_\' + i.toString());
		}
	}
	
	function select_roll(moduleID,objroll){
		
		if(objroll != null && objroll.checked){
			document.getElementById(\'module_\' + moduleID).checked = true;
		}else if(!objroll.checked){
			var i = 0;
			var obj = document.getElementById(\'roll\' + moduleID + \'_\' + i.toString());		
			var flag = false;
			while(obj){
				if(obj.checked){
					flag = true;
					break;
				}
				i ++;
				obj = document.getElementById(\'roll\' + moduleID + \'_\' + i.toString());
			}
			if(!flag) document.getElementById(\'module_\' + moduleID).checked = false;
		}
	}
</script>
'; ?>

<body style="overflow:auto" leftmargin="0" rightmargin="0" topmargin="0">
<form action="" name="" method="post" style="margin:0px;" >
<div style="height:40px;background-color:#D0E0F4; font-weight:bold; font-size:18px; line-height:2; text-align:center">
	Decentralize User Group
</div>
<?php $this->assign('counter', 0); ?>
<?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['modul'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['modul']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['module']):
        $this->_foreach['modul']['iteration']++;
?>
	
	<div style="height:auto; padding:5px; border:1px solid gray; <?php if (($this->_foreach['modul']['iteration']-1) != 0): ?> border-top:none;<?php endif; ?> padding-left:30px; <?php if (($this->_foreach['modul']['iteration']-1) % 2 != 0): ?> background-color:#EFEFEF; <?php endif; ?>">	
		<?php if ($this->_tpl_vars['module']['level'] == 0): ?>
		<?php $this->assign('counter', $this->_tpl_vars['counter']+1); ?>
		<font color="#FF6600"  size="+1"><?php echo $this->_tpl_vars['counter']; ?>
 &nbsp;</font>
		<?php else: ?>
			<font color="#FF6600"  size="+1"> &nbsp;&nbsp;&nbsp;</font>
		<?php endif; ?>
		<label style="font-weight:bold"><?php echo $this->_tpl_vars['module']['title']; ?>
&nbsp;</label>
		<?php if (! $this->_tpl_vars['module']['hashchild']): ?>
		<input name="module[]" id="module_<?php echo $this->_tpl_vars['module']['id']; ?>
" onClick="select_module('<?php echo $this->_tpl_vars['module']['id']; ?>
');" type="checkbox" value="<?php echo $this->_tpl_vars['module']['id']; ?>
" <?php if ($this->_tpl_vars['module']['checked']): ?> checked <?php endif; ?>/></label>				
		<span onClick="show_hide_roll(document.getElementById('container'+'<?php echo $this->_tpl_vars['module']['title']; ?>
'),this)" style="cursor:pointer; ">[Show roll]</span>			
		<span id="container<?php echo $this->_tpl_vars['module']['title']; ?>
" style="display:none; padding-left:60px;">
			 <?php $_from = $this->_tpl_vars['module']['roll']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['roll'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['roll']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['roll']):
        $this->_foreach['roll']['iteration']++;
?>
				<label style="font-weight:bold"><?php echo $this->_tpl_vars['roll']['name']; ?>

				<input name="roll<?php echo $this->_tpl_vars['module']['id']; ?>
[]" id="roll<?php echo $this->_tpl_vars['module']['id']; ?>
_<?php echo ($this->_foreach['roll']['iteration']-1); ?>
" onClick="select_roll('<?php echo $this->_tpl_vars['module']['id']; ?>
',this);" type="checkbox" value="<?php echo $this->_tpl_vars['roll']['id']; ?>
" <?php if ($this->_tpl_vars['roll']['checked']): ?> checked <?php endif; ?>/></label>&nbsp;&nbsp;&nbsp;
			 <?php endforeach; endif; unset($_from); ?>			 
		</span>
		<?php endif; ?>
	</div>
<?php endforeach; endif; unset($_from); ?>
<div style="margin-top:5px; text-align:center">
	<input type="submit" name="" value="Assign" style="border:1px solid gray">&nbsp;&nbsp;&nbsp;
	<input type="button" name="" value="Cancel" onClick="window.close();" style="border:1px solid gray">
</div>
</form>
</body>