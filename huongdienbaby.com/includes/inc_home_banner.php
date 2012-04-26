<br clear="all">
<div class="x_top"><div>&nbsp;</div></div>
<div class="x_center">
	<?
	$listBanner = getArray(' SELECT * FROM banners WHERE ban_type = 15 AND ban_active = 1 AND lang_id=' . $lang_id );
	?>
	<div id="cty_thanhvien" class="scroller_roll" style="padding-top:20px; padding-bottom:20px;">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>
				<?
				foreach($listBanner as $i=>$row){
				?>
					<div style="float:left ;display:none; padding:15px;" id="leftrightslide_<?=$i?>">
						<a  href="<?=$row["ban_url"]?>" target="<?=$row["ban_target"]?>"><img alt="<?=removeHTML($row['ban_name'])?>" src="/banners/<?=$row["ban_picture"]?>" height="50" style="border:0px solid #CCCCCC; margin-right: 25px;" /></a>
					</div>
				<?
				}
				?>
				<script type="text/javascript">
				var sliderwidth='960px';
				var sliderheight="50px";
				var slidespeed=1;
				slidebgcolor="";
				
				var leftrightslide=new Array();
				var finalslide='';
				<?
				foreach($listBanner as $i=>$row){
				?>
				leftrightslide[<?=$i-1?>]=document.getElementById("leftrightslide_<?=$i?>").innerHTML;
				<?
				}
				?>
				var imagegap="&nbsp;&nbsp;&nbsp;";
				var slideshowgap=20;
				</script>
				<script language="javascript" src="/banners/scrollimage.js"></script>
			</td>
		</tr>
	</table>
	<div class="clear"></div>
	</div>
</div>
<div class="x_bottom"><div>&nbsp;</div></div>

<?
/*<br clear="all">
<div class="x_top"><div>&nbsp;</div></div>
<div class="x_center">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td width="310" style="padding-left:7px;" valign="top">
					<div class="khu_top"><div>&nbsp;</div></div>
					<div class="khu_center" style="height:90px;">
						<? include("inc_visited.php");?>
					</div>
					<div class="khu_bottom"><div>&nbsp;</div></div>
				</td>
				<td width="10">&nbsp;</td>
				<td style="padding-right:7px;" valign="top">
					<div class="khu_top"><div>&nbsp;</div></div>
					<div class="khu_center" style="height:90px; overflow:hidden">
						<table cellpadding="0" cellspacing="0">
							<tr>							
						<?
						$db_banner = new db_query("SELECT * FROM banners WHERE ban_type = 11 AND ban_active = 1 AND lang_id=" . $lang_id . "");
						while($row=mysql_fetch_array($db_banner->result)){
							echo '<td>';
							showBanner($row["ban_picture"],$row["ban_name"],$row["ban_id"]);
							echo '</td>';
						}
						?>		
							</tr>
						</table>
					</div>
					<div class="khu_bottom"><div>&nbsp;</div></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="x_bottom"><div>&nbsp;</div></div>*/
?>
