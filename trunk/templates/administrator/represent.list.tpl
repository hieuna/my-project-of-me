<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>...:: NEW MID LIST ::...</title>
<link href="../administrator/style.css" rel="stylesheet" type="text/css">
{literal}
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
	if(checkedStr==''){
		alert("Phải chọn ít nhất một tin để xóa !");
	} 
	else
	 {
		if(confirm('Bạn có muốn xóa không?'))
		{
			document.frmList.str_id.value = checkedStr;
			document.frmList.submit();
		}
	}
}
</script>
{/literal}
</head>

<body>
  <table cellpadding="0" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="770" bgcolor="#FFFFFF">
   <tr>
    <td>{php}include"top.php";{/php}</td>
   </tr>
   <tr>
    <td>
	 <table cellpadding="0" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="770">
	  <tr>	  
	  <!--- MAIN -->
	   <td>
	    <table cellpadding="2" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="540">
		 <tr>
		  <td colspan="2" background="images/nav_03.gif" class="stlTitle" height="26"><img src="../images/button/browser.png" width="48" height="48" vspace="5" align="absmiddle">DANH SÁCH GIỚI THIỆU CÔNG TY <img src="../images/button/leftBgnd.jpg" width="600" height="1"></td>
		 </tr>
		 <tr><td colspan="2"><img src="images/spacer.gif" height="4" border="0" width="100%"></td></tr>
		 <tr valign="middle">
        <td height="30"><a href="represent.add.php?page=0" class="mainLink">Thêm mới</a> | <a href="javascript: Delete();" class="mainLink">Xóa</a> |<a href="#" class="mainLink" onClick="window.history.back()"> Quay lại</a> </td>
      <td height="30" align="center"><span class="txt_normal">{$showPage}</span> </td>
      </tr>
      <tr>
        <td colspan="2"><form action="" method="post" name="frmList" id="frmList">
          <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="0" bordercolor="#CCCCCC" style="BORDER-COLLAPSE: collapse">
            <!--DWLayoutTable-->
            <tr class="stlTitle" >
              <td width="4%" height="25" align="center" background="../images/button/itable.jpg"><input name="chkAll" type="checkbox" id="chkAll" onClick="SelectAll(this)"></td>
              <td width="59%" height="25" background="../images/button/itable.jpg" class="stlTitle">Thông tin công ty
                <input name="str_id" type="hidden" id="str_id">                </td> 
			            
              
			  
			  <td width="24%" height="25" align="center" background="../images/button/itable.jpg">Tình trạng</td>
			  
			  
              </tr>
			{section name=i loop=$r}{if $smarty.section.i.index is odd by 1}
            <tr  class="stlContent">
              <td align="center">
			  <input name="chkItem" type="checkbox" id="chkItem" onClick="SelectItem(this)" value="{$r[i].re_id}"></td>
              <td><a href="represent.edit.php?re_id={$r[i].re_id}" class="mainLink">{$r[i].re_sum}</a></td> 		  
			                
			  <td align="center" class="txt_normal">{if ($r[i].re_status eq 1)}
			  Hiển thị
				{else}
			  Khóa			
			  {/if}</td>        
			  
              </tr>
			{else}
              <tr bgcolor="#F5F5F5"  >
              <td align="center"><input name="chkItem" type="checkbox" id="chkItem" onClick="SelectItem(this)" value="{$r[i].re_id}"></td>
              <td><a href="represent.edit.php?re_id={$r[i].re_id}" class="mainLink">{$r[i].re_sum}</a></td>  
			   
			                
			  <td align="center" class="txt_normal">			  
			  {if ($r[i].re_status eq 1)}
			  Hiển thị
				{else}
			  Khóa			
			  {/if}			 
              </tr> 
			{/if} {sectionelse}
            <tr>
              <td colspan="7" align="center" class="txtuserpass">Chưa thêm một giới thiệu nào ...</td>
              </tr>
			{/section}
            <tr align="center" >
              <td colspan="7" background="../images/button/itable.jpg">&nbsp;</td>
            </tr>
          </table>
        </form></td>
      </tr>
      <tr>
        <td height="30"><a href="represent.add.php?page=0" class="mainLink">Thêm mới</a> | <a href="javascript: Delete();" class="mainLink">Xóa</a> | <a href="#" class="mainLink" onClick="window.history.back()"> Quay lại</a></td>
      <td height="30" align="center"><span class="txt_normal">{$showPage}</span> </td>
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
    <td>{php}include"foot.php";{/php}</td>
   </tr>
  </table>
</body>
</html>
