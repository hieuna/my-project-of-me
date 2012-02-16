<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
<link rel="stylesheet" href="..css/style.css" type="text/css">

</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/hanghoa_dichvu_title_a.jpg')">

<div align="center">
	<table border="0" width="192" id="table1" cellspacing="0" cellpadding="0">
		<tr>
			<td><a href="newmidDetail.php?newmid_id={$rmid[0].newMid_id}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image4','','images/hanghoa_dichvu_title.jpg',1)"><img src="images/hanghoa_dichvu_title_a.jpg" name="Image4" width="192" height="121" border="0"></a></td>
		</tr>
		<tr>
			<td background="images/hanghoa_dichvu_bg.jpg" height="86" valign="top">
			<div align="center">
				 <table border="0" width="90%" id="table3" cellspacing="0" cellpadding="0" height="67">
					<tr>
						<td valign="top" height="5"></td>
					</tr>
					<tr>
						<td valign="top" class="style_box_text">{$rmid[0].newMid_sums|truncate:150}</td>
					</tr>
				</table>
			</div>
			</td>
		</tr>
		<tr>
			<td height="17" bgcolor="#97B3D4">
			<table border="0" width="192" id="table2" cellspacing="0" cellpadding="0" height="17">
				<tr>
					<td width="16">
					<img border="0" src="images/hanghoa_dichvu_icon1.gif" width="16" height="17"></td>
					<td width="160" class="style_detail_text_link" align="right">	<a href="newmidDetail.php?newmid_id={$rmid[0].newMid_id}" class="style_detail_text_link"> {$rmid[0].newMid_title|truncate:20}</a></td>
					<td width="16">
					<img border="0" src="images/hanghoa_dichvu_icon2.gif" width="16" height="17"></td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>
			<img border="0" src="images/hanghoa_dichvu_bottom.jpg" width="192" height="10"></td>
		</tr>
  </table>
</div>

</body>

</html>
