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
	   					<td id="toolbar-published" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('publish');">
	   							<span title="Hiển thị" class="icon-32-publish"></span>
	   							Cấp quyền
	   						</a>
	   					</td>
	   					<td id="toolbar-uhpublished" class="button">
	   						<a class="toolbar" onclick="javascript: submitbutton('unpublish');">
	   							<span title="Ẩn đi" class="icon-32-unpublish"></span>
	   							Khóa
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
	   <div class="header">{$page_title}</div>
	   <div class="clr"></div>
   </div>
   <div class="b">
   		<div class="b">
   			<div class="b"></div>
   		</div>
   </div>
   {if $mosmsg}<div class="message">{$mosmsg}</div>{/if}
</div>
<div style="display:none" id="blockErr">
  <fieldset class="adminform">
    <legend>Xảy ra lỗi sau</legend>
    <table class="admintable" width="100%">
      <tr><td><font color="Red"><span id="strErr">{$errorTxt}</span></font></td></tr>
    </table>
  </fieldset>
</div>
{if $task=="view"}
<form name="adminForm" method="post" action="{$page}.php">
<table style="margin-bottom:5px;">
		<tbody>
			<tr>

				<td nowrap="nowrap" width="100%">
					<strong>Mã Site:</strong>
					<input type="text" size="10" value="{$filter_site_code}" id="filter_site_code" name="filter_site_code" />

					<strong  style="margin-left: 10px;">Tên Site:</strong>
					<input type="text" size="20" value="{$filter_site_name}" id="filter_site_name" name="filter_site_name" />

					<strong style="margin-left: 10px;">Domain:</strong>
					<input type="text" size="20" value="{$filter_site_domain}" id="filter_site_domain" name="filter_site_domain" />

					<strong style="margin-left: 10px;">Email:</strong>
					<input type="text" size="20" value="{$filter_site_emails}" id="filter_site_emails" name="filter_site_emails" />

					<button onclick="this.form.submit();">Tìm kiếm</button>

					<button onclick="document.getElementById('filter_site_code').value='';document.getElementById('filter_site_name').value='';document.getElementById('filter_site_domain').value='';document.getElementById('filter_site_emails').value='';document.getElementById('site_publish').value=3;document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>

				</td>

				<td nowrap="nowrap" style="text-align: right">
					<strong style="margin-left: 20px;">Trạng thái:</strong>

					<select style="text-align: right" onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_site_publish" name="filter_site_publish">
						<option {if $filter_site_publish == 3}selected="selected"{/if} value="3">- Trạng thái -</option>
						<option {if $filter_site_publish == 0}selected="selected"{/if} value="0">Ẩn</option>
						<option {if $filter_site_publish == 1}selected="selected"{/if} value="1">Hiển thị</option>
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
				<th class="title" nowrap="nowrap">ID</th>
				<th class="title" nowrap="nowrap">Tên site</th>
				<th class="title" nowrap="nowrap">Domain</th>
				<th class="title" nowrap="nowrap">Email</th>
				<th class="title" nowrap="nowrap">Phone</th>
				<th class="title" nowrap="nowrap">Shipping</th>
				<th class="title" nowrap="nowrap">Coupon</th>
				<th class="title" nowrap="nowrap">Active</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$arySite}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$arySite[loops].site_id}" name="cid[]" id="cb{$smarty.section.loops.index}">
				</td>
				<td>{$arySite[loops].site_id}</td>
				<td><a href="admin.sites.php?task=edit&id={$arySite[loops].site_id}" title="Click để sửa thông tin site này">{$arySite[loops].site_name}</a></td>
				<td>{$arySite[loops].site_domain}</td>
				<td>{$arySite[loops].site_emails}</td>
				<td>{$arySite[loops].site_phone}</td>

				<td>
					{if $arySite[loops].site_shipping_allow > 0}
						<img src="../images/icons/unblock16.gif" title="Nhận vận chuyển" />
					{/if}
					{if $arySite[loops].site_shipping_allow == 0}
						<img src="../images/icons/block16.gif" title="Không nhận vận chuyển" />
					{/if}
				</td>


				<td>
					{if $arySite[loops].site_use_coupon > 0}
						<img src="../images/icons/unblock16.gif" title="Có sử dụng Coupon" />
					{/if}
					{if $arySite[loops].site_use_coupon == 0}
						<img src="../images/icons/block16.gif" title="Không sử dụng Coupon" />
					{/if}
				</td>

				<td>
					{if $arySite[loops].site_publish > 0}
						<img src="../images/icons/unblock16.gif" title="Bật" />
					{/if}
					{if $arySite[loops].site_publish == 0}
						<img src="../images/icons/block16.gif" title="Tắt" />
					{/if}
				</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="13" align="center"><font color="red">Không tồn tại site nào thỏa mãn điều kiện tìm kiếm!</font></td>
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
</form>


