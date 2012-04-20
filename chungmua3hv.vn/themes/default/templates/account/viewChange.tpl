<div class="pageTitle">Thay đổi mật khẩu</div>
	<div class="err_signin">
    	{if $msg}
        	{$msg}
        {/if}
    </div>
<div class="signinBox">
    <form method="post" name="frmChangePassword" onsubmit="return frmPasswordTest(this)">
    	<input type="hidden" name="url" value="{''|selfUrl|encode}" />
        <label class="formLabel_02" for="Name">Mật khẩu hiện tại<span class="formRequest">*</span></label>
        <input type="password" class="formInput" id="Name" name="frmPassword" value=""><br />
        <label class="formLabel_02" for="Name">Mật khẩu mới<span class="formRequest">*</span></label>
        <input type="password" class="formInput" id="Name" name="frmPasswordNew" value=""><br />
       	
        <label class="formLabel_02" for="Name">Nhập lại mật khẩu<span class="formRequest">*</span></label>
        <input type="password" class="formInput" id="Name" name="frmPasswordNewConfirm" value=""><br />
        <p style="margin-left:60px;"><label class="formLabel"></label>
        <input type="submit" class="formUpInfo" value="Đổi mật khẩu"> &nbsp; Click <a style="text-decoration:underline" href="quen-mat-khau.html">vào đây</a> nếu bạn quên mật khẩu</p>
    </form>
</div>
