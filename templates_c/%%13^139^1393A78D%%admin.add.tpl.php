<?php /* Smarty version 2.6.10, created on 2012-01-10 11:29:16
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/admin.add.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>...:: ADMIN ADD ::...</title>
	<link href="../administrator/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php echo '
     <script language="javascript1.2" src="vietuni.js" type="text/javascript"></script>
    '; ?>

	<?php echo '
	 <script language="javascript">	  
	  function check() {
	   var v=document.frmReg;
	   if (v.username.value.length < 6)
	    {
		 alert("Xin vui lòng nhập tên đăng nhập. Tên đăng nhập không nhỏ hơn 6 ký tự !");
		 v.username.focus();
		 return false;
		}
	   if (v.password.value.length < 6)	   
	    {
		  alert("Xin vui lòng nhập mật khẩu đăng nhập. Mật khẩu đăng nhập không nhỏ hơn 6 ký tự !");
		  v.password.focus();
		  return false;
		}	
	  if (v.repass.value != v.password.value)
	   {
	    alert("Xin vui lòng xác nhận lại mật khẩu !");
		v.repass.focus();
		return false;
	   }	  
	   v.reg.value=\'reg\';	
	   return true;
	  }
	 </script>
	'; ?>

</head>

<body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#ffffff">

<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
	<td width="50%" background="images/bg.gif"><img src="images/px1.gif" width="1" height="1" alt="" border="0"></td>
	<td valign="bottom" background="">&nbsp;</td>
	<td>
 <?php include"top.php"; ?>
 <table cellpadding="2" cellspacing="0" border="0" width="100%">
   <tr>
    <td width="130">&nbsp;</td>
	<td width="520">
	 <table cellspacing=0 cellpadding=3 width="520" border=0 align="center">
	  <tbody>
	  <tr>
	   <td><form action="" name="frmReg" id="frmReg" method="post">
	      <table cellpadding="5" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="470">	 
	   <tr>
	     <td class="textsearchjob" align="left" colspan="2"><span class="stlTitle"><img src="../images/button/impressions.png" width="48" height="48" vspace="5" align="absmiddle">THÊM MỚI ADMIN <img src="../images/button/leftBgnd.jpg" width="600" height="1"></span></td>
	     </tr>
	   <tr>
	    <td class="textsearchjob" colspan="2" align="center"><span class="stlTitle">Kiểu gõ                  
			      <input name="optChoose" type="radio" id="optChoose" value="0" onFocus="setTypingMode(0)" checked>Off
                  <input name="optChoose" type="radio" id="optChoose" value="1" onFocus="setTypingMode(1)">Telex
                  <input name="optChoose" type="radio" id="optChoose" value="2" onFocus="setTypingMode(2)">VNI
                  <input name="optChoose" type="radio" id="optChoose" value="3" onFocus="setTypingMode(3)">VIQR			  </span></td>
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Tên đăng nhập <font color="#FF0000">(*)</font> </td>
	    <td>
		 <input type="text" name="username" id="username" class="textbox" style="width:150px ">		</td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">M&#7853;t khẩu <font color="#FF0000">(*)</font> </td>
	    <td>
		 <input type="password" name="password" id="password" class="textbox" style="width:150px " >		</td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">G&otilde; lại m&#7853;t khẩu <font color="#FF0000">(*)</font></td>
	    <td>
		 <input type="password" name="repass" id="repass" class="textbox" style="width:150px " >		</td>		
	   </tr>
	   <tr>
	    <td class="textadv">&nbsp;</td>
		<td><input type="submit" name="register" id="register" value="Đăng ký" onClick="return check();">&nbsp;<input type="reset" name="reset" value="Làm lại">&nbsp;<input type="hidden" name="reg" id="reg"></td>
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
 <?php include"foot.php"; ?>
	</td>
	<td valign="bottom" background="images/bg_right.gif">&nbsp;</td>
	<td width="50%" background="images/bg.gif"><img src="images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
</table>

</body>
</html>