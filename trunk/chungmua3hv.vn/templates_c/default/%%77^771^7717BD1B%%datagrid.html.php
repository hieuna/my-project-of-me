<?php /* Smarty version 2.6.19, created on 2011-11-11 03:17:02
         compiled from file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html', 1, false),array('function', 'html_options', 'file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html', 66, false),array('modifier', 'default', 'file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html', 108, false),array('modifier', 'flashPhoto', 'file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html', 144, false),array('modifier', 'number_format', 'file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html', 160, false),array('modifier', 'echo_date', 'file:/home/guidevn/public_html/chungmua3hv/lib/datagrid/templates/datagrid.html', 162, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => $_SESSION['lang_file']), $this);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>cpanel</title>
</head>
<link href="<?php echo $this->_tpl_vars['path']; ?>
/datagrid.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['path']; ?>
/datagrid.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['path']; ?>
/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $this->_tpl_vars['path']; ?>
/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<?php echo '
 	<script type="text/javascript">
    $(function() {
        $(\'.gallery\').lightBox();
    });
    </script>
    <style type="text/css">
    .coldata td{ padding:10px;}
    </style>
'; ?>

<body>
<form name="for_datagrid" action="" method="get" style="margin:0px;">
<input type="hidden" name="ajax" />
<?php if ($this->_tpl_vars['object']->sRootPath != ''): ?>
<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td valign="middle" id="root">
			&nbsp;&nbsp;<?php echo $this->_tpl_vars['object']->sRootPath; ?>

		</td>
	</tr>
</table>
<?php endif; ?>
<div style="width: 100%; border: 0px solid gray;">
<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="div_filter">
	<tr>
		<td width="100%" >
			<?php if ($this->_tpl_vars['object']->aFilter): ?>  
				<div style="float: left; width:82%;" id="filter_area">
					<table>
					<tr><td>
					<table cellpadding="" cellspacing="3" border="0">		  		
					<?php $_from = $this->_tpl_vars['object']->aFilter; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['filter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['filter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['filter']['iteration']++;
?>
						<?php if (($this->_foreach['filter']['iteration']-1) % 3 == 0): ?>							
							<tr>
						<?php endif; ?>
						<td><?php if ($this->_tpl_vars['row']['display'] != ''): ?>&nbsp;<?php echo $this->_tpl_vars['row']['display']; ?>
:<?php endif; ?></td>
						<td>
						<?php if ($this->_tpl_vars['row']['type'] == 'date'): ?>
						<input type="text" name="<?php if ($this->_tpl_vars['row']['name'] != ''): ?><?php echo $this->_tpl_vars['row']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['row']['field']; ?>
<?php endif; ?>" id="<?php if ($this->_tpl_vars['row']['name'] != ''): ?><?php echo $this->_tpl_vars['row']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['row']['field']; ?>
<?php endif; ?>" value="<?php echo $this->_tpl_vars['row']['selected']; ?>
" <?php if ($this->_tpl_vars['row']['style'] != ''): ?> style="<?php echo $this->_tpl_vars['row']['style']; ?>
"<?php endif; ?>/>
						<img src="<?php echo $this->_tpl_vars['path']; ?>
/calendar/images/lich.gif" id="img_<?php echo ($this->_foreach['filter']['iteration']-1); ?>
" onclick="displayCalendar(document.getElementById(<?php if ($this->_tpl_vars['row']['name'] != ''): ?>'<?php echo $this->_tpl_vars['row']['name']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['row']['field']; ?>
'<?php endif; ?>),'yyyy-mm-dd',this)" />
						<?php elseif ($this->_tpl_vars['row']['type'] == 'text' || $this->_tpl_vars['row']['type'] == 'number'): ?>
							<input type="text" name="<?php if ($this->_tpl_vars['row']['name'] != ''): ?><?php echo $this->_tpl_vars['row']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['row']['field']; ?>
<?php endif; ?>" value="<?php echo $this->_tpl_vars['row']['selected']; ?>
" style="<?php echo $this->_tpl_vars['row']['style']; ?>
" />
						<?php elseif ($this->_tpl_vars['row']['type'] == 'group'): ?>
						<select name="<?php echo $this->_tpl_vars['row']['name']; ?>
_group" id="<?php echo $this->_tpl_vars['row']['name']; ?>
_group" <?php if ($this->_tpl_vars['row']['style'] != ''): ?> style="<?php echo $this->_tpl_vars['row']['style']; ?>
"<?php endif; ?>>
							<option value="">--- Filter by ---</option>
							<?php $_from = $this->_tpl_vars['row']['field']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['item']):
?>
							<option value="<?php echo $this->_tpl_vars['field']; ?>
" <?php if ($this->_tpl_vars['field'] == $this->_tpl_vars['row']['fgroup_by']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['item'][0]; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
							<input type="text" name="<?php echo $this->_tpl_vars['row']['name']; ?>
" value="<?php echo $this->_tpl_vars['row']['selected']; ?>
" style="<?php echo $this->_tpl_vars['row']['style']; ?>
" />
						<?php else: ?>
						<select name="<?php if ($this->_tpl_vars['row']['name'] != ''): ?><?php echo $this->_tpl_vars['row']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['row']['field']; ?>
<?php endif; ?>" id="<?php if ($this->_tpl_vars['row']['name'] != ''): ?><?php echo $this->_tpl_vars['row']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['row']['field']; ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['row']['style'] != ''): ?> style="<?php echo $this->_tpl_vars['row']['style']; ?>
"<?php endif; ?>  onchange="document.for_datagrid.submit();" >
							<?php if ($this->_tpl_vars['row']['option_string'] == ''): ?>
								<option value="">--- <?php echo $this->_config[0]['vars']['all']; ?>
 ---</option>
								<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['row']['options'],'selected' => $this->_tpl_vars['row']['selected']), $this);?>
							
							<?php else: ?>
								<?php echo $this->_tpl_vars['row']['option_string']; ?>

							<?php endif; ?>
						</select>
						<?php endif; ?>
						</td>
						<?php if (($this->_foreach['filter']['iteration']-1) % 3 == 2): ?>
							</tr>
						<?php elseif (($this->_foreach['filter']['iteration'] == $this->_foreach['filter']['total']) == true): ?>							
							<td>&nbsp;</td></tr>
						<?php endif; ?>
				  	<?php endforeach; endif; unset($_from); ?>
					</table>
					</td>
					<td valign="bottom" style="padding-bottom:5px">
						<input type="submit" name="bt_fillter" value="<?php echo $this->_config[0]['vars']['bt_filter']; ?>
" style="border:1px solid gray; width:60px;"/>
						<input type="button" name="bt_reset" value="<?php echo $this->_config[0]['vars']['bt_reset']; ?>
" style="border:1px solid gray; width:60px;" onclick="resetFilter();"/>
					</td>
					</tr></table>					
			  </div>
			  <?php endif; ?>
			<div style="float: right; width:120px; padding-top:5px;"><?php echo $this->_config[0]['vars']['total_item']; ?>
: <strong><?php echo $this->_tpl_vars['number_record']; ?>
</strong>&nbsp;&nbsp;&nbsp;</div>
		</td>
	</tr>
	<?php if ($this->_tpl_vars['object']->sMessage != ''): ?>	
	<tr >
		<td class="notice_msg" style=""><?php echo $this->_tpl_vars['object']->sMessage; ?>
</td>
	</tr>
	<?php endif; ?>
</table>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="coldata">
	<tr class="tr_title">
		<?php if ($this->_tpl_vars['object']->aTaskAll): ?><td class="check td_border_left">&nbsp;</td><?php endif; ?>
		<?php if (! $this->_tpl_vars['object']->hideIndex): ?><td class="td_index">#</td><?php endif; ?>
		<?php $_from = $this->_tpl_vars['object']->aField; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<?php if ($this->_tpl_vars['row']['visible'] != 'hidden'): ?>			
				<td class="td_border_left" style="color:#000000;text-align:center; <?php if ($this->_tpl_vars['row']['width']): ?>width:<?php echo $this->_tpl_vars['row']['width']; ?>
px;<?php endif; ?>">
				<?php if ($this->_tpl_vars['row']['sortable']): ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/sort_asc<?php if (( $this->_tpl_vars['sort_by'] == $this->_tpl_vars['row']['field'] ) && ( $this->_tpl_vars['sort_value'] == 'asc' )): ?>_select<?php endif; ?>.gif" onclick="sortData('<?php echo $this->_tpl_vars['row']['field']; ?>
','asc');" style="cursor:pointer"/>&nbsp;<?php endif; ?>
				<?php echo $this->_tpl_vars['row']['display']; ?>

				<?php if ($this->_tpl_vars['row']['sortable']): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/sort_desc<?php if ($this->_tpl_vars['sort_by'] == $this->_tpl_vars['row']['field'] && $this->_tpl_vars['sort_value'] == 'desc'): ?>_select<?php endif; ?>.gif" onclick="sortData('<?php echo $this->_tpl_vars['row']['field']; ?>
','desc');" style="cursor:pointer"/><?php endif; ?>
				<?php if ($this->_tpl_vars['row']['datatype'] == 'order' && $this->_tpl_vars['arr_value'] != ''): ?>
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/save.png" style="cursor:pointer" title="<?php echo $this->_config[0]['vars']['save_order']; ?>
" border="0" onclick="save_order('<?php echo ((is_array($_tmp=@$this->_tpl_vars['row']['task'])) ? $this->_run_mod_handler('default', true, $_tmp, 'save_order') : smarty_modifier_default($_tmp, 'save_order')); ?>
');"/>
				<?php endif; ?>
				</td>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>		
		<?php if ($this->_tpl_vars['object']->aTask): ?>
		<td class="td_action td_border_left" style="width:<?php echo $this->_tpl_vars['object']->iActionWidth; ?>
px;"><?php if ($this->_tpl_vars['object']->aTask[0]['task'] == 'add'): ?>
			<span onclick="redirect_url('<?php echo $this->_tpl_vars['object']->sSubmitUrl; ?>
&task=<?php echo $this->_tpl_vars['object']->aTask[0]['task']; ?>
');"><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/<?php echo $this->_tpl_vars['object']->aTask[0]['icon']; ?>
" border="0" style="cursor:pointer;" /></span><?php else: ?><?php echo $this->_config[0]['vars']['act']; ?>
<?php endif; ?>
		</td>
		<?php endif; ?>
	</tr>
	
	<?php $_from = $this->_tpl_vars['arr_value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['value'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['value']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['value']['iteration']++;
?>		
	<tr class="<?php if (($this->_foreach['value']['iteration']-1) % 2 == 0): ?>tr_mau1<?php else: ?>tr_mau2<?php endif; ?>" onMouseOver="this.className='tr_hover'" onMouseOut="this.className='<?php if (($this->_foreach['value']['iteration']-1) % 2 == 0): ?>tr_mau1<?php else: ?>tr_mau2<?php endif; ?>'" >
		<?php if ($this->_tpl_vars['object']->aTaskAll): ?>
		<td class="td_check <?php if (! ($this->_foreach['value']['iteration'] == $this->_foreach['value']['total'])): ?> td_border<?php else: ?> td_border_left<?php endif; ?>">
			<input type="checkbox" name="arr_check[]" id="check_<?php echo ($this->_foreach['value']['iteration']-1); ?>
" value="<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
" />
		</td>
		<?php endif; ?>
		
		<?php if (! $this->_tpl_vars['object']->hideIndex): ?><td class="td_index <?php if (! ($this->_foreach['value']['iteration'] == $this->_foreach['value']['total'])): ?> td_border<?php else: ?> td_border_left<?php endif; ?>"><?php echo ($this->_foreach['value']['iteration']-1)+$this->_tpl_vars['index_start']; ?>
</td><?php endif; ?>
		
		<?php $_from = $this->_tpl_vars['object']->aField; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['col'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['col']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['col']['iteration']++;
?>
			<?php if ($this->_tpl_vars['item']['visible'] == '' || $this->_tpl_vars['item']['visible'] != 'hidden'): ?>				
				<td class="<?php if (! ($this->_foreach['value']['iteration'] == $this->_foreach['value']['total'])): ?> td_border<?php else: ?> td_border_left<?php endif; ?>" style="text-align:center;padding:0 3px; <?php if ($this->_tpl_vars['item']['style'] != ''): ?><?php echo $this->_tpl_vars['item']['style']; ?>
<?php endif; ?>">
				<?php if ($this->_tpl_vars['item']['link'] != ''): ?><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
&id=<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
"><?php endif; ?>
				<?php if ($this->_tpl_vars['item']['value_cores'] != ''): ?>
					<?php $_from = $this->_tpl_vars['item']['value_cores']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ref'] => $this->_tpl_vars['cor']):
?>
						<?php if ($this->_tpl_vars['ref'] == $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']]): ?>
							<?php echo $this->_tpl_vars['cor']; ?>

						<?php endif; ?>					
					<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['item']['datatype'] == 'img'): ?>
						<?php if ($this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] != ''): ?>						
						<a href="<?php echo $this->_tpl_vars['item']['img_path']; ?>
<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']]; ?>
" class="gallery">
							<?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['item']['field']])) ? $this->_run_mod_handler('flashPhoto', true, $_tmp, $this->_tpl_vars['item']['img_path'], $this->_tpl_vars['row'][$this->_tpl_vars['item']['tooltip']]) : smarty_modifier_flashPhoto($_tmp, $this->_tpl_vars['item']['img_path'], $this->_tpl_vars['row'][$this->_tpl_vars['item']['tooltip']])); ?>

						</a>
						<?php else: ?>&nbsp;<?php endif; ?>
					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'boolean'): ?>
						<?php if ($this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] == '1' || $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] == 't' || $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] == 'active'): ?>
							<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/active.gif" border="0">
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/deactive.gif" border="0">
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'publish'): ?>
						<?php if ($this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] == '1' || $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] == 't' || $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] == 'active'): ?>
							<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/active.gif" border="0" alt="unpublish" style="cursor:pointer" title="<?php echo $this->_config[0]['vars']['unpublish_item']; ?>
" onclick="doPublish('<?php echo $this->_tpl_vars['object']->sSubmitUrl; ?>
&task=<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['task'])) ? $this->_run_mod_handler('default', true, $_tmp, 'change_status') : smarty_modifier_default($_tmp, 'change_status')); ?>
&field=<?php echo $this->_tpl_vars['item']['field']; ?>
&id=<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
&ajax', this);">
						<?php else: ?>
							<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/deactive.gif" border="0" alt="publish"  style="cursor:pointer" title="<?php echo $this->_config[0]['vars']['publish_item']; ?>
" onclick="doPublish('<?php echo $this->_tpl_vars['object']->sSubmitUrl; ?>
&task=<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['task'])) ? $this->_run_mod_handler('default', true, $_tmp, 'change_status') : smarty_modifier_default($_tmp, 'change_status')); ?>
&field=<?php echo $this->_tpl_vars['item']['field']; ?>
&id=<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
&ajax', this);">
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'number'): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['item']['field']])) ? $this->_run_mod_handler('number_format', true, $_tmp, 0, ",", ".") : smarty_modifier_number_format($_tmp, 0, ",", ".")); ?>
	
					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'date'): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['item']['field']])) ? $this->_run_mod_handler('echo_date', true, $_tmp, "M d,Y h:i:s A") : smarty_modifier_echo_date($_tmp, "M d,Y h:i:s A")); ?>
	
					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'float'): ?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['item']['field']])) ? $this->_run_mod_handler('number_format', true, $_tmp, 3, ".", ",") : smarty_modifier_number_format($_tmp, 3, ".", ",")); ?>

					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'order'): ?>
						<input type="text" name="<?php echo $this->_tpl_vars['item']['field']; ?>
[<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
]" value="<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']]; ?>
"  style="width:60px; height:18px; font-size:11px"/>
					<?php elseif ($this->_tpl_vars['item']['datatype'] == 'movie'): ?>
						<?php if ($this->_tpl_vars['row'][$this->_tpl_vars['item']['field']] != ''): ?>
							 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="<?php echo $this->_tpl_vars['item']['img_size']; ?>
" height="<?php echo $this->_tpl_vars['item']['img_size']; ?>
" hspace="8" vspace="20" align="absmiddle" id="flash">
    <param name="movie" value="<?php echo $this->_tpl_vars['item']['img_path']; ?>
<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']]; ?>
" />
    <param name="quality" value="high" />
    <param name="SCALE" value="noborder" /><param name="LOOP" value="false" /><param name="PLAY" value="false" />
    <embed src="<?php echo $this->_tpl_vars['item']['img_path']; ?>
<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['item']['field']]; ?>
" width="<?php echo $this->_tpl_vars['item']['img_size']; ?>
" height="<?php echo $this->_tpl_vars['item']['img_size']; ?>
" hspace="8" vspace="20" loop="false" align="absmiddle" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" scale="noborder" play="true"></embed>
  </object><?php else: ?> No movie<?php endif; ?>
					<?php else: ?>
						<?php echo ((is_array($_tmp=@$this->_tpl_vars['row'][$this->_tpl_vars['item']['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

					<?php endif; ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['item']['link'] != ''): ?></a><?php endif; ?>	
				</td>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_tpl_vars['object']->aTask): ?>
		<td class="td_action <?php if (! ($this->_foreach['value']['iteration'] == $this->_foreach['value']['total'])): ?> td_border<?php else: ?> td_border_left<?php endif; ?>" style="width:<?php echo $this->_tpl_vars['object']->iActionWidth; ?>
px;">
		<?php $_from = $this->_tpl_vars['object']->aTask; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<?php if ($this->_tpl_vars['item']['task'] != 'add'): ?>
			<?php if (( $this->_tpl_vars['item']['display'] == '' ) || ( $this->_tpl_vars['item']['display']['operation'] == 'equal' && $this->_tpl_vars['row'][$this->_tpl_vars['item']['display']['field']] == $this->_tpl_vars['item']['display']['value'] ) || ( $this->_tpl_vars['item']['display']['operation'] == 'notequal' && $this->_tpl_vars['row'][$this->_tpl_vars['item']['display']['field']] != $this->_tpl_vars['item']['display']['value'] )): ?>			
			<span style="cursor:pointer" onclick="
				<?php if ($this->_tpl_vars['item']['confirm'] || $this->_tpl_vars['item']['action']): ?>javascript: 
					<?php if ($this->_tpl_vars['item']['action'] != ''): ?> <?php echo $this->_tpl_vars['item']['action']; ?>
('<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
') 
					<?php else: ?>
						<?php if ($this->_tpl_vars['item']['field_cascade'] != '' && $this->_tpl_vars['row'][$this->_tpl_vars['item']['field_cascade']] != '' && $this->_tpl_vars['row'][$this->_tpl_vars['item']['field_cascade']] != 0): ?> 
							confirm_redirect('<?php echo $this->_tpl_vars['item']['confirm_cascade']; ?>
', '<?php echo $this->_tpl_vars['object']->sSubmitUrl; ?>
&task=<?php echo $this->_tpl_vars['item']['task']; ?>
&id=<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
') 
						<?php else: ?>
							 confirm_redirect('<?php echo $this->_tpl_vars['item']['confirm']; ?>
', '<?php echo $this->_tpl_vars['object']->sSubmitUrl; ?>
&task=<?php echo $this->_tpl_vars['item']['task']; ?>
&id=<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
') 
							 
						<?php endif; ?>	
					<?php endif; ?> 
				<?php else: ?> javascript:redirect_url('<?php echo $this->_tpl_vars['object']->sSubmitUrl; ?>
&task=<?php echo $this->_tpl_vars['item']['task']; ?>
&id=<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['pkey']]; ?>
') <?php endif; ?>" title="<?php echo $this->_tpl_vars['item']['tooltip']; ?>
">
				<?php if ($this->_tpl_vars['item']['icon']): ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/<?php echo $this->_tpl_vars['item']['icon']; ?>
" border="0" style="cursor:pointer;" /><?php else: ?><?php echo $this->_tpl_vars['item']['text']; ?>
<?php endif; ?>
			</span>
			<?php endif; ?>			
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>&nbsp;
		</td>
		<?php endif; ?>
	</tr>	
	<?php endforeach; else: ?>
	<tr>
		<td style="text-align: center; color: #FF3333; padding: 15px; border-top: 1px solid gray;" colspan="<?php echo $this->_tpl_vars['number_cols']; ?>
">
			<strong><?php echo $this->_config[0]['vars']['no_item']; ?>
</strong>
		</td>
	</tr>	
	<?php endif; unset($_from); ?>	
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr class="tr_paging">
		<td class="td_check">
		<?php if ($this->_tpl_vars['object']->aTaskAll && $this->_tpl_vars['arr_value'] != ''): ?>
			<input type="checkbox" name="checkall" onclick="check_all(this)" title="<?php echo $this->_config[0]['vars']['check_title']; ?>
"/>			
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</td>
		<td valign="middle">&nbsp;
		<?php if ($this->_tpl_vars['object']->aTaskAll && $this->_tpl_vars['arr_value'] != ''): ?>
			<?php $_from = $this->_tpl_vars['object']->aTaskAll; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<span style="cursor:pointer; font-size:11px; font-weight:bold;" class="out" onmouseover="this.className='over'" onmouseout="this.className = 'out'" onclick="event_check('<?php echo $this->_tpl_vars['item']['task']; ?>
','<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['confirm'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Are you sure?') : smarty_modifier_default($_tmp, 'Are you sure?')); ?>
');"><?php echo $this->_tpl_vars['item']['display']; ?>
</span>&nbsp;|
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		</td>
		<td  valign="middle" align="right">
			<div style="float: right;">
				<?php echo $this->_config[0]['vars']['item_per_page']; ?>
: <input name="per_page" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['per_page'])) ? $this->_run_mod_handler('default', true, $_tmp, 10) : smarty_modifier_default($_tmp, 10)); ?>
" style="width: 40px; text-align:center;" onKeyPress="if(event.keyCode==13) for_datagrid.submit();">&nbsp;&nbsp;
				<?php if ($this->_tpl_vars['page'] > 1): ?>
				<span onClick="for_datagrid.page.value=1; for_datagrid.submit();" style="cursor: pointer; padding-top:3px;">
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-first.gif" border="0"  style="cursor:pointer;"/>
				</span>
				<span onClick="for_datagrid.page.value=<?php echo $this->_tpl_vars['page']-1; ?>
; for_datagrid.submit();" style="cursor: pointer">
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-prev.gif" border="0"  style="cursor:pointer"/>
				</span>
				<?php else: ?>
				<span>
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-first-disabled.gif" border="0" />
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-prev-disabled.gif" border="0" />
				</span>
				<?php endif; ?><img src="<?php echo $this->_tpl_vars['path']; ?>
/images/grid-split.gif" border="0" />
				<?php echo $this->_config[0]['vars']['page']; ?>
: <input name="page" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['page'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
" style="width: 20px; text-align:center;" onKeyPress="if(event.keyCode==13) for_datagrid.submit();">
				<?php echo $this->_config[0]['vars']['of']; ?>
 <strong><?php echo $this->_tpl_vars['number_page']; ?>
</strong>&nbsp;&nbsp;<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/grid-split.gif" border="0"/>
				<?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['number_page']): ?>
				<span onClick="for_datagrid.page.value=<?php echo $this->_tpl_vars['page']+1; ?>
; for_datagrid.submit();" style="cursor: pointer;">
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-next.gif" border="0"  style="cursor:pointer"/>
				</span>
				<span onClick="for_datagrid.page.value=<?php echo $this->_tpl_vars['number_page']; ?>
; for_datagrid.submit();" style="cursor: pointer;">
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-last.gif" border="0"  style="cursor:pointer"/>
				</span>
				<?php else: ?>
				<span>
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-next-disabled.gif" border="0" />
					<img src="<?php echo $this->_tpl_vars['path']; ?>
/images/page-last-disabled.gif" border="0" />
				</span>
				<?php endif; ?>&nbsp;
			</div>
		</td>
	</tr>
</table>
</div>

<input type="hidden" name="mod" value="<?php echo $_GET['mod']; ?>
">
<input type="hidden" name="amod" value="<?php echo $_GET['amod']; ?>
">
<input type="hidden" name="atask" value="<?php echo $_GET['atask']; ?>
">
<input type="hidden" name="sort_by" value="<?php echo $this->_tpl_vars['sort_by']; ?>
">
<input type="hidden" name="sort_value" value="<?php echo $this->_tpl_vars['sort_value']; ?>
">
<input type="hidden" name="task" />
</form>
</body>
</html>