<?php
defined('PG_PAGE') or die();

class PGUser
{
	// INITIALIZE VARIABLES
	var $is_error;			// DETERMINES WHETHER THERE IS AN ERROR OR NOT, CONTAINS RELEVANT ERROR CODE
	
	var $user_exists;		// DETERMINES WHETHER WE ARE EDITING AN EXISTING USER OR NOT

	var $user_info;			// CONTAINS USER'S INFORMATION FROM USERS TABLE
	
	var $user_salt;			// CONTAINS THE SALT USED TO ENCRYPT USER'S PASSWORD

	var $session_info;		// CONTAINS THE PRIVACY LEVEL THAT IS ALLOWED TO MODERATE FOR THIS USER

	var $gold_secret = 'shpvccorp';
  	//
	// THIS METHOD SETS INITIAL VARS SUCH AS USER INFO AND LEVEL INFO
  	//
	// INPUT:
  	//    	$user_unique (OPTIONAL) REPRESENTING AN ARRAY:
	//		$user_unique[0] REPRESENTS THE USER'S ID (user_id)
	//		$user_unique[1] REPRESENTS THE USER'S EMAIL (user_email)
	//		$user_unique[2] REPRESENTS THE USER'S USERNAME (user_username)
	//		$select_fields REPRESENTS THE FIELDS TO SELECT FROM THE USERS TABLE
	// OUTPUT: 
  	//    void
  	//
  
	function PGUser($user_unique = Array('0', '', ''), $select_fields = '*')
  	{
	  	global $database;
    
	  	// SET VARS
	  	$this->is_error = 0;
	  	$this->user_exists = 0;
	  	$this->user_info['user_id'] = 0;
		
	  	$user_unique_id = ( !empty($user_unique[0]) ? $user_unique[0] : NULL );
    	$user_unique_email = ( !empty($user_unique[1]) ? $user_unique[1] : NULL );
	    $user_unique_username = ( !empty($user_unique[2]) ? $user_unique[2] : NULL );

    	$select_fields = $database->getEscaped($select_fields);
    	
	  	// VERIFY USER_ID/USER_EMAIL IS VALID AND SET APPROPRIATE OBJECT VARIABLES
	  	if( $user_unique_id || $user_unique_email || $user_unique_username )
    	{
	    	// SET USERNAME AND EMAIL TO LOWERCASE
	    	$user_username = strtolower($user_unique_username);
	    	$user_email = strtolower($user_unique_email);
	      
		    // SELECT USER USING SPECIFIED SELECTION PARAMETER
		    $sql_array = array();
		    if( !empty($user_unique[0]) ) {
		      	$sql_array[] = "SELECT {$select_fields} FROM users WHERE user_id='{$user_unique_id}' LIMIT 1";
		    }
		    if( !empty($user_unique[1]) ) {
		      	$sql_array[] = "SELECT {$select_fields} FROM users WHERE user_email='".$database->getEscaped($user_email)."' LIMIT 1";
			}
	      	if( !empty($user_unique[2]) ) {
	      		$sql_array[] = "SELECT {$select_fields} FROM se_users WHERE user_username='".$database->getEscaped($user_username)."' LIMIT 1";
    		}
    		
		    if( count($sql_array)>1 )
		      	$sql = '('.join(') UNION (', $sql_array).')';
		    else
		      	$sql = $sql_array[0];

	    	$query = $database->db_query($sql);
	    	if($database->db_num_rows($query) == 1)
      		{
		      	$this->user_exists = 1;
		      	$this->user_info = $database->db_fetch_assoc($query);
	        
		      	// SET USER SALT
		      	$this->user_salt = $this->user_info['user_code'];
      		}
		}
		return ;
	}
  	// END PGUser() METHOD


