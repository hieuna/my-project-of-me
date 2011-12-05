{include file='admin_header.tpl'}
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
				<td width="100%">
					Bộ lọc:
					<input type="text" title="Lọc theo Email thành viên, Tên đăng nhập hoặc Họ tên thành viên" onchange="document.adminForm.submit();" class="text_area" size="40" value="{$search}" id="search" name="search" />
					<button onclick="this.form.submit();">Go</button>
					<button onclick="document.getElementById('search').value='';document.getElementById('filter_usertype').value='0';document.getElementById('filter_statusemail').value='-1';document.getElementById('filter_statusmobile').value='-1';document.getElementById('filter_status').value='-1';document.getElementById('limit').value='50';document.adminForm.p.value=1;">Reset</button>
				</td>
				<td nowrap="nowrap">
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_usertype" name="filter_usertype">
						<option value="0" {if $type_user==0} selected{/if}>- Kiểu user -</option>
	            		{foreach from=$typeUser key=k item=typeuser}
	            		<option value="{$k}"{if $k==$type_user} selected{/if}>{$typeuser}</option>
	            		{/foreach}
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_status" name="filter_status">
						<option {if $filter_status==-1}selected="selected"{/if} value="-1">- Trạng thái user -</option>
						<option {if $filter_status==1}selected="selected"{/if} value="1">Đã kích hoạt</option>
						<option {if $filter_status==0}selected="selected"{/if} value="0">Chưa kích hoạt</option>
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_statusemail" name="filter_statusemail">
						<option {if $filter_statusemail==-1}selected="selected"{/if} value="-1">- Xác thực email -</option>
						<option {if $filter_statusemail==1}selected="selected"{/if} value="1">Đã xác thực</option>
						<option {if $filter_statusemail==0}selected="selected"{/if} value="0">Chưa xác thực</option>
					</select>
					<select onchange="document.adminForm.submit();" size="1" class="inputbox" id="filter_statusmobile" name="filter_statusmobile">
						<option {if $filter_statusmobile==-1}selected="selected"{/if} value="-1">- Xác thực mobile -</option>
						<option {if $filter_statusmobile==1}selected="selected"{/if} value="1">Đã xác thực</option>
						<option {if $filter_statusmobile==0}selected="selected"{/if} value="0">Chưa xác thực</option>
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
				<th class="title" nowrap="nowrap">
					Thông tin user
				</th>
				<th class="title" nowrap="nowrap">
					Mobile
				<th class="title" nowrap="nowrap">
					Số tiền
				</th>
				<th class="title" nowrap="nowrap">
					Địa chỉ
				</th>
				<th class="title" nowrap="nowrap">
					Lần truy cập gần nhất
				</th>
				<th class="title">
					Kiểu user
				</th>
				<th class="title" nowrap="nowrap">
					Hành động
				</th>
			</tr>
		</thead>
		<tbody>
			{section name=loops loop=$member}
			<tr class="row{if $smarty.section.loops.index%2==0}0{else}1{/if}">
				<td>{$smarty.section.loops.index+1}</td>
				<td align="center">
					<input type="checkbox" onclick="isChecked(this.checked);" value="{$member[loops].user_id}" name="cid[]" id="cb{$smarty.section.loops.index}">
				</td>
				<td>
				<a href="admin_members.php?task=edit&id={$member[loops].user_id}" title="Click để sửa thông tin user này">
				<b>{$member[loops].user_email}</b></a>
				{if $member[loops].user_fullname}<br>{$member[loops].user_fullname}{/if}<br>
				{if $member[loops].user_verified}
				<font color="#0B55C4">Đã xác thực</font>{else}<font color="red">Chưa xác thực</font>{/if}
				</td>
				<td align="center">
				<b>{$member[loops].user_mobile}</b><br>
				{if $member[loops].user_verified_mobile}
				<font color="#0B55C4">Đã xác thực</font>{else}<font color="red">Chưa xác thực</font>{/if}
				</td>
				<td align="center">{$member[loops].user_gold|number_format}</td>
				<td align="left">
					{$member[loops].user_address} - {$member[loops].user_district} - {$member[loops].user_city}
				</td>
				<td align="center">
					{$member[loops].user_lastlogindate}
				</td>
				<td align="center">
				{$member[loops].user_type}
				</td>
				<td align="center">
				<img alt="Log" title="Xem log" src="../images/icons/admin_reports16.gif" style="cursor:pointer">&nbsp;
				<img alt="Sửa" title="Sửa" src="../images/icons/action_postcomment.gif" style="cursor:pointer" onclick="document.location='admin_members.php?task=edit&id={$member[loops].user_id}'">&nbsp;
				<img alt="Xóa" title="Xóa" src="../images/icons/action_delete2.gif" style="cursor:pointer" onclick="document.location='admin_members.php?task=delete&cid[]={$member[loops].user_id}'">
				</td>
			</tr>
			{sectionelse}
			<tr>
				<td colspan="11" align="center"><font color="red">Không tồn tại user nào thỏa mãn điều kiện tìm kiếm!</font></td>
			</tr>
			{/section}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="11">
					{$datapage}
				</td>
			</tr>
		</tfoot>
	</table>
	
	<input type="hidden" value="{$task}" name="task">
	<input type="hidden" value="" name="boxchecked">
	<input type="hidden" value="{$filter_order_Dir}" name="filter_order_Dir" />
	<input type="hidden" value="{$total_record}" name="total_record" id="total_record" />
