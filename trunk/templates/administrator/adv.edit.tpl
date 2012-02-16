<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>...:: ADV EDIT ::...</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="../administrator/style.css"></link>
{literal}
<script language="JavaScript" type="text/JavaScript">
<!--

function Back()
{
	window.history.back();
}

function checkNull() {
    var len=document.frmList.elements["chkpos"].length;
	var checked=false;	
	for (var i=0; i<len; i++) {
	  if(document.frmList.elements["chkpos"][i].checked) {
	   checked=true;
	   break;
	  }	  
	}
	if (!checked) {
	  alert("Xin vui lòng chọn một vị trí để đưa lên !");
	  return false;
	}	
	if(document.frmList.adv_title.value == '') {
		alert("Nhập tên Công ty hoặc Doanh nghiệp !");
		document.frmList.adv_title.focus();
		return false;
	}
	
	if(document.frmList.adv_url.value == '') {
		alert("Xin vui lòng nhập đường dẫn tới Website của công ty hoặc doanh nghiệp !");
		document.frmList.adv_url.focus();
		return false;
	}
	
	document.frmList.add.value='add';
	
	return true;
}
//-->
</script>
{/literal}
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
  <tr>
    <td valign="top">{php} include"top.php"; {/php}</td>
  </tr>
  <tr>
    <td valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="46%"><img src="../images/button/impressions.png" width="48" height="48" vspace="5" align="absmiddle"><span class="stlTitle">CẬP NHẬT THÔNG TIN QUẢNG CÁO </span></td>
        <td width="54%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><form action="" method="post" enctype="multipart/form-data" name="frmList" id="frmList" onSubmit="return checkNull();">
          <table width="95%"  border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
            <tr bgcolor="#0066CC">
              <td width="100%" height="25" background="../images/button/itable.jpg" class="stlTitle">CHI TIẾT</td>
              </tr>
            <tr>
              <td align="center" bgcolor="#F5F5F5" class="txt_normal"><table width="95%"  border="0" cellspacing="1" cellpadding="0">
                <tr>
                  <td height="25" colspan="2" align="left" class="ItemLink1">{$lblDisplay}</td>
                  </tr>
				<tr>
                  <td width="29%" height="25" align="left" class="stlTitle">Th&ecirc;m vào </td>
                  <td width="71%" height="25" align="left">{if $r[0].adv_location eq left}<input type="radio" name="chkpos" value="left" checked="checked">Bên trái&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="chkpos" value="right">Bên phải
				  
				  {elseif $r[0].adv_location eq right}
				  <input type="radio" name="chkpos" value="left">Bên trái&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="chkpos" value="right" checked="checked">Bên phải	  
				  {/if}
				  </td>
				</tr>
                <tr>
                  <td width="29%" height="25" align="left" class="stlTitle">Tên Công ty/Doanh nghiệp</td>
                  <td width="71%" height="25" align="left"><input name="adv_title" type="text" id="adv_title" value="{$r[0].adv_title}" size="25"></td>
                </tr>
				<tr>
                  <td height="25" align="left" class="stlTitle">Banner Quảng cáo c&#361;</td>
                  <td height="25" align="left" class="clsImeiMsg">{if $r[0].adv_img ne null}<img src="../{$r[0].adv_img}" alt="{$r[0].adv_title}" width="100" border="0">{else}<img src="images/noimage.gif" alt="{$r[0].adv_title}" width="100" border="0">{/if}</td>
                </tr>
                <tr>
                  <td height="25" align="left" class="stlTitle">Thay Banner Quảng cáo</td>
                  <td height="25" align="left" class="clsImeiMsg"><input name="file" type="file" class="txt_normal" size="30"> 
                  (Size 130*60)</td>
                </tr>
                <tr>
                  <td height="25" align="left" class="stlTitle">Đường dẫn (URL)</td>
                  <td height="25" align="left"><input name="adv_url" type="text" class="txt_name_product" id="adv_url" style="width:300px;" value="{$r[0].adv_link}"></td>
                </tr>
                <tr>
                  <td width="29%" height="25" align="left">&nbsp;</td>
                  <td width="71%" height="25" align="left"><input name="add" type="hidden" id="add">
                    <input name="Submit" type="submit" class="button" value="Cập nhật">&nbsp;<input type="button" name="back" value="Quay lại" class="button" onClick="window.history.back(-1)"></td>
                </tr>
              </table></td>
              </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">{php} include"foot.php"; {/php}</td>
  </tr>
</table>
</body>
</html>
