<?php
require_once("inc_security.php");
$list = new fsDataGird($id_field,$name_field,"Danh sách đơn hàng");

//**********************Menu Quicksearch  
//Trạng thái
$iActive       = getValue("iActive");
$arrayActive = array(   0 =>"--[Tất cả]--",
						1 =>"Đang xử lý",
                        2 =>"Hoàn thành",
                        3 =>"Hủy đơn hàng"
                        );
//Keyword
$sql                    = '';
$cart_id               = getValue("cart_id","str","GET","",1,1);
//sdt
$pro_id               = getValue("pro_id","str","GET","",1,1);
//tìm theo user người mua
$user_name               = getValue("user_name","str","GET","",1,1);
//tìm theo vùng:
$cart_loca               = getValue("cart_loca","str","GET","",1,1);
$arraypro_loca = array(  0 =>"--[Tất cả]--",
						1 =>"Hà Nội",
                        2 =>"Hồ Chí Minh"
                        );
//Show menu Search
$list->addSearch("MaDH","cart_id","text","");   
$list->addSearch("MaSP","pro_id","text",""); 
$list->addSearch("TT","iActive","array",$arrayActive,$iActive); 
$list->addSearch("User Name","user_name","text",""); 
$list->addSearch("TP","cart_loca","array",$arraypro_loca,$cart_loca); 
$list->addSearch("Từ","time_sent1","date"); 
$list->addSearch("Đến","time_sent2","date"); 

$time1 =  getValue("time_sent1","str","GET","dd/mm/yyyy");
$time2 =  getValue("time_sent2","str","GET","dd/mm/yyyy");
//echo $time1.$time2;


//Ghép Query 
if($cart_id!='' && $cart_id != translate_text("Enter keyword")){
    $sql   .= " AND Id = ".$cart_id ." ";
}
if($pro_id!='' && $pro_id != translate_text("Enter keyword")){
	$sql_pro_id= " AND pro_id = ".$pro_id." ";
    $sql   .= $sql_pro_id;
}
//serch time


if($time1!=''&& $time1 != translate_text("dd/mm/yyyy") && $time2!='' && $time2 != translate_text("dd/mm/yyyy")){
	$gettime1 = strtotime(str_replace('/','-',$time1));
	$gettime2 = strtotime(str_replace('/','-',$time2));
	$sql_catime= " AND ".$gettime1." <= time_sent AND ".$gettime2." >= time_sent ";
    $sql   .= $sql_catime;
	}
		
