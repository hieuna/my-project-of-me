<div class="t_top"><div><?=translate_display_text("thoi_tiet_gia_vang")?></div></div>
<div class="t_center">
<div id="id_div_thoi_tiet"></div>
<script language=javascript src="http://www.vnexpress.net/Service/Forex_Content.js"></script>
<script language="javascript">
	var forexstr = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#F2F2F2" style="border-top:3px #FFFFFF solid; border-bottom:3px #FFFFFF solid;">';
	forexstr +=	'<tr><td height="23" class="textBold" style="padding-left:20px;">';
	forexstr	+=	'<?=translate_display_text("ty_gia");?>';
	forexstr +=	'</td></tr></table>';
	forexstr += '<table border="1" width="100%" cellspacing="0" cellpadding="2" style="border-collapse:collapse" bordercolor="#f8f8f8" align="center">';
	for (i=0;i<vForexs.length;i++){
		if(vForexs[i]=='USD' || vForexs[i]=='EUR' || vForexs[i]=='GBP'){
			try { 
				forexstr+='<tr><td class="text">&nbsp;' + vForexs[i] + '</td><td align="right" class="text">' + vCosts[i] + '&nbsp;</td></tr>';
			} 
			catch(er) {
			} 
		}
	}
	forexstr+='</table>';
	document.write(forexstr);
</script>

</div>
<div class="t_bottom"><div>&nbsp;</div></div>
