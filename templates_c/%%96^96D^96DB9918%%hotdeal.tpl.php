<?php /* Smarty version 2.6.10, created on 2012-01-10 14:16:02
         compiled from D:%5CAppServ%5Cwww%5Cmobimart/templates/administrator/hotdeal.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>...:: HOT DEAL ::...</title>
<link href="../administrator/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<table cellpadding="0" cellspacing="0" align="center" border="0" style="border-collapse:collapse " width="770" bgcolor="#FFFFFF">
		<tr>
	    	<td><?php include"top.php"; ?></td>
		</tr>
		<tr>
			<td>
				<?php if ($this->_tpl_vars['task'] == 'addnew'): ?>
				<div id="main-form" class="">
					<table cellpadding="2" cellspacing="0" border="0" width="100%">
					   <thead>
					   	<tr>
					   		<th colspan="2"><?php echo $this->_tpl_vars['page_title']; ?>
</th>
					   	</tr>
					   </thead>
					   <tbody>
					   	<tr>
					   		<td width="30%">Chọn sản phẩm</td>
					   		<td width="70%">
					   		<select name="product_id" class="adm_selectbox">
					   			<option value="">Lựa chọn sản phẩm</option>
					   			<option value="1">Nokia E62</option>
					   			<option value="2">Nokia E7</option>
					   			<option value="3">Nokia E73</option>
					   		</select>
					   		</td>
					   	</tr>
					   	<tr>
					   		<td>Giá khuyến mại</td>
					   		<td><input type="text" name="price_hotdeal" class="adm_inputbox" value="" /></td>
					   	</tr>
					   	<tr>
					   		<td>Mức giảm</td>
					   		<td><input type="text" name="price_hotdeal" class="adm_inputbox" value="" disabled="disabled" /> (%)</td>
					   	</tr>
					   	<tr>
					   		<td>Tiêu đề sản phẩm</td>
					   		<td><input type="text" name="title" class="adm_inputbox" value="" /></td>
					   	</tr>
					   	<tr>
					   		<td>Mô tả sản phẩm</td>
					   		<td><textarea cols="30" rows="5" name="description"></textarea></td>
					   	</tr>
					   	<tr>
					   		<td>Ảnh tính năng</td>
					   		<td><input type="file" name="image" class="adm_inputbox" value="" /></td>
					   	</tr>
					   	<tr>
					   		<td>Ngày bắt đầu</td>
					   		<td><input type="text" name="start_date" class="adm_inputbox" value="" /></td>
					   	</tr>
					   	<tr>
					   		<td>Ngày kết thúc</td>
					   		<td><input type="text" name="end_date" class="adm_inputbox" value="" /></td>
					   	</tr>
					   	<tr>
					   		<td>Trạng thái</td>
					   		<td><input type="checkbox" name="published" class="adm_chk" value="1" /></td>
					   	</tr>
					   </tbody>
					   <tfoot>
					   	<tr>
					   		<td></td>
					   		<td>
					   			<input type="submit" class="adm_button" value="<?php echo $this->_tpl_vars['submit']; ?>
" />
					   			<input type="reset" class="adm_button" value="<?php echo $this->_tpl_vars['reset']; ?>
" />
					   			<input type="hidden" name="do" value="save" />
					   		</td>
					   	</tr>
					   </tfoot>
					</table>
				</div>	
				<?php else: ?>
				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td><?php include"foot.php"; ?></td>
		</tr>
	</table>
</body>
</html>