<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrator</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="{$style}" rel="stylesheet" type="text/css">
<link href="../administrator/style.css" rel="stylesheet" type="text/css">
{literal}
<script language="javascript">
	function Logout(){
		if(confirm("Bạn có muốn thoát khỏi chương trình không?")){
			location.href=("logout.php");
		}
	}
</script>
{/literal}
</head>
<body>
<table width="1024" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td height="30" align="center"  background="../images/button/tbl_header.png" class="title_top_1">Administrator System </td>
  </tr>
  <tr>
    <td height="25" bgcolor="#F5F5F5">
	<a href="index.php" class="mainLink">Trang Quản Trị</a> | 	
	<a href="admin.list.php?page=0" class="mainLink">Admin</a> |
	<a href="menulevel1.list.php?page=0" class="mainLink">Menu Chính</a> | 
	<a href="menulevel2.list.php?page=0" class="mainLink">Sub Menu</a> |
	<a href="new.list.php?page=0" class="mainLink">Tin tức</a> |
	<a href="adv.list.php?page=0" class="mainLink">Quảng cáo</a> |
	<a href="newsmid.list.php?page=0" class="mainLink">Tin tức giữa</a> |
	<a href="represent.list.php?page=0" class="mainLink">Giới thiệu C.Ty</a> |
	<a href="javascript: Logout();" class="mainLink">Thoát </a>
	</td>
  </tr>
  <tr>
    <td height="25" align="right" class="txt_normal"><strong>Xin chào, {$ad_username} </strong></td>
  </tr>
</table>
</body>
</html>
