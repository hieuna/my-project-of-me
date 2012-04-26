<?
$db_question = new db_query("SELECT * FROM polls WHERE pol_parent_id = 0 AND pol_parent_active = 1");
if(mysql_num_rows($db_question->result)){
?>
<div class="t_top"><div><?=translate_display_text("tham_do_y_kien")?></div></div>
<div class="t_center">
	<?
	if($row=mysql_fetch_array($db_question->result)){
	$db_answer = new db_query("SELECT * FROM polls WHERE pol_parent_id = " . intval($row["pol_id"]) . " AND pol_active = 1");
	?>
		<input type="hidden" name="check_poll" id="check_poll" value="0">
		<form action="<?=$lang_path?>poll.php" method="post" name="form_pols" class="poll" onSubmit="checkpoll(); return false">
		<input type="hidden" name="return_path" value="<?=getURLR($con_mod_rewrite)?>" />
		<div style="background:#f2f2f2; padding:4px;"><?=$row["pol_name"]?></div>
		<?
		$i=0;
		while($ans = mysql_fetch_array($db_answer->result)){
			$i++;
		?>
			<div class="left_poll"><label><input type="radio" name="pol_id" onChange="document.getElementById('check_poll').value=1" id="polid_<?=$i?>" value="<?=$ans["pol_id"]?>" align="absmiddle"></label><?=$ans["pol_name"]?></div>
		<?
		}
		?>
			<div align="center"><input type="button" value="<?=translate_display_text("binh_chon")?>" onClick="checkpoll();" class="buttom">&nbsp;<input type="button" value="<?=translate_display_text("ket_qua")?>" onclick="timeWin();" class="buttom"></div>
		</form>
	<?
	}
	?>
</div>
<div class="t_bottom"><div>&nbsp;</div></div>
<script language="javascript">
function checkpoll(){
	checked = document.getElementById('check_poll').value;
	
	if(parseInt(checked)==0){
		alert("<?=htmlspecialchars(translate_display_text("ban_phai_chon_mot_dap_an"))?>");
		return false;
	}
	document.form_pols.submit();
	timeWin();
}
</script>
<script language="JavaScript">
function timeWin(url) {
 remote=window.open('<?=$lang_path?>poll_result.php','timelineWin', 'width = 500, height = 250, alwaysLowered=0, alwaysRaised=0, channelmode=0, dependent=1, directories=0, fullscreen=0, hotkeys=1, location=0, menubar=0, resizable=1, scrollbars=1, status=0, titlebar=0, toolbar=0, z-lock=0');
 if (!remote.opener) 
		  remote.opener = self;
	  if (window.focus)
		  remote.focus();  
}
</script>

<?
}
?>
