<?
//Generate template cho estrore
class template{
	//Nội dung file gốc
	var $raw_file_content = "";
	//Lưu trữ các biến
	var $store_variable = array();
	//Lưu trữ các biến đc định nghĩa trong template
	var $templale_variable = array();
	//Lưu trữ template name để sau này có thể debug đc
	var $template_name = "";
	//Nơi chứa các template đã đc bẻ dựa vào ký tự {#-----#}
	var $template_break_content = array();
	//Nơi chứa giá trị HTML để phục vụ cho method getHTML()
	var $htmlContent = "";
	/*
	Khởi tạo class
	$template_path : Đường dẫn đến File template
	$template_name : tên template
	
	Load toàn bộ template vào memory
	*/
	function template($template_path, $template_name){
		//Check đuôi nếu ko phải html thì ko open
		if ($this->check_extension($template_name) != 1) die ("Cannot open template : Reason security");
		
		$filename = realpath("templates/" . $template_path . "/" . $template_name);
		if ($filename === false){
			die("Cannot find template " . $template_name);
		}
		$handle = fopen($filename, "r");
		$this->raw_file_content = fread($handle, filesize($filename));
		fclose($handle);
		//Lưu lại template name dùng để debug
		$this->template_name = $template_name;
		
		//Lấy hết các giá trị nằm trong {#VAR_......#}
		preg_match_all('/\{#VAR_(.*?)\#}/is', $this->raw_file_content, $matches);
		//Lặp để lấy giá trị
		for ($i=0; $i < count($matches['0']); $i++) {
			//Lấy text
			$mtext = $matches["1"][$i];
			//Bẻ dấu =
			$marray = explode("=",$mtext);
			//Nếu tồn tại $marray[1] -> có giá trị thì gán vào array tổng
			if (isset($marray[1])) $this->templale_variable[trim($marray[0])] = trim($marray[1]);
		}
	}
	
	/*
	Function get_theme_name: Lấy tên template
	*/
	function get_theme_name($theme_name){
		
		if(strpos($theme_name, $this->v2_path) !== false){
			return str_replace($this->v2_path . "_", "", $theme_name);
		}
		else{
			return $theme_name;
		}
		
	}
	
	/*
	Thêm variable name và value cho class
	$variable_name : Tên biến
	$variable_value : Giá trị của biến
	*/
	function add($variable_name,$variable_value){
		//Gán vào value, trước khi gán phải replace các ký tự {# #} để tránh replace lại
		$temp = str_replace("{#","",$variable_value);
		$temp = str_replace("#}","",$temp);
		$this->store_variable[$variable_name] = $temp;
	}
	
	/*
	Thêm 1 array các biến vào
	$array_variable : Mảng các biến
	*/
	function addArray($array_variable){
		//Kiểm tra nếu là array thì bắt đầu add
		if (is_array($array_variable)){
			foreach ($array_variable as $mkey => $mvalue){
				$this->add($mkey,$mvalue);
			}
		}
	}
	
	/*
	Tạo ra output HTML
	$break_number : Thứ tự của đoạn nội dung
					-1 : Đọc toàn bộ file
					0,1,2,3 .. Đọc nội dung của đoạn 0,1,2,3
	*/
	function generateHTML($break_number=-1,$kill_block_list=""){
		//Nếu $break_number = -1 -> Gán content cho raw content
		if ($break_number == -1) $content = $this->raw_file_content;
		//Nếu $break_number !=-1 thì kiểm tra và gán đoạn cụ thể
		else{
			//Nếu tồn tại key $break_number thì gán còn ko cho bằng rỗng
			if (isset($this->template_break_content[$break_number])) $content = $this->template_break_content[$break_number];
			else $content = "";
		}
		
		//Kill block không cần thiết
		$content = $this->killBlock($kill_block_list, $content);

		//Tìm tất cả trong {# ... #}
		preg_match_all('/\{#(.*?)\#}/is', $content, $matches);
		
        for ($i=0; $i < count($matches['0']); $i++) {
			//Lấy tag : toàn bộ thẻ và text : chữ trong thẻ
			$tag = $matches["0"][$i];
			$text = $matches["1"][$i];
			
			// Nếu tồn tại key trong array store_variable thì bắt đầu replace HTML
			if (isset($this->store_variable[$text])){
				$content = str_replace($tag, $this->store_variable[$text], $content);
			}
			//Nêu ko tồn tại trong array store_variable thì xóa thẳng cánh
			else{
				$content = str_replace($tag, "", $content);
			}
			
        }
		return $content;
	}
	
	/*
	Lấy output HTML
	getHTML có 2 kiểu :
		Nếu $htmlContent = rỗng thì method này sẽ call method generateHTML
		Nếu $htmlContent khác rỗng thì sẽ trả về $htmlContent
	*/
	function getHTML(){
		
		$str = array(chr(9), chr(10), chr(13));
		//$str = array(chr(9));
		//Remove các ký tự tab + xuống dòng
		if ($this->htmlContent != "") return str_replace($str, "", $this->htmlContent);
		else return str_replace($str, "", $this->generateHTML());
		
	}
	
	
	/*
	Check đuôi mở rộng, nếu là .html thì mới cho phép đọc còn ko thì phắn
	$filename : tên file
	*/
	function check_extension($filename){
		
		$sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
		$sExtension = strtolower( $sExtension ) ;
		
		if ($sExtension == "html") return 1;
		else return 0;
	}
	
	/*
	get Module tồn tại trong template
	Trả về 1 array tên các module trong template
	*/
	function getModule(){
		$mymodule = array();
		preg_match_all('/\{#MODULE_(.*?)\#}/is', $this->raw_file_content, $matches);
		$mymodule = $matches["1"];
		return $mymodule;
	}
	
	/*
	Lấy giá trị biến đc tạo trong template
	$variable_name : Tên biến
	$return_false : Nếu ko có thì trả về giá trị $return_false
	*/
	function getValue($variable_name,$return_false=0){
		if (isset($this->templale_variable[$variable_name])) return $this->templale_variable[$variable_name];
		else return $return_false;
	}
	
	/*
	Bẻ template theo ký tự {#-----#}
	*/
	function breakTemplate(){
		$this->template_break_content = explode("{#-----#}",$this->raw_file_content);
	}
	
	/*
	Kill block
	$kill_block_list : Danh sách nội dung cần loại bỏ
	$content : nội dung
	*/
	function killBlock($kill_block_list,$content){
		//Nếu kill_block_list rỗng thì return luôn
		if (trim($kill_block_list)=="") return $content;
		
		$temp_content = $content;
		//Bẻ list ra array
		$array_kill = explode(",",$kill_block_list);
		
		//Loop toàn bộ array_kill
		for ($i=0;$i<count($array_kill);$i++){
			//Nếu block khác rỗng bắt đầu tìm
			if (trim($array_kill[$i]) !=""){
				$start_block = strpos($temp_content,"{#_BLOCK_" . trim($array_kill[$i]) . "#}");
				$end_block = strpos($temp_content,"{#/BLOCK_" . trim($array_kill[$i]) . "#}");
				if ($start_block!==false && $end_block !==false && $start_block < $end_block){
					$temp_content = substr($temp_content,0,$start_block) . substr($temp_content,$end_block,strlen($temp_content)-$end_block);
				}
			}
		}
		
		return $temp_content;
	}
}
?>