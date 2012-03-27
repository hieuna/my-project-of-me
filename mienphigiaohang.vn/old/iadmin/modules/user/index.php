<?php
###################################ADD ######################################
if($action=='adduser')
{
	$id_module=$_REQUEST['id_module'];
	if($_POST && $_POST['name']!="")
	{
		
	 		
			$name = $_REQUEST['name'];
			$sex = $_REQUEST['sex'];
			$company = $_REQUEST['company'];
			$address = $_REQUEST['address'];
			$city = $_REQUEST['city'];
			$country = $_REQUEST['country'];
			$tel = $_REQUEST['phone'];
			$fax = $_REQUEST['fax'];
			$email = $_REQUEST['email'];
			$website = $_REQUEST['website'];
			$username = $_REQUEST['username'];
			$password = md5(md5($_REQUEST['password']));
			$hide = $_REQUEST['hide'];
			$date = date('Y-m-d H:i:s');
			$repassword=md5(md5($_REQUEST['repassword']));
			$picture	=$_FILES['picture']['name'];
			$group_user=$_REQUEST['group_user'];
	 
	 $check_user=mysql_query("SELECT username FROM users where  username='".$username."'");
	 $check_email=mysql_query("SELECT email FROM users where email='".$email."'");
	 if(mysql_num_rows($check_user)>0)
	 	{
		 $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Tên đăng nhập đã tồn tại!</span> </div>
          </div>';
	 	}
	 elseif(mysql_num_rows($check_email)>0)
	 {
		  $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Email đã tồn tại!</span> </div>
          </div>';
	 }
	 elseif($password!=$repassword)
	 {
		  $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Nhập lại mật khẩu chưa đúng!</span> </div>
          </div>';
	 }else
	 	{
			
			if(check_extend_img($picture)==true)
			{
				$str=time()."_".$picture;
				$picture=$str;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/users/".$picture) or die('Khong the upload hinh');
			}
			else
			{
				$picture="";
			}
			
			
	  mysql_query("INSERT INTO users (name,sex,company,address,city,country,tel,fax,email,username,password,hide,date,picture,group_user) 	values('{$name}','{$sex}','{$company}','{$address}','{$city}','{$country}','{$tel}','{$fax}','{$email}','{$username}','{$password}','{$hide}','{$date}','{$picture}','{$group_user}')") or die ('Khong the insert');
	  $mess=alert_success($config['domain'],"Thêm thành viên thành công!");
		}
	
	}
	
	$smarty->assign('mess',$mess);
	$smarty->assign('id_module',$id_module);
	$smarty->assign('city',comboCountry($country));
	$smarty->assign("module_name",$view_path."/adduser.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='edituser')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	if($_POST && $_POST['name']!=="")
	{
			$name = $_REQUEST['name'];
			$sex = $_REQUEST['sex'];
			$company = $_REQUEST['company'];
			$address = $_REQUEST['address'];
			$city = $_REQUEST['city'];
			$country = $_REQUEST['country'];
			$tel = $_REQUEST['phone'];
			$fax = $_REQUEST['fax'];
			$email = $_REQUEST['email'];
			$website = $_REQUEST['website'];
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$hide = $_REQUEST['hide'];
			$date = date('Y-m-d H:i:s');
			$repassword=$_REQUEST['repassword'];
			$picture=$_FILES['picture']['name'];
			$old_picture=$_REQUEST['picold'];
			$group_user=$_REQUEST['group_user'];
	 
	 $check_user=mysql_query("SELECT username FROM users where username!='".$_REQUEST['username_old']."' and username='".$username."'");
	 $check_email=mysql_query("SELECT email FROM users where email!='".$_REQUEST['email_old']."' and email='".$email."'");
	 
	 if(mysql_num_rows($check_user)>0)
	 	{
		 $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Tên đăng nhập đã tồn tại!</span> </div>
          </div>';
	 	}
	 elseif(mysql_num_rows($check_email)>0)
	 {
		  $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Email đã tồn tại!</span> </div>
          </div>';
	 } 
	 elseif($password!=$repassword)
	 {
		  $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Nhập lại mật khẩu không đúng!</span> </div>
          </div>';
	 }
	 else
	 	{
			if($password!="")
			{
				mysql_query("UPDATE users SET password='".md5(md5($password))."' where id='".$id."'");
			}
			
		if($picture!="")
		{
			if(check_extend_img($picture)==true)
			{
				if($_REQUEST['picold']!="")
					{
						if(is_file("../templates/pictures/users/".$old_picture)){ unlink("../templates/pictures/users/".$old_picture);}
					}
				
				$str=time()."_".$picture;
				$picture=$str;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/users/".$picture) or die('Khong the upload hinh');
				mysql_query("UPDATE users SET picture='".$picture."' where id='".$id."'");
			}
	 		
		}
		
	  mysql_query("UPDATE  users SET name='{$name}', sex='{$sex}',company='{$company}',address='{$address}',city='{$city}',country='{$country}',tel='{$tel}',fax='{$fax}',email='{$email}',username='{$username}',hide='{$hide}', group_user='{$group_user}' where id='".$id."'") or die ($query);
	  $mess=alert_success($config['domain'],"Cập nhật thành viên thành công!");
	  echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		}
	
	}
		
	
	$smarty->assign('query',$query);
	$where=" and id='".$id."'";
	$list_cat=listuser2($where);
	$smarty->assign('mess',$mess);
	$smarty->assign('id_module',$id_module);
	$smarty->assign('country',comboCountry($list_cat['country']));
	$smarty->assign("info",$list_cat);
	$smarty->assign("module_name",$view_path."/edituser.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='deluser')
{
	$id=$_REQUEST['id'];
	
	mysql_query("DELETE FROM users where id='".$id."'");
	
/*	$smarty->assign('id_module',$id_module);
	$list_cat=listnew("new",$limit,$where,$catsearch);
	$smarty->assign('info1',$list_cat);
	$smarty->assign("module_name",$view_path."/listnew.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
	*/
	echo "<script>javascript:history.go(-1)</script>";
}

###################################UPDATE VITRI######################################

elseif($_REQUEST['action']=="update_vitri")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE users set status='".$hide."' where id='".$id."'");
}

###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE users set hide='".$hide."' where id='".$id."'");
	
}


###################################DEL PIC#################################

elseif($_REQUEST['action']=="del_pic")
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT picture FROM users where id='".$id."'"));
	$pic_name=$r['picture'];
	mysql_query("UPDATE users SET picture='' where id='".$id."'");
	if(is_file("../templates/pictures/users/".$pic_name))
	{
		unlink("../templates/pictures/users/".$pic_name);
	}

	
}   
	   
	   
else
{
	$id_module=$_REQUEST['id_module'];
	/****************DELETE APPLY*******************/
	if($_POST['submit'])
	{
		if($_POST['Selected'])
		{
			foreach($_POST['Selected'] as $udel)
			{
				
				mysql_query("DELETE FROM users WHERE id='$udel'");
				
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	
	$where="";
	$psearch="";
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		$where.=" and username like '%".$txtsearch."%' ";
		$psearch.="&searchvl=".$txtsearch;
	}
	if(isset($_REQUEST['group_u']) && $_REQUEST['group_u']!="")
	{
		$group_u=$_REQUEST['group_u'];
		$where.=" and group_user = '".$group_u."'";
		$psearch.="&group_u=".$group_u;
	}
	
					   
	
	
	$row=10;
	$div=7;
	
	$query=mysql_query("SELECT id FROM users where 1=1  ".$where) or die ("SELECT id FROM users  where ".$where);
	$num_value=mysql_num_rows($query);
	
	//////////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		" limit ".$start.",".$row;
	$url_page="do=user&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	

	$smarty->assign("search_select",$txtsearch);
	$smarty->assign('page',$page);
	$smarty->assign('id_module',$id_module);
	$list_cat=listuser($limit,$where);
	$smarty->assign('info1',$list_cat);
	$smarty->assign("module_name",$view_path."/listuser.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
