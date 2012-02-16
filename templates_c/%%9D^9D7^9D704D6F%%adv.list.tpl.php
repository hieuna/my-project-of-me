<?php /* Smarty version 2.6.10, created on 2012-01-10 11:35:08
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/adv.list.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>...:: ADV LIST ::...</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../administrator/style.css" rel="stylesheet" type="text/css">

<link href="<?php echo $this->_tpl_vars['style']; ?>
" rel="stylesheet" type="text/css">

<?php echo '
<script language="JavaScript" type="text/JavaScript">
<!--

//Kiem tra xoa bo checkAll
function SelectItem(frmName) {
	var f = frmName.form;
	var dem = 0;	
	for (var i=0;i<f.elements["chkItem"].length;i++) {
		if (!f.elements["chkItem"][i].checked) {
			f.elements["chkAll"].checked = frmName.unchecked;
			return;
		}		
	}		
	for (var i=0;i<f.elements["chkItem"].length;i++) {
		if (f.elements["chkItem"][i].checked) {
			dem++;		
		}		
	}
	if (dem == i) {
		f.elements["chkAll"].checked = frmName.checked;
	}	
}

function SelectAll(frmName) {
	var f = frmName.form;	
	if (!f.elements["chkItem"]) return;
	if (f.elements["chkItem"][0]) {
		for (var i=0; i<f.elements["chkItem"].length; i++)
			f.elements["chkItem"][i].checked = frmName.checked;	
	} else {
		f.elements["chkItem"].checked = frmName.checked;	
	}
}

function Delete() {
	var checkedStr = "";
	for (var i=0;i<document.frmList.elements.length;i++){
		e = document.frmList.elements[i];
		if ((e.name).indexOf("chkItem")>=0){
			if (e.checked) checkedStr+=e.value+",";
		}
	}
		
	checkedStr=checkedStr.substr(0,checkedStr.length-1);
	if(checkedStr==\'\'){
		alert("Chọn phần cần xóa!");
	} 
	else
	 {
		if(confirm(\'Bạn có muốn xóa không?\'))
		{
			document.frmList.str_id.value = checkedStr;
			document.frmList.submit();
		}
	}
}//-->
</script>
'; ?>

</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
  <tr>
    <td valign="top"><?php  include"top.php";  ?></td>
  </tr>
  <tr>
    <td valign="top"><table width="95%"  border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td colspan="2" class="stlTitle" background="images/nav_03.gif"><img src="../images/button/browser.png" width="48" height="48" vspace="5" align="absmiddle"><span class="clsPriceListItem0">DANH SÁCH CÁC QUẢNG CÁO</span></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="46%" height="30"><a href="adv.add.php" class="mainLink">Th&ecirc;m mới</a> | <a href="javascript: Delete();" class="mainLink">Xóa</a> |<a href="#" class="mainLink" onClick="window.history.back()"> Quay lại</a></td>
      <td height="30" align="center"><span class="txt_normal"><?php echo $this->_tpl_vars['showPage']; ?>
</span> </td>
      </tr>
      <tr>
        <td colspan="2"><form action="" method="post" name="frmList" id="frmList">
          <table width="95%"  border="0" align="center" cellpadding="2" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
            <tr>
              <td width="4%" height="25" align="center" background="../images/button/itable.jpg"><input name="chkAll" type="checkbox" id="chkAll" onClick="SelectAll(this)"></td>
              <td width="23%" height="25"  class="stlTitle" background="../images/button/itable.jpg">Tên Công ty/Doanh nghiệp 
                <input name="str_id2" type="hidden" id="str_id2"></td>
              <td width="25%" align="center"  class="stlTitle" background="../images/button/itable.jpg">Ảnh</td>
              <td width="17%" align="center"  class="stlTitle" background="../images/button/itable.jpg">Đường dẫn</td>
              <td width="17%" align="center"  class="stlTitle" background="../images/button/itable.jpg">Số lượt xem</td>
              <td width="14%" height="25" align="center"  class="stlTitle" background="../images/button/itable.jpg">Trạng thái</td>
              </tr>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['r']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
 if ((1 & ($this->_sections['i']['index'] / 1))): ?>
            <tr bgcolor="#F5F5F5">
              <td align="center"><input name="chkItem" type="checkbox" id="chkItem" onClick="SelectItem(this)" value="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_id']; ?>
"></td>
              <td><a href="adv.edit.php?advid=<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_id']; ?>
" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_title']; ?>
</a></td>
              <td align="center"><a href="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_link']; ?>
" target="_blank"><img src="../<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_img']; ?>
" alt="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_title']; ?>
" width="100" border="0"></a></td>
              <td align="center"><a href="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_link']; ?>
" target="_blank" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_link']; ?>
</a></td>
              <td align="center" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_click']; ?>
</td>
              <td align="center"><img src="../images/button/checkin.png" width="12" height="12" hspace="3" vspace="3" align="absmiddle"></td>
              </tr>
			<?php else: ?>
            <tr>
              <td align="center"><input name="chkItem2" type="checkbox" id="chkItem" onClick="SelectItem(this)" value="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_id']; ?>
"></td>
              <td><a href="adv.edit.php?advid=<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_id']; ?>
" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_title']; ?>
</a></td>
              <td align="center"><a href="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_link']; ?>
" target="_blank"><img src="../<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_img']; ?>
" alt="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_title']; ?>
" width="100" border="0"></a></td>
              <td align="center"><span class="txt_normal"><a href="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_link']; ?>
" target="_blank" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_link']; ?>
</a></span></td>
              <td align="center"><span class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['adv_click']; ?>
</span></td>
              <td align="center"><img src="../images/button/checkin.png" width="12" height="12" hspace="3" vspace="3" align="absmiddle"></td>
              </tr>
			<?php endif; ?> <?php endfor; else: ?>
            <tr>
              <td colspan="6" align="center" class="txtuserpass">Kh&ocirc;ng c&oacute; quảng cáo nào. . . . .</td>
              </tr>
			<?php endif; ?>			
            <tr align="center" >
              <td colspan="6"background="../images/button/itable.jpg">&nbsp;</td>
            </tr>
			<TR>
			<td width="46%" height="30" colspan="2"><a href="adv.add.php" class="mainLink">Th&ecirc;m mới</a> | <a href="javascript: Delete();" class="mainLink">Xóa</a> |<a href="#" class="mainLink" onClick="window.history.back()"> Quay lại</a></td>
      <td height="30" align="center" colspan="4"><span class="txt_normal"><?php echo $this->_tpl_vars['showPage']; ?>
</span> </td>
			</TR>
            <tr align="left">
              <td colspan="6"><input name="str_id" type="hidden" id="str_id"></td>
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
    <td valign="top"><?php  include"foot.php";  ?></td>
  </tr>
</table>
</body>
</html>