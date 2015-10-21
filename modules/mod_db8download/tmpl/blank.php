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

$safe_htmltags = array(
    'a', 'address', 'em', 'strong', 'b', 'i',
    'big', 'small', 'sub', 'sup', 'cite', 'code',
    'img', 'ul', 'ol', 'li', 'dl', 'lh', 'dt', 'dd',
    'br', 'p', 'table', 'th', 'td', 'tr', 'pre',
    'blockquote', 'nowiki', 'h1', 'h2', 'h3',
    'h4', 'h5', 'h6', 'hr');

/* @var $params Joomla\Registry\Registry */
$filter = JFilterInput::getInstance($safe_htmltags);
echo $filter->clean($params->get('html_content'));
?>