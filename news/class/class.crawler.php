<?php
require_once(CPATH_BASE.'/include/simple_html_dom.php');
require_once(CPATH_BASE.'/include/class_curl.php');

class gdnCrawler {
	// (int) - ID của website
	var $web_id = 0;
	
	// (str) - URL của website
	var $web_linkRoot = '';
	
	// (arr) - Mảng các chuyên mục
	var $web_categories = array();
	
	// (arr) - Mảng các URL phân trang của website theo từng chuyên mục
	var $web_pagelinks = array();
	
	// (boolen) - Lần đầu tiên lấy hay quét định kỳ
	var $first_crawl = false;
	
	// (int) - Số trang quét nhiều nhất
	var $max_pages = 20;
	
	// (int) - ID của 1 chuyên mục được lựa chọn (nếu ko có sẽ lấy tất cả)
	var $set_catid = 0;
	
	// (arr) - Log của bước lấy links từ website
	var $log_links = array();
	
	// (arr) - Log của bước lấy dữ liệu từ website
	var $log_crawl = array();
	
	// (arr) - Log của bước lọc nội dung các bài đã lấy
	var $log_content = array();
	
	function __construct($web_id=0)
	{
		global $db;
		$sql = 'SELECT link '
			.' FROM web_source'
			.' WHERE id ='.$web_id;
		$webSource = $db->database_fetch_assoc( $db->database_query($sql) );
		
		if (!$webSource['link']) return false;
		
		$this->web_id = $web_id;
		$this->web_linkRoot = $webSource['link'];
		
		return ;
	}
	
	// Lấy các chuyên mục của website, lấy đường link cuối cùng đã crawl (nếu định kỳ)
	function getAllCategories()
	{
		global $db;
		
		$sql = 'SELECT id, category_id, name, link '
			.' FROM categories_source'
			.' WHERE web_id='.$this->web_id.' AND published=1'
			.' ORDER BY ordering';
		$results = $db->database_query($sql);
		
		while ($row = $db->database_fetch_assoc($results)){
			$this->web_categories[ $row['id'] ] = $row;
			$arrCatID[] = $row['id'];
		}
		
		if ($this->first_crawl) return true;
		// Lay link cuoi cung da crawl cua Category
		$sql = $db->database_query('SELECT * FROM last_crawl WHERE catid IN ('.implode(",", $arrCatID).')');
		while ($row = $db->database_fetch_assoc($sql)){
			$this->web_categories[ $row['catid'] ]['last_link'] = $row['link'];
		}
		
		unset($arrCatID, $row);
		return true;
	}
	
	// Lấy quy luật URL của các chuyên mục
	function getPages()
	{
		return ;
	}
	
	// Lấy các URL của bài viết
	function getLinks()
	{
		return ;
	}
	
	function getAllContent()
	{
		return ;
	}
	
	function getAllCrawled()
	{
		return ;
	}
	
	/*
		Lấy các links đã crawl
		$onlyNotContent: chỉ lấy những link chưa quét nội dung về
	*/
	function _getLinksCrawled($onlyNotContent=false)
	{
		global $db;
		
		$where = '';
		if ($this->set_catid) $where .= ' AND source_category_id='.$this->set_catid;
		else if ($this->web_id) $where .= ' AND source_web_id='.$this->web_id;
		if ($onlyNotContent) $where .= ' AND source_introtext IS NULL AND source_linkdie=0 AND up2server=0 ';
		
		$sql = "SELECT id, source_category_id, source_link FROM content WHERE source_linkdie<>1 ".$where." ORDER BY id DESC";
		
		$results = $db->database_query($sql);
		$links = array();
		
		while ($row = $db->database_fetch_assoc($results)){
			if ($onlyNotContent) $links[] = $row;
			else $links[] = $row['source_link'];
		}
		return $links;
	}
	
	function _getFolderImg($catID)
	{
		global $db;
		
		$sql = "
			SELECT categories.id AS cat_id, categories.title AS cat_title, sections.id AS sec_id, sections.title AS sec_title 
			FROM categories_source 
			LEFT JOIN categories ON categories.id = categories_source.category_id
			LEFT JOIN sections ON sections.id = categories.section
			WHERE categories_source.id = ".(int) $catID;
		$arr = $db->database_fetch_assoc( $db->database_query($sql) );
		$arr['folderImg'] = JFilterInput::stringURLSafe($arr['sec_title'], true).'/'.JFilterInput::stringURLSafe($arr['cat_title'], true).'/';
		return $arr;
	}	
	
