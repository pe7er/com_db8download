<?php
/**
 * @version     1.0.0
 * @package     com_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Users list controller class.
 */
class Db8downloadControllerUsers extends Db8downloadController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Users', $prefix = 'Db8downloadModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}