<?php
###################################ADD ######################################
if($action=='addsupport')
{
	if($_POST && $_POST['title']!="")
	{
		
	 $title=$_POST['title'];
	 $type=$_POST['type'];
	 $hide=$_POST['hide'];
	 $name=$_POST['name'];
	 $picture=$_FILES['picture']['name'];
	
	 
	 
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
		  echo "<script>alert('Hinh anh khong dung dinh dang')</script>";
	 	}
	 	else
	 	{
			$str=time()."_".$picture;
			$picture=$str;
			move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/news/".$picture) or die('Khong the upload hinh');
	 	}
	 }
	 
	 
	
		 mysql_query("INSERT INTO support (title,parent,hide,level,name,picture) values('{$title}','{$type}','{$hide}','1','{$name}','{$picture}')") ;
	
	 	$mess=alert_success($config['domain'],"Thêm hỗ trợ thành công!");
    	$smarty->assign('mess',$mess);
	}
	
	
	$listsup_parent=listsup_parent();
	$smarty->assign('listsup_parent',$listsup_parent);
	
	
	$smarty->assign("module_name",$view_path."/addsupport.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editsupport')
{
	$id=$_REQUEST['id'];
	if($_POST && $_POST['title']!=="")
	{
		$title=$_POST['title'];
	 	$type=$_POST['type'];
	 	$hide=$_POST['hide'];
		$name=$_POST['name'];
	 	$picture=$_FILES['picture']['name'];
		
		
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
		 	 echo "<script>alert('Hình ảnh không đúng định dạng! Không thể cập nhât hình ảnh')</script>";
	 		}
	 		else
	 		{
				if($_REQUEST['oldpic']!="")
				{
					if(is_file("../templates/pictures/news/".$old_picture)){ unlink("../templates/pictures/news/".$old_picture);}
				}
				
				$str=time()."_".$picture;
				$picture=$str;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/news/".$picture) or die('Khong the upload hinh');
				mysql_query("UPDATE support SET picture='".$picture."' where id='".$id."'");
	 		}
		 }
		
		
		
		 mysql_query("UPDATE support SET title='{$title}', parent='{$type}', hide='{$hide}', name='{$name}' where id='".$id."'") ;
	
		
		
		
		
	 
		$mess=alert_success($config['domain'],"Cập nhật danh mục thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
	}
	
	$listsupport=listsupport("and id='".$id."'");
	$listsup_parent=listsup_parent();
	$smarty->assign('listsup_parent',$listsup_parent);
	$smarty->assign('select_parent',$listsupport['parent']);
	$smarty->assign("info1",$listsupport);
	$smarty->assign("module_name",$view_path."/editsupport.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='delsupport')
{
	$id=$_REQUEST['id'];
	mysql_query("DELETE FROM support where id='".$id."'");
	
	$listsupport=listsupport();
	//$test_arr=listcat2();
	$smarty->assign('pri1',$listsupport);
	$smarty->assign("module_name",$view_path."/listsupport.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################UPDATE VITRI######################################

elseif($_REQUEST['action']=="update_vitri")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE support set status='".$hide."' where id='".$id."'");
}

###################################DEL PIC#################################

elseif($_REQUEST['action']=="del_pic")
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT picture FROM support where id='".$id."'"));
	$pic_name=$r['picture'];
	mysql_query("UPDATE support SET picture='' where id='".$id."'");
	if(is_file("../templates/pictures/news/".$pic_name))
	{
		unlink("../templates/pictures/news/".$pic_name);
	}

	
}   

###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE category set hide='".$hide."' where id='".$id."'");
	
}
	elseif($_REQUEST['action']=="update_trinhdon")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE category set trinhdon='".$hide."' where id='".$id."'");
	
}
	   
   
	   
	   
else
{
	$listsupport=listsupport();
	//$test_arr=listcat2();
	
	$smarty->assign('pri1',$listsupport);
	$smarty->assign("module_name",$view_path."/listsupport.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>

