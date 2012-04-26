<?
$db_category = new db_query("SELECT cat_id,cat_name,cat_type,new_teaser,new_picture,new_title,new_id
									 FROM categories_multi,news
									 WHERE cat_active = 1 AND cat_type='news' AND new_category = cat_id AND categories_multi.lang_id = " . $lang_id . " AND new_approve = 1
									 GROUP BY cat_id
									 LIMIT 2");
?>
<div style="padding:4px"></div>
<div class="tem_top"><div><a href="<?=$lang_path?>type.php?module=news"><?=mb_strtoupper(translate_display_text("tin_tuc"),"UTF-8")?></a></div></div>
<div class="tem_center">
	 <table cellpadding="5" cellspacing="0" width="100%">
		<tbody>
		<?
		$num_col = 2;
		$j=0;
		?>
		<?
		if($row = mysql_fetch_array($db_category->result)) $go_next = 1;
		else $go_next = 0;
		while($go_next == 1){
		?>
			<tr>
			<?
			for($i=0;$i<$num_col;$i++){
			?>
				<td valign="top" align="center" width="<?=round(100/3)?>%">
				<?
				if($go_next == 1){
					$link_cat 	 = createLink("type",array('module'=>$row["cat_type"],"title"=>$row["cat_name"],"iCat"=>$row["cat_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
					$link_detail = createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["new_title"],"iCat"=>$row["cat_id"],"iData"=>$row["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
					$db_news	 = new db_query("SELECT new_title,new_id,new_teaser
														 FROM news
														 WHERE new_approve = 1 AND new_category = " . $row["cat_id"] . "
														 ORDER BY new_date DESC
														 LIMIT 3");
					?>
					<div class="khu_top"><div><a href="<?=$link_cat?>"><span><?=$row["cat_name"]?></span></a></div></div>
					<div class="khu_center">
						<table cellpadding="2" cellspacing="0" width="100%" height="140">
							<tbody>
								<tr>
									<td colspan="2"><a href="<?=$link_detail?>" class="title"><?=cut_string($row["new_title"],100)?></a></td>
								</tr>
								<tr>
									<td style="padding-right:5px; padding-top:5px;" valign="top">
										<div style="overflow:hidden; width:120px; height:100px;"><a href="<?=$link_detail?>"><img src="/pictures/<?=$row["new_picture"]?>" onError="this.src='/images/noimage.jpg'"  width="120" style="border:solid 1px #e2e2e2"/></a></div>
									</td>
									<td valign="top">
										<div><?=cut_string($row["new_teaser"],190)?></div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?
										while($news=mysql_fetch_array($db_news->result)){
											$link_detail = createLink("detail",array('module'=>$row["cat_type"],"title"=>$row["new_title"],"iCat"=>$row["cat_id"],"iData"=>$news["new_id"]),$lang_path,$con_extenstion,$con_mod_rewrite);
										?>
											<div class="list_news"><a href="<?=$link_detail?>"><?=cut_string($news["new_title"],50)?></a></div>
										<?
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="khu_bottom"><div>&nbsp;</div></div>
					<?
					unset($db_news);
					?>
				<?
				$j++;
				}
				if($row = mysql_fetch_array($db_category->result)) $go_next = 1;
				else $go_next = 0;
				?>
			<? 
			}
			?>
            	<td valign="top" align="center" width="<?=round(100/3)?>%">
            		<div class="khu_top"><div><a><span>Video</span></a></div></div>
                        <div class="khu_center">
                            <div style="height:180px; width:295px; margin:0 auto;">
                                <div align="center" style="z-index:1;">	
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="295" height="180" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">
                                    <param name="allowFullScreen" value="true" />
                                    <param name="allowscriptaccess" value="always" />
                                    <param name="src" value="<?=$con_static_video?>" />
                                    <param name="allowfullscreen" value="true" />
                                    <param name="wmode" value="transparent" /> <!� NEW PARAMETER! �>
                                    <embed type="application/x-shockwave-flash" width="295" height="180" src="<?=$con_static_video?>" wmode="transparent" allowscriptaccess="always" allowfullscreen="true"></embed>
                                    <!� NEW PARAMETER is right after the source url in the EMBED tag �>
                                    </object>	
                                </div>
                            </div>
                        </div>
                    <div class="khu_bottom"><div>&nbsp;</div></div>
                </td>
			</tr>
		<?
		}
		//echo $con_static_video."ddddddddd";
		?>
		</tbody>
	 </table>
</div>
<div class="tem_bottom"><div>&nbsp;</div></div>
