<?
$new_id = getValue("iData","int","GET");
$cat_id = getValue("iCat","int","GET");
if(getValue("updatenew_" . $iData,"int","SESSION",0)!=1){
	$db_counter	= new db_execute("UPDATE news SET new_hits = new_hits + 1 WHERE new_id = " . $iData);
	unset($db_counter);
	$_SESSION["updatenew_" . $iData]=1;
}
$db_other_news = new db_query("SELECT new_title,new_id,cat_id,cat_type,new_teaser,new_date
											FROM news,categories_multi
											WHERE cat_id = new_category AND  cat_active=1 AND cat_id=" . $iCat . " 
											ORDER BY new_date DESC, new_id DESC
											LIMIT 10");
$db_detail = new db_query( "SELECT *
										FROM news,categories_multi
										WHERE cat_id = new_category  AND new_id = " . $new_id);
										
?>
<?
if($row = mysql_fetch_array($db_detail->result)){
?>
<div class="t_top"><div id="detail"><?=$row["new_title"]?></div></div>
	<div class="t_center">
		<div class="description" align="justify" style="padding:5px; font-size:12px">
			<div><font color="#B00070"><?=date("h:i",$row["new_date"])?></font> | <?=date("d/m/Y",$row["new_date"])?></font></div>
			<div>
			<? if($row["new_picture"] !=''){?><table cellpadding="5" cellspacing="0" align="left" width="100">
				<tr>
					<td style="padding-top:5px;"><img src="/pictures/medium_<?=$row["new_picture"]?>" border="0" /></td>
				</tr>
				<tr>
					<td style="color:#0000FF" align="center"><?=$row["new_image_note"]?></td>
				</tr>
			</table><? }?>
			<strong><?=trim($row["new_teaser"])?></strong> <br />
			<?
			$db_relate = new db_query("SELECT new_title,new_id,new_category
												FROM news,relate_news
												WHERE new_id = rel_relate AND rel_id = " . $row["new_id"] . " AND rel_relate <> " . $row["new_id"] . "
											   ");
			$re=0;
			$total_relate = mysql_num_rows($db_relate->result);
			while($rowr=mysql_fetch_array($db_relate->result)){
				if($re==0) echo '<img src="/images/bullet9.gif" border="0"> ';
				$re++;
				$link_detail 	= createLink("detail",array('module'=>$row["cat_type"],"title"=>$rowr["new_title"],"iCat"=>$rowr["new_category"],"iData"=>$rowr["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
			?>
				<a href="<?=$link_detail?>" title="<?=htmlspecialchars($rowr["new_title"])?>" class="relate"><strong><?=$rowr["new_title"]?></strong></a> <?=($re<$total_relate) ? '/' : '';?> 
			<?
			}
			?>
			<br  clear="all"/><?=trim($row["new_description"])?>
			</div>
			<br clear="all" />
			<div align="center"><a href="<?=$lang_path?>print.php?iData=<?=$iData?>" target="_blank"><img src="/images/print.gif" border="0" align="absmiddle" /> <?=translate_display_text("In_trang")?></a> &nbsp; <a href="<?=$lang_path?>mail.php?iData=<?=$iData?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>&width=400&height=400&TB_iframe=true" class="thickbox"><img src="/images/email.gif" border="0" align="absmiddle" /> <?=translate_display_text("Gui_email_ban_tin")?></a></div>
			<?
			if(mysql_num_rows($db_other_news->result)>0){
			?>
			<div style="background:#FFFFFF; padding:5px;">
				<div class="title_bold"><?=translate_display_text("cac_bai_viet_khac")?></div>
				<ul class="news_new">
					<?
					while($other=mysql_fetch_array($db_other_news->result)){
						$link_detail 	= createLink("detail",array('module'=>$other["cat_type"],"title"=>$other["new_title"],"iCat"=>$other["cat_id"],"iData"=>$other["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
					?>
						<li><a href="<?=$link_detail?>"><?=$other["new_title"]?></a></li>
					<?
					}
					?>
				</ul>
			</div>
			<br clear="all" />
			<?
			}
			?>
		</div>
 	</div>
<div class="t_bottom"><div>&nbsp;</div></div>
	<br />
<?
}
?>
