<?php 
/**
 * @version		1.3 com_annonces - petites annonces $
 * @package		simple_ads_-_petites_annonces
 * @copyright	Copyright (c) 2011 - All rights reserved.
 * @license		GNU/GPL
 * @author		Anthony JULOU
 * @author mail	ajulou@yahoo.fr
 *
 **/
defined('_JEXEC') or die('Restricted access');

class Image 
{
	/** Numéro de l'annonce */
	var $numeroAnnonce;

	/** Chemin root des photos de l'annonce */
	var $photoRootPath;
	
	/** Repertoire d'installation temporaire des photos */
	var $photoPathTemp;
	
	/** Repertoire d'installation des photos */
	var $photoPath;
	
	/** Repertoire d'installation des vignettes */
	var $vignettePath;
	
	
	/**
	 * Constructeur avec numéro de l'annonce 
	 * @param $pNumero
	 * @return unknown_type
	 */
	function Image( $pNumero ) 
	{
		$this->numeroAnnonce = $pNumero;;
		$this->photoRootPath = JPATH_SITE.DS.'images'.DS.'stories'.DS.'annonces'.DS.'A'.$pNumero;
		$this->photoPathTemp = $this->photoRootPath . DS . "temp";
		$this->photoPath = $this->photoRootPath;
		$this->vignettePath = $this->photoRootPath. DS .'vignettes';
	}
	
	/**
	 * Retourne le tableau des photos pour affichage
	 * 
	 * @param $pNumero d'annonce
	 * @return unknown_type
	 */
	function getListPhotos( $pNumero )
	{
		jimport('joomla.filesystem.file');
		$album = new Image( $pNumero ); 
		
		// Traitement des images
		$image_purl = JURI::root().'images/stories/annonces/A'.$pNumero . '/';
		$vignette_purl= $image_purl.'vignettes' . '/';
		$tableau_images = array('','','','');
		for ( $i = 1; $i < 5; $i++ ) 
		{
			$image = new stdclass();
			$uneImagePath = $album->photoPath. DS . $i . '.jpg';
			$uneImageUrl = $image_purl . $i . '.jpg';
			if ( JFile::exists( $uneImagePath) ) 
			{
				$image->url = $uneImageUrl;
				$image->vignetteUrl= $vignette_purl . $i . '.jpg';
				$image->existe=true;
			}
			else
				$image->existe=false;
			$tableau_images[$i-1] = $image;
		}
			
		return $tableau_images;
	}
	
	/**
	 * Permet de supprimer le repertoire contenant les photos 
	 * @param numero d'annonce indiquand le nom du repertoire "A4 pour annonce n°4"
	 * @return vide
	 */
	function supprimerPhotos( $pNumeroAnnonce )
	{
		$unePhoto = new Image( $pNumeroAnnonce ); 
	
		jimport('joomla.filesystem.file');
		
		// Création du repertoire temporaire
		if ( JFolder::exists( $unePhoto->photoPathTemp ) == true )
			JFolder::delete( $unePhoto->photoPathTemp );
		
		// Création du répertoire de stockage des photos
		if ( JFolder::exists( $unePhoto->photoPath ) == true )
			JFolder::delete( $unePhoto->photoPath );
			
		// Création du répertoire de stockage des vignettes
		if ( JFolder::exists( $unePhoto->vignettePath ) == true )
			JFolder::delete( $unePhoto->vignettePath );
		
		// Suppression du repertoire root
		if ( JFolder::exists( $unePhoto->photoRootPath ) == true )
				JFolder::delete( $unePhoto->photoRootPath );
	}
	
	/**
	 * Permet de supprimer une photo
	 * @param numero d'annonce 
	 * @param numero de la photo
	 * @return vide
	 */
	function supprimerUnePhoto( $pNumeroAnnonce, $photoId )
	{
		$album = new Image( $pNumeroAnnonce ); 
	
		jimport('joomla.filesystem.file');
		$fileName = DS . $photoId . ".jpg";
		// Création du repertoire temporaire
		if ( JFile::exists( $album->photoPathTemp . $fileName ) == true )
			JFile::delete( $album->photoPathTemp . $fileName );
		
		// Création du répertoire de stockage des photos
		if ( JFile::exists( $album->photoPath . $fileName ) == true )
			JFile::delete( $album->photoPath . $fileName );
			
		// Création du répertoire de stockage des vignettes
		if ( JFile::exists( $album->vignettePath . $fileName ) == true )
			JFile::delete( $album->vignettePath . $fileName );
		
		// Suppression du repertoire root
		if ( JFile::exists( $album->photoRootPath . $fileName ) == true )
				JFile::delete( $album->photoRootPath . $fileName );
	}
	
