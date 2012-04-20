<?php
session_start();

/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Updated: 07/02/07
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/

class CaptchaSecurityImages {	

	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
//		$possible = '123456789ABCDEFGHIJLMNOPQRSXYVZ';
		$possible = '123456789';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
		return $code;
	}	
	

	function CaptchaSecurityImages($width='150',$height='70',$characters='5') {
		$code = $this->generateCode($characters);
		/* font size will be 75% of the image height */
		$NewImage =imagecreatefromjpeg("img.jpg");//image create by existing image and as back ground 

		$LineColor = imagecolorallocate($NewImage,0,rand(0,255),rand(0,255));//line color 
		$TextColor = imagecolorallocate($NewImage, 0, 0, 0);//text color-white
		
		imageline($NewImage,rand(0,30),1,rand(0,40),rand(0,40),$LineColor);//create line 1 on image 
		imageline($NewImage,rand(30,70),1,50,rand(0,100),$LineColor);//create line 2 on image 
		imageline($NewImage,rand(70,100),1,80,rand(0,100),$LineColor);
		
		imagestring($NewImage, 5, 20, 2, $code, $TextColor);// Draw a random string horizontally 
		
		$_SESSION['key_captcha'] = $code;// carry the data through session		

		header("Content-type: image/jpeg");// out out the image 		
		
		imagejpeg($NewImage);//Output image to browser 
	}
}

$oCaptcha = new  CaptchaSecurityImages(160,25,5);

?>