<?php /* Smarty version 2.6.10, created on 2012-01-10 11:31:30
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/new.list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'D:\\AppServ\\www\\mobimart/templates/administrator/new.list.tpl', 107, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>...:: NEWS LIST ::...</title>
<link href="../administrator/style.css" rel="stylesheet" type="text/css">
<?php echo '
<script language="javascript" type="text/javascript">
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
		alert("Phải chọn ít nhất một tin để xóa !");
	} 
	else
	 {
		if(confirm(\'Bạn có muốn xóa không?\'))
		{
			document.frmList.str_id.value = checkedStr;
			document.frmList.submit();
		}
	}
}
</script>
'; ?>

</head>

<body>
  <table cellpadding="0" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="770" bgcolor="#FFFFFF">
   <tr>
    <td><?php include"top.php"; ?></td>
   </tr>
   <tr>
    <td>
	 <table cellpadding="0" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="770">
	  <tr>	  
	  <!--- MAIN -->
	   <td>
	    <table cellpadding="2" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="540">
		 <tr>
		  <td colspan="2" background="images/nav_03.gif" class="stlTitle" height="26"><img src="../images/button/browser.png" width="48" height="48" vspace="5" align="absmiddle">DANH SÁCH CÁC TIN TỨC <img src="../images/button/leftBgnd.jpg" width="600" height="1"></td>
		 </tr>
		 <tr><td colspan="2"><img src="images/spacer.gif" height="4" border="0" width="100%"></td></tr>
		 <tr valign="middle">
        <td height="30"><a href="new.add.php?mn_id=0" class="mainLink">Thêm mới</a> | <a href="javascript: Delete();" class="mainLink">Xóa</a> |<a href="#" class="mainLink" onClick="window.history.back()"> Quay lại</a> </td>
      <td height="30" align="center"><span class="txt_normal"><?php echo $this->_tpl_vars['showPage']; ?>
</span> </td>
      </tr>
      <tr>
        <td colspan="2"><form action="" method="post" name="frmList" id="frmList">
          <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
            <tr class="stlTitle" >
              <td width="4%" height="25" align="center" background="../images/button/itable.jpg"><input name="chkAll" type="checkbox" id="chkAll" onClick="SelectAll(this)"></td>
              <td height="25" class="stlTitle" background="../images/button/itable.jpg">Tên bài viết 
                <input name="str_id" type="hidden" id="str_id"> 
                </td> 
				<td height="25" class="stlTitle" background="../images/button/itable.jpg">Loại tin </td>  
			            
                <td height="25" align="center" background="../images/button/itable.jpg">Tóm tắt tin tức</td>
			  <td height="25" align="center" background="../images/button/itable.jpg">Ngày đưa tin</td>
			  <td height="25" align="center" background="../images/button/itable.jpg">Tình trạng</td>
			  <td height="25" align="center" background="../images/button/itable.jpg">Tin nóng</td>
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
            <tr  class="stlContent">
              <td align="center">
			  <input name="chkItem" type="checkbox" id="chkItem" onClick="SelectItem(this)" value="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_id']; ?>
"></td>
              <td><a href="new.edit.php?news_id=<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_id']; ?>
" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_title']; ?>
</a></td> 
			  <td align="center" class="txt_normal"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_cat']; ?>
</td>
			  <td align="center" class="txt_normal"><?php echo ((is_array($_tmp=$this->_tpl_vars['r'][$this->_sections['i']['index']]['news_sums'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>              <td align="center" class="txt_normal"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_date']; ?>
</td>
			  <td align="center" class="txt_normal"><?php if (( $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_status'] == 1 )): ?>
			  Hiển thị
				<?php else: ?>
			  Khóa			
			  <?php endif; ?></td>              <td align="center"class="txt_normal"><?php if (( $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_hot'] == 1 )): ?>
			  Tin nóng
				<?php else: ?>
			  Tin không nóng			
			  <?php endif; ?></td>
              </tr>
			<?php else: ?>
              <tr bgcolor="#F5F5F5"  >
              <td align="center"><input name="chkItem" type="checkbox" id="chkItem" onClick="SelectItem(this)" value="<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_id']; ?>
"></td>
              <td><a href="new.edit.php?news_id=<?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_id']; ?>
" class="mainLink"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_title']; ?>
</a></td>  
			   <td align="center" class="txt_normal"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_cat']; ?>
</td>
			  <td align="center" class="txt_normal"><?php echo ((is_array($_tmp=$this->_tpl_vars['r'][$this->_sections['i']['index']]['news_sums'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>              <td align="center" class="txt_normal"><?php echo $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_date']; ?>
</td>
			  <td align="center" class="txt_normal">			  
			  <?php if (( $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_status'] == 1 )): ?>
			  Hiển thị
				<?php else: ?>
			  Khóa			
			  <?php endif; ?>
			  
			  </td>              <td align="center"class="txt_normal"><?php if (( $this->_tpl_vars['r'][$this->_sections['i']['index']]['news_hot'] == 1 )): ?>
			  Tin nóng
				<?php else: ?>
			  Tin không nóng			
			  <?php endif; ?></td>
              </tr> 
			<?php endif; ?> <?php endfor; else: ?>
            <tr>
              <td colspan="7" align="center" class="txtuserpass">Chưa thêm một tin tức nào ...</td>
              </tr>
			<?php endif; ?>
            <tr align="center">
              <td colspan="7" background="../images/button/itable.jpg">&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td height="30"><a href="new.add.php?mn_id=0" class="mainLink">Thêm mới</a> | <a href="javascript: Delete();" class="mainLink">Xóa</a> | <a href="#" class="mainLink" onClick="window.history.back()"> Quay lại</a></td>
      <td height="30" align="center"><span class="txt_normal"><?php echo $this->_tpl_vars['showPage']; ?>
</span> </td>
      </tr>
		
		 <tr><td colspan="2">&nbsp;</td></tr>	
		 <tr><td colspan="2">&nbsp;</td></tr>		
		</table>
	   </td>
	  <!-- END MAIN -->
	  </tr>
	 </table>
	</td>
   </tr>
   <tr>
    <td><?php include"foot.php"; ?></td>
   </tr>
  </table>
</body>
</html>