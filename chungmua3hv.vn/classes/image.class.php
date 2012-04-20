<?php
/****************************************************************************
 *	Copyright (C) 2007 FunnyFoxGroup. All Rights Reserved.
 *	The following is Sample Code and is subject to all restrictions on
 *	such code as contained in the End User License Agreement accompanying
 *	this product.
 ****************************************************************************/
 
class CImage
{
	var $imageStream;
	var $filePath;
	var $width;
	var $height;
	var $type;
	var $mineType;
	var $error;
	
	
	/*
	 *	Scope: private
	 *	Level: Instance
	 *	Task : construct
	 */
	function CImage( $filePath='' )
	{
		if ( file_exists($filePath) )
		{
			$this->filePath	=	$filePath;
			list( $this->width, $this->height, $iType ) = getimagesize( $this->filePath );
			switch( $iType ) 
			{
				case 1:
					$this->type	= $iType;
					$this->mineType = 'image/gif';
					$this->imageStream = @imagecreatefromgif( $this->filePath );
					break;
				case 2:
					$this->type = $iType;
					$this->mineType = 'image/jpeg';
					$this->imageStream = @imagecreatefromjpeg( $this->filePath );
					break;
				case 3:
					$this->type = $iType;
					$this->mineType = 'image/png';
					$this->imageStream = @imagecreatefrompng( $this->filePath );
					break;
				case 6:
					$this->type = $iType;
					$this->mineType = 'image/bmp';
					$this->imageStream = @imagecreatefromwbmp( $this->filePath );
					break;
				default:
					$this->error( 'invalid imagetype' );
			}
			if ( !$this->imageStream )
			{
				$this->error( 'Image does not loaded' );
			}
		}else
		{
			$this->error( 'Can not find image' );
		}
	}
	
	
	/*
	 *	Scope: public
	 *	Level: Instance
	 *	Task : resize image
	 */
	function resize( $iNewWidth, $iNewHeight )
	{
		if ( !$this->imageStream ) 
		{
			$this->error( 'Image not loaded' );
		}

		if( function_exists( "imagecopyresampled" ) )
		{
			$resizedImageStream = imagecreatetruecolor( $iNewWidth, $iNewHeight );
			imagecopyresampled( $resizedImageStream, $this->imageStream, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $this->width, $this->height );
		}
		else
		{
			$resizedImageStream = imagecreate( $iNewWidth, $iNewHeight );
			imagecopyresized( $resizedImageStream, $this->imageStream, 0, 0, 0, 0, $iNewWidth, $iNewHeight, $this->width, $this->height );
		}
		$this->imageStream	=	$resizedImageStream;
		$this->width	=	$iNewWidth;
		$this->height	=	$iNewHeight;
	}
	
	
	/*
	 *	Scope: public
	 *	Level: Instance
	 *	Task : save image create Thumnail
	 */
	function saveImage( $filePath )
	{
		if ( !$this->imageStream ) 
		{
			$this->error( 'Can not save image' );
		}
		if( $filePath )
		{
			$this->filePath	=	$filePath;
		}
		switch( $this->type ) 
		{
			case 1:
				imagegif( $this->imageStream, $this->filePath );
				break;
			case 2:
				imagejpeg( $this->imageStream, $this->filePath );
				break;
			case 3:
				imagepng( $this->imageStream, $this->filePath );
				break;
			case 6:
				imagewbmp( $this->imageStream, $this->filePath );
				break;
			default:
				$this->error( 'Invalid image type ' );
			if ( !file_exists( $this->filePath ) ) 
			{
				$this->error('Can not find image');
			}
		}
	}
	
	
	/*
	 *	Scope: public
	 *	Level: Instance
	 *	Task : display image on the fly
	 */
	function showImage( )
	{
		header( "Content-type: {$this->mimetype}" );
		if ( !$this->imageStream ) 
		{
			$this->error('Image not loaded');
		}
		switch( $this->type ) 
		{
			case 1:
				imagegif( $this->imageStream );
				break;
			case 2:
				imagejpeg( $this->imageStream );
				break;
			case 3:
				imagepng( $this->imageStream );
				break;
			case 6:
				imagewbmp( $this->imageStream );
				break;
			default:
				$this->error('invalid imagetype');
		}
	}
	
	
	/*
	 *	Scope: private
	 *	Level: instance
	 *	Task : Display Error
	 */
	function error( $sMessage,$display=true )
	{
		if($display)
			echo $sMessage.'.';
		$this->error	=	$sMessage;
	}
	
	
	/*
	 *	Scope: private
	 *	Level: instance
	 *	Task : destruct
	 */
	function destruct( )
	{
		unset( $this->imageStream );
	}
	
	
	/*
	 *	Scope: Public
	 *	Level: Class
	 */
	function imageResize($sImagePath, $wScale = '100', $hScale = '')
	{
		if(empty($hScale)) $hScale = $wScale;
		$newSize = array();
		$size	 = getimagesize($sImagePath);
		if($size[0] > $size[1]){
			if($size[0] > $wScale) $newSize['w'] = $wScale;
			else $newSize['w'] = $size[0];
			$newSize['h'] = round( $newSize['w'] * $size[1]/$size[0] );
			if( $newSize['h'] > $hScale ) {
				$olderSize = $newSize;
				$newSize['h'] = $hScale;
				$newSize['w'] = round( $newSize['h'] * $olderSize['w']/$olderSize['h'] );
			}
			// Add New
		}
		else{
			if($size[1] > $hScale) $newSize['h'] = $hScale;
			else $newSize['h'] = $size[1];
			$newSize['w'] = round( $newSize['h'] * $size[0]/$size[1] );
			if( $newSize['w'] > $wScale ) {
				$olderSize = $newSize;
				$newSize['w'] = $hScale;
				$newSize['h'] = round( $newSize['w'] * $olderSize['h']/$olderSize['w'] );
			}
		}
		return $newSize;
	}
	
	
	/*
	 *	Scope: Public
	 *	Level: Class
	 *	Task : Create Thumnail
	 */
	function createThumbnail($sImagePath, $thumbPath ,$wScale = '100', $hScale = '')
	{
		$typeFile= array( "jpg", "jpeg", "png", "gif", "bmp" );
		if(
			!in_array(strtolower(substr($sImagePath, -3)), $typeFile) && 
			!in_array(strtolower(substr($sImagePath, -4)), $typeFile)
		) return 'none';
		$sOriginalFileName = $sImagePath ;
		$sExtension = substr( $sImagePath, ( strrpos($sImagePath, '.') + 1 ) ) ;
		$sExtension = strtolower( $sExtension ) ;
		switch($sExtension){
			case 'jpg':
			case 'jpeg':
				if (function_exists("imagejpeg")) {
					$srcImg = imagecreatefromjpeg("$sImagePath") or die( "File Not Found" );
					$sizeImage = CImage::imageResize($sImagePath, $wScale, $hScale);
					$thumbImg = imagecreatetruecolor($sizeImage['w'], $sizeImage['h']);
					imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $sizeImage['w'], $sizeImage['h'], imagesx($srcImg), imagesy($srcImg));
					imagejpeg($thumbImg, "$thumbPath");
				}
				break;
			case 'gif':
				if (function_exists("imagegif")) {
					$srcImg = imagecreatefromgif("$sImagePath") or die( "File Not Found" );
					$sizeImage = CImage::imageResize($sImagePath, $wScale, $hScale);
					$thumbImg = imagecreatetruecolor($sizeImage['w'], $sizeImage['h']);
					imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $sizeImage['w'], $sizeImage['h'], imagesx($srcImg), imagesy($srcImg));
					imagegif($thumbImg, "$thumbPath");
				}
				break;
			case 'png':
				if (function_exists("imagepng")) {
					$srcImg = imagecreatefrompng("$sImagePath") or die( "File Not Found" );
					$sizeImage = CImage::imageResize($sImagePath, $wScale, $hScale);
					$thumbImg = imagecreatetruecolor($sizeImage['w'], $sizeImage['h']);
					imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $sizeImage['w'], $sizeImage['h'], imagesx($srcImg), imagesy($srcImg));
					imagepng($thumbImg, "$thumbPath");
				}
				break;
			case 'bmp':
				if (function_exists("imagewbmp")) {
					$srcImg = imagecreatefromwbmp("$sImagePath") or die( "File Not Found" );
					$sizeImage = CImage::imageResize($sImagePath, $wScale, $hScale);
					$thumbImg = imagecreatetruecolor($sizeImage['w'], $sizeImage['h']);
					imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $sizeImage['w'], $sizeImage['h'], imagesx($srcImg), imagesy($srcImg));
					imagewbmp($thumbImg, "$thumbPath");
				}
				break;
			default:
				return $msg = "GD library does not support in this PHP server";
				break;
		}
	}
	
	function imageRotate($sImagePath, $iAngle = 180){
		if(is_file($sImagePath)){
			$typeFile= array( "jpg", "jpeg", "png", "gif", "bmp" );
			$sExtension = substr( $sImagePath, ( strrpos($sImagePath, '.') + 1 ) ) ;
			$sExtension = strtolower( $sExtension ) ;
			switch($sExtension){
				case 'jpg':
				case 'jpeg':
					if (function_exists("imagejpeg")) {
						$source = imagecreatefromjpeg($sImagePath);
						$rotate = imagerotate($source, $iAngle, 0);			
						imagejpeg($rotate,$sImagePath);		
					}
					break;
				case 'gif':
					if (function_exists("imagegif")) {
						$source = imagecreatefromgif($sImagePath);
						$rotate = imagerotate($source, $iAngle, 0);			
						imagegif($rotate,$sImagePath);		
					}
					break;
				case 'png':
					if (function_exists("imagepng")) {
						$source = imagecreatefrompng($sImagePath);
						$rotate = imagerotate($source, $iAngle, 0);			
						imagepng($rotate,$sImagePath);		
					}
					break;
				case 'bmp':
					if (function_exists("imagewbmp")) {
						$source = imagecreatefromwbmp($sImagePath);
						$rotate = imagerotate($source, $iAngle, 0);			
						imagewbmp($rotate,$sImagePath);
					}
					break;
				default:
					return $msg = "GD library does not support in this PHP server";
					break;
			}
		}else{
			return $msg = "Image not exists!";
		}
	}
	
	/*
	 *	Scope: private
	 *	Level: Instance
	 *	Task : construct
	 */
	function uploadFile( $file, $newName, $folder )
	{
		$typeUpload= array( "jpg", "jpeg", "png", "gif", "bmp", "swf" );
		if(!in_array( strtolower( substr( $newName, -3) ), $typeUpload ) ){
			return 'none';
		}	
		if(!is_dir( $folder ))
			@mkdir( $folder, 0777);
		@move_uploaded_file( $file, $folder.'/'.$newName );
		
		return $newName;
	}
}

class CFile{
	function uploadFile( $file, $newName, $folder )
	{	
		if(!is_dir( $folder ))
			@mkdir( $folder, 0777);
		$success = move_uploaded_file( $file, $folder.'/'.$newName );
		
		if($success)
		return $newName;
		else return 'none';
	}
}
?>