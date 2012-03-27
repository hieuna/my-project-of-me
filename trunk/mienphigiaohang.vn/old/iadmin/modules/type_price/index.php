<?php

###################################ADD ######################################
if($action=='add')
{
	$id_module=$_REQUEST['id_module'];
	if($_POST && $_POST['title']!="")
	{
		
	 	$title=$_POST['title'];
	 	$hide=$_POST['hide'];
		$price_trans=$_POST['price_trans'];
	 
	 
	
	 
	  mysql_query("INSERT INTO property_product (title,hide,type,price_trans) values('{$title}','{$hide}','2','{$price_trans}')") or die ('Khong the insert');
	  $mess=alert_success($config['domain'],"Thêm loại giá thành công!");
	}
	
	
	$smarty->assign('mess',$mess);
	
	$smarty->assign('id_module',$id_module);
	$smarty->assign("module_name",$view_path."/add.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='edit')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	if($_POST)
	{
		 $title=$_POST['title'];
	 	$hide=$_POST['hide'];
		$price_trans=$_REQUEST['price_trans'];
		
		
		
		 mysql_query("UPDATE property_product SET title='{$title}',price_trans='{$price_trans}', hide='{$hide}' where id='".$id."'") or die('khong the cap nhat'); ;
		$mess=alert_success($config['domain'],"Cập nhật loại giá xuất thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		
	}
	
	
	$listques=list_property(" where id='".$id."'");
	$smarty->assign('info1',$listques);
	$smarty->assign("module_name",$view_path."/edit.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='del')
{
	$id=$_REQUEST['id'];
	
	mysql_query("DELETE FROM property_product where id='".$id."'");
	
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
	if(is_file("../templates/pictures/gallarys/".$pic_name))
	{
		unlink("../templates/pictures/gallarys/".$pic_name);
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
				
				
				mysql_query("DELETE FROM property_product WHERE id='$udel'");
			
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		
		$where=" where title like '%".$txtsearch."%' and type=2";
		$psearch="&searchvl=".$txtsearch;
		
	}
	else
	{
		$where=" where type=2";
	}
	
	
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT id FROM property_product ".$where));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=type_price&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	
	
	$listques=list_property($where,$limit);
	$smarty->assign('info1',$listques);
	$smarty->assign("module_name",$view_path."/list.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
