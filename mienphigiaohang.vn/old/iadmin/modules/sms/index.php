<?php
###################################ADD ######################################

if($_REQUEST['action']=='del')
{
	$id=$_REQUEST['id'];
	
	mysql_query("DELETE FROM sms where sms_id='".$id."'");
	
/*	$smarty->assign('id_module',$id_module);
	$list_cat=listnew("new",$limit,$where,$catsearch);
	$smarty->assign('info1',$list_cat);
	$smarty->assign("module_name",$view_path."/listnew.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
	*/
	echo "<script>javascript:history.go(-1)</script>";
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
				
				mysql_query("DELETE FROM sms WHERE sms_id='$udel'");
				
				
			}
		}
	}
	
	/****************SEARCH LIST*******************/
	$where="where 1=1";
	if(isset($_REQUEST['searchvl']))
	{
		$txtsearch=$_REQUEST['searchvl'];
		$where.=" and (sms_phone like '%".$txtsearch."%' or sms_service like '%".$txtsearch."%')";
		$psearch="&searchvl=".$txtsearch;
	}
	
		
	
	
	$row=5;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT * FROM sms ".$where));
	
	//////////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		" limit ".$start.",".$row;
	$url_page="do=sms&id_module=".$id_module.$psearch;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	
	
	
	
	
	

	$smarty->assign("search_select",$txtsearch);
	$smarty->assign('page',$page);
	$smarty->assign('id_module',$id_module);
	$list_sms=list_sms($limit,$where);
	$smarty->assign('info1',$list_sms);
	$smarty->assign("module_name",$view_path."/list.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
