<?php

if($_REQUEST['action']=='editsystem')
{
	if($_POST)
	{
	$title=$_REQUEST['title'];
	$keyword=$_REQUEST['keyword'];
	$description=$_REQUEST['description'];
	$row=$_REQUEST['row'];
	$column=$_REQUEST['column'];
	$email=$_REQUEST['email'];
	$host_smtp=$_REQUEST['host_smtp'];
	$user_smtp=$_REQUEST['user_smtp'];
	$pass_smtp=$_REQUEST['pass_smtp'];
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	$address=$_REQUEST['address'];
	$repassword=$_REQUEST['repassword'];
	$picture=$_FILES['picture']['name'];
	$old_picture=$_REQUEST['oldpic'];
	$num_show=$_REQUEST['num_show'];
	
	if($password!='' && $password==$repassword)
	{
		mysql_query("UPDATE system SET pass='".md5(md5($password))."' where id=1") or die('Khong the update');
	}


		if($picture!="")
	 	{
	 		if(check_extend_img($picture)==false)
	 		{
		 		$mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Hình ảnh không đúng định dạng!</span> </div>
          </div>';
		 	 $mess="<script>alert('Hình ảnh không đúng định dạng! Không thể cập nhật hình ảnh')</script>";
			
	 		}
	 		else
	 		{
				if($_REQUEST['oldpic']!="")
				{
					if(is_file("../templates/pictures/".$old_picture)){ unlink("../templates/pictures/".$old_picture);}
				}
				
				$str=time()."_".$picture;
				$picture=$str;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/".$picture) or die('Khong the upload hinh');
				mysql_query("UPDATE system SET icon='".$picture."' where id='1'");
	 		}
		 }
		 
		
	
	
	mysql_query("UPDATE system SET title='{$title}',address='{$address}',keyword='{$keyword}',description='{$description}',row='{$row}',colum='{$column}',email='{$email}',host_smtp='{$host_smtp}',user_smtp='{$user_smtp}',pass_smtp='{$pass_smtp}',uid='{$username}',num_show='{$num_show}' where id=1") or die('Khong the cap nhat');
	
	$mess=alert_success($config['domain'],"Cập nhật hệ thống thành công!");

	}



$listsys=listsys();
$smarty->assign("mess",$mess);
$smarty->assign("info",$listsys);
$smarty->assign("module_name",$view_path."/editsys.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
###################################DEL PIC#################################

elseif($_REQUEST['action']=="del_pic")
{
	//$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT icon FROM system where id='1'"));
	$pic_name=$r['icon'];
	mysql_query("UPDATE system SET icon='' where id='1'");
	
	if(is_file("../templates/pictures/".$pic_name))
	{
		unlink("../templates/pictures/".$pic_name);
	}

	
}   


?>





