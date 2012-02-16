<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0032)http://www11.dantri.com.vn/news/ -->
<HTML xmlns:st1 = "urn:schemas-microsoft-com:office:smarttags">
<head>
<title>.....:: INNOTECH ::.....</title>
<META http-equiv=content-type content=text/html;charset=UTF-8>
<META id=refresher http-equiv=REFRESH content=5400>
<META content=INDEX,FOLLOW name=robots>
<META content="MSHTML 6.00.5730.11" name=GENERATOR>
</head>
<script language="javascript" src="js/Function.js"></script>
<script language="javascript" src="js/mm_menu.js"></script>
<LINK href="css/Global.css" type=text/css rel=stylesheet>
<link type="text/css" rel="stylesheet" href="css/style.css" />
<body>
<table width="194" border="0" cellpadding="0" cellspacing="0" bgcolor="#336699">
  <!--DWLayoutTable-->
  <tr align="left">
    <td width="194" height="20" valign="middle" background="images/bg_menu.gif" class="style_menu_left_text_link"><a href="index.php" class="style_menu_left_text_link">&nbsp;&nbsp;&nbsp;&nbsp;Trang chủ</a> </td>
  </tr>
  
  <tr height="1" bgcolor="#FFFFFF">
	 <td width="194"></td>
  </tr>  
  
  <tr>
    <td valign="top">
	<!-- Xu li Menu 2 cap dong -->
		
		<table border="0" cellSpacing=0 cellPadding=0>	
		{section name=i loop=$rmn1}
		<tr class=Category onMouseOver="Javascript:changeto(this,'CategoryHover');" onclick=JavaScript:dropCategory(mn{$rmn1[i].mn_id}); onMouseOut="Javascript:changeto(this,'Category')" align="left" height="25" >
		   {if (checkMenucha($rmn1[i].mn_id))}
			<td width="194" background="images/bg_menu.gif" class="style_menu_left_text_link">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$rmn1[i].mn_name}</td> <!-- sua bg menu     -->
		   {else}
			<td width="194" background="images/bg_menu.gif"><a href="about.php?newsn={$rmn1[i].mn_name}&news_cat=mn{$rmn1[i].mn_id}" class="style_menu_left_text_link">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$rmn1[i].mn_name}</a></td>	   	
			{/if}		</tr>
		
		<tr class=off id=mn{$rmn1[i].mn_id}>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" >
				 {section name=j loop=$rmn2} 
		  			{if $rmn2[j].mn_id eq $rmn1[i].mn_id}
					<tr align="left" class=SubCategory 
                    onmouseover="JavaScript:changeto(this,'SubCategoryHover')" onMouseOut="JavaScript:changeto(this,'SubCategory')">
						<td height="18" background="images/bg_menu.gif" class="menucon"><a href="about.php?newsn={$rmn2[j].submn_name}&news_cat=submn{$rmn2[j].submn_id}" class="submnLink">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$rmn2[j].submn_name}</a></td>  <!--   sua bg submenu-->
					</tr>
					<tr height="1" bgcolor="#FFFFFF">
						<td width="100%"></td>
					</tr>
				{/if}
			   {/section}	
				</table>			</td>
		</tr>
			
	{/section}	
		<tr>
            <td>            </td>				
		</tr>		
	</table>	</td>
  </tr>
 </table>
</body>
</html>
