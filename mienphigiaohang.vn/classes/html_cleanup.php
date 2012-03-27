<?
/**
Remove các thẻ HTML chống XSS
*/
class html_cleanup{
	//Các tag cho phép
	var $valid_elements	= array ("b", "blockquote", "br", "center", "del", "div", "em", "font", "h2", "h3", "h4", "i", "img", "ins", "li", "hr", "ol",
											"p", "pre", "s", "span", "strong", "strike", "sub", "sup", "table", "tbody", "td", "th", "tr", "u", "ul");
	
	//Phần mở rộng cho các tag đc phép, các attribute cho phép trong tag
	var $extended_valid_elements = array(            "a"			=> array("href", "style", "name", "rel", "target", "title"),
													 "b"			=> array("style"),
													 "blockquote"	=> array("title","style"),
													 "br"			=> array("clear","style"),
													 "center"		=> array("style"),
													 "del"			=> array("title","style"),
													 "div"			=> array("align", "title","style"),
													 "em"			=> array("title","style"),
													 "font"			=> array("color","size", "face", "title"),
													 "h2"			=> array("style"),
													 "h3"			=> array("style"),
													 "h4"			=> array("style"),
													 "i"			=> array("title","style"),
													 "img"			=> array("align","style", "alt", "border", "height", "hspace", "src", "title", "vspace", "width"),
													 "ins"			=> array("title","style"),
													 "li"			=> array("title", "type","style"),
													 "hr"			=> array("align", "noshade", "size", "title","style"),
													 "ol"			=> array( "title", "type","style"),
													 "p"			=> array( "title", "align","style"),
													 "pre"			=> array( "title","style"),
													 "s"			=> array( "title","style"),
													 "span"			=> array( "title","style"),
													 "strong"		=> array("style"),
													 "strike"		=> array( "title","style"),
													 "sub"			=> array( "title","style"),
													 "sup"			=> array( "title","style"),
													 "table"		=> array("align","style", "bgcolor", "border", "bordercolor", "cellpadding", "cellspacing", "height", "title", "width"),
													 "tbody"		=> array("style"),
													 "td"			=> array("align", "style", "bgcolor", "colspan", "height", "nowrap", "rowspan", "title", "valign", "width"),
													 "th"			=> array("align", "style", "bgcolor", "colspan", "height", "nowrap", "rowspan", "title", "valign", "width"),
													 "tr"			=> array("align", "style", "bgcolor", "height", "nowrap", "title", "valign"),
													 "u"			=> array( "title", "style"),
													 "ul"			=> array( "title", "style", "type"),
													 );
	//Các style không được phép dùng
	var $invalid_styles = array("behavior", "background-image", "background", "expression", "/*", "*/");
	
	//Các giao thức được dùng
	var $web_protocol = array("http://", "https://", "ftp://", "mailto:");

    var $domain_image = '';
    var $add_more     = "";
	var $input_html;
	var $output_html;
	var $DOMDoc;
	//Lưu lại log
	var $log_string = "";
	
	/**
	Khởi tạo hàm
	*/
	function html_cleanup($input_html){
		//Do something here
		$this->input_html = $input_html;
	}
	
	/**
	Bắt đầu làm sạch chuỗi HTML
	*/
	function clean(){
	    
		//Sử dụng strip_tags để làm sạch HTML
		$this->html_strip_tags();
		
		//Sử dụng DOMDocument để làm sạch
		$this->DOMDocument_cleanup();

        $this->modify_src_image();
        
		//Sau khi đã trải qua công đoạn làm sạch gán outout = input
		$this->output_html = $this->input_html;
		
		//Cleanup HTML Comment
		$this->output_html = preg_replace('/&lt;!--(.|\s)*?--&gt;/', '&nbsp;', $this->output_html);
		
		//Convert ký tự NCR -> UTF-8
		$convmap = array(0x0, 0x2FFFF, 0, 0xFFFF);
		$this->output_html = @mb_decode_numericentity($this->output_html, $convmap, "UTF-8");
		
	}
	
