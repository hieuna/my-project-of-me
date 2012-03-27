<?php
###################################ADD ######################################
if($action=='addtemp')
{
	$listlang=list_lang("where hide=1");
	$smarty->assign('lang',$listlang);
	
	$id_module=$_REQUEST['id_module'];
	
	if($_POST)
	{
		
	 
	 $hide=$_POST['hide'];
	 
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
	 
	  mysql_query("INSERT INTO post (hide,module) values('{$hide}','{$id_module}')") or die ('Khong the insert');
	  
	   $id_category=mysql_insert_id();
	   
	   foreach ($listlang as $value)
		{
			if($_REQUEST['title_'.$value['code']]!="")
			{
				mysql_query("INSERT INTO content_translate(id_category, title, id_lang, body,type_parent) values('".$id_category."','".$_REQUEST['title_'.$value['code']]."','".$value['id']."','".$_REQUEST['body_'.$value['code']]."','template')");
			}
		}
		
	  $mess=alert_success($config['domain'],"Thêm giao diện thành công!");
	}
	
	
	$smarty->assign('mess',$mess);
	$list_category=listcategory2(array_category2(0,"=",0,$id_module)); //SELECT DANH MUC
	$smarty->assign("list_category",$list_category);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("module_name",$view_path."/addtemp.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='edittemp')
{
		$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	$listlang=list_lang("where hide=1",$id);
	$smarty->assign('lang',$listlang);
	
	
	
	if($_POST)
	{
		
	 
	 	
	 	$hide=$_POST['hide'];
	
		
		
		
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
					if(is_file("../templates/pictures/news/".$old_picture)){ unlink("../templates/pictures/news/".$old_picture);}
				}
				
				$str=time()."_".$picture;
				$picture=$str;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../templates/pictures/news/".$picture) or die('Khong the upload hinh');
				mysql_query("UPDATE post SET picture='".$picture."' where id='".$id."'");
	 		}
		 }
		 
		 mysql_query("UPDATE post SET hide='{$hide}' where id='".$id."'") ;
		 
		 
		   foreach ($listlang as $value)
		{
			if($_REQUEST['title_'.$value['code']]!="")
			{
				$check_field_lang=mysql_num_rows(mysql_query("SELECT * FROM content_translate where id_lang='".$value['id']."' and id_category='".$id."'"));
				if($check_field_lang==0)
				{
					mysql_query("INSERT INTO content_translate(id_category, title, id_lang, body,type_parent) values('".$id."','".$_REQUEST['title_'.$value['code']]."','".$value['id']."','".$_REQUEST['body_'.$value['code']]."','template')");
				}
				else
				{
				
					mysql_query("UPDATE content_translate SET title='".$_REQUEST['title_'.$value['code']]."',
														body='".$_REQUEST['body_'.$value['code']]."'
												 where  id_lang='".$value['id']."' and id_category='".$id."'")  or die($q) ;
				}
				
			}
		} 
		 
		 
		$mess=alert_success($config['domain'],"Cập giao diện thành công!");
    	$smarty->assign('mess',$mess);
		
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		
	}
	
	
	$list_module=listmodule();
	$info=listnew("post","","where id='".$id."'");
	$idCate=mysql_fetch_array(mysql_query("SELECT parent FROM post where id='".$id."'"));
	$list_category=listcategory2(array_category_new($id_module,$idCate['parent'])); //SELECT DANH MUC
	$smarty->assign("lang_selected",$info['lang']);
	$smarty->assign("list_category",$list_category);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("info1",$info);
	$smarty->assign("module_name",$view_path."/edittemp.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='deltemp')
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT picture FROM post where id='".$id."'"));
	$pic_name=$r['picture'];
	mysql_query("DELETE FROM post where id='".$id."'");
	mysql_query("DELETE FROM content_translate where id_category='".$id."' and type_parent='template'");
	if(is_file("../templates/pictures/gallarys/".$pic_name))
	{
		unlink("../templates/pictures/gallarys/".$pic_name);
	}
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
	mysql_query("UPDATE post set status='".$hide."' where id='".$id."'");
}

###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE post set hide='".$hide."' where id='".$id."'");
	
}
###################################DEL PIC#################################

elseif($_REQUEST['action']=="del_pic")
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT picture FROM post where id='".$id."'"));
	$pic_name=$r['picture'];
	mysql_query("UPDATE post SET picture='' where id='".$id."'");
	mysql_query("DELETE FROM content_translate where id_category='".$id."' and type_parent='template'");
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
				$r=mysql_fetch_array(mysql_query("SELECT picture FROM post where id='$udel'"));
				$pic_name=$r['picture'];
				mysql_query("DELETE FROM post WHERE id='$udel'");
				mysql_query("DELETE FROM content_translate where id_category='".$id."' and type_parent='template'");
				if(is_file("../templates/pictures/news/".$pic_name))
				{
					unlink('../templates/pictures/news/'.$pic_name);
				}
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		$catsearch=$_REQUEST['category'];
		$where=" where title like '%".$txtsearch."%' and module='".$id_module."' and id_lang=18";
		$psearch="&searchvl=".$txtsearch."&category=".$catsearch;
		if($catsearch!=""){$where.=" and parent=".$catsearch;}
	}
	else
	{
		
		$where=" where module='".$id_module."' and id_lang=18 ";
	}
	
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT post.id AS id, content_translate.id AS id_translate  FROM post INNER JOIN content_translate ON post.id=content_translate.id_category ".$where));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=template&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	
	$list_category=listcategory3(array_category_new($id_module,$catsearch),"onchange='document.search.submit()'"); //SELECT DANH MUC	
	$smarty->assign("list_category",$list_category);
	$smarty->assign("search_select",$txtsearch);
	$smarty->assign('page',$page);
	$smarty->assign('id_module',$id_module);
	
	//$list_cat=listnew("post",$limit,$where,$catsearch);
	
	$list_cat=listpost("post INNER JOIN content_translate ON post.id=content_translate.id_category",$limit,$where,$catsearch);
	$smarty->assign('info1',$list_cat);
	
	$smarty->assign("module_name",$view_path."/listtemp.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
