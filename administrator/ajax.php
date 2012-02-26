<?php
include "../config/config.php";
include "../includes/define.table.php";

// INCLUDE DATABASE INFORMATION
include "../includes/database_config.php";

include "../includes/class_datetime.php";
include "../includes/class_database.php";
include "../includes/class_menu.php";
include "../includes/class_category.php";
include "../includes/class_product.php";
include "../includes/filter/filterinput.php";
include "../includes/environment/uri.php";
include "../includes/environment/request.php";
include "../includes/functions_general.php";


// INITIATE DATABASE CONNECTION
$database =& PGDatabase::getInstance();

// SET LANGUAGE CHARSET
$database->db_set_charset('utf8');

// CREATE URL CLASS
$PGRequest = new PGRequest();

// CREATE DATETIME CLASS
$datetime = new PGDatetime();

$task = PGRequest::getCmd('task', '');

//add feauture for product
if ($task == 'feauture_product'){
	$product_id		= PGRequest::getInt('product_id', 'GET', 0);
	$sql = "SELECT name FROM ".TBL_PRODUCT_FEAUTURE." WHERE product_id=".$product_id." ORDER BY product_option_value_id ASC";
	$result = $database->db_query($sql);
	echo '<select name="feauture[]" multiple="multiple" style="width:250px; height:200px;">';
	while ($row = $database->db_fetch_assoc($result)){
		echo '<option value="'.$row["name"].'">'.$row["name"].'</option>';
	}
	echo '</select>';
}

//add color for product
elseif ($task == 'addcolor'){
	$number		= PGRequest::getInt('number', 'GET', 0);
	for ($i=1; $i<=$number; $i++){
		echo '<p style="margin:10px 0;">
			<label>Chọn màu: </label><input type="text" maxlength="6" name="colors_'.$i.'" size="6" class="colorpickerField adm_inputbox medium" value="00ff00" />
			<label>Giá: </label><input type="text" name="price_color_'.$i.'" class="adm_inputbox medium" onkeypress="return shp.numberOnly(this, event);" value="" />
		</p>';
	}
	?>
	<script type="text/javascript">
	$(function(){
		//pick color
		$('.colorpickerField').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
	});
	</script>
	<?php 
}

//process link
elseif ($task=='process_link'){
	$value		= PGRequest::GetCmd('value', '');
	if ($value == "category"){
		$sql = "SELECT category_id, name, parent_id FROM ".TBL_CATEGORY." WHERE status=1 ORDER BY category_id DESC";
		$result = $database->db_query($sql);
		echo '<select name="link" class="adm_selectbox select">';
		echo '<option value="">Lựa chọn nhóm sản phẩm</option>';
		while ($row = $database->db_fetch_assoc($result)){
			if ($row["parent_id"] == 0){
				echo '<option value="'.$row["category_id"].'">'.$row["name"].'</option>';
			}else{
				echo '<option value="'.$row["category_id"].'">--'.$row["name"].'</option>';
			}
		}
		echo '</select>';
	}
	else if ($value == "product"){
		$sql = "SELECT p.product_id, pd.name FROM ".TBL_PRODUCT." AS p, ".TBL_PRODUCT_DESCRIPTION." AS pd WHERE p.product_id=pd.product_id AND p.status=1 ORDER BY p.product_id DESC";
		$result = $database->db_query($sql);
		echo '<select name="link" class="adm_selectbox select">';
		echo '<option value="">Lựa chọn sản phẩm</option>';
		while ($row = $database->db_fetch_assoc($result)){
			echo '<option value="'.$row["product_id"].'">'.$row["name"].'</option>';
		}
		echo '</select>';
	}
	else if ($value == "feauture"){
		echo 'Cập nhật tính năng sau...';
	}
	else if ($value == "category.news"){
		echo 'Cập nhật tính năng sau...';
	}
	else if ($value == "news"){
		echo 'Cập nhật tính năng sau...';
	}
}