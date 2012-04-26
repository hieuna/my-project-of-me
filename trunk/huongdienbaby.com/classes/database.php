<?
class db_init
{
	var $server;
	var $username;
	var $password;
	var $database;
	function db_init()
	{
		// Khai bao Server o day
		$this->server	 = "localhost";
		$this->username = "root";
		$this->password = "ngockieuvan@vccorp.vn";
		$this->database = "db_huongdienbaby";
	}
	function __destruct()
	{
		unset($this->server);
		unset($this->username);
		unset($this->password);
		unset($this->database);
	}
}
?>
<?
class db_query 
{
	var $result;
	var $links;
	function db_query($query)
	{
		//echo $query;
		$dbinit = new db_init();
		//Khai bao connect
		$this->links = mysql_connect($dbinit->server, $dbinit->username, $dbinit->password);
		$db_select = mysql_select_db($dbinit->database,$this->links);
		
		//echo $query;
		//$time_start = $this->microtime_float();
		
		mysql_query("SET NAMES 'utf8'");
		$this->result = mysql_query($query,$this->links);
		
		/*
		$time_end = $this->microtime_float();
		$time = $time_end - $time_start;
		echo " <font color='red'><b>" . number_format($time,10,".",",") . "</b></font> ";	
		*/
		if(isset($_SESSION["numberQuery"])) $_SESSION["numberQuery"]++;
		unset($dbinit);
		if (!$this->result)
		{
			$error = mysql_error($this->links);
			mysql_close($this->links);	
			die("Error in query string " . $error);
		}
		
	}
	function close()
	{
		mysql_free_result($this->result); 
		if ($this->links) 
		{  
			mysql_close($this->links);		
		}
	}
	//Hàm tính time
	function microtime_float()
	{
	   list($usec, $sec) = explode(" ", microtime());
	   return ((float)$usec + (float)$sec);
	}	
}
?>
<?
class db_execute 
{
	var $links;
	function db_execute($query, $utf8=1)
	{
		$dbinit = new db_init();
		
		$this->links = mysql_connect($dbinit->server, $dbinit->username, $dbinit->password);
		mysql_select_db($dbinit->database);
		
		unset($dbinit);
		mysql_query("SET NAMES 'utf8'");
		mysql_query($query);
		mysql_close($this->links);	
	}
}
?>
<?
class db_execute_return 
{
	var $links;
	var $result;
	
	function db_execute($query)
	{
		$dbinit = new db_init();
		$this->links = mysql_connect($dbinit->server, $dbinit->username, $dbinit->password);
		mysql_select_db($dbinit->database);
		
		unset($dbinit);
		mysql_query("SET NAMES 'utf8'");
		mysql_query($query);
		
		$last_id = 0;
		$this->result = mysql_query("select LAST_INSERT_ID() as last_id",$this->links);
		
		if($row=mysql_fetch_array($this->result)){
			$last_id = $row["last_id"];
		}
		
		mysql_close($this->links); 
		return $last_id;
	}
}
?>