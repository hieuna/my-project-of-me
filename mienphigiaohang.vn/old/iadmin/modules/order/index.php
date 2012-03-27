<?
if($_REQUEST['action']=='detail')
{
	$id=$_REQUEST['id'];
	$id_module=$_REQUEST['module'];
	$list_cat=list_order_detail($id);
	$list_cat2=listorder3($id);
	$smarty->assign('id_module',$id_module);
	$smarty->assign('info1',$list_cat);
	$smarty->assign('info2',$list_cat2);
	$u=mysql_fetch_array(mysql_query("SELECT username FROM users where id='".$list_cat2['id_user']."'"));
	$smarty->assign('username',$u['username']);
	$smarty->assign("module_name",$view_path."/listorder_detail.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

elseif($_REQUEST['action']=='delorder')
{
	$udel=$_REQUEST['id'];
	mysql_query("DELETE FROM orders WHERE id='$udel'");
	mysql_query("DELETE FROM order_detail where id_order='$udel'");
	echo "<script>javascript:history.go(-1)</script>";
}
elseif($_REQUEST['action']=="update_trangthai")
{
	$trangthai=$_REQUEST['trangthai'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE orders SET tinhtrang='".$trangthai."' where id='".$id."'");
}
elseif($_REQUEST['action']=="update_thanhtoan")
{
	$trangthai=$_REQUEST['trangthai'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE orders SET tinhtrangthanhtoan='".$trangthai."' where id='".$id."'");
}
else
{
	$id_module=$_REQUEST['id_module'];
	$id_pro=$_REQUEST['id_pro'];
	/****************DELETE APPLY*******************/
	if($_POST['submit'])
	{
		if($_POST['Selected'])
		{
			foreach($_POST['Selected'] as $udel)
			{
				
				mysql_query("DELETE FROM orders WHERE id='$udel'");
				mysql_query("DELETE FROM order_detail where id_order='$udel'");
			}
		}
	}
	
	$where="where 1=1";
	$page_where="";
	if( isset($_REQUEST['date_from']) && $_REQUEST['date_from']!="Từ ngày" && $_REQUEST['date_to']!="Đến ngày")
	{
		$date_from=$_REQUEST['date_from'];
		$date_from=substr($date_from,-4,4)."-".substr($date_from,0,2)."-".substr($date_from,3,2)." 00:00:00";
		$date_to=$_REQUEST['date_to'];
		$date_to=substr($date_to,-4,4)."-".substr($date_to,0,2)."-".substr($date_to,3,2)." 00:00:00";
		$where.=" and (date between '".$date_from."' and '".$date_to."')";
		$page_where.="&date_from=".$_REQUEST['date_from']."&date_to=".$_REQUEST['date_to']."";
	}
	
	if($_REQUEST['city']!="" && $id_pro=="")
	{
		$where.=" and pro_id IN (SELECT id FROM post where city='".$_REQUEST['city']."')";
		$page_where.="&city=".$_REQUEST['city'];
	}
	
	if($id_pro!="")
	{
		$where.= " and pro_id='".$id_pro."'";
		$where_dangxuly=$where." and tinhtrang=0";
		$where_hoantat=$where." and tinhtrang=1";
		$where_hoantatthanhtoan=$where." and tinhtrangthanhtoan=1";
		$where_chuathanhtoan=$where." and tinhtrangthanhtoan=0";
		$page_where.="&id_pro=".$id_pro."";
	}
	else
	{
		$where_dangxuly=$where." and tinhtrang=0";
		$where_hoantat=$where." and tinhtrang=1";
		$where_hoantatthanhtoan=$where." and tinhtrangthanhtoan=1";
		$where_chuathanhtoan=$where." and tinhtrangthanhtoan=0";
	}
	
	
	$row=10;
	$div=7;
	$query_value=mysql_query("SELECT id FROM orders ".$where) or die ("SELECT id FROM orders ".$where);
	$num_value=mysql_num_rows($query_value);
	
	
	//THONG KE
	
	$tongdonhang=$num_value;
	
	if($id_pro!="")
	{
		$name_pro=mysql_fetch_array(mysql_query("SELECT title FROM content_translate where id_category='".$id_pro."' and id_lang='".$_SESSION['id_lang']."'"));
	}
	else
	{
		$name_pro="";
	}
	
	$quan=mysql_fetch_array(mysql_query("SELECT sum(quality) AS total FROM order_detail where id_order in ( SELECT id FROM orders ".$where." )"));
	
	//$dangxuly=mysql_fetch_array(mysql_query("SELECT sum(quality) AS total FROM order_detail where id_order in ( SELECT id FROM orders ".$where_dangxuly." ) "));
	$dangxuly=mysql_num_rows(mysql_query("SELECT id FROM orders ".$where_dangxuly.""));
	
	
	//$hoantat=mysql_fetch_array(mysql_query("SELECT sum(quality) AS total FROM order_detail where id_order in ( SELECT id FROM orders ".$where_hoantat." ) "));
	
	$hoantat=mysql_num_rows(mysql_query("SELECT id FROM orders ".$where_hoantat.""));
	
	
	//$hoantatthanhtoan=mysql_fetch_array(mysql_query("SELECT sum(quality) AS total FROM order_detail where id_order in ( SELECT id FROM orders ".$where_hoantatthanhtoan." ) "));
	$hoantatthanhtoan=mysql_num_rows(mysql_query("SELECT id FROM orders ".$where_hoantatthanhtoan.""));
	
	
	//$chuathanhtoan=mysql_fetch_array(mysql_query("SELECT sum(quality) AS total FROM order_detail where id_order in ( SELECT id FROM orders ".$where_chuathanhtoan." ) "));
	$chuathanhtoan=mysql_num_rows(mysql_query("SELECT id FROM orders ".$where_chuathanhtoan.""));
	
	
	$smarty->assign('tongdonhang',$tongdonhang);
	$smarty->assign('tongphieu',$quan['total']);
	$smarty->assign('dangxuly',$dangxuly);
	$smarty->assign('hoantat',$hoantat);
	$smarty->assign('dangthanhtoan',$chuathanhtoan);
	$smarty->assign('hoantatthanhtoan',$hoantatthanhtoan);
	$smarty->assign('name_pro',$name_pro['title']);
	
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=order&id_module=".$id_module.$page_where;
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);
	
	$list_cat=list_order($limit,$where);
	
	$list_city=list_city("where hide=1");
	$smarty->assign('list_city',$list_city);
	
	
	$smarty->assign('id_module',$id_module);
	$smarty->assign('page',$page);
	$smarty->assign('info1',$list_cat);
	$smarty->assign("module_name",$view_path."/listorder.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}
?>
