<div id="toolbar-box">
   <div class="t">
   	<div class="t">
   		<div class="t"></div>
   	</div>
   </div>
   <div class="m">
	   <div id="toolbar" class="toolbar">
	   		{literal}
	   		<script language="javascript" type="text/javascript">
			function submitbutton(pressbutton) {
				if (pressbutton == 'remove') {
					if (document.adminForm.boxchecked.value == 0) {
						alert("Không có bản ghi nào được lựa chọn !");
					} else if ( confirm("Bạn có chắc rằng muốn xóa bản ghi này không?")) {
						submitform('remove');
					}
				} else {
					submitform(pressbutton);
				}
			}
			</script>
			{/literal}
	   		<table class="toolbar toolbar_small">
	   			<tbody>
	   				<tr>
	   					{if $task == "add" || $task == "edit"}
	   					<td id="toolbar-save" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('save');">
	   							<span title="Lưu lại" class="icon-32-save"></span>
	   							Lưu lại
	   						</a>
	   					</td>
	   					<td id="toolbar-cancel" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('cancel');">
	   							<span title="Hủy bỏ" class="icon-32-cancel"></span>
	   							Hủy bỏ
	   						</a>
	   					</td>
	   					<td id="toolbar-help" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('help');">
	   							<span title="Trợ giúp" class="icon-32-help"></span>
	   							Trợ giúp
	   						</a>
	   					</td>
	   					{else}
	   					<td id="toolbar-save" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('add');">
	   							<span title="Thêm mới" class="icon-32-new"></span>
	   							Thêm mới
	   						</a>
	   					</td>
	   					<td id="toolbar-export" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('export');">
	   							<span title="Xuất file excel" class="icon-32-export"></span>
	   							Export
	   						</a>
	   					</td>
	   					<td id="toolbar-delete" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('remove');">
	   							<span title="Xóa" class="icon-32-delete"></span>
	   							Xóa
	   						</a>
	   					</td>
	   					{/if}
	   				</tr>
	   			</tbody>
	   		</table>
	   </div>
	   <div class="header customer">{$page_title}</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
</div>
{if $task == "add" || $task == "edit"}
<form action="admin.customer_hotdeal.php" method="post" name="adminForm">
{$error}
<table class="adminTable">
   <tbody>
   	<tr>
   		<td>Lựa chọn Hot Deal</td>
   		<td>
   		<select name="hotdeal_id" class="adm_selectbox">
   			<option value="">Lựa chọn hot deal</option>
   			{section name=loops loop=$lsHotDeal}
   			<option {if $thisCus->hotdeal_id==$lsHotDeal[loops].id}selected="selected"{/if} value="{$lsHotDeal[loops].id}">{$lsHotDeal[loops].title}</option>
   			{/section}
   		</select>
   		</td>
   	</tr>
   	<tr>
   		<td>Tên khách hàng: </td>
   		<td><input type="text" name="name" class="adm_inputbox" value="{$thisCus->name}" /></td>
   	</tr>
   	<tr>
   		<td>Địa chỉ Email: </td>
   		<td><input type="text" name="email" class="adm_inputbox" value="{$thisCus->email}" /></td>
   	</tr>
   	<tr>
   		<td>Số điện thoại: </td>
   		<td><input type="text" name="phone" class="adm_inputbox" value="{$thisCus->phone}" /></td>
   	</tr>
   	<tr>
   		<td>Địa chỉ: </td>
   		<td><input type="text" name="address" class="adm_inputbox" value="{$thisCus->address}" /></td>
   	</tr>
   	<tr>
   		<td>Ngày mua: </td>
   		<td><input type="text" name="date" id="date" class="adm_inputbox" value="{$thisCus->date}" /></td>
   	</tr>
   	<tr>
   		<td>Số tiền đã mua: </td>
   		<td><input type="text" name="price" class="adm_inputbox" value="{$thisCus->price}" /></td>
   	</tr>
   	<tr>
   		<td>Mua giá khuyến mãi</td>
   		<td><input type="checkbox" name="is_promotion" class="adm_chk" {if $thisCus->is_promotion == 1} checked="checked"{/if} value="1" /> Có</td>
   	</tr>
   </tbody>
   <tfoot>
   	<tr>
   		<td></td>
   		<td>
   			<input type="hidden" name="id" value="{$thisCus->id}" />
   			<input type="hidden" name="task" value="save" />
   		</td>
   	</tr>
   </tfoot>
