<?
//function lấy khối html
function get_url_html($url)
{
	$ini = curl_init($url);
   curl_setopt($ini, CURLOPT_HEADER, false);
   $userAgent  = sprintf("Mozilla/%d.0",rand(4,5));
   curl_setopt($ini, CURLOPT_USERAGENT, $userAgent);
	curl_setopt($ini, CURLOPT_RETURNTRANSFER, true);
	
	$result 	= curl_exec($ini);
   unset($ini);
   
	$html 	= str_get_html($result); 
	return $html;
}

/*Function lấy các link con từ link tổng
	1. $html: khối html truyền vào
	2. $type_forum: loại diễn đàn (vi dụ: vBulletin)
	3. $site_name: tên diễn đàn (gồm cả đuôi .com .net ...)
*/
function get_sub_link($html, $site_name)
{
	switch($site_name){
		case "oto-hui.com":
			$arrayReturn = array();
			$sublink = $html->find("a[id*=thread_title]");
			foreach($sublink as $link){
            	$arrayReturn[]  = array(break_url_forum($link->href), $link->plaintext);  
         	}
			break;
			
		case "oto365.net":
			$arrayReturn = array();
			$sublink = $html->find("a[id*=thread_title]");
			foreach($sublink as $link){
            	$arrayReturn[]  = array(break_url_forum($link->href), $link->plaintext);  
         	}
			break;
			
		case "aha.vn": 
			$arrayReturn = array();
			$sublink = $html->find("div.topicName a");
			foreach($sublink as $link){
            	$arrayReturn[]  = array(break_url_forum($link->href), $link->plaintext);  
         	}
			break;
			
		case "otoxomnhala.com": 
			$site_name = str_replace("http://","",$site_name);
			$site_name = "http://" . $site_name;
			$site_name = str_replace("http://www.","http://",$site_name) . "/forums/";
			$arrayReturn = array();
			$sublink = $html->find("a[id*=thread_title]");
			foreach($sublink as $link){
            	$arrayReturn[]  = array(break_url_forum($site_name . $link->href), $link->plaintext);  
         	}
			break;
			
		default: 
			$site_name = str_replace("http://","",$site_name);
			$site_name = "http://" . $site_name;
			$site_name = str_replace("http://www.","http://",$site_name) . "/";
			$arrayReturn = array();
			$sublink = $html->find("a[id*=thread_title]");
			foreach($sublink as $link){
            	$arrayReturn[]  = array(break_url_forum($site_name . $link->href), $link->plaintext);  
         	}
			break;
	}
	return $arrayReturn;
}

function break_url_forum($url){
   $arrURL = explode("?",$url);
   $new_url = $arrURL[0] . "?";

   $string = isset($arrURL[1]) ? $arrURL[1] : "";
   //echo  $string . "<br>";
   $arrURL = explode('&amp;',$string);
   foreach($arrURL as $key=>$value){
      if(strpos($value,"s=") === false){
        $new_url .= $value;
      }
   }
   return $new_url;
}

//function lấy tiêu đề bài post
function get_post_title($html, $site_name)
{
	switch($site_name)
	{ 
		case "oto365.net": 
			$title = $html->find('h2[class="title icon"]', 0);
			$title = $title->plaintext;
			break;
			
		case "danmexe.net": 
			$title = $html->find('h2[class="title icon"]', 0);
			$title = $title->plaintext;
			break;
			
		case "aha.vn": 
			$title = $html->find("tr[id=topicTitle] b", 0);
			$title = $title->plaintext;
			$title = str_replace("Chủ đề:", "", $title);
			break;
			
		case "oto-hui.com": 
			$title = $html->find('h2[class="title icon"]', 0);
			$title = $title->plaintext;
			break;
			
		case "otofun.net": 
			$title = $html->find('h2[class="posttitle icon"]', 0);
			$title = $title->plaintext;
			break;
			
		default: 
			$title = $html->find("div.smallfont strong", 0);
			$title = $title->plaintext;
			break;
	}
	return $title;
}

//function lấy nội dung bài viết và các comment
function get_post_comment($html, $site_name)
{
	switch($site_name)
	{
		case "aha.vn": 
			$comment = $html->find("div.postContent");
			for($i=0; $i<count($comment); $i++)
				{
					$comment[$i] = $comment[$i]->plaintext;
				}	
			break;
		
		default: 
			$comment = $html->find("div[id*=post_message]");
			for($i=0; $i<count($comment); $i++)
				{
					$comment[$i] = $comment[$i]->plaintext;
				}	
			break;
	}
	return $comment;
}

//function lấy ngày post comment
function get_post_date($html, $site_name)
{
	switch($site_name)
	{
		case "oto365.net":
			$date = $html->find("span[class=date]");	
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], 0, 10);
			}
			break;

		case "danmexe.net":
			$date = $html->find("span[class=date]");	
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], 0, 10);
			}
			break;
			
		case "aha.vn":
			$date = $html->find("td[align=right]");	
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], strlen($date[$i])-10, strlen($date[$i]));
			}
			break;
			
		case "oto-hui.com":
			$date = $html->find("span[class=date]");	
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], 0, 10);
			}
			break;
			
		case "otofun.net":
			$date = $html->find("span[class=date]");	
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], 0, 10);
			}
			break;	
		
		case "otoxomnhala.com":
			$text = $html->find("td[class=thead]");
			$j=0;
			for($i=0; $i<count($text) - 3; $i++)
				for($x=0; $x<count($text); $x++)
				{
					if($i == 3*$x)
					{
						$date[$j] = $text[$i];
						$j++;
					}
				}
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], 0, 10);
			}
			break;
		
		default:
			$date = array();					
			$text = $html->find("td.thead div.normal");
			$j=0;
			for($i=0; $i<count($text); $i++)
			{
				if($i%2 == 1)
				{
					$date[$j] = $text[$i];
					$j++;
				}
			}
			for($i=0; $i<count($date); $i++)
			{
				$date[$i] = $date[$i]->plaintext;
				$date[$i] = trim($date[$i]);
				$date[$i] = substr($date[$i], 0, 10);
			}
			break;
	}
	
	for($i=0; $i<count($date); $i++)
	{
		$str = "ôm nay";
		$e = strpos($date[$i], $str);
		if($e != false)
		{
			$date[$i] = time("d-m-Y");
		}
		$str = "ôm qua";
		$e = strpos($date[$i], $str);
		if($e != false)
		{
			$date[$i] = time((time("d") - 1) . "-m-Y");
		}
		$date[$i] =  convertDateTime($date[$i]);
	}
	return $date;
}

//function bỏ biến session trong sublink
function remove_session($url)
{
	$start 	= strpos($url, "s=");
	$end	= strpos($url, "&");
	$part1	= substr($url, 0, $start);
	$part2	= substr($url, $end+1);
	$url	= $part1 . $part2;
	return $url;
}

//function lấy số page của số 
function get_page($html, $site_name)
{
	switch($site_name)
	{
		case "ddth.com":
			$page 	= $html->find("td.vbmenu_control", 0);
			$page 	= trim($page->plaintext);
			$start 	= strpos($page, "/");
			$page 	= substr($page, $start+1);
			intval($page);
			break;
		
	}
	return $page;
}	
?>