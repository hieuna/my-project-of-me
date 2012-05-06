<?php
class crawlUp2Server {
	var $contents = array();
	
	var $images = array();
	
	var $content_uploaded = array();
	
	var $created_by = 0;
	
	var $attribs = null;
	
	var $server_db_host = null;
	
	var $server_db_username = null;
	
	var $server_db_password = null;
	
	var $server_db_name = null;
	
	var $timenone = null;
	
	var $db = null;
	
	var $dbServer = null;
	
	var $total_contents = 0;
	
	var $web_source_id = 0;
	
	var $web_source_name = null;
	
	var $cat_source_id = 0;
	
	var $limit_upload = 100;
	
	var $time_start = null;
	
	var $time_end = null;
	
	var $log = null;
	
	function __construct()
	{
		$this->time_start = time();
		set_time_limit(0);
		
		$this->server_db_host = 'localhost';
		$this->server_db_username = 'root';
		$this->server_db_password = 'vertrigo';
		$this->server_db_name = 'joomla15';
		$this->created_by = 63;
		$this->attribs = 'show_title=
			link_titles=
			show_intro=
			show_section=
			link_section=
			show_category=
			link_category=
			show_vote=
			show_author=
			show_create_date=
			show_modify_date=
			show_pdf_icon=
			show_print_icon=
			show_email_icon=
			language=
			keyref=
			readmore=';
		$this->timenone = '0000-00-00 00:00:00';
		
		// INITIATE DATABASE CONNECTION
		$this->db =& SEDatabase::getInstance();
		
		// SET LANGUAGE CHARSET
		$this->db->database_set_charset('utf8');
		return ;
	}
	
	function getContents()
	{
		$where = '';
		if ($this->cat_source_id){
			$where .= ' AND source_category_id='.$this->cat_source_id;
		}
		else if ($this->web_source_id){
			$where .= ' AND source_web_id='.$this->web_source_id;
		}
		
		$nextMonth = time()-2592000;
		
		// GET TOTAL
		$total = $this->db->database_query("SELECT NULL FROM content WHERE title<>'' AND introtext<>'' AND `full_text`<>'' AND source_time>$nextMonth AND source_linkdie=0 AND up2server=0 ".$where);
		$this->total_contents = $this->db->database_num_rows($total);
		
		if ($this->total_contents){
			$sql = "SELECT id, title, introtext, full_text, sectionid, catid, created, source_web_id, source_link FROM content WHERE title<>'' AND introtext<>'' AND `full_text`<>'' AND source_time>$nextMonth AND source_linkdie=0 AND up2server=0 ".$where." ORDER BY created ASC LIMIT ".$this->limit_upload;
			$results = $this->db->database_query($sql);
			
			while ($row = $this->db->database_fetch_assoc($results)){
				$this->contents[ $row['id'] ] = $row;
			}
		}

		return ;
	}
	
	function getImages()
	{		
		$sql = "SELECT * FROM images WHERE up2server=0";
		$results = $this->db->database_query($sql);
		
		while ($row = $this->db->database_fetch_assoc($results)){
			$this->images[ $row['content_id'] ][] = $row;
		}
		return ;
	}
	
