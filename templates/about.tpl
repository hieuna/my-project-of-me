<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0032)http://www11.dantri.com.vn/news/ -->
<HTML xmlns:st1 = "urn:schemas-microsoft-com:office:smarttags">
<head>
<title>.....:: INNOTECH ::.....</title>
<META http-equiv=content-type content=text/html;charset=UTF-8>
<META id=refresher http-equiv=REFRESH content=5400>
<META content=INDEX,FOLLOW name=robots>
<META content="MSHTML 6.00.5730.11" name=GENERATOR>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript" src="js/Function.js"></script>
<link type="text/css" rel="stylesheet" href="css/style.css" />
<body>
<DIV id=divAdLeft 
style="LEFT: -100px; WIDTH: 100px; POSITION: absolute; TOP: 71px"><A 
href="http:// www.innotech.com.vn" target="_blank">
<IMG height=170 alt="" src="images/trai1.gif" width=100 border=0>
</A>
<A 
href="http:// www.innotech.com.vn" target="_blank">
<IMG height=225 alt="" src="images/trai2.gif" width=100 border=0>
</A>
</DIV>
<DIV id=divAdRight 
style="LEFT: -100px; WIDTH: 100px; POSITION: absolute; TOP: 71px"> <A href="http:// www.innotech.com.vn" target="_blank">
<IMG height=180 src="images/phai2.gif" width=100 border=0></A>
<A href="http:// www.innotech.com.vn" target="_blank">
<IMG height=180 src="images/phai3.gif" width=100 border=0></A>
</DIV>
<SCRIPT language=JavaScript src="js/ads.js" type="text/javascript"></SCRIPT>
<div align="center">
<table width="780" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="136" colspan="3" valign="top">{php}include"top.php";{/php}</td>
  </tr>
  <tr>
    <td width="194" height="564" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CFD8E2">
      <!--DWLayoutTable-->
      <tr>
        <td width="194" height="564" valign="top">{php}include"menu_about.php";{/php}</td>
        </tr>
    </table></td>
    <td width="590" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="99%" height="585" valign="top">
			<table width="590" height="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#990099">
				
				<tr>
					<td valign="top" width="590">
						<table border="0" cellpadding="0" cellspacing="3" width="100%">
						<tr>
						<td colspan="2"> {section name=i loop=$rc} 
						</td>
						</tr>
						
							<tr>
								
								<td colspan="2"><a href="newsdetails.php?news_cat={$rc[i].news_cat}&news_id={$rc[i].news_id}" class="style_title_text_default"> {$rc[i].news_title}</a></td>
							</tr>
							<tr>
								
								<td width="30%" valign="top">
								<a href="newsdetails.php?news_cat={$rc[i].news_cat}&news_id={$rc[i].news_id}">
								<img src="{$rc[i].news_img}" border="0" width="130" height="70">
								</a>
								</td>
								<td align="left" valign="top" class="style/style_thunggo">{$rc[i].news_sums|truncate:150}</td>
							</tr>
							<tr align="center">
								<td colspan="3">
									<hr width="80%" size="1" color="#666666">
								</td>
							</tr>
							{/section}
							<tr>
								
								<td colspan="2" align="right"><A class=Time 
                        href="javascript:history.go(-1)">[<B>Trở 
                    về</B>]</A>&nbsp;</td>
							</tr>
							<tr>
								
								<td colspan="2" class="newssame">
									Các tin khác :
								</td>
							</tr>
							{section name=t loop=$rk}
								<tr>
									
									<td colspan="2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;&nbsp;<a href="newsdetails.php?news_cat={$rk[t].news_cat}&news_id={$rk[t].news_id}" class="Other">{$rk[t].news_title}({$rk[t].news_date})</a>
									</td>
								</tr>
							{/section}
							<tr>
								<td colspan="2" height="50"></td>
							</tr>
					  </table>
					</td>
				</tr>				
				<tr>
					<td  colspan="3" height="100">
						
					</td>
				</tr>
			</table>
		</td>
        </tr>
    </table></td>
    <td width="0" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      </table>
    </td>
  </tr>  
  <tr>
    <td colspan="3" valign="top">{php}include"foot.php";{/php}</td>
  </tr>
</table>
</div>
</body>
</html>
