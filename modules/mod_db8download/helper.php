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

/**
 * Helper for mod_db8download
 *
 * @package     com_db8download
 * @subpackage  mod_db8download
 */
class ModDb8downloadHelper {

    /**
     * Retrieve component items
     * @param Joomla\Registry\Registry  &$params  module parameters
     * @return array Array with all the elements
     */
    public static function getList(&$params) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        /* @var $params Joomla\Registry\Registry */
        $query
                ->select('*')
                ->from($params->get('table'))
                ->where('state = 1');

        $db->setQuery($query, $params->get('offset'), $params->get('limit'));
        $rows = $db->loadObjectList();
        return $rows;
    }

    /**
     * Retrieve component items
     * @param Joomla\Registry\Registry  &$params  module parameters
     * @return mixed stdClass object if the item was found, null otherwise
     */
    public static function getItem(&$params) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        /* @var $params Joomla\Registry\Registry */
        $query
                ->select('*')
                ->from($params->get('item_table'))
                ->where('id = ' . intval($params->get('item_id')));

        $db->setQuery($query);
        $element = $db->loadObject();
        return $element;
    }

    /**
     * 
     * @param Joomla\Registry\Registry $params
     * @param string $field
     */
    public static function renderElement($table_name, $field_name, $field_value) {
        $result = '';
        
        switch ($table_name) {
            
		case '#__db8download_files':
		switch($field_name){
		case 'id':
		$result = $field_value;
		break;
		case 'name':
		$result = $field_value;
		break;
		case 'alias':
		$result = $field_value;
		break;
		case 'catid':
		$result = self::loadValueFromExternalTable('#__categories', 'id', 'title', $field_value);
		break;
		case 'filename':
						if (!empty($field_value)) {
							$result = JPATH_ADMINISTRATOR . 'components/com_db8download/com_db8download/' . $field_value;
						} else {
							$result = $field_value;
						}
		break;
		case 'image':
		$result = $field_value;
		break;
		case 'description':
		$result = $field_value;
		break;
		case 'access':
		$result = $field_value;
		break;
		case 'language':
		$result = JLanguage::getInstance($field_value)->getName();
		break;
		case 'created':
		$result = $field_value;
		break;
		case 'created_by':
		$user = JFactory::getUser($field_value);
		$result = $user->name;
		break;
		case 'hits':
		$result = $field_value;
		break;
		case 'tags':
		$result = self::loadValueFromExternalTable('#__tags', 'id', 'title', $field_value);
		break;
		}
		break;
		case '#__db8download_users':
		switch($field_name){
		case 'id':
		$result = $field_value;
		break;
		case 'name':
		$result = $field_value;
		break;
		case 'email':
		$result = $field_value;
		break;
		case 'ip_address':
		$result = $field_value;
		break;
		case 'file':
		$result = self::loadValueFromExternalTable('#__db8download_files', 'id', 'name', $field_value);
		break;
		case 'created':
		$result = $field_value;
		break;
		case 'created_by':
		$user = JFactory::getUser($field_value);
		$result = $user->name;
		break;
		}
		break;
        }
        return $result;
    }

    /**
     * Returns the translatable name of the element
     * @param Joomla\Registry\Registry $params
     * @param string $field Field name
     * @return string Translatable name.
     */
    public static function renderTranslatableHeader(&$params, $field) {
        return JText::_('MOD_DB8DOWNLOAD_HEADER_FIELD_' . str_replace('#__', '', strtoupper($params->get('table'))) . '_' . strtoupper($field));
    }

    /**
     * Checks if an element should appear in the table/item view
     * @param string $field name of the field
     * @return boolean True if it should appear, false otherwise
     */
    public static function shouldAppear($field) {
        $noHeaderFields = array('checked_out_time', 'checked_out', 'ordering', 'state');
        return !in_array($field, $noHeaderFields);
    }

    

    /**
     * Method to get a value from a external table
     * @param string $source_table Source table name
     * @param string $key_field Source key field 
     * @param string $value_field Source value field
     * @param mixed  $key_value Value for the key field
     * @return mixed The value in the external table or null if it wasn't found
     */
    private static function loadValueFromExternalTable($source_table, $key_field, $value_field, $key_value) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
                ->select($db->quoteName($value_field))
                ->from($source_table)
                ->where($db->quoteName($key_field) . ' = ' . $db->quote($key_value));


        $db->setQuery($query);
        return $db->loadResult();
    }
}
