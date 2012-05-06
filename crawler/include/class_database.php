<?php



class SEDatabase
{
	// INITIALIZE VARIABLES
	var $database_connection;		                // VARIABLE REPRESENTING DATABASE LINK IDENTIFIER
  
  var $_last_query;
  
  var $_last_resource;
  
  var $root_folder;





  
  //
	// THIS METHOD CONNECTS TO THE SERVER AND SELECTS THE DATABASE
  //
	// INPUT:
  //    $database_host REPRESENTING THE DATABASE HOST
	//	  $database_username REPRESENTING THE DATABASE USERNAME
	//	  $database_password REPRESENTING THE DATABASE PASSWORD
	//	  $database_name REPRESENTING THE DATABASE NAME
  //
	// OUTPUT:
  //    void
  //
  
	function SEDatabase($database_host, $database_username, $database_password, $database_name)
  {
    global $user, $global_plugins;
    
    // GET THE SOCIALENGINE ROOT
    $this->root_folder = dirname(dirname(realpath(__FILE__)));
    
	  $this->database_connection = $this->database_connect($database_host, $database_username, $database_password) or die($this->database_error());
	  $this->database_select($database_name) or die($this->database_error());
	}
  
  // END se_database() METHOD





  
  //
	// THIS METHOD CONNECTS TO THE SERVER AND SELECTS THE DATABASE
  //
	// INPUT:
  //    void
  //
	// OUTPUT:
  //    instance of this class
  //
  
	function &getInstance()
  {
    global $database, $database_host, $database_username, $database_password, $database_name;
    static $db;
    
    if( !is_a($db, 'SEDatabase') )
    {
      // Backwards compatibility
      if( is_a($database, 'SEDatabase') )
      {
        $db =& $database;
      }
      
      // Instantiate
      else
      {
        $db = new SEDatabase($database_host, $database_username, $database_password, $database_name);
        $database =& $db;
      }
    }
    
    return $db;
  }
  
  // END getInstance() METHOD







  //
	// THIS METHOD CONNECTS TO A DATABASE SERVER
  //
	// INPUT:
  //    $database_host REPRESENTING THE DATABASE HOST
	//	  $database_username REPRESENTING THE DATABASE USERNAME
	//	  $database_password REPRESENTING THE DATABASE PASSWORD
  //
	// OUTPUT:
  //    RETURNS A DATABASE LINK IDENTIFIER
  //
  
	function database_connect($database_host, $database_username, $database_password)
  {
	  return mysql_connect($database_host, $database_username, $database_password, TRUE);
	}
  
  // END database_connect() METHOD








  //
	// THIS METHOD SELECTS A DATABASE
  //
	// INPUT:
  //    $database_name REPRESENTING THE DATABASE NAME
  //
	// OUTPUT:
  //    RETURNS OUTPUT FOR DATABASE SELECTION
  //
  
	function database_select($database_name)
  {
	  return mysql_select_db($database_name, $this->database_connection);
	} 
  
  // END database_select() METHOD








	// THIS METHOD QUERIES A DATABASE
	// INPUT: $database_query REPRESENTING THE DATABASE QUERY TO RUN
	// OUTPUT: RETURNS A DATABASE QUERY RESULT RESOURCE
	function database_query($database_query)
  {
    // EXECUTE QUERY
    $query_result = mysql_query($database_query, $this->database_connection);
    
    // RETURN
	  return $query_result;
	}
  
  // END database_query() METHOD







  
  //
	// THIS METHOD FETCHES A ROW AS A NUMERIC ARRAY
  //
	// INPUT:
  //    $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
  //
	// OUTPUT:
  //    RETURNS A NUMERIC ARRAY FOR A DATABASE ROW
  //
  
	function database_fetch_array($database_result)
  {
    if( !is_resource($database_result) ) return FALSE;
	  return mysql_fetch_array($database_result, MYSQL_NUM);
	}
  
  // END database_fetch_array() METHOD








  //
	// THIS METHOD FETCHES A ROW AS AN ASSOCIATIVE ARRAY
  //
	// INPUT:
  //    $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
  //
	// OUTPUT:
  //    RETURNS AN ASSOCIATIVE ARRAY FOR A DATABASE ROW
  //
  
	function database_fetch_assoc($database_result)
  {
    if( !is_resource($database_result) ) return FALSE;
	  return mysql_fetch_assoc($database_result);
	}
  
  // END database_fetch_assoc() METHOD








  //
	// THIS METHOD RETURNS THE NUMBER OF ROWS IN A RESULT
  //
	// INPUT:
  //    $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
  //
	// OUTPUT:
  //    RETURNS THE NUMBER OF ROWS IN A RESULT
  //
  
	function database_num_rows($database_result)
  {
    if( !is_resource($database_result) ) return FALSE;
	  return mysql_num_rows($database_result);
	}
  
  // END database_num_rows() METHOD








  //
	// THIS METHOD RETURNS THE NUMBER OF ROWS IN A RESULT
  //
	// INPUT:
  //    $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
  //
	// OUTPUT:
  //    RETURNS THE NUMBER OF ROWS IN A RESULT
  //
  
	function database_affected_rows()
  {
	  return mysql_affected_rows($this->database_connection);
	}
  
  // END database_affected_rows() METHOD 








  //
	// THIS METHOD FREES THE RESULT
  //
	// INPUT:
  //    $database_result REPRESENTING A DATABASE QUERY RESULT RESOURCE
  //
	// OUTPUT:
  //    TRUE on success, else FALSE
  //
  
	function database_free_result($database_result)
  {
	  return mysql_free_result($database_result);
	}
  
