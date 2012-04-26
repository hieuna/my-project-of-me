<table cellpadding="0" cellspacing="0" align="left" width="100%" style="margin-top:8px;">
	<tr>
		<td>
			<?
			$db_banner = new db_query("SELECT * FROM banners WHERE ban_type = 10 AND ban_active = 1 AND lang_id=" . $lang_id . " ORDER BY RAND() LIMIT 1");
			if($row=mysql_fetch_array($db_banner->result)){
				showBanner($row["ban_picture"],$row["ban_name"],$row["ban_id"],758);
			}
			?>		
		</td>
		<td>&nbsp;</td>
		<td background="/images/db_support.jpg" style="background-position:center; background-repeat:no-repeat" width="240">
			<div align="center">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td><img src="/images/hotro.gif" border="0" /></td>
					<td>
                    <style type="text/css">
						#support_ol
						{
							position:relative;
						}
						#support_ol:hover ul
						{
							display:block;
						}
						#support_ol ul
						{
							position:absolute;
							left:0;
							bottom:-1;
							margin:0; padding:0;
							display:none;
						}
						#support_ol ul li
						{
							border:1px solid #F27400;
							width:110px;
							padding:3px 7px;
							background-color:#FFF;
						}
						#support_ol ul li:hover
						{
							background:#C00
						}
						#support_ol ul li a
						{
							font-weight:normal;
							color:#C00;
							display:block;
						}
						#support_ol ul li a:hover
						{
							color:#FFF;
						}

					</style>
                    	<div id="support_ol">
                        	<img src="/images/hotro_1_<?=$lang_id?>.gif" style="cursor:pointer" border="0" />
                            <?
								$arraySupportOnline = array();
								$arraySupportOnline = explode(";", $con_support_online);
								echo '<ul>';
								for($i=0; $i<count($arraySupportOnline); $i++){
									$support = explode(",", $arraySupportOnline[$i]);
									$name		= '';
									$yahoo	= '';
									$skype	= '';
									if(isset($support[0])) $name		= trim($support[0]);
									if(isset($support[1])) $yahoo		= trim($support[1]);
									if(isset($support[2])) $skype		= trim($support[2]);
									
									?>
									<? if($yahoo != ""){ ?><li><a href="ymsgr:sendIM?<?=$yahoo?>"><img src="http://opi.yahoo.com/online?u=<?=$yahoo?>" border=0 align="absmiddle" /> <?=str_replace("'","\'",$name)?></a></li><? }?>
									<? if($skype != ""){ ?><li><a href="skype:<?=$skype?>?call"><img align="absmiddle" border="0" src="/images/07.png"/> <?=str_replace("'","\'",$name)?></a></li><? }?>
									<?
									
								}
								echo '</ul>';
							?>
                        </div>
					</td>
				</tr>
			</table>
			
			</div>
			<div align="center"><a href="<?=$lang_path?>showcart.php"><img src="/images/giohang_<?=$lang_id?>.gif" border="0" /></a></div>
			<div align="center"><img src="/images/timkiem_<?=$lang_id?>.gif" border="0" onclick="showhidden('div_search');" style="cursor:pointer" /></div>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding:3px;">
			<div id="div_search" style="display:none">
				<? include("inc_form_search2.php");?>
			</div>
		</td>
	</tr>
</table>
