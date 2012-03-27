<?php
###################################ADD ######################################
if($action=='addlang')
{
	$id_module=$_REQUEST['id_module'];
	if($_POST && $_POST['title']!="")
	{
		
	 $title=$_POST['title'];
	 $code=$_POST['code'];
	 $check_code=mysql_query("SELECT * FROM language where code='".$code."'");
	 
	 if(mysql_num_rows($check_code)>0)
	 	{
		 $mess='<div class="message message-error">
            <div class="image"> <img src="http://'.$config['domain'].'/iadmin/templates/images/icons/error.png" alt="Success" height="32" /> </div>
            <div class="text">
              <h6>Error Message</h6>
              <span>Mã ngôn ngữ đã tồn tại!</span> </div>
          </div>';
		 
	 	}
	 else
	 {
	 
	  mysql_query("INSERT INTO language (title,code) values('{$title}','{$code}')") or die ('Khong the insert');
	  mysql_query("ALTER TABLE define ADD tran_".$code." varchar(255)");
	  
	  $mess=alert_success($config['domain'],"Thêm ngôn ngữ thành công!");
	 }
	}
	
	
	$smarty->assign('mess',$mess);
	$smarty->assign('id_module',$id_module);
	$smarty->assign("module_name",$view_path."/addlang.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################EDIT ######################################

elseif($action=='editlang')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['id_module'];
	
	if($_POST && $_POST['title']!=="")
	{
		$title=$_POST['title'];
	 	
		
		
		
		 mysql_query("UPDATE language SET title='{$title}' where id='".$id."'") ;
		$mess=alert_success($config['domain'],"Cập nhật ngôn ngữ thành công!");
    	$smarty->assign('mess',$mess);
		echo "<script>alert('Cập nhật thành công');javascript:history.go(-2)</script>";//Quay tro ve trang list
		
	}
	
	
	$listlang=list_lang("where id='".$id."'");
	$smarty->assign('id_module',$id_module);
	$smarty->assign("info",$listlang);
	$smarty->assign("module_name",$view_path."/editlang.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}


###################################DELETE ######################################

elseif($_REQUEST['action']=='dellang')
{
	$id=$_REQUEST['id'];
	$r=mysql_fetch_array(mysql_query("SELECT code FROM language where id='".$id."'"));
	mysql_query("ALTER TABLE define DROP COLUMN tran_".$r['code']);
	mysql_query("DELETE FROM language where id='".$id."'");
	mysql_query("DELETE FROM content_translate where id_lang='".$id."'");
	
	
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
	mysql_query("UPDATE language set status='".$hide."' where id='".$id."'");
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
	$r=mysql_fetch_array(mysql_query("SELECT code FROM language where id='".$id."'"));
	
	mysql_query("UPDATE new SET picture='' where id='".$id."'");
	mysql_query("ALTER TABLE define DROP COLUMN  tran_".$r['code']);
	
}   
elseif($_REQUEST['action']=="edittranslate") 
{
	$code=$_REQUEST['code'];
	if($_POST)
	{
		$searchvl=$_REQUEST['searchvl'];
		$where="where tran_".$code." like '%".$searchvl."%' or title like '%".$searchvl."'";
	}
	
	$listdefine=list_define($code);
	$listlang=listtranslate($code,$where);
	$smarty->assign('info1',$listlang);
	$smarty->assign('code',$code);
	$smarty->assign("module_name",$view_path."/edittranslate.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
	
	
	
}
	
elseif($_REQUEST['action']=="update_text") 
{
	$id=$_REQUEST['id'];
	$value=$_REQUEST['value'];
	$code=$_REQUEST['code'];
	mysql_query("UPDATE define SET tran_".$code."='".$value."' where id='".$id."'"); 
	
	
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
				$r=mysql_fetch_array(mysql_query("SELECT code FROM language where id='".$udel."'"));
				mysql_query("ALTER TABLE define DROP COLUMN tran_".$r['code']);
				mysql_query("DELETE FROM language WHERE id='$udel'");
				mysql_query("DELETE FROM content_translate where id_lang='".$udel."'");
				
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT id FROM language ".$where));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=language&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	
	
	$smarty->assign('page',$page);
	$smarty->assign('id_module',$id_module);
	$listlang=list_lang();
	$smarty->assign('info1',$listlang);
	$smarty->assign("module_name",$view_path."/listlang.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
