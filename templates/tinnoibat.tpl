<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>New Page 1</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
	<div align="center">
	<table border="0" width="194" id="table1" cellspacing="0" cellpadding="0">
		<tr>
			<td>
			<img border="0" src="images/tinnoibat_title.gif" width="194" height="26"></td>
		</tr>
		<tr>
			<td height="210" background="images/bg_tinnoibat.gif">
					<marquee width="94%" behavior="scroll" direction="up" height="180" scrollamount="1"scrolldelay="50" onmouseover='this.stop()' onmouseout='this.start()'>
					<table border="0">
					{section name=t loop=$rmid}				
						<tr>
						<TD><IMG SRC="Images/In Box_ico_1.bmp"/></TD>
						<td valign="top" class="style_tinnoibat_text_link">
						<a href="newsdetails.php?news_cat={$rmid[t].news_cat}&news_id={$rmid[t].news_id}" class="style_tinnoibat_text_link">{$rmid[t].news_title}</a>														
						</td>						
						</tr>
						{/section}	
					</table>
					</marquee>
			</td>
		</tr>
	</table>
	</div>
</body>
</html>