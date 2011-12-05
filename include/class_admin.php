<?php
defined('PG_PAGE') or die();

class PGAdmin
{
	// INITIALIZE VARIABLES
	var $is_error;			// DETERMINES WHETHER THERE IS AN ERROR OR NOT, CONTAINS RELEVANT ERROR CODE
	var $admin_exists;		// DETERMINES WHETHER WE ARE EDITING AN EXISTING ADMIN OR NOT
	var $admin_salt;		// CONTAINS THE SALT USED TO ENCRYPT THE ADMIN PASSWORD

	var $admin_info;		// CONTAINS ADMIN'S INFORMATION FROM admins TABLE
	var $admin_super;		// DETERMINES WHETHER ADMIN IS A SUPER ADMIN OR NOT

	/**
	 * SETS INITIAL VARS SUCH AS ADMIN INFO
	 * @param int[optional] $admin_id
	 * @param string[optional] $admin_username
	 */
	function PGAdmin($admin_id = 0, $admin_username = "")
  	{
	  	global $database;
    
	  	// SET INITIAL VARIABLES
	  	$this->is_error = FALSE;
	  	$this->admin_exists = FALSE;
	  	$this->admin_super = FALSE;
	  
	  	$admin_id = intval($admin_id);
	  	// VERIFY ADMIN_ID IS VALID AND SET APPROPRIATE OBJECT VARIABLES
	  	if( $admin_id || trim($admin_username) )
    	{
    		// Cache admin_info
    		/*
			$cacheTime = 604800; // 7d
			$cacheKey = 'adminInfo_'.$admin_id.'_'.$admin_username;
			$adminInfo = CacheLib::get($cacheKey, $cacheTime);
			*/
			if (!$adminInfo){
		    	$admin = $database->db_query("SELECT * FROM admins WHERE admin_id='".$admin_id."' OR admin_username='".$database->getEscaped($admin_username)."'");
		    	$adminInfo = $database->db_fetch_assoc($admin);
		    	
		    	//CacheLib::set($cacheKey, $adminInfo, $cacheTime);
			}
			
    		if( !empty($adminInfo) )
      		{
	      		$this->admin_exists = TRUE;
	      		$this->admin_info = $adminInfo;
        		$this->admin_salt = $this->admin_info['admin_code'];
        		
        		// Set & Cache is super
        		$cacheTime = 2592000; // 30d
        		$cacheKey = 'adminSupper';
				$super = CacheLib::get($cacheKey, $cacheTime);
				if (!$super){
	      			$super = $database->db_fetch_assoc($database->db_query("SELECT admin_id FROM admins ORDER BY admin_id LIMIT 1"));
					CacheLib::set($cacheKey, $super, $cacheTime);
				}
				
	      		if( $super['admin_id'] == $this->admin_info['admin_id']) $this->admin_super = TRUE;
	    	}
	  	}
	  	return ;
	}
  	
