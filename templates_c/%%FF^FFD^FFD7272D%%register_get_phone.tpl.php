<?php /* Smarty version 2.6.10, created on 2012-02-13 16:55:13
         compiled from D:/AppServ/www/mobimart/templates/register_get_phone.tpl */ ?>
<div id="main-hotdeal" class="clearfix">
	<div>
	<?php $_from = $this->_tpl_vars['thisBanner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stt'] => $this->_tpl_vars['banner']):
?>
		<img src="<?php echo $this->_tpl_vars['banner']['banner_image']; ?>
" />
	<?php endforeach; endif; unset($_from); ?>
	</div>
	<div id="frmGetPhone" class="clearfix">
	<form action="" method="post" name="frmGetPhone">
	<table class="tblRegister tblRadius" align="center" width="500">
		<thead>
			<tr>
				<th colspan="2"><?php echo $this->_tpl_vars['page_title']; ?>
</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($this->_tpl_vars['message']): ?>
			<tr>
				<td colspan="2" style="text-align:center;"><span style="color:red;"><?php echo $this->_tpl_vars['message']; ?>
</span></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Họ và tên</td>
				<td><input type="text" class="txtInput inputCSS3" name="name" /></td>
			</tr>
			<tr>
				<td>Số điện thoại</td>
				<td><input type="text" class="txtInput inputCSS3" name="phone" /></td>
			</tr>
			<tr>
				<td>Địa chỉ</td>
				<td><input type="text" class="txtInput inputCSS3" name="address" /></td>
			</tr>
			<tr>
				<td>Hình thức mua hàng</td>
				<td>
				<select name="payment" class="selectbox inputCSS3">
					<option value="cod">Giao hàng tận nhà</option>
					<option value="store">Trực tiếp đến cửa hàng</option>
				</select>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td>
				<input type="submit" class="btsubmit btsubmitCSS3" value="Đăng ký ngay" />
				</td>
			</tr>
		</tfoot>
	</table>
	</form>
	</div>
</div>