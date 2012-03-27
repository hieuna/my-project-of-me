<?php
if(isset($_POST['form_bk']))
	{   		
//check tồn tại	
	
    if(isset($_POST["pass"])){
		//die ($_POST['pass']);
		$pass = md5(md5($_POST['pass']));
		$db_update = new db_execute("UPDATE users 
										  SET 										 
										  password = '$pass'
										  WHERE id = '".$_SESSION['ses_userid']."'");
		  unset($db_update);
		  
		/*$_SESSION['loged'] = 1;		
		$_SESSION['ses_userid'] = $last_id;
		$_SESSION['ses_username'] = $user_name;
		$_SESSION['ses_email'] = $email;	*/
		echo "<script>alert ('Đổi mật khẩu thành công');</script>";
		chuyen_trang("../deals/doi-mat-khau-".$_SESSION['ses_username'].".html");
		}
	}
	
?>