<?
//Created by: Mr Toan
require_once("config_security.php");
//check quyền them sua xoa
checkAddEdit("add");


//Khai bao Bien
$iCat				= getValue("iCat");

$fs_redirect	= "listing.php?type=list&iCat=" . $iCat;
//Call Class generate_form();
$myform = new generate_form();
//Loại bỏ chuc nang thay the Tag Html
$myform->removeHTML(0);
//Checkdate
$pro_date	= getValue("pro_date","str","POST","",date("d/m/Y"));
$pro_date 	= convertDateTime($pro_date,"0:0:0");

// du lieu cho truong tim kien
$textsearch	= '';
$cat_form   = '';
$db_catname=new db_query("SELECT cat_name,cat_form FROM categories_multi WHERE cat_id=" . $iCat);
if($rowcat=mysql_fetch_array($db_catname->result)){
	$textsearch		= $rowcat["cat_name"];
	$cat_form		= $rowcat["cat_form"];
}
$db_catname->close();
unset($db_catname);
$arrcat_form = explode("|",$cat_form);
$pro_description = '';
$description	  = '';
$i=0;
foreach($arrcat_form as $key=>$value){
	$i++;
	$pro_description .= str_replace("|"," ",getValue("pro_des_" . $i,"str","POST","")) . '|';
	$description		.= $value . ' ' . str_replace("|"," ",getValue("pro_des_" . $i,"str","POST","")) . ' ';
}

