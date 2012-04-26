<table cellpadding="0" cellspacing="0" width="100%" background="/images/bg_header.jpg">
	<tr>
		<? 
		$order=getValue("order","str","COOKIE","");
		$count_order=explode("|",$order);
		?>
		<td>
		<?
		$db_banner = new db_query("SELECT * FROM banners WHERE ban_type = 5 AND ban_active = 1 AND lang_id=" . $lang_id . " LIMIT 1");
		while($row=mysql_fetch_array($db_banner->result)){
			showBanner($row["ban_picture"],$row["ban_name"],$row["ban_id"],658);
		}
		?>		
		</td>
		<td width="307" background="/images/bg_banner.jpg" valign="bottom" style="padding:5px;">
			<div style="padding:4px;"><a href="<?=$lang_path?>showcart.php"><strong style="color:#003366"><?=translate_display_text("gio_hang")?> : <font color="#FF0000"><?=intval(count($count_order)/3)?></font> <?=translate_display_text("san_pham")?></strong> <img src="/images/cart2.gif" border="0" align="absmiddle" /> </a></div>
			<table cellpadding="4" width="100%" cellspacing="0">
				<tr>
					<td>
						<strong style="color:#003366"><?=translate_display_text("hotline")?> :</strong> <font color="#FF0000"><?=translate_display_text("so_dien_thoai_hotline")?></font> &nbsp;&nbsp;
					</td>
					<td>
						<script type="text/javascript" language="JavaScript1.2" src="/js/menu.js"></script>
						<script type="text/javascript" language="JavaScript1.2">
							showmenu('<?=translate_display_text("ho_tro_truc_tuyen")?>&nbsp;<img src="/images/yahoo.gif" border="0" align="absmiddle" />','#',1);
								<?
								$arrayNick = array();
								$arraySupportOnline = explode(";", $con_support_online);
								for($i=0; $i<count($arraySupportOnline); $i++){
									$support = explode(",", $arraySupportOnline[$i]);
									$name		= '';
									$yahoo	= '';
									$skype	= '';
									if(isset($support[0])) $name		= trim($support[0]);
									if(isset($support[1])) $yahoo		= trim($support[1]);
									if(isset($support[2])) $skype		= trim($support[2]);
									?>
									<? if($yahoo != ""){?>showmenu('<img src="http://opi.yahoo.com/online?u=<?=$yahoo?>" border=0 align="absmiddle" /> <?=str_replace("'","\'",$name)?>','ymsgr:sendIM?<?=$yahoo?>',2);<? }?>
									<? if($skype != ""){?>showmenu('<img align="absmiddle" border="0" src="/images/07.png"/> <?=str_replace("'","\'",$name)?>','skype:<?=$skype?>?call',2);<? }?>
									<?
								}//End for($i=0; $i<count($arraySupportOnline); $i++)
								?>
								closemenu();
						  </script>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>