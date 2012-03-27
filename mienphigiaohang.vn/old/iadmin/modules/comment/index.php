<?php

if($_REQUEST['action']=='detail')
{
	$id=$_REQUEST['id'];
	$where=" where id='".$id."'";
	$listcom=listcom($where);
	$smarty->assign('info1',$listcom);
	
	$smarty->assign("module_name",$view_path."/detail.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

###################################DELETE ######################################

elseif($_REQUEST['action']=='delcom')
{
	$id=$_REQUEST['id'];
	
	
	mysql_query("DELETE FROM comment where id='".$id."'");
	
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
	mysql_query("UPDATE comment set hide='".$hide."' where id='".$id."'");
	
}
###################################DEL PIC#################################

	   
	   
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
				
				mysql_query("DELETE FROM comment WHERE id='$udel'");
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		$catsearch=$_REQUEST['category'];
		$where=" where body like '%".$txtsearch."%'";
		$psearch="&searchvl=".$txtsearch."&category=".$catsearch;
		if($catsearch!=""){$where.=" and type_parent=".$catsearch;}
	}
	else
	{
		$where="";
	}
	
	
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT id FROM comment ".$where));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=comment&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	$smarty->assign('page',$page);
	$listcom=listcom($where,$limit);
	$smarty->assign('info1',$listcom);
	$smarty->assign("module_name",$view_path."/listcom.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
