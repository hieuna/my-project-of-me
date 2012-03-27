<?php
    require_once("inc_security.php");
    //check quyền them sua xoa
    checkAddEdit("add");

    //Khai bao Bien
    $add                =   "add.php";
    $listing            =   "listing.php";  
    $sql                =   " cat_type = 'product'";  
      
    $menu                   = new menu(); 
    $listAll                = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $lang_id . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");
    
    $pro_prodate_start          = getValue("pro_prodate_start", "str", "POST", date("d/m/Y"));
    $pro_protime_start          = getValue("pro_protime_start", "str", "POST", date("H:i:s"));
    $pro_date_show              = getValue("pro_date_show", "int", "POST","7");
	$pro_loca = getValue("pro_loca","int","POST",1);
    //check user đăng sp
	$pro_user_id = getValue("pro_user_id","str","POST","");
	
    $action                     = getValue("action", "str", "POST", ""); 
    $pro_category_id            = getValue("pro_category_id","int","POST");
	$pro_special = getValue("pro_special","str","POST",""); 
	$pro_dieukien = getValue("pro_dieukien","str","POST",""); 
    // 22-3-2012
	$pro_meta_tag = getValue("pro_meta_tag","str","POST",""); 
	$pro_site_title = getValue("pro_site_title","str","POST","");  
	$pro_meta_description = getValue("pro_meta_description","str","POST","");  
	$pro_meta_keywords = getValue("pro_meta_keywords","str","POST","");  
	//
    if($array_config["description"]==1){
        $pro_description = getValue("pro_description","str","POST","");  
    }
      
    $myform                 = new generate_form();
    $myform->removeHTML(0);
    $errorMsg = "";
	
    if($array_config["description"]==1){
        $myform->add("pro_description","pro_description",0,1,"",1,"Nhập thông tin mô tả về sản phẩm",0,"",1);
    }  //END if($array_config["description"]==1){   
        
    //Insert vào CSDL 
    $myform->add("pro_category_id","pro_category_id",0,1,"",1,"Chọn một Category","",0,"");                                     
    $myform->add("pro_name","pro_name",0,0,"",1,"Nhập tên sản phẩm",0,"",1);
	
	// Code them 21-3-2012
	$myform->add("pro_site_title","pro_site_title",0,0,"",1,"Nhập Site-Title",0,"",1);
	$myform->add("pro_meta_tag","pro_meta_tag",0,0,"",1,"Nhập Meta-Tag",0,"",1);
	$myform->add("pro_meta_description","pro_meta_description",0,1,"",1,"Nhập Meta-Description",0,"",1);
	$myform->add("pro_meta_keywords","pro_meta_keywords",0,1,"",1,"Nhập Meta-Keywords",0,"",1);
	//
	$myform->add("pro_partner_id","pro_partner_id",0,0,"",1,"Nhập mã đối tác",0,"",1);

    $myform->add("pro_shot_title","pro_shot_title",0,0,"",1,"Nhập thông tin ngắn gọn sản phẩm",0,"",1);
	$myform->add("pro_special","pro_special",0,1,"",1,"Điểm nổi bật",0,"",1);
	$myform->add("pro_dieukien","pro_dieukien",0,1,"",1,"Điều kiện sử dụng",0,"",1);
	$myform->add("pro_loca", "pro_loca", 1, 1,0, 1, "Bạn chưa chọn vị trí hiển thị", 0, "");

    /*$myform->add("pro_address","pro_address",0,0,"",1,"Địa chỉ đổi voucher",0,"",1);       */ //bien :dia chi Voucher
    $myform->add("pro_active","pro_active",1,0,0,0,"",0,"");
    $myform->add("pro_price_deal","pro_price_deal",0,1,"",1,"Nhập giá SP tại Miễn Phí",0,"");       
	$myform->add("pro_price_merchant","pro_price_merchant",0,1,"",1,"Giá Ship",0,"");  // nhap gia thi truong chuyển thành giá Ship
    $myform->add("pro_gmap","pro_gmap",0,0,"",1,"Địa chỉ trên Google!",0,"",1);
	$myform->add("pro_quality","pro_quality",0,0,"",0,"",0,"");       
	$myform->add("pro_user_id", "pro_user_id", 0, 1, "", 1, "user id", 0, "");

    
    if($action == "insert"){  
        /*$pro_address = getValue("pro_address","str","POST","");  */ // kiem tra bien : dia chi voucher co ton tai hay ko
        $pro_price_deal       = getValue("pro_price_deal","int","POST",""); 
		$pro_price_merchant     = getValue("pro_price_merchant","int","POST","");  // kiem tra bien gi� san pham trn thi truong co ton tai hay ko
        $pro_latest             = time();
        
        $errorMsg .= $myform->checkdata();
        $pro_start              = convertDateTime($pro_prodate_start, $pro_protime_start);
        $pro_end                = ($pro_date_show * 24 * 60 * 60) + $pro_start;
        
        $myform->add("pro_latest","pro_latest",0,1,"",0,"",0,"",1);   
        $myform->add("pro_start","pro_start",0,1,"",0,"",0,"",1);
        $myform->add("pro_end","pro_end",0,1,"",0,"",0,"",1); 
        
        //Bắt lỗi số ngày đăng SP
        if($pro_date_show < 5 || $pro_date_show > 30){
            $errorMsg .= "&bull; Số ngày đăng bán phải trong khoảng 5 đến 30 ngày! <br />";
        }
        
        //Bắt lỗi ngày
        if($pro_start != 0 && $pro_end!=0){ 
            if($pro_start > $pro_end){
                $errorMsg .= "&bull; Thời gian đăng sản phẩm phải trước thời gian hết hạn! <br />";
            }
        }
  		/*
        //Tính % giảm giá
        if($pro_price_deal != 0 && $pro_price_merchant!=0){
            if($pro_price_deal >= $pro_price_merchant){
                $errorMsg .= "&bull; Giá SP tại Bảo Kim phải nhỏ hơn giá tại Merchant! <br />";
            }
            $pro_discount = intval((($pro_price_merchant - $pro_price_deal) * 100) / $pro_price_merchant);
            if($pro_discount < $con_min_discount){
                $errorMsg .= "&bull; Phần trăm giảm giá tối thiểu là ".$con_min_discount." ! <br />"; 
            }
            $myform->add("pro_discount","pro_discount",1,1,"",0,"",0,"",1);  
        }
        */
        
       //Upload ảnh
        if($errorMsg == ""){          
            $errorimg = "Bạn chưa nhập ảnh hoặc ảnh không đúng định dạng cho phép!";
            $upload_pic = new upload("pro_picture",$fs_img_upload, $extension_list, $limit_size);
            
            if ($upload_pic->file_name != ""){
                $picture = $upload_pic->file_name;
                $size = getimagesize($fs_img_upload . $picture );
                if($size[0] < 286){
                     $errorimg = "Ảnh sản phẩm có độ rộng tối thiểu là 286px! <br />";
                     $picture = '';
                }
                if($size[0] > 286){
                     $upload_pic->resize_image($fs_img_upload,$picture,286,190,"");
                     //delete_file($fs_img_upload,$picture);
                }
                if($picture!=''){
                    $upload_pic->resize_image($fs_img_upload,$picture,110,85,"normal_",$fs_img_products);
                    $upload_pic->resize_image($fs_img_upload,$picture,286,190,"medium_",$fs_img_products);               
                }
                if(!file_exists($fs_img_products.'normal_'.$picture) && $picture!=''){
                    $errorimg = '';
                    $errorimg = 'Ảnh upload có phần mở rộng chưa đúng định dạng gốc!';
                    $picture = '';
                }
            }  
            $myform->add("pro_picture","picture",0,1,"",1,$errorimg);    
        }
		
        
        $myform->addTable($fs_table);   
        $errorMsg .= $myform->checkdata(); 
             
        if($errorMsg == ""){
            $db_ex     = new db_execute_return();
            $last_id = $db_ex->db_execute($myform->generate_insert_SQL());                   
            $save = getValue("save","int","POST",0);
            //die();
            if($save==0) $fs_redirect = "listing.php";
            redirect($fs_redirect);
            exit();
        }   
        echo $myform->strErrorField;

    } //END if($action == "insert"){ 
    
    $myform->addFormname("add_new");
    $myform->evaluate();   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>