	// THIS METHOD VERIFIES LOGIN COOKIES, SETS APPROPRIATE OBJECT VARIABLES, AND UPDATES LAST ACTIVE TIME
	// INPUT: 
	// OUTPUT: 
	function user_checkCookies()
  	{
	  	global $database, $setting, $admin;
    
    	$session_object =& PGSession::getInstance();
    
    	// Ignore bots
    	if( strpos($_SERVER['HTTP_USER_AGENT'], 'Googlebot')!==FALSE ) return;
    	if( strpos($_SERVER['HTTP_USER_AGENT'], 'msnbot')!==FALSE ) return;
    
	    // Check if user exists
	    $user_id    = $session_object->get('user_id');
	    $user_email = $session_object->get('user_email');
	    $user_pass  = $session_object->get('user_pass');
    
	    // Check for auth token
	    if( !$user_id )
	    {
	      	$this->user_auth_token_check();
	    }
	    
	    if( isset($user_id) && isset($user_email) && isset($user_pass) )
	    {
	      	// Only create if not already exists to help with caching
	      	if( !$this->user_exists )
	      	{
	        	$this->PGUser(Array($user_id));
	      	}
	      
		    // VERIFY USER EXISTS, LOGIN COOKIE VALUES ARE CORRECT, AND EMAIL HAS BEEN VERIFIED - ELSE RESET USER CLASS
		    switch( TRUE )
	      	{
		        case ( !$this->user_exists ):
		        case ( $user_email != $this->user_password_crypt($this->user_info['user_email']) ):
		        case ( $user_pass != $this->user_info['user_password'] ):
		        case ( !$this->user_info['user_verified'] && $setting['setting_signup_verify'] ):
		        case ( !$this->user_info['user_enabled'] && (!is_object($admin) || !$admin->admin_exists) ):
		          	$this->user_clear();
		        break;
		    }
	      
	      	// MIGHT REMOVE THIS IN FAVOR OF SESSIONS?
	      	if( $this->user_exists && time()>$this->user_info['user_lastactive']+600 )
	      	{
		        $time_current = time();
		        $database->db_query("UPDATE users SET user_lastactive='{$time_current}', user_ip_lastactive='{$_SERVER['REMOTE_ADDR']}' WHERE user_id='{$this->user_info['user_id']}' LIMIT 1");
	      	}
		}
	    
	    // VISITOR HANDLING (ONLY UPDATE ONCE EVERY TWO MINUTES)
	    $user_lastactive = $session_object->get('user_lastactive', 0);
	    
	    if( empty($user_lastactive) || ($user_lastactive < time() - 120) )
	    {
	      	$visitor_ip = ip2long($_SERVER['REMOTE_ADDR']);
	      	$visitor_browser = md5($_SERVER['HTTP_USER_AGENT']);
	      	$visitor_lastactive = time();
	     
	      	$visitor_user_id = ( $this->user_exists ? $this->user_info['user_id'] : '0' );
	      
	      	// UPDATE USER LAST ACTIVE IF LOGGED IN
	      	if( $this->user_exists )
	      	{
	        	$sql = "UPDATE users SET user_lastactive='{$visitor_lastactive}', user_ip_lastactive='{$_SERVER['REMOTE_ADDR']}' WHERE user_id='{$visitor_user_id}' LIMIT 1";
	        	$database->db_query($sql);
	      	}
	      
	      	$session_object->set('user_lastactive', $visitor_lastactive);
	    }
	    
	    return ;
	}
  
