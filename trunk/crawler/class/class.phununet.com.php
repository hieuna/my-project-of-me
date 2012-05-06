<?php
require_once('class.crawler.php');

class crawl_phununet_com extends gdnCrawler {	
	function __construct()
	{
		global $db;
		set_time_limit(0);
		$this->web_id 		= 4;
		$this->web_linkRoot = 'http://www.phununet.com';
		return ;
	}
	
	function getPages()
	{
		if (!count($this->web_categories)) return false;
		
		foreach ($this->web_categories as $category){
			if ($this->set_catid && $this->set_catid!=$category['id']) continue;
			
			$this->web_pagelinks[ $category['id'] ] = $category['link'];
		}
		return ;
	}
	
	function getLinks()
	{
		if (!count($this->web_pagelinks)) return false;
		foreach ($this->web_pagelinks as $catID => $pageLink){
			if ($this->set_catid && $this->set_catid!=$catID) continue;
			
			$getLinks = $this->_getLinksInPage($pageLink, $catID);
		}
		return ;
	}
	
	function getAllContent()
	{
		$webLinks = $this->_getLinksCrawled(true);
		if (!count($webLinks)) return true;

		foreach ($webLinks as $content){
			if ($this->set_catid && $this->set_catid!=$content['source_category_id']) continue;
			
			// Lấy các trường thông tin từ 1 URL
			$articles = $this->_getContent($content['source_link']);
			
			// Lưu các trường thông tin nhận được
			if ($articles)
				$saveContent = $this->_saveContent($articles, $content['source_link']);
			
			//Ghi logs
			$log = 'Catetory ID '.$content['source_category_id'].': <a href='.$content['source_link'].' target="_blank">'.$articles['title'].' >></a>';
			if ( $saveContent ) $this->log_crawl[] = '<font color="blue">'.$log.'</font>';
			else $this->log_crawl[] = '<font color="red">'.$log.' [ERROR]</font>';
		}
		unset($articles);
		return ;
	}
	
