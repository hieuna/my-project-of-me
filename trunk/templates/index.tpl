<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0032)http://www11.dantri.com.vn/news/ -->
<link type="text/css" rel="stylesheet" href="..css/style.css" />
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
    <td width="152" height="564" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      
      <!--DWLayoutTable-->
      <tr>
        <td width="476" height="564" valign="top">
			<table width="100%" height="565" border="0" cellpadding="0" cellspacing="0">
				
				<tr>
					<td valign="top">
					<table width="100%" cellspacing="2" style="border-collapse: collapse" >						
						<tr>
							<td width="192" height="40">
								{php}include"hanghoa_dichvu.php";{/php}	</td>
							
							<td width="192">
								{php}include"sohuu_tritue.php";{/php}</td>
							
							<td width="192">
								{php}include"dautu.php";{/php}</td>
							<td width="1">&nbsp; &nbsp;</td>
						</tr>	
						<tr>
						  <td colspan="5"><img src="images/thungo_title.gif"/></td>
					  </tr>
						<tr>
							<td><img src="images/thungo_image.jpg"/></td>
							<td colspan="4" align="left" class="style_thungo_text" valign="top">{$rp[0].re_sum}</td>
						</tr>
						<tr>
							<td colspan="4" align="left"  valign="top" background="images/demoNoText_30_r1_c2.gif"><div align="right"><a href="chitiet.php" class="Other"><img src="images/image_detail.gif"/></a></div></td>
						</tr>
						<tr>
							<td colspan="4" height="27">
							<table border="0" width="100%" id="table5" cellspacing="0" cellpadding="0">
								<tr>
									<td width="199" valign="top">
										{php}include"gioithieusanpham.php";{/php}
									</td>
									<td width="6">&nbsp;</td>
									<td width="379">
										{php}include"gioithieucongnghe.php";{/php}
									</td>
								</tr>
							</table>
							
							</td>
						</tr>																		
					</table>
					</td>				
				</tr>
				{section name=t loop=$rN}				
				{/section}								
				<tr>
					<td height="50"></td>
				</tr>							
			</table>
		</td>		
        </tr>
    </table></td>
    <td width="150" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="150" height="564" valign="top">{php}include"right.php";{/php}</td>
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
