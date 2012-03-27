
<?php
if($_REQUEST['do']=="featured_pro")
{
	
	
	if($_POST['Selected'])
		{
				foreach($_POST['Selected'] as $udel)
				{
					
					mysql_query("DELETE FROM type_product WHERE id='$udel'");
					
					
				}
		}
	if($_REQUEST['action2']=='delfeatured')
	{
		$id=$_REQUEST['id'];
		mysql_query("DELETE FROM type_product WHERE id='$id'");
		
	}
	
	
	
	$id_featured=$_REQUEST['id_featured'];
	
	
	//HIEN DANH SACH SAN PHAM DAC TRUNG
	$list_featured=listfeatured_product("category INNER JOIN content_translate ON category.id=content_translate.id_category","","where  id_lang=18 and type_parent='category' and module=20 ","");
	$smarty->assign('list_featured',$list_featured);
	
	
	if($id_featured!="")
	{
		$select_=mysql_fetch_array(mysql_query("SELECT title FROM content_translate WHERE id_category='".$id_featured."' and id_lang=18 and type_parent='featured_product'"));
		$listdetailfeatured=listdetailfeatured("where id_type='".$id_featured."'");
	}
	else
	{
		$select_=mysql_fetch_array(mysql_query("SELECT title FROM content_translate WHERE id_lang=18 and type_parent='featured_product'"));
		$listdetailfeatured=listdetailfeatured("where 1=1 ");
	}
	
	$smarty->assign('select_',$select_['title']);
	
	
	$smarty->assign('listdetailfeatured',$listdetailfeatured);
	$list_type_product=list_featured;
	$smarty->assign('list_type_product',$list_type_product);
	$smarty->assign("module_name",$view_path."/listtype.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
	
	
}   

?>