	/**
	Sử dụng strip_tags để remove các thẻ ko đc phép
	*/
	function html_strip_tags(){
		
		$tag_allow = "";
		reset($this->valid_elements);
		//Tạo các tag_allow
		foreach ($this->valid_elements as $m_key => $m_value) $tag_allow .= "<" . $m_value . ">";

		//Loại các thẻ ko cho phép
		$this->input_html = strip_tags($this->input_html, $tag_allow);
	}
	
	/**
	Làm sạch HTML bằng DOMDocument
	*/
	function DOMDocument_cleanup(){
		//Khởi tạo 1 DOM Document mới
		$this->DOMDoc = new DOMDocument("1.0", "UTF-8");
		
		//Cho thẻ HTML, meta UTF8, <body> vào DOM để tránh lỗi khi loadHTML
		$this->input_html = 	'<html>' . 
									'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . 
									'<body>' .
										$this->input_html . 
									'</body>' . 
							  	'</html>';
        
		//Load input HTML vào DOM Document, dùng @ để tránh lỗi
		@$this->DOMDoc->loadHTML($this->input_html);
		
		//Loại bỏ các tag không cho phép
		$this->DOMDocument_cleanup_tag();
		
		//Loại các thẻ tr, td, th đứng 1 mình ko có cha
		$this->DOMDocument_cleanup_missing_parent_tr_td();
		
		//Loại các attribute không được phép
		$this->DOMDocument_cleanup_attribute();
      
		//Trả lại input chuỗi HTML đã validate xong		
		$this->input_html = $this->DOMDoc->saveHTML();

		// Replace các ký tự FCK sang UTF-8
		$this->input_html	= replace_fck($this->input_html, 1);
		
		//Tìm đến đầu body và /body để cắt chuỗi
		$start_pos 	= strpos($this->input_html,"<body>");
		$end_pos 	= strpos($this->input_html,"</body>");
		
		// Không tìm thấy vị trí thẻ body thì trả về chuỗi rỗng
		if($start_pos === false) $this->input_html	= "";
		else $this->input_html = substr($this->input_html, $start_pos + 6, $end_pos - $start_pos - 6);
	}
	
	
	/**
	Loại bỏ các tag không cho phép
	*/
	function DOMDocument_cleanup_tag(){

		$this->log_string .= "---START REMOVE TAG ---\n";
		
		//Lọc bỏ tag không được phép
		//gắn node với các tất cả các tag dưới dạng tham chiếu
		$node = $this->DOMDoc->getElementsByTagName("*");
		
		//Khai báo mảng những node cần delete
		$delete_node = array();
		$new_valid_elements = array_merge($this->valid_elements, array("html", "body"));
		
		foreach ($node as $mynode){
			
			$this->log_string .= $mynode->nodeName . " ";
			
			if (array_search($mynode->nodeName, $new_valid_elements) === false){
				$this->log_string .= "delete";
				//gán vào delete node
				$delete_node[] = $mynode;
			}
			$this->log_string .= "\n";
		}
		
		//Loop delete node để xóa
		foreach ($delete_node as $mynode){
			//Tự xóa nó bằng cách nhẩy đến nút cha rồi xóa
			$mynode->parentNode->removeChild($mynode);
		}
			
	}
	
