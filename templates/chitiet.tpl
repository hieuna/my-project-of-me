<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0032)http://www11.dantri.com.vn/news/ -->
<link type="text/css" rel="stylesheet" href="css/style.css" />
<HTML xmlns:st1 = "urn:schemas-microsoft-com:office:smarttags">
<head>
<title>.....:: INNOTECH ::.....</title>
<META http-equiv=content-type content=text/html;charset=UTF-8>
<META id=refresher http-equiv=REFRESH content=5400>
<META content=INDEX,FOLLOW name=robots>
<META content="MSHTML 6.00.5730.11" name=GENERATOR>
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
    <td width="194" height="564" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="194" height="564" valign="top">{php}include"menu_about.php";{/php}</td>
        </tr>
    </table></td>
    <td width="590" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="590" height="564" valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr align="left">   
					
				</tr>
				<tr>
					<td valign="top">
					<table width="100%"  cellspacing="2" style="border-collapse: collapse" >						
						<tr>
							
							<td colspan="4" align="left" class="NormalCon" valign="top">					{$rp[0].re_content}
							
							</td>
							
						</tr>
						<tr>							
							<td colspan="4" align="right" class="NormalCon" valign="top">
							<A class=Time 
                        href="javascript:history.go(-1)">[<B>Trở 
                    về</B>]</A>&nbsp;							
							</td>
							
						</tr>
																		
						<tr>
							
							<td  colspan="4" valign="top">
								{php}include"middle.php";{/php}
							</td>
							
						</tr>
						<tr>
							
							<td colspan="4" height="50"></td>
							
						</tr>																		
					</table>
					</td>				
				</tr>
				
				<tr>
					
					<td valign="top" colspan="3" class="newssame">&nbsp;&nbsp;&nbsp;Các tin khác :										
					</td>
					
				</tr>
				{section name=t loop=$rN}				
				<tr>
					
					<td valign="top">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;•&nbsp;&nbsp;&nbsp;&nbsp;<a href="newsdetails.php?news_cat={$rN[t].news_cat}&news_id={$rN[t].news_id}" class="Other">{$rN[t].news_title}({$rN[t].news_date})</a>														
					</td>						
				</tr>
				{/section}	
				
				
				<tr>
					<td height="50"></td>
				</tr>							
			</table>
		</td>		
        </tr>
    </table></td>
    <td width="0" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="0" height="564" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
      </tr>
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
