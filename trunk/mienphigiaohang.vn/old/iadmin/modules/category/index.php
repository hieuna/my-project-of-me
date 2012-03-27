<?php
###################################ADD ######################################
if($action=='addcat')
{
	$listlang=list_lang("where hide=1");
	$smarty->assign('lang',$listlang);
	
	
	
	if($_POST )
	{
		
	 $category=$_POST['category'];
	 $module=$_POST['module'];
	 $stt=$_POST['stt'];
	 $hide=$_POST['hide'];
	 $body=$_POST['body'];
	 $link=$_POST['link'];

	 
	 if($category=="0")
	 {
		 mysql_query("INSERT INTO category (module,status,hide,link,parent) values('{$module}','{$stt}','{$hide}','{$link}','{$category}')") ;
		 $id_category=mysql_insert_id();
	 }
	 else
	 {
		 $cat=mysql_fetch_array(mysql_query("SELECT id, parent, level FROM category where id='".$category."'"));
		 $level=$cat['level']+1;
		 $id_parent=$cat['id'];
		 mysql_query("INSERT INTO category (parent,module,status,hide,level,link) values('{$category}','{$module}','{$stt}','{$hide}','{$level}','{$link}')") or die ('KHong the insert');
		  $id_category=mysql_insert_id();
	 }
	 
	 foreach ($listlang as $value)
		{
			if($_REQUEST['title_'.$value['code']]!="")
			{
				mysql_query("INSERT INTO content_translate(id_category, title, id_lang,type_parent) values('".$id_category."','".$_REQUEST['title_'.$value['code']]."','".$value['id']."','category')");
			}
		}
		
	 
	 	$mess=alert_success($config['domain'],"Thêm danh mục thành công!");
    	$smarty->assign('mess',$mess);
	}
	
	
	$list_module=listmodule();
	$list_category=listcategory(array_category()); //SELECT DANH MUC

	$smarty->assign("list_category",$list_category);
	$smarty->assign("list_module",$list_module);/////DANH SACH MODULE
	$smarty->assign("module_name",$view_path."/addcat.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editcat')
{
	
	
	$id=$_REQUEST['id'];
	
	$listlang=list_lang("where hide=1",$id);
	$smarty->assign('lang',$listlang);
	
	
	
	
	if($_POST)
	{
	 	$category=$_POST['category'];
	 	$module=$_POST['module'];
	 	$stt=$_POST['stt'];
	 	$hide=$_POST['hide'];
	 	$body=$_POST['body'];
	 	$link=$_POST['link'];
		$lang=$_REQUEST['lang'];
		
		if($category=="0")
	 {
		 mysql_query("UPDATE category SET  module='{$module}', status='{$stt}', hide='{$hide}', link='{$link}', level='{$level}', parent='{$category}' where id='".$id."'") or die('KHONG THE UPDATE') ;
	 }
	 else
	 {
		 $cat=mysql_fetch_array(mysql_query("SELECT id, parent, level FROM category where id='".$category."'"));
		 $level=$cat['level']+1;
		 $id_parent=$cat['id'];
		 if($id!=$category)
		 {
		 	mysql_query("UPDATE category SET  module='{$module}', status='{$stt}', hide='{$hide}', link='{$link}', level='{$level}', parent='{$id_parent}'  where id='".$id."'")  or die('KHONG THE UPDATE') ;
		 }
	 }
	 
	  foreach ($listlang as $value)
		{
			if($_REQUEST['title_'.$value['code']]!="")
			{
				$check_field_lang=mysql_num_rows(mysql_query("SELECT * FROM content_translate where id_lang='".$value['id']."' and id_category='".$id."'"));
				if($check_field_lang==0)
				{
					mysql_query("INSERT INTO content_translate(id_category, title, id_lang,type_parent) values('".$id."','".$_REQUEST['title_'.$value['code']]."','".$value['id']."','category')");
				}
				else
				{
				mysql_query("UPDATE content_translate SET title='".$_REQUEST['title_'.$value['code']]."'  where  id_lang='".$value['id']."' and id_category='".$id."'")  or die('KHONG THE UPDATE') ;
				}
				
			}
		} 
		
		$mess=alert_success($config['domain'],"Cập nhật danh mục thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		
	}
	
	
	
	
	
	
	$list_module=listmodule();
	$info=listeditcat($id);
	$list_category=listcategory(array_category("","",$info['parent'])); //SELECT DANH MUC
	
	
	$smarty->assign("list_category",$list_category);
	$smarty->assign("select_module",$info['module']);
	
	$smarty->assign("info",$info);
	$smarty->assign("list_module",$list_module);/////DANH SACH MODULE
	$smarty->assign("module_name",$view_path."/editcat.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
	
	
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='delcat')
{
	$id=$_REQUEST['id'];
	mysql_query("DELETE FROM category where id='".$id."'");
	mysql_query("DELETE FROM content_translate where id_category='".$id."' and type_parent='category'");
	
	$list_cat=listcat();
	
	$list_cat=get_arr_cat(listcat2());
	//$test_arr=listcat2();
	$smarty->assign('test_arr',$test_arr);
	$smarty->assign('pri1',$list_cat);
	$smarty->assign("module_name",$view_path."/listcat.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################UPDATE VITRI######################################

elseif($_REQUEST['action']=="update_vitri")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE category set status='".$hide."' where id='".$id."'");
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
	
	
	$list_cat=get_arr_cat(listcat2());
	//$test_arr=listcat2();
	$smarty->assign('test_arr',$test_arr);
	$smarty->assign('pri1',$list_cat);
	$smarty->assign("module_name",$view_path."/listcat.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>

