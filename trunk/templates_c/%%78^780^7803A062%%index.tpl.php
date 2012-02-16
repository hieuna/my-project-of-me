<?php /* Smarty version 2.6.10, created on 2012-02-01 10:32:23
         compiled from D:/AppServ/www/mobimart/templates/administrator/index.tpl */ ?>
<html>
<head>
<title>..:: Administrator System Login ::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../administrator/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['style']; ?>
" rel="stylesheet" type="text/css">



<?php echo '
<script language="javascript">
	function CheckLogin()
	{
		if(document.frmLogin.username.value==\'\')
		{
			alert(\'Nhập Tên Đăng Nhập.\');
			document.frmLogin.username.focus();
			return false;
		}
		
		if(document.frmLogin.password.value==\'\')
		{
			alert(\'Nhập mật khẩu.\');
			document.frmLogin.password.focus();
			return false;
		}
		document.frmLogin.Login.value=\'Login\';
		return true;
	}
</script>	
'; ?>

</head>

<body>
<table width="750"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="txtRoot">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><form action="" method="post" name="frmLogin" id="frmLogin">
      <p>&nbsp;</p>
      <p class="link_edit_item">&nbsp;<?php echo $this->_tpl_vars['error']; ?>
</p>
      <table width="60%"  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
        <tr>
          <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr valign="top" bgcolor="#F2F2F2">
              <td width="44%" align="center" valign="middle"><table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="100" align="center"><img src="../images/button/frontpage.png" width="48" height="48"></td>
                  </tr>
              </table></td>
              <td width="56%" align="center"><table width="95%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="40" class="txtFile_Big"><strong>Đăng nhập hệ thống</strong></td>
                  </tr>
                  <tr>
                    <td><table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="BORDER-COLLAPSE: collapse">
                        <tr>
                          <td bgcolor="#DDDDDD"><table width="95%"  border="0" align="center" cellpadding="3" cellspacing="3">
                            <tr>
                              <td class="txtField">Tên đăng nhập</td>
                            </tr>
                            <tr>
                              <td><input name="username" type="text" id="username" style="width:150px;"></td>
                            </tr>
                            <tr>
                              <td class="txtField">Mật khẩu</td>
                            </tr>
                            <tr>
                              <td><input name="password" type="password" id="password" style="width:150px;"></td>
                            </tr>
                            <tr>
                              <td><input name="btnLogin" type="submit" class="link_edit_item" id="btnLogin" value="Đăng nhập" onClick="return CheckLogin();">
                                <input name="Login" type="hidden" id="Login"></td>
                            </tr>
                            <tr>
                              <td></td>
                            </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>