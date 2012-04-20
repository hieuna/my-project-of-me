<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quên mật khẩu</title>
{literal}
<style type="text/css">
	body{
		font-family:Arial, Helvetica, sans-serif;
		margin:0px;
		font-size:12px;
		color:white;
		height:100%;
		width:100%;				
		background:url({$smarty.const.SITE_URL}/themes/default/images/login/bg.jpg) repeat-x center;
		background-color:#1f70b1;
		text-align:left;
	}
</style>
{/literal}
{literal}
	<script language="javascript">
		function checkForm()
		{
			var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
			var email = $('#tex_email').val();
			
			if ( email == '')
			{
				alert ( "You must be fill your email " );
				$('#tex_email').focus();
				return false;
			}
			if ( !email.match(re) )
			{
				alert ( "Email invalid ");
				$('#tex_email').focus();
				return false;
			}
			
		}
	</script>
{/literal}

</head>

<body  marginheight="0" marginwidth="0" bgcolor="#255793">
{if $error!=""}
<div style="border:1px dashed #0F0; position:fixed; top:10%; left:35%; z-index:900; width:370px; text-align:center; background:#F00; padding:20px;">
{$error}</div>
{/if}
<form action="" method="post" style="margin: 0px; padding: 0px;">
<table width="100%" border="0" style="height:300px; ">
<tr><td align="center" valign="top">
<div style="width:434px; height:214px; position:relative; margin-top:150px;">
	<div style=" height:7px; width:434px; position:relative;  float:left">
		<div style="height:7px; width:7px; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/round-conner/t-left.jpg) no-repeat; left:0px; top:0px; position:absolute"></div>
		<div style="height:7px; width:420px; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/round-conner/t-center.jpg) repeat-x ; left:7px; top:0px; position:absolute"></div>
		<div style="height:7px; width:7px; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/round-conner/t-right.jpg) no-repeat; left:427px; top:0px; position:absolute"></div>
	</div>
	<div style="background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/1.jpg) repeat-x; height:200px; float:left; width:420px; border-left:2px solid #FFFFFF; border-right:2px solid #FFFFFF; text-align:left; padding-left:10px; position:relative">
		<h3>Quên mật khẩu</h3>
		<div style="height:108px; position:absolute; left: 2px; top: 50px; width: 423px;">
			<img src="{$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/lock.jpg" align="left" />
			<div style="float:left; width:320px; height:100px; font-size:12px; margin-left:10px; padding-top:0px;">
				<table width="100%" border="0" cellspacing="3" cellpadding="3">
				    <tr><td colspan="2">Xin nhập địa chỉ email đăng ký tài khoản để chúng tôi gửi mật khẩu cho bạn.</td></tr>
				  <tr>
					<td>Email</td>
					<td><input name="tex_email" type="text" style="width:200px" /></td>
				  </tr>
                  <tr><td></td><td><input type="submit" value="Gửi mật khẩu" /><a href="index.php?mod=user">Đăng nhập</a></td></tr>
                </table>
                
			</div>
		</div>
		<div style="position:absolute; left: 6px; top: 164px; width: 422px; height: 44px;">
			<img src="{$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/logo-bsg.jpg" align="middle" style="position:absolute; " />
			<div style="position:absolute; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/vien.jpg) no-repeat; position:absolute; width:63px; left: 155px; height: 44px;"></div>
			<div style="position:absolute; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/bg1.jpg); position:absolute; width:205px; left: 218px; height: 30px;  padding-top:6px;">
				
			</div>
		</div>
	
	</div>
	<div style=" height:7px; width:434px; position:relative;  float:left">
		<div style="height:7px; width:7px; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/round-conner/b-left.jpg) no-repeat; left:0px; top:0px; position:absolute"></div>
		<div style="height:7px; width:420px; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/round-conner/b-center.jpg) repeat-x ; left:7px; top:0px; position:absolute"></div>
		<div style="height:7px; width:7px; background:url({$smarty.const.SITE_URL}/themes/{$smarty.const.DEFAULT_THEME}/images/login/round-conner/b-right.jpg) no-repeat; left:427px; top:0px; position:absolute"></div>
	</div>
</div>
</td></tr>
</table>
</form>
<div style="margin:auto; width:600px; text-align:center; font-size:11px; color:#CCC;">
Chương trình quản lý dữ liệu - Thiết kế bởi <a href="http://www.vietsmarty.com" style="color:#999;">VietSmarty</a>
</div>
</body>
</html>












