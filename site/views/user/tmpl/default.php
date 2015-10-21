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

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_db8download');
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_db8download')) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">
        <table class="table">
            <tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_EMAIL'); ?></th>
			<td><?php echo $this->item->email; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_IP_ADDRESS'); ?></th>
			<td><?php echo $this->item->ip_address; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_FILE'); ?></th>
			<td><?php echo $this->item->file; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_CREATED'); ?></th>
			<td><?php echo $this->item->created; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_DB8DOWNLOAD_FORM_LBL_USER_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>

        </table>
    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_db8download&task=user.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_DB8DOWNLOAD_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_db8download')):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_db8download&task=user.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_DB8DOWNLOAD_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_DB8DOWNLOAD_ITEM_NOT_LOADED');
endif;
?>
