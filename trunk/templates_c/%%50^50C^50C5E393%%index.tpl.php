<?php /* Smarty version 2.6.10, created on 2012-01-11 10:33:24
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/index.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../administrator/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo $this->_tpl_vars['style']; ?>
" rel="stylesheet" type="text/css">
</head>
<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
  <!--DWLayoutTable-->
  <tr>
    <td width="750" valign="top"><?php  include"top.php";  ?></td>
  </tr>
  <tr>
    <td height="406" valign="top"><table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr valign="top">
        <td width="66">&nbsp;</td>
          <td width="228">&nbsp;</td>
          <td width="72">&nbsp;</td>
          <td width="234">&nbsp;</td>
      </tr>
      <tr valign="top">
         <td><img src="../images/button/cpanel.png" width="48" height="48"></td>
          <td>
          <table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="admin.list.php?page=0" class="link_menu_index">Admin</a></td>
              </tr>
              <tr>
                <td><a href="admin.add.php" class="link_menu_top">Thêm mới</a>, <a href="admin.list.php?page=0" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table>
          </td>
         <td><img src="../images/button/inbox.png" width="48" height="48"></td>
          <td>
          <table width="80%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                <td><a href="new.list.php?page=0" class="link_menu_index">Tin tức</a></td>
              </tr>
              <tr>
                <td><a href="new.add.php?mn_id=0" class="link_menu_top">Thêm mới</a>, <a href="new.list.php?page=0" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table>
         </td>
         <td><img src="../images/button/icon-hotdeal.png" width="48" height="48"></td>
          <td>
          <table width="80%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                <td><a href="admin.hotdeal.php?task=view" class="link_menu_index">Hot Deal</a></td>
              </tr>
              <tr>
                <td><a href="admin.hotdeal.php?task=addnew" class="link_menu_top">Thêm mới</a>, <a href="admin.hotdeal.php?task=view" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table>
         </td>
        </tr>
      <tr valign="top">
        <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>      
      <tr valign="top">
        <td>&nbsp;</td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
          <td>&nbsp;</td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </table></td>
        </tr>
      <tr valign="top">
        <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <tr valign="top">
        <td><img src="../images/button/credits.png" width="48"></td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="menulevel1.list.php?page=0" class="link_menu_index">Menu Chính</a></td>
              </tr>
              <tr>
                <td><a href="menulevel1.add.php" class="link_menu_top">Thêm mới</a>, <a href="menulevel1.list.php?page=0" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table></td>
          <td><img src="../images/button/css_f2.png" width="48" height="48"></td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="adv.list.php?page=0" class="link_menu_index">Quảng cáo</a></td>
              </tr>
              <tr>
                <td><a href="adv.add.php?adv_id=0" class="link_menu_top">Thêm mới</a>, <a href="adv.list.php?page=0" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table></td>
        </tr>
      <tr valign="top">
        <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <tr valign="top">
        <td>&nbsp;</td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td></td>
              </tr>
              <tr>
                <td></td>
              </tr>
          </table></td>
          <td>&nbsp;</td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td></td>
              </tr>
              <tr>
                <td></td>
              </tr>
          </table></td>
        </tr>
      <tr valign="top">
        <td rowspan="2"><img src="../images/button/asterisk.png" width="48" height="46"></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <tr valign="top">
        <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="menulevel2.list.php?page=0" class="link_menu_index">Sub Menu</a></td>
              </tr>
          <tr>
            <td><a href="menulevel2.add.php" class="link_menu_top">Thêm mới</a>, <a href="menulevel2.list.php?page=0" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table></td>
          <td><img src="../images/button/install.png" width="48" height="48"></td>
          <td><table width="80%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="newsmid.list.php?page=0" class="link_menu_index">Tin tức giữa</a></td>
              </tr>
              <tr>
                <td><a href="newsmid.add.php" class="link_menu_top">Thêm mới</a>, <a href="newsmid.list.php?page=0" class="link_menu_top">Danh sách</a></td>
              </tr>
          </table></td>
        </tr>
      <tr valign="top">
        <td height="41" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <tr valign="top">
        <td rowspan="3" valign="top"><img src="../images/button/categories.png" width="48" height="48"></td>
        <td height="19" valign="top"><a href="represent.list.php?page=0" class="link_menu_index">Giới thiệu Công Ty </a></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="top">
        <td height="16" valign="top"><a href="represent.add.php" class="link_menu_top">Thêm mới</a>, <a href="represent.list.php?page=0" class="link_menu_top">Danh sách</a></td>
        <td></td>
        <td></td>
      </tr>
      <tr valign="top">
        <td height="14"></td>
        <td></td>
        <td></td>
      </tr>
      
    </table></td>
      </tr>
      
      <tr valign="top">
        <td height="25" valign="top"><?php  include"foot.php";  ?></td>        
      </tr>
    </table>
</td>
  </tr>
  <tr>
    <td valign="top"></td>
  </tr>
</table>
</body>
</html>