  	// END user_checkCookies() METHOD

	
	// THIS METHOD TRIES TO LOG A USER IN IF THERE IS NO ERROR
	// INPUT: 
	//    $user_unique (OPTIONAL) REPRESENTING AN ARRAY:
	//	  $user_unique[0] REPRESENTS THE USER'S EMAIL (user_email)
	//	  $user_unique[1] REPRESENTS THE USER'S USERNAME (user_username)
	//	  $password REPRESENTING THE LOGIN PASSWORD
	//	  $javascript_disabled (OPTIONAL) A BOOLEAN REPRESENTING WHETHER JAVASCRIPT IS DISABLED OR NOT
	//	  $persistent (OPTIONAL) A BOOLEAN SPECIFYING WHETHER COOKIES SHOULD BE PERSISTENT OR NOT
	// OUTPUT: 
	function user_login($user_unique = Array('', ''), $password, $javascript_disabled = 0, $persistent = 0, $check_pass=true)
  	{
	  	global $database, $setting;
    
	  	if ( !empty($user_unique[0]) ) $this->PGUser(Array(0, $user_unique[0]));
	  	else if ( !empty($user_unique[1]) ) $this->PGUser(Array(0, '', $user_unique[1]));
	  	
	  	$current_time = time();
	  	$login_result = 0;
    
	  	// SHOW ERROR IF JAVASCRIPT IS DIABLED
	  	if( $javascript_disabled )
    	{
	    	$this->is_error = 'Trình duyệt không hỗ trợ javascript. Hãy cho phép chạy javascript trước khi thực hiện chức năng này.';
    	}
    
	  	// SHOW ERROR IF NO USER ROW FOUND
	  	elseif($this->user_exists == 0)
    	{
	    	$this->is_error = 'Tài khoản đăng nhập không đúng. Hãy kiểm tra lại';
    	}
    
	  	// VALIDATE PASSWORD
	  	elseif( $check_pass==true && (!trim($password) || $this->user_password_crypt($password) != $this->user_info['user_password']) )
    	{
	    	$this->is_error = 'Mật khẩu đăng nhập không đúng. Hãy kiểm tra lại';
	  	}
    
	  	// CHECK IF USER IS ENABLED
	  	elseif( !$this->user_info['user_enabled'] )
    	{
	    	$this->is_error = 'Tài khoản của bạn đã bị khóa. Hãy liên lạc với admin để được trợ giúp';
    	}
    
	  	// CHECK IF EMAIL IS VERIFIED
	  	elseif( !$this->user_info['user_verified'] && $setting['setting_signup_verify'] )
    	{
	    	$this->is_error = 'Tài khoản của  bạn chưa được kích hoạt. Hãy kiểm tra email của bạn và thực hiện kích hoạt tài khoản';
	  	}
    
	  	// INITIATE LOGIN AND ENCRYPT COOKIES
	  	else
    	{
		    // SET LOGIN RESULT VAR
		    $login_result = TRUE;
	      
		    // UPDATE USER LOGIN INFO
		    $database->db_query("UPDATE users SET user_lastlogindate='{$current_time}', user_logins=user_logins+1, user_lastactive='{$current_time}', user_ip_lastactive='{$_SERVER['REMOTE_ADDR']}' WHERE user_id='{$this->user_info['user_id']}' LIMIT 1");
	      
		    // LOG USER IN
		    $this->user_setcookies($persistent);
	  	}
	  	
	  	return ;
	}
  
  	// END user_login() METHOD

  
  	//
	// THIS METHOD SETS USER LOGIN COOKIES
  	//
	// INPUT:
  	//    $persistent (OPTIONAL) REPRESENTING WHETHER THE COOKIES SHOULD BE PERSISTENT OR NOT
  	//
	// OUTPUT: 
  	//    void
  	//
  
	function user_setcookies($persistent = false)
  	{
	    // TODO: PERSISTENT
	    $session_object =& PGSession::getInstance();
	    
	    $user_id = ( !empty($this->user_info['user_id']) ? $this->user_info['user_id'] : '' );
	    $user_email = ( !empty($this->user_info['user_email']) ? $this->user_password_crypt($this->user_info['user_email']) : '' );
	    $user_password = ( !empty($this->user_info['user_password']) ? $this->user_info['user_password'] : '' );
	    
	    // We don't need to do this any more because of the auth tokens
	    // Set cookie parameters
	    //$cookie_lifetime = ( $persistent ? (60 * 60 * 24 * 31 * 6) : 0 );
	    //if( $cookie_lifetime )
	    //{
	    //  session_set_cookie_params(10);//$cookie_lifetime);
	    //}
	    
	    // Get new id for security
	    $session_object->copy();
	    
	    // Set user login info
	    $session_object->set('user_id', $user_id);
	    $session_object->set('user_email', $user_email);
	    $session_object->set('user_pass', $user_password);
	    $session_object->set('user_persist', (bool) $persistent);
	    $session_object->set('user_lastactive', time() - 3600);
	    
	    // Create new key if logging in, delete old key if logging out
	    if( $user_id )
	    {
	      	$this->user_auth_token_create((bool)$persistent);
	    }
	    else
	    {
	      	$this->user_auth_token_delete();
	    }
	    
	    return ;
	}
  
