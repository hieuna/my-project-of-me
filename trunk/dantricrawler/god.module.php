<?php

function god_form_alter(&$form, &$form_state, $form_id){
  global $user;
  
  if ($form_id=='contact_mail_page'){
    $form['name']['#title'] = "Họ tên của bạn";
    $form['name']['#description'] = "";
    $form['mail']['#title'] = "Địa chỉ email";
    $form['mail']['#description'] = "Email có thực và chính xác";
    $form['subject']['#title'] = "Tiêu đề";
    $form['message']['#title'] = "Nội dung liên hệ";
    $form['submit']['#value'] = "Gửi đi";
  }
}

function god_menu(){  
  $items['god/get-news-dantri'] = array(
    'title' => 'Lấy tin',
    'page callback' => '_god_get_news_dantri',
    'page arguments' => array(2),
    'access arguments' => array('access content'),
    'type' => MENU_CALLBACK
  );
  
  $items['god/get-news-vnexpress'] = array(
    'title' => 'Lấy tin',
    'page callback' => '_god_get_news_vnexpress',
    'page arguments' => array(2),
    'access arguments' => array('access content'),
    'type' => MENU_CALLBACK
  );
  
  $items['god/get-news-ngoisao'] = array(
    'title' => 'Lấy tin',
    'page callback' => '_god_get_news_ngoisao',
    'page arguments' => array(2),
    'access arguments' => array('access content'),
    'type' => MENU_CALLBACK
  );
  
  return $items;
}

function god_cron(){
  $aLink = array(
    array('i' => 3, 'l' => 'http://vnexpress.net/gl/kinh-doanh/'),  // Kinh te
    array('i' => 4, 'l' => 'http://vnexpress.net/gl/the-gioi/'),    // The gioi
    array('i' => 4, 'l' => 'http://vnexpress.net/gl/the-thao/'),
    array('i' => 4, 'l' => 'http://vnexpress.net/gl/khoa-hoc/'),
    array('i' => 4, 'l' => 'http://vnexpress.net/gl/vi-tinh/'),
    array('i' => 1, 'l' => 'http://vnexpress.net/gl/van-hoa/'),     // Van hoa
    array('i' => 2, 'l' => 'http://vnexpress.net/gl/xa-hoi/'),      // Xa hoi
    array('i' => 8, 'l' => 'http://vnexpress.net/gl/phap-luat/'),   // Phap luat
    array('i' => 15, 'l' => 'http://vnexpress.net/gl/doi-song/'),   // Doi song
    array('i' => 15, 'l' => 'http://vnexpress.net/gl/oto-xe-may/'),
    
    
    array('i' => 2, 'l' => 'http://dantri.com.vn/c728/sukien.htm'),
    array('i' => 2, 'l' => 'http://dantri.com.vn/c20/xa-hoi.htm'),
    array('i' => 2, 'l' => 'http://dantri.com.vn/c25/giaoduc.htm'),
    array('i' => 2, 'l' => 'http://dantri.com.vn/c135/nhipsongtre.htm'),
    array('i' => 1, 'l' => 'http://dantri.com.vn/c23/giaitri.htm'),
    array('i' => 4, 'l' => 'http://dantri.com.vn/c36/thegioi.htm'),
    array('i' => 4, 'l' => 'http://dantri.com.vn/c119/sucmanhso.htm'),
    array('i' => 15, 'l' => 'http://dantri.com.vn/c130/tinhyeu-gioitinh.htm'),
    array('i' => 15, 'l' => 'http://dantri.com.vn/c7/suckhoe.htm'),
    array('i' => 15, 'l' => 'http://dantri.com.vn/c132/chuyenla.htm'),
    array('i' => 15, 'l' => 'http://dantri.com.vn/c111/otoxemay.htm'),
    array('i' => 3, 'l' => 'http://dantri.com.vn/c76/kinhdoanh.htm'),
    
    
    array('i' => 2, 'l' => 'http://ngoisao.net/news/thoi-cuoc/'),
    array('i' => 2, 'l' => 'http://ngoisao.net/news/hinh-su/'),
    array('i' => 1, 'l' => 'http://ngoisao.net/news/hau-truong/'),
    array('i' => 4, 'l' => 'http://ngoisao.net/news/the-thao/'),
    array('i' => 15, 'l' => 'http://ngoisao.net/news/dan-choi/'),
    array('i' => 15, 'l' => 'http://ngoisao.net/news/lam-dep/'),
    array('i' => 15, 'l' => 'http://ngoisao.net/news/thoi-trang/')
  );
  
  $crId = variable_get('crawler_current_id', 0);
  if (!isset($aLink[$crId])) $crId=0;
  $link = $aLink[$crId];
  $aURL = parse_url($link['l']);
  switch($aURL['host']){
    case 'vnexpress.net':
      _god_get_news_vnexpress(true, $link['l'], $link['i']); 
      break;
    case 'dantri.com.vn':
      _god_get_news_dantri(true, $link['l'], $link['i']); 
      break;
    case 'ngoisao.net':
      _god_get_news_ngoisao(true, $link['l'], $lindk['i']); 
      break;
  }
  variable_set('crawler_current_id', $crId+1);  
  
  god_cron();
}