	/**
	Loại bỏ các atttribute không được phép dùng
	*/
	function DOMDocument_cleanup_attribute(){
		$this->log_string .= "---START REMOVE ATTRIBUTE ---\n";
		//Loop lần 2 để lọc bỏ các Attribute không đc phép
		$node = $this->DOMDoc->getElementsByTagName("*");
		
		//Loop node
		foreach ($node as $mynode){
		
			//Nếu nodeName có trong array			
			if (isset($this->extended_valid_elements[$mynode->nodeName])){

				//Loop toàn bộ attribute
				foreach ($mynode->attributes as $attribute_name => $attribute_value){
				
					$this->log_string .= $mynode->nodeName . " > " . $attribute_name;
					
					//Nếu atttribute không có trong định nghĩa thì remove luôn attribute
					if (array_search($attribute_name, $this->extended_valid_elements[$mynode->nodeName]) === false){
						$mynode->removeAttribute($attribute_name);
						
						$this->log_string .= " REMOVE";
					}
					
					//Đối với attribute có trong định nghĩa thì check style, src, href chống nhét Javascript
					else{
						switch ($attribute_name){
							//Check attribute style
							case "style":
								//bẻ dấu ;
								$new_style_str = "";
								$style_array = explode(";", $attribute_value->value);
								
								//Loop cac value style
								foreach ($style_array as $m_key => $m_value){
									reset($this->invalid_styles);

									//Gán biến found_invalid_style bằng false, mặc định luôn không tìm thấy
									$found_invalid_style = false;
									
									foreach ($this->invalid_styles as $ivs_key => $ivs_value){
										//Nếu tìm đc invalid style thì gán $found_invalid_style = true;
										if (stripos($m_value, $ivs_value) !== false){
											$found_invalid_style = true;
											//Thoát vòng for
											break;
										}
									}
									
									//Nếu không tìm thấy invalid style thì gán thêm vào $new_style_str
									if (!$found_invalid_style) $new_style_str .= trim($m_value) . ";";
								}
								//Gán lại attribute style
								$mynode->setAttribute($attribute_name, $new_style_str);
							break;
							//Kết thúc check attribute style
							
							//Check attribute src, href
							case "src":
							case "href":
								//Kiểm tra giao thức của src, href
								reset($this->web_protocol);
								
								//Gán biến $trust_protocol luôn là false
								$found_trust_protocol = false;
								
								foreach($this->web_protocol as $m_key => $m_value){
									//Nếu vị trí đầu tiên đúng với các giao thức định nghĩa thì gán $found_trust_protocol = true
									if (stripos($attribute_value->value, $m_value) !== false && stripos($attribute_value->value, $m_value) == 0){ 
										$found_trust_protocol = true;
										break;
									}
								}
								
								//Nếu giao thức không có trong định nghĩa, mặc định gán lại là http:// tránh XSS đa phần trường hợp này sẽ ko show đúng
								if (!$found_trust_protocol) $mynode->setAttribute($attribute_name, "http://" . $attribute_value->value);
								
								//replace &amp; -> & trong src va href
								//else $mynode->setAttribute($attribute_name, str_replace("&amp;", "&", $attribute_value->value));
								
								//Thẻ a thì thêm target và rel vào
								if ($mynode->nodeName == "a"){
									$mynode->setAttribute("target", "_blank");
									$mynode->setAttribute("rel", "nofollow");
								}
								
								//echo $attribute_value->value;
								
							break;
							//Kết thúc check attribute src, href
						}
					}
					
					$this->log_string .= "\n";
				}
			}
			
		}//End Loop node		
	}
	//End DOMDocument_cleanup_attribute method
	
	
	/**
	Xóa các thẻ tr, td bị mất thẻ cha (tbody, table)
	*/
	function DOMDocument_cleanup_missing_parent_tr_td(){
	    
	
		$this->log_string .= "---START REMOVE MISSING PARENT TR, TD, TH, TAG ---\n";
		
		$tag_check = array("tbody"	=> "[table]", 
								 "tr"		=> "[tbody][table]", 
								 "td"		=> "[tr]", 
								 "th"		=> "[tr]");
		
		foreach ($tag_check as $m_key => $m_value){
			
			//Loop lần lượt các tag cần check
			$node = $this->DOMDoc->getElementsByTagName($m_key);
			
			//Khai báo mảng những node cần delete
			$delete_node = array();
			
			foreach ($node as $mynode){
				//Kiểm tra node cha của node này có trong định nghĩa ko?
				//Nếu node cha không có trong định nghĩa thì xóa tag vì đây là invalid tag
				if (strpos($m_value, "[" . $mynode->parentNode->nodeName . "]") === false){
					//gán vào delete node
					$delete_node[] = $mynode;
				}
			}
            
            //if(count($delete_node) > 0){
//                die('OK');
//                //Loop delete node để xóa
//    			foreach ($delete_node as $mynode){
//    				//Tự xóa nó bằng cách nhẩy đến nút cha rồi xóa
//    				$mynode->parentNode->removeChild($mynode);
//    			}	
//            }
		}	// End foreach tag_check array
	}
	/* Kết thúc DOMDocument_cleanup_missing_parent_tr_td*/
	