  	// END user_setcookies() METHOD


	// THIS METHOD CLEARS ALL THE CURRENT OBJECT VARIABLES
	// INPUT:
	// OUTPUT:
  
	function user_clear()
  	{
	  	$this->is_error = FALSE;
	  	$this->user_exists = FALSE;
    
	  	$this->user_info = array();
	  	
	  	return ;
	}
  
  	// END user_clear() METHOD


	// THIS METHOD LOGS A USER OUT
	// INPUT:
	// OUTPUT:
  
	function user_logout()
  	{
	  	global $database;
    
    	$session_object =& PGSession::getInstance();
    
    	// REMOVE AUTH TOKEN
    	$this->user_auth_token_delete();
    
	  	// CLEAR LAST ACTIVITY DATE
	  	$session_object->clear('user_lastactive');
    
	  	// CREATE PLAINTEXT USER EMAIL COOKIE WHILE LOGGED OUT
	  	setcookie("prev_email", $this->user_info['user_email'], time()+99999999, "/");
    
	  	$this->user_clear();
	  	$this->user_setcookies();
	  	
	  	return ;
	}
  
  	// END user_logout() METHOD


	// THIS METHOD VALIDATES USER ACCOUNT INPUT
	// INPUT: $email REPRESENTING THE DESIRED EMAIL
	// OUTPUT: 

	function user_account($email, $username='', $fullname, $mobile, $address, $district, $city)
  	{
	  	global $database, $setting;

	  	// MAKE SURE FIELDS ARE FILLED OUT
  		if (strlen($fullname) < 6) $this->is_error = 'Họ tên phải ít nhất 6 ký tự.';
		
		if ($mobile == '') $this->is_error = 'Số điện thoại không được để trống.';
		
		if (strlen($mobile)<10 || strlen($mobile)>11) $this->is_error = 'Độ dài của trường số điện thoại di động là 10 hoặc 11 số.';
  	
		if ($address == '') $this->is_error = 'Hãy nhập địa chỉ hiện tại của bạn.';
		
		if ($district == '') $this->is_error = 'Hãy chọn Quận huyện.';
		
		if ($city == '' || $city == 0) $this->is_error = 'Hãy chọn Tỉnh/Thành phố.';
		
	  	if( !trim($email) ) $this->is_error = 'Bạn chưa nhập địa chỉ Email.';
      	
	  	// Neu bat buoc phai co username hoac can check username
	  	if ($setting['setting_username'] || trim($username)){
	  		if( !trim($username) ) $this->is_error = 'Bạn chưa nhập Tên đăng nhập';
	  		
	  		// MAKE SURE USERNAME IS ALPHANUMERIC
		  	if( ereg('[^A-Za-z0-9]', $username) ) $this->is_error = 'Tên đăng nhập không đúng quy cách.';
		  	
		  	// MAKE SURE USERNAME IS NOT BANNED
		  	$banned_usernames = explode(",", strtolower($setting['setting_banned_usernames']));
		  	if( in_array(strtolower($username), $banned_usernames) ) $this->is_error = 'Tên đăng nhập đã bị khoá.';
		  	
		  	// MAKE SURE USERNAME IS UNIQUE
		 	$lowercase_username = strtolower($username);
		    if( strtolower($this->user_info['user_username']) != $lowercase_username )
		    {
		      	$username_query = $database->db_query("SELECT user_username FROM users WHERE user_username='".$database->getEscaped($lowercase_username)."' LIMIT 1");
		      	if( $database->db_num_rows($username_query) ) $this->is_error = 'Tên đăng nhập đã tồn tại.';
		    }
	  	}
	  	
	  	if ($this->is_error) return ;
      
	  	// MAKE SURE EMAIL IS NOT BANNED
	  	$banned_emails = explode(",", strtolower($setting['setting_banned_emails']));
	  	$wildcard_ban = "*".strstr(strtolower($email), "@");
    
    	if( trim($email) && in_array(strtolower($email), $banned_emails) )
      		$this->is_error = 'Địa chỉ Email đã bị khoá. Xin hãy nhập địa chỉ Email khác.';
    
    	if( trim($email) && in_array(strtolower($wildcard_ban), $banned_emails) )
      		$this->is_error = 'Địa chỉ Email đã bị khoá. Xin hãy nhập địa chỉ Email khác.';
    
	  	// MAKE SURE EMAIL IS VALID
	  	if( !is_email_address($email) )
      		$this->is_error = 'Địa chỉ Email không đúng. Xin hãy thử lại.';
    
	  	// MAKE SURE EMAIL IS UNIQUE
	  	$lowercase_email = strtolower($email);
    	if( strtolower($this->user_info['user_email']) != $lowercase_email )
    	{
	      	$email_query = $database->db_query("SELECT user_email FROM users WHERE user_email='".$database->getEscaped($lowercase_email)."' LIMIT 1");  
	      	if( $database->db_num_rows($email_query) ) $this->is_error = 'Địa chỉ Email này đã có người sử dụng. Xin hãy nhập địa chỉ Email khác.';
    	}
    	
    	return ;
	}
  