	function _getContent($contentLink)
	{
		return ;
	}
	
	function _getLinksInPage($pageLink, $page, $catID)
	{
		return ;
	}
	
	function _insertLink($url, $catID, $title='', $source_linkdie=0)
	{
		global $db;
		if (trim($url)) $url = trim($url);
		else return false;
		
		$sql = "INSERT INTO content (title, source_web_id, source_category_id, source_link, source_linkdie) VALUES ('".($title?$this->convertQuote($title):"")."', '".$this->web_id."', '".$catID."', '".$url."', '$source_linkdie')";
		$result = $db->database_query($sql);
		return $result;
	}
	
	function _saveContent($articles, $source_link)
	{
		global $db;
		if (!is_array($articles) || empty($articles)) return false;

		$articles['fulltext'] 	= $this->convertUnicode($articles['fulltext']);
		$articles['introtext'] 	= $this->convertUnicode($articles['introtext']);
		$articles['title'] 		= strip_tags($this->convertUnicode($articles['title']));
		
		$sql = "
			UPDATE content SET 
				title				='".$this->convertQuote($articles['title'])."', 
				source_time			=".(int) $articles['time'].", 
				source_introtext	='".$this->convertQuote($articles['introtext'])."', 
				source_fulltext		='".$this->convertQuote($articles['fulltext'])."'
			WHERE source_link			='".$source_link."'
		";
		
		$result = $db->database_query($sql);

		return $result;
	}
	
	function _filterImgs(& $fullcontent, $contentID, $img_path)
	{
		return ;
	}
	
	function _filterImg($imgUrl)
	{
		$size =@getimagesize($imgUrl);
		if ($size[0] > 100 || $size[1] > 100) return true;
		return false;
	}
	
	function _convertTime($timeString)
	{
		return ;
	}	
	
	/*function _convertTime($timeString)
	{
		$format = "%d/%m/%Y %T";
		$arrTime = strptime($timeString,$format);
		$timeStamp = mktime($arrTime['tm_hour'], $arrTime['tm_min'],$arrTime['tm_sec'],$arrTime['tm_mon']+1,$arrTime['tm_mday'],$arrTime['tm_year']+1900);
		return $timeStamp;
	}*/
	
	function _cleanContent($str)
	{
		$filter = & JFilterInput::getInstance(array('a','input','select','font','span'), null, 1, 1);
		
		$str = $filter->clean($str);

		return $str;
	}
	
	function _rel2abs($rel, $base='')
	{
		if (!$base) $base = $this->web_linkRoot;
		
	    /* return if already absolute URL */
	    if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;
	
	    /* queries and anchors */
	    if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;
	
	    /* parse base URL and convert to local variables: $scheme, $host, $path */
	    extract(parse_url($base));
	
	    /* remove non-directory element from path */
	    $path = preg_replace('#/[^/]*$#', '', $path);
	    
	    /* destroy path if relative url points to root */
	    if ($rel[0] == '/') $path = '';
	
	    /* dirty absolute URL */
	    $abs = "$host$path/$rel";
	    
	    /* replace '//' or '/./' or '/foo/../' with '/' */
	    $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
	    for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}
	
