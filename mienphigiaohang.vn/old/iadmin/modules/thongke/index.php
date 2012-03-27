<?php

if($_POST['submit'])
	{
		if($_POST['Selected'])
		{
			foreach($_POST['Selected'] as $udel)
			{
				
				mysql_query("DELETE FROM log WHERE id='$udel'");
			
				
			}
		}
	}
	$row=10;
	$div=7;
	$num_value=mysql_num_rows(mysql_query("SELECT id FROM log"));
	
	///////////////////////////PHAN TRANG
	$p = (isset($_GET['p'])) ? $_GET['p'] : "0";  				
	$start = 	$p*$row;
	$limit=		"limit ".$start.",".$row;
	$url_page="do=thongke";
	$page=divPage($num_value,$p,$div,$row,"index.php?".$url_page);

$tongthongke=tongthongke();
$tongtoday=tongtoday();
$tongmonth=tongmonth();
$tongtuan=tongtuan();
$tonglastday=tonglastday();
$dangtruycap=dangtruycap();

$arr_thongke=array("tongthongke"=>$tongthongke,"tongtoday"=>$tongtoday,"tongmonth"=>$tongmonth,"tongtuan"=>$tongtuan,"tonglastday"=>$tonglastday,"dangtruycap"=>$dangtruycap);

$smarty->assign('info_tk',$arr_thongke);
$smarty->assign('page',$page);	
$listthongke=list_thongke($limit);
$smarty->assign('info1',$listthongke);
$smarty->assign("module_name",$view_path."/listthongke.html");//////////////TRUY XUAT GIAO DIEN CUA MODULES


?>