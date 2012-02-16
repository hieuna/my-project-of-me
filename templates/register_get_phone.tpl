<div id="main-hotdeal" class="clearfix">
	<div>
	{foreach from=$thisBanner key=stt item=banner}
		<img src="{$banner.banner_image}" />
	{/foreach}
	</div>
	<div id="frmGetPhone" class="clearfix">
	<form action="" method="post" name="frmGetPhone">
	<table class="tblRegister tblRadius" align="center" width="500">
		<thead>
			<tr>
				<th colspan="2">{$page_title}</th>
			</tr>
		</thead>
		<tbody>
			{if $message}
			<tr>
				<td colspan="2" style="text-align:center;"><span style="color:red;">{$message}</span></td>
			</tr>
			{/if}
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