  // END database_free_result() METHOD 








  //
	// THIS METHOD SETS THE CLIENT CHARACTER SET FOR THE CURRENT CONNECTION
  //
	// INPUT:
  //    $charset REPRESENTING A VALID CHARACTER SET NAME
  //
	// OUTPUT:
  //    RESOURCE OR FALSE
  //
  
	function database_set_charset($charset)
  {
	  if( function_exists('mysql_set_charset') === TRUE )
    {
	    return mysql_set_charset($charset, $this->database_connection);
	  }
    else
    {
	    return $this->database_query('SET NAMES "'.$charset.'"');
	  }
	}
  
  // END database_set_charset() METHOD 








  //
	// THIS METHOD ESCAPES SPECIAL CHARACTERS IN A STRING FOR USE IN AN SQL STATEMENT
  //
	// INPUT:
  //    $unescaped_string REPRESENTING THE STRING TO ESCAPE
  //
	// OUTPUT: 
  //    Escaped string
  //
  
	function database_real_escape_string($unescaped_string)
  {
	  return mysql_real_escape_string($unescaped_string, $this->database_connection);
	}
  
  // END database_real_escape_string() METHOD 








  //
	// THIS METHOD RETURNS THE ID GENERATED FROM THE PREVIOUS INSERT OPERATION
  //
	// INPUT: 
  //    void
  //
	// OUTPUT:
  //    RETURNS THE ID GENERATED FROM THE PREVIOUS INSERT OPERATION
  //
  
	function database_insert_id()
  {
	  return mysql_insert_id($this->database_connection);
	}
  
  // END database_insert_id() METHOD








  //
	// THIS METHOD RETURNS THE DATABASE ERROR
  //
	// INPUT: 
  //    void
  //
	// OUTPUT: 
  //    The error message for the last failed query
  //
  
	function database_error()
  {
	  return mysql_error($this->database_connection);
	}
  
  // END database_error() METHOD








  //
	// THIS METHOD RETURNS ALL RETURNED DATA FOR THE LAST QUERY
  //
	// INPUT: 
  //    void
  //
	// OUTPUT: 
  //    An array of all returned data for the last query
  //
  
	function database_load_all()
  {
    if( !is_resource($this->_last_resource) )
    {
      return FALSE;
    }
    
    $resource = $this->_last_resource;
    $return_data = array();
    while( $data = $this->database_fetch_assoc($resource) )
    {
      $return_data[] = $data;
    }
    
    return $return_data;
	}
  
  // END database_load_all() METHOD








  //
	// THIS METHOD RETURNS ALL RETURNED DATA FOR THE LAST QUERY IN AN ASSOC
  // ARRAY USING THE COLUMN SPECIFIED AS THE KEY
  //
	// INPUT: 
  //    $key_column - to use as assoc index
  //
	// OUTPUT: 
  //    The error message for the last failed query
  //
  
	function database_load_all_assoc($key_column)
  {
    if( !is_resource($this->_last_resource) )
    {
      return FALSE;
    }
    
    $resource = $this->_last_resource;
    $return_data = array();
    while( $data = $this->database_fetch_assoc($resource) )
    {
      $return_data[$data[$key_column]] = $data;
    }
    
    return $return_data;
	}
  
  // END database_load_all_assoc() METHOD








  //
	// THIS METHOD CLOSES A CONNECTION TO THE DATABASE SERVER
  //
	// INPUT: 
  //  void
  //
	// OUTPUT:
  //    Connection closure result
  //
  
	function database_close()
  {
    
	  return mysql_close($this->database_connection);
	}
  
  // END database_close() METHOD








  //
	// THIS METHOD SORT THE BENCHMARKS BY TIME
  //
	// INPUT: 
  //    void
  //
	// OUTPUT: 
  //    void
  //
  
  //
	// THIS METHOD GETS MYSQL CLIENT INFO
  //
	// INPUT:
  //    void
  //
	// OUTPUT:
  //    http://us2.php.net/manual/en/function.mysql-get-client-info.php
  //
  
	function database_get_client_info()
  {
	  return ( function_exists('mysql_get_client_info') ? mysql_get_client_info() : FALSE );
	}
  
  // END database_get_client_info() METHOD 








  //
	// THIS METHOD GETS MYSQL HOST INFO
  //
	// INPUT:
  //    void
  //
	// OUTPUT:
  //    http://us2.php.net/manual/en/function.mysql-get-host-info.php
  //
  
	function database_get_host_info()
  {
	  return ( function_exists('mysql_get_host_info') ? mysql_get_host_info($this->database_connection) : FALSE );
	}
  
  // END database_get_host_info() METHOD 








  //
	// THIS METHOD GETS MYSQL PROTOCOL INFO
  //
	// INPUT:
  //    void
  //
	// OUTPUT:
  //    http://us2.php.net/manual/en/function.mysql-get-proto-info.php
  //
  
	function database_get_proto_info()
  {
	  return ( function_exists('mysql_get_proto_info') ? mysql_get_proto_info($this->database_connection) : FALSE );
	}
  
  // END database_get_proto_info() METHOD 








  //
	// THIS METHOD GETS MYSQL SERVER INFO
  //
	// INPUT:
  //    void
  //
	// OUTPUT:
  //    http://us2.php.net/manual/en/function.mysql-get-server-info.php
  //
  
	function database_get_server_info()
  {
	  return ( function_exists('mysql_get_server_info') ? mysql_get_server_info($this->database_connection) : FALSE );
	}
  
  // END database_get_server_info() METHOD 
  
}




//BACKWARDS COMPATIBILITY
class se_database extends SEDatabase { }




?>