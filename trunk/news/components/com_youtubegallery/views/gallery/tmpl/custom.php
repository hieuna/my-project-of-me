<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 2.1.9
 * @author DesignCompass Corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/

    // no direct access
    defined('_JEXEC') or die('Restricted access');
    
	
	$params = &JComponentHelper::getParams( 'com_youtubegallery' );
	
	require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'render.php');
	
	$renderer= new YouTubeGalleryRenderer;
	
	
						$renderedcontent=$renderer->render(
												$this->Model->gallery_list,
												$this->Model->galleryid,
												$this->Model->row,
												$this->Model->total_number_of_rows
												);

		if($params->get( 'allowcontentplugins' ))
		{
								$o = new stdClass();
								$o->text=$renderedcontent;
							
								$dispatcher	= JDispatcher::getInstance();
							
								JPluginHelper::importPlugin('content');
							
												$r = $dispatcher->trigger('onPrepareContent', array (&$o, $params_, 0));
							
								$renderedcontent=$o->text;
		}
				
		
	
		$align=$params->get( 'align' );
								
				
								
								

								
        switch($align)
        {
            case 'left' :
				echo '<div style="float:left;">'.$renderedcontent.'</div>';
                break;
        	
            case 'center' :
                echo '<div style="width:'.$this->Model->video_width.'px;margin-left:auto;margin-right:auto;">'.$renderedcontent.'</div>';
                break;
        	
            case 'right' :
                echo '<div style="float:right;">'.$renderedcontent.'</div>';
                break;
	
			default :
                echo $renderedcontent;
                break;
	
        }
		
		
		    

?>


                