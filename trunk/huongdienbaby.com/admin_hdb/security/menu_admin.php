<script language="javascript">
	var id_select = 0;
	function show_menu(mnu_id){
		if(document.getElementById(mnu_id+"_div").style.display=='none'){
			if(id_select!=0 && id_select!=mnu_id){
				show_menu(id_select);
			}
			id_select = mnu_id;
			document.getElementById(mnu_id+"_div").style.display='block';
			document.getElementById(mnu_id+"_img").src='../images/tru.gif';
		}else{
			id_select = 0;
			document.getElementById(mnu_id+"_div").style.display='none';
			document.getElementById(mnu_id+"_img").src='../images/cong.gif';
		}
	}
</script>
<link rel="stylesheet" type="text/css" href="../css/FSPortal.css">
<?
function menu_admin($module_name,$add_data,$link_new="",$edit_data,$link_edit="",$module_path="",$module_them='',$link_them=''){
	?>
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="titleMenu">
			<tr>
				<td bgcolor="#ddf8cc">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td height="21" background="../images/bg_title.jpg" class="module_name" style="cursor:pointer" onclick="show_menu('<?=md5($module_path)?>')">&nbsp; <?=$module_name?></td>
							<td background="../images/bg_title.jpg" style="padding:3px;" width="18"><img src="../images/cong.gif" id="<?=md5($module_path)?>_img" name="<?=md5($module_path)?>_img" onclick="show_menu('<?=md5($module_path)?>')" style="cursor:pointer" border="0"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div id="<?=md5($module_path)?>_div" style="display:none">
						<table cellpadding="3" cellspacing="0" width="100%" border="0" bordercolor="#c5d7ef" style="border-collapse:collapse">
							<? if($add_data != "-{}-" && $add_data != ''){?>
							<tr>
								<td width="16" align="right"><img src="../images/icon_cross.gif" hspace="0" vspace="2"></td>
								<td class="module_name" height="25"><a href="../<?=$link_new?>" target="workFrame"><?=$add_data?></a></td>
							</tr>
							<? }?>
							<? if($edit_data != "-{}-" &&  $edit_data != ''){?>
							<tr>
								<td width="16" align="right"><img src="../images/icon_cross.gif" hspace="0" vspace="2"></td>
								<td class="module_name" height="25"><a href="../<?=$link_edit?>" target="workFrame"><?=$edit_data?></a></td>
							</tr>
							<? }?>
							<?
							if($module_them!=''){
							?>
							<tr>
								<td width="16" align="right"><img src="../images/icon_cross.gif" hspace="0" vspace="2"></td>
								<td class="module_name" height="25"><a href="../<?=$link_them?>" target="workFrame"><?=translate_text($module_them)?></a></td>
							</tr>
							<?
							}
							?>
						</table>
					</div>
				</td>
		</table>
	<?
}
?>
<?
function template_start($title="Add New",$include_search=""){
?>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td style="border-bottom:solid 1px #7aa5d6;" width="1%" height="25">&nbsp;</td>
		<td bgcolor="#e5ecf9" width="21%" class="title_module"><?=$title?></td>
		<td style="border-bottom:solid 1px #7aa5d6;" width="79%" nowrap="nowrap" align="left"><? if(file_exists($include_search)) include($include_search);?>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3" valign="top" height="400" class="description_module">
		
<?
}
?>
<?
function template_end(){
?>
		</td>
	</tr>
</table>
<?
}
?>