  	// END user_account() METHOD


	// THIS METHOD VALIDATES USER PASSWORD INPUT
	// INPUT: $password_old REPRESENTING THE EXISTING PASSWORD
	//	  $password REPRESENTING THE DESIRED PASSWORD
	//	  $password_confirm REPRESENTING THE PASSWORD CONFIRMATION FIELD
	//	  $check_old (OPTIONAL) REPRESENTING WHETHER THE OLD PASSWORD SHOULD BE VERIFIED OR NOT
	// OUTPUT: 
  
	function user_password($password_old, $password, $password_confirm, $check_old = 1)
  	{
	  	// CHECK FOR EMPTY PASSWORDS
	  	if( !trim($password) || !trim($password_confirm) || ($check_old && !trim($password_old)) )
	      	$this->is_error = 'Bạn chưa nhập mật khẩu.';
	    
	  	// CHECK FOR OLD PASSWORD MATCH
	  	if( $check_old && $this->user_password_crypt($password_old) != $this->user_info['user_password'] )
	      	$this->is_error = 'Mật khẩu cũ không đúng. Xin hãy thử lại.';
	    
	  	// MAKE SURE BOTH PASSWORDS ARE IDENTICAL
	  	if( $password != $password_confirm )
	      	$this->is_error = 'Mật khẩu xác nhận không đúng. Xin hãy thử lại.';
	    
	  	// MAKE SURE PASSWORD IS LONGER THAN 5 CHARS
	  	if( trim($password) && strlen($password) < 6 )
	      	$this->is_error = 'Mật khẩu không được dưới 6 ký tự.';

	    // CHECK PASSWORD TIENG VIET
	    if( mb_detect_encoding($password) == 'UTF-8' )
	    	$this->is_error = 'Mật khẩu không được gõ tiếng Việt có dấu.';
	    	
	    if( mb_detect_encoding($password_confirm)== 'UTF-8' )
	    	$this->is_error = 'Mật khẩu xác nhận không được gõ tiếng Việt có dấu.';	

	    return ;
	}
  
  	// END user_password() METHOD


