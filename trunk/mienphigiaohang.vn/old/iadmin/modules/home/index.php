<?php

	function count_num($tbl,$where="")
	{
		$num=mysql_num_rows(mysql_query("SELECT * FROM ".$tbl." ".$where));
		return $num;
	}
	
	$num_category=count_num("category");
	$num_new=count_num("post","where module=2");
	$num_product=count_num("post","where module=4");
	$num_module=count_num("module");
	$num_user=count_num("users");
	//$list_n=listnew("post","limit 0,8","where and module=2");
	
	$list_n=listpost("post INNER JOIN content_translate ON post.id=content_translate.id_category","limit 0,8","where module=4","");
	
	
	
	$smarty->assign("ls",$list_n);
	$smarty->assign("num_category",$num_category);
	$smarty->assign("num_new",$num_new);
	$smarty->assign("num_product",$num_product);
	$smarty->assign("num_module",$num_module);
	$smarty->assign("num_user",$num_user);
	
	$smarty->assign("module_name",$view_path."/index.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES


?>