	function upContents()
	{
		if (count($this->contents)<1) return false;
		
		// Close DB localhost
		$this->db->database_close();
		
		// Connect DB server
		$this->dbServer =& new SEDatabase($this->server_db_host, $this->server_db_username, $this->server_db_password, $this->server_db_name);
		if (!$this->dbServer) return false;
		
		$this->dbServer->database_set_charset('utf8');
		
		foreach ($this->contents as $contentID => $content){
			$time = date("Y-m-d H:i:s", $content['created']-28800);
			$alias = JFilterInput::stringURLSafe( $content['title'] );
			$images = ($this->images[$contentID][0]['path_root'])?'images/stories/'.$this->images[$contentID][0]["path_root"]:'';
			// UP Contest
			$sql = "
				INSERT INTO gdn_content (
					title, 
					alias, 
					introtext, 
					`fulltext`, 
					state, 
					sectionid, 
					catid, 
					created, 
					created_by, 
					publish_up, 
					images, 
					attribs, 
					version, 
					metakey, 
					metadesc, 
					metadata,
					source_link,
					source_web_id
				) VALUES (
					'".str_replace("'","\'", $content['title'])."', 
					'".$alias."', 
					'".str_replace("'","\'", $content['introtext'])."', 
					'".str_replace("'","\'", $content['full_text'])."', 
					'0', 
					'".$content['sectionid']."', 
					'".$content['catid']."', 
					'".$time."', 
					'".$this->created_by."', 
					'".$time."', 
					'".$images."', 
					'".$this->attribs."', 
					'0', 
					'', 
					'', 
					'robots=
					author=',
					'".$content['source_link']."',
					'".$content['source_web_id']."'
				)
			";
			$save = $this->dbServer->database_query($sql);
			$content_id = $this->dbServer->database_insert_id();
			if ($save && $content_id){
				$this->content_uploaded[] = array((int) $contentID, $content['title']);
				// UP Images
				for($i=0; $i<count($this->images[$contentID]); $i++){
					$this->dbServer->database_query("
						INSERT INTO gdn_crawl_images (
							content_id,
							path_source,
							path_root
						) VALUES (
							'".$content_id."',
							'".$this->images[$contentID][$i]['path_source']."',
							'".$this->images[$contentID][$i]['path_root']."'
						)
					");
				}
			}
			else {
				echo $this->dbServer->database_error();
				break;
			}
		}
		
		$this->dbServer->database_close();
		// END UP SERVER
		
		// UPDATE LOCAL
		$this->saveUploaded();
		
		return ;
	}
	
	function saveUploaded()
	{
		global $database_host, $database_username, $database_password, $database_name;
		
		if (count($this->content_uploaded)<1) return ;
		
		// INITIATE DATABASE CONNECTION
		$database_connection = mysql_connect($database_host, $database_username, $database_password, TRUE) or die(mysql_error());
	    mysql_select_db($database_name, $database_connection) or die(mysql_error());
		
		foreach ($this->content_uploaded as $content){
			$contentID[] = (int) $content[0];
		}
		$listID = implode(",", $contentID);
		
		mysql_query("UPDATE content SET up2server=1 WHERE id IN ({$listID})");
		mysql_query("UPDATE images SET up2server=1 WHERE content_id IN ({$listID})");
		
		mysql_close($database_connection);
		
		unset($contentID, $listID);
		$this->time_end = time();
		return true;
	}
	
	function getLogs()
	{
		if (count($this->content_uploaded)<1) return ;
		$this->log = '<hr style="margin: 10px;" />Crawl từ '.$this->web_source_name.' lúc '.date("H:i d/m/Y", $this->time_start).' trong '.($this->time_end-$this->time_start).' giây được '.count($this->content_uploaded).'/'.$this->total_contents.' bài:<br /><br />';
		foreach ($this->content_uploaded as $content){
			$this->log .= "<div>".$content[0].": ".$content[1]."</div>";
		}
		$this->log = ($this->log)?$this->log:'0 bài viết';
		return ;
	}
	
	function writeLogs()
	{
		$logPath = 'logs/'.$this->web_source_name;
		if (!is_dir($logPath)){
			mkdir($logPath, 0777);
			@chmod($logPath, 0777);
		}
		$logFilename = $logPath."/".date('Y-m-d H-i', $this->time_start).".html";
		$handle = fopen($logFilename, 'w');
		
		$ouput = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" id="minwidth" >
					<head>
					  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
					  <title>Thông kê kết quả crawl tin tức trang '.$this->web_source_name.' vào '.date('H:i d/m/Y', $this->time_start).'</title>
					</head>
					<body>'.$this->log.'</body></html>';
		if (fwrite($handle, $ouput) === FALSE) {
	        echo "Cannot write to file ($logFilename)";
	        exit;
	    }
		fclose($handle);
		unset($ouput);
		
		$this->writeGlobalLogs($this->log);
		return ;
	}
	
	function writeGlobalLogs($log)
	{
		$logFilename = "logs/global/".date('Y-m-d').".html";
		$ouput = '';
		if (!file_exists($logFilename)) {
			$ouput .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" id="minwidth" >
					<head>
					  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
					  <title>Thông kê kết quả crawl tin tức ngày '.date('d/m/Y').'</title>
					</head>
					<body>';
		}
		$output .= $log;
		if (!file_exists($logFilename)) {
			$ouput .= '</body></html>';
		}
		
		$handle = fopen($logFilename, 'a');
		if (fwrite($handle, $ouput) === FALSE) {
	        echo "Cannot write to file ($logFilename)";
	        exit;
	    }
		fclose($handle);
		
		unset($ouput);
		return ;
	}
	
	function clean()
	{
		unset($this->contents, $this->content_uploaded, $this->images, $this->total_contents);
		return ;
	}
}
?>