<?php
/**
 * @version     1.0.0
 * @package     com_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::register('Db8downloadFrontendHelper', JPATH_COMPONENT . '/helpers/db8download.php');

// Execute the task.
$controller = JControllerLegacy::getInstance('Db8download');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
