<?php
    require_once("inc_security.php");
    //check quyền them sua xoa
    checkAddEdit("edit");

    //Khai bao Bien
    $fs_redirect    = base64_decode(getValue("returnurl","str","GET",base64_encode("listing.php")));
    $record_id      = getValue("record_id","int","GET");
	$_SESSION["pro_id"] = $record_id;
    $field_id       = "pro_id";
    $sql            = "cat_type = 'product'";          
    $menu           = new menu(); 
    $listAll        = $menu->getAllChild("categories_multi","cat_id","cat_parent_id","0",$sql . " AND lang_id = " . $lang_id . $sqlcategory,"cat_id,cat_name,cat_order,cat_type,cat_parent_id,cat_has_child","cat_order ASC, cat_name ASC","cat_has_child");   
    
    $db_edit   =    new db_query("SELECT * FROM products_multi WHERE pro_id=" . $record_id);
    $row       =    mysql_fetch_array($db_edit->result);
    
    $myform = new generate_form();
    //Loại bỏ chuc nang thay the Tag Html
    $myform->removeHTML(0);
    $errorMsg = "";
    $action    = getValue("action", "str", "POST", "");
    
    $pro_prodate_start      = getValue("pro_prodate_start", "str", "POST", date("d/m/Y", $row["pro_start"]));
    $pro_protime_start      = getValue("pro_protime_start", "str", "POST", date("H:i:s",$row["pro_start"]));
    
    $date_show = ($row["pro_end"] - $row["pro_start"])/(24*60*60);
    $pro_date_show          = getValue("pro_date_show", "int", "POST",$date_show);
    
    //Giữ lại giữ liệu khi Insert lỗi
    $pro_name           = getValue("pro_name","str","POST",$row['pro_name']) ;
	$pro_partner_id           = getValue("pro_partner_id","str","POST",$row['pro_partner_id']) ;
	$pro_shot_title           = getValue("pro_shot_title","str","POST",$row['pro_shot_title']) ;
	$pro_loca    = getValue("pro_loca","int","POST",$row['pro_loca']);
	//
	$pro_site_title= getValue("pro_site_title","str","POST",$row['pro_site_title']);
	$pro_meta_tag= getValue("pro_meta_tag","str","POST",$row['pro_meta_tag']);
	$pro_meta_description    = getValue("pro_meta_description","str","POST",$row['pro_meta_description']);
	$pro_meta_keywords    = getValue("pro_meta_keywords","str","POST",$row['pro_meta_keywords']);
    $pro_price_deal   = getValue("pro_price_deal","int","POST",$row['pro_price_deal']) ;
    $pro_price_merchant = getValue("pro_price_merchant","int","POST",$row['pro_price_merchant']) ;
    $pro_category_id    = getValue("pro_category_id","int","POST",$row['pro_category_id']);
    $pro_description    = getValue("pro_description","str","POST",$row['pro_description']);
	$pro_special = getValue("pro_special","str","POST",$row['pro_special']); 
	$pro_dieukien = getValue("pro_dieukien","str","POST",$row['pro_dieukien']); 
    $pro_address = getValue("pro_address","str","POST",$row['pro_address']); 
    $pro_gmap = getValue("pro_gmap","str","POST",$row['pro_gmap']);   
    if($action == "execute"){    
        $pro_link   =   getValue("pro_link","str","POST","");
        $pro_name   =   getValue("pro_name","str","POST","");
        $pro_start            = convertDateTime($pro_prodate_start, $pro_protime_start);
        $pro_end              = ($pro_date_show * 24 * 60 * 60) + $pro_start;
        $pro_link_md5         = md5($pro_link);
        //Tính % giảm giá
    /*    if($pro_price_deal != 0 && $pro_price_merchant!=0){
            if($pro_price_deal >= $pro_price_merchant){
                $errorMsg .= "&bull; Giá SP tại 123Deals phải nhỏ hơn giá tại Merchant! <br />";
            }
            $pro_discount = intval((($pro_price_merchant - $pro_price_deal) * 100) / $pro_price_merchant);
        }              
           */            
        $myform->add("pro_name","pro_name",0,1,"",1,"Nhập tên sản phẩm",0,"Tên sản phẩm đã có trong CSDL",1);  
		$myform->add("pro_category_id","pro_category_id",0,1,"",1,"Chọn một Category","",0,"");
        if($array_config["image"]==1){ 
		
		$errorimg = "Bạn chưa nhập ảnh hoặc ảnh không đúng định dạng cho phép!";
        $upload_pic = new upload("pro_picture",$fs_img_upload, $extension_list, $limit_size);
		$filename	= $upload_pic->file_name;
		if($filename != "")
				{					
					$myform->add("pro_picture","filename",0,1,"",1,$errorimg);  
					// resize
					/*$upload_pic->resize_image($fs_img_upload,$filename,110,85,"normal_",$fs_img_products);
					$upload_pic->resize_image($fs_img_upload,$filename,287,190,"medium_",$fs_img_products); 		*/	
					$size = getimagesize($fs_img_upload . $filename );
                if($size[0] < 286){
                     $errorimg = "Ảnh sản phẩm có độ rộng tối thiểu là 286px! <br />";
                     $filename = '';
                }
                if($size[0] > 286){
                     $upload_pic->resize_image($fs_img_upload,$filename,286,190,"");
                     //delete_file($fs_img_upload,$picture);
                }
                if($filename!=''){
                    $upload_pic->resize_image($fs_img_upload,$filename,110,85,"normal_",$fs_img_products);
                    $upload_pic->resize_image($fs_img_upload,$filename,286,190,"medium_",$fs_img_products);               
                }
                if(!file_exists($fs_img_products.'normal_'.$filename) && $filename!=''){
                    $errorimg = '';
                    $errorimg = 'Ảnh upload có phần mở rộng chưa đúng định dạng gốc!';
                    $filename = '';
                }		
				}//End if($filename != "")	
		                                                                                             
        }
		$myform->add("pro_partner_id","pro_partner_id",1,1,"",1,"Mã đối tác deals",0,"");
        $myform->add("pro_price_deal","pro_price_deal",0,1,"",1,"Nhập giá SP tại Miễn Phí",0,"");       
        $myform->add("pro_price_merchant","pro_price_merchant",0,1,"",1,"Nhập giá Ship SP",0,"");
        $myform->add("pro_discount","pro_discount",0,1,0,0,"",0,"",1);   
		//$myform->add("pro_address","pro_address",0,0,"",1,"Địa chỉ đổi voucher",0,"",1);       
		$myform->add("pro_loca","pro_loca",0,1,"",1,"Chọn vị trí hiển thị","",0,"");
	//
		$myform->add("pro_site_title","pro_site_title",0,0,"",1,"Nhập Site-Title",0,"",1);
		$myform->add("pro_meta_tag","pro_meta_tag",0,0,"",1,"Nhập Meta-Tag",0,"",1);
		$myform->add("pro_meta_description","pro_meta_description",0,1,"",1,"Nhập Meta-Description",0,"",1);
		$myform->add("pro_meta_keywords","pro_meta_keywords",0,1,"",1,"Nhập Meta-Keywords",0,"",1);
	//
		$myform->add("pro_shot_title","pro_shot_title",0,0,"",1,"Nhập thông tin ngắn gọn sản phẩm",0,"",1);
		$myform->add("pro_special","pro_special",0,1,"",1,"Điểm nổi bật",0,"",1);
		$myform->add("pro_dieukien","pro_dieukien",0,1,"",1,"Điều kiện sử dụng",0,"",1);
		$myform->add("pro_gmap","pro_gmap",0,0,"",1,"Địa chỉ trên Google!",0,"",1);

        $myform->add("pro_description","pro_description",0,1,"",1,"Nhập thông tin mô tả về sản phẩm",0,"",1);      
        $myform->add("pro_start","pro_start",0,1,"",1,"Thời gian đăng sản phẩm lên MPGH shopping",0,"",1);   
        $myform->add("pro_end","pro_end",0,1,"",1,"Thời gian đăng SP lên MPGH",0,"",1);   
        $myform->addTable($fs_table);   

        $errorMsg .= $myform->checkdata();

        if($errorMsg == ""){
            $db_ex     = new db_execute_return();
            $last_id = $db_ex->db_execute($myform->generate_update_SQL("pro_id", $record_id));                   
           		redirect("listing.php");

        }

    } //END if($action == "insert"){ 
	   

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?=$load_header?>

