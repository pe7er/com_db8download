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

jimport('joomla.application.component.view');

/**
 * View class for a list of Db8download.
 */
class Db8downloadViewFiles extends JViewLegacy
{

    protected $items;
    protected $pagination;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        Db8downloadHelper::addSubmenu('files');

        $this->addToolbar();

        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since    1.6
     */
    protected function addToolbar()
    {
        require_once JPATH_COMPONENT . '/helpers/db8download.php';

        $state = $this->get('State');
        $canDo = Db8downloadHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_DB8DOWNLOAD_TITLE_FILES'), 'files.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/file';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('file.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('file.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('files.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('files.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'files.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('files.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('files.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'files.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('files.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_db8download');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_db8download&view=files');

    }

    protected function getSortFields()
    {
        return array(
            'a.`id`' => JText::_('JGRID_HEADING_ID'),
            'a.`name`' => JText::_('COM_DB8DOWNLOAD_FILES_NAME'),
            'a.`alias`' => JText::_('COM_DB8DOWNLOAD_FILES_ALIAS'),
            'a.`catid`' => JText::_('COM_DB8DOWNLOAD_FILES_CATID'),
            'a.`filename`' => JText::_('COM_DB8DOWNLOAD_FILES_FILENAME'),
            'a.`image`' => JText::_('COM_DB8DOWNLOAD_FILES_IMAGE'),
            'a.`access`' => JText::_('COM_DB8DOWNLOAD_FILES_ACCESS'),
            'a.`language`' => JText::_('JGRID_HEADING_LANGUAGE'),
            'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
            'a.`state`' => JText::_('JSTATUS'),
            'a.`created`' => JText::_('COM_DB8DOWNLOAD_FILES_CREATED'),
            'a.`created_by`' => JText::_('COM_DB8DOWNLOAD_FILES_CREATED_BY'),
            'a.`hits`' => JText::_('COM_DB8DOWNLOAD_FILES_HITS'),
            'a.`tags`' => JText::_('COM_DB8DOWNLOAD_FILES_TAGS'),
        );
    }

}
