<?php
	if($_REQUEST['action']=="update_email") 
{
	$id=$_REQUEST['id'];
	$value=$_REQUEST['value'];
	mysql_query("UPDATE payment SET email='".$value."' where id='".$id."'"); 
}
###################################UPDATE HIDE#################################

elseif($_REQUEST['action']=="update_hide")
{
	$hide=$_REQUEST['hide'];
	$id=$_REQUEST['id'];
	mysql_query("UPDATE payment set hide='".$hide."' where id='".$id."'");
	
}

else{
	
	$listpay=listpay();
	$smarty->assign('info1',$listpay);
	$smarty->assign("module_name",$view_path."/editpay.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

?>