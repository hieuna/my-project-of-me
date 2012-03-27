<?php
###################################ADD ######################################
if($action=='addmodule')
{
	if($_POST && $_POST['title']!="")
	{
		
	 $title=$_REQUEST['title'];
	 $code=$_REQUEST['code'];
	 $hide=$_REQUEST['hide'];
	 $show_module=$_REQUEST['show_module'];
	 
		$error="INSERT INTO module (title,code,hide) values('{$title}','{$code}','{$hide}'";
		 
		 mysql_query("INSERT INTO module_ext (title,code,hide) values('{$title}','{$code}','{$hide}')") or die ('Khong the insert');
		 $id=mysql_insert_id();
	
		foreach($show_module as $uid)
		{
			mysql_query("INSERT INTO show_module_ext(id_module_ext,id_module) values('{$id}','{$uid}')");
		}
	 
	 	$mess=alert_success($config['domain'],"Thêm module mở rộng thành công!");
    	$smarty->assign('mess',$mess);
	}
	
	
	$list_cat=listmodule();
	$smarty->assign('list_module',$list_cat);
	$smarty->assign("module_name",$view_path."/addmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editmodule')
{
	$id=$_REQUEST['id'];
	if($_POST && $_POST['title']!=="")
	{
		$title=$_REQUEST['title'];
	 	$code=$_REQUEST['code'];
	 	$hide=$_REQUEST['hide'];
		$show_module=$_REQUEST['show_module'];
		
		 
		 mysql_query("UPDATE module_ext SET title='{$title}', code='{$code}', hide='{$hide}'  where id='".$id."'") or die('Khong the update') ;
		 
		 mysql_query("DELETE FROM show_module_ext where id_module_ext='".$id."'");
		 
		 foreach($show_module as $uid)
		{
			mysql_query("INSERT INTO show_module_ext(id_module_ext,id_module) values('{$id}','{$uid}')");
		}
		 
	 
		$mess=alert_success($config['domain'],"Cập nhật module thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
	}
	
	
	$list_module_select=listmodule2($id);
	$smarty->assign('list_module_select',$list_module_select);
	$list_module=listmoduleExt($id);	
	$smarty->assign("info",$list_module);
	$smarty->assign("module_name",$view_path."/editmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='delmodule')
{
	$id=$_REQUEST['id'];
	mysql_query("DELETE FROM module_ext where id='".$id."'");
	$list_cat=listmodule();
	$smarty->assign('pri1',$list_cat);
	$smarty->assign("module_name",$view_path."/listmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################UPDATE VITRI######################################

elseif($_REQUEST['action']=="update_vitri")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE module_ext set status='".$hide."' where id='".$id."'");
}

###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE module_ext set hide='".$hide."' where id='".$id."'");
	
}
	   
	   
	   
else
{
	$list_cat=listmoduleExt();
	//$test_arr=listcat2();
	$smarty->assign('pri1',$list_cat);
	$smarty->assign("module_name",$view_path."/listmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>

