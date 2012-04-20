<div class="pageTitle">THÔNG TIN CÁ NHÂN</div>
	<div class="err_signin">
    	{if $msg}
        	{$msg}
        {/if}
    </div>
<div class="signinBox">
    <form method="post" name="frmEditInformation" onsubmit="return checkfrmEditInformation(this)">
    	<input type="hidden" name="url" value="{''|selfUrl|encode}" />
        <label class="formLabel_02" for="Name">Họ và tên<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Name" name="frmName" value="{$accinfo.Member_Name}"><br />
       	
       
        <label class="formLabel_02" for="Email">Email<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Email" name="frmEmail" value="{$accinfo.Member_Email}" title="Email đăng nhập"><br />
        <label class="formLabel_02" for="Phone">Điện thoại<span class="formRequest">*</span></label>
        <input type="text" class="formInput" id="Phone" name="frmPhone"  style="width:150px;" value="{$accinfo.Member_Phone}"><br />
        
        <label class="formLabel_02" for="Name"><span class="forrmDesc">Địa chỉ<span class="formRequest">*</span></span></label>
        <textarea  class="formInput" id="Name" name="frmAddress">{$accinfo.Member_Address}</textarea><br />
        
        <label class="formLabel_02" for="Name">Giới tính<span class="formRequest">*</span></label>
        <select name="frmGender" class="formInput" style="width:80px;">
        	<option value="1" {if $accinfo.Member_Gender == '1'} selected="selected" {/if}>Nam</option>
            <option value="2" {if $accinfo.Member_Gender == '2'} selected="selected" {/if}>Nữ</option>
        </select><br />
       {* <label class="formLabel_02 avatar" for="UploadAvatar">Hình ảnh đại diện</label>
        <img style="width:40px; height:40px; margin:10px 0 0" src="{if $accinfo.Member_Photo} upload/avatar/{$accinfo.Member_Photo}{else}themes/default/images/ava.png{/if}" /><br />
        
        <label class="formLabel_02 " for="UploadAvatar"></label><span class="forrmDesc">Hình ảnh từ máy tính của bạn</span><br />
         <label class="formLabel_02" for="UploadAvatar"></label>
        <input name="UploadAvatar" type="file" id="UploadAvatar" contenteditable="false">
        <input name="oldPhoto" type="hidden" value="{$accinfo.Member_Photo}">*}
        <input name="memid" type="hidden" value="{$accinfo.Member_ID}">
        <br />
        
                             
        <label class="formLabel_02"></label>
        <input type="submit" class="formUpInfo" value="Lưu thông tin">
    </form>
</div>
