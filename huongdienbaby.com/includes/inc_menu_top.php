<?
$db_menu=new db_query("SELECT * FROM menus_multi WHERE mnu_parent_id=0 AND mnu_position=1 ORDER BY mnu_order ASC");
$total_record=mysql_num_rows($db_menu->result);
?>
<table cellpadding="0" cellspacing="0" width="100%" border="0">
	<tr>
		<td>
			<div class="div_tab_top" id="div_tab" style="clear:right">
				<ul>
					<?
					$i=0;
					$arrayImnu = array();
					$arraySpace = array();
					$menu_id = getValue("menu_id","int","COOKIE",1);
					$url = getURL();
					
					//echo $url;
					while($row=mysql_fetch_array($db_menu->result)){
					$arrayImnu[] = $row["mnu_id"];
					$arraySpace[] = intval($row["mnu_space"]);
					$i++;
					if(trim($row["mnu_check"])!=''){
						if(strpos($url,trim($row["mnu_check"]))!==false) $menu_id=$i;
					}
					?>
					 <li id="tab_<?=$i?>" onclick="changtab(<?=$i?>,<?=$total_record?>)" onmouseover="changtab(<?=$i?>,<?=$total_record?>,1)" onmouseout="mouseout(<?=$menu_id?>,<?=$total_record?>)" class="tab_nomal"><a href="<?=$row["mnu_link"]?>" onclick="document.cookie='menu_id='+<?=$i?>;"><span><?=$row["mnu_name"]?></span></a></li>
					<?
					}
					?>
				</ul>
			</div>
		</td>
	</tr>
	<tr>
		<td><div class="tab_content" id="tab_content"><div id="tab_content_a"></div></div>
			<?
			for($i=0;$i<count($arrayImnu);$i++){
			?>
				<div id="content_<?=$i+1?>" style="display:none;" class="tab_content">
				<?
					$db_menusub=new db_query("SELECT * FROM menus_multi WHERE mnu_parent_id=" . intval($arrayImnu[$i]) . " ORDER BY mnu_order ASC");
					?>
						<ul style="margin-left:<?=$arraySpace[$i]?>px;">
							<?
							$j=0;
							while($rows=mysql_fetch_array($db_menusub->result)){
							$j++;
							?>
								<li><a href="<?=$rows["mnu_link"]?>"><span><?=$rows["mnu_name"]?></span></a><? if($j<mysql_num_rows($db_menusub->result)) echo " &nbsp;|&nbsp;";?></li>
							<?
							}
							?>
						</ul>
					<?
					unset($db_menusub);
				?>
				</div>
			<?
			}
			?>
		</td>
	</tr>
</table>
<?=($menu_id!=0) ? '<script>changtab(' . $menu_id . ',' . $total_record .')</script>' : '' ?>