	/**
	generate tinyMCE rule 
	Tạo 1 chuỗi string về luật cho tinyMCE
	*/
	function generate_tinyMCE_rule(){
		$tiny_mce_rule_string = "";
		$tiny_mce_rule_string .= 'valid_elements : "' . implode($this->valid_elements, ",") . '",' . "\n";
		
		$tiny_mce_rule_string .= 'extended_valid_elements : "'; 
		reset($this->extended_valid_elements);
		foreach ($this->extended_valid_elements as $m_key => $m_value){
			$tiny_mce_rule_string .= $m_key . "[";
			$tiny_mce_rule_string .= implode($m_value, "|") . '],';
		}
		$tiny_mce_rule_string .= '",' . "\n";
		
		$tiny_mce_rule_string .= 'invalid_styles : "' . implode($this->invalid_styles, ",") . '",' . "\n";; 
		
		return $tiny_mce_rule_string;
	}
	
	/**
	Get gallery image, lấy toàn bộ thẻ image có khả năng nằm trong gallery trả về 1 array
	*/
	function getGalleryImage(){
		
		//Loop toàn bộ thẻ image
		$node = $this->DOMDoc->getElementsByTagName("img");
		$img_array = array();

		//Lấy server gallery
		global $galleryVatgiaServer;
        
		//Nếu ko có hoặc bằng rỗng thì gán bằng http://localhost:900
		if (!isset($galleryVatgiaServer)) $gallery_host = "http://localhost:9000";
		else $gallery_host = $galleryVatgiaServer;
		if ($gallery_host == "") $gallery_host = "http://localhost:9000";
		//-----------------
		
		//echo $gallery_host . "/gallery_img";
		
		foreach ($node as $mynode){
			//Lấy src
			$url = $mynode->getAttribute("src");
			//Lấy alt text
			$alt_text = $mynode->getAttribute("alt");
			
			
			
			//Nếu url thuôc gallery thì bắt đầu bóc tách		
			if (strpos($url, $gallery_host . "/gallery_img") !== false){
				
				$url_array = explode("/", $url);
				if (count($url_array) == 6){
					//gán vào delete node
					$img_array[md5($url)] = array("small_src"		=> $url_array[4] . "/small_" . $url_array[5],
															"alt_text"		=> $alt_text,
															"full_src"		=> $url);
				}
			}
		}
		
		return $img_array;
		
	}
    
    /**
        Đầu tiên phải set $this->domain_image trước
	    Reset src image nếu nó có dạng 
            src="image/product/xxx.jpg"     => src="http://baokim.vn/image/product/xxx.jpg"
	*/
	function modify_src_image(){
        $temp_dom = new DOMDocument("1.0", "UTF-8");
        
        $temp_dom->loadHTML($this->input_html);
		//Loop toàn bộ thẻ image
		$node = $temp_dom->getElementsByTagName("img");
  
		//-----------------
		
		foreach ($node as $mynode){
			//Lấy src
			$url = $mynode->getAttribute("src");
            $source_image_ = getDomain($url);
            
			//Nếu url thuôc gallery thì bắt đầu bóc tách		
			if ($source_image_ == ""){
                $url = str_replace("http://","",$url);
                $url = "http://" . $this->domain_image . $this->add_more . $url;
			}
            
            $newNode    =   $temp_dom->createElement("a");
            $newNode->setAttribute("rel","colorbox");
            $newNode->setAttribute("href",$url);
            
            $img = $temp_dom->createElement("img");
            $img->setAttribute("style","max-width: 700px;");
            $img->setAttribute("border","0");
            $img->setAttribute("title","Click để xem ảnh với kích thước đầy đủ!");
            $img->setAttribute("class","zoom lazyload");
            $img->setAttribute("src",$url);
            
            $newNode->appendChild($img);
            
            $mynode->parentNode->replaceChild($newNode, $mynode);
            
		}
        unset($source_image_);
		$this->input_html = $temp_dom->saveHTML();
		return ;
		
	}
}
?>