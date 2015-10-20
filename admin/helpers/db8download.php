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

/**
 * Db8download helper.
 */
class Db8downloadHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '') {
        		JHtmlSidebar::addEntry(
			JText::_('COM_DB8DOWNLOAD_TITLE_FILES'),
			'index.php?option=com_db8download&view=files',
			$vName == 'files'
		);
		JHtmlSidebar::addEntry(
			JText::_('JCATEGORIES') . ' (' . JText::_('COM_DB8DOWNLOAD_TITLE_FILES') . ')',
			"index.php?option=com_categories&extension=com_db8download",
			$vName == 'categories'
		);
		if ($vName=='categories') {
			JToolBarHelper::title('db8 Download: JCATEGORIES (COM_DB8DOWNLOAD_TITLE_FILES)');
		}

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_db8download';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
