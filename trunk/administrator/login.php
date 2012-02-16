<?php
ob_start();
session_start();

include "admin.header.php";

if(isset($_SESSION['admin_id'])) header('Location: index.php'); 
#-----------------------------------------------------------------------
$clsCommons=new clsCommons();
$error='';
#-----------------------------------------------------------------------
if(isset($_POST['Login']) && $_POST['Login']=='Login')
{
	$username=$clsCommons->fns_Save(trim($_POST['username']));
	$password=md5($clsCommons->fns_Save(trim($_POST['password'])));
	
	if($username=='' or $password=='')
	{
		$error='Tên Đăng Nhập hoặc Mật Khẩu không đúng. Đăng nhập lại!';
	}
	else
	{
		
		$sql="SELECT * FROM ".TBL_ADMIN." WHERE admin_username='$username' and admin_password='$password'";
		//echo $sql;
		if($clsCommons->fns_IsRecord($sql))
		{
			//Lay cac record set trong database gan vao bien mang $r
			$r=$clsCommons->fns_Rows($sql);
			
			//Luu session ten nguoi quan tri
			$_SESSION['admin_id']			= $r[0]['admin_id'];
			$_SESSION['admin_username']		= $r[0]['admin_username'];
			$_SESSION['admin_password']		= $r[0]['admin_password'];
			$_SESSION['admin_group'] 		= $r[0]['admin_group'];
			$_SESSION['admin_access']		= $r[0]['admin_access'];
			
			header('Location: admin.cpanel.php');
		}
		else 
		{
			$error='Tên Đăng Nhập hoặc Mật Khẩu không đúng. Đăng nhập lại!';
		}
	}
}

#-----------------------------------------------------------------------
$smarty->assign('error',$error);
$smarty->assign('style',$http_root.'administrator/style.css');
$smarty->display($template_root.'administrator/login.tpl');
?>