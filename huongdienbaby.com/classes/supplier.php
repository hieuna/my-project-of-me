<?

/*
class supplier
Developed by FinalStyle.com
*/
class supplier{
	var $logged = 0;
	var $login_name;
	var $password;
	var $u_id = -1;
	var $level = 0;
	var $use_security;
	/*
	init class
	login_name : ten truy cap
	password  : password (no hash)
	level: nhom user; 0: Normal; 1: Admin (default level = 0)
	*/
	function supplier($login_name="",$password=""){
		$checkcookie=0;
		$this->logged = 0;
		if ($login_name==""){
			if (isset($_SESSION["login_name"])) $login_name = $_SESSION["login_name"];
		}
		if ($password==""){
			if (isset($_SESSION["PHPSESS1D"])) $password = $_SESSION["PHPSESS1D"];
			$checkcookie=1;
		}
		else{
			$password = str_replace("\'","'",$password);
			$password = str_replace("'","''",$password);
		}
		
		if ($login_name=="" && $password=="") return;
		
		$db_supplier = new db_query("SELECT * 
												FROM suppliers
												WHERE sup_login = '" . $this->removequote($login_name) . "' AND sup_active = 1");
		
		if ($row=mysql_fetch_array($db_supplier->result)){
			
			//kiem tra password va use_active
			if($checkcookie==0)	$password = md5($password . $row["sup_security"]);
			if ($password == $row["sup_password"]){
					$this->logged 				= 1;
					$this->login_name 		= $login_name;
					$this->password 			= $password;
					$this->use_security		= $row["sup_security"];
					$this->u_id 				= intval($row["sup_id"]);
			}
		}
		
		$db_supplier->close();
		unset($db_supplier);
		
	}
	
	/*
	lưu thông tin đăng nhập vào session
	*/
	function savesession($time = 0){
		if ($this->logged !=1 ) return false;
			$_SESSION["login_name"] = $this->login_name;
			$_SESSION["PHPSESS1D"] = $this->password;
		}
	}

	/*
	Remove quote
	*/
	function removequote($str){
		$temp = str_replace("\'","'",$str);
		$temp = str_replace("'","''",$temp);
		return $temp;
	}


	//ham ma hoa
	function str_encode($encodeStr="")
	{
		$returnStr = "";
		if(!empty($encodeStr)) {
			$enc = base64_encode($encodeStr);
			$enc = str_replace('=','',$enc);
			$enc = str_rot13($enc);
			$returnStr = $enc;
		}
		
		return $returnStr;
	
	} // end func am_encode
	
	
	//ham giai ma hoa
	function str_decode($encodedStr="")
	{
	   $returnStr = "";
		if(!empty($encodedStr)) {
			 $dec = str_rot13($encodedStr);
			 $dec = base64_decode($dec);
			$returnStr = $dec;
		}
		return $returnStr;
	
	} // end func am_decode
}