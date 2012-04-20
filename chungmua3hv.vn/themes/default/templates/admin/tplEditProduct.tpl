<script type="text/javascript" src="{$smarty.const.SITE_URL}lib/css/tabcontent.js"></script>
<script src="{$smarty.const.SITE_URL}lib/include/src/js/jscal2.js"></script>
<script src="{$smarty.const.SITE_URL}lib/include/src/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" href="{$smarty.const.SITE_URL}lib/include/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="{$smarty.const.SITE_URL}lib/include/src/css/border-radius.css" />

<link rel="stylesheet" type="text/css" href="../src/css/steel/steel.css" />
    
    <div style="margin:10px">
<h3>Quản lý sản phẩm {$rowItem.Product_Deal}</h3>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="ID" value="{$rowItem.Product_ID}" />
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
<tr><td class="tdleft">Tiêu đề ngắn</td><td class="tdright"><input value="{$rowItem.Product_Deal}" type="text" name="txtName"></td></tr>
<tr><td class="tdleft">Tiêu đề đầy đủ</td><td class="tdright"><input value="{$rowItem.Product_Name}" type="text" name="txtNameFull"></td></tr>
<tr><td class="tdleft">Danh mục</td><td class="tdright">
<select name="selCategory">
{foreach from=$category item=item}
<option value="">Tất cả</option>
<option value="{$item.Group_ID}" {if $rowItem.Product_GroupID==$item.Group_ID} selected="selected"{/if}>{$item.Group_Name}</option>
{/foreach}
</select>
</td></tr>
<tr><td class="tdleft">Thuộc địa danh</td><td class="tdright">
<select name="selCity">
<option value="">Toàn quốc</option>
{foreach from=$destination item=item}
<option value="{$item.Group_ID}" {if $rowItem.Product_DestinationID==$item.Group_ID} selected="selected"{/if}>{$item.Group_Name}</option>
{/foreach}
</select>
</td></tr>

<tr><td class="tdleft">Đánh đấu đang giảm giá</td><td class="tdright"><input type="checkbox" {if $rowItem.Product_Hot ==1} checked="checked"{/if} name="chekHot" value="1" /></td></tr>
<tr><td class="tdleft">Cho phép hiển thị</td><td class="tdright"><input type="checkbox" {if $rowItem.Product_Status ==1} checked="checked"{/if} name="chekStatus" value="1" /></td></tr>
<tr><td class="tdleft">Đánh dấu đã bán</td><td class="tdright"><input type="checkbox" {if $rowItem.Product_Sold ==1} checked="checked"{/if} name="chekSold" value="1" /></td></tr>
<tr><td  class="tdleft">Miêu tả ngắn</td><td  class="tdright" style="width:760px;">{"txtDescription"|smalleditor:$rowItem.Product_Description}
</td></tr>
</table>
</div>

<div id="doanhnghiep" class="tabcontent" style="height:auto;">
{"txtContent"|editor:$rowItem.Product_Content}
</div>
<div id="box_luuy" class="tabcontent" style="height:auto;">
{"txtNote"|smalleditor:$rowItem.Product_Note}
</div>

<div id="country3" class="tabcontent" style="height:auto;">
{"txtDieukhoan"|smalleditor:$rowItem.Product_Terms_of_Use}
</div>

<div id="country4" class="tabcontent">

<table class="frmForm">
<tr><td class="tdleft">Giá trị thực</td><td  class="tdright"><input type="text" value="{$rowItem.Product_Price}" name="txtValue" style="width:170px"></td></tr>
<tr><td class="tdleft">Giá bán ra</td><td class="tdright"><input value="{$rowItem.Product_DealPrice}"  type="text" name="txtOutValue" style="width:170px"></td></tr>
<tr><td class="tdleft">Số lượng phiếu bán</td><td class="tdright"><input value="{$rowItem.Product_Quantity}"  type="text" name="txtNumber" style="width:70px"></td></tr>
<tr><td class="tdleft" style="width:220px;">Số lượng tối thiểu để đạt giá tốt</td><td class="tdright"><input value="{$rowItem.Product_Minimun}"  type="text" name="txtNumberMinimun" style="width:70px"></td></tr>
<tr><td class="tdleft">Số lượng đã bán</td><td class="tdright"><input value="{$rowItem.Product_Buy}"  type="text" name="txtNumberBuy" style="width:70px"></td></tr>
</table>
</div>

<div id="timeid" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Bắt đầu</td><td class="tdright"><input value="{$rowItem.Product_StartDate|echo_date:'d/m/Y H:i'}" type="text" name="txtFromTime" size="30" id="f_date1" /><button id="f_btn1">...</button></td></tr>
<tr><td class="tdleft">Kết thúc</td><td class="tdright"><input value="{$rowItem.Product_EndDate|echo_date:'d/m/Y H:i'}"  type="text"  name="txtEndTime" size="30" id="f_date2" /><button id="f_btn2">...</button></td></tr>
</table>
</div>
<div id="country5" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Địa chỉ đường dẫn</td><td class="tdright"><input type="text" value="{$rowItem.Product_LinkName}"  name="txtAddress"></td></tr>
<tr><td class="tdleft">Số lượt xem</td><td class="tdright"><input type="text" value="{$rowItem.Product_NumberView}"  name="txtNumberView"></td></tr>
</table>

</div>

<div id="hinhanh" class="tabcontent">
<table class="frmForm">
<tr><td class="tdleft">Ảnh đại diện</td><td class="tdright"><input type="file" name="photo"></td></tr>
{if $rowItem.Product_Photo}
<tr><td class="tdleft"></td><td class="tdright"><img src="{$smarty.const.SITE_URL}upload/product/thumb/{$rowItem.Product_Photo}" width="300"/></td></tr>
{/if}
<tr><td class="tdleft">Ảnh bản đồ</td><td class="tdright"><input type="file" name="photoMap"></td></tr>
{if $rowItem.Product_Map}
<tr><td class="tdleft"></td><td class="tdright"><img src="{$smarty.const.SITE_URL}upload/map/{$rowItem.Product_Map}" width="300" /></td></tr>
{/if}
</td></tr>
</table>
</div>





{literal}
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
    //]]></script>{/literal}

<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(false)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
</div>
</form>
</div>