	function getAllCrawled()
	{
		global $db;
		
		if (!count($this->web_categories)) return false;
		foreach ($this->web_categories as $category){
			if ($this->set_catid && $this->set_catid!=$category['id']) continue;
			// Lấy thông tin category và section của GDN news, đường dẫn của thư mục chứa ảnh
			$chuyenmuc = $this->_getFolderImg($category['id']);
			
			// Lấy các tin chưa được lọc nội dung
			$sql = "SELECT id, title, source_time, source_introtext, source_fulltext FROM content WHERE source_category_id={$category['id']} AND introtext ='' AND source_linkdie=0 AND up2server=0";
			$results = $db->database_query($sql);

			while ($row = $db->database_fetch_assoc($results)){

				// New Image Path: {section_name}/{category_name}/{content_id}_{content_title}.jpg
				$img_path = $chuyenmuc['folderImg'].$row['id']."_".JFilterInput::stringURLSafe($row['title'], true);
				
				// Loc lay cac anh trong bai viet
				$this->_filterImgs($row['source_fulltext'], $row['id'], $img_path, $row['title']);
				
				// Lam sach noi dung bai viet
				$row['source_fulltext'] 	= str_replace("'","\'", $this->_cleanContent($row['source_fulltext']));
				$row['source_introtext'] 	= str_replace("'","\'", strip_tags($row['source_introtext']));
				$row['title'] 				= str_replace("'","\'", $row['title']);
				/*
				if (strpos($row['source_introtext'],'(Xinh xinh) - ')!==false){
					$row['source_introtext'] = str_replace('(Xinh xinh) - ','',$row['source_introtext']);
					$row['source_fulltext'] .= '<div style="font-weight: bold" align="right">Theo Xinhxinh</div>';
				}
				*/
				// Lưu các trường sau khi xử lý từ nội dung gốc
				$update = $db->database_query("
					UPDATE content SET introtext='{$row['source_introtext']}', full_text='{$row['source_fulltext']}', sectionid={$chuyenmuc['sec_id']}, catid={$chuyenmuc['cat_id']}, created='{$row['source_time']}' WHERE id={$row['id']}
				");
				
				// Ghi logs
				$log = 'Catetory ID '.$category['id'].': '.$row['title'];
				if ( $update ) $this->log_content[] = '<font color="blue">'.$log.'</font>';
				else $this->log_content[] = '<font color="red">'.$log.' [ERROR]</font>';
			}
		}
		unset($fulltext, $new_introtext, $img_path, $row);
		return ;
	}
	
	function _getLinksInPage($pageLink, $catID)
	{
		global $db;	
	
		$html = file_get_html($pageLink);
		
		$a_find = 'a[id^=CacTinKhacChuyenMucCon]';

		// Nếu ko tìm thấy link, tức là trang rỗng
		if ($html->find($a_find,0)  == null)
		{
			$html->clear();
			return false;
		}
		
		// Lưu link gần nhất
		$newest_url = $this->_rel2abs($html->find($a_find,0)->href);

		if ($db->database_num_rows($db->database_query("SELECT NULL FROM last_crawl WHERE catid=$catID"))==0){
			$db->database_query("INSERT INTO last_crawl (catid, link, time) VALUES ($catID, '".$this->convertQuote($newest_url)."', '".date("Y-m-d H:i:s")."')");
		}
		else {
			$db->database_query("UPDATE last_crawl SET link='".$this->convertQuote($newest_url)."', time='".date("Y-m-d H:i:s")."' WHERE catid=$catID");
		}

		foreach ($html->find($a_find) as $element){
			$url = $this->_rel2abs($element->href);
			$title = trim(htmlspecialchars_decode($this->convertUnicode(trim($element->plaintext))));
			
			if ($url==$this->web_categories[$catID]['last_link'])
			{
				$html->clear();
				return false;
			}
			
			if (!$title || $title=='Đọc tiếp >') continue;
			
			//Check Avaiabled
			$check = $db->database_query('SELECT NULL FROM content WHERE title=\''.$this->convertQuote($title).'\' OR source_link=\''.$this->convertQuote($url).'\' LIMIT 1');
			$avai = ($db->database_num_rows($check)==1)?1:0;
			
			$insert = $this->_insertLink($url, $catID, $title, $avai);
			
			// Ghi logs
			$log = 'Catetory ID '.$catID.': <a href="'.$url.'" target="_blank">'.$url.'</a>';
			if ( $insert ) $this->log_links[] = '<font color="blue">'.$log.'</font>';
			else $this->log_links[] = '<font color="red">'.$log.' [ERROR]</font>';

		}
		
		unset($links_crawled);
		$html->clear();
		return true;
	}
	
	function _getContent($contentLink)
	{
		// Create DOM from URL

		$html = file_get_html($contentLink);
		
		$article = $html->find('div[id=divDetails]',0);
		
		// Nếu link bị die
		if (!is_object($article)) return false;
		
		// Chuyển toàn bộ link về tuyệt đối
		foreach ($article->find('*[src], *[href]') as $uri){
			if ( $uri->hasAttribute('src') ) $uri->src = $this->_rel2abs($uri->src, $contentLink);
			else $uri->href = $this->_rel2abs($uri->href, $contentLink);
		}
		
		// Lọc ra các trường thông tin cần
	    $item['title']     	= trim($article->find('span[id=Center_3_1_lblTitle]', 0)->plaintext);
	    $item['time']     	= $this->_convertTime(trim($article->find('span[id=Center_3_1_lblDate]', 0)->plaintext));
	    $item['introtext']  = trim($article->find('span[id=Center_3_1_lblSummary]', 0)->plaintext);
	    $item['fulltext'] 	= trim($article->find('span[id=Center_3_1_lblDetails]',0)->innertext);
	    $item['fulltext'] 	.= '<div style="font-weight: bold" align="right">'.$article->find('span[id=Center_3_1_lblAuthor]',0)->plaintext.'</div>';

	    $html->clear();
	    unset($article);
		return $item;
	}
	
	function _filterImgs(& $fullcontent, $contentID, $img_path, $title)
	{
		global $db;

		$html = str_get_html($fullcontent);
		$i=0;
		$first_img_src = '';
		foreach ($html->find('img') as $img){

			// Lọc lấy các ảnh cần lưu
			/*
			if ( $this->_filterImg($img->src)==false ){
				$fullcontent = str_replace($img->outertext, "", $fullcontent);
				continue;
			}
			*/
			$newSrc = '<img src="'.$img->src.'" alt="'. htmlspecialchars((isset($img->alt)?$img->alt:$title)) .'"'. (isset($img->align)?' align="'.$img->align.'"':'') .''. (isset($img->width)?' width="'.$img->width.'"':'') .''. (isset($img->height)?' height="'.$img->height.'"':'') .' />';
			$fullcontent = str_replace($img->outertext, $newSrc, $fullcontent);
				
			// Check avaiabled
			$check = $db->database_query("SELECT NULL FROM images WHERE content_id='".$contentID."' AND path_source='".$img->src."'");
			if ($db->database_num_rows($check)>0) continue;
			
			if ($i==0) $path_root = $img_path.'.jpg';
			else $path_root = $img_path.'_'.($i+1).'.jpg';
			
			$db->database_query("
				INSERT INTO images (content_id, path_source, path_root) VALUES 
				('$contentID', '".$img->src."', '".$path_root."')
			");
			$i++;
		}
		
		$html->clear();
		
		return true;
	}
	
	function _convertTime($timeString)
	{
		$temp1 = explode("/", $timeString);

		return mktime(date('H'), date('m'), date('s'), $temp1[1], $temp1[0], $temp1[2]);
	}
}
?>