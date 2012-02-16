<?php
/*
 * Version: 1.0
 * Code By: Kiều Văn Ngọc
 * Email: ngockv@gmail.com
 * Mobile: 097.8686.055
 * Website:
 * Name Table Defined: TBL_ADMIN
 */
class PGAdmin
{
	var $is_message;
	
	var $admin_id;
	var $admin_name;
	var $admin_email;
	var $admin_username;
	var $admin_password;
	var $admin_password_method;
	var $admin_code;
	var $admin_group;
	var $admin_access;
	var $admin_created;
	var $admin_modify;
	var $admin_registerDate;
	var $admin_lastvisitDate;
	var $admin_enabled;
	
	function __construct(){
		$this->admin_id = 0;
		$this->admin_name = "";
		$this->admin_email = "";
		$this->admin_username = "";
		$this->admin_password = "";
		$this->admin_password_method = "";
		$this->admin_code = "";
		$this->admin_group = 1;
		$this->admin_access = "";
		$this->admin_created = 0;
		$this->admin_modify = 0;
		$this->admin_registerDate = "";
		$this->admin_lastvisitDate = "";
		$this->admin_enabled = 1;
	}
	
	/*
	 * Load list fields
	 * $where : Điều Kiện câu truy vấn
	 * $start, $limit: LIMIT cho câu truy vấn
	 */
	public function loadList($where = null, $start=null, $limit=null){
		global $database;

		if (is_numeric($start) && is_numeric($limit)){
			$wLimit = " LIMIT ".$start.", ".$limit;
		}
		
		$sql = "SELECT * FROM ".TBL_ADMIN.$where." ORDER BY admin_id DESC".$wLimit;
		$result = $database->db_query($sql);
		while ($row = $database->db_fetch_assoc($result)){
			$res = $database->db_query("SELECT admin_name FROM ".TBL_ADMIN." WHERE admin_id=".$row["admin_created"]);
			$this_user = $database->getRow($res);
			$row['name_created'] = $this_user["admin_name"];
			if ($row['admin_access']) {
				$aryAccess = unserialize($row['admin_access']);
				$pageAccess = array();
				foreach ($aryAccess as $key=>$access) {
					if (count($access)) {
						foreach ($access as $kp=>$perm) {
							$pageAccess[$key][$kp] = $arrPermiss[$perm];
						}
						$pageAccess[$key] = join(", ", $pageAccess[$key]);
					}
				}
				$row['admin_access'] = $pageAccess;
			}
			$admin[] = $row;
		}
		
		return $admin;
	}
	
	/*
	 * Load field
	 * $admin_id : ID of field
	 */
	public function load($admin_id = null){
		global $database;
		if (!is_null($admin_id) && is_numeric($admin_id) && ($admin_id>0)){
			$result = $database->db_query("SELECT * FROM ".TBL_ADMIN." WHERE admin_id=$admin_id LIMIT 1");
			if ($oAdmin = $database->db_fetch_object($result)){
				$this->admin_id				= $oAdmin->admin_id;
				$this->admin_name			= $oAdmin->admin_name;
				$this->admin_username		= $oAdmin->admin_username;
				$this->admin_password		= $oAdmin->admin_password;
				$this->admin_email			= $oAdmin->admin_email;
				$this->admin_group			= $oAdmin->admin_group;
				$this->admin_access			= $oAdmin->admin_access;
				$this->admin_code			= $oAdmin->admin_code;
				$this->admin_created		= $oAdmin->admin_created;
				$this->admin_modify			= $oAdmin->admin_modify;
				$this->admin_registerDate	= $oAdmin->admin_registerDate;
				$this->admin_lastvisitDate	= $oAdmin->admin_lastvisitDate;
				$this->admin_enabled		= $oAdmin->admin_enabled;
			}
		}
		return $this;
	}
	