	/**
	 * CREATES A USER ACCOUNT USING THE GIVEN INFORMATION
	 * @param string $admin_username
	 * @param string $admin_password
	 * @param string $admin_name
	 * @param string $admin_email
	 * @param int $admin_group
	 * @param string $admin_access
	 * @return boolean
	 */
	function admin_create ($admin_username, $admin_password, $admin_name, $admin_email, $admin_group, $admin_access) {
	  	global $database, $setting, $datetime;
    
    	$admin_password_encrypted = $this->admin_password_crypt($admin_password);
    	$admin_registerDate = $datetime->timestampToDateTime();
    	
	  	$result = $database->db_query("
      		INSERT INTO admins (
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
		    	'{$admin_name}',
		    	'{$admin_email}',
		        '{$admin_username}',
		        '{$admin_password_encrypted}',
		        '{$setting['setting_password_method']}',
        		'{$this->admin_salt}',
		        '{$admin_group}',
		        '{$admin_access}',
		        '{$this->admin_info['admin_id']}',
		        '$admin_registerDate'
		    )
	    ");
	  	return $result;
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
	      	$method = $setting['setting_password_method'];
	      	$this->admin_salt = randomcode($setting['setting_password_code_length']);
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
	 * VERIFIES LOGIN COOKIES AND SETS APPROPRIATE OBJECT VARIABLES
	 */
	function admin_checkCookies()
  	{
    	// SAFE MODE (cookies)
    	if( defined('PG_ADMIN_SAFE_MODE') && PG_ADMIN_SAFE_MODE===TRUE )
    	{
      		$admin_id = ( isset($_COOKIE['admin_id']) ? $_COOKIE['admin_id'] : NULL );
      		$admin_username = ( isset($_COOKIE['admin_username']) ? $_COOKIE['admin_username'] : NULL );
      		$admin_password = ( isset($_COOKIE['admin_password']) ? $_COOKIE['admin_password'] : NULL );
    	}
    
    	// NORMAL (sessions)
    	else
    	{
	      	$session_object =& PGSession::getInstance();
	      
	      	$admin_id = $session_object->get('admin_id');
	      	$admin_username = $session_object->get('admin_username');
	      	$admin_password = $session_object->get('admin_password');
    	}
    
	  	if( isset($admin_id) && isset($admin_username) && isset($admin_password) )
    	{
	    	// GET ADMIN ROW IF AVAILABLE
	      	if( !$this->admin_exists )
	      	{
	        	$this->PGAdmin($admin_id);
	      	}
      
		    // VERIFY USER EXISTS, LOGIN COOKIE VALUES ARE CORRECT, AND EMAIL HAS BEEN VERIFIED - ELSE RESET USER CLASS
		    switch( TRUE )
      		{
		        case ( !$this->admin_exists ):
		        case ( $admin_username != $this->admin_password_crypt($this->admin_info['admin_username']) ):
		        case ( $admin_password != $this->admin_info['admin_password'] ):
		        case ( !$this->admin_info['admin_enabled'] ): $this->admin_clear();
		        break;
		    }
	  	}
	  	return ;
	}
  
	/**
	 * SETS LOGIN COOKIES
	 * @return boolean
	 */
	function admin_setCookies()
  	{
	    $admin_id = ( !empty($this->admin_info['admin_id']) ? $this->admin_info['admin_id'] : '' );
	    $admin_username = ( !empty($this->admin_info['admin_username']) ? $this->admin_password_crypt($this->admin_info['admin_username']) : '' );
	    $admin_password = ( !empty($this->admin_info['admin_password']) ? $this->admin_info['admin_password'] : '' );
      
    	// SAFE MODE (cookies)
	    if( defined('PG_ADMIN_SAFE_MODE') && PG_ADMIN_SAFE_MODE===TRUE )
	    {
		    setcookie("admin_id", $admin_id, 0, "/");
		    setcookie("admin_username", $admin_username, 0, "/");
		    setcookie("admin_password", $admin_password, 0, "/");
	    }
    
	    // NORMAL (sessions)
	    else
	    {
	      	$session_object =& PGSession::getInstance();
	      
	      	$session_object->set('admin_id', $admin_id);
	      	$session_object->set('admin_username', $admin_username);
	      	$session_object->set('admin_password', $admin_password);
		}
		return true;
	}

	/**
	 * TRIES TO LOG AN ADMIN IN IF THERE IS NO ERROR
	 */
	function admin_login()
  	{
      global $database, $datetime;
	  	$this->PGAdmin(0, $_POST['username']);
    
	  	// SHOW ERROR IF JAVASCRIPT IS DIABLED
	  	if( isset($_POST['javascript']) && $_POST['javascript'] == "no" )
    	{
	    	$this->is_error = 'Your browser does not have Javascript enabled. Please enable Javascript and try again.';
	  	}
    
    	elseif( !$this->admin_exists )
    	{
	    	$this->is_error = 'The login details you provided were invalid.';
	  	}
    
    	elseif( !$this->admin_info['admin_enabled'] )
    	{
	    	$this->is_error = 'The administrator has disabled your account.';
	  	}
    
    	elseif( $this->admin_password_crypt($_POST['password']) != $this->admin_info['admin_password'] )
    	{
	    	$this->is_error = 'The login details you provided were invalid.';
	  	}
    
    	else
    	{
          
          // UPDATE admin last login
          $database->db_query("UPDATE admins SET admin_lastvisitDate='%s' WHERE admin_username='%s'", $datetime->timestampToDateTime(), $this->admin_info['admin_username']);
      		$this->admin_setCookies();
	  	}
	  	return;
	}

	/**
	 * LOOPS AND/OR VALIDATES USER ACCOUNT INPUT
	 * @param array $aryInput
	 */
	function check_account_input($aryInput) {  
		global $database;
		      
    	//CHECK ADMIN NAME
		if (strlen($aryInput['admin_name']) < 6) {
			$this->is_error[] = 'Họ tên phải ít nhất 6 ký tự';
		}
		
		//CHECK EMAIL
		if ($aryInput['admin_email'] == '') {
			$this->is_error[] = 'Hãy nhập Email';
		}
		else if ($aryInput['admin_email'] !='') {
			if (!Validation::isEmail($aryInput['admin_email'])) {
				$this->is_error[] = 'Email không đúng định dạng';
			}
		}
		//CHECK USER EXISTED
		$email = strtolower($aryInput['admin_email']);
	  	if (strtolower($this->admin_info['admin_email']) != $email && $database->db_num_rows($database->db_query("SELECT admin_id FROM admins WHERE LOWER(admin_email)='{$email}'")) ) {
			$this->is_error[] = 'Email này đã có trong hệ thống. Hãy chọn 1 email khác.';
		}
		
		// CHECK PASSWORDS
	    if (trim($aryInput['admin_password_new']) || trim($aryInput['admin_password_conf'])) {
      		// CHECK FOR OLD PASSWORD MATCH
      		if ($this->admin_info['admin_password']) {
        		if (!trim($aryInput['admin_password_old'])) {
		          	$this->is_error[] = 'Hãy vào mật khẩu cũ.';
		        }
		        else if ($this->admin_password_crypt($aryInput['admin_password_old']) != $this->admin_info['admin_password']) {
		          	$this->is_error[] = 'Mật khẩu cũ không đúng.';
		        }
      		}
      
		    // CHECK FOR PASSWORD LENGTH
		    if (strlen($aryInput['admin_password_new']) < 6) {
		        $this->is_error[] = 'Mật khẩu phải tối thiểu 6 ký tự.';
		    }
		    // CHECK FOR PASSWORD MATCH
		    else if ($aryInput['admin_password_new'] != $aryInput['admin_password_conf']) {
		        $this->is_error[] = 'Mật khẩu xác nhận không đúng.';
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
			$this->is_error[] = 'Họ tên phải ít nhất 6 ký tự';
		}
		
		//CHECK EMAIL
		if ($aryInput['admin_email'] == '') {
			$this->is_error[] = 'Hãy nhập Email';
		}
		else if ($aryInput['admin_email'] !='') {
			if (!Validation::isEmail($aryInput['admin_email'])) {
				$this->is_error[] = 'Email không đúng định dạng';
			}
			else {
				$email = strtolower($aryInput['admin_email']);
				$sql = "SELECT admin_id FROM admins WHERE LOWER(admin_email)='{$email}'";
				if ($isUpdate) {
					$sql .= " AND admin_id <>".$aryInput['admin_id'];
				}
			  	if ($database->db_num_rows($database->db_query($sql))) {
					$this->is_error[] = 'Email này đã có trong hệ thống. Hãy chọn 1 email khác.';
				}
			}
		}
		
		//CHECK USERNAME
		if (!$isUpdate) {
		    if (preg_match("/[^a-zA-Z0-9]/", $aryInput['admin_username'])) {
		        $this->is_error[] = 'Tên đăng nhập phải là dạng chữ và số';
		    }
		    else if (strlen($aryInput['admin_username']) < 6) {
		        $this->is_error[] = 'Tên đăng nhập phải tối thiểu 6 ký tự.';
		    }
		    else if ($database->db_num_rows($database->db_query("SELECT admin_id FROM admins WHERE LOWER(admin_username)='".strtolower($aryInput['admin_username'])."'")) ) {
				$this->is_error[] = 'Tên đăng nhập đã có trong hệ thống. Hãy chọn 1 tên khác.';
		    }
		}
		
		//CHECK PASSWORDS
	    if (($isUpdate && trim($aryInput['admin_password'])!= '' && strlen($aryInput['admin_password']) < 6) || (!$isUpdate && strlen($aryInput['admin_password']) < 6)) {
	        $this->is_error[] = 'Mật khẩu phải tối thiểu 6 ký tự.';
	    }
	    
	    //CHECK USER GROUP
	  	if ($aryInput['admin_group'] == '') {
			$this->is_error[] = 'Hãy chọn 1 nhóm thành viên.';
		}
		
    	return true;
    }
 	// END admin_account() METHOD

	
	/**
	 * Sua thong tin cua Admin
	 * @param string $admin_username
	 * @param string $admin_password
	 * @param string $admin_name
	 * @param string $admin_email
	 * @return boolean
	 */
	function admin_edit($admin_username, $admin_password, $admin_name, $admin_email)
  	{
	  	global $database;
    
	  	if (trim($admin_password)) {
	    	$admin_password_encrypted = $this->admin_password_crypt($admin_password);
	  	}
    	else {
	    	$admin_password_encrypted = $this->admin_info['admin_password'];
	  	}
	  	$sql = "UPDATE admins SET admin_password='{$admin_password_encrypted}', admin_name='{$admin_name}', admin_email='{$admin_email}' WHERE admin_id='{$this->admin_info['admin_id']}' LIMIT 1";

	  	if (!$database->db_query($sql)) return false;
    
	  	// RESET COOKIE IF CURRENT ADMIN IS LOGGED IN
	  	global $admin;
	  	if( $admin->admin_info['admin_id'] == $this->admin_info['admin_id'] )
    	{
      		$this->admin_info['admin_username'] = $admin_username;
      		$this->admin_info['admin_password'] = $admin_password_encrypted;
      		$this->admin_setCookies();
	  	}
	  	
	  	// CLEAN CACHE
	  	$this->admin_clear_cache($this->admin_info['admin_id'], $admin_username);
	  	
	  	return true;
	}
	
	/**
	 * Cap nhat thong tin va quyen cua Admin
	 * @param array $aryInput
	 * @return boolean
	 */
	function update_user($aryInput)
  	{
	  	global $database;
    
  		if (trim($aryInput['admin_password'])) {
	    	$admin_password_encrypted = $this->admin_password_crypt($aryInput['admin_password']);
	  	}
    	else {
	    	$admin_password_encrypted = $this->admin_info['admin_password'];
	  	}
	  	
	  	$sql = "UPDATE admins SET 
	  				admin_name='".$aryInput['admin_name']."', 
	  				admin_email='".$aryInput['admin_email']."', 
	  				admin_group='".$aryInput['admin_group']."', 
	  				admin_enabled='".$aryInput['admin_enabled']."', 
	  				admin_access='".$aryInput['admin_access']."', 
	  				admin_password='".$admin_password_encrypted."' 
	  			WHERE admin_id='{$aryInput['admin_id']}' 
	  			LIMIT 1";

	  	if (!$database->db_query($sql)) return false;
    
  		// RESET COOKIE IF CURRENT ADMIN IS LOGGED IN
	  	global $admin;
	  	if( $admin->admin_info['admin_id'] == $this->admin_info['admin_id'] )
    	{
      		//$this->admin_info['admin_username'] = $aryInput['admin_username'];
      		$this->admin_info['admin_password'] = $admin_password_encrypted;
      		$this->admin_setCookies();
	  	}
	  	
	  	// CLEAN CACHE
	  	$this->admin_clear_cache($aryInput['admin_id'], $this->admin_info['admin_username']);
	  	
	  	return true;
	}

	/**
	 * Clean admin
	 * @return boolean
	 */
	function admin_clear()
  	{
	  	$this->is_error = FALSE;
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
	  	$database->db_query("DELETE FROM admins WHERE admin_id='{$this->admin_info['admin_id']}' LIMIT 1");
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