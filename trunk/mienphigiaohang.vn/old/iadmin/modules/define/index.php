<?php
###################################ADD ######################################
if($action=='adddefine')
{
	$id_module=$_REQUEST['id_module'];
	if($_POST && $_POST['title']!="")
	{
		
	 $title=$_POST['title'];
	
	 $check_code=mysql_query("SELECT * FROM define where title='".$title."'");
	 
	 if(mysql_num_rows($check_code)>0)
	 	{
		 $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Đã tồn tại tên này!</span> </div>
          </div>';
		 
	 	}
	 else
	 {
	 
	  mysql_query("INSERT INTO define (title) values('{$title}')") or die ('Khong the insert');
	  $mess=alert_success($config['domain'],"Thêm từ thành công!");
	 }
	}
	
	
	$smarty->assign('mess',$mess);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("module_name",$view_path."/adddefine.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editdefine')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	if($_POST && $_POST['title']!=="")
	{
		$title=$_POST['title'];
	 	
		
		
		
		 mysql_query("UPDATE define SET title='{$title}' where id='".$id."'") ;
		$mess=alert_success($config['domain'],"Cập nhật ngôn ngữ thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		
	}
	
	
	$listlang=list_define("where id='".$id."'");
	$smarty->assign('id_module',$id_module);
	$smarty->assign("info",$listlang);
	$smarty->assign("module_name",$view_path."/editdefine.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='deldefine')
{
	$id=$_REQUEST['id'];
	
	mysql_query("DELETE FROM define where id='".$id."'");
	
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
	
	mysql_query("UPDATE define SET picture='' where id='".$id."'");
	

	
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
				
				mysql_query("DELETE FROM define WHERE id='$udel'");
				
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT id FROM define ".$where));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=define&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	
	
	$smarty->assign('page',$page);
	$smarty->assign('id_module',$id_module);
	$listlang=list_define();
	$smarty->assign('info1',$listlang);
	$smarty->assign("module_name",$view_path."/listdefine.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
