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
class Db8downloadViewUsers extends JViewLegacy {

    protected $items;
    protected $pagination;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        Db8downloadHelper::addSubmenu('users');

        $this->addToolbar();

        $this->sidebar = JHtmlSidebar::render();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar() {
        require_once JPATH_COMPONENT . '/helpers/db8download.php';

        $state = $this->get('State');
        $canDo = Db8downloadHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_DB8DOWNLOAD_TITLE_USERS'), 'users.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/user';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('user.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('user.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::custom('users.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('users.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'users.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('users.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
                JToolBarHelper::custom('users.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
                JToolBarHelper::deleteList('', 'users.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            } else if ($canDo->get('core.edit.state')) {
                JToolBarHelper::trash('users.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_db8download');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_db8download&view=users');

        $this->extra_sidebar = '';
                                                        
        //Filter for the field file;
        jimport('joomla.form.form');
        $options = array();
        JForm::addFormPath(JPATH_COMPONENT . '/models/forms');
        $form = JForm::getInstance('com_db8download.user', 'user');

        $field = $form->getField('file');

        $query = $form->getFieldAttribute('filter_file','query');
        $translate = $form->getFieldAttribute('filter_file','translate');
        $key = $form->getFieldAttribute('filter_file','key_field');
        $value = $form->getFieldAttribute('filter_file','value_field');

        // Get the database object.
        $db = JFactory::getDBO();

        // Set the query and get the result list.
        $db->setQuery($query);
        $items = $db->loadObjectlist();

        // Build the field options.
        if (!empty($items))
        {
            foreach ($items as $item)
            {
                if ($translate == true)
                {
                    $options[] = JHtml::_('select.option', $item->$key, JText::_($item->$value));
                }
                else
                {
                    $options[] = JHtml::_('select.option', $item->$key, $item->$value);
                }
            }
        }

        JHtmlSidebar::addFilter(
            '$File',
            'filter_file',
            JHtml::_('select.options', $options, "value", "text", $this->state->get('filter.file')),
            true
        );
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);

			//Filter for the field created
		$this->extra_sidebar .= '<div class="other-filters">';
			$this->extra_sidebar .= '<small><label for="filter_from_created">'. JText::sprintf('COM_DB8DOWNLOAD_FROM_FILTER', 'Created') .'</label></small>';
			$this->extra_sidebar .= JHtml::_('calendar', $this->state->get('filter.created.from'), 'filter_from_created', 'filter_from_created', '%Y-%m-%d', array('style' => 'width:142px;', 'onchange' => 'this.form.submit();'));
			$this->extra_sidebar .= '<small><label for="filter_to_created">'. JText::sprintf('COM_DB8DOWNLOAD_TO_FILTER', 'Created') .'</label></small>';
			$this->extra_sidebar .= JHtml::_('calendar', $this->state->get('filter.created.to'), 'filter_to_created', 'filter_to_created', '%Y-%m-%d', array('style' => 'width:142px;', 'onchange'=> 'this.form.submit();'));
		$this->extra_sidebar .= '</div>';
			$this->extra_sidebar .= '<hr class="hr-condensed">';

    }

	protected function getSortFields()
	{
		return array(
		'a.`id`' => JText::_('JGRID_HEADING_ID'),
		'a.`name`' => JText::_('COM_DB8DOWNLOAD_USERS_NAME'),
		'a.`email`' => JText::_('COM_DB8DOWNLOAD_USERS_EMAIL'),
		'a.`ip_address`' => JText::_('COM_DB8DOWNLOAD_USERS_IP_ADDRESS'),
		'a.`file`' => JText::_('COM_DB8DOWNLOAD_USERS_FILE'),
		'a.`ordering`' => JText::_('JGRID_HEADING_ORDERING'),
		'a.`state`' => JText::_('JSTATUS'),
		'a.`created`' => JText::_('COM_DB8DOWNLOAD_USERS_CREATED'),
		);
	}

}