<? $myform->checkjavascript();?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?=template_top("Add New Product")?>
<div align="center" style="margin-left:100px">

 <?
    $form = new form();
    $form->create_form("add",$_SERVER['SCRIPT_NAME'] . "?" . @$_SERVER['QUERY_STRING'], "post", "multipart/form-data");
    $form->create_table('','','width="100%"');                                                 
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>
<?=$form->select("Chọn vùng","pro_loca","pro_loca",$arrayLocation,$pro_loca,"Chọn vùng",1)?>
<tr>
        <td  align="right" nowrap class="form_name" width="200"><font class="form_asterisk"> * </font>Danh mục Category:</td>
        <td class="form_text">
            <div id="content_loader">
                
                <select title="Danh mục cấp trên" id="pro_category_id" name="pro_category_id" class="form_control">
                    <option value="0">--[Chọn một danh mục]--</option>
                    <?
                    for($i=0; $i<count($listAll); $i++){
                        $selected = ($pro_category_id == $listAll[$i]["cat_id"]) ? ' selected="selected"' : '';
                        echo '<option title="' . htmlspecialbo($listAll[$i]["cat_name"]) . '" value="' . $listAll[$i]["cat_id"] . '"' . $selected . '>';
                        for($j=0; $j<$listAll[$i]["level"]; $j++) echo ' |--';
                        echo ' ' . cut_string($listAll[$i]["cat_name"], 55) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </td>
    </tr>
<?=$form->text("Mã đối tác","pro_partner_id", "pro_partner_id",$pro_partner_id, "Mã đối tác", 1, 50, "", 55, "", "", "")?>  
<?=$form->text("Tên sản phẩm","pro_name", "pro_name",$pro_name, "Tên sản phẩm", 1, 250, "", 255, "", "", "")?>  
<!--Thêm mới-->
<?=$form->text("Site-Title","pro_site_title", "pro_site_title",$pro_site_title, "Site-Title", 0, 250, "", 255, "", "", "")?>  
<?=$form->textarea("Meta-Tag","pro_meta_tag", "pro_meta_tag",$pro_meta_tag, "Meta-Tag", 0, 250, "", 255, "", "", "")?>  
<?=$form->textarea("Meta-description","pro_meta_description", "pro_meta_description",$pro_meta_description, "Meta-descrption", 0, 250, "", 255, "", "", "")?>  
<?=$form->textarea("Meta-keywords","pro_meta_keywords", "pro_meta_keywords",$pro_meta_keywords, "Meta-keywords", 0, 250, "", 255, "", "", "")?>  
<?=$form->textarea("Giới thiệu ngắn","pro_shot_title", "pro_shot_title",$pro_shot_title, "Giới thiệu ngắn", 1, 300, "", 300, "", "", "")?>  
<?=$form->getFile("Link ảnh sản phẩm","pro_picture","pro_picture","Ảnh sản phẩm",1,50,"","<br /><i class='form_add_text'>Ảnh Upload chỉ hỗ trợ các định dạng:<b style='color:#ff0000;'>".$extension_list."</b></i>")?> 
<?=$form->text("Số lượng", "pro_quality", "pro_quality",$pro_quality, "Số lượng", 0, 50, "", 55, "", "","")?>      
         <tr> 
            <td class="form_name">Giá sản phẩm =></td>
            <td>
                <table>
                    <tr>
                        <td align="left"><font class="form_asterisk"> * </font>Tại Miễn Phĩ</td>
                        <td><input type="text" name="pro_price_deal" id="pro_price_deal" size="20" maxlength="20" class="form" value="<?=$pro_price_deal?>"></td>
                        <td rowspan="2" valign="middle" align="center" class="textBold" style="font-size:18px">
                            <span id="discount_rate" style="font-size:24px"></span>
                        </td>
                    </tr>
                    <tr>
                        <td align="left"><font class="form_asterisk"> * </font>Giá Ship</td>
                        <td><input type="text" name="pro_price_merchant" id="pro_price_merchant" size="20" maxlength="20" class="form"  value="<?=$pro_price_merchant?>"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td colspan="2">
			<?=$form->wysiwyg("Điểm nổi bật","pro_special",$pro_special, "../../resource/wysiwyg_editor/", 800, 250)?>
        </td></tr>
        <tr><td colspan="2">
			<?=$form->wysiwyg("Điều kiện sử dụng","pro_dieukien",$pro_dieukien, "../../resource/wysiwyg_editor/", 800, 250)?>
        </td></tr>
        <tr><td colspan="2">
			<?//=$form->wysiwyg("Địa chỉ đổi voucher => Không phải nhập","pro_address",$pro_address, "../../resource/wysiwyg_editor/", 800, 250)?>
        </td></tr>
        <?
        if($array_config["description"]==1){
        ?>
        <tr>
          <td colspan="2">
		  	<?=$form->wysiwyg("Mô tả sản phẩm","pro_description",$pro_description, "../../resource/wysiwyg_editor/", 800, 350)?>
          </td>
        </tr>   
       <?
        }
       ?>
<?=$form->text("Địa chỉ trên Google", "pro_gmap", "pro_gmap",$pro_gmap, "Địa chỉ trên Google", 1, 350, "", 355, "", "","")?>   
<?=$form->text("Ngày đăng","pro_prodate_start" . $form->ec . "pro_protime_start", "pro_prodate_start" . $form->ec . "pro_protime_start", $pro_prodate_start . $form->ec . $pro_protime_start, "Ngày (dd/mm/yyyy)" . $form->ec . "Giờ (hh:mm:ss)", 1, 80 . $form->ec . 80, $form->ec, 10 . $form->ec . 10, " - ", $form->ec, "&nbsp; <i>(Ví dụ: dd/mm/yyyy - hh:mm:ss)</i>");?>
<?=$form->text("Số ngày đăng bán","pro_date_show","pro_date_show",$pro_date_show,"Số ngày đăng bán",1,50,"",3,"","","&nbsp;<i class='form_add_text'>Số ngày đăng bán từ 5 đến 30 ngày!</i>")?>
 <tr><td><input id="pro_user_id" name="pro_user_id" type="hidden" value="<?=$adm_name?>"  /></td></tr>
<input type="hidden" name="pro_active" id="pro_active" value="0"> 
<?=$form->checkbox("Tiếp tục thêm","save","save",1,0,"",0,"Checked='checked'")?>  
<?=$form->hidden("action", "action", "insert", "");?>     
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>

<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</div>
</body>
</html>