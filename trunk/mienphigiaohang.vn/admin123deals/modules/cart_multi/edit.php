<?
	require_once("inc_security.php");
	checkAddEdit("edit");
	$record_id 			= getValue("record_id", "int", "GET", "");
	$fs_title			= "Edit Oder";
	$fs_action			= getURL();
	$date = time();
	//query get info
	//lay du lieu cua record can sua doi
$db_data 	= new db_query("SELECT * FROM " . $fs_table . " WHERE " . $id_field . " = " . $record_id);

	if($row 	= mysql_fetch_assoc($db_data->result))
	{
		foreach($row as $key=>$value)
		{
			if($key!='lang_id' && $key!='admin_id') $$key = $value;
		}
		//get thông tin user:
		$user_id = $row["user_id"];
		$pro_id = $row["pro_id"];
		$cart_quality = $row["cart_quality"];
		$db_user           = new db_query("SELECT * 
                                        FROM users Where id = '$user_id'");									 
		$row_user  = mysql_fetch_array($db_user->result);
		$username = $row_user["username"];
		
		//get thông tin bên user cart:
		$db_user_cart         = new db_query("SELECT * 
                                        FROM custom_cart Where cart_id = " . $record_id);									 
		$row_user_cart  = mysql_fetch_array($db_user_cart->result);
		$user_cart= $row_user_cart["cus_name"];
		$phone = $row_user_cart["cus_phone"];
		$cus_email = $row_user_cart["cus_email"];
		$cus_add = $row_user_cart["cus_add"];
		$cus_mes = $row_user_cart["cus_mes"];
		//get thông tin thanh toán
		$db_user_pay        = new db_query("SELECT * 
                                        FROM cart_detail Where cart_id = " . $record_id);									 
		$row_user_pay  = mysql_fetch_array($db_user_pay->result);
		$tran_id = $row_user_pay["tran_id"];	
		$tran_status = $row_user_pay["tran_status"];	
		$date_update = $row_user_pay["date_update"];
		//get tên sp:
		$db_user_pro       = new db_query("SELECT * 
                                        FROM products_multi Where pro_id = " . $pro_id);									 
		$row_user_pro  = mysql_fetch_array($db_user_pro->result);
		$pro_name = $row_user_pro["pro_name"];
		$pro_loca = $row_user_pro["pro_loca"];
	}else
	{
		exit();
	}
	//end info
	$myform = new generate_form();
	$myform->add("note", "note", 0, 0, "", 1, "", 0, "");
	$myform->add("cart_quality", "quality", 0, 0, "", 1, "", 0, "");
	$myform->add("oder_status","oder_status",0,1,"",1,"Chọn trạng thái đơn hàng","",0,"");
	$myform->add("payment_type","payment_type",0,1,"",1,"Chọn phương thức thanh toán","",0,"");
	$myform->add("cart_loca","cart_loca",0,1,"",1,"Chọn Thành phố","",0,"");

	$myform->addTable($fs_table);
	
	//Get gia tri submit form co duoc gan vao ko?
	
	$submitform = getValue("action", "str", "POST", "");
	$soluong = getValue("quality", "str", "POST", 0);
	$phones = getValue("phone", "int", "POST", "");
	$email = getValue("email", "str", "POST", "");
	$add = getValue("add", "str", "POST", "");
	$mess = getValue("mess", "str", "POST", "");
	$transaction_status = getValue("transaction_status", "int", "POST", 0);

	$oder_status    = getValue("oder_status","int","POST",$row['oder_status']);
	$payment_type    = getValue("payment_type","int","POST",$row['payment_type']);
	$cart_loca    = getValue("cart_loca","int","POST",$row['cart_loca']);
	$note    = getValue("note","str","POST",$row['note']);

	//$oder_status    = getValue("note","int","POST",$row['note']);

	if($submitform == "execute"){		
				$myform->addTable($fs_table);
				
				$myform->removeHTML(0);
				$db_ex = new db_execute($myform->generate_update_SQL($id_field,$record_id));
				//update data :
				$db_updatesu = new db_execute("UPDATE  cart_detail
										  SET tran_status = '$transaction_status' , 										  	  
											  date_update   = '$date' 										  
										  WHERE cart_id = '".$record_id."'");
				unset($db_updatesu);
				//update transaction status:
				$db_updatetran = new db_execute("UPDATE custom_cart 
										  SET cus_phone = '$phones' , 
										  	  cus_email = '$email' ,
											  cus_add   = '$add' ,
											  cus_mes   = '$mess' 										  
										  WHERE cart_id = '".$record_id."'");
				unset($db_updatetran);
				if($cart_quality > $soluong){
					$tru = $cart_quality - $soluong;
				$db_updatesl = new db_execute("UPDATE products_multi 
										  SET  pro_coupon = pro_coupon - '$tru'
										  WHERE pro_id = '".$pro_id."'");
				}
				if($cart_quality < $soluong){
					$cong =  $soluong - $cart_quality;
				$db_updatesl = new db_execute("UPDATE products_multi 
										  SET pro_coupon = pro_coupon + '$cong'
										  WHERE pro_id = '".$pro_id."'");
				}
		  		unset($db_updatesl);
				//Redirect to:
				redirect("listing.php");	
		//}//End if($fs_errorMsg == "")
		
	}//End if($action == "insert")		
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?=$load_header?>
<? 

//chuyển các trường thành biến để lấy giá trị thay cho dùng kiểu getValue
$myform->evaluate();
//add form for javacheck
$myform->addFormname("add");

$errorMsg = $myform->strErrorField;

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_top("Sửa Đơn hàng")?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
	<?
    	$form = new form();
		$form->create_form("Edit", "", "post", "multipart/form-data", "");
		$form->create_table();
	?>   
     	<tr>
            <td align="center" style="font-family:Arial, Helvetica, sans-serif; color:#066; font-size:14PX; font-weight:bold">THÔNG TIN KHÁCH HÀNG : </td>
        </tr>
         <tr>
            <td align="center" class="form_name">User : </td><td class="form_text"><input readonly="readonly" class="form_control"  title="User đặt hàng" name="user_id" value="<?=$row["user_id"]?>" width="100" />Tài khoản: <?=$username?></td>
        </tr>
         <tr>
            <td align="center" class="form_name">Họ tên : </td><td class="form_text"><input readonly="readonly" class="form_control"  title="Họ tên user" name="username" value="<?=$user_cart?>" width="270" /></td>
        </tr>
        <tr>
            <td align="center" class="form_name">Số ĐT : </td><td class="form_text"><input  class="form_control"  title="Số đt" name="phone" value="<?=$phone?>" width="270" /> </td>
        </tr>
        <tr>
            <td align="center" class="form_name">Email: </td><td class="form_text"><input  class="form_control"  title="Email" name="email" value="<?=$cus_email?>" width="350" /></td>
        </tr>
	 	<tr>
            <td align="center" class="form_name">Địa chỉ: </td><td class="form_text"><textarea name="add"><?=$cus_add?></textarea></td>
        </tr>
        <tr>
            <td align="center" class="form_name">Lời nhắn: </td><td class="form_text"><textarea name="mess"><?=$cus_mes?></textarea></td>
        </tr>
        
        <tr>
            <td colspan="2" align="left" style="border-bottom:1px #999 dotted; width:500px"></td>
        </tr>
        <tr>
            <td align="center" style="font-family:Arial, Helvetica, sans-serif; color:#066; font-size:14PX; font-weight:bold">THÔNG TIN ĐƠN HÀNG : </td>
        </tr>
		  <?=$form->select("Chọn thành phố","cart_loca","cart_loca",$arraylocal,$cart_loca,"Thành phố",1)?>

         
         <tr>
            <td align="center" class="form_name">Trạng thái giao dịch: </td><td class="form_text">
            
           						 <select class="form_control" name="transaction_status" id="transaction_status" >
														<option <?php if ($tran_status ==0){ ?> selected="selected" <?php }?> value="0">Đang xử lý</option>
                                                        <option <?php if ($tran_status ==1){ ?> selected="selected" <?php }?> value="1">Hoàn tất</option>
                                                        <option <?php if ($tran_status ==2){ ?> selected="selected" <?php }?> value="2">Hủy giao dịch</option>
                                                        <option <?php if ($tran_status ==3){ ?> selected="selected" <?php }?> value="3">Hoàn tiền</option>
                                                        
								</select>
            </td>
        </tr>
        <tr>
            <td align="center" class="form_name">Tổng số tiền thanh toán: </td><td class="form_text"><input readonly="readonly" class="form_control"  title="Tổng số tiền thanh toán" name="total_amount" value="<?=$row["total_amount"]?>"  length="250" style="width:250px;" /></td>
        </tr>
        <tr>
            <td align="center" class="form_name">Mã Sản phẩm: </td><td class="form_text"><input readonly="readonly" class="form_control"  title="sp" name="masp" value="<?=$row["pro_id"]?>"  length="250" style="width:50px;" /></td>
        </tr>
        <tr>
            <td align="center" class="form_name">Tên SP: </td><td class="form_text"><input readonly="readonly" class="form_control"  title="Phí Bảo Kim thu" name="fee_amount" value="<?=$pro_name?>"  length="250" style="width:300px;" /></td>
        </tr>
         <tr>
            <td align="center" class="form_name">Số lượng: </td><td class="form_text"><input  class="form_control"  title="Số lượng" name="quality" value="<?=$row["cart_quality"]?>"  length="250" style="width:100px;" /></td>
        </tr>
        <?=$form->select("Trạng thái đơn hàng","oder_status","oder_status",$arraycartstatus,$oder_status,"Trạng thái đơn hàng",1)?>
        <tr>
            <td align="center" class="form_name">Ghi chú: </td><td class="form_text">
            <textarea name="note" style="width:300px"><?=$row["note"]?></textarea>
            </td>
        </tr>
      	
        <?=$form->select("Phương thức thanh toán","payment_type","payment_type",$arraypaymenttype,$payment_type,"Phương thức thanh toán",1)?>	
        <?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
        <?=$form->hidden("action", "action", "execute", "");?>
        <?
			$form->close_table();
			$form->close_form();
			unset($form);
		?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>