<?
function checkLogin($username, $password){
	$username	= replaceMQ($username);
	$password	= replaceMQ($password);
	$adm_id		= 0;
	$db_check	= new db_query("SELECT adm_id 
										 FROM admin_user
										 WHERE adm_loginname = '" . $username . "' AND adm_password = '" . md5($password) . "' AND adm_active = 1 AND adm_delete = 0");
	if(mysql_num_rows($db_check->result) > 0){
		$check	= mysql_fetch_array($db_check->result);
		$adm_id	= $check["adm_id"];
		$db_check->close();
		unset($db_check);
		return $adm_id;
	}
	else{
		$db_check->close();
		unset($db_check);
		return 0;
	}
}
function checkloggedin(){
	$denypath="../deny.htm";
	if (!isset($_SESSION["logged"])){
		redirect($denypath);
		exit();
	}
	else{
		if ($_SESSION["logged"] != 1){
			redirect($denypath);
			exit();
		}
	}
}
function get_curent_language(){
	$db_current_language = new db_query("SELECT lang_id
										 FROM admin_user
										 WHERE adm_loginname='" . $_SESSION["userlogin"] . "' AND adm_password='" . $_SESSION["password"] . "' AND adm_active=1 AND adm_delete = 0");
	if ($row=mysql_fetch_array($db_current_language->result)){
		$db_current_language->close();
		unset($db_current_language);
		return $row["lang_id"];
	}
	else{
		return "";
	}
}
function get_curent_path(){
	$db_current_path = new db_query("SELECT lang_path
										 FROM languages
										 WHERE lang_id=" . intval(get_curent_language()) . "");
	if ($row=mysql_fetch_array($db_current_path->result)){
		$db_current_path->close();
		unset($db_current_path);
		return $row["lang_path"];
	}
	else{
		return "";
	}
}
function checkaccess($module_id){
	$db_getright = new db_query("SELECT * 
								 FROM admin_user
								 WHERE adm_loginname='" . $_SESSION["userlogin"] . "' AND adm_password='" . $_SESSION["password"] . "' AND adm_active=1 AND adm_delete = 0");
	//Check xem user co ton tai hay khong
	if (mysql_num_rows($db_getright->result) > 0){
		$row = mysql_fetch_array($db_getright->result);
		//Neu column adm_isadmin = 1 thi cho access
		if ($row['adm_isadmin'] == 1) {
			$db_getright->close();
			unset($db_getright);
			return 1;
		}
	}
	//Ko co thi` fail luon
	else{
		$db_getright->close();
		unset($db_getright);
		return 0;
	}
	$db_getright->close();
	unset($db_getright);
	
	//check user
	$db_getright = new db_query("SELECT * 
								 FROM admin_user, admin_user_right, modules
								 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND
								 adm_loginname='" . $_SESSION["userlogin"] . "' AND adm_password='" . $_SESSION["password"] . "' AND adm_active=1 AND adm_delete = 0
								 AND mod_id = " . $module_id);
	
	if ($row=mysql_fetch_array($db_getright->result)){	
		$db_getright->close();
		unset($db_getright);
		return 1;
	}
	else{
		$db_getright->close();
		unset($db_getright);
		return 0;
	}
}
function checkAddEdit($right="add"){
	global $module_id;
	$db_getright = new db_query("SELECT * 
								 FROM admin_user, admin_user_right, modules
								 WHERE adm_id = adu_admin_id AND mod_id = adu_admin_module_id AND adm_isadmin = 0 AND
								 adm_loginname='" . $_SESSION["userlogin"] . "' AND adm_password='" . $_SESSION["password"] . "' AND adm_active=1 AND adm_delete = 0
								 AND mod_id = " . $module_id);
	
	if ($row=mysql_fetch_array($db_getright->result)){	
		$denypath="../error.php";
		switch($right){
			case "add":
				if($row["adu_add"] == 0){
					header("location: " . $denypath);
					exit();
				}
			break;
			case "edit":
				if($row["adu_edit"] == 0){
					header("location: " . $denypath);
					exit();
				}
			break;
			case "delete":
				if($row["adu_delete"] == 0){
					header("location: " . $denypath);
					exit();
				}
			break;
		}
		$db_getright->close();
		unset($db_getright);
	}
	return 1;
}
function checkRowUser($table,$field_id,$record_id,$returnurl){
	$strreturn ='';
	$db_useradmin = new db_query("SELECT adm_id,adm_isadmin,adm_edit_all FROM admin_user WHERE adm_id=" . $_SESSION["user_id"]);
	if($adm = mysql_fetch_array($db_useradmin->result)){
		if($adm["adm_isadmin"]==1){
			$strreturn ='';
		}else{
			$db_record = new db_query("SELECT admin_id FROM " . $table . " WHERE " . $field_id . " = " . $record_id);
			$row=mysql_fetch_array($db_record->result);
			if($row["admin_id"] == $_SESSION["user_id"] || $row["admin_id"] == 0 || $adm["adm_edit_all"]==1){
				$strreturn = '';
				unset($db_record);
			}else{
				$db_user = new db_query("SELECT adm_loginname FROM admin_user WHERE adm_id= " . intval($row["admin_id"]));
				if($use=mysql_fetch_array($db_user->result)){
					$strreturn = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script language="javascript">alert("Bản ghi này thuộc quyền sửa xóa của user: ' . $use["adm_loginname"] . '")</script>';
				}else{
					$strreturn = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script language="javascript">alert("Bản ghi không thuộc quyền sửa xóa của bạn !")</script>';
				}
				unset($db_user);
			}
		}
	}else{
		$denypath="../deny.htm";
		redirect($denypath);
	}
	if($strreturn!=''){
		echo $strreturn;
		redirect($returnurl);
		exit();
	}else{
		echo $strreturn;
	}
}
function checkCategory($user_id){
	$strreturn ='';
	$db_useradmin = new db_query("SELECT adm_isadmin,adm_all_category FROM admin_user WHERE adm_id=" . $user_id);
	if($use=mysql_fetch_array($db_useradmin->result)){
		if($use["adm_isadmin"]==1) return '';
		if($use["adm_all_category"]==1) return '';
		$listiCat = '0';
		$db_category = new db_query("SELECT auc_category_id
											  FROM admin_user_category,admin_user
											  WHERE auc_admin_id=adm_id AND auc_admin_id=" .  $user_id);
		while($row=mysql_fetch_array($db_category->result)) $listiCat .= ',' . $row["auc_category_id"];
		unset($db_category);
		$db_category = new db_query("SELECT cat_id
											  FROM categories_multi
											  WHERE admin_id=" .  $user_id);
		while($row=mysql_fetch_array($db_category->result)) $listiCat .= ',' . $row["cat_id"];
		unset($db_category);
		
		$strreturn = ' AND cat_id IN(' . $listiCat . ')';
	}
	return $strreturn;
}
?>