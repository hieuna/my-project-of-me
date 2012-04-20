<?php /* Smarty version 2.6.19, created on 2011-10-28 06:26:27
         compiled from tplEditProduct.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'smalleditor', 'tplEditProduct.tpl', 53, false),array('modifier', 'editor', 'tplEditProduct.tpl', 59, false),array('modifier', 'echo_date', 'tplEditProduct.tpl', 82, false),)), $this); ?>
<script type="text/javascript" src="<?php echo @SITE_URL; ?>
lib/css/tabcontent.js"></script>
<script src="<?php echo @SITE_URL; ?>
lib/include/src/js/jscal2.js"></script>
<script src="<?php echo @SITE_URL; ?>
lib/include/src/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo @SITE_URL; ?>
lib/include/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo @SITE_URL; ?>
lib/include/src/css/border-radius.css" />

<link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />
    
    <div style="margin:10px">
<h3>Quản lý sản phẩm <?php echo $this->_tpl_vars['rowItem']['Product_Deal']; ?>
</h3>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="ID" value="<?php echo $this->_tpl_vars['rowItem']['Product_ID']; ?>
" />
<div style="text-align:center; position:fixed; right:20px; z-index:300;">
<input type="submit" class="submitForm" value="Lưu dữ liệu" />
</div>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="country1" class="selected">Thông tin cơ bản</a></li>
<li><a href="#" rel="box_luuy">Điểm nổi bật</a></li>
<li><a href="#" rel="country3">Điều khoản sử dụng</a></li>
<li><a href="#" rel="doanhnghiep">Thông tin doanh nghiệp</a></li>
<li><a href="#" rel="country4">Bảng giá & số lượng bán</a></li>
<li><a href="#" rel="timeid">Thời gian</a></li>
<li><a href="#" rel="hinhanh">Hình ảnh</a></li>
<li><a href="#" rel="country5">SEO</a></li>
</ul>
<div style="border:1px solid gray; width:900px; margin-bottom: 1em; padding: 10px">

<div id="country1" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Tiêu đề ngắn</td><td class="tdright"><input value="<?php echo $this->_tpl_vars['rowItem']['Product_Deal']; ?>
" type="text" name="txtName"></td></tr>
<tr><td class="tdleft">Tiêu đề đầy đủ</td><td class="tdright"><input value="<?php echo $this->_tpl_vars['rowItem']['Product_Name']; ?>
" type="text" name="txtNameFull"></td></tr>
<tr><td class="tdleft">Danh mục</td><td class="tdright">
<select name="selCategory">
<?php $_from = $this->_tpl_vars['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="">Tất cả</option>
<option value="<?php echo $this->_tpl_vars['item']['Group_ID']; ?>
" <?php if ($this->_tpl_vars['rowItem']['Product_GroupID'] == $this->_tpl_vars['item']['Group_ID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['Group_Name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td></tr>
<tr><td class="tdleft">Thuộc địa danh</td><td class="tdright">
<select name="selCity">
<option value="">Toàn quốc</option>
<?php $_from = $this->_tpl_vars['destination']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<option value="<?php echo $this->_tpl_vars['item']['Group_ID']; ?>
" <?php if ($this->_tpl_vars['rowItem']['Product_DestinationID'] == $this->_tpl_vars['item']['Group_ID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['Group_Name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td></tr>

<tr><td class="tdleft">Đánh đấu đang giảm giá</td><td class="tdright"><input type="checkbox" <?php if ($this->_tpl_vars['rowItem']['Product_Hot'] == 1): ?> checked="checked"<?php endif; ?> name="chekHot" value="1" /></td></tr>
<tr><td class="tdleft">Cho phép hiển thị</td><td class="tdright"><input type="checkbox" <?php if ($this->_tpl_vars['rowItem']['Product_Status'] == 1): ?> checked="checked"<?php endif; ?> name="chekStatus" value="1" /></td></tr>
<tr><td class="tdleft">Đánh dấu đã bán</td><td class="tdright"><input type="checkbox" <?php if ($this->_tpl_vars['rowItem']['Product_Sold'] == 1): ?> checked="checked"<?php endif; ?> name="chekSold" value="1" /></td></tr>
<tr><td  class="tdleft">Miêu tả ngắn</td><td  class="tdright" style="width:760px;"><?php echo ((is_array($_tmp='txtDescription')) ? $this->_run_mod_handler('smalleditor', true, $_tmp, $this->_tpl_vars['rowItem']['Product_Description']) : smalleditor($_tmp, $this->_tpl_vars['rowItem']['Product_Description'])); ?>

</td></tr>
</table>
</div>

<div id="doanhnghiep" class="tabcontent" style="height:auto;">
<?php echo ((is_array($_tmp='txtContent')) ? $this->_run_mod_handler('editor', true, $_tmp, $this->_tpl_vars['rowItem']['Product_Content']) : smarty_modifier_editor($_tmp, $this->_tpl_vars['rowItem']['Product_Content'])); ?>

</div>
<div id="box_luuy" class="tabcontent" style="height:auto;">
<?php echo ((is_array($_tmp='txtNote')) ? $this->_run_mod_handler('smalleditor', true, $_tmp, $this->_tpl_vars['rowItem']['Product_Note']) : smalleditor($_tmp, $this->_tpl_vars['rowItem']['Product_Note'])); ?>

</div>

<div id="country3" class="tabcontent" style="height:auto;">
<?php echo ((is_array($_tmp='txtDieukhoan')) ? $this->_run_mod_handler('smalleditor', true, $_tmp, $this->_tpl_vars['rowItem']['Product_Terms_of_Use']) : smalleditor($_tmp, $this->_tpl_vars['rowItem']['Product_Terms_of_Use'])); ?>

</div>

<div id="country4" class="tabcontent">

<table class="frmForm">
<tr><td class="tdleft">Giá trị thực</td><td  class="tdright"><input type="text" value="<?php echo $this->_tpl_vars['rowItem']['Product_Price']; ?>
" name="txtValue" style="width:170px"></td></tr>
<tr><td class="tdleft">Giá bán ra</td><td class="tdright"><input value="<?php echo $this->_tpl_vars['rowItem']['Product_DealPrice']; ?>
"  type="text" name="txtOutValue" style="width:170px"></td></tr>
<tr><td class="tdleft">Số lượng phiếu bán</td><td class="tdright"><input value="<?php echo $this->_tpl_vars['rowItem']['Product_Quantity']; ?>
"  type="text" name="txtNumber" style="width:70px"></td></tr>
<tr><td class="tdleft" style="width:220px;">Số lượng tối thiểu để đạt giá tốt</td><td class="tdright"><input value="<?php echo $this->_tpl_vars['rowItem']['Product_Minimun']; ?>
"  type="text" name="txtNumberMinimun" style="width:70px"></td></tr>
<tr><td class="tdleft">Số lượng đã bán</td><td class="tdright"><input value="<?php echo $this->_tpl_vars['rowItem']['Product_Buy']; ?>
"  type="text" name="txtNumberBuy" style="width:70px"></td></tr>
</table>
</div>

<div id="timeid" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Bắt đầu</td><td class="tdright"><input value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rowItem']['Product_StartDate'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'd/m/Y H:i') : smarty_modifier_echo_date($_tmp, 'd/m/Y H:i')); ?>
" type="text" name="txtFromTime" size="30" id="f_date1" /><button id="f_btn1">...</button></td></tr>
<tr><td class="tdleft">Kết thúc</td><td class="tdright"><input value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rowItem']['Product_EndDate'])) ? $this->_run_mod_handler('echo_date', true, $_tmp, 'd/m/Y H:i') : smarty_modifier_echo_date($_tmp, 'd/m/Y H:i')); ?>
"  type="text"  name="txtEndTime" size="30" id="f_date2" /><button id="f_btn2">...</button></td></tr>
</table>
</div>
<div id="country5" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Địa chỉ đường dẫn</td><td class="tdright"><input type="text" value="<?php echo $this->_tpl_vars['rowItem']['Product_LinkName']; ?>
"  name="txtAddress"></td></tr>
<tr><td class="tdleft">Số lượt xem</td><td class="tdright"><input type="text" value="<?php echo $this->_tpl_vars['rowItem']['Product_NumberView']; ?>
"  name="txtNumberView"></td></tr>
</table>

</div>

<div id="hinhanh" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Ảnh đại diện</td><td class="tdright"><input type="file" name="photo"></td></tr>
<?php if ($this->_tpl_vars['rowItem']['Product_Photo']): ?>
<tr><td class="tdleft"></td><td class="tdright"><img src="<?php echo @SITE_URL; ?>
upload/product/thumb/<?php echo $this->_tpl_vars['rowItem']['Product_Photo']; ?>
" width="300"/></td></tr>
<?php endif; ?>
<tr><td class="tdleft">Ảnh bản đồ</td><td class="tdright"><input type="file" name="photoMap"></td></tr>
<?php if ($this->_tpl_vars['rowItem']['Product_Map']): ?>
<tr><td class="tdleft"></td><td class="tdright"><img src="<?php echo @SITE_URL; ?>
upload/map/<?php echo $this->_tpl_vars['rowItem']['Product_Map']; ?>
" width="300" /></td></tr>
<?php endif; ?>
</td></tr>
</table>
</div>





<?php echo '
    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date1",
        trigger    : "f_btn1",
        onSelect   : function() { this.hide() },
        showTime   : 24,
        dateFormat : "%d/%m/%Y %H:%M"
      });
      Calendar.setup({
        inputField : "f_date2",
        trigger    : "f_btn2",
        onSelect   : function() { this.hide() },
        showTime   : 24,
        dateFormat : "%d/%m/%Y %H:%M"
      });
    //]]></script>'; ?>


<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(false)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
</div>
</form>
</div>