	    /* absolute URL is ready! */
	    return $scheme.'://'.$abs;
	}
	
	
	function clean()
	{
		unset($this->web_categories, $this->web_pagelinks, $this->log_links, $this->log_crawl, $this->log_content);
		return ;
	}
	
	function convertQuote($str)
	{
		return mysql_real_escape_string($str);
	}
	
	function convertUnicode($str)
	{
		$trans = array(
			"&#225;" => "á", 
			"&#224;" => "à", 
			"&#7843;" => "ả", 
			"&#227;" => "ã", 
			"&#7841;" => "ạ", 
			"&#259;" => "ă", 
			"&#7855;" => "ắ", 
			"&#7857;" => "ằ", 
			"&#7859;" => "ẳ", 
			"&#7861;" => "ẵ", 
			"&#7863;" => "ặ", 
			"&#226;" => "â", 
			"&#7845;" => "ấ", 
			"&#7847;" => "ầ", 
			"&#7849;" => "ẩ", 
			"&#7851;" => "ẫ", 
			"&#7853;" => "ậ", 
			"&#233;" => "é", 
			"&#232;" => "è", 
			"&#7867;" => "ẻ", 
			"&#7869;" => "ẽ", 
			"&#7865;" => "ẹ", 
			"&#234;" => "ê", 
			"&#7871;" => "ế", 
			"&#7873;" => "ề", 
			"&#7875;" => "ể", 
			"&#7877;" => "ễ", 
			"&#7879;" => "ệ", 
			"&#237;" => "í", 
			"&#236;" => "ì", 
			"&#7881;" => "ỉ", 
			"&#297;" => "ĩ", 
			"&#7883;" => "ị", 
			"&#243;" => "ó", 
			"&#242;" => "ò", 
			"&#7887;" => "ỏ", 
			"&#245;" => "õ", 
			"&#7885;" => "ọ", 
			"&#244;" => "ô", 
			"&#7889;" => "ố", 
			"&#7891;" => "ồ", 
			"&#7893;" => "ổ", 
			"&#7895;" => "ỗ", 
			"&#7897;" => "ộ", 
			"&#417;" => "ơ", 
			"&#7899;" => "ớ", 
			"&#7901;" => "ờ", 
			"&#7903;" => "ở", 
			"&#7905;" => "ỡ", 
			"&#7907;" => "ợ", 
			"&#250;" => "ú", 
			"&#249;" => "ù", 
			"&#7911;" => "ủ", 
			"&#361;" => "ũ", 
			"&#7909;" => "ụ", 
			"&#432;" => "ư", 
			"&#7913;" => "ứ", 
			"&#7915;" => "ừ", 
			"&#7917;" => "ử", 
			"&#7919;" => "ữ", 
			"&#7921;" => "ự", 
			"&#253;" => "ý", 
			"&#7923;" => "ỳ", 
			"&#7927;" => "ỷ", 
			"&#7929;" => "ỹ", 
			"&#7925;" => "ỵ", 
			"&#273;" => "đ", 
			"&#193;" => "Á", 
			"&#192;" => " ﻿À", 
			"&#7842;" => "Ả", 
			"&#195;" => "Ã", 
			"&#7840;" => "Ạ", 
			"&#258;" => "Ă", 
			"&#7854;" => "Ắ", 
			"&#7856;" => "Ằ", 
			"&#7858;" => "Ẳ", 
			"&#7860;" => "Ẵ", 
			"&#7862;" => "Ặ", 
			"&#194;" => "Â", 
			"&#7844;" => "Ấ", 
			"&#7846;" => "Ầ", 
			"&#7848;" => "Ẩ", 
			"&#7850;" => "Ẫ", 
			"&#7852;" => "Ậ", 
			"&#201;" => "É", 
			"&#200;" => "È", 
			"&#7866;" => "Ẻ", 
			"&#7868;" => "Ẽ", 
			"&#7864;" => "Ẹ", 
			"&#202;" => "Ê", 
			"&#7870;" => "Ế", 
			"&#7872;" => "Ề", 
			"&#7874;" => "Ể", 
			"&#7876;" => "Ễ", 
			"&#7878;" => "Ệ", 
			"&#205;" => "Í", 
			"&#204;" => "Ì", 
			"&#7880;" => "Ỉ", 
			"&#296;" => "Ĩ", 
			"&#7882;" => "Ị", 
			"&#211;" => "Ó", 
			"&#210;" => "Ò", 
			"&#7886;" => "Ỏ", 
			"&#213;" => "Õ", 
			"&#7884;" => "Ọ", 
			"&#212;" => "Ô", 
			"&#7888;" => "Ố", 
			"&#7890;" => "Ồ", 
			"&#7892;" => "Ổ", 
			"&#7894;" => "Ỗ", 
			"&#7896;" => "Ộ", 
			"&#416;" => "Ơ", 
			"&#7898;" => "Ớ", 
			"&#7900;" => "Ờ", 
			"&#7902;" => "Ở", 
			"&#7904;" => "Ỡ", 
			"&#7906;" => "Ợ", 
			"&#218;" => "Ú", 
			"&#217;" => "Ù", 
			"&#7910;" => "Ủ", 
			"&#360;" => "Ũ", 
			"&#7908;" => "Ụ", 
			"&#431;" => "Ư", 
			"&#7912;" => "Ứ", 
			"&#7914;" => "Ừ", 
			"&#7916;" => "Ử", 
			"&#7918;" => "Ữ", 
			"&#7920;" => "Ự", 
			"&#221;" => "Ý", 
			"&#7922;" => "Ỳ", 
			"&#7926;" => "Ỷ", 
			"&#7928;" => "Ỹ", 
			"&#7924;" => "Ỵ", 
			"&#272;" => "Ð"
		);
		$str = strtr($str, $trans);
		return $str;
	}
}
?>