	public function save($oAdmin = null){
		global $database, $setting, $datetime, $admin_id;
    
		if (!is_object($oAdmin)) $oAdmin = $this;

		if (!isset($oAdmin->admin_id) || is_null($oAdmin->admin_id) || ($oAdmin->admin_id==0)){
			$admin_password_encrypted = md5($oAdmin->admin_password);
      		$sql = "INSERT INTO ".TBL_ADMIN." (
      			admin_name,
		        admin_email,
		        admin_username,
		        admin_password,
		        admin_password_method,
        		admin_code,
		        admin_group,
		        admin_access,
		        admin_created,
		        admin_registerDate
		    ) VALUES (
		    	'{$oAdmin->admin_name}',
		    	'{$oAdmin->admin_email}',
		        '{$oAdmin->admin_username}',
		        '{$admin_password_encrypted}',
		        '{$setting['setting_password_method']}',
        		'{$this->admin_salt}',
		        '{$oAdmin->admin_group}',
		        '{$oAdmin->admin_access}',
		        '{$admin_id}',
		        '$oAdmin->admin_registerDate'
		    )";
	      	$result = $database->db_query($sql);	
		}else{
			$admin_password_encrypted = $oAdmin->admin_password;
			$sql = "UPDATE ".TBL_ADMIN." SET 
					admin_password='{$admin_password_encrypted}', 
					admin_name='{$oAdmin->admin_name}', 
					admin_email='{$oAdmin->admin_email}',
					admin_group='{$oAdmin->admin_group}',
					admin_access='{$oAdmin->admin_access}',
					admin_modify={$admin_id}
					WHERE admin_id='{$oAdmin->admin_id}' LIMIT 1";
			echo $sql; die;
			$result = $database->db_query($sql);
		}
		return $result;
	}
	
	/*
	 * Remove Admin
	 */
	public function remove($cid = null){
		global $database;
		if (!is_array($cid)){
			$this->error = 'Tham số truyền vào không tồn tại !';
		}else{
			$total = count( $cid );
			if ( $total < 1) {
				echo "<script> alert('Lựa chọn một mục để xóa !'); window.history.go(-1);</script>\n";
				exit;
			}
			mosArrayToInts( $cid );
			$cids = 'admin_id=' . implode( ' OR admin_id=', $cid );
			$sql = "DELETE FROM ".TBL_ADMIN." WHERE ( $cids )";
			$database->db_query($sql);
			
			$this->is_message = 'Đã xóa '.$total.' quản trị thành công !';
		}
		
		return $this->is_message;
	}
	
	/*
	 * Publish and unpublish Admin
	 */
	public function published($cid, $published = 0){
		global $database;
		if (count( $cid ) < 1) {
			$action = $published == 1 ? 'Mở khóa' : 'Khóa';
			echo "<script> alert('Chọn một quản trị viên để $action'); window.history.go(-1);</script>\n";
			exit;
		}
	
		mosArrayToInts( $cid );
		$total = count ( $cid );
		$cids = 'admin_id=' . implode( ' OR admin_id=', $cid );
		
		$database->db_query("UPDATE ".TBL_ADMIN." SET admin_enabled=".(int) $published." WHERE ( $cids )");
	
		switch ( $published ) {
			case 1:
				$this->is_message = $total .' quản trị viên đã mở khóa thành công !';
				break;
	
			case 0:
			default:
				$this->is_message = $total .' quản trị viên đã khóa thành công !';
				break;
		}
		
		return $this->is_message;
	}

	
	/**
	 * Cap nhat quyen quan ly site cho Admin
	 * @param int $adminId
	 * @param array $arySiteId
	 * @param int $group
	 * @return array
	 */
	function insertAdminSite ($adminId, $arySiteId, $group=null) {
		
	  	global $database;
    
	  	if (!$database->db_query("DELETE FROM admins_sites WHERE admin_id='{$adminId}'")) return;
	  	
	  	$aryValue = array();
	  	if (count($arySiteId) && $group != 1) {
		  	foreach ($arySiteId as $key=>$siteId) {
		  		$aryValue[] = "('{$adminId}', '{$siteId}')";
		  	}
	  		$result = $database->db_query("INSERT INTO admins_sites (admin_id, site_id) VALUES " . join(",", $aryValue));
	  	}
	  	return $result;
	}

	/**
	 * Ma hoa mat khau Admin
	 * @param string $admin_password
	 * @return string
	 */
	function admin_password_crypt($admin_password)
  	{
    	global $setting;
    
	    if( !$this->admin_exists )
	    {
	      	$method = 1;
	      	$this->admin_salt = randomcode(16);
	    }
	    
	    else
	    {
	      	$method = $this->admin_info['admin_password_method'];
	    }
	    
	    // For new methods
	    if( $method>0 )
	    {
	      	if( !empty($this->admin_salt) )
	      	{
		        list($salt1, $salt2) = str_split($this->admin_salt, ceil(strlen($this->admin_salt) / 2));
		        $salty_password = $salt1.$admin_password.$salt2;
	      	}
	      	else
	      	{
	        	$salty_password = $admin_password;
	      	}
	    }
	    
	    switch( $method )
	    {
	      	// crypt()
	      	default:
	      	case 0:
	        	if( empty($this->admin_salt) ) $this->admin_salt = 'admin123';
	        	$admin_password_crypt = crypt($admin_password, '$1$'.str_pad(substr($this->admin_salt, 0, 8), 8, '0', STR_PAD_LEFT).'$');
	      	break;
	      
	      	// md5()
	      	case 1:
	        	$admin_password_crypt = md5($salty_password);
	      	break;
	      
	      	// sha1()
	      	case 2:
	        	$admin_password_crypt = sha1($salty_password);
	      	break;
	      
	      	// crc32()
	      	case 3:
	        	$admin_password_crypt = sprintf("%u", crc32($salty_password));
	      	break;
	    }
	    
	    return $admin_password_crypt;
  	}

  
	/**
	 * LOOPS AND/OR VALIDATES USER ACCOUNT INPUT
	 * @param array $aryInput
	 */
	function check_account_input($aryInput) {  
		global $database;
		      
    	//CHECK ADMIN NAME
		if (strlen($aryInput['admin_name']) < 6) {
			$this->is_message = 'Họ tên phải ít nhất 6 ký tự';
		}
		
		//CHECK EMAIL
		if ($aryInput['admin_email'] == '') {
			$this->is_message = 'Hãy nhập Email';
		}
		else if ($aryInput['admin_email'] !='') {
			if (!Validation::isEmail($aryInput['admin_email'])) {
				$this->is_message = 'Email không đúng định dạng';
			}
		}
		//CHECK USER EXISTED
		/*
		$email = strtolower($aryInput['admin_email']);
	  	if (strtolower($this->admin_info['admin_email']) != $email && $database->db_num_rows($database->db_query("SELECT admin_id FROM ".TBL_ADMIN." WHERE LOWER(admin_email)='{$email}'")) ) {
			$this->is_message = 'Email này đã có trong hệ thống. Hãy chọn 1 email khác.';
		}
		*/
		
		// CHECK PASSWORDS
	    if (trim($aryInput['admin_password_new']) || trim($aryInput['admin_password_conf'])) {
      		// CHECK FOR OLD PASSWORD MATCH
      		if ($this->admin_info['admin_password']) {
        		if (!trim($aryInput['admin_password_old'])) {
		          	$this->is_message = 'Hãy vào mật khẩu cũ.';
		        }
		        else if ($this->admin_password_crypt($aryInput['admin_password_old']) != $this->admin_info['admin_password']) {
		          	$this->is_message = 'Mật khẩu cũ không đúng.';
		        }
      		}
      
		    // CHECK FOR PASSWORD LENGTH
		    if (strlen($aryInput['admin_password_new']) < 6) {
		        $this->is_message = 'Mật khẩu phải tối thiểu 6 ký tự.';
		    }
		    // CHECK FOR PASSWORD MATCH
		    else if ($aryInput['admin_password_new'] != $aryInput['admin_password_conf']) {
		        $this->is_message = 'Mật khẩu xác nhận không đúng.';
		    }
    	}
		
    	return;
    }
    
    /**
     * Kiem tra cac thong tin Admin
     * @param array $aryInput
     * @param bool $isUpdate
     * @return boolean
     */
    function check_user_input($aryInput, $isUpdate=false) {  
		global $database;
		      
    	//CHECK ADMIN NAME
		if (strlen($aryInput['admin_name']) < 6) {
			$this->is_message = 'Họ tên phải ít nhất 6 ký tự';
		}
		
		//CHECK EMAIL
		if ($aryInput['admin_email'] == '') {
			$this->is_message = 'Hãy nhập Email';
		}
		else if ($aryInput['admin_email'] !='') {
			if (!Validation::isEmail($aryInput['admin_email'])) {
				$this->is_message = 'Email không đúng định dạng';
			}
			else {
				$email = strtolower($aryInput['admin_email']);
				$sql = "SELECT admin_id FROM ".TBL_ADMIN." WHERE LOWER(admin_email)='{$email}'";
				if ($isUpdate) {
					$sql .= " AND admin_id <>".$aryInput['admin_id'];
				}
			  	if ($database->db_num_rows($database->db_query($sql))) {
					$this->is_message = 'Email này đã có trong hệ thống. Hãy chọn 1 email khác.';
				}
			}
		}
		
		//CHECK USERNAME
		if (!$isUpdate) {
		    if (preg_match("/[^a-zA-Z0-9]/", $aryInput['admin_username'])) {
		        $this->is_message = 'Tên đăng nhập phải là dạng chữ và số';
		    }
		    else if (strlen($aryInput['admin_username']) < 6) {
		        $this->is_message = 'Tên đăng nhập phải tối thiểu 6 ký tự.';
		    }
		    else if ($database->db_num_rows($database->db_query("SELECT admin_id FROM ".TBL_ADMIN." WHERE LOWER(admin_username)='".strtolower($aryInput['admin_username'])."'")) ) {
				$this->is_message = 'Tên đăng nhập đã có trong hệ thống. Hãy chọn 1 tên khác.';
		    }
		}
		
		//CHECK PASSWORDS
	    if (($isUpdate && trim($aryInput['admin_password'])!= '' && strlen($aryInput['admin_password']) < 6) || (!$isUpdate && strlen($aryInput['admin_password']) < 6)) {
	        $this->is_message = 'Mật khẩu phải tối thiểu 6 ký tự.';
	    }
	    
	    //CHECK USER GROUP
	  	if ($aryInput['admin_group'] == '') {
			$this->is_message = 'Hãy chọn 1 nhóm thành viên.';
		}
		
    	return true;
    }
 	// END admin_account() METHOD

	
	/**
	 * Clean admin
	 * @return boolean
	 */
	function admin_clear()
  	{
	  	$this->is_message = FALSE;
	  	$this->admin_exists = FALSE;
	  	$this->admin_super = FALSE;
	  	$this->admin_salt = NULL;
	  	$this->admin_info = array();
	  	return true;
	}

	
	/**
	 * Xoa cache cua Admin
	 * @param int[optional] $admin_id
	 * @param string[optional] $admin_username
	 * @return boolean
	 */
	function admin_clear_cache($admin_id = 0, $admin_username = ""){
		CacheLib::delete('adminInfo_'.$admin_id.'_'.$admin_username);
		CacheLib::delete('adminInfo_'.$admin_id.'_');
		CacheLib::delete('adminInfo__'.$admin_username);
		CacheLib::delete('get_list_sites');
		return true;
	}
  
	/**
	 * Thoat Admin
	 * @return boolean
	 */
	function admin_logout()
	{
	  	$this->admin_clear();
    	$this->admin_setCookies();
    	return true;
	}

	/**
	 * Xoa Admin
	 * @return boolean
	 */
	function admin_delete()
  	{
	  	global $database;
	  	$database->db_query("DELETE FROM ".TBL_ADMIN." WHERE admin_id='{$this->admin_info['admin_id']}' LIMIT 1");
	  	$database->db_query("DELETE FROM admins_sites WHERE admin_id='{$this->admin_info['admin_id']}'");
	  	$this->admin_clear();
	  	return true;
	}
  	
  	/**
  	 * Lay danh sach site ma Admin quan ly
  	 * @return array
  	 */
  	function get_list_sites(){
		global $database;
		
		// Cache get_list_sites
		$cacheTime = 604800; // 7d
		$cacheKey = 'get_list_sites';
		$sites = CacheLib::get($cacheKey, $cacheTime);
		if (!empty($sites)) return $sites;
		
		$sql = "SELECT S.site_id, S.site_name, SA.admin_id FROM sites S 
				INNER JOIN admins_sites SA ON(S.site_id=SA.site_id) 
				WHERE S.site_publish=1";// AND AS.admin_id=".$adminId;

		$sites = $database->getArray($database->db_query($sql));
		
		CacheLib::set($cacheKey, $sites, $cacheTime);
		
		return $sites;
	}
}

?>