	// THIS METHOD ENCRYPTS A USERS PASsWORD
	// INPUT: UNENCRYPTED PASSWORD
	// OUTPUT: ENCRYPTED PASSWORD
  
	function user_password_crypt($user_password)
  	{
	    global $setting;
	    
	    if( !$this->user_exists )
	    {
	      	$method = $setting['setting_password_method'];
	      	$this->user_salt = randomcode($setting['setting_password_code_length']);
	    }
	    else
	    {
	      	$method = $this->user_info['user_password_method'];
	    }
	    
	    // For new methods
	    if( $method>0 )
	    {
	      	if( !empty($this->user_salt) )
	      	{
		        list($salt1, $salt2) = str_split($this->user_salt, ceil(strlen($this->user_salt) / 2));
		        $salty_password = $salt1.$user_password.$salt2;
	      	}
	    	else
	      	{
	        	$salty_password = $user_password;
	      	}
	    }
	    
	    switch( $method )
	    {
	      	// crypt()
	      	default:
	      	case 0:
	        	$user_password_crypt = crypt($user_password, '$1$'.str_pad(substr($this->user_salt, 0, 8), 8, '0', STR_PAD_LEFT).'$');
	      	break;
	      
	      	// md5()
	      	case 1:
	        	$user_password_crypt = md5($salty_password);
	      	break;
	      
	      	// sha1()
	      	case 2:
	        	$user_password_crypt = sha1($salty_password);
	      	break;
	      
	      	// crc32()
	      	case 3:
	        	$user_password_crypt = sprintf("%u", crc32($salty_password));
	      	break;
	    }
	    
	    return $user_password_crypt;
  	}
  
  	// END user_password_crypt() METHOD


	// THIS METHOD UPDATES THE USER'S LAST UPDATE DATE
	// INPUT: 
	// OUTPUT: 
  
	function user_lastupdate()
  	{
	  	global $database;
    
	  	$database->db_query("UPDATE users SET user_dateupdated='".time()."' WHERE user_id='{$this->user_info['user_id']}' LIMIT 1");
		
	  	return ;
  	}
  
  	// END user_lastupdate() METHOD


	// THIS METHOD CREATES A USER ACCOUNT USING THE GIVEN INFORMATION
	// INPUT: $signup_email REPRESENTING THE DESIRED EMAIL
	//	  $signup_password REPRESENTING THE DESIRED PASSWORD
	// OUTPUT: 
  