	/**
	 * Permet de récupérer les photos postées 
	 * et de les uploader pour les placer dans les bons répertoires
	 * 
	 * @param numeroAnnonce 
	 * @return unknown_type
	 */
	function enregistrerPhotos( $pNumeroAnnonce, $pMaxUploadKoSize )
	{
		$unePhoto = new Image( $pNumeroAnnonce ); 
	
		jimport('joomla.filesystem.file');
		
		// Création du repertoire temporaire
		if ( JFolder::exists( $unePhoto->photoPathTemp ) == false )
			JFolder::create( $unePhoto->photoPathTemp, 0777 );
		
		// Création du répertoire de stockage des photos
		if ( JFolder::exists( $unePhoto->photoPath ) == false )
			JFolder::create( $unePhoto->photoPath, 0777 );
			
		// Création du répertoire de stockage des vignettes
		if ( JFolder::exists( $unePhoto->vignettePath ) == false )
			JFolder::create( $unePhoto->vignettePath, 0777 );
		
		$result = true;
		$i = 1;
		while ( $i < 5 && $result == true )
		{	
			$file = JRequest::getVar( 'photo'.$i, '', 'files', 'array' );	
			if ( $file['name'] ) {
				$result = $unePhoto->enregistrerPhoto( $file, $i, $pMaxUploadKoSize );
			}
			$i++;
		}	
		
		// Suppression du repertoire temporaire
		if ( JFolder::exists( $unePhoto->photoPathTemp ) )
				JFolder::delete( $unePhoto->photoPathTemp );
		
		return $result;
	}
	
	/**
	 * Retourne l'url de la vignette d'une photo donnée
	 * 
	 * @return unknown_type
	 */
	function vignetteExists( $annonceId, $photoId) 
	{
		$unePhoto = new Image( $annonceId );

		jimport('joomla.filesystem.file');
		$vignetteFile = $unePhoto->vignettePath.DS.$photoId.'.jpg';
		if ( JFile::exists( $vignetteFile ) == true ) {
			$image_purl = JURI::root().'images/stories/annonces/A'.$annonceId . '/';
			return $image_purl.'vignettes' . '/'.$photoId.'.jpg';
		}
		else
			return "/components/com_annonces/assets/images/nophoto.gif";
	}
	
	
	/**
	 * Enregistrement des photos 
	 * 
	 * @param $file le fichier
	 * @param $photoId le numero de la photo
	 * @return string
	 */
	function enregistrerPhoto( $file, $photoId, $pMaxUploadKoSize )
	{
		global $mainframe;
		$result = true;
		if ( !empty($file['name']) )  
		{
			jimport('joomla.filesystem.file');
			
			//check the image
			$check = $this->check($file, (int) $pMaxUploadKoSize);
			
			if ($check == false) {
				return false;
			}
			
			//sanitize the image filename
			$filename = $photoId.'.jpg';
			$filepath = $this->photoPathTemp . DS . $filename;

			if ( JFile::upload($file['tmp_name'], $filepath)) 
			{
				// On redimensionne la photo
				$result = $this->dimensionnerPhotos( $filename ); 
			}
			/**else {
				JError::raiseError( 500, JText::_( 'UPLOAD FAILED' ) );
				return false;
			}*/
		}
		return $result;
	}
	
	/**
	 * Redimensionnement de l'image et creation de la vignette
	 * @param $image
	 * @param $annonceId
	 * @return unknown_type
	 */
	function dimensionnerPhotos($image )
	{
		jimport('joomla.filesystem.file');
		$result = true;
		if ( $image ) 
		{
			// Redimenssioner la photo
			$result &= $this->thumb( $this->photoPathTemp.DS.$image, $this->photoPath.DS.$image, 480, 400);
			// Puis creer les vignettes
			$result &= $this->thumb( $this->photoPathTemp.DS.$image, $this->vignettePath.DS.$image, 90, 65);
		}
		return $result;
	}
	
