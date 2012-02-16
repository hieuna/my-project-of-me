<?php /* Smarty version 2.6.10, created on 2012-01-09 16:05:38
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/new.add.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>...:: NEWS ADD ::...</title>
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="style.css">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php echo '
     <script language="javascript1.2" src="vietuni.js" type="text/javascript"></script>
    '; ?>

	<?php echo '
	 <script language="javascript">	  
	  function check() {
	   var v=document.frmReg;
	   if (v.news_title.value == "")
	    {
		  alert("Xin vui lòng nhập tên tiêu đề tin tức !");
		  v.news_title.focus();
		  return false;
		}
	   if (v.news_sums.value=="")	   
	    {
		  alert("Xin vui lòng nhập tóm tắt của tin tức !");
		  v.news_sums.focus();
		  return false;
		}
		v.addnew.value = "addnew";	 
	   return true;
	  }
	  
	  function getSubMenu(){
	  	with(document.frmReg){
			window.location = "new.add.php?mn_id=" + menu_id.value ;			
		}		
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
	   <td><form action="" name="frmReg" id="frmReg" method="post" enctype="multipart/form-data">
	      <table cellpadding="5" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="470">	 
	   <tr>
	     <td class="textsearchjob" align="left" colspan="2"><span class="stlTitle"><img src="../images/button/impressions.png" width="48" height="48" vspace="5" align="absmiddle">THÊM MỚI TIN TỨC <img src="../images/button/impressions.png" width="600" height="1"></span></td>
	     </tr>
	   <tr>
	    <td class="textsearchjob" colspan="2" align="center"><span class="stlTitle">Kiểu gõ                  
			      <input name="optChoose" type="radio" id="optChoose" value="0" onFocus="setTypingMode(0)" checked>Off
                  <input name="optChoose" type="radio" id="optChoose" value="1" onFocus="setTypingMode(1)">Telex
                  <input name="optChoose" type="radio" id="optChoose" value="2" onFocus="setTypingMode(2)">VNI
                  <input name="optChoose" type="radio" id="optChoose" value="3" onFocus="setTypingMode(3)">VIQR			   </span></td>
	   </tr>
	   
			   
	   <tr>
				<td width="30%" class="stlTitle">Loại tin <font color="#FF0000"></font> </td>
				<td>
				<select name="news_cat" id="news_cat" >				
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['RowMenuLevel1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>
					<option value="mn<?php echo $this->_tpl_vars['RowMenuLevel1'][$this->_sections['i']['index']]['mn_id']; ?>
"><?php echo $this->_tpl_vars['RowMenuLevel1'][$this->_sections['i']['index']]['mn_name']; ?>
</option>
				<?php endfor; endif; ?>
				<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['RowMenuLevel2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
					<option value="submn<?php echo $this->_tpl_vars['RowMenuLevel2'][$this->_sections['j']['index']]['submn_id']; ?>
"><?php echo $this->_tpl_vars['RowMenuLevel2'][$this->_sections['j']['index']]['submn_name']; ?>
</option>
				<?php endfor; endif; ?>
				
			</select>
							
				 </td>		   
	   
	   <tr>
	   
	    <td width="30%" class="stlTitle">Tiêu đề tin tức</td>
	    <td>
			<input name="news_title" type="text" class="textbox" id="news_title" style="width:250px" size="70" >		
		 </td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Tóm tắt nội dung<font color="#FF0000"></font> </td>
	    <td>
			
			<textarea name="news_sums" id="news_sums" style="BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid;  FONT-SIZE: 13px; BORDER-LEFT: #000000 1px solid; WIDTH: 300px; BORDER-BOTTOM: #000000 1px solid" rows="3" cols="20"></textarea>
			
			</td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Ảnh minh họa<font color="#FF0000"></font> </td>
	    <td>
			<input type="file" name="file" class="stlTitle" size="35">
		</td>		
	   </tr>
	   <tr>
	    <td width="30%" class="stlTitle">Chi tiết tin tức</td>
	    <td class="textlogother"><?php echo $this->_tpl_vars['news_details']; ?>
</td>		
	   </tr>	 
	   
	   <tr>
	    <td width="30%" class="stlTitle">
                         Tình tr&#7841;ng   </td>
	    <td><select size="1" name="news_status">
                              <option value="1">Hiển thị</option>
                              <option value="0">Khóa</option>
                            </select></td>
				
	   </tr>	 
	   <tr>
	    <td width="30%" class="stlTitle">
                         Tin nóng   </td>
	    <td><select size="1" name="news_hot">
                              <option value="1">Tin nóng</option>
                              <option value="0">Tin không nóng</option>
            </select></td>
				
	   </tr>	   
	   <tr>
	    <td class="stlTitle">&nbsp;</td>
		<td><input type="submit" name="register" id="register" value="Chấp nhận" onClick="return check();">
		&nbsp;<input type="reset" name="reset" value="Làm lại" >&nbsp;			
		<input type="hidden" name="addnew" value="addnew" id="addnew"></td>
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