</form>


{elseif $task=="new"}
	<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
		<fieldset class="adminform">
			<legend>Nhập thông tin vào các mục</legend>
			<table class="admintable" width="100%">
				<tr>
					<td class="key"><label for="user_email"><font color="red">*</font> Email </label></td>
					<td><input type="text" name="user_email" id="user_email" value="{$aryUser.user_email}" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="user_fullname"><font color="red">*</font> Họ tên </label></td>
					<td><input type="text" name="user_fullname" id="user_fullname" value="{$aryUser.user_fullname}" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="user_password"><font color="red">*</font> Nhập mật khẩu</label></td>
					<td><input type="password" name="user_password" id="user_password" value="" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="user_mobile"><font color="red">*</font> Số điện thoại</label></td>
					<td><input type="user_mobile" name="user_mobile" id="user_password" value="{$aryUser.user_mobile}" class="wid1" maxlength="50" onkeypress="return numberOnly(this, event);"></td>
				</tr>
				<tr>
					<td class="key"><label for="name"><font color="red">*</font> Địa chỉ 1</label></td>
					<td>
					<select name="user_city" id="user_city" style="width:190px" onchange="objMember.addDistrict('user_district', this)">
						<option value="0">- Tỉnh/Thành phố -</option>
						{foreach from=$city key=k item=ct}
	            		<option value="{$ct.city_id}"{if $ct.city_id==$aryUser.user_city} selected{/if}>{$ct.city_name}</option>
	            		{/foreach}
					</select>
					<select name="user_district" id="user_district" style="width:190px">
						<option value="">- Quận/Huyện/Thị xã -</option>
						{foreach from=$district key=k item=dc}
						{if $dc.district_city_id == $aryUser.user_city}
	            		<option value="{$dc.district_id}"{if $dc.district_id==$aryUser.user_district} selected{/if}>{$dc.district_name}</option>
	            		{/if}
	            		{/foreach}
					</select>
					<input type="text" name="user_address" id="user_address" value="{$aryUser.user_address}" class="wid1" maxlength="255">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Địa chỉ 2</label></td>
					<td>
					<select name="user_city2" id="user_city2" style="width:190px" onchange="objMember.addDistrict('user_district2', this)">
						<option value="0">- Tỉnh/Thành phố -</option>
						{foreach from=$city key=k item=ct}
	            		<option value="{$ct.city_id}"{if $ct.city_id==$aryUser.user_city2} selected{/if}>{$ct.city_name}</option>
	            		{/foreach}
					</select>
					<select name="user_district2" id="user_district2" style="width:190px">
						<option value="">- Quận/Huyện/Thị xã -</option>
						{foreach from=$district key=k item=dc}
						{if $dc.district_city_id == $aryUser.user_city2}
	            		<option value="{$dc.district_id}"{if $dc.district_id==$aryUser.user_district2} selected{/if}>{$dc.district_name}</option>
	            		{/if}
	            		{/foreach}
					</select>
					<input type="text" name="user_address2" id="user_address2" value="{$aryUser.user_address2}" class="wid1" maxlength="255">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Xác thực email</label></td>
					<td>
						<select name="user_verified" id="user_verified" style="width:190px">
							<option value="0" {if $aryUser.user_verified == 0}selected='selected'{/if}>Chưa xác thực</option>
							<option value="1" {if $aryUser.user_verified == 1}selected='selected'{/if}>Đã xác thực</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Xác thực mobile</label></td>
					<td>
						<select name="user_verified_mobile" id="user_verified_mobile" style="width:190px">
							<option value="0" {if $aryUser.user_verified_mobile == 0}selected='selected'{/if}>Chưa xác thực</option>
							<option value="1" {if $aryUser.user_verified_mobile == 1}selected='selected'{/if}>Đã xác thực</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Trạng thái</label></td>
					<td>
						<select name="user_enabled" id="user_enabled" style="width:190px">
							<option value="0" {if $aryUser.user_enabled == 0}selected='selected'{/if}>Chưa kích hoạt</option>
							<option value="1" {if $aryUser.user_enabled == 1}selected='selected'{/if}>Đã kích hoạt</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Kiểu user</label></td>
					<td>
						<select name="user_type" id="user_type" style="width:190px">
							<option value="1" {if $aryUser.user_type == 1}selected='selected'{/if}>Người mua</option>
							<option value="2" {if $aryUser.user_type == 2}selected='selected'{/if}>Người bán</option>
						</select>
					</td>
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
        <tr class="user_type_seller">
					<td class="key"><label for="site_use_coupon">Dùng coupon</label></td>
					<td>
					<input type="checkbox" name="site_use_coupon" id="site_use_coupon" value="1" />
					</td>
				</tr>
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
        <!-- END shipping -->
        <!-- END Phí thanh toán cho người bán hàng -->
			</table>
			<input type="hidden" value="{$task}" name="task">
			<input type="hidden" value="new" name="action">
			<input type="hidden" value="{$userId}" name="id" id="id">
		</fieldset>
	</form>
{elseif $task=="edit"}
	<form name="adminForm" id="adminForm" method="post" action="{$page}.php">
		<fieldset class="adminform">
			<legend>Nhập thông tin vào các mục</legend>
			<table class="admintable" width="100%">
				<tr>
					<td class="key"><label for="user_email"><font color="red">*</font> Email </label></td>
					<td><input type="text" name="user_email" id="user_email" value="{$aryUser.user_email}" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="user_fullname"><font color="red">*</font> Họ tên </label></td>
					<td><input type="text" name="user_fullname" id="user_fullname" value="{$aryUser.user_fullname}" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="user_password">Đổi mật khẩu</label></td>
					<td><input type="password" name="user_password" id="user_password" value="" class="wid1" maxlength="100"></td>
				</tr>
				<tr>
					<td class="key"><label for="user_mobile"><font color="red">*</font> Số điện thoại</label></td>
					<td><input type="user_mobile" name="user_mobile" id="user_password" value="{$aryUser.user_mobile}" class="wid1" maxlength="50" onkeypress="return numberOnly(this, event);"></td>
				</tr>
				<tr>
					<td class="key"><label for="name"><font color="red">*</font> Địa chỉ 1</label></td>
					<td>
					<select name="user_city" id="user_city" style="width:190px" onchange="objMember.addDistrict('user_district', this)">
						{foreach from=$city key=k item=ct}
	            		<option value="{$ct.city_id}"{if $ct.city_id==$aryUser.user_city} selected{/if}>{$ct.city_name}</option>
	            		{/foreach}
					</select>
					<select name="user_district" id="user_district" style="width:190px">
						{foreach from=$district key=k item=dc}
						{if $dc.district_city_id == $aryUser.user_city}
	            		<option value="{$dc.district_id}"{if $dc.district_id==$aryUser.user_district} selected{/if}>{$dc.district_name}</option>
	            		{/if}
	            		{/foreach}
					</select>
					<input type="text" name="user_address" id="user_address" value="{$aryUser.user_address}" class="wid1" maxlength="255">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Địa chỉ 2</label></td>
					<td>
					<select name="user_city2" id="user_city2" style="width:190px" onchange="objMember.addDistrict('user_district2', this)">
						<option value="0">- Tỉnh/Thành phố -</option>
						{foreach from=$city key=k item=ct}
	            		<option value="{$ct.city_id}"{if $ct.city_id==$aryUser.user_city2} selected{/if}>{$ct.city_name}</option>
	            		{/foreach}
					</select>
					<select name="user_district2" id="user_district2" style="width:190px">
						<option value="">- Quận/Huyện/Thị xã -</option>
						{foreach from=$district key=k item=dc}
						{if $dc.district_city_id == $aryUser.user_city2}
	            		<option value="{$dc.district_id}"{if $dc.district_id==$aryUser.user_district2} selected{/if}>{$dc.district_name}</option>
	            		{/if}
	            		{/foreach}
					</select>
					<input type="text" name="user_address2" id="user_address2" value="{$aryUser.user_address2}" class="wid1" maxlength="255">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Xác thực email</label></td>
					<td>
						<select name="user_verified" id="user_verified" style="width:190px">
							<option value="0" {if $aryUser.user_verified == 0}selected='selected'{/if}>Chưa xác thực</option>
							<option value="1" {if $aryUser.user_verified == 1}selected='selected'{/if}>Đã xác thực</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Xác thực mobile</label></td>
					<td>
						<select name="user_verified_mobile" id="user_verified_mobile" style="width:190px">
							<option value="0" {if $aryUser.user_verified_mobile == 0}selected='selected'{/if}>Chưa xác thực</option>
							<option value="1" {if $aryUser.user_verified_mobile == 1}selected='selected'{/if}>Đã xác thực</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Trạng thái</label></td>
					<td>
						<select name="user_enabled" id="user_enabled" style="width:190px">
							<option value="0" {if $aryUser.user_enabled == 0}selected='selected'{/if}>Chưa kích hoạt</option>
							<option value="1" {if $aryUser.user_enabled == 1}selected='selected'{/if}>Đã kích hoạt</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Kiểu user</label></td>
					<td>
						<select name="user_type" id="user_type" style="width:190px">
							<option value="1" {if $aryUser.user_type == 1}selected='selected'{/if}>Người mua</option>
							<option value="2" {if $aryUser.user_type == 2}selected='selected'{/if}>Người bán</option>
						</select>
					</td>
				</tr>
        <!-- BEGIN Phí thanh toán cho người bán hàng -->
        <tr class="user_type_seller">
					<td class="key"><label for="site_name">Tên shop <font color="Red">*</font></label></td>
					<td><input type="text" maxlength="255" class="wid1" value="{$aryUser.site_name}" id="site_name" name="site_name" /></td>
				</tr>
        <tr class="user_type_seller">
					<td class="key"><label for="site_domain">Website</label></td>
					<td><input type="text" maxlength="255" class="wid1" value="{$aryUser.site_domain}" id="site_domain" name="site_domain" /></td>
				</tr>
        <!-- PHÍ USER -->
        <tr class="user_type_seller">
					<td class="key" style="text-align: left; color: #0B55C4;" colspan="2">Phí người mua chịu</td>
				</tr>
        <tr class="user_type_seller">
					<td class="key"><label for="site_qt_feename">Tên phí (Quốc tế)</label></td>
					<td><input type="text" maxlength="255" class="wid1" value="{$aryUser.site_qt_feename}" id="site_qt_feename" name="site_qt_feename" /></td>
				</tr>
        <tr class="user_type_seller">
					<td class="key"><label for="site_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
					<td>
						<input type="text" name="site_qt_feeper" id="site_qt_feeper" value="{$aryUser.site_qt_feeper}" class="wid1" maxlength="200" />
						(%)
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="site_qt_feefix">Phí cố định (Quốc tế) </label></td>
					<td><input type="text" name="site_qt_feefix" id="site_qt_feefix" value="{$aryUser.site_qt_feefix}" class="wid1" maxlength="100" />
					(VNĐ)
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="name">Tên phí (Nội địa) </label></td>
					<td>
						<input type="text" name="site_nd_feename" id="site_nd_feename" value="{$aryUser.site_nd_feename}" class="wid1" maxlength="200" />
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="site_nd_feeper">Phí thanh toán (Nội địa) </label></td>
					<td>
						<input type="text" name="site_nd_feeper" id="site_nd_feeper" value="{$aryUser.site_nd_feeper}" class="wid1" maxlength="200" />
						(%)
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="site_nd_feefix">Phí cố định (Nội địa) </label></td>
					<td>
					<input type="text" name="site_nd_feefix" id="site_nd_feefix" value="{$aryUser.site_nd_feefix}" class="wid1" maxlength="100" />
					(VNĐ)
					</td>
				</tr>
        <!-- PHÍ MERCHANT -->
        <tr class="user_type_seller">
					<td class="key" style="text-align: left; color: #0B55C4;" colspan="2">Phí người bán chịu</td>
				</tr>
        <tr class="user_type_seller">
					<td class="key"><label for="site_merchant_qt_feename">Tên phí (Quốc tế)</label></td>
					<td><input type="text" maxlength="255" class="wid1" value="{$aryUser.site_merchant_qt_feename}" id="site_merchant_qt_feename" name="site_merchant_qt_feename" /></td>
				</tr>
        <tr class="user_type_seller">
					<td class="key"><label for="site_merchant_qt_feeper">Phí thanh toán (Quốc tế)</label></td>
					<td>
						<input type="text" name="site_merchant_qt_feeper" id="site_merchant_qt_feeper" value="{$aryUser.site_merchant_qt_feeper}" class="wid1" maxlength="200" />
						(%)
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="site_merchant_qt_feefix">Phí cố định (Quốc tế) </label></td>
					<td><input type="text" name="site_merchant_qt_feefix" id="site_merchant_qt_feefix" value="{$aryUser.site_merchant_qt_feefix}" class="wid1" maxlength="100" />
					(VNĐ)
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="name">Tên phí (Nội địa) </label></td>
					<td>
						<input type="text" name="site_merchant_nd_feename" id="site_merchant_nd_feename" value="{$aryUser.site_merchant_nd_feename}" class="wid1" maxlength="200" />
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="site_merchant_nd_feeper">Phí thanh toán (Nội địa) </label></td>
					<td>
						<input type="text" name="site_merchant_nd_feeper" id="site_merchant_nd_feeper" value="{$aryUser.site_merchant_nd_feeper}" class="wid1" maxlength="200" />
						(%)
					</td>
				</tr>
				<tr class="user_type_seller">
					<td class="key"><label for="site_merchant_nd_feefix">Phí cố định (Nội địa) </label></td>
					<td>
					<input type="text" name="site_merchant_nd_feefix" id="site_merchant_nd_feefix" value="{$aryUser.site_merchant_nd_feefix}" class="wid1" maxlength="100" />
					(VNĐ)
					</td>
				</tr>
        <tr class="user_type_seller">
					<td class="key"><label for="site_use_coupon">Sử dụng coupon</label></td>
					<td>
					<input type="checkbox" name="site_use_coupon" id="site_use_coupon" {if $aryUser.site_use_coupon==1}checked="checked"{/if} value="1" />
					</td>
				</tr>
        <!-- BEGIN shipping -->
        <tr class="user_type_seller">
					<td class="key"><label for="site_shipping_allow">Chấp nhận ship</label></td>
					<td>
					<input type="checkbox" name="site_shipping_allow" id="site_shipping_allow" {if $aryUser.site_shipping_allow==1}checked="checked"{/if} value="1" />
					</td>
				</tr>
        <tr class="user_shipping">
					<td class="key"><label for="site_shipping_urban_fee">Phí ship nội thành</label></td>
					<td>
					<input type="text" name="site_shipping_urban_fee" id="site_shipping_urban_fee" value="{$aryUser.site_shipping_urban_fee}" class="wid1" maxlength="100" />
					(VNĐ)
					</td>
				</tr>        
        <tr class="user_shipping">
					<td class="key"><label for="site_shipping_suburb_fee">Phí ship ngoại thành</label></td>
					<td>
					<input type="text" name="site_shipping_suburb_fee" id="site_shipping_suburb_fee" value="{$aryUser.site_shipping_suburb_fee}" class="wid1" maxlength="100" />
					(VNĐ)
					</td>
				</tr>
        <!-- END shipping -->        
        <!-- END Phí thanh toán cho người bán hàng -->
				<tr>
					<td class="key"><label for="name">Số tiền</label></td>
					<td>{$aryUser.user_gold|number_format}</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Ngày đăng ký</label></td>
					<td>{$aryUser.user_signupdate}</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Lần đăng nhập cuối</label></td>
					<td>{$aryUser.user_lastlogindate}</td>
				</tr>
				<tr>
					<td class="key"><label for="name">IP đăng ký</label></td>
					<td>{$aryUser.user_ip_signup}</td>
				</tr>
				<tr>
					<td class="key"><label for="name">IP login cuối cùng</label></td>
					<td>{$aryUser.user_ip_lastactive}</td>
				</tr>
				<tr>
					<td class="key"><label for="name">Số lần login</label></td>
					<td>{$aryUser.user_logins}</td>
				</tr>
			</table>
			<input type="hidden" value="{$task}" name="task">
			<input type="hidden" value="edit" name="action">
			<input type="hidden" value="{$userId}" name="id" id="id">
		</fieldset>
	</form>
{/if}