	/**
	 * Redimensionnement d'une image
	 * 
	 * @param $file
	 * @param $save
	 * @param $width
	 * @param $height
	 * @return unknown_type
	 */
	function thumb($file, $save, $width, $height)
	{
		//GD-Lib > 2.0 only!
		@unlink($save);
		
		//get sizes else stop
		if (!$infos = @getimagesize($file)) {
			return false;
		}

		// keep proportions
		$iWidth = $infos[0];
		$iHeight = $infos[1];
		$iRatioW = $width / $iWidth;
		$iRatioH = $height / $iHeight;

		if ($iRatioW < $iRatioH) {
			$iNewW = $iWidth * $iRatioW;
			$iNewH = $iHeight * $iRatioW;
		} else {
			$iNewW = $iWidth * $iRatioH;
			$iNewH = $iHeight * $iRatioH;
		}

		//Don't resize images which are smaller than thumbs
		if ($infos[0] < $width && $infos[1] < $height) {
			$iNewW = $infos[0];
			$iNewH = $infos[1];
		}

		if($infos[2] == 1) {
			/*
			* Image is typ gif
			*/
			$imgA = imagecreatefromgif($file);
			$imgB = imagecreate($iNewW,$iNewH);
			
       		//keep gif transparent color if possible
          	if(function_exists('imagecolorsforindex') && function_exists('imagecolortransparent')) {
            	$transcolorindex = imagecolortransparent($imgA);
            		//transparent color exists
            		if($transcolorindex >= 0 ) {
             			$transcolor = imagecolorsforindex($imgA, $transcolorindex);
              			$transcolorindex = imagecolorallocate($imgB, $transcolor['red'], $transcolor['green'], $transcolor['blue']);
              			imagefill($imgB, 0, 0, $transcolorindex);
              			imagecolortransparent($imgB, $transcolorindex);
              		//fill white
            		} else {
              			$whitecolorindex = @imagecolorallocate($imgB, 255, 255, 255);
              			imagefill($imgB, 0, 0, $whitecolorindex);
            		}
            //fill white
          	} else {
            	$whitecolorindex = imagecolorallocate($imgB, 255, 255, 255);
            	imagefill($imgB, 0, 0, $whitecolorindex);
          	}
          	imagecopyresampled($imgB, $imgA, 0, 0, 0, 0, $iNewW, $iNewH, $infos[0], $infos[1]);
			imagegif($imgB, $save);        

		} elseif($infos[2] == 2) {
			/*
			* Image is typ jpg
			*/
			$imgA = imagecreatefromjpeg($file);
			$imgB = imagecreatetruecolor($iNewW,$iNewH);
			imagecopyresampled($imgB, $imgA, 0, 0, 0, 0, $iNewW, $iNewH, $infos[0], $infos[1]);
			imagejpeg($imgB, $save);

		} elseif($infos[2] == 3) {
			/*
			* Image is typ png
			*/
			$imgA = imagecreatefrompng($file);
			$imgB = imagecreatetruecolor($iNewW, $iNewH);
			imagealphablending($imgB, false);
			imagecopyresampled($imgB, $imgA, 0, 0, 0, 0, $iNewW, $iNewH, $infos[0], $infos[1]);
			imagesavealpha($imgB, true);
			imagepng($imgB, $save);
		} else {
			return false;
		}
		return true;
	}
	
	function check($file, $tailleLimite )
	{
		jimport('joomla.filesystem.file');

		$sizelimit 	= $tailleLimite*1024; //size limit in kb
		$imagesize 	= $file['size'];

		//check if the upload is an image...getimagesize will return false if not
		if (!getimagesize($file['tmp_name'])) {
			JError::raiseWarning(100, JText::_('UPLOAD FAILED NOT AN IMAGE').': '.htmlspecialchars($file['name'], ENT_COMPAT, 'UTF-8'));
			return false;
		}

		//check if the imagefiletype is valid
		$fileext 	= JFile::getExt($file['name']);

		$allowable 	= array ('gif', 'jpg', 'png','GIF', 'JPG', 'PNG');
		if (!in_array($fileext, $allowable)) {
			JError::raiseWarning(100, JText::_('WRONG IMAGE FILE TYPE').': '.htmlspecialchars($file['name'], ENT_COMPAT, 'UTF-8'));
			return false;
		}

		//Check filesize
		if ($imagesize > $sizelimit) {
			JError::raiseWarning(100, JText::sprintf('IMAGE FILE SIZE', $tailleLimite ).': '.htmlspecialchars($file['name'], ENT_COMPAT, 'UTF-8'));
			return false;
		}

		//XSS check
		$xss_check =  JFile::read($file['tmp_name'],false,256);
		$html_tags = array('abbr','acronym','address','applet','area','audioscope','base','basefont','bdo','bgsound','big','blackface','blink','blockquote','body','bq','br','button','caption','center','cite','code','col','colgroup','comment','custom','dd','del','dfn','dir','div','dl','dt','em','embed','fieldset','fn','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','iframe','ilayer','img','input','ins','isindex','keygen','kbd','label','layer','legend','li','limittext','link','listing','map','marquee','menu','meta','multicol','nobr','noembed','noframes','noscript','nosmartquotes','object','ol','optgroup','option','param','plaintext','pre','rt','ruby','s','samp','script','select','server','shadow','sidebar','small','spacer','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','ul','var','wbr','xml','xmp','!DOCTYPE', '!--');
		foreach($html_tags as $tag) {
			// A tag is '<tagname ', so we need to add < and a space or '<tagname>'
			if(stristr($xss_check, '<'.$tag.' ') || stristr($xss_check, '<'.$tag.'>')) {
				JError::raiseWarning(100, JText::_('WARN IE XSS'));
				return false;
			}
		}

		return true;
	}
}