<? $myform->checkjavascript();
 	$myform->evaluate();   
    $myform->addFormname("add");
$errorMsg = $myform->strErrorField;
?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" >
<?=template_top("Add New Product")?>
<div align="center" style="margin-left:100px">

 <?
    $form = new form();
	$form->create_form("Edit", "", "post", "multipart/form-data", "");
    $form->create_table();                                                 
?>
<?=$form->text_note('Những ô có dấu sao (<font class="form_asterisk">*</font>) là bắt buộc phải nhập.')?>
<?=$form->errorMsg($errorMsg)?>
<?=$form->select("Vùng hiển thị","pro_loca","pro_loca",$arrayLocation,$pro_loca,"Vùng hiển thị",1)?>
<?=$form->text("Tên sản phẩm", "pro_name", "pro_name",$pro_name, "Tên sản phẩm", 1, 250, "", 255, "", "", "")?>
<?=$form->text("Mã đối tác", "pro_partner_id", "pro_partner_id",$pro_partner_id, "Mã đối tác", 1, 50, "", 55, "", "", "")?>  
<?=$form->textarea("Giới thiệu ngắn","pro_shot_title", "pro_shot_title",$pro_shot_title, "Giới thiệu ngắn", 1, 300, "", 300, "", "", "")?>  

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
    <tr>
        <td class="form_name"><font class="form_asterisk"> * </font>Link ảnh sản phẩm</td>
        <td align="left">
      
            <img  src="<?=$fs_img_products. 'normal_' . $row["pro_picture"]?>" />
           
        <br />
        <input type="file" name="pro_picture" id="pro_picture" class="form" onchange="check_edit('record_<?=$row["pro_id"]?>')" size="30">            
        <br /><i class='form_add_text'>Ảnh Upload chỉ hỗ trợ các định dạng:<b style='color:#ff0000;'><?=$extension_list?></b></i>
        </td>
    </tr> 
    <tr><td colspan="2" align="center"><a href="../pic_pro/add.php?pro_id=<?=$record_id ?>">Up anh slide</a></td></tr>
         <tr> 
            <td class="form_name">Giá sản phẩm =></td>
            <td>
                <table>
                    <tr>
                        <td align="left"><font class="form_asterisk"> * </font>Tại Miễn Phí</td>
                        <td><input type="text" name="pro_price_deal" id="pro_price_deal" size="20" maxlength="20" class="form" value="<?=$pro_price_deal?>" /></td>
                        <td rowspan="2" valign="middle" align="center" class="textBold" style="font-size:18px">
                        </td>
                    </tr>
                    <tr>
                        <td align="left"><font class="form_asterisk"> * </font>Giá Ship</td>
                        <td><input type="text" name="pro_price_merchant" id="pro_price_merchant" size="20" maxlength="20" class="form" value="<?=$pro_price_merchant?>" /></td>
                    </tr>
                </table>
            </td>
        </tr>
		<?=$form->textarea("Meta-Tag","pro_meta_tag", "pro_meta_tag",$pro_meta_tag, "Meta-Tag", 0, 250, "", 255, "", "", "")?>  
		<?=$form->text("Site-Title","pro_site_title", "pro_site_title",$pro_site_title, "Site-Title", 0, 250, "", 255, "", "", "")?>  
		<?=$form->textarea("Meta-description","pro_meta_description", "pro_meta_description",$pro_meta_description, "Meta-descrption", 0, 250, "", 255, "", "", "")?>  
		<?=$form->textarea("Meta-keywords","pro_meta_keywords", "pro_meta_keywords",$pro_meta_keywords, "Meta-keywords", 0, 250, "", 255, "", "", "")?>  

        <?=$form->text("Địa chỉ trên Google", "pro_gmap", "pro_gmap",$pro_gmap, "Địa chỉ trên Google", 1, 350, "", 355, "", "","vd: 129, Xã Đàn Q. Đống Đa Hà Nội")?>   
        <tr><td colspan="2">
			<?=$form->wysiwyg("Điểm nổi bật","pro_special",$pro_special, "../../resource/wysiwyg_editor/", 800, 250)?>
        </td></tr>
        <tr><td colspan="2">
			<?=$form->wysiwyg("Điều kiện sử dụng","pro_dieukien",$pro_dieukien, "../../resource/wysiwyg_editor/", 800, 250)?>
        </td></tr>
        <tr><td colspan="2">
			<?//=$form->wysiwyg("Địa chỉ đổi voucher","pro_address",$pro_address, "../../resource/wysiwyg_editor/", 800, 250)?>
        </td></tr>
        

       <?php
       if($array_config['description']==1){
       ?>   
       		<tr>
            	<td colspan="2">Mô tả sản phẩm</td>
            </tr>
            <tr>                       
              <td colspan="2"><?=$form->wysiwyg("","pro_description",$pro_description, "../../resource/wysiwyg_editor/", 800, 350)?></td>
            </tr>
       <?
       }
       ?>