if($user_name!='' && $user_name != translate_text("Enter keyword")){ 
	//die($user_name);
	$db_user           = new db_query("SELECT * 
                                        FROM users Where username = '$user_name'");									 
	if($listing_user  = mysql_fetch_array($db_user->result)){
	$user_id = $listing_user["id"];}else{$user_id = 0;}
	
	$sql_user_id= " AND user_id = ".$user_id." ";
    $sql   .= $sql_user_id;
}

if($cart_loca!=0){  
 //query 
 //die($pro_loca);
 
	$sql_locl = " AND cart_loca = ".$cart_loca." ";
	$sql .= $sql_locl;
}

if($iActive!=0){
    if($iActive==1) $oder_status = 1;
	elseif($iActive==2) $oder_status = 2;
   elseif($iActive==3) $oder_status = 3;
    $sql_ac= " AND oder_status = ".$oder_status." ";
	 $sql .= $sql_ac;
	 }

$record_id          = getValue("record_id"); 
// PHẦN PHÂN TRANG.       
//Get page break params
$page_size		= 10;
$page_prefix	= "Trang: ";
$normal_class	= "page";
$selected_class= "page_current";
$previous		= "<";
$next			= ">";
$first			= "<<";
$last			= ">>";
$break_type		= 1;//"1 => << < 1 2 [3] 4 5 > >>", "2 => < 1 2 [3] 4 5 >", "3 => 1 2 [3] 4 5", "4 => < >"
$url			= getURL(0,0,1,1,"page");
$db_count           = new db_query("SELECT COUNT(Id) AS count
                                        FROM " . $fs_table . " Where Id > 0 " . $sql."
                                       ");									 
$listing_count   = mysql_fetch_array($db_count->result);
$total_record    = $listing_count["count"];
$current_page    = getValue("page", "int", "GET", 1);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
$db_count->close();
unset($db_count);

//Query Select
	$query_listAll = "SELECT * 
                        FROM " . $fs_table . " WHERE Id > 0 " . $sql . 
                       "
                        ORDER BY Id DESC
                        LIMIT ".($current_page-1)*$page_size. " , " .$page_size;
	
//die($query_listAll);
$db_listing    = new db_query($query_listAll);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script language="javascript">
function check_all_module(type){
	for(i=1; i<=50; i++){
		ob = document.getElementById("record_" + i);
		if(!ob) break;
		ob.checked = type;
	}
}
</script>
<?=$load_header?>

</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top("Danh sách đơn hàng",$list->urlsearch())?>  
    <table border="1" cellpadding="3" cellspacing="0" class="table" width="100%" bordercolor="<?=$fs_border?>">
        <tr>
            <td colspan="12" align="left" style="padding-left:5px" class="break_page">
                <?=generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?>             
                <strong style="padding-left:100px">Tổng số: <?=$total_record?> bản ghi</strong>
            </td>    
        </tr>
        <tr  bgcolor="#f0f1f3" style="font-weight:bold"> 
            <td   width="5"><img src="<?=$fs_imagepath?>no.gif" border="0"></td>
            <td width="2%"><input type="checkbox" id="chech_all" value="1" onClick="check_all_module(this.checked)" /></td>
            <td  width="2%" nowrap="nowrap" align="center">Mã đơn hàng</td>
            <td  width="9%" nowrap="nowrap" align="center">Mã SP</td>
             <td  width="15%" nowrap="nowrap" align="center">Tên SP</td>
         
          	<td  align="center"  width="9%">Số lượng</td>
            <td  align="center"  width="9%">Thời gian</td>
            <td  align="center" width="9%">Tình trạng Đơn hàng</td>
            <td align="center" width="9%">Phương thức thanh toán</td>
           
            <td  align="center" width="9%">User</td>
            <td  align="center" width="9%">Thành phố</td>
        
            <td  align="center" width="3%"><img src="<?=$fs_imagepath?>edit.png" border="0" width="16"></td>
           
        </tr>
        <form action="" method="post" name="form_listing" id="form_listing" enctype="multipart/form-data">
        <input type="hidden" name="iQuick" value="update">    
        <?      
        $countno = ($current_page - 1) * $page_size;
        while($row = mysql_fetch_array($db_listing->result)){
            $countno++;			
        ?>
        <tr>
            <td width="2%" nowrap="nowrap" align="center"><?=$countno?></td>
            <td>
                <input type="checkbox" name="record_id[]" id="record_<?=$row["Id"]?>" value="<?=$row["Id"]?>">
          </td>
            <td width="2%" nowrap="nowrap" align="center"><?php print $row["Id"]; ?></td>
            <td align="center"><?php print $row["pro_id"]; ?></td>
            <?php 
			// get tên sp:
			
			$pro_id = $row["pro_id"];
			$db_pro_name           = new db_query("SELECT * 
                                        FROM products_multi Where pro_id = '$pro_id'");									 
			$row_pro_name  = mysql_fetch_array($db_pro_name->result)
			?>
             <td align="center"><a href="../../../deals/<?php if($row["cart_loca"] == 1){echo 'ha-noi';} else if($row["cart_loca"] == 2){echo 'ho-chi-minh';}?>-<?php echo replace_rewrite_url($row_pro_name["pro_name"]). '_' . $row["pro_id"]?>.html" target="_blank"><?php print $row_pro_name["pro_name"]; ?></a></td>
           
            <td nowrap="nowrap" align="center"><?php print $row["cart_quality"]; ?></td>
            <td  align="center"><?=date("d/m/Y h:m:s A",$row["time_sent"])?></td>
            <td align="center">
			<?php 
				 if($row["oder_status"] ==1){echo 'Đang xử lý';}
				 else if($row["oder_status"] ==2){echo 'Hoàn tất';}
				 else if($row["oder_status"] ==3){echo 'Đơn hàng hủy';}
			?>
            </td>
             <td align="center">
             <?php 
				 if($row["payment_type"] ==1){echo 'Giao tại nhà';}
				 else if($row["payment_type"] ==2){echo 'Nhận tại 123re.vn';}
				 else if($row["payment_type"] ==3){echo 'Qua Bảo Kim';}
				 else if($row["payment_type"] ==4){echo 'Qua Ngân Lượng';}
			?>
             </td>
            
               
                 <td align="center"><?php print $row["user_id"]; ?></td>
                <td align="center"><?php if($row["cart_loca"] == 1) {echo 'Hà Nội';} else if($row["cart_loca"] == 2) {echo 'TP.HCM';} ?></td>
        
            <td align="center" width="12"><a class="text" href="edit.php?record_id=<?=$row["Id"]?>&amp;returnurl=<?=base64_encode(getURL())?>"><img src="<?=$fs_imagepath?>edit.png" alt="EDIT" border="0"></a></td>
            
            
        </tr>
        <? } ?>
        <tr>
        <td colspan="12"> <input type="Submit" name="del" value="Delete all selected" />
        
        <?php
		function reload(){
		echo "
		<script type=\"text/javascript\">
		window.history.back();
		</script>
		";
	}       
			if(isset($_POST['del'])) {
				checkAddEdit("delete");
			if(empty($_POST['record_id'])) {
			 echo "<script>alert(\"Bạn chưa chọn đối tượng !\");</script>";
			} else {
			if(is_array($_POST['record_id'])) {
			$id =join($_POST['record_id'],',');			
			}			
			$del = mysql_query("delete from cart where Id IN ($id)");
			if($del) {
			 echo "<script>alert(\"Xóa thành công !\");</script>" ;
				 reload();		
			 }			
			else { echo "<script>alert(\"Lệnh xóa không thành công!\");</script>";}
			}			
		} 
?>
        </td></tr>
         <tr>
            <td colspan="12" align="left" style="padding-left:5px" class="break_page">
               <?=generatePageBar_basic($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?>                 
            </td>
        </tr>        
        <!--end-->
        </form>
        </table>
        
 
<?=template_bottom() ?>

<? /*------------------------------------------------------------------------------------------------*/ ?>


</body>
</html>