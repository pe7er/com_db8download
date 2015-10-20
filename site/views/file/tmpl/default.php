<?php
/**
 * @version     1.0.0
 * @package     com_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */
// no direct access
defined('_JEXEC') or die;


?>
<?php if ($this->item) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_ALIAS'); ?></th>
			<td><?php echo $this->item->alias; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_CATID'); ?></th>
			<td><?php echo $this->item->catid_title; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_FILENAME'); ?></th>
			<td>
			<?php $uploadPath = 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_db8download' . DIRECTORY_SEPARATOR . 'db8downloads' . DIRECTORY_SEPARATOR . $this->item->filename; ?>
			<a href="<?php echo JRoute::_(JUri::base() . $uploadPath, false); ?>" target="_blank"><?php echo $this->item->filename; ?></a></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_DESCRIPTION'); ?></th>
			<td><?php echo $this->item->description; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_ACCESS'); ?></th>
			<td><?php echo $this->item->access; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_LANGUAGE'); ?></th>
			<td><?php echo $this->item->language; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_CREATED'); ?></th>
			<td><?php echo $this->item->created; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_HITS'); ?></th>
			<td><?php echo $this->item->hits; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_FILE_TAGS'); ?></th>
			<td><?php echo $this->item->tags; ?></td>
</tr>

        </table>
    </div>
    
    <?php
else:
    echo JText::_('COM_DB8DOWNLOAD_ITEM_NOT_LOADED');
endif;
?>
