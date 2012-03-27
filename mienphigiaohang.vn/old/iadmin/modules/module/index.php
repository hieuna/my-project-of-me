<?php
###################################ADD ######################################
if($action=='addmodule')
{
	if($_POST && $_POST['title']!="")
	{
		
	 $title=$_REQUEST['title'];
	 $code=$_REQUEST['code'];
	 $hide=$_REQUEST['hide'];
	 
		$error="INSERT INTO module (title,code,hide) values('{$title}','{$code}','{$hide}'";
		 
		 mysql_query("INSERT INTO module (title,code,hide) values('{$title}','{$code}','{$hide}')") or die ('Khong the insert');
	
	 
	 	$mess=alert_success($config['domain'],"Thêm module thành công!");
    	$smarty->assign('mess',$mess);
	}
	
	$list_module=listmodule();
	$smarty->assign("info",$info);
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
		
		
		 
		 mysql_query("UPDATE module SET title='{$title}', code='{$code}', hide='{$hide}'  where id='".$id."'") or die('Khong the update') ;
	 
		$mess=alert_success($config['domain'],"Cập nhật module thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
	}
	
	
	$list_module=listmodule($id);	
	$smarty->assign("info",$list_module);
	$smarty->assign("module_name",$view_path."/editmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='delmodule')
{
	$id=$_REQUEST['id'];
	mysql_query("DELETE FROM module where id='".$id."'");
	$list_cat=listmodule();
	$smarty->assign('pri1',$list_cat);
	$smarty->assign("module_name",$view_path."/listmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################UPDATE VITRI######################################

elseif($_REQUEST['action']=="update_vitri")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE module set status='".$hide."' where id='".$id."'");
}

###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE module set hide='".$hide."' where id='".$id."'");
	
}
	   
	   
	   
else
{
	$list_cat=listmodule();
	//$test_arr=listcat2();
	$smarty->assign('pri1',$list_cat);
	$smarty->assign("module_name",$view_path."/listmodule.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>