function strip_html_tags($text){
    $text = preg_replace(
        array(
          // Remove invisible content
            '@<a[^>]*?>.*?</a>@siu',
            '<br>'
        ),
        array(
            '', ''
        ),
        $text);
    $text = str_replace('>', '', $text);
    $text = str_replace('<', '', $text);
    $text = str_replace('&gt;', '', $text);
    $text = str_replace('&lt;', '', $text);
    $text = str_replace('\\', '', $text);
    $text = str_replace('/', '', $text);
    return strip_tags(trim($text));
}

function remove_html_tag($text){
    $text = preg_replace(
        array(
          // Remove invisible content
            '@<h1[^>]*?>.*?</h1>@siu',
            '@<p[^>]*?>.*?</p>@siu'
        ),
        array(
            '', ''
        ),
        $text);
    return trim(strip_tags($text));
}

function _god_get_news_vnexpress($isCron=false, $url=null, $termID=null){

    module_load_include("php", "god", "webscrap.class");
    
    $domain = "http://vnexpress.net";
    
    if (is_null($url)) $url = isset($_GET['url'])?$_GET['url']:"http://vnexpress.net/gl/kinh-doanh/";
    
    $aXPath = array(
        "title"  => ".//div[@class='folder-news']//a[@class='link-title']",
        "link"  => ".//div[@class='folder-news']//a[@class='link-title']/@href"
    );
    $scrap = new WebScrap($url, $aXPath);
    $aLink = $scrap->GetScrap();
    
    foreach ($aLink as $link)
    if (count($link)==2 && (!empty($link['title']))){
        if (strpos($link['link'], 'ebank.vnexpress.net')!==false) next;
        // get title
        $title = html_entity_decode_utf8($link['title']);
        // get description
        $scrap = new WebScrap($domain.$link['link'], ".//div[@class='content']//h2[@class='Lead']");
        $aContent = $scrap->GetScrap();
        $desc = html_entity_decode_utf8(strip_html_tags(array_pop($aContent)));
        
        // get content
        $scrap->SetXpath(".//div[@class='content']/div");
        $aContent = $scrap->GetScrap();
        $content = array_shift($aContent);
        $i = strpos($content, '</h2>');
        $content = html_entity_decode_utf8(substr($content, $i+5));
        $content = str_replace('src="', 'src="'.$domain, $content);
        $content = str_replace('href="', 'href="'.$domain, $content);
		
		$content .= sprintf('<p style="text-align: right">Nguồn <a href="%s" target="_blank" rel="nofollow">vnexpress.net</a></p>', $domain.$link['link']);
        
        // get thumbnail
        $scrap->SetXpath(".//div[@class='content']/div//img/@src");
        $aContent = $scrap->GetScrap();
        if (count($aContent)>0){
          $image = $domain.array_shift($aContent);
        }else $image = null;
        
        $node = node_load(array("title"=>$title));
        if (!$node->nid){
            node_story_save($title, $desc, $content, $termID, $image, false);
            if (!$isCron){
                echo "Added new node: " . $title ." <br/>";
                flush(); ob_flush();
            }
        }else{
            if ($isCron) return;
            node_story_save($title, $desc, $content, $termID, $image, false, $node->nid);
            echo "Update node: " . $title ." <br/>";
            flush(); ob_flush();
        }
    }
}