<?=$form->text("Ngày đăng","pro_prodate_start" . $form->ec . "pro_protime_start", "pro_prodate_start" . $form->ec . "pro_protime_start", $pro_prodate_start . $form->ec . $pro_protime_start, "Ngày (dd/mm/yyyy)" . $form->ec . "Giờ (hh:mm:ss)", 0, 80 . $form->ec . 80, $form->ec, 10 . $form->ec . 10, " - ", $form->ec, "&nbsp; <i>(Ví dụ: dd/mm/yyyy - hh:mm:ss)</i>");?>
<?=$form->text("Số ngày đăng bán","pro_date_show","pro_date_show",$pro_date_show,"Số ngày đăng bán",1,50,"",3,"","","&nbsp;<i class='form_add_text'>Số ngày đăng bán từ 5 đến 20 ngày!</i>")?>
<?=$form->button("submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "submit" . $form->ec . "reset", "Cập nhật" . $form->ec . "Làm lại", "Cập nhật" . $form->ec . "Làm lại", 'style="background:url(' . $fs_imagepath . 'button_1.gif) no-repeat"' . $form->ec . 'style="background:url(' . $fs_imagepath . 'button_2.gif)"', "");?>
  <?=$form->hidden("action", "action", "execute", "");?>
   <?
			$form->close_table();
			$form->close_form();
			unset($form);
		?>

<?=template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
<script type="text/javascript" language="javascript">
function show_discount(){
    try{
        var price_deal = document.getElementById('pro_price_deal').value;
        var price_merchant = document.getElementById('pro_price_merchant').value;
        if(price_deal == 0 || price_merchant == 0){
            document.getElementById('discount_rate').innerHTML = '...';
        }
        else            
            if(price_deal > price_merchant ){
                document.getElementById('discount_rate').innerHTML = 'Giá tại 123Deals phải nhỏ hơn giá tại merchant';
            }
            else{
                var dis_count = price_merchant - price_deal;
                if(dis_count < 0){
                    document.getElementById('discount_rate').innerHTML = 'Giá tại 123Deals phải nhỏ hơn giá tại merchant';
                }
                else{
                    var dis_rate = parseInt((dis_count * 100) / price_merchant);
                    document.getElementById('discount_rate').innerHTML = dis_rate + '%';
                }
            }
    }
    catch(err){
        document.getElementById('discount_rate').innerHTML = '...';
    }
}
</script>
</div>
</body>
</html>