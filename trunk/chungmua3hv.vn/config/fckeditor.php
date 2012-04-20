<?php
	global $oFCKeditor;
	
	include(SITE_DIR."lib/fckeditor/fckeditor.php") ;
	$oFCKeditor = new FCKeditor('FCKeditor') ;
	$oFCKeditor->BasePath = SITE_URL."lib/fckeditor/";
	$oFCKeditor->Width=620;
	$oFCKeditor->Height=200;
	//$oFCKeditor->Config['SkinPath'] = SITE_URL."lib/fckeditor/editor/skins/office2003/";
	$oFCKeditor->Config['AutoDetectLanguage']	= false ;
	$oFCKeditor->Config['DefaultLanguage']		= "vi" ;
?>