{if $task=="new" || $task=="edit"}
{literal}
<script type="text/javascript">
var json_district = {/literal}{$json_district};{literal}
if (typeof objMember == 'undefined') {
	objMember = {
		processAction: function(sUrl) {
			$.ajax({
				type: "POST",
				url: sUrl,
				data: $("#adminForm").serialize(),
				dataType: "json",
				success: function(xmlhttp){
					var objData = xmlhttp;
					if (parseInt(objData.intOK) > 0) {
						document.location = "admin_members.php";
					} else {
						$("#strErr").attr("innerHTML", objData.strError);
						$("#blockErr").css("display", "block");
					}
				}
			});
			return false;
		},

		addOption: function (el,text,value) {
			var optn = document.createElement("option");
			optn.text = text;
			optn.value = value;
			el.options.add(optn);
		},

		removeChildNodes: function (obj) {
			if (obj == null) return;
			while (obj.firstChild) {
				obj.removeChild(obj.firstChild);
			}
		},
		
		addDistrict: function(sId, o) {
			var city = jQuery('#'+o.id).val();
			var desId = document.getElementById(sId);
			this.removeChildNodes(desId);
			//addOption(desId, 'Quận/Huyện/Thị Xã', '');
			var aryData = json_district;
			//if (aryData.length > 0) {
				for (var i in aryData) {
					if (parseInt(city) == parseInt(aryData[i].district_city_id)) {
						this.addOption(desId, aryData[i].district_name, aryData[i].district_id);
					}
				}
			//}
		}
	}
}
</script>{/literal}
{/if}

{literal}
<script language="javascript">
//var json_district = {/literal}{$json_district};{literal}
function submitform(pressbutton){
	var action = document.adminForm.action.value;
	if (pressbutton == 'save') {
		if (action == 'new') {
			objMember.processAction("admin_members.php?task=new&ajax=1");
		}
		else if (action == 'edit') {
			objMember.processAction("admin_members.php?task=edit&ajax=1");
		}
	}
	else {
		if (pressbutton) {
			document.adminForm.task.value=pressbutton;
		}
		document.adminForm.submit();
	}
}
</script>
{/literal}
{include file='admin_footer.tpl'}