//Insert to database
$myform->add("pro_category","pro_category",1,0,"",1,"Bạn chưa nhập chọn nhóm chuyên mục",0,"Bạn chưa nhập chọn nhóm chuyên mục");
$myform->add("pro_name","pro_name",0,0,"",1,"Bạn chưa nhập tiêu đề bài viết",0,"Bạn chưa nhập tiêu đề bài viết");
$myform->add("pro_date","pro_date",0,1,0,1,"Bạn chưa nhập ngày đăng tin",0,"Bạn chưa nhập ngày đăng tin");
$myform->add("pro_hot","pro_hot",1,0,0,0,"",0,"");
$myform->add("pro_new","pro_new",1,0,0,0,"",0,"");
$myform->add("pro_promotion","pro_promotion",1,0,0,0,"",0,"");
$myform->add("pro_khuyenmai","pro_khuyenmai",0,0,"",0,"",0,"");
$myform->add("pro_description","pro_description",0,1,"",0,"",0,"");
//$myform->add("pro_description2","pro_description2",0,0,"",0,"",0,"");
$myform->add("pro_teaser","pro_teaser",0,0,"",0,"",0,"");
$myform->add("pro_price","pro_price",3,0,0,0,"",0,"");
$myform->add("pro_weight","pro_weight",1,0,0,0,"",0,"");
$myform->add("pro_warranty","pro_warranty",0,0,"",0,"",0,"");
$myform->add("admin_id","admin_id",1,1,0,0,"",0,"");
$myform->add("pro_active","approve",1,1,1,0,"",0,"");
$myform->add("pro_stock","pro_stock",1,0,1,0,"",0,"");
$myform->add("pro_sp_khuyenmai","pro_sp_khuyenmai",1,0,0,0,"",0,"");
//$myform->add("pro_supplier","pro_supplier",1,0,0,1,"Chọn hãng sản xuất",0,"");
//echo $textsearch;
//array này gồm key là nội dung ; value 1 là lấy từ biến, 0 là lấy từ post
$myform->add_Field_Seach("pro_search",array("pro_name"=>0,"pro_teaser"=>0,"description"=>1,"textsearch"=>1));
//Add table
$myform->addTable($fs_table);
echo $myform->strErrorFeld;
$myform->generate_insert_SQL();
//Warning Error!
$errorMsg = "";
//Get Action.
$action	= getValue("action", "str", "POST", "");
if($action == "insert"){
	//exit();
	$upload_pic = new upload("picture", $fs_filepath, $extension_list, $limit_size);
	if ($upload_pic->file_name != ""){
		$picture = $upload_pic->file_name;
		//resize anh
		resize_image($fs_filepath,$upload_pic->file_name,$medium_width,$medium_heght,$medium_quantity,"medium_");
		resize_image($fs_filepath,$upload_pic->file_name,$small_width,$small_heght,$small_quantity,"small_");
		$myform->add("pro_picture","picture",0,1,"",0,"",0,"");
		//chmod images
		@chmod($fs_filepath . $picture,0644);
		@chmod($fs_filepath . 'small_' . $picture,0644);
		@chmod($fs_filepath . 'medium_' . $picture,0644);
	}
	
	//Check Error!
	$errorMsg .= $upload_pic->show_warning_error();
	$errorMsg .= $myform->checkdata();
	if($errorMsg == ""){
		$db_ex	 		= new db_execute_return();
		$last_id 		= $db_ex->db_execute($myform->generate_insert_SQL());
		$update_pic_id = getValue("update_pic_id","str","POST");
		$db_picture		= new db_execute("UPDATE pictures_product SET pipr_product = " . $last_id . ",pipr_temp='' WHERE pipr_temp='" . $update_pic_id . "'");
		unset($db_picture);
		//echo $myform->generate_insert_SQL();

		//Add related products
		$relate_id = getValue("arelate_select","arr","POST","");
		if($relate_id != ""){
			for($i=0;$i<count($relate_id);$i++){
				$query_str = "INSERT INTO products_relate VALUES(" . $last_id . "," . intval($relate_id[$i]) . ")";
				//echo $query_str . "<br>";
				$db_relate_execute = new db_execute($query_str);
				unset($db_relate_execute);
			}
		}
		// Redirect to add new
		$fs_redirect = "add.php?save=1&iCat=" . $iCat;
		//Redirect to:
		redirect($fs_redirect);
		exit();
	}
}
//add form for javacheck
$myform->addFormname("add_new");
$myform->evaluate();
//add more javacode
$myform->addjavasrciptcode("");
$myform->checkjavascript();
?>
<html>
<head>
<title>Add New</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/FSPortal.css" rel="stylesheet" type="text/css"> 
<?
$save = getValue("save","int","GET",0);
//when data has been save to database
if ($save==1){
?>
	<script language="javascript">
		if (!confirm("Data has been added to the database ! Do you to add more products?")){
			window.location.href='listing.php';
		}
	</script>
<? } ?>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<? /*------------------------------------------------------------------------------------------------*/ ?>
<? template_top(translate_text("them_moi_san_pham"))?>
<? /*---------Body------------*/ ?>
		<form ACTION="<?=getURL()?>" METHOD="POST" name="add_new" enctype="multipart/form-data">
		<table border="0" cellpadding="3" cellspacing="2" width="70%" align="center" >
			<tr>
				<td colspan="2" align="center">
					<?=$errorMsg?>
				</td>
			</tr>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("category")?>:</td>
				<td>
					<select name="pro_category" id="pro_category" class="form" onChange="window.location.href='<?=$_SERVER['SCRIPT_NAME']?>?iCat='+this.value">
						<option value="">--[<?=translate_text("select_category")?>]--</option>
						<?
						for($i=0;$i<count($listAll);$i++){
							if($listAll[$i]["cat_id"] == $iCat){
						?>
							<option value="<?=$listAll[$i]["cat_id"]?>" selected="selected">
							<?
							for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
								echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
							?>
							</option>
						<? }else{ ?>
							<option value="<?=$listAll[$i]["cat_id"]?>">
							<?
							for($j=0;$j<$listAll[$i]["level"];$j++) echo "---";
								echo "<font color='red'>+ </font>" . $listAll[$i]["cat_name"];
							?>
							</option>
						<?
							}
						}
						?>
					</select>
				</td>
			</tr>
			<? /*?>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right"><?=translate_text("hang_san_xuat")?>:</td>
				<td>
					<select name="pro_supplier" id="pro_supplier" class="form">
						<option value="">--[<?=translate_text("chon_hang_san_xuat")?>]--</option>
						<?
						foreach($arraySupplier as $key=>$value){
						?>
							<option value="<?=$key?>"><?=$value?></option>
						<?
						}
						?>
					</select>
				</td>
			</tr>
			<? */?>
			<?
			if($iCat != 0){
			?>
			<?
			form("pro_name",1,$pro_name,translate_text("title"),60);
			form("pro_stock",1,$pro_stock,"Kho hàng",10);
			//form("pro_weight",1,$pro_weight,translate_text("trong_luong"),10);			
			form("pro_khuyenmai",1,$pro_khuyenmai,translate_text("khuyen_mai"),60);
			form("pro_price",1,$pro_price,translate_text("price"),10);
			form("pro_date",1,date("d/m/Y"),translate_text("date"),10);
			?>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("check")?>:</td>
				<td class="textBold">
					<input type="checkbox" name="pro_hot" id="pro_hot" value="1">&nbsp;<img src="<?=$fs_imagepath?>hot.gif" border="0" width="22" height="10">&nbsp;
					<input type="checkbox" name="pro_new" id="pro_new" value="1">&nbsp;<img src="<?=$fs_imagepath?>new.gif" border="0" width="33" height="16">
					<input type="checkbox" name="pro_sp_khuyenmai" id="pro_sp_khuyenmai" value="1">&nbsp;Danh sách khuyến mại
				</td>
			</tr>
			<?
			$pro_temp=random();
			?>
			<tr>
				<td class="textBold" nowrap="nowrap" align="right" width="10%"><?=translate_text("images")?>:</td>
				<td nowrap="nowrap"><input type="file" name="picture" id="picture" class="form" size="20">&nbsp;<input type="hidden" name="update_pic_id" value="<?=$pro_temp?>"><input type="button" class="form" value="ADD MORE PICTURES" style="color:#FF0000; background:#EBE9E9;" onClick="javascript:window.open('picturesproduct.php?temp=<?=$pro_temp?>','','resizable=0,WIDTH=452,HEIGHT=350,scrollbars=1')"> &nbsp;<i>(Limit size: <font color="#FF0000"><?=number_format($limit_size,0,'','.'); ?></font>&nbsp;bytes)</i></td>
			</tr>
			<?
			form("pro_teaser",2,$pro_teaser,translate_text("teaser"),70,7);
			//form("pro_description",7,$pro_description,translate_text("description"),650,450);
			?>
			<tr>
				<td colspan="2">
					<table cellpadding="3" cellspacing="2">
						<?
						$i=0;
						foreach($arrcat_form as $key=>$value){
							$i++;
							if(trim($value)!=''){
							?>
								<tr>
									<td class="textBold" align="right" nowrap="nowrap"><?=$value?></td>
									<td nowrap="nowrap"><span id="span_<?=$i?>"><input type="text" name="pro_des_<?=$i?>" id="pro_des_<?=$i?>" class="form" style="width:400px;"></span><img src="../images/1.png" style="cursor:pointer" onClick="changeTypeForm(<?=$i?>)" id="image_<?=$i?>" align="absmiddle" border="0"></td>
								</tr>
							<?
							}
						}
						?>
					</table>
				</td>
			</tr>
			<? form("pro_description",7,$pro_description,translate_text("description"),650,450);?>
			<tr>
				<td colspan="2" align="center">
					<input type="button" class="form" value="<?=translate_text("save_change")?>" style="cursor:hand; width:100px" onClick="validateForm();">&nbsp;
					<input type="reset" class="form" value="<?=translate_text("clear_all")?>" style="cursor:hand; width:100px">
					<input type="hidden" name="approve" value="1">
					<input type="hidden" name="action" value="insert">
				</td>
			</tr>
			<?
			}//end iCat !=0
			?>
		</table>
		</form>
		<? /*---------Body------------*/ ?>
<? template_bottom() ?>
<? /*------------------------------------------------------------------------------------------------*/ ?>
</body>
</html>
<script language="javascript" src="../js/relate.js"></script>
<script language="javascript" src="../js/library.js"></script>
