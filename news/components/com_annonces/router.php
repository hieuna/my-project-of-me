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
function AnnoncesBuildRoute(&$query)
{
	$segments = array();

	if(isset($query['view']))
	{
		$segments[] = $query['view'];
		unset($query['view']);
	}

	if(isset($query['id']))
	{
		$segments[] = $query['id'];
		unset($query['id']);
	};

	if(isset($query['task']))
	{
		$segments[] = $query['task'];
		unset($query['task']);
	};

	if(isset($query['returnid']))
	{
		$segments[] = $query['returnid'];
		unset($query['returnid']);
	};

	return $segments;
}

function AnnoncesParseRoute($segments)
{
	$vars = array();

	//Handle View and Identifier
	switch($segments[0])
	{
		case 'annonce':
		{
			$id = explode(':', $segments[1]);
			$vars['id'] = $id[0];
			$vars['view'] = 'annonce';

		} break;
		
		
		case 'annonces':
		{
			$vars['view'] = 'annonces';
			$id = explode(':', $segments[1]);
			$vars['id'] = $id[0];

			$count = count($segments);
			if($count > 2) {
				$vars['task'] = $segments[2];
			}

		} break;

		case 'edit':
		{
			$count = count($segments);
			
			$vars['view'] = 'edit';

			if($count >= 3) {
				$vars['id'] = $segments[1];
				$vars['returnid'] = $segments[2];
			}
		} break;
	}

	return $vars;
}
?>