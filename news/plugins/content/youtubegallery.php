<?php
/**
 * YouTubeGallery Joomla! 1.5 Native Component
 * @version 2.1.9
 * @author DesignCompass Corp <admin@designcompasscorp.com>
 * @link http://www.designcompasscorp.com
 * @license GNU/GPL
 **/


defined('_JEXEC') or die('Restricted access');

$mainframe->registerEvent('onPrepareContent', 'plgContentYouTubeGallery');

function plgContentYouTubeGallery(&$row, &$params, $page=0)
{
	if (is_object($row)) {
		plgYouTubeGallery($row->text, $params);
		plgYouTubeGalleryByID($row->text, $params);
	}
	else
	{
		plgYouTubeGallery($row, $params);
		plgYouTubeGalleryByID($row, $params);
	}
}

///////////////////

function plgYouTubeGallery(&$text, &$params)
{
	
	$yg=new YouTubeGalleryClass;
	
	$options=array();
	$fList=$yg->getListToReplace('youtubegallery',$options,$text);
	
	
	if(count($fList)>0)
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');
		require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'render.php');
	}
	
	for($i=0; $i<count($fList);$i++)
	{
		$replaceWith=$yg->getYouTubeGallery($options[$i],$i,false);
		
		$text=str_replace($fList[$i],$replaceWith,$text);	
	}
	
	
	return true;
}

function plgYouTubeGalleryByID(&$text, &$params)
{
	
	$yg=new YouTubeGalleryClass;
	
	$options=array();
	$fList=$yg->getListToReplace('youtubegalleryid',$options,$text);
	
	if(count($fList)>0)
	{
		require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'misc.php');
		require_once(JPATH_SITE.DS.'components'.DS.'com_youtubegallery'.DS.'includes'.DS.'render.php');
	}
	
	for($i=0; $i<count($fList);$i++)
	{
		$replaceWith=$yg->getYouTubeGallery($options[$i],$i,true);
		
		$text=str_replace($fList[$i],$replaceWith,$text);	
	}
	
	
	return true;
}


class YouTubeGalleryClass
{
	
	
	function getListToReplace($par,&$options,&$text)
	{
		$fList=array();
		$l=strlen($par)+2;
	
		$offset=0;
		do{
			if($offset>=strlen($text))
				break;
		
			$ps=strpos($text, '{'.$par.'=', $offset);
			if($ps===false)
				break;
		
		
			if($ps+$l>=strlen($text))
				break;
		
		$pe=strpos($text, '}', $ps+$l);
				
		if($pe===false)
			break;
		
		$notestr=substr($text,$ps,$pe-$ps+1);

			$options[]=substr($text,$ps+$l,$pe-$ps-$l);
			$fList[]=$notestr;
			

		$offset=$ps+$l;
		
			
		}while(!($pe===false));
		
		return $fList;
	}

	

	function getYoutubeGallery($galleryparams,$count,$byId)
	{
		$result='';
		
		$opt=explode(',',$galleryparams);
		if(count($opt)<1)
			return '';
	
		
		$db = & JFactory::getDBO();
		
		if($byId)
		{
			$galleryid=(int)$opt[0];
			$query = 'SELECT * FROM #__youtubegallery WHERE id='.$galleryid.' LIMIT 1';
		}
		else
		{
			$galleryname=trim($opt[0]);
			$query = 'SELECT * FROM #__youtubegallery WHERE galleryname="'.$galleryname.'" LIMIT 1';
		}
			
		
		$db->setQuery($query);
		if (!$db->query())    die ( $db->stderr());
		
		
		$rows = $db->loadObjectList();
				
		if(count($rows)==0)
			return '';
			
		$row=$rows[0];
		$galleryid=$row->id;

		if(count($opt)>1)
		{
			$row->width=(int)$opt[1];
			
			$row->height=(int)$opt[2];
			$row->playvideo=(int)$opt[3];
			$row->repeat=(int)$opt[4];
			$row->fullscreen=(int)$opt[5];
			$row->autoplay=(int)$opt[6];
			$row->relatedvideos=(int)$opt[7];
			$row->showinfo=(int)$opt[8];
			$row->thumbbgcolor=$opt[9];
			$row->columns=(int)$opt[10];
			
			$row->showtitle=(int)$opt[11];

		}
		else
		{

		}

		$misc=new YouTubeGalleryMisc;
		$misc->tablerow = &$row;

		$total_number_of_rows=0;
							
		$misc->update_playlist($row);
								
		$videoid=JRequest::getVar('videoid');

		if($row->playvideo==1 and $videoid!='')
			$row->autoplay=1;

		$videoid_new=$videoid;
		$gallerylist=$misc->getGalleryList_FromCache_From_Table($galleryid,$videoid_new,$total_number_of_rows);
							
		if($videoid=='')
		{
			if($row->playvideo==1 and $videoid_new!='')
				JRequest::setVar('videoid',$videoid_new);
		}

		$renderer= new YouTubeGalleryRenderer;
		
		$result.=$renderer->render(
								 $gallerylist,
								 $galleryid,
								 $row,
								 $total_number_of_rows
								 );
	
		return $result;
	
	}

	
}


?>