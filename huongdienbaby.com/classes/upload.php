<?
/*
class upload
Developed by FinalStyle.com
*/
class upload{
	/*
	upload function
	upload_name : Ten textbox upload vi du : new_picture
	upload_path : duong dan save file upload
	extension_list : danh sach cac duoi mo rong duoc phep upload vi du : gif,jpg
	limt_size : dung luong gioi han (tinh bang byte) vi du : 20000 
	*/
	var $common_error	= "";
	var $warning_error	= "";
	var $file_name		= "";
	
	function upload($upload_name,$upload_path,$extension_list,$limit_size,$new_filename = ''){
		$limit_size=$limit_size*1024;
		// kiem tra xem co upload ko
		if (!is_uploaded_file($_FILES[$upload_name]['tmp_name'])){
			$this->common_error = "Không tìm thấy file tmp_name, file upload tạm<br>";
			return;
		}
		// check file_size
		if (filesize($_FILES[$upload_name]['tmp_name']) > $limit_size){
			$this->common_error = "Dung lượng file lớn hơn giới hạn cho phép : " . number_format($limit_size,0,0,".") . " bytes<br>";
			$this->warning_error = $this->common_error;
			return;
		}
		//check upload extension
		if ($this->check_upload_extension($_FILES[$upload_name]['name'],$extension_list) != 1){
			$this->common_error = "Phần mở rộng của file không đúng, bạn chỉ upload được file có phần mở rộng là : " . $extension_list . "<br>";
			$this->warning_error = $this->common_error;
			return;
		}
		//generate new filename
		if($new_filename == '') $new_filename = $this->generate_name($_FILES[$upload_name]['name']);
		 $this->file_name = $new_filename;
		//move upload file
		move_uploaded_file($_FILES[$upload_name]['tmp_name'],$upload_path . $new_filename);
	}
	
	function show_common_error(){
		return $this->common_error;
	}
	function show_warning_error(){
		return $this->warning_error;
	}
	
	/*
	Kiem tra phan mo rong
	*/
	function check_upload_extension($filename,$allow_list){
		
		$sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
		$sExtension = strtolower( $sExtension ) ;
		
		$allow_arr = explode(",",$allow_list);
		$pass = 0;
		
		for ($i=0;$i<count($allow_arr);$i++){
			if ($sExtension == $allow_arr[$i]) $pass = 1;
		}
		return $pass;
	}
	
	/*
	resize anh
	*/
	function resize_image($path,$filename,$maxwidth,$maxheight,$quality)
	{
		$sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
		$sExtension = strtolower($sExtension) ;
	
		// Get new dimensions
		list($width, $height) = getimagesize($path . $filename);
		if ($width != 0 && $height !=0)
		{
			if ($maxwidth / $width > $maxheight / $height)
			{
				$percent = $maxheight / $height;
			}
			else
			{
				$percent = $maxwidth / $width;
			}
		}
		$new_width = $width * $percent;
		$new_height = $height * $percent;
		
		// Resample
		$image_p = imagecreatetruecolor($new_width, $new_height);
		//check extension file
		switch ($sExtension){
		case "jpg" :
			$image = imagecreatefromjpeg($path . $filename);
			break;
		case "gif" :
			$image = imagecreatefromgif($path . $filename);
			break;
		}
		//$image = imagecreatefromjpeg($path . $filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		
		// Output
		
		switch ($sExtension){
		case "jpg" :
			imagejpeg($image_p, $path . "small_" . $filename, $quality);
			break;
		case "gif" :
			imagegif($image_p, $path . "small_" . $filename);
			break;
		}
		//imagejpeg($image_p, $path . "small_" . $filename, $quality);
		imagedestroy($image_p);
		@chmod($path . "small_" . $filename,777);
	}
	
	/*
	Generate file name
	*/
	function generate_name($filename)
	{
		$name = "";
		for($i=0; $i<3; $i++){
			$name .= chr(rand(97,122));
		}
		$today= getdate();
		$name.= $today[0];
		$ext	= substr($filename, (strrpos($filename, ".") + 1));
		return $name . "." . $ext;
	}	
}
?>