{elseif $task=="new"}
<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
    <fieldset class="adminform">
      <legend>Nhập thông tin vào các mục</legend>
      <table class="admintable" width="100%">
        <tr>
          <td class="key"><label for="site_code">Mã site <font color="Red">*</font></label></td>
          <td><input type="text" name="site_code" id="site_code" value="" class="wid1" maxlength="100"></td>
        </tr>
        <tr>
          <td class="key"><label for="site_name">Tên site <font color="Red">*</font></label></td>
          <td><input type="text" name="site_name" id="site_name" value="" class="wid1" maxlength="255"></td>
        </tr>
        
        <tr>
          <td class="key"><label for="site_domain">Domain <font color="Red">*</font></label></td>
          <td><input type="text" name="site_domain" id="site_domain" value="" class="wid1" maxlength="255"></td>
        </tr>
        <tr>
          <td class="key"><label for="site_phone">Điện thoại <font color="Red">*</font></label></td>
          <td><input type="text" name="site_phone" id="site_phone" value="" class="wid1" maxlength="20"></td>
        </tr>
        <tr>
          <td class="key"><label for="site_emails">Email <font color="Red">*</font></label></td>
          <td><input type="text" name="site_emails" id="site_emails" value="" class="wid1" maxlength="200"></td>
        </tr>
        <!-- BEGIN Phí thanh toán cho người bán hàng -->
        <tr class="user_type_seller">
          <td class="key"><label for="site_name">Tên shop <font color="Red">*</font></label></td>
          <td><input type="text" maxlength="255" class="wid1" value="" id="site_name" name="site_name" /></td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_domain">Website</label></td>
          <td><input type="text" maxlength="255" class="wid1" value="" id="site_domain" name="site_domain" /></td>
        </tr>
        <!-- PHÍ MERCHANT -->
        <tr class="user_type_seller">
          <td class="key" style="text-align: left; color: #0B55C4;" colspan="2">Phí người mua chịu</td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_qt_feename">Tên phí (Quốc tế)</label></td>
          <td><input type="text" maxlength="255" class="wid1" value="Phí thanh toán thẻ" id="site_qt_feename" name="site_qt_feename" /></td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
          <td>
            <input type="text" name="site_qt_feeper" id="site_qt_feeper" value="0.033" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_qt_feefix">Phí cố định (Quốc tế) </label></td>
          <td><input type="text" name="site_qt_feefix" id="site_qt_feefix" value="4620" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="name">Tên phí (Nội địa) </label></td>
          <td>
            <input type="text" name="site_nd_feename" id="site_nd_feename" value="Phí thanh toán thẻ" class="wid1" maxlength="200" />
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_nd_feeper">Phí thanh toán (Nội địa) </label></td>
          <td>
            <input type="text" name="site_nd_feeper" id="site_nd_feeper" value="0.011" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_nd_feefix">Phí cố định (Nội địa) </label></td>
          <td>
          <input type="text" name="site_nd_feefix" id="site_nd_feefix" value="1760" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <!-- PHÍ MERCHANT -->
        <tr class="user_type_seller">
          <td class="key" style="text-align: left; color: #0B55C4;" colspan="2">Phí người bán chịu</td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_qt_feename">Tên phí (Quốc tế)</label></td>
          <td><input type="text" maxlength="255" class="wid1" value="(Miễn phí)" id="site_merchant_qt_feename" name="site_merchant_qt_feename" /></td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
          <td>
            <input type="text" name="site_merchant_qt_feeper" id="site_merchant_qt_feeper" value="0" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_qt_feefix">Phí cố định (Quốc tế) </label></td>
          <td><input type="text" name="site_merchant_qt_feefix" id="site_merchant_qt_feefix" value="0" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="name">Tên phí (Nội địa) </label></td>
          <td>
            <input type="text" name="site_merchant_nd_feename" id="site_merchant_nd_feename" value="(Miễn phí)" class="wid1" maxlength="200" />
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_nd_feeper">Phí thanh toán (Nội địa) </label></td>
          <td>
            <input type="text" name="site_merchant_nd_feeper" id="site_merchant_nd_feeper" value="0" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_nd_feefix">Phí cố định (Nội địa) </label></td>
          <td>
          <input type="text" name="site_merchant_nd_feefix" id="site_merchant_nd_feefix" value="0" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <!-- BEGIN coupon -->
        <tr class="user_type_seller">
          <td class="key"><label for="site_use_coupon">Dùng coupon</label></td>
          <td>
          <input type="checkbox" name="site_use_coupon" id="site_use_coupon" value="1" />
          </td>
        </tr>
        <tr class="user_coupon">
          <td class="key"><label for="site_coupon_fee">Phí coupon</label></td>
          <td>
          <input type="text" name="site_coupon_fee" id="site_coupon_fee" value="0" class="wid1" maxlength="100" /> (VNĐ/coupon)
          </td>
        </tr>
        <!-- END coupon -->  
        <!-- BEGIN shipping -->
        <tr class="user_type_seller">
          <td class="key"><label for="site_shipping_allow">Chấp nhận ship</label></td>
          <td>
          <input type="checkbox" name="site_shipping_allow" id="site_shipping_allow" value="1" />
          </td>
        </tr>
        <tr class="user_shipping">
          <td class="key"><label for="site_shipping_urban_fee">Phí ship nội thành</label></td>
          <td>
          <input type="text" name="site_shipping_urban_fee" id="site_shipping_urban_fee" value="0" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>        
        <tr class="user_shipping">
          <td class="key"><label for="site_shipping_suburb_fee">Phí ship ngoại thành</label></td>
          <td>
          <input type="text" name="site_shipping_suburb_fee" id="site_shipping_suburb_fee" value="0" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <tr class="user_shipping">
          <td class="key"><label for="site_shipping_interprv_fee">Phí ship liên tỉnh</label></td>
          <td>
          <input type="text" name="site_shipping_interprv_fee" id="site_shipping_interprv_fee" value="0" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <!-- END shipping -->
        <!-- END Phí thanh toán cho người bán hàng -->
      </table>
      <input type="hidden" value="{$task}" name="task">
      <input type="hidden" value="new" name="action">
    </fieldset>
  </form>
{elseif $task=="edit"}
<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
    <fieldset class="adminform">
      <legend>Nhập thông tin vào các mục</legend>
      <table class="admintable" width="100%">
        <tr>
          <td class="key"><label for="site_code">Mã site <font color="Red">*</font></label></td>
          <td><input type="text" name="site_code" id="site_code" value="{$arySite.site_code}" class="wid1" maxlength="100" readonly></td>
        </tr>
        <tr>
          <td class="key"><label for="site_name">Tên site <font color="Red">*</font></label></td>
          <td><input type="text" name="site_name" id="site_name" value="{$arySite.site_name}" class="wid1" maxlength="255"></td>
        </tr>
		<tr>
			<td class="key"><label for="site_secure_secret">Secure Secret</label></td>
			<td>{$arySite.site_secure_secret}</td>
		</tr>
        <tr>
          <td class="key"><label for="site_domain">Domain <font color="Red">*</font></label></td>
          <td><input type="text" name="site_domain" id="site_domain" value="{$arySite.site_domain}" class="wid1" maxlength="255"></td>
        </tr>
        <tr>
          <td class="key"><label for="site_phone">Điện thoại <font color="Red">*</font></label></td>
          <td><input type="text" name="site_phone" id="site_phone" value="{$arySite.site_phone}" class="wid1" maxlength="20"></td>
        </tr>
        <tr>
          <td class="key"><label for="site_emails">Email <font color="Red">*</font></label></td>
          <td><input type="text" name="site_emails" id="site_emails" value="{$arySite.site_emails}" class="wid1" maxlength="200"></td>
        </tr>
        <tr>
          <td class="key"><label for="site_sendemail">Cho phép gửi mail </label></td>
          <td>
          <input type="checkbox" name="site_sendemail" id="site_sendemail" value="1" {if $arySite.site_sendemail == 1}checked{/if}>
          </td>
        </tr>
        <!-- BEGIN Phí thanh toán cho người bán hàng -->
        <tr class="user_type_seller">
          <td class="key"><label for="site_name">Tên shop <font color="Red">*</font></label></td>
          <td><input type="text" maxlength="255" class="wid1" value="{$arySite.site_name}" id="site_name" name="site_name" /></td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_domain">Website</label></td>
          <td><input type="text" maxlength="255" class="wid1" value="{$arySite.site_domain}" id="site_domain" name="site_domain" /></td>
        </tr>
        <!-- PHÍ USER -->
        <tr class="user_type_seller">
          <td class="key" style="text-align: left; color: #0B55C4;" colspan="2">Phí người mua chịu</td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_qt_feename">Tên phí (Quốc tế)</label></td>
          <td><input type="text" maxlength="255" class="wid1" value="{$arySite.site_qt_feename}" id="site_qt_feename" name="site_qt_feename" /></td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
          <td>
            <input type="text" name="site_qt_feeper" id="site_qt_feeper" value="{$arySite.site_qt_feeper}" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_qt_feefix">Phí cố định (Quốc tế) </label></td>
          <td><input type="text" name="site_qt_feefix" id="site_qt_feefix" value="{$arySite.site_qt_feefix}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="name">Tên phí (Nội địa) </label></td>
          <td>
            <input type="text" name="site_nd_feename" id="site_nd_feename" value="{$arySite.site_nd_feename}" class="wid1" maxlength="200" />
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_nd_feeper">Phí thanh toán (Nội địa) </label></td>
          <td>
            <input type="text" name="site_nd_feeper" id="site_nd_feeper" value="{$arySite.site_nd_feeper}" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_nd_feefix">Phí cố định (Nội địa) </label></td>
          <td>
          <input type="text" name="site_nd_feefix" id="site_nd_feefix" value="{$arySite.site_nd_feefix}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <!-- PHÍ MERCHANT -->
        <tr class="user_type_seller">
          <td class="key" style="text-align: left; color: #0B55C4;" colspan="2">Phí người bán chịu</td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_qt_feename">Tên phí (Quốc tế)</label></td>
          <td><input type="text" maxlength="255" class="wid1" value="{$arySite.site_merchant_qt_feename}" id="site_merchant_qt_feename" name="site_merchant_qt_feename" /></td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
          <td>
            <input type="text" name="site_merchant_qt_feeper" id="site_merchant_qt_feeper" value="{$arySite.site_merchant_qt_feeper}" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_qt_feefix">Phí cố định (Quốc tế) </label></td>
          <td><input type="text" name="site_merchant_qt_feefix" id="site_merchant_qt_feefix" value="{$arySite.site_merchant_qt_feefix}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="name">Tên phí (Nội địa) </label></td>
          <td>
            <input type="text" name="site_merchant_nd_feename" id="site_merchant_nd_feename" value="{$arySite.site_merchant_nd_feename}" class="wid1" maxlength="200" />
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_nd_feeper">Phí thanh toán (Nội địa) </label></td>
          <td>
            <input type="text" name="site_merchant_nd_feeper" id="site_merchant_nd_feeper" value="{$arySite.site_merchant_nd_feeper}" class="wid1" maxlength="200" />
            (%)
          </td>
        </tr>
        <tr class="user_type_seller">
          <td class="key"><label for="site_merchant_nd_feefix">Phí cố định (Nội địa) </label></td>
          <td>
          <input type="text" name="site_merchant_nd_feefix" id="site_merchant_nd_feefix" value="{$arySite.site_merchant_nd_feefix}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <!-- BEGIN coupon -->
        <tr class="user_type_seller">
          <td class="key"><label for="site_use_coupon">Sử dụng coupon</label></td>
          <td>
          <input type="checkbox" name="site_use_coupon" id="site_use_coupon" {if $arySite.site_use_coupon==1}checked="checked"{/if} value="1" />
          </td>
        </tr>
        <tr class="user_coupon">
          <td class="key"><label for="site_coupon_fee">Phí coupon</label></td>
          <td>
          <input type="text" name="site_coupon_fee" id="site_coupon_fee" value="{$arySite.site_coupon_fee}" class="wid1" maxlength="100" />
          (VNĐ/coupon)
          </td>
        </tr>
        <!-- END coupon --> 
        <!-- BEGIN shipping -->
        <tr class="user_type_seller">
          <td class="key"><label for="site_shipping_allow">Chấp nhận ship</label></td>
          <td>
          <input type="checkbox" name="site_shipping_allow" id="site_shipping_allow" {if $arySite.site_shipping_allow==1}checked="checked"{/if} value="1" />
          </td>
        </tr>
        <tr class="user_shipping">
          <td class="key"><label for="site_shipping_urban_fee">Phí ship nội thành</label></td>
          <td>
          <input type="text" name="site_shipping_urban_fee" id="site_shipping_urban_fee" value="{$arySite.site_shipping_urban_fee}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>        
        <tr class="user_shipping">
          <td class="key"><label for="site_shipping_suburb_fee">Phí ship ngoại thành</label></td>
          <td>
          <input type="text" name="site_shipping_suburb_fee" id="site_shipping_suburb_fee" value="{$arySite.site_shipping_suburb_fee}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <tr class="user_shipping">
          <td class="key"><label for="site_shipping_interprv_fee">Phí ship liên tỉnh</label></td>
          <td>
          <input type="text" name="site_shipping_interprv_fee" id="site_shipping_interprv_fee" value="{$arySite.site_shipping_interprv_fee}" class="wid1" maxlength="100" />
          (VNĐ)
          </td>
        </tr>
        <!-- END shipping -->        
        <!-- END Phí thanh toán cho người bán hàng -->
      </table>
      <input type="hidden" value="{$task}" name="task">
      <input type="hidden" value="edit" name="action">
      <input type="hidden" value="{$siteId}" name="id">
    </fieldset>
  </form>
{/if}

{literal}
<script language="javascript">

function submitform(pressbutton){
	var action = document.adminForm.action.value;
	
	if (pressbutton == 'save') {
		if (action == 'new') {
			objSites.processAction("admin_sites.php?task=new&ajax=1");
		}
		else if (action == 'edit') {
			objSites.processAction("admin_sites.php?task=edit&ajax=1");
		}
	}
	else {
		if (pressbutton) {
			document.adminForm.task.value=pressbutton;
		}
		document.adminForm.submit();
	}
}

if (typeof objSites == 'undefined') {
  objSites = {
    processAction: function(sUrl) {
      $.ajax({
        type: "POST",
        url: sUrl,
        data: $("#adminForm").serialize(),
        dataType: "json",
        success: function(xmlhttp){
          var objData = xmlhttp;
          if (parseInt(objData.intOK) > 0) {
            document.location = "admin_sites.php";
          } else {
            $("#strErr").attr("innerHTML", objData.strError);
            $("#blockErr").css("display", "block");
          }
        }
      });
      return false;
    }
  }
}
</script>
{/literal}
