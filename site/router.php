<?php

/**
 * @version     1.0.0
 * @package     com_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */
// No direct access
defined('_JEXEC') or die;

JLoader::register('Db8downloadFrontendHelper', JPATH_COMPONENT . '/helpers/db8download.php');

class Db8downloadRouter extends JComponentRouterBase
{

	/**
	 * Build method for URLs
	 * This method is meant to transform the query parameters into a more human
	 * readable form. It is only executed when SEF mode is switched on.
	 *
	 * @param   array &$query An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 *
	 * @since   3.3
	 */
	public function build(&$query)
	{
		$segments = array();
		$view     = null;

		if (isset($query['task']))
		{
			$taskParts  = explode('.', $query['task']);
			$segments[] = implode('/', $taskParts);
			$view       = $taskParts[0];
			unset($query['task']);
		}
		if (isset($query['view']))
		{
			$segments[] = $query['view'];
			$view       = $query['view'];
			unset($query['view']);
		}
		if (isset($query['id']))
		{
			if ($view !== null)
			{
				$model      = Db8downloadFrontendHelper::getModel($view);
				if($model !== null){
					$item       = $model->getData($query['id']);
					$alias      = $model->getAliasFieldNameByView($view);
					$segments[] = $item->$alias;
				}
			}
			else
			{
				$segments[] = $query['id'];
			}

			unset($query['id']);
		}

		return $segments;
	}

	/**
	 * Parse method for URLs
	 * This method is meant to transform the human readable URL back into
	 * query parameters. It is only executed when SEF mode is switched on.
	 *
	 * @param   array &$segments The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 *
	 * @since   3.3
	 */
	public function parse(&$segments)
	{
		$vars = array();
		JLoader::register('Db8downloadFrontendHelper', JPATH_SITE . '/components/com_db8download/helpers/db8download.php');

		// view is always the first element of the array
		$vars['view'] = array_shift($segments);
		$model        = Db8downloadFrontendHelper::getModel($vars['view']);

		while (!empty($segments))
		{
			$segment = array_pop($segments);

			// If it's the ID, let's put on the request
			if (is_numeric($segment))
			{
				$vars['id'] = $segment;
			}
			else
			{
				$id = $model->getItemIdByAlias(str_replace(':', '-', $segment));
if (!empty($id))
{
	$vars['id'] = $id;
}
else
{
	$vars['task'] = $vars['view'] . '.' . $segment;
}
			}
		}

		return $vars;
	}

}