function _god_get_news_dantri($isCron=false, $url=null, $termID=null){
    module_load_include("php", "god", "webscrap.class");
    
    $domain = "http://dantri.com.vn";
    
    if (is_null($url)) $url = isset($_GET['url'])?$_GET['url']:"http://dantri.com.vn/c23/giaitri.htm";
    /*$page = substr($url, -6, 2);
    $page = is_numeric($page)?1:substr($page, 1, 1);*/
    
    $aXPath = array(
        "title"  => ".//div[@class='fl wid470']/div[@class='mt3 clearfix']/a/@title",
        "link"  => ".//div[@class='fl wid470']/div[@class='mt3 clearfix']/a/@href", 
        "thumb" => ".//div[@class='fl wid470']/div[@class='mt3 clearfix']/a/img/@src"
    );
    $scrap = new WebScrap($url, $aXPath);
    $aLink = $scrap->GetScrap();
    
    foreach ($aLink as $link)
    if (count($link)==3 && (!empty($link['title']))){
        // get title
        $title = html_entity_decode_utf8($link['title']);
        
        // get description
        $scrap = new WebScrap($domain.$link['link'], ".//div[@id='ctl00_IDContent_ctl00_divContent']//div[@class='fon33 mt1']");
        $aContent = $scrap->GetScrap();
        $desc = html_entity_decode_utf8(strip_html_tags(array_pop($aContent)));
        
        // get content
        $scrap->SetXpath(".//div[@id='ctl00_IDContent_ctl00_divContent']//div[@class='fon34 mt3 mr2 fon43']");
        $aContent = $scrap->GetScrap();
        $content = html_entity_decode_utf8(array_pop($aContent));
		$content .= sprintf('<p style="text-align: right">Nguồn <a href="%s" target="_blank" rel="nofollow">dantri.com.vn</a></p>', $domain.$link['link']);
        
        // get thumbnail
        $image = (empty($link['thumb']))?null:str_replace('zoom/130_100/', '', $link['thumb']);    
        
        $node = node_load(array("title"=>$title));
        if (!$node->nid){
            node_story_save($title, $desc, $content, $termID, $image, false);
            if (!$isCron){
                echo "Added new node: " . $title ." <br/>";
                flush(); ob_flush();
            }
        }else{
            //return;
            if ($isCron) return;
            node_story_save($title, $desc, $content, $termID, $image, false, $node->nid);
            echo "Update node: " . $title ." <br/>";
            flush(); ob_flush();
        }
    }
}

