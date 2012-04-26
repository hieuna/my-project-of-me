<?
$db_faq = new db_query("SELECT * FROM faqs,categories_multi WHERE faq_category = cat_id AND faq_approve = 1 ORDER BY faq_date DESC");
$title = translate_display_text("thong_tin_hoi_dap");										
if($row=mysql_fetch_array($db_faq->result)){
	$title = $row["cat_name"];
	mysql_data_seek($db_faq->result,0);
}
?>
<div class="t_top"><div><?=$title?></div></div>
<div class="t_center" style="padding:7px;">
	<?
	while($row=mysql_fetch_array($db_faq->result)){
	?>
		<div class="textBold">
			<?=translate_display_text("nguoi_dang")?>: <?=$row["faq_name"]?>
		</div>
		<div class="description" style="padding:5px;">
			<label style="float:left; width:35px;"><img src="/images/question.gif" /></label>
			<?=$row["faq_question"]?>
		</div>
		<div class="textBold" onClick="checShow('traloi_<?=$row["faq_id"]?>')" style="cursor:pointer">
			<?=translate_display_text("xem_tra_loi")?>
		</div>
		<div align="justify" id="traloi_<?=$row["faq_id"]?>" style="display:none">
			<label style="float:left; width:35px;"><img src="/images/answer.gif" /></label>
			<?=$row["faq_answer"]?>
		</div>
		<br>
	<?
	}
	?>
 </div>
<div class="t_bottom"><div>&nbsp;</div></div>

<script language="javascript">
function checShow(div_id){
	document.getElementById(div_id).style.display = (document.getElementById(div_id).style.display=='none') ? 'block' : 'none';
}
</script>