	function user_create($signup_email, $signup_username, $signup_password, $signup_fullname, $signup_mobile, $signup_address, $signup_district=0, $signup_city=0, $signup_type=1)
  	{
	  	global $database, $setting, $uri;
    
	  	// PRESET VARS
	  	$signup_date = time();
	  	$signup_ip = $_SERVER['REMOTE_ADDR'];
    
    
	  	// SET WHETHER USER IS ENABLED OR NOT
    	$signup_enabled = (int) $setting['setting_signup_enable'];
    
	  	// SET EMAIL VERIFICATION VARIABLE
	  	if ($setting['setting_signup_verify']) $signup_verified = 0;
	  	else $signup_verified = 1;
    
	  	// CREATE RANDOM PASSWORD IF NECESSARY
	  	if( $setting['setting_signup_randpass'] ) $signup_password = randomcode(10);
    
	  	// ENCODE PASSWORD WITH MD5
	  	$crypt_password = $this->user_password_crypt($signup_password);
    	$signup_code = $user_salt = $this->user_salt;
    
	  	// ADD USER TO USER TABLE
	  	$create = $database->db_query("
	      INSERT INTO users (
	      	user_type,
	        user_email,
	        user_username,
	        user_password,
	        user_password_method,
	        user_fullname,
	        user_address,
	        user_district,
	        user_city,
	        user_mobile,
	        user_signupdate,
	        user_ip_signup,
	        user_ip_lastactive,
	        user_code,
	        user_verified,
	        user_enabled
	      ) VALUES (
	      	'{$signup_type}',
	        '".$database->getEscaped($signup_email)."',
	        '".$database->getEscaped($signup_username)."',
	        '{$crypt_password}',
	        '{$setting['setting_password_method']}',
	        '".$database->getEscaped($signup_fullname)."',
	        '".$database->getEscaped($signup_address)."',
	        '{$signup_district}',
	        '{$signup_city}',
	        '".$database->getEscaped($signup_mobile)."',
	        '{$signup_date}',
	        '{$signup_ip}',
	        '{$signup_ip}',
	        '{$signup_code}',
	        '{$signup_verified}',
	        '{$signup_enabled}'
	      )
	    ");
    
	  	// RETRIEVE USER ID
	  	$user_id = $database->db_insert_id();
    
    	if( $user_id && $create ) $this->user_exists = TRUE;
    	else {
    		$this->is_error = 'Không tạo được tài khoản.';
    		return false;
    	}
    
	  	// GET USER INFO
	  	$this->user_info = $database->db_fetch_assoc($database->db_query("SELECT * FROM users WHERE user_id='{$user_id}' LIMIT 1"));
	  
	  	// SEND RANDOM PASSWORD IF NECESSARY
	  	if( $setting['setting_signup_randpass'] )
    	{
      		//send_systememail('newpassword', $this->user_info['user_email'], Array($this->user_displayname, $this->user_info['user_email'], $signup_password, "<a href=\"".$url->url_base."login.php\">".$url->url_base."login.php</a>"));
    	}
    
	 	 // SEND VERIFICATION EMAIL IF REQUIRED
	  	if( $setting['setting_signup_verify'] )
    	{
    		$verify_code = md5($this->user_info['user_code']);
		    $time = time();
		    $verify_link = PG_URL_ROOT."signup_verify.php?u={$this->user_info['user_id']}&verify={$verify_code}&d={$time}";
		    
    		$aryReplace['[link]'] = $verify_link;
			$aryReplace['[email]'] = $signup_email;
			$aryReplace['[fullname]'] = $signup_fullname;
			$aryEmail = getSystemEmail('verification', $aryReplace);
			send_email_system($signup_email, $sender='', $aryEmail['system_email_subject'], $aryEmail['system_email_body']); 
    	}
    
	  	// SEND WELCOME EMAIL IF REQUIRED (AND IF VERIFICATION EMAIL IS NOT BEING SENT)
	  	if( $setting['setting_signup_welcome'] && !$setting['setting_signup_verify'] )
    	{
      		//send_systememail('welcome', $this->user_info['user_email'], Array($this->user_displayname, $this->user_info['user_email'], $signup_password, "<a href=\"".$url->url_base."login.php\">".$url->url_base."login.php</a>"));
    	}
    	return true;
	}
  
  	// END user_create() METHOD

	// THIS METHOD DELETES THE USER CURRENTLY ASSOCIATED WITH THIS OBJECT
	// INPUT: 
	// OUTPUT:
	function user_delete()
  	{
	  	global $database;
    
	  	// DELETE USER, LOGGOLD TABLE ROWS
	  	$database->db_query("DELETE FROM users WHERE user_id='{$this->user_info['user_id']}' LIMIT 1");
	  	$database->db_query("DELETE FROM loggolds WHERE loggold_user_id='{$this->user_info['user_id']}'");
	  	
	  	$this->user_clear();
	}
  
  	// END user_delete() METHOD

  
  	function user_auth_token_create($persistent = false)
  	{
  		global $database;
  		
	    if( !$this->user_exists )
	    {
	      	return false;
	    }
	    
	    $id = false;
	    while( !$id )
	    {
	      	$id = sha1(uniqid(mt_rand(), true));
	     	$resource = $database->db_query("SELECT NULL FROM session_auth WHERE session_auth_key='{$id}' LIMIT 1");
	      	if( $database->db_num_rows($resource) >= 1 )
	      	{
	        	$id = false;
	      	}
	    }
	    
	    $persistent = (bool) $persistent;
	    $ua = md5($_SERVER['HTTP_USER_AGENT']);
	    $ip = ip2long($_SERVER['REMOTE_ADDR']);
	    $now = time();
	    
	    $sql = "
	      	INSERT INTO session_auth
	        	(session_auth_key, session_auth_user_id, session_auth_ua, session_auth_ip, session_auth_type, session_auth_time)
	      	VALUES
	        	('{$id}', '{$this->user_info['user_id']}', '{$ua}', '{$ip}', '{$persistent}', '{$now}')
	    ";
	    $resource = $database->db_query($sql);
	    
	    
	    // Success, set token
	    if( $resource )
	    {
	      	// Delete old token if necessary
	      	$this->user_auth_token_delete(null, false);
	      
	      	// Set new token
	      	$cookie_lifetime = ( $persistent ? time() + (60 * 60 * 24 * 30 * 6) : 0 );
	      	$host = get_simple_cookie_domain();
	      	setcookie('auth_token', $id, $cookie_lifetime, '/', $host);
	      	return $id;
	    }
	    
	    else
	    {
	      	// Delete existing auth token on failure
	      	$this->user_auth_token_delete(null, true);
	      	return false;
	    }
  	}
  
  
  	function user_auth_token_delete($id = null, $delete_cookie = true)
  	{
  		global $database;
  		
	    if( !$id )
	    {
	      	$id = @$_COOKIE['auth_token'];
	      	if( !$id )
	      	{
	        	return;
	      	}
	    }
	    
	    // Remove cookie
	    if( $delete_cookie )
	    {
	      	$host = get_simple_cookie_domain();
	      	setcookie('auth_token', null, (int) time() / 2, '/', $host);
	    }
	    
	    // Remove from db
	    $database->db_query("DELETE FROM session_auth WHERE session_auth_key='{$id}' LIMIT 1");
	    
	    // Cleanup? ~6 months
	    $mintime = time() - (60 * 60 * 24 * 30 * 6);
	    $database->db_query("DELETE FROM session_auth WHERE session_auth_time<'{$mintime}'");
  	}
  
  
  	function user_auth_token_check()
  	{
  		global $database;
  	
	    // We are already logged in? Why are we checking this?
	    if( $this->user_exists )
	    {
	      	return true;
	    }
	    
	    $id = @$_COOKIE['auth_token'];
	    
	    // No auth token set, fail
	    if( !$id )
	    {
	      	return false;
	    }
	    
	    $ua = md5($_SERVER['HTTP_USER_AGENT']);
	    $ip = ip2long($_SERVER['REMOTE_ADDR']);
	    
	    $resource = $database->db_query("SELECT session_auth_user_id, session_auth_type FROM session_auth WHERE session_auth_key='{$id}' && session_auth_ip='{$ip}' && session_auth_ua='{$ua}' LIMIT 1");
	    if( !$database->db_num_rows($resource) )
	    {
	      	// There was an invalid key, remove it
	      	$this->user_auth_token_delete(null, true);
	      	return false;
	    }
	    
	    $info = $database->db_fetch_assoc($resource);
	    $persistent = (bool) $info['session_auth_type'];
	    $user_id = $info['session_auth_user_id'];
	    
	    // Should we populate use data here?
	    $this->PGUser(array($user_id));
	    $this->user_setcookies($persistent);
	    
	    return $user_id;
  	}
  	
  	function user_update_gold($update_gold, $update_gold_hash, $gold_type=PG_GOLD_TYPE_MAIN){
  		global $database;
  		
  		$sql = "UPDATE users SET $gold_type='".intval($update_gold)."', {$gold_type}_hash='".$database->getEscaped($update_gold_hash)."' WHERE user_id=".$this->user_info['user_id'];
  		
  		if ($database->db_query($sql)) return true;
  		return false;
  	}
}

?>