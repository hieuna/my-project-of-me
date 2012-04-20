<?php /* Smarty version 2.6.19, created on 2011-09-17 00:33:34
         compiled from login.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['aPageinfo']['title']; ?>
</title>
<?php echo '
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
'; ?>

</head>

<body  marginheight="0" marginwidth="0" bgcolor="#255793">
<?php if ($this->_tpl_vars['error'] != ""): ?>
<div style="border:1px dashed #0F0; position:fixed; top:10%; left:35%; z-index:900; width:370px; text-align:center; background:#F00; padding:20px;">
<?php echo $this->_tpl_vars['error']; ?>
</div>
<?php endif; ?>
<form action="" method="post" style="margin: 0px; padding: 0px;">
<table width="100%" border="0" style="height:300px; ">
<tr><td align="center" valign="top">
<div style="width:434px; height:214px; position:relative; margin-top:150px;">
	<div style=" height:7px; width:434px; position:relative;  float:left">
		<div style="height:7px; width:7px; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/round-conner/t-left.jpg) no-repeat; left:0px; top:0px; position:absolute"></div>
		<div style="height:7px; width:420px; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/round-conner/t-center.jpg) repeat-x ; left:7px; top:0px; position:absolute"></div>
		<div style="height:7px; width:7px; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/round-conner/t-right.jpg) no-repeat; left:427px; top:0px; position:absolute"></div>
	</div>
	<div style="background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/1.jpg) repeat-x; height:200px; float:left; width:420px; border-left:2px solid #FFFFFF; border-right:2px solid #FFFFFF; text-align:left; padding-left:10px; position:relative">
		<h3><?php echo $this->_config[0]['vars']['LOGIN']; ?>
</h3>
		<div style="height:108px; position:absolute; left: 2px; top: 50px; width: 423px;">
			<img src="<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/lock.jpg" align="left" />
			<div style="float:left; width:320px; height:100px; font-size:12px; margin-left:10px; padding-top:0px;">
				<table width="100%" border="0" cellspacing="3" cellpadding="3">
				    
				  <tr>
					<td><?php echo $this->_config[0]['vars']['username']; ?>
</td>
					<td><input name="<?php echo $_SESSION['prefix_']; ?>
username" type="text" style="width:200px" /></td>
				  </tr>
				  <tr>
					<td><?php echo $this->_config[0]['vars']['password']; ?>
</td>
					<td><input name="<?php echo $_SESSION['prefix_']; ?>
password" type="password" style="width:200px"  /></td>
				  </tr>
                  <tr><td></td><td><label><input type="checkbox"/>Nhớ mật khẩu</label> <a href="index.php?mod=user&task=forgot_password">Quên mật khẩu?</a></td></tr>
				</table>
			</div>
		</div>
		<div style="position:absolute; left: 6px; top: 164px; width: 422px; height: 44px;">
			<img src="<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/logo-bsg.jpg" align="middle" style="position:absolute; " />
			<div style="position:absolute; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/vien.jpg) no-repeat; position:absolute; width:63px; left: 155px; height: 44px;"></div>
			<div style="position:absolute; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/bg1.jpg); position:absolute; width:205px; left: 218px; height: 30px;  padding-top:6px;">
				<input  type="submit" value="login" style="background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/button.jpg); height:29px; width:105px; border:none; margin-left:50px; font-size:14px; color:#FFFFFF; font-weight:bold;" />
			</div>
		</div>
	
	</div>
	<div style=" height:7px; width:434px; position:relative;  float:left">
		<div style="height:7px; width:7px; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/round-conner/b-left.jpg) no-repeat; left:0px; top:0px; position:absolute"></div>
		<div style="height:7px; width:420px; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/round-conner/b-center.jpg) repeat-x ; left:7px; top:0px; position:absolute"></div>
		<div style="height:7px; width:7px; background:url(<?php echo @SITE_URL; ?>
/themes/<?php echo @DEFAULT_THEME; ?>
/images/login/round-conner/b-right.jpg) no-repeat; left:427px; top:0px; position:absolute"></div>
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