<?
function div_top($path="frame",$border="3px"){
?>
	<div style="background:url(/design_template/<?=$path?>/7.gif); background-position:left; padding-left:<?=$border?>;"><div style="background:url(/design_template/<?=$path?>/9.gif); background-position:right; padding-right:<?=$border?>;"><div  style="background:url(/design_template/<?=$path?>/8.gif);"><img src="/design_template/<?=$path?>/8.gif" border="0" /></div></div></div>
	<div style="background:url(/design_template/<?=$path?>/4.gif); background-repeat:repeat-y; padding-left:<?=$border?>;"><div style="background:url(/design_template/<?=$path?>/6.gif); background-repeat:repeat-y; background-position:right; padding-right:<?=$border?>;">
		<div><?
}
?>
<?
function div_bottom($path="frame",$border="3px"){
	?></div>
	</div></div>
	<div style="background:url(/design_template/<?=$path?>/1.gif); background-position:left; padding-left:<?=$border?>;"><div style="background:url(/design_template/<?=$path?>/3.gif); background-position:right; padding-right:<?=$border?>;"><div  style="background:url(/design_template/<?=$path?>/2.gif);"><img src="/design_template/<?=$path?>/2.gif" border="0" /></div></div></div>
<?
}
function showBanner($filename='',$title='',$url='',$width=0,$height=0,$path='/banners/'){
	$url = '/vn/banner_click.php?iBan=' . $url;
	$imgpath = '..' . $path . $filename;
	if(getExtension($filename)=='swf'){
		$flash_size=@getimagesize($imgpath);
		if(isset($flash_size[0])){
		?><div align="center"><div style="padding-bottom:5px; width:<?=$width?>px; overflow:hidden">
					<a href="<?=$url?>" target="_blank"><img src="/images/transperency.png" border="0" width="<?=$width?>" height="<?=$flash_size[1]?>" style="position:absolute" /></a>
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
			<div align="center"><div <? if($width!=0){?>style="padding-bottom:5px; width:<?=$width?>px; overflow:hidden" <? }?>><a href="<?=$url?>" target="_blank"><img src="<?=$path?><?=$filename?>" <? if($height!=0) {?>height="<?=$height?>"<? }?> <? if($width!=0) {?>width="<?=$width?>"<? }?> alt="<?=htmlspecialchars($title)?>" border="0"></a></div></div>
		<?
	}
}
function tooltip($title='',$img='pro_name',$content='',$price=0,$khuyenmai='Tặng áo sơ mi',$currency='VNĐ'){
	$strreturn = '<div class="tool_bold">' . $img . '</div>';
	$strreturn .= '<div class="tooltip">Giá: <font style="color:#ff0000">' . formatNumber($img) . '</font> ' . $currency . '</div>';
	if($khuyenmai != ''){
		$strreturn .= '<div class="tool_bold2">' . mb_strtoupper(translate_display_text("khuyen_mai"),"UTF-8") . '</div>';
		$strreturn .= '<div class="tooltip">' . $khuyenmai . '</div>';
	}
	$strreturn .= '<div class="tool_bold2">' . mb_strtoupper(translate_display_text("tinh_nang_noi_bat"),"UTF-8") . '</div>';
	$strreturn .= '<div class="tooltip">' . $content . '</div>';
	$strreturn .= '<div><img src="/images/tool_3.gif" border=0></div>';
	 $strreturn	= str_replace("'","",$strreturn);
	 $strreturn	= str_replace('"','&quot;',$strreturn);
	 $strreturn	= str_replace(chr(13),"<br>",trim($strreturn));
	return $strreturn;
}
function sao($require=1){
	if($require == 1){
		return '<font color="#FF0000">*</font>';
	}else{
		return '';
	}
}

?>