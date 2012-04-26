<?php

function resize_image($path,$filename,$maxwidth,$maxheight,$quality,$type="small_")
{
	$sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
	$sExtension = strtolower($sExtension);
	
	$size_img=getimagesize($path . $filename);
	if($size_img[0]<$maxwidth) $maxwidth=$size_img[0];
	if($size_img[1]<$maxheight) $maxheight=$size_img[1];
	
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
		imagejpeg($image_p, $path . $type . $filename, $quality);
		break;
	case "gif" :
		imagegif($image_p, $path . $type . $filename);
		break;
	}
	//imagejpeg($image_p, $path . "small_" . $filename, $quality);
	imagedestroy($image_p);
	@chmod($path . $type . $filename,664);
}
?>