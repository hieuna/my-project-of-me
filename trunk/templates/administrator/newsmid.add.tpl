<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>...:: NEW MID ADD ::...</title>
	<link href="../administrator/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style.css">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	{literal}
     <script language="javascript1.2" src="vietuni.js" type="text/javascript"></script>
    {/literal}
	{literal}
	 <script language="javascript">	  
	  function check() {
	   var v=document.frmReg;
	   if (v.newMid_title.value == "")
	    {
		  alert("Xin vui lòng nhập tên tiêu đề tin tức !");
		  v.newMid_title.focus();
		  return false;
		}
	   if (v.newMid_sums.value=="")	   
	    {
		  alert("Xin vui lòng nhập tóm tắt của tin tức !");
		  v.newMid_sums.focus();
		  return false;
		}	
		if (v.newMid_order.value=="")	   
	    {
		  alert("Xin vui lòng nhập thứ tự của tin tức này!");
		  v.newMid_order.focus();
		  return false;
		}
		if (isNaN(v.newMid_order.value))	   
	    {
		  alert("Xin vui lòng nhập số!");
		  v.newMid_order.focus();
		  return false;
		}	 
	   return true;
	  }
	  
	 
	 </script>
	{/literal}
</head>

<body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#ffffff">

<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
	<td width="50%" background="images/bg.gif"><img src="images/px1.gif" width="1" height="1" alt="" border="0"></td>
	<td valign="bottom" background="">&nbsp;</td>
	<td>
 {php}include"top.php";{/php}
 <table cellpadding="2" cellspacing="0" border="0" width="100%">
   <tr>
    <td width="130">&nbsp;</td>
	<td width="520">
	 <table cellspacing=0 cellpadding=3 width="520" border=0 align="center">
	  <tbody>
	  <tr>
	   <td><form action="" name="frmReg" id="frmReg" method="post" enctype="multipart/form-data">
	      <table cellpadding="5" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="470">	 
	   <tr>
	     <td class="textsearchjob" align="left" colspan="2"><span class="stlTitle"><img src="../images/button/impressions.png" width="48" height="48" vspace="5" align="absmiddle">THÊM MỚI TIN TỨC Ở GIỮA <img src="../images/button/impressions.png" width="600" height="1"></span></td>
	     </tr>
	   <tr>
	    <td class="textsearchjob" colspan="2" align="center"><span class="stlTitle">Kiểu gõ                  
			      <input name="optChoose" type="radio" id="optChoose" value="0" onFocus="setTypingMode(0)" checked>Off
                  <input name="optChoose" type="radio" id="optChoose" value="1" onFocus="setTypingMode(1)">Telex
                  <input name="optChoose" type="radio" id="optChoose" value="2" onFocus="setTypingMode(2)">VNI
                  <input name="optChoose" type="radio" id="optChoose" value="3" onFocus="setTypingMode(3)">VIQR			   </span></td>
	   </tr>	   
		
	    <td width="30%" class="stlTitle">Tiêu đề tin tức</td>
	    <td>
			<input name="newMid_title" type="text" class="textbox" id="newMid_title" style="width:250px" size="70" >		
		 </td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Tóm tắt nội dung<font color="#FF0000"></font> </td>
	    <td>
			<textarea name="newMid_sums" id="newMid_sums" cols="35" rows="5">
			</textarea>
			</td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Ảnh minh họa<font color="#FF0000"></font> </td>
	    <td>
			<input type="file" name="file" id="file" size="25">
		</td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Chi tiết tin tức</td>
	    <td>{$newMid_details}</td>		
	   </tr>	 
	   
	   <tr>
	    <td width="30%" class="stlTitle">
                         Tình tr&#7841;ng   </td>
	    <td><select name="newMid_status" size="1" id="newMid_status">
                              <option value="1">Hiển thị</option>
                              <option value="0">Khóa</option>
                            </select></td>
				
	   </tr>	 
	   <tr>
	    <td width="30%" class="stlTitle">
                         Thứ tự   </td>
	    <td><input name="newMid_order" type="text" class="textbox" id="newMid_order" size="10" ></td>
				
	   </tr>	   
	   <tr>
	    <td class="stlTitle">&nbsp;</td>
		<td><input type="submit" name="register" id="register" value="Chấp nhận" onClick="return check();">
		&nbsp;<input type="reset" name="reset" value="Làm lại">&nbsp;
		<input type="hidden" name="addnewMid" value="addnewMid" id="addnewMid"></td>
	   </tr>	  
    </table>
	   </form>		
	   </td>	  
	  </tr>	  
	  </tbody>
	 </table>
	</td>
	<td width="130">&nbsp;</td>
   </tr>
  </table>
 {php}include"foot.php";{/php}
	</td>
	<td valign="bottom" background="images/bg_right.gif">&nbsp;</td>
	<td width="50%" background="images/bg.gif"><img src="images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
</table>

</body>
</html>