</table>
</form>
{else}
<form name="adminForm" method="post" action="admin.customer_hotdeal.php">
	<table style="margin-bottom:5px;">
		<tbody>
			<tr>
				<td width="100%" align="left">
					Bộ lọc:
					<input type="text" title="Lọc theo họ tên khách hàng, email khách hàng hoặc tên sản phẩm khách mua" onchange="document.adminForm.submit();" class="text_area" size="40" value="{$search}" id="search" name="search" />
					<button onclick="this.form.submit();">Go</button>
					<button onclick="document.getElementById('search').value='';document.getElementById('filter_status').value=3;document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_hotdeal" name="filter_hotdeal">
						<option value="">Lựa chọn theo Hotdeal</option>
						{section name=loops loop=$lsHotdeals}
						<option {if $lsHotdeals[loops].id==$filter_hotdeal}selected="selected"{/if} value="{$lsHotdeals[loops].id}">{$lsHotdeals[loops].title}</option>
						{/section}
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_product" name="filter_product">
						<option value="">Lựa chọn theo sản phẩm</option>
						{section name=loops loop=$lsProducts}
						<option {if $lsProducts[loops].product_id==$filter_product}selected="selected"{/if} value="{$lsProducts[loops].product_id}">{$lsProducts[loops].name}</option>
						{/section}
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option {if $filter_status==3}selected="selected"{/if} value="3">- Lọc theo giá mua -</option>
						<option {if $filter_status==1}selected="selected"{/if} value="1">Mua giá khuyến mãi</option>
						<option {if $filter_status==0}selected="selected"{/if} value="0">Mua giá thường</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<table cellspacing="1" class="adminlist">
		<thead>
			<tr>
				<th width="5">#</th>
				<th width="5">
					<input type="checkbox" onclick="checkAll(50);" value="" name="toggle">
				</th>
				<th class="title" nowrap="nowrap" style="text-align: left; padding-left: 5px;">
					<strong>Tên khách hàng</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Email</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Số điện thoại</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Địa chỉ</strong>
				</th>	
				<th class="title" nowrap="nowrap">
					<strong>Ngày mua</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Giá tiền</strong>
				</th>
				<th width="15" nowrap="nowrap">
					<strong>Thứ tự mua</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Tên chương trình</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Sản phẩm</strong>
				</th>
				<th width="10" nowrap="nowrap">
					<strong>Giá khuyến mãi</strong>
				</th>
				<th class="title" nowrap="nowrap">
					<strong>Hình thức</strong>
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$lsCus}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$lsCus[loops].id}" name="cid[]" id="cb{$lsCus[loops].id}">
				</td>
				<td>
					<a href="admin.customer_hotdeal.php?task=edit&id={$lsCus[loops].id}">{$lsCus[loops].name}</a>
				</td>
				<td align="center">
					{$lsCus[loops].email}
				</td>
				<td align="center">{$lsCus[loops].phone}</td>
				<td align="center">{$lsCus[loops].address}</td>
				<td align="left">{$lsCus[loops].date}</td>
				<td align="center">{$lsCus[loops].price|number_format} VNĐ</td>
				<td align="center">{$lsCus[loops].order_product}</td>
				<td align="center">{$lsCus[loops].hotdeal_name}</td>
				<td align="center">{$lsCus[loops].name_product}</td>
				<td align="center">{if $lsCus[loops].is_promotion == 1} <b style="color:#85B21D;">Có</b> {else} <b style="color:red;">Không</b> {/if}</td>
				<td align="center">
					{if $lsCus[loops].payment=="cod"}
					Giao hàng tận nhà
					{elseif $lsCus[loops].payment=="store"}
					Trực tiếp đến cửa hàng
					{/if}
				</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="13" align="center"><font color="red">Không tồn tại bản ghi nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="13">
					{$datapage}
				</td>
			</tr>
		</tfoot>
	</table>
	
	<input type="hidden" value="{$task}" name="task">
	<input type="hidden" value="" name="boxchecked">
	<input type="hidden" value="{$total_record}" name="total_record" id="total_record" />
</form>
{/if}