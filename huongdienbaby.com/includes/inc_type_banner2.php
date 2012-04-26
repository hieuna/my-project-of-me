<? ?>				
	<?
	$width = $con_page_size-$con_left_size-9;
	require_once("../functions/file_functions.php");
	$db_banner = new db_query("SELECT cat_name,cat_picture
							 FROM categories_multi 
							 WHERE cat_picture <> '' AND cat_id = " . $iCat . " LIMIT 1");
							 
	if($row=mysql_fetch_array($db_banner->result)){
		div_top();
		$filename 	= $row["cat_picture"];
		$path	  	= "../channel_category/";
		$title		= $row["cat_name"];
		if(getExtension($filename)=='swf'){
			$flash_size=@getimagesize($imgpath);
			if(isset($flash_size[0])){
			?><div align="center"><div style="width:<?=$width?>px; overflow:hidden">
						<script src="/js/AC_RunActiveContent.js" type="text/javascript"></script>
						<script type="text/javascript">AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','<?=$flash_size[0]?>','height','<?=$flash_size[1]?>','src','<?=$path?><?=substr($filename, 0, strrpos($filename, "."))?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','<?=$path?><?=substr($filename, 0, strrpos($filename, "."))?>','wmode','transparent','','' );</script><noscript>
						<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" <?=$flash_size[3]?>>
						  <param name="movie" value="<?=$path?><?=$filename?>">
						  <param name="quality" value="high">
						  <embed src="<?=$path?><?=$filename?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" <?=$flash_size[3]?>></embed>
						 </object>
						</noscript></div></div><?
			}
		}else{	
			?>
				<div align="center"><div <? if($width!=0){?>style="width:<?=$width?>px; overflow:hidden" <? }?>><img src="<?=$path?><?=$filename?>" <? if($width!=0) {?>width="<?=$width?>"<? }?> alt="<?=htmlspecialchars($title)?>" border="0"></div></div>
			<?
		}
		div_bottom();
	}
	?>
<? ?>	
