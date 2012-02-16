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
<table width="152" border="0" cellpadding="0" cellspacing="0"  bgcolor="#D9E3F7">
  <!--DWLayoutTable-->
  <tr align="left">
    <td width="152" height="20" valign="middle" background="images/demoNoText_11.gif" class="trangchu"><a href="index.php" class="linkHomepage">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Trang chủ</a> </td>
  </tr>
  
  <tr height="1" bgcolor="#FFFFFF">
	 <td width="100%"></td>
  </tr>  
  
  <tr>
    <td valign="top">
	<!-- Xu li Menu 2 cap dong -->
		
		<table border="0" cellSpacing=0 cellPadding=0>	
		{section name=i loop=$rmn1}
		<tr class=Category onMouseOver="Javascript:changeto(this,'CategoryHover');" onclick=JavaScript:dropCategory(mn{$rmn1[i].mn_id}); onMouseOut="Javascript:changeto(this,'Category')" align="left" height="25" >
		   {if (checkMenucha($rmn1[i].mn_id))}
			<td width="152" background="images/demoNoText_.gif" class="trangchu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$rmn1[i].mn_name}</td> <!-- sua bg menu     -->
		   {else}
			<td width="152" background="images/demoNoText_.gif" ><a href="newscatagory.php?newsn={$rmn1[i].mn_name}&news_cat=mn{$rmn1[i].mn_id}" class="linkHomepage">{$rmn1[i].mn_name}</a></td>	   	
			{/if}
		</tr>
		
		<tr class=off id=mn{$rmn1[i].mn_id}>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="100%" >
				 {section name=j loop=$rmn2} 
		  			{if $rmn2[j].mn_id eq $rmn1[i].mn_id}
					<tr align="left" class=SubCategory 
                    onmouseover="JavaScript:changeto(this,'SubCategoryHover')" onMouseOut="JavaScript:changeto(this,'SubCategory')">
						<td height="18" background="images/demoNoText_19.gif" class="menucon"><a href="newscatagory.php?newsn={$rmn2[j].submn_name}&news_cat=submn{$rmn2[j].submn_id}" class="submnLink">&nbsp;&nbsp;{$rmn2[j].submn_name}</a></td>  <!--   sua bg submenu-->
					</tr>
					<tr height="1" bgcolor="#FFFFFF">
						<td width="100%"></td>
					</tr>
				{/if}
			   {/section}	
				 		 
				</table>
			</td>
		</tr>
			
	{/section}	
		<tr>
            <td>
				<FORM name=frmTemp><INPUT type=hidden name=objdrop></FORM> 
            </td>				
			
		</tr>		
	</table>
		
	</td>
  </tr>
  <tr>
    <td height="24" align="left" valign="top" >
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
		  <!--DWLayoutTable-->
			<tr bgcolor="#D9E3F7" align="center">
			  <form name="frmSearch" method="post" action="search.php">
				<td height="24" valign="middle">
					<input type="text" name="txtSearch" value="Search..." size="12" onFocus="javascript:txtSearch.value=''" onBlur="if(this.value=='') this.value='Search...'"  class="textSearch">
					<input type="image" name="btnSearch" src="images/search1.png" align="absmiddle" >
					<input type="hidden" name="find" value="find">
			  </form>	
			</tr>
		</table>
    </td>
  </tr>
  <tr bgcolor="#CCCCCC" align="center">
    <form name="linkWeb" action="" method="post">
  		<td width="152">
			<select name="lienket" class="linkWeb" onChange="window.open(this.value)">
				<option value="">------------Liên kết------------</option>
				<option value="http://www.mpt.gov.vn">Bộ bưu chính viễn thông</option>
				<option value="http://www.na.gov.vn">Quốc hội</option>
				<option value="http://www.vusta.org.vn">Liên hiệp hội</option>
				
			</select>
		</td>
	</form>
	
  </tr>
  <tr height="1" bgcolor="#FFFFFF">
			<td width="100%"></td>
		</tr>
  <tr align="left">
  		<td background="images/checkMail.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.innotech.com.vn/webmail" class="checkmail">Check Mail</a></td>
  </tr>
		
  <tr>
    <td height="21" valign="top" background="images/demoNoText_32.gif"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  
  {section name=k loop=$radvl}   
  <tr>
    <td valign="top"><a href="{$radvl[k].adv_link}"><img src="{$radvl[k].adv_img}" title="{$radvl[k].adv_title}" border="0" width="151" /></a></td>
	<tr>
		<td height="2" width="100%" bgcolor="#666666"></td>
	</tr>
  </tr>
  {/section}  
  
  <tr>
    <td height="171" valign="top" >
	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tbl_baitieubieu" >
		  {section name=i loop=$rnews1} 
		    {if $smarty.section.i.index is odd by 1}
				<tr align="center" height="45">
					<td valign="middle" width="45" class="tbl_baitieubieu">
						<a href="newsdetails.php?news_cat={$rnews1[i].news_cat}&news_id={$rnews1[i].news_id}"><img src="{$rnews1[i].news_img}" border="0" title="{$rnews1[i].news_title}" width="45" height="45"  align="absmiddle"/></a>
					</td>
					<td width="70%" width="45" class="tbl_baitieubieu"><a href="newsdetails.php?news_cat={$rnews1[i].news_cat}&news_id={$rnews1[i].news_id}" class="TimeL" title="{$rnews1[i].news_sums}">{$rnews1[i].news_title}</a></td>			
				
				</tr>					
			{else}
				 <tr align="center" height="45" bgcolor="#F2F9FF">
				 <td valign="middle" width="45" class="tbl_baitieubieu">
						<a href="newsdetails.php?news_cat={$rnews1[i].news_cat}&news_id={$rnews1[i].news_id}"><img src="{$rnews1[i].news_img}" border="0" title="{$rnews1[i].news_title}" width="45" height="45" align="absmiddle"/></a>
						</td>
						<td width="70%" width="45" class="tbl_baitieubieu">
						<a href="newsdetails.php?news_cat={$rnews1[i].news_cat}&news_id={$rnews1[i].news_id}" class="TimeL" title="{$rnews1[i].news_sums}">{$rnews1[i].news_title}</a>						
						</td>
						
						
				</tr>
			{/if}		
		   {/section}	
		</table>
	</td>		
  </tr>  
  <tr>
  	<td class="BoxHeader">{php}include"GiaVang.php";{/php}</td>
  </tr>  
  <tr>
  	<td class="BoxHeader">{php}include"ThoiTiet.php";{/php}</td>
  </tr>  
</table>
</body>
</html>