function _god_get_news_ngoisao($isCron=false, $url=null, $termID=null){
    module_load_include("php", "god", "webscrap.class");
    
    $domain = "http://ngoisao.net";
    
    if (is_null($url)) $url = isset($_GET['url'])?$_GET['url']:"http://ngoisao.net/news/hau-truong/";
    
    $aXPath = array(
        "title"  => ".//td[@id='tdContainer']//a[@class='HomeNormal Bold DBlue5']",
        "link"  => ".//td[@id='tdContainer']//a[@class='HomeNormal Bold DBlue5']/@href"
    );
    $scrap = new WebScrap($url, $aXPath);
    $aLink = $scrap->GetScrap();
    foreach ($aLink as $link)
    if (count($link)==2 && (!empty($link['title']))){
        // get title
        $title = html_entity_decode_utf8($link['title']);
        // get description
        $scrap = new WebScrap($domain.$link['link'], ".//table[@id='CContainer']//h2[@class='Lead']");
        $aContent = $scrap->GetScrap();
        $desc = html_entity_decode_utf8(strip_html_tags(array_pop($aContent)));
        // get content
        $scrap->SetXpath(".//table[@id='CContainer']//div");
        $aContent = $scrap->GetScrap();
        $content = array_pop($aContent);
        $i = strpos($content, '</h2>');
        $content = html_entity_decode_utf8(substr($content, $i+5));
        $content = str_replace('src="', 'src="'.$domain.$link['link'], $content);
        $content = str_replace('href="', 'href="'.$domain.$link['link'], $content);
		
		$content .= sprintf('<p style="text-align: right">Nguồn <a href="%s" target="_blank" rel="nofollow">ngoisao.net</a></p>', $domain.$link['link']);
        
        // get thumbnail
        $scrap->SetXpath(".//table[@id='CContainer']//div//img/@src");
        $aContent = $scrap->GetScrap();
        if (count($aContent)>0){
          $image = $domain.$link['link'].array_shift($aContent);
        }else $image = null;
        
        $node = node_load(array("title"=>$title));
        if (!$node->nid){
            node_story_save($title, $desc, $content, $termID, $image, false);
            if (!$isCron){
                echo "Added new node: " . $title ." <br/>";
                flush(); ob_flush();
            }
        }else{
            //return;
            if ($isCron) return;
            node_story_save($title, $desc, $content, $termID, $image, false, $node->nid);
            echo "Update node: " . $title ." <br/>";
            flush(); ob_flush();
        }
    }
}

function node_story_save($title, $desc, $content, $term_id, $image, $includeTeaser=true, $nid=null){
    if (is_null($desc)||empty($desc)|is_null($content)||empty($content)) return;
  
    if (is_null($nid))$node = new StdClass();
    else $node = node_load($nid);
    
    $node->type = 'news';
    $node->title = $title;
    if ($includeTeaser) $node->body = "<p><strong>".$desc."</strong></p>".$content;
    else $node->body = $content;
    $node->teaser = $desc;
    $node->field_news_desc[0]['value'] = $desc;
    if (is_null($nid)) $node->taxonomy[] = $term_id;
    
    // set thumbnail
    if (!is_null($image)){
        $filename = array_pop(explode("/", $image));
        $filename = str_replace(' ', '', $filename);
        $filename = str_replace('%20', '', $filename);
        $file_temp = file_get_contents($image);
        $dir = file_directory_path() .'/news/'.date("Y-m-d", time())."/";
        file_check_directory($dir, 1);
        $file_temp = file_save_data($file_temp, $dir.'/'.$filename, FILE_EXISTS_REPLACE); 
		if (filesize($file_temp) > 10000) $node->field_news_thumbs[] = field_file_save_file($file_temp, array(), $dir);
        @unlink($file_temp);
    }
    
    $node->uid = 1;
    $node->status = 1;
    $node->active = 1;
    $node->promote = 0;
    $node->format = 2;
    $node->created = time();
    $node->changed = time();
    
    return node_save($node);
}

function html_entity_decode_utf8($string){
    static $trans_tbl;
    
    $string = str_replace('&ldquo;', '"', $string);
    $string = str_replace('&rdquo;', '"', $string);
    
    $string = str_replace("\r", '', $string);
    $string = str_replace("\n", ' ', $string);
    // replace numeric entities
    $string = preg_replace('~&#x([0-9a-f]+);~ei', 'code2utf(hexdec("\\1"))', $string);
    $string = preg_replace('~&#([0-9]+);~e', 'code2utf(\\1)', $string);

    // replace literal entities
    if (!isset($trans_tbl))
    {
        $trans_tbl = array();

        foreach (get_html_translation_table(HTML_ENTITIES) as $val=>$key)
            $trans_tbl[$key] = utf8_encode($val);
    }

    return trim(strtr($string, $trans_tbl));
}
function code2utf($num) {
    if ($num < 128) return chr($num);
    if ($num < 2048) return chr(($num >> 6) + 192) . chr(($num & 63) + 128);
    if ($num < 65536) return chr(($num >> 12) + 224) . chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
    if ($num < 2097152) return chr(($num >> 18) + 240) . chr((($num >> 12) & 63) + 128) . chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
    return '';
}