<?php
###################################ADD ######################################
if($action=='addpro')
{
	$listlang=list_lang("where hide=1");
	$smarty->assign('lang',$listlang);
	
	
	$id_module=$_REQUEST['id_module'];
	
	if($_POST)
	{
		
	
	 $parent=$_REQUEST['category'];
		
		if($_SESSION['SESS_GROUP']==2)
		{
			$hide=0;
		}
		else
		{
	 		$hide=$_REQUEST['hide'];
		}
	 
	 $code=$_REQUEST['code'];
	 $date_end=$_REQUEST['date_end'];
	 $quanlity_limit=$_REQUEST['quanlity_limit'];
	$city=$_REQUEST['city'];
	 $view=$_REQUEST['view'];
	// $type_price=$_POST['type_price'];
	 $nsx=$_POST['nsx'];
	 $date=date('Y-m-d H:i:s');
	 $picture_bg=$_FILES['picture_bg']['name'];
	 $type_pay=$_REQUEST['type_pay'];
	 $id_cus=$_REQUEST['id_cus'];
	 $num_buy=$_REQUEST['num_buy'];
		
	 
	  if($picture_bg!="")
	 {
		 
		 
	 	if(check_extend_img($picture_bg)==false)
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
			$str=time()."_".$picture_bg;
			$picture_bg=$str;
			move_uploaded_file($_FILES['picture_bg']['tmp_name'],"../templates/pictures/products/".$picture_bg) or die('Khong the upload hinh');
	 	}
	 }
	 
	 
	 
	  mysql_query("INSERT INTO post (parent,code,hide,type_price,nsx,module,date_end,view,date,quanlity_limit,city,picture_bg,type_pay,id_cus,num_buy) 	values('{$parent}','{$code}','{$hide}','{$type_price}','{$nsx}','{$id_module}','{$date_end}','{$view}','{$date}','{$quanlity_limit}','{$city}','{$picture_bg}','{$type_pay}','{$id_cus}','{$num_buy}')") or die ('Khong the insert');
	  
	   $id_category=mysql_insert_id();
	 
	 
	 $count=count($_FILES['pic_slide']['name']);
	 $picture_name=$_FILES['pic_slide']['name'];
	 $picture_tmp=$_FILES['pic_slide']['tmp_name'];
	 
	 for($i=0; $i<=$count; $i++)
	 {
		 
	
		 if($picture_name[$i]!="")
	 	{
	 		if(check_extend_img($picture_name[$i])==false)
	 		{
		 		$mess='<div class="message message-error">
            	<div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" 	alt="Success" height="32" /> </div>
            	<div class="text">
              	<h6>Error Message</h6>
              	<span>Hình ảnh không đúng định dạng!</span> </div>
          	</div>';
		  		echo "<script>alert('Hình ảnh không đúng định dạng! Không thể cập nhật hình ảnh')</script>";
	 		}
	 		else
	 		{
				$str=$i.time()."_".$picture_name[$i];
				$picture=$str;
				move_uploaded_file($picture_tmp[$i],"../templates/pictures/products/".$picture) or die('Khong the upload hinh');
				mysql_query("INSERT INTO picture_pro (id_pro,title) values('{$id_category}','{$picture}')") or die ('KHONG THE INSERT');
	 		}
	 	}
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	
	 
	 
	 
	   
	   foreach ($listlang as $value)
		{
			if($_REQUEST['title_'.$value['code']]!="")
			{
				mysql_query("INSERT INTO content_translate(id_category, title, id_lang,tag,body,type_parent,price,loaigia,diemnoibat,dieukien,price_old,diachi,quote,map) values('".$id_category."','".$_REQUEST['title_'.$value['code']]."','".$value['id']."','".$_REQUEST['tag_'.$value['code']]."','".$_REQUEST['body_'.$value['code']]."','product','".$_REQUEST['price_'.$value['code']]."','".$_REQUEST['type_price_'.$value['code']]."','".$_REQUEST['diemnoibat_'.$value['code']]."','".$_REQUEST['dieukien_'.$value['code']]."','".$_REQUEST['priceold_'.$value['code']]."','".$_REQUEST['diachi_'.$value['code']]."','".$_REQUEST['quote_'.$value['code']]."','".$_REQUEST['map_'.$value['code']]."')");
			}
		}
	  
	  $mess=alert_success($config['domain'],"Thêm sản phẩm thành công!");
	}
	
	$listtypeprice=listtypeprice("where hide=1 and type=2");
	$smarty->assign('listtypeprice',$listtypeprice);
	
	$listnsx=listtypeprice("where hide=1 and type=1");
	$smarty->assign('listnsx',$listnsx);
	
	
	$list_city=list_city("where hide=1");
	$smarty->assign('list_city',$list_city);
	
	$smarty->assign('mess',$mess);
	$list_category=listcategory2(array_category_new($id_module)); //SELECT DANH MUC
	$smarty->assign("list_category",$list_category);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("module_name",$view_path."/addpro.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editpro')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	$listlang=list_lang("where hide=1",$id);
	$smarty->assign('lang',$listlang);
	
	
	if($_POST)
	{
	 	$parent=$_REQUEST['category'];
	 
	 	$hide=$_REQUEST['hide'];
	 	$code=$_REQUEST['code'];
	 	//$type_price=$_POST['type_price'];
	 	$nsx=$_POST['nsx'];
		$date_end=$_REQUEST['date_end'];
		$quanlity_limit=$_REQUEST['quanlity_limit'];
		$city=$_REQUEST['city'];
		$view=$_REQUEST['view'];
		$picture_bg=$_FILES['picture_bg']['name'];
		$oldpicture_bg=$_REQUEST['oldpicture_bg'];
		$type_pay=$_REQUEST['type_pay'];
		$id_cus=$_REQUEST['id_cus'];
		 $num_buy=$_REQUEST['num_buy'];
		
	$count=count($_FILES['pic_slide']['name']);
	 $picture_name=$_FILES['pic_slide']['name'];
	 $picture_tmp=$_FILES['pic_slide']['tmp_name'];
	 
	 for($i=0; $i<=$count; $i++)
	 {
		 
	
		 if($picture_name[$i]!="")
	 	{
	 		if(check_extend_img($picture_name[$i])==false)
	 		{
		 		$mess='<div class="message message-error">
            	<div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" 	alt="Success" height="32" /> </div>
            	<div class="text">
              	<h6>Error Message</h6>
              	<span>Hình ảnh không đúng định dạng!</span> </div>
          	</div>';
		  		echo "<script>alert('Hình ảnh không đúng định dạng! Không thể cập nhật hình ảnh')</script>";
	 		}
	 		else
	 		{
				$str=$i.time()."_".$picture_name[$i];
				$picture=$str;
				
								 
				move_uploaded_file($picture_tmp[$i],"../templates/pictures/products/".$picture) or die('Khong the upload hinh');
				mysql_query("INSERT INTO picture_pro (id_pro,title) values('{$id}','{$picture}')") or die ('KHONG THE INSERT');
	 		}
	 	}
	 }
		 
		 
		 
		 
		 
		 
		 if($picture_bg!="")
	 	{
	 		if(check_extend_img($picture_bg)==false)
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
				if($_REQUEST['oldpicture_bg']!="")
				{
					if(is_file("../templates/pictures/products/".$oldpicture_bg)){ unlink("../templates/pictures/products/".$oldpicture_bg);}
				}
				
				$str=time()."_".$picture_bg;
				$picture_bg=$str;
				move_uploaded_file($_FILES['picture_bg']['tmp_name'],"../templates/pictures/products/".$picture_bg) or die('Khong the upload hinh');
				mysql_query("UPDATE post SET picture_bg='".$picture_bg."' where id='".$id."'");
	 		}
		 }
		 
		 
		 
		 
		 
		
		 
		 
		 mysql_query("UPDATE post SET  parent='{$parent}', code='{$code}', hide='{$hide}',  nsx='{$nsx}', date_end='{$date_end}', view='{$view}', quanlity_limit='{$quanlity_limit}', city='{$city}', type_pay='{$type_pay}', id_cus='{$id_cus}',num_buy='{$num_buy}' where id='".$id."'") ;
		 
		 
		 
		  foreach ($listlang as $value)
		{
			if($_REQUEST['title_'.$value['code']]!="")
			{
				$check_field_lang=mysql_num_rows(mysql_query("SELECT * FROM content_translate where id_lang='".$value['id']."' and id_category='".$id."'"));
				
				if($check_field_lang==0)
				{
					mysql_query("INSERT INTO content_translate(id_category, title, id_lang, tag,body,type_parent,loaigia,price_old,diemnoibat,dieukien,diachi,quote,map) values('".$id."','".$_REQUEST['title_'.$value['code']]."','".$value['id']."','".$_REQUEST['tag_'.$value['code']]."','".$_REQUEST['body_'.$value['code']]."','product','".$_REQUEST['type_price_'.$value['code']]."','".$_REQUEST['priceold_'.$value['code']]."','".$_REQUEST['diemnoibat_'.$value['code']]."','".$_REQUEST['dieukien_'.$value['code']]."','".$_REQUEST['diachi_'.$value['code']]."','".$_REQUEST['quote_'.$value['code']]."','".$_REQUEST['map_'.$value['code']]."')");
				}
				else
				{
					mysql_query("UPDATE content_translate SET title='".$_REQUEST['title_'.$value['code']]."',
														price='".$_REQUEST['price_'.$value['code']]."',
														body='".$_REQUEST['body_'.$value['code']]."',
														tag='".$_REQUEST['tag_'.$value['code']]."',
														loaigia='".$_REQUEST['type_price_'.$value['code']]."',
														price_old='".$_REQUEST['priceold_'.$value['code']]."',
														diemnoibat='".$_REQUEST['diemnoibat_'.$value['code']]."',
														dieukien='".$_REQUEST['dieukien_'.$value['code']]."',
														diachi='".$_REQUEST['diachi_'.$value['code']]."',
														quote='".$_REQUEST['quote_'.$value['code']]."',
														map='".$_REQUEST['map_'.$value['code']]."'
												 		where  id_lang='".$value['id']."' and id_category='".$id."'")  or die('KHONG THE CAP NHAT') ;
				}
				
			}
		} 
		 
		 
		 
		 
		$mess=alert_success($config['domain'],"Cập nhật sản phẩm thành công!");
    	$smarty->assign('mess',$mess);
		
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		
	}
	
	
	$listtypeprice=listtypeprice("where hide=1 and type=2");
	$smarty->assign('listtypeprice',$listtypeprice);
	
	$listnsx=listtypeprice("where hide=1 and type=1");
	$smarty->assign('listnsx',$listnsx);
	
	$list_city=list_city("where hide=1");
	$smarty->assign('list_city',$list_city);
	
	$list_img_pro=list_img_pro("where id_pro='".$id."'");
	$smarty->assign('list_img_pro',$list_img_pro);
	
	$list_module=listmodule();
	$info=listnew("post","","where id='".$id."'");
	$idCate=mysql_fetch_array(mysql_query("SELECT parent FROM post where id='".$id."'"));
	$list_category=listcategory2(array_category_new($id_module,$idCate['parent'])); //SELECT DANH MUC
	$smarty->assign("list_category",$list_category);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("info1",$info);

	$smarty->assign("lang_selected",$info['lang']);
	$smarty->assign("listlang",$listlang);
	$smarty->assign("module_name",$view_path."/editpro.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='delpro')
{
	$id=$_REQUEST['id'];
	
	$r=mysql_query("SELECT * FROM picture_pro where id_pro='".$id."'");
	while($rs=mysql_fetch_array($r)){
		if(is_file("../templates/pictures/products/".$rs['title']))
		{
			unlink("../templates/pictures/products/".$rs['title']);
		}
	}
	
	mysql_query("DELETE FROM picture_pro where id_pro='".$id."'");
	mysql_query("DELETE FROM post where id='".$id."'");
	mysql_query("DELETE FROM content_translate where id_category='".$id."' and type_parent='product'");
	mysql_query("DELETE FROM type_product where id_product='".$id."'");
		
	/*$smarty->assign('id_module',$id_module);
	$list_cat=listnew("product",$limit,$where,$catsearch);
	$smarty->assign('info1',$list_cat);
	$smarty->assign("module_name",$view_path."/listpro.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
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
	$r=mysql_fetch_array(mysql_query("SELECT title FROM picture_pro where id='".$id."'"));
	$pic_name=$r['title'];
	mysql_query("DELETE FROM picture_pro where id='".$id."'");
	if(is_file("../templates/pictures/products/".$pic_name))
	{
		unlink("../templates/pictures/products/".$pic_name);
	}
	
	
}   
elseif($_REQUEST['action']=="del_pic_bg")
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT picture_bg FROM post where id='".$id."'"));
	$pic_name=$r['picture_bg'];
	mysql_query("UPDATE post SET picture_bg='' where id='".$id."'");
	
	if(is_file("../templates/pictures/products/".$pic_name))
	{
		unlink("../templates/pictures/products/".$pic_name);
	}

	
}   
 




elseif($_REQUEST['action']=="featured_detail")
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
	$list_featured=listfeatured_product("featured_product INNER JOIN content_translate ON featured_product.id=content_translate.id_category","","where  id_lang=18 and type_parent='featured_product' ","");
	$smarty->assign('list_featured',$list_featured);
	
	
	$select_=mysql_fetch_array(mysql_query("SELECT title FROM content_translate WHERE id_category='".$id_featured."' and id_lang=18 and type_parent='featured_product'"));
	
	$smarty->assign('select_',$select_['title']);
	
	$listdetailfeatured=listdetailfeatured("where id_type='".$id_featured."'");
	$smarty->assign('listdetailfeatured',$listdetailfeatured);
	$list_type_product=list_type_product();
	$smarty->assign('list_type_product',$list_type_product);
	$smarty->assign("module_name",$view_path."/listfeatured.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
	
	
}   


	   
	   
else
{
	$id_module=$_REQUEST['id_module'];
	
	if($_POST['submit'])
	{
		if($_POST['Selected'])
		{
			if($_POST['action'] == "delete")
			{
				foreach($_POST['Selected'] as $udel)
				{
					$r=mysql_query("SELECT * FROM picture_pro where id_pro='".$udel."'");
					while($rs=mysql_fetch_array($r)){
					if(is_file("../templates/pictures/products/".$rs['title']))
					{
						unlink("../templates/pictures/products/".$rs['title']);
					}
													}
	
					mysql_query("DELETE FROM picture_pro where id_pro='".$udel."'");
					mysql_query("DELETE FROM post WHERE id='$udel'");
					mysql_query("DELETE FROM type_product WHERE id_product='$udel'");
					mysql_query("DELETE FROM content_translate where id_category='".$udel."' and type_parent='product'");
					
				}
			}
			else
			{
				foreach($_POST['Selected'] as $udel)
				{
					$check=mysql_query("SELECT id FROM type_product where id_product='".$udel."' and id_type='".$_REQUEST['action']."'");
					if(mysql_num_rows($check)==0)
					{
						mysql_query("INSERT INTO type_product (id_type,id_product) values('".$_REQUEST['action']."','".$udel."')");
					}
				}
			}
		}
	}
	
	
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		$catsearch=$_REQUEST['category'];
		$where=" where title like '%".$txtsearch."%' and module='".$id_module."'  and id_lang=18";
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
	$url_page="do=product&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	$list_featured=listfeatured_product("category INNER JOIN content_translate ON category.id=content_translate.id_category","","where  id_lang=18 and type_parent='category' and module=20 ","");
	$smarty->assign('list_featured',$list_featured);
	
	
	$list_category=listcategory3(array_category_new($id_module,$catsearch),"onchange='document.search.submit()'"); //SELECT DANH MUC	
	$smarty->assign("list_category",$list_category);
	$smarty->assign("search_select",$txtsearch);
	$smarty->assign('page',$page);
	$smarty->assign('id_module',$id_module);
	$list_cat=listpost("post INNER JOIN content_translate ON post.id=content_translate.id_category",$limit,$where,$catsearch);
	$smarty->assign('info1',$list_cat);
	$smarty->assign("module_name",$view_path."/listpro.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
