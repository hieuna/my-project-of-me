<?php
###################################ADD ######################################
if($action=='view')
{
	
	$id=$_REQUEST['id'];
	$limit="";
	
	$where="where id='".$id."'";
	$listcontact=listcontact($where,$limit);
	$smarty->assign('info1',$listcontact);
	$smarty->assign("module_name",$view_path."/view.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editnew')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	if($_POST && $_POST['title']!=="")
	{
		$title=$_POST['title'];
	 	$parent=$_POST['category'];
	 	$picture=$_FILES['picture']['name'];
	 	$quote=$_POST['quote'];
	 	$hide=$_POST['hide'];
	 	$body=$_POST['body'];
		$old_picture=$_POST['oldpic'];
		 $lang=$_POST['lang'];
		
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
				if($_REQUEST['oldpic']!="")
				{
					if(is_file("../templates/pictures/news/".$old_picture)){ unlink("../templates/pictures/news/".$old_picture);}
				}
				
				$str=time()."_".$picture;
				$picture=$str;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/news/".$picture) or die('Khong the upload hinh');
				mysql_query("UPDATE new SET picture='".$picture."' where id='".$id."'");
	 		}
		 }
		 mysql_query("UPDATE new SET title='{$title}',lang='{$lang}', parent='{$parent}', quote='{$quote}', hide='{$hide}', body='{$body}' where id='".$id."'") ;
		$mess=alert_success($config['domain'],"Cập nhật bản tin thành công!");
    	$smarty->assign('mess',$mess);
		
	}
	
	
	$list_module=listmodule();
	$info=listedit_new("new",$id);
	$list_category=listcategory2(array_category_new($id_module,$info['parent'])); //SELECT DANH MUC
	$listlang=list_lang();
	$smarty->assign("lang_selected",$info['lang']);
	$smarty->assign("listlang",$listlang);
	$smarty->assign("list_category",$list_category);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("info",$info);
	$smarty->assign("module_name",$view_path."/editnew.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='del')
{
	$id=$_REQUEST['id'];
	
	mysql_query("DELETE FROM contact where id='".$id."'");
	
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
	mysql_query("UPDATE new set status='".$hide."' where id='".$id."'");
}

###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE new set hide='".$hide."' where id='".$id."'");
	
}
###################################DEL PIC#################################

elseif($_REQUEST['action']=="del_pic")
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT picture FROM new where id='".$id."'"));
	$pic_name=$r['picture'];
	mysql_query("UPDATE new SET picture='' where id='".$id."'");
	if(is_file("../templates/pictures/news/".$pic_name))
	{
		unlink("../templates/pictures/news/".$pic_name);
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
				mysql_query("DELETE FROM contact WHERE id='$udel'");
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		
		$where=" where title like '%".$txtsearch."%'";
		$psearch="&searchvl=".$txtsearch;
		
	}
	
	
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT id FROM contact ".$where));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=contact&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	
	$smarty->assign('page',$page);
	$listcontact=listcontact($where,$limit);
	$smarty->assign('info1',$listcontact);
	$smarty->assign("module_name",$view_path."/list.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
