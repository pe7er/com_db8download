<?php

/**
 * @version     1.0.0
 * @package     com_db8download
 * @subpackage  mod_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$doc = JFactory::getDocument();

/* */
$doc->addStyleSheet(JURI::base() . '/modules/mod_db8download/assets/css/style.css');

/* */
$doc->addScript(JURI::base() . '/modules/mod_db8download/assets/js/script.js');

require JModuleHelper::getLayoutPath('mod_db8download', $params->get('content_type', 'blank'));
