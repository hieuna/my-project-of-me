<?php
	if($_REQUEST['action']=="update_code") 
{
	$id=$_REQUEST['id'];
	$value=$_REQUEST['value'];
	
	mysql_query("UPDATE social SET code='".$value."' where id='".$id."'"); 
}

else{
	
	$listsocial=listsocial();
	$smarty->assign('info1',$listsocial);
	$smarty->assign("module_name",$view_path."/editsocial.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES
}

?>